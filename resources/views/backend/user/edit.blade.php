@extends('layouts.app')

@section('content')
<form method="post" class="validate" autocomplete="off" action="{{ action('UserController@update', $id) }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">{{ _lang('Update User') }}</h4>
                </div>
                <div class="card-body">
                    <input name="_method" type="hidden" value="PATCH">
                    <div class="form-group row">
                        <label class="col-xl-3 col-form-label">{{ _lang('Name') }}</label>
                        <div class="col-xl-9">
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}"
                                required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-form-label">{{ _lang('Email') }}</label>
                        <div class="col-xl-9">
                            <input type="text" class="form-control" name="email" value="{{ $user->email }}"
                                required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-form-label">{{ _lang('Account Number') }}</label>
                        <div class="col-xl-9">
                            <input type="text" class="form-control" name="account_number" value="{{ $user->account_number }}"
                                required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-form-label">{{ _lang('Password') }}</label>
                        <div class="col-xl-9">
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-form-label">{{ _lang('Country Code') }}</label>
                        <div class="col-xl-9">
                            <select class="form-control select2 auto-select" data-selected="{{ $user->country_code }}" name="country_code" required>
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
                            <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-form-label">{{ _lang('Branch') }}</label>
                        <div class="col-xl-9">
                            <select class="form-control auto-select" data-selected="{{ $user->branch_id }}"
                                name="branch_id">
                                <option value="">{{ _lang('Select One') }}</option>
                                {{ create_option('branches','id','name') }}
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-xl-3 col-form-label">{{ _lang('Status') }}</label>
                        <div class="col-xl-9">
                            <select class="form-control auto-select" data-selected="{{ $user->status }}"
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
                            <select class="form-control select2 auto-select" data-selected="{{ $user->email_verified_at }}" name="email_verified_at">
                                <option value="">{{ _lang('No') }}</option>
                                <option value="{{ $user->email_verified_at != null ? $user->email_verified_at : now() }}">{{ _lang('Yes') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-form-label">{{ _lang('SMS Verified') }}</label>
                        <div class="col-xl-9">
                            <select class="form-control select2 auto-select" data-selected="{{ $user->sms_verified_at }}" name="sms_verified_at">
                                <option value="">{{ _lang('No') }}</option>
                                <option value="{{ $user->sms_verified_at != null ? $user->sms_verified_at : now() }}">{{ _lang('Yes') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-form-label">{{ _lang('Withdraw Money') }}</label>
                        <div class="col-xl-9">
                            <select class="form-control auto-select" data-selected="{{ $user->allow_withdrawal }}" name="allow_withdrawal" required>
                                <option value="1">{{ _lang('Allowed') }}</option>
                                <option value="0">{{ _lang('Not Allowed') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-form-label">{{ _lang('Profile Picture') }}</label>
                        <div class="col-xl-9">
                            <input type="file" class="form-control dropify" name="profile_picture" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" data-default-file="{{ profile_picture($user->profile_picture) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xl-9 offset-xl-3">
                            <button type="submit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{ _lang('Update User') }}</button>
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
                @php $customFieldsData = json_decode($user->custom_fields, true); @endphp
                @foreach($customFields as $form_field)
                    <div class="col-12">
                        <div class="form-group">
                            <label class="control-label">{{ $form_field->field_label }}</label>
                            {!! xss_clean(generate_input_field($form_field, $customFieldsData[$form_field->field_name]['field_value'] ?? null)) !!}
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</form>
@endsection