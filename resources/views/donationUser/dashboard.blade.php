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

<div class="navbar d-flex justify-content-between align-items-center px-4">
    <div class="nav-left">
        <a href="/dashboard" class="me-3">Home</a>
        <a href="/campaigns" class="me-3">All Campaigns</a>
        <a href="{{ route('tracker') }}" class="me-3">Tracker</a>
    </div>
    <div class="nav-right d-flex align-items-center position-relative">
        <div class="dropdown me-3">
            <button class="btn btn-secondary dropdown-toggle position-relative" type="button" id="notifDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Notifications
                @if(count($notifications) > 0)
                    <span class="notification-badge">{{ count($notifications) }}</span>
                @endif
            </button>
            <ul class="dropdown-menu" aria-labelledby="notifDropdown">
                @forelse($notifications as $notif)
                    <li class="px-3 py-2 border-bottom">
                        <strong>{{ $notif->title }}</strong><br>
                        <small>{{ $notif->message }}</small><br>
                        <small class="text-muted">{{ $notif->created_at->format('d M Y H:i') }}</small>
                    </li>
                @empty
                    <li class="px-3 py-2">No notifications</li>
                @endforelse
            </ul>
        </div>

        <a href="{{ route('logout') }}" class="text-white text-decoration-none btn btn-danger">Logout</a>
    </div>
</div>

<div class="hero">
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">

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

            <div class="col-md-6 text-center">
                <img src="{{ asset('uploads/christmas/image.png') }}" alt="Christmas Donation" class="img-fluid">
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
