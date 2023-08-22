@php
use app\Http\helper\Helper as Helper;
$video_category = Helper::getVideoCategory();
$video_gallery = Helper::getAllLangGallery(Request::get('cat_id'),Request::get('title'),Request::get('year'),Request::get('month'),Request::get('sort_by'));

@endphp

<div class="col-md-12">
	<div class="contentWrap mt-4">
		<form class="search_videoForm filterform" name="form">
			<div class="row">
				<div class="col-lg-3">
					<div class="input-group">
						<select name="cat_id" id="cat_id" class="form-control" onchange="document.form.submit();">
							
							<option value="">{{__('Select Category')}}</option>
							@foreach($video_category as $category) 
							@if(app()->getLocale() == 'en')
							<option value="{{$category->id}}" @if($category->id ==Request::get('cat_id')) selected="selected" @endif>{{$category->name}}</option>
							@else
							<option value="{{$category->id}}" @if($category->id ==Request::get('cat_id')) selected="selected" @endif>{{$category->name_ar}}</option>
							@endif
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-lg-2">
					
					<select name="year" class="form-control" autocomplete="off" onchange="document.form.submit();">
						<option value="">{{__('Year')}}</option>
						<?php  $currentYear = date('Y'); 
						foreach (range(2010, $currentYear) as $value) {?>
							<option value="<?php echo $value?>" @if($value ==Request::get('year')) selected="selected" @endif><?php echo $value?></option>   
							
						<?php }
						?>						
					</select>
				</div>
				<div class="col-lg-2">
					
					<select name="month" class="form-control" autocomplete="off" onchange="document.form.submit();">
						<option value="">{{__('Month')}}</option>
						<?php
				
				for ($i = 0; $i < 12; $i++) {
					$time = strtotime(sprintf('%d months', $i),strtotime("01/01/2021"));   
					$label = date('F', $time);   
					$value = date('n', $time);?>

					<option  value='<?php echo $value?>' @if($value ==Request::get('month')) selected="selected" @endif>{{__($label)}}</option>

				<?php }?>
					</select>
				</div>
				<div class="col-md-3">
					<div class="input-group">
						<input type="text" name="title" class="form-control" placeholder="{{__('Search video here')}}">
						<button type="submit" class="searchbtn"></button>
					</div>
				</div>
				<div class="col-lg-2 last-field">
					
					<select name="sort_by" class="form-control" autocomplete="off" onchange="document.form.submit();">
						<!-- <option value="">{{__('Sort by')}}</option> -->
						<option value="desc" selected="selected">{{__('Newest')}}</option>
						<option value="asc" @if('asc' ==Request::get('sort_by')) selected="selected" @endif>{{__('Oldest')}}</option>
						
					</select>
				</div>
			</div>
		</form>
		<div class="row">
			@foreach($video_gallery as $gallery)
			<div class="col-md-4 col-sm-6">
				
				<div >
					<!--<img class="imgHover" src="{{asset('public/website/images/NA-Continued-Medical-Education-CME.jpg')}}" alt="">-->
					<!-- <iframe class="imgHover" width="100%" height="150px" src="https://www.youtube.com/embed/@if(app()->getLocale() == 'en'){{$gallery->youtube_link}}@else{{$gallery->youtube_link_ar}}@endif" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
					<iframe class="imgHover" width="100%" height="150px" src="https://www.youtube.com/embed/{{$gallery->youtube_link}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					
				</div>
				<div class="videoInfo">
					@if(app()->getLocale() == 'en')
					<h3 class="videoTitle">{{$gallery->title}}</h3>
					@else
					<h3 class="videoTitle">{{$gallery->title}}</h3>
					@endif
					@if(app()->getLocale() == 'en')
					<h6 class="newsDate">{{date('d M Y', strtotime($gallery->video_date))}}</h6>
					@else
					<h6 class="newsDate" style="" >{{date('d', strtotime($gallery->video_date))." ". __(date('F', strtotime($gallery->video_date)))."".date('Y', strtotime($gallery->video_date))}}</h6>

					@endif
				</div>
				
			</div>
			@endforeach
			
		</div>
		
	</div>
</div>
{{ $video_gallery->appends($_GET)->links() }} 