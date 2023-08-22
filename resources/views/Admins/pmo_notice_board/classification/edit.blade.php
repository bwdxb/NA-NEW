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
            <h1 class="m-0 text-dark">Edit Document Classification</h1>
         </div>
         
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
   <div class="container-fluid">
      <form method="post" action="{{ route('document_library.classification.update',$data->id)}}" enctype="multipart/form-data" name="forms" id="editPage" class="mt-5">
         {{csrf_field()}}
         @method('PUT')

			
			
            <div class="row">
               <label class="col-sm-2">Document Type</label>
               <div class="col-sm-10"><input type="text" name="classification" id="classification" class="form-control" value="{{$data->classification}}"></div>
            </div>
			<br />
			<div class="row">
               <label class="col-sm-2">Updated By</label>
                <div class="col-sm-10"><input type="text" name="updated_by"  class="form-control" id="updated_by" value="{{Auth::user()->first_name.' '.Auth::user()->last_name}}">
                </div>
                 
            </div>
			<br />
			
         <div class="form-group mt-5">
            <div class="form-row justify-content-end">           
               <a href="{{ url()->previous()}}"  class="btn btn-primary"> Back</a>
               <a href="{{url('/admin/document_library_classification')}}" class="btn btn-secondary">Cancel</a>
               <input type="submit" class="btn btn-primary" value="Update" style="margin-left:15px;">
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
