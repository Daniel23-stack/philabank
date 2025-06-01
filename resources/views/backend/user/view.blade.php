@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4 col-lg-3">
		<ul class="nav flex-column nav-tabs settings-tab" role="tablist">
			 <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#account_overview"><i class="icofont-ui-user"></i> {{ _lang('Account Overview') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#transactions"><i class="icofont-listine-dots"></i>{{ _lang('Transactions') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#add_money"><i class="icofont-plus-circle"></i> {{ _lang('Add Money') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#deduct_money"><i class="icofont-minus-circle"></i> {{ _lang('Deduct Money') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#my_loans"><i class="icofont-bank"></i> {{ _lang('Loans') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#my_fdr"><i class="icofont-money"></i> {{ _lang('Fixed Deposit') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#support_tickets"><i class="icofont-live-support"></i> {{ _lang('Support Ticket') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#kyc_documents"><i class="icofont-file-document"></i> {{ _lang('KYC Documents') }}</a></li>
             <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#email"><i class="icofont-email"></i> {{ _lang('Send Email') }}</a></li>
             <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#sms"><i class="icofont-email"></i> {{ _lang('Send SMS') }}</a></li>
		</ul>
	</div>

    <div class="col-md-8 col-lg-9">
        <div class="tab-content">
			<div id="account_overview" class="tab-pane active">
                <div class="card">
                    <div class="card-header">
                        <span class="header-title">{{ _lang('User Details') }}</span>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <td colspan="2" class="text-center"><img class="thumb-image-sm img-thumbnail"
                                        src="{{ profile_picture($user->profile_picture) }}"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="row">
                                        @foreach($account_balance as $currency)
                                        <div class="col-md">
                                            <div class="card mb-4">
                                                <div class="card-body">
                                                    <h6>{{ $currency->name.' '._lang('Balance') }}</h6>
                                                    <h6 class="pt-1"><b>{{ decimalPlace($currency->balance, currency($currency->name)) }}</b></h6>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Name') }}</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Account Number') }}</td>
                                <td>{{ $user->account_number }}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Email') }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Phone') }}</td>
                                <td>{{ '+'.$user->country_code.'-'.$user->phone }}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Branch') }}</td>
                                <td>{{ $user->branch->name }}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Status') }}</td>
                                <td>{!! xss_clean(status($user->status)) !!}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Email Verified') }}</td>
                                <td>{!! $user->email_verified_at != null ? xss_clean(show_status(_lang('Yes'),'primary')) : xss_clean(show_status(_lang('No'),'danger')) !!}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('SMS Verified') }}</td>
                                <td>{!! $user->sms_verified_at != null ? xss_clean(show_status(_lang('Yes'),'primary')) : xss_clean(show_status(_lang('No'),'danger')) !!}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Withdraw Money') }}</td>
                                <td>{!! $user->allow_withdrawal == 1 ? xss_clean(show_status(_lang('Allowed'),'primary')) : xss_clean(show_status(_lang('Not Allowed'),'danger')) !!}</td>
                            </tr>
                            <tr>
                                <td>{{ _lang('Account Opening Date') }}</td>
                                <td>{{ $user->created_at }}</td>
                            </tr>
                            <!--Custom Fields-->
                            @php $customFieldsData = json_decode($user->custom_fields, true); @endphp
                            @foreach($customFields as $customField)
                            <tr>
                                <td>{{ $customField->field_label }}</td>
                                <td>
                                    @if($customField->field_type == 'file')
                                    @php $file = $customFieldsData[$customField->field_name]['field_value'] ?? null; @endphp
                                    {!! $file != null ? '<a href="'. asset('public/uploads/media/'.$file) .'" target="_blank" class="btn btn-xs btn-primary"><i class="fas fa-download mr-2"></i>'._lang('Download').'</a>' : '' !!}
                                    @else
                                    {{ $customFieldsData[$customField->field_name]['field_value'] ?? null }}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div><!--End account overview Tab-->

            <div id="transactions" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <span class="header-title">{{ _lang('Transactions') }}</span>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered" id="transactions_table">
                            <thead>
                                <tr>
                                    <th>{{ _lang('Date') }}</th>
                                    <th>{{ _lang('AC Number') }}</th>
                                    <th>{{ _lang('Currency') }}</th>
                                    <th>{{ _lang('DR/CR') }}</th>
                                    <th>{{ _lang('Type') }}</th>
                                    <th>{{ _lang('Method') }}</th>
                                    <th>{{ _lang('Amount') }}</th>
                                    <th>{{ _lang('Status') }}</th>
                                    <th class="text-center">{{ _lang('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!--End Transaction Tab-->

            <div id="add_money" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <span class="header-title">{{ _lang('Add Money') }}</span>
                    </div>

                    <div class="card-body">
                        <form method="post" class="validate" autocomplete="off" action="{{ route('deposits.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('User Email') }}</label>
                                        <input type="email" class="form-control" name="account_number" value="{{ $user->email }}" required="" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Date') }}</label>
                                        <input type="text" class="form-control datetimepicker" name="date" value="{{ old('date', date('Y-m-d H:i:s')) }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Currency') }}</label>
                                        <select class="form-control auto-select select2" data-selected="{{ old('currency_id') }}" name="currency_id" required>
                                            <option value="">{{ _lang('Select One') }}</option>
                                            {{ create_option('currency','id','name','',array('status=' => 1)) }}
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Amount') }}</label>
                                        <input type="text" class="form-control float-field" name="amount" value="{{ old('amount') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Note') }}</label>
                                        <textarea class="form-control" name="note">{{ old('note') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg"><i class="icofont-check-circled"></i> {{ _lang('Submit') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!--End Add Money Tab-->

            <div id="deduct_money" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <span class="header-title">{{ _lang('Deduct Money') }}</span>
                    </div>

                    <div class="card-body">
                        <form method="post" class="validate" autocomplete="off" action="{{ route('withdraw.store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('User Email') }}</label>
                                        <input type="email" class="form-control" name="account_number" value="{{ $user->email }}" required="" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Date') }}</label>
                                        <input type="text" class="form-control datetimepicker" name="date" value="{{ old('date', date('Y-m-d H:i:s')) }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Currency') }}</label>
                                        <select class="form-control auto-select select2" data-selected="{{ old('currency_id') }}" name="currency_id" required>
                                            <option value="">{{ _lang('Select One') }}</option>
                                            {{ create_option('currency','id','name','',array('status=' => 1)) }}
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Amount') }}</label>
                                        <input type="text" class="form-control float-field" name="amount" value="{{ old('amount') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Note') }}</label>
                                        <textarea class="form-control" name="note">{{ old('note') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg"><i class="icofont-check-circled"></i> {{ _lang('Submit') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!--End Add Money Tab-->

            <div id="my_loans" class="tab-pane">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="panel-title">{{ _lang('Loans') }}</span>
                        <a class="btn btn-primary btn-sm float-right" href="{{ route('loans.create') }}"><i class="icofont-plus-circle"></i> {{ _lang('Add New Loan') }}</a>
                    </div>

                    <div class="card-body">
                        <table id="loans_table" class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>{{ _lang('Loan ID') }}</th>
                                    <th>{{ _lang('Loan Product') }}</th>
                                    <th class="text-right">{{ _lang('Applied Amount') }}</th>
                                    <th class="text-right">{{ _lang('Amount Paid') }}</th>
                                    <th class="text-right">{{ _lang('Due Amount') }}</th>
                                    <th>{{ _lang('Release Date') }}</th>
                                    <th>{{ _lang('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->loans as $loan)
                                <tr>
                                    <td><a href="{{ route('loans.show',$loan->id) }}">{{ $loan->loan_id }}</a></td>
                                    <td>{{ $loan->loan_product->name }}</td>
                                    <td class="text-right">{{ decimalPlace($loan->applied_amount, currency($loan->currency->name)) }}</td>
                                    <td class="text-right">{{ decimalPlace($loan->total_paid, currency($loan->currency->name)) }}</td>
                                    <td class="text-right">{{ decimalPlace($loan->applied_amount - $loan->total_paid, currency($loan->currency->name)) }}</td>
                                    <td>{{ $loan->release_date }}</td>
                                    <td>
                                        @if($loan->status == 0)
                                            {!! xss_clean(show_status(_lang('Pending'), 'warning')) !!}
                                        @elseif($loan->status == 1)
                                            {!! xss_clean(show_status(_lang('Approved'), 'success')) !!}
                                        @elseif($loan->status == 2)
                                            {!! xss_clean(show_status(_lang('Completed'), 'info')) !!}
                                        @elseif($loan->status == 3)
                                            {!! xss_clean(show_status(_lang('Cancelled'), 'danger')) !!}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!--End Send Email Tab-->

            <div id="my_fdr" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <span class="header-title">{{ _lang('Fixed Deposit') }}</span>
                    </div>

                    <div class="card-body">
                        <table id="fdr_table" class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>{{ _lang('Plan') }}</th>
                                    <th>{{ _lang('Currency') }}</th>
                                    <th>{{ _lang('Deposit Amount') }}</th>
                                    <th>{{ _lang('Return Amount') }}</th>
                                    <th>{{ _lang('Status') }}</th>
                                    <th>{{ _lang('Mature Date') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->fixed_deposits as $fixed_deposit)
                                <tr>
                                    <td>{{ $fixed_deposit->plan->name }}</td>
                                    <td>{{ $fixed_deposit->currency->name }}</td>
                                    <td>{{ decimalPlace($fixed_deposit->deposit_amount, currency($fixed_deposit->currency->name)) }}</td>
                                    <td>{{ decimalPlace($fixed_deposit->return_amount, currency($fixed_deposit->currency->name)) }}</td>
                                    <td>{!! xss_clean(fdr_status($fixed_deposit->status)) !!}</td>
                                    <td>{{ $fixed_deposit->mature_date }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!--End Fixed Deposit Tab-->

            <div id="support_tickets" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <span class="header-title">{{ _lang('Support Tickets') }}</span>
                    </div>

                    <div class="card-body">
                        <table id="support_tickets_table" class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>{{ _lang('ID') }}</th>
                                    <th>{{ _lang('Subject') }}</th>
                                    <th>{{ _lang('Status') }}</th>
                                    <th>{{ _lang('Created') }}</th>
                                    <th class="text-center">{{ _lang('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->support_tickets as $supportticket)
                                <tr>
                                    <td>{{ $supportticket->id }}</td>
                                    <td>{{ $supportticket->subject }}</td>
                                    <td>{!! xss_clean(ticket_status($supportticket->status)) !!}</td>
                                    <td>{{ $supportticket->created_at }}</td>
                                    <td class="text-center">
                                        <a href="{{ action('SupportTicketController@show', $supportticket['id']) }}" class="btn btn-primary btn-sm"><i class="icofont-ui-messaging"></i> {{ _lang('View Conversations') }}</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!--End Support ticket Tab-->

            <div id="email" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <span class="header-title">{{ _lang('Send Email') }}</span>
                    </div>

                    <div class="card-body">
                        <form method="post" class="validate" autocomplete="off" action="{{ route('users.send_email') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('User Email') }}</label>
                                        <input type="email" class="form-control" name="user_email" value="{{ $user->email }}" required="" readonly>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Subject') }}</label>
                                        <input type="text" class="form-control" name="subject" value="{{ old('subject') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Message') }}</label>
                                        <textarea class="form-control" rows="8" name="message" required>{{ old('message') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block"><i class="icofont-check-circled"></i> {{ _lang('Send') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!--End Send Email Tab-->

            <div id="sms" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <span class="header-title">{{ _lang('Send SMS') }}</span>
                    </div>

                    <div class="card-body">
                        <form method="post" class="validate" autocomplete="off" action="{{ route('users.send_sms') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('User Mobile') }}</label>
                                        <input type="text" class="form-control" name="phone" value="{{ $user->country_code.$user->phone }}" required="" readonly>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Message') }}</label>
                                        <textarea class="form-control" name="message" required>{{ old('message') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block"><i class="icofont-check-circled"></i> {{ _lang('Send') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!--End Send SMS Tab-->

            <div id="kyc_documents" class="tab-pane">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4 class="header-title">{{ _lang('Documents of').' '.$user->name }}</h4>
                        <div class="ml-auto">
                            @if($user->document_verified_at == null)
                                <div class="btn-group" role="group">
                                    <a href="{{ route('users.documents.varify', $user->id) }}" class="btn btn-success btn-sm float-right"><i class="icofont-check-circled"></i> {{ _lang('Approve') }}</a>
                                    <a href="{{ route('users.documents.unvarify', $user->id) }}" class="btn btn-danger btn-sm float-right"><i class="icofont-check-circled"></i> {{ _lang('Reject') }}</a>
                                </div>
                            @else
                                <a href="{{ route('users.documents.unvarify', $user->id) }}" class="btn btn-danger btn-sm float-right"><i class="icofont-close-circled"></i> {{ _lang('Click to Unverify') }}</a>
                            @endif
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>{{ _lang('Document Name') }}</th>
                                    <th>{{ _lang('Document File') }}</th>
                                    <th>{{ _lang('Submitted At') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($user->documents as $document)
                                <tr>
                                    <td>{{ $document->document_name }}</td>
                                    <td><a target="_blank" href="{{ asset('public/uploads/media/'.$document->document ) }}">{{ $document->document }}</a></td>
                                    <td>{{ date('d M, Y H:i:s',strtotime($document->created_at)) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!--End KYC Documents Tab-->

        </div>
    </div>
</div>
@endsection

@section('js-script')
<script>
   (function($) {
       "use strict";

       var transactions_table = $("#transactions_table").DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url('admin/users/get_user_transaction_data/'.$user->id) }}',
            "columns" : [
                { data: "created_at", name: "created_at" },
                { data: "user.account_number", name: "user.account_number" },
                { data: "currency.name", name: "currency.name" },
                { data: "dr_cr", name: "dr_cr" },
                { data: "type", name: "type" },
                { data: "method", name: "method" },
                { data: "amount", name: "amount" },
                { data: "status", name: "status" },
                { data: "action", name: "action" },
            ],
            responsive: true,
            "bStateSave": true,
            "bAutoWidth":false,
            "ordering": false,
            "language": {
                "decimal":        "",
                "emptyTable":     "{{ _lang('No Data Found') }}",
                "info":           "{{ _lang('Showing') }} _START_ {{ _lang('to') }} _END_ {{ _lang('of') }} _TOTAL_ {{ _lang('Entries') }}",
                "infoEmpty":      "{{ _lang('Showing 0 To 0 Of 0 Entries') }}",
                "infoFiltered":   "(filtered from _MAX_ total entries)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "{{ _lang('Show') }} _MENU_ {{ _lang('Entries') }}",
                "loadingRecords": "{{ _lang('Loading...') }}",
                "processing":     "{{ _lang('Processing...') }}",
                "search":         "{{ _lang('Search') }}",
                "zeroRecords":    "{{ _lang('No matching records found') }}",
                "paginate": {
                    "first":      "{{ _lang('First') }}",
                    "last":       "{{ _lang('Last') }}",
                    "previous":   "<i class='icofont-rounded-left'></i>",
                    "next":       "<i class='icofont-rounded-right'></i>",
                }
            },
            drawCallback: function () {
                $(".dataTables_paginate > .pagination").addClass("pagination-bordered");
            },
        });

        $(".select-filter").on("change", function (e) {
            transactions_table.draw();
        });

        $(document).on("ajax-screen-submit", function () {
            transactions_table.draw();
        });

        $('.nav-tabs a').on('shown.bs.tab', function(event){
            var tab = $(event.target).attr("href");
            var url = "{{ route('users.show',$user->id) }}";
            history.pushState({}, null, url + "?tab=" + tab.substring(1));
        });

        @if(isset($_GET['tab']))
        $('.nav-tabs a[href="#{{ $_GET['tab'] }}"]').tab('show');
        @endif

        $("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });

   })(jQuery);
</script>
@endsection