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

        <div class="swiper we-offer">
            <div class="swiper-wrapper">
                @if(isset($teamMembers) && count($teamMembers))
                    @foreach($teamMembers as $member)
                        <div class="swiper-slide">
                            <div class="destinations-block" style="border:none">
                              <div style="
    width: 200px;
    height: 200px;
    border-radius: 50%;
    overflow: hidden;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f0f0f0;">
    
    <img
        src="{{ asset($member->image ?? 'assets/img/default-profile.png') }}"
        alt="{{ $member->name }}"
        style="
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;"
    >
</div>
  <span class="destinations-title mh-auto text-center" style="font-size:20px">{{ $member->name }}</span>
                                <span class="destinations-title mh-auto text-center" style="font-size:20px">{{ $member->designation }}</span>
                                                        <span class="text-justify" style="font-size:15px">{{ $member->short_description }}</span>
        
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
  margin: 0 auto 10px;
  position: relative;
  background-color: #f0f0f0;
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
  object-fit: cover;
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
@media (max-width: 576px) {
  .swiper-wrapper {
    justify-content: center !important;
  }

  .swiper-slide {
    display: flex;
    justify-content: center;
  }
}

</style>


<div id="philosophy" class="container">
 <div class="site-title pb-5">
      <h2 class="text-center">Our Foundation</h2>
    </div>
  

<div class="card-container">
    <!-- Card 1 -->
    <div class="card">
      <img src="{{ $phylosophy_image1 ?? 'https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?cs=srgb&dl=pexels-souvenirpixels-414612.jpg&fm=jpg'}}" alt="Nature">
      <div class="card-body">
        <p class="card-text">{!! $phylosophy_content1 ?? "This is a longer card with supporting text below as a natural lead-in to additional content.This is a longer card with supporting text below as a natural lead-in to additional contentThis is a longer card with supporting text below as a natural lead-in to additional content."!!}</p>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="card">
      <img src="{{ $phylosophy_image2 ?? 'https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?cs=srgb&dl=pexels-souvenirpixels-414612.jpg&fm=jpg'}}" alt="Technology">
      <div class="card-body">
        <p class="card-text">{!! $phylosophy_content2 ?? "This card has supporting text below as a natural lead-in to additional content." !!}</p>
      </div>
    </div>

    <!-- Card 3 -->
    <div class="card">
      <img src="{{ $phylosophy_image3 ?? 'https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?cs=srgb&dl=pexels-souvenirpixels-414612.jpg&fm=jpg'}}" alt="Adventure">
      <div class="card-body">
        <p class="card-text">{!! $phylosophy_content3 ?? "This is a wider card with supporting text below as a natural lead-in to additional content."!!}</p>
      </div>
    </div>
  </div>
                </div>
<!-- team section !-->
<!-- team section !-->


</script>

<div id="services" class="destinations pt-5 pb-4" data-aos="fade-up">
    <div class="custom-container">
        <div class="site-title pb-4">
            <h2 class="text-center">What We Do</h2>
        </div>

        {{-- Replaced Swiper structure with a responsive Bootstrap grid --}}
        <div class="row justify-content-center"> {{-- Added justify-content-center for centering on smaller screens --}}

            @if (isset($services) && $services->count() > 0)
                @foreach ($services as $item)
                    {{-- Each service block will be a column in the grid --}}
                    <div class="col-sm-6 col-md-4 col-lg-3 mb-4"> {{-- Adjust col-xx-x classes for desired responsiveness --}}
                        <div class="destinations-block">
                            <div class="destinations-figure">
                                <img src="{{ asset($item->image) }}" class="img-fluid" alt="{{ $item->service_name }}">
                            </div>
                            <span class="destinations-title mh-auto text-center">{{ $item->service_name }}</span>
                        </div>
                    </div>
                @endforeach
            @else
                {{-- Static fallback if no service data --}}
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="destinations-block">
                        <div class="destinations-figure">
                            <img src="{{ asset('assets/img/architectural.jpeg') }}" class="img-fluid" alt="Architectural Design">
                        </div>
                        <span class="destinations-title mh-auto text-center" style="font-size:20px">Architectural Design</span>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="destinations-block">
                        <div class="destinations-figure">
                            <img src="{{ asset('assets/img/interior-design.jpg') }}" class="img-fluid" alt="Interior Design">
                        </div>
                        <span class="destinations-title mh-auto text-center" style="font-size:20px">Interior Design</span>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="destinations-block">
                        <div class="destinations-figure">
                            <img src="{{ asset('assets/img/project-managment.jpg') }}" class="img-fluid" alt="Project Management">
                        </div>
                        <span class="destinations-title mh-auto text-center" style="font-size:20px">Project Management</span>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="destinations-block">
                        <div class="destinations-figure">
                            <img src="{{ asset('assets/img/renovation-restoration.jpg') }}" class="img-fluid" alt="Renovation & Restoration">
                        </div>
                        <span class="destinations-title mh-auto text-center" style="font-size:20px">Renovation & Restoration</span>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="destinations-block">
                        <div class="destinations-figure">
                            <img src="{{ asset('assets/img/UrbanPlanning.jpg') }}" class="img-fluid" alt="Urban Planning">
                        </div>
                        <span class="destinations-title mh-auto text-center" style="font-size:20px">Urban Planning</span>
                    </div>
                </div>
            @endif

        </div> {{-- End row --}}

        {{-- Removed swiper-pagination --}}

    </div>
</div>

@push('styles')
<style>
.destinations-block {
    text-align: center;
    padding: 15px; /* Maintain internal padding */
    border: 1px solid #eee;
    border-radius: 8px;
    background-color: #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    
    /* --- ENFORCING UNIFORM SIZE --- */
    display: flex; /* Enable Flexbox */
    flex-direction: column; /* Stack children vertically */
    justify-content: space-between; /* Distribute space: image at top, text at bottom */
    align-items: center; /* Center content horizontally */
    
    /* Fixed height for all blocks (adjust as needed) */
    /* This is the most direct way to make heights equal */
    height: 280px; /* Example height. Adjust this value! */
    
    /* If you want perfect squares based on width, use the aspect-ratio trick instead: */
    /* Remove `height: 280px;` if using this */
    /* position: relative; */
    /* padding-bottom: 100%; /* Makes the height equal to the width (a square) */
    /* height: 0; */
    /* overflow: hidden; */
    /* Then, you'd need to absolutely position children inside destinations-block */
    /* Example:
    .destinations-block .destinations-figure,
    .destinations-block .destinations-title {
        position: absolute;
        width: 100%;
        left: 0;
        box-sizing: border-box;
        padding: 0 15px;
    }
    .destinations-block .destinations-figure { top: 15px; height: calc(100% - 70px); }
    .destinations-block .destinations-title { bottom: 15px; }
    */
    /* For now, sticking with simpler `height` property */
}

/* Container for the image */
.destinations-figure {
    width: 100%; /* Take full width of parent block */
    height: 160px; /* Fixed height for the image area within the block */
    overflow: hidden; /* Crucial for images that might be taller than this */
    margin-bottom: 15px; /* Space below the image */
    border-radius: 8px; /* Match outer block's border-radius */
    
    display: flex; /* Use flex to center the image if its dimensions are tricky */
    justify-content: center;
    align-items: center;
}

/* The actual image */
.destinations-figure img {
    width: 100%; /* Fill the container width */
    height: 100%; /* Fill the container height */
    object-fit: cover; /* ESSENTIAL: Crops image to cover container without distortion */
    display: block; /* Removes extra space under image */
    transition: transform 0.3s ease-in-out;
}

.destinations-block:hover .destinations-figure img {
    transform: scale(1.05);
}

/* Title styling */
.destinations-title {
    display: block; /* Make it a block for layout control */
    font-size: 20px;
    font-weight: bold;
    color: #333;
    margin-top: auto; /* Pushes the title to the bottom if there's vertical space */
    margin-bottom: 0; /* No bottom margin here, as block has padding */
    white-space: normal; /* Allow text to wrap */
    word-wrap: break-word; /* Ensure long words break */
    line-height: 1.3; /* Adjust line height for readability */
}

/* Ensure default img-fluid doesn't interfere */
.img-fluid {
    max-width: 100%;
    height: auto; /* Override to allow object-fit and fixed parent height to control */
}


/* Custom container (likely in your webSite.blade.php) */
.custom-container {
    padding-left: 15px;
    padding-right: 15px;
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
}

/* Bootstrap column adjustments for responsiveness */
/* This controls how many columns per row */
.row {
    display: flex; /* Ensure row uses flexbox for columns */
    flex-wrap: wrap; /* Allow columns to wrap to the next line */
}

.col-sm-6, .col-md-4, .col-lg-3 {
    display: flex; /* Make columns flex containers too */
    /* This ensures that destinations-block inside fills the entire column height if needed, */
    /* though with fixed height on destinations-block, it's less critical. */
    flex-direction: column; /* Stack content vertically within the column */
}
</style>
@endpush

{{-- No @push('scripts') block needed for this section anymore --}}

@endsection





