
@extends('layouts.webSite')
@section('title', 'Product details')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.2/css/lightgallery-bundle.min.css" />


<div class="project-banner">
    <div class="banner-image">
        <img src="{{ asset($projectDetails->banner_image ?? ($projectDetails->image ?? 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?ixlib=rb-4.0.3&auto=format&fit=cover&w=2000&q=80')) }}"
            alt="{{ $projectDetails->project_name ?? 'Project' }}">
        <div class="banner-overlay">
            <div class="banner-content">
                <nav class="breadcrumb-nav">
                    <a href="{{ url('/') }}">Home</a>
                    <span class="separator">/</span>
                    <a href="{{ route('productPage') }}">Project</a>
                    <span class="separator">/</span>
                    <span class="current">{{ $projectDetails->project_name ?? 'Project Details' }}</span>
                </nav>
                <h1 class="banner-title">{{ $projectDetails->project_name ?? 'Project Details' }}</h1>
            </div>
        </div>
    </div>
</div>
<style>
    .breadcrumb-nav,
.banner-title {
    display: block;
}

/* Hide on small devices (max-width 600px) */
@media (max-width: 600px) {
    .breadcrumb-nav,
    .banner-title {
        display: none;
    }
}
</style>

<div class="project-details-section">
    <div class="custom-container">
        <div class="project-details-wrapper">

            <div class="project-main-content">

                <div class="project-header">
                    <h2 class="project-title">{{($projectDetails->project_name ?? 'PROJECT NAME') }}</h2>
                </div>

                @if (isset($projectDetails->featured_image) || isset($projectDetails->image))
                    <div class="project-featured-image">
                        <img src="{{ asset($projectDetails->featured_image ?? $projectDetails->image) }}"
                            alt="{{ $projectDetails->project_name }}">
                    </div>
                @endif

                <div class="project-description">
                    <div class="description-content">
                        {!! $projectDetails->description ?? '<p>No description provided.</p>' !!}
                    </div>
                </div>

                @php
                    $sections = is_array($projectDetails->sections)
                        ? $projectDetails->sections
                        : json_decode($projectDetails->sections, true);
                @endphp

                @if (!empty($sections))
                    <div class="project-sections mt-5">
                        @foreach ($sections as $index => $section)
                            <div class="section-row {{ $index % 2 === 0 ? 'row-normal' : 'row-reverse' }}" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">

                                <div class="swiper section-image-gallery-swiper">
                                    <div class="swiper-wrapper">
                                        @foreach ($section['images'] ?? [] as $img)
                                            {{-- Modified for Lightgallery.js --}}
                                            <div class="swiper-slide">
                                                <a class="lightgallery-item"
                                                   href="{{ asset($img) }}"
                                                   data-src="{{ asset($img) }}"
                                                   data-sub-html="<h4>Section Image {{ $index + 1 }}</h4>"> {{-- Optional caption --}}
                                                    <img src="{{ asset($img) }}" alt="Section Image {{ $index + 1 }}">
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>

                                <div class="section-text">
                                    {!! $section['description'] ?? '<p>No description provided.</p>' !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

<style>
/* Existing Banner Section Styles */
.project-banner {
    position: relative;
    max-height: 400px;
    overflow: hidden;
}
.banner-image img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.banner-overlay {
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.4) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
}
.banner-content {
    text-align: center;
    color: white;
}
.breadcrumb-nav a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
}
.banner-title {
    font-size: 3.5rem;
    font-weight: 700;
}

/* Project Details Section */
.project-details-section {
    padding: 80px 0;
    background: #f8f9fa;
}
.project-main-content {
    background: white;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.project-header {
    /* No specific changes here from original */
}

.project-title {
    font-size: 2.5rem;
    font-weight: 700;
}

/* Project Featured Image Styles */
.project-featured-image {
    margin-bottom: 40px;
}
.project-featured-image img {
    width: 100%;
    height: 400px;
    object-fit: cover;
    border-radius: 12px;
}

.description-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #555;
    margin-bottom: 40px;
}

.project-sections {
    display: flex;
    flex-direction: column;
    gap: 60px;
}

.section-row {
    display: flex;
    gap: 30px;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}
.section-row.row-reverse {
    flex-direction: row-reverse;
}

/* Swiper specific CSS - focused on visual match for the carousel section */
.section-image-gallery-swiper {
    width: 100%;
    height: 400px;
    overflow: hidden;
    flex: 1 1 50%;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
    border-radius: 12px;
}

.section-image-gallery-swiper .swiper-slide {
    display: flex;
    justify-content: center;
    align-items: center;
    /* Ensure the clickable area fills the slide */
    width: 100%;
    height: 100%;
}

/* Style for the Lightgallery clickable link wrapper */
.section-image-gallery-swiper .swiper-slide .lightgallery-item {
    display: block; /* Make the link a block element to fill the slide */
    width: 100%;
    height: 100%;
    cursor: pointer; /* Indicate it's clickable */
}

.section-image-gallery-swiper .swiper-slide .lightgallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* 'cover' to fill the slide space, matching the screenshot's image look */
    border-radius: 12px; /* Apply to individual images */
}

/* Swiper Pagination (Dots) */
.swiper-pagination-bullet-active {
    background: #007aff;
}

.section-text {
    flex: 1 1 45%;
    font-size: 1.1rem;
    line-height: 1.7;
    color: #333;
}
.section-text p {
    margin-bottom: 15px;
}

@media (max-width: 768px) {
    .section-row {
        flex-direction: column !important;
    }
    .section-image-gallery-swiper {
        flex: 1 1 100%;
        height: 300px;
    }
    .banner-title {
        font-size: 2rem;
    }
    .project-featured-image img {
        height: 300px;
    }
}
</style>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.2/lightgallery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.2/plugins/thumbnail/lg-thumbnail.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.2/plugins/zoom/lg-zoom.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.2/plugins/fullscreen/lg-fullscreen.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.2/plugins/autoplay/lg-autoplay.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.2/plugins/share/lg-share.min.js"></script> {{-- Optional: For share button --}}
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.2/plugins/pager/lg-pager.min.js"></script> {{-- Optional: For pager (1/6) --}}


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Swiper Initialization
        const swiperContainers = document.querySelectorAll('.section-image-gallery-swiper');

        swiperContainers.forEach(container => {
            new Swiper(container, {
                loop: true,
                slidesPerView: 1,
                spaceBetween: 30,
                grabCursor: true,
                autoplay: {
                    delay: 9000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });

            // Lightgallery Initialization for each swiper container
            lightGallery(container, {
                selector: '.lightgallery-item', // This is crucial: it tells Lightgallery to look for elements with this class inside the container
                plugins: [lgThumbnail, lgZoom, lgFullscreen, lgAutoplay, lgPager], // Include plugins to match the screenshot
                loop: true,
                thumbnail: true, // Enable thumbnails at the bottom
                animateThumb: true,
                zoomFromOrigin: false,
                allowMediaOverlap: true,
                toggleThumb: true,
                speed: 500, // Transition speed
                download: false, // Optional: Hide download button
                counter: true, // Show image counter (e.g., 1/6)
            });
        });
    });
</script>

@endsection
