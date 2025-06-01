@extends('layouts.auth')

@section('content')
<div class="modern-auth-container">
    <div class="container-fluid p-0">
        <div class="row g-0 min-vh-100">
            <!-- Left Side - Visual Section -->
            <div class="col-lg-6 d-none d-lg-block">
                <div class="auth-visual-section">
                    <div class="overlay"></div>
                    <div class="content">
                        <h1 class="display-4 text-white mb-4">{{ _lang('Welcome Back!') }}</h1>
                        <p class="lead text-white-50 mb-5">{{ _lang('Login to access your account and manage your finances.') }}</p>
                        <div class="features">
                            <div class="feature-item">
                                <i class="fas fa-lock"></i>
                                <span>{{ _lang('Secure Login') }}</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-wallet"></i>
                                <span>{{ _lang('Manage Wallets') }}</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-exchange-alt"></i>
                                <span>{{ _lang('Easy Transactions') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Form Section -->
            <div class="col-lg-6 col-12">
                <div class="auth-form-wrapper">
                    <div class="auth-form-container">
                        <div class="auth-header">
                            <div class="logo-container">
                                <img class="modern-logo" src="{{ get_logo() }}" alt="Logo">
                            </div>
                            <h2 class="auth-title">{{ _lang('Login to Account') }}</h2>
                            <p class="auth-subtitle">{{ _lang('Enter your credentials to continue') }}</p>
                        </div>

                        @if(Session::has('error'))
                            <div class="modern-alert alert-error" data-aos="fade-in">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ session('error') }}</span>
                            </div>
                        @endif

                        @if(Session::has('registration_success'))
                            <div class="modern-alert alert-success" data-aos="fade-in">
                                <i class="fas fa-check-circle"></i>
                                <span>{{ session('registration_success') }}</span>
                            </div>
                        @endif

                        <form method="POST" class="modern-auth-form" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group-modern">
                                <label for="email" class="form-label">{{ _lang('Email Address') }}</label>
                                <input id="email" type="email" class="form-control-modern @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="error-message">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group-modern">
                                <label for="password" class="form-label">{{ _lang('Password') }}</label>
                                <input id="password" type="password" class="form-control-modern @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="error-message">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group-modern d-flex justify-content-between align-items-center">
                                <div class="modern-checkbox">
                                    <input class="modern-checkbox-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="modern-checkbox-label" for="remember">
                                        {{ _lang('Remember Me') }}
                                    </label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a class="terms-link" href="{{ route('password.request') }}">
                                        {{ _lang('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>

                            <div class="form-group-modern mt-4">
                                <button type="submit" class="btn-modern-primary w-100">
                                    {{ _lang('Login') }}
                                    <i class="fas fa-sign-in-alt"></i>
                                </button>
                            </div>

                            @if (Route::has('register'))
                                <div class="text-center mt-4">
                                    {{ _lang('Don\'t have an account?') }} <a class="terms-link" href="{{ route('register') }}">{{ _lang('Register Here') }}</a>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* General styles from register.blade.php */
.modern-auth-container {
    background: #f8f9fa;
    min-height: 100vh;
}

/* Visual Section Styles */
.auth-visual-section {
    position: relative;
    height: 100vh;
    background: url('/images/auth-bg.jpg') center/cover no-repeat;
    display: flex;
    align-items: center;
    padding: 3rem;
}

.auth-visual-section .overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.6) 100%);
}

.auth-visual-section .content {
    position: relative;
    z-index: 1;
    max-width: 500px;
}

.features {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
    margin-top: 3rem;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    color: white;
}

.feature-item i {
    font-size: 1.5rem;
    color: var(--accent-color);
}

/* Form Section Styles */
.auth-form-wrapper {
    height: 100vh;
    overflow-y: auto;
    background: white;
    padding: 2rem;
    display: flex;
    align-items: center;
}

.auth-form-container {
    max-width: 500px;
    margin: 0 auto;
    padding: 2rem;
    width: 100%; /* Added for responsiveness */
}

.auth-header {
    text-align: center;
    margin-bottom: 3rem;
}

.logo-container {
    margin-bottom: 2rem;
}

.modern-logo {
    max-height: 60px;
    width: auto;
}

.auth-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.auth-subtitle {
    color: #666;
    font-size: 1.1rem;
    margin-bottom: 2rem;
}

/* Form Styles */
.form-group-modern {
    margin-bottom: 1.5rem;
}

.form-control-modern {
    width: 100%;
    padding: 1rem 1.5rem;
    font-size: 1rem;
    border: 2px solid rgba(0, 0, 0, 0.1);
    border-radius: 12px;
    transition: all 0.3s ease;
    background: white;
}

.form-control-modern:focus {
    border-color: var(--accent-color);
    box-shadow: 0 0 0 4px rgba(101, 211, 147, 0.1);
    outline: none;
}

/* Error States */
.error-message {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-control-modern.is-invalid {
    border-color: #dc3545;
}

/* Button Styles */
.btn-modern-primary,
.btn-modern-secondary {
    padding: 1rem 2rem;
    font-size: 1rem;
    font-weight: 600;
    border-radius: 12px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
}

.btn-modern-primary {
    background: var(--accent-color);
    color: white;
}

.btn-modern-primary:hover {
    background: var(--primary-color);
    transform: translateY(-2px);
}

.btn-modern-secondary {
    background: #f8f9fa;
    color: #666;
}

.btn-modern-secondary:hover {
    background: #e9ecef;
}

/* Custom Checkbox */
.modern-checkbox {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
}

.modern-checkbox input {
    display: none;
}

.checkmark {
    width: 20px;
    height: 20px;
    border: 2px solid rgba(0, 0, 0, 0.1);
    border-radius: 4px;
    position: relative;
    transition: all 0.3s ease;
}

.modern-checkbox input:checked + .checkmark {
    background: var(--accent-color);
    border-color: var(--accent-color);
}

.checkmark:after {
    content: '';
    position: absolute;
    display: none;
    left: 6px;
    top: 2px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

.modern-checkbox input:checked + .checkmark:after {
    display: block;
}

/* Terms Links */
.terms-link {
    color: var(--accent-color);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.terms-link:hover {
    color: var(--primary-color);
    text-decoration: underline;
}

/* Animations */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive Styles */
@media (max-width: 991.98px) {
    .auth-form-wrapper {
        height: auto;
        min-height: 100vh;
    }
}

@media (max-width: 767.98px) {
    .auth-form-container {
        padding: 1rem;
    }

    .auth-title {
        font-size: 2rem;
    }

    .form-control-modern {
        padding: 0.875rem 1.25rem;
    }

    .btn-modern-primary,
    .btn-modern-secondary {
        padding: 0.875rem 1.5rem;
    }
}

/* Custom Scrollbar */
.auth-form-wrapper::-webkit-scrollbar {
    width: 8px;
}

.auth-form-wrapper::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.auth-form-wrapper::-webkit-scrollbar-thumb {
    background: var(--accent-color);
    border-radius: 4px;
}

.auth-form-wrapper::-webkit-scrollbar-thumb:hover {
    background: var(--primary-color);
}
</style>
@endsection
