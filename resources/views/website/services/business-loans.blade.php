@extends('theme.layout')

@section('title', 'Business Loans - PhilaLink Business Finance')

@section('content')
<style>
.hero-section {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    padding: 5rem 0;
    text-align: center;
}

.service-card {
    background: white;
    border-radius: 15px;
    padding: 2.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    border: 2px solid transparent;
    height: 100%;
}

.service-card:hover {
    transform: translateY(-5px);
    border-color: #28a745;
}

.service-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    margin: 0 auto 1.5rem;
}

.feature-list {
    list-style: none;
    padding: 0;
}

.feature-list li {
    padding: 0.5rem 0;
    border-bottom: 1px solid #f1f3f4;
}

.feature-list li:last-child {
    border-bottom: none;
}

.benefit-card {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 2rem;
    text-align: center;
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

.cta-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 4rem 0;
    text-align: center;
}

.btn-cta {
    background: white;
    color: #667eea;
    border: none;
    padding: 1rem 2rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.btn-cta:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3);
    color: #667eea;
}
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1 class="display-4 mb-4">Business Loans That Grow With You</h1>
        <p class="lead mb-4">Comprehensive financing solutions to fuel your business growth and success. From working capital to asset finance, we've got you covered.</p>
        <a href="{{ route('contact') }}" class="btn btn-cta btn-lg">Get Started Today</a>
    </div>
</section>

<!-- Business Loan Services -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Our Business Financing Solutions</h2>
            <p class="text-muted">Tailored financial products to meet your business needs at every stage</p>
        </div>

        <div class="row">
            <!-- Working Capital Finance -->
            <div class="col-lg-6 mb-4">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h4 class="text-center mb-3">Working Capital Finance</h4>
                    <p class="text-muted mb-4">Keep your business operations running smoothly with flexible working capital solutions that adapt to your cash flow needs.</p>

                    <h6>Key Features:</h6>
                    <ul class="feature-list">
                        <li><i class="fas fa-check text-success"></i> Flexible credit limits up to R5 million</li>
                        <li><i class="fas fa-check text-success"></i> Quick access to funds when you need them</li>
                        <li><i class="fas fa-check text-success"></i> Competitive interest rates</li>
                        <li><i class="fas fa-check text-success"></i> No early settlement penalties</li>
                        <li><i class="fas fa-check text-success"></i> Online account management</li>
                    </ul>

                    <div class="mt-4">
                        <strong>Ideal for:</strong> Seasonal businesses, inventory purchases, operational expenses, payroll financing
                    </div>
                </div>
            </div>

            <!-- Order Purchase Finance -->
            <div class="col-lg-6 mb-4">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <h4 class="text-center mb-3">Order Purchase Finance</h4>
                    <p class="text-muted mb-4">Secure large orders and fulfill customer demands with our specialized order purchase financing solutions.</p>

                    <h6>Key Features:</h6>
                    <ul class="feature-list">
                        <li><i class="fas fa-check text-success"></i> Finance up to 100% of order value</li>
                        <li><i class="fas fa-check text-success"></i> Fast approval process (48-72 hours)</li>
                        <li><i class="fas fa-check text-success"></i> Flexible repayment terms</li>
                        <li><i class="fas fa-check text-success"></i> Direct supplier payments</li>
                        <li><i class="fas fa-check text-success"></i> Risk mitigation support</li>
                    </ul>

                    <div class="mt-4">
                        <strong>Ideal for:</strong> Large order fulfillment, supplier payments, inventory stocking, contract financing
                    </div>
                </div>
            </div>

            <!-- Invoice Purchase Finance -->
            <div class="col-lg-6 mb-4">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <h4 class="text-center mb-3">Invoice Purchase Finance</h4>
                    <p class="text-muted mb-4">Improve your cash flow by converting outstanding invoices into immediate working capital.</p>

                    <h6>Key Features:</h6>
                    <ul class="feature-list">
                        <li><i class="fas fa-check text-success"></i> Advance up to 85% of invoice value</li>
                        <li><i class="fas fa-check text-success"></i> Same-day funding available</li>
                        <li><i class="fas fa-check text-success"></i> No minimum contract period</li>
                        <li><i class="fas fa-check text-success"></i> Credit protection available</li>
                        <li><i class="fas fa-check text-success"></i> Online invoice management</li>
                    </ul>

                    <div class="mt-4">
                        <strong>Ideal for:</strong> B2B businesses, service providers, manufacturers, contractors with 30-90 day payment terms
                    </div>
                </div>
            </div>

            <!-- Asset Finance -->
            <div class="col-lg-6 mb-4">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <h4 class="text-center mb-3">Asset Finance</h4>
                    <p class="text-muted mb-4">Acquire essential business assets without depleting your working capital through our flexible asset financing options.</p>

                    <h6>Key Features:</h6>
                    <ul class="feature-list">
                        <li><i class="fas fa-check text-success"></i> Finance up to 100% of asset value</li>
                        <li><i class="fas fa-check text-success"></i> Terms from 12 to 84 months</li>
                        <li><i class="fas fa-check text-success"></i> Fixed or variable interest rates</li>
                        <li><i class="fas fa-check text-success"></i> New and used equipment financing</li>
                        <li><i class="fas fa-check text-success"></i> Balloon payment options</li>
                    </ul>

                    <div class="mt-4">
                        <strong>Ideal for:</strong> Equipment purchases, vehicle financing, machinery, technology upgrades, office furniture
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Benefits Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Why Choose Our Business Loans?</h2>
            <p class="text-muted">We understand business and provide solutions that work</p>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h5>Relationship Banking</h5>
                    <p class="text-muted">Dedicated relationship managers who understand your business and industry</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h5>Quick Decisions</h5>
                    <p class="text-muted">Fast approval process with decisions typically within 48-72 hours</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h5>Flexible Solutions</h5>
                    <p class="text-muted">Customized financing solutions tailored to your specific business needs</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h5>Competitive Rates</h5>
                    <p class="text-muted">Market-leading interest rates and transparent fee structures</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <h5>Business Support</h5>
                    <p class="text-muted">Additional business advisory services to help you grow</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h5>Digital Banking</h5>
                    <p class="text-muted">Modern online and mobile banking platforms for easy management</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Application Process -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Simple Application Process</h2>
            <p class="text-muted">Get your business loan in 5 easy steps</p>
        </div>

        <div class="row">
            <div class="col-md-2 col-6 text-center mb-4">
                <div class="step-number bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px; font-weight: 700; font-size: 1.2rem;">1</div>
                <h6>Initial Consultation</h6>
                <p class="text-muted small">Discuss your needs with our business specialists</p>
            </div>

            <div class="col-md-2 col-6 text-center mb-4">
                <div class="step-number bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px; font-weight: 700; font-size: 1.2rem;">2</div>
                <h6>Submit Application</h6>
                <p class="text-muted small">Complete our comprehensive business loan application</p>
            </div>

            <div class="col-md-2 col-6 text-center mb-4">
                <div class="step-number bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px; font-weight: 700; font-size: 1.2rem;">3</div>
                <h6>Document Review</h6>
                <p class="text-muted small">Our team reviews your financial documents and business plan</p>
            </div>

            <div class="col-md-2 col-6 text-center mb-4">
                <div class="step-number bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px; font-weight: 700; font-size: 1.2rem;">4</div>
                <h6>Credit Assessment</h6>
                <p class="text-muted small">Comprehensive credit and risk assessment</p>
            </div>

            <div class="col-md-2 col-6 text-center mb-4">
                <div class="step-number bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px; font-weight: 700; font-size: 1.2rem;">5</div>
                <h6>Funding</h6>
                <p class="text-muted small">Receive your approved funds and start growing</p>
            </div>
        </div>
    </div>
</section>

<!-- Requirements Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h3>Business Loan Requirements</h3>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-check text-success"></i> Registered South African business</li>
                    <li class="mb-2"><i class="fas fa-check text-success"></i> Minimum 12 months trading history</li>
                    <li class="mb-2"><i class="fas fa-check text-success"></i> Annual turnover of R500,000+</li>
                    <li class="mb-2"><i class="fas fa-check text-success"></i> Good credit history</li>
                    <li class="mb-2"><i class="fas fa-check text-success"></i> Comprehensive business plan</li>
                    <li class="mb-2"><i class="fas fa-check text-success"></i> Financial statements (audited/reviewed)</li>
                </ul>
            </div>

            <div class="col-lg-6">
                <h3>Required Documentation</h3>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-file-alt text-primary"></i> Company registration documents</li>
                    <li class="mb-2"><i class="fas fa-file-alt text-primary"></i> 12 months bank statements</li>
                    <li class="mb-2"><i class="fas fa-file-alt text-primary"></i> Latest financial statements</li>
                    <li class="mb-2"><i class="fas fa-file-alt text-primary"></i> Management accounts</li>
                    <li class="mb-2"><i class="fas fa-file-alt text-primary"></i> Business plan and projections</li>
                    <li class="mb-2"><i class="fas fa-file-alt text-primary"></i> Director/shareholder details</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2>Ready to Grow Your Business?</h2>
        <p class="lead mb-4">Let our business financing experts help you find the perfect solution for your growth plans</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('contact') }}" class="btn btn-cta btn-lg">
                <i class="fas fa-phone"></i> Speak to a Specialist
            </a>
            <a href="#" class="btn btn-outline-light btn-lg">
                <i class="fas fa-download"></i> Download Brochure
            </a>
        </div>

        <div class="mt-4">
            <small>
                <strong>NCR Registration:</strong> NCR 19330 |
                <strong>Authorized Financial Services Provider</strong>
            </small>
        </div>
    </div>
</section>
@endsection
