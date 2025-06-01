<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\DPS;
use App\Models\DPSPlan;
use App\Models\Transaction;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class DPSController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        date_default_timezone_set(get_option('timezone', 'Asia/Dhaka'));
        $this->middleware(function ($request, $next) {
            if(get_option('dps_module', 1) == '0'){
                return back();
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $dps_schemes = DPS::select('dps.*')
            ->with('plan')
            ->where('user_id', auth()->id())
            ->orderBy("dps.id", "desc")
            ->get();
        return view('backend.customer_portal.dps.list', compact('dps_schemes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function plans() {
        $dps_plans = DPSPlan::active()->with('currency')->get();
        return view('backend.customer_portal.dps.dps_plans', compact('dps_plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apply(Request $request, $id) {
        if ($request->isMethod('get')) {
            $alert_col = 'col-lg-8 offset-lg-2';
            $dpsplan   = DPSPlan::active()->where('id', $id)->first();
            return view('backend.customer_portal.dps.apply', compact('alert_col', 'dpsplan'));
        } else {
            $dpsPlan = DPSPlan::active()->find($request->plan_id);

            if (!$dpsPlan) {
                return back()->with('error', _lang('Invalid DPS plan !'));
            }

            //Check Available Balance
            if (get_account_balance($dpsPlan->currency_id) < $dpsPlan->per_installment) {
                return back()->with('error', _lang('Insufficient balance !'))->withInput();
            }

            DB::beginTransaction();
            $dps                        = new DPS();
            $dps->dps_plan_id           = $dpsPlan->id;
            $dps->currency_id           = $dpsPlan->currency_id;
            $dps->user_id               = auth()->id();
            $dps->per_installment       = $dpsPlan->per_installment;
            $dps->installment_interval  = $dpsPlan->installment_interval;
            $dps->interval_type         = $dpsPlan->interval_type;
            $dps->total_installment     = $dpsPlan->total_installment;
            $dps->installment_completed = 1;
            $dps->interest_rate         = $dpsPlan->interest_rate;
            $dps->final_amount          = $dpsPlan->final_amount;
            $dps->email_at              = null;

            if ($dpsPlan->interval_type == 'days') {
                $dps->next_installment_date = Carbon::now()->addDays($dpsPlan->installment_interval + 1);
            } else {
                $dps->next_installment_date = Carbon::now()->addMonth($dpsPlan->installment_interval);
            }
            $dps->save();

            //Create Debit Transactions
            $debit                  = new Transaction();
            $debit->user_id         = auth()->id();
            $debit->currency_id     = $dpsPlan->currency_id;
            $debit->amount          = $dpsPlan->per_installment;
            $debit->dr_cr           = 'dr';
            $debit->type            = 'DPS_Installment';
            $debit->method          = 'Online';
            $debit->status          = 2; //Completed
            $debit->ref_id          = $dps->id;
            $debit->created_user_id = auth()->id();
            $debit->branch_id       = auth()->user()->branch_id;

            $debit->save();

            DB::commit();

            return redirect()->route('dps_scheme.index')->with('success', _lang('Congratulations, Your new DPS has been activated successfully'));

        }
    }

}