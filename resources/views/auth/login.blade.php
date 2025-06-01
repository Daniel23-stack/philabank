@extends('layouts.auth')

@section('content')
<div class="modern-auth-container">
    <div class="container">
        <div class="row min-vh-100 align-items-center">
            <div class="col-lg-10 offset-lg-1">
                <div class="modern-auth-card" data-aos="fade-up" data-aos-duration="800">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="auth-form-section">
                                <div class="auth-form-container" data-aos="fade-right" data-aos-delay="200">
                                    <div class="auth-header">
                                        <div class="logo-container">
                                            <img class="modern-logo" src="{{ get_logo() }}" alt="Logo">
                                        </div>
                                        <h2 class="auth-title">{{ _lang('Welcome Back') }}</h2>
                                        <p class="auth-subtitle">{{ _lang('Sign in to your account to continue') }}</p>
                                    </div>

                                    @if(Session::has('error'))
                                        <div class="modern-alert alert-error" data-aos="fade-in">
                                            <i class="icofont-warning"></i>
                                            <span>{{ session('error') }}</span>
                                        </div>
                                    @endif

                                    @if(Session::has('registration_success'))
                                        <div class="modern-alert alert-success" data-aos="fade-in">
                                            <i class="icofont-check-circled"></i>
                                            <span>{{ session('registration_success') }}</span>
                                        </div>
                                    @endif

                                    <form method="POST" class="modern-auth-form" action="{{ route('login') }}">
                                        @csrf

                                        <div class="form-group-modern" data-aos="fade-up" data-aos-delay="300">
                                            <div class="input-group-modern">
                                                <div class="input-icon">
                                                    <i class="icofont-email"></i>
                                                </div>
                                                <input id="email" type="email"
                                                       class="form-control-modern{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                       name="email" value="{{ old('email') }}" required autofocus>
                                                <label class="floating-label">{{ _lang('Email Address') }}</label>
                                            </div>
                                            @if ($errors->has('email'))
                                                <div class="error-message">
                                                    <i class="icofont-warning"></i>
                                                    <span>{{ $errors->first('email') }}</span>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="form-group-modern" data-aos="fade-up" data-aos-delay="400">
                                            <div class="input-group-modern">
                                                <div class="input-icon">
                                                    <i class="icofont-lock"></i>
                                                </div>
                                                <input id="password" type="password"
                                                       class="form-control-modern{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                       name="password" required>
                                                <label class="floating-label">{{ _lang('Password') }}</label>
                                                <div class="password-toggle" onclick="togglePassword('password')">
                                                    <i class="icofont-eye" id="password-eye"></i>
                                                </div>
                                            </div>
                                            @if ($errors->has('password'))
                                                <div class="error-message">
                                                    <i class="icofont-warning"></i>
                                                    <span>{{ $errors->first('password') }}</span>
                                                </div>
                                            @endif
                                        </div>

                                        @if(get_option('enable_recaptcha', 0) == 1)
                                        <div class="form-group-modern">
                                            <input type="hidden" name="g-recaptcha-response" id="recaptcha">
                                            @if ($errors->has('g-recaptcha-response'))
                                                <div class="error-message">
                                                    <i class="icofont-warning"></i>
                                                    <span>{{ $errors->first('g-recaptcha-response') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        @endif

                                        <div class="form-options" data-aos="fade-up" data-aos-delay="500">
                                            <div class="remember-me">
                                                <label class="modern-checkbox">
                                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <span class="checkmark"></span>
                                                    <span class="label-text">{{ _lang('Remember Me') }}</span>
                                                </label>
                                            </div>
                                            <div class="forgot-password">
                                                <a href="{{ route('password.request') }}" class="forgot-link">
                                                    {{ _lang('Forgot Password?') }}
                                                </a>
                                            </div>
                                        </div>

                                        <div class="auth-buttons" data-aos="fade-up" data-aos-delay="600">
                                            <button type="submit" class="btn-modern-primary">
                                                <span>{{ _lang('Sign In') }}</span>
                                                <i class="icofont-arrow-right"></i>
                                            </button>

                                            @if(get_option('allow_singup') == 'yes')
                                            <div class="signup-link">
                                                <span>{{ _lang("Don't have an account?") }}</span>
                                                <a href="{{ route('register') }}" class="signup-btn">
                                                    {{ _lang('Create Account') }}
                                                </a>
                                            </div>
                                            @endif
                                        </div>

                                        @if(get_option('google_login') == 'enabled' || get_option('facebook_login') == 'enabled')
                                        <div class="social-login" data-aos="fade-up" data-aos-delay="700">
                                            <div class="divider-text">
                                                <span>{{ _lang('Or continue with') }}</span>
                                            </div>
                                            <div class="social-buttons">
                                                @if(get_option('google_login') == 'enabled')
                                                <a href="{{ url('/login/google') }}" class="btn-social btn-google">
                                                    <i class="icofont-google-plus"></i>
                                                    <span>Google</span>
                                                </a>
                                                @endif
                                                @if(get_option('facebook_login') == 'enabled')
                                                <a href="{{ url('/login/facebook') }}" class="btn-social btn-facebook">
                                                    <i class="icofont-facebook"></i>
                                                    <span>Facebook</span>
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                    </form>

                                    <div class="auth-footer" data-aos="fade-up" data-aos-delay="800">
                                        @if(get_option('website_enable', 'yes') == 'yes')
                                        <a href="{{ url('/' . get_option('privacy_policy_page')) }}" target="_blank">{{ _lang('Privacy Policy') }}</a>
                                        <span>•</span>
                                        <a href="{{ url('/' . get_option('terms_condition_page')) }}" target="_blank">{{ _lang('Terms & Conditions') }}</a>
                                        @else
                                        <a href="{{ get_option('privacy_policy_page_url') }}" target="_blank">{{ _lang('Privacy Policy') }}</a>
                                        <span>•</span>
                                        <a href="{{ get_option('terms_condition_page_url') }}" target="_blank">{{ _lang('Terms & Conditions') }}</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 d-none d-lg-block">
                            <div class="auth-visual-section" data-aos="fade-left" data-aos-delay="400">
                                <div class="visual-content">
                                    <div class="welcome-text">
                                        <h3>{{ _lang('Welcome to') }}</h3>
                                        <h1>{{ get_option('site_title', config('app.name')) }}</h1>
                                        <p>{{ _lang('Secure, fast, and reliable banking at your fingertips') }}</p>
                                    </div>

                                    <div class="features-list">
                                        <div class="feature-item">
                                            <div class="feature-icon">
                                                <i class="icofont-shield-alt"></i>
                                            </div>
                                            <div class="feature-text">
                                                <h4>{{ _lang('Bank-Level Security') }}</h4>
                                                <p>{{ _lang('Your data is protected with 256-bit encryption') }}</p>
                                            </div>
                                        </div>
                                        <div class="feature-item">
                                            <div class="feature-icon">
                                                <i class="icofont-flash"></i>
                                            </div>
                                            <div class="feature-text">
                                                <h4>{{ _lang('Instant Transfers') }}</h4>
                                                <p>{{ _lang('Send money anywhere in seconds') }}</p>
                                            </div>
                                        </div>
                                        <div class="feature-item">
                                            <div class="feature-icon">
                                                <i class="icofont-support-faq"></i>
                                            </div>
                                            <div class="feature-text">
                                                <h4>{{ _lang('24/7 Support') }}</h4>
                                                <p>{{ _lang('Get help whenever you need it') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="floating-elements">
                                    <div class="floating-card card-1">
                                        <i class="icofont-credit-card"></i>
                                        <span>{{ _lang('Digital Wallet') }}</span>
                                    </div>
                                    <div class="floating-card card-2">
                                        <i class="icofont-chart-growth"></i>
                                        <span>{{ _lang('Investment') }}</span>
                                    </div>
                                    <div class="floating-card card-3">
                                        <i class="icofont-money"></i>
                                        <span>{{ _lang('Savings') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(get_option('enable_recaptcha', 0) == 1)
<script src="https://www.google.com/recaptcha/api.js?render={{ get_option('recaptcha_site_key') }}"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('{{ get_option('recaptcha_site_key') }}', {action: 'login'}).then(function(token) {
        if (token) {
            document.getElementById('recaptcha').value = token;
        }
        });
    });
</script>
@endif
@endsection
