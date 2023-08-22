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
            <h1 class="m-0 text-dark">Add Document Type</h1>
         </div>
         <div class="col-sm-6 mt-4 text-right ">
            <a href="{{route('document_library_type.index')}}" class="btn btn-primary"><h1 class="m-0">List All Document Type</h1></a>
         </div>
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content mt-4">
   <div class="container-fluid">
      <form method="post" action="{{ route('document_library.type.store')}}" enctype="multipart/form-data" name="addPage" id="addPage">
       {{csrf_field()}}
      
      
			
			
           
            <div class="row">
               <label class="col-sm-2">Document Type</label>
               <div class="col-sm-10"><input type="text" name="type" id="type" class="form-control" value="{{old('type')}}"></div>
            </div>
			<br />
			<div class="row">
               <label class="col-sm-2">Created By</label>
                <div class="col-sm-10"><input type="text" disabled name="created_by"  class="form-control" id="created_by" value="{{Auth::user()->first_name.' '.Auth::user()->last_name}}">
                </div>
                 
            </div>
			<br />
			
			
				
              
			
            
			
            <div class="form-group text-center">
            <a href="{{ url()->previous()}}"  class="btn btn-primary"> Back</a>
               <a href="/admin/document_library_type"  class="btn btn-primary"> Cancel</a>
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