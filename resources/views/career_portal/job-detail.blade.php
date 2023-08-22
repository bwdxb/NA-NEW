@extends('layouts.career-portal.app')
@php
 use app\Http\helper\Helper as Helper;
 $jobCategories = Helper::getJobCategories();
@endphp


@section('meta_tags')
{!! Meta::toHtml() !!}
  
@endsection
<style type="text/css">
    .g-recaptcha>div{width:100%!important;}
    .g-recaptcha.modal-captcha>div{width:304px!important;}
    .g-recaptcha{margin-bottom:10px;}  
    iframe{width:100%;}
    .rc-anchor-normal{width:100%!important;}
    .swal-text{font-family: 'Almarai', sans-serif;text-align: center;
    line-height: 1.5;}
</style>
@section('content')
<section class="jobContent pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 py-4" id="ar-all-job" style="display:none">
                <a class="back_to_site" href="{{route('career-portal.user.vacancy.view.all')}}">{{__('الوظائف المتاحة')}}</a>
            </div>
            <div class="col-md-12 py-4" id="en-all-job">
                <a class="back_to_site" href="{{route('career-portal.user.vacancy.view.all')}}">{{__('All Jobs')}}</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-8 col-xl-9"  id="en-content">
                <div class="job_des_wrapper">
                    <div class="jobHeader">                        
                        <div class="leftBlock">
                            <h2>
                                @if(app()->getLocale() == 'en')
                                    {{$data->job_title}}
                                @else
                                    {{$data->job_title_ar}}
                                @endif
                            </h2>
                            <ul class="joblisting">
                                <li>
                                    <i class="job_icon">
                                        <img style="width:20px;margin-top:3px;" src="{{asset('public/career_portal/images/job-category.svg')}}"></i>
                                    <span>
                                        {{$data->job_category}}
                                    </span>
                                </li>
                                <li>
                                    <i class="job_icon">
                                        <img style="margin-top:1px;" src="{{asset('public/career_portal/images/marker.svg')}}">
                                    </i>
                                    <span>                                      
                                        @if(app()->getLocale() == 'en')
                                            {{$data->location}}
                                        @else
                                            {{$data->location_ar}}
                                        @endif
                                    </span>
                                </li>
                                <li>
                                    <i class="job_icon"><img
                                                src="{{asset('public/career_portal/images/calander-icon.svg')}}"></i>
                                    <span title="Closing Date">                                      
                                     
                                            
                                            {{\Carbon\Carbon::createFromFormat('Y-m-d', $data->vacancy_closing_date)->format('d-m-Y') }}

                                        
                                    </span>
                                </li>
                            </ul>
                            <ul class="txt_lisitng">
                                <li>
                                    <label>{{__('Department')}}</label>
                                    <span>                                      
                                        @if(app()->getLocale() == 'en')
                                            {{$data->department}}
                                        @else
                                            {{$data->department_ar}}
                                        @endif
                                    </span>
                                </li>
                                <li>
                                    <label>{{__('Employment Type')}}</label>
                                    <span>{{$data->employment_type}}</span>
                                </li>
                                <!-- <li>
                                    <label>{{__('Salary and Benefits')}}</label>
                                    <span>                                      

                                    </span>
                                    
                                </li> -->
                            </ul>
                            
                        </div>
                        <div class="rightBlock">
                            <div class="jobAction">
                            @if($data->bi_lang) <button type="button" class="default_btn translate_to_arabic"    >ترجمة إلى العربية</button>@endif
                                <!-- <a class="actionlink" href="#"><i class="fas fa-bookmark"></i></a> -->
                                <a class="actionlink shareToggle" href="javascript:void(0)"><i class="fas fa-share-alt"></i></a>
                                <div class="socialShare" style="display:none;">
                                    <ul class="share_options">
                                        <li><a href="https://twitter.com/share?url={{Request::url()}}&text=Check out this job at National Ambulance UAE: ({{$data->job_title}}.)" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Twitter"><img src="{{asset('public/website/images/twitter-circled.svg')}}"  alt="Twitter"></a></li>
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u={{Request::url()}}&t=Check out this job at National Ambulance UAE: ({{$data->job_title}}.)" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Facebook"><img src="{{asset('public/website/images/facebook-circled.svg')}}"  alt="Facebook"></a></li>
                                        <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{Request::url()}}&t=Check out this job at National Ambulance UAE: ({{$data->job_title}}.)" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Linkedin"><img src="{{asset('public/website/images/linkedin-circled.svg')}}"  alt="Linkedin"></a></li>
                                        
                                        <li><a href="whatsapp://send?text=Check out this job at National Ambulance UAE: ({{$data->job_title}}.) {{Request::url()}}" data-action="share/whatsapp/share" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on whatsapp"><img src="{{asset('public/website/images/whatsapp.svg')}}"  alt="Whatsapp"></a></li>
                                        <li><a href="mailto:?subject=Check out this job at National Ambulance UAE: ({{$data->job_title}}.)&body={{Request::url()}}" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Mail"><img style="margin-top:3px;"width="40px" height="40px" src="{{asset('public/website/images/envelop-circled.svg')}}"  alt="Email"></a></li>        
                                        <li><a href="javascript:void(0); " onclick="window.print()"><img style="margin-top:8px;" width="40px" height="40px" src="{{asset('public/website/images/printer.svg')}}"  alt="Print"></a></li>
                                    </ul>
                                </div>
                                
                            </div>
                            <div class="logoColumn">
                              
                                <h4>{{$data->job_id}}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="job_summary">
                        <h3>{{__('Job Description')}} </h3>
                        <p><strong>{{__('Summary:')}}</strong></p>
                        @if(app()->getLocale() == 'en')
                            {!!$data->job_description!!}
                        @else
                            {!!$data->job_description_ar!!}
                        @endif
                        @if($data->job_reqiurement)
                        <p><strong>{{__('Qualifications and Experience:')}}</strong></p>
                        @if(app()->getLocale() == 'en')
                            {!!$data->job_reqiurement!!}
                        @else
                            {!!$data->job_reqiurement_ar!!}
                        @endif
                        @endif

                        @if($data->salary_package)
                            <p><strong>{{__('Salary and Benefits')}}</strong></p>
                            @if(app()->getLocale() == 'en')
                                    {!!$data->salary_package!!}
                                @else
                                    {!!$data->salary_package_ar!!}
                            @endif
                        @endif
                        <!-- <p class="mt-3">{{__('All of the above is crucial for you to be able to succeed in this role, however we are looking for someone who has the energy and passion to bring new ideas and be an active part of a developing team.')}}</p> -->
                        <p class="mt-4"><a class="default_btn navyblue_btn" href="{{route('career-portal.user.vacancy.apply',$data->id)}}">Apply Now</a></p>
                    </div>
                </div>
            </div>
            <!-- Arabic content -->
            <div class="col-md-12 col-lg-8 col-xl-9 " dir="rtl" style="display:none" id="ar-content">
                <div class="job_des_wrapper">
                    <div class="jobHeader">                        
                        <div class="leftBlock">
                            <h2 class="mb-3">
                               
                                    {{$data->job_title_ar}}
                                
                            </h2>
                            <ul class="joblisting">
                                <li>
                                    <i class="job_icon">
                                        <img style="width:20px;margin-top:3px;" src="{{asset('public/career_portal/images/job-category.svg')}}"></i>
                                    <span>
                                        {{$data->job_category_ar}}
                                    </span>
                                </li>
                                <li>
                                    <i class="job_icon">
                                        <img src="{{asset('public/career_portal/images/marker.svg')}}">
                                    </i>
                                    <span>                                      
                                      
                                            {{$data->location_ar}}
                                       
                                    </span>
                                </li>
                                <li>
                                    <i class="job_icon"><img
                                                src="{{asset('public/career_portal/images/calander-icon.svg')}}"></i>
                                    <span title="Closing Date">                                      
                                        
                                    {{\Carbon\Carbon::createFromFormat('Y-m-d', $data->vacancy_closing_date)->format('d-m-Y') }}
                                        
                                    </span>
                                </li>
                            </ul>
                            <ul class="txt_lisitng">
                                <li>
                                    <label>{{__('القسم')}}</label>
                                    <span>                                      
                                        
                                            {{$data->department_ar}}
                                     
                                    </span>
                                </li>
                                <li>
                                    <label>{{__('طبيعة الدوام')}}</label>
                                    <!-- <span>{{__($data->employment_type)}}</span> -->
                                    <span>
                                        @if($data->employment_type=='Full-time')
                                         دوام كامل
                                        @else
                                        {{$data->employment_type}}
                                        @endif
                                    </span>
                                </li>
                                <!-- <li>
                                    <label>{{__('الراتب والمزايا')}}</label>
                                    <span>                                      
                                       
                                    </span>
                                </li> -->
                            </ul>
                        </div>
                        <div class="rightBlock">
                            <div class="jobAction">
                                <button type="button" class="default_btn translate_to_english">Back to English</button>
                                <!-- <a class="actionlink" href="#"><i class="fas fa-bookmark"></i></a> -->
                                <a class="actionlink shareToggle" href="javascript:void(0)"><i class="fas fa-share-alt"></i></a>
                                <div class="socialShare" style="display:none;">
                                    <ul class="share_options">
                                    <li><a href="https://twitter.com/share?url={{Request::url()}}&text=وظيفة شاغرة في الإسعاف الوطني: ({{$data->job_title_ar}})" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Twitter"><img src="{{asset('public/website/images/twitter-circled.svg')}}"  alt="Twitter"></a></li>
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u={{Request::url()}}&t=وظيفة شاغرة في الإسعاف الوطني: ({{$data->job_title_ar}})" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Facebook"><img src="{{asset('public/website/images/facebook-circled.svg')}}"  alt="Facebook"></a></li>
                                        <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{Request::url()}}&t=وظيفة شاغرة في الإسعاف الوطني: ({{$data->job_title_ar}})" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Linkedin"><img src="{{asset('public/website/images/linkedin-circled.svg')}}"  alt="Linkedin"></a></li>
                                        
                                        <li><a href="whatsapp://send?text=وظيفة شاغرة في الإسعاف الوطني: ({{$data->job_title_ar}}) {{Request::url()}}" data-action="share/whatsapp/share" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on whatsapp"><img src="{{asset('public/website/images/whatsapp.svg')}}"  alt="Whatsapp"></a></li>
                                        <li><a href="mailto:?subject=وظيفة شاغرة في الإسعاف الوطني: ({{$data->job_title_ar}})&body={{Request::url()}}" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Mail"><img style="margin-top:3px;"width="40px" height="40px" src="{{asset('public/website/images/envelop-circled.svg')}}"  alt="Email"></a></li>        
                                        <li><a href="javascript:void(0); " onclick="window.print()"><img style="margin-top:8px;" width="40px" height="40px" src="{{asset('public/website/images/printer.svg')}}"  alt="Print"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="logoColumn">
                                
                                <h4>{{$data->job_id}}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="job_summary">
                        <h3>{{__('الوصف الوظيفي')}} </h3>
                        <p><strong>نبذة عن الوظيفة:</strong></p>
                            {!!$data->job_description_ar!!}
                        
                            @if($data->job_reqiurement_ar)
                                 <p><strong>المؤهلات والخبرة:</strong></p>

                                {!!$data->job_reqiurement_ar!!}
                             @endif                            

                            @if($data->salary_package_ar)
                                <p><strong>{{__('الراتب والمزايا')}}</strong></p>

                                {!!$data->salary_package_ar!!}
                            @endif
                       

                        <!-- <p class="mt-3">{{__('All of the above is crucial for you to be able to succeed in this role, however
                            we are looking for someone who has the energy and passion to be able to bring together new
                            ideas and developing team.')}}</p> -->
                        <p class="mt-4"><a class="default_btn navyblue_btn" id="ar-apply-button" href="{{route('career-portal.user.vacancy.apply',$data->id)}}">قدم على هذه الوظيفة</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-4 col-xl-3">
                <div class="asideWidget">
                    <div class="getHeader">
                        <h3>Share your profile <br>with us!</h3>
                    </div>
                    <div class="widgetContent">
                        <p class="mb-4">Send us your CV to match with future vacancies</p>
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
                            <button id="submitCV" class="default_btn primary_btn" data-bs-toggle="modal" data-bs-target="#generalcvModal">Submit Your CV</button>
                            <!-- <input class="form-control" name="CV" type="file"> -->
                        </div>
                    </div>
                </div>
                <div class="asideWidget">
                    <h3 class="widgetTitle">Receive Job Alerts</h3>
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
                    <form class="alert_job_form" method="POST" action="{{route('career-portal.subscription.create')}}">
                        {{csrf_field()}}
                                        <p class="text-center">{{__('Subscribe to receive job alerts when new vacancies are posted')}}</p>
                                        <div class="form-group mb-3">    
                                            <!-- <div id="output"></div>       -->
                                        <select  name="job_category[]" class="form-control chosen-select" data-placeholder="Select category(s) of interest" required multiple>
                                             @foreach($jobCategories as $jobCat)
                                             <option value="{{$jobCat->job_category}}">{{$jobCat->job_category}}</option>
                                             @endforeach
                                             </select>
                                        </div>
                                        <div class="form-group mb-3">
                                             <input type="email" name="email" class="form-control"
                                                  placeholder="Enter your email address"  required>
                                                  @error('email')
                                                    <p class="text-danger">{{ $message }}</p>
                                                  @enderror
                                        </div>
                                        <div class="row">
                                                @if(config('services.recaptcha.key'))
                                                <div class="g-recaptcha"
                                                    data-sitekey="{{ config('services.recaptcha.key') }}">
                                                </div>
                                                @endif
                                                
                                                @error('g-recaptcha-response')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                                <label id="g-recaptcha-response-msg"  style="color: red;font-weight: 400;"></label>
                                        </div>
                                        <div class="form-group mb-4">
                                             <div class="form-check form-check-flat">
                                                  <label class="form-check-label">
                                                       <input name="agreement" type="checkbox" class="form-check-input" required>I
                                                       agree with the <a href="/page/terms-and-conditions"><strong>{{__('Terms and Conditions')}}</strong></a> {{__('and')}}
                                                                <a href="/page/privacy-policy"><strong>{{__('Privacy Policy')}}</strong></a>
                                                       <i class="input-helper"></i>
                                                  </label>
                                             </div>
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

<!------ Upload CV Modal ------>

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
                                                                            
                                                                        </select>
                                  @error('title')
                                                    <p class="text-danger">{{ $message }}</p>
                                                  @enderror
                                  
                             </div>
                             <div class="form-group col-md-6">
                                  <input type="text" name="name" class="form-control" placeholder="Name*" required>
                                  @error('name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                  @enderror
                             </div>
                        </div>
                        <div class="row">
                             <div class="form-group col-md-6">
                                  <input type="email" name="email" class="form-control" placeholder="Email Address*" required>
                                  @error('email')
                                                    <p class="text-danger">{{ $message }}</p>
                                                  @enderror
                             </div>
                             <div class="form-group col-md-6">
                                  <input type="text" name="phone" class="form-control" placeholder="Mobile Number*" required>
                                  @error('phone')
                                                    <p class="text-danger">{{ $message }}</p>
                                                  @enderror
                             </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                            <input type="text" class="form-control" name="nationality" placeholder="Nationality*" required/>

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
                                    <label for="formFileLg" class="form-label">Upload CV*</label>
                                    <div class="customFile">
                                        <input class="form-control  file-size-limit" type="file" name="attach_cv" required>
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
                                    Submit
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
    $(document).ready(function(){
        $('#og-desc').attr('content','Check out this job at National Ambulance UAE: ({{$data->job_title}})');
        $('#og-title').attr('content','Check out this job at National Ambulance UAE: ({{$data->job_title}})');
        $(".translate_to_arabic").click(function(){
            $("#ar-content").show();
            $("#en-content").hide();
            $("#ar-all-job").show();
            $("#en-all-job").hide();
        });
        $(".translate_to_english").click(function(){
            $("#ar-content").hide();
            $("#en-content").show();
            $("#ar-all-job").hide();
            $("#en-all-job").show();
        });
        $('.shareToggle').click(function(){
            $('.socialShare').toggle('slow')
        });
    });

    </script>
    <script>
    @if(app()->getLocale() != 'en')                           
        window.location.replace("{{LaravelLocalization::getLocalizedURL('en')}}");
    @endif

    $("#ar-apply-button").on('click',(e)=>{
        var url=$('#ar-apply-button').attr('href');
        e.preventDefault();
        console.log(url);
        swal("يرجى العلم بأن عملية تقديم طلبات الوظائف يتطلب استكمالها في اللغة الإنجليزية").then((ok)=>{
            if(ok){
                window.location.href=url;

            }
        });

    });
    $(function () {
        $("form.generalCv_form").validate();
       
        $('form.generalCv_form').submit(function(e){
            $("#g-recaptcha-response-msg1").text('');

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
    });
    // $(function () {
    //     $("form.alert_job_form").validate();
       
    //     $('form.alert_job_form').submit(function(e){
    //         $("#g-recaptcha-response-msg").text('');

    //        var index=1;
    //        var isError = false;
    //         $(this).find('input[required], select[required], textarea[required]').each(function(){
              
    //             if (!$(this).valid()){
    //                 if(index==1){
    //                     index++;
    //                     $(this).focus();
    //                 }
    //                 $(this).css("border-color", "red");
    //                 // if($(this).attr('name')=='g-recaptcha-response'){
    //                 //     $("#g-recaptcha-response-msg1").text('This field is required.');
    //                 // }
    //                 isError= true;
    //             }else{
    //                 $(this).css("border-color", "green");
    //             }
    //         });
    //         if(isError){
    //             e.preventDefault();   
    //             $("label[for='g-recaptcha-response']").show();
              
    //         }else{           
    //             $('#loader').show();
    //         }
                     
    //     });
    // });
</script>
@endsection