<?php

namespace App\Http\Controllers;

use App\Mail\GeneralMail;
use App\Models\Document;
use App\Models\Transaction;
use App\Models\User;
use App\Utilities\Overrider;
use App\Utilities\SmsHelper;
use DataTables;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		date_default_timezone_set(get_option('timezone', 'Asia/Dhaka'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index($status = 'all') {
		return view('backend.user.list', compact('status'));
	}

	public function get_table_data($status = 'all') {
		$users = User::select('users.*')
			->with('branch')
			->where('user_type', 'customer')
			->when($status, function ($query, $status) {
				if ($status == 'email_verified') {
					return $query->where('email_verified_at', '!=', null);
				} else if ($status == 'kyc_verified') {
					return $query->where('document_verified_at', '!=', null);
				} else if ($status == 'kyc_unverified') {
					return $query->where('document_verified_at', null);
				} else if ($status == 'inactive') {
					return $query->where('status', 0);
				} else if ($status == 'active') {
					return $query->where('status', 1);
				}
			})
			->orderBy("users.id", "desc");

		return Datatables::eloquent($users)
			->editColumn('phone', function ($user) {
				return '+' . $user->country_code . '-' . $user->phone;
			})
			->editColumn('status', function ($user) {
				return status($user->status);
			})
			->addColumn('profile_picture', function ($user) {
				return '<div class="text-center"><img class="thumb-sm img-thumbnail"
				src="' . profile_picture($user->profile_picture) . '"></div>';
			})
			->editColumn('document_verified_at', function ($user) {
				$isVerified = $user->document_verified_at != null ? show_status(_lang('Yes'), 'primary') : show_status(_lang('No'), 'danger');
				return "<div class='text-center'>" . $isVerified . "</div>";
			})
			->addColumn('action', function ($user) {
				return '<div class="text-center"><form action="' . action('UserController@destroy', $user['id']) . '" class="text-center" method="post">'
				. '<a href="' . action('UserController@show', $user['id']) . '" class="btn btn-primary btn-sm"><i class="icofont-eye-alt"></i></a>&nbsp;'
				. '<a href="' . action('UserController@edit', $user['id']) . '" class="btn btn-warning btn-sm"><i class="icofont-ui-edit"></i></a>&nbsp;'
				. '<a href="' . route('users.view_documents', $user['id']) . '" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="' . _lang('View Documents') . '"><i class="icofont-file-document"></i></a>&nbsp;'
				. csrf_field()
					. '<input name="_method" type="hidden" value="DELETE">'
					. '<button class="btn btn-danger btn-sm btn-remove" type="submit"><i class="icofont-trash"></i></button>'
					. '</form></div>';
			})
			->setRowId(function ($user) {
				return "row_" . $user->id;
			})
			->rawColumns(['status', 'profile_picture', 'document_verified_at', 'email_verified_at', 'sms_verified_at', 'action'])
			->make(true);
	}

	/**
	 * Display a listing of users Documents.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function documents() {
		$users = User::where('user_type', 'customer')
			->where('document_submitted_at', '!=', null)
			->where('document_verified_at', null)
			->has('documents')->get();

		return view('backend.user.documents', compact('users'));
	}

	/**
	 * Display single users Documents.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function view_documents($user_id) {
		$documents = Document::where('user_id', $user_id)->get();
		$user = User::find($user_id);
		return view('backend.user.view_documents', compact('documents', 'user'));
	}

	/**
	 * Varify User account.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function varify($user_id) {
		$user = User::find($user_id);
		$user->document_verified_at = now();
		$user->save();

		//Send Email/Notification to customer

		//Redirect to back
		return back()->with('varified_success', _lang('Account Verified'));
	}

	/**
	 * Unvarify User account.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function unvarify($user_id) {
		$user = User::find($user_id);
		$user->document_verified_at = null;
		$user->document_submitted_at = null;
		$user->save();

		//Send Email/Notification to customer

		//Redirect to back
		return back()->with('varified_success', _lang('Account Unverified'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request) {
		$customFields = json_decode(get_option('users_custom_fields', '[]'));
		return view('backend.user.create', compact('customFields'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$validationRules = [
			'name' => 'required|max:255',
			'email' => 'required|email|unique:users|max:255',
			'account_number' => 'required|max:30|unique:users',
			'branch_id' => 'required',
			'status' => 'required',
			'profile_picture' => 'nullable|image',
			'password' => 'required|min:6',
		];

		$validationMessages = [];

		// Custom field validation
		$customFields = json_decode(get_option('users_custom_fields', '[]'));
		$customValidation = generate_custom_field_validation($customFields);

		$validationRules = array_merge($validationRules, $customValidation['rules']);
		$validationMessages = array_merge($validationMessages, $customValidation['messages']);

		$validator = Validator::make($request->all(), $validationRules, $validationMessages);

		if ($validator->fails()) {
			if ($request->ajax()) {
				return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
			} else {
				return redirect()->route('users.create')
					->withErrors($validator)
					->withInput();
			}
		}

		$profile_picture = "";
		if ($request->hasfile('profile_picture')) {
			$file = $request->file('profile_picture');
			$profile_picture = time() . $file->getClientOriginalName();
			$file->move(public_path() . "/uploads/profile/", $profile_picture);
		}

		// Store custom field data
		$customFieldsData = store_custom_field_data($customFields);

		$user = new User();
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->country_code = $request->input('country_code');
		$user->phone = $request->input('phone');
		$user->account_number = $request->input('account_number');
		$user->user_type = 'customer';
		$user->branch_id = $request->branch_id;
		$user->status = $request->input('status');
		$user->profile_picture = $profile_picture;
		$user->email_verified_at = $request->email_verified_at;
		$user->sms_verified_at = $request->sms_verified_at;
		$user->password = Hash::make($request->password);
		$user->custom_fields = json_encode($customFieldsData);

		$user->save();

		//Increment Account Number
		increment_account_number();

		//Prefix Output
		$user->status = status($user->status);
		$user->branch_id = $user->branch->name;
		$user->profile_picture = '<img src="' . profile_picture($user->profile_picture) . '" class="thumb-sm img-thumbnail">';

		if (!$request->ajax()) {
			return redirect()->route('users.index')->with('success', _lang('Saved successfully'));
		} else {
			return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Saved successfully'), 'data' => $user, 'table' => '#users_table']);
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request, $id) {
		$customFields = json_decode(get_option('users_custom_fields', '[]'));
		$user = User::find($id);
		$account_balance = DB::select("SELECT currency.*, (SELECT IFNULL(SUM(amount), 0) FROM transactions
            WHERE dr_cr = 'cr' AND currency_id = currency.id AND status = 2 AND transactions.user_id = " . $user->id . ") - (SELECT IFNULL(SUM(amount),0)
            FROM transactions WHERE dr_cr = 'dr' AND currency_id = currency.id AND status != 0 AND transactions.user_id = " . $user->id . ") as balance
            FROM currency LEFT JOIN transactions ON currency.id=transactions.currency_id WHERE currency.status=1 GROUP BY currency.id");

		return view('backend.user.view', compact('user', 'id', 'account_balance', 'customFields'));
	}

	public function get_user_transaction_data($user_id) {
		$transactions = Transaction::select('transactions.*')
			->with(['currency', 'user'])
			->where('user_id', $user_id)
			->orderBy("transactions.created_at", "desc");

		return Datatables::eloquent($transactions)
			->editColumn('amount', function ($transaction) {
				$symbol = $transaction->dr_cr == 'dr' ? '-' : '+';
				$class = $transaction->dr_cr == 'dr' ? 'text-danger' : 'text-success';
				return '<span class="' . $class . ' text-nowrap">' . $symbol . ' ' . decimalPlace($transaction->amount, currency($transaction->currency->name)) . '</span>';
			})
			->editColumn('dr_cr', function ($transaction) {
				return strtoupper($transaction->dr_cr);
			})
			->editColumn('type', function ($transaction) {
				return str_replace('_', ' ', $transaction->type);
			})
			->editColumn('status', function ($transaction) {
				return transaction_status($transaction->status);
			})
			->addColumn('action', function ($transaction) {
				return '<div class="dropdown text-center">'
				. '<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">' . _lang('Action')
				. '&nbsp;</button>'
				. '<div class="dropdown-menu">'
				. '<a class="dropdown-item ajax-modal" href="' . action('TransferRequestController@show', $transaction['id']) . '" data-title="' . _lang('Transaction Details') . '"><i class="icofont-eye-alt"></i> ' . _lang('Details') . '</a>'
				. '<a class="dropdown-item ajax-modal" href="' . action('TransactionController@edit', $transaction['id']) . '" data-title="' . _lang('Edit Transaction') . '"><i class="icofont-ui-edit"></i>  ' . _lang('Edit') . '</a>'
					. '</div>'
					. '</div>';
			})
			->setRowId(function ($transaction) {
				return "row_" . $transaction->id;
			})
			->rawColumns(['status', 'amount', 'action'])
			->make(true);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Request $request, $id) {
		$customFields = json_decode(get_option('users_custom_fields', '[]'));
		$user = User::find($id);
		return view('backend.user.edit', compact('user', 'id', 'customFields'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$validationRules = [
			'name' => 'required|max:255',
			'email' => [
				'required',
				'email',
				Rule::unique('users')->ignore($id),
			],
			'account_number' => [
				'required',
				'max:30',
				Rule::unique('users')->ignore($id),
			],
			'status' => 'required',
			'profile_picture' => 'nullable|image',
			'password' => 'nullable|min:6',
			'allow_withdrawal' => 'required',
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
				return redirect()->route('users.edit', $id)
					->withErrors($validator)
					->withInput();
			}
		}

		if ($request->hasfile('profile_picture')) {
			$file = $request->file('profile_picture');
			$profile_picture = time() . $file->getClientOriginalName();
			$file->move(public_path() . "/uploads/profile/", $profile_picture);
		}

		$user = User::find($id);

		// Store custom field data
		$customFieldsData = store_custom_field_data($customFields, json_decode($user->custom_fields, true));
		
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->country_code = $request->input('country_code');
		$user->phone = $request->input('phone');
		$user->account_number = $request->input('account_number');
		$user->status = $request->input('status');
		$user->branch_id = $request->branch_id;
		$user->allow_withdrawal = $request->allow_withdrawal;
		if ($request->hasfile('profile_picture')) {
			$user->profile_picture = $profile_picture;
		}
		if ($request->password) {
			$user->password = Hash::make($request->password);
		}

		$user->email_verified_at = $request->email_verified_at;
		$user->sms_verified_at = $request->sms_verified_at;
		$user->custom_fields = json_encode($customFieldsData);

		$user->save();

		//Prefix Output
		$user->status = status($user->status);
		$user->branch_id = $user->branch->name;
		$user->profile_picture = '<img src="' . profile_picture($user->profile_picture) . '" class="thumb-sm img-thumbnail">';

		if (!$request->ajax()) {
			return redirect()->route('users.index')->with('success', _lang('Updated successfully'));
		} else {
			return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Updated successfully'), 'data' => $user, 'table' => '#users_table']);
		}

	}

	public function send_email(Request $request) {
		@ini_set('max_execution_time', 0);
		@set_time_limit(0);

		Overrider::load("Settings");

		$validator = Validator::make($request->all(), [
			'user_email' => 'required',
			'subject' => 'required',
			'message' => 'required',
		]);

		if ($validator->fails()) {
			if ($request->ajax()) {
				return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
			} else {
				return back()->withErrors($validator)
					->withInput();
			}
		}

		//Send email
		$subject = $request->input("subject");
		$message = $request->input("message");

		$mail = new \stdClass();
		$mail->subject = $subject;
		$mail->body = $message;

		try {
			Mail::to($request->user_email)
				->send(new GeneralMail($mail));
		} catch (\Exception $e) {
			if (!$request->ajax()) {
				return back()->with('error', _lang('Sorry, Error Occured !'));
			} else {
				return response()->json(['result' => 'error', 'message' => _lang('Sorry, Error Occured !')]);
			}
		}

		if (!$request->ajax()) {
			return back()->with('success', _lang('Email Send Sucessfully'));
		} else {
			return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Email Send Sucessfully'), 'data' => $contact]);
		}
	}

	public function send_sms(Request $request) {
		@ini_set('max_execution_time', 0);
		@set_time_limit(0);

		Overrider::load("Settings");

		$validator = Validator::make($request->all(), [
			'phone' => 'required',
			'message' => 'required:max:160',
		]);

		if ($validator->fails()) {
			if ($request->ajax()) {
				return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
			} else {
				return back()->withErrors($validator)
					->withInput();
			}
		}

		//Send message
		$message = $request->input("message");

		if (get_option('sms_gateway') == 'none') {
			return back()->with('error', _lang('Sorry, SMS Gateway is disabled !'));
		}

		try {
			$sms = new SmsHelper();
			$sms->send($request->phone, $message);
		} catch (\Exception $e) {
			if (!$request->ajax()) {
				return back()->with('error', _lang('Sorry, Error Occured !'));
			} else {
				return response()->json(['result' => 'error', 'message' => _lang('Sorry, Error Occured !')]);
			}
		}

		if (!$request->ajax()) {
			return back()->with('success', _lang('SMS Send Sucessfully'));
		} else {
			return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('SMS Send Sucessfully'), 'data' => $contact]);
		}
	}

	public function custom_fields(Request $request) {
		if ($request->isMethod('get')) {
			$customFields = json_decode(get_option('users_custom_fields', '[]'));
			return view('backend.user.custom_fields', compact('customFields'));
		} else {
			$validator = Validator::make($request->all(), [
				'field_name.*' => 'required',
				'field_type.*' => 'required',
				'max_size.*' => 'required|numeric',
			], [
				'field_name.*.required' => _lang('Field name is required'),
				'field_type.*.required' => _lang('File type is required'),
				'max_size.*.required' => _lang('Max size is required'),
			]);

			if ($validator->fails()) {
				return back()->withErrors($validator)->withInput();
			}

			$form_fields = [];
			if ($request->has('field_name')) {
				for ($i = 0; $i < count($request->field_name); $i++) {
					$form_field = [];
					$form_field['field_label'] = $request->field_name[$i];
					$form_field['field_name'] = strtolower(str_replace(' ', '_', xss_clean($request->field_name[$i])));
					$form_field['field_type'] = $request->field_type[$i];
					$form_field['validation'] = $request->validation[$i];
					$form_field['max_size'] = $request->max_size[$i];
					$form_fields[$form_field['field_name']] = $form_field;
				}
			}

			$form_fields = json_encode($form_fields);

			update_option('users_custom_fields', $form_fields);

			return back()->with('success', _lang('Saved successfully'));
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$user = User::find($id);
		$user->delete();
		return redirect()->route('users.index')->with('success', _lang('Deleted successfully'));
	}
}