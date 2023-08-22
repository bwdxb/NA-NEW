@extends('layouts.index')
@section('meta_tags')
        {!! Meta::toHtml() !!} 
        <meta property="og:title" content="Contact Us" />
@endsection


@section('content')
<section class="contactMap">
    <!--           <ul class="nav nav-pills" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="pills-headquarters-tab" data-bs-toggle="pill" data-bs-target="#pills-headquarters" role="tab" aria-controls="pills-headquarters" aria-selected="true"  href="javascript:void(0)">
                  Headquarters
                </a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-warehouse-tab" data-bs-toggle="pill" data-bs-target="#pills-warehouse" role="tab" aria-controls="pills-warehouse" aria-selected="false" href="javascript:void(0)">
                  Warehouse
                </a>
              </li>   
          </ul> -->
    <div class="tab-content" id="pills-tabContent">
        <div class='tab-pane fade show active' id='pills-headquarters' role="tabpanel"
            aria-labelledby="pills-headquarters-tab">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7264.537526748368!2d54.575754!3d24.441459!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5e6593af65e16f%3A0xbece1fa3d55b51ca!2sNational%20Ambulance%20HQ!5e0!3m2!1sen!2sin!4v1622464241798!5m2!1sen!2sin"
                class="locationMap" width="1920" height="450" style="border:0;" allowfullscreen=""
                loading="lazy"></iframe>
        </div>
    </div>
</section>
<section id="contactForm" class="contactWrapper section_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xxl-7 mb-5">
                <h2 class="wrapTitle">{{__('Contact Us')}}</h2>
                
                @if(app()->getLocale() == 'en')
                {!!$contact->description!!}
                            @else
                            {!!$contact->description_ar!!}
                            @endif
            </div>
            <div class="col-md-6 col-xxl-5 contactBtns">
                <a id="pcr_scroll" class="default_btn navyblue_btn" href="{{ route('feedback') }}?type=Request%20Patient%20Care%20Record%20(PCR)#feedbackFormLink">{{__('Patient Care Record')}}</a>
                <a class="default_btn primary_btn" href="{{ route('feedback') }}">{{__('Feedback and Complaints')}}</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <h4 class="mb-3">{{__('Contact Info')}}</h4>
                <ul class="contact_address">
                    <li>
                        <i class="fa fa-building mt-1"></i>
                        <p>
                            <span>{{__('Head Office Working Hours:')}}</span>
                            <span>{{__('Monday to Thursday: 8:00AM - 5:00PM')}}</span>
                            <span>{{__('Friday: 8:00AM - 12:00PM')}}</span>
                            <span>{{__('(excluding Public Holidays)')}}</span>
                        </p>
                    </li>
                    <li>
                        <i class="fa fa-map-marker-alt mt-1"></i>
                        <p>
                            <span>{{__('Al Dar HQ, Level 13')}}</span>
                            <span>{{__('2, Al Rahah St')}}</span>{{__('Al Rahah, Abu Dhabi 23035')}}<br>{{__('United Arab Emirates')}}</p>
                    </li>
                    <li>
                        <i class="fa fa-phone-alt"></i>
                        <p>+971 2 596 8600</p>
                    </li>
                    <li>
                        <i class="mt-1"><img class="poIcon"
                                src="{{ asset('public/website/images/contact-postbox.svg') }}" /></i>
                        <p><span>{{__('PO Box : 63788,')}}</span><span>{{__('Abu Dhabi, UAE')}}</span</p>
                    </li>
                </ul>
                <div class="socialWidget">
                    <h4>{{__('Connect With Us')}}</h4>
                    <a class="facebook" href="https://www.facebook.com/NAmbulanceUAE/" target="_blank">
                        <svg id="Capa_1" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 51.97 96.12">
                            <path
                                d="M72.09,0,59.62,0c-14,0-23,9.28-23,23.66v10.9H24a2,2,0,0,0-2,2V52.33a2,2,0,0,0,2,2H36.57V94.16a2,2,0,0,0,2,2H54.88a2,2,0,0,0,2-2V54.29H71.5a2,2,0,0,0,2-2V36.52a2,2,0,0,0-2-2H56.84V25.32c0-4.45,1.06-6.7,6.85-6.7h8.4a2,2,0,0,0,2-2V2A2,2,0,0,0,72.09,0Z"
                                transform="translate(-22.08)" /></svg>
                    </a>
                    <a class="twitter" href="https://twitter.com/NAmbulanceUAE" target="_blank">
                        <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 13">
                            <path
                                d="M16,3.54a6.31,6.31,0,0,1-1.88.51,3.33,3.33,0,0,0,1.44-1.81A6.54,6.54,0,0,1,13.48,3a3.32,3.32,0,0,0-2.4-1A3.28,3.28,0,0,0,7.8,5.28,3.67,3.67,0,0,0,7.88,6,9.32,9.32,0,0,1,1.12,2.6,3.19,3.19,0,0,0,.67,4.25,3.28,3.28,0,0,0,2.13,7,3.42,3.42,0,0,1,.64,6.57v0A3.28,3.28,0,0,0,3.28,9.83a3.58,3.58,0,0,1-.87.12,4.2,4.2,0,0,1-.62-.06,3.3,3.3,0,0,0,3.07,2.28,6.6,6.6,0,0,1-4.08,1.4,6.57,6.57,0,0,1-.78,0A9.3,9.3,0,0,0,5,15a9.27,9.27,0,0,0,9.34-9.34c0-.14,0-.28,0-.42A6.63,6.63,0,0,0,16,3.54Z"
                                transform="translate(0 -2)" /></svg>
                    </a>
                    <a class="instagram" href="https://www.instagram.com/nambulanceuae/" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 512 512">
                            <path
                                d="M392,512H120A120.13,120.13,0,0,1,0,392V120A120.13,120.13,0,0,1,120,0H392A120.13,120.13,0,0,1,512,120V392A120.13,120.13,0,0,1,392,512ZM120,40a80.09,80.09,0,0,0-80,80V392a80.09,80.09,0,0,0,80,80H392a80.09,80.09,0,0,0,80-80V120a80.09,80.09,0,0,0-80-80ZM397,90a25,25,0,1,0,25,25A25,25,0,0,0,397,90ZM256,386c-71.68,0-130-58.32-130-130,7.14-172.46,252.89-172.41,260,0C386,327.68,327.68,386,256,386Zm0-220a90.11,90.11,0,0,0-90,90c4.94,119.4,175.07,119.36,180,0A90.11,90.11,0,0,0,256,166Z" />
                        </svg>
                    </a>
                    <a class="linkedin" href="https://www.linkedin.com/company/nambulanceuae/" target="_blank">
                        <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 13">
                            <path
                                d="M6,6H8.77V7.42h0A3.05,3.05,0,0,1,11.54,6C14.46,6,15,7.82,15,10.18V15H12.11V10.73c0-1,0-2.33-1.5-2.33S8.88,9.51,8.88,10.66V15H6ZM1,6H4v9H1ZM4,3.5A1.5,1.5,0,1,1,2.5,2,1.5,1.5,0,0,1,4,3.5Z"
                                transform="translate(-1 -2)" /></svg>
                    </a>
                    <a class="youtube" href="https://www.youtube.com/channel/UCK1bOJqu7KWdgDn_7UNMAgA" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" height="682pt" viewBox="-21 -117 682.66672 682">
                            <path
                                d="m626.8125 64.035156c-7.375-27.417968-28.992188-49.03125-56.40625-56.414062-50.082031-13.703125-250.414062-13.703125-250.414062-13.703125s-200.324219 0-250.40625 13.183593c-26.886719 7.375-49.03125 29.519532-56.40625 56.933594-13.179688 50.078125-13.179688 153.933594-13.179688 153.933594s0 104.378906 13.179688 153.933594c7.382812 27.414062 28.992187 49.027344 56.410156 56.410156 50.605468 13.707031 250.410156 13.707031 250.410156 13.707031s200.324219 0 250.40625-13.183593c27.417969-7.378907 49.03125-28.992188 56.414062-56.40625 13.175782-50.082032 13.175782-153.933594 13.175782-153.933594s.527344-104.382813-13.183594-154.460938zm-370.601562 249.878906v-191.890624l166.585937 95.945312zm0 0" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="col-md-7">
                <div class="form_panel">



                    <form method="post" class="generalForm" action="{{ route('contact_store') }}"
                        id="contactForm1" name="contactForm" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form_column">
                            <h4 class="mb-3">{{__('Contact Us')}}</h4>
                            <p>{{__('Got any questions? Would you like to have further information about National Ambulance? We are happy to help you.')}}</p> 
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <input type="hidden" name="enquiry_type" id="enquiry_type_val" value="{{old('enquiry_type')}}"/>
                                    <select id="inputCountry" name="enquiry_type" class="form-control" value="{{old('enquiry_type')}}" required>
                                        <option value="" selected="true" disabled="true">{{__('Type of Enquiry')}} *</option>
                                        <option value="General Enquiry" @if(old('enquiry_type')=='General Enquiry') selected @endif>{{__('General Enquiry')}}</option>
                                        <option value="Procurement and Supply Chain" @if(old('Procurement and Supply Chain')=='General Enquiry') selected @endif>{{__('Supply Chain and Procurement')}}
                                        </option>
                                        <option value="Education and Training" @if(old('enquiry_type')=='Education and Training') selected @endif>{{__('Clinical Education and Training')}}</option>
                                        <option value="Event Emergency Medical Coverage" @if(old('enquiry_type')=="Event Emergency Medical Coverage") selected @endif>{{__('Event Emergency Medical Coverage')}}</option>
                                        <option value="Non-Emergency Patient Transport" @if(old('enquiry_type')=='Non-Emergency Patient Transpor') selected @endif>{{__('Non-Emergency Patient Transport')}}
                                        </option>
                                        <option value="Emergency Medical Services" @if(old('enquiry_type')=='Emergency Medical Services') selected @endif>{{__('Emergency Medical Services')}}</option>
                                        <option value="Media" @if(old('enquiry_type')=='Media') selected @endif>{{__('Media')}}</option>
                                        <option value="Website Issues" @if(old('enquiry_type')=='Website Issues') selected @endif>{{__('Website Issues and Feedback')}}</option>
                                    </select>
                                    @error('enquiry_type')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <select id="title" name="title" class="form-control" required>
                                        <option value="">{{__('Title')}} *</option>
                                        <option value="Mr" @if(old('title')=='Mr') selected @endif>{{__('Mr')}}</option>
                                        <option value="Mrs" @if(old('title')=='Mrs') selected @endif>{{__('Mrs')}}</option>
                                        <option value="Miss" @if(old('title')=='Miss') selected @endif>{{__('Miss')}}</option>
                                        <option value="Ms" @if(old('title')=='Ms') selected @endif>{{__('Ms')}}</option>
                                    </select>
                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="text" class="form-control" name="name" placeholder="{{__('Full Name')}} *" value="{{old('name')}}" required>
                                    @error('name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <input type="text" name="mobile" class="form-control" value="{{old('mobile')}}"   placeholder="{{__('Contact Number')}} *" required>
                                    @error('mobile')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div id="emailDiv" class="form-group col-md-6">
                                    <input type="email" name="email" class="form-control" placeholder="{{__('Email')}} *"  value="{{old('email')}}"  required>
                                    @error('email')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                </div>
                                <div id="company_name" class="form-group col-md-6">
                                    <input type="text" name="organisation" id="organisation" class="form-control"
                                        placeholder="{{__('Company Name')}} *"  value="{{old('organisation')}}" >
                                        @error('organisation')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                <input type="text" name="country" class="form-control" placeholder="{{__('Country')}} *"  value="{{old('country')}}"  required>
                                @error('country')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror

                                    <!-- <select id="country" name="country" class="form-control" required>
                                        <option value="">{{__('Country')}} *</option>
                                        @foreach($countries as $key=>$country)
                                            <option value="{{ $country }}">{{ $country }}</option>
                                        @endforeach
                                    </select> -->
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" name="city" class="form-control" placeholder="{{__('City')}}"   value="{{old('city')}}">
                                    @error('city')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <textarea name="description" class="form-control" rows="5"
                                        placeholder="{{__('Message')}} *" required>{{old('description')}}</textarea>
                                        @error('description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                            <div class="row">
                                @if(config('services.recaptcha.key'))
                                    <div class="g-recaptcha mt-2"
                                        data-sitekey="{{ config('services.recaptcha.key') }}">
                                    </div>
                                    
                                @endif
                                <label id="g-recaptcha-response-msg"  style="color: red;font-weight: 400;"></label>
                                @error('g-recaptcha-response')
                                                    <p  class="text-danger">{{ $message }}</p>
                                                    @enderror
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 mt-3 mb-1">
                                    <div class="form-check form-check-flat">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="agreement" class="form-check-input" required  @error('agreement') autofocus @enderror>{{__('I hereby certify that all information provided in this form is correct and I agree to the')}} <a href="/page/terms-and-conditions"  target="_blank" > {{__('Terms and Conditions')}}</a>* <i class="input-helper"></i>
                                            @error('agreement')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form_column">
                            <div class="row">
                                <div class="btn_column form-group col-md-12">
                                    <button type="submit" class="default_btn" name="submit">{{__('Submit')}}</button>
                                </div>
                            </div>
                        </div>
                        <!-- <div id="response_div" class="row">
                            @if(session('success'))
                                <p class="text-danger">
                                    {{ session('success') }}<br />
                                    {{ session('msg') }}<br />
                                    {{ session('mail') }}
                                </p>
                            @endif
                            @if(session('error'))
                                <p class="text-danger">
                                    {{ session('error') }}
                                </p>
                            @endif
                            @if(session('message'))
                                <p class="text-info">
                                    {{ session('error') }}
                                </p>
                            @endif
                        </div> -->
                    </form>



                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<section class="FeedbackContent">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="FeedbackBox">
                    <i class="FdIcon"><img
                            src="{{ asset('public/website/images/feedback.svg') }}" /></i>
                    <h5>{{__('Feedback')}}</h5>
                    <p>{{__('We value feedback whether positive or negative and use it to improve our services. Please visit our')}}
                        <strong>{{__('Feedback and Complaints page')}}</strong>
                        {{__('to send us your comments or share your experience with us.')}}
                    </p>
                    <a class="FeedbackLink" href="/feedback">{{__('Go to Feedback and Complaints')}}</a>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="FeedbackBox">
                    <i class="FdIcon"><img
                            src="{{ asset('public/website/images/career.svg') }}" /></i>
                    <h5>{{__('Career Opportunities')}}</h5>
                    <p>{{__('For employment related enquiries or to view current vacancies and apply, please visit our')}}
                        <strong>{{__('Careers Portal')}}</strong>.</p>
                    <a class="FeedbackLink" href="/career-portal">{{__('Go to Careers Portal')}}</a>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="FeedbackBox">
                    <i class="FdIcon" style="padding:14px;"><img
                            src="{{ asset('public/website/images/supplier.svg') }}" /></i>
                    <h5>{{__('Suppliers')}}</h5>
                    <p>{{__('To register your company’s interest as a supplier for National Ambulance UAE, please visit the')}}
                        <strong>{{__('Supplier Registration Form')}}</strong> {{__('and follow the application process.')}}</p>
                    <a class="FeedbackLink" href="/page/supply-chain">{{__('Go to Supply Chain')}}</a>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="FeedbackBox">
                    <i class="FdIcon" style="padding:14px;"><img
                            src="{{ asset('public/website/images/education-icon.svg') }}" /></i>
                    <h5>{{__('Education and Training')}}</h5>
                    <p>{{__('To enquire or learn about our clinical education and training services and what National Ambulance can offer, please visit the')}}
                    <strong> {{__('Clinical Education and Training page.')}}</strong></p>
                    <a class="FeedbackLink" href="/page/clinical-education-and-training">{{__('Go to Clinical Education and Training')}}</a>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="FeedbackBox">
                    <i class="FdIcon"><img
                            src="{{ asset('public/website/images/coverage.svg') }}" /></i>
                    <h5>{{__('Event Emergency Medical Coverage')}}</h5>
                    <p>{{__('If you are holding an event and need National Ambulance’s assistance, please visit the')}}
                        <strong>{{__('Event Emergency Medical Coverage')}}</strong> {{__('section to request this service.')}}</p>
                    <a class="FeedbackLink" href="/page/event-emergency-medical-coverage">{{__('Request Event Emergency Medical Standby')}}</a>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="FeedbackBox">
                    <i class="FdIcon"><img
                            src="{{ asset('public/website/images/ambulance-white.svg') }}" /></i>
                    <h5>{{__('Non-Emergency Patient Transport')}}</h5>
                    <p>{{__('Do you require a professional non-urgent medical transport to, from or between hospitals? Please visit the')}}
                    <strong>{{__('Non-Emergency Patient Transport Form')}}</strong> {{__('and follow the process to request this service.')}}
                    </p>
                    <a class="FeedbackLink" href="/page/non-emergency-patient-transport-service-pts-">{{__('Non-Emergency Patient Transport')}}</a>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="FeedbackBox">
                    <i class="FdIcon"><img style="max-height:36px;"
                            src="{{ asset('public/website/images/patient-record.svg') }}" /></i>
                    <h5>{{__('Patient Care Record')}}</h5>
                    <p>{{__('To request a copy of a patient care record, please visit the')}}
                        <strong>{{__('Request Patient Care Record Form')}}</strong>
                        {{__('and follow the process to complete your request.')}}
                    </p>
                    <a class="FeedbackLink" href="{{ route('feedback') }}?type=Request%20Patient%20Care%20Record%20(PCR)#feedbackFormLink">{{__('Go to Patient Care Record')}}</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--footer-->
@endsection
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
<script type="text/javascript">
window.onload = function() {
    var $recaptcha = document.querySelector('#g-recaptcha-response');

    if($recaptcha) {
        $recaptcha.setAttribute("required", "required");
       

    }
};
    function btnRefresh() {
        $.ajax({
            type: 'GET',
            url: public_url + '/refresh_captcha',
            success: function (data) {

                $(".captcha span").html(data.captcha);

            }

        });

    }

    $(function () {
       

        $('#sub-btn').click(function () {
            console.log($('#feedback_type  :selected').attr('value'));
        });
        $("#inputCountry").change(function () {
            let val = $(this).val();
            $('#enquiry_type_val').val(val);
            if (val === 'General Enquiry' || val === 'Website Issues') {
                $('#company_name').hide();
                $('#company_name input').removeAttr('required');
                $('#emailDiv').removeClass()
                $('#emailDiv').addClass('form-group col-md-12')
            } else {
                $('#emailDiv').removeClass()
                $('#emailDiv').addClass('form-group col-md-6')
                $('#company_name').show();
                $('#company_name input').attr('required','true');
            }
        });

        const queryString = window.location.search;
        // console.log(queryString);
        const urlParams = new URLSearchParams(queryString);
        const type = urlParams.get('type')
        // console.log(type);
        if (type) {
            console.log(type);
            $('#inputCountry').attr('disabled', "true");
            $('#inputCountry').val(type).change();
            $('#enquiry_type_val').val(type);
        }
    });
    
    $(function () {
    
        $("form").validate();
       
        $('form').submit(function(e){
            $("#g-recaptcha-response-msg").text('');

           var index=1;
           var isError = false;
            $(this).find('input[required], select[required], textarea[required]').each(function(){
              
                if (!$(this).valid()){
                    if(index==1){
                        index++;
                        $(this).focus();
                    }
                    $(this).css("border-color", "red");
                    if($(this).attr('name')=='g-recaptcha-response'){
                        $("#g-recaptcha-response-msg").text('This field is required.');
                    }
                    isError= true;
                }else{
                    $(this).css("border-color", "green");
                }
            });
            if(isError){
                e.preventDefault();
                $("label[for='g-recaptcha-response']").show();

            }else{
                $('#loader').show();
            }
                     
        });
    
        @if(old('enquiry_type'))

$('#inputCountry').val("{{old('enquiry_type')}}").change();
@endif
      
});


</script>

@section('script')

@endsection
<!--/ footer-->