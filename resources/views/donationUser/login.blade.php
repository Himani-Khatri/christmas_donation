<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    min-height: 100vh;
    background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    overflow-x: hidden;
    position: relative;
}

body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.03) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.03) 0%, transparent 50%);
    pointer-events: none;
    animation: shimmer 10s ease-in-out infinite;
}

@keyframes shimmer {
    0%, 100% { opacity: 0.5; }
    50% { opacity: 1; }
}

/* Floating Christmas Elements */
body::after {
    content: '🎅 🎁 ⭐ 🔔 ❄️ 🎄 🎅 🎁 ⭐ 🔔';
    position: fixed;
    top: 0;
    left: 0;
    width: 200%;
    font-size: 30px;
    opacity: 0.15;
    animation: floatAcross 40s linear infinite;
    pointer-events: none;
    z-index: 1;
    letter-spacing: 100px;
}

@keyframes floatAcross {
    from {
        transform: translateX(-50%) translateY(-10vh) rotate(0deg);
    }
    to {
        transform: translateX(0%) translateY(110vh) rotate(360deg);
    }
}

.login-form {
    background: rgba(255, 255, 255, 0.95);
    padding: 60px 70px;
    border-radius: 30px;
    box-shadow: 
        0 30px 80px rgba(0, 0, 0, 0.3),
        0 0 0 1px rgba(255, 255, 255, 0.2),
        inset 0 0 60px rgba(255, 215, 0, 0.05);
    max-width: 500px;
    width: 100%;
    position: relative;
    z-index: 10;
    transform-style: preserve-3d;
    animation: formEntrance 1s ease-out;
}

@keyframes formEntrance {
    from {
        opacity: 0;
        transform: translateY(50px) rotateX(-15deg) scale(0.9);
    }
    to {
        opacity: 1;
        transform: translateY(0) rotateX(0) scale(1);
    }
}

.login-form::before {
    content: '🎄';
    position: absolute;
    top: -35px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 60px;
    animation: bounce 2s infinite ease-in-out;
    filter: drop-shadow(0 5px 15px rgba(67, 233, 123, 0.4));
}

.login-form::after {
    content: '';
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    background: linear-gradient(45deg, 
        #ff3b3b, 
        #ffd700, 
        #43e97b, 
        #fff,
        #ff3b3b);
    border-radius: 30px;
    z-index: -1;
    opacity: 0;
    animation: borderGlow 3s infinite;
    background-size: 300% 300%;
    animation: borderGlow 3s infinite, gradientShift 6s ease infinite;
}

@keyframes borderGlow {
    0%, 100% { opacity: 0; }
    50% { opacity: 0.7; }
}

@keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

@keyframes bounce {
    0%, 100% { transform: translateX(-50%) translateY(0) rotate(-5deg); }
    50% { transform: translateX(-50%) translateY(-15px) rotate(5deg); }
}

form {
    position: relative;
}

.alert {
    padding: 15px 20px;
    border-radius: 12px;
    margin-bottom: 25px;
    font-size: 14px;
    font-weight: 500;
    animation: slideDown 0.5s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.alert-success {
    background: linear-gradient(135deg, rgba(67, 233, 123, 0.2), rgba(67, 233, 123, 0.1));
    border: 2px solid #43e97b;
    color: #1a5d3a;
}

.alert-error {
    background: linear-gradient(135deg, rgba(255, 59, 59, 0.2), rgba(255, 59, 59, 0.1));
    border: 2px solid #ff3b3b;
    color: #8b0000;
}

.alert ul {
    margin: 0;
    padding-left: 20px;
}

.alert li {
    margin: 5px 0;
}

.form-group {
    margin-bottom: 30px;
    animation: slideIn 0.6s ease-out backwards;
}

.form-group:nth-child(2) { animation-delay: 0.1s; }
.form-group:nth-child(3) { animation-delay: 0.2s; }

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

label {
    display: block;
    margin-bottom: 10px;
    color: #2c5364;
    font-weight: 600;
    font-size: 15px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.input-wrapper {
    position: relative;
}

.input-wrapper::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 15px;
    width: 20px;
    height: 20px;
    transform: translateY(-50%);
    opacity: 0.4;
    transition: all 0.3s ease;
}

input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 16px 20px;
    border: 2px solid rgba(44, 83, 100, 0.2);
    border-radius: 15px;
    font-size: 16px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    background: rgba(255, 255, 255, 0.9);
    color: #2c5364;
}

input[type="email"]:focus,
input[type="password"]:focus {
    outline: none;
    border-color: #43e97b;
    background: #fff;
    box-shadow: 
        0 8px 25px rgba(67, 233, 123, 0.2),
        0 0 0 4px rgba(67, 233, 123, 0.1);
    transform: translateY(-2px);
}

input::placeholder {
    color: rgba(44, 83, 100, 0.5);
}

button[type="submit"] {
    width: 100%;
    padding: 18px;
    background: linear-gradient(135deg, #ff3b3b 0%, #ff6b6b 100%);
    color: white;
    border: none;
    border-radius: 15px;
    font-size: 18px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    text-transform: uppercase;
    letter-spacing: 1.5px;
    box-shadow: 0 10px 30px rgba(255, 59, 59, 0.4);
    position: relative;
    overflow: hidden;
    margin-top: 10px;
}

button[type="submit"]::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

button[type="submit"]:hover::before {
    width: 500px;
    height: 500px;
}

button[type="submit"]:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(255, 59, 59, 0.5);
}

button[type="submit"]:active {
    transform: translateY(-1px);
}

.signup-link-wrapper {
    text-align: center;
    margin-top: 30px;
    animation: fadeIn 1s ease-out 0.5s backwards;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.signup-link {
    color: #2c5364;
    text-decoration: none;
    font-weight: 600;
    font-size: 15px;
    transition: all 0.3s ease;
    display: inline-block;
    position: relative;
}

.signup-link::after {
    content: '';
    position: absolute;
    bottom: -3px;
    left: 0;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, #43e97b, #ffd700);
    transition: width 0.3s ease;
}

.signup-link:hover {
    color: #43e97b;
    transform: translateX(5px);
}

.signup-link:hover::after {
    width: 100%;
}

/* Decorative Stars */
.login-form form::before {
    content: '⭐';
    position: absolute;
    top: -15px;
    right: 30px;
    font-size: 25px;
    animation: twinkle 2s infinite ease-in-out;
}

.login-form form::after {
    content: '⭐';
    position: absolute;
    bottom: -15px;
    left: 30px;
    font-size: 25px;
    animation: twinkle 2s infinite ease-in-out 1s;
}

@keyframes twinkle {
    0%, 100% { opacity: 1; transform: scale(1) rotate(0deg); }
    50% { opacity: 0.5; transform: scale(1.2) rotate(180deg); }
}

@media (max-width: 768px) {
    .login-form {
        padding: 45px 35px;
    }
    
    body {
        padding: 10px;
    }
    
    .login-form::before {
        font-size: 45px;
        top: -25px;
    }
}

/* Snow particles */
.login-form:hover::before {
    animation: bounce 1s infinite ease-in-out, sparkle 0.5s ease-in-out;
}

@keyframes sparkle {
    0%, 100% { filter: drop-shadow(0 5px 15px rgba(67, 233, 123, 0.4)); }
    50% { filter: drop-shadow(0 5px 30px rgba(255, 215, 0, 0.8)); }
}
/* NAVBAR */
.navbar {
    width: 100%;
    background: linear-gradient(135deg, #c8102e 0%, #a00d24 100%);
    padding: 20px 60px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #fff;
    box-shadow: 0 8px 30px rgba(200, 16, 46, 0.4);
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
}

.nav-left,
.nav-right {
    display: flex;
    gap: 10px;
}

.nav-left a,
.nav-right a {
    margin: 0 15px;
    color: white;
    text-decoration: none;
    font-size: 16px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    position: relative;
    padding: 8px 16px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.nav-left a:hover,
.nav-right a:hover {
    background: rgba(255, 255, 255, 0.15);
    transform: translateY(-2px);
}

.nav-left a::before,
.nav-right a::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, #ffd700, #fff);
    transform: translateX(-50%);
    transition: width 0.3s ease;
}

.nav-left a:hover::before,
.nav-right a:hover::before {
    width: 80%;
}

</style>
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