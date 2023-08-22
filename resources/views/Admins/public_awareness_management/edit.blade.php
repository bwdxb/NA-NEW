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
            <h1 class="m-0 text-dark">Edit Public Awareness</h1>
         </div>
        
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content mt-4">
   <div class="container-fluid">
      <form method="post" action="{{route('public_awareness.update',['id'=>$banner->id])}}" enctype="multipart/form-data"  id="editPublic">
       {{csrf_field()}}
	   @method('PUT')
      
         <div class="form-group">
			<div class="row">
               <label class="col-sm-2">Select Category</label>
               <div class="col-sm-10"><select name="cat_id" id="cat_id" class="form-control">
					  
					<option value="">Select Category</option>
					@foreach($categories as $key=>$category) 
					<option value="{{$key}}" @if($key ==$banner->cat_id) selected="selected" @endif>{{$category}}</option>
					@endforeach
					</select></div>
            </div>
           <br />
            <div class="row">
               <label class="col-sm-2">Topic of Awareness</label>
                <div class="col-sm-10">
				<input type="text" name="name" class="form-control" id="name" value="{{$banner->name}}">
                </div>
                 
            </div>
			
			<br />
            <div class="row">
               <label class="col-sm-2">Topic of Awareness(ar)</label>
                <div class="col-sm-10">
				<input type="text" name="name_ar" class="form-control" id="name_ar" value="{{$banner->name_ar}}">
                </div>
                 
            </div>
			
			<br />
			<div class="row">
               <label class="col-sm-2">Upload Image</label>
                <div class="col-sm-10">
					<div class="fileupload fileupload-new" data-provides="fileupload">
						<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
							<img  @if(isset($banner->image))
									src="{{asset('public/uploads/public_awareness/'.$banner->image)}}"
								  @else
									 src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
								  @endif
									 alt="" />
						</div>
						<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
						<div>
							<span class="btn btn-white btn-file">
								<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
								<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
								<input type="file" name="image" class="default" />
							</span>
							
						</div>
					</div>
				</div>
				
            </div>
            <br />
            <div class="row">
               <label class="col-sm-2">Upload Image(ar)</label>
                <div class="col-sm-10">
					<div class="fileupload fileupload-new" data-provides="fileupload">
						<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
							<img  @if(isset($banner->image_ar))
									src="{{asset('public/uploads/public_awareness/'.$banner->image_ar)}}"
								  @else
									 src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
								  @endif
									 alt="" />
						</div>
						<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
						<div>
							<span class="btn btn-white btn-file">
								<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
								<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
								<input type="file" name="image_ar" class="default" />
							</span>
							
						</div>
					</div>
				</div>
				
            </div>
            <br />
			<div class="row">
               <label class="col-sm-2">Objective</label>
                <div class="col-sm-10">
				<input type="text" name="objective" class="form-control" id="objective" value="{{$banner->objective}}">
                </div>
                 
            </div>
            <br />
			<div class="row">
               <label class="col-sm-2">Objective(ar)</label>
                <div class="col-sm-10">
				<input type="text" name="objective_ar" class="form-control" id="objective_ar" value="{{$banner->objective_ar}}">
                </div>
                 
            </div>
			<br />
			<div class="row">
               <label class="col-sm-2">Videos</label>
                <div class="col-sm-6">
				@php
				  $videos = json_decode($banner->videos);
				  $video_type = json_decode($banner->video_type);
				  @endphp
				
					<div class="input-group hdtuto control-group lst video-increment" >
					 <!-- <select name="video_type[]" class="myfrm form-control" >
						 <option value="VIDEO">Video</option>
						 <option value="IMAGE">Image</option>
					 </select> -->
					 <input type="text" name="video[]" class="myfrm form-control" value="{{$videos[0]}}">
					  <div class="input-group-btn"> 
						<button id="video-add-clone" class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
					  </div>
					</div>
					<?php 
					if(!empty($videos))
					{
					for($i=1; $i<count($videos);$i++){?>
						<div class="hdtuto control-group lst input-group my-video-clone" style= "margin-top:10px">
								<!-- <select name="video_type[]" class="myfrm form-control" >
									<option value="VIDEO" @if($video_type[$i]=='VIDEO') selected @endif>Video</option>
									<option value="IMAGE" @if($video_type[$i]=='IMAGE') selected @endif>Image</option>
								</select> -->
								<input type="text" name="video[]" class="myfrm form-control" value="{{$videos[$i]}}">
								<div class="input-group-btn"> 
								<button  onclick="removeVideoHtml(this)"  class="btn btn-danger video-remove-clone" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
								</div>
								<br/>
						</div>
					  <?php }} ?>
					<div class="video-clone hide">
					  <div class="hdtuto control-group lst input-group my-video-clone" style= "margin-top:10px">
					  	<!-- <select name="video_type[]" class="myfrm form-control" >
							<option value="VIDEO" >Video</option>
							<option value="IMAGE" >Image</option>
					 	</select> -->
						<input type="text" name="video[]" class="myfrm form-control">
						<div class="input-group-btn"> 
						  <button onclick="removeVideoHtml(this)" class="btn btn-danger video-remove-clone" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
						</div>
					  </div>
					</div>
				</div>
				
              <br>  
                 
            </div>
			<br />
			<div class="row">
               <label class="col-sm-2">Graphics</label>
                <div class="col-sm-6">
				@php
				  $graphics = json_decode($banner->graphics);
				  @endphp
				
					<div class="input-group hdtuto control-group lst graphics-increment" >
					 <!-- <select name="video_type[]" class="myfrm form-control" >
						 <option value="VIDEO">Video</option>
						 <option value="IMAGE">Image</option>
					 </select> -->
					 <input type="file" name="graphics[]" class="myfrm form-control" >
					  <div class="input-group-btn"> 
						<button id="graphics-add-clone" class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
					  </div>
					</div>
					<?php 
					if(!empty($graphics))
					{
						for($i=0; $i<count($graphics);$i++){?>
							<div class="hdtuto control-group lst input-group my-graphics-clone" style= "margin-top:10px">
								
									<!-- <input type="file" name="graphics[]" class="myfrm form-control" value="{{$graphics[$i]}}"> -->
									<input type="hidden" name="graphics_images[]" class="myfrm form-control" value="{{$graphics[$i]}}">
									<img src="{{url('/public/uploads/public_awareness/'.$graphics[$i])}}" width="50" height="50"/>
									<div class="input-group-btn"> 
										<button onclick="removeGraphicsHtml(this)" class="btn btn-danger graphics-remove-clone" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
									</div>
									<br/>
							</div>
					  	<?php }
					} ?>
					<div class="graphics-clone hide">
					  <div class="hdtuto control-group lst input-group my-graphics-clone" style= "margin-top:10px">
						<input type="file" name="graphics[]" class="myfrm form-control">
						<div class="input-group-btn"> 
						  <button onclick="removeGraphicsHtml(this)" class="btn btn-danger graphics-remove-clone" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
						</div>
					  </div>
					</div>
				</div>
				
              <br>  
                 
            </div>
			<br />
			<div class="row">
               <label class="col-sm-2">Upload Poster</label>
                <div class="col-sm-10">
					<div class="fileupload fileupload-new" data-provides="fileupload">
						<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
							<img  @if(isset($banner->poster))
									src="{{asset('public/uploads/public_awareness/'.$banner->poster)}}"
								  @else
									 src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
								  @endif
									 alt="" />
						</div>
						<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
						<div>
							<span class="btn btn-white btn-file">
								<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
								<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
								<input type="file" name="poster" class="default" />
							</span>
							
						</div>
					</div>
				</div>
				
            </div>
			<br />
			<div class="row">
               <label class="col-sm-2">Upload Poster(ar)</label>
                <div class="col-sm-10">
					<div class="fileupload fileupload-new" data-provides="fileupload">
						<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
							<img  @if(isset($banner->poster_ar))
									src="{{asset('public/uploads/public_awareness/'.$banner->poster_ar)}}"
								  @else
									 src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
								  @endif
									 alt="" />
						</div>
						<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
						<div>
							<span class="btn btn-white btn-file">
								<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
								<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
								<input type="file" name="poster_ar" class="default" />
							</span>
							
						</div>
					</div>
				</div>
				
            </div>
			<br />
			<div class="row">
               <label class="col-sm-2">Description</label>
               <div class="col-sm-10"><textarea type="text" name="description" class="form-control" id="description">{{$banner->description}}</textarea></div>
               <div class="clearfix">
               </div>
            </div>
			<br>
			<div class="row">
               <label class="col-sm-2">Description (ar)</label>
               <div class="col-sm-10"><textarea type="text" name="description_ar" class="form-control" id="description_ar">{{$banner->description_ar}}</textarea></div>
               <div class="clearfix">
               </div>
            </div>
			<br>
			
            <div class="form-group text-center">
			<a href="{{ url()->previous()}}"  class="btn btn-primary"> Back</a>
               <a href="{{url('/admin/public_awareness')}}" class="btn btn-secondary">Cancel</a>
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
<script src="{{ asset('public/plugins/jquery/jquery.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $("#video-add-clone").click(function(){ 
          var lsthmtl = $(".video-clone").html();
          $(".video-increment").after(lsthmtl);
      });
      $("#graphics-add-clone").click(function(){ 
          var lsthmtl = $(".graphics-clone").html();
          $(".graphics-increment").after(lsthmtl);
      });
	  
    //   $(".graphics-remove-clone").on("click",function(){ 

	//   $(this).parents('.my-graphics-clone').remove();
    //       //$(this).parents(".hdtuto control-group lst").remove();
		  
    //   });
    //   $(".video-remove-clone").on("click",function(){ 
	//   $(this).parents('.my-video-clone').remove();
    //       //$(this).parents(".hdtuto control-group lst").remove();
		  
    //   });
    });
	function removeVideoHtml(e){ 
	  $(e).parents('.my-video-clone').remove();
          //$(this).parents(".hdtuto control-group lst").remove();
		  
      }
	function removeGraphicsHtml(e){ 
	  $(e).parents('.my-graphics-clone').remove();
          //$(this).parents(".hdtuto control-group lst").remove();
		  
      }
</script>
<script type="text/javascript" src="{{asset('public/admin/js/ckeditor/ckeditor.js')}}"></script>

<script>
    CKEDITOR.replace('objective', {
	allowedContent:true,
      height: 300,
    filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form'
    });
    CKEDITOR.replace('objective_ar', {
	allowedContent:true,
      height: 300,
    filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form'
    });
    CKEDITOR.replace('description', {
	allowedContent:true,
      height: 300,
    filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form'
    });
    CKEDITOR.replace('description_ar', {
	allowedContent:true,
      height: 300,
    filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form'
    });
  </script>

@endsection