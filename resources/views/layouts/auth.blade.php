<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ get_option('site_title', config('app.name')) }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ get_favicon() }}"/>

    <!-- Google font -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icofont Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icofont@1.0.1/dist/icofont.min.css">
    <!-- AOS Animation Library -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

    <!-- Styles -->
    <link href="{{ asset('public/auth/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/auth/css/app.css?v=1.2') }}" rel="stylesheet">

    <!-- Modern Auth Styles -->
    <style type="text/css">
        /* Modern Authentication Styles */
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        .modern-auth-container {
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }

        .modern-auth-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="10" cy="60" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="90" cy="40" r="0.5" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            pointer-events: none;
        }

        .modern-auth-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            overflow: hidden;
            position: relative;
            z-index: 2;
        }

        .auth-form-section {
            padding: 3rem;
            min-height: 600px;
            display: flex;
            align-items: center;
        }

        .auth-form-container {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo-container {
            margin-bottom: 1.5rem;
        }

        .modern-logo {
            max-height: 60px;
            width: auto;
        }

        .auth-title {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .auth-subtitle {
            color: #666;
            font-size: 1rem;
            margin: 0;
        }

        /* Modern Form Styles */
        .modern-auth-form {
            margin-bottom: 2rem;
        }

        .form-group-modern {
            margin-bottom: 1.5rem;
        }

        .input-group-modern {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            z-index: 2;
            font-size: 1.1rem;
        }

        .form-control-modern {
            width: 100%;
            padding: 16px 16px 16px 50px;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-size: 1rem;
            background: #fff;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-control-modern:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-control-modern.is-invalid {
            border-color: #e74c3c;
        }

        .floating-label {
            position: absolute;
            left: 50px;
            top: 16px;
            color: #999;
            font-size: 1rem;
            transition: all 0.3s ease;
            pointer-events: none;
            background: white;
            padding: 0 8px;
        }

        .form-control-modern:focus + .floating-label,
        .form-control-modern:not(:placeholder-shown) + .floating-label {
            top: -8px;
            left: 42px;
            font-size: 0.8rem;
            color: #667eea;
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #999;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #667eea;
        }

        .error-message {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #e74c3c;
            font-size: 0.85rem;
            margin-top: 8px;
        }

        .error-message i {
            font-size: 1rem;
        }

        /* Modern Alerts */
        .modern-alert {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        .alert-error {
            background: rgba(231, 76, 60, 0.1);
            border: 1px solid rgba(231, 76, 60, 0.2);
            color: #e74c3c;
        }

        .alert-success {
            background: rgba(39, 174, 96, 0.1);
            border: 1px solid rgba(39, 174, 96, 0.2);
            color: #27ae60;
        }

        /* Form Options */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .modern-checkbox {
            display: flex;
            align-items: center;
            cursor: pointer;
            user-select: none;
        }

        .modern-checkbox input {
            display: none;
        }

        .checkmark {
            width: 20px;
            height: 20px;
            border: 2px solid #e1e5e9;
            border-radius: 4px;
            margin-right: 12px;
            position: relative;
            transition: all 0.3s ease;
        }

        .modern-checkbox input:checked + .checkmark {
            background: #667eea;
            border-color: #667eea;
        }

        .modern-checkbox input:checked + .checkmark::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 12px;
            font-weight: bold;
        }

        .label-text {
            color: #666;
            font-size: 0.9rem;
        }

        .terms-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .terms-link:hover {
            color: #5a6fd8;
            text-decoration: underline;
        }

        .forgot-link {
            color: #667eea;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .forgot-link:hover {
            color: #5a6fd8;
            text-decoration: none;
        }

        /* Auth Buttons */
        .auth-buttons {
            margin-bottom: 2rem;
        }

        .btn-modern-primary {
            width: 100%;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
            color: white;
            padding: 16px 24px;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            transition: all 0.3s ease;
            cursor: pointer;
            margin-bottom: 1rem;
        }

        .btn-modern-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .signup-link {
            text-align: center;
            color: #666;
            font-size: 0.9rem;
        }

        .signup-btn {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            margin-left: 8px;
            transition: color 0.3s ease;
        }

        .signup-btn:hover {
            color: #5a6fd8;
            text-decoration: none;
        }

        /* Social Login */
        .social-login {
            margin-bottom: 2rem;
        }

        .divider-text {
            text-align: center;
            position: relative;
            margin-bottom: 1.5rem;
        }

        .divider-text::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e1e5e9;
        }

        .divider-text span {
            background: white;
            padding: 0 16px;
            color: #999;
            font-size: 0.85rem;
        }

        .social-buttons {
            display: flex;
            gap: 12px;
        }

        .btn-social {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 16px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-google {
            background: #fff;
            border: 2px solid #e1e5e9;
            color: #333;
        }

        .btn-google:hover {
            border-color: #db4437;
            color: #db4437;
            text-decoration: none;
        }

        .btn-facebook {
            background: #fff;
            border: 2px solid #e1e5e9;
            color: #333;
        }

        .btn-facebook:hover {
            border-color: #4267B2;
            color: #4267B2;
            text-decoration: none;
        }

        /* Auth Footer */
        .auth-footer {
            text-align: center;
            font-size: 0.85rem;
            color: #999;
        }

        .auth-footer a {
            color: #667eea;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .auth-footer a:hover {
            color: #5a6fd8;
            text-decoration: none;
        }

        .auth-footer span {
            margin: 0 8px;
        }

        /* Visual Section */
        .auth-visual-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 3rem;
            min-height: 600px;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .visual-content {
            position: relative;
            z-index: 2;
            color: white;
        }

        .welcome-text {
            margin-bottom: 3rem;
        }

        .welcome-text h3 {
            font-size: 1.2rem;
            font-weight: 400;
            margin-bottom: 0.5rem;
            opacity: 0.9;
        }

        .welcome-text h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .welcome-text p {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        .features-list {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .feature-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .feature-text h4 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .feature-text p {
            font-size: 0.9rem;
            opacity: 0.8;
            margin: 0;
            line-height: 1.5;
        }

        .floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .floating-card {
            position: absolute;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: white;
            font-size: 0.85rem;
            font-weight: 500;
            animation: floatAuth 6s ease-in-out infinite;
        }

        .floating-card i {
            font-size: 1.2rem;
        }

        .card-1 {
            top: 15%;
            right: 10%;
            animation-delay: 0s;
        }

        .card-2 {
            bottom: 25%;
            left: 5%;
            animation-delay: 2s;
        }

        .card-3 {
            top: 60%;
            right: 15%;
            animation-delay: 4s;
        }

        @keyframes floatAuth {
            0%, 100% { transform: translateY(0px) translateX(0px); }
            50% { transform: translateY(-15px) translateX(10px); }
        }

        /* Multi-Step Registration Form */
        .registration-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            padding: 0 1rem;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .step:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 15px;
            left: 60%;
            right: -40%;
            height: 2px;
            background: #e1e5e9;
            z-index: 1;
            transition: all 0.3s ease;
        }

        .step.active:not(:last-child)::after,
        .step.completed:not(:last-child)::after {
            background: #667eea;
        }

        .step-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #e1e5e9;
            color: #999;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .step.active .step-number {
            background: #667eea;
            color: white;
            transform: scale(1.1);
        }

        .step.completed .step-number {
            background: #27ae60;
            color: white;
        }

        .step.completed .step-number::after {
            content: '✓';
            position: absolute;
            font-size: 0.8rem;
        }

        .step-label {
            font-size: 0.8rem;
            color: #999;
            text-align: center;
            transition: all 0.3s ease;
        }

        .step.active .step-label {
            color: #667eea;
            font-weight: 600;
        }

        .step.completed .step-label {
            color: #27ae60;
        }

        /* Multi-Step Form */
        .multi-step-form {
            position: relative;
        }

        .form-step {
            display: none;
            animation: fadeInStep 0.5s ease-in-out;
        }

        .form-step.active {
            display: block;
        }

        @keyframes fadeInStep {
            from {
                opacity: 0;
                transform: translateX(20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .step-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .section-subtitle {
            font-size: 1rem;
            font-weight: 600;
            color: #667eea;
            margin: 1.5rem 0 1rem 0;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #f0f0f0;
        }

        /* Form Navigation */
        .form-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 2rem;
            gap: 1rem;
        }

        .btn-modern-secondary {
            background: transparent;
            border: 2px solid #e1e5e9;
            color: #666;
            padding: 12px 24px;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-modern-secondary:hover {
            border-color: #667eea;
            color: #667eea;
            transform: translateY(-2px);
        }

        /* Employment Fields Toggle */
        .employment-fields {
            transition: all 0.3s ease;
        }

        .employment-fields.show {
            display: block !important;
        }

        /* Enhanced Form Controls for Multi-Step */
        .form-control-modern[type="date"] {
            color: #333;
        }

        .form-control-modern[type="date"]::-webkit-calendar-picker-indicator {
            color: #667eea;
            cursor: pointer;
        }

        textarea.form-control-modern {
            min-height: 80px;
            resize: vertical;
            padding-top: 16px;
        }

        textarea.form-control-modern + .floating-label {
            top: 16px;
        }

        textarea.form-control-modern:focus + .floating-label,
        textarea.form-control-modern:not(:placeholder-shown) + .floating-label {
            top: -8px;
        }

        /* Progress Indicator */
        .form-progress {
            position: absolute;
            top: 0;
            left: 0;
            height: 4px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        /* Step Validation */
        .form-step.has-errors {
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        /* Responsive Design */
        @media (max-width: 991px) {
            .auth-form-section {
                padding: 2rem;
            }

            .welcome-text h1 {
                font-size: 2rem;
            }

            .features-list {
                gap: 1.5rem;
            }

            .registration-steps {
                padding: 0;
            }

            .step-label {
                font-size: 0.7rem;
            }

            .form-navigation {
                flex-direction: column;
            }

            .btn-modern-secondary,
            .btn-modern-primary {
                width: 100%;
                justify-content: center;
            }
        }

        /* Loan Management Styles */
        .loan-item {
            background: #f8f9fa;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            position: relative;
            transition: all 0.3s ease;
        }

        .loan-item:hover {
            border-color: #667eea;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.1);
        }

        .loan-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #e1e5e9;
        }

        .loan-header h5 {
            margin: 0;
            color: #333;
            font-weight: 600;
        }

        .btn-remove-loan {
            background: #e74c3c;
            border: none;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-remove-loan:hover {
            background: #c0392b;
            transform: scale(1.1);
        }

        .loan-actions {
            text-align: center;
            margin: 1.5rem 0;
        }

        .btn-add-loan {
            background: transparent;
            border: 2px dashed #667eea;
            color: #667eea;
            padding: 12px 24px;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-add-loan:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }

        /* Financial Fields Styling */
        .secondary-bank-fields,
        .mobile-money-fields,
        .existing-loans-section {
            margin-top: 1rem;
            padding: 1rem;
            background: rgba(102, 126, 234, 0.05);
            border-radius: 12px;
            border: 1px solid rgba(102, 126, 234, 0.1);
            transition: all 0.3s ease;
        }

        .secondary-bank-fields.show,
        .mobile-money-fields.show,
        .existing-loans-section.show {
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Enhanced checkbox styling for financial options */
        .modern-checkbox input:checked + .checkmark {
            background: #667eea;
            border-color: #667eea;
            animation: checkboxPulse 0.3s ease;
        }

        @keyframes checkboxPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        /* Financial summary cards */
        .financial-summary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem;
            border-radius: 12px;
            margin-top: 1rem;
        }

        .financial-summary h6 {
            margin: 0 0 0.5rem 0;
            font-weight: 600;
        }

        .financial-summary .amount {
            font-size: 1.2rem;
            font-weight: 700;
        }

        /* Expense Category Styles */
        .expense-intro {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 2rem;
            text-align: center;
            font-style: italic;
        }

        .expense-category {
            background: #f8f9fa;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .expense-category:hover {
            border-color: #667eea;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.1);
        }

        .expense-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #e1e5e9;
        }

        .expense-header h5 {
            margin: 0;
            color: #333;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .expense-header h5 i {
            color: #667eea;
            font-size: 1.2rem;
        }

        .expense-header small {
            color: #666;
            font-size: 0.8rem;
        }

        .expense-amount, .expense-range {
            transition: all 0.3s ease;
        }

        .expense-amount:focus, .expense-range:focus {
            border-color: #667eea !important;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25) !important;
        }

        /* Expense Summary Card */
        .expense-summary-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            border-radius: 15px;
            margin-top: 2rem;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .expense-summary-card h5 {
            margin: 0 0 1.5rem 0;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .expense-summary-card h5 i {
            font-size: 1.3rem;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding: 0.5rem 0;
        }

        .summary-item .label {
            font-weight: 500;
            opacity: 0.9;
        }

        .summary-item .amount {
            font-size: 1.3rem;
            font-weight: 700;
        }

        .expense-ratio {
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .expense-ratio .label {
            font-weight: 500;
            margin-right: 10px;
        }

        .expense-ratio .ratio {
            font-size: 1.1rem;
            font-weight: 700;
        }

        .ratio-bar {
            width: 100%;
            height: 8px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
            margin-top: 8px;
            overflow: hidden;
        }

        .ratio-fill {
            height: 100%;
            background: #fff;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .ratio-fill.warning {
            background: #f39c12;
        }

        .ratio-fill.danger {
            background: #e74c3c;
        }

        /* Expense validation indicators */
        .expense-category.valid {
            border-color: #27ae60;
        }

        .expense-category.invalid {
            border-color: #e74c3c;
        }

        .expense-validation {
            margin-top: 0.5rem;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .expense-validation.valid {
            color: #27ae60;
        }

        .expense-validation.invalid {
            color: #e74c3c;
        }

        .expense-validation i {
            font-size: 0.9rem;
        }

        /* Responsive adjustments for expense categories */
        @media (max-width: 768px) {
            .expense-category {
                padding: 1rem;
            }

            .expense-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }

            .expense-summary-card {
                padding: 1.5rem;
            }

            .summary-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
        }

        /* Document Upload Styles */
        .document-intro, .consent-intro {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 2rem;
            text-align: center;
            font-style: italic;
        }

        .document-category {
            background: #f8f9fa;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .document-category:hover {
            border-color: #667eea;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.1);
        }

        .document-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .document-header h5 {
            margin: 0;
            color: #333;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .document-header h5 i {
            color: #667eea;
            font-size: 1.2rem;
        }

        .required-badge {
            background: #e74c3c;
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .optional-badge {
            background: #95a5a6;
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .document-description {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .document-upload-area {
            position: relative;
            border: 2px dashed #e1e5e9;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            background: white;
        }

        .document-upload-area:hover {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.02);
        }

        .document-upload-area.dragover {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.1);
        }

        .document-input {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .upload-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            cursor: pointer;
            margin: 0;
        }

        .upload-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .upload-label:hover .upload-icon {
            transform: scale(1.1);
        }

        .upload-text {
            text-align: center;
        }

        .upload-title {
            display: block;
            font-weight: 600;
            color: #333;
            margin-bottom: 4px;
        }

        .upload-subtitle {
            display: block;
            font-size: 0.8rem;
            color: #666;
        }

        .upload-progress {
            margin-top: 1rem;
        }

        .progress-bar {
            width: 100%;
            height: 6px;
            background: #e1e5e9;
            border-radius: 3px;
            overflow: hidden;
        }

        .progress-bar::after {
            content: '';
            display: block;
            height: 100%;
            background: linear-gradient(90deg, #667eea, #764ba2);
            width: 0%;
            transition: width 0.3s ease;
            animation: progressAnimation 2s infinite;
        }

        @keyframes progressAnimation {
            0% { width: 0%; }
            50% { width: 70%; }
            100% { width: 100%; }
        }

        .upload-success {
            color: #27ae60;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 1rem;
        }

        .upload-success i {
            font-size: 1.2rem;
        }

        /* Document Summary Card */
        .document-summary-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            border-radius: 15px;
            margin-top: 2rem;
        }

        .document-summary-card h5 {
            margin: 0 0 1.5rem 0;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .document-checklist {
            margin-bottom: 1.5rem;
        }

        .checklist-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 0.5rem;
            padding: 0.5rem 0;
        }

        .checklist-item i {
            font-size: 1.1rem;
        }

        .checklist-item.completed i {
            color: #27ae60;
        }

        .checklist-item.optional i {
            color: #95a5a6;
        }

        .upload-progress-summary {
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            padding-top: 1rem;
        }

        .progress-text {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .progress-bar-summary {
            width: 100%;
            height: 8px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: #fff;
            border-radius: 4px;
            transition: width 0.3s ease;
        }

        /* Consent Sections */
        .consent-section {
            background: #f8f9fa;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .consent-section:hover {
            border-color: #667eea;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.1);
        }

        .consent-header h5 {
            margin: 0 0 1rem 0;
            color: #333;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .consent-header h5 i {
            color: #667eea;
            font-size: 1.2rem;
        }

        .consent-content p {
            color: #555;
            margin-bottom: 1rem;
        }

        .consent-list {
            list-style: none;
            padding: 0;
            margin: 0 0 1.5rem 0;
        }

        .consent-list li {
            position: relative;
            padding-left: 1.5rem;
            margin-bottom: 0.5rem;
            color: #666;
        }

        .consent-list li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #27ae60;
            font-weight: bold;
        }

        .consent-checkbox {
            background: white;
            padding: 1rem;
            border-radius: 8px;
            border: 1px solid #e1e5e9;
        }

        /* Digital Signature */
        .signature-area {
            background: white;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
        }

        #signature-canvas {
            border: 1px solid #ddd;
            border-radius: 8px;
            cursor: crosshair;
            background: white;
            max-width: 100%;
            height: auto;
        }

        .signature-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
        }

        .btn-clear {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 0.9rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s ease;
        }

        .btn-clear:hover {
            background: #c0392b;
            transform: translateY(-1px);
        }

        .signature-instruction {
            color: #666;
            font-size: 0.9rem;
            font-style: italic;
        }

        /* Responsive adjustments for documents */
        @media (max-width: 768px) {
            .document-category, .consent-section {
                padding: 1rem;
            }

            .document-upload-area {
                padding: 1.5rem;
            }

            .upload-icon {
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
            }

            .document-summary-card {
                padding: 1.5rem;
            }

            #signature-canvas {
                width: 100%;
                height: 120px;
            }

            .signature-controls {
                flex-direction: column;
                gap: 10px;
            }
        }

        @media (max-width: 576px) {
            .auth-form-section {
                padding: 1.5rem;
            }

            .auth-title {
                font-size: 1.5rem;
            }

            .form-options {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .social-buttons {
                flex-direction: column;
            }
        }

        /* Legacy styles for compatibility */
        @php $bgColor = get_option('auth_bg_color_2','#0b2559'); @endphp
        .area{
            background: {{ $bgColor }};
            background: -webkit-linear-gradient(to left, {{ get_option('auth_bg_color_1','#26437e') }}, {{ get_option('auth_bg_color_2','#0b2559') }});
            background: linear-gradient(to left, {{ get_option('auth_bg_color_1','#26437e') }}, {{ get_option('auth_bg_color_2','#0b2559') }});
        }
        @php $bgImage = get_option('auth_bg_image') == '' ? asset('public/auth/images/auth-bg.jpg') : asset('public/uploads/media/'.get_option('auth_bg_image')); @endphp
        #auth-bg{background: url({{ $bgImage }}) no-repeat;}

        #auth-bg::after {background: {{ hex2rgba($bgColor, 0.9) }};}
    </style>
</head>
<body>
    <div class="area" >
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>

    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation Library -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <!-- Modern Auth JavaScript -->
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });

        // Password toggle functionality
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const eye = document.getElementById(inputId + '-eye');

            if (input.type === 'password') {
                input.type = 'text';
                eye.className = 'icofont-eye-blocked';
            } else {
                input.type = 'password';
                eye.className = 'icofont-eye';
            }
        }

        // Enhanced form interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Add focus/blur effects to form inputs
            const inputs = document.querySelectorAll('.form-control-modern');

            inputs.forEach(input => {
                // Handle floating labels
                const updateLabel = () => {
                    const label = input.nextElementSibling;
                    if (label && label.classList.contains('floating-label')) {
                        if (input.value || input === document.activeElement) {
                            label.style.top = '-8px';
                            label.style.fontSize = '0.8rem';
                            label.style.color = '#667eea';
                        } else {
                            label.style.top = '16px';
                            label.style.fontSize = '1rem';
                            label.style.color = '#999';
                        }
                    }
                };

                input.addEventListener('focus', updateLabel);
                input.addEventListener('blur', updateLabel);
                input.addEventListener('input', updateLabel);

                // Initial check
                updateLabel();
            });

            // Add ripple effect to buttons
            const buttons = document.querySelectorAll('.btn-modern-primary, .btn-social');

            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;

                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.classList.add('ripple');

                    this.appendChild(ripple);

                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });

            // Form validation enhancements
            const forms = document.querySelectorAll('.modern-auth-form');

            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const submitBtn = this.querySelector('.btn-modern-primary');
                    if (submitBtn) {
                        submitBtn.innerHTML = '<i class="icofont-spinner-alt-3 icofont-spin"></i> <span>Processing...</span>';
                        submitBtn.disabled = true;
                    }
                });
            });

            // Add smooth transitions for error messages
            const errorMessages = document.querySelectorAll('.error-message');
            errorMessages.forEach(error => {
                error.style.opacity = '0';
                error.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    error.style.transition = 'all 0.3s ease';
                    error.style.opacity = '1';
                    error.style.transform = 'translateY(0)';
                }, 100);
            });
        });
    </script>

    <!-- Add ripple effect CSS -->
    <style>
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        .btn-modern-primary, .btn-social {
            position: relative;
            overflow: hidden;
        }

        .icofont-spin {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>

	@yield('js-script')
</body>
</html>
