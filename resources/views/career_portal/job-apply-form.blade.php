@php
    use app\Http\helper\Helper as Helper;
    $countries = Helper::getAllCountries();
@endphp

@extends('layouts.career-portal.app')

@section('meta_tags')
{!! Meta::toHtml() !!}
    
<meta name="image" property="og:image" content="{{url('/public/Image/200x200.jpg')}}">
<meta property="og:title" content="Check out this job at National Ambulance UAE: ({{$data->job_title}}.)" />
<meta property="og:url" content="{{url()->current()}}" />
<link rel="stylesheet" href="{{asset('public/career_portal/css/selectize.bootstrap.min.css')}}">
<!-- <meta property="og:description" content="" /> -->
@endsection

@section('content')
<section class="page_banner applyJob">
    <div class="apply_job_caption">
        <div class="container">
            <div class="row">
                <!--<div class="col-md-12">
                    
                    
                </div>-->
            </div>
        </div>
    </div>
</section>
<section class="form_section">
    <form method="post" action="{{ route('career-portal.user.vacancy.create') }}" enctype="multipart/form-data" id="job-apply-form">
        {{csrf_field()}}
        <div class="container">
            <input type="hidden" name="id" value="{{$data->id}}">
            <div class="row">
                <div class="col-md-12 job_ap_wrapper">
                    <!--<h5 class="jobID">{{$data->job_id}}</h5>-->
                    <div class="form_panel">
                        <h1>{{$data->job_title}}</h1>
                        <p>{{__('Thank you for your interest in National Ambulance. Applying for this position does not guarantee a job offer. We reserve the right to refrain from
                        responding, but may consider contacting you should you qualify for the position or an
                        opportunity that matches your profile/ qualifications arises. As part of this application
                        process, we will collect and use your personal information. For details on how we use personal
                    information, please see our  Privacy Policy.')}}</p>
                    <h5>{{$data->job_id}}</h5>
                        <div class="customTabs">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <p><strong>Opps Something went wrong</strong></p>
                                    <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(session('job_apply_success'))
                                            <!-- <div class="alert alert-success">
                                        {{ session('success') }}<br/>
                                        {{ session('msg') }}<br/>
                                        {{ session('mail') }}
                                    </div> -->
                                    <p class="text-success">
                                        {{ session('job_apply_success') }}<br />
                                        <!-- {{ session('msg') }}<br/> -->
                                        <!-- {{ session('mail') }} -->
                                    </p>
                                    @endif
                                    @if(session('job_apply_error'))
                                            <!-- <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div> -->
                                    <p class="text-danger">
                                        {{ session('job_apply_error') }}
                                    </p>
                                    @endif
                                    <ul class="nav nav-tabs step_list" id="nav-tab" role="tablist">
                                        <li><a class="nav-link active" href="#tab_1" data-bs-toggle="tab" data-bs-target="#tab_1"
                                         role="tab" aria-controls="tab_1" aria-selected="true">{{__('Personal Information')}}</a></li>
                                         <li><a class="nav-link" href="#tab_2" data-bs-toggle="tab" data-bs-target="#tab_2"
                                             role="tab" aria-controls="tab_2" aria-selected="false">{{__('CV Upload')}}</a></li>
                                             <li><a class="nav-link" href="#tab_3" data-bs-toggle="tab" data-bs-target="#tab_3"
                                                 role="tab" aria-controls="tab_3" aria-selected="false">{{__('Qualifications ')}}</a></li>
                                                 <li><a class="nav-link" href="#tab_4" data-bs-toggle="tab" data-bs-target="#tab_4"
                                                     role="tab" aria-controls="tab_4" aria-selected="false">{{__('Employment Details')}}</a></li>
                                                     <li><a class="nav-link" href="#tab_5" data-bs-toggle="tab" data-bs-target="#tab_5"
                                                         role="tab" aria-controls="tab_5" aria-selected="false">{{__('Declaration')}}</a></li> 
                                                     </ul>
                                                     
                                                     <div class="tab-content" id="nav-tabContent">
                                                        <div class="inner_tab tab-pane show active" id="tab_1" role="tabpanel"
                                                              aria-labelledby="tab_1">
                                                                <div  class="PersonalForm" name="job_application_form">
                                                                    <div class="form_column">
                                                                        <h5 class="mb-4">{{__('Personal Information')}}</h5>
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <select id="title" name="title" class="form-control" required>
                                                                                    <option selected disabled="true"
                                                                                    value="">{{__('Title')}}*</option>
                                                                                    <option value="Mr" {{old('title')=='Mr'?'selected':''}}>{{__('Mr')}}</option>
                                                                                    <option value="Mrs"  {{old('title')=='Mrs'?'selected':''}}>{{__('Mrs')}}</option>
                                                                                    <option value="Miss"  {{old('title')=='Miss'?'selected':''}}>{{__('Miss')}}</option>
                                                                                    <option value="Ms"  {{old('title')=='Ms'?'selected':''}}>{{__('Ms')}}</option>
                                                                                </select>
                                                                                @error('title')
                                                                                <p class="text-danger">{{ $message }}</p>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <input class="form-control" name="name" placeholder="Full Name *" type="text"
                                                                                required value="{{old('name')}}" />
                                                                                @error('name')
                                                                                <p class="text-danger">{{ $message }}</p>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <select class="form-control" name="gender" required>
                                                                                    <option value="" selected>{{__('Gender')}} *</option>
                                                                                    <option {{old('gender')=='Male'?'selected':''}}>{{__('Male')}}</option>
                                                                                    <option  {{old('gender')=='Female'?'selected':''}}>{{__('Female')}}</option>
                                                                                </select>
                                                                                @error('gender')
                                                                                <p class="text-danger">{{ $message }}</p>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="custom_datepicker form-group col-md-6">
                                                                            
                                                                            <input id="Patient_dob" type="text" name="date_of_birth"
                                                                           {{-- max="{{ \Carbon\Carbon::now()->subYear(18)->format('Y-m-d') }}"--}}
                                                                            class="form-control"
                                                                            placeholder="{{__('Date of Birth')}} *"
                                                                            value="{{old('date_of_birth')}}"
                                                                            {{--title="Should be atleast 18yrs old" --}}                                                                         onfocus="(this.type='text')"
                                                                            onblur="(this.type='text')" required>
                                                                            <i class="far fa-calendar-alt"></i>
                                                                            @error('date_of_birth')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group col-md-12">
                                                                        <input type="hidden" id="nationality-value" name="nationality">
                                                                            <select  class="form-control ar-pos serachSelect" name="nationality" id="nationality-select" required>
                                                                                <option selected value="">{{__('Nationality')}}*</option>
                                                                                @foreach($countries as $key=>$country)
                                                                                    <option value="{{ $country }}"  {{old('nationality')==$country?'selected':''}}>{{ $country }}</option>
                                                                                @endforeach
                                                                                <!-- <option value="uae">{{__('UAE')}}</option>
                                                                                <option value="other">{{__('Other')}}</option> -->
                                                                            </select>
                                                                            @error('nationality')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div id="uae-national">
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <input class="form-control" name="passport_no" placeholder="Passport Number*" type="text" required value="{{old('passport_no')}}" />
                                                                                @error('passport_no')
                                                                                <p class="text-danger">{{ $message }}</p>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <input class="form-control" name="unified_no" placeholder="Unified Number (UID)*" type="text" required value="{{old('unified_no')}}" />
                                                                                @error('unified_no')
                                                                                <p class="text-danger">{{ $message }}</p>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <input class="form-control" name="family_book_no" placeholder="Family Book Number*" type="text" required value="{{old('family_book_no')}}" />
                                                                                @error('family_book_no')
                                                                                <p class="text-danger">{{ $message }}</p>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <input class="form-control" name="emirates_id_no" placeholder="Emirates ID Number*" type="text" pattern="^[0-9]{3}-[0-9]{4}-[0-9]{7}-[0-9]{1}$"
                                                    title="Required valid emirate id eg: 123-1234-1234567-1" value="{{old('emirates_id_no')}}" id="emirates_id_no" onkeyup="addHyphen(this)" />
                                                                                @error('emirates_id_no')
                                                                                <p class="text-danger">{{ $message }}</p>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="form-group col-md-12">
                                                                                <strong class="col-md-6 ">National Service*</strong>
                                                                                <div class="radio_row col-md-6 " id="national-service">
                                                                                    <label class="radio">
                                                                                        Yes
                                                                                        <input name="national_service" type="radio" value="1"   @if(old('national_service')=='1'||!(old('national_service'))) checked @endif>
                                                                                        <span class="checkround"></span>
                                                                                    </label>
                                                                                    <label class="radio">
                                                                                        No
                                                                                        <input name="national_service" type="radio" value="0"     @if(old('national_service')=='0') checked @endif>
                                                                                        <span class="checkround"></span>
                                                                                    </label>
                                                                                </div>
                                                                                @error('national_service')
                                                                                <p class="text-danger">{{ $message }}</p>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="row" id="national-service-waiver">
                                                                            <div class="form-group col-md-12">
                                                                                <div class="custom-file">
                                                                                    <label class="form-label" for="Waiver">
                                                                                If exempted from National Service, please provide a copy of waiver 
                                                                                    </label>
                                                                                    <input id="attach_waiver" class="form-control file-size-limit" name="attach_waiver" type="file"/>
                                                                                </div>
                                                                                @error('attach_waiver')
                                                                                <p class="text-danger">{{ $message }}</p>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <select class="form-control" name="marital_status" >
                                                                                    <option value="" selected>{{__('Marital Status')}}*</option>
                                                                                    <option {{old('marital_status')=='Single'?'selected':''}}>Single</option>
                                                                                    <option  {{old('marital_status')=='Married'?'selected':''}}>Married</option>
                                                                                    <option  {{old('marital_status')=='Widowed'?'selected':''}}>Widowed</option>
                                                                                    <option  {{old('marital_status')=='Divorced'?'selected':''}}>Divorced</option>
                                                                                </select>
                                                                                @error('marital_status')
                                                                                <p class="text-danger">{{ $message }}</p>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <input class="form-control" name="email" placeholder="Email Address*" type="email" required value="{{old('email')}}" />
                                                                                @error('email')
                                                                                <p class="text-danger">{{ $message }}</p>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <input class="form-control" name="mobile" placeholder="Mobile Number*" type="text" required value="{{old('mobile')}}" />
                                                                                @error('mobile')
                                                                                <p class="text-danger">{{ $message }}</p>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <input class="form-control" name="address" placeholder="Address*" type="text" required value="{{old('address')}}" />
                                                                                @error('address')
                                                                                <p class="text-danger">{{ $message }}</p>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <select class="form-control" name="emirates" >
                                                                                    <option selected="" disabled="true">Emirate*</option>
                                                                                    <option {{old('emirates')=='Sharjah'?'selected':''}}>Sharjah</option>
                                                                                    <option  {{old('emirates')=='Ajman'?'selected':''}}>Ajman</option>
                                                                                    <option  {{old('emirates')=='Umm Al Quwain'?'selected':''}}>Umm Al Quwain</option>
                                                                                    <option  {{old('emirates')=='Ras Al Khaimah'?'selected':''}}>Ras Al Khaimah</option>
                                                                                    <option  {{old('emirates')=='Fujairah'?'selected':''}}>Fujairah</option>
                                                                                    <option  {{old('emirates')=='Abu Dhabi'?'selected':''}}>Abu Dhabi</option>
                                                                                    <option  {{old('emirates')=='Dubai'?'selected':''}}>Dubai</option>
                                                                                </select>
                                                                                
                                                                                @error('emirates')
                                                                                <p class="text-danger">{{ $message }}</p>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <input class="form-control" name="languages_known" placeholder="Languages Known*" type="text" required value="{{old('languages_known')}}" />
                                                                                @error('languages_known')
                                                                                <p class="text-danger">{{ $message }}</p>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="form-group col-md-12">
                                                                                <input class="form-control" name="key_skills" placeholder="What are your key skills?*" type="text" required value="{{old('key_skills')}}" />
                                                                                @error('key_skills')
                                                                                <p class="text-danger">{{ $message }}</p>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="other-national">
                                                                        <div class="row">
                                                                            <!-- <h6 class="col-md-12">If Non-UAE National:</h6>
                                                                            <div class="form-group col-md-6">
                                                                                <input class="form-control" name="nationality_other" placeholder="Your Nationality*" type="text" required value="" />
                                                                                @error('nationality_other')
                                                                                <p class="text-danger">{{ $message }}</p>
                                                                                @enderror
                                                                            </div> -->
                                                                            
                                                                        </div>
                                                                        <div class="row">
                                                                        
                                                                            <div class="form-group col-md-6">
                                                                                <input class="form-control" name="non_uae_passport_no" placeholder="Passport Number*" type="text" required value="{{old('non_uae_passport_no')}}" />
                                                                                @error('non_uae_passport_no')
                                                                                <p class="text-danger">{{ $message }}</p>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <select class="form-control" name="non_uae_marital_status">
                                                                                    <option selected>{{__('Marital Status')}}*</option>
                                                                                    <option {{old('non_uae_marital_status')=='Single'?'selected':''}}>Single</option>
                                                                                    <option {{old('non_uae_marital_status')=='Married'?'selected':''}}>Married</option>
                                                                                    <option {{old('non_uae_marital_status')=='Widowed'?'selected':''}}>Widowed</option>
                                                                                    <option {{old('non_uae_marital_status')=='Divorced'?'selected':''}}>Divorced</option>
                                                                                </select>
                                                                                @error('non_uae_marital_status')
                                                                                <p class="text-danger">{{ $message }}</p>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <input class="form-control" name="non_uae_email" placeholder="Email Address*" type="email" required value="{{old('non_uae_email')}}"/>
                                                                                @error('non_uae_email')
                                                                                <p class="text-danger">{{ $message }}</p>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <input class="form-control" name="non_uae_mobile" placeholder="Mobile Number*" type="text" required value="{{old('non_uae_mobile')}}"/>
                                                                                @error('non_uae_mobile')
                                                                                <p class="text-danger">{{ $message }}</p>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="row">
                                                                            <!-- <strong class="col-md-12">Where are you currently located?*</strong> -->
                                                                            <div class="form-group col-md-6">
                                                                                <select id="current-location" name="country" class="form-control serachSelect">
                                                                                    <option value="" selected>Where are you currently located?*</option>
                                                                                    @foreach($countries as $key=>$country)
                                                                                        <option value="{{ $country }}"  {{old('country')==$country?'selected':''}}>{{ $country }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                                @error('country')
                                                                                <p class="text-danger">{{ $message }}</p>
                                                                                @enderror 
                                                                            </div>

                                                                            </div>

                                                                            <div class="row" id="current-location-uae">
                                                                            <!-- <h6 class="col-md-12">If located in the UAE</h6> -->
                                                                            <div class="form-group col-md-6">
                                                                                <input class="form-control" name="uae_type_of_visa" placeholder="Type of Visa* e.g. residency, visit, etc." type="text" required value="{{old('uae_type_of_visa')}}" />
                                                                                @error('uae_type_of_visa')
                                                                                <p class="text-danger">{{ $message }}</p>
                                                                                @enderror
                                                                            </div>
                                                                                <div class="form-group col-md-6">
                                                                                    <input class="form-control" name="uae_emirates_id_no" placeholder="Emirates ID Number (for UAE residents only)" pattern="^[0-9]{3}-[0-9]{4}-[0-9]{7}-[0-9]{1}$"
                                                    title="Required valid emirate id eg: 123-1234-1234567-1" type="text"  value="{{old('uae_emirates_id_no')}}" id="uae_emirates_id_no"  onkeyup="addHyphen(this)"/>
                                                                                   
                                                                                   @error('uae_emirates_id_no')
                                                                                    <p class="text-danger">{{ $message }}</p>
                                                                                    @enderror
                                                                                </div>
                                                                                </div>
                                                                                        <div class="row">
                                                                                        <div class="form-group col-md-6">
                                                                                            <input class="form-control" name="non_uae_languages_known" placeholder="Languages Known*" type="text" required value="{{old('non_uae_languages_known')}}" />
                                                                                            @error('non_uae_languages_known')
                                                                                            <p class="text-danger">{{ $message }}</p>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="form-group col-md-6">
                                                                                            <input class="form-control" name="non_uae_key_skills" placeholder="What are your key skills?*" type="text" required value="{{old('non_uae_key_skills')}}" />
                                                                                            @error('non_uae_key_skills')
                                                                                            <p class="text-danger">{{ $message }}</p>
                                                                                            @enderror
                                                                                        </div>
                                                                        </div>
                                                                </div>
                                    
                                                                </div>
                                                                <div class="form_column mt-3">
                                                                    <div class="row">
                                                                        <div class="btn_column form-group col-md-12">
                                                                            <button type="button" class="default_btn btn_next" id="btn_personal_info">{{__('Next')}}</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                     </div>
                        <div class="inner_tab tab-pane show" id="tab_2" role="tabpanel"
                        aria-labelledby="2">
                                <div  class="CvForm" name="job_application_form">
                                    <div class="form_column">
                                        <h5 class="mb-4">{{__('CV File Upload')}}</h5>                               
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <div class="custom-file">
                                                    <label class="form-label" for="formFileLg">
                                                        {{__('Select the CV file to upload')}}*
                                                    </label>                                            
                                                    <div class="customFile">
                                                        <input id="attach_CV" class="form-control file-input file-size-limit" name="attach_cv" type="file" required onchange="attachCV()"/>
                                                        <span id="attachcvLabel" class="file_label">Upload File</span>                                            
                                                    </div>
                                                </div>
                                                @error('attach_cv')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form_column mt-3">
                                        <div class="row">
                                            <div class="btn_column form-group col-md-12">
                                                <button type="button" class="default_btn grey_bgbtn" id="btn_cv_prev">Previous</button>
                                                <button type="button" class="default_btn btn_next" id="btn_cv_info">{{__('Next')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    <div class="inner_tab tab-pane fade" id="tab_3" role="tabpanel" aria-labelledby="tab_3">
                        <div class="QualificationsForm">
                            <div class="form_column">
                                <h5 class="mb-4">Qualifications Information</h5>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <h6>Basic Education*</h6>
                                        <label>Please specify your Basic Education</label>
                                        <input type="text" name="basic_education" class="form-control" placeholder="Basic Education*" required value="{{old('basic_education')}}" />
                                        @error('basic_education')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h6>Postgraduate Education</h6>
                                        <label>Please specify your Masters, PHD or other Postgraduate Education</label>
                                        <input type="text" name="postgraduate_education" class="form-control" placeholder="Postgraduate Education" />
                                        @error('postgraduate_education')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>                                    
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <h6>Certifications</h6>
                                        <label class="form-label label_hght" for="certificate">
                                            Please attach relevant certificate(s) as per the position requirements
                                        </label>
                                        <input type="text" name="certification_type[0]" class="form-control" placeholder="Certification Type" value="{{old('certification_type')[0]}}">                                                    
                                        @error('certification_type')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group custom-file col-md-6">
                                        <h6>Upload File</h6>
                                        <label class="d-block pb-2">You can upload multiple files. If you choose to, please select and upload them in one go.</label>
                                        <!-- <span class="addMore file-input-button" id="file-input-button-x" data-id="x"><i class="fas fa-plus-circle"></i>Add More</span>
                                        <div id="file-list-x"></div>  -->
                                        <div class="customFile">
                                            <input id="attach_file" multiple class="file-input form-control d-inline-block file-size-limit" name="attach_certificates[0][]" multiple type="file" onchange="javascript:attach_certificates()"/>
                                            <span class="file_label">Upload File</span>                                            
                                        </div>
                                        <div id="fileList"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <h6>Supporting Documentation</h6>
                                        <label class="form-label label_hght" for="certificate">
                                            Please attach other relevant documents as per position requirements
                                        </label>
                                        <input type="text" name="document_type[0]" class="form-control" placeholder="File Name" value="{{old('document_type')[0]}}">
                                        @error('document_type')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror</div>

                                    <div class="form-group custom-file col-md-6">
                                        <h6>Upload File</h6>
                                        <label class="d-block pb-2">You can upload multiple files. If you choose to, please select and upload them in one go.</label>                                        
                                        <!-- <span class="addMore file-input-button" id="file-input-button-y" data-id="y"><i class="fas fa-plus-circle"></i>Add More</span>
                                        <div id="file-list-y"></div>  -->
                                        <div class="customFile">
                                            <input id="attach_document" class="file-input form-control d-inline-block file-size-limit" name="attach_documents[0][]" multiple type="file" onchange="javascript:attach_documents()"/>
                                            <span class="file_label">Upload File</span>                                            
                                        </div>
                                        <div id="documentfileList"></div>
                                    </div>
                                </div>                                        
                            </div>
                            <div class="form_column mt-3">
                                <div class="row">
                                    <div class="btn_column form-group col-md-12">
                                        <button type="button" class="default_btn grey_bgbtn" id="btn_edu_prev">Previous</button>
                                        <button type="button" class="default_btn btn_next" id="btn_edu_info">{{__('Next')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="inner_tab tab-pane fade" id="tab_4" role="tabpanel" aria-labelledby="tab_4">
                        <div class="QualificationsForm">
                            <div class="form_column">
                                <h5 class="mb-4">Employment Details</h5>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>How many years of experience do you have?*</label>
                                        <input class="form-control" name="work_experience" type="text" value="{{old('work_experience')}}" required/>
                                        @error('work_experience')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>                                            
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Current Position*</label>
                                        <input class="form-control" name="current_position" type="text" required value="{{old('current_position')}}" />
                                        @error('current_position')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Current Employer Name*</label>
                                        <input class="form-control" name="employer_name" type="text" value="{{old('employer_name')}}" required />
                                        @error('employer_name')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>                                            
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Current Monthly Salary in AED and Benefits*</label>
                                        <input class="form-control" name="current_salary" type="text" required value="{{old('current_salary')}}" required/>
                                        @error('current_salary')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Expected Salary and Benefits*</label>
                                        <input class="form-control" name="expected_salary" type="text" value="{{old('expected_salary')}}" required />
                                        @error('expected_salary')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>                                            
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>When are you available for an interview?*</label>
                                        {{--                                                <input class="form-control" name="interview_availability" type="date" required value="" />--}}
                                        <input class="form-control" name="interview_availability" type="text"    value="{{old('interview_availability')}}" required/>
                                        <!-- <i class="far fa-calendar-alt"></i> -->
                                        @error('interview_availability')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Date Available to Start Work*</label>
                                        {{--                                                <input class="form-control" name="work_start_date" type="date" value="" />--}}
                                        <input class="form-control" name="work_start_date" type="text" value="{{old('work_start_date')}}" required />
                                        <!-- <i class="far fa-calendar-alt"></i> -->
                                        @error('work_start_date')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>                                            
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Employment Notice Period*</label>
                                        {{--                                                <input class="form-control" name="notice_period" type="text" required value="" />--}}
                                        <input class="form-control" name="notice_period" type="text" required value="{{old('notice_period')}}" />
                                        @error('notice_period')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Please indicate how you heard about this job*</label>
                                        <select class="form-control" name="job_heard" required>
                                            <option  value="" selected></option>
                                            <option  {{old('job_heard')=='Email from National Ambulance'?'selected':''}}>Email from National Ambulance</option>
                                            <option  {{old('job_heard')=='National Ambulance Career Portal'?'selected':''}}>National Ambulance Career Portal</option>
                                            <option  {{old('job_heard')=='National Ambulance Social Media Pages'?'selected':''}}>National Ambulance Social Media Pages</option>
                                            <option  {{old('job_heard')=='Recruitment Agency'?'selected':''}}>Recruitment Agency</option>
                                            <option  {{old('job_heard')=='Friends and Family (National Ambulance Employee)'?'selected':''}}>Friends and Family (National Ambulance Employee)</option>
                                            <option  {{old('job_heard')=='Friends and Family'?'selected':''}}>Friends and Family</option>
                                            <option  {{old('job_heard')=='Internet Search Engine'?'selected':''}}>Internet Search Engine</option>
                                            <option  {{old('job_heard')=='Newspaper or Magazine'?'selected':''}}>Newspaper or Magazine</option>
                                            <option  {{old('job_heard')=='TV or Radio'?'selected':''}}>TV or Radio</option>
                                            <option  {{old('job_heard')=='Social Media Sites'?'selected':''}}>Social Media Sites</option>
                                            <option  {{old('job_heard')=='Online Recruitment Website (e.g. LinkedIn)'?'selected':''}}>Online Recruitment Website (e.g. LinkedIn)</option>
                                            <option  {{old('job_heard')=='Other'?'selected':''}}>Other</option>
                                        </select>
                                        @error('job_heard')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form_column mt-3">
                                <div class="row">
                                    <div class="btn_column form-group col-md-12">
                                        <button type="button" class="default_btn grey_bgbtn" id="btn_employement_prev">Previous</button>

                                        <button type="button" class="default_btn btn_next" id="btn_emp_next">{{__('Next')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="inner_tab tab-pane fade" id="tab_5" role="tabpanel" aria-labelledby="tab_5">
                        <div class="QualificationsForm">
                            <div class="row">
                              <div class="form-group col-md-12">
                                 <p>Thank you for your interest in National Ambulance. Before submitting this application, please take a moment to review and ensure that the application has been completed correctly to help us proceed with your application efficiently.</p>
                                 <p>We confirm that the information provided on this application form will remain private and confidential and be used for selection and recruitment purposes and as stated in our <a href="/page/privacy-policy" target="_blank">Privacy Policy</a>. If your application is shortlisted, we may process or use this information for normal course of business or if required by law.</p>
                             </div>
                         </div>
                         <div class="row">
                           <div class="form-group col-md-12">
                              <div class="form-check">
                                 <input name="agreement" class="form-check-input" type="checkbox"  id="flexCheckChecked" required>
                                 <label class="form-check-label fw-normal" for="flexCheckChecked">
                                    By submitting this application, I hereby certify that all information provided in it is complete, true and correct to the best of my knowledge. I understand that any false statements, misleading information, omissions or misrepresentation made by me on this application, may result in my failure to proceed with this application or to submit any future applications, as well as a subsequent withdrawal of an offer of employment or termination of employment. I understand that this application may be subject to a screening and verification check and I give my consent to National Ambulance UAE to carry out such procedure.*
                                </label>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        @if(config('services.recaptcha.key'))
                        <div class="g-recaptcha"
                        data-sitekey="{{ config('services.recaptcha.key') }}">
                    </div>
                    @endif
                    <label id="g-recaptcha-response-msg"  style="color: red;font-weight: 400;"></label>

                    @error('g-recaptcha-response')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form_column mt-3">
                    <div class="row">
                        <div class="btn_column form-group col-md-12">
                            <button type="button" class="default_btn grey_bgbtn" id="btn_emp_prev">Previous</button>
                            <input type="hidden" name="job_id" value="{{$data->job_id}}">
                            <button type="submit" class="default_btn btn_next">{{__('Submit')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
</div>
</div>
</div>
</div>
</form>
</section>
@endsection

@section('script')
<script>
window.onload = function() {
    var $recaptcha = document.querySelector('#g-recaptcha-response');

    if($recaptcha) {
        $recaptcha.setAttribute("required", "required");
    }
};
// $('form#job-apply-form').submit(function(){
//     $(this).find(':button[type=submit]').prop('disabled', true);
// });
    $(document).ready(function(){

        let invalidArr = '';
        let tempCount = 0;
        jQuery("form input").on("invalid", function (event) {
            tempCount++;
            let count = $("form").find(":invalid").length;
           
            if (tempCount === 1) {
                invalidArr = $(this).parents('.inner_tab.tab-pane').attr('id');
           

                $('#nav-tab a[href="#' + invalidArr + '"]').tab('show');
                $(this).addClass('is-invalid');
                // $(this).show();
                $(this).focus();
                $(this).css("border-color", "red");
                // $(this).checkValidity();

                // alert('Please do provided valid information in "' + $(this).attr('placeholder') +'" !!!');

            }
            if (count == tempCount + 1) {
                // console.log("count is last : " + invalidArr)

                invalidArr = '';
                tempCount = 0;
                $("form").find(":invalid").focus();

            }

        });
    });
    $(document).ready(function(){
      
        $('#national-service-waiver').hide();
        $('#national-service-waiver').find('input').removeAttr('required');
        $("#uae-national").hide();
        $("#uae-national").find('input').removeAttr('required');
        $('#other-national').hide();
        $('#other-national').find('input').removeAttr('required');
        if($('#national-service input[type=radio]').val()=='1'){
                        $('#national-service-waiver').hide();
                        $('#national-service-waiver').find('input').removeAttr('required');
        }else if( $('#national-service input[type=radio]').val()=='0') {
                        $('#national-service-waiver').show();
                        // $('#national-service-waiver').find('input').attr("required", true);
        }

        if($("#nationality-select").val()=='United Arab Emirates'){
                if("{{$data->job_category}}".search('UAE Nationals') ==-1){
                    swal("info","Please search for UAE national Jobs.","info");
                    $(this).val('');
                    $("#uae-national").hide();
                $("#uae-national").find('input').removeAttr('required');
                $('#other-national').hide();
                $('#other-national').find('input').removeAttr('required');
                }else{
                         $("#uae-national").show();
                        $("#uae-national").find('input').attr("required", true);
                        $('#other-national').hide();
                        $('#other-national').find('input').removeAttr('required');
                        
                }
           

            }else if($("#nationality-select").val() !=''){
                $("#uae-national").hide();
                $("#uae-national").find('input').removeAttr('required');
                $('#other-national').show();
                $('#other-national').find('input').attr("required", true);
                $('#other-national').find('#current-location-selectized').removeAttr("required");

            }else{
                $("#uae-national").hide();
                $("#uae-national").find('input').removeAttr('required');
                $('#other-national').hide();
                $('#other-national').find('input').removeAttr('required');

            }
            if($("#current-location").val()=='United Arab Emirates'){
                $("#current-location-uae").show();
                $('#current-location-uae').find('input').attr("required", true);
                $('#current-location-uae').find('input[name=uae_emirates_id_no]').removeAttr("required");

                
            }else{
                $("#current-location-uae").hide();
                $('#current-location-uae').find('input').removeAttr('required');
            }
            // edit load
        if("{{$data->job_category}}".search('UAE Nationals') !=-1){
            
            // $("#nationality-select").removeAttr('selected');
        //  $('#nationality-select').find('option[value="United Arab Emirates"]').attr('selected','selected');
            $('#nationality-select').val("United Arab Emirates").change();
            $('#nationality-value').val("United Arab Emirates");

            $('#nationality-select').attr('disabled', "true");
            $("#uae-national").show();
            $("#uae-national").find('input').attr("required", true);
            $('#other-national').hide();
            $('#other-national').find('input').removeAttr('required');
            $('#national-service input[type=radio]').change(function () {
                
                var checkedValue = $(this).val();
                if (checkedValue === '1') {
                    $('#national-service-waiver').hide();
                    $('#national-service-waiver').find('input').removeAttr('required');

                } else {
                    $('#national-service-waiver').show();
                    $('#national-service-waiver').find('input').attr("required", true);

                }
            });
           
        }else{
            $('#nationality-select').val("").change();
            $('#nationality-select').removeAttr('disabled');
            $("#uae-national").find('input').removeAttr("required");

            // $('#nationality-select').find('option[value="United Arab Emirates"]').removeAttr('selected');
            // $('#nationality-select').change();

        }
        $("#nationality-select").change(function(){
            $('#national-service input[type=radio]').change(function () {
                
                var checkedValue = $(this).val();
                if (checkedValue === '1') {
                    $('#national-service-waiver').hide();
                    $('#national-service-waiver').find('input').removeAttr('required');

                } else {
                    $('#national-service-waiver').show();
                    $('#national-service-waiver').find('input').attr("required", true);

                }
            });
            var nationality= $(this).val();
            if(nationality=='United Arab Emirates'){
                if("{{$data->job_category}}".search('UAE Nationals') ==-1){
                    swal("info","Please search for UAE national Jobs.","info");
                    $(this).val('');
                    $("#uae-national").hide();
                $("#uae-national").find('input').removeAttr('required');
                $('#other-national').hide();
                $('#other-national').find('input').removeAttr('required');
                }else{
                         $("#uae-national").show();
                        $("#uae-national").find('input').attr("required", true);
                        $('#other-national').hide();
                        $('#other-national').find('input').removeAttr('required');
                }
           

            }else if(nationality !=''){
                $("#uae-national").hide();
                $("#uae-national").find('input').removeAttr('required');
                $('#other-national').show();
                $('#other-national').find('input').attr("required", true);
                $('#other-national').find('#current-location-selectized').removeAttr("required");
            }else{
                $("#uae-national").hide();
                $("#uae-national").find('input').removeAttr('required');
                $('#other-national').hide();
                $('#other-national').find('input').removeAttr('required');

            }

        });
        @if(old('nationality'))
            $("#nationality-select").val("{{old('nationality')}}").change();

        @endif
        $("#current-location-uae").hide();
        $('#current-location-uae').find('input').removeAttr("required");

        $("#current-location").change(function(){
            var nationality= $(this).val();
            if(nationality=='United Arab Emirates'){
                $("#current-location-uae").show();
                $('#current-location-uae').find('input').attr("required", true);
                $('#current-location-uae').find('input[name=uae_emirates_id_no]').removeAttr("required");                
            }else{
                $("#current-location-uae").hide();
                $('#current-location-uae').find('input').removeAttr('required');
            }
                $('#current-location-uae').find('#current-location-selectized').removeAttr('required');
        });

        @if(old('country'))
            $('#current-location').val("{{old('country')}}").change();

        @endif
        
        
        $('#btn_cv_prev').on('click', function (e) {
            // alert('in : ');
            $('#nav-tab a[href="#tab_1"]').tab('show') // Select tab by name
        });
        $('#btn_edu_prev').on('click', function (e) {
            // alert('in : ');
            $('#nav-tab a[href="#tab_2"]').tab('show') // Select tab by name
        });
        $('#btn_employement_prev').on('click', function (e) {
            // alert('in : ');
           $('#nav-tab a[href="#tab_3"]').tab('show') // Select tab by name
        });
         
        $('#btn_emp_prev').on('click', function (e) {
            // alert('in : ');
           $('#nav-tab a[href="#tab_4"]').tab('show') // Select tab by name
        });
        
        $("form").validate();
    
        $('.default_btn.btn_next').on('click',function(e){
            
            $("#g-recaptcha-response-msg").text('');

            var isError=false;
            var tabActive = $(this).parents('.inner_tab.tab-pane').attr('id');
            var index = 1;
            $(this).parents('.inner_tab.tab-pane').find('input[required], select[required], textarea[required]').each(function(){
                
                if ($(this)&&!$(this).valid()){
                    // $(this).addClass('is-invalid');
                    if(index==1){
                        index++;
                        $(this).focus();
                    }
                    $(this).css("border-color", "red");
                    // if($(this).attr('name')=='g-recaptcha-response'){
                    //     $("#g-recaptcha-response-msg").text('This field is required.');
                    // }
                    isError= true;
                }else{
                    $(this).css("border-color", "green");
                    
                }
            });
            if(isError){
                e.preventDefault();
                if($(this).attr('type')=='submit'){
                        swal("Error","Validation failed. Please fill the required fields in all the sections of the form.");

                    }
                $('#nav-tab a[href="#' + tabActive + '"]').tab('show');
            }else{
                switch (tabActive) {
                    case "tab_1":
                        $('#nav-tab a[href="#tab_2"]').tab('show');
             $('html, body').animate({
            scrollTop: $("#tab_2").offset().top - 150   
            }, 500);
                        break;
                    case "tab_2":
                        $('#nav-tab a[href="#tab_3"]').tab('show');
                        
                        break;
                    case "tab_3":
                        $('#nav-tab a[href="#tab_4"]').tab('show');
        $('html, body').animate({
                scrollTop: $("#tab_4").offset().top + 500   
            }, 500);
                        break;
                    case "tab_4":
                        $('#nav-tab a[href="#tab_5"]').tab('show');
        $('html, body').animate({
                scrollTop: $("#tab_5").offset().top + 500   
            }, 500);
                        break;
                }
            }          
        });
        $("#attach_waiver").removeAttr("required");
        $('form').submit(function() {
            console.log("submit");

            if($('form').valid()){
                $(this).find(':button[type=submit]').prop('disabled', true);

                $('#loader').show();
            }else{
                e.preventDefault();
                $("label[for='g-recaptcha-response']").show();

            }
        });
    });
 
</script>
<script>
    @if(app()->getLocale() != 'en')                           
        window.location.replace("LaravelLocalization::getLocalizedURL('en')}}");
    @endif
</script>
<script>
	function addHyphen (element) {
    	let ele = document.getElementById(element.id);
        ele = ele.value;   
        let finalVal=ele;
        if(ele.length==3){
            finalVal = ele+"-";
        }else if(ele.length==8){
            finalVal = ele+"-";
        }else if(ele.length==16){
            finalVal = ele+"-";
        }else if(ele.length>18){
            finalVal = ele.slice(0, -1);
        }
        document.getElementById(element.id).value = finalVal;
    }
</script>
@endsection