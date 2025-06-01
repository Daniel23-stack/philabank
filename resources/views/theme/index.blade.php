@extends('theme.layout')

@section('content')
<!-- Modern Hero Section with Animations -->
<section class="modern-hero" id="hero">
	<div class="hero-background">
		<div class="floating-shapes">
			<div class="shape shape-1"></div>
			<div class="shape shape-2"></div>
			<div class="shape shape-3"></div>
			<div class="shape shape-4"></div>
		</div>
	</div>

	<div class="container">
		<div class="row align-items-center min-vh-100">
			<div class="col-lg-6">
				<div class="hero-content" data-aos="fade-right" data-aos-duration="1000">
					<div class="hero-badge" data-aos="fade-up" data-aos-delay="200">
						<span class="badge-text">🚀 Modern Banking Solutions</span>
					</div>
					<h1 class="hero-title" data-aos="fade-up" data-aos-delay="400">
						{{ get_trans_option('main_heading', 'Smart way to keep your money safe and secure') }}
					</h1>
					<p class="hero-subtitle" data-aos="fade-up" data-aos-delay="600">
						{{ get_trans_option('sub_heading', 'Transfer money within minutes and save money for your future. All of your desired service in single platform.') }}
					</p>
					<div class="hero-buttons" data-aos="fade-up" data-aos-delay="800">
						<a href="{{ get_option('allow_singup') == 'yes' ? route('register') : route('login') }}" class="btn btn-modern-primary">
							<span>{{ _lang('Get Started') }}</span>
							<i class="icofont-simple-right"></i>
						</a>
						<a href="#services" class="btn btn-modern-outline">
							<span>{{ _lang('Learn More') }}</span>
						</a>
					</div>
					<div class="hero-stats" data-aos="fade-up" data-aos-delay="1000">
						<div class="stat-item">
							<div class="stat-number">{{ get_option('total_customer', '10K') }}+</div>
							<div class="stat-label">{{ _lang('Happy Customers') }}</div>
						</div>
						<div class="stat-item">
							<div class="stat-number">{{ get_option('total_transactions', '1M') }}+</div>
							<div class="stat-label">{{ _lang('Transactions') }}</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="hero-visual" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="400">
					<div class="hero-card floating">
						<div class="card-content">
							<div class="card-header">
								<div class="card-icon">
									<i class="icofont-bank"></i>
								</div>
								<div class="card-title">Digital Banking</div>
							</div>
							<div class="card-body">
								<div class="balance-display">
									<div class="balance-label">Available Balance</div>
									<div class="balance-amount">$12,450.00</div>
								</div>
								<div class="card-actions">
									<button class="action-btn">
										<i class="icofont-send-mail"></i>
										<span>Send</span>
									</button>
									<button class="action-btn">
										<i class="icofont-download"></i>
										<span>Receive</span>
									</button>
									<button class="action-btn">
										<i class="icofont-chart-growth"></i>
										<span>Invest</span>
									</button>
								</div>
							</div>
						</div>
					</div>
					<div class="floating-elements">
						<div class="floating-card card-1">
							<i class="icofont-shield-alt"></i>
							<span>Secure</span>
						</div>
						<div class="floating-card card-2">
							<i class="icofont-flash"></i>
							<span>Fast</span>
						</div>
						<div class="floating-card card-3">
							<i class="icofont-24-hours"></i>
							<span>24/7</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section about">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-6">
				<div class="about-img">
					<img src="{{ get_option('home_about_us_banner') == '' ? asset('public/theme/images/about-us.jpg') : media_images(get_option('home_about_us_banner')) }}" alt="" class="img-fluid">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="about-content pl-4 mt-4 mt-lg-0">
					<h2 class="title-color">{{ get_trans_option('home_about_us_heading') }}</h2>
					<p class="mt-4 mb-5">{{ get_trans_option('home_about_us_content') }}</p>

					<a href="{{ get_option('home_about_us_link') }}" class="btn btn-main-2 btn-icon">{{ get_trans_option('home_about_us_button','Services') }}<i class="icofont-simple-right ml-3"></i></a>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="cta-section">
	<div class="container">
		<div class="cta position-relative">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="counter-stat">
						<i class="icofont-doctor"></i>
						<span class="h3">{{ get_option('total_customer',0) }}</span>+
						<p>{{ _lang('Customers') }}</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="counter-stat">
						<i class="icofont-flag"></i>
						<span class="h3">{{ get_option('total_branch',0) }}</span>
						<p>{{ _lang('Branches') }}</p>
					</div>
				</div>

				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="counter-stat">
						<i class="icofont-credit-card"></i>
						<span class="h3">{{ get_option('total_transactions',0) }}</span>M
						<p>{{ _lang('Total Transactions') }}</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="counter-stat">
						<i class="icofont-globe"></i>
						<span class="h3">{{ get_option('total_countries',0) }}</span>+
						<p>{{ _lang('Supported Country') }}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Modern Services Section -->
<section class="modern-services" id="services">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8 text-center">
				<div class="section-header" data-aos="fade-up" data-aos-duration="800">
					<div class="section-badge">
						<span>💼 Our Services</span>
					</div>
					<h2 class="section-title">{{ get_trans_option('home_service_heading', 'Banking Services Made Simple') }}</h2>
					<p class="section-subtitle">{{ get_trans_option('home_service_content', 'Experience the future of banking with our comprehensive digital solutions designed for your convenience.') }}</p>
				</div>
			</div>
		</div>

		<div class="row g-4">
		@foreach($services as $index => $service)
			<div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 200 }}" data-aos-duration="800">
				<div class="service-card modern-card">
					<div class="card-glow"></div>
					<div class="service-icon">
						{!! xss_clean($service->icon) !!}
					</div>
					<div class="service-content">
						<h4 class="service-title">{{ $service->translation->title }}</h4>
						<p class="service-description">{{ $service->translation->body }}</p>
					</div>
					<div class="service-hover-effect">
						<div class="hover-icon">
							<i class="icofont-arrow-right"></i>
						</div>
					</div>
				</div>
			</div>
		@endforeach
		</div>

		<!-- Interactive Features Grid -->
		<div class="features-grid" data-aos="fade-up" data-aos-delay="600">
			<div class="row g-4 mt-5">
				<div class="col-lg-3 col-md-6">
					<div class="feature-item" data-aos="zoom-in" data-aos-delay="200">
						<div class="feature-icon">
							<i class="icofont-shield-alt"></i>
						</div>
						<h5>Bank-Level Security</h5>
						<p>256-bit SSL encryption</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="feature-item" data-aos="zoom-in" data-aos-delay="400">
						<div class="feature-icon">
							<i class="icofont-flash"></i>
						</div>
						<h5>Instant Transfers</h5>
						<p>Real-time processing</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="feature-item" data-aos="zoom-in" data-aos-delay="600">
						<div class="feature-icon">
							<i class="icofont-support-faq"></i>
						</div>
						<h5>24/7 Support</h5>
						<p>Always here to help</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="feature-item" data-aos="zoom-in" data-aos-delay="800">
						<div class="feature-icon">
							<i class="icofont-globe"></i>
						</div>
						<h5>Global Access</h5>
						<p>Worldwide availability</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@if(get_option('home_fixed_deposit_section', 1) == 1)
<section class="section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7 text-center">
				<div class="section-title">
					<h2>{{ get_trans_option('home_fixed_deposit_heading') }}</h2>
					<div class="divider mx-auto my-4"></div>
					<p>{{ get_trans_option('home_fixed_deposit_content') }}</p>
				</div>
			</div>
		</div>

		<div class="row">
			@foreach($fdr_plans as $fdr_plan)
			<div class="col-lg-4">
				<div class="pricing-table mb-4">
					<div class="pricing-table-head">
						<h4 class="my-3">{{ $fdr_plan->name }}</h4>
						<h3 class="my-3">{{ $fdr_plan->interest_rate }}%</h3>
					</div>
					<div class="pricing-table-content">
						<table class="table">
							<tr>
								<td>{{ _lang('Duration') }}</td>
								<td>{{ $fdr_plan->duration.' '._dlang(ucwords($fdr_plan->duration_type)) }}</td>
							</tr>
							<tr>
								<td>{{ _lang('Interest Rate') }}</td>
								<td>{{ $fdr_plan->interest_rate.' %' }}</td>
							</tr>
							<tr>
								<td>{{ _lang('Minimum') }}</td>
								<td>{{ decimalPlace($fdr_plan->minimum_amount, currency()) }}</td>
							</tr>
							<tr>
								<td>{{ _lang('Maximum') }}</td>
								<td>{{ decimalPlace($fdr_plan->maximum_amount, currency()) }}</td>
							</tr>
						</table>
					</div>
					<div class="text-center mt-4">
						<a href="{{ route('fixed_deposits.apply') }}" class="btn">{{ _lang('Apply Now') }}</a>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</section>
@endif

@if(get_option('dps_section', 1) == 1)
<section class="section dps gray-bg">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7 text-center">
				<div class="section-title">
					<h2>{{ get_trans_option('home_dps_heading') }}</h2>
					<div class="divider mx-auto my-4"></div>
					<p>{{ get_trans_option('home_dps_content') }}</p>
				</div>
			</div>
		</div>

		<div class="row">
			@foreach($dps_plans as $dps_plan)
			<div class="col-lg-4">
				<div class="pricing-table mb-4">
					<div class="pricing-table-head">
						<h4 class="my-3">{{ $dps_plan->name }}</h4>
						<h3 class="my-3">{{ $dps_plan->interest_rate }}%</h3>
					</div>
					<div class="pricing-table-content">
						<table class="table">
							<tr>
								<td>{{ _lang('Currency') }}</td>
								<td>{{ $dps_plan->currency->name }}</td>
							</tr>
							<tr>
								<td>{{ _lang('Per Instalment') }}</td>
								<td>{{ decimalPlace($dps_plan->per_installment, currency($dps_plan->currency->name)) }}</td>
							</tr>
							<tr>
								<td>{{ _lang('Installment Interva') }}</td>
								<td>{{ _lang('Every').' '.$dps_plan->installment_interval }} {{ ucwords($dps_plan->interval_type) }}</td>
							</tr>
							<tr>
								<td>{{ _lang('Interest Rate') }}</td>
								<td>{{ $dps_plan->interest_rate }}</td>
							</tr>
							<tr>
								<td>{{ _lang('Total Installment') }}</td>
								<td>{{ $dps_plan->total_installment }}</td>
							</tr>
							<tr>
								<td>{{ _lang('Total Deposit') }}</td>
								<td>{{ decimalPlace($dps_plan->total_installment *  $dps_plan->per_installment, currency($dps_plan->currency->name)) }}</td>
							</tr>
							<tr>
								<td>{{ _lang('Matured Amount') }}</td>
								<td>{{ decimalPlace($dps_plan->final_amount, currency($dps_plan->currency->name)) }}</td>
							</tr>
						</table>
					</div>
					<div class="text-center mt-4">
						<a href="{{ route('dps_scheme.apply',$dps_plan->id) }}" class="btn">{{ _lang('Apply Now') }}</a>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</section>
@endif


@if(get_option('home_loan_section', 1) == 1)
<section class="section loan">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7 text-center">
				<div class="section-title">
					<h2>{{ get_trans_option('home_loan_heading') }}</h2>
					<div class="divider mx-auto my-4"></div>
					<p>{{ get_trans_option('home_loan_content') }}</p>
				</div>
			</div>
		</div>

		<div class="row">
			@foreach($loan_plans as $loan_plan)
			<div class="col-lg-4">
				<div class="pricing-table mb-4">
					<div class="pricing-table-head">
						<h4 class="my-3">{{ $loan_plan->name }}</h4>
						<h3 class="my-3">{{ $loan_plan->interest_rate.' %' }}</h3>
					</div>
					<div class="pricing-table-content">
						<table class="table">
							<tr>
								<td>{{ _lang('Term') }}</td>
								<td>
									{{ $loan_plan->term }}
									@if($loan_plan->term_period === '+1 month')
										{{ _lang('Month') }}
									@elseif($loan_plan->term_period === '+1 year')
										{{ _lang('Year') }}
									@elseif($loan_plan->term_period === '+1 day')
										{{ _lang('Day') }}
									@elseif($loan_plan->term_period === '+1 week')
										{{ _lang('Week') }}
									@endif
								</td>
							</tr>

							<tr>
								<td>{{ _lang('Interest Rate') }}</td>
								<td>{{ $loan_plan->interest_rate.' %' }}</td>
							</tr>

							<tr>
								<td>{{ _lang('Interest Type') }}</td>
								<td>{{ ucwords(str_replace("_"," ", $loan_plan->interest_type)) }}</td>
							</tr>

							<tr>
								<td>{{ _lang('Minimum') }}</td>
								<td>{{ decimalPlace($loan_plan->minimum_amount, currency()) }}</td>
							</tr>

							<tr>
								<td>{{ _lang('Maximum') }}</td>
								<td>{{ decimalPlace($loan_plan->maximum_amount, currency()) }}</td>
							</tr>
						</table>
					</div>
					<div class="text-center mt-4">
						<a href="{{ route('loans.apply_loan') }}" class="btn">{{ _lang('Apply Now') }}</a>
					</div>
				</div>
			</div>
			@endforeach

		</div>
	</div>
</section>
@endif

<!-- Modern Testimonials Section -->
<section class="modern-testimonials">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8 text-center">
				<div class="section-header" data-aos="fade-up" data-aos-duration="800">
					<div class="section-badge">
						<span>💬 What Our Customers Say</span>
					</div>
					<h2 class="section-title">{{ get_trans_option('home_testimonial_heading', 'Trusted by Thousands') }}</h2>
					<p class="section-subtitle">{{ get_trans_option('home_testimonial_content', 'See what our satisfied customers have to say about their banking experience with us.') }}</p>
				</div>
			</div>
		</div>

		<div class="testimonials-grid" data-aos="fade-up" data-aos-delay="400">
			<div class="row g-4">
				@foreach($testimonials as $index => $testimonial)
				<div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 200 }}">
					<div class="testimonial-card modern-card">
						<div class="card-glow"></div>
						<div class="testimonial-content">
							<div class="quote-icon">
								<i class="icofont-quote-right"></i>
							</div>
							<p class="testimonial-text">"{{ $testimonial->translation->testimonial }}"</p>
						</div>
						<div class="testimonial-author">
							<div class="author-avatar">
								<img src="{{ media_images($testimonial->image) }}" alt="{{ $testimonial->translation->name }}" class="img-fluid">
							</div>
							<div class="author-info">
								<h5 class="author-name">{{ $testimonial->translation->name }}</h5>
								<p class="author-title">Verified Customer</p>
							</div>
						</div>
						<div class="rating-stars">
							<i class="icofont-star"></i>
							<i class="icofont-star"></i>
							<i class="icofont-star"></i>
							<i class="icofont-star"></i>
							<i class="icofont-star"></i>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>

		<!-- Trust Indicators -->
		<div class="trust-indicators" data-aos="fade-up" data-aos-delay="600">
			<div class="row g-4 mt-5">
				<div class="col-lg-3 col-md-6 text-center">
					<div class="trust-item">
						<div class="trust-icon">
							<i class="icofont-award"></i>
						</div>
						<h4>99.9%</h4>
						<p>Customer Satisfaction</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 text-center">
					<div class="trust-item">
						<div class="trust-icon">
							<i class="icofont-shield-alt"></i>
						</div>
						<h4>Bank Grade</h4>
						<p>Security Standards</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 text-center">
					<div class="trust-item">
						<div class="trust-icon">
							<i class="icofont-clock-time"></i>
						</div>
						<h4>24/7</h4>
						<p>Customer Support</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 text-center">
					<div class="trust-item">
						<div class="trust-icon">
							<i class="icofont-globe"></i>
						</div>
						<h4>Global</h4>
						<p>Reach & Access</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
