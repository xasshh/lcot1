<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,">
    <title>Life College of Theology Abuja</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/governing-council.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/acred.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/gallery.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/history.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/payment.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/rector.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/reference.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/register.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/admin.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="contact-info">
                <span><i class="fas fa-clock"></i> Mon — Fri: 9am - 5pm</span>
                <span><i class="fas fa-envelope"></i> abujalifecollege@gmail.com</span>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header>
        <nav class="container">
            <div class="logo">
                <a href="{{ route('home') }}"><img src="{{ asset('frontend/images/head.png') }}" alt="Institution Logo"></a>
            </div>

            <div id="showMenu">
                <i class="fas fa-bars" id="showMenu"></i>
            </div>

            <div class="nav-links" id="navLinks">
                <div id="closeMenu">
                    <i class="fas fa-times" id="closeMenu"></i>
                </div>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="dropdown">
                        <a href="#">Introduction <i class="fas fa-chevron-down"></i></a>
                        <div class="dropdown-content">
                            <a href="{{ route('history') }}">Our History</a>
                         <a href="{{ route('mission-vision-values') }}">Mission./Vision./Values</a>
                            <a href="{{ route('acred') }}">Aff./Acred./Memb</a>
                            <a href="{{ route('gallery') }}">Gallery</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="#">Administration <i class="fas fa-chevron-down"></i></a>
                        <div class="dropdown-content">
                            <a href="{{ route('governingCouncil') }}">Governing Council</a>
                            <a href="{{ route('management') }}">Management Team</a>
                            <a href="{{ route('center') }}">Center Coordinators</a>
                            <a href="{{ route('faculty') }}">Faculty Members</a>
                            <a href="{{ route('nonTeachingStaff') }}">Non-Teaching Staff</a>
                        </div>
                    </li>
                    
                    <li class="dropdown">
                        <a href="#">Programmes <i class="fas fa-chevron-down"></i></a>
                        <div class="dropdown-content registration-menu">
                            <p class="programmes-heading">Programmes</p>
                            <div class="programmes-list">
                                <div class="programmes-group">
                                    <a href="#" class="programmes-group-toggle">Certificate Programs <i class="fas fa-chevron-down"></i></a>
                                    <div class="programmes-group-panel">
                                        <a href="#">Certificate in Music</a>
                                        <a href="#">Certificate in Christian Ministry</a>
                                    </div>
                                </div>
                                <div class="programmes-group">
                                    <a href="#" class="programmes-group-toggle">Diploma Programs <i class="fas fa-chevron-down"></i></a>
                                    <div class="programmes-group-panel">
                                        <a href="#">Diploma in music</a>
                                        <a href="#">Diploma in theology</a>
                                    </div>
                                </div>
                                <div class="programmes-group">
                                    <a href="#" class="programmes-group-toggle">Degree Programs <i class="fas fa-chevron-down"></i></a>
                                    <div class="programmes-group-panel">
                                        <a href="#">Bachelor of Theology (Summer)</a>
                                        <a href="#">Bachelor of Theology (Weekend)</a>
                                        <a href="#">Bachelor of Theology (Special Executive)</a>
                                        <a href="#">Bachelor of Theology (Day School)</a>
                                    </div>
                                </div>
                                <div class="programmes-group">
                                    <a href="#" class="programmes-group-toggle">Post-Graduate programs <i class="fas fa-chevron-down"></i></a>
                                    <div class="programmes-group-panel">
                                        <a href="#">Master of Theology (Missions)</a>
                                        <a href="#">Master of Theology (Biblical Studies)</a>
                                        <a href="#">Master of Theology (Pastoral Studies)</a>
                                        <a href="#">Master of Theology (Christian Education)</a>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('reference') }}">Reference Form</a>
                        </div>
                    </li>
                    <li><a href="#contact">FAQs</a></li>
                    @guest
                    <li><a href="{{ route('login') }}" class="login-btn">Student Login</a></li>
                    <li><a href="{{ route('admin.login') }}" class="login-btn space-left">Admin Login</a></li>
                @endguest
                
                @auth
                    <li><a href="{{ route('dashboard') }}" class="login-btn">Dashboard</a></li>
                @endauth
                                </ul>
            </div>
        </nav>
    </header>