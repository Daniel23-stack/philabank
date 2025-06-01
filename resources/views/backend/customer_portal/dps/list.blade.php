@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<div class="card no-export">
		    <div class="card-header">
				<span class="panel-title">{{ _lang('My DPS Schemes') }}</span>
			</div>
			<div class="card-body">
				<table id="fdr_table" class="table table-bordered data-table">
					<thead>
					    <tr>
						    <th>{{ _lang('Plan') }}</th>
							<th>{{ _lang('Amount To Pay') }}</th>
							<th>{{ _lang('Installment') }}</th>
							<th>{{ _lang('Next Installment') }}</th>
							<th class="text-right">{{ _lang('Total Paid') }}</th>
							<th class="text-right">{{ _lang('After Matured') }}</th>
							<th>{{ _lang('Status') }}</th>
					    </tr>
					</thead>
					<tbody>
                        @foreach($dps_schemes as $dps_scheme)
                        <tr>
						    <td>{{ $dps_scheme->plan->name }}</td>
							<td>{{ decimalPlace($dps_scheme->per_installment, currency($dps_scheme->currency->name)) }} / {{ _lang('Every').' '.$dps_scheme->installment_interval }} {{ ucwords($dps_scheme->interval_type) }}</td>
							<td>
								<span class="text-danger">{{ _lang('Total').': '.$dps_scheme->total_installment }}<br></span>
								<span class="text-info">{{ _lang('Completed').': '.$dps_scheme->installment_completed }}</span>
							</td>
							<td>{{ $dps_scheme->next_installment_date }}</td>
							<td class="text-right">{{ decimalPlace($dps_scheme->per_installment * $dps_scheme->installment_completed, currency($dps_scheme->currency->name)) }}</td>
							<td class="text-right">{{ decimalPlace($dps_scheme->final_amount, currency($dps_scheme->currency->name)) }}</td>
							<td>{!! xss_clean(dps_status($dps_scheme->status)) !!}</td>
					    </tr>
                        @endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection