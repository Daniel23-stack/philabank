<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'account_number',
        'country_code',
        'phone',
        'password',
        'user_type',
        'email_verified_at',
        'status',
        'profile_picture',
        'two_factor_code',
        'two_factor_expires_at',
        // Personal Details
        'identity_number',
        'passport_number',
        'identity_type',
        'date_of_birth',
        'gender',
        'nationality',
        // Address Information
        'residential_address',
        'city',
        'state_province',
        'postal_code',
        'country',
        // Contact Information
        'alternative_phone',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_relationship',
        // Employment Information
        'employment_status',
        'employer_name',
        'employer_address',
        'job_title',
        'monthly_income',
        'employment_start_date',
        // Financial Information
        'monthly_expenses',
        'existing_debt',
        'bank_account_type',
        'bank_name',
        'bank_account_number',
        // Credit Information
        'credit_score',
        'credit_history',
        'has_previous_loans',
        'previous_loan_details',
        // KYC and Compliance
        'kyc_status',
        'kyc_completed_at',
        'last_info_update',
        'next_required_update',
        'info_update_required',
        // Risk Assessment
        'risk_category',
        'risk_score',
        'risk_assessment_date',
        // Loan Eligibility
        'loan_eligible',
        'max_loan_amount',
        'eligibility_notes',
        // Verification Status
        'address_verified',
        'employment_verified',
        'income_verified',
        'address_verified_at',
        'employment_verified_at',
        'income_verified_at',
        // System Fields
        'verification_documents',
        'admin_notes',
        'profile_completed_at',
        'terms_accepted',
        'terms_accepted_at',
        // Document Upload Fields
        'identity_documents',
        'address_proof_documents',
        'income_proof_documents',
        'collateral_documents',
        'payslip_documents',
        'headshot_documents',
        // Document Status
        'identity_document_status',
        'address_proof_status',
        'income_proof_status',
        'collateral_document_status',
        'payslip_status',
        'headshot_status',
        // Document Rejection Reasons
        'identity_document_rejection_reason',
        'address_proof_rejection_reason',
        'income_proof_rejection_reason',
        'collateral_document_rejection_reason',
        'payslip_rejection_reason',
        'headshot_rejection_reason',
        // Consent and Declarations
        'credit_check_consent',
        'credit_check_consent_ip',
        'data_processing_consent',
        'data_processing_consent_ip',
        'marketing_consent',
        'marketing_consent_ip',
        'loan_terms_consent',
        'loan_terms_consent_ip',
        // Digital Signature
        'digital_signature',
        'digital_signature_ip',
        'signature_type',
        // Document Completeness
        'document_completeness_score',
        'all_documents_uploaded',
        'all_documents_verified',
        'overall_kyc_status',
        'kyc_rejection_reason',
        'kyc_review_attempts',
        // Document Security
        'document_encryption_keys',
        'documents_encrypted',
        'document_access_log',
        // Compliance
        'aml_check_passed',
        'sanctions_check_passed',
        'compliance_notes',
        // Financial Details - Primary Bank
        'primary_bank_name',
        'primary_bank_branch',
        'primary_account_number',
        'primary_account_name',
        'primary_account_type',
        'primary_bank_code',
        'primary_swift_code',
        'salary_deposited_here',
        'average_monthly_balance',
        // Financial Details - Secondary Bank
        'secondary_bank_name',
        'secondary_bank_branch',
        'secondary_account_number',
        'secondary_account_name',
        'secondary_account_type',
        'secondary_bank_code',
        'secondary_swift_code',
        'preferred_disbursement_account',
        // Mobile Money
        'mobile_money_provider',
        'mobile_money_number',
        'mobile_money_name',
        'mobile_money_verified',
        // Existing Debts
        'existing_loans',
        'total_existing_debt_amount',
        'total_monthly_debt_payments',
        // Credit Cards
        'has_credit_cards',
        'credit_cards',
        'total_credit_limit',
        'total_credit_used',
        // Other Financial Information
        'has_savings_account',
        'total_savings_amount',
        'has_investments',
        'total_investment_value',
        'investment_types',
        // Financial Behavior
        'spending_pattern',
        'savings_frequency',
        'monthly_savings_target',
        'emergency_fund_months',
        // Financial Goals
        'financial_goals',
        'loan_purpose',
        'loan_purpose_description',
        // Bank Verification
        'primary_bank_verified',
        'secondary_bank_verified',
        'primary_bank_verified_at',
        'secondary_bank_verified_at',
        // Financial Documents
        'bank_statements',
        'salary_slips',
        'tax_documents',
        'financial_documents',
        // Financial Assessment
        'financial_health_score',
        'financial_assessment_date',
        'financial_assessment_notes',
        // Detailed Monthly Expenses
        'housing_expenses',
        'housing_range',
        'housing_details',
        'groceries_expenses',
        'groceries_range',
        'transport_expenses',
        'transport_range',
        'transport_details',
        'education_expenses',
        'education_range',
        'number_of_children',
        'education_details',
        'medical_expenses',
        'medical_range',
        'has_medical_aid',
        'medical_details',
        'debt_repayment_expenses',
        'debt_repayment_range',
        'miscellaneous_expenses',
        'miscellaneous_range',
        'miscellaneous_details',
        'insurance_expenses',
        'insurance_range',
        'insurance_details',
        'entertainment_expenses',
        'entertainment_range',
        'savings_contributions',
        'savings_range',
        // Expense Analysis
        'total_calculated_expenses',
        'expense_income_ratio',
        'disposable_income',
        'expense_accuracy',
        'expenses_verified',
        'expenses_verified_at',
        'expense_documents',
        'expense_pattern',
        'expense_notes',
        'expense_assessment_date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'updated_at'            => 'datetime',
        'created_at'            => 'datetime',
        'email_verified_at'     => 'datetime',
        'two_factor_expires_at' => 'datetime',
        'otp_expires_at'        => 'datetime',
        // New date fields
        'date_of_birth'         => 'date',
        'employment_start_date' => 'date',
        'kyc_completed_at'      => 'datetime',
        'last_info_update'      => 'datetime',
        'next_required_update'  => 'datetime',
        'risk_assessment_date'  => 'datetime',
        'address_verified_at'   => 'datetime',
        'employment_verified_at' => 'datetime',
        'income_verified_at'    => 'datetime',
        'profile_completed_at'  => 'datetime',
        'terms_accepted_at'     => 'datetime',
        // JSON fields
        'verification_documents' => 'array',
        'existing_loans'        => 'array',
        'credit_cards'          => 'array',
        'investment_types'      => 'array',
        'financial_goals'       => 'array',
        'bank_statements'       => 'array',
        'salary_slips'          => 'array',
        'tax_documents'         => 'array',
        'financial_documents'   => 'array',
        // Document Upload Fields
        'identity_documents'    => 'array',
        'address_proof_documents' => 'array',
        'income_proof_documents' => 'array',
        'collateral_documents'  => 'array',
        'payslip_documents'     => 'array',
        'headshot_documents'    => 'array',
        // Document Security
        'document_encryption_keys' => 'array',
        'document_access_log'   => 'array',
        'compliance_notes'      => 'array',
        // Boolean fields
        'has_previous_loans'    => 'boolean',
        'info_update_required'  => 'boolean',
        'loan_eligible'         => 'boolean',
        'address_verified'      => 'boolean',
        'employment_verified'   => 'boolean',
        'income_verified'       => 'boolean',
        'terms_accepted'        => 'boolean',
        'salary_deposited_here' => 'boolean',
        'preferred_disbursement_account' => 'boolean',
        'mobile_money_verified' => 'boolean',
        'has_credit_cards'      => 'boolean',
        'has_savings_account'   => 'boolean',
        'has_investments'       => 'boolean',
        'primary_bank_verified' => 'boolean',
        'secondary_bank_verified' => 'boolean',
        // Consent and Declaration fields
        'credit_check_consent' => 'boolean',
        'data_processing_consent' => 'boolean',
        'marketing_consent' => 'boolean',
        'loan_terms_consent' => 'boolean',
        // Document Status fields
        'all_documents_uploaded' => 'boolean',
        'all_documents_verified' => 'boolean',
        'documents_encrypted' => 'boolean',
        'aml_check_passed' => 'boolean',
        'sanctions_check_passed' => 'boolean',
        // Additional date fields
        'primary_bank_verified_at' => 'datetime',
        'secondary_bank_verified_at' => 'datetime',
        'financial_assessment_date' => 'datetime',
        'expenses_verified_at' => 'datetime',
        'expense_assessment_date' => 'datetime',
        // Document verification dates
        'identity_document_verified_at' => 'datetime',
        'address_proof_verified_at' => 'datetime',
        'income_proof_verified_at' => 'datetime',
        'collateral_document_verified_at' => 'datetime',
        'payslip_verified_at' => 'datetime',
        'headshot_verified_at' => 'datetime',
        // Consent dates
        'credit_check_consent_at' => 'datetime',
        'data_processing_consent_at' => 'datetime',
        'marketing_consent_at' => 'datetime',
        'loan_terms_consent_at' => 'datetime',
        'digital_signature_at' => 'datetime',
        'documents_completed_at' => 'datetime',
        'aml_check_date' => 'datetime',
        'sanctions_check_date' => 'datetime',
        'last_document_access' => 'datetime',
        // Additional JSON fields
        'expense_documents' => 'array',
        // Additional boolean fields
        'has_medical_aid' => 'boolean',
        'expenses_verified' => 'boolean',
    ];

    public function getCreatedAtAttribute($value) {
        $date_format = get_date_format();
        $time_format = get_time_format();
        return \Carbon\Carbon::parse($value)->format("$date_format $time_format");
    }

    public function role() {
        return $this->belongsTo('App\Models\Role', 'role_id')->withDefault(['name' => _lang('Default')]);
    }

    public function branch() {
        return $this->belongsTo('App\Models\Branch', 'branch_id')->withDefault(['name' => _lang('Default')]);
    }

    public function transactions() {
        return $this->hasMany('App\Models\Transaction', 'user_id')->with('currency')->orderBy('id', 'desc');
    }

    public function loans() {
        return $this->hasMany('App\Models\Loan', 'borrower_id')->with('currency')->orderBy('id', 'desc');
    }

    public function fixed_deposits() {
        return $this->hasMany('App\Models\FixedDeposit', 'user_id')->with('currency')->orderBy('id', 'desc');
    }

    public function support_tickets() {
        return $this->hasMany('App\Models\SupportTicket', 'user_id')->orderBy('id', 'desc');
    }

    public function documents() {
        return $this->hasMany('App\Models\Document', 'user_id');
    }

    public function generateTwoFactorCode() {
        $this->timestamps            = false;
        $this->two_factor_code       = rand(100000, 999999);
        $this->two_factor_expires_at = now()->addMinutes(30);
        $this->save();
    }

    public function resetTwoFactorCode() {
        $this->timestamps            = false;
        $this->two_factor_code       = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    public function generateOTP() {
        $this->timestamps     = false;
        $this->otp            = rand(100000, 999999);
        $this->otp_expires_at = now()->addMinutes(5);
        $this->save();
    }

    // Microloan System Methods

    /**
     * Check if user information needs to be updated (every 3 months)
     */
    public function needsInfoUpdate() {
        if (!$this->last_info_update) {
            return true;
        }
        return $this->last_info_update->addMonths(3)->isPast();
    }

    /**
     * Mark information as updated and set next required update
     */
    public function markInfoUpdated() {
        $this->last_info_update = now();
        $this->next_required_update = now()->addMonths(3);
        $this->info_update_required = false;
        $this->save();
    }

    /**
     * Check if profile is complete for loan application
     */
    public function isProfileComplete() {
        $requiredFields = [
            'identity_number', 'date_of_birth', 'residential_address',
            'phone', 'employment_status', 'monthly_income'
        ];

        foreach ($requiredFields as $field) {
            if (empty($this->$field)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Calculate age from date of birth
     */
    public function getAgeAttribute() {
        if (!$this->date_of_birth) {
            return null;
        }
        return $this->date_of_birth->age;
    }

    /**
     * Get full address as string
     */
    public function getFullAddressAttribute() {
        $parts = array_filter([
            $this->residential_address,
            $this->city,
            $this->state_province,
            $this->postal_code,
            $this->country
        ]);

        return implode(', ', $parts);
    }

    /**
     * Check if user is eligible for loans
     */
    public function isLoanEligible() {
        return $this->loan_eligible &&
               $this->kyc_status === 'approved' &&
               $this->isProfileComplete() &&
               !$this->needsInfoUpdate();
    }

    /**
     * Get debt-to-income ratio
     */
    public function getDebtToIncomeRatio() {
        if (!$this->monthly_income || $this->monthly_income <= 0) {
            return null;
        }

        $totalDebt = ($this->existing_debt ?? 0) + ($this->monthly_expenses ?? 0);
        return ($totalDebt / $this->monthly_income) * 100;
    }

    /**
     * Get available loan amount based on income and existing debt
     */
    public function getAvailableLoanAmount() {
        if (!$this->isLoanEligible() || !$this->monthly_income) {
            return 0;
        }

        $debtRatio = $this->getDebtToIncomeRatio();
        if ($debtRatio > 40) { // 40% debt-to-income ratio limit
            return 0;
        }

        // Calculate based on 30% of monthly income for 12 months
        $maxAmount = ($this->monthly_income * 0.3) * 12;

        return min($maxAmount, $this->max_loan_amount ?? $maxAmount);
    }

    /**
     * Update risk assessment
     */
    public function updateRiskAssessment() {
        $score = $this->calculateRiskScore();

        $this->risk_score = $score;
        $this->risk_assessment_date = now();

        if ($score <= 25) {
            $this->risk_category = 'low';
        } elseif ($score <= 50) {
            $this->risk_category = 'medium';
        } elseif ($score <= 75) {
            $this->risk_category = 'high';
        } else {
            $this->risk_category = 'very_high';
        }

        $this->save();
    }

    /**
     * Calculate risk score based on various factors
     */
    private function calculateRiskScore() {
        $score = 0;

        // Age factor (younger = higher risk)
        if ($this->age) {
            if ($this->age < 25) $score += 20;
            elseif ($this->age < 35) $score += 10;
            elseif ($this->age > 65) $score += 15;
        }

        // Employment status
        switch ($this->employment_status) {
            case 'unemployed':
                $score += 40;
                break;
            case 'self_employed':
                $score += 20;
                break;
            case 'student':
                $score += 30;
                break;
            case 'employed':
                $score += 5;
                break;
        }

        // Debt-to-income ratio
        $debtRatio = $this->getDebtToIncomeRatio();
        if ($debtRatio) {
            if ($debtRatio > 50) $score += 30;
            elseif ($debtRatio > 40) $score += 20;
            elseif ($debtRatio > 30) $score += 10;
        }

        // Credit history
        switch ($this->credit_history) {
            case 'poor':
                $score += 35;
                break;
            case 'fair':
                $score += 20;
                break;
            case 'good':
                $score += 10;
                break;
            case 'excellent':
                $score += 0;
                break;
            case 'no_history':
                $score += 25;
                break;
        }

        // Previous loans
        if ($this->has_previous_loans) {
            $score += 10;
        }

        return min(100, $score); // Cap at 100
    }

    // Financial Assessment Methods

    /**
     * Get total monthly debt obligations
     */
    public function getTotalMonthlyDebtPayments() {
        $total = $this->total_monthly_debt_payments ?? 0;

        // Add credit card minimum payments (assume 3% of used credit)
        if ($this->total_credit_used) {
            $total += ($this->total_credit_used * 0.03);
        }

        return $total;
    }

    /**
     * Calculate debt-to-income ratio including all debts
     */
    public function getComprehensiveDebtToIncomeRatio() {
        if (!$this->monthly_income || $this->monthly_income <= 0) {
            return null;
        }

        $totalDebt = $this->getTotalMonthlyDebtPayments() + ($this->monthly_expenses ?? 0);
        return ($totalDebt / $this->monthly_income) * 100;
    }

    /**
     * Calculate credit utilization ratio
     */
    public function getCreditUtilizationRatio() {
        if (!$this->total_credit_limit || $this->total_credit_limit <= 0) {
            return 0;
        }

        return (($this->total_credit_used ?? 0) / $this->total_credit_limit) * 100;
    }

    /**
     * Calculate financial health score
     */
    public function calculateFinancialHealthScore() {
        $score = 100; // Start with perfect score

        // Debt-to-income ratio (30% weight)
        $debtRatio = $this->getComprehensiveDebtToIncomeRatio();
        if ($debtRatio) {
            if ($debtRatio > 50) $score -= 30;
            elseif ($debtRatio > 40) $score -= 20;
            elseif ($debtRatio > 30) $score -= 10;
            elseif ($debtRatio > 20) $score -= 5;
        }

        // Credit utilization (20% weight)
        $creditUtil = $this->getCreditUtilizationRatio();
        if ($creditUtil > 80) $score -= 20;
        elseif ($creditUtil > 60) $score -= 15;
        elseif ($creditUtil > 40) $score -= 10;
        elseif ($creditUtil > 30) $score -= 5;

        // Savings behavior (20% weight)
        if (!$this->has_savings_account) $score -= 15;
        elseif (!$this->total_savings_amount || $this->total_savings_amount <= 0) $score -= 10;
        elseif ($this->emergency_fund_months && $this->emergency_fund_months < 3) $score -= 5;

        // Employment stability (15% weight)
        if ($this->employment_status === 'unemployed') $score -= 15;
        elseif ($this->employment_status === 'self_employed') $score -= 8;
        elseif ($this->employment_status === 'student') $score -= 10;

        // Investment behavior (10% weight)
        if ($this->has_investments && $this->total_investment_value > 0) $score += 5;

        // Bank account verification (5% weight)
        if (!$this->primary_bank_verified) $score -= 5;

        return max(0, min(100, $score));
    }

    /**
     * Update financial health assessment
     */
    public function updateFinancialHealthScore() {
        $this->financial_health_score = $this->calculateFinancialHealthScore();
        $this->financial_assessment_date = now();
        $this->save();
    }

    /**
     * Get recommended loan amount based on financial health
     */
    public function getRecommendedLoanAmount() {
        $baseAmount = $this->getAvailableLoanAmount();
        $healthScore = $this->financial_health_score ?? $this->calculateFinancialHealthScore();

        // Adjust based on financial health score
        $multiplier = 1.0;
        if ($healthScore >= 80) $multiplier = 1.2;
        elseif ($healthScore >= 60) $multiplier = 1.0;
        elseif ($healthScore >= 40) $multiplier = 0.8;
        elseif ($healthScore >= 20) $multiplier = 0.6;
        else $multiplier = 0.4;

        return $baseAmount * $multiplier;
    }

    /**
     * Check if user has sufficient banking information
     */
    public function hasSufficientBankingInfo() {
        return $this->primary_bank_name &&
               $this->primary_account_number &&
               $this->primary_bank_verified;
    }

    /**
     * Get preferred disbursement account
     */
    public function getPreferredDisbursementAccount() {
        if ($this->preferred_disbursement_account && $this->secondary_bank_name) {
            return [
                'type' => 'bank',
                'bank_name' => $this->secondary_bank_name,
                'account_number' => $this->secondary_account_number,
                'account_name' => $this->secondary_account_name,
                'verified' => $this->secondary_bank_verified
            ];
        }

        if ($this->mobile_money_provider && $this->mobile_money_number) {
            return [
                'type' => 'mobile_money',
                'provider' => $this->mobile_money_provider,
                'number' => $this->mobile_money_number,
                'name' => $this->mobile_money_name,
                'verified' => $this->mobile_money_verified
            ];
        }

        return [
            'type' => 'bank',
            'bank_name' => $this->primary_bank_name,
            'account_number' => $this->primary_account_number,
            'account_name' => $this->primary_account_name,
            'verified' => $this->primary_bank_verified
        ];
    }

    /**
     * Get existing loans summary
     */
    public function getExistingLoansSummary() {
        $loans = $this->existing_loans ?? [];

        return [
            'count' => count($loans),
            'total_amount' => collect($loans)->sum('outstanding_amount'),
            'total_monthly_payment' => collect($loans)->sum('monthly_payment'),
            'types' => collect($loans)->pluck('type')->unique()->values()->toArray()
        ];
    }

    /**
     * Check if eligible for specific loan amount
     */
    public function isEligibleForAmount($amount) {
        if (!$this->isLoanEligible()) {
            return false;
        }

        $maxAmount = $this->getRecommendedLoanAmount();
        return $amount <= $maxAmount;
    }

    /**
     * Get financial profile completeness percentage
     */
    public function getFinancialProfileCompleteness() {
        $requiredFields = [
            'monthly_income', 'monthly_expenses', 'primary_bank_name',
            'primary_account_number', 'employment_status'
        ];

        $optionalFields = [
            'secondary_bank_name', 'mobile_money_provider', 'total_savings_amount',
            'existing_loans', 'credit_cards', 'loan_purpose'
        ];

        $requiredComplete = 0;
        foreach ($requiredFields as $field) {
            if (!empty($this->$field)) {
                $requiredComplete++;
            }
        }

        $optionalComplete = 0;
        foreach ($optionalFields as $field) {
            if (!empty($this->$field)) {
                $optionalComplete++;
            }
        }

        // Required fields are 70% of score, optional are 30%
        $requiredScore = ($requiredComplete / count($requiredFields)) * 70;
        $optionalScore = ($optionalComplete / count($optionalFields)) * 30;

        return round($requiredScore + $optionalScore);
    }

    // Detailed Expense Management Methods

    /**
     * Calculate total monthly expenses from detailed breakdown
     */
    public function calculateTotalExpenses() {
        $expenses = [
            $this->housing_expenses ?? 0,
            $this->groceries_expenses ?? 0,
            $this->transport_expenses ?? 0,
            $this->education_expenses ?? 0,
            $this->medical_expenses ?? 0,
            $this->debt_repayment_expenses ?? 0,
            $this->miscellaneous_expenses ?? 0,
            $this->insurance_expenses ?? 0,
            $this->entertainment_expenses ?? 0,
            $this->savings_contributions ?? 0,
        ];

        return array_sum($expenses);
    }

    /**
     * Update calculated expense totals
     */
    public function updateExpenseCalculations() {
        $this->total_calculated_expenses = $this->calculateTotalExpenses();

        if ($this->monthly_income && $this->monthly_income > 0) {
            $this->expense_income_ratio = ($this->total_calculated_expenses / $this->monthly_income) * 100;
            $this->disposable_income = $this->monthly_income - $this->total_calculated_expenses;
        }

        $this->expense_assessment_date = now();
        $this->save();
    }

    /**
     * Get expense breakdown as array
     */
    public function getExpenseBreakdown() {
        return [
            'housing' => [
                'amount' => $this->housing_expenses ?? 0,
                'range' => $this->housing_range,
                'details' => $this->housing_details,
                'percentage' => $this->getExpensePercentage('housing_expenses')
            ],
            'groceries' => [
                'amount' => $this->groceries_expenses ?? 0,
                'range' => $this->groceries_range,
                'percentage' => $this->getExpensePercentage('groceries_expenses')
            ],
            'transport' => [
                'amount' => $this->transport_expenses ?? 0,
                'range' => $this->transport_range,
                'details' => $this->transport_details,
                'percentage' => $this->getExpensePercentage('transport_expenses')
            ],
            'education' => [
                'amount' => $this->education_expenses ?? 0,
                'range' => $this->education_range,
                'children' => $this->number_of_children,
                'details' => $this->education_details,
                'percentage' => $this->getExpensePercentage('education_expenses')
            ],
            'medical' => [
                'amount' => $this->medical_expenses ?? 0,
                'range' => $this->medical_range,
                'has_medical_aid' => $this->has_medical_aid,
                'details' => $this->medical_details,
                'percentage' => $this->getExpensePercentage('medical_expenses')
            ],
            'debt_repayment' => [
                'amount' => $this->debt_repayment_expenses ?? 0,
                'range' => $this->debt_repayment_range,
                'percentage' => $this->getExpensePercentage('debt_repayment_expenses')
            ],
            'miscellaneous' => [
                'amount' => $this->miscellaneous_expenses ?? 0,
                'range' => $this->miscellaneous_range,
                'details' => $this->miscellaneous_details,
                'percentage' => $this->getExpensePercentage('miscellaneous_expenses')
            ],
            'insurance' => [
                'amount' => $this->insurance_expenses ?? 0,
                'range' => $this->insurance_range,
                'details' => $this->insurance_details,
                'percentage' => $this->getExpensePercentage('insurance_expenses')
            ],
            'entertainment' => [
                'amount' => $this->entertainment_expenses ?? 0,
                'range' => $this->entertainment_range,
                'percentage' => $this->getExpensePercentage('entertainment_expenses')
            ],
            'savings' => [
                'amount' => $this->savings_contributions ?? 0,
                'range' => $this->savings_range,
                'percentage' => $this->getExpensePercentage('savings_contributions')
            ]
        ];
    }

    /**
     * Get expense percentage of total income
     */
    private function getExpensePercentage($expenseField) {
        if (!$this->monthly_income || $this->monthly_income <= 0) {
            return 0;
        }

        $amount = $this->$expenseField ?? 0;
        return round(($amount / $this->monthly_income) * 100, 2);
    }

    /**
     * Get expense category recommendations
     */
    public function getExpenseRecommendations() {
        $recommendations = [];
        $breakdown = $this->getExpenseBreakdown();

        // Housing should be max 30% of income
        if ($breakdown['housing']['percentage'] > 30) {
            $recommendations[] = [
                'category' => 'housing',
                'type' => 'warning',
                'message' => 'Housing expenses exceed recommended 30% of income',
                'current' => $breakdown['housing']['percentage'] . '%',
                'recommended' => '≤30%'
            ];
        }

        // Transport should be max 15% of income
        if ($breakdown['transport']['percentage'] > 15) {
            $recommendations[] = [
                'category' => 'transport',
                'type' => 'warning',
                'message' => 'Transport expenses exceed recommended 15% of income',
                'current' => $breakdown['transport']['percentage'] . '%',
                'recommended' => '≤15%'
            ];
        }

        // Debt repayment should be max 20% of income
        if ($breakdown['debt_repayment']['percentage'] > 20) {
            $recommendations[] = [
                'category' => 'debt_repayment',
                'type' => 'critical',
                'message' => 'Debt repayments exceed recommended 20% of income',
                'current' => $breakdown['debt_repayment']['percentage'] . '%',
                'recommended' => '≤20%'
            ];
        }

        // Savings should be at least 10% of income
        if ($breakdown['savings']['percentage'] < 10) {
            $recommendations[] = [
                'category' => 'savings',
                'type' => 'info',
                'message' => 'Consider increasing savings to at least 10% of income',
                'current' => $breakdown['savings']['percentage'] . '%',
                'recommended' => '≥10%'
            ];
        }

        // Total expenses should not exceed 90% of income
        if ($this->expense_income_ratio > 90) {
            $recommendations[] = [
                'category' => 'total',
                'type' => 'critical',
                'message' => 'Total expenses exceed 90% of income - high financial risk',
                'current' => round($this->expense_income_ratio, 2) . '%',
                'recommended' => '≤90%'
            ];
        }

        return $recommendations;
    }

    /**
     * Get expense range midpoint for calculations
     */
    public static function getExpenseRangeMidpoint($range) {
        $ranges = [
            '0-1000' => 500,
            '0-1500' => 750,
            '0-2000' => 1000,
            '0-2500' => 1250,
            '0-3000' => 1500,
            '0-5000' => 2500,
            '1001-2000' => 1500,
            '1001-2500' => 1750,
            '1001-3000' => 2000,
            '1501-3000' => 2250,
            '2001-4000' => 3000,
            '2001-5000' => 3500,
            '2501-5000' => 3750,
            '2501-7000' => 4750,
            '3001-6000' => 4500,
            '3001-7500' => 5250,
            '5001-9500' => 7250,
            '5001-8000' => 6500,
            '5001-10000' => 7500,
            '6001-10000' => 8000,
            '7001-15000' => 11000,
            '7501-14500' => 11000,
            '9501-15000' => 12250,
            '10001-15000' => 12500,
            '10001-25000' => 17500,
            '10001+' => 15000,
            '14501-20000' => 17250,
            '15001-20000' => 17500,
            '15001-25000' => 20000,
            '15001+' => 20000,
            '20001+' => 25000,
            '25001+' => 30000,
        ];

        return $ranges[$range] ?? 0;
    }

    /**
     * Validate expense ranges against actual amounts
     */
    public function validateExpenseRanges() {
        $validations = [];

        $expenseFields = [
            'housing' => ['amount' => 'housing_expenses', 'range' => 'housing_range'],
            'groceries' => ['amount' => 'groceries_expenses', 'range' => 'groceries_range'],
            'transport' => ['amount' => 'transport_expenses', 'range' => 'transport_range'],
            'education' => ['amount' => 'education_expenses', 'range' => 'education_range'],
            'medical' => ['amount' => 'medical_expenses', 'range' => 'medical_range'],
            'debt_repayment' => ['amount' => 'debt_repayment_expenses', 'range' => 'debt_repayment_range'],
            'miscellaneous' => ['amount' => 'miscellaneous_expenses', 'range' => 'miscellaneous_range'],
            'insurance' => ['amount' => 'insurance_expenses', 'range' => 'insurance_range'],
            'entertainment' => ['amount' => 'entertainment_expenses', 'range' => 'entertainment_range'],
            'savings' => ['amount' => 'savings_contributions', 'range' => 'savings_range'],
        ];

        foreach ($expenseFields as $category => $fields) {
            $amount = $this->{$fields['amount']} ?? 0;
            $range = $this->{$fields['range']};

            if ($amount > 0 && $range) {
                $isValid = $this->isAmountInRange($amount, $range);
                $validations[$category] = [
                    'amount' => $amount,
                    'range' => $range,
                    'valid' => $isValid,
                    'message' => $isValid ? 'Amount matches selected range' : 'Amount does not match selected range'
                ];
            }
        }

        return $validations;
    }

    /**
     * Check if amount falls within specified range
     */
    private function isAmountInRange($amount, $range) {
        $rangeParts = explode('-', str_replace('+', '', $range));

        if (count($rangeParts) === 1) {
            // Handle ranges like "20001+"
            return $amount >= intval($rangeParts[0]);
        }

        $min = intval($rangeParts[0]);
        $max = intval($rangeParts[1]);

        return $amount >= $min && $amount <= $max;
    }
}
