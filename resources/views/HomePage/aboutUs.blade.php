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
                <p class="text-justify" data-aos="fade-up">{!! $about_us_page_text ?? 'At Adiyogi Global, we are committed to delivering healthy, high-quality products to people around the
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

<div class="container">
   <h2 style="text-align:center;padding-bottom:40px">Our Phylosophy</h2>

<div class="card-container">
    <!-- Card 1 -->
    <div class="card">
      <img src="https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?cs=srgb&dl=pexels-souvenirpixels-414612.jpg&fm=jpg" alt="Nature">
      <div class="card-body">
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.This is a longer card with supporting text below as a natural lead-in to additional contentThis is a longer card with supporting text below as a natural lead-in to additional content..</p>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="card">
      <img src="https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?cs=srgb&dl=pexels-souvenirpixels-414612.jpg&fm=jpg" alt="Technology">
      <div class="card-body">
        <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
      </div>
    </div>

    <!-- Card 3 -->
    <div class="card">
      <img src="https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?cs=srgb&dl=pexels-souvenirpixels-414612.jpg&fm=jpg" alt="Adventure">
      <div class="card-body">
        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
      </div>
    </div>
  </div>
                </div>
<!-- team section !-->
<div class="destinations pt-5 pb-4" data-aos="fade-up">
  <div class="custom-container">
    <div class="site-title pb-4">
 <h2 class="text-center">Our Team</h2>
</div>

<div class="swiper we-offer ">
<div class="swiper-wrapper " >

 <div class="swiper-slide">
<div class="destinations-block" style="border:none">
     <div class="destinations-figure" style="width: 200px;
  height: 200px;
  border-radius: 50%;
  overflow: hidden;
  margin: 0 auto;">
<img style="width: 100%; height: 100%; object-fit: cover;" src="https://plus.unsplash.com/premium_photo-1689568126014-06fea9d5d341?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8cHJvZmlsZXxlbnwwfHwwfHx8MA%3D%3D"  class="img-fluid" alt="Destinations">
</div>
<span class="destinations-title mh-auto text-center" style="font-size:20px">Basmati Rice</span>
<span class="destinations-title mh-auto text-center" style="font-size:20px">Web developer</span>

</div>
</div>
<div class="swiper-slide">
 <div class="destinations-block" style="border:none">
 <div class="destinations-figure" style="width: 200px;
  height: 200px;
  border-radius: 50%;
  overflow: hidden;
  margin: 0 auto;">
 <img src="./assets/img/Ground Spice.jpg" style="width: 100%; height: 100%; object-fit: cover;" class="img-fluid" alt="Destinations">
</div>
<span class="destinations-title mh-auto text-center" style="font-size:20px">Ground Spices</span>
<span class="destinations-title mh-auto text-center" style="font-size:20px">Web developer</span>

 </div>
</div>
<div class="swiper-slide">
<div class="destinations-block" style="border:none">
<div class="destinations-figure" style="width: 200px;
  height: 200px;
  border-radius: 50%;
  overflow: hidden;
  margin: 0 auto;">
<img src="data:image/jpeg;base64,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" style="width: 100%; height: 100%; object-fit: cover;" class="img-fluid" alt="Destinations">
 </div>
<span class="destinations-title mh-auto text-center" style="font-size:20px">Fresh Fruits & Vegetables</span>
<span class="destinations-title mh-auto text-center" style="font-size:20px">Web developer</span>

</div>
</div>
<div class="swiper-slide">
<div class="destinations-block" style="border:none">
    <div class="destinations-figure" style="width: 200px;
  height: 200px;
  border-radius: 50%;
  overflow: hidden;
  margin: 0 auto;">
<img src="./assets/img/Non Basmati Rice 2.jpg" style="width: 100%; height: 100%; object-fit: cover;" class="img-fluid" alt="Destinations">
</div>
<span class="destinations-title mh-auto text-center" style="font-size:20px">Non Basmati Rice</span>
<span class="destinations-title mh-auto text-center" style="font-size:20px">Web developer</span>

 </div>
</div>
 <div class="swiper-slide">
<div class="destinations-block" style="border:none">
 <div class="destinations-figure" style="width: 200px;
  height: 200px;
  border-radius: 50%;
  overflow: hidden;
  margin: 0 auto;">
 <img src="./assets/img/fresh-fruits-berries-.jpg" style="width: 100%; height: 100%; object-fit: cover;" class="img-fluid" alt="Destinations">
</div>
 <span class="destinations-title mh-auto text-center" style="font-size:20px">Fresh Fruits</span>
 <span class="destinations-title mh-auto text-center" style="font-size:20px">Web developer</span>

</div>
                        </div>


</div>

 <div class="swiper-pagination" style="border:none"></div> </div>


</div>
</div>
<style>
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

    @media (min-width:1000px) {
      .container {
        max-width: 1300px;
      }
    }

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
      min-height: 0px;
      max-height:200px
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


</script>

@endsection





