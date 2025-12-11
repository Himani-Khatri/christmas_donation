<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Christmas Donation Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #0a1929;
    min-height: 100vh;
    color: #fff;
    overflow-x: hidden;
    position: relative;
}

/* Animated snow background */
body::before {
    content: '';
    position: fixed;
    width: 100%;
    height: 100%;
    background: 
        radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.03) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(200, 16, 46, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 50% 50%, rgba(67, 233, 123, 0.03) 0%, transparent 50%);
    animation: snowFloat 25s ease-in-out infinite;
    pointer-events: none;
    z-index: 0;
}

@keyframes snowFloat {
    0%, 100% { transform: translate(0, 0); }
    33% { transform: translate(30px, -30px); }
    66% { transform: translate(-20px, 20px); }
}

/* Floating snowflakes */
.snowflake {
    position: fixed;
    top: -10px;
    color: rgba(255, 255, 255, 0.8);
    font-size: 20px;
    animation: fall linear infinite;
    pointer-events: none;
    z-index: 1;
}

@keyframes fall {
    to {
        transform: translateY(100vh) rotate(360deg);
    }
}

/* Premium navbar */
.navbar {
    width: 100%;
    background: linear-gradient(135deg, #c8102e 0%, #8b0a1f 100%);
    padding: 25px 60px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 10px 40px rgba(200, 16, 46, 0.4);
    position: sticky;
    top: 0;
    z-index: 1000;
    backdrop-filter: blur(10px);
    animation: navSlide 0.8s ease;
    border-bottom: 3px solid rgba(255, 215, 0, 0.3);
}

@keyframes navSlide {
    from {
        opacity: 0;
        transform: translateY(-100%);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.navbar::before {
    content: '🎄';
    position: absolute;
    left: 20px;
    font-size: 2em;
    animation: shake 3s ease-in-out infinite;
}

@keyframes shake {
    0%, 100% { transform: rotate(0deg); }
    25% { transform: rotate(-10deg); }
    75% { transform: rotate(10deg); }
}

.nav-left, .nav-right {
    display: flex;
    gap: 10px;
    position: relative;
    z-index: 2;
}

.nav-left a, .nav-right a {
    color: white;
    text-decoration: none;
    font-weight: 700;
    padding: 12px 24px;
    border-radius: 25px;
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    position: relative;
    overflow: hidden;
}

.nav-left a::before, .nav-right a::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.2);
    transition: left 0.5s;
}

.nav-left a:hover::before, .nav-right a:hover::before {
    left: 100%;
}

.nav-left a:hover, .nav-right a:hover {
    background: rgba(255, 255, 255, 0.15);
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(255, 215, 0, 0.3);
}

/* Hero section */
.hero {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 100px 80px;
    gap: 80px;
    position: relative;
    z-index: 2;
    animation: heroReveal 1.2s ease 0.3s both;
}

@keyframes heroReveal {
    from {
        opacity: 0;
        transform: translateY(50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.hero-text {
    flex: 1;
    animation: slideInLeft 1s ease 0.5s both;
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.hero-text h1 {
    font-size: 64px;
    font-weight: 900;
    background: linear-gradient(135deg, #ff3b3b, #ffd700, #43e97b);
    background-size: 200% auto;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: gradientShift 3s ease infinite;
    margin-bottom: 30px;
    line-height: 1.2;
}

@keyframes gradientShift {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

.hero-text p {
    font-size: 20px;
    color: rgba(255, 255, 255, 0.95);
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(10px);
    padding: 25px;
    border-radius: 20px;
    border-left: 5px solid #ffd700;
    margin-bottom: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    transition: all 0.3s ease;
}

.hero-text p:hover {
    transform: translateX(10px);
    border-left-width: 8px;
    box-shadow: 0 15px 40px rgba(255, 215, 0, 0.2);
}

.hero-img {
    flex: 1;
    animation: slideInRight 1s ease 0.7s both;
    position: relative;
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(50px) scale(0.9);
    }
    to {
        opacity: 1;
        transform: translateX(0) scale(1);
    }
}

.hero-img::before {
    content: '';
    position: absolute;
    width: 120%;
    height: 120%;
    top: -10%;
    left: -10%;
    background: radial-gradient(circle, rgba(200, 16, 46, 0.3) 0%, transparent 70%);
    filter: blur(40px);
    animation: pulse 3s ease-in-out infinite;
    z-index: -1;
}

.hero-img img {
    width: 100%;
    border-radius: 25px;
    box-shadow: 0 30px 80px rgba(0, 0, 0, 0.5);
    transition: transform 0.5s ease;
}

.hero-img img:hover {
    transform: scale(1.05) rotate(2deg);
}

/* Container styling */
.container {
    position: relative;
    z-index: 2;
}

/* Premium section headers */
.section-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 30px;
    padding: 20px;
    background: linear-gradient(135deg, rgba(200, 16, 46, 0.2) 0%, rgba(139, 10, 31, 0.2) 100%);
    border-radius: 15px;
    border-left: 5px solid #ffd700;
}

.section-header h2 {
    margin: 0;
    font-weight: 800;
    font-size: 2em;
    background: linear-gradient(135deg, #ffd700, #fff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Premium form styling */
.form-container {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(20px);
    border-radius: 25px;
    padding: 40px;
    border: 2px solid rgba(255, 215, 0, 0.2);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
    margin-bottom: 50px;
}

.form-control, .form-select {
    background: rgba(255, 255, 255, 0.1) !important;
    border: 2px solid rgba(255, 255, 255, 0.2) !important;
    color: white !important;
    padding: 15px !important;
    border-radius: 15px !important;
    font-size: 16px !important;
    transition: all 0.3s ease !important;
}

.form-control:focus, .form-select:focus {
    background: rgba(255, 255, 255, 0.15) !important;
    border-color: #ffd700 !important;
    box-shadow: 0 0 20px rgba(255, 215, 0, 0.3) !important;
    color: white !important;
}

.form-control::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

.form-select option {
    background: #1a1a2e;
    color: white;
}

label {
    color: #ffd700 !important;
    font-weight: 600;
    font-size: 16px;
    margin-bottom: 10px;
}

/* Premium button */
.btn-primary {
    background: linear-gradient(135deg, #c8102e 0%, #8b0a1f 100%) !important;
    border: none !important;
    padding: 16px 50px !important;
    border-radius: 50px !important;
    font-weight: 700 !important;
    font-size: 18px !important;
    box-shadow: 0 10px 30px rgba(200, 16, 46, 0.4) !important;
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important;
    position: relative;
    overflow: hidden;
}

.btn-primary::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.6s;
}

.btn-primary:hover::before {
    left: 100%;
}

.btn-primary:hover {
    transform: translateY(-3px) scale(1.05) !important;
    box-shadow: 0 15px 40px rgba(200, 16, 46, 0.6) !important;
}

/* Premium tables */
.table-container {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(20px);
    border-radius: 25px;
    padding: 30px;
    border: 2px solid rgba(255, 215, 0, 0.2);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
    margin-bottom: 50px;
    overflow: hidden;
}

.table {
    margin: 0 !important;
}

.table-dark {
    background: transparent !important;
    color: white !important;
}

.table-dark thead {
    background: linear-gradient(135deg, #c8102e 0%, #8b0a1f 100%);
}

.table-dark thead th {
    border: none !important;
    padding: 20px !important;
    font-weight: 700;
    font-size: 16px;
    letter-spacing: 0.5px;
}

.table-dark tbody tr {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
    transition: all 0.3s ease;
}

.table-dark tbody tr:hover {
    background: rgba(255, 215, 0, 0.1) !important;
    transform: scale(1.01);
}

.table-dark tbody td {
    padding: 18px !important;
    border: none !important;
    vertical-align: middle;
}

/* Realistic Payment Modal */
#paymentModal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.85);
    backdrop-filter: blur(10px);
    justify-content: center;
    align-items: center;
    z-index: 10000;
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.payment-box {
    background: linear-gradient(135deg, #ffffff 0%, #f5f5f5 100%);
    color: #000;
    padding: 40px;
    width: 480px;
    max-width: 95%;
    border-radius: 25px;
    box-shadow: 0 30px 80px rgba(0, 0, 0, 0.5);
    animation: modalSlideIn 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    position: relative;
    overflow: hidden;
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: translateY(-50px) scale(0.9);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.payment-box::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 6px;
    background: linear-gradient(90deg, #c8102e, #ffd700, #43e97b);
    background-size: 200% auto;
    animation: gradientFlow 3s linear infinite;
}

@keyframes gradientFlow {
    0% { background-position: 0% 50%; }
    100% { background-position: 200% 50%; }
}

.payment-header {
    text-align: center;
    margin-bottom: 30px;
}

.payment-header h3 {
    font-size: 28px;
    font-weight: 800;
    color: #1a1a2e;
    margin-bottom: 10px;
}

.payment-header .secure-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    color: white;
    padding: 8px 20px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
    box-shadow: 0 5px 15px rgba(67, 233, 123, 0.3);
}

.payment-header .secure-badge::before {
    content: '🔒';
    font-size: 16px;
}

.payment-amount {
    text-align: center;
    background: linear-gradient(135deg, rgba(200, 16, 46, 0.1) 0%, rgba(255, 215, 0, 0.1) 100%);
    padding: 20px;
    border-radius: 15px;
    margin-bottom: 25px;
}

.payment-amount .label {
    font-size: 14px;
    color: #666;
    margin-bottom: 5px;
}

.payment-amount .amount {
    font-size: 36px;
    font-weight: 900;
    color: #c8102e;
}

.card-input-group {
    margin-bottom: 20px;
}

.card-input-group label {
    display: block;
    color: #333 !important;
    font-weight: 600;
    margin-bottom: 8px;
    font-size: 14px;
}

.card-input {
    width: 100%;
    padding: 15px;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    font-size: 16px;
    transition: all 0.3s ease;
    background: white;
    color: #000;
}

.card-input:focus {
    outline: none;
    border-color: #c8102e;
    box-shadow: 0 0 0 4px rgba(200, 16, 46, 0.1);
}

.card-input::placeholder {
    color: #999;
}

.card-row {
    display: flex;
    gap: 15px;
}

.card-row .card-input-group {
    flex: 1;
}

.card-brands {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin: 20px 0;
    opacity: 0.6;
}

.card-brands span {
    font-size: 32px;
}

.payment-actions {
    display: flex;
    gap: 15px;
    margin-top: 25px;
}

.btn-success, .btn-danger {
    flex: 1;
    padding: 16px !important;
    border-radius: 12px !important;
    font-weight: 700 !important;
    font-size: 16px !important;
    border: none !important;
    transition: all 0.3s ease !important;
}

.btn-success {
    background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%) !important;
    box-shadow: 0 10px 25px rgba(67, 233, 123, 0.3) !important;
}

.btn-success:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 15px 35px rgba(67, 233, 123, 0.4) !important;
}

.btn-danger {
    background: linear-gradient(135deg, #ff3b3b 0%, #c8102e 100%) !important;
    box-shadow: 0 10px 25px rgba(255, 59, 59, 0.3) !important;
}

.btn-danger:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 15px 35px rgba(255, 59, 59, 0.4) !important;
}

/* Alert styling */
.alert {
    border-radius: 15px !important;
    border: none !important;
    padding: 20px !important;
    font-weight: 600 !important;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2) !important;
}

.alert-success {
    background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%) !important;
    color: white !important;
}

/* Responsive design */
@media (max-width: 768px) {
    .navbar {
        padding: 20px 30px;
        flex-direction: column;
        gap: 15px;
    }

    .hero {
        flex-direction: column;
        padding: 60px 30px;
        gap: 40px;
    }

    .hero-text h1 {
        font-size: 42px;
    }

    .hero-text p {
        font-size: 16px;
        padding: 20px;
    }

    .form-container, .table-container {
        padding: 25px;
    }

    .payment-box {
        width: 90%;
        padding: 30px;
    }

    .card-row {
        flex-direction: column;
        gap: 20px;
    }
}
</style>
</head>
<body>

<!-- Snowflakes -->
<div class="snowflake" style="left: 10%; animation-duration: 10s; animation-delay: 0s;">❄</div>
<div class="snowflake" style="left: 20%; animation-duration: 12s; animation-delay: 2s;">❄</div>
<div class="snowflake" style="left: 30%; animation-duration: 14s; animation-delay: 4s;">❄</div>
<div class="snowflake" style="left: 40%; animation-duration: 11s; animation-delay: 1s;">❄</div>
<div class="snowflake" style="left: 50%; animation-duration: 13s; animation-delay: 3s;">❄</div>
<div class="snowflake" style="left: 60%; animation-duration: 15s; animation-delay: 5s;">❄</div>
<div class="snowflake" style="left: 70%; animation-duration: 12s; animation-delay: 2s;">❄</div>
<div class="snowflake" style="left: 80%; animation-duration: 10s; animation-delay: 0s;">❄</div>
<div class="snowflake" style="left: 90%; animation-duration: 14s; animation-delay: 4s;">❄</div>

<!-- NAVBAR -->
<div class="navbar">
    <div class="nav-left">
        <a href="/dashboard">🏠 Home</a>
        <a href="/campaigns">🎁 All Campaigns</a>
    </div>
    <div class="nav-right">
        <a href="{{ route('logout') }}">🚪 Logout</a>
    </div>
</div>

<!-- HERO -->
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

<!-- DONATION FORM -->
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

<!-- USER DONATIONS -->
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

<!-- ALL MONEY DONATIONS -->
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

<!-- REALISTIC PAYMENT MODAL -->
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

<script>
const typeSelect = document.getElementById('type');
const amountDiv = document.getElementById('amountDiv');
const amountInput = document.getElementById('amount');
const fakePayBtn = document.getElementById('fakePayBtn');
const modal = document.getElementById('paymentModal');
const confirmPayment = document.getElementById('confirmPayment');
const cancelPayment = document.getElementById('cancelPayment');
const displayAmount = document.getElementById('displayAmount');

// Card input formatting
const cardNumber = document.getElementById('cardNumber');
const cardExpiry = document.getElementById('cardExpiry');
const cardCVV = document.getElementById('cardCVV');

typeSelect.addEventListener('change', () => {
    amountDiv.style.display = typeSelect.value === 'money' ? 'block' : 'none';
});

// Format card number
cardNumber.addEventListener('input', (e) => {
    let value = e.target.value.replace(/\s/g, '');
    let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
    e.target.value = formattedValue;
});

// Format expiry date
cardExpiry.addEventListener('input', (e) => {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length >= 2) {
        value = value.slice(0, 2) + '/' + value.slice(2, 4);
    }
    e.target.value = value;
});

// Only allow numbers in CVV
cardCVV.addEventListener('input', (e) => {
    e.target.value = e.target.value.replace(/\D/g, '');
});

fakePayBtn.addEventListener('click', () => {
    if(typeSelect.value === '') {
        alert("Please select a donation type!");
        return;
    }
    
    if(typeSelect.value === 'money') {
        if(amountInput.value === '' || amountInput.value < 10) {
            alert("Please enter a valid amount (minimum NPR 10)!");
            return;
        }
        displayAmount.textContent = amountInput.value;
    } else {
        displayAmount.textContent = 'N/A';
    }
    
    modal.style.display = "flex";
});

cancelPayment.addEventListener('click', () => {
    modal.style.display = "none";
    clearCardInputs();
});

confirmPayment.addEventListener('click', () => {
    // Validate card inputs
    if(typeSelect.value === 'money') {
        if(cardNumber.value.replace(/\s/g, '').length < 16) {
            alert("Please enter a valid card number!");
            return;
        }
        if(cardExpiry.value.length < 5) {
            alert("Please enter a valid expiry date!");
            return;
        }
        if(cardCVV.value.length < 3) {
            alert("Please enter a valid CVV!");
            return;
        }
    }
    
    // Show success animation
    confirmPayment.innerHTML = '<span style="display: inline-block; animation: spin 1s linear infinite;">⏳</span> Processing...';
    confirmPayment.disabled = true;
    
    setTimeout(() => {
        alert("Payment Successful! 🎉 Thank you for your generous donation!");
        modal.style.display = "none";
        clearCardInputs();
        document.getElementById('donationForm').submit();
    }, 2000);
});

function clearCardInputs() {
    cardNumber.value = '';
    cardExpiry.value = '';
    cardCVV.value = '';
    document.getElementById('cardName').value = '';
    confirmPayment.innerHTML = 'Pay Now';
    confirmPayment.disabled = false;
}

// Close modal on outside click
modal.addEventListener('click', (e) => {
    if(e.target === modal) {
        modal.style.display = "none";
        clearCardInputs();
    }
});

// Add spin animation for loading
const style = document.createElement('style');
style.textContent = `
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
`;
document.head.appendChild(style);
</script>
</body>
</html>