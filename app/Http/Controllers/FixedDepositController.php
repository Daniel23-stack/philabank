<?php

namespace App\Http\Controllers;

use App\Models\FDRPlan;
use App\Models\FixedDeposit;
use App\Models\Transaction;
use App\Notifications\ApprovedFDRRequest;
use App\Notifications\FDRMatured;
use App\Notifications\RejectFDRRequest;
use DataTables;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FixedDepositController extends Controller {

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
        return view('backend.fdr.list');
    }

    public function get_table_data(Request $request) {
        $fixeddeposits = FixedDeposit::select('fdrs.*')
            ->with('plan')
            ->with('currency')
            ->with('user')
            ->orderBy("fdrs.id", "desc");

        return Datatables::eloquent($fixeddeposits)
            ->filter(function ($query) use ($request) {
                if ($request->has('status')) {
                    $query->where('status', $request->status);
                }
            }, true)
            ->filterColumn('user.name', function ($query, $keyword) {
                $query->whereHas('user', function ($query) use ($keyword) {
                    return $query->where("name", "like", "%{$keyword}%")
                        ->orWhere("email", "like", "%{$keyword}%");
                });
            }, true)
            ->editColumn('user.name', function ($fixeddeposits) {
                return '<b>' . $fixeddeposits->user->name . ' </b><br>' . $fixeddeposits->user->email;
            })
            ->editColumn('status', function ($fixeddeposit) {
                return fdr_status($fixeddeposit->status);
            })
            ->addColumn('action', function ($fixeddeposit) {
                $actions = '';
                $actions .= $fixeddeposit->status == 0 ? '<a href="' . action('FixedDepositController@approve', $fixeddeposit['id']) . '" class="dropdown-item"><i class="icofont-check-circled"></i> ' . _lang('Approve') . '</a>' : '';
                $actions .= $fixeddeposit->status == 0 ? '<a href="' . action('FixedDepositController@reject', $fixeddeposit['id']) . '" class="dropdown-item"><i class="icofont-close-line-circled"></i> ' . _lang('Reject') . '</a>' : '';
                $actions .= $fixeddeposit->status == 0 ? '<a href="' . action('FixedDepositController@edit', $fixeddeposit['id']) . '" class="dropdown-item"><i class="icofont-pencil-alt-2"></i> ' . _lang('Edit') . '</a>' : '';
                $actions .= $fixeddeposit->status == 1 ? '<a href="' . action('FixedDepositController@completed', $fixeddeposit['id']) . '" class="dropdown-item"><i class="icofont-check-circled"></i> ' . _lang('Mark as Completed') . '</a>' : '';

                return '<div class="dropdown text-center">'
                . '<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">' . _lang('Action')
                . '&nbsp;</button>'
                . '<div class="dropdown-menu dropdown-menu-right">'
                . $actions
                . '<a class="dropdown-item" href="' . action('FixedDepositController@show', $fixeddeposit['id']) . '"><i class="icofont-eye-alt"></i>  ' . _lang('Details') . '</a>'
                . '<form action="' . action('FixedDepositController@destroy', $fixeddeposit['id']) . '" method="post">'
                . csrf_field()
                . '<input name="_method" type="hidden" value="DELETE">'
                . '<button class="dropdown-item btn-remove" type="submit"><i class="icofont-trash"></i> ' . _lang('Delete') . '</button>'
                    . '</form>'
                    . '</div>'
                    . '</div>';
            })
            ->setRowId(function ($fixeddeposit) {
                return "row_" . $fixeddeposit->id;
            })
            ->rawColumns(['user.name', 'status', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        return view('backend.fdr.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $fdrPlan    = FDRPlan::find($request->fdr_plan_id);
        $min_amount = $fdrPlan->minimum_amount;
        $max_amount = $fdrPlan->maximum_amount;

        $validator = Validator::make($request->all(), [
            'fdr_plan_id'    => 'required',
            'user_id'        => 'required',
            'currency_id'    => 'required',
            'deposit_amount' => "required|numeric:min:$min_amount|max:$max_amount",
            'attachment'     => 'nullable|mimes:jpeg,JPEG,png,PNG,jpg,doc,pdf,docx,zip',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('fixed_deposits.create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $attachment = '';
        if ($request->hasfile('attachment')) {
            $file       = $request->file('attachment');
            $attachment = time() . $file->getClientOriginalName();
            $file->move(public_path() . "/uploads/media/", $attachment);
        }

        $fdrPlan = FDRPlan::find($request->fdr_plan_id);

        if ($fdrPlan->minimum_amount > $request->deposit_amount || $fdrPlan->maximum_amount < $request->deposit_amount) {
            return back()->with('error', _lang('Sorry, deposit amount is not allowed for this plan !'))
                ->withInput();
        }

        $fixeddeposit                   = new FixedDeposit();
        $fixeddeposit->fdr_plan_id      = $request->input('fdr_plan_id');
        $fixeddeposit->user_id          = $request->input('user_id');
        $fixeddeposit->currency_id      = $request->input('currency_id');
        $fixeddeposit->deposit_amount   = $request->input('deposit_amount');
        $fixeddeposit->return_amount    = $fixeddeposit->deposit_amount + (($fdrPlan->interest_rate / 100) * $fixeddeposit->deposit_amount);
        $fixeddeposit->attachment       = $attachment;
        $fixeddeposit->remarks          = $request->input('remarks');
        $fixeddeposit->status           = 1; //Active
        $fixeddeposit->approved_date    = date('Y-m-d');
        $fixeddeposit->mature_date      = date("Y-m-d", strtotime('+ ' . $fdrPlan->duration . ' ' . $fdrPlan->duration_type));
        $fixeddeposit->approved_user_id = auth()->user()->id;
        $fixeddeposit->created_user_id  = auth()->user()->id;
        $fixeddeposit->branch_id        = auth()->user()->branch_id;

        $fixeddeposit->save();

        return redirect()->route('fixed_deposits.index')->with('success', _lang('New fixed deposit created Successfully'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
        $fixeddeposit = FixedDeposit::find($id);
        return view('backend.fdr.view', compact('fixeddeposit', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $fixeddeposit = FixedDeposit::find($id);
        if ($fixeddeposit->status != 0) {
            abort(403);
        }
        return view('backend.fdr.edit', compact('fixeddeposit', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $fdrPlan    = FDRPlan::find($request->fdr_plan_id);
        $min_amount = $fdrPlan->minimum_amount;
        $max_amount = $fdrPlan->maximum_amount;

        $validator = Validator::make($request->all(), [
            'fdr_plan_id'    => 'required',
            'user_id'        => 'required',
            'currency_id'    => 'required',
            'deposit_amount' => "required|numeric:min:$min_amount|max:$max_amount",
            'attachment'     => 'nullable|mimes:jpeg,JPEG,png,PNG,jpg,doc,pdf,docx,zip',
            'approved_date'  => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('fixed_deposits.edit', $id)
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        if ($request->hasfile('attachment')) {
            $file       = $request->file('attachment');
            $attachment = time() . $file->getClientOriginalName();
            $file->move(public_path() . "/uploads/media/", $attachment);
        }

        $fixeddeposit = FixedDeposit::find($id);
        if ($fixeddeposit->status != 0) {
            abort(403);
        }
        $fixeddeposit->fdr_plan_id    = $request->input('fdr_plan_id');
        $fixeddeposit->user_id        = $request->input('user_id');
        $fixeddeposit->currency_id    = $request->input('currency_id');
        $fixeddeposit->deposit_amount = $request->input('deposit_amount');
        $fixeddeposit->return_amount  = $request->input('return_amount');
        if ($request->hasfile('attachment')) {
            $fixeddeposit->attachment = $attachment;
        }
        $fixeddeposit->remarks     = $request->input('remarks');
        $fixeddeposit->mature_date = $request->input('mature_date');

        $fixeddeposit->updated_user_id = auth()->id();

        $fixeddeposit->save();

        if (!$request->ajax()) {
            return redirect()->route('fixed_deposits.index')->with('success', _lang('Updated Successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Updated Successfully'), 'data' => $fixeddeposit, 'table' => '#fdrs_table']);
        }
    }

    /**
     * Approve FDR Request
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve($id) {
        DB::beginTransaction();

        $fixeddeposit = FixedDeposit::find($id);
        if ($fixeddeposit->status != 0) {
            abort(403);
        }

        $fixeddeposit->status           = 1;
        $fixeddeposit->approved_date    = date('Y-m-d');
        $fixeddeposit->approved_user_id = auth()->id();
        $fixeddeposit->save();

        $transaction         = Transaction::find($fixeddeposit->transaction_id);
        $transaction->status = 2;
        $transaction->save();

        try {
            $transaction->user->notify(new ApprovedFDRRequest($transaction));
        } catch (\Exception $e) {}

        DB::commit();
        return back()->with('success', _lang('Request Approved'));
    }

    /**
     * Reject FDR Request
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reject($id) {
        DB::beginTransaction();
        $fixeddeposit = FixedDeposit::find($id);
        if ($fixeddeposit->status != 0) {
            abort(403);
        }

        $transaction         = Transaction::find($fixeddeposit->transaction_id);
        $transaction->status = 0;
        $transaction->save();

        $fixeddeposit->status = 2; //Cancelled
        $fixeddeposit->save();

        try {
            $transaction->user->notify(new RejectFDRRequest($transaction));
        } catch (\Exception $e) {}

        DB::commit();
        return redirect()->route('fixed_deposits.index')->with('success', _lang('Request Rejected'));
    }

    /**
     * Approve Wire Transfer
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function completed($id) {
        DB::beginTransaction();

        $fixeddeposit = FixedDeposit::find($id);
        if ($fixeddeposit->status != 1) {
            abort(403);
        }

        if ($fixeddeposit->getRawOriginal('mature_date') > date('Y-m-d')) {
            return redirect()->route('fixed_deposits.complete_before_maturity', $id)->with('error', _lang('Fixed deposit is unmatured. If you still want to complete please review the return amount you want to apply.'));
        }

        $fixeddeposit->status          = 3;
        $fixeddeposit->updated_user_id = auth()->id();
        $fixeddeposit->completed_at    = now();
        $fixeddeposit->save();

        $transaction                  = new Transaction();
        $transaction->user_id         = $fixeddeposit->user_id;
        $transaction->currency_id     = $fixeddeposit->currency_id;
        $transaction->amount          = $fixeddeposit->return_amount;
        $transaction->dr_cr           = 'cr';
        $transaction->type            = 'Deposit';
        $transaction->method          = 'Online';
        $transaction->status          = 2;
        $transaction->note            = 'Return of Fixed deposit';
        $transaction->created_user_id = auth()->id();
        $transaction->branch_id       = auth()->user()->branch_id;

        $transaction->save();

        try {
            $transaction->user->notify(new FDRMatured($transaction));
        } catch (\Exception $e) {}

        DB::commit();
        return back()->with('success', _lang('FDR mark as Completed'));
    }

    public function complete_before_maturity(Request $request, $id) {
        if ($request->isMethod('get')) {
            $alert_col    = 'col-lg-6 offset-lg-3';
            $fixeddeposit = FixedDeposit::find($id);

            if ($fixeddeposit->status != 1) {
                abort(403);
            }

            if ($fixeddeposit->getRawOriginal('mature_date') > date('Y-m-d')) {
                return view('backend.fdr.complete-before-maturity', compact('fixeddeposit', 'id', 'alert_col'));
            }

            return back();
        } else {
            $fixeddeposit = FixedDeposit::find($id);

            if ($fixeddeposit->status != 1) {
                abort(403);
            }

            if ($fixeddeposit->getRawOriginal('mature_date') <= date('Y-m-d')) {
                abort(403);
            }

            $validator = Validator::make($request->all(), [
                'return_amount' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            if ($fixeddeposit->return_amount < $request->return_amount) {
                return back()->with('error', _lang('Return amount cannot greater than') . ' ' . $fixeddeposit->return_amount)->withInput();
            }

            DB::beginTransaction();

            $fixeddeposit->status          = 3;
            $fixeddeposit->updated_user_id = auth()->id();
            $fixeddeposit->return_amount   = $request->return_amount;
            $fixeddeposit->completed_at    = now();
            $fixeddeposit->save();

            $transaction                  = new Transaction();
            $transaction->user_id         = $fixeddeposit->user_id;
            $transaction->currency_id     = $fixeddeposit->currency_id;
            $transaction->amount          = $request->return_amount;
            $transaction->dr_cr           = 'cr';
            $transaction->type            = 'Deposit';
            $transaction->method          = 'Online';
            $transaction->status          = 2;
            $transaction->note            = 'Return of Fixed deposit';
            $transaction->created_user_id = auth()->id();
            $transaction->branch_id       = auth()->user()->branch_id;

            $transaction->save();

            try {
                $transaction->user->notify(new FDRMatured($transaction));
            } catch (\Exception $e) {}

            DB::commit();

            return redirect()->route('fixed_deposits.index')->with('success', _lang('FDR mark as Completed'));

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        DB::beginTransaction();
        $fixeddeposit = FixedDeposit::find($id);
        if ($fixeddeposit->transaction_id != null) {
            $transaction = Transaction::find($fixeddeposit->transaction_id);
            $transaction->delete();
        }
        $fixeddeposit->delete();
        DB::commit();
        return redirect()->route('fixed_deposits.index')->with('success', _lang('Deleted Successfully'));
    }
}