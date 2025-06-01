@extends('layouts.banking')

@section('page-title', 'Apply for PhilaLink Microloan')

@section('content')
<style>
.application-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 15px;
    padding: 2rem;
    margin-bottom: 2rem;
}

.loan-type-card {
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
    cursor: pointer;
}

.loan-type-card:hover {
    border-color: #667eea;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
}

.loan-type-card.selected {
    border-color: #667eea;
    background: #f8f9ff;
}

.loan-rate {
    font-size: 1.5rem;
    font-weight: 700;
    color: #667eea;
}

.progress-steps {
    display: flex;
    justify-content: space-between;
    margin-bottom: 2rem;
}

.step {
    flex: 1;
    text-align: center;
    position: relative;
}

.step.active .step-number {
    background: #667eea;
    color: white;
}

.step.completed .step-number {
    background: #28a745;
    color: white;
}

.step-number {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #e9ecef;
    color: #6c757d;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 0.5rem;
    font-weight: 600;
}

.step-title {
    font-size: 0.9rem;
    color: #6c757d;
}

.step.active .step-title {
    color: #667eea;
    font-weight: 600;
}

.calculation-preview {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 1.5rem;
    margin-top: 1rem;
}

.preview-item {
    display: flex;
    justify-content: space-between;
    padding: 0.5rem 0;
    border-bottom: 1px solid #dee2e6;
}

.preview-item:last-child {
    border-bottom: none;
    font-weight: 700;
    color: #667eea;
}
</style>

<div class="application-header">
    <h3><i class="fas fa-hand-holding-usd"></i> PhilaLink Microloan Application</h3>
    <p>Quick and easy loan application with instant approval for eligible customers</p>
</div>

<!-- Progress Steps -->
<div class="progress-steps">
    <div class="step active">
        <div class="step-number">1</div>
        <div class="step-title">Loan Details</div>
    </div>
    <div class="step">
        <div class="step-number">2</div>
        <div class="step-title">Personal Info</div>
    </div>
    <div class="step">
        <div class="step-number">3</div>
        <div class="step-title">Documents</div>
    </div>
    <div class="step">
        <div class="step-number">4</div>
        <div class="step-title">Review</div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5>{{ _lang('Loan Application Form') }}</h5>
            </div>
            <div class="card-body">
                <form method="post" class="validate" autocomplete="off" action="{{ route('loans.apply_loan') }}" enctype="multipart/form-data" id="loanApplicationForm">
                    {{ csrf_field() }}

                    <!-- Step 1: Loan Details -->
                    <div class="form-step active" id="step1">
                        <h6 class="mb-3">{{ _lang('Select Your Microloan Type') }}</h6>

                        <!-- Microloan Types -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="loan-type-card" data-term="1" data-rate="26" data-product="emergency">
                                    <h6>Emergency Loan</h6>
                                    <div class="loan-rate">26%</div>
                                    <p class="text-muted">1 Month Term</p>
                                    <small>Perfect for urgent expenses and emergencies</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="loan-type-card" data-term="2" data-rate="35" data-product="standard">
                                    <h6>Standard Loan</h6>
                                    <div class="loan-rate">35%</div>
                                    <p class="text-muted">2 Month Term</p>
                                    <small>Flexible repayment with equal monthly payments</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="loan-type-card" data-term="3" data-rate="40" data-product="extended">
                                    <h6>Extended Loan</h6>
                                    <div class="loan-rate">40%</div>
                                    <p class="text-muted">3 Month Term</p>
                                    <small>Extended repayment for larger amounts</small>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Loan Amount') }} (R)</label>
                                    <input type="number" class="form-control" name="applied_amount" id="loanAmount"
                                           value="{{ request('amount') ?? old('applied_amount') }}"
                                           min="500" max="50000" step="100" required>
                                    <small class="form-text text-muted">Minimum: R500 | Maximum: R50,000</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Purpose of Loan') }}</label>
                                    <select class="form-control" name="loan_purpose" required>
                                        <option value="">{{ _lang('Select Purpose') }}</option>
                                        <option value="emergency">Emergency Expenses</option>
                                        <option value="medical">Medical Bills</option>
                                        <option value="education">Education</option>
                                        <option value="home_improvement">Home Improvement</option>
                                        <option value="business">Business Investment</option>
                                        <option value="debt_consolidation">Debt Consolidation</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden fields for loan product -->
                        <input type="hidden" name="loan_product_id" id="loanProductId" value="">
                        <input type="hidden" name="currency_id" value="1"> <!-- Default to base currency -->
                        <input type="hidden" name="loan_term" id="loanTerm" value="">
                        <input type="hidden" name="interest_rate" id="interestRate" value="">

                        <button type="button" class="btn btn-primary" onclick="nextStep(2)">
                            {{ _lang('Next Step') }} <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>

                    <!-- Step 2: Personal Information -->
                    <div class="form-step" id="step2" style="display: none;">
                        <h6 class="mb-3">{{ _lang('Personal Information') }}</h6>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Employment Status') }}</label>
                                    <select class="form-control" name="employment_status" required>
                                        <option value="">{{ _lang('Select Status') }}</option>
                                        <option value="employed">Employed</option>
                                        <option value="self_employed">Self Employed</option>
                                        <option value="unemployed">Unemployed</option>
                                        <option value="retired">Retired</option>
                                        <option value="student">Student</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Monthly Income') }} (R)</label>
                                    <input type="number" class="form-control" name="monthly_income"
                                           value="{{ Auth::user()->monthly_income ?? '' }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('First Payment Date') }}</label>
                                    <input type="date" class="form-control" name="first_payment_date"
                                           value="{{ old('first_payment_date') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Bank Account Number') }}</label>
                                    <input type="text" class="form-control" name="bank_account"
                                           value="{{ Auth::user()->primary_account_number ?? '' }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" onclick="prevStep(1)">
                                <i class="fas fa-arrow-left"></i> {{ _lang('Previous') }}
                            </button>
                            <button type="button" class="btn btn-primary" onclick="nextStep(3)">
                                {{ _lang('Next Step') }} <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 3: Documents -->
                    <div class="form-step" id="step3" style="display: none;">
                        <h6 class="mb-3">{{ _lang('Supporting Documents') }}</h6>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Supporting Documents') }}</label>
                                    <input type="file" class="form-control" name="attachment" accept=".pdf,.jpg,.jpeg,.png">
                                    <small class="form-text text-muted">
                                        Upload proof of income, bank statements, or ID document (PDF, JPG, PNG)
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">{{ _lang('Additional Information') }}</label>
                                    <textarea class="form-control" name="description" rows="4"
                                              placeholder="Provide any additional information about your loan application">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" onclick="prevStep(2)">
                                <i class="fas fa-arrow-left"></i> {{ _lang('Previous') }}
                            </button>
                            <button type="button" class="btn btn-primary" onclick="nextStep(4)">
                                {{ _lang('Review Application') }} <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 4: Review -->
                    <div class="form-step" id="step4" style="display: none;">
                        <h6 class="mb-3">{{ _lang('Review Your Application') }}</h6>

                        <div id="applicationReview">
                            <!-- Review content will be populated by JavaScript -->
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="termsAccepted" required>
                            <label class="form-check-label" for="termsAccepted">
                                I agree to the <a href="#" target="_blank">Terms and Conditions</a> and
                                <a href="#" target="_blank">Privacy Policy</a>
                            </label>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" onclick="prevStep(3)">
                                <i class="fas fa-arrow-left"></i> {{ _lang('Previous') }}
                            </button>
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-paper-plane"></i> {{ _lang('Submit Application') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Loan Calculator Preview -->
        <div class="card">
            <div class="card-header">
                <h6>{{ _lang('Loan Summary') }}</h6>
            </div>
            <div class="card-body">
                <div id="loanPreview" style="display: none;">
                    <div class="calculation-preview">
                        <div class="preview-item">
                            <span>{{ _lang('Loan Amount') }}:</span>
                            <span id="previewAmount">R0.00</span>
                        </div>
                        <div class="preview-item">
                            <span>{{ _lang('Interest Rate') }}:</span>
                            <span id="previewRate">0%</span>
                        </div>
                        <div class="preview-item">
                            <span>{{ _lang('Loan Term') }}:</span>
                            <span id="previewTerm">0 months</span>
                        </div>
                        <div class="preview-item">
                            <span>{{ _lang('Interest Amount') }}:</span>
                            <span id="previewInterest">R0.00</span>
                        </div>
                        <div class="preview-item">
                            <span>{{ _lang('Total Repayment') }}:</span>
                            <span id="previewTotal">R0.00</span>
                        </div>
                        <div class="preview-item">
                            <span>{{ _lang('Monthly Payment') }}:</span>
                            <span id="previewMonthly">R0.00</span>
                        </div>
                    </div>
                </div>

                <div id="noPreview" class="text-center text-muted">
                    <i class="fas fa-calculator fa-2x mb-2"></i>
                    <p>Select loan type and amount to see preview</p>
                </div>
            </div>
        </div>

        <!-- Help Information -->
        <div class="card mt-3">
            <div class="card-header">
                <h6>{{ _lang('Need Help?') }}</h6>
            </div>
            <div class="card-body">
                <p class="text-muted">Our loan specialists are here to help you choose the right loan for your needs.</p>
                <a href="#" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-phone"></i> Contact Support
                </a>
            </div>
        </div>
    </div>
</div>

<script>
let selectedLoanType = null;
let currentStep = 1;

// Initialize form with URL parameters
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const amount = urlParams.get('amount');
    const term = urlParams.get('term');
    const rate = urlParams.get('rate');

    if (amount) {
        document.getElementById('loanAmount').value = amount;
    }

    if (term && rate) {
        // Select the appropriate loan type
        const loanCard = document.querySelector(`[data-term="${term}"][data-rate="${rate}"]`);
        if (loanCard) {
            loanCard.click();
        }
    }
});

// Loan type selection
document.querySelectorAll('.loan-type-card').forEach(card => {
    card.addEventListener('click', function() {
        // Remove selected class from all cards
        document.querySelectorAll('.loan-type-card').forEach(c => c.classList.remove('selected'));

        // Add selected class to clicked card
        this.classList.add('selected');

        // Store selected loan type
        selectedLoanType = {
            term: parseInt(this.dataset.term),
            rate: parseFloat(this.dataset.rate),
            product: this.dataset.product
        };

        // Update hidden fields
        document.getElementById('loanTerm').value = selectedLoanType.term;
        document.getElementById('interestRate').value = selectedLoanType.rate;
        document.getElementById('loanProductId').value = selectedLoanType.product;

        // Update preview
        updateLoanPreview();
    });
});

// Amount input change
document.getElementById('loanAmount').addEventListener('input', updateLoanPreview);

function updateLoanPreview() {
    const amount = parseFloat(document.getElementById('loanAmount').value);

    if (!amount || !selectedLoanType) {
        document.getElementById('loanPreview').style.display = 'none';
        document.getElementById('noPreview').style.display = 'block';
        return;
    }

    // Calculate loan details
    const principal = amount;
    const rate = selectedLoanType.rate / 100;
    const term = selectedLoanType.term;

    const interestAmount = principal * rate;
    const totalAmount = principal + interestAmount;
    const monthlyPayment = totalAmount / term;

    // Update preview
    document.getElementById('previewAmount').textContent = 'R' + principal.toLocaleString('en-ZA', {minimumFractionDigits: 2});
    document.getElementById('previewRate').textContent = selectedLoanType.rate + '%';
    document.getElementById('previewTerm').textContent = term + ' month' + (term > 1 ? 's' : '');
    document.getElementById('previewInterest').textContent = 'R' + interestAmount.toLocaleString('en-ZA', {minimumFractionDigits: 2});
    document.getElementById('previewTotal').textContent = 'R' + totalAmount.toLocaleString('en-ZA', {minimumFractionDigits: 2});
    document.getElementById('previewMonthly').textContent = 'R' + monthlyPayment.toLocaleString('en-ZA', {minimumFractionDigits: 2});

    // Show preview
    document.getElementById('loanPreview').style.display = 'block';
    document.getElementById('noPreview').style.display = 'none';
}

function nextStep(step) {
    // Validate current step
    if (!validateStep(currentStep)) {
        return;
    }

    // Hide current step
    document.getElementById('step' + currentStep).style.display = 'none';
    document.querySelector('.step:nth-child(' + currentStep + ')').classList.remove('active');
    document.querySelector('.step:nth-child(' + currentStep + ')').classList.add('completed');

    // Show next step
    currentStep = step;
    document.getElementById('step' + currentStep).style.display = 'block';
    document.querySelector('.step:nth-child(' + currentStep + ')').classList.add('active');

    // Update review if on step 4
    if (currentStep === 4) {
        updateReview();
    }
}

function prevStep(step) {
    // Hide current step
    document.getElementById('step' + currentStep).style.display = 'none';
    document.querySelector('.step:nth-child(' + currentStep + ')').classList.remove('active');

    // Show previous step
    currentStep = step;
    document.getElementById('step' + currentStep).style.display = 'block';
    document.querySelector('.step:nth-child(' + currentStep + ')').classList.add('active');
    document.querySelector('.step:nth-child(' + currentStep + ')').classList.remove('completed');
}

function validateStep(step) {
    switch(step) {
        case 1:
            if (!selectedLoanType) {
                alert('Please select a loan type');
                return false;
            }
            const amount = document.getElementById('loanAmount').value;
            if (!amount || amount < 500 || amount > 50000) {
                alert('Please enter a valid loan amount between R500 and R50,000');
                return false;
            }
            break;
        case 2:
            // Validate required fields in step 2
            const requiredFields = ['employment_status', 'monthly_income', 'first_payment_date', 'bank_account'];
            for (let field of requiredFields) {
                if (!document.querySelector(`[name="${field}"]`).value) {
                    alert('Please fill in all required fields');
                    return false;
                }
            }
            break;
    }
    return true;
}

function updateReview() {
    const formData = new FormData(document.getElementById('loanApplicationForm'));
    const amount = document.getElementById('loanAmount').value;

    let reviewHtml = `
        <div class="calculation-preview">
            <h6>Loan Details</h6>
            <div class="preview-item">
                <span>Loan Type:</span>
                <span>${selectedLoanType.term} Month ${selectedLoanType.product.charAt(0).toUpperCase() + selectedLoanType.product.slice(1)} Loan</span>
            </div>
            <div class="preview-item">
                <span>Loan Amount:</span>
                <span>R${parseFloat(amount).toLocaleString('en-ZA', {minimumFractionDigits: 2})}</span>
            </div>
            <div class="preview-item">
                <span>Interest Rate:</span>
                <span>${selectedLoanType.rate}%</span>
            </div>
            <div class="preview-item">
                <span>Purpose:</span>
                <span>${formData.get('loan_purpose')}</span>
            </div>

            <h6 class="mt-3">Personal Information</h6>
            <div class="preview-item">
                <span>Employment Status:</span>
                <span>${formData.get('employment_status')}</span>
            </div>
            <div class="preview-item">
                <span>Monthly Income:</span>
                <span>R${parseFloat(formData.get('monthly_income')).toLocaleString('en-ZA', {minimumFractionDigits: 2})}</span>
            </div>
            <div class="preview-item">
                <span>First Payment Date:</span>
                <span>${formData.get('first_payment_date')}</span>
            </div>
        </div>
    `;

    document.getElementById('applicationReview').innerHTML = reviewHtml;
}
</script>
@endsection
