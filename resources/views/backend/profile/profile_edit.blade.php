@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-lg-8 offset-lg-2">
		<div class="card">
			<div class="card-header text-center">
				{{ _lang('Profile Settings') }}
			</div>
			<div class="card-body">

				<form action="{{ route('profile.update') }}" autocomplete="off" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data" method="post">
					@csrf
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Name') }}</label>
								<input type="text" class="form-control" name="name" value="{{$profile->name}}" required>
							</div>
						</div>

						<div class="col-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Email') }}</label>
								<input type="text" class="form-control" name="email" value="{{ $profile->email }}" required>
								@if(get_option('email_verification') == 'enabled')
								<i><small><i class="icofont-info-circle"></i> {{ _lang('If you change email address then you need to verify email address again') }} !</small></i>
								@endif
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Country Code') }}</label>
								<select class="form-control select2 auto-select" data-selected="{{ $profile->country_code }}" name="country_code" required>
									<option value="">{{ _lang('Select One') }}</option>
									@foreach(get_country_codes() as $key => $value)
									<option value="{{ $value['dial_code'] }}">{{ $value['country'].' (+'.$value['dial_code'].')' }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Phone') }}</label>
								<input type="text" class="form-control" name="phone" value="{{ $profile->phone }}" required>
							</div>
						</div>

						@php $customFieldsData = json_decode($profile->custom_fields, true); @endphp
						@foreach($customFields as $form_field)
							<div class="col-lg-12">
								<div class="form-group">
									<label class="control-label">{{ $form_field->field_label }}</label>
									{!! xss_clean(generate_input_field($form_field, $customFieldsData[$form_field->field_name]['field_value'] ?? null)) !!}
								</div>
							</div>
						@endforeach

						@if(get_option('mobile_verification') == 'enabled')
						<div class="col-12 mt-n3 mb-3">
						<i><small><i class="icofont-info-circle"></i> {{ _lang('If you change mobile number then you need to verify mobile number again') }} !</small></i>
						</div>
						@endif

						<div class="col-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Image') }} (300 X 300)</label>
								<input type="file" class="form-control dropify" data-default-file="{{ $profile->profile_picture != "" ? asset('public/uploads/profile/'.$profile->profile_picture) : '' }}" name="profile_picture" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG">
							</div>
						</div>

						<div class="col-12">
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block"><i class="icofont-check-circled"></i> {{ _lang('Update Profile') }}</button>
							</div>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>
@endsection

