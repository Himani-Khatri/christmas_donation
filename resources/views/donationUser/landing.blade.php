<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Christmas Donation</title>
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

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
<div class="hero">
<div class="hero-text">
<h1>Spread Love This Christmas 🎄</h1>
<p>
                Christmas is a season of joy, togetherness, and giving.  
                But while many celebrate with warmth and comfort, thousands of families struggle silently.  
                Your small act of kindness can bring warmth, food, clothes, and hope to someone who truly needs it.
</p>
<p>
                During festive seasons, donations matter more - they help restore faith, uplift communities,  
                and remind the needy that they are not forgotten.  
                Let's make this Christmas and New Year brighter for everyone. 🌟
</p>
</div>
<div class="hero-img">
<img src="{{ asset('uploads/christmas/image.png') }}" alt="Christmas Donation">
</div>
</div>
</body>
</html>