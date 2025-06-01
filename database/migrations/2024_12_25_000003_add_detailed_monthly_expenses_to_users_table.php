<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailedMonthlyExpensesToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Detailed Monthly Expenses Breakdown
            $table->decimal('housing_expenses', 10, 2)->nullable()->after('monthly_expenses');
            $table->enum('housing_range', [
                '0-5000', '5001-9500', '9501-15000', '15001-20000', '20001+'
            ])->nullable()->after('housing_expenses');
            $table->text('housing_details')->nullable()->after('housing_range');
            
            $table->decimal('groceries_expenses', 10, 2)->nullable()->after('housing_details');
            $table->enum('groceries_range', [
                '0-3000', '3001-6000', '6001-10000', '10001-15000', '15001+'
            ])->nullable()->after('groceries_expenses');
            
            $table->decimal('transport_expenses', 10, 2)->nullable()->after('groceries_range');
            $table->enum('transport_range', [
                '0-3000', '3001-7500', '7501-14500', '14501-20000', '20001+'
            ])->nullable()->after('transport_expenses');
            $table->text('transport_details')->nullable()->after('transport_range');
            
            $table->decimal('education_expenses', 10, 2)->nullable()->after('transport_details');
            $table->enum('education_range', [
                '0-2500', '2501-7000', '7001-15000', '15001-25000', '25001+'
            ])->nullable()->after('education_expenses');
            $table->integer('number_of_children')->nullable()->after('education_range');
            $table->text('education_details')->nullable()->after('number_of_children');
            
            $table->decimal('medical_expenses', 10, 2)->nullable()->after('education_details');
            $table->enum('medical_range', [
                '0-1500', '1501-3000', '3001-5000', '5001-8000', '8001+'
            ])->nullable()->after('medical_expenses');
            $table->boolean('has_medical_aid')->default(false)->after('medical_range');
            $table->text('medical_details')->nullable()->after('has_medical_aid');
            
            $table->decimal('debt_repayment_expenses', 10, 2)->nullable()->after('medical_details');
            $table->enum('debt_repayment_range', [
                '0-1000', '1001-2000', '2001-5000', '5001-10000', '10001+'
            ])->nullable()->after('debt_repayment_expenses');
            
            $table->decimal('miscellaneous_expenses', 10, 2)->nullable()->after('debt_repayment_range');
            $table->enum('miscellaneous_range', [
                '0-2000', '2001-4000', '4001-6000', '6001-10000', '10001+'
            ])->nullable()->after('miscellaneous_expenses');
            $table->text('miscellaneous_details')->nullable()->after('miscellaneous_range');
            
            // Additional Expense Categories
            $table->decimal('insurance_expenses', 10, 2)->nullable()->after('miscellaneous_details');
            $table->enum('insurance_range', [
                '0-1000', '1001-2500', '2501-5000', '5001-8000', '8001+'
            ])->nullable()->after('insurance_expenses');
            $table->text('insurance_details')->nullable()->after('insurance_range');
            
            $table->decimal('entertainment_expenses', 10, 2)->nullable()->after('insurance_details');
            $table->enum('entertainment_range', [
                '0-1000', '1001-2500', '2501-5000', '5001-8000', '8001+'
            ])->nullable()->after('entertainment_expenses');
            
            $table->decimal('savings_contributions', 10, 2)->nullable()->after('entertainment_range');
            $table->enum('savings_range', [
                '0-1000', '1001-3000', '3001-6000', '6001-10000', '10001+'
            ])->nullable()->after('savings_contributions');
            
            // Expense Analysis
            $table->decimal('total_calculated_expenses', 10, 2)->nullable()->after('savings_range');
            $table->decimal('expense_income_ratio', 5, 2)->nullable()->after('total_calculated_expenses');
            $table->decimal('disposable_income', 10, 2)->nullable()->after('expense_income_ratio');
            $table->enum('expense_accuracy', ['estimated', 'tracked', 'verified'])->default('estimated')->after('disposable_income');
            
            // Expense Verification
            $table->boolean('expenses_verified')->default(false)->after('expense_accuracy');
            $table->timestamp('expenses_verified_at')->nullable()->after('expenses_verified');
            $table->json('expense_documents')->nullable()->after('expenses_verified_at');
            
            // Expense Patterns
            $table->enum('expense_pattern', ['consistent', 'seasonal', 'irregular'])->nullable()->after('expense_documents');
            $table->text('expense_notes')->nullable()->after('expense_pattern');
            $table->timestamp('expense_assessment_date')->nullable()->after('expense_notes');
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
                'housing_expenses', 'housing_range', 'housing_details',
                'groceries_expenses', 'groceries_range',
                'transport_expenses', 'transport_range', 'transport_details',
                'education_expenses', 'education_range', 'number_of_children', 'education_details',
                'medical_expenses', 'medical_range', 'has_medical_aid', 'medical_details',
                'debt_repayment_expenses', 'debt_repayment_range',
                'miscellaneous_expenses', 'miscellaneous_range', 'miscellaneous_details',
                'insurance_expenses', 'insurance_range', 'insurance_details',
                'entertainment_expenses', 'entertainment_range',
                'savings_contributions', 'savings_range',
                'total_calculated_expenses', 'expense_income_ratio', 'disposable_income', 'expense_accuracy',
                'expenses_verified', 'expenses_verified_at', 'expense_documents',
                'expense_pattern', 'expense_notes', 'expense_assessment_date'
            ]);
        });
    }
}
