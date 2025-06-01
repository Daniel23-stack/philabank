@extends('theme.layout')

@section('title', 'Microloans - PhilaLink Financial Solutions')

@section('content')
<style>
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 5rem 0;
    text-align: center;
}

.loan-type-card {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    border: 2px solid transparent;
}

.loan-type-card:hover {
    transform: translateY(-5px);
    border-color: #667eea;
}

.loan-rate {
    font-size: 3rem;
    font-weight: 800;
    color: #667eea;
    margin: 1rem 0;
}

.loan-term {
    background: #f8f9fa;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    display: inline-block;
    font-weight: 600;
    color: #495057;
}

.feature-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    margin: 0 auto 1rem;
}

.process-step {
    text-align: center;
    padding: 2rem;
}

.step-number {
    width: 50px;
    height: 50px;
    background: #667eea;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.2rem;
    margin: 0 auto 1rem;
}

.cta-section {
    background: #f8f9fa;
    padding: 4rem 0;
    text-align: center;
}

.btn-apply {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    border: none;
    color: white;
    padding: 1rem 2rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.btn-apply:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
    color: white;
}
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1 class="display-4 mb-4">Quick Microloans for Every Need</h1>
        <p class="lead mb-4">Get the financial support you need with our flexible microloan solutions. Fast approval, competitive rates, and transparent terms.</p>
        <a href="{{ route('register') }}" class="btn btn-apply btn-lg">Apply Now</a>
    </div>
</section>

<!-- Loan Types Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Choose Your Microloan Type</h2>
            <p class="text-muted">Tailored solutions for different financial needs</p>
        </div>

        <div class="row">
            <!-- Emergency Loan -->
            <div class="col-lg-4">
                <div class="loan-type-card">
                    <div class="text-center">
                        <i class="fas fa-bolt feature-icon"></i>
                        <h4>Emergency Loan</h4>
                        <div class="loan-rate">26%</div>
                        <div class="loan-term">1 Month Term</div>
                    </div>

                    <hr class="my-4">

                    <h6>Perfect for:</h6>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success"></i> Medical emergencies</li>
                        <li><i class="fas fa-check text-success"></i> Urgent home repairs</li>
                        <li><i class="fas fa-check text-success"></i> Unexpected bills</li>
                        <li><i class="fas fa-check text-success"></i> Car repairs</li>
                    </ul>

                    <div class="mt-4">
                        <strong>Amount Range:</strong> R500 - R10,000<br>
                        <strong>Approval Time:</strong> Within 24 hours<br>
                        <strong>Repayment:</strong> Single payment after 30 days
                    </div>

                    <div class="mt-4">
                        <small class="text-muted">
                            <strong>Note:</strong> Interest compounds if unpaid after 30 days
                        </small>
                    </div>
                </div>
            </div>

            <!-- Standard Loan -->
            <div class="col-lg-4">
                <div class="loan-type-card">
                    <div class="text-center">
                        <i class="fas fa-balance-scale feature-icon"></i>
                        <h4>Standard Loan</h4>
                        <div class="loan-rate">35%</div>
                        <div class="loan-term">2 Month Term</div>
                    </div>

                    <hr class="my-4">

                    <h6>Perfect for:</h6>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success"></i> Home improvements</li>
                        <li><i class="fas fa-check text-success"></i> Appliance purchases</li>
                        <li><i class="fas fa-check text-success"></i> Education expenses</li>
                        <li><i class="fas fa-check text-success"></i> Small business needs</li>
                    </ul>

                    <div class="mt-4">
                        <strong>Amount Range:</strong> R1,000 - R25,000<br>
                        <strong>Approval Time:</strong> Within 48 hours<br>
                        <strong>Repayment:</strong> Equal monthly payments
                    </div>

                    <div class="mt-4">
                        <small class="text-muted">
                            <strong>Flexible:</strong> Early repayment options available
                        </small>
                    </div>
                </div>
            </div>

            <!-- Extended Loan -->
            <div class="col-lg-4">
                <div class="loan-type-card">
                    <div class="text-center">
                        <i class="fas fa-chart-line feature-icon"></i>
                        <h4>Extended Loan</h4>
                        <div class="loan-rate">40%</div>
                        <div class="loan-term">3 Month Term</div>
                    </div>

                    <hr class="my-4">

                    <h6>Perfect for:</h6>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success"></i> Business investments</li>
                        <li><i class="fas fa-check text-success"></i> Major purchases</li>
                        <li><i class="fas fa-check text-success"></i> Debt consolidation</li>
                        <li><i class="fas fa-check text-success"></i> Equipment financing</li>
                    </ul>

                    <div class="mt-4">
                        <strong>Amount Range:</strong> R5,000 - R50,000<br>
                        <strong>Approval Time:</strong> Within 72 hours<br>
                        <strong>Repayment:</strong> Manageable monthly installments
                    </div>

                    <div class="mt-4">
                        <small class="text-muted">
                            <strong>Extended:</strong> Lower monthly payments for larger amounts
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Why Choose Our Microloans?</h2>
            <p class="text-muted">We make borrowing simple, fast, and transparent</p>
        </div>

        <div class="row">
            <div class="col-md-3 text-center mb-4">
                <div class="feature-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h5>Quick Approval</h5>
                <p class="text-muted">Get approved within 24-72 hours with our streamlined process</p>
            </div>

            <div class="col-md-3 text-center mb-4">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h5>Secure & Safe</h5>
                <p class="text-muted">Your personal and financial information is protected with bank-level security</p>
            </div>

            <div class="col-md-3 text-center mb-4">
                <div class="feature-icon">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <h5>Flexible Terms</h5>
                <p class="text-muted">Choose from 1, 2, or 3-month terms that fit your budget</p>
            </div>

            <div class="col-md-3 text-center mb-4">
                <div class="feature-icon">
                    <i class="fas fa-calculator"></i>
                </div>
                <h5>Transparent Rates</h5>
                <p class="text-muted">No hidden fees - know exactly what you'll pay upfront</p>
            </div>
        </div>
    </div>
</section>

<!-- Application Process -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Simple Application Process</h2>
            <p class="text-muted">Get your loan in just 4 easy steps</p>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <h5>Apply Online</h5>
                    <p class="text-muted">Fill out our quick online application form in minutes</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="process-step">
                    <div class="step-number">2</div>
                    <h5>Get Approved</h5>
                    <p class="text-muted">Receive approval notification within 24-72 hours</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="process-step">
                    <div class="step-number">3</div>
                    <h5>Receive Funds</h5>
                    <p class="text-muted">Money is deposited directly into your bank account</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="process-step">
                    <div class="step-number">4</div>
                    <h5>Repay Easily</h5>
                    <p class="text-muted">Make payments through our convenient debit order system</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Requirements Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h3>Loan Requirements</h3>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-check text-success"></i> South African citizen or permanent resident</li>
                    <li class="mb-2"><i class="fas fa-check text-success"></i> Age 18 years or older</li>
                    <li class="mb-2"><i class="fas fa-check text-success"></i> Regular monthly income</li>
                    <li class="mb-2"><i class="fas fa-check text-success"></i> Valid bank account</li>
                    <li class="mb-2"><i class="fas fa-check text-success"></i> Valid ID document</li>
                    <li class="mb-2"><i class="fas fa-check text-success"></i> Proof of income (payslip/bank statement)</li>
                </ul>
            </div>

            <div class="col-lg-6">
                <h3>Documents Needed</h3>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-file-alt text-primary"></i> Copy of ID document</li>
                    <li class="mb-2"><i class="fas fa-file-alt text-primary"></i> Latest payslip or proof of income</li>
                    <li class="mb-2"><i class="fas fa-file-alt text-primary"></i> 3 months bank statements</li>
                    <li class="mb-2"><i class="fas fa-file-alt text-primary"></i> Proof of residence</li>
                    <li class="mb-2"><i class="fas fa-file-alt text-primary"></i> Employment letter (if applicable)</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2>Ready to Apply for Your Microloan?</h2>
        <p class="lead mb-4">Join thousands of satisfied customers who have trusted us with their financial needs</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('register') }}" class="btn btn-apply btn-lg">
                <i class="fas fa-paper-plane"></i> Apply Now
            </a>
            <a href="#" class="btn btn-outline-primary btn-lg">
                <i class="fas fa-calculator"></i> Calculate Loan
            </a>
        </div>

        <div class="mt-4">
            <small class="text-muted">
                <strong>NCR Registration:</strong> NCR 19330 |
                <strong>Responsible Lending:</strong> We promote responsible lending practices
            </small>
        </div>
    </div>
</section>
@endsection
