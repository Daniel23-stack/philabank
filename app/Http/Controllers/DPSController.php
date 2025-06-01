<?php

namespace App\Http\Controllers;

use App\Models\DPS;
use App\Models\DPSPlan;
use App\Models\Transaction;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class DPSController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        date_default_timezone_set(get_option('timezone', 'Asia/Dhaka'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('backend.dps.list');
    }

    public function get_table_data(Request $request) {

        $dps_list = DPS::select('dps.*')
            ->with('plan', 'currency', 'user')
            ->orderBy("dps.id", "desc");

        return Datatables::eloquent($dps_list)
            ->filter(function ($query) use ($request) {
                if ($request->has('status')) {
                    $query->where('status', $request->status);
                }
            }, true)
            ->editColumn('total_installment', function ($dps) {
                return _lang('Total') . ': ' . $dps->total_installment . "<br>" . _lang('Completed') . ': ' . $dps->installment_completed;
            })
            ->addColumn('total_paid', function ($dps) {
                return decimalPlace($dps->per_installment * $dps->installment_completed, currency($dps->currency->name));
            })
            ->editColumn('final_amount', function ($dps) {
                return decimalPlace($dps->final_amount, currency($dps->currency->name));
            })
            ->editColumn('status', function ($dps) {
                return dps_status($dps->status);
            })
            ->editColumn('next_installment_date', function ($dps) {
                $next_installment = $dps->next_installment_date . '<br>';
                $next_installment .= '<span class="text-danger">' . $dps->dueInstallmentDate() . '</span>';
                return $next_installment;
            })
            ->addColumn('action', function ($dps) {
                return '<div class="dropdown text-center">'
                . '<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">' . _lang('Action')
                . '&nbsp;<i class="fas fa-angle-down"></i></button>'
                . '<div class="dropdown-menu">'
                . '<a class="dropdown-item ajax-modal" href="' . action('DPSController@edit', $dps['id']) . '" data-title="' . _lang('Update DPS') . '"><i class="icofont-ui-edit"></i> ' . _lang('Edit') . '</a>'
                . '<a class="dropdown-item ajax-modal" href="' . action('DPSController@show', $dps['id']) . '" data-title="' . _lang('DPS Details') . '"><i class="icofont-eye-alt"></i>  ' . _lang('View') . '</a>'
                    . '</div>'
                    . '</div>';
            })
            ->setRowId(function ($dps) {
                return "row_" . $dps->id;
            })
            ->rawColumns(['status', 'total_installment', 'next_installment_date', 'action'])
            ->make(true);
    }

    public function due_dps() {
        return view('backend.dps.due_dps_list');
    }

    public function get_due_dps_data(Request $request) {
        $dps_list = DPS::select('dps.*')
            ->with('plan', 'currency', 'user')
            ->where('status', 1)
            ->whereDate('next_installment_date', '<', Carbon::now())
            ->orderBy("dps.id", "desc");

        return Datatables::eloquent($dps_list)
            ->filter(function ($query) use ($request) {
                if ($request->has('status')) {
                    $query->where('status', $request->status);
                }
            }, true)
            ->editColumn('total_installment', function ($dps) {
                return _lang('Total') . ': ' . $dps->total_installment . "<br>" . _lang('Completed') . ': ' . $dps->installment_completed;
            })
            ->addColumn('total_paid', function ($dps) {
                return decimalPlace($dps->per_installment * $dps->installment_completed, currency($dps->currency->name));
            })
            ->editColumn('final_amount', function ($dps) {
                return decimalPlace($dps->final_amount, currency($dps->currency->name));
            })
            ->editColumn('status', function ($dps) {
                return dps_status($dps->status);
            })
            ->editColumn('next_installment_date', function ($dps) {
                $next_installment = $dps->next_installment_date . '<br>';
                $next_installment .= '<span class="text-danger">' . $dps->dueInstallmentDate() . '</span>';
                return $next_installment;
            })
            ->addColumn('action', function ($dps) {
                return '<div class="dropdown text-center">'
                . '<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">' . _lang('Action')
                . '&nbsp;<i class="fas fa-angle-down"></i></button>'
                . '<div class="dropdown-menu">'
                . '<a class="dropdown-item ajax-modal" href="' . action('DPSController@edit', $dps['id']) . '" data-title="' . _lang('Update DPS') . '"><i class="icofont-ui-edit"></i> ' . _lang('Edit') . '</a>'
                . '<a class="dropdown-item ajax-modal" href="' . action('DPSController@show', $dps['id']) . '" data-title="' . _lang('DPS Details') . '"><i class="icofont-eye-alt"></i>  ' . _lang('View') . '</a>'
                    . '</div>'
                    . '</div>';
            })
            ->setRowId(function ($dps) {
                return "row_" . $dps->id;
            })
            ->rawColumns(['status', 'total_installment', 'next_installment_date', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        if (!$request->ajax()) {
            return back();
        } else {
            return view('backend.dps.modal.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'dps_plan_id'   => 'required',
            'user_id'       => 'required',
            'debit_account' => 'required|in:user_account,cash',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('dps.create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $dpsPlan = DPSPlan::active()->find($request->dps_plan_id);

        if (!$dpsPlan) {
            return back()->with('error', _lang('Invalid DPS plan !'));
        }

        //Check Available Balance
        if ($request->debit_account == 'user_account' && get_account_balance($dpsPlan->currency_id) < $dpsPlan->per_installment) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => _lang('Insufficient balance !')]);
            } else {
                return back()->with('error', _lang('Insufficient balance !'))->withInput();
            }
        }

        DB::beginTransaction();

        $dps                        = new DPS();
        $dps->dps_plan_id           = $dpsPlan->id;
        $dps->currency_id           = $dpsPlan->currency_id;
        $dps->user_id               = $request->user_id;
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
        if ($request->debit_account == 'user_account') {
            $debit                  = new Transaction();
            $debit->user_id         = $request->user_id;
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
        }

        DB::commit();

        if (!$request->ajax()) {
            return redirect()->route('dps.create')->with('success', _lang('New DPS has been activated successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('New DPS has been activated successfully'), 'data' => $dps, 'table' => '#dps_table']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
        $dps = DPS::find($id);
        if (!$request->ajax()) {
            return back();
        } else {
            return view('backend.dps.modal.view', compact('dps', 'id'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $dps = DPS::find($id);
        if (!$request->ajax()) {
            return back();
        } else {
            return view('backend.dps.modal.edit', compact('dps', 'id'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'per_installment'       => 'required',
            'installment_interval'  => 'required',
            'interval_type'         => 'required',
            'installment_completed' => 'required',
            'status'                => 'required',
            'next_installment_date' => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('dps.edit', $id)
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $dps                        = DPS::find($id);
        $dps->per_installment       = $request->input('per_installment');
        $dps->installment_interval  = $request->input('installment_interval');
        $dps->interval_type         = $request->input('interval_type');
        $dps->installment_completed = $request->input('installment_completed');
        $dps->status                = $request->input('status');
        $dps->next_installment_date = $request->input('next_installment_date');

        $dps->save();

        if (!$request->ajax()) {
            return redirect()->route('dps.index')->with('success', _lang('Updated Successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Updated Successfully'), 'data' => $dps, 'table' => '#dps_table']);
        }

    }
}