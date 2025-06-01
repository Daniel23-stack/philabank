@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4 class="header-title text-center">{{ _lang('Available DPS Plans') }}</h4>
			</div>
			<div class="card-body">
                <div class="row dps-plan">
                    @foreach($dps_plans as $dps_plan)
                    <div class="col-lg-4">
                        <div class="dps-item mb-4">
                            <div class="title">
                                <div class="d-flex flex-wrap justify-content-between">
                                    <h4 class="my-3">{{ $dps_plan->name }}</h4>
                                    <h4 class="my-3">{{ $dps_plan->interest_rate }}%</h4>
                                </div>
                            </div>

                            <div class="content">
                                <ul class="plan-feature-list pl-0">
                                    <li class="d-flex flex-wrap justify-content-between">
                                        <span>{{ _lang('Currency') }}</span>
                                        <span>{{ $dps_plan->currency->name }}</span>
                                    </li>
                                    <li class="d-flex flex-wrap justify-content-between">
                                        <span>{{ _lang('Per Instalment') }}</span>
                                        <span>{{ decimalPlace($dps_plan->per_installment, currency($dps_plan->currency->name)) }}</span>
                                    </li>
                                    <li class="d-flex flex-wrap justify-content-between">
                                        <span>{{ _lang('Installment Interval') }}</span>
                                        <span>{{ _lang('Every').' '.$dps_plan->installment_interval }} {{ ucwords($dps_plan->interval_type) }}</span>
                                    </li>
                                    <li class="d-flex flex-wrap justify-content-between">
                                        <span>{{ _lang('Interest Rate') }}</span>
                                        <span>{{ $dps_plan->interest_rate }} %</span>
                                    </li>
                                    <li class="d-flex flex-wrap justify-content-between">
                                        <span>{{ _lang('Total Installment') }}</span>
                                        <span>{{ $dps_plan->total_installment }}</span>
                                    </li>
                                    <li class="d-flex flex-wrap justify-content-between">
                                        <span>{{ _lang('Total Deposit') }}</span>
                                        <span>{{ decimalPlace($dps_plan->total_installment *  $dps_plan->per_installment, currency($dps_plan->currency->name)) }}</span>
                                    </li>
                                    <li class="d-flex flex-wrap justify-content-between">
                                        <span>{{ _lang('Matured Amount') }}</span>
                                        <span>{{ decimalPlace($dps_plan->final_amount, currency($dps_plan->currency->name)) }}</span>
                                    </li>
                                </ul>
                                <a href="{{ route('dps_scheme.apply',$dps_plan->id) }}" class="btn btn-main-2 btn-block">{{ _lang('Apply Now') }}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
			</div>
		</div>
    </div>
</div>
@endsection


