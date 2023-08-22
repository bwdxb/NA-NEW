@php
use app\Http\helper\Helper as Helper;
$services = Helper::services($page->slug);
$testimonials = Helper::testimonialsByCat($page->slug);
@endphp

@if($testimonials&&(count($testimonials)>0))
<div class="testimonials">
    <div class="row">
        <div class="col-md-12 text-center mb-5">
            <h2>{{__('What Clients Say')}}</h2>
            <div class="headingLine mx-auto"></div>
        </div>
    </div>
    <div class="testimonialSlider">
        @foreach($testimonials as $testimony)
                <div class="testimonials_item">
                    <div class="client_info">
                        <h4>{{$testimony->client_name}}</h4>
                        <span class="desgnation">{{$testimony->title}}</span>
                        <p>“{{$testimony->testimonial}}”</p>
                    </div>
                </div>
        @endforeach
    </div>
</div>
@endif
<!-- Services start-->
<section class="our_services">
    <div class="container p-0">
        <div class="row">
            <div class="col-md-12 text-center mb-5">
                <h2>{{__('Other Services')}}</h2>
                <div class="headingLine mx-auto"></div>
            </div>
            <div class="row serviceList m-0 p-0">
                @foreach($services as $service)
                <div class="col-sm-6 col-lg-4 mb-4">
                    <div class="serviceImage hoverEffect">
                        <img class="imgHover" src="{{ isset($service->banner)?url('/public/uploads/cms/'.$service->banner):(isset($service->image)?url('/public/uploads/cms/'.$service->image):env('APP_URL').'public/uploads/service/7447.jpg' )}}" alt="{{__('Public and Private Emergency Medical Services (EMS)')}}">
                    </div>
                    <div class="serviceInfo">
                        @if(app()->getLocale() == 'en')
                        <h3>{{__($service->title)}}</h3>
                        <p class="text-truncate">{{ strip_tags($service->description) }}</p>
                        @else
                        <h3>{{__($service->title_ar)}}</h3>
                        <p class="text-truncate">{{ strip_tags($service->description_ar) }}</p>
                        @endif
                        <a class="learnMore" href="{{ url('/page/'.$service->slug) }}">{{__('Learn More')}}</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!--Services end-->