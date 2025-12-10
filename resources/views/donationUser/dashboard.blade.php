<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Christmas Donation</title>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
    min-height: 100vh;
    position: relative;
    overflow-x: hidden;
}

body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: 
        radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
    pointer-events: none;
    animation: shimmer 8s ease-in-out infinite;
    z-index: 1;
}

@keyframes shimmer {
    0%, 100% { opacity: 0.3; }
    50% { opacity: 0.7; }
}

/* Snowfall Effect */
body::after {
    content: '❄️ ❄️ ❄️ ❄️ ❄️ ❄️ ❄️ ❄️ ❄️ ❄️ ❄️ ❄️';
    position: fixed;
    top: -10%;
    left: -10%;
    width: 120%;
    font-size: 25px;
    color: rgba(255, 255, 255, 0.6);
    animation: snowfall 20s linear infinite;
    pointer-events: none;
    letter-spacing: 120px;
    z-index: 2;
}

@keyframes snowfall {
    0% {
        transform: translateY(-10vh) translateX(0) rotate(0deg);
        opacity: 1;
    }
    100% {
        transform: translateY(110vh) translateX(50px) rotate(360deg);
        opacity: 0.3;
    }
}

/* Navbar */
.navbar {
    width: 100%;
    background: linear-gradient(135deg, #c8102e 0%, #a00d24 100%);
    padding: 20px 60px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #fff;
    box-shadow: 0 8px 30px rgba(200, 16, 46, 0.4);
    position: relative;
    z-index: 100;
    animation: slideDown 0.8s ease-out;
}

@keyframes slideDown {
    from {
        transform: translateY(-100%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.navbar::before {
    content: '🎄';
    position: absolute;
    left: 20px;
    font-size: 30px;
    animation: bounce 2s infinite ease-in-out;
}

.navbar::after {
    content: '🎅';
    position: absolute;
    right: 20px;
    font-size: 30px;
    animation: wave 2s infinite ease-in-out;
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

@keyframes wave {
    0%, 100% { transform: rotate(0deg); }
    25% { transform: rotate(20deg); }
    75% { transform: rotate(-20deg); }
}

.nav-left,
.nav-right {
    display: flex;
    gap: 10px;
    z-index: 10;
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

.nav-left a:hover,
.nav-right a:hover {
    background: rgba(255, 255, 255, 0.15);
    transform: translateY(-2px);
}

.nav-left a:hover::before,
.nav-right a:hover::before {
    width: 80%;
}

/* Hero Section */
.hero {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 80px 80px;
    position: relative;
    z-index: 10;
    gap: 60px;
}

.hero::before {
    content: '⭐';
    position: absolute;
    top: 50px;
    left: 10%;
    font-size: 40px;
    animation: twinkle 3s infinite ease-in-out;
}

.hero::after {
    content: '🎁';
    position: absolute;
    bottom: 50px;
    right: 10%;
    font-size: 40px;
    animation: float 4s infinite ease-in-out;
}

@keyframes twinkle {
    0%, 100% { opacity: 1; transform: scale(1) rotate(0deg); }
    50% { opacity: 0.4; transform: scale(1.3) rotate(180deg); }
}

@keyframes float {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(10deg); }
}

.hero-text {
    width: 50%;
    animation: slideInLeft 1s ease-out;
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-100px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.hero-text h1 {
    font-size: 56px;
    background: linear-gradient(135deg, #ff3b3b, #ffd700, #43e97b);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 30px;
    font-weight: 900;
    line-height: 1.2;
    text-shadow: 0 4px 20px rgba(255, 59, 59, 0.3);
    animation: textGlow 3s ease-in-out infinite;
}

@keyframes textGlow {
    0%, 100% { 
        filter: drop-shadow(0 0 10px rgba(255, 215, 0, 0.5));
    }
    50% { 
        filter: drop-shadow(0 0 25px rgba(255, 215, 0, 0.8));
    }
}

.hero-text p {
    font-size: 18px;
    color: rgba(255, 255, 255, 0.9);
    line-height: 1.8;
    margin-bottom: 25px;
    background: rgba(255, 255, 255, 0.05);
    padding: 20px;
    border-radius: 15px;
    border-left: 4px solid #ffd700;
    backdrop-filter: blur(10px);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
    animation: fadeInUp 1s ease-out backwards;
}

.hero-text p:nth-of-type(1) {
    animation-delay: 0.3s;
}

.hero-text p:nth-of-type(2) {
    animation-delay: 0.5s;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.hero-img {
    width: 45%;
    animation: slideInRight 1s ease-out;
    position: relative;
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(100px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.hero-img::before {
    content: '';
    position: absolute;
    top: -15px;
    left: -15px;
    right: -15px;
    bottom: -15px;
    background: linear-gradient(45deg, #ff3b3b, #ffd700, #43e97b, #fff);
    border-radius: 20px;
    z-index: -1;
    opacity: 0.6;
    animation: borderRotate 4s linear infinite;
}

@keyframes borderRotate {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* IMAGE WRAPPER */
.hero-img {
    width: 45%;
    position: relative;
    animation: fadeIn 1.2s ease-in-out;
}

/* BORDER GLOW */
.hero-img::before {
    content: '';
    position: absolute;
    top: -12px;
    left: -12px;
    right: -12px;
    bottom: -12px;
    background: linear-gradient(45deg, #ff3b3b, #ffd700, #43e97b, #ffffff);
    border-radius: 18px;
    z-index: -1;
    opacity: 0.65;
    animation: rotateBorder 4s linear infinite;
}

@keyframes rotateBorder {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* IMAGE ITSELF */
.hero-img img {
    width: 100%;
    height: auto;
    object-fit: cover;
    border-radius: 18px;
    box-shadow: 
        0 20px 60px rgba(0, 0, 0, 0.45),
        0 0 40px rgba(255, 215, 0, 0.35);
    transition: 0.4s ease;
}

/* HOVER EFFECT */
.hero-img:hover img {
    transform: scale(1.05) translateY(-8px);
    box-shadow: 
        0 30px 75px rgba(0, 0, 0, 0.55),
        0 0 60px rgba(255, 215, 0, 0.55);
}

/* Mobile Responsive */
@media (max-width: 850px) {
    .hero-img {
        width: 100%;
    }
}


/* Decorative Lights */
.navbar {
    border-bottom: 3px solid transparent;
    border-image: linear-gradient(90deg, 
        #ff3b3b 0%, 
        #ffd700 25%, 
        #43e97b 50%, 
        #ffd700 75%, 
        #ff3b3b 100%);
    border-image-slice: 1;
    animation: lightsAnimation 3s linear infinite;
}

@keyframes lightsAnimation {
    0% { border-image-source: linear-gradient(90deg, #ff3b3b 0%, #ffd700 25%, #43e97b 50%, #ffd700 75%, #ff3b3b 100%); }
    25% { border-image-source: linear-gradient(90deg, #ffd700 0%, #43e97b 25%, #ff3b3b 50%, #43e97b 75%, #ffd700 100%); }
    50% { border-image-source: linear-gradient(90deg, #43e97b 0%, #ff3b3b 25%, #ffd700 50%, #ff3b3b 75%, #43e97b 100%); }
    75% { border-image-source: linear-gradient(90deg, #ffd700 0%, #43e97b 25%, #ff3b3b 50%, #43e97b 75%, #ffd700 100%); }
    100% { border-image-source: linear-gradient(90deg, #ff3b3b 0%, #ffd700 25%, #43e97b 50%, #ffd700 75%, #ff3b3b 100%); }
}

/* Responsive */
@media(max-width: 850px) {
    .navbar {
        padding: 15px 30px;
        flex-direction: column;
        gap: 15px;
    }
    
    .navbar::before,
    .navbar::after {
        position: relative;
        left: 0;
        right: 0;
    }
    
    .nav-left,
    .nav-right {
        flex-direction: column;
        align-items: center;
        gap: 5px;
    }
    
    .hero {
        flex-direction: column;
        text-align: center;
        padding: 50px 30px;
        gap: 40px;
    }
    
    .hero-text, 
    .hero-img {
        width: 100%;
    }
    
    .hero-text h1 {
        font-size: 42px;
    }
    
    .hero-text p {
        font-size: 16px;
    }
    
    .hero::before,
    .hero::after {
        font-size: 30px;
    }
}

@media(max-width: 480px) {
    .hero-text h1 {
        font-size: 32px;
    }
    
    .navbar {
        padding: 15px 20px;
    }
    
    .hero {
        padding: 40px 20px;
    }
}
</style>
</head>
<body>
<div class="navbar">
<div class="nav-left">
<a href="/dashboard">Home</a>
<a href="/campaigns">All Campaigns</a>
</div>
<div class="nav-right">
<a href="{{ route('logout') }}">Logout</a>
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const logoutLink = document.querySelector('a[href="{{ route('logout') }}"]');

        if (logoutLink) {
            logoutLink.addEventListener("click", function (e) {
                if (!confirm("Are you sure you want to logout?")) {
                    e.preventDefault();
                }
            });
        }
    });
</script>

</html>