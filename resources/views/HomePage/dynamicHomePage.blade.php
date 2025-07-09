@extends('layouts.webSite')
@section('title', 'RN Communication ')
@section('content')
    {{-- @include('include.navigation') --}}
    @include('include.slider')

    <!-- aboutus Section -->
    <div class="destinations pt-5 pb-2">
        <div class="custom-container">
            <!-- <div class="site-title">
                <h2 class="text-center">About Us</h2>
            </div>
            <div class="about-image">
                <img src="./assets/img/chilli.jpg" alt="" style="object-fit: cover;

    height: 300px;
    width: 400px;">
                <div class="about-text">
            <p >{!! isset($aboutText['0']->sort_about_us) ? $aboutText['0']->sort_about_us : 'Please fill about data from admin panel.'  !!}</p>
</div>
</div> -->
<div class="col-md-12 mb-4 offerings-container">
<div class="site-title">
                <h2  class="text-center">About Us</h2>
            </div>
                    <div class="offerings-block">
                        <div class="offerings-content" >
                       <p class="text-justify">{!! $home_about_content ?? 'Adiyogi Global is dedicated to providing healthy, high-quality products to customers worldwide. With
                        over 12 years of experience, we source the finest goods directly from top farmers and manufacturers
                        across India. Our commitment to quality and transparency ensures that every product meets the highest
                        standards of purity and freshness. We take pride in earning the trust of our customers through
                        exceptional service and a deep dedication to their well-being. At Adiyogi Global, we bring the best of
                        India to the world, always prioritizing quality and care.Customer trust is the foundation of Adiyogi Global. We are committed to earning and maintaining this
                        trust through transparency, integrity, and exceptional service. From your first interaction with us, we
                        aim to provide a seamless and satisfying experience.' !!}</p>

                        </div>
                        <div class="offerings-figure"data-aos="fade-right">
                            <img src="{{ asset($home_about_image ?? './assets/img/Random Pics.jpeg') }}" class="img-fluid rounded" width="" height="" alt="Bikaner">
                        </div>
                    </div>
                </div>

        </div>
    </div>
    <!-- About Section End
    <section class="chairperson">
        <div class="custom-container">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="chairperson-figure pb-5">
                        <?php if(!empty($getChairManData['0']->image)) { ?>
                        <img src="<?php echo url($getChairManData['0']->image)?>" width="" height="" class="img-fluid" alt="Chairperson's" />
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
                       {!! $getChairManData['0']->message  !!}</b><br><span>(<?php echo $getChairManData['0']->name?>)</span></p>getChairManData
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
<div class="destinations pt-5 pb-4" data-aos="fade-up">
  <div class="custom-container">
    <div class="site-title pb-4">
            <h2 class="text-center">Our Services</h2>
        </div>

        <div class="swiper we-offer">
            <div class="swiper-wrapper">

                @if ($home_products->count())
                    @foreach ($home_products as $item)
                        <div class="swiper-slide">
                            <div class="destinations-block">
                                <div class="destinations-figure">
                                    <img src="{{ asset($item->image) }}" class="img-fluid" alt="Destinations">
                                </div>
                                <span class="destinations-title mh-auto text-center">{{ $item->heading_top }}</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="swiper-slide">
                        <div class="destinations-block">
                            <div class="destinations-figure">
                                <img src="./assets/img/Basmati rice.jpeg" class="img-fluid" alt="Destinations">
                            </div>
                            <span class="destinations-title mh-auto text-center">Basmati Rice</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="destinations-block">
                            <div class="destinations-figure">
                                <img src="./assets/img/Ground Spice.jpg" class="img-fluid" alt="Destinations">
                            </div>
                            <span class="destinations-title mh-auto text-center">Ground Spices</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="destinations-block">
                            <div class="destinations-figure">
                                <img src="./assets/img/Fruit & Vegitables 2.jpg" class="img-fluid" alt="Destinations">
                            </div>
                            <span class="destinations-title mh-auto text-center">Fresh Fruits & Vegetables</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="destinations-block">
                            <div class="destinations-figure">
                                <img src="./assets/img/Non Basmati Rice 2.jpg" class="img-fluid" alt="Destinations">
                            </div>
                            <span class="destinations-title mh-auto text-center">Non Basmati Rice</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="destinations-block">
                            <div class="destinations-figure">
                                <img src="./assets/img/fresh-fruits-berries-.jpg" class="img-fluid" alt="Destinations">
                            </div>
                            <span class="destinations-title mh-auto text-center">Fresh Fruits</span>
                        </div>
                    </div>
                @endif

            </div>

            <div class="swiper-pagination"></div>
        </div>

        <div class="view-button text-center pt-4">
            <a href="{{ route('productPage') }}">Know more</a>
        </div>
    </div>
</div>
<!-- Destinations Section End -->


     <!-- Destinations Section -->
      <!-- <div class="destinations pt-5 pb-2">
        <div class="custom-container">
            <div class="site-title pb-0">
                <h2 class="text-center">Glimpse of Product</h2>
                <div class="destinations-block">
                                <div class="destinations-figure">
                                    <img src="./assets/img/chilli.jpg" class="img-fluid" width="" height="" alt="Destinations">
                                </div>
                                <span class="destinations-title mh-auto text-center">Chilli</span>
                            </div>
            <p class="text-center">Embark on unforgettable journeys to exotic destinations with our expertly crafted travel experiences.</p> --}}
            </div>
            <div class="swiper glimpse">
                <div class="swiper-wrapper">
                    @if (!empty($getAllProduts))
                        @foreach ($getAllProduts as $product)
                            <div class="swiper-slide mb-4">
                                <div class="destinations-block">
                                    <div style="width: auto;height: 150px; overflow: hidden;">
                                        <img src="{{ url($product->p_img) }}" class="img-fluid"
                                        alt="{!! $product->p_name !!}" style="width: 100%;height: 100%; object-fit: cover;">
                                    </div>
                                    <span class="destinations-title mh-auto text-center">{!! $product->p_name !!}</span>
                                </div>
                            </div>
                        @endforeach
                        @else
                        <div class="swiper-slide mb-4">
                            <div class="destinations-block">
                                <div class="destinations-figure">
                                    <img src="./assets/img/chilli.jpg" class="img-fluid" width="" height="" alt="Destinations">
                                </div>
                                <span class="destinations-title mh-auto text-center">Chilli</span>
                            </div>
                        </div>
                        <div class="swiper-slide mb-4">
                            <div class="destinations-block">
                                <div class="destinations-figure">
                                    <img src="assets/img/Wheat.jpg" class="img-fluid" width="" height="" alt="Destinations">
                                </div>
                                <span class="destinations-title mh-auto text-center">Wheat</span>
                            </div>
                        </div>
                        <div class="swiper-slide mb-4">
                            <div class="destinations-block">
                                <div class="destinations-figure">
                                    <img src="assets/img/tomato.jpg" class="img-fluid" width="" height="" alt="Destinations">
                                </div>
                                <span class="destinations-title mh-auto text-center">Tomato</span>
                            </div>
                        </div>
                        <div class="swiper-slide mb-4">
                            <div class="destinations-block">
                                <div class="destinations-figure">
                                    <img src="assets/img/main-peas.jpg" class="img-fluid" width="" height="" alt="Destinations">
                                </div>
                                <span class="destinations-title mh-auto text-center">Peas</span>
                            </div>
                        </div>
                        <div class="swiper-slide mb-4">
                            <div class="destinations-block">
                                <div class="destinations-figure">
                                    <img src="assets/img/Paddy.jpg" class="img-fluid" width="" height="" alt="Destinations">
                                </div>
                                <span class="destinations-title mh-auto text-center">Paddy</span>
                            </div>
                        </div>
                        <div class="swiper-slide mb-4">
                            <div class="destinations-block">
                                <div class="destinations-figure">
                                    <img src="assets/img/Vermicompost.jpg" class="img-fluid" width="" height="" alt="Destinations">
                                </div>
                                <span class="destinations-title mh-auto text-center">Vermicompost</span>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div> --> 
    <!-- Destinations Section End -->

    <!-- {{-- Testimonial Section  --}}
    <section class="testimonial pt-5 pb-4">
        <div class="custom-container">
            <div class="site-title pb-3">
                <h2 class="text-center">Testimonial</h2>
                <p class="text-center text-white">Include quotes or stories from farmers who have benefited from <b>KRISHIDHA FPO's</b> services.</p>
            </div>
            <div class="swiper testimonials mb-5">
                <div class="swiper-wrapper" id="testimonialsData">

   @if(isset($testimonial))
   @foreach ($testimonial as $testimonialValue)

   <div class="swiper-slide">
    <div class="testimonials-block text-center">
        <div class="testimonials-title"><?=$testimonialValue->client_name?><span> </span></div>
        <p class="text-justify"><?=$testimonialValue->review_text?></p>
    </div>
</div>
@endforeach
@endif
</div>
</div>
 Why Choose Us Section Starts -->
<section class="our-service pt-5 pb-5">
    <div class="custom-container">
        <div class="section-heading mb-4">
            <h2 class="text-center">Why choose us</h2>
        </div>
        <div class="row" id="ourServices">
            <div class="col-md-4 mb-4">
                <div class="our-block">
                    <div class="our-block-figure"><i class="fa-solid fa-sliders"></i></div>
                    <div class="our-content">
                        <p class="mb-0 text-center">Audio-Video Support</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="our-block">
                    <div class="our-block-figure"><i class="fa-solid fa-award"></i></div>
                    <div class="our-content">

                        <p class="mb-0 text-center">Live Streaming</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="our-block">
                    <div class="our-block-figure"><i class="fa-regular fa-star"></i></div>
                    <div class="our-content">

                        <p class="mb-0 text-center">Event Management - Townhall</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="our-block">
                    <div class="our-block-figure"><i class="fa-solid fa-headphones"></i></div>
                    <div class="our-content">

                        <p class="mb-0 text-center">Audio-Video Rentals</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="our-block">
                    <div class="our-block-figure"><i class="fa-solid fa-fire"></i></div>
                    <div class="our-content">

                        <p class="mb-0 text-center">Onsite Support</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="our-block">
                    <div class="our-block-figure"><i class="fa-solid fa-wallet"></i></div>
                    <div class="our-content">

                        <p class="mb-0 text-center">Specialized AV Solutions</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Why Choose Us Section Ends -->


{{-- new letter --}}
 {{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Newsletter Section</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"> --}}
    <style>
        .newsletter-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            position: relative;
            overflow: hidden;
        }

        .newsletter-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(0,123,255,0.05) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .newsletter-content {
            position: relative;
            z-index: 2;
        }

        .fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .newsletter-title {
            font-weight: 600;
            color: #2c3e50;
            animation-delay: 0.2s;
        }

        .newsletter-subtitle {
            animation-delay: 0.4s;
        }

        .newsletter-form {
            animation-delay: 0.6s;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 16px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 4px 12px rgba(0,123,255,0.15);
            transform: translateY(-2px);
        }

        .btn-subscribe {
            background: linear-gradient(45deg, #007bff, #0056b3);
            border: none;
            border-radius: 10px;
            padding: 12px 24px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,123,255,0.3);
        }

        .btn-subscribe:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0,123,255,0.4);
            background: linear-gradient(45deg, #0056b3, #004085);
        }

        .newsletter-icon {
            font-size: 2.5rem;
            color: #007bff;
            margin-bottom: 1rem;
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

        .privacy-text {
            animation-delay: 0.8s;
            transition: color 0.3s ease;
        }

        .privacy-text:hover {
            color: #007bff !important;
        }

        .floating-shape {
            position: absolute;
            background: rgba(0,123,255,0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .shape-1 {
            width: 60px;
            height: 60px;
            top: 20%;
            right: 10%;
            animation-delay: -2s;
        }

        .shape-2 {
            width: 40px;
            height: 40px;
            bottom: 30%;
            left: 15%;
            animation-delay: -4s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }
    </style>

    <section class="newsletter-section py-5">
        <div class="floating-shape shape-1"></div>
        <div class="floating-shape shape-2"></div>

        <div class="container newsletter-content">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="newsletter-icon fade-in-up">
                        <i class="fas fa-envelope-open-text"></i>
                    </div>
                    <h3 class="newsletter-title mb-3 fade-in-up">Subscribe to Our Newsletter</h3>
                    <p class="newsletter-subtitle mb-4 text-muted fade-in-up">Stay updated with our latest news and updates.</p>

                    <form class="newsletter-form row g-3 justify-content-center fade-in-up" id="newsletterForm">
                        <div class="col-md-8">
                            <input type="email" class="form-control" placeholder="Enter your email" required id="emailInput">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-subscribe w-100">
                                <i class="fas fa-paper-plane me-2"></i>Subscribe
                            </button>
                        </div>
                    </form>

                    <!-- Captcha Section -->
                    <div class="captcha-section mt-4 fade-in-up" style="animation-delay: 1s;">
                        <div class="row g-2 justify-content-center align-items-end">
                            <div class="col-md-4">
                                <label for="captcha" class="form-label text-start d-block">Enter Captcha</label>
                                <input type="text" class="form-control" id="captcha" name="captcha"
                                       placeholder="Enter captcha code" required>
                            </div>
                            <div class="col-md-3">
                                <div class="captcha-display bg-light  p-1 text-center">
                                    <span id="captcha-code" class="fw-bold fs-4 text-primary font-monospace">A3B7K</span>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-outline-primary captcha-refresh-btn" onclick="refreshCaptcha()" title="Refresh Captcha">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <small class="privacy-text text-muted mt-3 d-block fade-in-up">
                        <i class="fas fa-shield-alt me-1"></i>
                        We respect your privacy. Unsubscribe at any time.
                    </small>
                </div>
            </div>
        </div>
    </section>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> --}}
    <script>
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
    </script>

{{-- new letter --}}

        <!-- </div>
    </section> -->
    <!-- <section class="our_partner pt-5 pb-2">
        <div class="custom-container">
            <div class="site-title pb-3">
                <h2 class="text-center">Our Partner</h2>
            </div>
            <div class="row">
                @if(!empty($partnersImages))
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
@endsection
<style>
    .about-image{
        display:flex;
    }
    .about-text{
        display:end;
    }

.our_services-title + p {font: 400 14px/normal var(--font-josefin);color: rgb(var(--black-color));}
.our_services-title + p{margin-bottom: 10px; display: -webkit-box;max-width: 100%;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;}

.custom-container, .header-contaner{
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
.our-block-figure > svg {
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
    background-color: rgba(1,0,102,255);
    border: 5px solid rgba(1,0,102,255);
    border-bottom-right-radius: 100%;
    transform: scale(0) translate(-100%, -100%);
    transition: var(--transition);
    z-index: -1;
}
.our-block:hover > .our-content h4.our-title{color: rgba(1,0,102,255);font-weight: 700;}
.our-block:hover .our-block-figure > svg {
    color: #fff;
    top: -5px;
    left: -5px;
}
.our-block:hover .our-block-figure::after {
    transform: scale(1) translate(0%, 0%);
}
.our-block:hover {
    border-color:rgba(1,0,102,255) ;
}
 .our-block:hover:before {
    background-color: #fff;
    top: 0rem;
    bottom: 0rem;
    right: 0rem;
    left: 0rem;
}
.our-block > .our-content {
    margin-left: 50px;
    text-align: left;
    margin-top:14px;
}
.our-block > .our-content h4.our-title {
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

