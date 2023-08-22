@extends('layouts.index')
@section('content')
@php
use app\Http\helper\Helper as Helper;
$mainMenuTitle = Helper::mainMenuTitleById(4);
$leftSubMenu = Helper::geSubMenu($page->parent_id);
@endphp

<!-- Content Header (Page header) -->
<section class="pageBanner"  style="background-image: url({{asset('public/website/images/about-us-banner.jpg')}})" >
	<div class="pageHeading">          
		<div class="container">
			<div class="row">
				<div class="col-md-12">

					@if(app()->getLocale() == 'en')
					<h1>{{isset($mainMenuTitle)?$mainMenuTitle->title:""}}</h1>
					@else
					<h1>{{isset($mainMenuTitle)?$mainMenuTitle->title_ar:""}}</h1>
					@endif
					<span class="subTitle">National Ambulance</span>
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
					@if(app()->getLocale() == 'en')
					<li class="breadcrumb-item"><a href="#">{{$mainMenuTitle->title}}</a></li>
					@else
					<li class="breadcrumb-item"><a href="#">{{$mainMenuTitle->title_ar}}</a></li>
					@endif
					
					<!--<li class="breadcrumb-item"><a href="#">Library</a></li>-->
					<li class="breadcrumb-item active" aria-current="page">{{$page->name}}</li>
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
					{{$page->title}}
					@else
					{{$page->title_ar}}
					@endif

				</h2>
			</div>
			<div class="col-md-4 col-xl-3">
				@include('website.includes.side_bar') 
			</div>
			<div class="col-md-8 col-xl-9">

				<div class="contentWrap mt-4">
					<?php if($page->slug == 'news') {?>
						@include('website.includes.news') 
					<?php } elseif($page->slug == 'supply-chain') {?>
						@include('website.includes.supplier_registration') 
					<?php }elseif($page->slug == 'video-gallery'){?>
						@include('website.includes.video_gallery') 
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