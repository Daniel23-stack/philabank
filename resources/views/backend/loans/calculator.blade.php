@extends('layouts.banking')

@section('page-title', 'PhilaLink Loan Calculator')

@section('content')
<style>
.calculator-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 15px;
    padding: 2rem;
    margin-bottom: 2rem;
}

.loan-option {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1rem;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
    cursor: pointer;
}

.loan-option:hover {
    border-color: #667eea;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
}

.loan-option.selected {
    border-color: #667eea;
    background: #f8f9ff;
}

.loan-type {
    font-size: 1.2rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 0.5rem;
}

.loan-rate {
    font-size: 2rem;
    font-weight: 800;
    color: #667eea;
    margin: 0.5rem 0;
}

.loan-description {
    color: #666;
    font-size: 0.9rem;
}

.calculation-result {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 2rem;
    margin-top: 2rem;
}

.result-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid #dee2e6;
}

.result-item:last-child {
    border-bottom: none;
}

.result-label {
    font-weight: 600;
    color: #495057;
}

.result-value {
    font-weight: 700;
    color: #333;
}

.total-amount {
    font-size: 1.5rem;
    color: #667eea;
}

.apply-btn {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    border: none;
    color: white;
    padding: 1rem 2rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.apply-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
}
</style>

<div class="calculator-card">
    <h3><i class="fas fa-calculator"></i> PhilaLink Microloan Calculator</h3>
    <p>Calculate your loan repayment with our competitive interest rates and transparent terms</p>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5>{{ _lang('Loan Calculator') }}</h5>
            </div>
            <div class="card-body">
                <form id="loanCalculatorForm">
                    <!-- Loan Amount -->
                    <div class="form-group mb-4">
                        <label for="loanAmount" class="form-label">{{ _lang('Loan Amount') }} (R)</label>
                        <input type="number" class="form-control form-control-lg" id="loanAmount"
                               placeholder="Enter loan amount" min="500" max="50000" step="100" value="5000">
                        <small class="form-text text-muted">Minimum: R500 | Maximum: R50,000</small>
                    </div>

                    <!-- Loan Type Selection -->
                    <div class="form-group mb-4">
                        <label class="form-label">{{ _lang('Select Loan Type') }}</label>

                        <div class="loan-option" data-term="1" data-rate="26">
                            <div class="loan-type">One-Month Emergency Loan</div>
                            <div class="loan-rate">26% Interest</div>
                            <div class="loan-description">
                                Perfect for emergency expenses. Interest compounds if unpaid after 30 days.
                                <br><strong>Ideal for:</strong> Medical emergencies, urgent repairs, unexpected bills
                            </div>
                        </div>

                        <div class="loan-option" data-term="2" data-rate="35">
                            <div class="loan-type">Two-Month Standard Loan</div>
                            <div class="loan-rate">35% Interest</div>
                            <div class="loan-description">
                                Flexible repayment over 2 months with equal monthly payments.
                                <br><strong>Ideal for:</strong> Home improvements, appliance purchases, education expenses
                            </div>
                        </div>

                        <div class="loan-option" data-term="3" data-rate="40">
                            <div class="loan-type">Three-Month Extended Loan</div>
                            <div class="loan-rate">40% Interest</div>
                            <div class="loan-description">
                                Extended repayment period with manageable monthly installments.
                                <br><strong>Ideal for:</strong> Business investments, major purchases, debt consolidation
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary btn-lg" onclick="calculateLoan()">
                        <i class="fas fa-calculator"></i> Calculate Loan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5>{{ _lang('Calculation Results') }}</h5>
            </div>
            <div class="card-body">
                <div id="calculationResults" style="display: none;">
                    <div class="calculation-result">
                        <div class="result-item">
                            <span class="result-label">{{ _lang('Loan Amount') }}:</span>
                            <span class="result-value" id="resultPrincipal">R0.00</span>
                        </div>
                        <div class="result-item">
                            <span class="result-label">{{ _lang('Interest Rate') }}:</span>
                            <span class="result-value" id="resultRate">0%</span>
                        </div>
                        <div class="result-item">
                            <span class="result-label">{{ _lang('Loan Term') }}:</span>
                            <span class="result-value" id="resultTerm">0 months</span>
                        </div>
                        <div class="result-item">
                            <span class="result-label">{{ _lang('Interest Amount') }}:</span>
                            <span class="result-value" id="resultInterest">R0.00</span>
                        </div>
                        <div class="result-item">
                            <span class="result-label">{{ _lang('Total Repayment') }}:</span>
                            <span class="result-value total-amount" id="resultTotal">R0.00</span>
                        </div>
                        <div class="result-item">
                            <span class="result-label">{{ _lang('Monthly Payment') }}:</span>
                            <span class="result-value" id="resultMonthly">R0.00</span>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="button" class="apply-btn w-100" onclick="applyForLoan()">
                            <i class="fas fa-paper-plane"></i> Apply for This Loan
                        </button>
                    </div>
                </div>

                <div id="noCalculation" class="text-center text-muted">
                    <i class="fas fa-calculator fa-3x mb-3"></i>
                    <p>Enter loan amount and select loan type to see calculation results</p>
                </div>
            </div>
        </div>

        <!-- Loan Information -->
        <div class="card mt-3">
            <div class="card-header">
                <h6>{{ _lang('Important Information') }}</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li><i class="fas fa-check text-success"></i> Quick approval process</li>
                    <li><i class="fas fa-check text-success"></i> No hidden fees</li>
                    <li><i class="fas fa-check text-success"></i> Flexible repayment options</li>
                    <li><i class="fas fa-check text-success"></i> Secure online application</li>
                </ul>

                <hr>

                <small class="text-muted">
                    <strong>NCR Registration:</strong> NCR 19330<br>
                    Interest rates are calculated on the principal amount.
                    Early repayment options available.
                </small>
            </div>
        </div>
    </div>
</div>

<script>
let selectedLoanType = null;

// Loan option selection
document.querySelectorAll('.loan-option').forEach(option => {
    option.addEventListener('click', function() {
        // Remove selected class from all options
        document.querySelectorAll('.loan-option').forEach(opt => opt.classList.remove('selected'));

        // Add selected class to clicked option
        this.classList.add('selected');

        // Store selected loan type
        selectedLoanType = {
            term: parseInt(this.dataset.term),
            rate: parseFloat(this.dataset.rate)
        };

        // Auto-calculate if amount is entered
        const amount = document.getElementById('loanAmount').value;
        if (amount && amount > 0) {
            calculateLoan();
        }
    });
});

// Auto-calculate on amount change
document.getElementById('loanAmount').addEventListener('input', function() {
    if (selectedLoanType && this.value > 0) {
        calculateLoan();
    }
});

function calculateLoan() {
    const amount = parseFloat(document.getElementById('loanAmount').value);

    if (!amount || amount < 500 || amount > 50000) {
        alert('Please enter a valid loan amount between R500 and R50,000');
        return;
    }

    if (!selectedLoanType) {
        alert('Please select a loan type');
        return;
    }

    // Calculate interest and total
    const principal = amount;
    const rate = selectedLoanType.rate / 100;
    const term = selectedLoanType.term;

    // Simple interest calculation
    const interestAmount = principal * rate;
    const totalAmount = principal + interestAmount;
    const monthlyPayment = totalAmount / term;

    // Update results
    document.getElementById('resultPrincipal').textContent = 'R' + principal.toLocaleString('en-ZA', {minimumFractionDigits: 2});
    document.getElementById('resultRate').textContent = selectedLoanType.rate + '%';
    document.getElementById('resultTerm').textContent = term + ' month' + (term > 1 ? 's' : '');
    document.getElementById('resultInterest').textContent = 'R' + interestAmount.toLocaleString('en-ZA', {minimumFractionDigits: 2});
    document.getElementById('resultTotal').textContent = 'R' + totalAmount.toLocaleString('en-ZA', {minimumFractionDigits: 2});
    document.getElementById('resultMonthly').textContent = 'R' + monthlyPayment.toLocaleString('en-ZA', {minimumFractionDigits: 2});

    // Show results
    document.getElementById('calculationResults').style.display = 'block';
    document.getElementById('noCalculation').style.display = 'none';
}

function applyForLoan() {
    if (!selectedLoanType) {
        alert('Please calculate a loan first');
        return;
    }

    const amount = document.getElementById('loanAmount').value;
    const term = selectedLoanType.term;
    const rate = selectedLoanType.rate;

    // Redirect to loan application with pre-filled data
    window.location.href = `{{ route('loans.apply_loan') }}?amount=${amount}&term=${term}&rate=${rate}`;
}
</script>
@endsection
