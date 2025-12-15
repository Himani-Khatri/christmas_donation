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
        .navbar { background: #5c2d91; padding: 15px 40px; }
        .navbar a { color: #fff; font-weight: 700; text-decoration: none; margin-right: 20px; }
        .navbar a:hover { text-decoration: underline; }

        .campaign-list {
            position: sticky;
            top: 20px;
            max-height: 90vh;
            overflow-y: auto;
        }
        .campaign-card {
            cursor: pointer;
            transition: transform .2s;
            margin-bottom: 15px;
        }
        .campaign-card:hover {
            transform: scale(1.03);
        }
        .campaign-img {
            height: 120px;
            object-fit: cover;
            border-radius: 12px;
        }
        .donation-table {
            display: none;
            animation: fadeIn .3s ease-in-out;
        }
        @keyframes fadeIn { from {opacity:0;} to {opacity:1;} }
        .active-card { border: 2px solid #5c2d91; }
    </style>
</head>
<body>

<div class="navbar">
    <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
    <a href="{{ route('admin.donations') }}">Standalone Donations</a>
    <a href="{{ route('campaign.donation') }}">Campaign Donations</a>
    <a href="{{ route('admin.logout') }}">Logout</a>
</div>

<div class="container">
    <h3 class="text-center mb-4">🎯 Campaign Donations</h3>

    <div class="row">
        {{-- Left: Campaign List --}}
        <div class="col-md-3 campaign-list">
            @foreach($campaigns as $campaign)
                <div class="card campaign-card" id="card-{{ $campaign->id }}" onclick="showTable({{ $campaign->id }})">
                    <img src="{{ asset('uploads/campaigns/'.$campaign->banner) }}" 
                         class="campaign-img card-img-top" 
                         alt="{{ $campaign->title }}">
                    <div class="card-body text-center">
                        <h5 class="fw-bold">{{ $campaign->title }}</h5>
                        <small class="text-muted">
                            {{ \Carbon\Carbon::parse($campaign->start_date)->format('d M Y') }} -
                            {{ \Carbon\Carbon::parse($campaign->end_date)->format('d M Y') }}
                        </small>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Right: Donation Table --}}
        <div class="col-md-9">
            @foreach($campaigns as $campaign)
                <div id="table-{{ $campaign->id }}" class="donation-table">
                    <h4 class="fw-bold mb-3">{{ $campaign->title }} Donations</h4>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered align-middle text-center">
                            <thead class="table-secondary">
                                <tr>
                                    <th>User</th>
                                    <th>Type</th>
                                    <th>Amount / Quantity</th>
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
                                                💰 {{ number_format($d->amount,2) }} NPR
                                            @else
                                                {{ $d->quantity ?? 'N/A' }}
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
                                                {{ $d->type==='money' ? ucfirst($d->payment_status) : ucfirst(str_replace('_',' ',$d->status)) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($d->type !== 'money')
                                                {{-- Pickup --}}
                                                <form method="POST" action="{{ route('admin.donation.pickup', $d->id) }}">
                                                    @csrf
                                                    <select name="pickup_type" class="form-select form-select-sm mb-1">
                                                        <option value="instant" {{ $d->pickup_type=='instant'?'selected':'' }}>Instant Pickup</option>
                                                        <option value="scheduled" {{ $d->pickup_type=='scheduled'?'selected':'' }}>Scheduled Pickup</option>
                                                    </select>
                                                    <input type="date" name="pickup_date" value="{{ $d->pickup_date }}" class="form-control form-control-sm mb-1">
                                                    <button class="btn btn-sm btn-success w-100">Save Pickup 🚚</button>
                                                </form>

                                                {{-- Status --}}
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
                                                {{-- Money Donation --}}
                                                @if($d->payment_status==='completed')
                                                    <span class="text-success fw-bold">Received 💰</span>
                                                @else
                                                    <form method="POST" action="{{ route('donation.markReceived', $d->id) }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-success w-100">Mark as Received 💰</button>
                                                    </form>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No donations yet</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @php
                        $total = $campaign->donations->where('type','money')->sum('amount');
                    @endphp
                    <div class="text-end mb-4">
                        <strong>Total Collected: 💰 {{ number_format($total,2) }} NPR</strong>
                    </div>
                    <hr>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    let currentTable = null;
    let currentCard = null;
    function showTable(id) {
        if(currentTable) currentTable.style.display='none';
        if(currentCard) currentCard.classList.remove('active-card');
        const table=document.getElementById('table-'+id);
        table.style.display='block';
        currentTable=table;
        const card=document.getElementById('card-'+id);
        card.classList.add('active-card');
        currentCard=card;
        table.scrollIntoView({behavior:'smooth',block:'start'});
    }
    document.addEventListener('DOMContentLoaded',()=>{
        @if(count($campaigns)>0)
            showTable({{ $campaigns[0]->id }});
        @endif
    });
</script>

</body>
</html>
