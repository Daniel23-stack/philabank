@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-header d-flex align-items-center">
                <h4 class="header-title">{{ ucwords(str_replace("_"," ",$status)).' '._lang('Users') }}</h4>

                <div class="ml-auto">
                    <div class="dropdown d-inline-block">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="userFilter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ ucwords(str_replace("_"," ",$status)).' '._lang('Users') }}
                        </button>

                        <div class="dropdown-menu" aria-labelledby="userFilter">
                            <a class="dropdown-item" href="{{ route('users.index') }}">{{ _lang('All Users') }}</a>
                            <a class="dropdown-item" href="{{ route('users.filter') }}/inactive">{{ _lang('Active Users') }}</a>
                            <a class="dropdown-item" href="{{ route('users.filter') }}/inactive">{{ _lang('Inactive Users') }}</a>
                            <a class="dropdown-item" href="{{ route('users.filter') }}/kyc_verified">{{ _lang('KYC Verified') }}</a>
                            <a class="dropdown-item" href="{{ route('users.filter') }}/kyc_unverified">{{ _lang('KYC Unverified') }}</a>
                        </div>
                    </div>

                    <a class="btn btn-primary btn-sm" href="{{ route('users.create') }}"><i class="icofont-plus-circle"></i> {{ _lang('Add New') }}</a>
                </div>
            </div>

            <div class="card-body">
                <table id="users_table" class="table table-bordered" data-status="{{ $status }}">
                    <thead>
                        <tr>
                            <th class="text-center">{{ _lang('Photo') }}</th>
                            <th>{{ _lang('AC Number') }}</th>
                            <th>{{ _lang('Name') }}</th>
                            <th>{{ _lang('Email') }}</th>
                            <th>{{ _lang('Phone') }}</th>
                            <th>{{ _lang('Status') }}</th>
                            <th class="text-center">{{ _lang('KYC Verified') }}</th>
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
<script src="{{ asset('public/backend/assets/js/datatables/users.js?v=1.1') }}"></script>
@endsection