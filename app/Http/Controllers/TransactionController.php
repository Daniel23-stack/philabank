<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller {

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
        return view('backend.transactions.list');
    }

    public function get_table_data(Request $request) {
        $transactions = Transaction::select('transactions.*')
            ->with('user')
            ->with('currency')
            ->orderBy("transactions.created_at", "desc");

        return Datatables::eloquent($transactions)
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
            ->editColumn('user.name', function ($transaction) {
                return '<b>' . $transaction->user->name . ' </b><br>' . $transaction->user->email;
            })
            ->editColumn('amount', function ($transaction) {
                $symbol = $transaction->dr_cr == 'dr' ? '-' : '+';
                $class  = $transaction->dr_cr == 'dr' ? 'text-danger' : 'text-success';
                return '<span class="' . $class . '">' . $symbol . ' ' . decimalPlace($transaction->amount, currency($transaction->currency->name)) . '</span>';
            })
            ->editColumn('dr_cr', function ($transaction) {
                return strtoupper($transaction->dr_cr);
            })
            ->editColumn('type', function ($transaction) {
                return str_replace('_', ' ', $transaction->type);
            })
            ->editColumn('status', function ($transaction) {
                return transaction_status($transaction->status);
            })
            ->addColumn('action', function ($transaction) {
                return '<a href="' . action('TransferRequestController@show', $transaction['id']) . '" data-title="' . _lang('Transaction Details') . '" class="btn btn-primary btn-sm ajax-modal"><i class="icofont-eye-alt"></i> ' . _lang('View') . '</a>&nbsp;'
                . '<a href="' . action('TransactionController@edit', $transaction['id']) . '" data-title="' . _lang('Edit Transaction') . '" class="btn btn-warning btn-sm ajax-modal"><i class="icofont-edit"></i> ' . _lang('Edit') . '</a>&nbsp;';
            })
            ->setRowId(function ($transaction) {
                return "row_" . $transaction->id;
            })
            ->rawColumns(['user.name', 'status', 'amount', 'action'])
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $transaction = Transaction::find($id);
        if (!$request->ajax()) {
            return back();
        } else {
            return view('backend.transfer_request.modal.edit', compact('transaction', 'id'));
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
            'date'   => 'required',
            'status' => 'required',
            'amount' => 'required|numeric|min:1.00',
            'fee'    => 'required|numeric',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return redirect()->route('fdr_plans.edit', $id)
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $transaction                  = Transaction::find($id);
        $transaction->status          = $request->input('status');
        $transaction->amount          = $request->input('amount');
        $transaction->fee             = $request->input('fee');
        $transaction->note            = $request->input('note');
        $transaction->created_at      = $request->input('date');
        $transaction->updated_user_id = auth()->id();

        $transaction->save();

        if (!$request->ajax()) {
            return redirect()->route('transactions.index')->with('success', _lang('Updated Successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'update', 'message' => _lang('Updated Successfully'), 'data' => $transaction, 'table' => '#transactions_table']);
        }

    }

}