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
            <h1 class="m-0 text-dark">Add Service</h1>
         </div>
        
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content mt-4">
   <div class="container-fluid">
      <form method="post" action="{{ route('service.store')}}" enctype="multipart/form-data" name="addService" id="addService">
       {{csrf_field()}}
      
         <div class="form-group">

           
            <div class="row">
               <label class="col-sm-2">Name</label>
               <div class="col-sm-10"><input type="text" name="name" id="name" class="form-control"></div>
            </div>
			<br>
			<div class="row">
               <label class="col-sm-2">Upload Image</label>
                <div class="col-sm-6">
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
				
              <br>  
                 
            </div>
            <div class="row">
               <label class="col-sm-2">Description</label>
               <div class="col-sm-10"><textarea type="text" name="description" class="form-control" id="description"></textarea></div>
               <div class="clearfix">
               </div>
            </div>
			<br>
            
            <div class="form-group text-center">
            <a href="{{ url()->previous()}}"  class="btn btn-primary"> Back</a>
                                        <a href="{{route('staticpage.index')}}" class="btn btn-secondary">Cancel</a>
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

<script type="text/javascript" src="{{asset('public/admin/js/ckeditor/ckeditor.js')}}"></script>

<script>
CKEDITOR.replace('description', {
		allowedContent:true,
        filebrowserUploadUrl: 'ckeditor/ck_upload.php',
        filebrowserUploadMethod: 'form'
    });
		//CKEDITOR.replace( 'description' );
</script>

@endsection