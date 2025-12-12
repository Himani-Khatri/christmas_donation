<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Christmas Donation Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

<div class="snowflake" style="left: 10%; animation-duration: 10s; animation-delay: 0s;">❄</div>
<div class="snowflake" style="left: 20%; animation-duration: 12s; animation-delay: 2s;">❄</div>
<div class="snowflake" style="left: 30%; animation-duration: 14s; animation-delay: 4s;">❄</div>
<div class="snowflake" style="left: 40%; animation-duration: 11s; animation-delay: 1s;">❄</div>
<div class="snowflake" style="left: 50%; animation-duration: 13s; animation-delay: 3s;">❄</div>
<div class="snowflake" style="left: 60%; animation-duration: 15s; animation-delay: 5s;">❄</div>
<div class="snowflake" style="left: 70%; animation-duration: 12s; animation-delay: 2s;">❄</div>
<div class="snowflake" style="left: 80%; animation-duration: 10s; animation-delay: 0s;">❄</div>
<div class="snowflake" style="left: 90%; animation-duration: 14s; animation-delay: 4s;">❄</div>

<div class="navbar">
    <div class="nav-left">
        <a href="/dashboard">🏠 Home</a>
        <a href="/campaigns">🎁 All Campaigns</a>
    </div>
    <div class="nav-right">
        <a href="{{ route('logout') }}">🚪 Logout</a>
    </div>
</div>

<div class="hero">
    <div class="hero-text">
        <h1>Spread Love This Christmas 🎄</h1>
        <p>Your kindness brings hope and warmth to families in need.</p>
        <p>Every donation creates real impact. Be the reason someone smiles today.</p>
    </div>
    <div class="hero-img">
        <img src="{{ asset('uploads/christmas/image.png') }}" alt="Christmas Donation">
    </div>
</div>

<div class="container mt-5 mb-5">
    <div class="section-header">
        <span style="font-size: 2em;">🎁</span>
        <h2>Make a Donation</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif

    <div class="form-container">
        <form id="donationForm" method="POST" action="{{ route('store_donationLists') }}">
            @csrf

            <div class="mb-4">
                <label>Full Name</label>
                <input type="text" class="form-control" name="full_name" placeholder="Enter your full name" required>
            </div>

            <div class="mb-4">
                <label>Type of Donation</label>
                <select name="type" id="type" class="form-select" required>
                    <option value="">Select Type</option>
                    <option value="money">💰 Money</option>
                    <option value="toys">🧸 Toys</option>
                    <option value="clothing">👕 Clothing</option>
                    <option value="surprise_gift">🎁 Surprise Gift</option>
                </select>
            </div>

            <div class="mb-4" id="amountDiv" style="display:none;">
                <label>Amount (NPR)</label>
                <input type="number" name="amount" id="amount" class="form-control" placeholder="Enter amount" min="10">
            </div>

            <button type="button" class="btn btn-primary" id="fakePayBtn">💳 Proceed to Payment</button>
        </form>
    </div>
</div>

<div class="container mb-5">
    <div class="section-header">
        <span style="font-size: 2em;">📋</span>
        <h2>Your Donations</h2>
    </div>
    <div class="table-container">
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>#</th><th>Type</th><th>Amount / N/A</th><th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($donations as $donation)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ ucfirst($donation->type) }}</td>
                    <td>{{ $donation->type === 'money' ? 'NPR '.$donation->amount : 'N/A' }}</td>
                    <td>{{ $donation->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">No donations yet. Be the first to make a difference! 🌟</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="container mb-5">
    <div class="section-header">
        <span style="font-size: 2em;">💝</span>
        <h2>All Money Donations</h2>
    </div>
    <div class="table-container">
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>#</th><th>Name</th><th>Amount</th><th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($allMoneyDonations as $donation)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $donation->full_name }}</td>
                    <td>NPR {{ $donation->amount }}</td>
                    <td>{{ $donation->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">No money donations yet. 💫</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="paymentModal">
    <div class="payment-box">
        <div class="payment-header">
            <h3>Secure Payment</h3>
            <span class="secure-badge">Secure Checkout</span>
        </div>

        <div class="payment-amount">
            <div class="label">Total Amount</div>
            <div class="amount">NPR <span id="displayAmount">0</span></div>
        </div>

        <div class="card-input-group">
            <label>Card Number</label>
            <input type="text" class="card-input" id="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19">
        </div>

        <div class="card-input-group">
            <label>Cardholder Name</label>
            <input type="text" class="card-input" id="cardName" placeholder="JOHN DOE">
        </div>

        <div class="card-row">
            <div class="card-input-group">
                <label>Expiry Date</label>
                <input type="text" class="card-input" id="cardExpiry" placeholder="MM/YY" maxlength="5">
            </div>
            <div class="card-input-group">
                <label>CVV</label>
                <input type="text" class="card-input" id="cardCVV" placeholder="123" maxlength="3">
            </div>
        </div>

        <div class="card-brands">
            <span>💳</span>
            <span>💳</span>
            <span>💳</span>
        </div>

        <div class="payment-actions">
            <button class="btn btn-danger" id="cancelPayment">Cancel</button>
            <button class="btn btn-success" id="confirmPayment">Pay Now</button>
        </div>
    </div>
</div>

<script src="script.js"></script>

</body>
</html>