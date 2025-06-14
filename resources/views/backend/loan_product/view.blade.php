@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="card">
		    <div class="card-header">
				<span class="panel-title">{{ _lang('View Loan Product') }}</span>
			</div>

			<div class="card-body">
			    <table class="table table-bordered">
				    <tr><td>{{ _lang('Name') }}</td><td>{{ $loanproduct->name }}</td></tr>
					<tr><td>{{ _lang('Loan ID Prefix') }}</td><td>{{ $loanproduct->loan_id_prefix }}</td></tr>
					<tr><td>{{ _lang('Next Loan ID') }}</td><td>{{ $loanproduct->starting_loan_id }}</td></tr>
					<tr><td>{{ _lang('Description') }}</td><td>{{ $loanproduct->description }}</td></tr>
					<tr><td>{{ _lang('Interest Rate') }}</td><td>{{ $loanproduct->interest_rate }}</td></tr>
					<tr><td>{{ _lang('Interest Type') }}</td><td>{{ $loanproduct->interest_type }}</td></tr>
					<tr><td>{{ _lang('Minimum Amount') }}</td><td>{{ $loanproduct->minimum_amount }}</td></tr>
					<tr><td>{{ _lang('Maximum Amount') }}</td><td>{{ $loanproduct->maximum_amount }}</td></tr>
					<tr><td>{{ _lang('Term') }}</td><td>{{ $loanproduct->term }}</td></tr>
					<tr><td>{{ _lang('Term Period') }}</td><td>{{ $loanproduct->term_period }}</td></tr>
			    </table>
			</div>
	    </div>
	</div>
</div>
@endsection


