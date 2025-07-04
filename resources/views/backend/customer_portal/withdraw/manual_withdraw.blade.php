@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-lg-8 offset-lg-2">
		<div class="card">
			<div class="card-header">
				<h4 class="header-title text-center">{{ _lang('Withdraw Money') }}</h4>
			</div>
			<div class="card-body">
				<form method="post" class="validate" autocomplete="off" action="{{ route('withdraw.manual_withdraw', $withdraw_method->id) }}" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="row p-2">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Amount') }}</label>
								<input type="text" class="form-control float-field" name="amount" value="{{ old('amount') }}" required>
							</div>
						</div>

						@if($withdraw_method->requirements)
						@foreach($withdraw_method->requirements as $requirement)
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ $requirement }}</label>
								<input type="text" class="form-control" name="requirements[{{ str_replace(' ','_',$requirement) }}]" value="{{ old('requirements.'.str_replace(' ', '_', $requirement)) }}" required>
							</div>
						</div>
						@endforeach
						@endif

						@if($withdraw_method->descriptions != '')
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Instructions') }}</label>
								<div class="border rounded">{!! xss_clean($withdraw_method->descriptions) !!}</div>
							</div>
						</div>
						@endif

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Description') }}</label>
								<textarea class="form-control" name="description">{{ old('description') }}</textarea>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Attachment') }}</label>
								<input type="file" class="form-control dropify" name="attachment">
							</div>
						</div>

						 <div class="col-md-12 mb-2">
				            <h6 class="text-danger text-center"><b>{{ decimalPlace($withdraw_method->fixed_charge, currency($withdraw_method->currency->name)) }} + {{ $withdraw_method->charge_in_percentage }}% {{ _lang('transaction charge will be applied') }}</b></h6>
				        </div>

						<div class="col-md-12">
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-lg btn-block"><i class="icofont-check-circled"></i> {{ _lang('Submit') }}</button>
							</div>
						</div>
					</div>
				</form>

			</div>
		</div>
    </div>
</div>
@endsection


