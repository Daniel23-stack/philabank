<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFinancialDetailsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Primary Bank Account (Salary Account)
            $table->string('primary_bank_name', 255)->nullable()->after('bank_account_number');
            $table->string('primary_bank_branch', 255)->nullable()->after('primary_bank_name');
            $table->string('primary_account_number', 50)->nullable()->after('primary_bank_branch');
            $table->string('primary_account_name', 255)->nullable()->after('primary_account_number');
            $table->enum('primary_account_type', ['savings', 'checking', 'current'])->nullable()->after('primary_account_name');
            $table->string('primary_bank_code', 20)->nullable()->after('primary_account_type');
            $table->string('primary_swift_code', 20)->nullable()->after('primary_bank_code');
            $table->boolean('salary_deposited_here')->default(true)->after('primary_swift_code');
            $table->decimal('average_monthly_balance', 15, 2)->nullable()->after('salary_deposited_here');
            
            // Secondary Bank Account (Loan Disbursement)
            $table->string('secondary_bank_name', 255)->nullable()->after('average_monthly_balance');
            $table->string('secondary_bank_branch', 255)->nullable()->after('secondary_bank_name');
            $table->string('secondary_account_number', 50)->nullable()->after('secondary_bank_branch');
            $table->string('secondary_account_name', 255)->nullable()->after('secondary_account_number');
            $table->enum('secondary_account_type', ['savings', 'checking', 'current'])->nullable()->after('secondary_account_name');
            $table->string('secondary_bank_code', 20)->nullable()->after('secondary_account_type');
            $table->string('secondary_swift_code', 20)->nullable()->after('secondary_bank_code');
            $table->boolean('preferred_disbursement_account')->default(false)->after('secondary_swift_code');
            
            // Mobile Money/Digital Wallet (Alternative)
            $table->string('mobile_money_provider', 100)->nullable()->after('preferred_disbursement_account');
            $table->string('mobile_money_number', 30)->nullable()->after('mobile_money_provider');
            $table->string('mobile_money_name', 255)->nullable()->after('mobile_money_number');
            $table->boolean('mobile_money_verified')->default(false)->after('mobile_money_name');
            
            // Existing Debts and Loans
            $table->json('existing_loans')->nullable()->after('mobile_money_verified');
            $table->decimal('total_existing_debt_amount', 15, 2)->nullable()->after('existing_loans');
            $table->decimal('total_monthly_debt_payments', 15, 2)->nullable()->after('total_existing_debt_amount');
            
            // Credit Cards
            $table->boolean('has_credit_cards')->default(false)->after('total_monthly_debt_payments');
            $table->json('credit_cards')->nullable()->after('has_credit_cards');
            $table->decimal('total_credit_limit', 15, 2)->nullable()->after('credit_cards');
            $table->decimal('total_credit_used', 15, 2)->nullable()->after('total_credit_limit');
            
            // Other Financial Information
            $table->boolean('has_savings_account')->default(false)->after('total_credit_used');
            $table->decimal('total_savings_amount', 15, 2)->nullable()->after('has_savings_account');
            $table->boolean('has_investments')->default(false)->after('total_savings_amount');
            $table->decimal('total_investment_value', 15, 2)->nullable()->after('has_investments');
            $table->json('investment_types')->nullable()->after('total_investment_value');
            
            // Financial Behavior
            $table->enum('spending_pattern', ['conservative', 'moderate', 'aggressive'])->nullable()->after('investment_types');
            $table->enum('savings_frequency', ['weekly', 'monthly', 'quarterly', 'annually', 'irregular', 'none'])->nullable()->after('spending_pattern');
            $table->decimal('monthly_savings_target', 15, 2)->nullable()->after('savings_frequency');
            $table->decimal('emergency_fund_months', 3, 1)->nullable()->after('monthly_savings_target');
            
            // Financial Goals
            $table->json('financial_goals')->nullable()->after('emergency_fund_months');
            $table->enum('loan_purpose', [
                'business_expansion', 'education', 'medical', 'home_improvement', 
                'debt_consolidation', 'emergency', 'agriculture', 'equipment_purchase',
                'working_capital', 'personal', 'other'
            ])->nullable()->after('financial_goals');
            $table->text('loan_purpose_description')->nullable()->after('loan_purpose');
            
            // Bank Verification
            $table->boolean('primary_bank_verified')->default(false)->after('loan_purpose_description');
            $table->boolean('secondary_bank_verified')->default(false)->after('primary_bank_verified');
            $table->timestamp('primary_bank_verified_at')->nullable()->after('secondary_bank_verified');
            $table->timestamp('secondary_bank_verified_at')->nullable()->after('primary_bank_verified_at');
            
            // Financial Documents
            $table->json('bank_statements')->nullable()->after('secondary_bank_verified_at');
            $table->json('salary_slips')->nullable()->after('bank_statements');
            $table->json('tax_documents')->nullable()->after('salary_slips');
            $table->json('financial_documents')->nullable()->after('tax_documents');
            
            // Financial Health Score
            $table->decimal('financial_health_score', 5, 2)->nullable()->after('financial_documents');
            $table->timestamp('financial_assessment_date')->nullable()->after('financial_health_score');
            $table->text('financial_assessment_notes')->nullable()->after('financial_assessment_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                // Primary Bank
                'primary_bank_name', 'primary_bank_branch', 'primary_account_number', 'primary_account_name',
                'primary_account_type', 'primary_bank_code', 'primary_swift_code', 'salary_deposited_here',
                'average_monthly_balance',
                // Secondary Bank
                'secondary_bank_name', 'secondary_bank_branch', 'secondary_account_number', 'secondary_account_name',
                'secondary_account_type', 'secondary_bank_code', 'secondary_swift_code', 'preferred_disbursement_account',
                // Mobile Money
                'mobile_money_provider', 'mobile_money_number', 'mobile_money_name', 'mobile_money_verified',
                // Existing Debts
                'existing_loans', 'total_existing_debt_amount', 'total_monthly_debt_payments',
                // Credit Cards
                'has_credit_cards', 'credit_cards', 'total_credit_limit', 'total_credit_used',
                // Other Financial
                'has_savings_account', 'total_savings_amount', 'has_investments', 'total_investment_value', 'investment_types',
                // Financial Behavior
                'spending_pattern', 'savings_frequency', 'monthly_savings_target', 'emergency_fund_months',
                // Financial Goals
                'financial_goals', 'loan_purpose', 'loan_purpose_description',
                // Verification
                'primary_bank_verified', 'secondary_bank_verified', 'primary_bank_verified_at', 'secondary_bank_verified_at',
                // Documents
                'bank_statements', 'salary_slips', 'tax_documents', 'financial_documents',
                // Assessment
                'financial_health_score', 'financial_assessment_date', 'financial_assessment_notes'
            ]);
        });
    }
}
