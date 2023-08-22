{{--@extends('layouts.index')--}}

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
<link rel="stylesheet" href="{{asset('public/website/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('public/website/css/style.css')}}" media="all">

<style type="text/css">
     body{padding:0;}
     .launch_page{background-image:url("{{asset('public/website/images/ribbon.png')}}");background-repeat:no-repeat;min-height:100vh;background-size:contain;
        background-position:center right;
        display:flex;
        align-items:center;
        justify-content:center;
        text-align: center;
    }
</style>

    <section class="launch_page">
        
        
    </section>




@section('script')

