<form method="post" class="ajax-submit" autocomplete="off" action="{{ action('DPSController@update', $id) }}" enctype="multipart/form-data">
	{{ csrf_field()}}
	<input name="_method" type="hidden" value="PATCH">
	<div class="row px-2">
		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">{{ _lang('DPS Plan') }}</label>						
				<select class="form-control auto-select" data-selected="{{ $dps->dps_plan_id }}" name="dps_plan_id" disabled>
					<option value="">{{ _lang('Select One') }}</option>
					@foreach(\App\Models\DPSPlan::active()->get() as $dps_plan)
					<option value="{{ $dps_plan->id }}">{{ $dps_plan->name .' ('.decimalPlace($dps_plan->per_installment, currency($dps_plan->currency->name)) .' / '. $dps_plan->installment_interval .' '. $dps_plan->interval_type .')' }}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">{{ _lang('User Account') }}</label>						
				<select class="form-control auto-select" data-selected="{{ $dps->user_id }}" name="user_id" disabled>
					<option value="">{{ _lang('Select One') }}</option>
					@foreach(get_table('users', array('user_type=' => 'customer')) as $user )
					<option value="{{ $user->id }}">{{ $user->email .' ('. $user->name . ')' }}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Per installment Amount') }}</label>	
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text currency">{{ $dps->currency->name }}</span>
					</div>						
					<input type="text" class="form-control float-field" name="per_installment" value="{{ $dps->per_installment }}" required>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Installment Interval') }}</label>						
				<input type="number" class="form-control" name="installment_interval" value="{{ $dps->installment_interval }}" required>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Interval Type') }}</label>						
				<select class="form-control auto-select" data-selected="{{ $dps->interval_type }}" name="interval_type"  required>
					<option value="">{{ _lang('Select One') }}</option>
					<option value="days">{{ _lang('Days') }}</option>
					<option value="month">{{ _lang('Month') }}</option>
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Interest Rate') }} %</label>						
				<input type="text" class="form-control" name="interest_rate" value="{{ $dps->interest_rate }}" readonly>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Number of Total installment') }}</label>						
				<input type="number" class="form-control" name="total_installment" value="{{ $dps->total_installment }}" readonly>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Installment Completed') }}</label>						
				<input type="text" class="form-control" name="installment_completed" value="{{ $dps->installment_completed }}">
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">{{ _lang('Final Amount after maturity') }}</label>	
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text currency">{{ $dps->currency->name }}</span>
					</div>							
					<input type="text" class="form-control" name="final_amount" value="{{ $dps->final_amount }}" readonly>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Status') }}</label>						
				<select class="form-control auto-select" data-selected="{{ $dps->status }}" name="status" required>
					<option value="1">{{ _lang('Active') }}</option>
					<option value="2">{{ _lang('Matured') }}</option>
					<option value="3">{{ _lang('Closed') }}</option>
				</select>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Next Installment Date') }}</label>						
				<input type="text" class="form-control datepicker" name="next_installment_date" value="{{ $dps->getRawOriginal('next_installment_date') }}">
			</div>
		</div>

		<div class="form-group">
		    <div class="col-md-12">
			    <button type="submit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{ _lang('Update') }}</button>
		    </div>
		</div>
	</div>
</form>

