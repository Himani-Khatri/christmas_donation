<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campaign Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-light bg-light p-3 shadow-sm">
    <a class="navbar-brand" href="#">🎄 Christmas Donation</a>
</nav>

<div class="container mt-4 text-center">

    @if($campaign->banner)
        <img src="/uploads/campaigns/{{ $campaign->banner }}" class="img-fluid rounded mb-4" style="max-height: 350px; object-fit:cover;">
    @endif

    <h2 class="fw-bold">{{ $campaign->title }}</h2>

    <p class="text-muted">
        {{ $campaign->start_date }} — {{ $campaign->end_date }}
    </p>

    <p class="mt-3 fs-5" style="line-height: 1.7;">
        {{ $campaign->description }}
    </p>

    <a href="{{ route('donationUser.donation') }}" class="btn btn-danger btn-lg mt-3">
        Donate Now 🎁
    </a>

</div>

</body>
</html>
