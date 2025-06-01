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
                                    
                                    <h6 class="py-4">{{ _lang('Reset Your Password') }}</h6> 

                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <form method="POST" class="form-signin" action="{{ route('password.email') }}" autocomplete="off">
                                        @csrf

                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="{{ _lang('Enter Your Email') }}" value="{{ old('email') }}" required>

                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-login btn-block">
                                                    {{ _lang('Submit') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 d-none d-md-block">
                            <div id="auth-bg" class="d-flex align-items-center justify-content-center">
                                <div class="px-5">
                                    <p class="mb-1 font-weight-light">{{ _lang('WELCOME TO') }}</p>
                                    <h2 class="font-weight-bold">{{ get_option('site_title', config('app.name')) }}</h2>

                                    <div class="divider"></div>

                                    <p>{{ _lang('Enter your registered email for getting password reset link') }}</p> 
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
