@section('meta_tags')
{!! Meta::toHtml() !!}
@endsection
@section('content')
@php
use app\Http\helper\Helper as Helper;
$mainMenuTitle = Helper::mainMenuTitleById($inner_page->main_id);
$subMenuTitle = Helper::subMenuTitleById($inner_page->parent_id);
$leftSubSubMenu = Helper::geSubSubMenu($inner_page->parent_id);
@endphp


	@extends($inner_page->main_id == 5?'layouts.career-portal.app':'layouts.index')


<!-- Content Header (Page header) -->
<section class="pageBanner {{$inner_page->main_id}}" 
<?php if($inner_page->image == '')
{?> style="background-image: url({{asset('public/website/images/about-us-banner.jpg')}})" <?php }
else
	{?>style="background-image: url({{asset('public/uploads/cms/'.$inner_page->image)}})"<?php }?>>
<div class="pageHeading">          
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>
					<!-- {{$subMenuTitle->title}} -->
					@if(app()->getLocale() == 'en')
                                {{$subMenuTitle->title }}
                            @else
                                {{$subMenuTitle->title_ar}}
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
					@if(app()->getLocale() == 'en')
					<li class="breadcrumb-item"><a href="{{$mainMenuTitle->id==5?route('career-portal.index'):url()->current()}}">{{$mainMenuTitle->title}}</a></li>
					<li class="breadcrumb-item"><a href="{{url()->current()}}">{{$subMenuTitle->title}}</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{$inner_page->title}}</li>
					@else
					<li class="breadcrumb-item"><a href="{{$mainMenuTitle->id==5?route('career-portal.index'):url()->current()}}">{{$mainMenuTitle->title_ar}}</a></li>
					<li class="breadcrumb-item"><a href="{{url()->current()}}">{{$subMenuTitle->title_ar}}</a></li>
					<li class="breadcrumb-item active" aria-current="page">{{$inner_page->title_ar}}</li>
					@endif

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
					{{$inner_page->title}}
					@else
					{{$inner_page->title_ar}}
					@endif
				</h2>
			</div>
			<div class="col-lg-4 col-xl-3 hide">
				@include('website.includes.side_bar') 
			</div>
			<div class="col-md-12 col-lg-8 col-xl-9">   
				<div class="contentWrap mt-4">
					@if(app()->getLocale() == 'en')
					{!!$inner_page->description!!}
					@else
					{!!$inner_page->description_ar!!}
					@endif
					
				</div>
			</div>
		</div>
	</div>
</section>

@endsection
@section('script')
@endsection