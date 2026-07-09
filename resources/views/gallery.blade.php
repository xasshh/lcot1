@include('layouts.header')

<!-- Hero Section -->
<section class="page-hero">
    <div class="hero-content">
        <h1>Gallery</h1>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="separator">/</span>
            <a href="#">Introduction</a>
            <span class="separator">/</span>
            <span class="current">Gallery</span>
        </div>
    </div>
</section>

@php
    // Sections mirror public/frontend/gallery.html (the design source).
    $img = fn (string $prefix, int $count) => array_map(fn ($i) => "{$prefix}{$i}.jpeg", range(1, $count));
    $gallerySections = [
        ['title' => 'Inauguration of Kuje CCM Study Center', 'subtitle' => '16th May, 2026', 'images' => $img('kuje', 5)],
        ['title' => 'Inauguration of Gwagwalada B.TH Study Center', 'subtitle' => '16th May, 2026', 'images' => $img('gwagwalada', 4)],
        ['title' => 'The Opening of our New Campus for Academic use', 'subtitle' => '25th April, 2026 by Rev. Dr. Johnson Rogho', 'images' => $img('newcampus', 9)],
        ['title' => "Taking the students of the Executive B.Th and the Master's M.th round the new campus", 'subtitle' => 'Accompanied by the Rector, Rev. Dr. Kunle Ibikunle', 'images' => array_map(fn ($i) => "newcampus{$i}.jpeg", range(10, 25))],
        ['title' => 'The 2025 CCM Graduating Class being lectured', 'subtitle' => 'By Rev. Prof. James Jacob', 'images' => $img('ccmgraduating', 3)],
        ['title' => 'October 2025 Graduation Ceremony at the Permanent Campus Site', 'subtitle' => 'ACO Estate, Lugbe, Abuja.', 'images' => $img('graduating', 33)],
        ['title' => 'Inauguration of Wuse CCM Study Center', 'subtitle' => '23rd January, 2025', 'images' => $img('wuseccm', 3)],
        ['title' => 'Inauguration of Gidanmangoro CCM Study Center', 'subtitle' => '2nd August, 2025', 'images' => $img('gidanmangoroccm', 4)],
        ['title' => 'Inauguration of Lugbe CCM Study Center', 'subtitle' => '2nd May, 2025', 'images' => $img('lugbeccm', 4)],
        ['title' => 'Inauguration of Akwanga CCM Study Center', 'subtitle' => '29th June, 2025', 'images' => $img('akwangaccm', 4)],
        ['title' => 'Inauguration of Nyanya B.TH Study Center', 'subtitle' => '2nd June, 2024', 'images' => $img('nyanyabth', 3)],
        ['title' => 'Project Defense for Minna B.th Study Center Students', 'subtitle' => '27th August, 2025', 'images' => ['minnabth.jpeg']],
        ['title' => 'Inauguration of Asokoro CCM Study Center', 'subtitle' => null, 'images' => $img('asokoroccm', 2)],
        ['title' => 'Inauguration of Kubwa B.TH Study Center', 'subtitle' => null, 'images' => $img('kubwabth', 2)],
    ];
@endphp

<section class="gallery">
    <p class="gallery-intro">Explore moments from LIFE College of Theology, Abuja — campus life, graduations, conferences, and ministry events.</p>

    @foreach($gallerySections as $section)
        <div class="gallery-grid">
            <div class="gallery-caption">
                <h3>{{ $section['title'] }}</h3>
                @if($section['subtitle'])
                    <p>{{ $section['subtitle'] }}</p>
                @endif
            </div>
            <div class="gallery-items">
                @foreach($section['images'] as $image)
                    <div class="gallery-item"><img src="{{ asset('frontend/images/gallery/' . $image) }}" alt="{{ $section['title'] }}" loading="lazy"></div>
                @endforeach
            </div>
        </div>
    @endforeach
</section>

@include('layouts.footer')
