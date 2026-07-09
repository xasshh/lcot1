@include('layouts.header')

<!-- Hero Section -->
<section class="hero">
    <!-- Background slideshow layer -->
    <div class="hero-slideshow">
        <div class="hero-slides">
            <div class="hero-slide" style="background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url('{{ asset('frontend/images/homepage-bg1.jpeg') }}')"></div>
            <div class="hero-slide" style="background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url('{{ asset('frontend/images/header.jpeg') }}')"></div>
            <div class="hero-slide" style="background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url('{{ asset('frontend/images/homepage-bg2.jpeg') }}')"></div>
            <div class="hero-slide" style="background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url('{{ asset('frontend/images/homepage-bg5.jpeg') }}')"></div>
            <div class="hero-slide" style="background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url('{{ asset('frontend/images/homepage-bg3.jpeg') }}')"></div>
            <div class="hero-slide" style="background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url('{{ asset('frontend/images/homepage-bg6.jpeg') }}')"></div>
            <div class="hero-slide" style="background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url('{{ asset('frontend/images/homepage-bg4.jpeg') }}')"></div>
            <div class="hero-slide" style="background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url('{{ asset('frontend/images/homepage-bg7.jpeg') }}')"></div>
            <div class="hero-slide" style="background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url('{{ asset('frontend/images/homepage-bg8.jpeg') }}')"></div>
        </div>
    </div>

    <!-- Navigation arrows -->
    <button class="hero-arrow hero-arrow-left" id="heroPrev" aria-label="Previous slide">
        <i class="fas fa-chevron-left"></i>
    </button>
    <button class="hero-arrow hero-arrow-right" id="heroNext" aria-label="Next slide">
        <i class="fas fa-chevron-right"></i>
    </button>
</section>

<!-- Programs Section -->
<section class="programs" id="programs">
    <h2>Our Programs</h2>
    <p class="section-description">Discover our comprehensive range of theological programs</p>
    <div class="programs-grid">
        <div class="program-card">
            <i class="fas fa-graduation-cap"></i>
            <h3>Certificate in Christian Ministry. CCM</h3>
            <p>6-month specialized program in church leadership and administration</p>
        </div>
        <div class="program-card">
            <i class="fas fa-church"></i>
            <h3>Diploma in Theology. Dip.Th</h3>
            <p>1-year short-term biblical and theological program</p>
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

    <!-- Rector's Desk Section -->
    <section class="rectors-desk">
        <div class="container">
            <h1>The Rector's Desk</h1>
            <div class="rector-content">
                <div class="rector-image">
                    <img src="{{ asset('frontend/images/rector.jpg') }}" alt="Rev. Dr. Kunle Ibikunle">
                </div>
                <div class="rector-message">
                    <p>It is my great pleasure and honour to welcome you to LIFE College of Theology, Abuja. 'A place where to Study Yourself Approved, A workman that needed not to be Ashamed of God's calling.'</p>
                    <p>LIFE College of Theology, Abuja came on board in 1998, to train Kingdom workers particularly for the Kingdom work in the Northern part of our country Nigeria. Since then, great numbers of Certificate in Christian Ministry (CCM), Diploma in Theology (Dip.Th), Bachelor in Theology (B.Th) and Masters in Theology (M.Th) graduates have been turned out to back up the needed workforce in the Kingdom business of our Lord Jesus Christ. </p>
                    <p>In LIFE Abuja, we have the passion, love and interest to support and assist with the training required for everyone with the call of God upon their lives, to find fulfillments, realisation and rest for such a call, not just a call as a Pastor, but also a call as a worker called into various Kingdom work of God's Business.</p>
                    <p>We are in the age of effectiveness and efficiency, and the work in God's Kingdom must not be left out. Therefore those who must be engaged in the work of the Kingdom must be properly trained and bred to bring the desired turnaround to God's business of bringing people into Salvation and in making Christians live a fulfilled life. </p>
                    <p>Therefore join us, and make your calling and ministry count as we welcome you into LIFE College of Theology, Abuja in the name of the Father, Son and the Holy Spirit. </p>
                    <p>God bless you.</p>
                    
                    
                    <div class="rector-signature">
                        <p>In His Service,</p>
                        <h4>Rev. Dr. Kunle Ibikunle</h4>
                        <p>Rector, Life College of Theology Abuja</p>
                    </div>
                </div>
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
                <img src="{{ asset('frontend/images/registrar.jpeg') }}" alt="Registrar">
            </div>
            <div class="staff-info">
                <h3>Pastor Mrs. Joyce O. Akaa</h3>
                <span class="role">Registrar</span>
            </div>
        </div>

        <div class="staff-card">
            <div class="staff-image">
                <img src="{{ asset('frontend/images/acad-dean.jpeg') }}" alt="Academic Dean">
            </div>
            <div class="staff-info">
                <h3>Rev. Dr. Mrs. Henrietta Emessiri</h3>
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
                <img src="{{ asset('frontend/images/accountant.jpeg') }}" alt="Accountant">
            </div>
            <div class="staff-info">
                <h3>Rev. Babajide Abayomi Coker</h3>
                <span class="role">Accountant</span>
            </div>
        </div>

        <div class="staff-card">
            <div class="staff-image">
                <img src="{{ asset('frontend/images/center-coordinator.jpeg') }}" alt="General Center Coordinator">
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



@include('layouts.footer')
