<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | Campaign Donations</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #f4f6f9; font-family: 'Segoe UI', sans-serif; }
        .container { margin-top: 40px; }
        .card { border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .badge { font-size: 14px; padding: 8px 12px; }
        .navbar { background: #5c2d91; padding: 15px 40px; }
        .navbar a { color: #fff; font-weight: 700; text-decoration: none; margin-right: 20px; }
        .navbar a:hover { text-decoration: underline; }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<div class="navbar">
    <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
    <a href="{{ route('admin.donations') }}">Donations</a>
    <a href="{{ route('admin.logout') }}">Logout</a>
</div>

<div class="container">
    <div class="card p-4">
        <h3 class="mb-4 text-center">📋 Campaign Donations</h3>

        {{-- Alerts --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Loop through campaigns --}}
        @forelse($campaigns as $campaign)
            <div class="mb-4">
                <h4 class="fw-bold">
                    {{ $campaign->title }} 
                    ({{ \Carbon\Carbon::parse($campaign->start_date)->format('d M, Y') }} — 
                    {{ \Carbon\Carbon::parse($campaign->end_date)->format('d M, Y') }})
                </h4>

                <div class="table-responsive mb-3">
                    <table class="table table-bordered align-middle text-center">
                        <thead class="table-secondary">
                            <tr>
                                <th>User</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Pickup / Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($campaign->donations as $d)
                                <tr>
                                    <td>{{ $d->full_name }}</td>
                                    <td class="text-capitalize">{{ $d->type }}</td>
                                    <td>
                                        @if($d->type === 'money')
                                            💰 {{ number_format($d->amount, 2) }} NPR
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $statusColor = $d->type === 'money' 
                                                ? ($d->payment_status === 'completed' ? 'success' : 'warning') 
                                                : match($d->status) {
                                                    'pending' => 'warning',
                                                    'approved' => 'info',
                                                    'picked_up' => 'primary',
                                                    'completed' => 'success',
                                                    default => 'secondary'
                                                };
                                        @endphp
                                        <span class="badge bg-{{ $statusColor }}">
                                            {{ $d->type === 'money' 
                                                ? ucfirst($d->payment_status) 
                                                : ucfirst(str_replace('_',' ',$d->status)) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($d->type !== 'money')
                                            <form method="POST" action="{{ route('admin.donation.pickup', $d->id) }}">
                                                @csrf
                                                <select name="pickup_type" class="form-select form-select-sm mb-1">
                                                    <option value="instant" {{ $d->pickup_type=='instant'?'selected':'' }}>Instant Pickup</option>
                                                    <option value="scheduled" {{ $d->pickup_type=='scheduled'?'selected':'' }}>Scheduled Pickup</option>
                                                </select>
                                                <input type="date" name="pickup_date" value="{{ $d->pickup_date }}" class="form-control form-control-sm mb-1">
                                                <button class="btn btn-sm btn-success w-100">Save Pickup 🚚</button>
                                            </form>

                                            <form method="POST" action="{{ route('admin.donation.status', $d->id) }}" class="mt-2">
                                                @csrf
                                                <select name="status" class="form-select form-select-sm mb-1">
                                                    <option value="pending" {{ $d->status=='pending'?'selected':'' }}>Pending</option>
                                                    <option value="approved" {{ $d->status=='approved'?'selected':'' }}>Approved</option>
                                                    <option value="picked_up" {{ $d->status=='picked_up'?'selected':'' }}>Picked Up</option>
                                                    <option value="completed" {{ $d->status=='completed'?'selected':'' }}>Completed</option>
                                                </select>
                                                <button class="btn btn-sm btn-primary w-100">Update Status</button>
                                            </form>
                                        @else
                                            @if($d->payment_status === 'completed')
                                                <span class="text-success">Received 💰</span>
                                            @else
                                                <form method="POST" action="{{ route('donation.markReceived', $d->id) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success w-100">
                                                        Mark as Received 💰
                                                    </button>
                                                </form>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No donations for this campaign</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Total money for this campaign --}}
                <div class="text-end mb-3">
                    @php
                        $totalMoney = $campaign->donations->where('type','money')->sum('amount');
                    @endphp
                    <strong>Total Money Received: 💰 {{ number_format($totalMoney, 2) }} NPR</strong>
                </div>
                <hr>
            </div>
        @empty
            <div class="alert alert-info text-center">
                No campaigns found.
            </div>
        @endforelse
    </div>
</div>

</body>
</html>
