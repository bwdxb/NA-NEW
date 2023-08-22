@extends('layouts.index')

@section('meta_tags')
    

        <meta name="robots" content="index,follow"/> 

        <meta name='keywords' content='' />
        <meta property='article:section' content='event' />
        <meta property="og:url" content="{{URL::current()}}">

        @if(app()->getLocale()=='ar')
        <!-- <meta property="og:title" content="الإسعاف الوطني في خدمة مجتمع الإمارات منذ عام 2010، تفضلوا بزيارة موقعه الإلكتروني" /> -->

{{-- <meta property="og:description" content="الإسعاف الوطني في خدمة مجتمع الإمارات منذ عام 2010. تفضلوا بزيارة موقعه الإلكتروني" /> --}}
<meta property="og:description" content="يقدم الإسعاف الوطني خدمات طوارئ طبية على مستوى عال من الجودة للمواطنين والمقيمين في دولة الإمارات، وبما يتماشى مع أهداف قطاع الرعاية الصحية في الدولة." />
@else

<meta property="og:description" content="National Ambulance provides quality pre-hospital emergency medical services for the people of the United Arab Emirates in line with the nation's healthcare objectives." />
@endif
        <meta property="og:title" content="{{__('National Ambulance')}}" />
        <meta property="og:type" content="article" />
        <meta property="og:locale" content="en-us" />
        <meta property="og:locale:alternate" content="en-us" />
        <meta property="og:site_name" content="{{__(env('SITE_URL', 'National Ambulance'))}}" />
        <meta property="og:image" content="{{url('/public/Image/200x200.jpg')}}?1" />
        <meta name="image" property="og:image" content="{{url('/public/Image/200x200.jpg')}}?1">
     
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:title" content="{{__('National Ambulance')}}" />
        <meta name="twitter:site" content="@NationalAmbulanceCareerPortal" />
        @if(app()->getLocale()=='ar')
        <meta property="twitter:description" content="الإسعاف الوطني في خدمة مجتمع الإمارات منذ عام 2010. تفضلوا بزيارة موقعه الإلكتروني"  />
@else

<meta property="twitter:description" content="National Ambulance provides quality pre-hospital emergency medical services for the people of the United Arab Emirates in line with the nation's healthcare objectives." />
@endif
        <meta property="twitter:image" content="{{url('/public/Image/200x200.jpg')}}" />
        <meta property="twitter:image:url" content="{{url('/public/Image/200x200.jpg')}}" />
    
@endsection
@section('content')
    {{--    {{__('')}}--}}
    <!-- Content Header (Page header) -->


    <section class="heroSlider">
        <div id="homeSlider" class="carousel slide"  data-interval="false">
            <div class="carousel-inner">
                @if(!empty($banners))
                    @foreach($banners as $key=>$banner)
                    @if($banner->file_type == 'video')
                            <div class="carousel-item @if($key == 0) active @endif">
                                <video width="100%" height="100%" autoplay muted loop playsinline controlsList="nodownload">
                                    @desktop
                                         <source src="{{$banner->image}}" type="video/mp4"/>
                                    @elsedesktop
                                         <source src="{{$banner->image_mob}}" type="video/mp4"/>
                                    @enddesktop
                                </video>
                             </div>
                        @else
                            <div class="carousel-item @if($key == 0) active @endif">
                            @desktop
                                    <img src="{{$banner->image}}" class="d-block w-100"
                                            alt="..."/>
                            @elsedesktop
                                    <img src="{{$banner->image_mob}}" class="d-block w-100"
                                                                        alt="..."/>
                            @enddesktop
                                
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
            {{__('Scroll Down')}}
        </div>
        <div class="c-share">
            <input class="c-share__input" type="checkbox" id="checkbox">
            <label class="c-share__toggler" for="checkbox">
                <span class="c-share__icon"></span>
            </label>
            <ul class="c-share_options" data-title="Share">
                @if(app()->getLocale()=='ar')
 <li><a href="https://twitter.com/share?url={{Request::url()}}&text=الإسعاف الوطني في خدمة مجتمع الإمارات منذ عام 2010. تفضلوا بزيارة موقعه الإلكتروني" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Twitter"><img src="{{asset('public/website/images/twitter-circled.svg')}}"  alt="Twitter"></a></li>
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u={{Request::url()}}&t=الإسعاف الوطني في خدمة مجتمع الإمارات منذ عام 2010. تفضلوا بزيارة موقعه الإلكتروني{{url()->current()}}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Facebook"><img src="{{asset('public/website/images/facebook-circled.svg')}}"  alt="Facebook"></a></li>
                                        <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{Request::url()}}&t=الإسعاف الوطني في خدمة مجتمع الإمارات منذ عام 2010. تفضلوا بزيارة موقعه الإلكتروني{{url()->current()}}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Linkedin"><img src="{{asset('public/website/images/linkedin-circled.svg')}}"  alt="Linkedin"></a></li>
                                        
                                        <li><a href="whatsapp://send?text=الإسعاف الوطني في خدمة مجتمع الإمارات منذ عام 2010. تفضلوا بزيارة موقعه الإلكتروني  {{url()->current()}}" data-action="share/whatsapp/share" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on whatsapp"><img src="{{asset('public/website/images/whatsapp.svg')}}"  alt="Whatsapp"></a></li>
                                        <li><a href="mailto:?subject=الإسعاف الوطني في خدمة مجتمع الإمارات منذ عام 2010. تفضلوا بزيارة موقعه الإلكتروني{{url()->current()}}&body={{Request::url()}}" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Mail"><img style="margin-top:3px;"width="40px" height="40px" src="{{asset('public/website/images/envelop-circled.svg')}}"  alt="Email"></a></li>        
                                        <li><a href="javascript:void(0); " onclick="window.print()"><img style="margin-top:8px;" width="40px" height="40px" src="{{asset('public/website/images/printer.svg')}}"  alt="Print"></a></li>
                                   
           
                @else
 <li><a href="https://twitter.com/share?url={{Request::url()}}&text=National Ambulance serving UAE communities since 2010, check out their website" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Twitter"><img src="{{asset('public/website/images/twitter-circled.svg')}}"  alt="Twitter"></a></li>
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u={{Request::url()}}&t=National Ambulance serving UAE communities since 2010, check out their website {{url()->current()}}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Facebook"><img src="{{asset('public/website/images/facebook-circled.svg')}}"  alt="Facebook"></a></li>
                                        <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{Request::url()}}&t=National Ambulance serving UAE communities since 2010, check out their website {{url()->current()}}" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Linkedin"><img src="{{asset('public/website/images/linkedin-circled.svg')}}"  alt="Linkedin"></a></li>
                                        
                                        <li><a href="whatsapp://send?text=National Ambulance serving UAE communities since 2010, check out their website {{url()->current()}}" data-action="share/whatsapp/share" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on whatsapp"><img src="{{asset('public/website/images/whatsapp.svg')}}"  alt="Whatsapp"></a></li>
                                        <li><a href="mailto:?subject=National Ambulance serving UAE communities since 2010, check out their website {{url()->current()}}&body={{Request::url()}}" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Mail"><img style="margin-top:3px;"width="40px" height="40px" src="{{asset('public/website/images/envelop-circled.svg')}}"  alt="Email"></a></li>        
                                        <li><a href="javascript:void(0); " onclick="window.print()"><img style="margin-top:8px;" width="40px" height="40px" src="{{asset('public/website/images/printer.svg')}}"  alt="Print"></a></li>
                                   
           
                @endif
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
                        <h2>{{__('National Ambulance UAE')}}</h2>
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
                            <a class="readmore" href="/page/who-we-are">{{__('More About Us')}}</a>
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
                    <a class="learnMore" href="/page/frontline-emergency-ambulance-service">
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
                                                        <span class="number timer count-title count-number"
                                                              data-to="670265"
                                                              data-speed="1200"> +</span>
                                    <p>{{__('Number of Received Calls')}}</p>
                                </div>
                            </div>
                            <div class="numberColumn">
                                <i class="icon patient">
                                    <img src="{{asset('public/website/images/patient.svg')}}">
                                </i>
                                <div class="n_data">
                                                        <span class="number timer count-title count-number"
                                                              data-to="364238"
                                                              data-speed="1200">+ </span>
                                    @if(app()->getLocale() == 'en')
                                        <p>Number of Treated Patients</p>
                                    @else
                                        <p>عدد المرضى الذين تم إسعافهم</p>
                                    @endif

                                </div>
                            </div>
                            <div class="numberColumn">
                                <i class="icon ambulance">
                                    <img src="{{asset('public/website/images/ambulance.svg')}}">
                                </i>
                                <div class="n_data">
                                                        <span class="number timer count-title count-number"
                                                              data-to="234880"
                                                              data-speed="1200">+ </span>

                                    <p>{{__('Number of Transported Patients')}}</p>
                                </div>
                            </div>
                            <div class="numbertxt">
                                <h5>{{__('Service Figures Since Operations Started')}}</h5>
                                <p class="text-right">{{__('Last Update: December 2021')}}</p>
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
                        <h2 class="text-uppercase"><a href="/our-services">{{__('OUR SERVICES')}}</a></h2>
                        <div class="headingLine"></div>
                    </div>
                    <div class="serviceList">

                        @foreach($services as $service)
                            <div class="serviceBox">
                                <div class="serviceImage hoverEffect">
                                    <img class="imgHover"
                                         src="{{ isset($service->banner)?url('/public/uploads/cms/'.$service->banner):(isset($service->image)?url('/public/uploads/cms/'.$service->image):env('APP_URL').'/public/uploads/service/7447.jpg' )}}"
                                         alt="{{$service->title}}">
                                </div>
                                <div class="serviceInfo">
                                    @if(app()->getLocale() == 'en')
                                        <h3>{{$service->title}}</h3>
                                    @else
                                        <h3>{{$service->title_ar}}</h3>
                                @endif
                                <!-- <h3>{{__($service->title)}}</h3> -->
                                    <a class="learnMore"
                                       href="{{url('/page/'.$service->slug)}}">{{__('Learn More')}}</a>
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
                    <div class="newsAds col-md-7 col-lg-8 col-xl-9">
                        <div class="largeNews">
                            <a href="{{ url('news_detail',$news[0]->id)}}">
                                <div class="hoverEffect">
                                   
                                    <?php $firstNews = json_decode($news[0]->image)?>
                                    @if($news[0]->cover_img)
                                    <img class="imgHover" src="{{url('public/uploads/news/'.$news[0]->cover_img)}}"
                                         alt="Latest News">
                                    @else

                                    <img class="imgHover" src="{{url('public/uploads/news/'.$firstNews[0])}}"
                                         alt="Latest News">
                                    @endif
                                    <div class="newsContent">
                                        <div class="newsDate">
                                        @if(app()->getLocale() == 'en')
                                            <span>{{__(date('M', strtotime($news[0]->news_date)))}}</span>
                                        @else
                                            <span>{{__(date('F', strtotime($news[0]->news_date)))}}</span>
                                        @endif
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
                                @if($news[$i]->cover_img)
                                    <img class="imgHover" src="{{url('public/uploads/news/'.$news[$i]->cover_img)}}"
                                            alt="Latest News">
                                @else
                                    <img class="imgHover" src="{{url('public/uploads/news/'.$newsImage[0])}}"
                                            alt="Latest News">
                                @endif
                                    
                                    <div class="newsContent">
                                        <div class="newsDate">
                                        @if(app()->getLocale() == 'en')
                                            <span>{{__(date('M', strtotime($news[$i]->news_date)))}}</span>
                                        @else
                                            <span>{{__(date('F', strtotime($news[$i]->news_date)))}}</span>
                                        @endif
                                            {{date('d', strtotime($news[$i]->news_date))}}
                                        </div>
                                        <div class="newsTag">
                                            {{__('Press Release')}}
                                        </div>
                                    </div>
                                </div>
                                <div class="newsTitle">
                                    <h4>{{__($news[$i]->title)}}</h4>
                                </div>
                            </a>
                            <?php } ?>
                        </div>
                        <div class="viewAll_area">
                            <a class="viewAllBtn" href="{{ url('/page/news')}}">{{__('View All News')}}</a>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-4 col-xl-3">
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
                        <div class="callAction"><!--<a class="learnMore" href="/public-awareness">{{__('Learn More')}}</a>--></div>
                        @if(app()->getLocale() == 'en')
                             <img src="{{url('public/uploads/public_awareness/'.$public_aware->image)}}">
                        @else
                             <img src="{{url('public/uploads/public_awareness/'.$public_aware->image_ar)}}">
                        @endif
                    </div>
            @endforeach
                   <!-- <div class="slideItem">
                                    <div class="callAction"><a class="learnMore" href="#">{{__('Learn More')}}</a></div>
                                    <img src="{{asset('public/website/images/covid-19-banner.jpg')}}">
                                </div> -->
            </div>
        </section>
    <!--@endif
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
    @endif -->
    <section class="getapp section_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="appBanner">
                        <div class="appContent">
                            <h2>{{__('Get The App')}}</h2>
                            <p>{{__('The National Ambulance 998 App could save your life in times of emergencies')}}.
                                {{__('Download it today for a safer tomorrow!')}}</p>  
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
                                        <img src="{{asset('public/website/images/Ios-app-store.png')}}"
                                             alt="Apple Store">
                                    @else
                                        <img src="{{asset('public/website/images/Ios-app-store-ar.png')}}"
                                             alt="Apple Store">
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
                        @if(app()->getLocale() == 'en')
                            <img src="{{asset('public/website/images/emergency-phone-number.jpg')}}">
                        @else
                            <img src="{{asset('public/website/images/emergency-phone-number-ar.jpg')}}">
                        @endif
                    </figure>
                </div>
            </div>
        </div>
    </section>


@endsection


@section('script')

@endsection