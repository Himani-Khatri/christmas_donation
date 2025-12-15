<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campaign Details | {{ $campaign->title }}</title>
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

<div class="container mt-4 text-center">

    @if(!empty($campaign->banner))
        <img src="{{ asset('uploads/campaigns/' . $campaign->banner) }}" 
             class="img-fluid rounded mb-4" 
             style="max-height: 350px; object-fit: cover;">
    @endif

    <h2 class="fw-bold">{{ $campaign->title }}</h2>

    <p class="text-muted">
        {{ \Carbon\Carbon::parse($campaign->start_date)->format('F d, Y') }} — 
        {{ \Carbon\Carbon::parse($campaign->end_date)->format('F d, Y') }}
    </p>

    <p class="mt-3 fs-5" style="line-height: 1.7;">
        {{ $campaign->description }}
    </p>

    <a href="{{ route('campaign.donations', ['id' => $campaign->id]) }}" 
   class="btn btn-danger btn-lg mt-3">
    Donate Now 🎁
</a>



</div>

</body>
</html>
