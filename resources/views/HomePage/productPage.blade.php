@extends('layouts.webSite')
@section('title', 'Services')
@section('content')

@php
    use App\Models\WebSiteElements;

    $project_content = WebSiteElements::where([
        'status' => 1,
        'element' => 'projects_content'
    ])->value('element_details');
@endphp

<div class="information-page-slider"
     style="background: url('{{ asset('assets/img/projectsbanner.jpg') }}'); background-size: cover; background-position: center;">
    <div class="information-content">
        <h1><a href="{{ url('/') }}">Home</a><span>About Us</span></h1>
    </div>
</div>

<div id="about">
    <div class="default-content products-page pt-5 pb-3">
        <div class="custom-container">
            <div class="site-title pb-3">
                <h2 class="text-center">Our Projects</h2>
                <p class="text-center pb-3">
                    {!! $project_content ?? "From basic treks to high-altitude mountaineering expeditions, we cater to adventurers of all levels." !!}
                </p>
            </div>

            <div class="services-grid mt-3">
                @if (isset($services) && $services->count() > 0)
                    @foreach ($services as $index => $item)
                        <div class="service-card" data-aos="fade-up" data-aos-duration="1500">
                            <div class="card-image">
                                @php
                                    $sections = is_array($item->sections) ? $item->sections : json_decode($item->sections, true);
                                @endphp
                                @if (!empty($sections))
                                    <div class="swiper mySwiper{{ $index }}">
                                        <div class="swiper-wrapper">
                                            @foreach ($sections as $section)
                                                @if (!empty($section['image']))
                                                    <div class="swiper-slide">
                                                        <img src="{{ asset($section['image']) }}" alt="Section Image">
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="swiper-pagination"></div>
                                    </div>
                                @else
                                    <img src="{{ asset('assets/img/default-image.jpg') }}" alt="Default Image">
                                @endif
                            </div>
                            <div class="card-content">
                                <h4><a href="{{ route('productDetails', $item->slug) }}">{{ strtoupper($item->project_name) }}</a></h4>
                                <p>{!! Str::limit($item->description, 300, '...') !!}</p>
                                <a href="{{ route('productDetails', $item->slug) }}" class="theme-btn">
                                    <span>View Details</span>
                                    <i class="fa fa-link" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center">No services available.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        @foreach ($services as $index => $item)
            new Swiper(".mySwiper{{ $index }}", {
                loop: true,
                pagination: {
                    el: ".mySwiper{{ $index }} .swiper-pagination",
                    clickable: true,
                },
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
            });
        @endforeach
    });
</script>

<style>
.services-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.service-card {
    background: #fff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(0,0,0,0.1);
    transition: 0.3s ease-in-out;
    display: flex;
    flex-direction: column;
}

.service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 35px rgba(0,0,0,0.15);
}

.card-image img, .swiper-slide img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    border-radius: 10px;
}

.card-content {
    padding: 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.card-content h4 {
    font-size: 1.2rem;
    font-weight: bold;
    margin-bottom: 10px;
    color: #2c3e50;
}

.card-content h4 a {
    text-decoration: none;
    color: inherit;
}

.card-content p {
    font-size: 0.95rem;
    color: #555;
    margin-bottom: 20px;
    line-height: 1.6;
    max-height: 180px;
    overflow: auto;
}

.theme-btn {
    padding: 10px 30px;
    border-radius: 30px;
    background: navy;
    color: #fff;
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: all 0.3s ease;
    width: max-content;
}

.theme-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 15px rgba(102, 126, 234, 0.3);
}

@media (max-width: 1024px) {
    .services-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .services-grid {
        grid-template-columns: 1fr;
    }

    .card-image img {
        height: 180px;
    }
}
</style>

@endsection
