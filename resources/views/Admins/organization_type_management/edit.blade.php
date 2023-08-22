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
            <h1 class="m-0 text-dark">Edit Organization Type</h1>
   
         </div>
        
      </div>
    
   </div>
  
</div>
<!-- /.content-header -->
<section class="content">
   <div class="container-fluid">
   
       <form method="post" action="{{route('organization_type.update',['id'=>$organization_type->id])}}" enctype="multipart/form-data" class="form-horizontal" id="addOrganizationType">
        @csrf
          @method('PUT')
         <div class="form-group">
		 <div class="row">
               <label class="col-sm-2">Organization Type</label>
               <div class="col-sm-10"><input type="text" name="type" id="type" class="form-control"  value="{{$organization_type->type}}"></div>
            </div>

              </div>
			
			  
			  <br/>
		 <div class="row">
               <label class="col-sm-2">Organization Type (ar)</label>
               <div class="col-sm-10"><input type="text" name="type_ar" id="type_ar" class="form-control"  value="{{$organization_type->type_ar}}"></div>
            </div>

              </div>
			
			  
			  <br/>
             

            <div class="form-group text-center">
               <a href="{{ url()->previous()}}"  class="btn btn-primary"> Back</a>
               <a href="{{route('organization_type.index')}}" class="btn btn-secondary">Cancel</a>
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