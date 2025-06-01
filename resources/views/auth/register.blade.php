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
                                        <h2 class="auth-title">{{ _lang('Create Account') }}</h2>
                                        <p class="auth-subtitle">{{ _lang('Complete your profile for microloan eligibility') }}</p>

                                        <!-- Progress Steps -->
                                        <div class="registration-steps" data-aos="fade-up" data-aos-delay="100">
                                            <div class="step active" data-step="1">
                                                <div class="step-number">1</div>
                                                <div class="step-label">{{ _lang('Basic Info') }}</div>
                                            </div>
                                            <div class="step" data-step="2">
                                                <div class="step-number">2</div>
                                                <div class="step-label">{{ _lang('Personal Details') }}</div>
                                            </div>
                                            <div class="step" data-step="3">
                                                <div class="step-number">3</div>
                                                <div class="step-label">{{ _lang('Address & Contact') }}</div>
                                            </div>
                                            <div class="step" data-step="4">
                                                <div class="step-number">4</div>
                                                <div class="step-label">{{ _lang('Employment') }}</div>
                                            </div>
                                            <div class="step" data-step="5">
                                                <div class="step-number">5</div>
                                                <div class="step-label">{{ _lang('Financial Details') }}</div>
                                            </div>
                                            <div class="step" data-step="6">
                                                <div class="step-number">6</div>
                                                <div class="step-label">{{ _lang('Documents') }}</div>
                                            </div>
                                            <div class="step" data-step="7">
                                                <div class="step-number">7</div>
                                                <div class="step-label">{{ _lang('Consent') }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <form method="POST" class="modern-auth-form multi-step-form" action="{{ route('register') }}">
                                        @csrf

                                        <!-- Step 1: Basic Information -->
                                        <div class="form-step active" data-step="1">
                                            <h3 class="step-title">{{ _lang('Basic Information') }}</h3>

                                            <div class="form-group-modern" data-aos="fade-up" data-aos-delay="300">
                                                <div class="input-group-modern">
                                                    <div class="input-icon">
                                                        <i class="icofont-user"></i>
                                                    </div>
                                                    <input id="name" type="text"
                                                           class="form-control-modern{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                           name="name" value="{{ old('name') }}" required autofocus>
                                                    <label class="floating-label">{{ _lang('Full Name') }}</label>
                                                </div>
                                                @if ($errors->has('name'))
                                                    <div class="error-message">
                                                        <i class="icofont-warning"></i>
                                                        <span>{{ $errors->first('name') }}</span>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="form-group-modern" data-aos="fade-up" data-aos-delay="400">
                                                <div class="input-group-modern">
                                                    <div class="input-icon">
                                                        <i class="icofont-email"></i>
                                                    </div>
                                                    <input id="email" type="email"
                                                           class="form-control-modern{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                           name="email" value="{{ old('email') }}" required>
                                                    <label class="floating-label">{{ _lang('Email Address') }}</label>
                                                </div>
                                                @if ($errors->has('email'))
                                                    <div class="error-message">
                                                        <i class="icofont-warning"></i>
                                                        <span>{{ $errors->first('email') }}</span>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="row" data-aos="fade-up" data-aos-delay="500">
                                                <div class="col-md-5">
                                                    <div class="form-group-modern">
                                                        <div class="input-group-modern">
                                                            <div class="input-icon">
                                                                <i class="icofont-flag"></i>
                                                            </div>
                                                            <select class="form-control-modern" name="country_code" required>
                                                                <option value="">{{ _lang('Country') }}</option>
                                                                @foreach(get_country_codes() as $key => $value)
                                                                <option value="{{ $value['dial_code'] }}" {{ old('country_code') == $value['dial_code'] ? 'selected' : '' }}>
                                                                    {{ $value['country'].' (+'.$value['dial_code'].')' }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="form-group-modern">
                                                        <div class="input-group-modern">
                                                            <div class="input-icon">
                                                                <i class="icofont-phone"></i>
                                                            </div>
                                                            <input id="phone" type="text"
                                                                   class="form-control-modern{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                                   name="phone" value="{{ old('phone') }}" required>
                                                            <label class="floating-label">{{ _lang('Phone Number') }}</label>
                                                        </div>
                                                        @if ($errors->has('phone'))
                                                            <div class="error-message">
                                                                <i class="icofont-warning"></i>
                                                                <span>{{ $errors->first('phone') }}</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group-modern" data-aos="fade-up" data-aos-delay="600">
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

                                            <div class="form-group-modern" data-aos="fade-up" data-aos-delay="700">
                                                <div class="input-group-modern">
                                                    <div class="input-icon">
                                                        <i class="icofont-lock"></i>
                                                    </div>
                                                    <input id="password-confirm" type="password" class="form-control-modern"
                                                           name="password_confirmation" required>
                                                    <label class="floating-label">{{ _lang('Confirm Password') }}</label>
                                                    <div class="password-toggle" onclick="togglePassword('password-confirm')">
                                                        <i class="icofont-eye" id="password-confirm-eye"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Step 2: Personal Details -->
                                        <div class="form-step" data-step="2">
                                            <h3 class="step-title">{{ _lang('Personal Details') }}</h3>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group-modern">
                                                        <div class="input-group-modern">
                                                            <div class="input-icon">
                                                                <i class="icofont-id-card"></i>
                                                            </div>
                                                            <select class="form-control-modern" name="identity_type" required>
                                                                <option value="">{{ _lang('ID Type') }}</option>
                                                                <option value="national_id" {{ old('identity_type') == 'national_id' ? 'selected' : '' }}>{{ _lang('National ID') }}</option>
                                                                <option value="passport" {{ old('identity_type') == 'passport' ? 'selected' : '' }}>{{ _lang('Passport') }}</option>
                                                                <option value="drivers_license" {{ old('identity_type') == 'drivers_license' ? 'selected' : '' }}>{{ _lang('Driver\'s License') }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group-modern">
                                                        <div class="input-group-modern">
                                                            <div class="input-icon">
                                                                <i class="icofont-id"></i>
                                                            </div>
                                                            <input type="text" class="form-control-modern" name="identity_number"
                                                                   value="{{ old('identity_number') }}" required>
                                                            <label class="floating-label">{{ _lang('ID Number') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group-modern">
                                                        <div class="input-group-modern">
                                                            <div class="input-icon">
                                                                <i class="icofont-calendar"></i>
                                                            </div>
                                                            <input type="date" class="form-control-modern" name="date_of_birth"
                                                                   value="{{ old('date_of_birth') }}" required>
                                                            <label class="floating-label">{{ _lang('Date of Birth') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group-modern">
                                                        <div class="input-group-modern">
                                                            <div class="input-icon">
                                                                <i class="icofont-users"></i>
                                                            </div>
                                                            <select class="form-control-modern" name="gender">
                                                                <option value="">{{ _lang('Gender') }}</option>
                                                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>{{ _lang('Male') }}</option>
                                                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>{{ _lang('Female') }}</option>
                                                                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>{{ _lang('Other') }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group-modern">
                                                <div class="input-group-modern">
                                                    <div class="input-icon">
                                                        <i class="icofont-globe"></i>
                                                    </div>
                                                    <input type="text" class="form-control-modern" name="nationality"
                                                           value="{{ old('nationality') }}">
                                                    <label class="floating-label">{{ _lang('Nationality') }}</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Step 3: Address & Contact -->
                                        <div class="form-step" data-step="3">
                                            <h3 class="step-title">{{ _lang('Address & Contact Information') }}</h3>

                                            <div class="form-group-modern">
                                                <div class="input-group-modern">
                                                    <div class="input-icon">
                                                        <i class="icofont-location-pin"></i>
                                                    </div>
                                                    <textarea class="form-control-modern" name="residential_address" rows="3"
                                                              required>{{ old('residential_address') }}</textarea>
                                                    <label class="floating-label">{{ _lang('Residential Address') }}</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group-modern">
                                                        <div class="input-group-modern">
                                                            <div class="input-icon">
                                                                <i class="icofont-building"></i>
                                                            </div>
                                                            <input type="text" class="form-control-modern" name="city"
                                                                   value="{{ old('city') }}" required>
                                                            <label class="floating-label">{{ _lang('City') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group-modern">
                                                        <div class="input-group-modern">
                                                            <div class="input-icon">
                                                                <i class="icofont-map"></i>
                                                            </div>
                                                            <input type="text" class="form-control-modern" name="state_province"
                                                                   value="{{ old('state_province') }}">
                                                            <label class="floating-label">{{ _lang('State/Province') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group-modern">
                                                        <div class="input-group-modern">
                                                            <div class="input-icon">
                                                                <i class="icofont-envelope"></i>
                                                            </div>
                                                            <input type="text" class="form-control-modern" name="postal_code"
                                                                   value="{{ old('postal_code') }}">
                                                            <label class="floating-label">{{ _lang('Postal Code') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group-modern">
                                                        <div class="input-group-modern">
                                                            <div class="input-icon">
                                                                <i class="icofont-flag"></i>
                                                            </div>
                                                            <input type="text" class="form-control-modern" name="country"
                                                                   value="{{ old('country') }}" required>
                                                            <label class="floating-label">{{ _lang('Country') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group-modern">
                                                <div class="input-group-modern">
                                                    <div class="input-icon">
                                                        <i class="icofont-phone"></i>
                                                    </div>
                                                    <input type="text" class="form-control-modern" name="alternative_phone"
                                                           value="{{ old('alternative_phone') }}">
                                                    <label class="floating-label">{{ _lang('Alternative Phone') }}</label>
                                                </div>
                                            </div>

                                            <h4 class="section-subtitle">{{ _lang('Emergency Contact') }}</h4>

                                            <div class="form-group-modern">
                                                <div class="input-group-modern">
                                                    <div class="input-icon">
                                                        <i class="icofont-user-alt-3"></i>
                                                    </div>
                                                    <input type="text" class="form-control-modern" name="emergency_contact_name"
                                                           value="{{ old('emergency_contact_name') }}" required>
                                                    <label class="floating-label">{{ _lang('Emergency Contact Name') }}</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group-modern">
                                                        <div class="input-group-modern">
                                                            <div class="input-icon">
                                                                <i class="icofont-phone"></i>
                                                            </div>
                                                            <input type="text" class="form-control-modern" name="emergency_contact_phone"
                                                                   value="{{ old('emergency_contact_phone') }}" required>
                                                            <label class="floating-label">{{ _lang('Emergency Contact Phone') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group-modern">
                                                        <div class="input-group-modern">
                                                            <div class="input-icon">
                                                                <i class="icofont-heart"></i>
                                                            </div>
                                                            <select class="form-control-modern" name="emergency_contact_relationship" required>
                                                                <option value="">{{ _lang('Relationship') }}</option>
                                                                <option value="spouse" {{ old('emergency_contact_relationship') == 'spouse' ? 'selected' : '' }}>{{ _lang('Spouse') }}</option>
                                                                <option value="parent" {{ old('emergency_contact_relationship') == 'parent' ? 'selected' : '' }}>{{ _lang('Parent') }}</option>
                                                                <option value="sibling" {{ old('emergency_contact_relationship') == 'sibling' ? 'selected' : '' }}>{{ _lang('Sibling') }}</option>
                                                                <option value="child" {{ old('emergency_contact_relationship') == 'child' ? 'selected' : '' }}>{{ _lang('Child') }}</option>
                                                                <option value="friend" {{ old('emergency_contact_relationship') == 'friend' ? 'selected' : '' }}>{{ _lang('Friend') }}</option>
                                                                <option value="other" {{ old('emergency_contact_relationship') == 'other' ? 'selected' : '' }}>{{ _lang('Other') }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Step 4: Employment Information -->
                                        <div class="form-step" data-step="4">
                                            <h3 class="step-title">{{ _lang('Employment & Financial Information') }}</h3>

                                            <div class="form-group-modern">
                                                <div class="input-group-modern">
                                                    <div class="input-icon">
                                                        <i class="icofont-briefcase"></i>
                                                    </div>
                                                    <select class="form-control-modern" name="employment_status" required>
                                                        <option value="">{{ _lang('Employment Status') }}</option>
                                                        <option value="employed" {{ old('employment_status') == 'employed' ? 'selected' : '' }}>{{ _lang('Employed') }}</option>
                                                        <option value="self_employed" {{ old('employment_status') == 'self_employed' ? 'selected' : '' }}>{{ _lang('Self Employed') }}</option>
                                                        <option value="unemployed" {{ old('employment_status') == 'unemployed' ? 'selected' : '' }}>{{ _lang('Unemployed') }}</option>
                                                        <option value="student" {{ old('employment_status') == 'student' ? 'selected' : '' }}>{{ _lang('Student') }}</option>
                                                        <option value="retired" {{ old('employment_status') == 'retired' ? 'selected' : '' }}>{{ _lang('Retired') }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="employment-fields" style="display: none;">
                                                <div class="form-group-modern">
                                                    <div class="input-group-modern">
                                                        <div class="input-icon">
                                                            <i class="icofont-building-alt"></i>
                                                        </div>
                                                        <input type="text" class="form-control-modern" name="employer_name"
                                                               value="{{ old('employer_name') }}">
                                                        <label class="floating-label">{{ _lang('Employer Name') }}</label>
                                                    </div>
                                                </div>

                                                <div class="form-group-modern">
                                                    <div class="input-group-modern">
                                                        <div class="input-icon">
                                                            <i class="icofont-location-pin"></i>
                                                        </div>
                                                        <textarea class="form-control-modern" name="employer_address" rows="2">{{ old('employer_address') }}</textarea>
                                                        <label class="floating-label">{{ _lang('Employer Address') }}</label>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group-modern">
                                                            <div class="input-group-modern">
                                                                <div class="input-icon">
                                                                    <i class="icofont-badge"></i>
                                                                </div>
                                                                <input type="text" class="form-control-modern" name="job_title"
                                                                       value="{{ old('job_title') }}">
                                                                <label class="floating-label">{{ _lang('Job Title') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group-modern">
                                                            <div class="input-group-modern">
                                                                <div class="input-icon">
                                                                    <i class="icofont-calendar"></i>
                                                                </div>
                                                                <input type="date" class="form-control-modern" name="employment_start_date"
                                                                       value="{{ old('employment_start_date') }}">
                                                                <label class="floating-label">{{ _lang('Employment Start Date') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group-modern">
                                                <div class="input-group-modern">
                                                    <div class="input-icon">
                                                        <i class="icofont-money"></i>
                                                    </div>
                                                    <input type="number" class="form-control-modern" name="monthly_income"
                                                           value="{{ old('monthly_income') }}" step="0.01" required>
                                                    <label class="floating-label">{{ _lang('Monthly Income') }}</label>
                                                </div>
                                            </div>

                                            <!-- Detailed Monthly Expenses Breakdown -->
                                            <h4 class="section-subtitle">{{ _lang('Monthly Expenses Breakdown') }}</h4>
                                            <p class="expense-intro">{{ _lang('Please provide your monthly expenses in each category. Select the range that best matches your spending.') }}</p>

                                            <!-- Housing Expenses -->
                                            <div class="expense-category" data-category="housing">
                                                <div class="expense-header">
                                                    <h5><i class="icofont-home"></i> {{ _lang('Housing') }}</h5>
                                                    <small>{{ _lang('Rent/Bond + Utilities') }}</small>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group-modern">
                                                            <div class="input-group-modern">
                                                                <div class="input-icon">
                                                                    <i class="icofont-money"></i>
                                                                </div>
                                                                <input type="number" class="form-control-modern expense-amount"
                                                                       name="housing_expenses" value="{{ old('housing_expenses') }}"
                                                                       step="0.01" data-category="housing">
                                                                <label class="floating-label">{{ _lang('Amount (R)') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group-modern">
                                                            <div class="input-group-modern">
                                                                <div class="input-icon">
                                                                    <i class="icofont-chart-bar-graph"></i>
                                                                </div>
                                                                <select class="form-control-modern expense-range" name="housing_range" data-category="housing">
                                                                    <option value="">{{ _lang('Select Range') }}</option>
                                                                    <option value="0-5000" {{ old('housing_range') == '0-5000' ? 'selected' : '' }}>R0 - R5,000</option>
                                                                    <option value="5001-9500" {{ old('housing_range') == '5001-9500' ? 'selected' : '' }}>R5,001 - R9,500</option>
                                                                    <option value="9501-15000" {{ old('housing_range') == '9501-15000' ? 'selected' : '' }}>R9,501 - R15,000</option>
                                                                    <option value="15001-20000" {{ old('housing_range') == '15001-20000' ? 'selected' : '' }}>R15,001 - R20,000</option>
                                                                    <option value="20001+" {{ old('housing_range') == '20001+' ? 'selected' : '' }}>R20,001+</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group-modern">
                                                    <div class="input-group-modern">
                                                        <div class="input-icon">
                                                            <i class="icofont-file-text"></i>
                                                        </div>
                                                        <input type="text" class="form-control-modern" name="housing_details"
                                                               value="{{ old('housing_details') }}">
                                                        <label class="floating-label">{{ _lang('Details (e.g., rent, utilities, maintenance)') }}</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Groceries Expenses -->
                                            <div class="expense-category" data-category="groceries">
                                                <div class="expense-header">
                                                    <h5><i class="icofont-food-cart"></i> {{ _lang('Groceries') }}</h5>
                                                    <small>{{ _lang('Food and household items') }}</small>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group-modern">
                                                            <div class="input-group-modern">
                                                                <div class="input-icon">
                                                                    <i class="icofont-money"></i>
                                                                </div>
                                                                <input type="number" class="form-control-modern expense-amount"
                                                                       name="groceries_expenses" value="{{ old('groceries_expenses') }}"
                                                                       step="0.01" data-category="groceries">
                                                                <label class="floating-label">{{ _lang('Amount (R)') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group-modern">
                                                            <div class="input-group-modern">
                                                                <div class="input-icon">
                                                                    <i class="icofont-chart-bar-graph"></i>
                                                                </div>
                                                                <select class="form-control-modern expense-range" name="groceries_range" data-category="groceries">
                                                                    <option value="">{{ _lang('Select Range') }}</option>
                                                                    <option value="0-3000" {{ old('groceries_range') == '0-3000' ? 'selected' : '' }}>R0 - R3,000</option>
                                                                    <option value="3001-6000" {{ old('groceries_range') == '3001-6000' ? 'selected' : '' }}>R3,001 - R6,000</option>
                                                                    <option value="6001-10000" {{ old('groceries_range') == '6001-10000' ? 'selected' : '' }}>R6,001 - R10,000</option>
                                                                    <option value="10001-15000" {{ old('groceries_range') == '10001-15000' ? 'selected' : '' }}>R10,001 - R15,000</option>
                                                                    <option value="15001+" {{ old('groceries_range') == '15001+' ? 'selected' : '' }}>R15,001+</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Transport Expenses -->
                                            <div class="expense-category" data-category="transport">
                                                <div class="expense-header">
                                                    <h5><i class="icofont-car"></i> {{ _lang('Transport') }}</h5>
                                                    <small>{{ _lang('Car, fuel, insurance, public transport') }}</small>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group-modern">
                                                            <div class="input-group-modern">
                                                                <div class="input-icon">
                                                                    <i class="icofont-money"></i>
                                                                </div>
                                                                <input type="number" class="form-control-modern expense-amount"
                                                                       name="transport_expenses" value="{{ old('transport_expenses') }}"
                                                                       step="0.01" data-category="transport">
                                                                <label class="floating-label">{{ _lang('Amount (R)') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group-modern">
                                                            <div class="input-group-modern">
                                                                <div class="input-icon">
                                                                    <i class="icofont-chart-bar-graph"></i>
                                                                </div>
                                                                <select class="form-control-modern expense-range" name="transport_range" data-category="transport">
                                                                    <option value="">{{ _lang('Select Range') }}</option>
                                                                    <option value="0-3000" {{ old('transport_range') == '0-3000' ? 'selected' : '' }}>R0 - R3,000</option>
                                                                    <option value="3001-7500" {{ old('transport_range') == '3001-7500' ? 'selected' : '' }}>R3,001 - R7,500</option>
                                                                    <option value="7501-14500" {{ old('transport_range') == '7501-14500' ? 'selected' : '' }}>R7,501 - R14,500</option>
                                                                    <option value="14501-20000" {{ old('transport_range') == '14501-20000' ? 'selected' : '' }}>R14,501 - R20,000</option>
                                                                    <option value="20001+" {{ old('transport_range') == '20001+' ? 'selected' : '' }}>R20,001+</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group-modern">
                                                    <div class="input-group-modern">
                                                        <div class="input-icon">
                                                            <i class="icofont-file-text"></i>
                                                        </div>
                                                        <input type="text" class="form-control-modern" name="transport_details"
                                                               value="{{ old('transport_details') }}">
                                                        <label class="floating-label">{{ _lang('Details (e.g., car payment, fuel, insurance)') }}</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Education Expenses -->
                                            <div class="expense-category" data-category="education">
                                                <div class="expense-header">
                                                    <h5><i class="icofont-graduate"></i> {{ _lang('Education') }}</h5>
                                                    <small>{{ _lang('School fees, university, training') }}</small>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group-modern">
                                                            <div class="input-group-modern">
                                                                <div class="input-icon">
                                                                    <i class="icofont-money"></i>
                                                                </div>
                                                                <input type="number" class="form-control-modern expense-amount"
                                                                       name="education_expenses" value="{{ old('education_expenses') }}"
                                                                       step="0.01" data-category="education">
                                                                <label class="floating-label">{{ _lang('Amount (R)') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group-modern">
                                                            <div class="input-group-modern">
                                                                <div class="input-icon">
                                                                    <i class="icofont-chart-bar-graph"></i>
                                                                </div>
                                                                <select class="form-control-modern expense-range" name="education_range" data-category="education">
                                                                    <option value="">{{ _lang('Select Range') }}</option>
                                                                    <option value="0-2500" {{ old('education_range') == '0-2500' ? 'selected' : '' }}>R0 - R2,500</option>
                                                                    <option value="2501-7000" {{ old('education_range') == '2501-7000' ? 'selected' : '' }}>R2,501 - R7,000</option>
                                                                    <option value="7001-15000" {{ old('education_range') == '7001-15000' ? 'selected' : '' }}>R7,001 - R15,000</option>
                                                                    <option value="15001-25000" {{ old('education_range') == '15001-25000' ? 'selected' : '' }}>R15,001 - R25,000</option>
                                                                    <option value="25001+" {{ old('education_range') == '25001+' ? 'selected' : '' }}>R25,001+</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group-modern">
                                                            <div class="input-group-modern">
                                                                <div class="input-icon">
                                                                    <i class="icofont-users"></i>
                                                                </div>
                                                                <input type="number" class="form-control-modern" name="number_of_children"
                                                                       value="{{ old('number_of_children') }}" min="0" max="10">
                                                                <label class="floating-label">{{ _lang('Number of Children') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group-modern">
                                                    <div class="input-group-modern">
                                                        <div class="input-icon">
                                                            <i class="icofont-file-text"></i>
                                                        </div>
                                                        <input type="text" class="form-control-modern" name="education_details"
                                                               value="{{ old('education_details') }}">
                                                        <label class="floating-label">{{ _lang('Details (e.g., school fees, university, training)') }}</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Medical Expenses -->
                                            <div class="expense-category" data-category="medical">
                                                <div class="expense-header">
                                                    <h5><i class="icofont-medical-sign"></i> {{ _lang('Medical') }}</h5>
                                                    <small>{{ _lang('Healthcare, medical aid, medications') }}</small>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group-modern">
                                                            <div class="input-group-modern">
                                                                <div class="input-icon">
                                                                    <i class="icofont-money"></i>
                                                                </div>
                                                                <input type="number" class="form-control-modern expense-amount"
                                                                       name="medical_expenses" value="{{ old('medical_expenses') }}"
                                                                       step="0.01" data-category="medical">
                                                                <label class="floating-label">{{ _lang('Amount (R)') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group-modern">
                                                            <div class="input-group-modern">
                                                                <div class="input-icon">
                                                                    <i class="icofont-chart-bar-graph"></i>
                                                                </div>
                                                                <select class="form-control-modern expense-range" name="medical_range" data-category="medical">
                                                                    <option value="">{{ _lang('Select Range') }}</option>
                                                                    <option value="0-1500" {{ old('medical_range') == '0-1500' ? 'selected' : '' }}>R0 - R1,500</option>
                                                                    <option value="1501-3000" {{ old('medical_range') == '1501-3000' ? 'selected' : '' }}>R1,501 - R3,000</option>
                                                                    <option value="3001-5000" {{ old('medical_range') == '3001-5000' ? 'selected' : '' }}>R3,001 - R5,000</option>
                                                                    <option value="5001-8000" {{ old('medical_range') == '5001-8000' ? 'selected' : '' }}>R5,001 - R8,000</option>
                                                                    <option value="8001+" {{ old('medical_range') == '8001+' ? 'selected' : '' }}>R8,001+</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group-modern">
                                                            <label class="modern-checkbox">
                                                                <input type="checkbox" name="has_medical_aid" {{ old('has_medical_aid') ? 'checked' : '' }}>
                                                                <span class="checkmark"></span>
                                                                <span class="label-text">{{ _lang('I have medical aid/insurance') }}</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group-modern">
                                                            <div class="input-group-modern">
                                                                <div class="input-icon">
                                                                    <i class="icofont-file-text"></i>
                                                                </div>
                                                                <input type="text" class="form-control-modern" name="medical_details"
                                                                       value="{{ old('medical_details') }}">
                                                                <label class="floating-label">{{ _lang('Medical aid provider/details') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Debt Repayment Expenses -->
                                            <div class="expense-category" data-category="debt_repayment">
                                                <div class="expense-header">
                                                    <h5><i class="icofont-credit-card"></i> {{ _lang('Debt Repayments') }}</h5>
                                                    <small>{{ _lang('Credit cards, loans, store accounts') }}</small>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group-modern">
                                                            <div class="input-group-modern">
                                                                <div class="input-icon">
                                                                    <i class="icofont-money"></i>
                                                                </div>
                                                                <input type="number" class="form-control-modern expense-amount"
                                                                       name="debt_repayment_expenses" value="{{ old('debt_repayment_expenses') }}"
                                                                       step="0.01" data-category="debt_repayment">
                                                                <label class="floating-label">{{ _lang('Amount (R)') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group-modern">
                                                            <div class="input-group-modern">
                                                                <div class="input-icon">
                                                                    <i class="icofont-chart-bar-graph"></i>
                                                                </div>
                                                                <select class="form-control-modern expense-range" name="debt_repayment_range" data-category="debt_repayment">
                                                                    <option value="">{{ _lang('Select Range') }}</option>
                                                                    <option value="0-1000" {{ old('debt_repayment_range') == '0-1000' ? 'selected' : '' }}>R0 - R1,000</option>
                                                                    <option value="1001-2000" {{ old('debt_repayment_range') == '1001-2000' ? 'selected' : '' }}>R1,001 - R2,000</option>
                                                                    <option value="2001-5000" {{ old('debt_repayment_range') == '2001-5000' ? 'selected' : '' }}>R2,001 - R5,000</option>
                                                                    <option value="5001-10000" {{ old('debt_repayment_range') == '5001-10000' ? 'selected' : '' }}>R5,001 - R10,000</option>
                                                                    <option value="10001+" {{ old('debt_repayment_range') == '10001+' ? 'selected' : '' }}>R10,001+</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Miscellaneous Expenses -->
                                            <div class="expense-category" data-category="miscellaneous">
                                                <div class="expense-header">
                                                    <h5><i class="icofont-shopping-cart"></i> {{ _lang('Miscellaneous') }}</h5>
                                                    <small>{{ _lang('Clothing, savings, entertainment, other') }}</small>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group-modern">
                                                            <div class="input-group-modern">
                                                                <div class="input-icon">
                                                                    <i class="icofont-money"></i>
                                                                </div>
                                                                <input type="number" class="form-control-modern expense-amount"
                                                                       name="miscellaneous_expenses" value="{{ old('miscellaneous_expenses') }}"
                                                                       step="0.01" data-category="miscellaneous">
                                                                <label class="floating-label">{{ _lang('Amount (R)') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group-modern">
                                                            <div class="input-group-modern">
                                                                <div class="input-icon">
                                                                    <i class="icofont-chart-bar-graph"></i>
                                                                </div>
                                                                <select class="form-control-modern expense-range" name="miscellaneous_range" data-category="miscellaneous">
                                                                    <option value="">{{ _lang('Select Range') }}</option>
                                                                    <option value="0-2000" {{ old('miscellaneous_range') == '0-2000' ? 'selected' : '' }}>R0 - R2,000</option>
                                                                    <option value="2001-4000" {{ old('miscellaneous_range') == '2001-4000' ? 'selected' : '' }}>R2,001 - R4,000</option>
                                                                    <option value="4001-6000" {{ old('miscellaneous_range') == '4001-6000' ? 'selected' : '' }}>R4,001 - R6,000</option>
                                                                    <option value="6001-10000" {{ old('miscellaneous_range') == '6001-10000' ? 'selected' : '' }}>R6,001 - R10,000</option>
                                                                    <option value="10001+" {{ old('miscellaneous_range') == '10001+' ? 'selected' : '' }}>R10,001+</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group-modern">
                                                    <div class="input-group-modern">
                                                        <div class="input-icon">
                                                            <i class="icofont-file-text"></i>
                                                        </div>
                                                        <input type="text" class="form-control-modern" name="miscellaneous_details"
                                                               value="{{ old('miscellaneous_details') }}">
                                                        <label class="floating-label">{{ _lang('Details (e.g., clothing, entertainment, savings)') }}</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Expense Summary -->
                                            <div class="expense-summary-card">
                                                <h5><i class="icofont-chart-pie"></i> {{ _lang('Expense Summary') }}</h5>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="summary-item">
                                                            <span class="label">{{ _lang('Total Monthly Expenses:') }}</span>
                                                            <span class="amount" id="total-expenses">R0.00</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="summary-item">
                                                            <span class="label">{{ _lang('Disposable Income:') }}</span>
                                                            <span class="amount" id="disposable-income">R0.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="expense-ratio">
                                                    <span class="label">{{ _lang('Expense-to-Income Ratio:') }}</span>
                                                    <span class="ratio" id="expense-ratio">0%</span>
                                                    <div class="ratio-bar">
                                                        <div class="ratio-fill" id="ratio-fill" style="width: 0%"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Hidden field for calculated total -->
                                            <input type="hidden" name="monthly_expenses" id="monthly_expenses_total" value="{{ old('monthly_expenses') }}">
                                        </div>

                                        <!-- Step 5: Financial Details -->
                                        <div class="form-step" data-step="5">
                                            <h3 class="step-title">{{ _lang('Financial Details') }}</h3>

                                            <!-- Primary Bank Account (Salary Account) -->
                                            <h4 class="section-subtitle">{{ _lang('Primary Bank Account (Where Salary is Deposited)') }}</h4>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group-modern">
                                                        <div class="input-group-modern">
                                                            <div class="input-icon">
                                                                <i class="icofont-bank"></i>
                                                            </div>
                                                            <input type="text" class="form-control-modern" name="primary_bank_name"
                                                                   value="{{ old('primary_bank_name') }}" required>
                                                            <label class="floating-label">{{ _lang('Bank Name') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group-modern">
                                                        <div class="input-group-modern">
                                                            <div class="input-icon">
                                                                <i class="icofont-building"></i>
                                                            </div>
                                                            <input type="text" class="form-control-modern" name="primary_bank_branch"
                                                                   value="{{ old('primary_bank_branch') }}">
                                                            <label class="floating-label">{{ _lang('Branch Name') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group-modern">
                                                        <div class="input-group-modern">
                                                            <div class="input-icon">
                                                                <i class="icofont-numbered-list"></i>
                                                            </div>
                                                            <input type="text" class="form-control-modern" name="primary_account_number"
                                                                   value="{{ old('primary_account_number') }}" required>
                                                            <label class="floating-label">{{ _lang('Account Number') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group-modern">
                                                        <div class="input-group-modern">
                                                            <div class="input-icon">
                                                                <i class="icofont-user-alt-3"></i>
                                                            </div>
                                                            <input type="text" class="form-control-modern" name="primary_account_name"
                                                                   value="{{ old('primary_account_name') }}" required>
                                                            <label class="floating-label">{{ _lang('Account Name') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group-modern">
                                                        <div class="input-group-modern">
                                                            <div class="input-icon">
                                                                <i class="icofont-credit-card"></i>
                                                            </div>
                                                            <select class="form-control-modern" name="primary_account_type" required>
                                                                <option value="">{{ _lang('Account Type') }}</option>
                                                                <option value="savings" {{ old('primary_account_type') == 'savings' ? 'selected' : '' }}>{{ _lang('Savings') }}</option>
                                                                <option value="checking" {{ old('primary_account_type') == 'checking' ? 'selected' : '' }}>{{ _lang('Checking') }}</option>
                                                                <option value="current" {{ old('primary_account_type') == 'current' ? 'selected' : '' }}>{{ _lang('Current') }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group-modern">
                                                        <div class="input-group-modern">
                                                            <div class="input-icon">
                                                                <i class="icofont-money"></i>
                                                            </div>
                                                            <input type="number" class="form-control-modern" name="average_monthly_balance"
                                                                   value="{{ old('average_monthly_balance') }}" step="0.01">
                                                            <label class="floating-label">{{ _lang('Average Monthly Balance') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Secondary Bank Account (Loan Disbursement) -->
                                            <h4 class="section-subtitle">{{ _lang('Secondary Bank Account (For Loan Disbursement) - Optional') }}</h4>

                                            <div class="form-group-modern">
                                                <label class="modern-checkbox">
                                                    <input type="checkbox" name="has_secondary_account" id="has_secondary_account" {{ old('has_secondary_account') ? 'checked' : '' }}>
                                                    <span class="checkmark"></span>
                                                    <span class="label-text">{{ _lang('I have a different account for loan disbursement') }}</span>
                                                </label>
                                            </div>

                                            <div class="secondary-bank-fields" style="display: none;">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group-modern">
                                                            <div class="input-group-modern">
                                                                <div class="input-icon">
                                                                    <i class="icofont-bank"></i>
                                                                </div>
                                                                <input type="text" class="form-control-modern" name="secondary_bank_name"
                                                                       value="{{ old('secondary_bank_name') }}">
                                                                <label class="floating-label">{{ _lang('Bank Name') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group-modern">
                                                            <div class="input-group-modern">
                                                                <div class="input-icon">
                                                                    <i class="icofont-numbered-list"></i>
                                                                </div>
                                                                <input type="text" class="form-control-modern" name="secondary_account_number"
                                                                       value="{{ old('secondary_account_number') }}">
                                                                <label class="floating-label">{{ _lang('Account Number') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group-modern">
                                                            <div class="input-group-modern">
                                                                <div class="input-icon">
                                                                    <i class="icofont-user-alt-3"></i>
                                                                </div>
                                                                <input type="text" class="form-control-modern" name="secondary_account_name"
                                                                       value="{{ old('secondary_account_name') }}">
                                                                <label class="floating-label">{{ _lang('Account Name') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group-modern">
                                                            <div class="input-group-modern">
                                                                <div class="input-icon">
                                                                    <i class="icofont-credit-card"></i>
                                                                </div>
                                                                <select class="form-control-modern" name="secondary_account_type">
                                                                    <option value="">{{ _lang('Account Type') }}</option>
                                                                    <option value="savings" {{ old('secondary_account_type') == 'savings' ? 'selected' : '' }}>{{ _lang('Savings') }}</option>
                                                                    <option value="checking" {{ old('secondary_account_type') == 'checking' ? 'selected' : '' }}>{{ _lang('Checking') }}</option>
                                                                    <option value="current" {{ old('secondary_account_type') == 'current' ? 'selected' : '' }}>{{ _lang('Current') }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group-modern">
                                                    <label class="modern-checkbox">
                                                        <input type="checkbox" name="preferred_disbursement_account" {{ old('preferred_disbursement_account') ? 'checked' : '' }}>
                                                        <span class="checkmark"></span>
                                                        <span class="label-text">{{ _lang('Use this account for loan disbursement') }}</span>
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- Mobile Money (Alternative) -->
                                            <h4 class="section-subtitle">{{ _lang('Mobile Money Account (Alternative) - Optional') }}</h4>

                                            <div class="form-group-modern">
                                                <label class="modern-checkbox">
                                                    <input type="checkbox" name="has_mobile_money" id="has_mobile_money" {{ old('has_mobile_money') ? 'checked' : '' }}>
                                                    <span class="checkmark"></span>
                                                    <span class="label-text">{{ _lang('I have a mobile money account') }}</span>
                                                </label>
                                            </div>

                                            <div class="mobile-money-fields" style="display: none;">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group-modern">
                                                            <div class="input-group-modern">
                                                                <div class="input-icon">
                                                                    <i class="icofont-mobile-phone"></i>
                                                                </div>
                                                                <select class="form-control-modern" name="mobile_money_provider">
                                                                    <option value="">{{ _lang('Select Provider') }}</option>
                                                                    <option value="mpesa" {{ old('mobile_money_provider') == 'mpesa' ? 'selected' : '' }}>M-Pesa</option>
                                                                    <option value="airtel_money" {{ old('mobile_money_provider') == 'airtel_money' ? 'selected' : '' }}>Airtel Money</option>
                                                                    <option value="mtn_mobile_money" {{ old('mobile_money_provider') == 'mtn_mobile_money' ? 'selected' : '' }}>MTN Mobile Money</option>
                                                                    <option value="orange_money" {{ old('mobile_money_provider') == 'orange_money' ? 'selected' : '' }}>Orange Money</option>
                                                                    <option value="tigo_pesa" {{ old('mobile_money_provider') == 'tigo_pesa' ? 'selected' : '' }}>Tigo Pesa</option>
                                                                    <option value="other" {{ old('mobile_money_provider') == 'other' ? 'selected' : '' }}>{{ _lang('Other') }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group-modern">
                                                            <div class="input-group-modern">
                                                                <div class="input-icon">
                                                                    <i class="icofont-phone"></i>
                                                                </div>
                                                                <input type="text" class="form-control-modern" name="mobile_money_number"
                                                                       value="{{ old('mobile_money_number') }}">
                                                                <label class="floating-label">{{ _lang('Mobile Money Number') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group-modern">
                                                    <div class="input-group-modern">
                                                        <div class="input-icon">
                                                            <i class="icofont-user-alt-3"></i>
                                                        </div>
                                                        <input type="text" class="form-control-modern" name="mobile_money_name"
                                                               value="{{ old('mobile_money_name') }}">
                                                        <label class="floating-label">{{ _lang('Account Name') }}</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Existing Debts and Loans -->
                                            <h4 class="section-subtitle">{{ _lang('Existing Debts and Loans') }}</h4>

                                            <div class="form-group-modern">
                                                <label class="modern-checkbox">
                                                    <input type="checkbox" name="has_existing_loans" id="has_existing_loans" {{ old('has_existing_loans') ? 'checked' : '' }}>
                                                    <span class="checkmark"></span>
                                                    <span class="label-text">{{ _lang('I have existing loans or debts') }}</span>
                                                </label>
                                            </div>

                                            <div class="existing-loans-section" style="display: none;">
                                                <div class="loans-container">
                                                    <div class="loan-item" data-loan="1">
                                                        <div class="loan-header">
                                                            <h5>{{ _lang('Loan/Debt #1') }}</h5>
                                                            <button type="button" class="btn-remove-loan" onclick="removeLoan(1)" style="display: none;">
                                                                <i class="icofont-close"></i>
                                                            </button>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group-modern">
                                                                    <div class="input-group-modern">
                                                                        <div class="input-icon">
                                                                            <i class="icofont-bank"></i>
                                                                        </div>
                                                                        <select class="form-control-modern" name="loans[1][type]">
                                                                            <option value="">{{ _lang('Loan Type') }}</option>
                                                                            <option value="personal_loan">{{ _lang('Personal Loan') }}</option>
                                                                            <option value="business_loan">{{ _lang('Business Loan') }}</option>
                                                                            <option value="mortgage">{{ _lang('Mortgage') }}</option>
                                                                            <option value="car_loan">{{ _lang('Car Loan') }}</option>
                                                                            <option value="credit_card">{{ _lang('Credit Card') }}</option>
                                                                            <option value="student_loan">{{ _lang('Student Loan') }}</option>
                                                                            <option value="microfinance">{{ _lang('Microfinance') }}</option>
                                                                            <option value="other">{{ _lang('Other') }}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group-modern">
                                                                    <div class="input-group-modern">
                                                                        <div class="input-icon">
                                                                            <i class="icofont-building-alt"></i>
                                                                        </div>
                                                                        <input type="text" class="form-control-modern" name="loans[1][lender]">
                                                                        <label class="floating-label">{{ _lang('Lender/Bank Name') }}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group-modern">
                                                                    <div class="input-group-modern">
                                                                        <div class="input-icon">
                                                                            <i class="icofont-money"></i>
                                                                        </div>
                                                                        <input type="number" class="form-control-modern" name="loans[1][original_amount]" step="0.01">
                                                                        <label class="floating-label">{{ _lang('Original Amount') }}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group-modern">
                                                                    <div class="input-group-modern">
                                                                        <div class="input-icon">
                                                                            <i class="icofont-chart-line"></i>
                                                                        </div>
                                                                        <input type="number" class="form-control-modern" name="loans[1][outstanding_amount]" step="0.01">
                                                                        <label class="floating-label">{{ _lang('Outstanding Amount') }}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group-modern">
                                                                    <div class="input-group-modern">
                                                                        <div class="input-icon">
                                                                            <i class="icofont-calendar"></i>
                                                                        </div>
                                                                        <input type="number" class="form-control-modern" name="loans[1][monthly_payment]" step="0.01">
                                                                        <label class="floating-label">{{ _lang('Monthly Payment') }}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group-modern">
                                                                    <div class="input-group-modern">
                                                                        <div class="input-icon">
                                                                            <i class="icofont-percentage"></i>
                                                                        </div>
                                                                        <input type="number" class="form-control-modern" name="loans[1][interest_rate]" step="0.01">
                                                                        <label class="floating-label">{{ _lang('Interest Rate (%)') }}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group-modern">
                                                                    <div class="input-group-modern">
                                                                        <div class="input-icon">
                                                                            <i class="icofont-calendar"></i>
                                                                        </div>
                                                                        <input type="date" class="form-control-modern" name="loans[1][end_date]">
                                                                        <label class="floating-label">{{ _lang('Expected End Date') }}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="loan-actions">
                                                    <button type="button" class="btn-add-loan" onclick="addLoan()">
                                                        <i class="icofont-plus"></i>
                                                        <span>{{ _lang('Add Another Loan') }}</span>
                                                    </button>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-md-6">
                                                        <div class="form-group-modern">
                                                            <div class="input-group-modern">
                                                                <div class="input-icon">
                                                                    <i class="icofont-money"></i>
                                                                </div>
                                                                <input type="number" class="form-control-modern" name="total_existing_debt_amount"
                                                                       value="{{ old('total_existing_debt_amount') }}" step="0.01" readonly>
                                                                <label class="floating-label">{{ _lang('Total Outstanding Debt') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group-modern">
                                                            <div class="input-group-modern">
                                                                <div class="input-icon">
                                                                    <i class="icofont-calendar"></i>
                                                                </div>
                                                                <input type="number" class="form-control-modern" name="total_monthly_debt_payments"
                                                                       value="{{ old('total_monthly_debt_payments') }}" step="0.01" readonly>
                                                                <label class="floating-label">{{ _lang('Total Monthly Payments') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Loan Purpose -->
                                            <h4 class="section-subtitle">{{ _lang('Loan Purpose') }}</h4>

                                            <div class="form-group-modern">
                                                <div class="input-group-modern">
                                                    <div class="input-icon">
                                                        <i class="icofont-target"></i>
                                                    </div>
                                                    <select class="form-control-modern" name="loan_purpose">
                                                        <option value="">{{ _lang('What will you use the loan for?') }}</option>
                                                        <option value="business_expansion" {{ old('loan_purpose') == 'business_expansion' ? 'selected' : '' }}>{{ _lang('Business Expansion') }}</option>
                                                        <option value="education" {{ old('loan_purpose') == 'education' ? 'selected' : '' }}>{{ _lang('Education') }}</option>
                                                        <option value="medical" {{ old('loan_purpose') == 'medical' ? 'selected' : '' }}>{{ _lang('Medical Expenses') }}</option>
                                                        <option value="home_improvement" {{ old('loan_purpose') == 'home_improvement' ? 'selected' : '' }}>{{ _lang('Home Improvement') }}</option>
                                                        <option value="debt_consolidation" {{ old('loan_purpose') == 'debt_consolidation' ? 'selected' : '' }}>{{ _lang('Debt Consolidation') }}</option>
                                                        <option value="emergency" {{ old('loan_purpose') == 'emergency' ? 'selected' : '' }}>{{ _lang('Emergency') }}</option>
                                                        <option value="agriculture" {{ old('loan_purpose') == 'agriculture' ? 'selected' : '' }}>{{ _lang('Agriculture') }}</option>
                                                        <option value="equipment_purchase" {{ old('loan_purpose') == 'equipment_purchase' ? 'selected' : '' }}>{{ _lang('Equipment Purchase') }}</option>
                                                        <option value="working_capital" {{ old('loan_purpose') == 'working_capital' ? 'selected' : '' }}>{{ _lang('Working Capital') }}</option>
                                                        <option value="personal" {{ old('loan_purpose') == 'personal' ? 'selected' : '' }}>{{ _lang('Personal Use') }}</option>
                                                        <option value="other" {{ old('loan_purpose') == 'other' ? 'selected' : '' }}>{{ _lang('Other') }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group-modern">
                                                <div class="input-group-modern">
                                                    <div class="input-icon">
                                                        <i class="icofont-file-text"></i>
                                                    </div>
                                                    <textarea class="form-control-modern" name="loan_purpose_description" rows="3">{{ old('loan_purpose_description') }}</textarea>
                                                    <label class="floating-label">{{ _lang('Please describe how you plan to use the loan') }}</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Step 6: Supporting Documentation -->
                                        <div class="form-step" data-step="6">
                                            <h3 class="step-title">{{ _lang('Supporting Documentation') }}</h3>
                                            <p class="document-intro">{{ _lang('Please upload the required documents to complete your application. All documents must be clear, legible, and not older than 3 months (where applicable).') }}</p>

                                            <!-- Proof of Identity -->
                                            <div class="document-category" data-category="identity">
                                                <div class="document-header">
                                                    <h5><i class="icofont-id-card"></i> {{ _lang('Proof of Identity') }}</h5>
                                                    <span class="required-badge">{{ _lang('Required') }}</span>
                                                </div>
                                                <p class="document-description">{{ _lang('Upload a clear copy of your ID document or passport') }}</p>
                                                <div class="document-upload-area">
                                                    <input type="file" id="identity_document" name="identity_document" accept=".pdf,.jpg,.jpeg,.png" class="document-input" required>
                                                    <label for="identity_document" class="upload-label">
                                                        <div class="upload-icon">
                                                            <i class="icofont-upload-alt"></i>
                                                        </div>
                                                        <div class="upload-text">
                                                            <span class="upload-title">{{ _lang('Click to upload or drag and drop') }}</span>
                                                            <span class="upload-subtitle">{{ _lang('PDF, JPG, PNG (Max 5MB)') }}</span>
                                                        </div>
                                                    </label>
                                                    <div class="upload-progress" style="display: none;">
                                                        <div class="progress-bar"></div>
                                                    </div>
                                                    <div class="upload-success" style="display: none;">
                                                        <i class="icofont-check-circled"></i>
                                                        <span>{{ _lang('Document uploaded successfully') }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Proof of Address -->
                                            <div class="document-category" data-category="address">
                                                <div class="document-header">
                                                    <h5><i class="icofont-home"></i> {{ _lang('Proof of Address') }}</h5>
                                                    <span class="required-badge">{{ _lang('Required') }}</span>
                                                </div>
                                                <p class="document-description">{{ _lang('Utility bill or rental agreement (max. 3 months old)') }}</p>
                                                <div class="document-upload-area">
                                                    <input type="file" id="address_proof" name="address_proof" accept=".pdf,.jpg,.jpeg,.png" class="document-input" required>
                                                    <label for="address_proof" class="upload-label">
                                                        <div class="upload-icon">
                                                            <i class="icofont-upload-alt"></i>
                                                        </div>
                                                        <div class="upload-text">
                                                            <span class="upload-title">{{ _lang('Click to upload or drag and drop') }}</span>
                                                            <span class="upload-subtitle">{{ _lang('PDF, JPG, PNG (Max 5MB)') }}</span>
                                                        </div>
                                                    </label>
                                                    <div class="upload-progress" style="display: none;">
                                                        <div class="progress-bar"></div>
                                                    </div>
                                                    <div class="upload-success" style="display: none;">
                                                        <i class="icofont-check-circled"></i>
                                                        <span>{{ _lang('Document uploaded successfully') }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Proof of Income -->
                                            <div class="document-category" data-category="income">
                                                <div class="document-header">
                                                    <h5><i class="icofont-money-bag"></i> {{ _lang('Proof of Income') }}</h5>
                                                    <span class="required-badge">{{ _lang('Required') }}</span>
                                                </div>
                                                <p class="document-description">{{ _lang('Latest 12 months\' payslips or bank statements') }}</p>
                                                <div class="document-upload-area">
                                                    <input type="file" id="income_proof" name="income_proof[]" accept=".pdf,.jpg,.jpeg,.png" class="document-input" multiple required>
                                                    <label for="income_proof" class="upload-label">
                                                        <div class="upload-icon">
                                                            <i class="icofont-upload-alt"></i>
                                                        </div>
                                                        <div class="upload-text">
                                                            <span class="upload-title">{{ _lang('Click to upload or drag and drop') }}</span>
                                                            <span class="upload-subtitle">{{ _lang('Multiple files allowed - PDF, JPG, PNG (Max 5MB each)') }}</span>
                                                        </div>
                                                    </label>
                                                    <div class="upload-progress" style="display: none;">
                                                        <div class="progress-bar"></div>
                                                    </div>
                                                    <div class="upload-success" style="display: none;">
                                                        <i class="icofont-check-circled"></i>
                                                        <span>{{ _lang('Documents uploaded successfully') }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- 3 Months' Payslips -->
                                            <div class="document-category" data-category="payslips">
                                                <div class="document-header">
                                                    <h5><i class="icofont-file-document"></i> {{ _lang('3 Months\' Payslips') }}</h5>
                                                    <span class="required-badge">{{ _lang('Required') }}</span>
                                                </div>
                                                <p class="document-description">{{ _lang('Most recent 3 months\' payslips') }}</p>
                                                <div class="document-upload-area">
                                                    <input type="file" id="payslips" name="payslips[]" accept=".pdf,.jpg,.jpeg,.png" class="document-input" multiple required>
                                                    <label for="payslips" class="upload-label">
                                                        <div class="upload-icon">
                                                            <i class="icofont-upload-alt"></i>
                                                        </div>
                                                        <div class="upload-text">
                                                            <span class="upload-title">{{ _lang('Click to upload or drag and drop') }}</span>
                                                            <span class="upload-subtitle">{{ _lang('3 files required - PDF, JPG, PNG (Max 5MB each)') }}</span>
                                                        </div>
                                                    </label>
                                                    <div class="upload-progress" style="display: none;">
                                                        <div class="progress-bar"></div>
                                                    </div>
                                                    <div class="upload-success" style="display: none;">
                                                        <i class="icofont-check-circled"></i>
                                                        <span>{{ _lang('Payslips uploaded successfully') }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Headshot and ID Picture -->
                                            <div class="document-category" data-category="headshot">
                                                <div class="document-header">
                                                    <h5><i class="icofont-camera"></i> {{ _lang('Headshot and Picture of ID') }}</h5>
                                                    <span class="required-badge">{{ _lang('Required') }}</span>
                                                </div>
                                                <p class="document-description">{{ _lang('Clear headshot photo and a picture of you holding your ID document') }}</p>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="document-upload-area">
                                                            <input type="file" id="headshot" name="headshot" accept=".jpg,.jpeg,.png" class="document-input" required>
                                                            <label for="headshot" class="upload-label">
                                                                <div class="upload-icon">
                                                                    <i class="icofont-camera"></i>
                                                                </div>
                                                                <div class="upload-text">
                                                                    <span class="upload-title">{{ _lang('Headshot Photo') }}</span>
                                                                    <span class="upload-subtitle">{{ _lang('JPG, PNG (Max 5MB)') }}</span>
                                                                </div>
                                                            </label>
                                                            <div class="upload-progress" style="display: none;">
                                                                <div class="progress-bar"></div>
                                                            </div>
                                                            <div class="upload-success" style="display: none;">
                                                                <i class="icofont-check-circled"></i>
                                                                <span>{{ _lang('Photo uploaded') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="document-upload-area">
                                                            <input type="file" id="id_selfie" name="id_selfie" accept=".jpg,.jpeg,.png" class="document-input" required>
                                                            <label for="id_selfie" class="upload-label">
                                                                <div class="upload-icon">
                                                                    <i class="icofont-id-card"></i>
                                                                </div>
                                                                <div class="upload-text">
                                                                    <span class="upload-title">{{ _lang('ID Selfie') }}</span>
                                                                    <span class="upload-subtitle">{{ _lang('You holding your ID') }}</span>
                                                                </div>
                                                            </label>
                                                            <div class="upload-progress" style="display: none;">
                                                                <div class="progress-bar"></div>
                                                            </div>
                                                            <div class="upload-success" style="display: none;">
                                                                <i class="icofont-check-circled"></i>
                                                                <span>{{ _lang('Photo uploaded') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Collateral Documents (Optional) -->
                                            <div class="document-category" data-category="collateral">
                                                <div class="document-header">
                                                    <h5><i class="icofont-shield"></i> {{ _lang('Collateral Documents') }}</h5>
                                                    <span class="optional-badge">{{ _lang('Optional') }}</span>
                                                </div>
                                                <p class="document-description">{{ _lang('For secured loans - property deeds, vehicle registration, etc.') }}</p>
                                                <div class="document-upload-area">
                                                    <input type="file" id="collateral_docs" name="collateral_docs[]" accept=".pdf,.jpg,.jpeg,.png" class="document-input" multiple>
                                                    <label for="collateral_docs" class="upload-label">
                                                        <div class="upload-icon">
                                                            <i class="icofont-upload-alt"></i>
                                                        </div>
                                                        <div class="upload-text">
                                                            <span class="upload-title">{{ _lang('Click to upload or drag and drop') }}</span>
                                                            <span class="upload-subtitle">{{ _lang('Multiple files allowed - PDF, JPG, PNG (Max 5MB each)') }}</span>
                                                        </div>
                                                    </label>
                                                    <div class="upload-progress" style="display: none;">
                                                        <div class="progress-bar"></div>
                                                    </div>
                                                    <div class="upload-success" style="display: none;">
                                                        <i class="icofont-check-circled"></i>
                                                        <span>{{ _lang('Documents uploaded successfully') }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Document Upload Summary -->
                                            <div class="document-summary-card">
                                                <h5><i class="icofont-check-alt"></i> {{ _lang('Document Upload Summary') }}</h5>
                                                <div class="document-checklist">
                                                    <div class="checklist-item" data-document="identity">
                                                        <i class="icofont-close-circled"></i>
                                                        <span>{{ _lang('Proof of Identity') }}</span>
                                                    </div>
                                                    <div class="checklist-item" data-document="address">
                                                        <i class="icofont-close-circled"></i>
                                                        <span>{{ _lang('Proof of Address') }}</span>
                                                    </div>
                                                    <div class="checklist-item" data-document="income">
                                                        <i class="icofont-close-circled"></i>
                                                        <span>{{ _lang('Proof of Income') }}</span>
                                                    </div>
                                                    <div class="checklist-item" data-document="payslips">
                                                        <i class="icofont-close-circled"></i>
                                                        <span>{{ _lang('3 Months\' Payslips') }}</span>
                                                    </div>
                                                    <div class="checklist-item" data-document="headshot">
                                                        <i class="icofont-close-circled"></i>
                                                        <span>{{ _lang('Headshot and ID Photo') }}</span>
                                                    </div>
                                                    <div class="checklist-item optional" data-document="collateral">
                                                        <i class="icofont-minus-circled"></i>
                                                        <span>{{ _lang('Collateral Documents (Optional)') }}</span>
                                                    </div>
                                                </div>
                                                <div class="upload-progress-summary">
                                                    <span class="progress-text">{{ _lang('Required documents: ') }}<span id="uploaded-count">0</span>/5</span>
                                                    <div class="progress-bar-summary">
                                                        <div class="progress-fill" id="upload-progress-fill" style="width: 0%"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Step 7: Consent and Declarations -->
                                        <div class="form-step" data-step="7">
                                            <h3 class="step-title">{{ _lang('Consent and Declarations') }}</h3>
                                            <p class="consent-intro">{{ _lang('Please review and provide your consent for the following declarations to complete your application.') }}</p>

                                            <!-- Credit Check Authorization -->
                                            <div class="consent-section">
                                                <div class="consent-header">
                                                    <h5><i class="icofont-search-document"></i> {{ _lang('Credit Check Authorization') }}</h5>
                                                </div>
                                                <div class="consent-content">
                                                    <p>{{ _lang('I hereby authorize ') }}{{ get_option('site_title', config('app.name')) }}{{ _lang(' and its authorized agents to:') }}</p>
                                                    <ul class="consent-list">
                                                        <li>{{ _lang('Obtain my credit report from registered credit bureaus') }}</li>
                                                        <li>{{ _lang('Verify my employment and income information') }}</li>
                                                        <li>{{ _lang('Contact my references and previous lenders') }}</li>
                                                        <li>{{ _lang('Perform ongoing credit monitoring during the loan term') }}</li>
                                                    </ul>
                                                    <div class="consent-checkbox">
                                                        <label class="modern-checkbox">
                                                            <input type="checkbox" name="credit_check_consent" required>
                                                            <span class="checkmark"></span>
                                                            <span class="label-text">{{ _lang('I authorize the credit check and verification process') }}</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Data Processing Consent -->
                                            <div class="consent-section">
                                                <div class="consent-header">
                                                    <h5><i class="icofont-database"></i> {{ _lang('Data Processing Consent') }}</h5>
                                                </div>
                                                <div class="consent-content">
                                                    <p>{{ _lang('I consent to the processing of my personal data for:') }}</p>
                                                    <ul class="consent-list">
                                                        <li>{{ _lang('Loan application assessment and processing') }}</li>
                                                        <li>{{ _lang('Identity verification and fraud prevention') }}</li>
                                                        <li>{{ _lang('Compliance with regulatory requirements') }}</li>
                                                        <li>{{ _lang('Account management and customer service') }}</li>
                                                    </ul>
                                                    <div class="consent-checkbox">
                                                        <label class="modern-checkbox">
                                                            <input type="checkbox" name="data_processing_consent" required>
                                                            <span class="checkmark"></span>
                                                            <span class="label-text">{{ _lang('I consent to the processing of my personal data') }}</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Marketing Communications -->
                                            <div class="consent-section">
                                                <div class="consent-header">
                                                    <h5><i class="icofont-email"></i> {{ _lang('Marketing Communications') }}</h5>
                                                </div>
                                                <div class="consent-content">
                                                    <p>{{ _lang('I would like to receive marketing communications about:') }}</p>
                                                    <ul class="consent-list">
                                                        <li>{{ _lang('New loan products and special offers') }}</li>
                                                        <li>{{ _lang('Financial education and tips') }}</li>
                                                        <li>{{ _lang('Company news and updates') }}</li>
                                                    </ul>
                                                    <div class="consent-checkbox">
                                                        <label class="modern-checkbox">
                                                            <input type="checkbox" name="marketing_consent">
                                                            <span class="checkmark"></span>
                                                            <span class="label-text">{{ _lang('I consent to receive marketing communications (optional)') }}</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Digital Signature -->
                                            <div class="consent-section">
                                                <div class="consent-header">
                                                    <h5><i class="icofont-pen-alt-1"></i> {{ _lang('Digital Signature') }}</h5>
                                                </div>
                                                <div class="consent-content">
                                                    <p>{{ _lang('By providing your digital signature below, you confirm that:') }}</p>
                                                    <ul class="consent-list">
                                                        <li>{{ _lang('All information provided is true and accurate') }}</li>
                                                        <li>{{ _lang('You understand the loan terms and conditions') }}</li>
                                                        <li>{{ _lang('You agree to the privacy policy and terms of service') }}</li>
                                                        <li>{{ _lang('You authorize the processing of this application') }}</li>
                                                    </ul>
                                                    <div class="signature-area">
                                                        <canvas id="signature-canvas" width="400" height="150"></canvas>
                                                        <div class="signature-controls">
                                                            <button type="button" id="clear-signature" class="btn-clear">
                                                                <i class="icofont-eraser"></i>
                                                                {{ _lang('Clear') }}
                                                            </button>
                                                            <span class="signature-instruction">{{ _lang('Please sign above') }}</span>
                                                        </div>
                                                        <input type="hidden" name="digital_signature" id="digital_signature">
                                                    </div>
                                                </div>
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

                                            <div class="form-group-modern">
                                                <label class="modern-checkbox">
                                                    <input type="checkbox" name="agree" id="agree" {{ old('agree') ? 'checked' : '' }}>
                                                    <span class="checkmark"></span>
                                                    <span class="label-text">
                                                        {{ _lang('I agree with') }}
                                                        <a href="{{ url('/' . get_option('privacy_policy_page')) }}" target="_blank" class="terms-link">{{ _lang('Privacy Policy') }}</a>
                                                        {{ _lang('and') }}
                                                        <a href="{{ url('/' . get_option('terms_condition_page')) }}" target="_blank" class="terms-link">{{ _lang('Terms & Conditions') }}</a>
                                                    </span>
                                                </label>
                                                @if ($errors->has('agree'))
                                                    <div class="error-message">
                                                        <i class="icofont-warning"></i>
                                                        <span>{{ $errors->first('agree') }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Form Navigation -->
                                        <div class="form-navigation">
                                            <button type="button" class="btn-modern-secondary" id="prev-step" style="display: none;">
                                                <i class="icofont-arrow-left"></i>
                                                <span>{{ _lang('Previous') }}</span>
                                            </button>

                                            <button type="button" class="btn-modern-primary" id="next-step">
                                                <span>{{ _lang('Next') }}</span>
                                                <i class="icofont-arrow-right"></i>
                                            </button>

                                            <button type="submit" class="btn-modern-primary" id="create-account-btn" style="display: none;" disabled>
                                                <span>{{ _lang('Create Account') }}</span>
                                                <i class="icofont-check"></i>
                                            </button>
                                        </div>

                                        <div class="signup-link" style="margin-top: 2rem; text-align: center;">
                                            <span>{{ _lang('Already have an account?') }}</span>
                                            <a href="{{ route('login') }}" class="signup-btn">
                                                {{ _lang('Sign In') }}
                                            </a>
                                        </div>
                                    </form>
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
        grecaptcha.execute('{{ get_option('recaptcha_site_key') }}', {action: 'register'}).then(function(token) {
        if (token) {
            document.getElementById('recaptcha').value = token;
        }
        });
    });
</script>
@endif

@section('js-script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Multi-step form functionality
        let currentStep = 1;
        const totalSteps = 7;
        let loanCounter = 1;

        const steps = document.querySelectorAll('.step');
        const formSteps = document.querySelectorAll('.form-step');
        const nextBtn = document.getElementById('next-step');
        const prevBtn = document.getElementById('prev-step');
        const submitBtn = document.getElementById('create-account-btn');
        const agreeCheckbox = document.getElementById('agree');
        const employmentStatus = document.querySelector('select[name="employment_status"]');
        const employmentFields = document.querySelector('.employment-fields');

        // Initialize form
        updateStepDisplay();

        // Next button functionality
        nextBtn.addEventListener('click', function() {
            if (validateCurrentStep()) {
                if (currentStep < totalSteps) {
                    currentStep++;
                    updateStepDisplay();
                }
            }
        });

        // Previous button functionality
        prevBtn.addEventListener('click', function() {
            if (currentStep > 1) {
                currentStep--;
                updateStepDisplay();
            }
        });

        // Step click functionality
        steps.forEach((step, index) => {
            step.addEventListener('click', function() {
                const stepNumber = index + 1;
                if (stepNumber <= currentStep || isStepCompleted(stepNumber - 1)) {
                    currentStep = stepNumber;
                    updateStepDisplay();
                }
            });
        });

        // Employment status change
        if (employmentStatus) {
            employmentStatus.addEventListener('change', function() {
                if (this.value === 'employed' || this.value === 'self_employed') {
                    employmentFields.style.display = 'block';
                    employmentFields.classList.add('show');
                } else {
                    employmentFields.style.display = 'none';
                    employmentFields.classList.remove('show');
                }
            });
        }

        // Financial details form interactions
        const hasSecondaryAccount = document.getElementById('has_secondary_account');
        const secondaryBankFields = document.querySelector('.secondary-bank-fields');
        const hasMobileMoney = document.getElementById('has_mobile_money');
        const mobileMoneyFields = document.querySelector('.mobile-money-fields');
        const hasExistingLoans = document.getElementById('has_existing_loans');
        const existingLoansSection = document.querySelector('.existing-loans-section');

        // Secondary bank account toggle
        if (hasSecondaryAccount) {
            hasSecondaryAccount.addEventListener('change', function() {
                if (this.checked) {
                    secondaryBankFields.style.display = 'block';
                    secondaryBankFields.classList.add('show');
                } else {
                    secondaryBankFields.style.display = 'none';
                    secondaryBankFields.classList.remove('show');
                }
            });
        }

        // Mobile money toggle
        if (hasMobileMoney) {
            hasMobileMoney.addEventListener('change', function() {
                if (this.checked) {
                    mobileMoneyFields.style.display = 'block';
                    mobileMoneyFields.classList.add('show');
                } else {
                    mobileMoneyFields.style.display = 'none';
                    mobileMoneyFields.classList.remove('show');
                }
            });
        }

        // Existing loans toggle
        if (hasExistingLoans) {
            hasExistingLoans.addEventListener('change', function() {
                if (this.checked) {
                    existingLoansSection.style.display = 'block';
                    existingLoansSection.classList.add('show');
                } else {
                    existingLoansSection.style.display = 'none';
                    existingLoansSection.classList.remove('show');
                    // Reset loan totals
                    document.querySelector('input[name="total_existing_debt_amount"]').value = '';
                    document.querySelector('input[name="total_monthly_debt_payments"]').value = '';
                }
            });
        }

        function updateStepDisplay() {
            // Update step indicators
            steps.forEach((step, index) => {
                const stepNumber = index + 1;
                step.classList.remove('active', 'completed');

                if (stepNumber === currentStep) {
                    step.classList.add('active');
                } else if (stepNumber < currentStep) {
                    step.classList.add('completed');
                }
            });

            // Update form steps
            formSteps.forEach((formStep, index) => {
                formStep.classList.remove('active');
                if (index + 1 === currentStep) {
                    formStep.classList.add('active');
                }
            });

            // Update navigation buttons
            prevBtn.style.display = currentStep > 1 ? 'flex' : 'none';
            nextBtn.style.display = currentStep < totalSteps ? 'flex' : 'none';
            submitBtn.style.display = currentStep === totalSteps ? 'flex' : 'none';

            // Update submit button state
            if (currentStep === totalSteps) {
                submitBtn.disabled = !agreeCheckbox.checked;
            }

            // Scroll to top of form
            document.querySelector('.auth-form-container').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        function validateCurrentStep() {
            const currentFormStep = document.querySelector(`.form-step[data-step="${currentStep}"]`);
            const requiredFields = currentFormStep.querySelectorAll('[required]');
            let isValid = true;

            // Remove previous error styling
            currentFormStep.classList.remove('has-errors');

            requiredFields.forEach(field => {
                field.style.borderColor = '#e1e5e9';

                if (!field.value.trim()) {
                    field.style.borderColor = '#e74c3c';
                    isValid = false;
                }

                // Special validation for email
                if (field.type === 'email' && field.value) {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(field.value)) {
                        field.style.borderColor = '#e74c3c';
                        isValid = false;
                    }
                }

                // Special validation for password confirmation
                if (field.name === 'password_confirmation' && field.value) {
                    const password = document.getElementById('password').value;
                    if (field.value !== password) {
                        field.style.borderColor = '#e74c3c';
                        isValid = false;
                    }
                }
            });

            if (!isValid) {
                currentFormStep.classList.add('has-errors');
                // Show error message
                showStepError('Please fill in all required fields correctly.');
            }

            return isValid;
        }

        function isStepCompleted(stepIndex) {
            // Check if previous steps are completed
            for (let i = 1; i <= stepIndex; i++) {
                const stepElement = document.querySelector(`.form-step[data-step="${i}"]`);
                const requiredFields = stepElement.querySelectorAll('[required]');

                for (let field of requiredFields) {
                    if (!field.value.trim()) {
                        return false;
                    }
                }
            }
            return true;
        }

        function showStepError(message) {
            // Remove existing error
            const existingError = document.querySelector('.step-error');
            if (existingError) {
                existingError.remove();
            }

            // Create new error
            const error = document.createElement('div');
            error.className = 'step-error modern-alert alert-error';
            error.innerHTML = `<i class="icofont-warning"></i><span>${message}</span>`;
            error.style.marginTop = '1rem';

            const currentFormStep = document.querySelector(`.form-step[data-step="${currentStep}"]`);
            currentFormStep.appendChild(error);

            // Remove error after 5 seconds
            setTimeout(() => {
                if (error.parentNode) {
                    error.remove();
                }
            }, 5000);
        }

        // Enhanced checkbox functionality for terms agreement
        if (agreeCheckbox) {
            agreeCheckbox.addEventListener('change', function() {
                if (currentStep === totalSteps) {
                    submitBtn.disabled = !this.checked;

                    // Add visual feedback
                    if (this.checked) {
                        submitBtn.style.opacity = '1';
                        submitBtn.style.transform = 'scale(1)';
                    } else {
                        submitBtn.style.opacity = '0.6';
                        submitBtn.style.transform = 'scale(0.98)';
                    }
                }
            });
        }

        // Password strength indicator
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('password-confirm');

        if (passwordInput) {
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                const strength = calculatePasswordStrength(password);
                showPasswordStrength(strength);
            });
        }

        if (confirmPasswordInput) {
            confirmPasswordInput.addEventListener('input', function() {
                const password = passwordInput.value;
                const confirmPassword = this.value;

                if (confirmPassword && password !== confirmPassword) {
                    this.style.borderColor = '#e74c3c';
                    showPasswordMismatch();
                } else {
                    this.style.borderColor = '#e1e5e9';
                    hidePasswordMismatch();
                }
            });
        }

        function calculatePasswordStrength(password) {
            let strength = 0;
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            return strength;
        }

        function showPasswordStrength(strength) {
            const existingIndicator = document.querySelector('.password-strength');
            if (existingIndicator) {
                existingIndicator.remove();
            }

            if (strength > 0) {
                const indicator = document.createElement('div');
                indicator.className = 'password-strength';
                indicator.style.marginTop = '8px';
                indicator.style.fontSize = '0.8rem';

                const strengthText = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong'][strength - 1];
                const strengthColor = ['#e74c3c', '#e67e22', '#f39c12', '#27ae60', '#2ecc71'][strength - 1];

                indicator.innerHTML = `
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <div style="flex: 1; height: 4px; background: #e1e5e9; border-radius: 2px; overflow: hidden;">
                            <div style="width: ${strength * 20}%; height: 100%; background: ${strengthColor}; transition: all 0.3s ease;"></div>
                        </div>
                        <span style="color: ${strengthColor}; font-weight: 500;">${strengthText}</span>
                    </div>
                `;

                passwordInput.parentNode.parentNode.appendChild(indicator);
            }
        }

        function showPasswordMismatch() {
            const existingError = document.querySelector('.password-mismatch');
            if (!existingError) {
                const error = document.createElement('div');
                error.className = 'password-mismatch error-message';
                error.innerHTML = '<i class="icofont-warning"></i><span>Passwords do not match</span>';
                confirmPasswordInput.parentNode.parentNode.appendChild(error);
            }
        }

        function hidePasswordMismatch() {
            const existingError = document.querySelector('.password-mismatch');
            if (existingError) {
                existingError.remove();
            }
        }

        // Auto-save form data to localStorage
        const formInputs = document.querySelectorAll('.form-control-modern');
        formInputs.forEach(input => {
            // Load saved data
            const savedValue = localStorage.getItem(`register_${input.name}`);
            if (savedValue && !input.value) {
                input.value = savedValue;
            }

            // Save data on change
            input.addEventListener('input', function() {
                localStorage.setItem(`register_${this.name}`, this.value);
            });
        });

        // Clear saved data on successful submission
        document.querySelector('.multi-step-form').addEventListener('submit', function() {
            formInputs.forEach(input => {
                localStorage.removeItem(`register_${input.name}`);
            });
        });

        // Expense calculation functions
        function calculateExpenseTotals() {
            const expenseFields = [
                'housing_expenses', 'groceries_expenses', 'transport_expenses',
                'education_expenses', 'medical_expenses', 'debt_repayment_expenses',
                'miscellaneous_expenses'
            ];

            let totalExpenses = 0;

            expenseFields.forEach(field => {
                const input = document.querySelector(`input[name="${field}"]`);
                if (input) {
                    const value = parseFloat(input.value) || 0;
                    totalExpenses += value;
                }
            });

            // Update hidden total field
            const totalField = document.getElementById('monthly_expenses_total');
            if (totalField) {
                totalField.value = totalExpenses.toFixed(2);
            }

            // Update summary display
            updateExpenseSummary(totalExpenses);

            return totalExpenses;
        }

        function updateExpenseSummary(totalExpenses) {
            const monthlyIncomeInput = document.querySelector('input[name="monthly_income"]');
            const monthlyIncome = parseFloat(monthlyIncomeInput?.value) || 0;

            // Update total expenses display
            const totalExpensesDisplay = document.getElementById('total-expenses');
            if (totalExpensesDisplay) {
                totalExpensesDisplay.textContent = `R${totalExpenses.toLocaleString('en-ZA', {minimumFractionDigits: 2})}`;
            }

            // Calculate disposable income
            const disposableIncome = monthlyIncome - totalExpenses;
            const disposableIncomeDisplay = document.getElementById('disposable-income');
            if (disposableIncomeDisplay) {
                disposableIncomeDisplay.textContent = `R${disposableIncome.toLocaleString('en-ZA', {minimumFractionDigits: 2})}`;
                disposableIncomeDisplay.style.color = disposableIncome >= 0 ? '#27ae60' : '#e74c3c';
            }

            // Calculate expense ratio
            let expenseRatio = 0;
            if (monthlyIncome > 0) {
                expenseRatio = (totalExpenses / monthlyIncome) * 100;
            }

            const expenseRatioDisplay = document.getElementById('expense-ratio');
            const ratioFill = document.getElementById('ratio-fill');

            if (expenseRatioDisplay && ratioFill) {
                expenseRatioDisplay.textContent = `${expenseRatio.toFixed(1)}%`;
                ratioFill.style.width = `${Math.min(expenseRatio, 100)}%`;

                // Color coding based on ratio
                ratioFill.className = 'ratio-fill';
                if (expenseRatio > 90) {
                    ratioFill.classList.add('danger');
                } else if (expenseRatio > 70) {
                    ratioFill.classList.add('warning');
                }
            }
        }

        function validateExpenseRange(category) {
            const amountInput = document.querySelector(`input[name="${category}_expenses"]`);
            const rangeSelect = document.querySelector(`select[name="${category}_range"]`);
            const categoryElement = document.querySelector(`[data-category="${category}"]`);

            if (!amountInput || !rangeSelect || !categoryElement) return;

            const amount = parseFloat(amountInput.value) || 0;
            const range = rangeSelect.value;

            // Remove existing validation
            categoryElement.classList.remove('valid', 'invalid');
            const existingValidation = categoryElement.querySelector('.expense-validation');
            if (existingValidation) {
                existingValidation.remove();
            }

            if (amount > 0 && range) {
                const isValid = isAmountInRange(amount, range);

                categoryElement.classList.add(isValid ? 'valid' : 'invalid');

                const validation = document.createElement('div');
                validation.className = `expense-validation ${isValid ? 'valid' : 'invalid'}`;
                validation.innerHTML = `
                    <i class="icofont-${isValid ? 'check' : 'close'}"></i>
                    <span>${isValid ? 'Amount matches selected range' : 'Amount does not match selected range'}</span>
                `;

                categoryElement.appendChild(validation);
            }
        }

        function isAmountInRange(amount, range) {
            const rangeParts = range.split('-');

            if (range.includes('+')) {
                const min = parseInt(rangeParts[0]);
                return amount >= min;
            }

            const min = parseInt(rangeParts[0]);
            const max = parseInt(rangeParts[1]);

            return amount >= min && amount <= max;
        }

        // Loan calculation functions
        function calculateLoanTotals() {
            let totalOutstanding = 0;
            let totalMonthlyPayments = 0;

            document.querySelectorAll('.loan-item').forEach(function(loanItem) {
                const outstanding = parseFloat(loanItem.querySelector('input[name*="[outstanding_amount]"]').value) || 0;
                const monthly = parseFloat(loanItem.querySelector('input[name*="[monthly_payment]"]').value) || 0;

                totalOutstanding += outstanding;
                totalMonthlyPayments += monthly;
            });

            document.querySelector('input[name="total_existing_debt_amount"]').value = totalOutstanding.toFixed(2);
            document.querySelector('input[name="total_monthly_debt_payments"]').value = totalMonthlyPayments.toFixed(2);
        }

        // Add event listeners for expense calculations
        document.addEventListener('input', function(e) {
            // Handle expense amount changes
            if (e.target.classList.contains('expense-amount')) {
                const category = e.target.getAttribute('data-category');
                calculateExpenseTotals();
                if (category) {
                    validateExpenseRange(category);
                }
            }

            // Handle monthly income changes
            if (e.target.name === 'monthly_income') {
                calculateExpenseTotals();
            }

            // Handle loan amount changes
            if (e.target.name && (e.target.name.includes('[outstanding_amount]') || e.target.name.includes('[monthly_payment]'))) {
                calculateLoanTotals();
            }
        });

        // Handle expense range changes
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('expense-range')) {
                const category = e.target.getAttribute('data-category');
                if (category) {
                    validateExpenseRange(category);
                }
            }
        });
    });

    // Global functions for loan management
    function addLoan() {
        loanCounter++;
        const loansContainer = document.querySelector('.loans-container');

        const loanTemplate = `
            <div class="loan-item" data-loan="${loanCounter}">
                <div class="loan-header">
                    <h5>Loan/Debt #${loanCounter}</h5>
                    <button type="button" class="btn-remove-loan" onclick="removeLoan(${loanCounter})">
                        <i class="icofont-close"></i>
                    </button>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <div class="input-group-modern">
                                <div class="input-icon">
                                    <i class="icofont-bank"></i>
                                </div>
                                <select class="form-control-modern" name="loans[${loanCounter}][type]">
                                    <option value="">Loan Type</option>
                                    <option value="personal_loan">Personal Loan</option>
                                    <option value="business_loan">Business Loan</option>
                                    <option value="mortgage">Mortgage</option>
                                    <option value="car_loan">Car Loan</option>
                                    <option value="credit_card">Credit Card</option>
                                    <option value="student_loan">Student Loan</option>
                                    <option value="microfinance">Microfinance</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <div class="input-group-modern">
                                <div class="input-icon">
                                    <i class="icofont-building-alt"></i>
                                </div>
                                <input type="text" class="form-control-modern" name="loans[${loanCounter}][lender]">
                                <label class="floating-label">Lender/Bank Name</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group-modern">
                            <div class="input-group-modern">
                                <div class="input-icon">
                                    <i class="icofont-money"></i>
                                </div>
                                <input type="number" class="form-control-modern" name="loans[${loanCounter}][original_amount]" step="0.01">
                                <label class="floating-label">Original Amount</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group-modern">
                            <div class="input-group-modern">
                                <div class="input-icon">
                                    <i class="icofont-chart-line"></i>
                                </div>
                                <input type="number" class="form-control-modern" name="loans[${loanCounter}][outstanding_amount]" step="0.01">
                                <label class="floating-label">Outstanding Amount</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group-modern">
                            <div class="input-group-modern">
                                <div class="input-icon">
                                    <i class="icofont-calendar"></i>
                                </div>
                                <input type="number" class="form-control-modern" name="loans[${loanCounter}][monthly_payment]" step="0.01">
                                <label class="floating-label">Monthly Payment</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <div class="input-group-modern">
                                <div class="input-icon">
                                    <i class="icofont-percentage"></i>
                                </div>
                                <input type="number" class="form-control-modern" name="loans[${loanCounter}][interest_rate]" step="0.01">
                                <label class="floating-label">Interest Rate (%)</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <div class="input-group-modern">
                                <div class="input-icon">
                                    <i class="icofont-calendar"></i>
                                </div>
                                <input type="date" class="form-control-modern" name="loans[${loanCounter}][end_date]">
                                <label class="floating-label">Expected End Date</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        loansContainer.insertAdjacentHTML('beforeend', loanTemplate);

        // Show remove buttons for all loans if more than one
        if (loanCounter > 1) {
            document.querySelectorAll('.btn-remove-loan').forEach(btn => {
                btn.style.display = 'block';
            });
        }
    }

    function removeLoan(loanId) {
        const loanItem = document.querySelector(`[data-loan="${loanId}"]`);
        if (loanItem) {
            loanItem.remove();

            // Hide remove buttons if only one loan remains
            const remainingLoans = document.querySelectorAll('.loan-item');
            if (remainingLoans.length === 1) {
                document.querySelectorAll('.btn-remove-loan').forEach(btn => {
                    btn.style.display = 'none';
                });
            }

            // Recalculate totals
            calculateLoanTotals();
        }
    }

    function calculateLoanTotals() {
        let totalOutstanding = 0;
        let totalMonthlyPayments = 0;

        document.querySelectorAll('.loan-item').forEach(function(loanItem) {
            const outstanding = parseFloat(loanItem.querySelector('input[name*="[outstanding_amount]"]').value) || 0;
            const monthly = parseFloat(loanItem.querySelector('input[name*="[monthly_payment]"]').value) || 0;

            totalOutstanding += outstanding;
            totalMonthlyPayments += monthly;
        });

        document.querySelector('input[name="total_existing_debt_amount"]').value = totalOutstanding.toFixed(2);
        document.querySelector('input[name="total_monthly_debt_payments"]').value = totalMonthlyPayments.toFixed(2);
    }
</script>
@endsection
