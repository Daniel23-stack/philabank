<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Notifications\WithdrawMoney;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WithdrawController extends Controller {

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
        return view('backend.withdraw.list');
    }

    public function get_table_data() {

        $transactions = Transaction::select('transactions.*')
            ->with('user')
            ->with('currency')
            ->where('type', 'Withdraw')
            ->orderBy("transactions.created_at", "desc");

        return Datatables::eloquent($transactions)
            ->editColumn('created_at', function ($transaction) {
                return $transaction->created_at;
            })
            ->editColumn('user.name', function ($transaction) {
                return '<b>' . $transaction->user->name . ' </b><br>' . $transaction->user->email;
            })
            ->editColumn('amount', function ($transaction) {
                return decimalPlace($transaction->amount, currency($transaction->currency->name));
            })
            ->editColumn('status', function ($transaction) {
                return transaction_status($transaction->status);
            })
            ->addColumn('action', function ($transaction) {
                return '<form action="' . action('WithdrawController@destroy', $transaction['id']) . '" class="text-center" method="post">'
                . '<a href="' . action('WithdrawController@show', $transaction['id']) . '" data-title="' . _lang('Transaction Details') . '" class="btn btn-primary btn-sm ajax-modal">' . _lang('View') . '</a>&nbsp;'
                . csrf_field()
                . '<input name="_method" type="hidden" value="DELETE">'
                . '<button class="btn btn-danger btn-sm btn-remove" type="submit">' . _lang('Delete') . '</button>'
                    . '</form>';
            })
            ->setRowId(function ($transaction) {
                return "row_" . $transaction->id;
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
        if (!$request->ajax()) {
            return view('backend.withdraw.create');
        } else {
            return view('backend.withdraw.modal.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        @ini_set('max_execution_time', 0);
        @set_time_limit(0);

        $validator = Validator::make($request->all(), [
            'date'           => 'required',
            'account_number' => 'required',
            'currency_id'    => 'required',
            'amount'         => 'required|numeric|min:1.00',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            } else {
                return back()->withErrors($validator)->withInput();
            }
        }

        $user = User::whereRaw("(email = '$request->account_number' OR account_number = '$request->account_number')")
            ->where('user_type', 'customer')
            ->first();    

        if (!$user) {
            return back()->with('error', _lang('User Account not found !'))->withInput();
        }

        if ($user->allow_withdrawal == 0) {
            return back()->with('error', _lang('Sorry, Withdraw action is disabled in this account !'));
        }

        //Check Available Balance
        if (get_account_balance($request->currency_id, $user->id) < $request->amount) {
            if (!$request->ajax()) {
                return back()->with('error', _lang('Insufficient balance !'))->withInput();
            } else {
                return response()->json(['result' => 'error', 'message' => _lang('Insufficient balance !')]);
            }
        }

        $transaction                  = new Transaction();
        $transaction->user_id         = $user->id;
        $transaction->currency_id     = $request->input('currency_id');
        $transaction->amount          = $request->input('amount');
        $transaction->dr_cr           = 'dr';
        $transaction->type            = 'Withdraw';
        $transaction->method          = 'Manual';
        $transaction->status          = 2;
        $transaction->note            = $request->input('note');
        $transaction->created_user_id = auth()->id();
        $transaction->branch_id       = auth()->user()->branch_id;
        $transaction->created_at      = $request->date;

        $transaction->save();

        try {
            $transaction->user->notify(new WithdrawMoney($transaction));
        } catch (\Exception $e) {}

        if (!$request->ajax()) {
            return back()->with('success', _lang('Withdraw made successfully'));
        } else {
            return response()->json(['result' => 'success', 'action' => 'store', 'message' => _lang('Withdraw made successfully'), 'data' => $transaction, 'table' => '#transactions_table']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
        $transaction = Transaction::find($id);
        if (!$request->ajax()) {
            return view('backend.withdraw.view', compact('transaction', 'id'));
        } else {
            return view('backend.withdraw.modal.view', compact('transaction', 'id'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $transaction = Transaction::find($id);
        $transaction->delete();
        return redirect()->route('withdraw.index')->with('success', _lang('Deleted Successfully'));
    }
}