@extends('layouts.index')
    @php
        use app\Http\helper\Helper as Helper;
        $config = Helper::getConfigByType("COURSE_STATUS_BUTTON");
        $mainMenuTitle = Helper::mainMenuTitleById($page->parent_id);
        $leftSubMenu = Helper::geSubMenu($page->parent_id);
        $description=app()->getLocale() == 'ar'?strip_tags($page->description_ar):strip_tags($page->description);
            if (strlen($description) > 300)
				{
					$description = substr($description, 0, 300);
					$description = explode(' ', $description);
					array_pop($description); // remove last word from array
					$description = implode(' ', $description);
				}
    @endphp
    
    @section('meta_tags')
        {!! Meta::toHtml() !!}
        @if($page->slug=='news')
            <meta property="og:description" content="Please provide news main page description @ resources/website/cms.blade.php" />
        @elseif($page->slug=='video-gallery')
            <meta property="og:description" content="Please provide video-gallery page description @ resources/website/cms.blade.php" />
        @else
            <meta property="og:description" content="{{$description}}" />
            <meta name="image" property="og:image" content="{{ ($page->image == '')?asset('public/website/images/about-us-banner.jpg'):asset('public/uploads/cms/'.$page->image) }}">
            <meta name="image" property="og:image:url" content="{{ ($page->image == '')?asset('public/website/images/about-us-banner.jpg'):asset('public/uploads/cms/'.$page->image) }}">
        @endif

    @endsection

    @section('content')
   
    @if(!($page->id == 48 || $page->id == 49))

    @if($page->id == 47)
    <!-- xxxxxxx Education and training banner content start xxxxxxx -->
        <section class="pageBanner" <?php if($page->image == ''){?>
        style="background-image: url({{ asset('public/website/images/about-us-banner.jpg') }})"
                <?php } else {?>style="background-image: url({{ asset('public/uploads/cms/'.$page->image) }})"
        <?php }?>>
            @if($config->status)
                <a class="default_btn course_btn" href="/courses">{{__('View Courses')}}</a>
            @endif
            <div class="pageHeading">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>
                                @if(app()->getLocale() == 'en')
                                    {{$mainMenuTitle->title }}
                                @else
                                    {{$mainMenuTitle->title_ar}}
                                @endif
                            </h1>
                            <span class="subTitle">{{__('National Ambulance')}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- xxxxxxx Education and training banner content end xxxxxxx -->
    @else
        <!-- Content Header (Page header) -->
        <section class="pageBanner" <?php if($page->image == ''){?>
        style="background-image: url({{ asset('public/website/images/about-us-banner.jpg') }})"
                <?php } else {?>style="background-image: url({{ asset('public/uploads/cms/'.$page->image) }})"
        <?php }?>>


            <div class="pageHeading">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>
                                @if(app()->getLocale() == 'en')
                                    {{$mainMenuTitle->title }}
                                @else
                                    {{$mainMenuTitle->title_ar}}
                                @endif
                            </h1>
                            <span class="subTitle">{{__('National Ambulance')}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
        <!--Banner end-->
        <section class="pageBreadcrumbs">
            <div class="container">
                <div class="row">
                    <nav aria-label="breadcrumb" class="col-md-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a  href="{{url()->current()}}">
                                    @if(app()->getLocale() == 'en')
                                        {{$mainMenuTitle->title }}
                                    @else
                                        {{$mainMenuTitle->title_ar}}
                                    @endif
                                </a>
                            </li>
                            <!--<li class="breadcrumb-item"><a href="#">Library</a></li>-->
                            @if(!($page->id == 48 || $page->id == 49))
                            
                        
                            <li class="breadcrumb-item active" aria-current="page">
                                @if(app()->getLocale() == 'en')
                                    {{$page->title }}
                                @else
                                    {{$page->title_ar}}
                                @endif
                            </li>
                            @endif
                        </ol>
                    </nav>
                </div>
            </div>
        </section>

    @endif
    <!--About Us end-->
    <section class="pageWrapper section_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="wrapTitle">
                        @if(app()->getLocale() == 'en')
                            {{$page->title }}
                        @else
                            {{$page->title_ar}}
                        @endif
                    </h2>
                </div>
                @if($page->id == 48 || $page->id == 49)

                @else
                <div class="col-lg-4 col-xl-3 hide">
                    @include('website.includes.side_bar')
                </div>
                @endif
                <div class="{{($page->id == 48 || $page->id == 49)?'col-md-12 col-lg-12 col-xl-12':'col-md-12 col-lg-8 col-xl-9'}}">
                    <div class="contentWrap mt-4">
                        <?php if($page->slug == 'news') {?>
                        @include('website.includes.news')
                        <?php } elseif($page->slug == 'supply-chain') {?>
                        @include('website.includes.supplier_registration')
                        <?php }elseif($page->slug == 'video-gallery'){?>
                        @include('website.includes.video_gallery')
                        <?php }elseif($page->id == 44){?>
                        @if(app()->getLocale() == 'en')
                            {!!$page->description!!}
                        @else
                            {!!$page->description_ar!!}
                        @endif
                        @include('website.includes.services_what_we_offer')
                        <?php }elseif($page->id == 45){?>
                        @if(app()->getLocale() == 'en')
                            {!!$page->description!!}
                        @else
                            {!!$page->description_ar!!}
                        @endif
                        @include('website.includes.pts_registration')
                        @include('website.includes.services_what_we_offer')
                        <?php }elseif($page->id == 46){?>
                        @if(app()->getLocale() == 'en')
                            {!!$page->description!!}
                        @else
                            {!!$page->description_ar!!}
                        @endif
                        @include('website.includes.events_ambulance_coverage_form')
                        @include('website.includes.services_what_we_offer')
                        <?php }elseif($page->id == 47){?>
                        @if(app()->getLocale() == 'en')
                            {!!$page->description!!}
                        @else
                            {!!$page->description_ar!!}
                        @endif
                        
                        @include('website.includes.education_and_training_form')
                        @include('website.includes.services_what_we_offer')

                        <?php }elseif($page->slug == 'get-in-touch'){?>
                        @include('website.includes.get_in_touch')
                        <?php } else {?>
                        @if(app()->getLocale() == 'en')
                            {!!$page->description!!}
                        @else
                            {!!$page->description_ar!!}
                        @endif
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
@section('script')
@endsection