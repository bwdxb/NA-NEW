@php
use app\Http\helper\Helper as Helper;
$mainMenuTitle = Helper::mainMenuTitleById($page->parent_id);
$leftSubMenu = Helper::geSubMenu($page->parent_id);
@endphp
@extends('layouts.index')

@section('meta_tags')
        {!! Meta::toHtml() !!} 
        <meta property="og:title" content="Feedback and Complaints" />
        <!-- <meta property="og:description" content="Feedback and Complaints" /> -->
@endsection

@section('content')
<section class="pageBanner"
style="background-image: url({{ isset($data->banner)? asset('public/uploads/feedback/'.$data->banner) :asset('public/website/images/about-us-banner.jpg') }})">
<div class="pageHeading">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{__('Feedback and Complaints')}}</h1>
                <span class="subTitle">{{__('National Ambulance')}}</span>
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
                    <li class="breadcrumb-item">
                        <a href="#">
                            @if(app()->getLocale() == 'en')
                            {{ $mainMenuTitle->title }}
                            @else
                            {{ $mainMenuTitle->title_ar }}
                            @endif
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        @if(app()->getLocale() == 'en')
                        {{ $data->title }}
                        @else
                        {{ $data->title_ar }}
                        @endif
                    </li>
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
                <h2 class="wrapTitle">
                    @if(app()->getLocale() == 'en')
                    {{ $data->title }}
                    @else
                    {{ $data->title_ar }}
                    @endif
                </h2>
            </div>
            <!-- <div class="col-md-4 col-xl-3">
                @include('website.includes.side_bar')
                
            </div> -->
            <div class="col-md-12 col-xl-12">
                <div class="contentWrap mt-4">
                    @if(app()->getLocale() == 'en')
                    {!!$data->intro!!}
                    @else
                    {!!$data->intro_ar!!}
                    @endif
                    <br />
                    <div class="feedbackForm" id="feedbackForm">
                        <div class="form_panel">
                            <form method="post" class="eventCoverageForm"
                            action="{{ route('post-feedback') }}" name="EventCoverageForm" enctype='multipart/form-data'>
                            {{ csrf_field() }}
                            <div class="form_column">
                                <h4 class="mb-3 fst-italic navyColor">{{__('Send us your feedback')}}</h4>

                                <ul id="response_div" class="row text-danger">
                                    @foreach ($errors->all() as $key=>$error)
                                    <li>{{$key+1}},  {{ $error }}</li>
                                    @endforeach
                                </ul>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>{{__('Type of Feedback')}}*</label>
                                        <input type="hidden" name="type" id="enquiry_type_val" value="{{old('type')}}"/>
                                        
                                        <select id="feedback_type" name="type" class="form-control" required="true"   @error('type') autofocus @enderror>
                                            <option value="" selected>{{__('Select')}}
                                                </option>
                                                <option  value="Complaint" id="option-complaint"
                                                {{ old('type')==='Complaint'?"selected":"" }}>
                                                {{__('Complaint')}}</option>
                                                <option value="Compliment" id="option-compliment"
                                                {{ old('type')==='Compliment'?"selected":"" }}>
                                                {{__('Compliment')}}</option>
                                                <option value="Suggestion" id="option-suggestion"
                                                {{ old('type')==='Suggestion'?"selected":"" }}>
                                                {{__('Suggestion')}}</option>
                                                <option value="Request Patient Care Record (PCR)" id="option-pcr"
                                                {{ old('type')==='Request Patient Care Record (PCR)'?"selected":"" }}>{{__('Request Patient Care Record (PCR)')}}</option>
                                                <option value="Other" id="option-other"
                                                {{ old('type')==='Other'?"selected":"" }}>
                                                {{__('Other')}}</option>
                                            </select>
                                            @error('type')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                            
                                        </p>
                                    </div>
                                    <p id="pcr-text-info" style="display:none;"><i class="fa fa-info-circle"></i> {{__('You may request a copy of National Ambulance Patient Care Record only if you are the patient, guardian or legally authorised representative')}}
                                </div>
                                    <div class="row">
                    <div class="form-group col-md-6">
                        <label>{{__('Title')}}*</label>
                        <select id="title" name="title" class="form-control" required="true"   @error('title') autofocus @enderror>
                            <option value=""><!-- {{__('Select')}} --></option>
                             
                            <option value="Mr"
                            {{ old('title')==='Mr'?"selected":"" }}>
                            {{__('Mr')}}</option>
                            <option value="Mrs"
                            {{ old('title')==='Mrs'?"selected":"" }}>
                            {{__('Mrs')}}</option>
                            <option value="Miss"
                            {{ old('title')==='Miss'?"selected":"" }}>
                            {{__('Miss')}}</option>  
                            <option value="Ms"
                            {{ old('title')==='Ms'?"selected":"" }}>
                            Ms</option>             
                        </select>
                        @error('title')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
    <div class="form-group col-md-6">
        <label>{{__('Full Name')}} *</label>
        <input type="text" name="name" 
        class="form-control" title="no numeric values accepted for Name"
        placeholder="" required="true"
        value="{{ old('name') }}"   @error('name') autofocus @enderror>
        @error('name')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
</div>

    <div class="row">
        <div id="nationality_div" class="form-group col-md-12">
            <label>{{__('Nationality')}} *</label>
            <input type="text" 
            title="no numeric values accepted for Nationality" name="nationality"
            class="form-control" placeholder=""
            value="{{ old('nationality') }}"   @error('nationality') autofocus @enderror>
            @error('nationality')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label>{{__('Email')}} *</label>
            <input type="email" name="email" class="form-control" placeholder=""
            required="true" value="{{ old('email') }}"   @error('email') autofocus @enderror>
            @error('email')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label>{{__('Mobile Number')}} *</label>
            <input type="text" name="contact"
       
            class="form-control" title="Please provide valid U.A.E phone number" placeholder=""
            required="true" value="{{ old('contact') }}"   @error('contact') autofocus @enderror>
            @error('contact')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="row" id="ref-no-incident-dt">
        <div class="form-group col-md-6">
            <label>{{__('Reference [CAD] Number (If available)')}} </label>
            <input type="text" name="cad" class="form-control" placeholder=""
            value="{{ old('cad') }}"   @error('cad') autofocus @enderror>
            @error('cad')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label>{{__('Incident Date')}}</label>
            <input type="text" name="incident_date" 
            {{--max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"--}}
            class="form-control" placeholder=""
            value="{{ old('incident_date') }}"  @error('incident_date') autofocus @enderror>
            <!-- <i class="far fa-calendar-alt"></i> -->
            @error('incident_date')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    
<div class="row">
    <div id="area_location_div" class="form-group col-md-6">
        <label>{{__('City')}}*</label>
        <input type="text" name="area_location" id="area_location" class="form-control" placeholder="{{__('In which City did the incident take place?')}}"
        value="{{ old('city') }}"  @error('area_location') autofocus @enderror>
        @error('area_location')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label id="emirate_select">{{__('Emirate')}}*</label>
        <select name="emirates" class="form-control" id="select-emirate"   @error('emirates') autofocus @enderror>
            <option value="" id="emirate_select_value">{{__('In which Emirate did the incident take place?')}}</option>
            <option value="Sharjah"
            {{ old('emirates')==='Sharjah'?"selected":"" }}>
            {{__('Sharjah')}}</option>
            <option value="Ajman"
            {{ old('emirates')==='Ajman'?"selected":"" }}>
            {{__('Ajman')}}</option>
            <option value="Umm Al Quwain"
            {{ old('emirates')==='Umm Al Quwain'?"selected":"" }}>
            {{__('Umm Al Quwain')}}</option>
            <option value="Ras Al Khaima"
            {{ old('emirates')==='Ras Al Khaima'?"selected":"" }}>
            {{__('Ras Al Khaimah')}}</option>
            <option value="Fujairah"
            {{ old('emirates')==='Fujairah'?"selected":"" }}>
            {{__('Fujairah')}}</option>
            <option value="Abu Dhabi"
            {{ old('emirates')==='Dhabi'?"selected":"" }}>
            {{__('Abu Dhabi')}}</option>
            <option value="Dubai"
            {{ old('emirates')==='Dubai'?"selected":"" }}>
            {{__('Dubai')}}</option>
        </select>
        @error('emirates')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
</div>
<div class="row">
    <div id="emirates_file_div" style="display:none;" class="form-group col-md-12 mb-1">
        <label>{{__('Please provide a copy of your emirates ID (front and back) or passport')}} *</label>
        <div class="customFile">
        <input id="passport_files" type="file" multiple title="Please provide a copy of your emirates ID (front and back) or passport" name="emirate_or_passport_files[]"
            class="form-control file-input file-size-limit" placeholder="" onchange="passportFiles()">
            <span id="output"></span>
            <span class="file_label">{{__('Upload File')}}</span>
        </div>
        <div id="psportfilesList"></div>            
            @error('emirate_or_passport_files')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        
        <small class="ps-3 mb-2">{{__('You can upload multiple files. If you choose to, please select and upload them in one go.')}}</small>
    </div>
<div class="row">
    <div class="form-group col-md-12">
        <label id="feedback_message">{{__('Complaint(s)')}}*</label>
        <textarea name="feedback_message" class="form-control" rows="5"
        placeholder=""
        required="true">{{ old('feedback_message') }}</textarea>
        @error('feedback_message')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div id="complaint_soltn_div" class="form-group col-md-12">
        <label>{{__('Suggested Solution(s)')}}</label>
        <textarea name="solution" class="form-control" rows="5"
        placeholder="">{{ old('solution') }}</textarea>
        @error('solution')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="row">
    @if(config('services.recaptcha.key'))
        <div class="g-recaptcha"
            data-sitekey="{{ config('services.recaptcha.key') }}">
        </div>
    @endif
    <span id="g-recaptcha-response-msg"  style="color: red;font-weight: 400;margin-bottom:1.5rem;"></span>

    @error('g-recaptcha-response')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
<div class="form-group col-md-12">
    <div class="form-check form-check-flat">
        <label class="form-check-label">
            <input   @error('agreement') autofocus @enderror type="checkbox" name="agreement" class="form-check-input" required>{{__('I hereby certify that all information provided in this form is correct and I agree to the')}} <a href="/page/terms-and-conditions"  target="_blank" > {{__('Terms and Conditions')}}</a>*<i class="input-helper"></i>
        </label>
        @error('agreement')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
</div>
</div>
<div class="form_column">
    <div class="row">
        <div class="btn_column form-group col-md-12">
            <button type="submit" class="default_btn" id="sub-btn">{{__('Submit')}}</button>
        </div>
    </div>
    
</div>


</form>
</div>
</div><br />
@if(app()->getLocale() == 'en')
{!!$data->concl!!}
@else
{!!$data->concl_ar!!}
@endif
</div>
</div>
</div>
</div>
</section>


<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    // var maxDate =
    window.onload = function() {
    var $recaptcha = document.querySelector('#g-recaptcha-response');

    if($recaptcha) {
        $recaptcha.setAttribute("required", "required");
    }
};
    $().ready(function(){
       $("#select-emirate").on('change',function(){
        var selectedValue= $(this).val();
        var conditionArray= ['Complaint','Request Patient Care Record (PCR)','Compliment'];
        var checkIn = $('#feedback_type').val();
        // console.log(selectedValue);
        // console.log(checkIn);
        if(selectedValue=="Dubai" && conditionArray.includes(checkIn) ){
            // $(this).val(''); 
            // swal('{{__("National Ambulance services are not available in this area")}}');

        }
       });
    })
    $().ready(function(){
        $('#feedback_message').html("{{__('Message')}}*");
        $('#emirate_select_value').html("{{__('Select')}}");
        $('#ref-no-incident-dt').hide();
        $('#emirate_select').html("{{__('Emirate of Residence')}}");
        $('#nationality_div').hide();
        $('#area_location_div').hide();
        $('#area_location').removeAttr('required');
        $('#complaint_soltn_div').hide();
        
    })

    $(function () {
        
        
     
        $('#sub-btn').click(function () {
            console.log($('#feedback_type  :selected').attr('value'));
        });
        
       
        $("#feedback_type").on('change',function () {
            console.log('change event works ???');
            $('#pcr-text-info').hide();
            let val = $(this).val();
            
            // if (val === 'suggestion' || val === 'others') {
                //     $('#company_name').hide();
                //     $('#emailDiv').removeClass()
                //     $('#emailDiv').addClass('form-group col-md-12')
                // }
                $('#complaint_soltn_div').hide();
                // $('#complaint_soltn_div input').removeAttr('required');
                $('#emirates_file_div').hide();
                // $('#emirates_file_div input').removeAttr('required');
                
                $('#emirate_select').html("{{__('Emirate')}}");
                $('#emirate_select_value').html("{{__('In which Emirate did the incident take place?')}}");
                if (val === 'Suggestion' || val === 'Other') {
                    $('#feedback_message').html("{{__('Message')}}*");
                    $('#emirate_select_value').html("{{__('Select')}}");
                    if (val === 'Suggestion') {
                        $('#feedback_message').html("{{__('Suggestion(s)')}}*");
                    }
                    // $('#complaint_soltn_div').show();
                    $('#ref-no-incident-dt').hide();
                    // $('#ref-no-incident-dt input').removeAttr('required');
                    $('#emirate_select').html("{{__('Emirate of Residence')}}");
                    
                } else if (val === 'Compliment') {
                    $('#feedback_message').html("{{__('Compliment')}}*");
                    $('#ref-no-incident-dt').show();
                } else if (val === 'Complaint') {
                    $('#feedback_message').html("{{__('Complaint(s)')}}*");
                    $('#complaint_soltn_div').show();
                    // $('#complaint_soltn_div input').attr('required','true');
                    $('#ref-no-incident-dt').show();
                    
                    // $('#ref-no-incident-dt input').attr('required','true');
                }else if(val === 'Request Patient Care Record (PCR)'){
                    $('#feedback_message').html("{{__('Message')}}*");
                    $('#complaint_soltn_div').hide();
                    // $('#complaint_soltn_div input').attr('required','true');
                    
                    $('#ref-no-incident-dt').show();
                    // $('#ref-no-incident-dt input').attr('required','true');
                    
                    $('#emirates_file_div').show();
                    $('#emirates_file_div input').attr('required','true');

                    $('#pcr-text-info').show();
                }
                
                if (val === 'Complaint' || val === 'Compliment'||val === 'Request Patient Care Record (PCR)') {
                    $('#nationality_div').show();
                    
                    $('#area_location_div').show();
                    $('#area_location').attr('required','true');
                } else {
                    $('#nationality_div').hide();
                $('#area_location_div').hide();
                $('#area_location').removeAttr('required');
            }



            //for condition related to emirate dubai for complaint , compliment and pcr reqests type
            var selectedValue= $("#select-emirate").val();
        var conditionArray= ['Complaint','Request Patient Care Record (PCR)','Compliment'];
        var checkIn = $(this).val();
      
        if(selectedValue=="Dubai" && conditionArray.includes(checkIn) ){
            // $("#select-emirate").val(''); 
            // swal('{{__("National Ambulance services are not available in this area")}}');

        }
        });

        const queryString = window.location.search;
        // console.log(queryString);
        const urlParams = new URLSearchParams(queryString);
        const type = urlParams.get('type')
        // console.log(type);
        if (type) {
            console.log(type);
            $('#feedback_type').attr('disabled', "true");
            $('#feedback_type').val(type).change();
            // $('#feedback_type').trigger("change");
            $('#enquiry_type_val').val(type);
            // $('#pcr-text-info').show();
            
            // $('#feedback_message').html("{{__('Message')}}*");
            // $('#complaint_soltn_div').hide();
            // // $('#complaint_soltn_div input').attr('required','true');
            
            // $('#ref-no-incident-dt').show();
            // // $('#ref-no-incident-dt input').attr('required','true');
            
            // $('#emirates_file_div').show();
            // $('#emirates_file_div input').attr('required','true');
            
            // $('#nationality_div').show();
            
            // $('#area_location_div').show();
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
                        //    if($(this).attr('name')=='g-recaptcha-response'){
                        //         $("#g-recaptcha-response-msg").text('This field is required.');
                        //     }
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
        @if(old('type'))
            $('#feedback_type').val("{{old('type')}}").change();
        @endif
    });
    
</script>
@endsection
@section('script')

@endsection
<!--/ footer-->