@extends('layouts.index')
@section('content')
    @php
        use app\Http\helper\Helper as Helper;
        $mainMenuTitle = Helper::mainMenuTitleById($page->parent_id);
        $leftSubMenu = Helper::geSubMenu($page->parent_id);
    @endphp

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
    <!--Banner end-->
    <section class="pageBreadcrumbs">
        <div class="container">
            <div class="row">
                <nav aria-label="breadcrumb" class="col-md-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">
                                @if(app()->getLocale() == 'en')
                                    {{$mainMenuTitle->title }}
                                @else
                                    {{$mainMenuTitle->title_ar}}
                                @endif
                            </a>
                        </li>
                        <!--<li class="breadcrumb-item"><a href="#">Library</a></li>-->
                        <li class="breadcrumb-item active" aria-current="page">
                            @if(app()->getLocale() == 'en')
                                {{$page->title }}
                            @else
                                {{$page->title_ar}}
                            @endif
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
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
                <div class="col-lg-4 col-xl-3 hide">
                    @include('website.includes.side_bar')
                </div>
                <div class="col-md-12 col-lg-8 col-xl-9">
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