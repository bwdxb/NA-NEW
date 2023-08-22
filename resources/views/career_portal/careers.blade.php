@extends('layouts.career-portal.app')

@section('meta_tags')
    {!! Meta::toHtml() !!} 
   <meta property="og:description" content="Our Careers portal offers information about the opportunities available at National Ambulance  " />
  <meta property="og:title" content="Careers-National Ambulance" />
  <meta name="image" property="og:image" content="{{url('/public/Image/200x200.jpg')}}">
@endsection
@section('content')


    <section class="careerpage_video">
        <video width="100%" height="100%" autoplay muted loop playsinline>
            <source src="{{asset('public/career_portal/videos/homepage-video.mp4')}}" type="video/mp4"/>
        </video>
        <div class="video_caption">
            <div class="container">
                <div class="row">
                @if(app()->getLocale() == 'en')
                    {!!$data->intro!!}
                        @else
                    {!!$data->intro_ar!!}
                @endif
                </div>
            </div>
        </div>
    </section>
    <a style="display:none;" href="{{LaravelLocalization::localizeUrl('/career-portal/user/vacancy')}}">career</a>
    <!--video end-->

    @if(app()->getLocale() == 'en')
        {!!$data->concl!!}
    @else
        {!!$data->concl_ar!!}
    @endif
   
@endsection

@section('script')

@endsection  