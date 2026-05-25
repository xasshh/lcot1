@include('layouts.header') 

       <!-- Hero Section -->
       <section class="page-hero">
        <div class="hero-content">
            <h1>Management Team</h1>
            <div class="breadcrumb">
                <a href="index.html">Home</a>
                <span class="separator">/</span>
                <a href="#">Administration</a>
                <span class="separator">/</span>
                <span class="current">Team</span>
            </div>
        </div>
    </section>
    
    
    <!-- Governing Council Members Section -->
    <section class="council-members">
        <div class="container">
            <h2>The Management Team</h2>
            <div class="members-grid">
                <!-- First Row -->
                <div class="member-card" data-aos="fade-up">
                    <img src="{{ asset('frontend/images/rector.jpg') }}" alt="Council Member Name">
                    <h3>Rev. Kunle Ibikunle</h3>
                    <p>Rector</p>
                </div>
                <div class="member-card" data-aos="fade-up" data-aos-delay="100">
                    <img src=" {{ asset('frontend/images/registrar.jpeg') }}" alt="Council Member Name">
                    <h3>Pastor Mrs. Joyce O. Akaa</h3>
                    <p>Registrar</p>
                </div>
                <div class="member-card" data-aos="fade-up" data-aos-delay="200">
                    <img src=" {{ asset('frontend/images/acad-dean.jpeg') }}" alt="Council Member Name">
                    <h3>Rev. Dr. Mrs. Henrietta Emessiri</h3>
                    <p>Academic Dean</p>
                </div>
                <div class="member-card" data-aos="fade-up" data-aos-delay="300">
                    <img src=" {{ asset('frontend/images/student-affrs.jpeg') }} " alt="Council Member Name">
                    <h3>Rev. Mrs. Hannah Rogho</h3>
                    <p>Dean of Student Affairs</p>
                </div>
    
                <!-- Second Row -->
                <div class="member-card" data-aos="fade-up">
                    <img src="  {{ asset('frontend/images/center-coordinator.jpeg') }} " alt="Council Member Name">
                    <h3>Pastor Barr. Julie N. Okorie</h3>
                    <p>Center Coordinator</p>
                </div>
                <div class="member-card" data-aos="fade-up" data-aos-delay="100">
                    <img src=" {{ asset('frontend/images/accountant.jpeg ') }}" alt="Council Member Name">
                    <h3>Pastor Coker Abayomi</h3>
                    <p>Accountant</p>
                </div>
            </div>
        </div>
    </section>
    
    
@include('layouts.footer') 
