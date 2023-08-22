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
            <h1 class="m-0 text-dark">Add Story Category</h1>
         </div>
         <div class="col-sm-6 mt-4 text-right ">
            <a href="{{route('story_category.index')}}" class="btn btn-primary"><h1 class="m-0">List Story Category</h1></a>
         </div>
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content mt-4">
   <div class="container-fluid">
      <form method="post" action="{{ route('story_category.store')}}" enctype="multipart/form-data" name="addPage" id="addPage">
       {{csrf_field()}}
      
      
			
			
           
            <div class="row">
               <label class="col-sm-2">Story Category</label>
               <div class="col-sm-10"><input type="text" name="category" id="category" class="form-control" value="{{old('category')}}"></div>
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
               <a href="/admin/story_category"  class="btn btn-primary"> Cancel</a>
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