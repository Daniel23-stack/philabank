@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-3">
		<ul class="nav flex-column nav-tabs settings-tab" role="tablist">
			 <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#general"><i class="icofont-settings"></i> {{ _lang('General Settings') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#system"><i class="icofont-ui-settings"></i> {{ _lang('System Settings') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#system_modules"><i class="icofont-contrast"></i> {{ _lang('System Modules') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#kyc_form_builder"><i class="icofont-list"></i> {{ _lang('KYC From Builder') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#request_otp"><i class="icofont-smart-phone"></i> {{ _lang('Request & OTP') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#email"><i class="icofont-email"></i> {{ _lang('Email Configurations') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#sms_gateway"><i class="icofont-ui-messaging"></i> {{ _lang('SMS Gateway') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#social_login"><i class="icofont-google-plus"></i> {{ _lang('Social Login') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#google_recaptcha"><i class="icofont-verification-check"></i> {{ _lang('Google Recaptcha v3') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#cron_jobs"><i class="icofont-clock-time"></i> {{ _lang('Cron Jobs') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#logo"><i class="icofont-image"></i> {{ _lang('Logo and Favicon') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#cache"><i class="icofont-server"></i> {{ _lang('Cache Control') }}</a></li>
		</ul>
	</div>

	@php $settings = \App\Models\Setting::all(); @endphp

	<div class="col-md-9">
		<div class="tab-content">
			<div id="general" class="tab-pane active">
				<div class="card">

					<div class="card-header">
						<h4 class="header-title">{{ _lang('General Settings') }}</h4>
					</div>

					<div class="card-body">
						 <form method="post" class="settings-submit params-panel" autocomplete="off" action="{{ route('settings.update_settings','store') }}" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-6">
								  <div class="form-group">
									<label class="control-label">{{ _lang('Company Name') }}</label>
									<input type="text" class="form-control" name="company_name" value="{{ get_setting($settings, 'company_name') }}" required>
								  </div>
								</div>

								<div class="col-md-6">
								  <div class="form-group">
									<label class="control-label">{{ _lang('Site Title') }}</label>
									<input type="text" class="form-control" name="site_title" value="{{ get_setting($settings, 'site_title') }}" required>
								  </div>
								</div>

								<div class="col-md-6">
								  <div class="form-group">
									<label class="control-label">{{ _lang('Phone') }}</label>
									<input type="text" class="form-control" name="phone" value="{{ get_setting($settings, 'phone') }}">
								  </div>
								</div>

								<div class="col-md-6">
								  <div class="form-group">
									<label class="control-label">{{ _lang('Email') }}</label>
									<input type="email" class="form-control" name="email" value="{{ get_setting($settings, 'email') }}">
								  </div>
								</div>

								<div class="col-md-6">
								  <div class="form-group">
									<label class="control-label">{{ _lang('Timezone') }}</label>
									<select class="form-control select2" name="timezone" required>
									<option value="">{{ _lang('-- Select One --') }}</option>
									{{ create_timezone_option(get_setting($settings, 'timezone')) }}
									</select>
								  </div>
								</div>

								<div class="col-md-6">
								  <div class="form-group">
									<label class="control-label">{{ _lang('Language') }}</label>
									<select class="form-control select2" name="language">
										<option value="">{{ _lang('-- Select One --') }}</option>
										{{ load_language( get_setting($settings, 'language') ) }}
									</select>
								  </div>
								</div>

								<div class="col-md-12">
								  <div class="form-group">
									<label class="control-label">{{ _lang('Address') }}</label>
									<textarea class="form-control" name="address">{{ get_setting($settings, 'address') }}</textarea>
								  </div>
								</div>


								<div class="col-md-12">
								  <div class="form-group">
									<button type="submit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{ _lang('Save Settings') }}</button>
								  </div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div id="system" class="tab-pane">
				<div class="card">
					<div class="card-header">
						<h4 class="header-title">{{ _lang('System Settings') }}</h4>
					</div>
					<div class="card-body">
						<form method="post" class="settings-submit params-panel" autocomplete="off" action="{{ route('settings.update_settings','store') }}" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="row">

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Website') }}</label>
										<select class="form-control" name="website_enable" required>
											<option value="yes" {{ get_setting($settings, 'website_enable') == 'yes' ? 'selected' : '' }}>{{ _lang('Enable') }}</option>
											<option value="no" {{ get_setting($settings, 'website_enable') == 'no' ? 'selected' : '' }}>{{ _lang('Disable') }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Backend Direction') }}</label>
										<select class="form-control" name="backend_direction" required>
											<option value="ltr" {{ get_setting($settings, 'backend_direction') == 'ltr' ? 'selected' : '' }}>{{ _lang('LTR') }}</option>
											<option value="rtl" {{ get_setting($settings, 'backend_direction') == 'rtl' ? 'selected' : '' }}>{{ _lang('RTL') }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Currency Position') }}</label>
										<select class="form-control" name="currency_position" required>
											<option value="left" {{ get_setting($settings, 'currency_position') == 'left' ? 'selected' : '' }}>{{ _lang('Left') }}</option>
											<option value="right" {{ get_setting($settings, 'currency_position') == 'right' ? 'selected' : '' }}>{{ _lang('Right') }}</option>
										</select>
									</div>
								</div>


								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Date Format') }}</label>
										<select class="form-control auto-select" name="date_format" data-selected="{{ get_setting($settings, 'date_format','Y-m-d') }}" required>
											<option value="Y-m-d">{{ date('Y-m-d') }}</option>
											<option value="d-m-Y">{{ date('d-m-Y') }}</option>
											<option value="d/m/Y">{{ date('d/m/Y') }}</option>
											<option value="m-d-Y">{{ date('m-d-Y') }}</option>
											<option value="m.d.Y">{{ date('m.d.Y') }}</option>
											<option value="m/d/Y">{{ date('m/d/Y') }}</option>
											<option value="d.m.Y">{{ date('d.m.Y') }}</option>
											<option value="d/M/Y">{{ date('d/M/Y') }}</option>
											<option value="d/M/Y">{{ date('M/d/Y') }}</option>
											<option value="d M, Y">{{ date('d M, Y') }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Time Format') }}</label>
										<select class="form-control auto-select" name="time_format" data-selected="{{ get_setting($settings, 'time_format',24) }}" required>
											<option value="24">{{ _lang('24 Hours') }}</option>
											<option value="12">{{ _lang('12 Hours') }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Allow Sign Up') }}</label>
										<select class="form-control" name="allow_singup" required>
											<option value="yes" {{ get_setting($settings, 'allow_singup') == 'yes' ? 'selected' : '' }}>{{ _lang('Enable') }}</option>
											<option value="no" {{ get_setting($settings, 'allow_singup') == 'no' ? 'selected' : '' }}>{{ _lang('Disable') }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Email Verification') }}</label>
										<select class="form-control" name="email_verification" required>
											<option value="disabled" {{ get_setting($settings, 'email_verification') == 'disabled' ? 'selected' : '' }}>{{ _lang('Disable') }}</option>
											<option value="enabled" {{ get_setting($settings, 'email_verification') == 'enabled' ? 'selected' : '' }}>{{ _lang('Enable') }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Mobile Verification') }}</label>
										<select class="form-control" name="mobile_verification" required>
											<option value="disabled" {{ get_setting($settings, 'mobile_verification') == 'disabled' ? 'selected' : '' }}>{{ _lang('Disable') }}</option>
											<option value="enabled" {{ get_setting($settings, 'mobile_verification') == 'enabled' ? 'selected' : '' }}>{{ _lang('Enable') }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Enable 2FA') }}</label>
										<select class="form-control" name="enable_2fa" required>
											<option value="no" {{ get_setting($settings, 'enable_2fa') == 'no' ? 'selected' : '' }}>{{ _lang('No') }}</option>
											<option value="yes" {{ get_setting($settings, 'enable_2fa') == 'yes' ? 'selected' : '' }}>{{ _lang('Yes') }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Enable KYC') }}</label>
										<select class="form-control" name="enable_kyc" required>
											<option value="no" {{ get_setting($settings, 'enable_kyc') == 'no' ? 'selected' : '' }}>{{ _lang('No') }}</option>
											<option value="yes" {{ get_setting($settings, 'enable_kyc') == 'yes' ? 'selected' : '' }}>{{ _lang('Yes') }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Wire Transfer Bank Selection') }}</label>
										<select class="form-control" name="bank_selection_method" required>
											<option value="selectbox" {{ get_setting($settings, 'bank_selection_method', 'selectbox') == 'selectbox' ? 'selected' : '' }}>{{ _lang('Select Box') }}</option>
											<option value="manual" {{ get_setting($settings, 'bank_selection_method', 'selectbox') == 'manual' ? 'selected' : '' }}>{{ _lang('Manual Input') }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Next Account Number') }}</label>
										<input type="number" class="form-control" name="next_account_number" value="{{ next_account_number() }}">
									</div>
								</div>

								<div class="col-md-12">
								  <div class="form-group">
									<button type="submit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{ _lang('Save Settings') }}</button>
								  </div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div id="system_modules" class="tab-pane">
				<div class="card">
					<div class="card-header">
						<h4 class="header-title">{{ _lang('System Modules') }}</h4>
					</div>
					<div class="card-body">
						<div class="alert alert-warning">
							<span><i class="icofont-warning"></i> {{ _lang('Module will disabled or enabled only on customer portal') }}</span>
						</div>
						<form method="post" class="settings-submit params-panel" autocomplete="off" action="{{ route('settings.update_settings','store') }}" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Send Money') }}</label>
										<select name="send_money_module" class="form-control auto-select" data-selected="{{ get_setting($settings, 'send_money_module', 1) }}" required>
											<option value="1">{{ _lang('Enabled') }}</option>
											<option value="0">{{ _lang('Disabled') }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Exchange Money') }}</label>
										<select name="exchnage_money_module" class="form-control auto-select" data-selected="{{ get_setting($settings, 'exchnage_money_module', 1) }}" required>
											<option value="1">{{ _lang('Enabled') }}</option>
											<option value="0">{{ _lang('Disabled') }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Wire Transfer') }}</label>
										<select name="wire_transfer_module" class="form-control auto-select" data-selected="{{ get_setting($settings, 'wire_transfer_module', 1) }}" required>
											<option value="1">{{ _lang('Enabled') }}</option>
											<option value="0">{{ _lang('Disabled') }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Payment Request') }}</label>
										<select name="payment_request_module" class="form-control auto-select" data-selected="{{ get_setting($settings, 'payment_request_module', 1) }}" required>
											<option value="1">{{ _lang('Enabled') }}</option>
											<option value="0">{{ _lang('Disabled') }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Manual Deposit Money') }}</label>
										<select name="manual_deposit_module" class="form-control auto-select" data-selected="{{ get_setting($settings, 'manual_deposit_module', 1) }}" required>
											<option value="1">{{ _lang('Enabled') }}</option>
											<option value="0">{{ _lang('Disabled') }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Automatic Deposit Money') }}</label>
										<select name="automatic_deposit_module" class="form-control auto-select" data-selected="{{ get_setting($settings, 'automatic_deposit_module', 1) }}" required>
											<option value="1">{{ _lang('Enabled') }}</option>
											<option value="0">{{ _lang('Disabled') }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Gift Card Module') }}</label>
										<select name="gift_card_module" class="form-control auto-select" data-selected="{{ get_setting($settings, 'gift_card_module', 1) }}" required>
											<option value="1">{{ _lang('Enabled') }}</option>
											<option value="0">{{ _lang('Disabled') }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Withdraw Money') }}</label>
										<select name="withdraw_money_module" class="form-control auto-select" data-selected="{{ get_setting($settings, 'withdraw_money_module', 1) }}" required>
											<option value="1">{{ _lang('Enabled') }}</option>
											<option value="0">{{ _lang('Disabled') }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Loan Management') }}</label>
										<select name="loan_module" class="form-control auto-select" data-selected="{{ get_setting($settings, 'loan_module', 1) }}" required>
											<option value="1">{{ _lang('Enabled') }}</option>
											<option value="0">{{ _lang('Disabled') }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Fixed Deposit') }}</label>
										<select name="fixed_deposit_module" class="form-control auto-select" data-selected="{{ get_setting($settings, 'fixed_deposit_module', 1) }}" required>
											<option value="1">{{ _lang('Enabled') }}</option>
											<option value="0">{{ _lang('Disabled') }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label">{{ _lang('DPS Module') }}</label>
										<select name="dps_module" class="form-control auto-select" data-selected="{{ get_setting($settings, 'dps_module', 1) }}" required>
											<option value="1">{{ _lang('Enabled') }}</option>
											<option value="0">{{ _lang('Disabled') }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<button type="submit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{ _lang('Save Settings') }}</button>
									</div>
								</div>
							</div>
						</form>	
					</div>
				</div>
			</div>

			<div id="kyc_form_builder" class="tab-pane fade">
				<div class="card">
					<div class="card-header d-flex align-items-center justify-content-between">
						<h4 class="header-title">{{ _lang('KYC Form Builder') }}</h4>
						<button class="btn btn-outline-primary btn-sm" id="add-new-field"><i class="icofont-plus-circle"></i> {{ _lang('Add New Field') }}</button>
					</div>

					<div class="card-body">
						<form method="post" class="settings-submit params-panel" autocomplete="off" action="{{ route('settings.update_kyc_form') }}" enctype="multipart/form-data">
							{{ csrf_field()}}
							<div class="row">
								<div class="col-md-12 mt-4">
									<table class="table table-bordered" id="form-fields">
										<thead>
											<th></th>
											<th>{{ _lang('Field Name') }}</th>
											<th>{{ _lang('Field Type') }}</th>
											<th>{{ _lang('Validation') }}</th>
											<th>{{ _lang('File Max Size (MB)') }}</th>
											<th class="text-center">{{ _lang('Action') }}</th>
										</thead>
										<tbody>
											@foreach(json_decode(get_setting($settings, 'kyc_form_fields', '[]')) as $form_field)
											<tr class="row-data">
												<td class="drag-element"><i class="icofont-drag"></i></td>
												<td><input type="text" name="field_name[]" class="form-control" placeholder="Field Name" value="{{ $form_field->field_label }}" required></td>
												<td>
													<select name="field_type[]" class="form-control auto-select" data-selected="{{ $form_field->field_type }}" required>
														<option value="file">File (PNG,JPG,PDF)</option>
														<option value="text">Textbox</option>
														<option value="number">Number</option>
														<option value="textarea">Textarea</option>
													</select>
												</td>
												<td>
													<select name="validation[]" class="form-control auto-select" data-selected="{{ $form_field->validation }}" required>
														<option value="required">Required</option>
														<option value="nullable">No Required</option>
													</select>
												</td>
												<td><input type="number" name="max_size[]" class="form-control" placeholder="2" value="{{ $form_field->max_size }}" required></td>
												<td class="text-center"><button type="button" class="btn btn-danger btn-sm btn-remove-row"><i class="icofont-trash"></i></button></td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							
								<div class="col-md-12">
									<div class="form-group">
										<button type="submit" class="btn btn-primary"><i class="bi bi-check-circle-fill"></i> {{ _lang('Save Changes') }}</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div id="request_otp" class="tab-pane fade">
				<div class="card">
					<div class="card-header">
						<h4 class="header-title">{{ _lang('Requests & OTP') }}</h4>
					</div>

					<div class="card-body">
						<form method="post" class="settings-submit params-panel" autocomplete="off" action="{{ route('settings.update_settings','store') }}" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Send Money') }}</label>
										<select class="form-control" name="send_money_action" id="send_money_action" required>
											<option value="0" {{ get_setting($settings, 'send_money_action')== 0 ? "selected" : "" }}>{{ _lang('Approval Not Required') }}</option>
											<option value="1" {{ get_setting($settings, 'send_money_action')== 1 ? "selected" : "" }}>{{ _lang('Approval Required') }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Send Money OTP') }}</label>
										<select class="form-control" name="send_money_otp" id="send_money_otp" required>
											<option value="0" {{ get_setting($settings, 'send_money_otp')== 0 ? "selected" : "" }}>{{ _lang('OTP Not Required') }}</option>
											<option value="1" {{ get_setting($settings, 'send_money_otp')== 1 ? "selected" : "" }}>{{ _lang('OTP Required') }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Exchange Money') }}</label>
										<select class="form-control" name="exchange_money_action" id="exchange_money_action" required>
											<option value="0" {{ get_setting($settings, 'exchange_money_action')== 0 ? "selected" : "" }}>{{ _lang('Approval Not Required') }}</option>
											<option value="1" {{ get_setting($settings, 'exchange_money_action')== 1 ? "selected" : "" }}>{{ _lang('Approval Required') }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Exchange Money OTP') }}</label>
										<select class="form-control" name="exchange_money_otp" id="exchange_money_otp" required>
											<option value="0" {{ get_setting($settings, 'exchange_money_otp')== 0 ? "selected" : "" }}>{{ _lang('OTP Not Required') }}</option>
											<option value="1" {{ get_setting($settings, 'exchange_money_otp')== 1 ? "selected" : "" }}>{{ _lang('OTP Required') }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Withdraw Money') }}</label>
										<input type="text" class="form-control"  value="{{ _lang('Approval Required') }}" readonly="">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Withdraw Money OTP') }}</label>
										<select class="form-control" name="withdraw_money_otp" id="withdraw_money_otp" required>
											<option value="0" {{ get_setting($settings, 'withdraw_money_otp')== 0 ? "selected" : "" }}>{{ _lang('OTP Not Required') }}</option>
											<option value="1" {{ get_setting($settings, 'withdraw_money_otp')== 1 ? "selected" : "" }}>{{ _lang('OTP Required') }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Wire Transfer') }}</label>
										<input type="text" class="form-control"  value="{{ _lang('Approval Required') }}" readonly="">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Wire Transfer OTP') }}</label>
										<select class="form-control" name="wire_transfer_otp" id="wire_transfer_otp" required>
											<option value="0" {{ get_setting($settings, 'wire_transfer_otp')== 0 ? "selected" : "" }}>{{ _lang('OTP Not Required') }}</option>
											<option value="1" {{ get_setting($settings, 'wire_transfer_otp')== 1 ? "selected" : "" }}>{{ _lang('OTP Required') }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<button type="submit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{ _lang('Save Settings') }}</button>
									</div>
								</div>

							</div>
						</form>
					</div>
				</div>
			</div>

			<div id="email" class="tab-pane fade">
				<div class="card">
					<div class="card-header">
						<h4 class="header-title">{{ _lang('Email Settings') }}</h4>
					</div>

					<div class="card-body">
						<form method="post" class="settings-submit params-panel" autocomplete="off" action="{{ route('settings.update_settings','store') }}" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Mail Type') }}</label>
										<select class="form-control niceselect wide" name="mail_type" id="mail_type" required>
											<option value="smtp" {{ get_setting($settings, 'mail_type')=="smtp" ? "selected" : "" }}>{{ _lang('SMTP') }}</option>
											<option value="sendmail" {{ get_setting($settings, 'mail_type')=="sendmail" ? "selected" : "" }}>{{ _lang('Sendmail') }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('From Email') }}</label>
										<input type="text" class="form-control" name="from_email" value="{{ get_setting($settings, 'from_email') }}" required>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('From Name') }}</label>
										<input type="text" class="form-control" name="from_name" value="{{ get_setting($settings, 'from_name') }}" required>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('SMTP Host') }}</label>
										<input type="text" class="form-control smtp" name="smtp_host" value="{{ get_setting($settings, 'smtp_host') }}">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('SMTP Port') }}</label>
										<input type="text" class="form-control smtp" name="smtp_port" value="{{ get_setting($settings, 'smtp_port') }}">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('SMTP Username') }}</label>
										<input type="text" class="form-control smtp" autocomplete="off" name="smtp_username" value="{{ get_setting($settings, 'smtp_username') }}">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('SMTP Password') }}</label>
										<input type="password" class="form-control smtp" autocomplete="off" name="smtp_password" value="{{ get_setting($settings, 'smtp_password') }}">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('SMTP Encryption') }}</label>
										<select class="form-control smtp" name="smtp_encryption">
											<option value="">{{ _lang('None') }}</option>
											<option value="ssl" {{ get_setting($settings, 'smtp_encryption')=="ssl" ? "selected" : "" }}>{{ _lang('SSL') }}</option>
											<option value="tls" {{ get_setting($settings, 'smtp_encryption')=="tls" ? "selected" : "" }}>{{ _lang('TLS') }}</option>
										</select>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<button type="submit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{ _lang('Save Settings') }}</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>

				<div class="card mt-4">
					<div class="card-header">
						<h4 class="header-title">{{ _lang('Send Test Email') }}</h4>
					</div>

					<div class="card-body">
						<form action="{{ route('settings.send_test_email') }}" class="settings-submit params-panel" method="post">
							<div class="row">
								@csrf
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label">{{ _lang('Email To') }}</label>
										<input type="email" class="form-control" name="email_address" required>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label">{{ _lang('Message') }}</label>
										<textarea class="form-control" name="message" required></textarea>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<button type="submit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{ _lang('Send Test Email') }}</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div id="sms_gateway" class="tab-pane fade">

				<div class="card">
					<div class="card-header">
						<h4 class="header-title">{{ _lang('SMS Gateways') }}</h4>
					</div>

					<div class="card-body">
						<div class="accordion" id="sms_gateway">
							<div class="card">
								<div class="card-header params-panel" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								  <span>{{ _lang('Twilio') }}</span>
								</div>

								<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#sms_gateway">
									<div class="card-body">
									   <form method="post" class="settings-submit params-panel" autocomplete="off" action="{{ route('settings.update_settings','store') }}" enctype="multipart/form-data">

											{{ csrf_field() }}
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">{{ _lang('SMS Gateway') }}</label>
														<select class="form-control auto-select" data-selected="{{ get_setting($settings, 'sms_gateway', 'none') }}" name="sms_gateway" required>
															<option value="none">{{ _lang('None') }}</option>
															<option value="twilio">{{ _lang('Twilio') }}</option>
															<option value="textmagic">{{ _lang('Textmagic') }}</option>
															<option value="nexmo">{{ _lang('Nexmo') }}</option>
															<option value="infobip">{{ _lang('Infobip') }}</option>
														</select>
													</div>
												</div>

												<div class="col-md-6">
												  	<div class="form-group">
														<label class="control-label">{{ _lang('Account SID') }}</label>
														<input type="text" class="form-control" name="twilio_account_sid" value="{{ get_setting($settings, 'twilio_account_sid') }}" required>
												  	</div>
												</div>

												<div class="col-md-6">
												  	<div class="form-group">
														<label class="control-label">{{ _lang('Auth Token') }}</label>
														<input type="text" class="form-control" name="twilio_auth_token" value="{{ get_setting($settings, 'twilio_auth_token') }}" required>
												  	</div>
												</div>

												<div class="col-md-6">
												  	<div class="form-group">
														<label class="control-label">{{ _lang('From Number') }}</label>
														<input type="text" class="form-control" name="twilio_mobile_number" value="{{ get_setting($settings, 'twilio_mobile_number') }}" required>
												  	</div>
												</div>

												<div class="col-md-12">
												  	<div class="form-group">
														<button type="submit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{ _lang('Save Settings') }}</button>
												  	</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>

							<div class="card mt-2">
								<div class="card-header params-panel" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
								  <span>{{ _lang('Textmagic') }}</span>
								</div>

								<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#sms_gateway">
									<div class="card-body">
									   <form method="post" class="settings-submit params-panel" autocomplete="off" action="{{ route('settings.update_settings','store') }}" enctype="multipart/form-data">

											{{ csrf_field() }}
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">{{ _lang('SMS Gateway') }}</label>
														<select class="form-control auto-select" data-selected="{{ get_setting($settings, 'sms_gateway', 'none') }}" name="sms_gateway" required>
															<option value="none">{{ _lang('None') }}</option>
															<option value="twilio">{{ _lang('Twilio') }}</option>
															<option value="textmagic">{{ _lang('Textmagic') }}</option>
															<option value="nexmo">{{ _lang('Nexmo') }}</option>
															<option value="infobip">{{ _lang('Infobip') }}</option>
														</select>
													</div>
												</div>

												<div class="col-md-6">
												  	<div class="form-group">
														<label class="control-label">{{ _lang('Username') }}</label>
														<input type="text" class="form-control" name="textmagic_username" value="{{ get_setting($settings, 'textmagic_username') }}" required>
												 	 </div>
												</div>

												<div class="col-md-6">
												  	<div class="form-group">
														<label class="control-label">{{ _lang('API V2 KEY') }}</label>
														<input type="text" class="form-control" name="textmagic_api_key" value="{{ get_setting($settings, 'textmagic_api_key') }}" required>
												  	</div>
												</div>

												<div class="col-md-12">
												  	<div class="form-group">
														<button type="submit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{ _lang('Save Settings') }}</button>
												  	</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div> <!--End Textmagic -->

							<div class="card mt-2">
								<div class="card-header params-panel" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseTwo">
								  <span>{{ _lang('Nexmo') }}</span>
								</div>

								<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#sms_gateway">
									<div class="card-body">
									   <form method="post" class="settings-submit params-panel" autocomplete="off" action="{{ route('settings.update_settings','store') }}" enctype="multipart/form-data">

											{{ csrf_field() }}
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">{{ _lang('SMS Gateway') }}</label>
														<select class="form-control auto-select" data-selected="{{ get_setting($settings, 'sms_gateway', 'none') }}" name="sms_gateway" required>
															<option value="none">{{ _lang('None') }}</option>
															<option value="twilio">{{ _lang('Twilio') }}</option>
															<option value="textmagic">{{ _lang('Textmagic') }}</option>
															<option value="nexmo">{{ _lang('Nexmo') }}</option>
															<option value="infobip">{{ _lang('Infobip') }}</option>
														</select>
													</div>
												</div>

												<div class="col-md-6">
												  	<div class="form-group">
														<label class="control-label">{{ _lang('API KEY') }}</label>
														<input type="text" class="form-control" name="nexmo_api_key" value="{{ get_setting($settings, 'nexmo_api_key') }}" required>
												  	</div>
												</div>

												<div class="col-md-6">
												  	<div class="form-group">
														<label class="control-label">{{ _lang('API Secret') }}</label>
														<input type="text" class="form-control" name="nexmo_api_secret" value="{{ get_setting($settings, 'nexmo_api_secret') }}" required>
												  	</div>
												</div>


												<div class="col-md-12">
												  	<div class="form-group">
														<button type="submit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{ _lang('Save Settings') }}</button>
												  	</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div> <!--End Nexmo -->

							<div class="card mt-2">
								<div class="card-header params-panel" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseTwo">
								  <span>{{ _lang('Infobip') }}</span>
								</div>

								<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#sms_gateway">
									<div class="card-body">
									   <form method="post" class="settings-submit params-panel" autocomplete="off" action="{{ route('settings.update_settings','store') }}" enctype="multipart/form-data">

											{{ csrf_field() }}
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">{{ _lang('SMS Gateway') }}</label>
														<select class="form-control auto-select" data-selected="{{ get_setting($settings, 'sms_gateway', 'none') }}" name="sms_gateway" required>
															<option value="none">{{ _lang('None') }}</option>
															<option value="twilio">{{ _lang('Twilio') }}</option>
															<option value="textmagic">{{ _lang('Textmagic') }}</option>
															<option value="nexmo">{{ _lang('Nexmo') }}</option>
															<option value="infobip">{{ _lang('Infobip') }}</option>
														</select>
													</div>
												</div>

												<div class="col-md-6">
												  	<div class="form-group">
														<label class="control-label">{{ _lang('API KEY') }}</label>
														<input type="text" class="form-control" name="infobip_api_key" value="{{ get_setting($settings, 'infobip_api_key') }}" required>
												  	</div>
												</div>

												<div class="col-md-6">
												  	<div class="form-group">
														<label class="control-label">{{ _lang('API BASE URL') }}</label>
														<input type="text" class="form-control" name="infobip_api_base_url" value="{{ get_setting($settings, 'infobip_api_base_url') }}" required>
												  	</div>
												</div>

												<div class="col-md-12">
												  	<div class="form-group">
														<button type="submit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{ _lang('Save Settings') }}</button>
												  	</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div> <!--End Infobip -->

						</div>
					</div>
				</div>
			</div>

			<div id="social_login" class="tab-pane fade">
				<div class="card">
					<div class="card-header">
						<h4 class="header-title">{{ _lang('Social Login') }}</h4>
					</div>
					<div class="card-body">
						<form method="post" class="settings-submit params-panel" autocomplete="off" action="{{ route('settings.update_settings','store') }}" enctype="multipart/form-data">
							{{ csrf_field() }}

							<h5 class="header-title">{{ _lang('Google Login') }}</h5>
							<div class="params-panel border border-dark p-3">
								<div class="row">

									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">{{ _lang('Google Login') }}</label>
											<select class="form-control select2 auto-select" data-selected="{{ get_setting($settings, 'google_login','disabled') }}" name="google_login" required>
												<option value="disabled">{{ _lang('Disable') }}</option>
												<option value="enabled">{{ _lang('Enable') }}</option>
											</select>
										</div>
									</div>


									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">{{ _lang('GOOGLE CLIENT ID') }}</label> <a href="https://console.developers.google.com/apis/credentials" target="_blank" class="btn-link float-right">{{ _lang('GET API KEY') }}</a>
											<input type="text" class="form-control" name="GOOGLE_CLIENT_ID" value="{{ get_setting($settings, 'GOOGLE_CLIENT_ID') }}">
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">{{ _lang('GOOGLE CLIENT SECRET') }}</label>
											<input type="text" class="form-control" name="GOOGLE_CLIENT_SECRET" value="{{ get_setting($settings, 'GOOGLE_CLIENT_SECRET') }}">
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">{{ _lang('GOOGLE REDIRECT URL') }}</label>
											<input type="text" class="form-control" value="{{ url('login/google/callback') }}" readOnly="true">
										</div>
									</div>

								</div>
							</div>

							<br>
							<h5 class="header-title">{{ _lang('Facebook Login') }}</h5>
							<div class="params-panel border border-dark p-3">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">{{ _lang('Facebook Login') }}</label>
											<select class="form-control select2 auto-select" data-selected="{{ get_setting($settings, 'facebook_login','disabled') }}" name="facebook_login" required>
												<option value="disabled">{{ _lang('Disable') }}</option>
												<option value="enabled">{{ _lang('Enable') }}</option>
											</select>
										</div>
									</div>


									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">{{ _lang('FACEBOOK APP ID') }}</label>					<a href="https://developers.facebook.com/apps" target="_blank" class="btn-link float-right">{{ _lang('GET API KEY') }}</a>
											<input type="text" class="form-control" name="FACEBOOK_CLIENT_ID" value="{{ get_setting($settings, 'FACEBOOK_CLIENT_ID') }}">
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">{{ _lang('FACEBOOK APP SECRET') }}</label>
											<input type="text" class="form-control" name="FACEBOOK_CLIENT_SECRET" value="{{ get_setting($settings, 'FACEBOOK_CLIENT_SECRET') }}">
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">{{ _lang('FACEBOOK REDIRECT URL') }}</label>
											<input type="text" class="form-control" value="{{ url('login/facebook/callback') }}" readOnly="true">
										</div>
									</div>
								</div>
							</div>

							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<button type="submit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{ _lang('Save Settings') }}</button>
									</div>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>

			<div id="google_recaptcha" class="tab-pane fade">
				<div class="card">
					<div class="card-header">
						<h4 class="header-title">{{ _lang('Google Recaptcha v3') }}</h4>
					</div>

					<div class="card-body">
					    <form method="post" class="settings-submit params-panel" autocomplete="off" action="{{ route('settings.update_settings','store') }}">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-6">
								  	<div class="form-group">
										<label class="control-label">{{ _lang('Enable Recaptcha v3') }}</label>
											<select class="form-control auto-select" data-selected="{{ get_setting($settings, 'enable_recaptcha', 0) }}" name="enable_recaptcha" required>
											<option value="0">{{ _lang('No') }}</option>
											<option value="1">{{ _lang('Yes') }}</option>
										</select>
								  	</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Site Key') }}</label>
										<input type="text" class="form-control" name="recaptcha_site_key" value="{{ get_setting($settings, 'recaptcha_site_key') }}">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Secret Key') }}</label>
										<input type="text" class="form-control" name="recaptcha_secret_key" value="{{ get_setting($settings, 'recaptcha_secret_key') }}">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<button type="submit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{ _lang('Save Settings') }}</button>
									</div>
								</div>
							</div>
					    </form>
				    </div>
				</div>
			</div>

			<div id="cron_jobs" class="tab-pane fade">
				<div class="card">
					<div class="card-header">
						<h4 class="header-title">{{ _lang('Cron Jobs') }}</h4>
					</div>

					<div class="card-body">
						<div class="alert alert-warning">
							<span><i class="ti-info-alt"></i>&nbsp;{{ _lang('Run Cronjobs at least every').' 5 '._lang('minutes') }}</span>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label">{{ _lang('Cronjobs Command for cPanel') }}</label>
									<input type="text" class="form-control" value="{{ 'cd ' . base_path() .  ' && /usr/local/bin/php artisan schedule:run >> /dev/null 2>&1' }}" readonly>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label">{{ _lang('Schedule Task Command for Plesk') }}</label>
									<input type="text" class="form-control" value="{{ 'cd ' . base_path() .  ' && /opt/plesk/php/'. substr(phpversion(), 0, 3) .'/bin/php artisan schedule:run >> /dev/null 2>&1' }}" readonly>
								</div>
							</div>
						</div>
				    </div>
				</div>
			</div>

			<div id="logo" class="tab-pane fade">
				<div class="card">
					<div class="card-header">
						<h4 class="header-title">{{ _lang('Logo and Favicon') }}</h4>
					</div>

					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<form method="post" class="settings-submit params-panel" autocomplete="off" action="{{ route('settings.uplaod_logo') }}" enctype="multipart/form-data">
									{{ csrf_field() }}
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">{{ _lang('Upload Logo') }}</label>
												<input type="file" class="form-control dropify" name="logo" data-max-file-size="8M" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" data-default-file="{{ get_logo() }}" required>
											</div>
										</div>

										<br>
										<div class="col-md-12">
											<div class="form-group">
												<button type="submit" class="btn btn-primary btn-block">{{ _lang('Upload') }}</button>
											</div>
										</div>
									</div>
								</form>
							</div>

							<div class="col-md-6">
								<form method="post" class="settings-submit params-panel" autocomplete="off" action="{{ route('settings.update_settings','store') }}" enctype="multipart/form-data">
									{{ csrf_field() }}
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">{{ _lang('Upload Favicon') }} (PNG)</label>
												<input type="file" class="form-control dropify" name="favicon" data-max-file-size="2M" data-allowed-file-extensions="png" data-default-file="{{ get_favicon() }}" required>
											</div>
										</div>

										<br>
										<div class="col-md-12">
											<div class="form-group">
												<button type="submit" class="btn btn-primary btn-block">{{ _lang('Upload') }}</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div><!--End Logo Tab-->


			<div id="cache" class="tab-pane fade">
				<div class="card">
					<div class="card-header">
						<h4 class="header-title">{{ _lang('Cache Control') }}</h4>
					</div>

					<div class="card-body">
						<form method="post" class="params-panel" autocomplete="off" action="{{ route('settings.remove_cache') }}">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-12">
									<div class="checkbox">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" name="cache[view_cache]" value="view_cache" id="view_cache">
											<label class="custom-control-label" for="view_cache">{{ _lang('View Cache') }}</label>
										</div>
									</div>
								</div>

								<div class="col-md-12">
									<div class="checkbox">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" name="cache[application_cache]" value="application_cache" id="application_cache">
											<label class="custom-control-label" for="application_cache">{{ _lang('Application Cache') }}</label>
										</div>
									</div>
								</div>

								<br>
								<br>
								<div class="col-md-12">
									<div class="form-group">
										<button type="submit" class="btn btn-primary">{{ _lang('Remove Cache') }}</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div><!--End Cache Tab-->

		</div>
	</div>
</div>
@endsection

@section('js-script')
<script src="{{ asset('public/backend/assets/js/sortable.min.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', (event) => {
	new Sortable(document.getElementById('form-fields').getElementsByTagName('tbody')[0], {
		animation: 150,
		ghostClass: 'blue-background-class',
		handle: '.drag-element',
	});
});

(function ($) {
"use strict";

$(document).on('click', '#add-new-field', function () {
    var rowData = `<tr class="row-data">
						<td class="drag-element"><i class="icofont-drag"></i></td>
						<td><input type="text" name="field_name[]" class="form-control" placeholder="Field Name" required></td>
						<td>
							<select name="field_type[]" class="form-control" required>
								<option value="file">File (PNG,JPG,PDF)</option>
								<option value="text">Textbox</option>
								<option value="number">Number</option>
								<option value="textarea">Textarea</option>
							</select>
						</td>
						<td>
							<select name="validation[]" class="form-control" required>
								<option value="required">Required</option>
								<option value="nullable">No Required</option>
							</select>
						</td>
						<td><input type="number" name="max_size[]" class="form-control" placeholder="2" value="2" required></td>
						<td class="text-center"><button type="button" class="btn btn-danger btn-sm btn-remove-row"><i class="icofont-trash"></i></button></td>
					</tr>`;

    $('#form-fields tbody').append(rowData);
});

$(document).on('click', '.btn-remove-row', function () {
	$(this).closest('.row-data').remove();
});

})(jQuery);
</script>
@endsection
