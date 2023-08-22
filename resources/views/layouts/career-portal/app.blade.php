<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <link rel="icon" 
  type="image/jpg" 
  href="{{url('/public/Image/200x200.jpg')}}">
    @yield('meta_tags')

    <meta name="image" property="og:image" content="{{url('/public/Image/200x200.jpg')}}?3">
    <meta property="og:site_name" content="{{env('SITE_URL', 'National Ambulance')}}" />
    <title>{{__('Careers')}}-{{__('National Ambulance')}}</title>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-VX2XZS26QV"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-VX2XZS26QV');
    </script>
    <base href="{{URL::to('/')}}"/>
    

    <link rel="stylesheet" type="text/css" href="{{ asset('public/career_portal/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/career_portal/css/style.css')}}">  
    @if(app()->getLocale() == 'en')
        <link rel="stylesheet" href="{{asset('public/career_portal/css/en.css')}}">
    @else
        <link rel="stylesheet" href="{{asset('public/career_portal/css/ar.css')}}">
    @endif
    <link rel="stylesheet" href="{{ asset('public/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/website/css/animate.min.css')}}">  
    <link rel="stylesheet" type="text/css" href="{{ asset('public/career_portal/css/multi.select.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/career_portal/css/jquery-ui.css')}}">
</head> 
<body style="visibility:hidden;" >
<div id="loader" style="z-index:1000;" class="center"></div>
<div id="progress" class="center" style="z-index:1000;background-color: #00000075;background-size:60px auto;display:none;background-image:url('http://cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.16.1/images/loader-large.gif')"></div>

<!--header-->
<header class="header  @if(Request::segment(3) == '') {{'fixedHeader'}} @endif ">
    
<div class="topNav" url="{{ in_array(Request::segment(2).'-'.Request::segment(3).'-'.Request::segment(4).'-'.Request::segment(5),['career-portal-user-vacancy-view','career-portal-user-vacancy-','career-portal-user-vacancy-apply'])}}">  
        <div class="container"> 
            <ul>
                <li><a class="back_NA" href="{{env('APP_URL')}}index">{{__('National Ambulance Website')}}</a></li>
               @if(!(in_array(Request::segment(2).'-'.Request::segment(3).'-'.Request::segment(4).'-'.Request::segment(5),['career-portal-user-vacancy-view','career-portal-user-vacancy-','career-portal-user-vacancy-apply'])))
                <li> @if(app()->getLocale() == 'en')
                <a class="lang" href="{{LaravelLocalization::getLocalizedURL('ar')}}">العربية</a>
                            @else
                            <a class="lang" href="{{LaravelLocalization::getLocalizedURL('en')}}">English</a>
                          @endif
                </li>

                @endif
            </ul>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container justify-content-space-between">
            <a class="logo" href="{{env('APP_URL')}}career-portal">
                <img class="whiteLogo" src="{{asset('public/career_portal/images/national-ambulance-logo-white.svg')}}" alt="National Ambulance">
                <img class="fixedNav_logo" src="{{asset('public/career_portal/images/national-ambulance-logo-blue.svg')}}"
                     alt="National Ambulance">
            </a>
            <div class="mobShow">
            @if(!(in_array(Request::segment(2).'-'.Request::segment(3).'-'.Request::segment(4).'-'.Request::segment(5),['career-portal-user-vacancy-view','career-portal-user-vacancy-','career-portal-user-vacancy-apply'])))

                     @if(app()->getLocale() == 'en')
                     <a class="lang" href="{{LaravelLocalization::getLocalizedURL('ar')}}">العربية</a>
                            @else
                            <a class="lang" href="{{LaravelLocalization::getLocalizedURL('en')}}">English</a>
                         @endif
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
                <form id="mobSearch" class="toggleSearch" style="display:none;"  action="{{route('search')}}">
                <input type="text" name="s" class="form-control " placeholder="{{__('Search here...')}}">
            </form>
                <button class="navbar-toggler">
                    <span class="burger_line"></span>
                </button>
            </div>
            @include('layouts.career-portal.menu')
            
        </div>
    </nav>
</header>
<!--header end-->

<!--content start-->
<section id="main-content">
@yield('content')
</section>
<!--content end-->


<!--footer-->
<footer class="footer section_padding">
    <div class="container">
        <div class="row">
            <div class="footerColumn">
                <h3>{{__('Working With Us')}}</h3>
               
                <ul class="footerLinks">
                    <li><a href="{{LaravelLocalization::localizeUrl(env('APP_URL').'/page/who-we-are')}}">{{__('About National Ambulance')}}</a></li>
                    <li><a href="{{LaravelLocalization::localizeUrl(env('APP_URL').'/inner_page/why-national-ambulance-')}}">{{__('Why National Ambulance')}}</a></li>
                    <li><a href="{{LaravelLocalization::localizeUrl(env('APP_URL').'/inner_page/our-people')}}">{{__('Our People')}}</a></li>
                </ul>
            </div>
            <div class="footerColumn">
                <h3>{{__('Careers at National Ambulance')}}</h3>
                <ul class="footerLinks">
                    <li><a href="{{LaravelLocalization::localizeUrl('/inner_page/experienced-professionals')}}">{{__('Experienced Professionals')}}</a></li>
                    <li><a href="{{LaravelLocalization::localizeUrl('/inner_page/uae-nationals')}}">{{__('UAE Nationals')}}</a></li>
                    <li><a href="{{LaravelLocalization::localizeUrl('/career-portal/user/vacancy')}}">{{__('Search Jobs')}}</a></li>
                </ul>
            </div>
            <div class="footerColumn">
                <h3>{{__('Explore Links')}}</h3>
                <ul class="footerLinks">
                    <li><a href="{{LaravelLocalization::localizeUrl(env('APP_URL').'/index')}}">{{__('Nationalambulance.ae')}}</a></li>
                    <li><a href="{{LaravelLocalization::localizeUrl(env('APP_URL').'/contact-us')}}">{{__('Contact Us')}}</a></li>
                    <li><a href="{{LaravelLocalization::localizeUrl(env('APP_URL').'/page/terms-and-conditions')}}">{{__('Terms and Conditions')}}</a></li>
                    <li><a href="{{LaravelLocalization::localizeUrl(env('APP_URL').'/page/privacy-policy')}}">{{__('Privacy Policy')}}</a></li>
                </ul>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.slick/1.4.1/slick.min.js"></script>
<script type="text/javascript"  src="{{asset('public/career_portal/js/bootstrap.min.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('public/js/jquery.validate.js') }}" defer></script>
<script src="{{ asset('public/js/validation.js') }}" defer></script>
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
@if(app()->getLocale() == 'en')
    <script src='https://www.google.com/recaptcha/api.js?hl=en'></script>
@else
    <script src='https://www.google.com/recaptcha/api.js?hl=ar'></script>
@endif

<script type="text/javascript"  src="{{asset('public/career_portal/js/jquery-ui.min.js')}}"></script>
<script type="text/javascript"  src="{{asset('public/career_portal/js/chosen.jquery.js')}}"></script>
<script type="text/javascript"  src="{{asset('public/career_portal/js/custom.js')}}"></script>
<script type="text/javascript"  src="{{asset('public/career_portal/js/wow.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>

@yield('script')

<script>
 @if(session('success'))
        
 swal("{{session('title_msg')?session('title_msg'):'Success'}}", "{{ session('success') }}", "success").then(function() {
    window.location.href = window.location.href;
    });  

           
    @endif
    @if(session('error'))
    
    swal("Error", "{{ session('error') }}", "error")
      
    @endif
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
        $('.careerpage_video video').bind('contextmenu',function() { return false; });

        $('.serachSelect').selectize({
          sortField: 'text'
      });
      $("#current-location-selectized").removeAttr('required');
      $("#nationality-select-selectized").change(()=>{
          $('label[for="nationality-select-selectized"]').remove();
      });
    });
</script>
</body>
</html>

