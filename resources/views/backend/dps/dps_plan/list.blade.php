@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<div class="card no-export">
		    <div class="card-header d-flex align-items-center">
				<span class="panel-title">{{ _lang('DPS Plans') }}</span>
				<a class="btn btn-primary btn-sm ml-auto ajax-modal" data-title="{{ _lang('New DPS Plan') }}" href="{{ route('dps_plans.create') }}"><i class="icofont-plus-circle"></i> {{ _lang('Add New') }}</a>
			</div>
			<div class="card-body">
				<table id="dps_plans_table" class="table table-bordered data-table">
					<thead>
					    <tr>
						    <th>{{ _lang('Plan') }}</th>
							<th>{{ _lang('Installment') }}</th>
							<th>{{ _lang('Total Installment') }}</th>
							<th>{{ _lang('Interest') }}</th>
							<th>{{ _lang('Final Amount') }}</th>
							<th class="text-center">{{ _lang('Status') }}</th>
							<th class="text-center">{{ _lang('Action') }}</th>
					    </tr>
					</thead>
					<tbody>
					    @foreach($dpsplans as $dpsplan)
					    <tr data-id="row_{{ $dpsplan->id }}">
							<td class='name'>{{ $dpsplan->name }}</td>
							<td class='per_installment'>{{ decimalPlace($dpsplan->per_installment, currency($dpsplan->currency->name)) }} / {{ _lang('Every').' '.$dpsplan->installment_interval }} {{ ucwords($dpsplan->interval_type) }}</td>
							<td class='total_installment'>{{ $dpsplan->total_installment.' '._lang('Times') }}</td>
							<td class='interest_rate'>{{ $dpsplan->interest_rate }}%</td>
							<td class='final_amount'>{{ decimalPlace($dpsplan->final_amount, currency($dpsplan->currency->name)) }}</td>
							<td class='status text-center'>{!! xss_clean(status($dpsplan->status)) !!}</td>
							
							<td class="text-center">
								<span class="dropdown">
								  <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  {{ _lang('Action') }}
								  </button>
								  <form action="{{ action('DPSPlanController@destroy', $dpsplan['id']) }}" method="post">
									{{ csrf_field() }}
									<input name="_method" type="hidden" value="DELETE">

									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a href="{{ action('DPSPlanController@edit', $dpsplan['id']) }}" data-title="{{ _lang('Update DPS Plan') }}" class="dropdown-item dropdown-edit ajax-modal"><i class="icofont-ui-edit"></i> {{ _lang('Edit') }}</a>
										<a href="{{ action('DPSPlanController@show', $dpsplan['id']) }}" data-title="{{ _lang('DPS Plan Details') }}" class="dropdown-item dropdown-view ajax-modal"><i class="icofont-eye-alt"></i> {{ _lang('View') }}</a>
										<button class="btn-remove dropdown-item" type="submit"><i class="icofont-trash"></i> {{ _lang('Delete') }}</button>
									</div>
								  </form>
								</span>
							</td>
					    </tr>
					    @endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection