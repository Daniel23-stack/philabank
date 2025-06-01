@extends('layouts.app')

@section('content')
<div class="row">
	<div class="{{ $alert_col }}">
		<div class="card">
			<div class="card-header">
				<h4 class="header-title">{{ _lang('Review Interest Rate') }}</h4>
			</div>
			<div class="card-body">
				<form method="post" class="validate" autocomplete="off" action="{{ route('fixed_deposits.complete_before_maturity', $id) }}">
					@csrf
					<div class="row">
                        <div class="col-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('FDR Plan') }}</label>
								<input type="text" class="form-control float-field" name="plan" value="{{ $fixeddeposit->plan->name }}" readonly>
							</div>
						</div>

                        <div class="col-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Currency') }}</label>
								<input type="text" class="form-control float-field" name="deposit_amount" value="{{ $fixeddeposit->currency->name }}" readonly>
							</div>
						</div>

						<div class="col-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Deposit Amount') }}</label>
								<input type="text" class="form-control float-field" name="deposit_amount" value="{{ $fixeddeposit->deposit_amount }}" readonly>
							</div>
						</div>

						<div class="col-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Return Amount') }}</label>
								<input type="text" class="form-control float-field" name="return_amount" value="{{ old('return_amount', $fixeddeposit->return_amount) }}" required>
							</div>
						</div>

						<div class="col-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Mature Date') }}</label>
								<input type="text" class="form-control" name="mature_date" value="{{ $fixeddeposit->mature_date }}" readonly>
							</div>
						</div>

						<div class="col-md-12 mt-2">
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block"><i class="icofont-check-circled"></i> {{ _lang('Mark as Completed') }}</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
