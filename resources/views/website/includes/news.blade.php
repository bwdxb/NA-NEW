@php
use app\Http\helper\Helper as Helper;
$news_category = Helper::getNewsCategoryAll();
$allNews = Helper::getAllNews(Request::get('cat_id'),Request::get('title'),Request::get('year'),Request::get('month'),Request::get('sort_by'));
@endphp



<form method="get" action="" name="form" class="filterform">

	<div class="row">
		<div class="filter-col-lg">
			<div class="input-group">
				<select name="cat_id" id="cat_id" class="form-control">
					<option value="">{{__('Select Category')}}</option>
						@foreach($news_category as $key=>$category) 
						<option value="{{$category->id}}" @if($category->id== Request::get('cat_id')) selected @endif>
						@if(app()->getLocale() == 'en')	
							{{$category->name}}
						@else
							{{$category->name_ar}}
						@endif
					</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="filter-col-lg">
			<input type="text"  autocomplete="off" id="title" class="form-control" placeholder="{{__('Search By Keyword')}}" value="{{Request::get('title')}}" name="title"> 
		</div>

		<div class="filter-col-sm">

			<select name="year" class="form-control" autocomplete="off">
				<option value="">{{__('Year')}}</option>
				<?php  $currentYear = date('Y'); 
				foreach (range(2010, $currentYear) as $value) {?>
					<option value="<?php echo $value?>" @if($value ==Request::get('year')) selected="selected" @endif><?php echo $value?></option>   

				<?php }
				?>

			</select>
		</div>

		<div class="filter-col-sm">

			<select name="month" class="form-control" autocomplete="off">
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


		<div class="filterColBtn">
			<button class="btn btn-primary " type="submit">{{__('Filter')}} </button>
		</div>
		<div class="filter-col-sm">

			<select name="sort_by" class="form-control" autocomplete="off" onchange="document.form.submit();">
				<option value="">{{__('Sort By')}}</option>
				<option value="desc" @if('desc' ==Request::get('sort_by')) selected="selected" @endif>{{__('Newest')}}</option>
				<option value="asc" @if('asc' ==Request::get('sort_by')) selected="selected" @endif>{{__('Oldest')}}</option>

			</select>
		</div>



	</div>
</form>
<br />
<div class="row">
	@foreach($allNews as $news)
	@php
		if($_GET['teeee'])
		{
			print_r($news);
		}
	@endphp
	<div class="col-lg-4 col-sm-6">
		
		<a href="{{ url('news_detail',$news->id)}}" class="news_item hoverEffect">
			<div class="newsImage">
				@php
				$images = json_decode($news->image);
				@endphp
				@if($news->cover_img)
					<img class="imgHover" src="{{asset('public/uploads/news/').'/'.($news->cover_img)}}" alt="">
				@elseif(!empty($images))
					<img class="imgHover" src="{{asset('public/uploads/news/').'/'.($images[0])}}" alt="">
				@endif
				<!--<span class="news_tag">{{$news->cat_name}}</span>-->
			</div>
			<div class="newsDescription">
				<h3 class="newsTitle">
					{{$news->title}}						
				</h3>
				@if(app()->getLocale() == 'en')
				<h6 class="newsDate">{{date('d M Y', strtotime($news->news_date))}}</h6>
				@else
				<h6 class="newsDate" style="" >{{date('d', strtotime($news->news_date))."". __(date('F', strtotime($news->news_date)))." ".date('Y', strtotime($news->news_date))}}</h6>
				<!-- <h6 class="newsDate" style="float: right;direction: ltr;" >{{date('d', strtotime($news->news_date))." ".date('Y', strtotime($news->news_date))." ". __(date('F', strtotime($news->news_date)))}}</h6> -->

				@endif

				@if(app()->getLocale() == 'en')
					<h6 class="newsDate">{{$news->cat_name}}</h6>
				@else
					<h6 class="newsDate">{{$news->cat_name_ar}}</h6>
				@endif
			</div>
		</a>
	</div>
	@endforeach
	
</div>


{{ $allNews->appends($_GET)->links() }}

