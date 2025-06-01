<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="{{ get_option('meta_keywords','bank, online bank, send money') }}"/>
    <meta name="description" content="{{ get_option('meta_content','Online Banking Solutions') }}"/>

    <title>{{ get_option('site_title', config('app.name')) }}</title>

    <!-- Favicon-->
    <link rel="icon" type="image/png" href="{{ get_favicon() }}" />
    <!-- bootstrap.min css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- Icon Font Css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icofont@1.0.1/dist/icofont.min.css">
    <!-- Slick Slider  CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css">

    <!-- AOS Animation Library -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('public/theme/css/style.css?v=1.1') }}">

    <!-- Modern Animations & Effects CSS -->
    <style>
        /* Modern Hero Section */
        .modern-hero {
            position: relative;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            overflow: hidden;
            display: flex;
            align-items: center;
        }

        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 6s ease-in-out infinite;
        }

        .shape-1 {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }

        .shape-3 {
            width: 60px;
            height: 60px;
            top: 80%;
            left: 20%;
            animation-delay: 4s;
        }

        .shape-4 {
            width: 100px;
            height: 100px;
            top: 10%;
            right: 30%;
            animation-delay: 1s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            display: inline-block;
            margin-bottom: 1.5rem;
        }

        .badge-text {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 50px;
            padding: 8px 20px;
            color: white;
            font-size: 14px;
            font-weight: 500;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            color: white;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }

        .btn-modern-primary {
            background: linear-gradient(45deg, #ff6b6b, #ee5a24);
            border: none;
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(255, 107, 107, 0.3);
        }

        .btn-modern-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(255, 107, 107, 0.4);
            color: white;
            text-decoration: none;
        }

        .btn-modern-outline {
            background: transparent;
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 13px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .btn-modern-outline:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.5);
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
        }

        .hero-stats {
            display: flex;
            gap: 3rem;
        }

        .stat-item {
            text-align: left;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: white;
            line-height: 1;
        }

        .stat-label {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
            margin-top: 5px;
        }

        /* Hero Visual */
        .hero-visual {
            position: relative;
            z-index: 2;
        }

        .hero-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .floating {
            animation: cardFloat 6s ease-in-out infinite;
        }

        @keyframes cardFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 2rem;
        }

        .card-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
        }

        .balance-display {
            margin-bottom: 2rem;
        }

        .balance-label {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 5px;
        }

        .balance-amount {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
        }

        .card-actions {
            display: flex;
            gap: 1rem;
        }

        .action-btn {
            flex: 1;
            background: #f8f9fa;
            border: none;
            border-radius: 12px;
            padding: 15px 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .action-btn:hover {
            background: #e9ecef;
            transform: translateY(-2px);
        }

        .action-btn i {
            font-size: 1.2rem;
            color: #667eea;
        }

        .action-btn span {
            font-size: 0.8rem;
            font-weight: 500;
            color: #333;
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
            background: white;
            border-radius: 12px;
            padding: 15px 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            color: #333;
            animation: floatCard 4s ease-in-out infinite;
        }

        .floating-card i {
            color: #667eea;
            font-size: 1.2rem;
        }

        .card-1 {
            top: 20%;
            right: -20%;
            animation-delay: 0s;
        }

        .card-2 {
            bottom: 30%;
            left: -15%;
            animation-delay: 2s;
        }

        .card-3 {
            top: 60%;
            right: -25%;
            animation-delay: 4s;
        }

        @keyframes floatCard {
            0%, 100% { transform: translateY(0px) translateX(0px); }
            50% { transform: translateY(-15px) translateX(10px); }
        }

        /* Modern Services Section */
        .modern-services {
            padding: 100px 0;
            background: #f8f9fa;
            position: relative;
        }

        .section-header {
            margin-bottom: 4rem;
        }

        .section-badge {
            margin-bottom: 1rem;
        }

        .section-badge span {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 500;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: #666;
            line-height: 1.6;
        }

        .service-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem 2rem;
            height: 100%;
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
            cursor: pointer;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        }

        .card-glow {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #667eea, #764ba2);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .service-card:hover .card-glow {
            opacity: 0.05;
        }

        .service-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            transition: all 0.4s ease;
        }

        .service-icon i {
            font-size: 2rem;
            color: white;
        }

        .service-card:hover .service-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .service-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 1rem;
        }

        .service-description {
            color: #666;
            line-height: 1.6;
            margin-bottom: 0;
        }

        .service-hover-effect {
            position: absolute;
            bottom: 2rem;
            right: 2rem;
            opacity: 0;
            transition: all 0.4s ease;
        }

        .service-card:hover .service-hover-effect {
            opacity: 1;
            transform: translateX(-10px);
        }

        .hover-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(45deg, #ff6b6b, #ee5a24);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        /* Features Grid */
        .features-grid {
            margin-top: 4rem;
        }

        .feature-item {
            text-align: center;
            padding: 2rem 1rem;
            transition: all 0.3s ease;
        }

        .feature-item:hover {
            transform: translateY(-5px);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .feature-item:hover .feature-icon {
            transform: scale(1.1);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .feature-item h5 {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .feature-item p {
            color: #666;
            font-size: 0.9rem;
            margin: 0;
        }

        /* Modern Testimonials Section */
        .modern-testimonials {
            padding: 100px 0;
            background: white;
            position: relative;
        }

        .testimonials-grid {
            margin-top: 3rem;
        }

        .testimonial-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            height: 100%;
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .testimonial-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .testimonial-content {
            margin-bottom: 2rem;
        }

        .quote-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            color: white;
            font-size: 1.2rem;
        }

        .testimonial-text {
            font-size: 1rem;
            line-height: 1.6;
            color: #555;
            font-style: italic;
            margin: 0;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid #f8f9fa;
        }

        .author-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .author-name {
            font-size: 1rem;
            font-weight: 600;
            color: #333;
            margin: 0;
        }

        .author-title {
            font-size: 0.85rem;
            color: #666;
            margin: 0;
        }

        .rating-stars {
            display: flex;
            gap: 3px;
        }

        .rating-stars i {
            color: #ffc107;
            font-size: 0.9rem;
        }

        /* Trust Indicators */
        .trust-indicators {
            margin-top: 4rem;
            padding-top: 3rem;
            border-top: 1px solid #eee;
        }

        .trust-item {
            padding: 1.5rem 1rem;
            transition: all 0.3s ease;
        }

        .trust-item:hover {
            transform: translateY(-5px);
        }

        .trust-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, #ff6b6b, #ee5a24);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .trust-item:hover .trust-icon {
            transform: scale(1.1);
            box-shadow: 0 10px 30px rgba(255, 107, 107, 0.3);
        }

        .trust-item h4 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .trust-item p {
            color: #666;
            font-size: 0.9rem;
            margin: 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-stats {
                flex-direction: column;
                gap: 1.5rem;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: flex-start;
            }

            .floating-card {
                display: none;
            }

            .section-title {
                font-size: 2rem;
            }

            .testimonial-author {
                flex-direction: column;
                text-align: center;
                gap: 0.5rem;
            }

            .trust-indicators .row {
                gap: 2rem;
            }
        }
    </style>

    <!--- Custom CSS Code --->
    <style type="text/css">
        {!! xss_clean(get_option('custom_css')) !!}
    </style>
</head>

<body id="top">
    <header>
        <nav class="navbar navbar-expand-lg navigation" id="navbar">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    @if(get_option('logo') == '')
                        <h3 class="m-0">{{ get_option('site_title', config('app.name')) }}</h3>
                    @else
                        <img src="{{ get_logo() }}" alt="" class="img-fluid">
                    @endif
                </a>

                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icofont-navigation-menu"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarmain">
                    {!! xss_clean(show_navigation(get_option('primary_menu'), 'navbar-nav ml-auto', 'nav-link')) !!}

                    <ul class="navbar-nav ml-auto">

                        @guest
                        <li class="nav-item"><a class="nav-link btn-outline-red mr-lg-2 text-nowrap" href="{{ route('login') }}"><i class="icofont-lock"></i> {{ _lang('Sign In') }}</a></li>
                        @if(get_option('allow_singup') == 'yes')
                        <li class="nav-item"><a class="nav-link btn-signup mr-lg-2 text-nowrap" href="{{ route('register') }}"><i class="icofont-ui-user"></i> {{ _lang('Sign Up') }}</a></li>
                        @endif
                        @endguest

                        @auth
                        <li class="nav-item"><a class="nav-link btn-signup mr-lg-2 text-nowrap" href="{{ route('dashboard.index') }}"><i class="icofont-ui-user"></i> {{ _lang('My Account') }}</a></li>
                        @endauth

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle btn-outline-red" id="languageSelector" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="icofont-globe"></i>  {{ session('language') =='' ? get_option('language') : session('language') }} <i class="icofont-thin-down"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageSelector">
                                @foreach(get_language_list() as $language)
                                    <a class="dropdown-item" href="{{ url('/') }}?language={{ $language }}">{{ $language }}</a>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    @yield('content')

    @if(get_option('gdpr_cookie_status') == '1' && !session('cookie_accepted'))
    <!-- Cookie Consent -->
    <div class="cookie-consent" id="cookie-consent-box">
        <div class="container">
            <div class="cookie-header mb-2">
                <h5 class="text-white">{{ _lang('Cookie Policy') }}</h5>
                <button class="close-btn"><i class="icofont-close-line-squared"></i></button>
            </div>
            <p class="mb-4">
                {{ get_option('gdpr_cookie_content') }}
            </p>

            <button type="button" class="btn btn-primary btn-sm" id="cookie-accept-btn"> {{ _lang('Accept') }}</button>
            <a class="btn btn-info btn-sm" href="{{ url('/' . get_option('gdpr_privacy_policy_page')) }}" target="_blank">{{ _lang('Learn More') }}</a>
        </div>
    </div>
    @endif

    <!-- footer Start -->
    <footer class="footer section gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mr-auto col-sm-12">
                    <div class="widget mb-5 mb-lg-0">
                        <div class="logo mb-4">
                            @if(get_option('logo') == '')
                            <h3 class="m-0">{{ get_option('site_title', config('app.name')) }}</h3>
                            @else
                            <img src="{{ get_logo() }}" alt="" class="img-fluid">
                            @endif
                        </div>
                        <p>{{ get_trans_option('footer_about_us') }}</p>

                        <ul class="list-inline footer-socials mt-4">
                            <li class="list-inline-item"><a href="{{ get_option('facebook_link') }}"><i class="icofont-facebook"></i></a></li>
                            <li class="list-inline-item"><a href="{{ get_option('twitter_link') }}"><i class="icofont-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="{{ get_option('linkedin_link') }}"><i class="icofont-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="widget mb-5 mb-lg-0">
                        <h4 class="text-capitalize mb-3">{{ get_option('footer_menu_1_title') }}</h4>
                        <div class="divider mb-4"></div>
                        {!! xss_clean(show_navigation(get_option('footer_menu_1'), 'list-unstyled footer-menu lh-35')) !!}
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="widget mb-5 mb-lg-0">
                        <h4 class="text-capitalize mb-3">{{ get_option('footer_menu_2_title') }}</h4>
                        <div class="divider mb-4"></div>
                        {!! xss_clean(show_navigation(get_option('footer_menu_2'), 'list-unstyled footer-menu lh-35')) !!}
                    </div>
                </div>
            </div>

            <div class="footer-btm py-4 mt-5">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-12">
                        <div class="copyright">
                            {!! xss_clean(get_trans_option('copyright')) !!}
                        </div>
                        <div class="ncr-registration text-center mt-2">
                            <small class="text-muted">
                                <strong>PhilaLink Financial Services</strong> |
                                <strong>NCR Registration Number:</strong> NCR 19330 |
                                <strong>Authorized Financial Services Provider</strong> |
                                Responsible Lending Practices
                            </small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <a class="backtop js-scroll-trigger" href="#top">
                            <i class="icofont-long-arrow-up"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <!-- Main jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <!-- Bootstrap 4.6.2 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Slick Slider -->
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <!-- Counterup -->
    <script src="https://cdn.jsdelivr.net/npm/waypoints@4.0.1/lib/jquery.waypoints.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.counterup@2.1.0/jquery.counterup.min.js"></script>

    <!-- AOS Animation Library -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <script src="{{ asset('public/theme/js/script.js') }}"></script>

    <!-- Initialize AOS Animations -->
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });

        // Add smooth scrolling for anchor links
        $(document).ready(function() {
            $('a[href^="#"]').on('click', function(event) {
                var target = $(this.getAttribute('href'));
                if( target.length ) {
                    event.preventDefault();
                    $('html, body').stop().animate({
                        scrollTop: target.offset().top - 80
                    }, 1000);
                }
            });

            // Add parallax effect to hero section
            $(window).scroll(function() {
                var scrolled = $(this).scrollTop();
                var parallax = $('.floating-shapes');
                var speed = scrolled * 0.5;
                parallax.css('transform', 'translateY(' + speed + 'px)');
            });

            // Counter animation
            $('.stat-number').each(function() {
                var $this = $(this);
                var countTo = $this.text().replace(/[^0-9]/g, '');

                $({ countNum: 0 }).animate({
                    countNum: countTo
                }, {
                    duration: 2000,
                    easing: 'linear',
                    step: function() {
                        var suffix = $this.text().replace(/[0-9]/g, '');
                        $this.text(Math.floor(this.countNum) + suffix);
                    },
                    complete: function() {
                        var suffix = $this.text().replace(/[0-9]/g, '');
                        $this.text(this.countNum + suffix);
                    }
                });
            });
        });
    </script>

	@yield('js-script')

     <!--- Custom JS Code --->
     <script type="text/javascript">
        (function ($) {
        "use strict";

            $(document).on('click', '#cookie-consent-box .close-btn', function(){
                $('#cookie-consent-box').addClass('d-none');
            });

            $(document).on('click', '#cookie-accept-btn', function(){
                $.ajax({
                    url: "{{ route('cookie.accept') }}",
                    success:  function (response) {
                        if(response.success){
                            $('#cookie-consent-box').remove();
                        }
                    }
                });
            });
        })(jQuery);

        {!! xss_clean(get_option('custom_js')) !!}
    </script>
</body>
</html>
