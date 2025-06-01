@extends('layouts.app')

@section('content')
<div class="row">
	
	@if(Auth::user()->user_type == 'customer' && Auth::user()->document_submitted_at != null)	
		<div class="col-lg-12">
			<div class="alert alert-danger">
				<span>{{ _lang('You have already submit your documents ! You will be notified soon after reviewing your documents.') }}</span>
			</div>
		</div>
	@else

	<div class="{{ $alert_col }}">
		<div class="card">
			<div class="card-header text-center">
				{{ _lang('KYC Verification') }}
			</div>

			<div class="card-body">
				<form action="{{ route('profile.document_verification') }}" autocomplete="off" method="post" enctype="multipart/form-data">
					@csrf
					<div class="row">
						@foreach(json_decode(get_option('kyc_form_fields', '[]')) as $form_field)
						<div class="col-12">
							<div class="form-group">
								<label class="control-label">{{ $form_field->field_label }}</label>
								{!! xss_clean(generate_input_field($form_field)) !!}
							</div>
						</div>
						@endforeach

						<div class="col-12">
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block"><i class="icofont-check-circled"></i> {{ _lang('Submit') }}</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	@endif
</div>
@endsection

