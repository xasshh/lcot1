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
                <a href="index.html"><img src="{{ asset('frontend/images/head.png') }}" alt="Institution Logo"></a>
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
                            <a href="{{ route('acred') }}">Aff./Acred./Memb</a>
                            <a href="{{ route('gallery') }}">Gallery</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="#">Administration <i class="fas fa-chevron-down"></i></a>
                        <div class="dropdown-content">
                            <a href="{{ route('rectorsDesk') }}">From the Rector's Desk</a>
                            <a href="{{ route('governingCouncil') }}">Governing Council</a>
                            <a href="{{ route('management') }}">Management Team</a>
                            <a href="{{ route('center') }}">Center Coordinators</a>
                            <a href="{{ route('faculty') }}">Faculty Members</a>
                            <a href="{{ route('nonTeachingStaff') }}">Non-Teaching Staff</a>
                        </div>
                    </li>
                    
                    <li class="dropdown">
                        <a href="#">Registration <i class="fas fa-chevron-down"></i></a>
                        <div class="dropdown-content registration-menu">
                            <a href="#" class="menu-item">How To Apply</a>
                            
                            <div class="program-section">
                                <h4>Our Programmes (scroll down to view more):</h4>
                                
                                <div class="program-category">
                                    <h5 class="program-title">Executive</h5>
                                    <ul>
                                        <li><a href="#">Bachelor of Theology</a></li>
                                        <li><a href="#">Master of Art in Theology</a></li>
                                    </ul>
                                </div>
                    
                                <div class="program-category">
                                    <h5 class="program-title">Full-Time - Undergraduate</h5>
                                    <ul>
                                        <li><a href="#">Bachelor of Theology</a></li>
                                        <li><a href="#">Certificate in Music</a></li>
                                        <li><a href="#">Diploma in Music</a></li>
                                        <li><a href="#">Diploma in Theology</a></li>
                                    </ul>
                                </div>
                    
                                <div class="program-category">
                                    <h5 class="program-title">Full-Time - Post Graduate</h5>
                                    <ul>
                                        <li><a href="#">Master of Art in Theology</a></li>
                                        <li><a href="#">Doctor of Ministry</a></li>
                                        <li><a href="#">Doctor of Philosophy</a></li>
                                    </ul>
                                </div>
                                <a href="reference.html" class="menu-item">Reference Form</a>
                            </div>
                    
                            
                        </div>
                    </li>
                    <li><a href="#contact">FAQs</a></li>
                    @guest
                    <li><a href="{{ route('login') }}" class="login-btn">Login</a></li>
                    <li><a href="{{ route('admin.login') }}" class="login-btn space-left">Admin Login</a></li>
                @endguest
                
                @auth
                    <li><a href="{{ route('dashboard') }}" class="login-btn">Dashboard</a></li>
                @endauth
                                </ul>
            </div>
            <i class="fas fa-bars" id="showMenu"></i>
        </nav>
    </header>