<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDocumentManagementToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Document Upload Fields
            $table->json('identity_documents')->nullable()->after('verification_documents');
            $table->json('address_proof_documents')->nullable()->after('identity_documents');
            $table->json('income_proof_documents')->nullable()->after('address_proof_documents');
            $table->json('collateral_documents')->nullable()->after('income_proof_documents');
            $table->json('payslip_documents')->nullable()->after('collateral_documents');
            $table->json('headshot_documents')->nullable()->after('payslip_documents');

            // Document Status Tracking
            $table->enum('identity_document_status', ['pending', 'uploaded', 'verified', 'rejected'])->default('pending')->after('headshot_documents');
            $table->enum('address_proof_status', ['pending', 'uploaded', 'verified', 'rejected'])->default('pending')->after('identity_document_status');
            $table->enum('income_proof_status', ['pending', 'uploaded', 'verified', 'rejected'])->default('pending')->after('address_proof_status');
            $table->enum('collateral_document_status', ['pending', 'uploaded', 'verified', 'rejected'])->default('pending')->after('income_proof_status');
            $table->enum('payslip_status', ['pending', 'uploaded', 'verified', 'rejected'])->default('pending')->after('collateral_document_status');
            $table->enum('headshot_status', ['pending', 'uploaded', 'verified', 'rejected'])->default('pending')->after('payslip_status');

            // Document Verification Dates
            $table->timestamp('identity_document_verified_at')->nullable()->after('headshot_status');
            $table->timestamp('address_proof_verified_at')->nullable()->after('identity_document_verified_at');
            $table->timestamp('income_proof_verified_at')->nullable()->after('address_proof_verified_at');
            $table->timestamp('collateral_document_verified_at')->nullable()->after('income_proof_verified_at');
            $table->timestamp('payslip_verified_at')->nullable()->after('collateral_document_verified_at');
            $table->timestamp('headshot_verified_at')->nullable()->after('payslip_verified_at');

            // Document Rejection Reasons
            $table->text('identity_document_rejection_reason')->nullable()->after('headshot_verified_at');
            $table->text('address_proof_rejection_reason')->nullable()->after('identity_document_rejection_reason');
            $table->text('income_proof_rejection_reason')->nullable()->after('address_proof_rejection_reason');
            $table->text('collateral_document_rejection_reason')->nullable()->after('income_proof_rejection_reason');
            $table->text('payslip_rejection_reason')->nullable()->after('collateral_document_rejection_reason');
            $table->text('headshot_rejection_reason')->nullable()->after('payslip_rejection_reason');

            // Consent and Declarations
            $table->boolean('credit_check_consent')->default(false)->after('headshot_rejection_reason');
            $table->timestamp('credit_check_consent_at')->nullable()->after('credit_check_consent');
            $table->string('credit_check_consent_ip')->nullable()->after('credit_check_consent_at');

            $table->boolean('data_processing_consent')->default(false)->after('credit_check_consent_ip');
            $table->timestamp('data_processing_consent_at')->nullable()->after('data_processing_consent');
            $table->string('data_processing_consent_ip')->nullable()->after('data_processing_consent_at');

            $table->boolean('marketing_consent')->default(false)->after('data_processing_consent_ip');
            $table->timestamp('marketing_consent_at')->nullable()->after('marketing_consent');
            $table->string('marketing_consent_ip')->nullable()->after('marketing_consent_at');

            $table->boolean('loan_terms_consent')->default(false)->after('marketing_consent_ip');
            $table->timestamp('loan_terms_consent_at')->nullable()->after('loan_terms_consent');
            $table->string('loan_terms_consent_ip')->nullable()->after('loan_terms_consent_at');

            // Digital Signature
            $table->text('digital_signature')->nullable()->after('loan_terms_consent_ip');
            $table->timestamp('digital_signature_at')->nullable()->after('digital_signature');
            $table->string('digital_signature_ip')->nullable()->after('digital_signature_at');
            $table->enum('signature_type', ['digital', 'physical', 'electronic'])->nullable()->after('digital_signature_ip');

            // Document Completeness
            $table->decimal('document_completeness_score', 5, 2)->nullable()->after('signature_type');
            $table->boolean('all_documents_uploaded')->default(false)->after('document_completeness_score');
            $table->boolean('all_documents_verified')->default(false)->after('all_documents_uploaded');
            $table->timestamp('documents_completed_at')->nullable()->after('all_documents_verified');

            // KYC Status
            $table->enum('overall_kyc_status', ['incomplete', 'pending_review', 'approved', 'rejected', 'requires_update'])->default('incomplete')->after('documents_completed_at');
            $table->text('kyc_rejection_reason')->nullable()->after('overall_kyc_status');
            $table->integer('kyc_review_attempts')->default(0)->after('kyc_rejection_reason');

            // Document Security
            $table->json('document_encryption_keys')->nullable()->after('kyc_review_attempts');
            $table->boolean('documents_encrypted')->default(false)->after('document_encryption_keys');
            $table->timestamp('last_document_access')->nullable()->after('documents_encrypted');
            $table->json('document_access_log')->nullable()->after('last_document_access');

            // Compliance
            $table->boolean('aml_check_passed')->default(false)->after('document_access_log');
            $table->timestamp('aml_check_date')->nullable()->after('aml_check_passed');
            $table->boolean('sanctions_check_passed')->default(false)->after('aml_check_date');
            $table->timestamp('sanctions_check_date')->nullable()->after('sanctions_check_passed');
            $table->json('compliance_notes')->nullable()->after('sanctions_check_date');
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
                // Document Upload Fields
                'identity_documents', 'address_proof_documents', 'income_proof_documents',
                'collateral_documents', 'payslip_documents', 'headshot_documents',
                // Document Status
                'identity_document_status', 'address_proof_status', 'income_proof_status',
                'collateral_document_status', 'payslip_status', 'headshot_status',
                // Verification Dates
                'identity_document_verified_at', 'address_proof_verified_at', 'income_proof_verified_at',
                'collateral_document_verified_at', 'payslip_verified_at', 'headshot_verified_at',
                // Rejection Reasons
                'identity_document_rejection_reason', 'address_proof_rejection_reason', 'income_proof_rejection_reason',
                'collateral_document_rejection_reason', 'payslip_rejection_reason', 'headshot_rejection_reason',
                // Consent and Declarations
                'credit_check_consent', 'credit_check_consent_at', 'credit_check_consent_ip',
                'data_processing_consent', 'data_processing_consent_at', 'data_processing_consent_ip',
                'marketing_consent', 'marketing_consent_at', 'marketing_consent_ip',
                'loan_terms_consent', 'loan_terms_consent_at', 'loan_terms_consent_ip',
                // Digital Signature
                'digital_signature', 'digital_signature_at', 'digital_signature_ip', 'signature_type',
                // Document Completeness
                'document_completeness_score', 'all_documents_uploaded', 'all_documents_verified', 'documents_completed_at',
                // KYC Status
                'overall_kyc_status', 'kyc_rejection_reason', 'kyc_review_attempts',
                // Document Security
                'document_encryption_keys', 'documents_encrypted', 'last_document_access', 'document_access_log',
                // Compliance
                'aml_check_passed', 'aml_check_date', 'sanctions_check_passed', 'sanctions_check_date', 'compliance_notes'
            ]);
        });
    }
}
