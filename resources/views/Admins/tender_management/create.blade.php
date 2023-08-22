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
            <h1 class="m-0 text-dark">Add Tender</h1>
         </div>
        
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content mt-4">
   <div class="container-fluid">
      <form method="post" action="{{ route('tender.store')}}" enctype="multipart/form-data" name="addTender" id="addTender">
       {{csrf_field()}}
      
         <div class="form-group">

           
            <div class="row">
               <label class="col-sm-2">Name</label>
               <div class="col-sm-10"><input type="text" name="name" id="name" class="form-control"></div>
            </div>
			<br>
            <div class="row">
               <label class="col-sm-2">Name (ar)</label>
               <div class="col-sm-10"><input type="text" name="name_ar" id="name_ar" class="form-control"></div>
            </div>
			<br>
			<div class="row">
               <label class="col-sm-2">Publishing Date</label>
                <div class="col-sm-9">
				
					<div class="input-group date" data-provide="datepicker">
					<input type="text" readonly="" class="form-control" name="publishing_date">
						<div class="input-group-addon">
							<span class="glyphicon glyphicon-th"></span>
						</div>
					</div>
				
				</div>
			 </div>
			 <br />
			 <div class="row">
               <label class="col-sm-2">Closing Date</label>
                <div class="col-sm-9">
				
					<div class="input-group date" data-provide="datepicker">
					<input type="text" readonly="" class="form-control" name="closing_date">
						<div class="input-group-addon">
							<span class="glyphicon glyphicon-th"></span>
						</div>
					</div>
				
				</div>
			 </div>
           
			<br />
			<div class="row">
               <label class="col-sm-2">Upload File</label>
                <div class="col-sm-6">
					<div class="fileupload fileupload-new" data-provides="fileupload">
						<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
							<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
						</div>
						<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
						<div>
							<span class="btn btn-white btn-file">
								<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select File</span>
								<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
								<input type="file" name="upload_file" class="default" />
							</span>
							
						</div>
					</div>
				</div>
				
              <br>  
                 
            </div>
			<br>
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
            
			<br>
            
            <div class="form-group text-center">
            <a href="{{ url()->previous()}}"  class="btn btn-primary"> Back</a>
                                   <a href="{{route('tender.index')}}" class="btn btn-secondary">Cancel</a>
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
<script src="https://cdn.ckeditor.com/4.16.0/standard-all/ckeditor.js"></script>

<script>
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