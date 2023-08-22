@extends('layouts.master')
@section('content')
<section class="wrapper"> 
	<div class="row">
		<div class="col-sm-12">
			<section class="panel">
				<div class="content-header">
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6 mt-4">
								<h1 class="m-0 text-dark">Add Video Gallery</h1>
							</div>
						</div>
						<!-- /.row -->
					</div>
					<!-- /.container-fluid -->
				</div>
				<!-- /.content-header -->
				<section class="content mt-4">
					<div class="container-fluid">
						<form method="post" action="{{ route('video_gallery.store')}}" enctype="multipart/form-data" name="addPage" id="addPage">
							{{csrf_field()}}
							<div class="row">
                  <label class="col-sm-2">Select Lang </label>
                  <div class="col-sm-10">
                     <select name="lang" id="lang" class="form-control">
                       <option selected="selected">Select Lang</option>
                       <option selected="{{(isset($video_gallery) && $video_gallery->lang == 'English') ? 'selected' : ''}}">English</option>
                       <option selected="{{(isset($video_gallery) && $video_gallery->lang == 'Arabic') ? 'selected' : ''}}">Arabic</option>
                    </select>
                 </div>
              </div>
							<div class="row">
								<label class="col-sm-2">Select Category</label>
								<div class="col-sm-10"><select multiple name="cat_id[]" id="cat_id" class="form-control">

									<option value="">Select Category</option>

									@foreach($video_category as $category) 
									<option value="{{$category->id}}">{{$category->name}} ({{$category->name_ar}})</option>
									@endforeach
								</select></div>
							</div>
							<br>



							<div class="row">
								<label class="col-sm-2">Title</label>
								<div class="col-sm-10"><input type="text" name="title" id="title" class="form-control" value="{{old('title')}}"></div>
							</div>
							<!-- <div class="row">
								<label class="col-sm-2">Title (Arabic)</label>
								<div class="col-sm-10"><input type="text" name="title_ar" id="title_ar" class="form-control" value="{{old('title_ar')}}"></div>
							</div> -->
							<br />
							<div class="row">
								<label class="col-sm-2">Date</label>
								<div class="col-sm-9">

									<div class="input-group date" data-date-format="yyyy-mm-dd" data-provide="datepicker">
										<input type="text" readonly="" class="form-control" name="video_date">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-th"></span>
										</div>
									</div>

								</div>
							</div>
							<br />
							<div class="row">
								<label class="col-sm-2">Youtube Link</label>
								<div class="col-sm-10"><input type="text" name="youtube_link"  class="form-control" id="youtube_link" value="{{old('youtube_link')}}">
								</div>

							</div>
							<br />
							<!-- <div class="row">
								<label class="col-sm-2">Youtube Link Arabic Version</label>
								<div class="col-sm-10"><input type="text" name="youtube_link_ar"  class="form-control" id="youtube_link_ar" value="{{old('youtube_link_ar')}}">
								</div>

							</div>
							<br /> -->


							<div class="form-group text-center">
							<a href="{{ url()->previous()}}"  class="btn btn-primary"> Back</a>
                  <a href="{{route('video_gallery.index')}}" class="btn btn-secondary">Cancel</a>
								<input type="submit" class="btn btn-primary" value="Save">
							</div>
						</div>
					</form>

				</div>
			</section>
		</section>
		
		
	</div>
</div>
</section>

@endsection