@extends('layouts.banking')

@section('page-title', 'Dashboard')

@section('content')
<style>
.badge-status {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: 600;
}

.status-due {
    background-color: #dc3545;
    color: white;
}

.status-upcoming {
    background-color: #28a745;
    color: white;
}

.balance-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 15px;
    padding: 1.5rem;
    margin-bottom: 1rem;
    transition: transform 0.3s ease;
}

.balance-card:hover {
    transform: translateY(-5px);
}

.balance-amount {
    font-size: 2rem;
    font-weight: bold;
    margin: 0;
}

.balance-currency {
    font-size: 0.9rem;
    opacity: 0.8;
}
</style>

	@if(Auth::user()->user_type == 'customer' && Auth::user()->document_verified_at == null && get_option('enable_kyc') == 'yes')
		<div class="row">
			<div class="col-lg-12">
				<div class="alert alert-danger">
					<strong><i class="mdi mdi-information-outline"></i> {{ _lang('Your account is not verified. Please submit all necessary documents') }}. <a href="{{ route('profile.document_verification') }}">{{ _lang('Submit Documents') }} </a></strong>
				</div>
			</div>
		</div>
	@endif

<h4>{{ _lang('Dashboard') }}</h4>

<!-- Account Balances -->
<div class="row mb-4">
    @if(isset($account_balance) && count($account_balance) > 0)
        @foreach($account_balance as $index => $currency)
        <div class="col-md-{{ count($account_balance) <= 3 ? '4' : '3' }}">
            <div class="balance-card" @if($index == 1) style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);" @elseif($index == 2) style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);" @elseif($index == 3) style="background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);" @endif>
                <div class="balance-currency">{{ $currency->name }} {{ _lang('Balance') }}</div>
                <div class="balance-amount">{{ currency($currency->name) }}{{ number_format($currency->balance, 2) }}</div>
            </div>
        </div>
        @endforeach
    @else
        <!-- Default demo balances if no real data -->
        <div class="col-md-4">
            <div class="balance-card">
                <div class="balance-currency">USD Balance</div>
                <div class="balance-amount">$0.00</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="balance-card" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                <div class="balance-currency">EUR Balance</div>
                <div class="balance-amount">€0.00</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="balance-card" style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);">
                <div class="balance-currency">ZAR Balance</div>
                <div class="balance-amount">R0.00</div>
            </div>
        </div>
    @endif
</div>

<!-- Status Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card p-3 border-danger">
            <strong>{{ _lang('Active Loans') }}</strong>
            <div>{{ isset($loans) ? count($loans) : 0 }}
                <a href="{{ route('loans.my_loans') }}" class="float-end">→ {{ _lang('View') }}</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 border-primary">
            <strong>{{ _lang('Payment Requests') }}</strong>
            <div>{{ $payment_request ?? 0 }}
                @if(Route::has('payment_requests.index'))
                    <a href="{{ route('payment_requests.index') }}" class="float-end">→ {{ _lang('View') }}</a>
                @else
                    <a href="#" class="float-end">→ {{ _lang('View') }}</a>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 border-success">
            <strong>{{ _lang('Active Fixed Deposits') }}</strong>
            <div>{{ $active_fdr ?? 0 }}
                @if(Route::has('fixed_deposits.history'))
                    <a href="{{ route('fixed_deposits.history') }}" class="float-end">→ {{ _lang('View') }}</a>
                @else
                    <a href="#" class="float-end">→ {{ _lang('View') }}</a>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 border-info">
            <strong>{{ _lang('Active Tickets') }}</strong>
            <div>{{ $active_tickets ?? 0 }}
                @if(Route::has('tickets.my_tickets'))
                    <a href="{{ route('tickets.my_tickets') }}" class="float-end">→ {{ _lang('View') }}</a>
                @else
                    <a href="#" class="float-end">→ {{ _lang('View') }}</a>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Upcoming Loan Payments -->
<h5>{{ _lang('Upcoming Loan Payment') }}</h5>
<table class="table table-bordered table-striped">
    <thead class="table-light">
        <tr>
            <th>{{ _lang('Loan ID') }}</th>
            <th>{{ _lang('Next Payment Date') }}</th>
            <th>{{ _lang('Status') }}</th>
            <th>{{ _lang('Amount to Pay') }}</th>
            <th>{{ _lang('Action') }}</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($loans) && count($loans) > 0)
            @foreach($loans as $loan)
                @if($loan->next_payment)
                <tr>
                    <td>{{ $loan->loan_id }}</td>
                    <td>{{ $loan->next_payment->repayment_date }}</td>
                    <td>
                        @if($loan->next_payment->getRawOriginal('repayment_date') >= date('Y-m-d'))
                            <span class="badge badge-status status-upcoming">{{ _lang('Upcoming') }}</span>
                        @else
                            <span class="badge badge-status status-due">{{ _lang('Due') }}</span>
                        @endif
                    </td>
                    <td>{{ currency($loan->currency->name) }}{{ number_format($loan->next_payment->amount_to_pay, 2) }}</td>
                    <td>
                        @if(Route::has('loans.loan_payment'))
                            <a href="{{ route('loans.loan_payment', $loan->id) }}" class="btn btn-sm btn-dark">{{ _lang('Pay Now') }}</a>
                        @else
                            <a href="#" class="btn btn-sm btn-dark">{{ _lang('Pay Now') }}</a>
                        @endif
                    </td>
                </tr>
                @endif
            @endforeach
        @else
            <tr>
                <td colspan="5" class="text-center">{{ _lang('No Active Loans') }}</td>
            </tr>
        @endif
    </tbody>
</table>

<!-- Recent Transactions -->
<h5>{{ _lang('Recent Transactions') }}</h5>
<table class="table table-bordered table-hover">
    <thead class="table-light">
        <tr>
            <th>{{ _lang('Date') }}</th>
            <th>{{ _lang('Currency') }}</th>
            <th>{{ _lang('Amount') }}</th>
            <th>{{ _lang('Charge') }}</th>
            <th>{{ _lang('Grand Total') }}</th>
            <th>{{ _lang('DR/CR') }}</th>
            <th>{{ _lang('Type') }}</th>
            <th>{{ _lang('Method') }}</th>
            <th>{{ _lang('Status') }}</th>
            <th>{{ _lang('Details') }}</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($recent_transactions) && count($recent_transactions) > 0)
            @foreach($recent_transactions as $transaction)
                @php
                    $symbol = $transaction->dr_cr == 'dr' ? '-' : '+';
                    $class  = $transaction->dr_cr == 'dr' ? 'text-danger' : 'text-success';
                @endphp
                <tr>
                    <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $transaction->currency->name }}</td>
                    @if($transaction->dr_cr == 'dr')
                        <td>{{ currency($transaction->currency->name) }}{{ number_format(($transaction->amount - $transaction->fee), 2) }}</td>
                    @else
                        <td>{{ currency($transaction->currency->name) }}{{ number_format(($transaction->amount + $transaction->fee), 2) }}</td>
                    @endif
                    <td>{{ $transaction->dr_cr == 'dr' ? '+ ' : '- ' }}{{ currency($transaction->currency->name) }}{{ number_format($transaction->fee, 2) }}</td>
                    <td><span class="{{ $class }}">{{ $symbol }} {{ currency($transaction->currency->name) }}{{ number_format($transaction->amount, 2) }}</span></td>
                    <td>{{ strtoupper($transaction->dr_cr) }}</td>
                    <td>{{ str_replace('_', ' ', $transaction->type) }}</td>
                    <td>{{ $transaction->method }}</td>
                    <td>
                        @if($transaction->status == 2)
                            <span class="badge bg-success">{{ _lang('Completed') }}</span>
                        @elseif($transaction->status == 0)
                            <span class="badge bg-danger">{{ _lang('Cancelled') }}</span>
                        @else
                            <span class="badge bg-warning">{{ _lang('Pending') }}</span>
                        @endif
                    </td>
                    <td>
                        @if(Route::has('transaction_details'))
                            <a href="{{ route('transaction_details', $transaction->id) }}" class="btn btn-sm btn-outline-primary">{{ _lang('View') }}</a>
                        @else
                            <a href="#" class="btn btn-sm btn-outline-primary">{{ _lang('View') }}</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10" class="text-center">{{ _lang('No Recent Transactions') }}</td>
            </tr>
        @endif
    </tbody>
</table>

@endsection
