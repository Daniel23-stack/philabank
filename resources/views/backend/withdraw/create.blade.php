@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4 class="header-title">{{ _lang('Withdraw Money') }}</h4>
			</div>
			<div class="card-body">
			    <form method="post" class="validate" autocomplete="off" action="{{ route('withdraw.store') }}" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Account Number / Email') }}</label>
								<input type="text" class="form-control" name="account_number" value="{{ old('account_number') }}" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Date') }}</label>
								<input type="text" class="form-control datetimepicker" name="date" value="{{ old('date', date('Y-m-d H:i:s')) }}" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Currency') }}</label>
								<select class="form-control auto-select select2" data-selected="{{ old('currency_id') }}" name="currency_id" required>
									<option value="">{{ _lang('Select One') }}</option>
									{{ create_option('currency','id','name','',array('status=' => 1)) }}
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Amount') }}</label>
								<input type="text" class="form-control float-field" name="amount" value="{{ old('amount') }}" required>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Note') }}</label>
								<textarea class="form-control" name="note">{{ old('note') }}</textarea>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-lg"><i class="icofont-check-circled"></i> {{ _lang('Submit') }}</button>
							</div>
						</div>
					</div>
			    </form>
			</div>
		</div>
    </div>
</div>
@endsection


