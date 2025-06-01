<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MicroloanSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed Currencies
        $currencies = [
            [
                'name' => 'ZAR',
                'exchange_rate' => 1.0000,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'USD',
                'exchange_rate' => 0.054,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'EUR',
                'exchange_rate' => 0.049,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'GBP',
                'exchange_rate' => 0.043,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($currencies as $currency) {
            DB::table('currency')->updateOrInsert(
                ['name' => $currency['name']],
                $currency
            );
        }

        // Seed Loan Products
        $loanProducts = [
            [
                'name' => 'Emergency Microloan',
                'loan_id_prefix' => 'EML',
                'starting_loan_id' => 1000,
                'minimum_amount' => 500.00,
                'maximum_amount' => 10000.00,
                'interest_rate' => 26.00,
                'interest_type' => 'flat',
                'term' => 1,
                'term_period' => 'month',
                'description' => 'Quick emergency loans for urgent financial needs. Interest compounds if unpaid after 30 days.',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Standard Microloan',
                'loan_id_prefix' => 'SML',
                'starting_loan_id' => 2000,
                'minimum_amount' => 1000.00,
                'maximum_amount' => 25000.00,
                'interest_rate' => 35.00,
                'interest_type' => 'flat',
                'term' => 2,
                'term_period' => 'month',
                'description' => 'Flexible 2-month loans with equal monthly payments for various financial needs.',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Extended Microloan',
                'loan_id_prefix' => 'XML',
                'starting_loan_id' => 3000,
                'minimum_amount' => 5000.00,
                'maximum_amount' => 50000.00,
                'interest_rate' => 40.00,
                'interest_type' => 'flat',
                'term' => 3,
                'term_period' => 'month',
                'description' => 'Extended 3-month loans with manageable monthly installments for larger amounts.',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($loanProducts as $product) {
            DB::table('loan_products')->updateOrInsert(
                ['name' => $product['name']],
                $product
            );
        }

        // Note: Account balances and transactions would be seeded here
        // but the accounts table doesn't exist in this system
        // The system likely uses a different approach for balance tracking

        $this->command->info('✅ Currencies seeded successfully!');
        $this->command->info('✅ Loan products created:');
        $this->command->info('   - Emergency Microloan (26% - 1 month)');
        $this->command->info('   - Standard Microloan (35% - 2 months)');
        $this->command->info('   - Extended Microloan (40% - 3 months)');
        $this->command->info('✅ Microloan system seeded successfully!');
    }
}
