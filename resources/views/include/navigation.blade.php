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
    <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active-link' : '' }}" >
      Home
    </a>
  </li>

  <!-- ✅ About Us with Dropdown -->
  <li class="has-dropdown">
    <a href="{{ route('aboutUs') }}"  class="{{ request()->is('about-us') ? 'active-link' : '' }}" >
      About Us
    </a>
    <ul class="dropdown">
      <li><a href="{{ route('aboutUs') }}#about" >Introduction</a></li>
      <li><a href="{{ route('aboutUs') }}#team" >The Team</a></li>
      <li><a href="{{ route('aboutUs') }}#philosophy" >Our Foundation</a></li>
      <li><a href="{{ route('aboutUs') }}#services" >What We Do</a></li>
    </ul>
  </li>

  <!-- ✅ Projects -->
  <li>
    <a href="{{ route('productPage') }}" class="{{ request()->is('projects') ? 'active-link' : '' }}" >
      Projects
    </a>
  </li>

  <!-- ✅ Gallery -->
  <li>
    <a href="{{ route('galleryPages') }}" class="{{ request()->is('gallery') ? 'active-link' : '' }}" >
      Gallery
    </a>
  </li>

  <!-- ✅ Articles -->
  <li>
    <a href="{{ route('blogPage') }}" class="{{ request()->is('articles') ? 'active-link' : '' }}" >
      Articles
    </a>
  </li>

  <!-- ✅ Contact Us -->
  <li>
    <a href="{{ route('contactUs') }}" class="{{ request()->is('contact-us') ? 'active-link' : '' }}" >
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
<script>
document.addEventListener("DOMContentLoaded", function () {
  const dropdownLinks = document.querySelectorAll(".has-dropdown .dropdown a");
  const mobileToggle = document.getElementById("mobileToggle");
  const mainNav = document.getElementById("mainNav");

  dropdownLinks.forEach(link => {
    link.addEventListener("click", function () {
      // ✅ Close dropdown on ALL devices
      document.querySelectorAll(".has-dropdown .dropdown").forEach(menu => {
        menu.classList.remove("open"); // mobile
      });

      // ✅ Temporarily disable hover dropdown on desktop
      const parent = this.closest(".has-dropdown");
      if (parent) {
        parent.classList.add("dropdown-clicked");
        setTimeout(() => {
          parent.classList.remove("dropdown-clicked");
        }, 500); // restore hover after half a second
      }

      // ✅ Close mobile menu if open
      if (window.innerWidth <= 991) {
        mainNav?.classList.remove("active");
        mobileToggle?.classList.remove("active");
        document.body.classList.remove("no-scroll");
      }
    });
  });
});
</script>
<style>
@media (min-width: 992px) {
  .navbar-block .has-dropdown:hover .dropdown {
    display: flex;
  }

  /* ✅ Disable hover when dropdown-clicked is added */
  .navbar-block .has-dropdown.dropdown-clicked:hover .dropdown {
    display: none !important;
  }
}

@media (max-width: 991px) {
  .navbar-block .dropdown.open {
    display: flex !important;
    position: relative;
    flex-direction: column;
    background: rgba(255, 255, 255, 0.15);
    padding-left: 1rem;
  }
}

  /* Dropdown styles */
.navbar-block .has-dropdown {
  position: relative;
}

/* Highlight active menu item */
.navbar-block a.active-link {
  border-bottom: 3px solid red; /* White underline or any color */
}

/* ✅ SUPER STRONG - Dropdown that resists ALL scroll changes */
.navbar-block .dropdown,
.main-header .navbar-block .dropdown,
.main-header.scrolled .navbar-block .dropdown,
.main-header[style] .navbar-block .dropdown {
  display: none;
  position: absolute !important;
  top: 100% !important;
  left: 0 !important;
  flex-direction: column !important;
  background: rgba(13, 13, 13, 0.42) !important; /* ✅ Your custom dark transparent background */
  backdrop-filter: blur(15px) !important;
  border-radius: 12px !important;
  box-shadow: 0 12px 25px rgba(0, 0, 0, 0.4) !important;
  padding: 8px 0 !important;
  min-width: 200px !important;
  z-index: 99999 !important;
  border: 1px solid rgba(255, 255, 255, 0.2) !important;
  transition: all 0.3s ease !important;
  isolation: isolate !important;
  /* ✅ Extra protection against inheritance */
  color: inherit !important;
  font-family: inherit !important;
}

/* ✅ MAXIMUM STRENGTH - Text color that never changes */
.navbar-block .dropdown li a,
.main-header .navbar-block .dropdown li a,
.main-header.scrolled .navbar-block .dropdown li a,
.main-header[style] .navbar-block .dropdown li a,
.navbar-block .dropdown li a[style] {
  padding: 12px 20px !important;
  font-size: 0.95rem !important;
  color: #ffffff !important; /* ✅ Maximum strength white text */
  text-decoration: none !important;
  display: block !important;
  white-space: nowrap !important;
  border-radius: 6px !important;
  background: transparent !important;
  border: none !important;
  outline: none !important;
  box-shadow: none !important;
  text-shadow: none !important;
  font-weight: normal !important;
}

/* ✅ MAXIMUM STRENGTH - Hover state */
.navbar-block .dropdown li a:hover,
.main-header .navbar-block .dropdown li a:hover,
.main-header.scrolled .navbar-block .dropdown li a:hover,
.main-header[style] .navbar-block .dropdown li a:hover {
  background-color: rgba(255, 255, 255, 0.15) !important;
  color: #ffffff !important;
  text-decoration: none !important;
  border: none !important;
  outline: none !important;
  box-shadow: none !important;
  text-shadow: none !important;
}

/* ✅ Show dropdown on hover for desktop only */
@media (min-width: 992px) {
  .navbar-block .has-dropdown:hover .dropdown {
    display: flex !important;
    animation: fadeInUp 0.3s ease forwards;
  }
}

/* ✅ MAXIMUM STRENGTH - Mobile dropdown styling */
@media (max-width: 991px) {
  .navbar-block .dropdown.open,
  .main-header .navbar-block .dropdown.open,
  .main-header.scrolled .navbar-block .dropdown.open,
  .main-header[style] .navbar-block .dropdown.open {
    display: flex !important;
    position: relative !important;
    background: rgba(13, 13, 13, 0.42) !important; /* ✅ Your custom mobile background */
    border: none !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3) !important;
    flex-direction: column !important;
    padding-left: 1rem !important;
    border-radius: 8px !important;
    margin-top: 5px !important;
  }
  
  /* ✅ MAXIMUM STRENGTH - Mobile dropdown text color */
  .navbar-block .dropdown.open li a,
  .main-header .navbar-block .dropdown.open li a,
  .main-header.scrolled .navbar-block .dropdown.open li a,
  .main-header[style] .navbar-block .dropdown.open li a {
    color: #ffffff !important;
    background: transparent !important;
    padding: 10px 15px !important;
  }
}
/* Default nav link style */
.site-logo {
  transition: opacity 0.3s ease;
}


/* ✅ Animation */
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

/* ✅ NUCLEAR OPTION - If still having issues, add this */
.navbar-block .dropdown * {
  color: #ffffff !important;
}
</style>
<script>
  const mainLogo = document.getElementById("mainLogo");

window.addEventListener("scroll", function () {
    if (window.scrollY > 50) {
        mainLogo.style.opacity = "0";
        mainLogo.style.transition = "opacity 0.3s ease";
    } else {
        mainLogo.style.opacity = "1";
    }
});

</script>
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
