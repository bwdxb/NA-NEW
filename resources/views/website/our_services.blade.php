@extends('layouts.index')
@section('meta_tags')
		{!! Meta::toHtml() !!}
@endsection

@section('content')
<!-- Content Header (Page header) Banner -->
<section class="pageBanner"
style="background-image: url({{ isset($data->banner)?url('public/uploads/service/'.$data->banner):url('public/website/images/about-us-banner.jpg') }})">
<div class="pageHeading">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{__('OUR SERVICES')}}</h1>
                <span class="subTitle">{{__('National Ambulance')}}</span>
            </div>
        </div>
    </div>
</div>
</section>
<!--Banner end-->
<!--Introduction start-->
@if(app()->getLocale() == 'en')
    {!!$data->intro!!}
@else
    {!!$data->intro_ar!!}
@endif
<!--Introduction end-->

<!-- Services start-->
<section class="our_services">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mb-5">
                <h2>{{__('What We Offer')}}</h2>
                <div class="headingLine mx-auto"></div>
            </div>
            <div class="row serviceList m-0 p-0">
                @foreach($services as $service)
                <div class="col-xs-12 col-sm-6 col-lg-3">
                    <div class="serviceImage hoverEffect">
                        <img class="imgHover"
                        src="{{ isset($service->banner)?url('/public/uploads/cms/'.$service->banner):(isset($service->image)?url('/public/uploads/cms/'.$service->image):env('APP_URL').'/public/uploads/service/7447.jpg' )}}"
                        alt="{{__('Public and Private Emergency Medical Services (EMS)')}}">
                    </div>
                    <div class="serviceInfo">
                        <h3>
                            @if(app()->getLocale() == 'en')
                            {{$service->title}}
                            @else
                            {{$service->title_ar}}
                            @endif
                        </h3>
                        <p class="text-truncate">
                            @if(app()->getLocale() == 'en')
                            {{ strip_tags($service->description) }}
                            @else
                            {{ strip_tags($service->description_ar) }}
                            @endif
                            
                        </p>
                        <a class="learnMore"
                        href="{{ url('/page/'.$service->slug) }}">{{__('Learn More')}}</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!--Services end-->

<!--Conclusion start-->
@if(app()->getLocale() == 'en')
{!!$data->concl!!}
@else
{!!$data->concl_ar!!}
@endif

<!--Conclusion end-->

@endsection
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    function btnRefresh() {
        $.ajax({
            type: 'GET',
            url: public_url + '/refresh_captcha',
            success: function (data) {

                $(".captcha span").html(data.captcha);

            }

        });

    }
</script>

@section('script')

@endsection