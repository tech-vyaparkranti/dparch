<!-- Header section Start -->
<header class="main-header" style=" position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 1000;
  height:100px;">
    <div class="header-contaner" style="padding-top:10px">
        <div class="logo-section">
            <div class="mobile-bars" id="mobileToggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <a href="{{ url('/') }}" aria-level="Main logo">
                <img id="mainLogo" src="{{ asset($Logo ?? './assets/img/logo.png') }}" class="img-fluid site-logo" width="120" height="90" alt="Home Styler">
            </a>
        </div>
        <div class="slide-navigation" id="mainNav">
            <div class="navbar-wrapper">
                <ul class="navbar-block">

  <!-- ✅ Home -->
  <li>
    <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active-link' : '' }}" style="font-weight: bolder; font-size: 17px;">
      Home
    </a>
  </li>

  <!-- ✅ About Us with Dropdown -->
  <li class="has-dropdown">
    <a href="{{ route('aboutUs') }}" class="{{ request()->is('about-us') ? 'active-link' : '' }}" style="font-weight: bolder; font-size: 17px;">
      About Us
    </a>
    <ul class="dropdown">
      <li><a href="{{ route('aboutUs') }}#about">Introduction</a></li>
      <li><a href="{{ route('aboutUs') }}#team">The Team</a></li>
      <li><a href="{{ route('aboutUs') }}#philosophy">Our Foundation</a></li>
      <li><a href="{{ route('aboutUs') }}#services">What We Do</a></li>
    </ul>
  </li>

  <!-- ✅ Projects -->
  <li>
    <a href="{{ route('productPage') }}" class="{{ request()->is('projects') ? 'active-link' : '' }}" style="font-weight: bolder; font-size: 17px;">
      Projects
    </a>
  </li>

  <!-- ✅ Gallery -->
  <li>
    <a href="{{ route('galleryPages') }}" class="{{ request()->is('gallery') ? 'active-link' : '' }}" style="font-weight: bolder; font-size: 17px;">
      Gallery
    </a>
  </li>

  <!-- ✅ Articles -->
  <li>
    <a href="{{ route('blogPage') }}" class="{{ request()->is('articles') ? 'active-link' : '' }}" style="font-weight: bolder; font-size: 17px;">
      Articles
    </a>
  </li>

  <!-- ✅ Contact Us -->
  <li>
    <a href="{{ route('contactUs') }}" class="{{ request()->is('contact-us') ? 'active-link' : '' }}" style="font-weight: bolder; font-size: 17px;">
      Contact Us
    </a>
  </li>

</ul>
            </div>
            <ul class="sticky-content">
                {{-- Social links could go here --}}
            </ul>
        </div>
    </div>
</header>


<style>
  /* Dropdown styles */
.navbar-block .has-dropdown {
  position: relative;
}
/* Default nav link style */


/* Highlight active menu item */
.navbar-block a.active-link {
  border-bottom: 3px solid red; /* White underline or any color */
}


.navbar-block .dropdown {
  display: none;
  position: absolute;
  top: 100%;
  left: 0;
  flex-direction: column;
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(12px);
  border-radius: 12px;
  box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
  padding: 8px 0;
  min-width: 200px;
  z-index: 9999;
  border: 1px solid rgba(255, 255, 255, 0.3);
  transition: all 0.3s ease;
}


.navbar-block .dropdown li a {
  padding: 10px 20px;
  font-size: 0.95rem;
  color: #fff;
  text-decoration: none;
  display: block;
  white-space: nowrap;
  border-radius: 6px;
}

.navbar-block .dropdown li a:hover {
  background-color: rgba(255, 255, 255, 0.2);
  color: #222;
  
}

/* ✅ Show dropdown on hover for desktop only */
@media (min-width: 992px) {
  .navbar-block .has-dropdown:hover .dropdown {
    display: flex;
    animation: fadeInUp 0.3s ease forwards;
    color: #fff;
  }
}

/* ✅ Force dropdown to show on click for mobile */
@media (max-width: 991px) {
  .navbar-block .dropdown.open {
    display: flex !important;
    position: relative;
    background: rgba(255, 255, 255, 0.15) !important;
    border: none;
    box-shadow: none;
    flex-direction: column;
    padding-left: 1rem;
     color: #fff !important;
  }
}
/* Default nav link style */

</style>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const dropdowns = document.querySelectorAll(".has-dropdown > a");
    const navLinks = document.querySelectorAll(".navbar-block a");
    const mobileToggle = document.getElementById("mobileToggle");
    const mainNav = document.getElementById("mainNav");

    dropdowns.forEach(link => {
        link.addEventListener("click", function (e) {
            if (window.innerWidth <= 991) {
                e.preventDefault();
                const dropdownMenu = this.nextElementSibling;

                document.querySelectorAll(".has-dropdown .dropdown").forEach(menu => {
                    if (menu !== dropdownMenu) menu.classList.remove("open");
                });

                dropdownMenu.classList.toggle("open");
            }
        });
    });

    navLinks.forEach(link => {
        link.addEventListener("click", function (e) {
            if (window.innerWidth <= 991 && !this.parentElement.classList.contains('has-dropdown')) {
                mainNav.classList.remove("active");
                mobileToggle.classList.remove("active");
                document.body.classList.remove("no-scroll");
            }
        });
    });

    if (mobileToggle && mainNav) {
        mobileToggle.addEventListener("click", function () {
            mainNav.classList.toggle("active");
            mobileToggle.classList.toggle("active");
            document.body.classList.toggle("no-scroll");
        });
    }

    document.addEventListener("click", function(e) {
        if (window.innerWidth <= 991) {
            if (!mainNav.contains(e.target) && !mobileToggle.contains(e.target)) {
                mainNav.classList.remove("active");
                mobileToggle.classList.remove("active");
                document.body.classList.remove("no-scroll");
                document.querySelectorAll(".has-dropdown .dropdown").forEach(menu => {
                    menu.classList.remove("open");
                });
            }
        }
    });
});
</script>
