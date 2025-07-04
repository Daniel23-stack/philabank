@php $settings = \App\Models\Setting::whereIn('name',['send_money_module', 'exchnage_money_module', 'wire_transfer_module',
				'payment_request_module', 'manual_deposit_module', 'automatic_deposit_module', 'gift_card_module',
				'withdraw_money_module', 'loan_module', 'fixed_deposit_module', 'dps_module'])
				->get(); 
@endphp

<div class="sb-sidenav-menu-heading">{{ _lang('NAVIGATIONS') }}</div>

<a class="nav-link" href="{{ route('dashboard.index') }}">
	<div class="sb-nav-link-icon"><i class="icofont-dashboard-web"></i></div>
	{{ _lang('Dashboard') }}
</a>

@if(get_setting($settings, 'send_money_module', 1) == '1')
<a class="nav-link" href="{{ route('transfer.send_money') }}">
	<div class="sb-nav-link-icon"><i class="icofont-location-arrow"></i></div>
	{{ _lang('Send Money') }}
</a>
@endif

@if(get_setting($settings, 'exchnage_money_module', 1) == '1')
<a class="nav-link" href="{{ route('transfer.exchange_money') }}">
	<div class="sb-nav-link-icon"><i class="icofont-exchange"></i></div>
	{{ _lang('Exchange Money') }}
</a>
@endif

@if(get_setting($settings, 'wire_transfer_module', 1) == '1')
<a class="nav-link" href="{{ route('transfer.wire_transfer') }}">
	<div class="sb-nav-link-icon"><i class="icofont-bank-transfer"></i></div>
	{{ _lang('Wire Transfer') }}
</a>
@endif

@if(get_setting($settings, 'payment_request_module', 1) == '1')
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#payment_request" aria-expanded="false" aria-controls="collapseLayouts">
	<div class="sb-nav-link-icon"><i class="icofont-credit-card"></i></div>
	{{ _lang('Payment Request') }}
	<div class="sb-sidenav-collapse-arrow"><i class="icofont-rounded-down"></i></div>
</a>
<div class="collapse" id="payment_request" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
	<nav class="sb-sidenav-menu-nested nav">
		<a class="nav-link" href="{{ route('payment_requests.create') }}">{{ _lang('New Request') }}</a>
		<a class="nav-link" href="{{ route('payment_requests.index') }}">{{ _lang('All Requests') }}</a>
	</nav>
</div>
@endif

<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#deposit" aria-expanded="false" aria-controls="collapseLayouts">
	<div class="sb-nav-link-icon"><i class="icofont-plus-circle"></i></div>
	{{ _lang('Deposit Money') }}
	<div class="sb-sidenav-collapse-arrow"><i class="icofont-rounded-down"></i></div>
</a>
<div class="collapse" id="deposit" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
	<nav class="sb-sidenav-menu-nested nav">
		@if(get_setting($settings, 'automatic_deposit_module', 1) == '1')
		<a class="nav-link" href="{{ route('deposit.automatic_methods') }}">{{ _lang('Automatic Deposit') }}</a>
		@endif

		@if(get_setting($settings, 'manual_deposit_module', 1) == '1')
		<a class="nav-link" href="{{ route('deposit.manual_methods') }}">{{ _lang('Manual Deposit') }}</a>
		@endif

		@if(get_setting($settings, 'gift_card_module', 1) == '1')
		<a class="nav-link" href="{{ route('deposit.redeem_gift_card') }}">{{ _lang('Redeem Gift Card') }}</a>
		@endif
	</nav>
</div>

@if(get_setting($settings, 'withdraw_money_module', 1) == '1')
<a class="nav-link" href="{{ route('withdraw.manual_methods') }}">
	<div class="sb-nav-link-icon"><i class="icofont-minus-circle"></i></div>
	{{ _lang('Withdraw Money') }}
</a>
@endif

@if(get_setting($settings, 'loan_module', 1) == '1')
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#loans" aria-expanded="false" aria-controls="collapseLayouts">
	<div class="sb-nav-link-icon"><i class="icofont-dollar-minus"></i></div>
	{{ _lang('Loans') }}
	<div class="sb-sidenav-collapse-arrow"><i class="icofont-rounded-down"></i></div>
</a>
<div class="collapse" id="loans" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
	<nav class="sb-sidenav-menu-nested nav">
		<a class="nav-link" href="{{ route('loans.apply_loan') }}">{{ _lang('Apply New Loan') }}</a>
		<a class="nav-link" href="{{ route('loans.my_loans') }}">{{ _lang('My Loans') }}</a>
		<a class="nav-link" href="{{ route('loans.calculator') }}">{{ _lang('Loan Calculator') }}</a>
	</nav>
</div>
@endif

@if(get_setting($settings, 'fixed_deposit_module', 1) == '1')
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#fdr" aria-expanded="false" aria-controls="collapseLayouts">
	<div class="sb-nav-link-icon"><i class="icofont-money"></i></div>
	{{ _lang('Fixed Deposit') }}
	<div class="sb-sidenav-collapse-arrow"><i class="icofont-rounded-down"></i></div>
</a>
<div class="collapse" id="fdr" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
	<nav class="sb-sidenav-menu-nested nav">
		<a class="nav-link" href="{{ route('fixed_deposits.apply') }}">{{ _lang('Apply New FRD') }}</a>
		<a class="nav-link" href="{{ route('fixed_deposits.history') }}">{{ _lang('FDR History') }}</a>
	</nav>
</div>
@endif

@if(get_setting($settings, 'dps_module', 1) == '1')
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dps" aria-expanded="false" aria-controls="collapseLayouts">
	<div class="sb-nav-link-icon"><i class="icofont-money-bag"></i></div>
	{{ _lang('DPS Scheme') }}
	<div class="sb-sidenav-collapse-arrow"><i class="icofont-rounded-down"></i></div>
</a>
<div class="collapse" id="dps" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
	<nav class="sb-sidenav-menu-nested nav">
		<a class="nav-link" href="{{ route('dps_scheme.plans') }}">{{ _lang('DPS Plans') }}</a>
		<a class="nav-link" href="{{ route('dps_scheme.index') }}">{{ _lang('My DPS') }}</a>
	</nav>
</div>
@endif

<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tickets" aria-expanded="false" aria-controls="collapseLayouts">
	<div class="sb-nav-link-icon"><i class="icofont-live-support"></i></div>
	{{ _lang('Support Tickets') }}
	<div class="sb-sidenav-collapse-arrow"><i class="icofont-rounded-down"></i></div>
</a>
<div class="collapse" id="tickets" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
	<nav class="sb-sidenav-menu-nested nav">
		<a class="nav-link" href="{{ route('tickets.create_ticket') }}">{{ _lang('Create New Ticket') }}</a>
		<a class="nav-link" href="{{ route('tickets.my_tickets',['status' => 'pending']) }}">{{ _lang('Pending Tickets') }}</a>
		<a class="nav-link" href="{{ route('tickets.my_tickets',['status' => 'active']) }}">{{ _lang('Active Tickets') }}</a>
		<a class="nav-link" href="{{ route('tickets.my_tickets',['status' => 'closed']) }}">{{ _lang('Closed Tickets') }}</a>
	</nav>
</div>

<a class="nav-link" href="{{ route('customer_reports.transactions_report') }}">
	<div class="sb-nav-link-icon"><i class="icofont-chart-histogram"></i></div>
	{{ _lang('Transactions Report') }}
</a>
