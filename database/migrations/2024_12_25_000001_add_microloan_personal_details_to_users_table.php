<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMicroloanPersonalDetailsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Personal Details for Microloan System
            $table->string('identity_number', 50)->nullable()->after('name');
            $table->string('passport_number', 50)->nullable()->after('identity_number');
            $table->enum('identity_type', ['national_id', 'passport', 'drivers_license'])->default('national_id')->after('passport_number');
            $table->date('date_of_birth')->nullable()->after('identity_type');
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('date_of_birth');
            $table->string('nationality', 100)->nullable()->after('gender');
            
            // Residential Address
            $table->text('residential_address')->nullable()->after('nationality');
            $table->string('city', 100)->nullable()->after('residential_address');
            $table->string('state_province', 100)->nullable()->after('city');
            $table->string('postal_code', 20)->nullable()->after('state_province');
            $table->string('country', 100)->nullable()->after('postal_code');
            
            // Additional Contact Details
            $table->string('alternative_phone', 30)->nullable()->after('phone');
            $table->string('emergency_contact_name', 255)->nullable()->after('alternative_phone');
            $table->string('emergency_contact_phone', 30)->nullable()->after('emergency_contact_name');
            $table->string('emergency_contact_relationship', 100)->nullable()->after('emergency_contact_phone');
            
            // Employment Information
            $table->enum('employment_status', ['employed', 'self_employed', 'unemployed', 'student', 'retired'])->nullable()->after('emergency_contact_relationship');
            $table->string('employer_name', 255)->nullable()->after('employment_status');
            $table->text('employer_address')->nullable()->after('employer_name');
            $table->string('job_title', 255)->nullable()->after('employer_address');
            $table->decimal('monthly_income', 15, 2)->nullable()->after('job_title');
            $table->date('employment_start_date')->nullable()->after('monthly_income');
            
            // Financial Information
            $table->decimal('monthly_expenses', 15, 2)->nullable()->after('employment_start_date');
            $table->decimal('existing_debt', 15, 2)->nullable()->after('monthly_expenses');
            $table->enum('bank_account_type', ['savings', 'checking', 'both', 'none'])->nullable()->after('existing_debt');
            $table->string('bank_name', 255)->nullable()->after('bank_account_type');
            $table->string('bank_account_number', 50)->nullable()->after('bank_name');
            
            // Credit Information
            $table->integer('credit_score')->nullable()->after('bank_account_number');
            $table->enum('credit_history', ['excellent', 'good', 'fair', 'poor', 'no_history'])->nullable()->after('credit_score');
            $table->boolean('has_previous_loans')->default(false)->after('credit_history');
            $table->text('previous_loan_details')->nullable()->after('has_previous_loans');
            
            // KYC and Compliance
            $table->enum('kyc_status', ['pending', 'in_progress', 'approved', 'rejected'])->default('pending')->after('previous_loan_details');
            $table->timestamp('kyc_completed_at')->nullable()->after('kyc_status');
            $table->timestamp('last_info_update')->nullable()->after('kyc_completed_at');
            $table->timestamp('next_required_update')->nullable()->after('last_info_update');
            $table->boolean('info_update_required')->default(false)->after('next_required_update');
            
            // Risk Assessment
            $table->enum('risk_category', ['low', 'medium', 'high', 'very_high'])->nullable()->after('info_update_required');
            $table->decimal('risk_score', 5, 2)->nullable()->after('risk_category');
            $table->timestamp('risk_assessment_date')->nullable()->after('risk_score');
            
            // Loan Eligibility
            $table->boolean('loan_eligible')->default(false)->after('risk_assessment_date');
            $table->decimal('max_loan_amount', 15, 2)->nullable()->after('loan_eligible');
            $table->text('eligibility_notes')->nullable()->after('max_loan_amount');
            
            // Additional Verification
            $table->boolean('address_verified')->default(false)->after('eligibility_notes');
            $table->boolean('employment_verified')->default(false)->after('address_verified');
            $table->boolean('income_verified')->default(false)->after('employment_verified');
            $table->timestamp('address_verified_at')->nullable()->after('address_verified');
            $table->timestamp('employment_verified_at')->nullable()->after('employment_verified');
            $table->timestamp('income_verified_at')->nullable()->after('income_verified');
            
            // System Tracking
            $table->json('verification_documents')->nullable()->after('income_verified_at');
            $table->text('admin_notes')->nullable()->after('verification_documents');
            $table->timestamp('profile_completed_at')->nullable()->after('admin_notes');
            $table->boolean('terms_accepted')->default(false)->after('profile_completed_at');
            $table->timestamp('terms_accepted_at')->nullable()->after('terms_accepted');
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
                'identity_number', 'passport_number', 'identity_type', 'date_of_birth', 'gender', 'nationality',
                'residential_address', 'city', 'state_province', 'postal_code', 'country',
                'alternative_phone', 'emergency_contact_name', 'emergency_contact_phone', 'emergency_contact_relationship',
                'employment_status', 'employer_name', 'employer_address', 'job_title', 'monthly_income', 'employment_start_date',
                'monthly_expenses', 'existing_debt', 'bank_account_type', 'bank_name', 'bank_account_number',
                'credit_score', 'credit_history', 'has_previous_loans', 'previous_loan_details',
                'kyc_status', 'kyc_completed_at', 'last_info_update', 'next_required_update', 'info_update_required',
                'risk_category', 'risk_score', 'risk_assessment_date',
                'loan_eligible', 'max_loan_amount', 'eligibility_notes',
                'address_verified', 'employment_verified', 'income_verified',
                'address_verified_at', 'employment_verified_at', 'income_verified_at',
                'verification_documents', 'admin_notes', 'profile_completed_at',
                'terms_accepted', 'terms_accepted_at'
            ]);
        });
    }
}
