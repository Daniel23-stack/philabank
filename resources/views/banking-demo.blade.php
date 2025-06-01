@extends('layouts.banking')

@section('page-title', 'Banking Dashboard Demo')

@section('content')
<style>
.badge-status {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: 600;
}

.status-due {
    background-color: #dc3545;
    color: white;
}

.status-upcoming {
    background-color: #28a745;
    color: white;
}

.balance-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 15px;
    padding: 1.5rem;
    margin-bottom: 1rem;
}

.balance-amount {
    font-size: 2rem;
    font-weight: bold;
    margin: 0;
}

.balance-currency {
    font-size: 0.9rem;
    opacity: 0.8;
}
</style>

<h4>Dashboard</h4>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="balance-card">
            <div class="balance-currency">USD Balance</div>
            <div class="balance-amount">$1,197,452.02</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="balance-card" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
            <div class="balance-currency">EUR Balance</div>
            <div class="balance-amount">€1,263.65</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="balance-card" style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);">
            <div class="balance-currency">INR Balance</div>
            <div class="balance-amount">₹7,972.42</div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card p-3 border-danger">
            <strong>Active Loans</strong>
            <div>5 <a href="#" class="float-end">→ View</a></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 border-primary">
            <strong>Payment Requests</strong>
            <div>0 <a href="#" class="float-end">→ View</a></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 border-success">
            <strong>Active Fixed Deposits</strong>
            <div>0 <a href="#" class="float-end">→ View</a></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 border-info">
            <strong>Active Tickets</strong>
            <div>0 <a href="#" class="float-end">→ View</a></div>
        </div>
    </div>
</div>

<h5>Upcoming Loan Payment</h5>
<table class="table table-bordered table-striped">
    <thead class="table-light">
        <tr>
            <th>Loan ID</th>
            <th>Next Payment Date</th>
            <th>Status</th>
            <th>Amount to Pay</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>BL5001</td>
            <td>09/05/2025</td>
            <td>
                <span class="badge badge-status status-due">Due</span>
            </td>
            <td>₹888.49</td>
            <td><a href="#" class="btn btn-sm btn-dark">Pay Now</a></td>
        </tr>
        <tr>
            <td>BL5002</td>
            <td>14/06/2025</td>
            <td>
                <span class="badge badge-status status-upcoming">Upcoming</span>
            </td>
            <td>€88.85</td>
            <td><a href="#" class="btn btn-sm btn-dark">Pay Now</a></td>
        </tr>
        <tr>
            <td>EL8001</td>
            <td>17/05/2025</td>
            <td>
                <span class="badge badge-status status-due">Due</span>
            </td>
            <td>₹1,660.72</td>
            <td><a href="#" class="btn btn-sm btn-dark">Pay Now</a></td>
        </tr>
        <tr>
            <td>SL1007</td>
            <td>18/07/2025</td>
            <td>
                <span class="badge badge-status status-upcoming">Upcoming</span>
            </td>
            <td>$4.38</td>
            <td><a href="#" class="btn btn-sm btn-dark">Pay Now</a></td>
        </tr>
        <tr>
            <td>SL1008</td>
            <td>18/05/2025</td>
            <td>
                <span class="badge badge-status status-due">Due</span>
            </td>
            <td>$43.75</td>
            <td><a href="#" class="btn btn-sm btn-dark">Pay Now</a></td>
        </tr>
    </tbody>
</table>

<h5>Recent Transactions</h5>
<table class="table table-bordered table-hover">
    <thead class="table-light">
        <tr>
            <th>Date</th>
            <th>Currency</th>
            <th>Amount</th>
            <th>Charge</th>
            <th>Grand Total</th>
            <th>DR/CR</th>
            <th>Type</th>
            <th>Method</th>
            <th>Status</th>
            <th>Details</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>23/05/2025 06:12</td>
            <td>USD</td>
            <td>$100.00</td>
            <td>+ $1.00</td>
            <td>- $101.00</td>
            <td>DR</td>
            <td>Exchange</td>
            <td>Online</td>
            <td><span class="badge bg-success">Completed</span></td>
            <td><a href="#" class="btn btn-sm btn-outline-primary">View</a></td>
        </tr>
        <tr>
            <td>23/05/2025 06:12</td>
            <td>EUR</td>
            <td>€85.00</td>
            <td>- €0.00</td>
            <td>+ €85.00</td>
            <td>CR</td>
            <td>Exchange</td>
            <td>Online</td>
            <td><span class="badge bg-success">Completed</span></td>
            <td><a href="#" class="btn btn-sm btn-outline-primary">View</a></td>
        </tr>
        <tr>
            <td>19/05/2025 02:15</td>
            <td>USD</td>
            <td>$3,400.00</td>
            <td>+ $37.00</td>
            <td>- $3,437.00</td>
            <td>DR</td>
            <td>Wire Transfer</td>
            <td>Manual</td>
            <td><span class="badge bg-success">Completed</span></td>
            <td><a href="#" class="btn btn-sm btn-outline-primary">View</a></td>
        </tr>
    </tbody>
</table>
@endsection
