@extends('layouts.webSite')
@section('title', 'About Us')
@section('content')

<div class="information-page-slider"
     style="background: url('{{ asset('assets/img/aboutusbanner.JPG') }}'); background-size: cover; background-position: center;">
    <div class="information-content">
        <h1><a href="{{ url('/') }}">Home</a><span>About Us</span></h1>
    </div>
</div>
<div id="about">
    <div class="default-content pt-5 pb-3">
        <div class="custom-container">
            <div class="site-title pb-3">
                <h2 class="text-center">Introduction</h2>
            </div>
            <div class="midd-content">
                <p class="text-justify" data-aos="fade-up">{!! $home_about_content ?? 'At Adiyogi Global, we are committed to delivering healthy, high-quality products to people around the
world. For over 12 years, we have built a reputation as a trusted provider by sourcing only the finest
goods directly from the best farmers and manufacturers in India. Our dedication to quality is reflected in
every product we offer, from fresh produce to a wide range of specialty items.
Our journey is rooted in a deep belief that everyone deserves access to products crafted with care and
responsibility. By working closely with our suppliers, we ensure that every product meets the highest
standards of purity and freshness. We take pride in bringing India’s rich agricultural heritage and
manufacturing expertise to the global market, offering products that consistently exceed expectations.
Customer trust is the foundation of Adiyogi Global. We are committed to earning and maintaining this
trust through transparency, integrity, and exceptional service. From your first interaction with us, we
aim to provide a seamless and satisfying experience.

As we continue to grow, our focus remains on quality, trust, and customer care. We are proud of our
journey and excited about the future, always striving to bring the best of India to the world. Thank you
for choosing Adiyogi Global.'  !!}</p>
                
               
        </div>
    </div>
 </div>
</div>

<div id="team" class="pt-5 pb-5" style="background-color:#f9f9f9;">
  <div class="custom-container">
    <div class="site-title pb-4">
      <h2 class="text-center">The Team</h2>
    </div>
    <div class="row align-items-center">
      <div class="col-md-4 text-center mb-4 mb-md-0">
<img src="{{ isset($director_image) ? asset($director_image) : asset('assets/img/Random Pics.jpeg') }}"
                         alt="About Us"
                         class="img-fluid rounded w-100"
                         style="height:300px; object-fit:cover;">      </div>
      <div class="col-md-8">
        {!! $director_message ?? 'At DP Architect, we don’t just design buildings — we craft experiences, emotions, and environments that shape lives. Every structure we create reflects our commitment to design excellence, functional integrity, and a deep respect for space, context, and culture.

Over the years, we’ve had the privilege of transforming ideas into enduring landmarks, blending innovation with timeless principles of architecture. Whether it’s a residence, a commercial complex, or an urban masterplan, our goal remains constant: to deliver thoughtful, sustainable, and inspiring design.' !!}
        <p class="text-end mt-3" style="font-weight: bold;">— Mr. Anil Kalra <br><span style="font-weight: normal;">Founder & Principal Architect</span></p>
      </div>
    </div>
  </div>
</div>

<div class="destinations pt-5 pb-4" data-aos="fade-up">
    <div class="custom-container">
        <div class="site-title pb-4">
      <h2 class="text-center">Our Core Team</h2>
    </div>

        <div class="swiper we-offer"  >
            <div class="swiper-wrapper"  >
                {{-- Static fallback for team members --}}
                {{-- Dynamic team members from the database --}}
                {{-- Static fallback for team members --}}
                {{-- Dynamic team members from the database --}}
                @if(isset($teamMembers) && count($teamMembers))
                    @foreach($teamMembers as $member)
                        <div class="swiper-slide"  >
                            <div class="destinations-block"   >
                              <div class="team-member-image-wrapper" >
    <img
        src="{{ asset($member->image ?? 'assets/img/default-profile.png') }}"
        alt="{{ $member->name }}"
    >
</div>
  <span class="destinations-title mh-auto text-center" style="font-size:20px">{{ $member->name }}</span>
                                <span class=" mh-auto text-center"  style="font-size:15px;font-weight:bold">{{ $member->designation }}</span>
                                                        <span class="text-justify" style="font-size:15px;margin-top:10px">{{ $member->short_description }}</span>
        
                            </div>
                        </div>
                    @endforeach
                @else
                    {{-- Static fallback if no team data --}}
                    <div class="swiper-slide">
                        <div class="destinations-block" style="border:none">
                            <div class="destinations-figure" style="width: 200px; height: 200px; border-radius: 50%; overflow: hidden; margin: 0 auto;">
                                <img src="https://plus.unsplash.com/premium_photo-1689568126014-06fea9d5d341?fm=jpg&q=60&w=3000" style="width: 100%; height: 100%; object-fit: cover;" alt="Rohit Sharma">
                            </div>
                            <span class="destinations-title mh-auto text-center" style="font-size:20px">Rohit Sharma</span>
                            <span class="destinations-title mh-auto text-center" style="font-size:18px; color:#555;">Web Developer</span>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="destinations-block" style="border:none">
                            <div class="destinations-figure" style="width: 200px; height: 200px; border-radius: 50%; overflow: hidden; margin: 0 auto;">
                                <img src="./assets/img/Ground Spice.jpg" style="width: 100%; height: 100%; object-fit: cover;" alt="Priya Verma">
                            </div>
                            <span class="destinations-title mh-auto text-center" style="font-size:20px">Priya Verma</span>
                            <span class="destinations-title mh-auto text-center" style="font-size:18px; color:#555;">UI/UX Designer</span>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="destinations-block" style="border:none">
                            <div class="destinations-figure" style="width: 200px; height: 200px; border-radius: 50%; overflow: hidden; margin: 0 auto;">
                                <img src="./assets/img/Non Basmati Rice 2.jpg" style="width: 100%; height: 100%; object-fit: cover;" alt="Aman Gupta">
                            </div>
                            <span class="destinations-title mh-auto text-center" style="font-size:20px">Aman Gupta</span>
                            <span class="destinations-title mh-auto text-center" style="font-size:18px; color:#555;">Project Manager</span>
                        </div>
                    </div>
                @endif

            </div>
            <div class="swiper-pagination" style="border:none"></div>
        </div>
    </div>
</div>

<style>
    .team-card:hover .overlay {
        opacity: 1 !important;
    }
</style>





<style>
  .image-hover-container {
    overflow: hidden;
    /* (Optional) Define container size if needed */
}

.image-hover-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;

    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.image-hover-container img:hover {
    transform: scale(1.03); /* Scales up slightly */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Adds a shadow */
}

  html {
    scroll-behavior: smooth; /* Optional: Makes scrolling smooth */
    scroll-padding-top: 110px; /* Adjust this value! */
    /* Use a value slightly larger than your fixed header's height to give some breathing room. */
    /* If your header is 80px, try 90px or 100px. */
}
  /* TEAM CARD STYLES */
.team-card {
  text-align: center;
  border: none;
  position: relative;
}

/* Wrapper around the circular image */
.team-image-wrapper {
  width: 200px;
  height: 200px;
  border-radius: 50%;
  overflow: hidden;
  position: relative;
  background-color: #f0f0f0;
}

.team-member-image-wrapper {
    width: 200px; /* Fixed width for the circle */
    border-radius: 50%; /* Makes it circular */
    background-color: #f0f0f0; /* Fallback background for empty space */
}


/* NEW/UPDATED: Image inside the circular wrapper */
.team-member-image-wrapper img {
    width: 100%; /* Image takes full width of its wrapper */
    height: 200px; /* Image takes full height of its wrapper */
    object-fit: cover; /* KEY: Scales image to cover the entire area, cropping if necessary */
    object-position: center; /* Centers the image content */
    display: block; /* Ensures it behaves as a block element */
    border-radius: 50%; /* Ensures the image itself is also circular */
    
}


/* Image inside the circular wrapper */
.team-image-wrapper img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  display: block;
  
}

/* Overlay on hover */
.team-image-wrapper .overlay {
  position: absolute;
  inset: 0; /* shorthand for top, right, bottom, left = 0 */
  background: rgba(0, 0, 0, 0.75);
  color: #fff;
  font-size: 14px;
  padding: 15px;
  opacity: 0;
  transition: opacity 0.3s ease-in-out;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  border-radius: 50%;
  line-height: 1.4;
}

.team-image-wrapper:hover .overlay {
  opacity: 1;
}

/* RESPONSIVE CONTAINER */
.container {
  width: 100%;
  padding-left: 15px;
  padding-right: 15px;
  margin-left: auto;
  margin-right: auto;
}

@media (min-width: 576px) {
  .container {
    max-width: 540px;
  }
}

@media (min-width: 768px) {
  .container {
    max-width: 720px;
  }
}

@media (min-width: 1000px) {
  .container {
    max-width: 1300px;
  }
}

/* CARD GRID (PHILOSOPHY SECTION) */
.card-container {
  display: grid;
  grid-template-columns: 1fr;
  gap: 20px;
}

@media (min-width: 768px) {
  .card-container {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (min-width: 1024px) {
  .card-container {
    grid-template-columns: repeat(3, 1fr);
  }
}

/* INDIVIDUAL CARD STYLE */
.card {
  background-color: #ffffff;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  display: flex;
  flex-direction: column;
  height: 100%;
}

.card img {
  width: 100%;
  max-height: 200px;
  /* object-fit: cover; */
}

.card-body {
  padding: 15px;
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.card-text {
  color: #555;
  font-size: 0.95rem;
  margin-bottom: 10px;
}

/* SWIPER RESPONSIVE FIX */


</style>


<div id="philosophy" class="container" style="margin-top: 50px;">
  <div class="custom-container">
 <div class="site-title pb-5">
      <h2 class="text-center">Our Foundation</h2>
    </div>
  

<div class="card-container">
    <div class="card">
      <img src="{{ $phylosophy_image1 ?? 'https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?cs=srgb&dl=pexels-souvenirpixels-414612.jpg&fm=jpg'}}" alt="Nature">
      <div class="card-body">
        <p class="card-text">{!! $phylosophy_content1 ?? "This is a longer card with supporting text below as a natural lead-in to additional content.This is a longer card with supporting text below as a natural lead-in to additional contentThis is a longer card with supporting text below as a natural lead-in to additional content."!!}</p>
      </div>
    </div>

    <div class="card">
      <img src="{{ $phylosophy_image2 ?? 'https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?cs=srgb&dl=pexels-souvenirpixels-414612.jpg&fm=jpg'}}" alt="Technology">
      <div class="card-body">
        <p class="card-text">{!! $phylosophy_content2 ?? "This card has supporting text below as a natural lead-in to additional content." !!}</p>
      </div>
    </div>

    <div class="card">
      <img src="{{ $phylosophy_image3 ?? 'https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?cs=srgb&dl=pexels-souvenirpixels-414612.jpg&fm=jpg'}}" alt="Adventure">
      <div class="card-body">
        <p class="card-text">{!! $phylosophy_content3 ?? "This is a wider card with supporting text below as a natural lead-in to additional content."!!}</p>
      </div>
    </div>
</div>
</div>
<style>
  /* --- Card Container Styling (for layout and responsiveness) --- */
.card-container {
    display: grid; /* Use CSS Grid for responsive layout */
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); /* Cards will adapt to screen size, min 280px wide */
    gap: 30px; /* Space between cards */
    padding: 20px; /* Padding around the entire card section */
    max-width: 1200px; /* Max width for the container */
    margin: 0 auto; /* Center the container on the page */
}

/* --- Base Card Styling --- */
.card {
    background-color: #fff;
    border-radius: 12px; /* Soft rounded corners for the card */
    overflow: hidden; /* Crucial for clipping the image when it scales */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Subtle initial shadow */
    display: flex; /* Use flexbox to organize image and body vertically */
    flex-direction: column;
    height: 100%; /* Ensures cards in a grid/flex layout maintain consistent height */
    cursor: pointer; /* Indicates it's interactive */

    /* For 3D effect: Sets up a 3D rendering context */
    transform-style: preserve-3d;
    transform: perspective(1000px); /* Gives a sense of depth */

    /* Smooth transitions for all hover effects */
    transition: transform 0.4s ease-out, box-shadow 0.4s ease-out;
}

/* --- Card Image Styling --- */
.card img {
    width: 100%;
    height: 200px; /* Fixed height for consistent image size, adjust as needed */
    object-fit: cover; /* Ensures images cover the area without distortion */
    object-position: center;
    display: block;
    border-top-left-radius: 12px; /* Match card's top border-radius */
    border-top-right-radius: 12px; /* Match card's top border-radius */

    /* Smooth transition for the image zoom effect */
    transition: transform 0.4s ease-out;
}

/* --- Card Body Styling --- */
.card .card-body {
    padding: 20px;
    flex-grow: 1; /* Allows the body to take up available space, pushing content nicely */
    display: flex;
    flex-direction: column;
}

.card .card-text {
    color: #555;
    line-height: 1.6;
    font-size: 0.95rem;
    /* You can add text overflow ellipsis here if text content is very long */
}

/* --- 3D Hover Effect for the Card --- */
.card:hover {
    /* Lift the card up and slightly forward */
    transform: translateY(-12px) rotateX(2deg) scale(1.02);
    /* Make the shadow larger and more diffused for a "lifted" 3D look */
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
    z-index: 1; /* Bring the hovered card slightly to the front if cards are close */
}

/* --- Optional: Subtle Image Zoom within the Hovered Card --- */
.card:hover img {
    transform: scale(1.05); /* The image zooms slightly more than the card itself */
}

/* --- Responsive Adjustments (for smaller screens) --- */
@media (max-width: 768px) {
    .card-container {
        grid-template-columns: 1fr; /* Stack cards vertically on small screens */
    }
}
</style>
<!-- team section !-->
<!-- team section !-->


</script>

<div id="services" class="destinations pt-5 pb-4" data-aos="fade-up">
    <div class="custom-container">
        <div class="site-title pb-4">
            <h2 class="text-center">What We Do</h2>
        </div>

        {{-- Standard Bootstrap Row and Columns (no Swiper) --}}
        <div class="row justify-content-center">
            @if (isset($services) && $services->count() > 0)
                @foreach ($services as $item)
                    {{-- Each service item is now a Bootstrap column --}}
                    <div class="col-md-4 col-sm-6 mb-4">
                        {{-- This is the 'destinations-block' structure from your Gallery Swiper slide --}}
                        <div class="destinations-block text-center" style="background:none;">
                            <div class="destinations-figure d-flex align-items-center justify-content-center">
                                {{-- Image with initial inline styles, we'll override in CSS --}}
                                <img src="{{ asset($item->image) }}" class="img-fluid" alt="{{ $item->service_name }}"
                                     style="width:100%; height:250px; object-fit:contain; border-radius:20px;">
                            </div>
                            <span class="destinations-title d-block mt-2" style="font-size:20px;">
                                {{ $item->service_name }}
                            </span>
                        </div>
                    </div>
                @endforeach
            @else
                {{-- Fallback content using the same structure --}}
                @php
                    $fallbackServices = [
                        ['img' => 'assets/img/architectural.jpeg', 'title' => 'Architectural Design'],
                        ['img' => 'assets/img/interior-design.jpg', 'title' => 'Interior Design'],
                        ['img' => 'assets/img/project-managment.jpg', 'title' => 'Project Management'],
                        ['img' => 'assets/img/renovation-restoration.jpg', 'title' => 'Renovation & Restoration'],
                        ['img' => 'assets/img/UrbanPlanning.jpg', 'title' => 'Urban Planning'],
                    ];
                @endphp

                @foreach ($fallbackServices as $fallback)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="destinations-block text-center" style="background:none;">
                            <div class="destinations-figure d-flex align-items-center justify-content-center">
                                <img src="{{ asset($fallback['img']) }}" class="img-fluid" alt="{{ $fallback['title'] }}"
                                     style="width:100%; height:250px; object-fit:contain; border-radius:20px;">
                            </div>
                            <span class="destinations-title d-block mt-2" style="font-size:20px;">
                                {{ $fallback['title'] }}
                            </span>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@push('styles')
<style>
/* ------------------------------------------- */
/* OUR EXPERTISE SECTION STYLES (Gallery-like Grid) */
/* ------------------------------------------- */

/* Ensure the Bootstrap columns are also flex containers for consistent height across a row */
.row.justify-content-center > [class*="col-"] {
    display: flex;
    flex-direction: column;
    align-items: stretch; /* Makes sure blocks stretch to fill tallest column */
}

/* The main container for each service item - Mimics gallery's slide structure */
.destinations-block {
    text-align: center;
    background: none !important; /* Forces background to none as per your inline style */
    
    /* Use flexbox for internal layout (image, title) */
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* Pushes image up, title down */
    align-items: center; /* Horizontally center content */
    
    /* Enforce a consistent height for the entire block */
    /* Adjust this height to control the overall card size */
    min-height: 320px; /* Adjust this value as needed to fit image + title space */
    height: 320px;
    max-height: 320px;
    
    width: 100%; /* Ensures it fills its column */
    padding: 0; /* Remove internal padding if you want image to go edge to edge */
}

/* Container for the image within each block */
.destinations-figure {
    width: 100%; /* Take full width of parent block */
    height: 250px; /* Fixed height for the image area, as per your inline style */
    overflow: hidden; /* Important to keep image contained within this area */
    margin-bottom: 10px; /* Space between image and title */
    
    /* Using d-flex, align-items-center, justify-content-center as in your HTML */
    display: flex;
    align-items: center;
    justify-content: center; /* Corrected typo: justify-content */
}

/* The actual image */
.destinations-figure img {
    width: 100% !important; /* Force width to 100% of destinations-figure */
    height: 100% !important; /* Force height to 100% of destinations-figure */
    object-fit: contain; /* ***KEY CHANGE: Shows entire image, might have blank space*** */
    border-radius: 20px !important; /* From your inline style */
    background-color: #f8f8f8; /* Optional: A background color for the empty space from object-fit: contain */
    display: block;
}

/* Title styling */
.destinations-title {
    font-size: 20px !important; /* From your inline style */
    font-weight: bold;
    color: #333;
    margin-top: auto; /* Pushes the title to the bottom if there's vertical space */
    margin-bottom: 0;
    white-space: normal;
    word-wrap: break-word;
    line-height: 1.3;
}

/* General custom container style (should be in your main webSite.blade.php) */
.custom-container {
    padding-left: 15px;
    padding-right: 15px;
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
}

/* Responsive adjustments for columns */
@media (max-width: 575.98px) { /* Bootstrap's 'sm' breakpoint */
    .col-sm-6, .col-md-4, .col-lg-3 {
        width: 100%; /* Full width on extra small screens */
        max-width: 320px; /* Optional: Limit max width of a single card on very small screens */
        margin-left: auto;
        margin-right: auto; /* Center the single column */
    }
    .destinations-block {
        margin-left: auto; /* Center the block itself within the column */
        margin-right: auto;
    }
}
</style>
@endpush



{{-- No @push('scripts') block needed for this section anymore --}}

@endsection





