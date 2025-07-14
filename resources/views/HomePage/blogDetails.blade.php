@extends('layouts.webSite')
@section('title', 'Product details')
@section('content')


    <!-- Banner Section -->
    <div class="project-banner">
        <div class="banner-image">
            <img src="{{ asset($blogDetails->image) }}"
                alt="{{ $blogDetails->title }}">
            <div class="banner-overlay">
                <div class="banner-content">
                    <nav class="breadcrumb-nav">
                        <a href="{{ url('/') }}">Home</a>
                        <span class="separator">/</span>
                        <a href="{{route("blogPage")}}">Blog</a>
                        <span class="separator">/</span>
                        <span class="current">{{ $blogDetails->title ?? 'Blog Details' }}</span>
                    </nav>
                    <h1 class="banner-title">{{ $blogDetails->title ?? 'Blog Details' }}</h1>
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
                        {{-- <div class="project-meta">
                        <span class="project-category">{{ $blogDetails->category ?? 'Adventure' }}</span>
                        <span class="project-date">{{ $blogDetails->created_at ? $blogDetails->created_at->format('M Y') : 'Recent' }}</span>
                    </div> --}}
                        <h2 class="project-title">{{ strtoupper($blogDetails->title) }}</h2>
                    </div>

                    <!-- Project Featured Image -->
                    @if (isset($blogDetails->image))
                        <div class="project-featured-image">
                            <img src="{{ asset($blogDetails->image) }}"
                                alt="{{ $blogDetails->title }}">
                        </div>
                    @endif

                    <!-- Project Description -->
                    <div class="project-description">
                        <div class="description-content">
                            {!! $blogDetails->content !!}
                        </div>
                    </div>

                    <!-- Project Features -->
                    {{-- <div class="project-features">
                    <h3>What's Included</h3>
                    <div class="features-grid">
                        <div class="feature-item">
                            <i class="fas fa-map-marked-alt"></i>
                            <span>Expert Guidance</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-shield-alt"></i>
                            <span>Safety Equipment</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-utensils"></i>
                            <span>Meals & Accommodation</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-camera"></i>
                            <span>Photography Support</span>
                        </div>
                    </div>
                </div> --}}

                    {{-- @php
                        $galleryImages = is_array($blogDetails->gallery_images)
                            ? $blogDetails->gallery_images
                            : json_decode($blogDetails->gallery_images, true);
                    @endphp

                    <div class="project-gallery">
                        <h3>Project Gallery</h3>
                        <div class="gallery-grid">
                            @if (!empty($galleryImages))
                                @foreach ($galleryImages as $index => $image)
                                    <div class="gallery-item" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                                        <img src="{{ asset($image) }}" alt="Gallery Image {{ $index + 1 }}">
                                        
                                    </div>
                                @endforeach
                            @else
                                @for ($i = 1; $i <= 6; $i++)
                                    <div class="gallery-item" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                                        <img src="https://images.unsplash.com/photo-{{ 1441974231531 + $i }}?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                            alt="Gallery Image {{ $i }}">
                                        <div class="gallery-overlay">
                                            <button class="gallery-btn" onclick="openLightbox({{ $i - 1 }})">
                                                <i class="fas fa-expand"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endfor
                            @endif
                        </div>
                    </div> --}}



                </div>

                <!-- Sidebar -->
                <div class="project-sidebar">
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Recent Projects</h3>
                        <div class="recent-projects">
                            @if (isset($recentBlog) && $recentBlog->count() > 0)
                                @foreach ($recentBlog as $recentProject)
                                <a
                                                    href="{{ route('blogDetails', $recentProject->slug) }}">
                                    <div class="recent-project-item">
                                        <div class="recent-project-image">
                                            <img src="{{ asset($recentProject->image) }}"
                                                alt="{{ $recentProject->title }}">
                                        </div>
                                        <div class="recent-project-content">
                                            <h4><a
                                                    href="{{ route('blogDetails', $recentProject->slug) }}">{{ $recentProject->title }}</a>
                                            </h4>
                                            <p>{{ Str::limit(strip_tags($recentProject->content), 30) }}</p>
                                            <span
                                                class="project-date">{{ $recentProject->created_at ? $recentProject->created_at->format('M d, Y') : 'Recent' }}</span>
                                        </div>
                                    </div>
                                    </a>
                                @endforeach
                            @else
                                <!-- Default recent projects -->
                                @for ($i = 1; $i <= 3; $i++)
                                    <div class="recent-project-item">
                                        <div class="recent-project-image">
                                            <img src="https://images.unsplash.com/photo-{{ 1506905925346 + $i }}?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                                alt="Recent Project {{ $i }}">
                                        </div>
                                        <div class="recent-project-content">
                                            <h4><a href="#">Mountain Adventure {{ $i }}</a></h4>
                                            <p>Experience the thrill of high-altitude adventure with our expert guides...
                                            </p>
                                            <span class="project-date">Dec {{ 10 + $i }}, 2024</span>
                                        </div>
                                    </div>
                                @endfor
                            @endif
                        </div>
                    </div>

                    <!-- Additional sidebar widget -->
                    {{-- <div class="sidebar-widget">
                    <h3 class="widget-title">Quick Contact</h3>
                    <div class="quick-contact">
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <span>+1 (555) 123-4567</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <span>info@adventure.com</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>123 Adventure St, Mountain View</span>
                        </div>
                    </div>
                </div> --}}
                </div>
            </div>
        </div>
    </div>
    <style>
        /* Project Banner Styles */
        .project-banner {
            position: relative;
            height: 400px;
            overflow: hidden;
        }

        .banner-image {
            position: relative;
            height: 100%;
            width: 100%;
        }

        .banner-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .banner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.4) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .banner-content {
            text-align: center;
            color: white;
            z-index: 2;
        }

        .breadcrumb-nav {
            margin-bottom: 20px;
            font-size: 1rem;
        }

        .breadcrumb-nav a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .breadcrumb-nav a:hover {
            color: white;
        }

        .separator {
            margin: 0 10px;
            color: rgba(255, 255, 255, 0.6);
        }

        .current {
            color: white;
            font-weight: 500;
        }

        .banner-title {
            font-size: 3.5rem;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin: 0;
        }

        /* Project Details Section */
        .project-details-section {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .project-details-wrapper {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Main Content */
        .project-main-content {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .project-header {
            margin-bottom: 30px;
        }

        .project-meta {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }

        .project-category {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .project-date {
            color: #666;
            font-size: 0.9rem;
        }

        .project-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
            line-height: 1.2;
        }

        .project-featured-image {
            margin-bottom: 40px;
            border-radius: 15px;
            overflow: hidden;
        }

        .project-featured-image img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        .project-description {
            margin-bottom: 40px;
        }

        .description-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #555;
        }

        .description-content p {
            margin-bottom: 20px;
        }

        .project-features {
            margin-bottom: 40px;
            padding: 30px;
            background: #f8f9fa;
            border-radius: 15px;
        }

        .project-features h3 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .feature-item i {
            color: #667eea;
            font-size: 1.2rem;
        }

        .feature-item span {
            font-weight: 500;
            color: #2c3e50;
        }

        /* Gallery Styles */
        .project-gallery {
            margin-bottom: 40px;
        }

        .project-gallery h3 {
            color: #2c3e50;
            margin-bottom: 30px;
            font-size: 1.8rem;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .gallery-item {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            aspect-ratio: 4/3;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover {
            transform: scale(1.05);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-btn {
            background: white;
            border: none;
            padding: 15px;
            border-radius: 50%;
            color: #2c3e50;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .gallery-btn:hover {
            background: #667eea;
            color: white;
        }

        /* Project CTA */
        .project-cta {
            text-align: center;
            padding: 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            color: white;
        }

        .project-cta h3 {
            font-size: 2rem;
            margin-bottom: 15px;
        }

        .project-cta p {
            font-size: 1.1rem;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .theme-btn {
            display: inline-flex;
            align-items: center;
            gap: 15px;
            padding: 15px 30px;
            background: white;
            color: #2c3e50 !important;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .theme-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        /* Sidebar Styles */
        .project-sidebar {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .sidebar-widget {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .widget-title {
            font-size: 1.3rem;
            color: #2c3e50;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f1f1f1;
        }

        .recent-projects {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .recent-project-item {
            display: flex;
            gap: 15px;
            padding: 15px;
            border-radius: 10px;
            transition: background 0.3s ease;
        }

        .recent-project-item:hover {
            background: #f8f9fa;
        }

        .recent-project-image {
            flex-shrink: 0;
            width: 80px;
            height: 80px;
            border-radius: 10px;
            overflow: hidden;
        }

        .recent-project-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .recent-project-content {
            flex-grow: 1;
        }

        .recent-project-content h4 {
            margin: 0 0 8px 0;
            font-size: 1rem;
        }

        .recent-project-content h4 a {
            color: #2c3e50;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .recent-project-content h4 a:hover {
            color: #667eea;
        }

        .recent-project-content p {
            font-size: 0.9rem;
            color: #666;
            margin: 0 0 8px 0;
            line-height: 1.4;
        }

        .project-date {
            font-size: 0.8rem;
            color: #999;
        }

        /* Quick Contact */
        .quick-contact {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .contact-item i {
            color: #667eea;
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        .contact-item span {
            color: #2c3e50;
            font-size: 0.9rem;
        }

        /* Lightbox Styles */
        .lightbox-modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
        }

        .lightbox-content {
            position: relative;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .lightbox-close {
            position: absolute;
            top: 20px;
            right: 30px;
            color: white;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
            z-index: 1001;
        }

        .lightbox-close:hover {
            color: #ccc;
        }

        #lightboxImage {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
        }

        .lightbox-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            justify-content: space-between;
            width: 100%;
            padding: 0 20px;
        }

        .lightbox-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            padding: 15px 20px;
            font-size: 1.5rem;
            border-radius: 50%;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .lightbox-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .project-details-wrapper {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .project-sidebar {
                order: -1;
            }

            .banner-title {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 768px) {
            .project-banner {
                height: 300px;
            }

            .banner-title {
                font-size: 2rem;
            }

            .project-main-content {
                padding: 30px 20px;
            }

            .project-title {
                font-size: 2rem;
            }

            .gallery-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .project-details-section {
                padding: 60px 0;
            }
        }

        @media (max-width: 480px) {
            .banner-title {
                font-size: 1.8rem;
            }

            .project-main-content {
                padding: 20px 15px;
            }

            .project-title {
                font-size: 1.8rem;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
            }

            .sidebar-widget {
                padding: 20px;
            }

            .project-meta {
                flex-direction: column;
                gap: 10px;
            }

            .recent-project-item {
                flex-direction: column;
                text-align: center;
            }

            .recent-project-image {
                width: 100%;
                height: 150px;
            }
        }

        /* Form Styles */
        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .default-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .default-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .contact-form-area button[data-bs-dismiss="modal"] {
            position: absolute;
            top: 10px;
            right: 10px !important;
            left: auto;
            color: red;
            background: none;
            border: none;
            font-size: 1.5rem;
            z-index: 1000;
        }

        .contact-form-area.pt-4 {
            padding: 20px;
        }
    </style>

@endsection
