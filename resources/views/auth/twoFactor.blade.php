@extends('layouts.auth')

@section('content')
<div class="auth-container d-md-flex align-items-center">
    <div class="container">
        <div class="row">
         <div class="col-md-12 col-lg-10 offset-lg-1">
                <div class="bg-white p-2">
                    <div class="row no-gutters">
                        <div class="col-md-6">
                            <div class="card card-signin">

                                <div class="card-body">
                                    
                                <img class="logo" src="{{ get_logo() }}">
                                    
                                    <h6 class="py-4">{{ _lang('One time password has been sent to your email address.') }}</h6> 

                                    @if(session()->has('message'))
                                        <p class="alert alert-info">
                                            {{ session()->get('message') }}
                                        </p>
                                    @endif

                                    <form method="POST" class="form-signin" action="{{ route('verify.store') }}" autocomplete="off">
                                        @csrf

                                        <div class="alert alert-info" role="alert">   
                                            {{ _lang('If you did not receive the email') }}
                                            <a href="{{ route('verify.resend') }}">{{ _lang('click here') }}</a>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input id="two_factor_code" type="text" class="form-control{{ $errors->has('two_factor_code') ? ' is-invalid' : '' }}" name="two_factor_code" placeholder="{{ _lang('Enter OTP') }}" required>

                                                @if ($errors->has('two_factor_code'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('two_factor_code') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-login btn-block">
                                                    {{ _lang('Verify') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 d-none d-md-block">
                            <div id="auth-bg" class="d-flex align-items-center justify-content-center">
                                <div>
                                    <p class="mb-1 font-weight-light">{{ _lang('WELCOME TO') }}</p>
                                    <h2 class="font-weight-bold">{{ get_option('site_title', config('app.name')) }}</h2>

                                    <div class="divider"></div>

                                    <h6>{{ _lang('2FA Verification') }}</h6> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection