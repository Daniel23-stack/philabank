<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use App\Utilities\Overrider;
use App\Utilities\SmsHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller {
	public function __construct() {
		date_default_timezone_set(get_option('timezone', 'Asia/Dhaka'));
	}

	public function index() {
		$alert_col = 'col-lg-8 offset-lg-2';
		$profile = auth()->user();
		$customFields = json_decode(get_option('users_custom_fields', '[]'));
		return view('backend.profile.profile_view', compact('profile', 'alert_col', 'customFields'));
	}

	public function edit() {
		$alert_col = 'col-lg-8 offset-lg-2';
		$profile = auth()->user();
		$customFields = json_decode(get_option('users_custom_fields', '[]'));
		return view('backend.profile.profile_edit', compact('profile', 'alert_col', 'customFields'));
	}

	public function show_notification($id) {
		$notification = auth()->user()->notifications()->find($id);
		if ($notification && request()->ajax()) {
			$notification->markAsRead();
			return new Response('<div class="alert alert-info" role="alert">' . $notification->data['message'] . '</div>');
		}
		return back();
	}

	public function notification_mark_as_read($id) {
		$notification = auth()->user()->notifications()->find($id);
		if ($notification) {
			$notification->markAsRead();
		}
	}

	public function update(Request $request) {
		$validationRules = [
			'name' => 'required',
			'country_code' => 'required',
			'phone' => 'required',
			'email' => [
				'required',
				Rule::unique('users')->ignore(Auth::user()->id),
			],
			'profile_picture' => 'nullable|image|max:5120',
		];

		$validationMessages = [];

		// Custom field validation
		$customFields = json_decode(get_option('users_custom_fields', '[]'));
		$customValidation = generate_custom_field_validation($customFields, true);

		$validationRules = array_merge($validationRules, $customValidation['rules']);
		$validationMessages = array_merge($validationMessages, $customValidation['messages']);

		$validator = Validator::make($request->all(), $validationRules, $validationMessages);

		if ($validator->fails()) {
			if ($request->ajax()) {
				return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
			} else {
				return back()->withErrors($validator)->withInput();
			}
		}

		DB::beginTransaction();

		$profile = Auth::user();

		// Store custom field data
		$customFieldsData = store_custom_field_data($customFields, json_decode($profile->custom_fields, true));

		if (get_option('email_verification') == 'enabled') {
			if ($profile->email != $request->email) {
				$profile->email_verified_at = null;
			}
			Overrider::load("Settings");
		}

		if (get_option('mobile_verification') == 'enabled') {
			if ($profile->phone != $request->phone) {
				$profile->sms_verified_at = null;
			}

			if ($profile->country_code != $request->country_code) {
				$profile->sms_verified_at = null;
			}
		}

		$profile->name = $request->name;
		$profile->email = $request->email;
		$profile->country_code = $request->country_code;
		$profile->phone = $request->phone;
		$profile->custom_fields = json_encode($customFieldsData);
		if ($request->hasFile('profile_picture')) {
			$image = $request->file('profile_picture');
			$file_name = "profile_" . time() . '.' . $image->getClientOriginalExtension();
			Image::make($image)->crop(300, 300)->save(base_path('public/uploads/profile/') . $file_name);
			$profile->profile_picture = $file_name;
		}

		$profile->save();

		DB::commit();

		if (get_option('email_verification') == 'enabled') {
			Auth::user()->sendEmailVerificationNotification();
		}

		return redirect()->route('profile.index')->with('success', _lang('Profile updated successfully'));
	}

	/**
	 * Show the form for change_password the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function change_password() {
		$alert_col = 'col-lg-8 offset-lg-2';
		return view('backend.profile.change_password', compact('alert_col'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update_password(Request $request) {
		$this->validate($request, [
			'oldpassword' => 'required',
			'password' => 'required|string|min:6|confirmed',
		]);

		$user = User::find(Auth::User()->id);
		if (Hash::check($request->oldpassword, $user->password)) {
			$user->password = Hash::make($request->password);
			$user->save();
		} else {
			return back()->with('error', _lang('Old Password did not match !'));
		}
		return back()->with('success', _lang('Password has been changed'));
	}

	public function mobile_verification(Request $request) {
		if (request()->isMethod('get')) {
			if (get_option('mobile_verification') == 'enabled' && auth()->user()->sms_verified_at == null && auth()->user()->user_type == 'customer') {

				$code = random_int(100000, 999999);
				$body = "Please use this code - $code to verify your phone number";
				$api_error = '';

				try {
					$sms = new SmsHelper();
					$sms->send(auth()->user()->country_code . auth()->user()->phone, $body);
				} catch (\Exception $e) {
					$api_error = 'SMS API HAVING ISSUES. PLESE CHECK YOUR SMS CONFIGURATION !';
				}

				$alert_col = 'col-lg-6 offset-lg-3';
				$sms_token = encrypt($code);
				return view('backend.profile.mobile_verification', compact('alert_col', 'api_error', 'sms_token'));
			}
			return back();
		} else if (request()->isMethod('post')) {

			$validator = Validator::make($request->all(), [
				'verification_code' => 'required',
				'sms_token' => 'required',
			]);

			if ($validator->fails()) {
				if ($request->ajax()) {
					return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
				} else {
					return back()->withErrors($validator)
						->withInput();
				}
			}

			if (request()->verification_code == decrypt(request()->sms_token)) {
				$profile = Auth::user();
				$profile->sms_verified_at = now();
				$profile->save();

				if (!$request->ajax()) {
					return redirect()->route('dashboard.index')->with('success', _lang('Verification Successfully'));
				} else {
					return response()->json(['result' => 'success', 'message' => _lang('Verification Successfully')]);
				}
			} else {
				if (!$request->ajax()) {
					return back()->with('error', _lang('Invalid Verification Code !'));
				} else {
					return response()->json(['result' => 'error', 'action' => 'store', 'message' => _lang('Invalid Verification Code !')]);
				}
			}

		}
	}

	public function document_verification(Request $request) {
		if (request()->isMethod('get')) {
			if (get_option('enable_kyc') == 'yes' && auth()->user()->document_verified_at == null && auth()->user()->user_type == 'customer') {
				$alert_col = "col-lg-6 offset-lg-3";
				return view('backend.profile.document_verification', compact('alert_col'));
			}
			return back();
		} else if (request()->isMethod('post')) {

			$kyc_form_fields = json_decode(get_option('kyc_form_fields', '[]'));

			if (empty($kyc_form_fields)) {
				return back()->with('error', _lang('KYC field not found'));
			}

			$validationRules = [];
			$validationMessages = [];

			// Custom field validation
			$validation = generate_custom_field_validation($kyc_form_fields);

			$validationRules = array_merge($validationRules, $validation['rules']);
			$validationMessages = array_merge($validationMessages, $validation['messages']);

			$validator = Validator::make($request->all(), $validationRules, $validationMessages);

			if ($validator->fails()) {
				if ($request->ajax()) {
					return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
				} else {
					return back()->withErrors($validator)
						->withInput();
				}
			}

			DB::beginTransaction();
			if (!empty($kyc_form_fields)) {
				foreach ($kyc_form_fields as $field) {
					$field_label = $field->field_label;
					$field_name = $field->field_name;
					$field_type = $field->field_type;

					if ($field_type == 'file') {
						if (request()->hasFile('requirements.' . $field_name)) {
							$file = request()->file('requirements.' . $field_name);
							$file_name = $file->getClientOriginalName();
							$file_name = str_replace(' ', '_', $file_name);
							$file_name = time() . md5(uniqid()) . '_' . $file_name;
							$file->move('public/uploads/media/', $file_name);
							$field_value = $file_name;
						} else {
							$field_value = null;
						}
					} else {
						$field_value = request()->requirements[$field_name];
					}

					$document = new Document();
					$document->document_name = $field_label;
					$document->document_type = $field_type;
					$document->document = $field_value;
					$document->user_id = auth()->id();

					$document->save();
				}
			}

			//Update User table
			$user = Auth::user();
			$user->document_submitted_at = now();
			$user->save();

			DB::commit();

			return redirect()->route('dashboard.index')->with('success', _lang('Thank you for submitting your document. You will be notified soon after reviewing your documents by authority.'));

		}
	}

}
