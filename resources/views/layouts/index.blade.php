@php
use app\Http\helper\Helper as Helper;
        $launchConfigData = Helper::getLaunchConfig();
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    @if(app()->getLocale() == 'en')

    <meta name="base_url" content="{{ LaravelLocalization::localizeUrl('/') }}">
    @else

    <meta name="base_url" content="{{ LaravelLocalization::localizeUrl('/') }}">
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="icon" 
  type="image/jpg" 
  href="{{url('/public/Image/200x200.jpg')}}">
        @yield('meta_tags')
        <meta name="image" property="og:image" content="{{url('/public/Image/200x200.jpg')}}?2">
        <meta property="og:image:url" content="{{url('/public/Image/200x200.jpg')}}?2" />
        <meta property="og:site_name" content="{{env('SITE_URL', 'National Ambulance')}}" />
        <meta name="format-detection" content="telephone=yes">
        <base href="{{Request::server('HTTP_HOST')}}" hello/>

        <title>{{__('National Ambulance')}}</title>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-VX2XZS26QV"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-VX2XZS26QV');
    </script>
    <link rel="stylesheet" href="{{asset('public/website/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/website/css/style.css')}}" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.css"/>
    @if(app()->getLocale() == 'en')
    <link rel="stylesheet" href="{{asset('public/website/css/en.css')}}">
    @else
    <link rel="stylesheet" href="{{asset('public/website/css/ar.css')}}">
    <meta property="og:locale" content="es_AR" />

    @endif

    <link rel="stylesheet" href="{{ asset('public/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/website/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/website/css/jquery-ui.css')}}">
    @if(app()->getLocale() == 'en')
    
    <script src='https://www.google.com/recaptcha/api.js?hl=en' defer></script>
    @else
    <script src='https://www.google.com/recaptcha/api.js?hl=ar' defer></script>

    @endif
</head>
<body id='firework' class="@if(Request::segment(2) == 'index'||Request::segment(2) == '' || Request::segment(2) == 'launch') {{'no-pding'}} @endif" style="visibility:hidden;">
<div id="loader" class="center"></div>
<div id="progress" class="center" style="background-color: #00000075;background-size:60px auto;display:none;background-image:url('http://cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.16.1/images/loader-large.gif')"></div>


    <!--header-->
    <header class="header @if(Request::segment(2) == 'index'||Request::segment(2) == ''||Request::segment(2) == 'launch') {{'fixedHeader'}} @endif">
        <div class="topNav">
            <div class="container">
                <ul>
                    
                    <li><a class="empPortal" href="{{url('/employee-portal/login')}}">{{__('Employee Portal')}}</a></li>
                    @if(!(in_array(Request::segment(2).'-'.Request::segment(3),['courses-apply','courses-detail','courses-'])))
                        <li class="mobHide" testdata="{{Request::segment(2)}}" >
                            <!--<a class="lang" href="#">العربية</a>-->               
                            @if(app()->getLocale() == 'en')
                                @if(Request::segment(2) == 'news_detail')
                                    <a class="lang" href="/ar/page/news">العربية</a>
                                @else
                                 <a class="lang" href="{{LaravelLocalization::getLocalizedURL('ar')}}">العربية</a>
                                 @endif
                            @else
                                @if(Request::segment(2) == 'news_detail')
                                    <a class="lang" href="/en/page/news">English</a>
                                @else
                                    <a class="lang" href="{{LaravelLocalization::getLocalizedURL('en')}}">English</a>
                                 @endif
                            
                            @endif
                        </li> 
                    @endif 
                </ul>
                <div class="btn-group">
                    <button class="dropdown-toggle" type="button" id="sos_toggle">
                            <img src="{{asset('public/website/images/SOS.svg')}}" alt="{{__('SOS')}}">
                    </button>
                    <ul class="dropdown-menu" id="sos_dropdown">
                        <li><a class="dropdown-item" href="tel:999"><i class="fas fa-phone"></i>{{__('Call 999 Police')}}</a></li>
                        <li><a class="dropdown-item" href="tel:998"><i class="fas fa-phone"></i>{{__('Call 998 Ambulance')}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container justify-content-between">
                <a class="logo" href="{{ url('/index') }}">
                    <img class="whiteLogo" src="{{asset('public/website/images/national-ambulance-logo-white.svg')}}"
                    alt="{{__('National Ambulance')}}">
                    <img class="fixedNav_logo" src="{{asset('public/website/images/national-ambulance-logo-blue.svg')}}"
                    alt="{{__('National Ambulance')}}">
                </a>
                <div class="mobShow">
                    @if(app()->getLocale() == 'en')
                    <a class="lang" href="{{LaravelLocalization::getLocalizedURL('ar')}}">العربية</a>
                            @else
                            <a class="lang" href="{{LaravelLocalization::getLocalizedURL('en')}}">English</a>
                           
                    @endif
                    <div class="topSearch">
                        <button class="mob_searchBtn">
                            <svg id="seacrh_icon" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512">
                            <path class="cls-1"
                            d="M375.73,330.48A206.52,206.52,0,0,0,416,208C416,93.31,322.69,0,208,0S0,93.31,0,208,93.31,416,208,416a206.57,206.57,0,0,0,122.49-40.27L466.75,512,512,466.75ZM208,352c-79.41,0-144-64.59-144-144S128.59,64,208,64s144,64.6,144,144S287.4,352,208,352Z"/>
                        </svg>
                        <svg id="close_icon" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 357 357">
                        <g id="close">
                            <polygon class="cls-1"
                            points="357 35.7 321.3 0 178.5 142.8 35.7 0 0 35.7 142.8 178.5 0 321.3 35.7 357 178.5 214.2 321.3 357 357 321.3 214.2 178.5 357 35.7"/>
                        </g>
                    </svg>
                </button>
            </div>
            <form id="mobSearch" class="toggleSearch" style="display:none;" action="{{route('search')}}">
                <input type="text" name="s" class="form-control " placeholder="{{__('Search here...')}}">
            </form>
            <button class="navbar-toggler">
                <span class="burger_line"></span>
            </button>
        </div>
        @include('layouts.includes.menu')
    </div>
</nav>
</header>
<section id="main-content">
    @yield('content')

</section>
<!--footer--> 
<footer class="footer section_padding">
    <div class="container">
        <div class="row">
            <div class="footerColumn">
                <h3>{{__('Quick Links')}}</h3>
                {{--            <ul class="footerLinks">--}}
                    {{--                <li><a href="/page/who-we-are">About Us</a></li>--}}
                    {{--                <li><a href="/our-services">Services</a></li>--}}
                    {{--                <li><a href="#">Careers</a></li>--}}
                    {{--                <li><a href="/page/news">Newsroom</a></li>--}}
                    {{--                <li><a href="#">Public Awareness</a></li>--}}
                    {{--                <li><a href="/page/supply-chain">Supply Chain</a></li>--}}
                    {{--                <li><a href="#">Request Patient Care Record</a></li>--}}
                    {{--                <li><a href="/contact-us">Contact Us</a></li>--}}
                    {{--                <li><a href="/feedback">Feedback and Complaints</a></li>--}}
                {{--            </ul>--}}
                <ul class="footerLinks">
                    <li><a href="{{LaravelLocalization::localizeUrl('/page/who-we-are')}}">{{__('About Us')}}</a></li>
                    <li><a href="{{LaravelLocalization::localizeUrl('/our-services')}}">{{__('Services')}}</a></li>
                    <li><a href="{{LaravelLocalization::localizeUrl('/career-portal')}}">{{__('Careers')}}</a></li>
                    <li><a href="{{LaravelLocalization::localizeUrl('/page/news')}}">{{__('Newsroom')}}</a></li>
                    <li><a href="javascript:void(0)" style="cursor:text;">{{__('Public Awareness')}}</a></li>
                    <li><a href="{{LaravelLocalization::localizeUrl('/page/supply-chain')}}">{{__('Supply Chain')}}</a></li>
                    <li><a href="{{ route('feedback') }}?type=Request%20Patient%20Care%20Record%20(PCR)#feedbackFormLink">{{__('Request Patient Care Record')}}</a></li>
                    <li><a href="{{LaravelLocalization::localizeUrl('/contact-us')}}">{{__('Contact Us')}}</a></li>
                    <li><a href="{{LaravelLocalization::localizeUrl('/feedback')}}">{{__('Feedback and Complaints')}}</a></li>
                </ul>
            </div>
            <div class="footerColumn">
                <h3>{{__('Explore Links')}}</h3>
                <ul class="footerLinks">
                    <!-- <li><a href="#">{{__('FAQ')}}</a></li> -->
                    <li><a href="{{LaravelLocalization::localizeUrl('/sitemap')}}">{{__('Sitemap')}}</a></li>
                    <li><a href="{{LaravelLocalization::localizeUrl('/page/terms-and-conditions')}}">{{__('Terms and Conditions')}}</a></li>
                    <li><a href="{{LaravelLocalization::localizeUrl('/page/privacy-policy')}}">{{__('Privacy Policy')}}</a></li>
                </ul>
            </div>
            <div class="footerColumn">
                <h3>{{__('Contact Us')}}</h3>
                <a class="linkhover" href="https://goo.gl/maps/ijZ7ZrA7nMTFZ1hGA" target="_blank">
                <address>                
                {{__('National Ambulance Head Office')}}<br>
                    {{__('Al Dar HQ Building, Level 13')}}<br>{{__('2, Al Rahah St')}}<br>
                    {{__('Al Rahah, Abu Dhabi 23035')}}<br>{{__('United Arab Emirates')}}                
                </address>
                </a>
                <a class="footerPhone" href="tel:+971 2 596 8600">{{__('+971 2 596 8600')}}</a>
                @if(app()->getLocale() == 'en')
                <p class="poBox">PO. BOX: 63788, Abu Dhabi, UAE</p>
                @else
                <p class="poBox">ص.ب: 63788، أبو ظبي، دولة الإمارات العربية المتحدة</p>
                @endif
                
                <a class="footerEmail" href="mailto:info@nationalambulance.ae">{{__('info@nationalambulance.ae')}}</a>
            </div>
            <div class="footerColumn">
                <h3>{{__('Working Hours')}}</h3>
                <p><font> {{__('24/7 for Frontline Emergency Service')}}</font> {{__('in the Northern Emirates')}}</p>
                <p class="m-0">{{__('Head Office')}}<br>{{__('Monday to Thursday: 8:00AM - 5:00PM')}}<br>{{__('Friday: 8:00AM - 12:00PM')}}</p>
                <!--@if(app()->getLocale() == 'en')
                <p>8:00 AM - 4:30 PM</p>
                @else
                <p>من الساعة 8:00 صباحا حتى 4:30 مساءً</p>
                @endif-->
                
            </div>
            <div class="footerSocial">
                <a class="facebook wow fadeInUp" href="https://www.facebook.com/NAmbulanceUAE/" target="_blank"
                data-wow-duration="0.5s" data-wow-delay="0s">
                <svg id="Capa_1" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 51.97 96.12">
                    <path d="M72.09,0,59.62,0c-14,0-23,9.28-23,23.66v10.9H24a2,2,0,0,0-2,2V52.33a2,2,0,0,0,2,2H36.57V94.16a2,2,0,0,0,2,2H54.88a2,2,0,0,0,2-2V54.29H71.5a2,2,0,0,0,2-2V36.52a2,2,0,0,0-2-2H56.84V25.32c0-4.45,1.06-6.7,6.85-6.7h8.4a2,2,0,0,0,2-2V2A2,2,0,0,0,72.09,0Z"
                    transform="translate(-22.08)"/>
                </svg>
            </a>
            <a class="twitter wow fadeInUp" href="https://twitter.com/NAmbulanceUAE" target="_blank"
            data-wow-duration="0.5s" data-wow-delay="0.2s">
            <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 13">
                <path d="M16,3.54a6.31,6.31,0,0,1-1.88.51,3.33,3.33,0,0,0,1.44-1.81A6.54,6.54,0,0,1,13.48,3a3.32,3.32,0,0,0-2.4-1A3.28,3.28,0,0,0,7.8,5.28,3.67,3.67,0,0,0,7.88,6,9.32,9.32,0,0,1,1.12,2.6,3.19,3.19,0,0,0,.67,4.25,3.28,3.28,0,0,0,2.13,7,3.42,3.42,0,0,1,.64,6.57v0A3.28,3.28,0,0,0,3.28,9.83a3.58,3.58,0,0,1-.87.12,4.2,4.2,0,0,1-.62-.06,3.3,3.3,0,0,0,3.07,2.28,6.6,6.6,0,0,1-4.08,1.4,6.57,6.57,0,0,1-.78,0A9.3,9.3,0,0,0,5,15a9.27,9.27,0,0,0,9.34-9.34c0-.14,0-.28,0-.42A6.63,6.63,0,0,0,16,3.54Z"
                transform="translate(0 -2)"/>
            </svg>
        </a>
        <a class="linkedin wow fadeInUp" href="https://www.linkedin.com/company/nambulanceuae/" target="_blank"
        data-wow-duration="0.5s" data-wow-delay="0.4s">
        <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 13">
            <path d="M6,6H8.77V7.42h0A3.05,3.05,0,0,1,11.54,6C14.46,6,15,7.82,15,10.18V15H12.11V10.73c0-1,0-2.33-1.5-2.33S8.88,9.51,8.88,10.66V15H6ZM1,6H4v9H1ZM4,3.5A1.5,1.5,0,1,1,2.5,2,1.5,1.5,0,0,1,4,3.5Z"
            transform="translate(-1 -2)"/>
        </svg>
    </a>
    <a class="instagram wow fadeInUp" href="https://www.instagram.com/nambulanceuae/" target="_blank"
    data-wow-duration="0.5s" data-wow-delay="0.6s">
    <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 512 512">
        <path d="M392,512H120A120.13,120.13,0,0,1,0,392V120A120.13,120.13,0,0,1,120,0H392A120.13,120.13,0,0,1,512,120V392A120.13,120.13,0,0,1,392,512ZM120,40a80.09,80.09,0,0,0-80,80V392a80.09,80.09,0,0,0,80,80H392a80.09,80.09,0,0,0,80-80V120a80.09,80.09,0,0,0-80-80ZM397,90a25,25,0,1,0,25,25A25,25,0,0,0,397,90ZM256,386c-71.68,0-130-58.32-130-130,7.14-172.46,252.89-172.41,260,0C386,327.68,327.68,386,256,386Zm0-220a90.11,90.11,0,0,0-90,90c4.94,119.4,175.07,119.36,180,0A90.11,90.11,0,0,0,256,166Z"/>
    </svg>
</a>
<a class="youtube wow fadeInUp" href="https://www.youtube.com/channel/UCK1bOJqu7KWdgDn_7UNMAgA"
target="_blank" data-wow-duration="0.5s" data-wow-delay="0.8s">
<svg xmlns="http://www.w3.org/2000/svg" height="682pt" viewBox="-21 -117 682.66672 682">
    <path d="m626.8125 64.035156c-7.375-27.417968-28.992188-49.03125-56.40625-56.414062-50.082031-13.703125-250.414062-13.703125-250.414062-13.703125s-200.324219 0-250.40625 13.183593c-26.886719 7.375-49.03125 29.519532-56.40625 56.933594-13.179688 50.078125-13.179688 153.933594-13.179688 153.933594s0 104.378906 13.179688 153.933594c7.382812 27.414062 28.992187 49.027344 56.410156 56.410156 50.605468 13.707031 250.410156 13.707031 250.410156 13.707031s200.324219 0 250.40625-13.183593c27.417969-7.378907 49.03125-28.992188 56.414062-56.40625 13.175782-50.082032 13.175782-153.933594 13.175782-153.933594s.527344-104.382813-13.183594-154.460938zm-370.601562 249.878906v-191.890624l166.585937 95.945312zm0 0"/>
</svg>
</a>

</div>
</div>
</div>
<div class="footerBotm">
    <div class="container">
        <div class="row">
            <div class="ISO_logo"><img src="{{asset('public/website/images/ISO-9001.png')}}" alt="ISO-9001"></div>
            <div class="JCI_logo"><a title="The Gold Seal of Approval® is a registered trademark owned by Joint Commission International and is used with permission." href="https://www.jointcommissioninternational.org/" target="_blank"><img src="{{asset('public/website/images/JCI-logo.png')}}" alt="JCI"></a></div>
        </div>
    </div>
</div>
<div class="copyRight">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                @if(app()->getLocale() == 'en')

                <p>Copyright 2023 © National Ambulance. All Rights Reserved</p>

                @else

                <p>حقوق النشر 2023 © الإسعاف الوطني . جميع الحقوق محفوظة</p>

                @endif
            </div>
        </div>
    </div>
</div>
</footer>
<!--/ footer-->
@if($launchConfigData && !($launchConfigData->status))
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap">
<div class="launch_page">
    <h1 id="countdown" style="">Coming Soon...<span style="display:block;text-align:right;direction:rtl;font-family:Almarai, sans-serif;">ينطلق قريبا...</span></h1>
    <div class="strip">
        <div class="strip_border"></div>
    </div>                    
</div>
@endif
        
<!-- /End button popover  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.slick/1.4.1/slick.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

@if(app()->getLocale() == 'en')
<script src="{{asset('public/website/js/custom-en.js')}}"></script>
@else
<script src="{{asset('public/website/js/custom-ar.js')}}"></script> 
@endif
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="{{ asset('public/js/jquery.ajax.js') }}" defer></script>
<script src="{{ asset('public/js/jquery.validate.js') }}" defer></script>

<script src="{{ asset('public/js/validation.js') }}" defer></script>
<script></script>
<script>
    $().ready(function(){
            jQuery.extend(jQuery.validator.messages, {
    required: "{{__('This field is required.')}}",
    remote: "{{__('Please fix this field.')}}",
    email: "{{__('Please enter a valid email address.')}}",
    url: "{{__('Please enter a valid URL.')}}",
    date: "{{__('Please enter a valid date.')}}",
    dateISO: "{{__('Please enter a valid date (ISO).')}}",
    number: "{{__('Please enter a valid number.')}}",
    digits: "{{__('Please enter only digits.')}}",
    creditcard: "{{__('Please enter a valid credit card number.')}}",
    equalTo: "{{__('Please enter the same value again.')}}",
    accept: "{{__('Please enter a value with a valid extension.')}}",
    // maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
    // minlength: jQuery.validator.format("Please enter at least {0} characters."),
    // rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
    // range: jQuery.validator.format("Please enter a value between {0} and {1}."),
    // max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
    // min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
});
});
</script>
<script src="{{ asset('public/website/js/wow.js') }}" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js" async></script>
<script src="{{asset('public/website/js/jquery-ui.min.js')}}" async></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>
<script>

$(window).ready(function(){
    const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const type = urlParams.get('launch');
        if (type==1) {
            console.log(type);
            countdown();
        }
       
});


        function countdown(){

// Set the date we're counting down to
var countDownDate = new Date().getTime()+12*1000;

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("countdown").innerHTML = (days&&(days + "d ")) + (hours&&(hours + "h ")
  )+ (minutes&& (minutes + "m ")) + seconds + "";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("countdown").innerHTML = "Launching...";//EXPIRED
    window.location.href="{{route('launch.launch')}}";
  }
}, 1000);
    }
</script>
<script type="text/javascript">

    var temp="{{env('APP_URL')}}";
    (function ($) {
        $.fn.countTo = function (options) {
            options = options || {};

            return $(this).each(function () {
                // set options for current element
                var settings = $.extend({}, $.fn.countTo.defaults, {
                    from: $(this).data('from'),
                    to: $(this).data('to'),
                    speed: $(this).data('speed'),
                    refreshInterval: $(this).data('refresh-interval'),
                    decimals: $(this).data('decimals')
                }, options);

                // how many times to update the value, and how much to increment the value on each update
                var loops = Math.ceil(settings.speed / settings.refreshInterval),
                increment = (settings.to - settings.from) / loops;

                // references & variables that will change with each update
                var self = this,
                $self = $(this),
                loopCount = 0,
                value = settings.from,
                data = $self.data('countTo') || {};

                $self.data('countTo', data);

                // if an existing interval can be found, clear it first
                if (data.interval) {
                    clearInterval(data.interval);
                }
                data.interval = setInterval(updateTimer, settings.refreshInterval);

                // initialize the element with the starting value
                render(value);

                function updateTimer() {
                    value += increment;
                    loopCount++;

                    render(value);

                    if (typeof (settings.onUpdate) == 'function') {
                        settings.onUpdate.call(self, value);
                    }

                    if (loopCount >= loops) {
                        // remove the interval
                        $self.removeData('countTo');
                        clearInterval(data.interval);
                        value = settings.to;

                        if (typeof (settings.onComplete) == 'function') {
                            settings.onComplete.call(self, value);
                        }
                    }
                }

                function render(value) {
                    var formattedValue = settings.formatter.call(self, value, settings);
                    $self.html(formattedValue);
                }
            });
        };

        $.fn.countTo.defaults = {
            from: 0,               // the number the element should start at
            to: 0,                 // the number the element should end at
            speed: 1000,           // how long it should take to count between the target numbers
            refreshInterval: 100,  // how often the element should be updated
            decimals: 0,           // the number of decimal places to show
            formatter: formatter,  // handler for formatting the value before rendering
            onUpdate: null,        // callback method for every time the element is updated
            onComplete: null       // callback method for when the element finishes updating
        };

        function formatter(value, settings) {
            return value.toFixed(settings.decimals);
        }
    }(jQuery));

    jQuery(function ($) {
        // custom formatting example
        $('.count-number').data('countToOptions', {
            formatter: function (value, options) {
                return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
            }
        });

        // start all the timers
        setTimeout(() => {
            $('.timer').each(count);
        }, 3000);
        function count(options) {
            var $this = $(this);
            options = $.extend({}, options || {}, $this.data('countToOptions') || {});
            $this.countTo(options);
        }
    });
</script>
<script>
    $(window).scroll(function () {
        new WOW().init();
    })
</script>
<script type="text/javascript">
        // $("body").html($("body").html().replace(/http%3a%2f%2fna.bw.ae%2f/g,'https%3a%2f%2fnationalambulance.ae%2'));
    $(document).ready(function () {
        // $(".sl_results_list").html($(".sl_results_list").html().replace('http://na.bw.ae/','https://nationalambulance.ae/'));

    });
    $(document).ready(function () {
       
        $("#feedbackFormLink").click(function () {
            $('html, body').animate({
                scrollTop: $("#feedbackForm").offset().top - 100
            }, 500);
        });

        $("#surveyLink").click(function () {
            $('html, body').animate({
                scrollTop: $("#surveyContent").offset().top - 100
            }, 500);
        });
        $("#FeedbackLink").click(function () {
            $('html, body').animate({
                scrollTop: $("#serviceTab").offset().top - 100
            }, 500);
        });
        $("#headingTwo").click(function () {
            $('html, body').animate({
                scrollTop: $("#collapseTwo").offset().top - 150
            }, 500);
        });
        $("#headingOne").click(function () {
            $('html, body').animate({
                scrollTop: $("#collapseOne").offset().top - 150
            }, 500);
        });
        $('#firstStepButton').click(function(){
            $('html, body').animate({
                scrollTop: $("#step_2").offset().top + 1200   
            }, 500);
        });

        $(function() {
            $('#timepicker1, #timepicker2, #timepicker3, #appointment_time, #return_time').timepicker({
                defaultTime: null
            });
        });

    });
    $( function() {
        $( "#PickUp_date, #Event_endDate, #incident_date, #ReturnDate" ).datepicker({
            dateFormat: "dd-mm-yy",	
            duration: "fast",
            changeMonth: true,
            changeYear: true,
            minDate: "startdate",
        });
        $( "#patient_dob" ).datepicker({
            dateFormat: "dd-mm-yy",
            duration: "fast",
            changeMonth: true,
            changeYear: true,
            maxDate: new Date(),
            // minDate: 0,
            yearRange: '1910:' + new Date().getFullYear().toString()   
        });
        $( "#Event_startDate" ).datepicker({
            dateFormat: "dd-mm-yy",	
            duration: "fast",
            changeMonth: true,
            changeYear: true,
            minDate: "startdate",
            onSelect: function(selected) {
                $("#Event_endDate").datepicker("option","minDate", new Date(moment($(this).val(),'DD-MM-YYYY').format('YYYY-MM-DD')))
                
            }
        });
       
    });
    
    // $('input[required]').on('input propertychange paste change', function() {
    //     var empty = $('.generalForm').find('input[required]').filter(function() {
    //     return this.value == '';
    //     });
    //     $('#firstStepButton').prop('disabled', (empty.length)) 

    // });

</script>
<script>
 @if(session('success'))

 swal("{{session('title_msg')?session('title_msg'):'Success'}}", "{{ session('success') }}", "success").then(function() {
    window.location.href = window.location.href;
});

 @endif
 @if(session('error'))

 swal("Error", "{{ session('error') }}", "error");  
 @endif
//  document.onreadystatechange = function () {
//   var state = document.readyState
//   if (state == 'complete') {
//          document.getElementById('interactive');
//          document.getElementById('load').style.visibility="hidden";
//   }
// }
</script>
<script>
    document.onreadystatechange = function() {
        if (document.readyState !== "complete") {
            document.querySelector(
                "body").style.visibility = "hidden";
            document.querySelector(
                "#loader").style.visibility = "visible";
        } else {
            document.querySelector(
                "#loader").style.display = "none";
            document.querySelector(
                "body").style.visibility = "visible";
        }
    };
    
</script>
<script>
    $('.file-size-limit').on('change', function() {
        var isSizeValid = true;
        console.log(this.files.length);
        // if(this.files.length>1){
            $.each(this.files ,function( index, file ){
                const size = (file.size / 1024 / 1024).toFixed(2);
                // console.log(size);
                if(size>2){
                    isSizeValid=false;
                }
            });
        // }
        if (!isSizeValid) {
            $(this).val(''); 
            alert("File must be less than size 2 MB");
        } 
    });
    $(document).ready(function(){
        $('#homeSlider video').bind('contextmenu',function() { return false; });
    });

    $(document).ready(function () {
      $('.serachSelect').selectize({
          sortField: 'text'
      });
      $('#inputCountry-selectized').attr('name', 'country_id_selectized');
      $('#countryCode-selectized').attr('name', 'country_code_selectized');
      $('#sos_toggle').click( function(e) {        
        e.preventDefault(); // stops link from making page jump to the top
        e.stopPropagation(); // when you click the button, it stops the page from seeing it as clicking the body too
        $('#sos_dropdown').toggle();        
    });    
    $('#sos_dropdown').click( function(e) {        
        e.stopPropagation(); // when you click within the content area, it stops the page from seeing it as clicking the body too        
    });    
    $('body').click( function() {       
        $('#sos_dropdown').hide();        
    });
  });

  @if(app()->getLocale() == 'en')
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        $("#pcr_scroll").attr("href", "/en/feedback?type=Request%20Patient%20Care%20Record%20(PCR)#feedbackForm")
    }    
 @else
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        $("#pcr_scroll").attr("href", "/ar/feedback?type=Request%20Patient%20Care%20Record%20(PCR)#feedbackForm")
    }    
 @endif
 $(document).ready(function(){
    //Event for pushed the video
    $('#homeSlider').carousel({
        interval: false,
    });
});

</script>
<script>

    <script>

@yield('script')
</body>

</html>
