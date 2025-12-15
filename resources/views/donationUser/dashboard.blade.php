<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Christmas Donation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/khalti.css') }}">
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="nav-left">
        <a href="/dashboard">Home</a>
        <a href="/campaigns">All Campaigns</a>
    </div>
    <div class="nav-right">
        <a href="{{ route('logout') }}" class="text-white text-decoration-none">Logout</a>
    </div>
</div>

<div class="hero">
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">

            <!-- MESSAGE + DONATE NOW BUTTON -->
            <div class="col-md-6">
                <div class="card p-4 shadow text-center">
                    <h4 class="mb-4">🎁 Make a Difference This Christmas!</h4>
                    <p class="mb-4">
                        Your contribution of items like clothing, toys, or books can bring joy to someone in need. 
                        Click below to donate items and schedule a pickup.
                    </p>
                    <a href="{{ route('donation.create') }}" class="btn btn-success btn-lg">
                        Donate Now 🎄
                    </a>
                </div>
            </div>

            <!-- IMAGE -->
            <div class="col-md-6 text-center">
                <img src="{{ asset('uploads/christmas/image.png') }}" alt="Christmas Donation" class="img-fluid">
            </div>

        </div>
    </div>
</div>

</body>
</html>
