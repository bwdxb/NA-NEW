@extends('layouts.index')
@section('content')
    @php
        use app\Http\helper\Helper as Helper;
        $mainMenuTitle = Helper::mainMenuTitleById(4);
        $leftSubMenu = Helper::geSubMenu(4);
    @endphp

    <!-- Content Header (Page header) -->
    <section class="pageBanner"
    style="background-image: url({{ asset('public/website/images/about-us-banner.jpg') }})">
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
                            {{__('Testimonials')}}
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
                        {{__('Testimonials')}}
                    </h2>
                </div>
                
                <div class="col-md-12 ">
                    <div class="contentWrap mt-4">
					<div class="testimonials">
    <div class="row">
        <div class="col-md-12 text-center mb-5">
            <h2>{{__('What Clients Say')}}</h2>
            <div class="headingLine mx-auto"></div>
        </div>
    </div>
    <div class="testimonialSlider">
			@if(!$isEdit)
				<div class="testimonials_item">
                    <div class="client_info">
                        <h4>{{$testimonials->client_name}}</h4>
                        <span class="desgnation">{{$testimonials->title}}</span>
                        <p>“{{$testimonials->testimonial}}”</p>
                    </div>
                </div>
			@endif
        @foreach($data as $testimony)
		@if($testimonials->category==$testimony->category)
			@if($testimonials->id == $testimony->id)
			<div class="testimonials_item">
						<div class="client_info">
							<h4>{{$testimonials->client_name}}</h4>
							<span class="desgnation">{{$testimonials->title}}</span>
							<p>“{{$testimonials->testimonial}}”</p>
						</div>
					</div>
			@else
			
				<div class="testimonials_item">
					<div class="client_info">
						<h4>{{$testimony->client_name}}</h4>
						<span class="desgnation">{{$testimony->title}}</span>
						<p>“{{$testimony->testimonial}}”</p>
					</div>
				</div>
			@endif    
			@endif    
        @endforeach
    </div>
</div>
                     
                       
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
@section('script')

@endsection
			
	