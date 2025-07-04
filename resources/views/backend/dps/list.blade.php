@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<div class="card no-export">
		    <div class="card-header d-flex align-items-center">
				<span class="panel-title">{{ _lang('ALL DPS') }}</span>
				<div class="ml-auto">
					<select name="status" class="select-filter filter-select">
						<option value="">{{ _lang('All') }}</option>
						<option value="1">{{ _lang('Active') }}</option>
						<option value="2">{{ _lang('Matured') }}</option>
						<option value="3">{{ _lang('Closed') }}</option>
					</select>
					<a class="btn btn-primary btn-sm ajax-modal" data-title="{{ _lang('Add New DPS') }}" href="{{ route('dps.create') }}"><i class="icofont-plus-circle"></i> {{ _lang('Add New') }}</a>
				</div>
			</div>
			<div class="card-body">
				<table id="dps_table" class="table table-bordered">
					<thead>
					    <tr>
						    <th>{{ _lang('DPS Plan') }}</th>
							<th>{{ _lang('User Account') }}</th>
							<th>{{ _lang('Installment') }}</th>
							<th>{{ _lang('Total Paid') }}</th>
							<th>{{ _lang('After Matured') }}</th>
							<th>{{ _lang('Status') }}</th>
							<th>{{ _lang('Next Installment') }}</th>
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
<script>
(function ($) {
  "use strict";

  var dps_table = $("#dps_table").DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: _url + "/admin/dps/get_table_data",
      method: "POST",
      data: function (d) {
        d._token = $('meta[name="csrf-token"]').attr("content");

        if ($("select[name=status]").val() != "") {
          d.status = $("select[name=status]").val();
        }
      },
      error: function (request, status, error) {
        console.log(request.responseText);
      },
    },
    columns: [
		{ data : 'plan.name', name : 'plan.name' },
		{ data : 'user.name', name : 'user.name' },
		{ data : 'total_installment', name : 'total_installment' },
		{ data : 'total_paid', name : 'total_paid' },
		{ data : 'final_amount', name : 'final_amount' },
		{ data : 'status', name : 'status' },
		{ data : 'next_installment_date', name : 'next_installment_date' },
		{ data : "action", name : "action" },
    ],
    responsive: true,
    bStateSave: true,
    bAutoWidth: false,
    ordering: false,
    language: {
      decimal: "",
      emptyTable: $lang_no_data_found,
      info:
        $lang_showing +
        " _START_ " +
        $lang_to +
        " _END_ " +
        $lang_of +
        " _TOTAL_ " +
        $lang_entries,
      infoEmpty: $lang_showing_0_to_0_of_0_entries,
      infoFiltered: "(filtered from _MAX_ total entries)",
      infoPostFix: "",
      thousands: ",",
      lengthMenu: $lang_show + " _MENU_ " + $lang_entries,
      loadingRecords: $lang_loading,
      processing: $lang_processing,
      search: $lang_search,
      zeroRecords: $lang_no_matching_records_found,
      paginate: {
        first: $lang_first,
        last: $lang_last,
        previous: "<i class='icofont-rounded-left'></i>",
        next: "<i class='icofont-rounded-right'></i>",
      },
    },
    drawCallback: function () {
      $(".dataTables_paginate > .pagination").addClass("pagination-bordered");
    },
  });

  $(".select-filter").on("change", function (e) {
    dps_table.draw();
  });

  $(document).on("ajax-screen-submit", function () {
    dps_table.draw();
  });

})(jQuery);
</script>
@endsection