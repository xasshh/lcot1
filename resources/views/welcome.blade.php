
    {{-- <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header> --}}
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0,">
            <title>Life College of Theology Abuja</title>
            <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
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
                            <a href="">Governing Council</a>
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
                                        <a href="{{ route('reference') }}" class="menu-item">Reference Form</a>
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
                </nav>
            </header>
        
            <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1>Welcome to LIFE College of Theology, Abuja</h1>
                <h3>A Place To Study To Show Yourself Approved.</h3>
                <a href="history.html" class="explore-btn">Explore</a>
            </div>
        </section>
        
            <!-- Programs Section -->
            <section class="programs" id="programs">
                <h2>Our Programs</h2>
                <p class="section-description">Discover our comprehensive range of theological programs</p>
                <div class="programs-grid">
                    <div class="program-card">
                        <i class="fas fa-graduation-cap"></i>
                        <h3>Certificate in Christian Ministry. CCM </h3>
                        <p>6-month specialized program in church leadership and administration</p>
                    </div>
                    <div class="program-card">
                        <i class="fas fa-church"></i>
                        <h3>Diploma in Theology. Dip.Th</h3>
                        <p> 1-year short-term biblical and theological program</p>
                    </div>
                    <div class="program-card">
                        <i class="fas fa-book-bible"></i>
                        <h3>Bachelor of Theology. B.Th</h3>
                        <p>4-year comprehensive program in biblical studies and theology</p>
                    </div>
                    <div class="program-card">
                        <i class="fas fa-certificate"></i>
                        <h3>Masters in Theology. M.Th</h3>
                        <p>18 months practical ministry training program</p>
                    </div>
                    
                </div>
            </section>
        
            <!-- Executive Staff Section -->
        <section class="executive-staff">
            <h2>Our Management Staff</h2>
            <p>Meet our dedicated leadership team</p>
            
            <div class="staff-container">
                <div class="staff-card">
                    <div class="staff-image">
                        <img src="{{ asset('frontend/images/rector.jpg') }}" alt="Rector">
                    </div>
                    <div class="staff-info">
                        <h3>Rev. Dr. Kunle Ibikunle</h3>
                        <span class="role">Rector</span>
                    </div>
                </div>
        
                <div class="staff-card">
                    <div class="staff-image">
                        <img src="{{ asset('frontend/images/registrar.jpeg') }}" alt="Academic Dean">
                    </div>
                    <div class="staff-info">
                        <h3>Pastor Mrs. Joyce O. Akaa</h3>
                        <span class="role">Registrar</span>
                    </div>
                </div>
        
                <div class="staff-card">
                    <div class="staff-image">
                        <img src="{{ asset('frontend/images/acad-dean.jpeg') }}" alt="Registrar">
                    </div>
                    <div class="staff-info">
                        <h3> Rev. Dr. Mrs. Henrietta Emessiri</h3>
                        <span class="role">Academic Dean</span>
                    </div>
                </div>
        
                <div class="staff-card">
                    <div class="staff-image">
                        <img src="{{ asset('frontend/images/student-affrs.jpeg') }}" alt="Dean of Student Affairs">
                    </div>
                    <div class="staff-info">
                        <h3>Rev. Mrs. Hannah Rogho</h3>
                        <span class="role">Dean of Student Affairs</span>
        
                    </div>
                </div>
                <div class="staff-card">
                    <div class="staff-image">
                        <img src="{{ asset('frontend/images/accountant.jpeg') }}" alt="Dean of Student Affairs">
                    </div>
                    <div class="staff-info">
                        <h3>Rev. Babajide Abayomi Coker</h3>
                        <span class="role">Accountant</span>
        
                    </div>
                </div>
                <div class="staff-card">
                    <div class="staff-image">
                        <img src="{{ asset('frontend/images/center-coordinator.jpeg') }}" alt="Dean of Student Affairs">
                    </div>
                    <div class="staff-info">
                        <h3>Pastor. Barr. Julie N. Okorie</h3>
                        <span class="role">General Center Coordinator</span>
        
                    </div>
                </div>
            </div>
        </section>
        
        
            <!-- Stats Counter Section -->
            <section class="stats">
                <div class="stats-container">
                    <div class="stat-item">
                        <span class="counter" data-target="100">0</span>
                        <span class="plus">+</span>
                        <p>Students</p>
                    </div>
                    <div class="stat-item">
                        <span class="counter" data-target="21">0</span>
                        <span class="plus">+</span>
                        <p>Faculty Members</p>
                    </div>
                    <div class="stat-item">
                        <span class="counter" data-target="400">0</span>
                        <span class="plus">+</span>
                        <p>Alumni</p>
                    </div>
                    <div class="stat-item">
                        <span class="counter" data-target="27">0</span>
                        <p>Years of Excellence</p>
                    </div>
                </div>
            </section>
        
        
        
            <!-- Testimonials Section -->
            <section class="testimonials">
                <div class="section-title">
                    <h2>TESTIMONIAL</h2>
                    <h1>Our Graduates Say!</h1>
                </div>
                
                <div class="testimonial-container">
                    <div class="testimonial-card">
                        <div class="testimonial-img">
                            <img src="{{ asset('frontend/images/testimonial1.jpg') }}" alt="Testimonial">
                        </div>
                        <h3>Student Name</h3>
                        <p class="role">Program taken</p>
                        <p class="quote">Testimonial</p>
                    </div>
        
                    <div class="testimonial-card">
                        <div class="testimonial-img">
                            <img src="{{ asset('frontend/images/testimonial2.jpg') }}" alt="Testimonial">
                        </div>
                        <h3>Student Name</h3>
                        <p class="role">Program taken</p>
                        <p class="quote">Testimonial</p>
                    </div>
        
                    <div class="testimonial-card">
                        <div class="testimonial-img">
                            <img src="{{ asset('frontend/images/testimonial3.jpg') }}" alt="Testimonial">
                        </div>
                        <h3>Student Name</h3>
                        <p class="role">Program taken</p>
                        <p class="quote">Testimonial</p>
                    </div>
                </div>
            </section>
        
            <!-- Footer -->
            <footer class="footer">
                <div class="footer-content">
                    <div class="footer-section">
                        <h3>Contact Us</h3>
                        <p><i class="fas fa-map-marker-alt"></i>Foursquare Gospel Church, Behind Government Secondary School, Area 10, Garki, Abuja</p>
                        <p><i class="fas fa-phone"></i> +234 813 451 8174</p>
                        <p><i class="fas fa-envelope"></i> abujalifecollege@gmail.com</p>
                    </div>
                    <div class="footer-section">
                        <h3>Quick Links</h3>
                        <ul>
                            <li><i class="fas fa-chevron-right"></i><a href="admission.html"></i>Admission</a></li>
                            <li><i class="fas fa-chevron-right"></i><a href="faculty.html">Faculty</a></li>
                            <li><i class="fas fa-chevron-right"></i><a href="library.html">Library</a></li>
                            <li><i class="fas fa-chevron-right"></i><a href="news.html">News</a></li>
                        </ul>
                    </div>
                    <div class="footer-section">
                        <h3>Connect With Us</h3>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="footer-bottom-content">
                        <div class="copyright">
                            &copy; 2025 Life College of Theology. All rights reserved.
                        </div>
                        <div class="designer">
                            Designed by <a href="#">Emerging Ways Global</a>
                        </div>
                    </div>
                </div>
            </footer>
        
            <script src="{{ asset('frontend/js/script.js') }}"></script>
            <!-- Scroll to Top Button -->
        <button id="scrollToTop" class="scroll-to-top">
            <i class="fas fa-arrow-up"></i>
        </button>
        
        </body>
        </html>