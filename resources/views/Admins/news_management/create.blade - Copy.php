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
            <h1 class="m-0 text-dark">Add News</h1>
         </div>
        
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content mt-4">
   <div class="container-fluid">
      <form method="post" action="{{ route('news.store')}}" enctype="multipart/form-data" name="addNews" id="addNews">
       {{csrf_field()}}
      
         <div class="form-group">
			<div class="row">
               <label class="col-sm-2">Select Category</label>
               <div class="col-sm-10"><select name="cat_id" id="cat_id" class="form-control">
			   <option value="">Select Category</option>
			   @foreach($news_category as $key => $value)
			   <option value="{{$key}}">{{$value}}</option>
			   @endforeach
			   </select>
			   </div>
            </div>
			<br>
			
           
            <div class="row">
               <label class="col-sm-2">Title</label>
               <div class="col-sm-10"><input type="text" name="title" id="title" class="form-control"></div>
            </div>
			<br>
			<div class="row">
               <label class="col-sm-2">Date</label>
                <div class="col-sm-9">
				
					<div class="input-group date" data-provide="datepicker">
						<input type="text" readonly="" class="form-control" name="news_date">
						<div class="input-group-addon">
							<span class="glyphicon glyphicon-th"></span>
						</div>
					</div>
                 </div>
            </div>
			<br />
			<div class="row">
               <label class="col-sm-2">Source</label>
               <div class="col-sm-10"><input type="text" name="source" id="source" class="form-control"></div>
            </div>
			<br />
			<div class="row">
               <label class="col-sm-2">Summary</label>
               <div class="col-sm-10"><textarea name="summary" id="summary" rows="5" class="form-control"></textarea></div>
            </div>
			<br />
			<div class="row">
               <label class="col-sm-2">Upload Image</label>
                <div class="col-sm-6">
					<div class="input-group hdtuto control-group lst increment" >
					  <input type="file" name="filenames[]" class="myfrm form-control">
					  <div class="input-group-btn"> 
						<button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
					  </div>
					</div>
					<div class="clone hide">
					  <div class="hdtuto control-group lst input-group myclone" style= "margin-top:10px">
						<input type="file" name="filenames[]" class="myfrm form-control">
						<div class="input-group-btn"> 
						  <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
						</div>
					  </div>
					</div>
				</div>
				
              <br>  
                 
            </div>
			
					
            <br />
			<div class="row">
               <label class="col-sm-2">Description</label>
               <div class="col-sm-10"><textarea type="text" name="description" class="form-control" id="description"></textarea></div>
               <div class="clearfix">
               </div>
            </div>
			<br>
            
            <div class="form-group text-center">
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
      $(".btn-success").click(function(){ 
          var lsthmtl = $(".clone").html();
          $(".increment").after(lsthmtl);
      });
	  
      $("body").on("click",".btn-danger",function(){ 
	  $(this).closest('.myclone').remove();
          //$(this).parents(".hdtuto control-group lst").remove();
		  
      });
    });
</script>
<script type="text/javascript" src="{{asset('public/admin/js/ckeditor/ckeditor.js')}}"></script>

<script>
    CKEDITOR.replace('description', {
	allowedContent:true,
      height: 300,
    filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form'
    });
  </script>

@endsection