@extends('layouts.webSite')
@section('title', 'Events')
@section('content')
<div class="information-page-slider"
     style="background: url('{{ asset('assets/img/aboutusbanner.JPG') }}'); background-size: cover; background-position: center;">
    <div class="information-content">
        <h1><a href="{{ url('/') }}">Home</a><span>Events</span></h1>
    </div>
</div>
<div id="about">
    <div class="default-content pt-5 pb-5">
        <div class="custom-container">
            <div class="site-title mb-4">
                <h2 class="text-center">Glimpse of Happiness</h2>
            </div>

            {{-- DYNAMIC FILTER BUTTONS --}}
            @php
                $categories = $galleryImages->pluck('filter_category')->filter()->unique()->values();
            @endphp
            <div class="shuffle_wrapper text-center pt-2 pb-4">
                <button class="default-btn active" data-filter="all"><span>All</span></button>
                @foreach ($categories as $cat)
                    <button class="default-btn filter" data-filter="{{ $cat }}"><span>{{ ucfirst($cat) }}</span></button>
                @endforeach
            </div>

         <div class="row my-shuffle-container">
    @if($galleryImages->isNotEmpty())
        @foreach ($galleryImages as $GalleryImage)
            <div class="col-12 col-sm-6 col-md-4 mb-4 picture-item"
                 data-groups='["{{ $GalleryImage->filter_category ?? 'uncategorized' }}"]'>
                <a data-fancybox="gallery"
                   href="{{ $GalleryImage->local_image ? url($GalleryImage->local_image) : $GalleryImage->image_link }}">
                    <div style="width: 100%; height: 250px; overflow: hidden; border-radius: 10px; box-shadow: 0 2px 8px #ccc;">
                        <img src="{{ $GalleryImage->local_image ? url($GalleryImage->local_image) : $GalleryImage->image_link }}"
                             class="img-fluid"
                             alt="{{ $GalleryImage->title ?? $GalleryImage->alternate_text }}"
                             style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
                    </div>
                    <div class="gallery-caption mt-2">
                        <h3 class="h6 mb-1">
                            {{ $GalleryImage->title ?: $GalleryImage->alternate_text ?: 'Untitled' }}
                        </h3>
                        <p class="text-muted small">
                            {{ $GalleryImage->description }}
                        </p>
                    </div>
                </a>
            </div>
        @endforeach
    @else
        <div class="col-12"><p class="text-center">No gallery items available.</p></div>
    @endif
</div>

        </div>
    </div>
</div>

{{-- Scripts --}}
<script src="{{ asset('assets/js/jquery-1.12.4.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Shuffle/6.1.0/shuffle.min.js"></script>
<script>
    $(function() {
        var element = document.querySelector('.my-shuffle-container');
        var sizer = element.querySelector('.my-sizer-element');
        var shuffleInstance = new window.Shuffle(element, {
            itemSelector: '.picture-item',
            sizer: sizer
        });

        // Button event handlers
        $('.shuffle_wrapper button').on('click', function() {
            $('.shuffle_wrapper button').removeClass('active');
            $(this).addClass('active');
            var filterVal = $(this).data('filter');
            if (filterVal === 'all') {
                shuffleInstance.filter();
            } else {
                shuffleInstance.filter(filterVal);
            }
        });
    });
</script>
<style>
    /* Button highlight */
    .shuffle_wrapper .active {
        background: #1976d2;
        color: #fff;
    }
    /* Responsive improvements */
    .gallery-caption h3 {
        font-size: 1.1rem;
        font-weight: bold;
        margin-bottom: 4px;
    }
    .gallery-caption p {
        font-size: 0.98rem;
        color: #666;
        margin-bottom: 0;
    }
</style>
@endsection
