@include('layouts.header')

<!-- Hero Section -->
<section class="page-hero">
    <div class="hero-content">
        <h1>Non-Teaching Staff</h1>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="separator">/</span>
            <a href="#">Administration</a>
            <span class="separator">/</span>
            <span class="current">Non-Teaching</span>
        </div>
    </div>
</section>

<!-- Non-Teaching Staff Section -->
<section class="council-members">
    <div class="container">
        <h2>The Non-Teaching Staffs</h2>
        <div class="members-grid">
            <div class="member-card" data-aos="fade-up">
                <img src="{{ asset('frontend/images/non-teaching-1.jpeg') }}" alt="Staff Member">
                <h3>Sis. Faloye Oyeyemi</h3>
                <p>Secretary</p>
            </div>
            <div class="member-card" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset('frontend/images/accountant.jpeg') }}" alt="Staff Member">
                <h3>Rev. Babjide Abayomi Coker</h3>
                <p>Accountant</p>
            </div>
            <div class="member-card" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('frontend/images/Omotoso Ebenezer A.JPG') }}" alt="Staff Member">
                <h3>Omotoso Ebenezer A.</h3>
                <p>I.C.T Head</p>
            </div>
            <div class="member-card" data-aos="fade-up" data-aos-delay="300">
                <img src="{{ asset("frontend/images/rector's-driver.jpeg") }}" alt="Staff Member">
                <h3>Pastor Ogar Francis</h3>
                <p>Rector's Driver</p>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
