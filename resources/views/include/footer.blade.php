{{-- Recognitions --}}

<!-- <section class="recognitions pt-5 pb-4">
    <div class="custom-container">
        <div class="site-title pb-3">
            <h2 class="text-center">Recognitions</h2>
        </div>
        <div class="recognitions-self swiper">
            <div class="swiper-wrapper">
                @if (!empty($Recognitions))
                @foreach ($Recognitions as $RecoRow)
<div class="swiper-slide mb-4">
                    <div class="destinations-new">
                        <div class="destinations-inner">
                            <div>
                            <img src="{{ url($RecoRow->image) }}" class="img-fluid" width="300" height="400"  alt="Lakshadweep">
                        </div> -->
<!-- <span class="destinations-title">Certificate-1</span> -->
<!-- </div>
                    </div>
                </div>
@endforeach
@else
<div class="swiper-slide mb-4">
                    <div class="destinations-new">
                        <div class="destinations-inner">
                            <img src="assets/img/fssai.png" class="img-fluid" width="300" height="400" alt="India Gate"> -->
<!-- <span class="destinations-title">Certificate-2</span> -->
<!-- </div>
                    </div>
                </div>
                <div class="swiper-slide mb-4">
                    <div class="destinations-new">
                        <div class="destinations-inner">
                            <img src="assets/img/ministry.png" class="img-fluid" width="300" height="400" alt="Hawamahal"> -->
<!-- <span class="destinations-title">Certificate-3</span> -->
<!-- </div>
                    </div>
                </div>
                @endif


            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section> -->
{{-- Recognitions End --}}
<!-- Footer Section -->

<footer class="footer-section " style="padding-top:10px">
    <div class="custom-container">
        <div class="row">
            <div class="col-lg-5 col-md-6 col-sm-12 mb-4 ">
                <div class="footer-item">
                    <div class="footer-logo">
                        <div class="footer-logo-inner">
                            <img src="{{ asset('./assets/img/dparch1.png') }}" class="img-fluid image-class" width="130"
                                height="86" alt="DP Arch">
                        </div>
                        <p style="margin-left: 24px;margin-bottom:0px;padding:0px;text-lg-center"><b style="margin-bottom:0px">{!! $footer_logo_name ?? 'Design Park Architects' !!}</b></p>
                        <p class="footer-tagline "
                            style="">
                            Beyond the Blueprint <br>SIMPLE . STRONG . MEMORABLE
                        </p>

                        <a href="#" class="compact-enquiry-btn " data-bs-toggle="modal"
                            data-bs-target="#compactEnquiryModal"
                            style="margin-left: 25px;color:#fff !important; border:none; background-color:#070736fc; color:white;padding:15px 10px; ">
                            <span style="font-size:13px">Enquire now</span>
                        </a>
                        {{-- <ul class="social-media mt-4">
                        <li><a href="{!! $facebook_link ?? 'https://www.facebook.com/DP Arch' !!}" aria-label="Read more about DP Arch  facebook"><i class="fa-brands fa-facebook"></i></a></li>
                        <li><a href="{!! $linkedin_link ?? '/' !!}" aria-label="Read more about DP Arch  Linkedin"><i class="fab fa-linkedin"></i></a></li>
                        <li><a href="{!! $instagram_link ?? 'https://www.instagram.com/adiyogi_global' !!}" aria-label="Read more about DP Arch  Instagram"><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href="{!! $youtube_link ?? 'https://www.youtube.com/@DP Arch' !!}" aria-label="Read more about DP Arch  Youtube"><i class="fa-brands fa-youtube"></i></a></li>
                        </ul> --}}
                        {{-- <p class="text-center mb-0"><img style="max-width: 100%" src="assets/img/msme.png" alt="DP Arch " width="100%" height="" /></p> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="footer-item">
                    <h5 class="footer-title">Quick Link</h5>
                    <ul>
                        <li><a href="{{ route('aboutUs') }}">About Us</a></li>
                        <li><a href="{{ route('termsConditions') }}">Terms & Conditions</a></li>
                        <!-- {{-- <li><a href="{{ route('shippingDeliverypolicy') }}">Shipping & Delivery Policy</a></li>
                        <li><a href="{{ route('CancellationRefundPolicy') }}">Cancellation & Refund Policy</a></li> --}} -->
                        <li><a href="{{ route('privacyPolicy') }}">Privacy Policy</a></li>

                        <li><a href="{{ route('productPage') }}">Projects</a></li>
                        <li><a href="{{ route('galleryPages') }}">Gallery</a></li>
                        <li><a href="{{ route('blogPage') }}">Articles</a></li>

                        <li><a href="{{ route('contactUs') }}">Contact Us</a></li>
                        <li><a href="{{ route('sitemap') }}">Sitemap</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="footer-item">
                    <h5 class="footer-title">Contact Information</h5>
                    <div class="footer-contact">
                        <div class="footer-item pb-3">
                            <label>Company E-mail:</label>
                            <p class="footer-email"><i class="fa-solid fa-envelope"></i>&nbsp;<a
                                    href="mailto:{!! $email_2 ?? 'info@dparch.co.in' !!}"
                                    style="font-size:20px;">{!! $email_2 ?? 'info@dparch.co.in' !!}</a>
                        </div>
                        <div class="footer-item pb-3">
                            <label>Contact No:</label>
                            <p><i class="fa-solid fa-phone"></i>&nbsp;<a
                                    href="tel:+91{!! isset($contact_us_contact_number) ? str_replace(' ', '', $contact_us_contact_number) : '+919958298515' !!}">{!! $contact_us_contact_number ?? '+919958298515' !!}</a></p>
                        </div>
                        <div class="footer-item pb-3">
                            <label>Address:</label>
                            <p><i class="fa-solid fa-location-dot"></i>
                                {!! $address ??
                                    'Block K, Birbal Road, Jangpura Ext.
                                
                                New Delhi - 110014' !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Right-Sliding Enquiry Modal -->
    <div class="modal slide-right fade" id="compactEnquiryModal" tabindex="-1"
        aria-labelledby="compactEnquiryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content compact-modal-content">
                <div class="modal-header compact-modal-header">
                    <div class="d-flex flex-column align-items-center w-100">
        {{-- Logo section --}}
        {{-- <div class="mb-2"> 
            <img src="{{ asset('./assets/img/dparch.png') }}" class="img-fluid "style="max-height: 60px; max-width: 120px;"alt="DP Arch">
        </div> --}}
        {{-- End Logo section --}}

        <div>
            <h5 class="modal-title compact-modal-title" id="compactEnquiryModalLabel">Quick Enquiry</h5>
        </div>
    </div>
                    <button type="button" class="btn-close compact-close-btn" style="color:black"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body compact-modal-body">
                    <form enctype="multipart/form-data" method="POST" id="compactContactUsForm"
                        action="{{ route('saveContactUsDetails') }}">
                        @csrf
                        <input type="hidden" name="country_code" value="IN" id="country_code_id">

                        <div class="row g-3 " style="margin-top:20px" >
                            <!-- First & Last Name -->
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">First Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control shadow-sm" id="first_name"
                                    name="first_name" placeholder="Enter first name..." required>
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="form-label">Last Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control shadow-sm" id="last_name" name="last_name"
                                    placeholder="Enter last name.." required>
                            </div>

                            <!-- Email & Phone -->
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address <span
                                        class="text-danger">*</span></label>
                                <input type="email" class="form-control shadow-sm" id="email" name="email"
                                    placeholder="Enter Email..." required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone_number" class="form-label">Phone Number <span
                                        class="text-danger">*</span></label>
                                <input type="tel" class="form-control shadow-sm" id="phone_number"
                                    name="phone_number" placeholder="Enter phone number..." required>
                            </div>

                            <!-- Message -->
                            <div class="col-12">
                                <label for="message" class="form-label">Message <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control shadow-sm" id="message" name="message" rows="4"
                                    placeholder="Write your message here..." required></textarea>
                            </div>

                            <!-- Captcha -->
                            <div class="col-md-6">
                                <label for="captcha" class="form-label">Captcha <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control shadow-sm" id="captcha" name="captcha"
                                    placeholder="Enter the captcha" required>
                            </div>
                            <div class="col-md-6 d-flex align-items-end">
                                <div class="d-flex align-items-center">
                                    <img src="{{ captcha_src() }}" id="enquiry_captcha_img"
                                        class="img-thumbnail me-2" alt="captcha" style="height: 45px;">
                                    <button type="button" onclick="refreshCaptcha()"
                                        class="btn btn-outline-secondary btn-sm">Refresh</button>
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="col-12 text-center pt-2">
                                <button type="submit" class="btn btn-primary w-100 fw-semibold py-2"
                                    style="background:#070736fc;" id="submitButton">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>


                    <div id="formResponse" class="mt-3"></div>


                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Success Alert -->
    {{-- <div class="alert alert-success alert-dismissible fade compact-success-alert" role="alert" id="compactSuccessAlert">
        <i class="fas fa-check-circle me-2"></i>
        <strong>Success!</strong> Your enquiry has been submitted.
        <button type="button" class="btn-close" style="" onclick="hideCompactAlert()"></button>
    </div> --}}

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> --}}
    <script>
        function refreshCaptcha() {
            document.getElementById('enquiry_captcha_img').src = "{{ captcha_src() }}?" + Math.random();
            document.getElementById('captcha').value = '';
        }

        // $('#compactContactUsForm').on('submit', function (e) {
        //     e.preventDefault();

        //     let form = this;
        //     let formData = new FormData(form);
        //     $('#submitButton').attr('disabled', true).text('Submitting...');

        //     $.ajax({
        //         url: '{{ route('saveContactUsDetails') }}',
        //         method: 'POST',
        //         data: formData,
        //         contentType: false,
        //         processData: false,

        // //         success: function (response) {
        // //             $('#submitButton').attr('disabled', false).text('Submit');

        // //             if (response.status === true) {
        // //                 Swal.fire({
        // //                     icon: 'success',
        // //                     title: 'Success!',
        // //                     text: response.message || 'Your message has been sent.',
        // //                     confirmButtonColor: '#3085d6',
        // //                     confirmButtonText: 'OK'
        // //                 }).then(() => {
        // //                     const modal = bootstrap.Modal.getInstance(document.getElementById('compactEnquiryModal'));
        // //                     if (modal) modal.hide();
        // //                 });

        // //                 form.reset();
        // //             } else {
        // //                 Swal.fire({
        // //                     icon: 'error',
        // //                     title: 'Oops...',
        // //                     text: response.message || 'Something went wrong!'
        // //                 });
        // //             }

        // //             refreshCompactCaptcha();
        // //         },

        // //         error: function (xhr) {
        // //     $('#submitButton').attr('disabled', false).text('Submit');

        // //     let msg = 'Something went wrong.';
        // //     if (xhr.responseJSON?.errors) {
        // //         msg = Object.values(xhr.responseJSON.errors).flat().join('\n');
        // //     } else if (xhr.responseJSON?.message) {
        // //         msg = xhr.responseJSON.message;
        // //     }

        // //     Swal.fire({
        // //         icon: 'error',
        // //         title: 'Submission Failed',
        // //         text: msg
        // //     });

        // //     refreshCompactCaptcha();
        // // }
        // success: function (response) {
        //     $('#submitButton').attr('disabled', false).text('Submit');

        //     if (response.status === true) {
        //         Swal.fire({
        //             icon: 'success',
        //             title: 'Success!',
        //             text: response.message || 'Your message has been sent.',
        //         }).then(() => {
        //             const modal = bootstrap.Modal.getInstance(document.getElementById('compactEnquiryModal'));
        //             if (modal) modal.hide();
        //         });
        //         form.reset();
        //     } else {
        //         Swal.fire({
        //             icon: 'warning',
        //             title: 'Notice',
        //             text: response.message || 'Submission already exists today.',
        //         });
        //     }

        //     refreshCompactCaptcha();
        // },


        //     });
        // });
        $('#compactContactUsForm').on('submit', function(e) {
            e.preventDefault();

            let form = this;
            let formData = new FormData(form);
            $('#submitButton').attr('disabled', true).text('Submitting...');

            $.ajax({
                url: '{{ route('saveContactUsDetails') }}',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status) {
                        successMessage(response.message);
                        closeModal();
                    } else {
                        errorMessage(response.message ?? "Something went wrong.");
                        $('#submitButton').attr('disabled', false);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        if (errors?.captcha) {
                            errorMessage(errors.captcha[0]);
                        } else {
                            errorMessage("Please check all required fields.");
                        }
                        refreshCaptcha()
                    } else if (xhr.status === 400) {
                        // Logical or duplicate submission error
                        const message = xhr.responseJSON?.message ||
                            "You already sent a message for today.";
                        errorMessage(message);
                    } else {
                        // Other server-side issues
                        errorMessage("Something went wrong.");
                    }

                    $('#submitButton').attr('disabled', false);
                }

            });
        });
    </script>
</footer>

<div class="copyright-section text-center p-3">&copy;
    <script>
        document.write(new Date().getFullYear());
    </script>
    {{ isset($WebSetting['0']->copyright_txt) ? $WebSetting['0']->copyright_txt : ' All Rights Reserved by Design Park Architects ' }}
    & Developed by <a href="https://vyaparkranti.com/" class="text-white" aria-label="Digital Markating"
        alt="Vyapar Kranti">Vyapar kranti</a>
</div>
<!-- Footer Section End-->
<style>
     @media (max-width: 575.98px) {
    .image-class {
      margin-left: 20px !important;
    }
  }
    .footer-tagline{
        font-size: 1.05rem; font-weight: 500; color: #333; text-align: left; margin-bottom: 2px;
        color:black !important;
        margin-left:25px !important;
    }
    /* Demo content */
    @media (max-width: 768px) {
  .footer-tagline {
 text-align: center ;
  }
  .img-a{
    margin-left:30px;
  }
}

/* Small devices (≤ 480px) */
@media (max-width: 480px) {
  .footer-tagline {
    text-align: center;
  }
   .img-a{
    margin-left:30px;
  }

}
    .demo-page-content {
        height: 120vh;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        text-align: center;
    }

    .demo-page-content h1 {
        color: #333;
        margin-bottom: 20px;
        font-size: 3rem;
        font-weight: bold;
    }

    .demo-page-content p {
        color: #666;
        font-size: 18px;
        max-width: 600px;
        line-height: 1.6;
    }





    /* Floating Enquiry Button */
    .compact-enquiry-btn {
        /* REMOVE the following properties that made it fixed and vertical: */
        /* position: fixed; */
        /* top: 60%; */
        /* right: 0; */
        /* transform: translateY(-50%); */
        /* z-index: 1000; */
        /* width: 38px; */
        /* height: 130px; */
        /* writing-mode: vertical-rl; */
        /* text-orientation: mixed; */
        /* white-space: nowrap; */

        /* NEW OR MODIFIED PROPERTIES FOR IN-FLOW BUTTON: */
        display: inline-flex;
        /* Use flex to align icon and text horizontally */
        align-items: center;
        justify-content: center;

        /* margin-top: 20px; */
        /* Add some space above the button */
        /* margin-left: 23px; -> Removed from CSS, added inline to HTML for precise alignment */

        background: #070736fc;
        color: white;
        font-weight: bold;
        font-size: 14px;
        /* Slightly adjusted font size for better button look */
        text-transform: uppercase;
        border: 1px solid black;
        padding: 10px 20px;
        /* Standard button padding */
        border-radius: 5px;
        /* Add slight rounded corners for a button feel */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Standard shadow */
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        /* Ensure no underline */
        letter-spacing: 0.5px;
    }

    .compact-enquiry-btn:hover {
        background: red;
        /* Removed 'right: 4px;' as it's no longer fixed */
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        transform: translateY(-2px);
        /* Keep a slight lift on hover */
    }

    /* Ensure the icon within the button looks correct horizontally */
    .compact-enquiry-btn i {
        /* If you had transform: rotate(180deg) on the span, remove it. */
        /* If you want space between icon and text, use me-2 class from Bootstrap or add margin-right: 5px; here */
    }

    /* You can remove the .compact-enquiry-btn .icon rule if you're using Bootstrap's me-2 */
    /* .compact-enquiry-btn .icon {
    transform: rotate(90deg);
} */

    /* .compact-enquiry-btn:hover {
            transform: translateY(-50%) scale(1.05);
            box-shadow: 0 6px 25px rgba(255, 107, 53, 0.6);
            color: white;
            text-decoration: none;
        } */

    @keyframes compact-pulse {
        0% {
            box-shadow: 0 4px 20px rgba(255, 107, 53, 0.4);
        }

        50% {
            box-shadow: 0 4px 30px rgba(255, 107, 53, 0.7);
        }

        100% {
            box-shadow: 0 4px 20px rgba(255, 107, 53, 0.4);
        }
    }

    /* Right-sliding Modal */
    .modal.slide-right .modal-dialog {
        position: fixed;
        right: 0;
        top: 0;
        height: 100vh;
        margin: 0;
        transform: translateX(100%);
        transition: transform 0.3s ease-in-out;
    }

    .modal.slide-right.show .modal-dialog {
        transform: translateX(0);
    }

    .compact-modal-content {
        border-radius: 0;
        border: none;
        height: 100vh;
        overflow-y: auto;
        max-width: 500px;
        min-width: 400px;
        box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
    }

    .compact-modal-header {
        background: #070736fc;;

        transition: var(--transition) color: white;
        border-bottom: none;
        padding: 20px;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .compact-modal-title {
        font-weight: bold;
        font-size: 1.25rem;
        margin: 0;
        color:white;
    }

    .compact-close-btn {
        filter: invert(1);
        font-size: 1.2rem;
        color: white;
    }

    .compact-modal-body {
        padding: 30px 20px;
        background: white;
    }

    /* Form Styling */
    .compact-form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 20px;
    }

    .compact-form-group {
        margin-bottom: 20px;
    }

    .compact-form-input,
    .compact-form-textarea {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
        background-color: #f8f9fa;
    }

    .compact-form-input:focus,
    .compact-form-textarea:focus {
        outline: none;
        border-color: #ff6b35;
        background-color: white;
        box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.15);
    }

    .compact-captcha-section {
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 15px;
        align-items: center;
        margin-bottom: 20px;
    }

    .compact-captcha-display {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .compact-captcha-code {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        padding: 12px 16px;
        border-radius: 8px;
        font-family: monospace;
        font-weight: bold;
        color: #333;
        min-width: 90px;
        text-align: center;
        font-size: 16px;
        border: 2px solid #dee2e6;
    }

    .compact-refresh-btn {
        background: linear-gradient(135deg, #6c757d, #495057);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 14px;
    }

    .compact-refresh-btn:hover {
        background: linear-gradient(135deg, #495057, #343a40);
        transform: translateY(-1px);
    }

    /* Button Layout */
    .compact-button-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-top: 30px;
    }

    .compact-submit-btn {
        background: linear-gradient(135deg, #ff6b35, #f7931e);
        color: white;
        border: none;
        border-radius: 25px;
        padding: 12px 24px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .compact-cancel-btn {
        background: linear-gradient(135deg, #6c757d, #495057);
        color: white;
        border: none;
        border-radius: 25px;
        padding: 12px 24px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .compact-submit-btn:hover {
        transform: translateY(-2px);

        box-shadow: 0 5px 15px rgba(255, 107, 53, 0.4);
    }

    .compact-cancel-btn:hover {
        background: linear-gradient(135deg, #495057, #343a40);
        transform: translateY(-2px);
    }

    /* Section titles */
    .compact-section-subtitle {
        color: rgba(255, 255, 255, 0.8);
        font-size: 12px;
        margin-bottom: 5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .compact-section-title {
        color: #ff6b35;
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 25px;
    }

    /* Success Alert */
    .compact-success-alert {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1050;
        display: none;
        max-width: 350px;
        border-radius: 10px;
        border: none;
        box-shadow: 0 5px 20px rgba(25, 135, 84, 0.3);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .compact-enquiry-btn {
            right: 15px;
            padding: 10px 16px;
            font-size: 12px;
 
}
        }
                   @media (max-width: 576px) {
    .compact-enquiry-btn {
        margin-left: -8px !important;
    }

        .compact-modal-content {
            min-width: 100vw;
            max-width: 100vw;
        }

        .compact-form-row,
        .compact-captcha-section,
        .compact-button-row {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .compact-modal-body {
            padding: 20px 15px;
        }

        .demo-page-content h1 {
            font-size: 2rem;
        }
    }

    /* Custom backdrop for right slide */
    .modal.slide-right .modal-backdrop {
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    .modal.slide-right.show .modal-backdrop {
        opacity: 0.5;
    }

    .footer-tagline {
        font-size: 0.9rem;
        color: #ccc;
        margin-top: 5px;
        max-width: 300px;
    }
</style>
