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
for choosing Adiyogi Global.' !!}</p>
                <div class="about-blocks pb-3" id="mission-sec">
                    <div class="about-item about-item-left">
                        <h3><b>Vision</b></h3>
                        <p class="text-justify" data-aos="fade-right">{!! $vision_content ?? 'To be a global leader in delivering healthy, high-quality products by sourcing the best from India,
fostering sustainable practices, and building lasting trust with our customers. We aim to enrich lives
worldwide by consistently providing goods that promote well-being and reflect our commitment to
excellence and integrity' !!}</p>
                    </div>
                    <img src="{{ asset($vision_image ?? './assets/img/vision (1).jpg') }}"  alt="" height="200px" width="200px" class="about-img">
</div>
<div class="about-blocks" id="mission-sec">
                    
                    <img src="{{ asset($mision_image ?? './assets/img/mission (1).jpg') }}" alt="" height="200px" width="200px" class="about-img">
                    <div class="about-item about-item-right">
                        <h3><b>Mission</b></h3>
                        <p class="text-justify" data-aos="fade-left">{!! $mision_content ?? 'Our mission at Adiyogi Global is to source and deliver the finest, healthiest products from India to the
world, ensuring exceptional quality and customer satisfaction. We strive to build strong relationships
with farmers and manufacturers, uphold ethical practices, and continuously exceed expectations
through innovation, transparency, and dedication to excellence.' !!}
</p>
                    </div>
                </div>
                <div class="about-blocks" id="mission-sec">
                <div class="about-item about-item-right">
                        <h3><b>Value</b></h3>
                        <p class="text-justify" data-aos="fade-right">{!! $value_content ?? '<b>Quality Excellence:</b> We are committed to delivering only the highest quality products,
ensuring that every item meets our rigorous standards for purity and freshness.<br>
 <b>Customer Trust:</b> We build and maintain strong relationships with our customers through
honesty, transparency, and consistent performance.<br>
<b> Sustainability: </b>We prioritize sustainable practices in sourcing and operations, supporting the
environment and the communities we work with.<br>
 <b>Integrity:</b> We conduct our business with the utmost integrity, honoring our commitments and
ensuring ethical practices in all aspects of our operations.<br>
<b> Respect for Tradition:</b> We value the rich heritage and craftsmanship of our products,
preserving traditional methods while delivering them to a global audience.' !!}
</p>
                    </div>
                    <img src="{{ asset($value_image ?? './assets/img/values (1).jpg') }}" alt="" height="200px" width="200px"class="about-img" >
                </div>
    
            </div>
        </div>
    </div>
</div>
@endsection





