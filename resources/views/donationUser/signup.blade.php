<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Signup</title>

<link rel="stylesheet" href="{{ asset('css/signup.css') }}">

</head>
<body>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="{{ route('store') }}" method="post" enctype="multipart/form-data">
        <div class="form-content">
            @csrf
            <div class="input-group">
                <label for="fname">Full Name:</label>
                <input type="text" name="fname" id="fname" placeholder="Write your fullname" value="{{ old('fname') }}" required>
            </div>
            <br><br>
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="your.email@example.com" value="{{ old('email') }}" required>
            </div>
            <br><br>
            <div class="input-group">
                <label for="phone">Phone number:</label>
                <input type="phone" name="phone" id="phone" placeholder="1234567890" value="{{ old('phone') }}" required>
            </div>
            <br><br>
            <div class="input-group">
                <label for="gender">Gender:</label>
                <input type="radio" name="gender" id="male" value="male" required>Male
                <input type="radio" name="gender" id="female" value="female" required>Female
                <input type="radio" name="gender" id="other" value="other" required>Other
            </div>
            <br><br>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Create a strong password" required>
            </div>
            <br><br>
            <div class="input-group">
                <label for="password_confirmation">Re-Password:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm your password" required>
            </div>
            <br><br>
            <div class="input-group">
                <label for="date">Date of birth:</label>
                <input type="date" name="date" id="date" value="{{ old('date') }}" required>
            </div>
            <br><br>
            @if($errors->any())
            <div style="color:red;">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <button type="submit">Sign Up</button>
            <a href="{{ route('donationUser.login') }}" class="login-link">Already have an account? Login →</a>
        </div>
    </form>
    </body>
</html>