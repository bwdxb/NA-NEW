
@extends('layouts.index')


@section('meta_tags')
    {!! Meta::toHtml() !!} 
   <!-- <meta property="og:description" content="Our Careers portal offers information about the opportunities available at National Ambulance  " />
  <meta property="og:title" content="Careers-National Ambulance" /> -->
  <meta name="image" property="og:image" content="{{url('/public/Image/200x200.jpg')}}">
@endsection

@section('content')
<!--Page Banner start-->
<section class="page_banner"
style="background-image: url({{ url('public/website/images/course-banner.jpg') }})">
<div class="course_caption">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>Explore Courses at National Ambulance</h1>
                </div>
                <form action="" method="get">
                <div class="col-md-12">
                    <div class="filterWrapper">
                        <div class="coursefield">
                            <input type="text"  autocomplete="off" id="search_key" class="form-control" placeholder="Search by keywords" value="{{Request::get('search_key')}}" name="search_key">
                            <button class="searchBtn"></button>
                        </div>
                        <div class="coursefield">
                            <div id="categoryList"></div> 
                            <select name="category" id="category" class="form-control"  >
                                                            <option value="">Course Category</option>
                  <option value="National Association of Emergency Medical Technicians (NAEMT)" @if(Request::get('category')=='National Association of Emergency Medical Technicians (NAEMT)') selected @endif>National Association of Emergency Medical Technicians (NAEMT)</option>
                  <option value="American Heart Association (AHA)"  @if(Request::get('category')=='American Heart Association (AHA)') selected @endif>American Heart Association (AHA)</option>
                  <option value="American Health and Safety Institute (ASHI)"  @if(Request::get('category')=='American Health and Safety Institute (ASHI)') selected @endif>American Health and Safety Institute (ASHI)</option>
                  <option value="Emergency Medical Services (EMS)"  @if(Request::get('category')=='Emergency Medical Services (EMS)') selected @endif>Emergency Medical Services (EMS)</option>
                  <option value="Community Outreach Programmes (CSR)"  @if(Request::get('category')=='Community Outreach Programmes (CSR)') selected @endif>Community Outreach Programmes (CSR)</option>
                </select>
                        </div>
                        <div class="coursefield">
                        <select name="sort" id="sort" class="form-control" required >
                    <option value="Earliest" @if(Request::get('sort')=='Earliest') selected @endif>Earliest</option>
                    <option value="Latest" @if(Request::get('sort')=='Latest') selected @endif>Latest</option>
                   
                 </select>
                        </div>
                        <div class="courseBtn">
                            <button type="submit" class="default_btn navyblue_btn">Find Course</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</section>
<!--Page Banner end-->

<section class="courseWrapper section_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mb-4">
                <h2>Find the right course for you!</h2>
                <p class="available_course">{{count($courses)}} courses available</p>
            </div>

            <div class="col-lg-12">
            
                @foreach($courses as $course)         
                   
                <div class="courseItem">
                    <div class="courseImage">
                                                <img src="{{asset($course->logo)}}"
                             alt="National Ambulance">
                                            </div>
                    <div class="courseDescription">
                        <h3 class="courseTitle">
                         {{$course->title}}                                                
                        </h3>
                        <div class="courseInfo">
                            <ul class="courselisting">
                                <li>
                                    <i class="course_icon">
                                        <img src="{{asset('public/website/images/course-category.svg')}}">
                                    </i>
                                    <span>                                      
                                      {{$course->category}}
                                    </span>
                                </li>
                                <li>
                                    <i class="course_icon">
                                        <img src="{{asset('public/website/images/calander-icon.svg')}}">
                                    </i>
                                   
                                    <span>{{\Carbon\Carbon::createFromFormat('Y-m-d', $course->start_date)->format('d-m-Y') }} to {{\Carbon\Carbon::createFromFormat('Y-m-d', $course->end_date)->format('d-m-Y') }}</span>
                                </li>

                                <li>
                                    <i class="course_icon">
                                        <img style="max-height:26px;" src="{{asset('public/website/images/marker.svg')}}">
                                    </i>
                                    <span>                                      
                                        {!!$course->location!!}
                                    </span>
                                </li>                                
                                
                                <!-- <li>
                                    <i class="course_icon">
                                        <img src="{{asset('public/website/images/course-calander-icon.png')}}">
                                    </i>
                                    <span>Start Date:{{\Carbon\Carbon::createFromFormat('Y-m-d', $course->start_date)->format('d-m-Y') }}</span>
                                </li>
                                <li>
                                    <i class="course_icon">
                                        <img src="{{asset('public/website/images/course-calander.png')}}">
                                    </i>
                                    <span>End Date:{{\Carbon\Carbon::createFromFormat('Y-m-d', $course->end_date)->format('d-m-Y') }}</span>
                                </li> -->
                                <li>
                                    <i class="course_icon">
                                        @if($course->type=="Classroom")
                                          <img src="{{asset('public/website/images/classroom.svg')}}"/>
                                        @elseif($course->type=="Virtual")
                                          <img src="{{asset('public/website/images/virtual.svg')}}"/>
                                        @elseif($course->type=="Blended")
                                          <img src="{{asset('public/website/images/blended.svg')}}"/>
                                        @endif
                                    </i>
                                    <span>{{$course->type}}</span>
                                </li>                                
                                <li>
                                    <i class="course_icon">
                                        <img src="{{asset('public/website/images/calander-icon.svg')}}">
                                    </i>
                                    <span>Reservation Closing Date:  {{\Carbon\Carbon::createFromFormat('Y-m-d', $course->closing_date)->format('d-m-Y') }}</span>
                                </li>
                                
                            </ul>
                            @if($course->course_status)
                                <a class="default_btn primary_btn" onclick="alert('Sorry. No seats are avilable!')">Closed</a>
                            @else
                                <a class="default_btn primary_btn" href="{{route('courses.detail',$course->id)}}">Request Reservation</a>
                            @endif
                        </div>
                    </div>
                    <span class="course_save"></span>
                </div>  
                
                @endforeach
               
            </div>
            <div class="col-lg-3 col-md-4">
                
            </div>
            
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    @if(app()->getLocale() != 'en')                           
        window.location.replace("{{LaravelLocalization::getLocalizedURL('en')}}");
    @endif
</script>

@endsection