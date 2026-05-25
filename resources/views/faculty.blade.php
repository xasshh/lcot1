@include('layouts.header') 
   <section class="page-hero">
    <div class="hero-content">
        <h1>Faculty Members</h1>
        <div class="breadcrumb">
            <a href="index.html">Home</a>
            <span class="separator">/</span>
            <a href="#">Administration</a>
            <span class="separator">/</span>
            <span class="current">Faculty Members</span>
        </div>
    </div>
</section>


<!-- Governing Council Members Section -->
<section class="council-members">
    <div class="container">
        <h2>The Faculty Members</h2>
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
                <img src="{{ asset('frontend/images/acad-dean.jpeg') }}" alt="Council Member Name">
                <h3>Rev. Dr. Mrs. Henrietta Emessiri</h3>
                <p>Academic Dean</p>
            </div>
            <div class="member-card" data-aos="fade-up" data-aos-delay="300">
                <img src=" {{ asset('frontend/images/student-affrs.jpeg') }}" alt="Council Member Name">
                <h3>Rev. Mrs. Hannah Rogho</h3>
                <p>Dean of Student Affairs</p>
            </div>

            <!-- Second Row -->
            <div class="member-card" data-aos="fade-up">
                <img src="{{ asset('frontend/images/center-coordinator.jpeg') }}" alt="Council Member Name">
                <h3>Pastor Barr. Julie N. Okorie</h3>
                <p>Center Coordinator</p>
            </div>
            <div class="member-card" data-aos="fade-up" data-aos-delay="100">
                <img src=" {{ asset('frontend/images/accountant.jpeg') }}" alt="Council Member Name">
                <h3>Rev. Babjide Abayomi Coker</h3>
                <p>Accountant</p>
            </div>
            <div class="member-card" data-aos="fade-up" data-aos-delay="200">
                <img src=" {{ asset('frontend/images/G&C.jpeg') }}" alt="Council Member Name">
                <h3>Pastor Mrs. Adeyeye Margaret Omowumi</h3>
                <p>Lecturer</p>
            </div>
            <div class="member-card" data-aos="fade-up" data-aos-delay="300">
                <img src=" {{ asset('frontend/images/lecturer-1.jpeg ') }}" alt="Council Member Name">
                <h3>Rev. Dr. Barr. (Mrs.) Gloria Ibikunle</h3>
                <p>Lecturer</p>
            </div>
            <!-- Third Row -->
            <div class="member-card" data-aos="fade-up">
                <img src=" {{ asset('frontend/images/lecturer-2.jpeg ') }}" alt="Council Member Name">
                <h3>Rev. Babatunde A. Idowu</h3>
                <p>Lecturer</p>
            </div>
            <div class="member-card" data-aos="fade-up" data-aos-delay="100">
                <img src=" {{ asset('frontend/images/lecturer-3.jpeg ') }}" alt="Council Member Name">
                <h3>Rev. Dr. Johnson M. O. Rogho</h3>
                <p>Lecturer</p>
            </div>
            <div class="member-card" data-aos="fade-up" data-aos-delay="200">
                <img src=" {{ asset('frontend/images/lecturer-4.jpeg ') }}" alt="Council Member Name">
                <h3>Pastor Barr. (Mrs.) Gift Okereke</h3>
                <p>Lecturer</p>
            </div>
            <div class="member-card" data-aos="fade-up" data-aos-delay="300">
                <img src="i {{ asset('frontend/images/lecturer-5.jpeg ') }}" alt="Council Member Name">
                <h3>Pastor Alabi Akinola</h3>
                <p>Lecturer</p>
            </div>
            <!-- Fourth Row -->
            <div class="member-card" data-aos="fade-up">
                <img src=" {{ asset('frontend/images/lecturer-6.jpeg ') }}" alt="Council Member Name">
                <h3>Rev. Dr. Raphael Nweke</h3>
                <p>Lecturer</p>
            </div>
            <div class="member-card" data-aos="fade-up" data-aos-delay="100">
                <img src=" {{ asset('frontend/images/lecturer-7.jpeg ') }}" alt="Council Member Name">
                <h3>Rev. Dr. Olayemi Toyin Segun</h3>
                <p>Lecturer</p>
            </div>
            <div class="member-card" data-aos="fade-up" data-aos-delay="200">
                <img src=" {{ asset('frontend/images/lecturer-8.jpeg ') }}" alt="Council Member Name">
                <h3>Rev. Akinyoade Tunji</h3>
                <p>Lecturer</p>
            </div>
            <div class="member-card" data-aos="fade-up" data-aos-delay="300">
                <img src=" {{ asset('frontend/images/lecturer-9.jpeg ') }}" alt="Council Member Name">
                <h3>Pastor Adetogun Adewuyi</h3>
                <p>Lecturer</p>
            </div>
            <!-- Fifth Row -->
            <div class="member-card" data-aos="fade-up">
                <img src="{{ asset('frontend/images/lecturer-10.jpeg ') }}" alt="Council Member Name">
                <h3>Rev. Izirien Tunde</h3>
                <p>Lecturer</p>
            </div>
            <div class="member-card" data-aos="fade-up" data-aos-delay="100">
                <img src=" {{ asset('frontend/images/lecturer-11.jpeg ') }}" alt="Council Member Name">
                <h3>Rev. Julius Oni</h3>
                <p>Lecturer</p>
            </div>
            <div class="member-card" data-aos="fade-up" data-aos-delay="200">
                <img src=" {{ asset('frontend/images/lecturer-12.jpeg ') }}" alt="Council Member Name">
                <h3>Bro. Ibrahim John Nigge</h3>
                <p>Lecturer</p>
            </div>
            <div class="member-card" data-aos="fade-up" data-aos-delay="300">
                <img src=" {{ asset('frontend/images/lecturer-13.jpeg ') }}" alt="Council Member Name">
                <h3>Bro Mmahi Chukwuka Okoro</h3>
                <p>Lecturer</p>
            </div>

            <!-- Sixth Row -->
            <div class="member-card" data-aos="fade-up">
                <img src=" {{ asset('frontend/images/lecturer-14.jpeg ') }} " alt="Council Member Name">
                <h3>Alade Samson O.</h3>
                <p>Lecturer</p>
            </div>
        </div>
    </div>
</section>
@include('layouts.footer')