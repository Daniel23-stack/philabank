<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeder.
     *
     * @return void
     */
    public function run()
    {
        // Create a comprehensive test user
        $user = User::create([
            // Basic Information
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'phone' => '+27123456789',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),

            // Personal Details
            'identity_type' => 'national_id',
            'identity_number' => '8001015009087',
            'date_of_birth' => '1980-01-01',
            'gender' => 'male',
            'nationality' => 'south_african',

            // Address Information
            'residential_address' => '123 Main Street',
            'city' => 'Cape Town',
            'state_province' => 'Western Cape',
            'postal_code' => '8001',
            'country' => 'South Africa',

            // Emergency Contact
            'emergency_contact_name' => 'Jane Doe',
            'emergency_contact_phone' => '+27987654321',
            'emergency_contact_relationship' => 'spouse',

            // Employment Information
            'employment_status' => 'employed',
            'employer_name' => 'ABC Corporation',
            'job_title' => 'Software Developer',
            'employment_start_date' => '2019-01-01',
            'monthly_income' => 45000.00,

            // Detailed Monthly Expenses
            'housing_expenses' => 12000.00,
            'housing_range' => '9501-15000',
            'housing_details' => 'Rent and utilities',
            'groceries_expenses' => 8000.00,
            'groceries_range' => '6001-10000',
            'transport_expenses' => 10000.00,
            'transport_range' => '7501-14500',
            'transport_details' => 'Car payment, fuel, insurance',
            'education_expenses' => 5000.00,
            'education_range' => '2501-7000',
            'number_of_children' => 2,
            'education_details' => 'School fees for 2 children',
            'medical_expenses' => 4000.00,
            'medical_range' => '3001-5000',
            'has_medical_aid' => true,
            'medical_details' => 'Discovery Health Medical Scheme',
            'debt_repayment_expenses' => 3000.00,
            'debt_repayment_range' => '2001-5000',
            'miscellaneous_expenses' => 5000.00,
            'miscellaneous_range' => '4001-6000',
            'miscellaneous_details' => 'Clothing, entertainment, savings',
            'total_calculated_expenses' => 47000.00,
            'monthly_expenses' => 47000.00,
            'expense_income_ratio' => 104.44,
            'disposable_income' => -2000.00,

            // Primary Bank Account
            'primary_bank_name' => 'Standard Bank',
            'primary_bank_branch' => 'Cape Town Central',
            'primary_account_number' => '123456789',
            'primary_account_name' => 'John Doe',
            'primary_account_type' => 'savings',
            'primary_bank_code' => '051001',
            'salary_deposited_here' => true,
            'average_monthly_balance' => 15000.00,
            'primary_bank_verified' => true,
            'primary_bank_verified_at' => now(),

            // Secondary Bank Account
            'secondary_bank_name' => 'FNB',
            'secondary_bank_branch' => 'Claremont',
            'secondary_account_number' => '987654321',
            'secondary_account_name' => 'John Doe',
            'secondary_account_type' => 'checking',
            'secondary_bank_code' => '250655',
            'preferred_disbursement_account' => true,
            'secondary_bank_verified' => true,
            'secondary_bank_verified_at' => now(),

            // Mobile Money
            'mobile_money_provider' => 'mpesa',
            'mobile_money_number' => '+27123456789',
            'mobile_money_name' => 'John Doe',
            'mobile_money_verified' => true,

            // Existing Loans
            'existing_loans' => [
                [
                    'type' => 'car_loan',
                    'lender' => 'Wesbank',
                    'original_amount' => 250000.00,
                    'outstanding_amount' => 180000.00,
                    'monthly_payment' => 4500.00,
                    'interest_rate' => 12.5,
                    'end_date' => '2027-12-31'
                ],
                [
                    'type' => 'personal_loan',
                    'lender' => 'African Bank',
                    'original_amount' => 50000.00,
                    'outstanding_amount' => 25000.00,
                    'monthly_payment' => 1200.00,
                    'interest_rate' => 18.0,
                    'end_date' => '2025-06-30'
                ]
            ],
            'total_existing_debt_amount' => 205000.00,
            'total_monthly_debt_payments' => 5700.00,

            // Credit Cards
            'has_credit_cards' => true,
            'credit_cards' => [
                [
                    'provider' => 'Standard Bank',
                    'type' => 'Visa',
                    'limit' => 50000.00,
                    'used' => 15000.00
                ]
            ],
            'total_credit_limit' => 50000.00,
            'total_credit_used' => 15000.00,

            // Savings and Investments
            'has_savings_account' => true,
            'total_savings_amount' => 25000.00,
            'has_investments' => true,
            'total_investment_value' => 100000.00,
            'investment_types' => ['unit_trusts', 'retirement_annuity'],

            // Financial Behavior
            'spending_pattern' => 'moderate',
            'savings_frequency' => 'monthly',
            'monthly_savings_target' => 2000.00,
            'emergency_fund_months' => 3.0,

            // Loan Purpose
            'loan_purpose' => 'business_expansion',
            'loan_purpose_description' => 'Expanding my consulting business and purchasing equipment',

            // Document Status
            'identity_document_status' => 'verified',
            'address_proof_status' => 'verified',
            'income_proof_status' => 'verified',
            'payslip_status' => 'verified',
            'headshot_status' => 'verified',
            'collateral_document_status' => 'uploaded',

            // Document Verification Dates
            'identity_document_verified_at' => now()->subDays(2),
            'address_proof_verified_at' => now()->subDays(2),
            'income_proof_verified_at' => now()->subDays(1),
            'payslip_verified_at' => now()->subDays(1),
            'headshot_verified_at' => now()->subHours(12),

            // Consent and Declarations
            'credit_check_consent' => true,
            'credit_check_consent_at' => now()->subDays(3),
            'credit_check_consent_ip' => '127.0.0.1',
            'data_processing_consent' => true,
            'data_processing_consent_at' => now()->subDays(3),
            'data_processing_consent_ip' => '127.0.0.1',
            'marketing_consent' => true,
            'marketing_consent_at' => now()->subDays(3),
            'marketing_consent_ip' => '127.0.0.1',
            'loan_terms_consent' => true,
            'loan_terms_consent_at' => now()->subDays(3),
            'loan_terms_consent_ip' => '127.0.0.1',

            // Digital Signature
            'digital_signature' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPhfDwAChwGA60e6kgAAAABJRU5ErkJggg==',
            'digital_signature_at' => now()->subDays(3),
            'digital_signature_ip' => '127.0.0.1',
            'signature_type' => 'digital',

            // Document Completeness
            'document_completeness_score' => 95.0,
            'all_documents_uploaded' => true,
            'all_documents_verified' => true,
            'documents_completed_at' => now()->subDays(1),

            // KYC Status
            'kyc_status' => 'approved',
            'kyc_completed_at' => now()->subHours(6),

            // Financial Assessment
            'financial_health_score' => 72.5,
            'financial_assessment_date' => now()->subHours(4),
            'expense_accuracy' => 'tracked',
            'expenses_verified' => true,
            'expenses_verified_at' => now()->subHours(6),

            // System Fields
            'user_type' => 'customer',
            'terms_accepted' => true,
            'terms_accepted_at' => now()->subDays(3),
            'profile_completed_at' => now()->subHours(6),
            'status' => 1, // Active
            'loan_eligible' => true,
            'address_verified' => true,
            'employment_verified' => true,
            'income_verified' => true,
            'info_update_required' => false,
        ]);

        echo "✅ Test user created successfully!\n";
        echo "📧 Email: john.doe@example.com\n";
        echo "🔑 Password: password123\n";
        echo "💰 Financial Health Score: {$user->financial_health_score}%\n";
        echo "📊 KYC Status: {$user->kyc_status}\n";
        echo "🏦 Loan Eligible: " . ($user->loan_eligible ? 'Yes' : 'No') . "\n";
    }
}
