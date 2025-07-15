@extends('layouts.webSite')
@section('title', 'Services')
@section('content')

@php
    use App\Models\WebSiteElements;

    $project_content = WebSiteElements::where([
        'status' => 1,
        'element' => 'projects_content'
    ])->value('element_details'); // or whatever column holds the actual content
@endphp
<div class="information-page-slider">
    <div class="information-content">
        <h1><a href="{{ url('/') }}">Home</a><span>Project</span></h1>
    </div>
</div>
<div id="about">
    <div class="default-content products-page pt-5 pb-3">
        <div class="custom-container">
            <div class="site-title pb-3">
                <h2 class="text-center">Our Projects</h2>
                <p class="text-center pb-3">
                    {!! $project_content ?? "From basic treks to high-altitude mountaineering expeditions, we cater to adventurers of all levels." !!}
                    {{-- {!! $data['projects_content'] !!} --}}
                </p>
            </div>
            <div class="services-grid mt-3">
            @if (isset($services) && $services->count() > 0)
                @foreach ($services as $index => $item)
                <div class="service-card" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <div class="services-container {{ $index % 2 == 1 ? 'reverse' : '' }}">
                        <div class="left-item">
                            @php
    $sections = is_array($item->sections) ? $item->sections : json_decode($item->sections, true);
@endphp
@if (!empty($sections))
    <div class="swiper mySwiper{{ $index }}">
        <div class="swiper-wrapper">
            @foreach ($sections as $section)
                @if (!empty($section['image']))
                    <div class="swiper-slide">
                        <img src="{{ asset($section['image']) }}" alt="Section Image" style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px;">
                    </div>
                @endif
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
        {{-- <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div> --}}
    </div>
@else
    <img src="{{ asset('assets/img/default-image.jpg') }}" alt="Default Image">
@endif

                        </div>
                        <div class="right-item">
                            <h4>{{ strToUpper($item->project_name) }}</h4> 
                            <p class="text-justify">{!! Str::limit($item->description, 500, '...') !!}</p>
                            <a href="{{route('productDetails',$item->slug)}}" type="button" class="theme-btn center">
                                <span>View Details</span>
                                <i class="fa fa-link" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                
                <div class="service-card" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <div class="services-container">
                        <div class="left-item">
                            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Strategic Planning Service">
                        </div>
                        <div class="right-item">
                            <h4>Strategic Planning</h4>
                            <p>Develop comprehensive strategies that align with
                                 your vision and objectives. Our strategic planning services help you identify opportunities, mitigate risks, and create actionable roadmaps for sustainable success.</p>
                            <a href="#" class="theme-btn style-two bgc-secondary">
                                <span data-hover="Book Now">Explore</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                
                <div class="service-card" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <div class="services-container">
                        <div class="left-item">
                            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Digital Solutions Service">
                        </div>
                        <div class="right-item">
                            <h4>Digital Solutions</h4>
                            <p class="text-justify pb-10">Transform your business with our cutting-edge digital solutions. From web development to mobile applications, we create innovative platforms that drive growth and enhance user experience across all digital touchpoints.</p>
                            <a href="#" class="theme-btn style-two bgc-secondary">
                                <span data-hover="Book Now">View Details</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

            @endif
            
        </div>

        </div>
    </div>
</div>

<!-- Modal -->
{{-- <div class="modal fade" id="enquery-pop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="contact-form-area pt-4">
                <div class="midd-content section-title mb-3">
                    <h3>Send us a message</h3>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"
                            aria-hidden="true"></i></button>
                </div>
                <form enctype="multipart/form-data" method="POST" id="contactUsForm" action="javascript:">
                    @csrf
                    <input type="hidden" name="country_code" value="" id="country_code_id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="first_name">First name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                    placeholder="First name" required>
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="last_name">Last name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                    placeholder="Last name" required>
                                <div class="valid-feedback">Looks good!</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email ID"
                                    required>
                                <div class="invalid-feedback">Please provide a valid Email.</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="phone_number">Phone</label>
                                <input type="tel" pattern="^[1-9][0-9]*$" class="form-control" id="phone_number"
                                    name="phone_number" required>
                                <div class="invalid-feedback">Please provide a valid phone number.</div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control" id="message" name="message" maxlength="1000"
                                    minlength="30" required rows="3"></textarea>
                                <div class="invalid-feedback">Please provide a message.</div>
                            </div>
                        </div>
                        <x-input-with-label-element id="captcha" type="text" label="Captcha" name="captcha" required
                            placeholder="Captcha"></x-input-with-label-element>
                        <div class="col-md-8 col-sm-12 mb-3">
                            <div class="row">
                                <div class="col-md-6 pt-4">
                                    <img src="{{ captcha_src() }}" class="img-thumbnail h-100" id="captcha_img_id">
                                </div>
                                <div class="col-md-6 pt-4 view-button">
                                    <button type="button" class="btn default-btn btn-block font-weight-bold"
                                        onclick="refreshCapthca('captcha_img_id','captcha')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                            <path
                                                d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                                            <path fill-rule="evenodd"
                                                d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                                        </svg>
                                        Refresh
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <input class="form-check-input" type="checkbox" value="" id="tnc" required>
                                <label class="form-check-label" for="tnc">Agree to terms and
                                    conditions</label>
                                <div class="invalid-feedback">You must agree before submitting.</div>
                            </div>
                        </div>
                    </div>
                    <div class="view-button">
                        <button class="default-btn" id="submitButton" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}

{{-- <style>
     .contact-form-area button[data-bs-dismiss="modal"],
    .service-page .destinations-block a {
        position: absolute;
        bottom: 0;
        top: calc(100% - 45px);
        right: 0;
        left: calc(100% - 45px);
        width: 40px;
        height: 40px;
        text-align: center;
        line-height: 40px;
        color: #fff;
        background-color: rgb(var(--red-color));
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
        z-index: 1;
    }
    .offerings-content-inner a {
        padding: 8px 15px;
        border-radius: 25px;
        background-color: var(--brown-color);
        color: #fff;
    }
    .offerings-content-inner a:hover{
        color:#fff;
    }
    .contact-form-area button[data-bs-dismiss="modal"] {
        position: absolute;
        top: 10px;
        right: 10px !important;
        left: auto;
        color:red;
    }
    .contact-form-area.pt-4 {
    padding: 20px;
}
    </style> --}}
    <style>
/* Services Section Styles */
.services-section {
    padding: 80px 0;
    background: white;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.section-header {
    text-align: center;
    margin-bottom: 60px;
    color: #2c3e50;
}

.section-header h2 {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 20px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
}

.section-header p {
    font-size: 1.2rem;
    opacity: 0.8;
    max-width: 600px;
    margin: 0 auto;
}

.services-grid {
    display: grid;
    gap: 40px;
    max-width: 1000px;
    margin: 0 auto;
}

.service-card {
    background: rgba(255, 255, 255, 1);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    transition: all 0.4s ease;
    border: 1px solid rgba(230, 230, 230, 0.5);
}

.service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
}

.services-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    min-height: 350px;
}

.services-container.reverse {
    direction: rtl;
}

.services-container.reverse .right-item {
    direction: ltr;
}

.left-item {
    position: relative;
    overflow: hidden;
}

.left-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.service-card:hover .left-item img {
    transform: scale(1.1);
}

.right-item {
    padding: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    position: relative;
}

.right-item h4 {
    font-size: 1.8rem;
    font-weight: 600;
    margin-bottom: 20px;
    color: #2c3e50;
    position: relative;
}

.right-item h4::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 0;
    width: 50px;
    height: 3px;
    background: linear-gradient(90deg, #667eea, #764ba2);
    border-radius: 2px;
}

.right-item p {
    font-size: 1rem;
    line-height: 1.8;
    color: #555;
    margin-bottom: 30px;
}

.theme-btn {
    display: inline-flex;
    height: 100%;
    width: 50%;
    align-items: center;
    gap: 15px;
    padding: 15px 30px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white !important;
    text-decoration: none;
    border-radius: 50px;
    font-weight: 600;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-size: 0.9rem;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    border: none;
}

.theme-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 50%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.6s ease;
}

.theme-btn:hover::before {
    left: 100%;
}

.theme-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    color: white !important;
}

.theme-btn span {
    position: relative;
    z-index: 2;
}

.theme-btn i {
    font-size: 1.1rem;
    transition: transform 0.3s ease;
}

.theme-btn:hover i {
    transform: translateX(5px);
}

/* Service specific styling */
.service-card:nth-child(1) .right-item h4::after {
    background: linear-gradient(90deg, #ff6b6b, #ee5a52);
}

.service-card:nth-child(2) .right-item h4::after {
    background: linear-gradient(90deg, #4ecdc4, #44a08d);
}

.service-card:nth-child(3) .right-item h4::after {
    background: linear-gradient(90deg, #45b7d1, #096dd9);
}

/* Loading animation */
.service-card {
    opacity: 0;
    transform: translateY(50px);
    animation: fadeInUp 0.6s ease forwards;
}

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .services-container,
    .services-container.reverse {
        grid-template-columns: 1fr;
        direction: ltr;
    }

    .left-item {
        height: 250px;
    }

    .right-item {
        padding: 30px 25px;
    }

    .section-header h2 {
        font-size: 2.2rem;
    }

    .services-grid {
        gap: 30px;
    }
}

@media (max-width: 480px) {
    .services-section {
        padding: 60px 0;
    }

    .container {
        padding: 0 15px;
    }

    .right-item {
        padding: 25px 20px;
    }

    .right-item h4 {
        font-size: 1.5rem;
    }

    .theme-btn {
        padding: 12px 25px;
        font-size: 0.8rem;
    }
}

/* Modal Styles */
.contact-form-area button[data-bs-dismiss="modal"] {
    position: absolute;
    top: 10px;
    right: 10px !important;
    left: auto;
    color: red;
    background: none;
    border: none;
    font-size: 1.5rem;
    z-index: 1000;
}

.contact-form-area.pt-4 {
    padding: 20px;
}

.modal-content {
    border-radius: 15px;
    border: none;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
}

.form-control {
    border-radius: 10px;
    border: 2px solid #e9ecef;
    padding: 12px 15px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.default-btn {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 50px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.default-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
}
</style>

@endsection

@section('script')
<script>
    $("#contactUsForm").on("submit", function () {
        var full_number = phone_number.getNumber(intlTelInputUtils.numberFormat.E164);
        full_number = Number(full_number);
        //$("#phone_number").val(full_number);
        typeof (full_number);
        $("#country_code_id").val("+" + phone_number.getSelectedCountryData().dialCode);
        var form = new FormData(this);

        $("#submitButton").attr("disable", true);
        $.ajax({
            type: 'post',
            url: '{{ route('saveContactUsDetails') }}',
            data: form,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status) {
                    successMessage(response.message, true);
                } else {
                    errorMessage(response.message ?? "Something went wrong.");
                    $("#submitButton").attr("disable", false);
                    refreshCapthca('captcha_img_id', 'captcha');
                }
            },
            failure: function (response) {
                errorMessage(response.message ?? "Something went wrong.");
                $("#submitButton").attr("disable", false);
                refreshCapthca('captcha_img_id', 'captcha');
            },
            error: function (response) {
                errorMessage(response.message ?? "Something went wrong.");
                $("#submitButton").attr("disable", false);
                refreshCapthca('captcha_img_id', 'captcha');
            }
        });
    });
    var phone_number = window.intlTelInput(document.querySelector("#phone_number"), {
        separateDialCode: true,
        preferredCountries: ["in"],
        hiddenInput: "full",
        utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
    });
</script>

@section('script')
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        @foreach ($services as $index => $item)
            new Swiper(".mySwiper{{ $index }}", {
                loop: true,
                pagination: {
                    el: ".mySwiper{{ $index }} .swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".mySwiper{{ $index }} .swiper-button-next",
                    prevEl: ".mySwiper{{ $index }} .swiper-button-prev",
                },
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
            });
        @endforeach
    });
</script>


@endsection