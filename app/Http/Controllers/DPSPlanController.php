<?php

namespace App\Http\Controllers;

use App\Models\DPSPlan;
use Illuminate\Http\Request;
use Validator;

class DPSPlanController extends Controller {

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
        $dpsplans = DPSPlan::all()->sortByDesc("id");
        return view('backend.dps.dps_plan.list', compact('dpsplans'));
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
            return view('backend.dps.dps_plan.modal.create');
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
            'name'                => 'required|max:100',
            'currency_id'         => 'required',
            'per_installment'      => 'required|numeric',
            'installment_interval' => 'required|integer',
            'interval_type'       => 'required',
            'total_installment'    => 'required|integer',
            'interest_rate'       => 'required|numeric',
            'status'              => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('dps_plans.create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $totalDeposit   = $request->total_installment * $request->per_installment;
        $finalAmount    = $totalDeposit + ($totalDeposit * $request->interest_rate / 100);

        $dpsplan                      = new DPSPlan();
        $dpsplan->name                = $request->input('name');
        $dpsplan->currency_id         = $request->input('currency_id');
        $dpsplan->per_installment      = $request->input('per_installment');
        $dpsplan->installment_interval = $request->input('installment_interval');
        $dpsplan->interval_type       = $request->input('interval_type');
        $dpsplan->total_installment    = $request->input('total_installment');
        $dpsplan->interest_rate       = $request->input('interest_rate');
        $dpsplan->final_amount        = $finalAmount;
        $dpsplan->status              = $request->input('status');

        $dpsplan->save();

        if (!$request->ajax()) {
            return redirect()->route('dps_plans.create')->with('success', _lang('Saved Successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Saved Successfully'), 'data' => $dpsplan, 'table' => '#dps_plans_table']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
        $dpsplan = DPSPlan::find($id);
        if (!$request->ajax()) {
            return back();
        } else {
            return view('backend.dps.dps_plan.modal.view', compact('dpsplan', 'id'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $dpsplan = DPSPlan::find($id);
        if (!$request->ajax()) {
            return back();
        } else {
            return view('backend.dps.dps_plan.modal.edit', compact('dpsplan', 'id'));
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
            'name'                => 'required|max:100',
            'currency_id'         => 'required',
            'per_installment'      => 'required|numeric',
            'installment_interval' => 'required|integer',
            'interval_type'       => 'required',
            'total_installment'    => 'required|integer',
            'interest_rate'       => 'required|numeric',
            'status'              => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('dps_plans.edit', $id)
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $totalDeposit   = $request->total_installment * $request->per_installment;
        $finalAmount    = $totalDeposit + ($totalDeposit * $request->interest_rate / 100);

        $dpsplan                      = DPSPlan::find($id);
        $dpsplan->name                = $request->input('name');
        $dpsplan->currency_id         = $request->input('currency_id');
        $dpsplan->per_installment      = $request->input('per_installment');
        $dpsplan->installment_interval = $request->input('installment_interval');
        $dpsplan->interval_type       = $request->input('interval_type');
        $dpsplan->total_installment    = $request->input('total_installment');
        $dpsplan->interest_rate       = $request->input('interest_rate');
        $dpsplan->final_amount        =  $finalAmount;
        $dpsplan->status              = $request->input('status');

        $dpsplan->save();

        if (!$request->ajax()) {
            return redirect()->route('dps_plans.index')->with('success', _lang('Updated Successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Updated Successfully'), 'data' => $dpsplan, 'table' => '#dps_plans_table']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $dpsplan = DPSPlan::find($id);
        $dpsplan->delete();
        return redirect()->route('dps_plans.index')->with('success', _lang('Deleted Successfully'));
    }
}