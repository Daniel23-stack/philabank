<?php

namespace App\Http\Controllers;

use App\Models\FixedDeposit;
use App\Models\Loan;
use App\Models\PaymentRequest;
use App\Models\SupportTicket;
use App\Models\Transaction;
use App\Models\User;
use App\Models\DepositRequest;
use App\Models\WithdrawRequest;
use DB;

class DashboardController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        date_default_timezone_set(get_option('timezone', 'Asia/Dhaka'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $user      = auth()->user();
        $user_type = $user->user_type;
        $data      = array();
        if ($user_type == 'customer') {
            $data['active_tickets']  = SupportTicket::where('status', 1)->where('user_id', auth()->id())->count();
            $data['loans']           = Loan::where('status', 1)->where('borrower_id', auth()->id())->get();
            $data['active_fdr']      = FixedDeposit::where('status', 1)->where('user_id', auth()->id())->count();
            $data['payment_request'] = PaymentRequest::where('status', 1)->where('receiver_id', auth()->id())->count();

            $data['recent_transactions'] = Transaction::where('user_id', auth()->id())
                ->with('currency')
                ->limit(10)
                ->orderBy('created_at', 'desc')
                ->get();

            $data['account_balance'] = DB::select("SELECT currency.*, (SELECT IFNULL(SUM(amount), 0) FROM transactions
            WHERE dr_cr = 'cr' AND currency_id = currency.id AND status = 2 AND transactions.user_id = " . $user->id . ") - (SELECT IFNULL(SUM(amount),0)
            FROM transactions WHERE dr_cr = 'dr' AND currency_id = currency.id AND status != 0 AND transactions.user_id = " . $user->id . ") as balance
            FROM currency LEFT JOIN transactions ON currency.id=transactions.currency_id WHERE currency.status=1 GROUP BY currency.id");
        } else {
            $data['active_customer']     = User::where('user_type', 'customer')->where('status', 1)->count();
            $data['inactive_customer']   = User::where('user_type', 'customer')->where('status', 0)->count();
            $data['recent_transactions'] = Transaction::limit(10)
                ->with('currency')
                ->orderBy('created_at', 'desc')
                ->get();

        }

        return view("backend.dashboard-$user_type", $data);
    }

    /**
     * Show the admin dashboard
     */
    public function admin_dashboard() {
        $user = auth()->user();

        // Admin dashboard data
        $data = array();
        $data['active_customer'] = User::where('user_type', 'customer')->where('status', 1)->count();
        $data['pending_kyc'] = User::where('user_type', 'customer')->whereNull('document_verified_at')->count();
        $data['total_loans'] = Loan::count();
        $data['active_loans'] = Loan::where('status', 1)->count();
        $data['pending_loans'] = Loan::where('status', 0)->count();
        $data['total_deposits'] = DepositRequest::where('status', 2)->sum('amount');
        $data['total_withdraws'] = WithdrawRequest::where('status', 2)->sum('amount');
        $data['pending_deposits'] = DepositRequest::where('status', 1)->count();
        $data['pending_withdraws'] = WithdrawRequest::where('status', 1)->count();
        $data['active_tickets'] = SupportTicket::where('status', 1)->count();
        $data['pending_tickets'] = SupportTicket::where('status', 0)->count();

        // Recent transactions
        $data['recent_transactions'] = Transaction::limit(10)
            ->with(['user', 'currency'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Recent loans
        $data['recent_loans'] = Loan::limit(10)
            ->with(['borrower', 'currency', 'loan_product'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view("backend.dashboard-admin", $data);
    }

    public function active_users_widget() {
        // Use for Permission Only
        return redirect()->route('dashboard.index');
    }

    public function pending_kyc_widget() {
        // Use for Permission Only
        return redirect()->route('dashboard.index');
    }

    public function pending_tickets_widget() {
        // Use for Permission Only
        return redirect()->route('dashboard.index');
    }

    public function deposit_requests_widget() {
        // Use for Permission Only
        return redirect()->route('dashboard.index');
    }

    public function withdraw_requests_widget() {
        // Use for Permission Only
        return redirect()->route('dashboard.index');
    }

    public function loan_requests_widget() {
        // Use for Permission Only
        return redirect()->route('dashboard.index');
    }

    public function fdr_requests_widget() {
        // Use for Permission Only
        return redirect()->route('dashboard.index');
    }

    public function wire_transfer_widget() {
        // Use for Permission Only
        return redirect()->route('dashboard.index');
    }

    public function total_deposit_widget() {
        // Use for Permission Only
        return redirect()->route('dashboard.index');
    }

    public function total_withdraw_widget() {
        // Use for Permission Only
        return redirect()->route('dashboard.index');
    }

    public function recent_transaction_widget() {
        // Use for Permission Only
        return redirect()->route('dashboard.index');
    }
}
