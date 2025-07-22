<div class="sticky-navigation">
    <div class="custom-container">
    <ul class="sticky-content p-0 m-0">
            <li><a href="mailto:{!! $email_2??"info@dparch.co.in" !!}"><i class="fa fa-envelope"></i>&nbsp;<span>{!! $email_1??"info@dparch.co.in" !!}</span></a></li>
            <li><a href="tel:+91{!! isset($contact_us_contact_number)?str_replace(" ","",$contact_us_contact_number):"+919958298515" !!}"><i class="fa fa-phone"></i>&nbsp;<span>{!! $contact_us_contact_number??"+919958298515" !!}</span></a></li>
        </ul>
        {{-- <div class="gtranslate_wrapper"></div> --}}
    </div>
</div> 
<!-- Header section Start -->
<header class="main-header">
    <div class="header-contaner">
        <div class="logo-section">
            <div class="mobile-bars" hidden></div>
            <a href="{{ url('/') }}" aria-level="Main logo"><img src="{{ asset($Logo??"./assets/img/logo.png") }}" class="img-fluid site-logo" width="120" height="90" alt="Home Styler"></a>
        </div>
        <div class="slide-navigation">
            <div class="navbar-wrapper">
                <ul class="navbar-block">
                    <li><a href="{{ url('/') }}" style="font-weight: bolder;
    font-size: 15px;">Home</a></li>
                    <li class="has-dropdown">
            <a href="{{ route('aboutUs') }}"style="font-weight: bolder;
    font-size: 15px;">About Us</a>
            <ul class="dropdown">
              <li><a href="{{ route('aboutUs') }}#about">About</a></li>
              <li><a href="{{ route('aboutUs') }}#team">Our Team</a></li>
              <li><a href="{{ route('aboutUs') }}#philosophy">Our Philosophy</a></li>
              <li><a href="{{ route('aboutUs') }}#services">Our Services</a></li>
            </ul>
          </li>
                    <li><a href="{{ route('productPage') }}"style="font-weight: bolder;
    font-size: 15px;">Projects</a></li> 
                    <li><a href="{{ route('galleryPages') }}"style="font-weight: bolder;
    font-size: 15px;">Gallery</a></li>
                     <li><a href="{{ route('blogPage') }}"style="font-weight: bolder;
    font-size: 15px;">Articles</a></li>
                    <li><a href="{{ route('contactUs') }}"style="font-weight: bolder;
    font-size: 15px;">Contact Us</a></li>
                   
                    
                    
                </ul>
                
            </div>
            <ul class="sticky-content">
                {{-- <li><a href="{!! $facebook_link ?? 'https://www.facebook.com/RNcommunication' !!}" aria-label="Read more about RNcommunication  facebook"><i class="fa-brands fa-facebook"></i></a></li>
                <li><a href="{!! $linkedin_link ?? '/' !!}" aria-label="Read more about RNcommunication  Linkedin"><i class="fab fa-linkedin"></i></a></li>
                <li><a href="{!! $instagram_link ?? 'https://www.instagram.com/adiyogi_global/' !!}" aria-label="Read more about RNcommunication  Instagram"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a href="{!! $youtube_link ?? 'https://www.youtube.com/@RNcommunication' !!}" aria-label="Read more about RNcommunication  Youtube"><i class="fa-brands fa-youtube"></i></a></li> --}}
                
            </ul>
            
        </div>
    </div>
</header>

<style>
    .navbar-block .has-dropdown {
  position: relative;
}
@media (max-width: 768px) {
    .site-logo {
        width: 90px;
        height: 90px;
        border-radius:50%;
    }
}

.navbar-block .has-dropdown > a::after {
  font-size: 0.6rem;
  margin-left: 4px;
  color: #ccc;
}

/* Glassy dropdown menu */
.navbar-block .dropdown {
  position: absolute;
  top: 100%;
  left: 0;
  display: none;
  flex-direction: column;
  background: rgba(255, 255, 255, 0.1); /* Light glass effect */
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border-radius: 12px;
  box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
  padding: 8px 0;
  min-width: 200px;
  z-index: 9999;
  border: 1px solid rgba(255, 255, 255, 0.3);
  transition: opacity 0.3s ease, transform 0.3s ease;
}

/* Show on hover */
.navbar-block .has-dropdown:hover .dropdown {
  display: flex;
  animation: fadeInUp 0.3s ease forwards;
}

/* List items */
.navbar-block .dropdown li {
  padding: 0;
  margin: 0;
}

/* Link styles */
.navbar-block .dropdown li a {
  padding: 10px 20px;
  font-size: 0.95rem;
  color: #fff;
  text-decoration: none;
  display: block;
  white-space: nowrap;
  transition: all 0.3s ease;
  border-radius: 6px;
}

/* Hover effect */
.navbar-block .dropdown li a:hover {
  background-color: rgba(255, 255, 255, 0.2);
  color: #222;
}


/* Smooth fade-in animation */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

</style>
