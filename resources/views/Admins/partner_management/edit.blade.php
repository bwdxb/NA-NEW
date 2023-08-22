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
            <h1 class="m-0 text-dark">Edit Partner</h1>
   
         </div>
        
      </div>
    
   </div>
  
</div>
<!-- /.content-header -->
<section class="content">
   <div class="container-fluid">
   
       <form method="post" action="{{route('partner.update',['id'=>$partner->id])}}" enctype="multipart/form-data" class="form-horizontal" id="editPartner">
        @csrf
          @method('PUT')
         <div class="form-group">
		 <div class="row">
               <label class="col-sm-2">Name</label>
                <div class="col-sm-6">
				<input type="text" name="name"   class="form-control" id="name" value="{{$partner->name}}">
                </div>
                 
            </div>
			<br>
           
		 <div class="row">
               <label class="col-sm-2">Name (Ar)</label>
                <div class="col-sm-6">
				<input type="text" name="name_ar"   class="form-control" id="name_ar" value="{{$partner->name_ar}}">
                </div>
                 
            </div>
			<br>
           
			<div class="row">
               <label class="col-sm-2">Upload Logo</label>
                <div class="col-sm-6">
					<div class="fileupload fileupload-new" data-provides="fileupload">
						<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
						
						<img  @if(isset($partner->image))
									src="{{asset('public/uploads/partner/').'/'.($partner->image)}}"
								  @else
									 src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
								  @endif
									 alt="partner_image" />
								
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
					<div id="progress-div"><div id="progress-bar"></div></div>    
				</div>
				
                
                 
            </div>
			<br />
			
              </div>
			
			  
			  <br/>
             

            <div class="form-group text-center">
			   <a href="{{ url()->previous()}}"  class="btn btn-primary"> Back</a>
               <a href="{{route('partner.index')}}" class="btn btn-secondary">Cancel</a>
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




