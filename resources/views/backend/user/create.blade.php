@extends('layouts.app')

@section('content')
<form method="post" class="validate" autocomplete="off" action="{{ route('users.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">{{ _lang('Create New User') }}</h4>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-xl-3 col-form-label">{{ _lang('Name') }}</label>
                        <div class="col-xl-9">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-form-label">{{ _lang('Email') }}</label>
                        <div class="col-xl-9">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                required>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-xl-3 col-form-label">{{ _lang('Account Number') }}</label>
                        <div class="col-xl-9">
                            <input type="text" class="form-control" name="account_number" value="{{ old('account_number', next_account_number()) }}"
                                required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-form-label">{{ _lang('Password') }}</label>
                        <div class="col-xl-9">
                            <input type="password" class="form-control" name="password" value="" required>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-xl-3 col-form-label">{{ _lang('Country Code') }}</label>
                        <div class="col-xl-9">
                            <select class="form-control select2 auto-select" data-selected="{{ old('country_code') }}" name="country_code" required>
                                <option value="">{{ _lang('Select One') }}</option>
                                @foreach(get_country_codes() as $key => $value)
                                <option value="{{ $value['dial_code'] }}">{{ $value['country'].' (+'.$value['dial_code'].')' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-xl-3 col-form-label">{{ _lang('Phone') }}</label>
                        <div class="col-xl-9">
                            <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-form-label">{{ _lang('Branch') }}</label>
                        <div class="col-xl-9">
                            <select class="form-control auto-select" data-selected="{{ old('branch_id') }}"
                                name="branch_id" required>
                                <option value="">{{ _lang('Select One') }}</option>
                                {{ create_option('branches','id','name') }}
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-xl-3 col-form-label">{{ _lang('Status') }}</label>
                        <div class="col-xl-9">
                            <select class="form-control auto-select" data-selected="{{ old('status') }}"
                                name="status" required>
                                <option value="">{{ _lang('Select One') }}</option>
                                <option value="1">{{ _lang('Active') }}</option>
                                <option value="0">{{ _lang('In Active') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-form-label">{{ _lang('Email Verified') }}</label>
                        <div class="col-xl-9">
                            <select class="form-control select2 auto-select" name="email_verified_at">
                                <option value="">{{ _lang('No') }}</option>
                                <option value="{{ now() }}">{{ _lang('Yes') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-form-label">{{ _lang('SMS Verified') }}</label>
                        <div class="col-xl-9">
                            <select class="form-control select2 auto-select" name="sms_verified_at">
                                <option value="">{{ _lang('No') }}</option>
                                <option value="{{ now() }}">{{ _lang('Yes') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-form-label">{{ _lang('Profile Picture') }}</label>
                        <div class="col-xl-9">
                            <input type="file" class="form-control dropify" name="profile_picture">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xl-9 offset-xl-3">
                            <button type="submit" class="btn btn-primary">{{ _lang('Create User') }}</button>
                        </div>
                    </div>
               
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">{{ _lang('Custom Fields') }}</h4>
                </div>
                <div class="card-body">
                @foreach($customFields as $form_field)
                    <div class="col-12">
                        <div class="form-group">
                            <label class="control-label">{{ $form_field->field_label }}</label>
                            {!! xss_clean(generate_input_field($form_field)) !!}
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</form>
@endsection