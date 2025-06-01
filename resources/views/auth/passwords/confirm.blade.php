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
                                    
                                    <h6 class="py-4">{{ _lang('Please confirm your password before continuing.') }}</h6> 

                                    <form method="POST" action="{{ route('password.confirm') }}">
                                        @csrf

                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ _lang('Password') }}" required autocomplete="current-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-12 text-center">
                                                <button type="submit" class="btn btn-login btn-block">
                                                    {{ _lang('Confirm Password') }}
                                                </button>

                                                @if (Route::has('password.request'))
                                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                                        {{ _lang('Forgot Your Password?') }}
                                                    </a>
                                                @endif
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

                                    <h6>{{ _lang('Confirm Password') }}</h6> 
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
