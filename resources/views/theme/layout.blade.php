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
        :root {
            --primary-color: #000117;
            --accent-color: #65d393;
            --primary-gradient: linear-gradient(135deg, var(--primary-color) 0%, #1a1a2e 100%);
            --accent-gradient: linear-gradient(135deg, var(--accent-color) 0%, #4fb87a 100%);
        }

        /* Modern Navigation */
        .navbar {
            background: rgba(0, 1, 23, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(101, 211, 147, 0.1);
        }

        .navbar-brand h3 {
            color: var(--accent-color);
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--accent-color);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link:hover {
            color: var(--accent-color) !important;
        }

        /* Modern Buttons */
        .btn-modern {
            padding: 0.8rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background: var(--accent-color);
            transition: all 0.3s ease;
            z-index: -1;
        }

        .btn-modern:hover::before {
            width: 100%;
        }

        .btn-modern-primary {
            background: var(--accent-color);
            color: var(--primary-color);
            border: none;
        }

        .btn-modern-outline {
            border: 2px solid var(--accent-color);
            color: var(--accent-color);
        }

        .btn-modern-outline:hover {
            color: var(--primary-color);
        }

        /* Enhanced Hero Section */
        .modern-hero {
            min-height: 100vh;
            background: var(--primary-gradient);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            padding: 0;
        }

        .hero-container {
            position: relative;
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
        }

        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://images.unsplash.com/photo-1563986768609-322da13575f3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
            opacity: 0.15;
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 600px;
            padding: 2rem;
            margin-left: 10%;
        }

        .hero-badge {
            background: rgba(101, 211, 147, 0.1);
            color: var(--accent-color);
            padding: 0.8rem 1.5rem;
            border-radius: 50px;
            font-weight: 500;
            display: inline-block;
            margin-bottom: 2rem;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(101, 211, 147, 0.2);
            animation: fadeInUp 1s ease;
        }

        .hero-title {
            font-size: 4.5rem;
            font-weight: 800;
            color: white;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            letter-spacing: -1px;
            animation: fadeInUp 1s ease 0.2s;
            animation-fill-mode: both;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
            margin-bottom: 2.5rem;
            animation: fadeInUp 1s ease 0.4s;
            animation-fill-mode: both;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            animation: fadeInUp 1s ease 0.6s;
            animation-fill-mode: both;
        }

        .hero-card {
            position: absolute;
            right: 10%;
            top: 50%;
            transform: translateY(-50%);
            width: 400px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            z-index: 2;
            animation: fadeInRight 1s ease 0.8s;
            animation-fill-mode: both;
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .card-icon {
            width: 50px;
            height: 50px;
            background: var(--accent-gradient);
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
            color: var(--primary-color);
        }

        .balance-display {
            margin-bottom: 2rem;
        }

        .balance-label {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 0.5rem;
        }

        .balance-amount {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .card-actions {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .action-btn {
            background: #f8f9fa;
            border: none;
            border-radius: 12px;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .action-btn:hover {
            background: #e9ecef;
            transform: translateY(-2px);
        }

        .action-btn i {
            font-size: 1.2rem;
            color: var(--accent-color);
        }

        .action-btn span {
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--primary-color);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(50px) translateY(-50%);
            }
            to {
                opacity: 1;
                transform: translateX(0) translateY(-50%);
            }
        }

        /* Banking Features Section */
        .banking-features {
            padding: 6rem 0;
            background: #f8f9fa;
        }

        .feature-image {
            width: 100%;
            height: 300px;
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .feature-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .feature-image:hover img {
            transform: scale(1.05);
        }

        /* Banking Stats Section */
        .banking-stats {
            padding: 6rem 0;
            background: var(--primary-gradient);
            position: relative;
            overflow: hidden;
        }

        .stats-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80');
            background-size: cover;
            background-position: center;
            opacity: 0.1;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            color: white;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.15);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--accent-color);
            margin-bottom: 1rem;
        }

        .stat-label {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.9);
        }

        /* Banking Services Section */
        .banking-services {
            padding: 6rem 0;
            background: white;
        }

        .service-image {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .service-image img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .service-image:hover img {
            transform: scale(1.05);
        }

        .service-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 2rem;
            background: linear-gradient(to top, rgba(0, 1, 23, 0.9), transparent);
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .hero-card {
                width: 350px;
                right: 5%;
            }
        }

        @media (max-width: 992px) {
            .hero-content {
                margin-left: 5%;
            }

            .hero-title {
                font-size: 3.5rem;
            }
        }

        @media (max-width: 768px) {
            .hero-card {
                display: none;
            }

            .hero-content {
                max-width: 100%;
                margin: 0;
                text-align: center;
                padding: 2rem;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-buttons {
                justify-content: center;
            }
        }

        /* Modern Features Section */
        .features-section {
            padding: 8rem 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            position: relative;
            overflow: hidden;
        }

        .section-header {
            text-align: center;
            margin-bottom: 5rem;
        }

        .section-badge {
            display: inline-block;
            background: rgba(101, 211, 147, 0.1);
            color: var(--accent-color);
            padding: 0.8rem 1.5rem;
            border-radius: 50px;
            font-weight: 500;
            margin-bottom: 1.5rem;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(101, 211, 147, 0.2);
        }

        .section-title {
            font-size: 3rem;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: #666;
            max-width: 600px;
            margin: 0 auto;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 2.5rem;
            height: 100%;
            transition: all 0.4s ease;
            border: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--accent-gradient);
            opacity: 0;
            transition: all 0.4s ease;
            z-index: 0;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .feature-card:hover::before {
            opacity: 0.05;
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: var(--accent-gradient);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            position: relative;
            z-index: 1;
            transition: all 0.4s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .feature-icon i {
            font-size: 2.5rem;
            color: white;
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .feature-description {
            color: #666;
            line-height: 1.6;
            position: relative;
            z-index: 1;
            margin-bottom: 1.5rem;
        }

        .feature-link {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            position: relative;
            z-index: 1;
            transition: all 0.3s ease;
        }

        .feature-link:hover {
            gap: 1rem;
            color: var(--primary-color);
        }

        /* Modern Services Section */
        .services-section {
            padding: 8rem 0;
            background: var(--primary-gradient);
            position: relative;
            overflow: hidden;
        }

        .services-section .section-title,
        .services-section .section-subtitle {
            color: white;
        }

        .service-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 2.5rem;
            height: 100%;
            transition: all 0.4s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--accent-gradient);
            opacity: 0;
            transition: all 0.4s ease;
            z-index: 0;
        }

        .service-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.15);
        }

        .service-card:hover::before {
            opacity: 0.1;
        }

        .service-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            position: relative;
            z-index: 1;
            transition: all 0.4s ease;
        }

        .service-card:hover .service-icon {
            transform: scale(1.1);
            background: var(--accent-color);
        }

        .service-icon i {
            font-size: 2.5rem;
            color: white;
        }

        .service-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .service-description {
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
            position: relative;
            z-index: 1;
            margin-bottom: 1.5rem;
        }

        .service-link {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            position: relative;
            z-index: 1;
            transition: all 0.3s ease;
        }

        .service-link:hover {
            gap: 1rem;
            color: white;
        }

        /* Testimonials Section */
        .testimonials-section {
            padding: 8rem 0;
            background: #f8f9fa;
            position: relative;
            overflow: hidden;
        }

        .testimonial-card {
            background: white;
            border-radius: 24px;
            padding: 2.5rem;
            height: 100%;
            transition: all 0.4s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }

        .testimonial-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .testimonial-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #666;
            margin-bottom: 2rem;
            position: relative;
        }

        .testimonial-content::before {
            content: '"';
            font-size: 4rem;
            color: var(--accent-color);
            opacity: 0.2;
            position: absolute;
            top: -2rem;
            left: -1rem;
            font-family: serif;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .author-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid var(--accent-color);
        }

        .author-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .author-info h4 {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-color);
            margin: 0;
        }

        .author-info p {
            font-size: 0.9rem;
            color: #666;
            margin: 0;
        }

        /* Contact Section */
        .contact-section {
            padding: 8rem 0;
            background: var(--primary-gradient);
            position: relative;
            overflow: hidden;
        }

        .contact-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 3rem;
            height: 100%;
            transition: all 0.4s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .contact-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.15);
        }

        .contact-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            transition: all 0.4s ease;
        }

        .contact-card:hover .contact-icon {
            background: var(--accent-color);
            transform: scale(1.1);
        }

        .contact-icon i {
            font-size: 2.5rem;
            color: white;
        }

        .contact-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 1rem;
        }

        .contact-info {
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .contact-link {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .contact-link:hover {
            gap: 1rem;
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .section-title {
                font-size: 2.5rem;
            }

            .feature-card,
            .service-card,
            .testimonial-card,
            .contact-card {
                margin-bottom: 2rem;
            }
        }

        @media (max-width: 768px) {
            .section-title {
                font-size: 2rem;
            }

            .section-subtitle {
                font-size: 1.1rem;
            }
        }

        /* Loan Products Section */
        .loan-products-section {
            padding: 8rem 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            position: relative;
            overflow: hidden;
        }

        .loan-card {
            background: white;
            border-radius: 24px;
            padding: 3rem;
            height: 100%;
            transition: all 0.4s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .loan-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: var(--accent-gradient);
            opacity: 0;
            transition: all 0.4s ease;
        }

        .loan-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .loan-card:hover::before {
            opacity: 1;
        }

        .loan-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .loan-type {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .loan-rate {
            font-size: 3rem;
            font-weight: 800;
            color: var(--accent-color);
            margin-bottom: 0.5rem;
            line-height: 1;
        }

        .loan-term {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 2rem;
        }

        .loan-details {
            flex-grow: 1;
            margin-bottom: 2rem;
        }

        .loan-detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .loan-detail-item:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-size: 1rem;
            color: #666;
        }

        .detail-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .loan-amount {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--accent-color);
        }

        .loan-footer {
            text-align: center;
            margin-top: auto;
        }

        .apply-btn {
            display: inline-block;
            padding: 1rem 2rem;
            background: var(--accent-gradient);
            color: white;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            width: 100%;
        }

        .apply-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(101, 211, 147, 0.2);
            color: white;
        }

        .loan-badge {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            background: rgba(101, 211, 147, 0.1);
            color: var(--accent-color);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        @media (max-width: 992px) {
            .loan-card {
                margin-bottom: 2rem;
            }
        }

        /* Loan Calculator Section */
        .calculator-section {
            padding: 8rem 0;
            background: var(--primary-gradient);
            position: relative;
            overflow: hidden;
        }

        .calculator-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .calculator-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .calculator-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .calculator-subtitle {
            color: #666;
            font-size: 1.1rem;
        }

        .calculator-form {
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 1rem;
            font-weight: 500;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .form-control {
            width: 100%;
            padding: 1rem;
            border: 2px solid rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(101, 211, 147, 0.1);
            outline: none;
        }

        .calculator-results {
            background: rgba(101, 211, 147, 0.1);
            border-radius: 16px;
            padding: 2rem;
            margin-top: 2rem;
        }

        .result-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .result-item:last-child {
            border-bottom: none;
        }

        .result-label {
            font-size: 1.1rem;
            color: #666;
        }

        .result-value {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--accent-color);
        }

        .loan-type-selector {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .loan-type-btn {
            flex: 1;
            padding: 1rem;
            border: 2px solid rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            background: white;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .loan-type-btn.active {
            border-color: var(--accent-color);
            background: rgba(101, 211, 147, 0.1);
        }

        .loan-type-btn:hover {
            border-color: var(--accent-color);
        }

        .loan-type-name {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .loan-type-rate {
            font-size: 0.9rem;
            color: #666;
        }

        .range-slider {
            width: 100%;
            height: 6px;
            background: rgba(0, 0, 0, 0.1);
            border-radius: 3px;
            outline: none;
            -webkit-appearance: none;
        }

        .range-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 20px;
            height: 20px;
            background: var(--accent-color);
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .range-slider::-webkit-slider-thumb:hover {
            transform: scale(1.2);
        }

        .amount-display {
            text-align: right;
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-top: 0.5rem;
        }

        @media (max-width: 768px) {
            .calculator-card {
                padding: 2rem;
            }

            .loan-type-selector {
                flex-direction: column;
            }
        }

        /* Calculator Nav Button */
        .btn-calculator {
            background: var(--accent-gradient);
            color: white !important;
            border-radius: 50px;
            padding: 0.5rem 1.5rem !important;
            transition: all 0.3s ease;
        }

        .btn-calculator:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(101, 211, 147, 0.3);
        }

        .btn-calculator i {
            margin-right: 0.5rem;
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

                        <li class="nav-item">
                            <a class="nav-link btn-calculator mr-lg-2 text-nowrap" href="{{ url('/loan-calculator') }}">
                                <i class="icofont-calculator"></i> {{ _lang('Loan Calculator') }}
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle btn-outline-red" id="languageSelector" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="icofont-globe"></i> {{ session('language') =='' ? get_option('language') : session('language') }} <i class="icofont-thin-down"></i>
                            </a>
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

    <!-- Add this script before the closing body tag -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const loanTypeBtns = document.querySelectorAll('.loan-type-btn');
        const loanAmountSlider = document.getElementById('loanAmount');
        const loanAmountDisplay = document.getElementById('loanAmountDisplay');
        const interestRateDisplay = document.getElementById('interestRate');
        const loanTermDisplay = document.getElementById('loanTerm');
        const totalInterestDisplay = document.getElementById('totalInterest');
        const totalPaymentDisplay = document.getElementById('totalPayment');
        const monthlyPaymentDisplay = document.getElementById('monthlyPayment');

        let currentRate = 26;
        let currentTerm = 1;

        function formatCurrency(amount) {
            return new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }).format(amount);
        }

        function calculateLoan() {
            const amount = parseFloat(loanAmountSlider.value);
            const interest = (amount * currentRate / 100);
            const totalPayment = amount + interest;
            const monthlyPayment = totalPayment / currentTerm;

            loanAmountDisplay.textContent = formatCurrency(amount).replace('$', '');
            interestRateDisplay.textContent = currentRate.toFixed(2) + '%';
            loanTermDisplay.textContent = currentTerm + (currentTerm > 1 ? ' Months' : ' Month');
            totalInterestDisplay.textContent = formatCurrency(interest);
            totalPaymentDisplay.textContent = formatCurrency(totalPayment);
            monthlyPaymentDisplay.textContent = formatCurrency(monthlyPayment);
        }

        loanTypeBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                loanTypeBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                currentRate = parseFloat(this.dataset.rate);
                currentTerm = parseInt(this.dataset.term);
                calculateLoan();
            });
        });

        loanAmountSlider.addEventListener('input', calculateLoan);

        // Initial calculation
        calculateLoan();
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
