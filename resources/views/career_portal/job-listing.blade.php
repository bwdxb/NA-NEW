
@extends('layouts.career-portal.app')
@php
 use app\Http\helper\Helper as Helper;
 $jobCategories = Helper::getJobCategories();
@endphp

@section('meta_tags')
    {!! Meta::toHtml() !!} 
   <meta property="og:description" content="Our Careers portal offers information about the opportunities available at National Ambulance  " />
  <meta property="og:title" content="Careers-National Ambulance" />
  <meta name="image" property="og:image" content="{{url('/public/Image/200x200.jpg')}}">
@endsection
<style type="text/css">
    .g-recaptcha>div{width:100%!important;}
    .g-recaptcha.modal-captcha>div{width:304px!important;}
    .g-recaptcha{margin-bottom:10px;}  
    iframe{width:100%;}
    .rc-anchor-normal{width:100%!important;}
</style>
@section('content')
<section class="page_banner">
    <div class="job_caption">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>{{__('Explore Career Opportunities')}}<br>{{__('at National Ambulance')}}</h1>
                </div>
                <form action="{{route('career-portal.user.vacancy.view.filter')}}" method="get">
                <div class="col-md-12">
                    <div class="filterWrapper">
                        <div class="jobfield">
                            <input type="text" name="search_key" class="form-control"
                                   placeholder="{{__('Search keywords')}}" value="{{Request::get('search_key')}}">
                            <button class="searchBtn"></button>
                        </div>
                        <div class="jobfield">
                            <div id="categoryList"></div> 
                            <select class="form-control chosen-select" name="category[]" multiple data-placeholder="Job Category">
                                <!-- <option  value="" disabled>Job Category</option> -->
                                @foreach($jobCategories as $jobCat)
                                    <option value="{{$jobCat->job_category}}"  {{( Request::get('category')&&in_array($jobCat->job_category,Request::get('category')))?'selected':''}}>
                                    @if(app()->getLocale() == 'en')
                                    {{$jobCat->job_category}}
                            @else
                            {{$jobCat->job_category_ar}}
                            @endif       
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="jobfield">
                            <select class="form-control" name="sort">
                                <option {{Request::get('sort')=='Newest'?'selected':''}} value="Newest">{{__('Newest')}}</option>
                                <option  {{Request::get('sort')=='Oldest'?'selected':''}} value="Oldest">{{__('Oldest')}}</option>
                            </select>
                        </div>
                        <div class="jobBtn">
                            <button type="submit" class="default_btn navyblue_btn">{{__('Find Job')}}</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</section>
<!--Page Banner end-->
<section class="jobWrapper section_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mb-4">
                <h2>{{__('Find the right job for you!')}}</h2>
                <p class="available_job">{{count($data)}} {{__('jobs available')}}</p>
            </div>

            <div class="col-md-12 col-lg-8 col-xl-9">
            @forelse($data as $d)

                <div class="jobItem">
                    <div class="jobImage">
                        @if($loop->iteration % 2 == 0)
                        <img src="{{asset('public/career_portal/images/company-logo.svg')}}"
                             alt="National Ambulance">
                        @else
                        <img src="{{asset('public/career_portal/images/company-logo.svg')}}"
                             alt="National Ambulance">
                        @endif
                    </div>
                    <div class="jobDescription">
                        <h3 class="jobTitle">
                            @if(app()->getLocale() == 'en')
                                {{$d->job_title}}
                            @else
                                {{$d->job_title_ar}}
                            @endif                    
                        </h3>
                        <div class="jobInfo">
                            <ul class="joblisting">
                                <li>
                                    <i class="job_icon">
                                        <img src="{{asset('public/career_portal/images/marker.svg')}}">
                                    </i>
                                    <span>                                      
                                        @if(app()->getLocale() == 'en')
                                            {{$d->location}}
                                        @else
                                            {{$d->location_ar}}
                                        @endif
                                    </span>
                                </li>                                
                                <li>
                                    <i class="job_icon">
                                        <img style="width:20px;margin-top:2px;" src="{{asset('public/career_portal/images/job-category.svg')}}">
                                    </i>
                                    <span>                                      
                                        @if(app()->getLocale() == 'en')
                                            {{$d->job_category}}
                                        @else
                                            {{$d->job_category_ar}}
                                        @endif
                                    </span>
                                </li>
                                <li>
                                    <i class="job_icon">
                                        <img src="{{asset('public/career_portal/images/calander-icon.svg')}}">
                                    </i>
                                    <span>
                                        Closing Date:               
                                        {{\Carbon\Carbon::createFromFormat('Y-m-d', $d->vacancy_closing_date)->format('d-m-Y') }}
                                        
                                    </span>
                                </li>
                                <li>
                                    <i class="job_icon">
                                        <img src="{{asset('public/career_portal/images/department.svg')}}">
                                    </i>
                                    <span>                                      
                                        @if(app()->getLocale() == 'en')
                                            {{$d->department}}
                                        @else
                                            {{$d->department_ar}}
                                        @endif
                                    </span>
                                </li>
                            </ul>
                            <a class="default_btn primary_btn" 
                            href="{{ route('career-portal.user.vacancy.details.view',['id'=>$d->id]) }}">{{__('Apply Now')}}</a>
                        </div>
                    </div>
                    <span class="job_save"></span>
                </div>

                @empty
                    <div class="col-md-12">
                        <b>{{_('There are no current vacancies available.')}}</b>
                    </div>
                @endforelse
            </div>
            <div class="col-md-12 col-lg-4 col-xl-3">
                <div class="asideWidget">
                    <div class="getHeader">
                        <h3>Share your profile<br>with us!</h3>
                    </div>
                    <div class="widgetContent">
                        <p class="mb-4">{{__('Send us your CV to match with future vacancies')}}</p>
                        @if(session('general_cv_success'))
                        <h5 class="navyColor">
                            <i class="fas fa-check"></i>
                            {{ session('general_cv_success') }}<br/>
                        </h5>
                    @endif

                    @if(session('general_cv_error'))
                        <h5 class="text-danger">
                            <i class="fas fa-times"></i>
                            {{ session('general_cv_error') }}
                        </h5>
                    @endif
                        <div class="uploadCV">
                            <button id="submitCV" class="default_btn primary_btn" data-bs-toggle="modal" data-bs-target="#generalcvModal">{{__('Submit Your CV')}}</button>
                            <!-- <input class="form-control  file-size-limit" name="CV" type="file"> -->
                        </div>
                    </div>
                </div>
                <div class="asideWidget">
                    <h3 class="widgetTitle">{{__('Receive Job Alerts')}}</h3>
                    <div class="widgetContent pt-3">
                    @if(session('subscription_success'))
                        <h5 class="navyColor">
                            <i class="fas fa-check"></i>
                            {{ session('subscription_success') }}<br/>
                        </h5>
                    @endif

                    @if(session('subscription_error'))
                        <h5 class="text-danger">
                            <i class="fas fa-times"></i>
                            {{ session('subscription_error') }}
                        </h5>
                    @endif
                    <form class="alert_job_form1" id="alert_job_form" method="POST" action="{{route('career-portal.subscription.create')}}">
                        {{csrf_field()}}
                                        <p class="text-center">{{__('Subscribe to receive job alerts when new vacancies are posted')}}</p>
                                        <div class="form-group mb-3">    
                                            <div id="output"></div>                                           
                                             <select  name="job_category[]" class="form-control chosen-select" placelholder="Select category(s) of interest" required multiple>
                                             <!-- <option class="navyColor" value="all"></option> -->
                                             @foreach($jobCategories as $jobCat)
                                             <option value="{{$jobCat->job_category}}">{{$jobCat->job_category}}</option>
                                             @endforeach
                                             </select>
                                        </div>
                                        <div class="form-group mb-3">
                                             <input type="email" name="email" class="form-control"
                                                  placeholder="{{__('Enter your email address')}}" required>
                                                  @error('email')
                                                    <p class="text-danger">{{ $message }}</p>
                                                  @enderror
                                        </div>                                        
                                        <div class="form-group mb-4">
                                             <div class="form-check form-check-flat">
                                                  <label class="form-check-label">
                                                       <input type="checkbox" name="agreement" class="form-check-input" required>{{__('I agree with the')}} <a href="/page/terms-and-conditions"><strong>{{__('Terms and Conditions')}}</strong></a> {{__('and')}}
                                                                <a href="/page/privacy-policy"><strong>{{__('Privacy Policy')}}</strong></a>
                                                       <i class="input-helper"></i>
                                                  </label>
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
                                        <div class="form-group">
                                             <button type="submit" class="default_btn navyblue_btn">{{__('Subscribe')}}</button>
                                        </div>
                                   </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="generalcvModal" tabindex="-1" aria-labelledby="generalcvModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="generalcvModalLabel">General CVs</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
           <div class="form_panel">
                <form class="generalCv_form" name="General CV" enctype="multipart/form-data" method="post" action="{{route('career-portal.general.create')}}">
                {{csrf_field()}}   
                <div class="form_column">
                        <div class="row">
                             <div class="form-group col-md-6">
                             <select id="title" name="title" class="form-control" required>
                                                                            <option selected disabled="true"
                                                                            value="">{{__('Title')}}</option>
                                                                            <option value="Mr">{{__('Mr')}}</option>
                                                                            <option value="Mrs">{{__('Mrs')}}</option>
                                                                            <option value="Miss">{{__('Miss')}}</option>
                                                                            <option value="Ms">{{__('Ms')}}</option>
                                                                            
                                                                        </select>                                  @error('title')
                                                    <p class="text-danger">{{ $message }}</p>
                                                  @enderror
                                  
                             </div>
                             <div class="form-group col-md-6">
                                  <input type="text" name="name" class="form-control" placeholder="{{__('Name*')}}" required>
                                  @error('name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                  @enderror
                             </div>
                        </div>
                        <div class="row">
                             <div class="form-group col-md-6">
                                  <input type="email" name="email" class="form-control" placeholder="{{__('Email Address*')}}" required>
                                  @error('email')
                                                    <p class="text-danger">{{ $message }}</p>
                                                  @enderror
                             </div>
                             <div class="form-group col-md-6">
                                  <input type="text" name="phone" class="form-control" placeholder="{{_('Mobile Number*')}}" required>
                                  @error('phone')
                                                    <p class="text-danger">{{ $message }}</p>
                                                  @enderror
                             </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                            <input type="text" class="form-control" name="nationality" placeholder="{{__('Nationality*')}}" required/>
                                <!-- <select class="form-control" name="nationality">
                                <option selected="">Nationality*</option>
                                <option>UAE</option>
                                <option>Indian</option>
                                </select> -->
                                @error('nationality')
                                                    <p class="text-danger">{{ $message }}</p>
                                                  @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="custom-file">
                                    <label for="formFileLg" class="form-label">{{__('Upload CV*')}}</label>
                                    <div class="customFile">
                                        <input class="form-control file-size-limit" type="file" name="attach_cv" required>
                                    </div>
                                </div>
                                @error('attach_cv')
                                                    <p class="text-danger">{{ $message }}</p>
                                                  @enderror
                            </div>
                        </div>
                        <div class="row">
                        @if(config('services.recaptcha.key'))
                        <div class="g-recaptcha modal-captcha"
                        data-sitekey="{{ config('services.recaptcha.key') }}">
                    </div>
                    @endif
                    <label id="g-recaptcha-response-msg1"  style="color: red;font-weight: 400;"></label>

                    @error('g-recaptcha-response')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                    </div>
                    <div class="form_column mt-2">
                        <div class="row">
                            <div class="btn_column form-group col-md-12">
                                <button type="submit" class="default_btn grey_bgbtn m-0">
                                    {{__('Submit')}}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
      </div>
    </div>
  </div>
</div>
<!--{{__('Job Listing')}} end-->
@endsection

@section('script')
<script>
     window.onload = function() {
        var $recaptcha1 = document.querySelector('#g-recaptcha-response-1');
        if($recaptcha1) {
            $recaptcha1.setAttribute("required", "required");
        }
        var $recaptcha = document.querySelector('#g-recaptcha-response');
        if($recaptcha) {
            $recaptcha.setAttribute("required", "required");
        }
    };
    $(function () {
        $("form.generalCv_form").validate();
       
        $('form.generalCv_form').submit(function(e){
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
                    // if($(this).attr('name')=='g-recaptcha-response'){
                    //     alert();
                    //     $("#g-recaptcha-response-msg1").text('This field is required.');
                    // }
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
   
        // $("#alert_job_form").validate();
       
        // $('#alert_job_form').submit(function(e){
        //     alert();
        //     e.preventDefault();
        //     $("#g-recaptcha-response-msg1").text('');

        //    var index=1;
        //    var isError = false;
        //     $(this).find('input[required], select[required], textarea[required]').each(function(){
              
        //         if (!$(this).valid()){
        //             if(index==1){
        //                 index++;
        //                 $(this).focus();
        //             }
        //             $(this).css("border-color", "red");
        //             // if($(this).attr('name')=='g-recaptcha-response'){
        //             //     alert();
        //             //     $("#g-recaptcha-response-msg1").text('This field is required.');
        //             // }
        //             isError= true;
        //         }else{
        //             $(this).css("border-color", "green");
        //         }
        //     });
        //     if(isError){
        //         e.preventDefault();   
        //         $("label[for='g-recaptcha-response']").show();
              
        //     }else{           
        //         $('#loader').show();
        //     }
                     
        // });
    });
    @if(app()->getLocale() != 'en')                           
        window.location.replace("{{LaravelLocalization::getLocalizedURL('en')}}");
    @endif
</script>

@endsection