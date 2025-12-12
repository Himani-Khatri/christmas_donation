<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Campaigns</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark p-3">
    <a class="navbar-brand text-white" href="#">Admin Panel</a>
</nav>

<div class="container mt-4">

    <h2 class="mb-3">All Campaigns</h2>

    <a href="{{ route('admin.campaign.create') }}" class="btn btn-primary mb-3">Create New Campaign</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Banner</th>
                <th>Start</th>
                <th>End</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($campaigns as $campaign)
            <tr>
                <td>{{ $campaign->id }}</td>
                <td>{{ $campaign->title }}</td>
                <td>
                    @if($campaign->banner)
                        <img src="/uploads/campaigns/{{ $campaign->banner }}" width="80">
                    @else
                        No Image
                    @endif
                </td>
                <td>{{ $campaign->start_date }}</td>
                <td>{{ $campaign->end_date }}</td>
                <td>
                    @if($campaign->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Ended</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

</body>
</html>
