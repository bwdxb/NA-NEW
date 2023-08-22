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
						<h1 class="m-0 text-dark">Edit Public Awareness Category</h1>
					 </div>
					
				  </div>
				  <!-- /.row -->
			   </div>
			   <!-- /.container-fluid -->
			</div>
<!-- /.content-header -->
<section class="content mt-4">
   <div class="container-fluid">
      <form method="post" action="{{route('public_awareness_category.update',['id'=>$data->id])}}" enctype="multipart/form-data" class="form-horizontal" id="addOrganizationType">
       {{csrf_field()}}
	   @method('PUT')
      
         <div class="form-group">

           
            <div class="row">
               <label class="col-sm-2">Category Name</label>
               <div class="col-sm-10"><input type="text" name="name" id="name" class="form-control"  value="{{$data->name}}"></div>
            </div>
			<br>
            <div class="row">
               <label class="col-sm-2">Category Name (ar)</label>
               <div class="col-sm-10"><input type="text" name="name_ar" id="name_ar" class="form-control"  value="{{$data->name_ar}}"></div>
            </div>
			<br>
	
            <div class="form-group text-center">
               <a href="{{ url()->previous()}}"  class="btn btn-primary"> Back</a>
               <a href="{{url('/admin/public_awareness_category')}}" class="btn btn-secondary">Cancel</a>
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