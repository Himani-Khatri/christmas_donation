<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="stylesheet" href="{{ asset('css/login.css') }}">

</head>
<body>
<div class="navbar">
    <div class="nav-left">
        <a href="/">Home</a>
        <a href="/campaigns">All Campaigns</a>
    </div>

    <div class="nav-right">
        <a href="{{ route('donationUser.login') }}">Login</a>
        <a href="{{ route('donationUser.signup') }}">Sign Up</a>
    </div>
</div>

<div class="login-form">
<form action="{{ route('donationUser.login') }}" method="post">
@csrf
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="alert alert-error">{{ session('error') }}</div>
@endif
@if($errors->any())
<div class="alert alert-error">
<ul>
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
<div class="form-group">
<label for="email">Email:</label>
<div class="input-wrapper">
<input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="your.email@example.com">
</div>
</div>
<div class="form-group">
<label for="password">Password</label>
<div class="input-wrapper">
<input type="password" id="password" name="password" required placeholder="Enter your password">
</div>
</div>
<button type="submit">Login</button>
<div class="signup-link-wrapper">
<a href="{{ route('donationUser.signup') }}" class="signup-link">Don't have an account? Sign Up →</a>
</div>
</form>
</div>
</body>
</html>