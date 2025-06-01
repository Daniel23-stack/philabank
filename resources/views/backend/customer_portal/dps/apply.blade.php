@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-lg-8 offset-lg-2">
		<div class="card">
			<div class="card-header">
				<h4 class="header-title text-center">{{ _lang('New DPS Confirmation') }}</h4>
			</div>
			<div class="card-body">
                <table class="table table-striped table-bordered">
                    <tr><td>{{ _lang('Name') }}</td><td>{{ $dpsplan->name }}</td></tr>
                    <tr><td>{{ _lang('Currency') }}</td><td>{{ $dpsplan->currency->name }}</td></tr>
                    <tr><td>{{ _lang('Installment') }}</td><td>{{ decimalPlace($dpsplan->per_installment, currency($dpsplan->currency->name)) }} / {{ _lang('Every').' '.$dpsplan->installment_interval }} {{ ucwords($dpsplan->interval_type) }}</td></tr>
                    <tr><td>{{ _lang('Total Installment') }}</td><td>{{ $dpsplan->total_installment.' '._lang('Times') }}</td></tr>
                    <tr><td>{{ _lang('Interest Rate') }}</td><td>{{ $dpsplan->interest_rate }}%</td></tr>
                    <tr><td>{{ _lang('Total Deposit') }}</td><td>{{ decimalPlace($dpsplan->total_installment * $dpsplan->per_installment, currency($dpsplan->currency->name)) }}</td></tr>
                    <tr><td>{{ _lang('You Will Get After Matured') }}</td><td>{{ decimalPlace($dpsplan->final_amount, currency($dpsplan->currency->name)) }}</td></tr>
                    <tr>
                        <td colspan="2">
                            <form action="{{ route('dps_scheme.apply', $dpsplan->id) }}" method="post">
                                @csrf
                                <input type="hidden" name="plan_id" value="{{ $dpsplan->id }}">
                                <button type="submit" class="btn btn-primary float-left"><i class="icofont-check-circled"></i> {{ _lang('Confirm') }}</button>
                                <a href="{{ route('dashboard.index') }}" class="btn btn-danger float-right"><i class="icofont-close-circled"></i> {{ _lang('Reject') }}</a>
                            </form>
                        </td>
                    </tr>
                </table>
			</div>
		</div>
    </div>
</div>
@endsection


