@extends('layouts.index')

@section('content')

    {{--    <!-- Content Header (Page header) Banner -->--}}
    {{--    <section class="pageBanner" style="background-image: url({{asset('public/website/images/about-us-banner.jpg')}})">--}}
    {{--        <div class="pageHeading">--}}
    {{--            <div class="container">--}}
    {{--                <div class="row">--}}
    {{--                    <div class="col-md-12">--}}
    {{--                        <h1>Our Services</h1>--}}
    {{--                        <span class="subTitle">National Ambulance</span>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}
    {{--    <!--Banner end-->--}}

    {{--    <!-- Intro -->--}}
    {{--    <section class="serviceContent section_padding">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row">--}}
    {{--                <div class="section_title col-md-7">--}}
    {{--                    <h2>Why Choose Us</h2>--}}
    {{--                    <div class="headingLine"></div>--}}
    {{--                    <p class="mt-4">Our specialised and highly trained teams of Doctors, Paramedics and Emergency--}}
    {{--                        Medical Technicians (EMTs) provide different levels of emergency pre-hospital care from basic--}}
    {{--                        life support (BLS) to advanced life support (ALS) through a variety of emergency care solutions--}}
    {{--                        and services tailored to clients’ needs and consistent with local regulations and international--}}
    {{--                        best practice.</p>--}}
    {{--                    <p>In addition, National Ambulance is an internationally recognised Training Centre, accredited by--}}
    {{--                        the American Health Association (AHA), the National Association of Emergency Medical--}}
    {{--                        Technicians.</p>--}}
    {{--                </div>--}}
    {{--                <div class="col-md-5 text-center">--}}
    {{--                    <img src="{{asset('public/website/images/services-care-level.jpg')}}">--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}
    {{--    <!--Intro end-->--}}

    <!--Introduction start-->
    {{$data->intro}}
    <!--Introduction end-->

    <!-- Services start-->
    <section class="our_services">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mb-5">
                    <h2>What We Offer</h2>
                    <div class="headingLine mx-auto"></div>
                </div>
                <div class="row serviceList">
                    @foreach($services as $service)
                        <div class="col-md-3">
                            <div class="serviceImage hoverEffect">
                                <img class="imgHover"
                                     src="{{isset($service->image)?url('public/uploads/cms/'.$service->image):'http://na.bw.ae/national-ambulance/public/uploads/service/7447.jpg'}}"
                                     alt="Public and Private Emergency Medical Services (EMS)">
                            </div>
                            <div class="serviceInfo">
                                <h3>{{$service->title}}</h3>
                                <p class="text-truncate">{{strip_tags($service->description)}}</p>
                                <a class="learnMore" href="{{url('/page/'.$service->slug)}}">Learn More</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!--Services end-->

    <!--Conclusion start-->
    {{$data->concl}}
    <!--Conclusion end-->

    {{--    <!-- Certificates -->--}}
    {{--    <section class="projects section_padding">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row mt-4">--}}
    {{--                <div class="col-md-7 mx-auto">--}}
    {{--                    <h6 class="text-center">(NAEMT) and the American Health and Safety Institute (ASHI). As part of this--}}
    {{--                        we offer a wide range of educational and training courses that fall under community programmes,--}}
    {{--                        international accreditations, EMS Education and EMS projects.</h6>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-md-12">--}}
    {{--                    <ul class="traningLogo">--}}
    {{--                        <li><img src="{{asset('public/website/images/ATC.jpg')}}"></li>--}}
    {{--                        <li><img src="{{asset('public/website/images/ASHI.jpg')}}"></li>--}}
    {{--                        <li><img src="{{asset('public/website/images/NAEMT.jpg')}}"></li>--}}
    {{--                        <li><img src="{{asset('public/website/images/NREMT.jpg')}}"></li>--}}
    {{--                    </ul>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}
    {{--    <!--Certificates end-->--}}

    {{--    <!--Conclusion end-->--}}
    {{--    <section class="service_iconWrapper section_padding">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-md-12 text-center mb-5">--}}
    {{--                    <h2>Why you should choose National Ambulance?</h2>--}}
    {{--                    <div class="headingLine mx-auto"></div>--}}
    {{--                </div>--}}
    {{--                <div class="col-md-4">--}}
    {{--                    <div class="scBox">--}}
    {{--                        <i class="sricon"><img src="{{asset('public/website/images/experience.svg')}}"></i>--}}
    {{--                        <p>Proven experience in delivering reliable emergency medical services in the UAE since 2010 and--}}
    {{--                            in covering high profile global events</p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-md-4">--}}
    {{--                    <div class="scBox">--}}
    {{--                        <i class="sricon"><img src="{{asset('public/website/images/ambulance-blue.svg')}}"></i>--}}
    {{--                        <p>A modern fleet of fully equipped ambulances consistent with international standard</p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-md-4">--}}
    {{--                    <div class="scBox">--}}
    {{--                        <i class="sricon"><img src="{{asset('public/website/images/qualified.svg')}}"></i>--}}
    {{--                        <p>Highly experienced, qualified and professional personnel</p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-md-4">--}}
    {{--                    <div class="scBox">--}}
    {{--                        <i class="sricon"><img src="{{asset('public/website/images/ecg.svg')}}"></i>--}}
    {{--                        <p>Utilising latest EMS communication technologies and emergency medical equipment</p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-md-4">--}}
    {{--                    <div class="scBox">--}}
    {{--                        <i class="sricon"><img src="{{asset('public/website/images/education-training.svg')}}"></i>--}}
    {{--                        <p>Internationally recognised training centre accredited by AHA and NAEM</p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-md-4">--}}
    {{--                    <div class="scBox">--}}
    {{--                        <i class="sricon"><img src="{{asset('public/website/images/certified.svg')}}"></i>--}}
    {{--                        <p>Accredited by Joint Commission International (JCI) and certified according to ISO 9001, ISO--}}
    {{--                            14001 and ISO 45001 standards</p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-md-4">--}}
    {{--                    <div class="scBox">--}}
    {{--                        <i class="sricon"><img src="{{asset('public/website/images/approach.svg')}}"></i>--}}
    {{--                        <p>Applying a quality approach that adheres to strict protocols in clinical governance, complies--}}
    {{--                            with local legislations and regulations, adopts international standards and undertakes--}}
    {{--                            regular audits to continually improve our service</p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}

    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}
    {{--    <!--Conclusion end-->--}}

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