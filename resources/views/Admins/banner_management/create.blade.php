@extends('layouts.master')
@section('content')
<style>
#progress-bar {background-color: #12CC1A;height:20px;color: #FFFFFF;width:0%;-webkit-transition: width .3s;-moz-transition: width .3s;transition: width .3s;}
#progress-div {border:#0FA015 1px solid;padding: 5px 0px;margin:30px 0px;border-radius:4px;text-align:center;}
</style>
<section class="wrapper"> 
<div class="row">
	<div class="col-sm-12">
		<section class="panel">
			<div class="content-header">
			   <div class="container-fluid">
				  <div class="row mb-2">
					 <div class="col-sm-6 mt-4">
						<h1 class="m-0 text-dark">Create Banner</h1>
			   
					 </div>
					
				  </div>
				
			   </div>
			  
			</div>
<!-- /.content-header -->
<section class="content">
   <div class="container-fluid">
   
       <form method="post" action="{{route('banner.store')}}" enctype="multipart/form-data" class="form-horizontal" id="addBanner">
	  
        @csrf
          
         <div class="form-group">
		 <div class="row">
               <label class="col-sm-2">Banner Name</label>
                <div class="col-sm-6">
				<input type="text" name="name" class="form-control" id="name" value="{{old('name')}}">
                </div>
                 
            </div>
			<br>
            <div class="row">
               <label class="col-sm-2">Sequence Number</label>
                <div class="col-sm-6"><input type="text" name="sequence_number"  class="form-control" id="sequence_number" value="{{old('sequence_number')}}">
                </div>
                 
            </div>
			<br>
            <div class="row">
               <label class="col-sm-2">File Type</label>
                <div class="col-sm-6">
				<select name="file_type" class="form-control" id="file_type">
				<option value="image">Image</option>
				<option value="video">Video</option>
				</select>
                </div>
                 
            </div>
			<br>
			<div class="row">
               <label class="col-sm-2">Banner Image/Video url</label>
                <div class="col-sm-6">
				<input type="text" name="image" class="form-control" id="image" value="{{old('image')}}">
                </div>
                 
            </div>
			<br>

			<div class="row">
               <label class="col-sm-2">Banner Image/Video Mobile url</label>
                <div class="col-sm-6">
				<input type="text" name="image_mob" class="form-control" id="image_mob" value="{{old('image_mob')}}">
                </div>
                 
            </div>
			<br>
			<!-- <div class="row">
               <label class="col-sm-2">Upload Image/Video</label>
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
								<input type="file" name="image" id="image" class="default" />
							</span>
							
							
							
						</div>
					</div>
					
					<div id="progress-div"><div id="progress-bar"></div></div>    
            </div>
			
			
              </div>
			<div class="row">
               <label class="col-sm-2">Upload Mobile Image/Video</label>
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
								<input type="file" name="image_mob" id="image" class="default" />
							</span>
							
							
							
						</div>
					</div>
					
					<div id="progress-div"><div id="progress-bar"></div></div>    
            </div>
			
			
              </div> -->
			
			  <br />
			 

            <div class="form-group text-center">
			<a href="{{ url()->previous()}}"  class="btn btn-primary"> Back</a>
               <a href="{{route('banner.index')}}" class="btn btn-secondary">Cancel</a>
               <input type="submit" class="btn btn-secondary" value="Save">
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

@section('script')

@endsection



