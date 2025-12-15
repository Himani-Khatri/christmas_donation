<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pickup Tracker - Christmas Donation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
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

<div class="container mt-5">
    <div class="card p-4 shadow">
        <h4 class="mb-4 text-center">🚚 Pickup Tracker</h4>

        @if($donations->isEmpty())
            <p class="text-center">You haven't donated any items yet.</p>
        @else
            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th>Item Name</th>
                            <th>Type</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Pickup Date</th>
                            <th>Admin Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($donations as $item)
                            <tr>
                                <td>{{ $item->full_name }}</td>
                                <td class="text-capitalize">{{ $item->type }}</td>
                                <td>{{ $item->quantity ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge 
                                        @if($item->status == 'pending') bg-warning
                                        @elseif($item->status == 'approved') bg-info
                                        @elseif($item->status == 'picked_up') bg-primary
                                        @elseif($item->status == 'completed') bg-success
                                        @else bg-secondary @endif">
                                        {{ ucfirst(str_replace('_',' ',$item->status)) }}
                                    </span>
                                </td>
                                <td>{{ $item->pickup_date ?? 'Not Scheduled' }}</td>
                                <td>
                                    @php
                                        $note = $notifications->where('donation_id', $item->id)->first();
                                    @endphp
                                    {{ $note->message ?? '-' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

</body>
</html>
