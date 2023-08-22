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
						<h1 class="m-0 text-dark">Add Category Course</h1>
					 </div>
					
				  </div>
				  <!-- /.row -->
			   </div>
			   <!-- /.container-fluid -->
			</div>
<!-- /.content-header -->
<section class="content mt-4">
   <div class="container-fluid">
      <form method="post" action="{{route('course_category.store')}}" enctype="multipart/form-data" class="form-horizontal" id="addOrganizationType">
       {{csrf_field()}}
	  
      
         <div class="form-group">

	
         <div class="row">
               <label class="col-sm-2">Course Category</label>
               <div class="col-sm-10"><select name="category" id="category" class="form-control" required >
                  <option value="">Select course category</option>
                  <option value="NAEMT" @if($course->category =='NAEMT') selected @endif>NAEMT</option>
                  <option value="AHA"  @if($course->category =='AHA') selected @endif>AHA</option>
                  <option value="ASHI"  @if($course->category =='ASHI') selected @endif>ASHI</option>
                  <option value="EMS"  @if($course->category =='EMS') selected @endif>EMS</option>
               </select></div>
            </div>
			<br>
         
         <div class="row">
               <label class="col-sm-2">Course Name</label>
               <div class="col-sm-10"><input type="text" name="title" id="title" class="form-control" required value="{{$course->title}}"></div>
            </div>
			<br>
            <div class="row">
               <label class="col-sm-2">Course Name (ar)</label>
               <div class="col-sm-10"><input type="text" name="title_ar" id="title_ar" class="form-control" required value="{{$course->title_ar}}"></div>
            </div>
			<br>
          
            <div class="form-group text-center">
            <a href="{{ url()->previous()}}"  class="btn btn-primary"> Back</a>
               <a href="{{url('/admin/course_category')}}" class="btn btn-secondary">Cancel</a>
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