@extends('layouts.index')

@section('content')
@php
use app\Http\helper\Helper as Helper;
$mainMenuTitle = Helper::mainMenuTitleById($page->parent_id);
$leftSubMenu = Helper::geSubMenu($page->parent_id);
@endphp
<section class="pageBanner" style="background-image: url({{asset('public/website/images/about-us-banner.jpg')}})">
    <div class="pageHeading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Feedback and Complaints</h1>
                    <span class="subTitle">National Ambulance</span>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Banner end-->
<section class="pageBreadcrumbs">
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb" class="col-md-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">{{$mainMenuTitle->title}}</a></li>
                    <!--<li class="breadcrumb-item"><a href="#">Library</a></li>-->
                    <li class="breadcrumb-item active" aria-current="page">{{$page->title}}</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<!--pageBreadcrumbs end-->
<section class="pageWrapper section_padding feedbackWrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="wrapTitle">{{$page->title}}</h2>
            </div>
            <div class="col-md-4 col-xl-3">
                @include('website.includes.side_bar')
                <!-- <aside class="menuSidebar mt-4">
                         <h4>Contact US</h4> 
                         <ul class="sidebarNav">
                             <li><a href="#">Who We Are</a></li>
                             <li><a href="#">Mission & Vision</a></li> 
                             <li><a href="#">CEO Message</a></li>
                             <li><a href="#">Public Emergency Service</a></li> 
                         </ul>
                     </aside> -->
                 </div>
                 <div class="col-md-8 col-xl-9">
                    <div class="contentWrap mt-4">
                    <!-- <h3>National Ambulance welcomes and values all feedback, whether positive or negative, and use it to improve our services.</h3>
                        <p>We encourage our customers to share their experiences or comments with us. Our Feedback Team is dedicated to make every effort to respond to you in a timely and respectful manner. You can get in touch with the team through the following ways:</p>
                        <div class="feedbackIcon mb-5">
                            <ul>
                              <li>
                                  <i class="fd_icon"><img src="{{asset('public/website/images/document.svg')}}" /></i>
                                  <h6>Filling the Electronic<br>Feedback Form</h6>
                              </li>
                              <li>
                                  <i class="fd_icon"><img src="{{asset('public/website/images/call-center.svg')}}" /></i>
                                  <h6>Calling the Customer and Patient Feedback Desk<br>+971 2 596 8689</h6>
                              </li>
                              <li>
                                  <i class="fd_icon"><img src="{{asset('public/website/images/feedback-whatsapp.svg')}}" /></i>
                                  <h6>Sending a WhatsApp <br>Message to<br>+971 50 899 8764</h6>
                              </li>
                              <li>
                                  <i class="fd_icon"><img src="{{asset('public/website/images/laptop.svg')}}" /></i>
                                  <h6>Conducting an Online<br>Survey</h6>
                              </li>
                            </ul>
                        </div>
                        <p><strong>All our communications with you will be treated in total confidence and not shared except with your explicit approval.<br>Once you submit a complaint, suggestion or a compliment:</strong></p>
                        <ul class="ulList mt-3">
                            <li>A reference number will be issued and shared with you via SMS</li>
                            <li>We will acknowledge receipt within three working days</li>
                            <li>You will receive a response from us within 25 working days of receipt</li>
                        </ul>
                        <p><strong>If for any reason you were not satisfied with the outcome of your complaint, the following options are available:</strong></p>
                        <ul class="ulList mt-3">
                            <li>The Department of Health – Abu Dhabi (DOH- Abu Dhabi) offers a clinical complaint registration service. If you wish to use it, visit DOH Customer Service Department or <a href="tel:800555">call 800555</a></li>
                            <li>Issues related to quality and safety can be directly reported to Joint Commission International (JCI) by sending an email to <a href="mailto:jciquality@jcrinc.com">jciquality@jcrinc.com</a></li>
                        </ul>
                        <div class="FeedbackContent mt-4">
                             <h4>How are we doing?</h4>
                             <p class="mb-4">We can't achieve our aims in isolation. We need our patients, their relatives, client healthcare facilities, healthcare professionals, customers and stakeholders to help us by letting us know how we are doing.</p>
                             <p class="mb-1"><strong>Why not take one of our surveys?</strong></p>
                             <p>Your input will form a part of our ongoing quality management and improvement process which will help us in making continuous improvements to our service delivery.</p>
                             <p>All our on-line surveys are collected using Survey Monkey®. You may fill in the name and contact details section or leave that section blank to ensure your responses are totally anonymous.</p>
                             <p><strong>Patient Satisfaction Survey</strong> – if you were a patient, care giver or an accompanying relative on one of our ambulances, let us know how your experience was. To participate in this survey <a target="_blank" href="https://www.surveymonkey.com/r/NA-Patients">click here</a></p>
                             <p class="mb-1"><strong>Strategic Stakeholder Survey</strong></p>
                             <p>As a valued stakeholder we welcome your feedback where we have interacted together. Whether it be on a joint emergency response, during an emergency incident or at one of your events or sites, we would like to hear from you about your perception of our service and how well we worked together. To participate in this survey <a target="_blank" href="https://www.surveymonkey.com/r/NA-Stakeholders">click here</a></p>
                             <p><strong>Hospital Survey</strong> – if you are a part of our emergency response as a receiving hospital, we welcome your feedback on your perception of our service and how well we worked together. To participate in this survey <a target="_blank" href="https://www.surveymonkey.com/r/NA-Stakeholders">click here</a></p>
                         </div> -->
                         {!!$page->description!!}
                         <div class="feedbackForm" >
                            <div class="form_panel">
                                <form method="post" class="eventCoverageForm" action="{{url('post-feedback')}}" name="EventCoverageForm">
                                    {{csrf_field()}}
                                    <div class="form_column">
                                        <h4 class="mb-3 fst-italic">Let us know how we did</h4>
                                        <div id="response_div" class="row">
                                            @if (session('success'))
                                    <!-- <div class="alert alert-success">
                                        {{ session('success') }}<br/>
                                        {{ session('msg') }}<br/>
                                        {{ session('mail') }}
                                    </div> -->
                                    <p class="text-danger">
                                        {{ session('success') }}<br/>
                                        <!-- {{ session('msg') }}<br/> -->
                                        <!-- {{ session('mail') }} -->
                                    </p>
                                    @endif
                                    @if (session('error'))
                                    <!-- <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div> -->
                                    <p class="text-danger">
                                        {{ session('error') }}
                                    </p>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Type of Feedback</label>
                                        <select id="feedback_type" name="type" class="form-control" required="true">
                                            <option value="" disabled="true">Type of Enquiry
                                            </option>
                                            <option selected="true" value="Complaint">Complaint</option>
                                            <option value="Compliment">Compliment</option>
                                            <option value="Suggestion">Suggestion</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        @error('type')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Title *</label>
                                        <select id="title" name="title" class="form-control" required="true">
                                            <option value="">Select</option>
                                            <option value="Mr">Mr</option>
                                            <option value="Mrs">Mrs</option>
                                            <option value="Miss">Miss</option>
                                            <option value="Ms">Ms</option>
                                        </select>
                                        @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Name *</label>
                                        <input type="text" name="name" pattern="[A-Za-z ]{1,32}" class="form-control" title="no numeric values accepted for Name" placeholder="" required="true">
                                        @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div id="nationality_div" class="form-group col-md-12">
                                        <label>Nationality *</label>
                                        <input type="text" pattern="[A-Za-z ]{1,32}" title="no numeric values accepted for Nationality" name="nationality" class="form-control"
                                        placeholder="">
                                        @error('nationality')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Email *</label>
                                        <input type="email" name="email" class="form-control" placeholder="" required="true">
                                        @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Contact Number *</label>
                                        <input type="text" name="contact" pattern="^(?:\+971|00971|0)?(?:50|51|52|55|56|2|3|4|6|7|9)\d{7}$" class="form-control" title="not a valid UAE phone number" placeholder="" required="true">
                                        @error('contact')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Reference [CAD] Number (If available)</label>
                                        <input type="text" name="cad" class="form-control" placeholder="">
                                        @error('cad')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Incident Date</label>
                                        <input type="date" name="incident_date" max="{{\Carbon\Carbon::now()->format('Y-m-d')}}" class="form-control"
                                        placeholder="">
                                        @error('incident_date')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div id="area_location_div" class="form-group col-md-6">
                                        <label>City</label>
                                        <input type="text" name="area_location" class="form-control"
                                        placeholder="In which location/ area the incident take place?">
                                        @error('area_location')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Country</label>
                                        <select name="emirates" class="form-control">
                                            <option value="">In which Emirate the incident take place?</option>
                                            <option value="Sharjah">Sharjah</option>
                                            <option value="Ajman">Ajman</option>
                                            <option value="Umm Al Quwain">Umm Al Quwain</option>
                                            <option value="Ras Al Khaima">Ras Al Khaima</option>
                                            <option value="Fujairah">Fujairah</option>
                                            <option value="Abu Dhabi">Abu Dhabi</option>
                                            <option value="Dubai">Dubai</option>
                                        </select>
                                        @error('emirates')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label id="feedback_message">Complaint*</label>
                                        <textarea name="feedback_message" class="form-control" rows="5" placeholder="" required="true"></textarea>
                                        @error('feedback_message')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div id="complaint_soltn_div" class="form-group col-md-12">
                                        <label>Suggested Solutions</label>
                                        <textarea name="solution" class="form-control" rows="5" placeholder=""></textarea>
                                        @error('solution')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    @if(config('services.recaptcha.key'))
                                    <div class="g-recaptcha"
                                    data-sitekey="{{config('services.recaptcha.key')}}">
                                </div>
                                @endif 
                                @error('g-recaptcha-response')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <div class="form-check form-check-flat">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" required>I hereby certify
                                        that all information provided in this form is correct. <i class="input-helper"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form_column">
                            <div class="row">
                                <div class="btn_column form-group col-md-12">
                                    <button type="submit" class="default_btn">Submit</button>
                                </div>
                            </div>

                        </div>


                    </form>
                </div>
            </div>
            <!-- Event Coverage Service Form -->
        </div>
    </div>
</div>
</div>
</section>

@endsection
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    // var maxDate = 

    $(function () {
        $("#feedback_type").change(function () {
            let val = $(this).val();

            // if (val === 'suggestion' || val === 'others') {
            //     $('#company_name').hide();
            //     $('#emailDiv').removeClass()
            //     $('#emailDiv').addClass('form-group col-md-12')
            // }
            $('#complaint_soltn_div').hide();
            if (val === 'Suggestion' || val === 'Other') {
                $('#feedback_message').html("Message*");
            } else if (val === 'Compliment') {
                $('#feedback_message').html("Compliment*");
            } else if (val === 'Complaint') {
                $('#feedback_message').html("Complaint*");
                $('#complaint_soltn_div').show();
            }

            if (val === 'Complaint' || val === 'Compliment') {
                $('#nationality_div').show();
                $('#area_location_div').show();
            }else{
                $('#nationality_div').hide();
                $('#area_location_div').hide();
            }
        });
    });


</script>
@section('script')

@endsection
<!--/ footer-->