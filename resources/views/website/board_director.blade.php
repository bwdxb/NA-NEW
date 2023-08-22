@php
use app\Http\helper\Helper as Helper;
$mainMenuTitle = Helper::mainMenuTitleById(2);
$leftSubMenu = Helper::geSubMenu(2);
@endphp

@extends('layouts.index')

@section('meta_tags')
		{!! Meta::toHtml() !!}
	
		<meta name="image" property="og:image" content="{{asset('public/website/images/aboutus-board-of-directors.jpg')}}">
        <meta property="og:title" content="Board of Directors" />
        <meta property="og:description" content="please provide description content in meta tag from board_director.blade.php file" />
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="pageBanner" style="background-image: url({{asset('public/website/images/aboutus-board-of-directors.jpg')}})">
	<div class="pageHeading">          
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>
						@if(app()->getLocale() == 'en')
						{{$mainMenuTitle->title}}
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
							{{$mainMenuTitle->title}}
							@else
							{{$mainMenuTitle->title_ar}}
							@endif
						</a>
					</li>
					<!--<li class="breadcrumb-item"><a href="#">Library</a></li>-->
					<li class="breadcrumb-item active" aria-current="page">{{__('Board of Directors')}}</li>
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
				<h2 class="wrapTitle">{{__('Board of Directors')}}</h2>
			</div>
			<div class="col-md-4 col-xl-3">
				@include('website.includes.side_bar') 
			</div>
			<div class="col-md-8 col-xl-9">
				<div class="contentWrap mt-4">
					<div class="memberBlock mt-4">
						<div class="memberImage"><img alt="{{$board_director[0]->name}}" src="{{url('public/uploads/board_director/'.$board_director[0]->image)}}" style="width:280px; height:auto;" /></div>
						
						<div class="memberInfo">
							<h3 class="mName">
								@if(app()->getLocale() == 'en')
								{{$board_director[0]->name}}
								@else
								{{$board_director[0]->name_ar}}
								@endif
								
							</h3>
							<span class="designation">
								@if(app()->getLocale() == 'en')
								{{$board_director[0]->designation}}
								@else
								{{$board_director[0]->designation_ar}}
								@endif
							</span>

							<!-- <p>
								@if(app()->getLocale() == 'en')
								{{strip_tags(\Illuminate\Support\Str::limit($board_director[0]->description, 328, $end='.'))}}
								@else
								{{strip_tags(\Illuminate\Support\Str::limit($board_director[0]->description_ar, 328, $end='.'))}}
								@endif
								
							</p> -->
							<!-- <a class="viewAllBtn" href="#">Learn More</a> --></div>
						</div>
						
						<div class="listWrapper mt-4">

							<?php for($i =1; $i<count($board_director); $i++){?>
								<!-- <div class="listItem" data-toggle="modal" onclick="displayModal({{$board_director[$i]->id}})"> -->
								<div class="listItem">
									<figure class="itemImage"><img alt="{{$board_director[$i]->name}}" src="{{url('public/uploads/board_director/'.$board_director[$i]->image)}}"/></figure>

									<div class="itemInfo">
										<h4 class="mName">
											@if(app()->getLocale() == 'en')
											{{$board_director[$i]->name}}
											@else
											{{$board_director[$i]->name_ar}}
											@endif
										</h4>
										<span class="dsgTitle">
											@if(app()->getLocale() == 'en')
											{{$board_director[$i]->designation}}
											@else
											{{$board_director[$i]->designation_ar}}
											@endif
										</span> 
										<span class="compName">
											@if(app()->getLocale() == 'en')
											{{$board_director[$i]->institute}}
											@else
											{{$board_director[$i]->institute_ar}}
											@endif
										</span>
									</div>
								</div>

							<?php }?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php for($i =1; $i<count($board_director); $i++){?>

		<div class="modal fade" id="myModal_<?php echo $board_director[$i]->id;?>" role="dialog" tabindex="-1">
			<div class="modal-dialog" role="document">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" onclick="close_modal(<?php echo $board_director[$i]->id;?>)" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title">
							@if(app()->getLocale() == 'en')
							{{$board_director[$i]->name}}
							@else
							{{$board_director[$i]->name_ar}}
							@endif
								
							</h4>
						</div>
						<div class="modal-body">
							<img src="{{url('public/uploads/board_director/'.$board_director[$i]->image)}}" />
							@if(app()->getLocale() == 'en')
							{{$board_director[$i]->description}}
							@else
							{{$board_director[$i]->description_ar}}
							@endif
						</div>
					</div>
				</div>
			</div>
		<?php }?>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script type="text/javascript">
			function displayModal(id) 
			{
				$('#myModal_'+id).modal('show');
			} 
			function close_modal(id)
			{
				$('#myModal_'+id).modal('hide');
			}    

		</script>

		@endsection
		@section('script')
		@endsection