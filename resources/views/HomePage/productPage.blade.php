@extends('layouts.webSite')
@section('title', 'Services')
@section('content')
<div class="information-page-slider">
    <div class="information-content">
        <h1><a href="{{ url('/') }}">Home</a><span>Services</span></h1>
    </div>
</div>
<div id="about">
    <div class="default-content products-page pt-5 pb-3">
        <div class="custom-container">
            <div class="site-title pb-3">
                <h2 class="text-center">Our Services</h2>
                {{-- <p class="text-center pb-3">From basic treks to high-altitude mountaineering expeditions, we cater to adventurers of all levels.</p> --}}
            </div>
            <div class="midd-content">
                <div class="row">
                    @foreach ($services as  $item)
                    <div class="col-md-12 mb-4 offerings-container">
                        <div class="offerings-block">
                            <div class="offerings-content">
                                <div class="offerings-content-inner">
                                    <h3>{{ $item->heading_top }}</h3>
                                    <p class="text-justify">{{ $item->heading_middle }}</p>
                                    <a href="javascript:void(0)" type="button" data-bs-toggle="modal"
                            data-bs-target="#enquery-pop"><i class="fa fa-link" aria-hidden="true"></i> Enquiry Now</a>
                                </div>
                            </div>
                            <div class="offerings-figure" data-aos="zoom-in-up">
                                <img src="{{ asset($item->image) }}" class="img-fluid rounded" width="" height="" alt="{{ $item->heading_top }}" >
                            </div>
                            
                        </div>
                    </div>
                    @endforeach
                   
                    <!-- <div class="col-md-12 mb-4 offerings-container">
                        <div class="offerings-block">
                            <div class="offerings-content">
                                <div class="offerings-content-inner">
                                    <h3>Tomato</h3>
                                    <p>The tomato, often referred to as the "love apple," is a culinary gem cherished for its vibrant color, juicy texture, and versatile flavor. Originating from the Andes region of South America, this humble fruit has journeyed across continents to become a staple ingredient in cuisines around the globe. Whether enjoyed fresh in salads, cooked into rich sauces, or sun-dried for intensified sweetness, the tomato's culinary potential knows no bounds.</p>
                                    <a href="javascript:void(0)" type="button" data-bs-toggle="modal"
                                    data-bs-target="#enquery-pop"><i class="fa fa-link" aria-hidden="true"></i> Enquiry Now</a>
                                </div>
                            </div>
                            <div class="offerings-figure" data-aos="zoom-in-down">
                                <img src="assets/img/tomato.jpg" class="img-fluid rounded" width="" height="" alt="Bikaner"  />
                            </div>
                        </div>
                    </div> -->
               



                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="enquery-pop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</div>

<style>
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
@endsection