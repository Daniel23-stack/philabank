<table class="table table-bordered" id="receipt">
	<tr>
		<td colspan="2" class="text-center">
			<img src="{{ get_logo() }}" class="thumb-image-sm"/>
			<p>{{ get_option('company_name') }}</br>
			{{ get_option('address') }}</br>
			{{ get_option('phone') }}</p>
		</td>
	</tr>
	@if($transaction->type == 'Transfer' && $transaction->dr_cr == 'dr')
		<tr><td>{{ _lang('Sender Name') }}</td><td>{{ $transaction->user->name }}</td></tr>
		<tr><td>{{ _lang('Sender Email') }}</td><td>{{ $transaction->user->email }}</td></tr>
		<tr><td>{{ _lang('Sender Account') }}</td><td>{{ $transaction->user->account_number }}</td></tr>
		<tr><td>{{ _lang('Send Amount') }}</td><td>{{ decimalPlace($transaction->amount - $transaction->fee, currency($transaction->currency->name)) }}</td></tr>
	    <tr><td>{{ _lang('Charge') }}</td><td>{{ decimalPlace($transaction->fee, currency($transaction->currency->name)) }}</td></tr>

		<tr><td>{{ _lang('Receiver Name') }}</td><td>{{ $transaction->child_transaction->user->name }}</td></tr>
		<tr><td>{{ _lang('Receiver Email') }}</td><td>{{ $transaction->child_transaction->user->email }}</td></tr>
		<tr><td>{{ _lang('Receiver Account') }}</td><td>{{ $transaction->child_transaction->user->account_number }}</td></tr>
		<tr><td>{{ _lang('Received Amount') }}</td><td>{{ decimalPlace($transaction->child_transaction->amount,currency($transaction->child_transaction->currency->name)) }}</td></tr>
	@endif

	@if($transaction->type == 'Transfer' && $transaction->dr_cr == 'cr')
		<tr><td>{{ _lang('Sender Name') }}</td><td>{{ $transaction->parent_transaction->user->name }}</td></tr>
		<tr><td>{{ _lang('Sender Email') }}</td><td>{{ $transaction->parent_transaction->user->email }}</td></tr>
		<tr><td>{{ _lang('Sender Account') }}</td><td>{{ $transaction->parent_transaction->user->account_number }}</td></tr>
		<tr><td>{{ _lang('Send Amount') }}</td><td>{{ decimalPlace($transaction->parent_transaction->amount - $transaction->parent_transaction->fee, currency($transaction->parent_transaction->currency->name)) }}</td></tr>
	    <tr><td>{{ _lang('Charge') }}</td><td>{{ decimalPlace($transaction->parent_transaction->fee, currency($transaction->parent_transaction->currency->name)) }}</td></tr>

		<tr><td>{{ _lang('Receiver Name') }}</td><td>{{ $transaction->user->name }}</td></tr>
		<tr><td>{{ _lang('Receiver Email') }}</td><td>{{ $transaction->user->email }}</td></tr>
		<tr><td>{{ _lang('Receiver Account') }}</td><td>{{ $transaction->user->account_number }}</td></tr>
		<tr><td>{{ _lang('Received Amount') }}</td><td>{{ decimalPlace($transaction->amount,currency($transaction->currency->name)) }}</td></tr>
	@endif

	@if($transaction->type == 'Exchange' && $transaction->dr_cr == 'dr')
		<tr><td>{{ _lang('User Name') }}</td><td>{{ $transaction->user->name }}</td></tr>
		<tr><td>{{ _lang('Account Number') }}</td><td>{{ $transaction->user->account_number }}</td></tr>
		<tr><td>{{ _lang('Send Amount') }}</td><td>{{ decimalPlace($transaction->amount - $transaction->fee, currency($transaction->currency->name)) }}</td></tr>
		<tr><td>{{ _lang('Charge') }}</td><td>{{ decimalPlace($transaction->fee, currency($transaction->currency->name)) }}</td></tr>
		<tr><td>{{ _lang('Received Amount') }}</td><td>{{ decimalPlace($transaction->child_transaction->amount,currency($transaction->child_transaction->currency->name)) }}</td></tr>
		<tr><td>{{ _lang('Exchange Rate') }}</td><td>1 {{ $transaction->currency->name }} = {{ ($transaction->child_transaction->amount/($transaction->amount - $transaction->fee)).' '.$transaction->child_transaction->currency->name }}</td></tr>
	@endif

	@if($transaction->type == 'Exchange' && $transaction->dr_cr == 'cr')
		<tr><td>{{ _lang('User Name') }}</td><td>{{ $transaction->user->name }}</td></tr>
		<tr><td>{{ _lang('Account Number') }}</td><td>{{ $transaction->user->account_number }}</td></tr>
		<tr><td>{{ _lang('Send Amount') }}</td><td>{{ decimalPlace($transaction->parent_transaction->amount - $transaction->parent_transaction->fee, currency($transaction->parent_transaction->currency->name)) }}</td></tr>
		<tr><td>{{ _lang('Charge') }}</td><td>{{ decimalPlace($transaction->parent_transaction->fee, currency($transaction->parent_transaction->currency->name)) }}</td></tr>
		<tr><td>{{ _lang('Received Amount') }}</td><td>{{ decimalPlace($transaction->amount,currency($transaction->currency->name)) }}</td></tr>
		<tr><td>{{ _lang('Exchange Rate') }}</td><td>1 {{ $transaction->parent_transaction->currency->name }} = {{ ($transaction->amount/($transaction->parent_transaction->amount - $transaction->parent_transaction->fee)).' '.$transaction->currency->name }}</td></tr>
	@endif

	@if($transaction->type != 'Transfer' || $transaction->type == 'Exchange')
	<tr><td>{{ _lang('User Name') }}</td><td>{{ $transaction->user->name }}</td></tr>
	<tr><td>{{ _lang('Account Number') }}</td><td>{{ $transaction->user->account_number }}</td></tr>
	<tr><td>{{ _lang('User Email') }}</td><td>{{ $transaction->user->email }}</td></tr>

	<tr><td>{{ _lang('Transfer Amount') }}</td><td>{{ decimalPlace($transaction->amount - $transaction->fee, currency($transaction->currency->name)) }}</td></tr>
	<tr><td>{{ _lang('Charge') }}</td><td>{{ decimalPlace($transaction->fee, currency($transaction->currency->name)) }}</td></tr>
	<tr><td>{{ _lang('Grand Total') }}</td><td>{{ decimalPlace($transaction->amount, currency($transaction->currency->name)) }}</td></tr>
	@endif

	@if($transaction->type == 'Wire_Transfer')
		<tr><td>{{ _lang('Username') }}</td><td>{{ $transaction->user->name }}</td></tr>
		<tr><td>{{ _lang('User Email') }}</td><td>{{ $transaction->user->email }}</td></tr>
		<tr><td>{{ _lang('User Account') }}</td><td>{{ $transaction->user->account_number }}</td></tr>
		<tr><td>{{ _lang('Amount') }}</td><td>{{ decimalPlace($transaction->amount - $transaction->fee, currency($transaction->currency->name)) }}</td></tr>
	    <tr><td>{{ _lang('Charge') }}</td><td>{{ decimalPlace($transaction->fee, currency($transaction->currency->name)) }}</td></tr>
		@if($transaction->other_bank_id != null)
		<tr><td>{{ _lang('Bank Name') }}</td><td>{{ $transaction->other_bank->name }}</td></tr>
		@endif
	@endif

	@if($transaction->transaction_details != null)
		@foreach($transaction->transaction_details as $key => $value)
		<tr>
			<td>{{ ucwords(str_replace('_',' ',$key)) }}</td>
			<td>{{ $key != 'currency' ? $value : get_currency($value)->name }}</td>
		</tr>
		@endforeach
	@endif

    <tr><td>{{ _lang('DR/CR') }}</td><td>{{ strtoupper($transaction->dr_cr) }}</td></tr>
	<tr><td>{{ _lang('Type') }}</td><td>{{ str_replace("_"," ",$transaction->type) }}</td></tr>
	<tr><td>{{ _lang('Status') }}</td><td>{!! xss_clean(transaction_status($transaction->status)) !!}</td></tr>
	<tr><td>{{ _lang('Note') }}</td><td>{{ $transaction->note }}</td></tr>
	<tr><td>{{ _lang('Created At') }}</td><td>{{ $transaction->created_at }}</td></tr>
	<tr><td>{{ _lang('Created By') }}</td><td>{{ $transaction->created_by->name}}</td></tr>
</table>
<button class="btn btn-primary btn-block print d-print-none" data-print="receipt"><i class="icofont-print"></i> {{ _lang('Print') }}</button>

