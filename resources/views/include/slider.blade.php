<!-- Fullscreen Swiper Slider -->
<div class="video-banner">
  <div class="video-block">
    <div class="swiper main-slider">
      <div class="swiper-wrapper">
        @forelse ($sliders as $slide)
        <div class="swiper-slide">
          <img
            src="{{ asset($slide->image) }}"
            alt="Slide Image"
            class="slide-image"
          />
          <div class="video-content text-white text-center">
            <h3 class="slide-heading">{!! $slide->heading_bottom !!}</h3>
          </div>
        </div>
        @empty
        <div class="swiper-slide">
          <img
            src="./assets/img/3 Emperium Prime .JPG"
            alt="Fallback"
            class="slide-image"
          />
        </div>
        @endforelse
      </div>

      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>
  </div>
</div>

<!-- Internal CSS with !important -->
<style>
.video-banner,
.video-block,
.main-slider,
.swiper-slide {
  position: relative !important;
}

.slide-image {
  width: 100% !important;
  height: 100% !important;
  display: block !important;
}

.video-content {
  position: absolute !important;
  bottom: 10% !important;
  left: 50% !important;
  transform: translateX(-50%) !important;
  z-index: 10 !important;
  color: #fff !important;
  text-shadow: 0 2px 5px rgba(0, 0, 0, 0.6) !important;
  text-align: center !important;
}

.swiper-button-prev,
.swiper-button-next {
  color: white !important;
  top: 50% !important;
  transform: translateY(-50%) !important;
  z-index: 11 !important;
}

/* Mobile + Tablet Responsiveness */
@media (max-width: 768px) {
  .video-banner,
  .video-block,
  .main-slider,
  .swiper-slide {
  }

  .slide-image {
    height: 30vh;
    max-height: 80vh !important;
  }

  .video-content {
    font-size: 14px !important;
    bottom: 5% !important;
    
  }
  .swiper-button-prev,
.swiper-button-next {
  color: white !important;
  top: 100px !important;
  transform: translateY(-50%) !important;
  z-index: 11 !important;
}

}
</style>

<!-- Swiper Script -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  new Swiper('.main-slider', {
    effect: 'fade',
    fadeEffect: { crossFade: true },
    autoplay: {
      delay: 9000,
      disableOnInteraction: false,
      pauseOnMouseEnter: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    loop: true,
    speed: 1000,
  });
});
</script>
