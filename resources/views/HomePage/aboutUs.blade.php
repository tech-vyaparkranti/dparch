@extends('layouts.webSite')
@section('title', 'About Us')
@section('content')
<div class="information-page-slider">
    <div class="information-content">
        <h1><a href="{{ url('/') }}">Home</a><span>About Us</span></h1>
    </div>
</div>
<div id="about">
    <div class="default-content pt-5 pb-3">
        <div class="custom-container">
            <div class="site-title pb-3">
                <h2 class="text-center">About Us </h2>
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

<div id="director-message" class="pt-5 pb-5" style="background-color:#f9f9f9;">
  <div class="custom-container">
    <div class="site-title pb-4">
      <h2 class="text-center">Message from Our Director</h2>
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
        <p class="text-end mt-3" style="font-weight: bold;">— Mr. Testing<br><span style="font-weight: normal;">Founder & Director</span></p>
      </div>
    </div>
  </div>
</div>

<div id="team" class="destinations pt-5 pb-4" data-aos="fade-up">
    <div class="custom-container">
        <div class="site-title pb-4">
            <h2 class="text-center">Our Team</h2>
        </div>
        <div class="swiper we-offer">
            <div class="swiper-wrapper">
               @if (isset($teamMembers) && count($teamMembers))
    @foreach ($teamMembers as $member)
        <div class="swiper-slide">
            <div class="destinations-block team-card">
                <div class="team-image-wrapper">
                    <img
                        src="{{ asset($member->image ?? 'assets/img/default-profile.png') }}"
                        alt="{{ $member->name }}"
                    />
                    <div class="overlay">
                        <p>{{ $member->short_description ?? 'No description provided.' }}</p>
                    </div>
                </div>
                <span class="destinations-title mh-auto text-center" style="font-size:20px">{{ $member->name }}</span>
                <span class="destinations-title mh-auto text-center" style="font-size:20px">{{ $member->designation }}</span>
            </div>
        </div>
    @endforeach
                @else
                    {{-- Static fallback if no data --}}
                    <div class="swiper-slide">
                        <div class="destinations-block" style="border:none">
                            <div class="destinations-figure" style="width: 200px; height: 200px; border-radius: 50%; overflow: hidden; margin: 0 auto;">
                                <img style="width: 100%; height: 100%; object-fit: cover;" src="https://plus.unsplash.com/premium_photo-1689568126014-06fea9d5d341?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8cHJvZmlsZXxlbnwwfHwwfHx8MA%3D%3D"  class="img-fluid" alt="Destinations">
                            </div>
                            <span class="destinations-title mh-auto text-center" style="font-size:20px">Rohit Sharma</span>
                            <span class="destinations-title mh-auto text-center" style="font-size:20px">Web Developer</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="destinations-block" style="border:none">
                            <div class="destinations-figure" style="width: 200px; height: 200px; border-radius: 50%; overflow: hidden; margin: 0 auto;">
                                <img src="./assets/img/Ground Spice.jpg" style="width: 100%; height: 100%; object-fit: cover;" class="img-fluid" alt="Destinations">
                            </div>
                            <span class="destinations-title mh-auto text-center" style="font-size:20px">Priya Verma</span>
                            <span class="destinations-title mh-auto text-center" style="font-size:20px">UI/UX Designer</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="destinations-block" style="border:none">
                            <div class="destinations-figure" style="width: 200px; height: 200px; border-radius: 50%; overflow: hidden; margin: 0 auto;">
                                <img src="./assets/img/Non Basmati Rice 2.jpg" style="width: 100%; height: 100%; object-fit: cover;" class="img-fluid" alt="Destinations">
                            </div>
                            <span class="destinations-title mh-auto text-center" style="font-size:20px">Aman Gupta</span>
                            <span class="destinations-title mh-auto text-center" style="font-size:20px">Project Manager</span>
                        </div>
                    </div>
                @endif
            </div>
            <div class="swiper-pagination" style="border:none"></div>
        </div>
    </div>
</div>





<style>
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
   <h2 style="text-align:center;padding-bottom:40px">Our Philosophy</h2>

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
 <h2 class="text-center">Our Expertise</h2>
</div>

<div class="swiper we-offer ">
<div class="swiper-wrapper " >

 @if (isset($services) && $services->count() > 0)
 @foreach ($services as $item)
<div class="swiper-slide c">
<div class="destinations-block">
<div class="destinations-figure">
    <img src="{{ asset($item->image) }}" class="img-fluid" alt="Destinations" style="object-fit: fill">
</div>
<span class="destinations-title mh-auto text-center">{{ $item->service_name }}</span>
</div>
</div>
 @endforeach
 @else
 <div class="swiper-slide">
<div class="destinations-block">
     <div class="destinations-figure">
<img src="./assets/img/architectural.jpeg" class="img-fluid" alt="Destinations">
</div>
<span class="destinations-title mh-auto text-center" style="font-size:20px">Architectural Design</span>
</div>
</div>
<div class="swiper-slide">
 <div class="destinations-block">
 <div class="destinations-figure">
 <img src="./assets/img/interior-design.jpg" class="img-fluid" alt="Destinations">
</div>
<span class="destinations-title mh-auto text-center" style="font-size:20px">Interior Design</span>
 </div>
</div>
<div class="swiper-slide">
<div class="destinations-block">
<div class="destinations-figure">
<img src="./assets/img/project-managment.jpg" class="img-fluid" alt="Destinations">
 </div>
<span class="destinations-title mh-auto text-center" style="font-size:20px">Project Management</span>
</div>
</div>
<div class="swiper-slide">
<div class="destinations-block">
    <div class="destinations-figure">
<img src="./assets/img/renovation-restoration.jpg" class="img-fluid" alt="Destinations">
</div>
<span class="destinations-title mh-auto text-center" style="font-size:20px">Renovation & Restoration</span>
 </div>
</div>
 <div class="swiper-slide">
<div class="destinations-block">
 <div class="destinations-figure">
 <img src="./assets/img/UrbanPlanning.jpg" class="img-fluid" alt="Destinations">
</div>
 <span class="destinations-title mh-auto text-center" style="font-size:20px">Urban Planning</span>
</div>
</div>
@endif

</div>

 <div class="swiper-pagination"></div> </div>

</div>
</div>
<style>
 
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

@endsection





