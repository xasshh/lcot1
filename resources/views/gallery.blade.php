@include('layouts.header')
  <!-- Hero Section -->
  <section class="page-hero">
    <div class="hero-content">
        <h1>Gallery</h1>
        <div class="breadcrumb">
            <a href="index.html">Home</a>
            <span class="separator">/</span>
            <a href="#">Introduction</a>
            <span class="separator">/</span>
            <span class="current">Gallery</span>
        </div>
    </div>
</section>

<section class="gallery">
    <h2 class="gallery-title">Our Gallery</h2>
    <div class="gallery-grid">
        <div class="gallery-item">
            <img src=" {{ asset('frontend/images/gallery/gallery1.jpeg ') }}" alt="Gallery Image 1">
        </div>
        <div class="gallery-item">
            <img src="{{ asset('frontend/images/gallery/gallery2.jpeg ') }}" alt="Gallery Image 2">
        </div>
        <div class="gallery-item">
            <img src="{{ asset('frontend/images/gallery/gallery3.jpeg ') }}" alt="Gallery Image 3">
        </div>
        <div class="gallery-item">
            <img src="{{ asset('frontend/images/gallery/gallery3.jpeg ') }}" alt="Gallery Image 3">
        </div>
        <div class="gallery-item">
            <img src="{{ asset('frontend/images/gallery/gallery3.jpeg ') }}" alt="Gallery Image 3">
        </div>
        <div class="gallery-item">
            <img src="{{ asset('frontend/images/gallery/gallery3.jpeg ') }}" alt="Gallery Image 3">
        </div>
        <div class="gallery-item">
            <img src="{{ asset('frontend/images/gallery/gallery3.jpeg ') }}" alt="Gallery Image 3">
        </div>
        <!-- Add more images as needed -->
    </div>
    <div class="gallery-grid">
        <div class="gallery-item">
            <img src="{{ asset('frontend/images/gallery/gallery1.jpeg ') }}" alt="Gallery Image 1">
        </div>
        <div class="gallery-item">
            <img src="{{ asset('frontend/images/gallery/gallery2.jpeg ') }}" alt="Gallery Image 2">
        </div>
        <div class="gallery-item">
            <img src="{{ asset('frontend/images/gallery/gallery3.jpeg ') }}" alt="Gallery Image 3">
        </div>
        <div class="gallery-item">
            <img src="{{ asset('frontend/images/gallery/gallery3.jpeg ') }}" alt="Gallery Image 3">
        </div>
        <div class="gallery-item">
            <img src="{{ asset('frontend/images/gallery/gallery3.jpeg ') }}" alt="Gallery Image 3">
        </div>
        <div class="gallery-item">
            <img src="{{ asset('frontend/images/gallery/gallery3.jpeg ') }}" alt="Gallery Image 3">
        </div>
        <div class="gallery-item">
            <img src="{{ asset('frontend/images/gallery/gallery3.jpeg ') }}" alt="Gallery Image 3">
        </div>
        <!-- Add more images as needed -->
    </div>
</section>

@include('layouts.footer') 