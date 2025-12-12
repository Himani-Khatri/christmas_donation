<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Christmas Campaigns</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-light bg-light p-3 shadow-sm">
    <a class="navbar-brand" href="#">🎄 Christmas Donation</a>
</nav>

<div class="container mt-4">

    <h2 class="mb-4 text-center">🎄 Christmas Donation Campaigns 🎁</h2>

    <div class="row">
        @foreach($campaigns as $camp)
        <div class="col-md-4 mb-4">

            <div class="card shadow-lg border-0">

                @if($camp->banner)
                    <img src="/uploads/campaigns/{{ $camp->banner }}" class="card-img-top" style="height:200px; object-fit:cover;">
                @else
                    <div class="bg-secondary text-white text-center p-5">No Image</div>
                @endif

                <div class="card-body">
                    <h4 class="card-title">{{ $camp->title }}</h4>
                    <p class="text-muted">{{ $camp->start_date }} → {{ $camp->end_date }}</p>

                    <a href="{{ route('campaign.show', $camp->id) }}" class="btn btn-primary w-100">
                        View Campaign
                    </a>
                </div>

            </div>

        </div>
        @endforeach
    </div>

</div>

</body>
</html>
