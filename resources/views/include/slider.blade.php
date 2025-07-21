<!-- main Video Section -->
<div class="video-banner">
  <div class="video-block">
    <div class="swiper main-slider">
      <div class="swiper-wrapper">
        @foreach ($sliders as $slide )
        <div class="swiper-slide">
          
          <img class="img-fluid banner-img" width="" height="" style="height:560px" alt="Image" src="{{ asset($slide->image) }}" />
          <div class="video-content">
            <!-- Dynamic content from the database -->
            <h2 style="padding-top:100px">{!!$slide->heading_top !!}</h2>
            <h3>{!! $slide->heading_middle !!}</h3>
            <p>{!! $slide->heading_bottom !!}</p>
            {{-- Uncomment the following line if you have a contact route for each slide --}}
            {{-- <a href="{{ route('contactUs') }}" aria-label="Explore The World">Get in touch</a> --}}
          </div>
        </div>
        @endforeach

        {{--
            This block will only render if the $sliders collection is empty.
            This ensures that either dynamic slides OR static slides are shown, but not both.
        --}}
        @unless (count($sliders) > 0)
        <!-- Static slides - example content added for structure, currently commented out -->
        <div class="swiper-slide">
          <img class="img-fluid" width="" height="" alt="Image" src="./assets/img/3 Emperium Prime .JPG" />
          <div class="video-content">
            {{--
            <h2>Adiyogi Global</h2>
            <h3>Grow with Innovation: Solutions for Sustainable Farming</h3>
            <p>A short descriptive text for Banner Pic 1.</p>
            <a href="{{ route('contactUs') }}" aria-label="Explore The World">Get in touch</a>
            --}}
          </div>
        </div>
        <div class="swiper-slide">
          <img class="img-fluid" width="" height="" alt="Image" src="./assets/img/1 Skyom city lucknow (1).jpg" />
          <div class="video-content">
            {{--
            <h2>Adiyogi Global</h2>
            <h3>Grow with Innovation: Solutions for Sustainable Farming</h3>
            <p>A short descriptive text for Banner Pic 2.</p>
            <a href="{{ route('contactUs') }}" aria-label="Explore The World">Get in touch</a>
            --}}
          </div>
        </div>
        <div class="swiper-slide">
          <img class="img-fluid" width="" height="" alt="Image" src="./assets/img/2 INR heights karnal.jpg" />
          <div class="video-content">
            {{--
            <h2>Adiyogi Global</h2>
            <h3>Grow with Innovation: Solutions for Sustainable Farming</h3>
            <p>A short descriptive text for Banner Pic 3.</p>
            <a href="{{ route('contactUs') }}" aria-label="Explore The World">Get in touch</a>
            --}}
          </div>
        </div>
        
        @endunless
      </div>
      <div class="swiper-button-prev" ></div>
<div class="swiper-button-next" ></div>
    </div>
  </div>
</div>
<style>
.swiper-button-prev, .swiper-button-next {
  position: absolute;
  top: 200px;
  
}
@media (max-width: 640px) { 
  .swiper-button-prev, .swiper-button-next {
    top: 120px;
  }
}
</style>
