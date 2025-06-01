<form method="post" class="ajax-submit" autocomplete="off" action="{{ route('dps.store') }}" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="row px-2">
	    <div class="col-md-12">
			<div class="form-group">
				<label class="control-label">{{ _lang('DPS Plan') }}</label>						
				<select class="form-control auto-select" data-selected="{{ old('dps_plan_id') }}" name="dps_plan_id"  required>
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
				<select class="form-control auto-select select2" data-selected="{{ old('user_id') }}" name="user_id"  required>
					<option value="">{{ _lang('Select One') }}</option>
					@foreach(get_table('users', array('user_type=' => 'customer')) as $user )
					<option value="{{ $user->id }}">{{ $user->email .' ('. $user->name . ')' }}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">{{ _lang('Money Deduct from') }}</label>						
				<select class="form-control auto-select" data-selected="{{ old('debit_account', 'user_account') }}" name="debit_account" required>
					<option value="user_account">{{ _lang('User Account') }}</option>
					<option value="cash">{{ _lang('Cash') }}</option>
				</select>
			</div>
		</div>

		<div class="col-md-12">
		    <div class="form-group">
			    <button type="submit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{ _lang('Submit') }}</button>
		    </div>
		</div>
	</div>
</form>
