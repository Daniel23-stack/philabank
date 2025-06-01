@extends('theme.layout')

@section('title', 'Personal Finance - PhilaLink Financial Wellness')

@section('content')
<style>
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 5rem 0;
    text-align: center;
}

.service-category {
    background: white;
    border-radius: 15px;
    padding: 2.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    border-left: 5px solid #667eea;
}

.service-category:hover {
    transform: translateY(-5px);
}

.category-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.8rem;
    margin-bottom: 1.5rem;
}

.service-item {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 1.5rem;
    margin-bottom: 1rem;
    border-left: 3px solid #28a745;
}

.benefit-card {
    text-align: center;
    padding: 2rem;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 2rem;
}

.benefit-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    margin: 0 auto 1rem;
}

.coaching-section {
    background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
    color: white;
    padding: 4rem 0;
    text-align: center;
}

.btn-coaching {
    background: white;
    color: #fd7e14;
    border: none;
    padding: 1rem 2rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-coaching:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3);
    color: #fd7e14;
}
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1 class="display-4 mb-4">Your Complete Financial Wellness Partner</h1>
        <p class="lead mb-4">Comprehensive personal finance solutions to help you achieve financial freedom and security. From budgeting to retirement planning, we're here to guide your journey.</p>
        <a href="{{ route('register') }}" class="btn btn-light btn-lg">Start Your Financial Journey</a>
    </div>
</section>

<!-- Main Services -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Comprehensive Financial Services</h2>
            <p class="text-muted">Everything you need to take control of your financial future</p>
        </div>

        <div class="row">
            <!-- Budgeting and Cash Flow Management -->
            <div class="col-lg-6 mb-4">
                <div class="service-category">
                    <div class="category-icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <h4>Budgeting & Cash Flow Management</h4>
                    <p class="text-muted mb-4">Take control of your money with personalized budgeting tools and expert guidance.</p>

                    <div class="service-item">
                        <h6><i class="fas fa-calculator text-success"></i> Personalized Budgeting Assistance</h6>
                        <p class="text-muted mb-0">Custom budget plans tailored to your income, expenses, and financial goals</p>
                    </div>

                    <div class="service-item">
                        <h6><i class="fas fa-chart-line text-success"></i> Income and Expense Tracking</h6>
                        <p class="text-muted mb-0">Advanced tools to monitor your spending patterns and identify savings opportunities</p>
                    </div>

                    <div class="service-item">
                        <h6><i class="fas fa-lightbulb text-success"></i> Spending and Saving Tips</h6>
                        <p class="text-muted mb-0">Expert advice on reducing expenses and maximizing your savings potential</p>
                    </div>
                </div>
            </div>

            <!-- Savings and Investment Planning -->
            <div class="col-lg-6 mb-4">
                <div class="service-category">
                    <div class="category-icon">
                        <i class="fas fa-piggy-bank"></i>
                    </div>
                    <h4>Savings & Investment Planning</h4>
                    <p class="text-muted mb-4">Build wealth through strategic savings and investment strategies.</p>

                    <div class="service-item">
                        <h6><i class="fas fa-target text-success"></i> Short & Long-term Savings Plans</h6>
                        <p class="text-muted mb-0">Goal-based savings strategies for emergency funds, vacations, and major purchases</p>
                    </div>

                    <div class="service-item">
                        <h6><i class="fas fa-graduation-cap text-success"></i> Investment Education</h6>
                        <p class="text-muted mb-0">Learn about mutual funds, stocks, ETFs, and other investment vehicles</p>
                    </div>

                    <div class="service-item">
                        <h6><i class="fas fa-balance-scale text-success"></i> Portfolio Diversification</h6>
                        <p class="text-muted mb-0">Strategic asset allocation to minimize risk and maximize returns</p>
                    </div>
                </div>
            </div>

            <!-- Debt Management -->
            <div class="col-lg-6 mb-4">
                <div class="service-category">
                    <div class="category-icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <h4>Debt Management</h4>
                    <p class="text-muted mb-4">Get out of debt faster with proven strategies and expert guidance.</p>

                    <div class="service-item">
                        <h6><i class="fas fa-chart-bar text-success"></i> Repayment Strategies</h6>
                        <p class="text-muted mb-0">Optimized plans for credit card and personal loan repayment</p>
                    </div>

                    <div class="service-item">
                        <h6><i class="fas fa-compress-arrows-alt text-success"></i> Debt Consolidation</h6>
                        <p class="text-muted mb-0">Combine multiple debts into manageable single payments</p>
                    </div>

                    <div class="service-item">
                        <h6><i class="fas fa-exchange-alt text-success"></i> Refinancing Options</h6>
                        <p class="text-muted mb-0">Lower your interest rates and reduce monthly payments</p>
                    </div>
                </div>
            </div>

            <!-- Tax Planning -->
            <div class="col-lg-6 mb-4">
                <div class="service-category">
                    <div class="category-icon">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <h4>Tax Planning</h4>
                    <p class="text-muted mb-4">Maximize your tax efficiency with strategic planning and expert advice.</p>

                    <div class="service-item">
                        <h6><i class="fas fa-strategy text-success"></i> Tax-Efficient Strategies</h6>
                        <p class="text-muted mb-0">Minimize your tax burden through legal optimization strategies</p>
                    </div>

                    <div class="service-item">
                        <h6><i class="fas fa-receipt text-success"></i> Deductions & Credits</h6>
                        <p class="text-muted mb-0">Identify all available deductions and credits to reduce your tax liability</p>
                    </div>

                    <div class="service-item">
                        <h6><i class="fas fa-calendar-alt text-success"></i> Long-term Tax Planning</h6>
                        <p class="text-muted mb-0">Multi-year tax strategies for sustained savings</p>
                    </div>
                </div>
            </div>

            <!-- Retirement Planning -->
            <div class="col-lg-6 mb-4">
                <div class="service-category">
                    <div class="category-icon">
                        <i class="fas fa-umbrella"></i>
                    </div>
                    <h4>Retirement Planning</h4>
                    <p class="text-muted mb-4">Secure your future with comprehensive retirement planning strategies.</p>

                    <div class="service-item">
                        <h6><i class="fas fa-chart-area text-success"></i> Tailored Retirement Plans</h6>
                        <p class="text-muted mb-0">Customized savings plans based on your retirement goals and timeline</p>
                    </div>

                    <div class="service-item">
                        <h6><i class="fas fa-university text-success"></i> Pension & Investment Selection</h6>
                        <p class="text-muted mb-0">Expert guidance on pension funds, retirement annuities, and investment options</p>
                    </div>

                    <div class="service-item">
                        <h6><i class="fas fa-shield-alt text-success"></i> Wealth Preservation</h6>
                        <p class="text-muted mb-0">Strategies to protect and preserve your retirement wealth</p>
                    </div>
                </div>
            </div>

            <!-- Risk Management & Insurance -->
            <div class="col-lg-6 mb-4">
                <div class="service-category">
                    <div class="category-icon">
                        <i class="fas fa-shield-virus"></i>
                    </div>
                    <h4>Risk Management & Insurance</h4>
                    <p class="text-muted mb-4">Protect your financial future with comprehensive insurance planning.</p>

                    <div class="service-item">
                        <h6><i class="fas fa-stethoscope text-success"></i> Insurance Evaluation</h6>
                        <p class="text-muted mb-0">Health, life, disability, and property insurance assessment</p>
                    </div>

                    <div class="service-item">
                        <h6><i class="fas fa-clipboard-check text-success"></i> Coverage Recommendations</h6>
                        <p class="text-muted mb-0">Personalized insurance recommendations based on your needs</p>
                    </div>

                    <div class="service-item">
                        <h6><i class="fas fa-lock text-success"></i> Wealth Protection</h6>
                        <p class="text-muted mb-0">Comprehensive strategies to protect your assets and income</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Education & Family Planning -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="service-category">
                    <div class="category-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h4>Education & Family Financial Planning</h4>
                    <p class="text-muted mb-4">Plan for your family's future with specialized education and life event planning.</p>

                    <div class="service-item">
                        <h6><i class="fas fa-school text-success"></i> Children's Education Savings</h6>
                        <p class="text-muted mb-0">Tax-efficient education savings plans and investment strategies</p>
                    </div>

                    <div class="service-item">
                        <h6><i class="fas fa-heart text-success"></i> Life Event Planning</h6>
                        <p class="text-muted mb-0">Financial planning for marriage, children, home buying, and major life changes</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h5>Digital Financial Tools</h5>
                    <p class="text-muted">Access our comprehensive suite of digital tools including budget calculators, investment trackers, and financial planning apps.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Benefits Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Why Choose Our Personal Finance Services?</h2>
            <p class="text-muted">Comprehensive support for every aspect of your financial life</p>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h5>Expert Advisors</h5>
                    <p class="text-muted">Certified financial planners with years of experience</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h5>Personalized Plans</h5>
                    <p class="text-muted">Customized strategies tailored to your unique situation</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h5>Ongoing Support</h5>
                    <p class="text-muted">Continuous monitoring and adjustment of your financial plan</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Financial Coaching Section -->
<section class="coaching-section">
    <div class="container">
        <h2>One-on-One Financial Coaching</h2>
        <p class="lead mb-4">Personalized financial literacy sessions to empower your financial decision-making</p>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle me-3" style="font-size: 1.5rem;"></i>
                            <span>Personal financial assessment</span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle me-3" style="font-size: 1.5rem;"></i>
                            <span>Goal setting and planning</span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle me-3" style="font-size: 1.5rem;"></i>
                            <span>Investment education</span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle me-3" style="font-size: 1.5rem;"></i>
                            <span>Debt management strategies</span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle me-3" style="font-size: 1.5rem;"></i>
                            <span>Retirement planning guidance</span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle me-3" style="font-size: 1.5rem;"></i>
                            <span>Tax optimization strategies</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('contact') }}" class="btn btn-coaching btn-lg">
                <i class="fas fa-calendar-alt"></i> Book Your Session
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-light">
    <div class="container text-center">
        <h2>Start Your Financial Transformation Today</h2>
        <p class="lead mb-4">Take the first step towards financial freedom with our comprehensive personal finance services</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-user-plus"></i> Get Started
            </a>
            <a href="{{ route('contact') }}" class="btn btn-outline-primary btn-lg">
                <i class="fas fa-phone"></i> Speak to an Advisor
            </a>
        </div>

        <div class="mt-4">
            <small class="text-muted">
                <strong>NCR Registration:</strong> NCR 19330 |
                <strong>Authorized Financial Services Provider</strong> |
                <strong>Your Financial Wellness Partner</strong>
            </small>
        </div>
    </div>
</section>
@endsection
