@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<div class="card no-export">
		    <div class="card-header d-flex align-items-center">
				<span class="panel-title">{{ _lang('Wire Transfer Request') }}</span>
				<select name="status" class="ml-auto select-filter filter-select">
					<option value="1">{{ _lang('Pending') }}</option>
					<option value="2">{{ _lang('Approved') }}</option>
					<option value="0">{{ _lang('Rejected') }}</option>
				</select>
			</div>
			<div class="card-body">
				<table id="transfer_request_table" class="table table-bordered">
					<thead>
					    <tr>
						    <th>{{ _lang('User') }}</th>
						    <th>{{ _lang('AC Number') }}</th>
							<th>{{ _lang('Currency') }}</th>
							<th>{{ _lang('Amount') }}</th>
							<th>{{ _lang('Bank') }}</th>
							<th>{{ _lang('Status') }}</th>
							<th class="text-center">{{ _lang('Action') }}</th>
					    </tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection

@section('js-script')
<script src="{{ asset('public/backend/assets/js/datatables/transfer_request.js?v=1.1') }}"></script>
@endsection