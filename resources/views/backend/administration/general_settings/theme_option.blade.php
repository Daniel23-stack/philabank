@extends('layouts.app')

@section('content')
<div class="row">
    @php $settings = \App\Models\Setting::all(); @endphp

    <div class="col-lg-3 col-md-4 col-sm-5">
		<ul class="nav flex-column nav-tabs settings-tab" role="tablist">
			 <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home-page">{{ _lang('Home Page') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#about-page">{{ _lang('About Page') }}</a></li>
             <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#signup-page">{{ _lang('Login & Register Page') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#footer">{{ _lang('Footer Setion') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#seo">{{ _lang('SEO Settings') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#gdpr-page">{{ _lang('GDPR Cookie') }}</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#custom_css">{{ _lang('Custom CSS & JS') }}</a></li>
		</ul>
	</div>

    <div class="col-lg-9 col-md-8 col-sm-7">
        <div class="tab-content">
            <div id="home-page" class="tab-pane active">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">{{ _lang('Home Page Settings') }}</h4>
                    </div>

                    @php $navigations = App\Models\Navigation::where('status',1)->get(); @endphp

                    <div class="card-body">
                        <form method="post" class="settings-submit params-panel" autocomplete="off"
                            action="{{ route('theme_option.update','store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Main Heading') }}</label>
                                        <input type="text" class="form-control" name="main_heading"
                                            value="{{ get_trans_option('main_heading') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Sub Heading') }}</label>
                                        <input type="text" class="form-control" name="sub_heading"
                                            value="{{ get_trans_option('sub_heading') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Primary Menu') }}</label>
                                        <select class="form-control auto-select" data-selected="{{ get_option('primary_menu') }}" name="primary_menu">
                                            <option value="">{{ _lang('Select One') }}</option>
                                            @foreach($navigations as $navigation)
                                                <option value="{{ $navigation->id }}">{{ $navigation->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Home Banner') }}</label>
                                        <input type="file" class="dropify" name="home_banner" data-default-file="{{ get_setting($settings, 'home_banner') != '' ? asset('/public/uploads/media/'.get_setting($settings, 'home_banner')) : asset('public/theme/images/slider-bg-1.jpg') }}"  data-allowed-file-extensions="png jpg">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('About Us Banner') }}</label>
                                        <input type="file" class="dropify" name="home_about_us_banner" data-default-file="{{ get_setting($settings, 'home_about_us_banner') != '' ? asset('/public/uploads/media/'.get_setting($settings, 'home_about_us_banner')) : asset('public/theme/images/about-us.jpg') }}"  data-allowed-file-extensions="png jpg">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Total Customers') }}</label>
                                        <input type="text" class="form-control" name="total_customer"
                                            value="{{ get_setting($settings, 'total_customer',0) }}">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Total Branches') }}</label>
                                        <input type="text" class="form-control" name="total_branch"
                                            value="{{ get_setting($settings, 'total_branch',0) }}">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Total Transactions') }}</label>
                                        <input type="text" class="form-control" name="total_transactions"
                                            value="{{ get_setting($settings, 'total_transactions',0) }}">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Total Countries') }}</label>
                                        <input type="text" class="form-control" name="total_countries"
                                            value="{{ get_setting($settings, 'total_countries',0) }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('About Us Heading') }}</label>
                                        <input type="text" class="form-control" name="home_about_us_heading"
                                            value="{{ get_trans_option('home_about_us_heading') }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('About Us Content') }}</label>
                                        <textarea class="form-control"
                                            name="home_about_us_content">{{ get_trans_option('home_about_us_content') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('About Us Button') }}</label>
                                        <input type="text" class="form-control" name="home_about_us_button"
                                            value="{{ get_trans_option('home_about_us_button','Services') }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('About Us Link') }}</label>
                                        <input type="text" class="form-control" name="home_about_us_link"
                                            value="{{ get_setting($settings, 'home_about_us_link') }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Services Heading') }}</label>
                                        <input type="text" class="form-control" name="home_service_heading"
                                            value="{{ get_trans_option('home_service_heading') }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Services Content') }}</label>
                                        <textarea class="form-control"
                                            name="home_service_content">{{ get_trans_option('home_service_content') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Fixed Deposit Section') }}</label>
                                        <select class="form-control auto-select" name="home_fixed_deposit_section"
                                            data-selected="{{ get_setting($settings, 'home_fixed_deposit_section', 1) }}">
                                            <option value="1">{{ _lang('Enabled') }}</option>
                                            <option value="0">{{ _lang('Disabled') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Fixed Deposit Heading') }}</label>
                                        <input type="text" class="form-control" name="home_fixed_deposit_heading"
                                            value="{{ get_trans_option('home_fixed_deposit_heading') }}">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Fixed Deposit Content') }}</label>
                                        <textarea class="form-control"
                                            name="home_fixed_deposit_content">{{ get_trans_option('home_fixed_deposit_content') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('DPS Section') }}</label>
                                        <select class="form-control auto-select" name="dps_section"
                                            data-selected="{{ get_setting($settings, 'dps_section', 1) }}">
                                            <option value="1">{{ _lang('Enabled') }}</option>
                                            <option value="0">{{ _lang('Disabled') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('DSP Heading') }}</label>
                                        <input type="text" class="form-control" name="home_dps_heading"
                                            value="{{ get_trans_option('home_dps_heading') }}">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('DSP Content') }}</label>
                                        <textarea class="form-control"
                                            name="home_dps_content">{{ get_trans_option('home_dps_content') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Loan Section') }}</label>
                                        <select class="form-control auto-select" name="home_loan_section"
                                            data-selected="{{ get_setting($settings, 'home_loan_section', 1) }}">
                                            <option value="1">{{ _lang('Enabled') }}</option>
                                            <option value="0">{{ _lang('Disabled') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Loan Heading') }}</label>
                                        <input type="text" class="form-control" name="home_loan_heading"
                                            value="{{ get_trans_option('home_loan_heading') }}">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Loan Content') }}</label>
                                        <textarea class="form-control"
                                            name="home_loan_content">{{ get_trans_option('home_loan_content') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Testimonial Heading') }}</label>
                                        <input type="text" class="form-control" name="home_testimonial_heading"
                                            value="{{ get_trans_option('home_testimonial_heading') }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Testimonial Content') }}</label>
                                        <textarea class="form-control"
                                            name="home_testimonial_content">{{ get_trans_option('home_testimonial_content') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="icofont-check-circled"></i> {{ _lang('Save Settings') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div id="about-page" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">{{ _lang('About Page Settings') }}</h4>
                    </div>

                    <div class="card-body">
                        <form method="post" class="settings-submit params-panel" autocomplete="off"
                            action="{{ route('theme_option.update','store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Title') }}</label>
                                        <input type="text" class="form-control" name="about_page_title"
                                            value="{{ get_trans_option('about_page_title') }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Our Team Title') }}</label>
                                        <input type="text" class="form-control" name="our_team_title"
                                            value="{{ get_trans_option('our_team_title') }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Our Team Sub Title') }}</label>
                                        <input type="text" class="form-control" name="our_team_sub_title"
                                            value="{{ get_trans_option('our_team_sub_title') }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('About Us Image') }}</label>
                                        <input type="file" class="dropify" name="about_us_image" data-default-file="{{ get_setting($settings, 'about_us_image') != '' ? asset('/public/uploads/media/'.get_setting($settings, 'about_us_image')) : asset('public/theme/images/about-us-main.jpg') }}"  data-allowed-file-extensions="png jpg">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('About Us Content') }}</label>
                                        <textarea class="form-control" rows="6"
                                            name="about_us_content">{{ get_trans_option('about_us_content') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="icofont-check-circled"></i> {{ _lang('Save Settings') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>


            <div id="signup-page" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">{{ _lang('Login & Register Page') }}</h4>
                    </div>

                    <div class="card-body">
                        <form method="post" class="settings-submit params-panel" autocomplete="off"
                            action="{{ route('theme_option.update','store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                @if(get_setting($settings, 'website_enable', 'yes') == 'yes')
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Privacy Policy Page') }}</label>
                                        <select class="form-control select2 auto-select" data-selected="{{ get_setting($settings, 'privacy_policy_page') }}" name="privacy_policy_page">
                                            <option value="">{{ _lang('Select Page') }}</option>
                                            @foreach(\App\Models\Page::all() as $page)
                                            <option value="{{ $page->slug }}">{{ $page->translation->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Terms & Condition Page') }}</label>
                                        <select class="form-control select2 auto-select" data-selected="{{ get_setting($settings, 'terms_condition_page') }}" name="terms_condition_page">
                                            <option value="">{{ _lang('Select Page') }}</option>
                                            @foreach(\App\Models\Page::all() as $page)
                                            <option value="{{ $page->slug }}">{{ $page->translation->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @else
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Privacy Policy Page URL') }}</label>
                                        <input type="text" class="form-control" value="{{ get_setting($settings, 'privacy_policy_page_url') }}" name="privacy_policy_page_url">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Terms & Condition Page URL') }}</label>
                                        <input type="text" class="form-control" value="{{ get_setting($settings, 'terms_condition_page_url') }}" name="terms_condition_page_url">
                                    </div>
                                </div>
                                @endif

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Background Color 1') }}</label>
                                        <input type="color" class="form-control" value="{{ get_setting($settings, 'auth_bg_color_1', '#26437e') }}" name="auth_bg_color_1">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Background Color 2') }}</label>
                                        <input type="color" class="form-control" value="{{ get_setting($settings, 'auth_bg_color_2', '#0b2559') }}" name="auth_bg_color_2">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Image') }}</label>
                                        <input type="file" class="dropify" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" data-default-file="{{ get_setting($settings, 'auth_bg_image') == '' ? asset('public/auth/images/auth-bg.jpg') : asset('public/uploads/media/'.get_setting($settings, 'auth_bg_image')) }}" name="auth_bg_image">
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-3">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="icofont-check-circled"></i> {{ _lang('Save Settings') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <div id="footer" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">{{ _lang('Footer Settings') }}</h4>
                    </div>

                    <div class="card-body">
                        <form method="post" class="settings-submit params-panel" autocomplete="off"
                            action="{{ route('theme_option.update','store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Footer Menu 1 Title') }}</label>
                                        <input type="text" class="form-control" name="footer_menu_1_title" value="{{ get_trans_option('footer_menu_1_title') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Footer Menu 1') }}</label>
                                        <select class="form-control auto-select" data-selected="{{ get_setting($settings, 'footer_menu_1') }}" name="footer_menu_1">
                                            <option value="">{{ _lang('Select One') }}</option>
                                            @foreach($navigations as $navigation)
                                                <option value="{{ $navigation->id }}">{{ $navigation->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Footer Menu 2 Title') }}</label>
                                        <input type="text" class="form-control" name="footer_menu_2_title" value="{{ get_trans_option('footer_menu_2_title') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Footer Menu 2') }}</label>
                                        <select class="form-control auto-select" data-selected="{{ get_setting($settings, 'footer_menu_2') }}" name="footer_menu_2">
                                            <option value="">{{ _lang('Select One') }}</option>
                                            @foreach($navigations as $navigation)
                                                <option value="{{ $navigation->id }}">{{ $navigation->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Footer About Us') }}</label>
                                        <textarea class="form-control"
                                            name="footer_about_us">{{ get_trans_option('footer_about_us') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Facebook Link') }}</label>
                                        <input type="text" class="form-control" name="facebook_link"
                                            value="{{ get_setting($settings, 'facebook_link') }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Twitter Link') }}</label>
                                        <input type="text" class="form-control" name="twitter_link"
                                            value="{{ get_setting($settings, 'twitter_link') }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Linkedin Link') }}</label>
                                        <input type="text" class="form-control" name="linkedin_link"
                                            value="{{ get_setting($settings, 'linkedin_link') }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Copyright Text') }}</label>
                                        <input type="text" class="form-control" name="copyright"
                                            value="{{ get_trans_option('copyright') }}">
                                    </div>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="icofont-check-circled"></i> {{ _lang('Save Settings') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <div id="seo" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">{{ _lang('SEO Settings') }}</h4>
                    </div>

                    <div class="card-body">
                        <form method="post" class="settings-submit params-panel" autocomplete="off"
                            action="{{ route('theme_option.update','store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Meta Keywords') }}</label>
                                        <input type="text" class="form-control" name="meta_keywords"
                                            value="{{ get_setting($settings, 'meta_keywords') }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Meta Content') }}</label>
                                        <textarea class="form-control"
                                            name="meta_content">{{ get_setting($settings, 'meta_content') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="icofont-check-circled"></i> {{ _lang('Save Settings') }}</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>

            <div id="gdpr-page" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">{{ _lang('GDPR Cookie') }}</h4>
                    </div>

                    <div class="card-body">
                        <form method="post" class="settings-submit params-panel" autocomplete="off"
                            action="{{ route('theme_option.update','store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Cookie Content') }}</label>
                                        <textarea class="form-control" rows="4"
                                            name="gdpr_cookie_content">{{ get_setting($settings, 'gdpr_cookie_content') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('Privacy Policy Page') }}</label>
                                        <select class="form-control select2 auto-select" data-selected="{{ get_setting($settings, 'gdpr_privacy_policy_page') }}" name="gdpr_privacy_policy_page">
                                            <option value="">{{ _lang('Select Page') }}</option>
                                            @foreach(\App\Models\Page::all() as $page)
                                            <option value="{{ $page->slug }}">{{ $page->translation->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Status') }}</label>
										<select class="form-control" name="gdpr_cookie_status" required>
											<option value="0" {{ get_setting($settings, 'gdpr_cookie_status') == '0' ? 'selected' : '' }}>{{ _lang('Disabled') }}</option>
											<option value="1" {{ get_setting($settings, 'gdpr_cookie_status') == '1' ? 'selected' : '' }}>{{ _lang('Enable') }}</option>
										</select>
									</div>
								</div>

                                <div class="col-md-12 mt-3">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="icofont-check-circled"></i> {{ _lang('Save Settings') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>


            <div id="custom_css" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">{{ _lang('Custom CSS & JS') }}</h4>
                    </div>

                    <div class="card-body">
                        <form method="post" class="settings-submit params-panel" autocomplete="off"
                            action="{{ route('theme_option.update','store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('CSS CODE') }}</label>
                                        <textarea class="form-control" rows="10"
                                            name="custom_css">{{ get_setting($settings, 'custom_css') }}</textarea>
                                        <small class="text-danger">{{ _lang('Write Your CSS Code without style tag') }} !</small>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">{{ _lang('JS CODE') }}</label>
                                        <textarea class="form-control" rows="10"
                                            name="custom_js">{{ get_setting($settings, 'custom_js') }}</textarea>
                                        <small class="text-danger">{{ _lang('Write Your JS Code without script tag') }} !</small>
                                    </div>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="icofont-check-circled"></i> {{ _lang('Save Settings') }}</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>

        </div><!--End Tab COntent-->
    </div>
</div>
@endsection