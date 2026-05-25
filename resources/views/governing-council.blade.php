@include('layouts.header') 
      <!-- Hero Section -->
<section class="page-hero">
    <div class="hero-content">
        <h1>Governing Council</h1>
        <div class="breadcrumb">
            <a href="index.html">Home</a>
            <span class="separator">/</span>
            <a href="#">Administration</a>
            <span class="separator">/</span>
            <span class="current">Council</span>
        </div>
    </div>
</section>


<!-- Governing Council Members Section -->
<section class="council-members">
    <div class="container">
        <h2>The Governing Council</h2>
        <div class="members-grid">
            <!-- First Row -->
            <div class="member-card" data-aos="fade-up">
                <img src="{{ asset('frontend/images/chairman.jpg') }}" alt="Council Member Name">
                <h3>Rev. Joseph Ameh</h3>
                <p>Chairman</p>
            </div>
            <div class="member-card" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset('frontend/images/vice-chairman.jpg') }}" alt="Council Member Name">
                <h3>Rev. Dr. Paul Fadayini</h3>
                <p>Vice Chairman</p>
            </div>
            <div class="member-card" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('frontend/images/provost.jpg') }}" alt="Council Member Name">
                <h3>Rev. Prof. Cletus C. Orgu</h3>
                <p>Provost</p>
            </div>
            <div class="member-card" data-aos="fade-up" data-aos-delay="300">
                <img src="{{ asset('frontend/images/rector.jpg') }}" alt="Council Member Name">
                <h3>Rev. Kunle Ibikunle</h3>
                <p>Rector - Abuja</p>
            </div>

            <!-- Second Row -->
            <div class="member-card" data-aos="fade-up">
                <img src="{{ asset('frontend/images/registrar-LIFE.jpg') }}" alt="Council Member Name">
                <h3>Rev. Dr. Delight Oyedeji</h3>
                <p>Registrar</p>
            </div>
            <div class="member-card" data-aos="fade-up" data-aos-delay="100">
                <img src=" {{ asset('frontend/images/National-directorr.png') }}" alt="Council Member Name">
                <h3>Rev. Joel Ogunsola</h3>
                <p>National Director C.E.</p>
            </div>
            <div class="member-card" data-aos="fade-up" data-aos-delay="200">
                <img src=" {{ asset('frontend/images/rector-aba.jpg') }} " alt="Council Member Name">
                <h3>Pastor Dr. Okore Kalu</h3>
                <p>Rector - Aba</p>
            </div>
            <div class="member-card" data-aos="fade-up" data-aos-delay="300">
                <img src=" {{ asset('frontend/images/faculty-rep.jpg ') }}" alt="Council Member Name">
                <h3>Rev. Dr. Dotun Akinsulire</h3>
                <p>Faculty Representative</p>
            </div>

            <!-- Third Row -->
            <div class="member-card" data-aos="fade-up">
                <img src=" {{ asset('frontend/images/alumni-president.jpg ') }}" alt="Council Member Name">
                <h3>Rev. Ajibola Jolaosho</h3>
                <p>Alumni President</p>
            </div>
            <div class="member-card" data-aos="fade-up" data-aos-delay="100">
                <img src=" {{ asset('frontend/images/member-1.jpg ') }}" alt="Council Member Name">
                <h3>Prof. Gladys Esiobu</h3>
                <p>Member</p>
            </div>
            <div class="member-card" data-aos="fade-up" data-aos-delay="200">
                <img src=" {{ asset('frontend/images/member-2.jpg  ') }}" alt="Council Member Name">
                <h3>Rev. Dr. Yinka Ologunsua</h3>
                <p>Member</p>
            </div>
        </div>
    </div>
</section>
@include('layouts.footer') 