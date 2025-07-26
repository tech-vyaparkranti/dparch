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

<!-- AOS CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">

<div class="information-page-slider"
     style="background: url('{{ asset('assets/img/projectsbanner.jpg') }}'); background-size: cover; background-position: center;">
    <div class="information-content">
        <h1><a href="{{ url('/') }}">Home</a><span>Projects</span></h1>
    </div>
</div>

<div id="about">
    <div class="default-content products-page pt-5 pb-3">
        <div class="custom-container">
            <div class="site-title pb-3">
                <h2 class="text-center">Our Projects</h2>
               <!-- <p class="text-center pb-3">
                    {!! $project_content ?? "From basic treks to high-altitude mountaineering expeditions, we cater to adventurers of all levels." !!}
                </p>!-->
            </div>

            <div class="services-grid mt-3">
                @if (isset($services) && $services->count() > 0)
                    @foreach ($services as $index => $item)
                        <div class="service-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                            
                               <h4 style="text-align:center"><a href="{{ route('productDetails', $item->slug) }}" style="color:black" >{{ $item->project_name }}</a></h4>
                            <div class="card-image" style="">

                                @if (!empty($item->main_image))
                                    <img src="{{ asset($item->main_image) }}" style="border-radius:10px 10px 0px 0px"  alt="{{ $item->project_name }}">
                                @else
                                    <img src="{{ asset('assets/img/default-image.jpg') }}" alt="Default Image">
                                @endif
                            </div>
                            <div class="card-content">
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

<!-- AOS Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init({
        once: true,
        duration: 1000,
        offset: 100,
    });
</script>

<style>
.services-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}
.theme-btn:hover {
    background-color: red; /* Change to red on hover */
    color: white; /* Keep text white on hover */
}

.service-card {
    background: #fff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15), 0 6px 8px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.4s ease;
    display: flex;
    flex-direction: column;
    will-change: transform;
}

.service-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 18px 38px rgba(0, 0, 0, 0.25), 0 8px 12px rgba(0, 0, 0, 0.12);
}

.card-image {
    width: 100%;
    height: 256px;
    overflow: hidden;
    transition: transform 0.4s ease-in-out;
}

.card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease;
}

.service-card:hover .card-image img {
    transform: scale(1.06);
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
    transition: color 0.3s ease;
}

.card-content h4 a {
    text-decoration: none;
    color: inherit;
}

.service-card:hover .card-content h4 {
    color: #e41e25;
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
    padding: 10px 5px;
    border-radius: 5px;
    background: #070736fc;
    color: #fff;
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: all 0.3s ease;
    width: max-content;
}

/* .theme-btn:hover {
    transform: translateY(-2px);
    background-color: #001f5f;
    box-shadow: 0 8px 15px rgba(0, 0, 80, 0.3);
} */

/* Responsive */
@media (max-width: 1024px) {
    .services-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .services-grid {
        grid-template-columns: 1fr;
    }

    .card-image {
        height: 180px;
    }
}
</style>


@endsection
