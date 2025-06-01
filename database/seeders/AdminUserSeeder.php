<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Admin User
        $adminUser = User::updateOrCreate(
            ['email' => 'admin@philalink.com'],
            [
                'name' => 'PhilaLink Administrator',
                'email' => 'admin@philalink.com',
                'password' => Hash::make('admin123'),
                'user_type' => 'admin',
                'status' => 1,
                'email_verified_at' => Carbon::now(),
                'phone' => '+27123456789',
                'residential_address' => '123 Banking Street, Cape Town',
                'city' => 'Cape Town',
                'state_province' => 'Western Cape',
                'postal_code' => '8001',
                'country' => 'South Africa',
                'account_number' => 'ADM' . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT),
                'document_verified_at' => Carbon::now(),
                'kyc_status' => 'approved',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        // Create Customer Test User (Enhanced)
        $customerUser = User::updateOrCreate(
            ['email' => 'john.doe@example.com'],
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'password' => Hash::make('password123'),
                'user_type' => 'customer',
                'status' => 1,
                'email_verified_at' => Carbon::now(),
                'phone' => '+27987654321',
                'residential_address' => '456 Customer Avenue, Johannesburg',
                'city' => 'Johannesburg',
                'state_province' => 'Gauteng',
                'postal_code' => '2000',
                'country' => 'South Africa',
                'account_number' => 'ACC' . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT),
                'document_verified_at' => Carbon::now(),
                'kyc_status' => 'approved',
                'identity_document_status' => 'verified',
                'income_verified' => true,
                'loan_eligible' => true,
                'monthly_income' => 25000.00,
                'monthly_expenses' => 15000.00,
                'housing_expenses' => 8000.00,
                'groceries_expenses' => 3000.00,
                'transport_expenses' => 2000.00,
                'education_expenses' => 1000.00,
                'medical_expenses' => 500.00,
                'debt_repayment_expenses' => 500.00,
                'miscellaneous_expenses' => 0.00,
                'total_calculated_expenses' => 15000.00,
                'total_existing_debt_amount' => 50000.00,
                'financial_health_score' => 75.5,
                'primary_bank_name' => 'First National Bank',
                'primary_account_type' => 'cheque',
                'primary_account_number' => '1234567890',
                'primary_bank_verified' => true,
                'secondary_bank_name' => 'Standard Bank',
                'secondary_account_type' => 'savings',
                'secondary_account_number' => '0987654321',
                'secondary_bank_verified' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        // Create Additional Test Customer
        $customerUser2 = User::updateOrCreate(
            ['email' => 'jane.smith@example.com'],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'password' => Hash::make('password123'),
                'user_type' => 'customer',
                'status' => 1,
                'email_verified_at' => Carbon::now(),
                'phone' => '+27555123456',
                'residential_address' => '789 Business Road, Durban',
                'city' => 'Durban',
                'state_province' => 'KwaZulu-Natal',
                'postal_code' => '4000',
                'country' => 'South Africa',
                'account_number' => 'ACC' . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT),
                'document_verified_at' => null,
                'kyc_status' => 'pending',
                'identity_document_status' => 'pending',
                'income_verified' => false,
                'loan_eligible' => false,
                'monthly_income' => 18000.00,
                'monthly_expenses' => 12000.00,
                'housing_expenses' => 6000.00,
                'groceries_expenses' => 2500.00,
                'transport_expenses' => 1500.00,
                'education_expenses' => 800.00,
                'medical_expenses' => 700.00,
                'debt_repayment_expenses' => 500.00,
                'miscellaneous_expenses' => 0.00,
                'total_calculated_expenses' => 12000.00,
                'total_existing_debt_amount' => 30000.00,
                'financial_health_score' => 62.3,
                'primary_bank_name' => 'ABSA Bank',
                'primary_account_type' => 'cheque',
                'primary_account_number' => '5555666677',
                'primary_bank_verified' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        // Create Staff/Employee User
        $staffUser = User::updateOrCreate(
            ['email' => 'staff@philalink.com'],
            [
                'name' => 'PhilaLink Staff Member',
                'email' => 'staff@philalink.com',
                'password' => Hash::make('staff123'),
                'user_type' => 'staff',
                'status' => 1,
                'email_verified_at' => Carbon::now(),
                'phone' => '+27111222333',
                'residential_address' => '321 Staff Street, Pretoria',
                'city' => 'Pretoria',
                'state_province' => 'Gauteng',
                'postal_code' => '0001',
                'country' => 'South Africa',
                'account_number' => 'STF' . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        $this->command->info('✅ PhilaLink admin user created successfully!');
        $this->command->info('📧 Email: admin@philalink.com');
        $this->command->info('🔑 Password: admin123');
        $this->command->info('');
        $this->command->info('✅ Test customer users created:');
        $this->command->info('📧 john.doe@example.com (Password: password123) - Verified & Loan Eligible');
        $this->command->info('📧 jane.smith@example.com (Password: password123) - Pending Verification');
        $this->command->info('');
        $this->command->info('✅ PhilaLink staff user created:');
        $this->command->info('📧 staff@philalink.com (Password: staff123)');
    }
}
