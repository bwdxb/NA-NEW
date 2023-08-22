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
            <h1 class="m-0 text-dark">Add Organization Type</h1>
         </div>
        
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content mt-4">
   <div class="container-fluid">
      <form method="post" action="{{ route('organization_type.store')}}" enctype="multipart/form-data" name="addOrganizationType" id="addOrganizationType">
       {{csrf_field()}}
      
         <div class="form-group">

           
            <div class="row">
               <label class="col-sm-2">Organization Type</label>
               <div class="col-sm-10"><input type="text" name="type" id="type" class="form-control"></div>
            </div>
			<br>
            <div class="row">
               <label class="col-sm-2">Organization Type (ar)</label>
               <div class="col-sm-10"><input type="text" name="type_ar" id="type_ar" class="form-control"></div>
            </div>
			<br>
	
            <div class="form-group text-center">
            <a href="{{ url()->previous()}}"  class="btn btn-primary"> Back</a>
               <a href="{{route('organization_type.index')}}" class="btn btn-secondary">Cancel</a>
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