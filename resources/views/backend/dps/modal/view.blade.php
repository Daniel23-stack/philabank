<table class="table table-bordered">
	<tr><td>{{ _lang('DPS Plan') }}</td><td>{{ $dps->plan->name }}</td></tr>
	<tr><td>{{ _lang('Currency') }}</td><td>{{ $dps->currency->name }}</td></tr>
	<tr><td>{{ _lang('User Account') }}</td><td>{{ $dps->user->name}}</td></tr>
	<tr><td>{{ _lang('Installment') }}</td><td>{{ decimalPlace($dps->per_installment, currency($dps->currency->name)) }} / {{ _lang('Every').' '.$dps->installment_interval }} {{ ucwords($dps->interval_type) }}</td></tr>
	<tr><td>{{ _lang('Total Installment') }}</td><td>{{ $dps->total_installment }}</td></tr>
	<tr><td>{{ _lang('Installment Completed') }}</td><td>{{ $dps->installment_completed }}</td></tr>
	<tr><td>{{ _lang('Interest Rate') }}</td><td>{{ $dps->interest_rate }}%</td></tr>
	<tr><td>{{ _lang('Final Amount') }}</td><td>{{ decimalPlace($dps->final_amount, currency($dps->currency->name)) }}</td></tr>
	<tr><td>{{ _lang('Status') }}</td><td>{!! xss_clean(dps_status($dps->status)) !!}</td></tr>
	<tr><td>{{ _lang('Next Installment Date') }}</td><td>{{ $dps->next_installment_date }}</td></tr>
</table>

