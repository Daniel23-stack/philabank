<?php

namespace App\Cronjobs;

use App\Models\DPS;
use App\Models\Transaction;
use App\Notifications\DPSDueInstallment;
use App\Notifications\DPSMatured;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DPSScheduleTask {

    public function __invoke() {
        @ini_set('max_execution_time', 0);
        @set_time_limit(0);

        update_option('DPS_scheduleTask', Carbon::now());

        $now = Carbon::now();

        $dps_schemes = DPS::active()
            ->whereDate('next_installment_date', '<=', $now)
            ->whereColumn('total_installment', '>', 'installment_completed')
            ->whereRaw('email_at IS NULL')
            ->orWhereDate('email_at', '<', $now)
            ->whereColumn('status', 1)
            ->with('plan', 'currency')
            ->limit(5)
            ->get();

        foreach ($dps_schemes as $dps) {
            $installment_amount = $dps->per_installment;
            $last_email_at      = Carbon::parse($dps->email_at);
            if (get_account_balance($dps->currency_id, $dps->user_id) < $installment_amount) {
                //Send Due DPS Installment Notification
                if ($dps->email_at == NULL || $last_email_at->diffInDays($now) > 1) {
                    try {
                        $dps->user->notify(new DPSDueInstallment($dps));
                        $dps->email_at = $now;
                        $dps->save();
                    } catch (\Exception $e) {}
                }
            } else {
                DB::beginTransaction();

                $dps->installment_completed += 1;

                if ($dps->interval_type == 'days') {
                    $dps->next_installment_date = Carbon::now()->addDays($dps->installment_interval + 1);
                } else {
                    $dps->next_installment_date = Carbon::now()->addMonth($dps->installment_interval);
                }
                $dps->email_at = null;
                $dps->save();

                //Create Debit Transactions
                $debit              = new Transaction();
                $debit->user_id     = $dps->user_id;
                $debit->currency_id = $dps->currency_id;
                $debit->amount      = $dps->per_installment;
                $debit->dr_cr       = 'dr';
                $debit->type        = 'DPS_Installment';
                $debit->method      = 'Online';
                $debit->status      = 2; //Completed
                $debit->ref_id      = $dps->id;

                $debit->save();

                DB::commit();

                //Send Due DPS MATURED Notification
                if ($dps->installment_completed >= $dps->total_installment) {

                    $dps->status     = 2;
                    $dps->matured_at = Carbon::now();
                    $dps->save();

                    $transaction              = new Transaction();
                    $transaction->user_id     = $dps->user_id;
                    $transaction->currency_id = $dps->currency_id;
                    $transaction->amount      = $dps->final_amount;
                    $transaction->dr_cr       = 'cr';
                    $transaction->type        = 'Deposit';
                    $transaction->method      = 'Online';
                    $transaction->status      = 2;
                    $transaction->note        = 'DPS Matured';
        
                    $transaction->save();

                    try {
                        $dps->user->notify(new DPSMatured($dps));
                    } catch (\Exception $e) {}
                }
            }
        }
    }

}