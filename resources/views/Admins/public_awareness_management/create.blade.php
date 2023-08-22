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
            <h1 class="m-0 text-dark">Create Public Awareness</h1>
         </div>
        
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content mt-4">
   <div class="container-fluid">
      <form method="post" action="{{ route('public_awareness.store')}}" enctype="multipart/form-data" name="addPublic" id="addPublic">
       {{csrf_field()}}
      
         <div class="form-group">
			<div class="row">
               <label class="col-sm-2">Select Category</label>
               <div class="col-sm-10"><select name="cat_id" id="cat_id" class="form-control">
					  
					<option value="">Select Category</option>
					@foreach($categories as $key=>$category) 
					<option value="{{$key}}">{{$category}}</option>
					@endforeach
					</select></div>
            </div>
           <br />
            <div class="row">
               <label class="col-sm-2">Topic of Awareness</label>
                <div class="col-sm-10">
				<input type="text" name="name" class="form-control" id="name" value="{{old('name')}}">
                </div>
                 
            </div>
           <br />
            <div class="row">
               <label class="col-sm-2">Topic of Awareness (ar)</label>
                <div class="col-sm-10">
				<input type="text" name="name_ar" class="form-control" id="name_ar" value="{{old('name_ar')}}">
                </div>
                 
            </div>
			
			<br />
			<div class="row">
               <label class="col-sm-2">Upload Image</label>
                <div class="col-sm-10">
					<div class="fileupload fileupload-new" data-provides="fileupload">
						<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
							<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
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
							<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
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
				<input type="text" name="objective" class="form-control" id="objective" value="{{old('objective')}}">
                </div>
                 
            </div>
			<br />
			<div class="row">
               <label class="col-sm-2">Objective (ar)</label>
                <div class="col-sm-10">
				<input type="text" name="objective_ar" class="form-control" id="objective_ar" value="{{old('objective_ar')}}">
                </div>
                 
            </div>
			<br />
			<div class="row">
               <label class="col-sm-2">Videos and Graphics</label>
                <div class="col-sm-6">
					<div class="input-group hdtuto control-group lst video-increment" >
					<!-- <select name="video_type[]" class="myfrm form-control" >
						 <option value="VIDEO" >Video</option>
						 <option value="IMAGE" >Image</option>
					 </select> -->
					  <input type="text" name="video[]" class="myfrm form-control">
					  <div class="input-group-btn"> 
						<button  id="video-add-clone" class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
					  </div>
					</div>
					<div class="video-clone hide">
					  <div class="hdtuto control-group lst input-group my-video-clone" style= "margin-top:10px">
					  <!-- <select name="video_type[]" class="myfrm form-control" >
						 <option value="VIDEO" >Video</option>
						 <option value="IMAGE" >Image</option>
					 </select> -->
						<input type="text" name="video[]" class="myfrm form-control">
						<div class="input-group-btn"> 
						  <button  onclick="removeVideoHtml(this)"  class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
						</div>
					  </div>
					</div>
				</div>
              <br>  

            </div>
			<div class="row">
               <label class="col-sm-2">Graphics</label>
                <div class="col-sm-6">
			
				
					<div class="input-group hdtuto control-group lst graphics-increment" >
					
					 <input type="file" name="graphics[]" class="myfrm form-control" >
					  <div class="input-group-btn"> 
						<button id="graphics-add-clone" class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
					  </div>
					</div>
					
					
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
			<br />
			<div class="row">
               <label class="col-sm-2">Upload Poster</label>
                <div class="col-sm-10">
					<div class="fileupload fileupload-new" data-provides="fileupload">
						<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
							<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
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
							<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
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
               <div class="col-sm-10"><textarea type="text" name="description" class="form-control" id="description"></textarea></div>
               <div class="clearfix">
               </div>
            </div>
			<br>
			<div class="row">
               <label class="col-sm-2">Description (ar)</label>
               <div class="col-sm-10"><textarea type="text" name="description_ar" class="form-control" id="description_ar"></textarea></div>
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