@extends('layouts.webSite')
@section('title', 'Design Park Architects ')
@section('content')
    {{-- @include('include.navigation') --}}
    @include('include.slider')

    <!-- aboutus Section -->
  <div class="destinations pt-5 pb-2">
    <div class="custom-container">
        <div class="col-12 offerings-container">
            <div class="site-title">
                <h2 class="text-center">About Us</h2>
            </div>

            <div class="row align-items-center">
                <!-- Content Column (first on small devices) -->
                <div class="col-md-6 order-1 order-md-2" data-aos="fade-left">
                    <p class="text-justify mb-4" style="font-size:16px; line-height:1.8;">
                        {!! Str::limit(
                            $home_about_content ??
                            'Adiyogi Global is dedicated to providing healthy, high-quality products to customers worldwide. With over 12 years of experience, we source the finest goods directly from top farmers and manufacturers across India...',
                            1000,
                            '...'
                        ) !!}
                    </p>

                    <!-- ✅ Spacing only on small devices -->
                    <a href="{{ route('aboutUs') }}"
                       class="btn about-us-btn mb-4 mb-md-0 d-inline-block"
                       style="padding:10px 20px; border:none; background-color:#070736fc; color:white;">
                       Know More
                    </a>
                </div>

                <!-- Image Column (second on small devices) -->
                <div class="col-md-6 mb-3 order-2 order-md-1" data-aos="fade-right">
                    <img src="{{ isset($home_about_image) ? asset($home_about_image) : asset('assets/img/Random Pics.jpeg') }}"
                         alt="About Us"
                         class="img-fluid rounded w-100"
                         style="height:300px; object-fit:cover;">
                </div>
            </div>
        </div>
    </div>
</div>



<style>
    /* Specific style for this button */
    .about-us-btn {
        transition: background-color 0.3s ease, color 0.3s ease;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        border-radius: 5px; /* Optional */
    }

    .about-us-btn:hover {
        background-color: red !important; /* Use !important if other styles are overriding */
        color: white !important; /* Use !important if other styles are overriding */
    }
</style>
  
<style>
.custom-container, .offerings-container {
    overflow-x: hidden;
}
</style>


  <!-- About Section End
        <section class="chairperson">
            <div class="custom-container">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <div class="chairperson-figure pb-5">
                            <?php if(!empty($getChairManData['0']->image)) { ?>
                            <img src="<?php echo url($getChairManData['0']->image); ?>" width="" height="" class="img-fluid" alt="Chairperson's" />
                            <?php } else{ ?>
                                <img src="assets/img/Mukesh-Kumar-Pandey-ji.png" width="" height="" class="img-fluid" alt="Chairperson's" />
                                <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-8">
                <?php if(!empty($getChairManData['0']->message)) { ?>
                    <div class="chairperson-content">
                        <h3>Message from Chairperson’s Desk</h3>
                        <p><b>Welcome!</b><br>
                           {!! $getChairManData['0']->message !!}</b><br><span>(<?php echo $getChairManData['0']->name; ?>)</span></p>getChairManData
                    </div>
                    <?php } else { ?>
                        <div class="chairperson-content">
                            <h3>Message from Chairperson’s Desk</h3>
                            <p><b>Welcome!</b><br>
                                I am immensely proud of the journey KRISHIDHA FPO has undertaken. We started with a vision to empower our fellow farmers and transform their livelihoods. Today, seeing hundreds of families thriving under our umbrella fills me with immense satisfaction. Our commitment is unwavering. We will continue to work relentlessly to provide our farmers with the resources, knowledge, and support they need to achieve agricultural success. Join us on this journey of growth and prosperity!<br><b>Warm regards,</b><br><span>(Mr. Mukesh Kumar Pandey)</span></p>getChairManData
                        </div>
                     <?php }?>

                    </div>
                </div>
            </div>
        </section> -->

   <!-- Destinations Section -->
<!-- Our Expertise Section -->
<div class="destinations pt-5 pb-4 expertise-section" data-aos="fade-up">
    <div class="custom-container">
        <div class="site-title pb-4">
            <h2 class="text-center">Our Expertise</h2>
        </div>

        {{-- Standard Bootstrap Row and Columns (no Swiper) --}}
        <div class="row justify-content-center">
            {{-- Check if $services is set and has items --}}
            @if (isset($services) && $services->count() > 0)
                @foreach ($services as $item)
                    {{-- Each service item is now a Bootstrap column --}}
                    <div class="col-md-4 col-sm-6 mb-4">
                        {{-- This is the 'destinations-block' structure from your Gallery Swiper slide --}}
                        <a href="{{ route('productPage') }}" class="destinations-block text-center text-decoration-none" style="background:none; display:block;height:300px !important;">
    <div class="destinations-figure d-flex align-items-center justify-content-center">
        <img src="{{ asset($item->image) }}" class="img-fluid" alt="{{ $item->service_name }}"
             style="width:100%; height:250px; object-fit:contain; border-radius:20px;">
    </div>
    <span class="destinations-title d-block " style="font-size:20px;">
        {{ $item->service_name }}
    </span>
</a>
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
{{-- <style>

/* Only applies to expertise section – safer */
.expertise-section .destinations-block {
    text-align: center !important;
    background: none !important;
    display: flex !important;
    flex-direction: column !important;
    justify-content: space-between !important;
    align-items: center !important;
    height: 320px !important;
    width: 100% !important;
    padding: 0 !important;
    border-radius: 20px !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08) !important;
    transition: transform 0.3s ease, box-shadow 0.3s ease !important;
    overflow: hidden !important;
}

.expertise-section .destinations-block:hover {
    transform: translateY(-5px) !important;
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15) !important;
}

.expertise-section .destinations-figure {
    width: 100% !important;
    height: 250px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    border-radius: 20px !important;
    overflow: hidden !important;
    background-color: #f8f8f8 !important;
    margin-bottom: 10px !important;
}

.expertise-section .destinations-figure img {
    width: 100% !important;
    height: 100% !important;
    object-fit: contain !important;
    border-radius: 20px !important;
    transition: transform 0.3s ease !important;
}

.expertise-section .destinations-block:hover img {
    transform: scale(1.05) !important;
}

.expertise-section .destinations-title {
    font-size: 20px !important;
    font-weight: bold !important;
    color: #333 !important;
    margin-top: auto !important;
    margin-bottom: 0 !important;
    text-align: center !important;
}


</style> --}}
@endpush

<!-- Why Choose Us Section -->
<section class="our-service pt-5 pb-5">
    <div class="custom-container">
        <div class="site-title pb-4">
            <h2 class="text-center">Our Resolutions</h2>
        </div>

        <div class="row">
            @if (isset($why_choose_us) && count($why_choose_us))
                @foreach ($why_choose_us as $item)
                    <div class="col-md-4 mb-4">
    <div class="our-block text-center" 
         onmouseover="this.querySelectorAll('img').forEach(img => { img.style.filter='invert(1)'; img.style.transform='scale(1.1)'; });" 
         onmouseout="this.querySelectorAll('img').forEach(img => { img.style.filter='invert(0)'; img.style.transform='scale(1)'; });">

        <div class="our-block-figure">
            @if ($item->icon && file_exists(public_path($item->icon)))
                <img src="{{ asset($item->icon) }}" 
                     alt="Icon" 
                     style="height:40px; transition:filter 0.3s, transform 0.3s;">
            @else
                <i class="fa fa-star" style="font-size:30px"></i>
            @endif
        </div>

        <div class="our-content mt-2">
            <p style="font-size:18px; line-height:50px;">{{ $item->title }}</p>
        </div>

    </div>
</div>

                @endforeach
            @else
                @php
                    $default_services = [
                        ['icon' => 'fa-sliders', 'title' => 'Audio-Video Support'],
                        ['icon' => 'fa-award', 'title' => 'Live Streaming'],
                        ['icon' => 'fa-star', 'title' => 'Event Management - Townhall'],
                        ['icon' => 'fa-headphones', 'title' => 'Audio-Video Rentals'],
                        ['icon' => 'fa-fire', 'title' => 'Onsite Support'],
                        ['icon' => 'fa-wallet', 'title' => 'Specialized AV Solutions'],
                    ];
                @endphp

                @foreach ($default_services as $service)
                    <div class="col-md-4 mb-4">
                        <div class="our-block text-center">
                            <div class="our-block-figure">
                                <i class="fa-solid {{ $service['icon'] }}" style="font-size:30px;"></i>
                            </div>
                            <div class="our-content mt-2">
                                <p style="font-size:18px; line-height:50px;">{{ $service['title'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

<!-- Gallery Slider Section -->
<div class="destinations pt-5 pb-4" data-aos="fade-up" >
    <div class="custom-container">
        <div class="site-title pb-4">
            <h2 class="text-center">Gallery</h2>
        </div>

        <div class="swiper we-offer">
            <div class="swiper-wrapper" style="max-height:250px; margin-bottom: 20px;">
                {{-- Check if $galleryImages is set and has images --}}
                @if (isset($galleryImages) && $galleryImages->count())
                    @foreach ($galleryImages as $image)
                        <div class="swiper-slide">
                            <a href="{{ url('/gallery') }}" class="text-decoration-none">
                                <div class="destinations-block text-center" style="background:none;">
                                    <div class="destinations-figure d-flex align-items-center justify-content-center" style="max-height:200px">
                                        <img src="{{ url($image->local_image) }}" alt="Gallery Image"
                                             style="width:100%; height:250px; object-fit:contain; border-radius:20px;">
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    @php
                        $fallbackImages = [
                            'assets/img/Basmati rice.jpeg',
                            'assets/img/Ground Spice.jpg',
                            'assets/img/Fruit & Vegitables 2.jpg',
                            'assets/img/Non Basmati Rice 2.jpg',
                            'assets/img/fresh-fruits-berries-.jpg',
                        ];
                    @endphp

                    @foreach ($fallbackImages as $img)
                        <div class="swiper-slide">
                            <a href="{{ url('/gallery') }}" class="text-decoration-none">
                                <div class="destinations-block text-center" style="background:none;">
                                    <div class="destinations-figure d-flex align-items-center justify-content-center">
                                        <img src="{{ asset($img) }}" alt="Gallery Image"
                                             style="width:100%; height:250px; object-fit:cover; border-radius:20px;">
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>


<style>
    @media (max-width: 576px) {
    .our-block {
        width: 260px;
        margin-left: auto;
        margin-right: auto;
    }
}

</style>

    {{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Newsletter Section</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"> --}}
    <style>.simple-newsletter {
  background: #f4f6f8;
  border-top: 1px solid #dee2e6;
}

.simple-newsletter h5 {
  font-size: 1.2rem;
}

.simple-newsletter input,
.simple-newsletter canvas {
  height: 34px;
  line-height: 1;
}

#simpleCaptcha {
  margin-right: 0.25rem;
}

.btn-outline-secondary {
  height: 34px;
}

    </style>

    <!-- @if($blog->isNotEmpty())
<div id="home-articles" class="pt-5 pb-4">
    <div class="custom-container">
        <div class="site-title pb-3">
            <h2 class="text-center">Our Articles</h2>
        </div>
        <div class="blog-container midd-content">
            <div class="row">
                @foreach ($blog as $BlogRow)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="blog-card h-100" onclick="window.location.href='{{ url('/blog/' . $BlogRow['slug']) }}'">
                            <div class="blog-card-image">
                                <img src="{{ url($BlogRow['image']) }}" class="img-fluid" alt="{{ $BlogRow['title'] }}" />
                            </div>
                            <div class="blog-card-content">
                                <h3 class="blog-title">{{ $BlogRow['title'] }}</h3>
                                <div class="blog-meta">
                                    <span class="blog-date">{{ \Carbon\Carbon::parse($BlogRow['blog_date'])->format('M d, Y') }}</span>
                                </div>
<a href="{{ route('blogDetails', $BlogRow['slug']) }}" class="btn btn-primary blog-details-btn">Read More</a>                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif -->


<!-- <style>
    .blog-details-btn {
    background-color: #070736fc; /* Initial background color */
    color: white; /* Initial text color */
    border: none; /* Ensure no border */
    padding: 10px 20px; /* Example padding, adjust as needed */
    transition: background-color 0.3s ease, color 0.3s ease; /* Smooth transition */
    text-decoration: none; /* Remove underline */
    display: inline-block; /* Essential for padding/sizing */
    text-align: center;
    border-radius: 5px; /* Optional: adds slight rounded corners */
}

/* Hover effect for the "Read More" button */
.blog-details-btn:hover {
    background-color: red !important; /* Change to red on hover, use !important if btn-primary overrides */
    color: white !important; /* Keep text white on hover, use !important if btn-primary overrides */
}
.blog-card {
    background: #fff !important;
    border-radius: 10px !important;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
    overflow: hidden !important;
    transition: transform 0.3s ease, box-shadow 0.3s ease !important;
    cursor: pointer !important;
}
.blog-card:hover {
    transform: translateY(-5px) !important;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2) !important;
}
.blog-card-image {
    width: 100% !important;
    height: 200px !important;
    overflow: hidden !important;
}
.blog-card-image img {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    transition: transform 0.3s ease !important;
}
.blog-card:hover .blog-card-image img {
    transform: scale(1.05) !important;
}
.blog-card-content {
    padding: 20px !important;
}
.blog-title {
    font-size: 1.25rem !important;
    font-weight: 600 !important;
    margin-bottom: 10px !important;
    color: #333 !important;
}
.blog-meta {
    margin-bottom: 15px !important;
}
.blog-date {
    color: #666 !important;
    font-size: 0.9rem !important;
}
.blog-details-btn {
    background-color: #070736fc !important;
    border: none !important;
    padding: 8px 20px !important;
    border-radius: 5px !important;
    color: white !important;
    text-decoration: none !important;
    font-weight: 500 !important;
    transition: background-color 0.3s ease !important;
}
/* .blog-details-btn:hover {
    background-color: #000066 !important;
    color: white !important;
} */
.blog-container .row {
    margin: 0 -15px !important;
}
.blog-container .row > div {
    padding: 0 15px !important;
}
@media (max-width: 768px) {
    .col-md-6 {
        flex: 0 0 100% !important;
        max-width: 100% !important;
    }
}

</style> -->

    <section class="simple-newsletter py-4 bg-light">
  <div class="container">
    <div class="row align-items-center justify-content-center text-center">
      <div class="col-md-8">
        <h5 class="fw-semibold mb-2">Subscribe to Our Newsletter</h5>
        <p class="text-muted small mb-3">Get the latest updates, straight to your inbox.</p>
       <form class="d-flex flex-column flex-md-row align-items-center justify-content-center gap-2" id="simpleNewsletterForm" autocomplete="off">
  <input type="email" class="form-control form-control-sm w-100 w-md-auto" placeholder="Your email" id="simpleEmail" required style="max-width:250px;border: 1px solid black;">

  <!-- CAPTCHA canvas -->
  <canvas id="simpleCaptcha" width="100" height="34" style="border-radius:5px; background:#f8f9fa;"></canvas>

  <!-- Refresh button -->
  <button type="button" class="btn btn-outline-secondary btn-sm px-2" style="border: 1px solid black;" onclick="drawSimpleCaptcha()" title="Refresh Captcha">
    <i class="fas fa-sync-alt"></i>
  </button>

  <!-- CAPTCHA input -->
  <input type="text" class="form-control form-control-sm" placeholder="Enter code" id="simpleCaptchaInput" required style="max-width:120px;border: 1px solid black;">
  
  <!-- Subscribe -->
<button class="btn btn-sm subscribe-btn" style="background-color: #070736fc; color: white; padding:10px 0px; font-size:15px;border-radius:5px;text-align:justify;width:113px" type="submit">
    <i class="fas fa-paper-plane me-1"></i>Subscribe
</button></form>

        <small class="text-muted d-block mt-2">We respect your privacy. Unsubscribe anytime.</small>
      </div>
    </div>
  </div>
</section>


   <script>
  function randomSimpleCaptcha(len = 5) {
    const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
    let code = '';
    for (let i = 0; i < len; i++) code += chars[Math.floor(Math.random() * chars.length)];
    return code;
  }

  function drawSimpleCaptcha() {
    const canvas = document.getElementById('simpleCaptcha');
    const ctx = canvas.getContext('2d');
    const code = randomSimpleCaptcha();
    canvas.dataset.code = code;

    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.fillStyle = '#fff';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    ctx.font = '20px Arial';
    ctx.fillStyle = '#333';
    ctx.fillText(code, 10, 24);
  }

  document.addEventListener('DOMContentLoaded', drawSimpleCaptcha);

  document.getElementById('simpleNewsletterForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const email = document.getElementById('simpleEmail').value.trim();
    const input = document.getElementById('simpleCaptchaInput').value.trim().toUpperCase();
    const code = document.getElementById('simpleCaptcha').dataset.code;

    if (!email || !email.match(/^[^@\s]+@[^@\s]+\.[^@\s]+$/)) {
      alert('Please enter a valid email.');
      return;
    }

    if (input !== code) {
      alert('Incorrect captcha. Try again.');
      drawSimpleCaptcha();
      return;
    }

    // AJAX to Laravel
    fetch("{{ route('subscribe') }}", {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({ email: email })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert(data.success);
        e.target.reset();
        drawSimpleCaptcha();
      } else if (data.error) {
        alert(data.error);
        drawSimpleCaptcha();
      }
    })
    .catch(err => {
      console.error(err);
      alert('An error occurred. Please try again.');
      drawSimpleCaptcha();
    });
  });
</script>




    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> --}}
    {{-- <script>
        // Captcha functionality
        function refreshCaptcha() {
            const captchaCode = document.getElementById('captcha-code');
           const refreshBtn = document.querySelector('.captcha-refresh-btn');

            // Add spinning animation
            refreshBtn.innerHTML = '<i class="fas fa-sync-alt fa-spin"></i>';

            setTimeout(() => {
                // Generate new captcha code
                const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                let newCode = '';
                for (let i = 0; i < 5; i++) {
                    newCode += characters.charAt(Math.floor(Math.random() * characters.length));
                }
                captchaCode.textContent = newCode;

                // Clear captcha input
                document.getElementById('captcha').value = '';

                // Reset button
                refreshBtn.innerHTML = '<i class="fas fa-sync-alt"></i>';

                // Add flash effect
                captchaCode.parentElement.style.background = '#e3f2fd';
                setTimeout(() => {
                    captchaCode.parentElement.style.background = '#f8f9fa';
                }, 300);
            }, 500);
        }

        // Form submission animation
        document.getElementById('newsletterForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const email = document.getElementById('emailInput').value;
            const captcha = document.getElementById('captcha').value;
            const expectedCaptcha = document.getElementById('captcha-code').textContent;
            const button = this.querySelector('.btn-subscribe');
            const originalText = button.innerHTML;

            // Validate captcha
            if (captcha.toUpperCase() !== expectedCaptcha) {
                // Captcha error animation
                const captchaInput = document.getElementById('captcha');
                captchaInput.style.borderColor = '#dc3545';
                captchaInput.style.boxShadow = '0 0 10px rgba(220,53,69,0.3)';
                captchaInput.focus();

                setTimeout(() => {
                    captchaInput.style.borderColor = '#e9ecef';
                    captchaInput.style.boxShadow = '0 2px 4px rgba(0,0,0,0.05)';
                }, 2000);

                return;
            }

            // Loading animation
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Subscribing...';
            button.disabled = true;

            setTimeout(() => {
                // Success animation
                button.innerHTML = '<i class="fas fa-check me-2"></i>Subscribed!';
                button.classList.add('btn-success');
                button.classList.remove('btn-subscribe');

                // Add success shake animation
                button.style.animation = 'pulse 0.5s ease-in-out';

                // Reset form
                document.getElementById('emailInput').value = '';
                document.getElementById('captcha').value = '';
                refreshCaptcha();

                // Reset button after 3 seconds
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.disabled = false;
                    button.classList.remove('btn-success');
                    button.classList.add('btn-subscribe');
                    button.style.animation = '';
                }, 3000);

            }, 1500);
        });

        // Add intersection observer for scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, observerOptions);

        // Observe all fade-in elements
        document.querySelectorAll('.fade-in-up').forEach(el => {
            el.style.animationPlayState = 'paused';
            observer.observe(el);
        });

        // Add pulse animation keyframe
        const style = document.createElement('style');
        style.textContent = `
            @keyframes pulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.05); }
                100% { transform: scale(1); }
            }
        `;
        document.head.appendChild(style);
    </script> --}}

    {{-- new letter --}}

    <!-- </div>
        </section> -->
    <!-- <section class="our_partner pt-5 pb-2">
            <div class="custom-container">
                <div class="site-title pb-3">
                    <h2 class="text-center">Our Partner</h2>
                </div>
                <div class="row">
                    @if (!empty($partnersImages))
                    @foreach ($partnersImages as $PartnerRow)
    <div class="col-4">
                        <div style="width:auto;height:150px;overflow:hidden;">
                            <img src="{{ url($PartnerRow->image) }}" alt="deHaat"  class="img-fluid" />
                        </div>
                    </div>
    @endforeach
@else
    <div class="col-4">
                        <img src="assets/img/deHaat-logo.png" alt="deHaat" width="200" height="" class="img-fluid" />
                    </div>
                    <div class="col-4">
                        <img src="assets/img/amrit.jpg" alt="deHaat" width="200" height="" class="img-fluid" />
                    </div>
                    <div class="col-4">
                        <img src="assets/img/guiding.jpg" alt="deHaat" width="200" height="" class="img-fluid" />
                    </div>
                     @endif

                </div>
            </div>
        </section> -->
    <!-- {{-- Testimonial Section End  --}} -->

     <style>

        .subscribe-btn {
    /* Initial background and color are already set inline, but add transition here */
    transition: background-color 0.3s ease, color 0.3s ease;
    cursor: pointer; /* Indicate it's clickable */

}

/* Hover effect for the Subscribe button */
.subscribe-btn:hover {
    background-color: red !important; /* Change to red on hover, use !important to override inline */
    color: white !important; /* Keep text white on hover, use !important to override inline */
}
        .custom-modal .modal-dialog {
            max-width: 60% !important;
            height: 500px;
        }
        
        .custom-modal .modal-content {
            height: 500px;
            /* background: linear-gradient(135deg, #e4e1e0 0%, #91d7d8 100%); */
            /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); */
            background: #a8b2c5;
            border: none;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            position: relative;
            overflow: hidden;
        }
        
        .custom-modal .modal-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="construction" patternUnits="userSpaceOnUse" width="20" height="20"><rect fill="%23000" fill-opacity="0.05" width="20" height="20"/><rect fill="%23000" fill-opacity="0.1" width="10" height="10"/><rect fill="%23000" fill-opacity="0.1" x="10" y="10" width="10" height="10"/></pattern></defs><rect width="100" height="100" fill="url(%23construction)"/></svg>');
            opacity: 0.1;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .custom-modal .modal-dialog {
                max-width: 90% !important;
                margin: 1rem;
                height: 450px;
            }
            .custom-modal .modal-content {
                height: 450px;
            }
        }
        
        @media (max-width: 576px) {
            .custom-modal .modal-dialog {
                max-width: 95% !important;
                margin: 0.5rem;
                height: 400px;
            }
            .custom-modal .modal-content {
                height: 400px;
            }
        }
        
        .modal-header {
            border-bottom: none;
            padding: 20px 20px 0;
            position: relative;
            z-index: 2;
        }
        
        .modal-body {
            padding: 0;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: calc(100% - 70px);
            position: relative;
            z-index: 2;
        }
        
        .close-btn {
            background: rgba(255,255,255,0.2);
            border: 2px solid rgba(16, 15, 15, 0.3);
            font-size: 1.8rem;
            color: rgb(8, 8, 8);
            cursor: pointer;
            padding: 0;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
            font-weight: bold;
        }
        
        .close-btn:hover {
            background: rgba(255,255,255,0.3);
            border-color: rgba(255,255,255,0.5);
            transform: scale(1.1);
        }
        
        .construction-icon {
            font-size: 4rem;
            color: white;
            margin-bottom: 20px;
            animation: bounce 2s infinite;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }
        
        .modal-text {
            font-size: 1.8rem;
            line-height: 1.4;
            color: white;
            margin: 0;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            max-width: 80%;
            text-align: center;
        }
        
        .coming-soon {
            font-size: 1.2rem;
            color: rgba(255,255,255,0.9);
            margin-top: 15px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
    </style>
    {{-- <div class="container mt-5">
        <h1>Welcome to Our Website</h1>
        <p>This is your main content. The modal will show automatically when the page loads.</p>
    </div> --}}

    <!-- Bootstrap Modal -->
    <div class="modal fade custom-modal" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close-btn ms-auto" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="construction-icon">🚧</div>
                    <p class="modal-text">
                        We are currently updating our website to bring you a better and more interesting experience.
                    </p>
                    {{-- <div class="coming-soon">Coming Soon</div> --}}
                </div>
            </div>
        </div>
    </div>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script to show modal automatically -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show modal immediately when page loads
            var updateModal = new bootstrap.Modal(document.getElementById('updateModal'));
            updateModal.show();
        });
    </script>


@endsection
<style>
    .about-image {
        display: flex;
    }

    .about-text {
        display: end;
    }

    .our_services-title+p {
        font: 400 14px/normal var(--font-josefin);
        color: rgb(var(--black-color));
    }

    .our_services-title+p {
        margin-bottom: 10px;
        display: -webkit-box;
        max-width: 100%;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .custom-container,
    .header-contaner {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    #ourServices {
        justify-content: center;
    }

    .our-block {

        padding: 1rem;
        transition: var(--transition);
        cursor: pointer;
        background-color: #fff;
        position: relative;

        z-index: 0;
        min-height: 100px;
    }

    .our-block::before {
        transition: var(--transition);
        content: '';
        position: absolute;
        top: 0rem;
        right: 0rem;
        bottom: 0rem;
        left: 0rem;
        background-color: #fff;
        box-shadow: 0px 0px 15px -5px rgb(0 0 0 / 30%);
        z-index: -1;
    }

    .our-block:hover:before {
        top: -0.4rem;
        right: -0.4rem;
        bottom: -0.4rem;
        left: -0.4rem;
    }

    .our-block-figure>svg {
        font-size: 30px;
        color: var(--primary-bg);
        transition: var(--transition);
        position: relative;
        left: 0;
        top: 0;
    }

    .our-block-figure {
        float: left;
        position: relative;
        transition: var(--transition);
    }

    .our-block-figure::after {
        content: '';
        position: absolute;
        left: -1rem;
        top: -1rem;
        width: calc(100% + 2rem);
        height: calc(100% + 2rem);
        background-color: rgba(1, 0, 102, 255);
        border: 5px solid rgba(1, 0, 102, 255);
        border-bottom-right-radius: 100%;
        transform: scale(0) translate(-100%, -100%);
        transition: var(--transition);
        z-index: -1;
    }

    .our-block:hover>.our-content h4.our-title {
        color: rgba(1, 0, 102, 255);
        font-weight: 700;
    }

    .our-block:hover .our-block-figure>svg {
        color: #fff;
        top: -5px;
        left: -5px;
    }

    .our-block:hover .our-block-figure::after {
        transform: scale(1) translate(0%, 0%);
    }

    .our-block:hover {
        border-color: rgba(1, 0, 102, 255);
    }

    .our-block:hover:before {
        background-color: #fff;
        top: 0rem;
        bottom: 0rem;
        right: 0rem;
        left: 0rem;
    }

    .our-block>.our-content {
        margin-left: 50px;
        text-align: left;
        margin-top: 14px;
    }

    .our-block>.our-content h4.our-title {
        font: 500 16px/normal var(--lato-font);
        margin-bottom: 10px;
        color: var(--primary-bg);
        transition: var(--transition);
    }

    .our-content p {
        font-size: 15px;
        line-height: 20px;
    }
</style>


@section('script')
    <script>
        let site_url = '{{ url('/') }}';
    </script>
    {{-- <script src="js/homePage.js?v=2"></script> --}}
@endsection
