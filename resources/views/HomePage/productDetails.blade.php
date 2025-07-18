@extends('layouts.webSite')
@section('title', 'Product details')
@section('content')

<!-- Banner Section -->
<div class="project-banner">
    <div class="banner-image">
        <img src="{{ asset($projectDetails->banner_image ?? ($projectDetails->image ?? 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80')) }}"
            alt="{{ $projectDetails->project_name ?? 'Project' }}">
        <div class="banner-overlay">
            <div class="banner-content">
                <nav class="breadcrumb-nav">
                    <a href="{{ url('/') }}">Home</a>
                    <span class="separator">/</span>
                    <a href="{{route('productPage')}}">Project</a>
                    <span class="separator">/</span>
                    <span class="current">{{ $projectDetails->project_name ?? 'Project Details' }}</span>
                </nav>
                <h1 class="banner-title">{{ $projectDetails->project_name ?? 'Project Details' }}</h1>
            </div>
        </div>
    </div>
</div>

<!-- Project Details Section -->
<div class="project-details-section">
    <div class="custom-container">
        <div class="project-details-wrapper">

            <!-- Main Content -->
            <div class="project-main-content">

                <!-- Project Header -->
                <div class="project-header">
                    <h2 class="project-title">{{ strtoupper($projectDetails->project_name ?? 'PROJECT NAME') }}</h2>
                </div>

                <!-- Project Featured Image -->
                @if (isset($projectDetails->featured_image) || isset($projectDetails->image))
                    <div class="project-featured-image">
                        <img src="{{ asset($projectDetails->featured_image ?? $projectDetails->image) }}"
                            alt="{{ $projectDetails->project_name }}">
                    </div>
                @endif

                <!-- Description Content -->
                <div class="project-description">
                    <div class="description-content">
                        {!! $projectDetails->description ?? '<p>No description provided.</p>' !!}
                    </div>
                </div>

                <!-- Dynamic Sections (image + text pairs) -->
                @php
                    $sections = is_array($projectDetails->sections)
                        ? $projectDetails->sections
                        : json_decode($projectDetails->sections, true);
                @endphp

                @if (!empty($sections))
                    <div class="project-sections mt-5">
                        @foreach ($sections as $index => $section)
                            <div class="section-row {{ $index % 2 === 0 ? 'row-normal' : 'row-reverse' }}" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                                <div class="section-image">
                                    <img src="{{ asset($section['image'] ?? 'assets/img/default-image.jpg') }}" alt="Section Image {{ $index + 1 }}">
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
.project-banner {
    position: relative;
    height: 400px;
    overflow: hidden;
}
.banner-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
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
.section-image, .section-text {
    flex: 1 1 45%;
}
.section-image img {
    width: 100%;
    height: auto;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}
.section-text {
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
    .section-image, .section-text {
        flex: 1 1 100%;
    }
    .project-featured-image img {
        height: auto;
    }
    .banner-title {
        font-size: 2rem;
    }
}
</style>
@endsection