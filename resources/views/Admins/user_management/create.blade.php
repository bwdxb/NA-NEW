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
            <h1 class="m-0 text-dark">Create User</h1>
            
        
            
         </div>
         <!-- /.col -->
        
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
   <div class="container-fluid">
   
      <form method="post" action="{{ route('user.store')}}" name="userForm" id="userForm" enctype="multipart/form-data">
	  
        @csrf
          <!-- @method('PUT') -->
         <div class="form-group">
		 <div class="row">
               <label class="col-sm-2">Select Role</label>
                <div class="col-sm-6">
				<select name="role_id" class="form-control" id="role_id" >
				<option value="">Select Role</option>
					@foreach($allRoles as $key=>$value) 
					
					<option value="{{$key}}">{{$value}}</option>
					
					@endforeach
					</select>
                </div>
                 
            </div>
			<br>
            <div class="row">
               <label class="col-sm-2">First Name</label>
                <div class="col-sm-6"><input type="text" name="first_name" id="first_name" class="form-control" value="{{old('first_name')}}">
                </div>
                 
            </div>
			<br>
			<div class="row">
               <label class="col-sm-2">Last Name</label>
                <div class="col-sm-6"><input type="text" name="last_name" id="last_name" class="form-control" value="{{old('last_name')}}" >
                </div>
                 
            </div>
			<br />
			<!-- <div class="row">
               <label class="col-sm-2">Phone Number</label>
                <div class="col-sm-6"><input type="text" name="mobile" id="mobile" class="form-control" value="{{old('mobile')}}">
				
                </div>
                 
            </div>
			<br /> -->
			<div class="row">
               <label class="col-sm-2">Designation</label>
                <div class="col-sm-6"><input type="text" name="designation" id="designation" class="form-control" value="{{old('designation')}}">
				
                </div>
                 
            </div>
			<br />
         <div class="row">
               <label class="col-sm-2">Email Address</label>
                <div class="col-sm-6"><input type="email" name="email" id="email" class="form-control" value="{{old('email')}}">
            
                </div>
                 
            </div>
         <br />
			<div class="row">
               <label class="col-sm-2">Password (default password will be '12345678')</label>
                <div class="col-sm-6"><input type="password" name="password" id="password" class="form-control" value="{{old('password')?old('password'):'12345678'}}">
				
                </div>
                 
            </div>
			<br />
			
              </div>
			
			  
			  <br/>
             

            <div class="form-group text-center">
            <a href="{{ url()->previous()}}"  class="btn btn-primary"> Back</a>
                                   <a href="{{route('user.index')}}" class="btn btn-secondary">Cancel</a>
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

<script type="text/javascript">
    
     function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah')
                .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>


@endsection




