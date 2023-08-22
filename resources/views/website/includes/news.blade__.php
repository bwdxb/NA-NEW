@php
use app\Http\helper\Helper as Helper;
$news_category = Helper::getNewsCategory();
$allNews = Helper::getAllNews(Request::get('cat_id'),Request::get('title'),Request::get('year'),Request::get('month'),Request::get('sort_by'));

@endphp

<form method="get" action="" name="form">

	<div class="row">
		<div class="col-md-2">
			<div class="input-group">
				<select name="cat_id" id="cat_id" class="form-control">

					<option value="">Select Category</option>
					@foreach($news_category as $key=>$category) 
					<option value="{{$key}}" @if($key ==Request::get('cat_id')) selected="selected" @endif>{{$category}}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-lg-2" style="margin-right:4px">
			<input type="text"  autocomplete="off" id="title" class="form-control" placeholder="Search By Keyword" value="{{Request::get('title')}}" name="title"> 
		</div>

		<div class="col-lg-2" style="margin-right:4px">

			<select name="year" class="form-control" autocomplete="off">
				<option value="">Year</option>
				<?php  $currentYear = date('Y'); 
				foreach (range(2010, $currentYear) as $value) {?>
					<option value="<?php echo $value?>" @if($value ==Request::get('year')) selected="selected" @endif><?php echo $value?></option>   

				<?php }
				?>

			</select>
		</div>

		<div class="col-lg-2" style="margin-right:4px">

			<select name="month" class="form-control" autocomplete="off">
				<option value="">Month</option>
				<?php
				for ($i = 0; $i < 12; $i++) {
					$time = strtotime(sprintf('%d months', $i));   
					$label = date('F', $time);   
					$value = date('n', $time);?>

					<option value='<?php echo $value?>' @if($value ==Request::get('month')) selected="selected" @endif><?php echo $label?></option>

				<?php }?>
			</select>
		</div>


		<div class="col-lg-1 ">
			<button class="btn btn-primary " type="submit" style="margin-top:2px;" >Filter </button>
		</div>
		<div class="col-lg-2" style="margin-right:4px">

			<select name="sort_by" class="form-control" autocomplete="off" onchange="document.form.submit();">
				<option value="">Sort by</option>
				<option value="desc" @if('desc' ==Request::get('sort_by')) selected="selected" @endif>Newest</option>
				<option value="asc" @if('asc' ==Request::get('sort_by')) selected="selected" @endif>Oldest</option>

			</select>
		</div>



	</div>
</form>
<br />
<div class="row">
	@foreach($allNews as $news)
	<div class="col-md-4">
		
		<a href="{{ url('news_detail',$news->id)}}" class="news_item hoverEffect">
			<div class="newsImage">
				@php
				$images = json_decode($news->image);
				@endphp
				@if(!empty($images))
				<img class="imgHover" src="{{asset('public/uploads/news/').'/'.($images[0])}}" alt="">
				@endif
				<!--<span class="news_tag">{{$news->cat_name}}</span>-->
			</div>
			<div class="newsDescription">
				<h3 class="newsTitle">
					<h3>{{$news->title}}</h3>
				</h3>
				<h6 class="newsDate">{{date('M d, Y', strtotime($news->news_date))}}</h6>
			</div>
		</a>
	</div>
	@endforeach
	
</div>

{{ $allNews->appends($_GET)->links() }} 