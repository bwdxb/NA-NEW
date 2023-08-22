@extends('layouts.index')

@section('content')
{{--    {{__('')}}--}}
<!-- Content Header (Page header) -->


<section class="heroSlider">
    <div id="homeSlider" class="carousel slide" data-bs-ride="carousel" data-interval="false">
        <div class="carousel-inner">
            @if(!empty($banners))
            @foreach($banners as $banner)
            
            <div class="carousel-item active">
                @if($banner->file_type == 'video')
                <video width="100%" height="100%" autoplay muted loop>
                    <source src="{{url('public/uploads/banner/'.$banner->image)}}" type="video/mp4"/>
                </video>
            </div>
            @else
            <div class="carousel-item">
                <img src="{{url('public/uploads/banner/'.$banner->image)}}" class="d-block w-100"
                alt="..."/>
            </div>
            @endif

                @endforeach
                @endif
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#homeSlider" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#homeSlider" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
        </div>
        <div id="bottom_scroll" class="botmScroll">
            <span class="down"></span>
            Scroll Down
        </div>
        <div class="c-share">
            <input class="c-share__input" type="checkbox" id="checkbox">
            <label class="c-share__toggler" for="checkbox">
                <span class="c-share__icon"></span>
            </label>
            <ul class="c-share_options" data-title="Share">
                <li>
                    <a hget_shortlink_from_idref="#"
                   onclick="window.open('https://twitter.com/intent/tweet/?text=Inside the Northern Emirates field hospitals treating Covid-19 patients&url=http://www.nationalambulance.ae/', 'Twitter-dialog', 'width=626,height=436')"><img
                   src="{{asset('public/website/images/twitter-circled.svg')}}" alt="Twitter"></a>
               </li>
               <li>
                <a href="#"
                   onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.seha.ae%3Fp%3D13778', 'Facebook-dialog', 'width=626,height=436')"><img
                   src="{{asset('public/website/images/facebook-circled.svg')}}" alt="Facebook"></a>
               </li>
                   <li>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=https://chillyfacts.com/create-linkedin-share-button-on-website-webpages&title=Create LinkedIn Share button on Website Webpages&summary=chillyfacts.com&source=Chillyfacts"><img
                        src="{{asset('public/website/images/linkedin-circled.svg')}}" alt="Linkedin"></a>
                    </li>
                    <li>
                        <a class="whatsapp_trigger"
                       href="https://web.whatsapp.com/send?phone=&amp;text=Inside the Northern Emirates field hospitals treating Covid-19 patients : https%3A%2F%2Fwww.seha.ae%3Fp%3D13778"><img
                       src="{{asset('public/website/images/whatsapp.svg')}}" alt="Whatsapp"></a>
                   </li>
                   <li>
                    <a href="mailto:someone@example.com"><img style="margin-top:3px;margin-left:4px;" width="40px"
                      height="40px"
                      src="{{asset('public/website/images/envelop-circled.svg')}}"
                      alt="Email"></a>
                  </li>
                  <li>
                    <a href="javascript:void(0); " onclick="window.print()"><img style="margin-top:8px;margin-left:4px;"
                     width="40px" height="40px"
                     src="{{asset('public/website/images/printer.svg')}}"
                     alt="Print"></a>
                 </li>
            </ul>

        </div>
</section>
<!--Banner end-->
 <section id="about" class="aboutUs section_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="section_title">
                    <span>{{__('About Us')}}</span>
                    <h2>National Ambulance UAE</h2>
                </div>
                <div class="aboutContent">
                    <div class="headingLine"></div>
                    <div class="abDescription">
                        <p>
                            {{__('about_us_intro_1')}}
                        </p>
                        <p>
                            {{__('about_us_intro_2')}}
                        </p>
                        <a class="readmore" href="/national-ambulance/page/who-we-are">{{__('More About Us')}}</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <figure class="aboutImage hoverEffect">
                    <img class="imgHover" src="{{asset('public/website/images/about-us-img.jpg')}}"
                    alt="Natonal Ambulance">
                </figure>
            </div>

        </div>
    </div>
</section>
<!--About Us end-->
<section class="frontline_banner section_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="mb-5">{{__('Serving UAE Communities')}}</h2>
                <a class="learnMore" href="/national-ambulance/page/frontline-emergency-ambulance-service">
                {{__('Learn More')}}</a>
            </div>
        </div>
    </div>
    <div class="counterWrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="counterBox">
                        <h3>{{__('998 Frontline Emergency Ambulance Service in the Northern Emirates')}}</h3>
                        <div class="numberColumn">
                            <i class="icon headphones">
                                <img src="{{asset('public/website/images/headphones.svg')}}">
                            </i>
                            <div class="n_data">
                                <span class="number timer count-title count-number" data-to="482000"
                                data-speed="1200"> +</span>
                                <p>{{__('Number of Received Calls')}}</p>
                            </div>
                        </div>
                        <div class="numberColumn">
                            <i class="icon patient">
                                <img src="{{asset('public/website/images/patient.svg')}}">
                            </i>
                            <div class="n_data">
                                <span class="number timer count-title count-number" data-to="297000"
                                data-speed="1200">+ </span>

                                <p>{{__('Number of Treated Patients')}}</p>
                            </div>
                        </div>
                        <div class="numberColumn">
                            <i class="icon ambulance">
                                <img src="{{asset('public/website/images/ambulance.svg')}}">
                            </i>
                            <div class="n_data">
                                <span class="number timer count-title count-number" data-to="200000"
                                data-speed="1200">+ </span>

                                <p>{{__('Number of Transported Patients')}}</p>
                            </div>
                        </div>
                        <div class="numbertxt">
                            <h5>{{__('Service Figures Since Operations Started')}}</h5>
                            <p class="text-right">{{__('Last Update: Feb 2021')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--frontline_banner end-->
@if(!empty($services))
<section class="services section_padding">
    <div class="container">
        <div class="row">
            <div class="section_title col-md-12">
                <h2 class="text-uppercase">{{__('OUR SERVICES')}}</h2>
                <div class="headingLine"></div>
            </div>
            <div class="serviceList">

                @foreach($services as $service)
                <div class="serviceBox">
                    <div class="serviceImage hoverEffect">
                        <img class="imgHover"
                        src="{{ isset($service->banner)?url('/public/uploads/cms/'.$service->banner):(isset($service->image)?url('/public/uploads/cms/'.$service->image):'http://na.bw.ae/national-ambulance/public/uploads/service/7447.jpg' )}}"
                        alt="{{$service->title}}">
                    </div>
                    <div class="serviceInfo">
                        @if(app()->getLocale() == 'en')
                        <h3>{{$service->title}}</h3>
                        @else
                        <h3>{{$service->title_ar}}</h3>
                        @endif
                        <!-- <h3>{{__($service->title)}}</h3> -->
                        <a class="learnMore" href="{{url('/page/'.$service->slug)}}">{{__('Learn More')}}</a>
                    </div>
                </div>
                @endforeach

            </div>

        </div>
    </div>
</section>
@endif
<!--services end-->
@if(!empty($news))
<section class="latestNews section_padding">
    <div class="container">
        <div class="row">
            <div class="section_title col-md-12">
                <h2 class="text-uppercase">{{__('LATEST NEWS')}}</h2>
                <div class="headingLine"></div>
            </div>
        </div>
        <div class="row">
            <div class="newsAds col-md-9 col-xl-8">
                <div class="largeNews">
                    <a href="{{ url('news_detail',$news[0]->id)}}">
                        <div class="hoverEffect">
                            <?php $firstNews = json_decode($news[0]->image)?>
                            <img class="imgHover" src="{{url('public/uploads/news/'.$firstNews[0])}}"
                            alt="Latest News">
                            <div class="newsContent">
                                <div class="newsDate">
                                    <span>{{date('M', strtotime($news[0]->news_date))}}</span>
                                    {{date('d', strtotime($news[0]->news_date))}}
                                </div>
                                <div class="newsTag">
                                    {{__('Press Release')}}
                                </div>
                            </div>
                        </div>
                        <div class="newsTitle">
                            <h4>{{$news[0]->title}}</h4>
                        </div>
                    </a>
                </div>
                <div class="smallNews">
                    <?php for($i = 1; $i < count($news); $i++){
                        $newsImage = json_decode($news[$i]->image);
                        ?>
                        <a href="{{ url('news_detail',$news[$i]->id)}}">
                            <div class="coverNews hoverEffect">
                                <img class="imgHover" src="{{url('public/uploads/news/'.$newsImage[0])}}"
                                alt="Latest News">
                                <div class="newsContent">
                                    <div class="newsDate">
                                        <span>{{date('M', strtotime($news[$i]->news_date))}}</span>
                                        {{date('d', strtotime($news[$i]->news_date))}}
                                    </div>
                                    <div class="newsTag">
                                        {{__('Press Release')}}
                                    </div>
                                </div>
                            </div>
                            <div class="newsTitle">
                                {{--                                    <h4>{{__('')}}{{$news[$i]->title}}</h4>--}}
                                <h4>{{__($news[$i]->title)}}</h4>
                            </div>
                        </a>
                    <?php } ?>
                </div>
                <div class="viewAll_area">
                    <a class="viewAllBtn" href="{{ url('/page/news')}}">{{__('View All News')}}</a>
                </div>
            </div>
            <div class="col-md-3 col-xl-4">
                <div class="twitterBox">
                    <div class="widgetHeader">
                        <h5>{{__('Tweets')}}</h5>
                        <a href="#"><img src="{{asset('public/website/images/twitter-follow-btn.png')}}"></a>
                    </div>
                    <div class="feedContent">
                        <a class="twitter-timeline"
                        href="https://twitter.com/NAmbulanceUAE?ref_src=twsrc%5Etfw">
                    {{__('Tweets by NAmbulanceUAE')}}</a>
                    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endif
@if(!empty($public_awareness))
<section class="Covid-19 section_padding">
    <div class="container">
        <div class="row">
            <div class="section_title col-md-12 mb-4">
                <h2 class="text-uppercase">{{__('Public Awareness')}}</h2>
                <div class="headingLine"></div>
            </div>
        </div>
    </div>
    <div class="bannerSlider">
        @foreach($public_awareness as $public_aware)
        <div class="slideItem">
            <div class="callAction"><a class="learnMore" href="#">{{__('Learn More')}}</a></div>
            <img src="{{url('public/uploads/public_awareness/'.$public_aware->image)}}">
        </div>
        @endforeach
<!--         <div class="slideItem">
            <div class="callAction"><a class="learnMore" href="#">{{__('Learn More')}}</a></div>
            <img src="{{asset('public/website/images/covid-19-banner.jpg')}}">
        </div> -->
    </div>
</section>
@endif
@if(!empty($partners))
<section class="partners section_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section_title col-md-12">
                    <h2 class="text-uppercase">{{__('OUR PARTNERS')}}</h2>
                    <div class="headingLine"></div>
                </div>
            </div>
            <div class="logo_wrapper mt-4">
                <ul class="logoSlider">
                    @foreach($partners as $partner)
                    <li><img src="{{url('public/uploads/partner/'.$partner->image)}}"></li>

                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</section>
@endif
<section class="getapp section_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="appBanner">
                    <div class="appContent">
                        <h2>{{__('Get The App')}}</h2>
                        <p>{{__('The National Ambulance 998 App could save your life in times of emergencies')}}.
                            <br>{{__('Download it today for a safer tomorrow!')}}</p>
                        <div class="appStore">
                            <a class="andriodStore" href="#">
                                   @if(app()->getLocale() == 'en')
                                    <img src="{{asset('public/website/images/android-app-store.png')}}"
                                alt="Android App Store">
                                @else
                                    <img src="{{asset('public/website/images/android-app-store-ar.png')}}"
                                alt="Android App Store">
                                @endif
                                
                            </a>
                            <a class="IosStore" href="#">                                
                                @if(app()->getLocale() == 'en')
                                    <img src="{{asset('public/website/images/Ios-app-store.png')}}" alt="Apple Store">
                                @else
                                    <img src="{{asset('public/website/images/Ios-app-store-ar.png')}}" alt="Apple Store">
                                @endif
                            </a>
                            <span class="qrCode"><img src="{{asset('public/website/images/qr_code.png')}}"></span>
                        </div>
                    </div>
                    <div class="NA998">
                    	@if(app()->getLocale() == 'en')
                        <img src="{{asset('public/website/images/NA998-app.png')}}">
                        @else
                        <img src="{{asset('public/website/images/NA998-app-ar.png')}}">
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <figure class="ambulanceNumber">
                    <img src="{{asset('public/website/images/emergency-phone-number.jpg')}}">
                </figure>
            </div>
        </div>
    </div>
</section>


@endsection


@section('script')

@endsection