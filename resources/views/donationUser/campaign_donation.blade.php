<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Donate to {{ $campaign->title }} - Christmas Donation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/khalti.css') }}">
</head>
<body>

<div class="navbar d-flex justify-content-between align-items-center px-4">
    <div class="nav-left">
        <a href="/dashboard" class="me-3">Home</a>
        <a href="/campaigns" class="me-3">All Campaigns</a>
        <a href="{{ route('tracker') }}" class="me-3">Tracker</a>
    </div>
    <div class="nav-right d-flex align-items-center position-relative">
        

        <a href="{{ route('logout') }}" class="text-white text-decoration-none btn btn-danger">Logout</a>
    </div>
</div>

<div class="hero">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Donate to "{{ $campaign->title }}"</h2>
        <div class="row justify-content-center">

            <div class="col-md-6 mb-4">
                <div class="card p-4 shadow">
                    <h4 class="text-center mb-4">Donate Money 💜</h4>

                    @if(session('error_money'))
                        <div class="alert alert-danger">{{ session('error_money') }}</div>
                    @endif

                    @if(!session('user_id'))
                        <p class="text-center text-danger">
                            Please <a href="{{ route('donationUser.login') }}">login</a> to donate
                        </p>
                    @else
                        <form method="POST" action="{{ route('khalti.initiate') }}">
                            @csrf
                            <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">
                            <input type="text" name="full_name" class="form-control" placeholder="Your Name" required>
                            <input type="number" name="amount" class="form-control mt-3" placeholder="Minimum NPR 10" min="10" required>
                            <button type="submit" class="btn khalti-btn text-white w-100 mt-3">Pay with Khalti</button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card p-4 shadow">
                    <h4 class="text-center mb-4">Donate Items 🎁</h4>

                    @if(session('error_items'))
                        <div class="alert alert-danger">{{ session('error_items') }}</div>
                    @endif

                    @if(!session('user_id'))
                        <p class="text-center text-danger">
                            Please <a href="{{ route('donationUser.login') }}">login</a> to donate
                        </p>
                    @else
                        <form method="POST" action="{{ route('store_donationLists') }}">
                            @csrf
                            <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">
                            <input type="text" name="full_name" class="form-control" placeholder="Your Name" required>

                            <select name="type" class="form-control mt-3" required>
                                <option value="" disabled selected>Select Item Type</option>
                                <option value="clothing">Clothing</option>
                                <option value="toys">Toys</option>
                                <option value="surprise_gift">Surprise Gift</option>
                                <option value="other">Other</option>
                            </select>

                            <input type="number" name="quantity" class="form-control mt-3" placeholder="Quantity" min="1" required>

                            <button type="submit" class="btn btn-success w-100 mt-3">Donate Item</button>
                        </form>
                    @endif
                </div>
            </div>

        </div>

       

    </div>
</div>

</body>
</html>
