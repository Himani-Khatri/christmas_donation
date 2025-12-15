<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark px-4">
    <span class="navbar-brand">Admin Dashboard</span>
    <a href="{{ route('admin.logout') }}" class="btn btn-danger btn-sm">Logout</a>
    
</nav>

<div class="container mt-4">

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Total Donations</h5>
                    <h2>{{ \App\Models\DonationList::count() ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Money Donations</h5>
                    <h2>{{ \App\Models\DonationList::where('type','money')->count() ?? 0 }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Item Donations</h5>
                    <h2>{{ \App\Models\DonationList::where('type','!=','money')->count() ?? 0 }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            Quick Actions
        </div>
        <div class="card-body">
            <a href="{{ route('admin.donations') }}" class="btn btn-success">📦 Manage Donations</a>
            <a href="{{ route('admin.campaign.index') }}" class="btn btn-info">📢 Campaigns</a>
        </div>
    </div>

</div>

</body>
</html>
