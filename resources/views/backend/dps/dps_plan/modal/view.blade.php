<table class="table table-bordered">
	<tr><td>{{ _lang('Name') }}</td><td>{{ $dpsplan->name }}</td></tr>
	<tr><td>{{ _lang('Currency') }}</td><td>{{ $dpsplan->currency->name }}</td></tr>
	<tr><td>{{ _lang('Installment') }}</td><td>{{ decimalPlace($dpsplan->per_installment, currency($dpsplan->currency->name)) }} / {{ _lang('Every').' '.$dpsplan->installment_interval }} {{ ucwords($dpsplan->interval_type) }}</td></tr>
	<tr><td>{{ _lang('Total Installment') }}</td><td>{{ $dpsplan->total_installment.' '._lang('Times') }}</td></tr>
	<tr><td>{{ _lang('Interest Rate') }}</td><td>{{ $dpsplan->interest_rate }}%</td></tr>
	<tr><td>{{ _lang('Final Amount') }}</td><td>{{ decimalPlace($dpsplan->final_amount, currency($dpsplan->currency->name)) }}</td></tr>
	<tr><td>{{ _lang('Status') }}</td><td>{!! xss_clean(status($dpsplan->status)) !!}</td></tr>
</table>

