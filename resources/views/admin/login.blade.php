<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark d-flex justify-content-center align-items-center" style="height:100vh;">

<div class="card p-4 shadow" style="width:380px;">
    <h3 class="text-center mb-3">Admin Login</h3>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf

        <input type="email" name="email" class="form-control mb-3" placeholder="Admin Email" required>

        <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

        <button class="btn btn-primary w-100">Login</button>
    </form>
</div>

</body>
</html>
