@extends('layouts.webSite')
@section('title', 'Blog')
@section('content')

{{-- <div class="information-page-slider">
         style="background: url('{{ asset('assets/img/aboutusbanner.JPG') }}'); background-size: cover; background-position: center;">
    <div class="information-content">
        <h1><a href="{{ url('/') }}">Home</a><span>Blog</span></h1>
    </div>
</div> --}}

<div class="information-page-slider"
     style="background: url('{{ asset('assets/img/aboutusbanner.JPG') }}'); background-size: cover; background-position: center;">
    <div class="information-content">
        <h1><a href="{{ url('/') }}">Home</a><span>Articles</span></h1>
    </div>
</div>

<div id="about">
    <div class="default-content blog-page pt-5 pb-3">
        <div class="custom-container">
            <div class="site-title pb-3">
                <h2 class="text-center">Project experience so far</h2>
            </div>
            <div class="blog-container midd-content">
                <div class="row">
                    @if($blog->isNotEmpty())
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
                                        <a href="{{ route('blogDetails', $BlogRow['slug']) }}" class="btn btn-primary blog-details-btn" style="background-color: navy; border-color: navy;">
    Read More
</a>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-md-4 mb-4">
                            <div class="blog-card">
                                <div class="blog-card-image">
                                    <img src="assets/img/Paddy.jpg" class="img-fluid" alt="Paddy" />
                                </div>
                                <div class="blog-card-content">
                                    <h3 class="blog-title">Paddy</h3>
                                    <div class="blog-meta">
                                        <span class="blog-date">Sample Post</span>
                                    </div>
                                    <a class="btn btn-primary blog-details-btn" style="background-color: navy; border-color: navy;">
    Read More
</a>

                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.blog-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
}

.blog-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
}

.blog-card-image {
    width: 100%;
    height: 200px;
    overflow: hidden;
}

.blog-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.blog-card:hover .blog-card-image img {
    transform: scale(1.05);
}

.blog-card-content {
    padding: 20px;
}

.blog-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 10px;
    color: #333;
    line-height: 1.4;
}

.blog-meta {
    margin-bottom: 15px;
}

.blog-date {
    color: #666;
    font-size: 0.9rem;
}

.blog-details-btn {
    background-color: #28a745;
    border: none;
    padding: 8px 20px;
    border-radius: 5px;
    color: white;
    text-decoration: none;
    font-weight: 500;
    transition: background-color 0.3s ease;
}

.blog-details-btn:hover {
    background-color: #218838;
    color: white;
    text-decoration: none;
}

.blog-container .row {
    margin: 0 -15px;
}

.blog-container .row > div {
    padding: 0 15px;
}

@media (max-width: 768px) {
    .col-md-6 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}
</style>

@endsection