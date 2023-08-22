@php
    $start_date=\Carbon\Carbon::createFromFormat('Y-m-d', $course->start_date);
    $end_date=\Carbon\Carbon::createFromFormat('Y-m-d', $course->end_date);
    $course_duration=$start_date->diffInDays($end_date);
@endphp

@extends('layouts.index')


@section('meta_tags')
    {!! Meta::toHtml() !!} 
@endsection

@section('content')
<section class="courseContent pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 py-4" id="ar-all-job" style="display:none">
                <a class="back_to_site" href="{{route('courses.list')}}">{{__('الدورات التدريبية')}}</a>
            </div>
            <div class="col-md-12 py-4" id="en-all-job">
                <a class="back_to_site" href="{{route('courses.list')}}">{{__('All Courses')}}</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12"  id="en-content">
                <div class="course_des_wrapper">
                    <div class="courseHeader">                        
                        <div class="leftBlock">
                            <h2>
                                {{$course->title}}
                            </h2>
                            <ul class="courselisting">
                            @if($course->category)
                                <li>
                                    <i class="course_icon">
                                        <img src="{{asset('public/website/images/course-category.svg')}}">
                                    </i>
                                    <span>
                                       {{$course->category}}
                                    </span>
                                </li>
                                @endif
                                @if($course->location)

                                <li>
                                    <i class="course_icon">
                                        <img style="max-height:26px;" src="{{asset('public/website/images/marker.svg')}}">
                                    </i>
                                    <span>                                      
                                        {!!$course->location!!}
                                    </span>
                                </li>
                                @endif
                                <li>
                                    <i class="course_icon">
                                        <img src="{{asset('public/website/images/calander-icon.svg')}}">
                                    </i>
                                    <span title="Closing Date">                                               
                                    {{\Carbon\Carbon::createFromFormat('Y-m-d', $course->start_date)->format('d-m-Y') }} to  {{\Carbon\Carbon::createFromFormat('Y-m-d', $course->end_date)->format('d-m-Y') }}
                                    </span>
                                </li>                                
                            </ul>
                            <ul class="txt_lisitng">
                                <!-- <li>
                                    <label>Start Date</label>
                                    <span>                                      
                                    {{\Carbon\Carbon::createFromFormat('Y-m-d', $course->start_date)->format('d-m-Y') }}
                                    </span>
                                </li>
                                <li>
                                    <label>End Date</label>
                                    <span>                                      
                                    {{\Carbon\Carbon::createFromFormat('Y-m-d', $course->end_date)->format('d-m-Y') }}
                                    </span>
                                </li> -->
                                @if($course_duration)
                                <li>
                                    <label>{{__('Course Duration')}}</label>
                                    <span>{{$course_duration." days"}}</span> 
                                </li>
                                @endif
                                @if($course->type)
                                <li>
                                    <label>{{__('Course Type')}}</label>
                                    <span>{{$course->type}}</span>
                                </li>
                                @endif
                               

                                <li>
                                    <label>{{__('Course Fee')}}</label>
                                    <span> @if($course->fee_type=='AED') {{$course->course_fee}} {{__('AED')}} @else {{$course->fee_type}}  @endif</span>
                                </li>
                                
                                <li>
                                    <label>Reservation Closing Date</label>
                                    <span>{{\Carbon\Carbon::createFromFormat('Y-m-d', $course->closing_date)->format('d-m-Y') }}</span>
                                </li>
                                @if($course->link)
                                <li>
                                    <label>Link</label>
                                    <span><a href="{{$course->link }}" target="_blank">Open Link</a></span>
                                </li>
                                @endif
                            </ul>
                        </div>
                        <div class="rightBlock"> 
                            <div class="courseAction">
                                @if(!$course->bi_lang)
                                    <button type="button" class="default_btn translate_to_arabic">ترجمة إلى العربية</button>
                                @endif
                                <!-- <a class="actionlink" href="#"><i class="fas fa-bookmark"></i></a> -->
                                <a class="actionlink shareToggle" href="javascript:void(0)"><i class="fas fa-share-alt"></i></a>
                                <div class="socialShare" style="display:none;">
                            <ul class="share_options">
                                    <li><a href="https://twitter.com/share?url={{Request::url()}}&text=check out this course at National Ambulance: {{$course->title}}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Twitter"><img src="{{asset('public/website/images/twitter-circled.svg')}}"  alt="Twitter"></a></li>
                                <li><a href="https://www.facebook.com/sharer/sharer.php?u={{Request::url()}}&t=check out this course at National Ambulance: {{$course->title}}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Facebook"><img src="{{asset('public/website/images/facebook-circled.svg')}}"  alt="Facebook"></a></li>
                                <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{Request::url()}}&t=check out this course at National Ambulance: {{$course->title}}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Linkedin"><img src="{{asset('public/website/images/linkedin-circled.svg')}}"  alt="Linkedin"></a></li>
                                
                                <li><a href="whatsapp://send?text=check out this course at National Ambulance : {{Request::url()}}" data-action="share/whatsapp/share" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on whatsapp"><img src="{{asset('public/website/images/whatsapp.svg')}}"  alt="Whatsapp"></a></li>
                                <li><a href="mailto:?subject=check out this course at National Ambulance: {{$course->title}}&body={{Request::url()}}" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Mail"><img style="margin-top:3px;"width="40px" height="40px" src="{{asset('public/website/images/envelop-circled.svg')}}"  alt="Email"></a></li>                  
                                <li><a href="javascript:void(0); " onclick="window.print()"><img style="margin-top:8px;" width="40px" height="40px" src="{{asset('public/website/images/printer.svg')}}"  alt="Print"></a></li>
                            </ul>
                                </div>                                
                            </div>
                            <div class="logoColumn">            
                            <div class="courseImage">
                                                <img src="{{asset($course->logo)}}"
                             alt="National Ambulance">
                                            </div>             
                                <!-- <h4>RNA1631016070</h4> -->
                            </div>
                        </div>
                    </div>
                    <div class="course_summary">
                    @if($course->description) 

                        <h3>{{__('About the Course')}} </h3>
                            {!!$course->description!!}     

                            @endif
                            @if($course->who_should_take_course) 
                        <h3>{{__('Who can take the course?')}} </h3>
                            {!!$course->who_should_take_course!!}
                            @endif
                            @if($course->certification)
                        <h3>{{__('Certification')}} </h3>
                           {!!$course->certification!!}
                           @endif
                        @if($course->note)
                            <h3>{{__('Note :')}} </h3>    
                                {!!$course->note!!}
                        @endif
                        <p class="mt-4"><a class="default_btn navyblue_btn" href="{{route('course.apply.form',$course->id)}}">{{__('Request Reservation')}}</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-12"  dir="rtl"   style="display:none" id="ar-content">
                <div class="course_des_wrapper">
                    <div class="courseHeader">                        
                        <div class="leftBlock">
                            <h2>
                                {{$course->title_ar}}
                            </h2>
                            <ul class="courselisting">
                            @if($course->category_ar)
                                <li>
                                    <i class="course_icon">
                                        <img src="{{asset('public/website/images/course-category.svg')}}">
                                    </i>
                                    <span>
                                       {{$course->category_ar}}
                                    </span>
                                </li>
                                @endif
                                @if($course->location_ar)
                                <li>
                                    <i class="course_icon">
                                        <img src="{{asset('public/website/images/marker.svg')}}">
                                    </i>
                                    <span>                                      
                                        {!!$course->location_ar!!}
                                    </span>
                                </li>
                                @endif
                                <li>
                                    <i class="course_icon">
                                        <img src="{{asset('public/website/images/calander-icon.svg')}}">
                                    </i>
                                    <span title="Closing Date">                                               
                                    {{\Carbon\Carbon::createFromFormat('Y-m-d', $course->start_date)->format('d-m-Y') }} إلى  {{\Carbon\Carbon::createFromFormat('Y-m-d', $course->end_date)->format('d-m-Y') }}
                                    </span>
                                </li>
                                <!-- <li>
                                    <i class="course_icon">
                                        <img src="{{asset('public/website/images/course-calander.png')}}">
                                    </i>
                                    <span title="Closing Date">                                               
                                    {{\Carbon\Carbon::createFromFormat('Y-m-d', $course->closing_date)->format('d-m-Y') }}
                                    </span>
                                </li> -->
                            </ul>
                            <ul class="txt_lisitng">
                                <!-- <li>
                                    <label>Start Date</label>
                                    <span>                                      
                                    {{\Carbon\Carbon::createFromFormat('Y-m-d', $course->start_date)->format('d-m-Y') }}
                                    </span>
                                </li>
                                <li>
                                    <label>End Date</label>
                                    <span>                                      
                                    {{\Carbon\Carbon::createFromFormat('Y-m-d', $course->end_date)->format('d-m-Y') }}
                                    </span>
                                </li> -->
                                @if($course_duration)

                                <li>
                                    <label>مدة الدورة</label>
                                    <span>{{$course_duration}} {{__('أيام')}}</span>
                                </li>
                                @endif
                                @if($course->type_ar)

                                <li>
                                    <label>طريقة التعليم</label>
                                    <span>{{$course->type_ar}}</span>
                                </li>
                                @endif
                                <li>
                                    <label>رسوم الدورة</label>                              
                                    <span> @if($course->fee_type=='AED') {{$course->course_fee}} {{__('AED')}} @else {{__("برامج المسؤولية المجتمعية (لا توجد رسوم)")}}  @endif</span>
                                </li>
                                @if($course->closing_date)

                                <li>
                                    <label>موعد اغلاق طلبات التسجيل</label>
                                    <span>{{\Carbon\Carbon::createFromFormat('Y-m-d', $course->closing_date)->format('d-m-Y') }}</span>
                                </li>
                                @endif
                                @if($course->link)
                                <li>
                                    <label>Link</label>
                                    <span><a href="{{$course->link }}" target="_blank">Open Link</a></span>
                                </li>
                                @endif
                            </ul> 
                            
                        </div>
                        <div class="rightBlock">
                            <div class="courseAction">
                            <button type="button" class="default_btn translate_to_english">Back to English</button>
                                <!-- <a class="actionlink" href="#"><i class="fas fa-bookmark"></i></a> -->
                                <a class="actionlink shareToggle" href="javascript:void(0)"><i class="fas fa-share-alt"></i></a>
                                <div class="socialShare" style="display:none;">
                                    <ul class="share_options">
                                    <li><a href="https://twitter.com/share?url={{Request::url()}}&text=دورة تدريبية لدى الإسعاف الوطني : {{$course->title}}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Twitter"><img src="{{asset('public/website/images/twitter-circled.svg')}}"  alt="Twitter"></a></li>
                                <li><a href="https://www.facebook.com/sharer/sharer.php?u={{Request::url()}}&t=دورة تدريبية لدى الإسعاف الوطني : {{$course->title}}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Facebook"><img src="{{asset('public/website/images/facebook-circled.svg')}}"  alt="Facebook"></a></li>
                                <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{Request::url()}}&t=دورة تدريبية لدى الإسعاف الوطني : {{$course->title}}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Linkedin"><img src="{{asset('public/website/images/linkedin-circled.svg')}}"  alt="Linkedin"></a></li>
                                
                                <li><a href="whatsapp://send?text=دورة تدريبية لدى الإسعاف الوطني  : {{Request::url()}}" data-action="share/whatsapp/share" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on whatsapp"><img src="{{asset('public/website/images/whatsapp.svg')}}"  alt="Whatsapp"></a></li>
                                <li><a href="mailto:?subject=دورة تدريبية لدى الإسعاف الوطني : {{$course->title}}&body={{Request::url()}}" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Mail"><img style="margin-top:3px;"width="40px" height="40px" src="{{asset('public/website/images/envelop-circled.svg')}}"  alt="Email"></a></li>                  
                                <li><a href="javascript:void(0); " onclick="window.print()"><img style="margin-top:8px;" width="40px" height="40px" src="{{asset('public/website/images/printer.svg')}}"  alt="Print"></a></li>
                             </ul>
                                </div>                                
                            </div>
                            <div class="logoColumn">            
                            <div class="courseImage">
                                <img src="{{asset($course->logo)}}" alt="National Ambulance">
                            </div>             
                                <!-- <h4>RNA1631016070</h4> -->
                            </div>
                        </div>
                    </div>
                    <div class="course_summary">
                    @if($course->description_ar)

                        <h3>عن الدورة</h3>
                            {!!$course->description_ar!!}  
                    @endif
                            @if($course->who_should_take_course_ar)

                        <h3>من يمكنه التسجيل في هذه الدورة؟</h3>
                            {!!$course->who_should_take_course_ar!!}
                            @endif
                            @if($course->certification_ar)
                        <h3>الشهادة</h3>
                            {!!$course->certification_ar!!}
                            @endif
                        @if($course->note_ar)
                            <h3>ملاحظة</h3>    
                                {!!$course->note_ar!!}
                        @endif
                        <p class="mt-4"><a class="default_btn navyblue_btn" href="{{route('course.apply.form',$course->id)}}">قدم طلب تسجيل</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
              
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<script>
    $(document).ready(function(){
       
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
</script>

@endsection