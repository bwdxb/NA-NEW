@extends('layouts.master')
@section('content')
<section class="wrapper"> 
<div class="row">
	<div class="col-sm-12">
		<section class="panel">
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Sub Admin</h1>
          </div><!-- /.col -->
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
<form action="{{route('subAdmin.update',$users->id)}}" method="post" id="addSubAdmin" name="addSubAdmin" >
@csrf
				<div class="form-group">
            <div class="row">
               <label class="col-sm-3">First Name</label>
                <div class="col-sm-6"><input type="text" name="first_name" id="first_name" class="form-control" value="{{$users->first_name }}">
                </div>
                 <div class="clearfix">
                 </div>
            </div>
			<br>
			<div class="row">
               <label class="col-sm-3">Last Name</label>
                <div class="col-sm-6"><input type="text" name="last_name" id="last_name" class="form-control" value="{{$users->last_name }}">
                </div>
                 <div class="clearfix">
                 </div>
            </div>
			<br />
			<div class="row">
               <label class="col-sm-3">Email</label>
                <div class="col-sm-6"><input type="email" name="email" id="email" class="form-control" value="{{$users->email }}">
                </div>
                 <div class="clearfix">
                 </div>
            </div>
			<br />
			<div class="row">
               <label class="col-sm-3">Phone Number</label>
                <div class="col-sm-6"><input type="text" name="mobile" id="mobile" class="form-control" value="{{$users->mobile }}">
				
                </div>
                 <div class="clearfix">
                 </div>
            </div>
			<br />
			<div class="row">
               <label class="col-sm-3">Gender</label>
                <div class="col-sm-6">
				<select name="gender" id="gender" class="form-control">
				<option value="">Select Gender</option>
				<option value="male" @if($users->gender == 'male') selected  @endif>Male</option>
				<option value="female" @if($users->gender == 'female') selected  @endif>Female</option>
				</select>
				
                </div>
                 <div class="clearfix">
                 </div>
            </div>
			<br />
			<div class="row">
               <label class="col-sm-3">Date of Birth</label>
                <div class="col-sm-6"><input type="text" name="date_of_birth" id="date_of_birth" class="form-control" value="{{$users->date_of_birth }}">
                </div>
                 <div class="clearfix">
                 </div>
            </div>
			</br>

              
                <div class ="row">
                <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Management</th>
          <th>ADD</th>
          <th>EDIT</th>
		  <th>DELETE</th>
		  <th>STATUS</th>
      </tr>
    </thead>
    <tbody>
    <?php
			$i=1;
			$j=0;
			$cnt = count($allScreens);
			$same_label = '';
			$count = 1;
			$test = 0;
			
			foreach($allScreens as $screen){

				if($count || $test)
				{
					
					if($same_label == $screen->module)
					{
						$count = 0;
						$test = 1;
				 	} else { ?>
                  
				 <tr>
                    <td><span style="font-weight:bold; padding:15px;"><?php echo $screen->module; ?> </span></td>
					
				<?php 
					  $test = 0;
					  $count = 1;  
					  $same_label = $screen->module;
					  $i=2;
					  }  					
					 				     	
				  }	   
				  
			?>
						<td >
						<input type="checkbox" name="access_management_id[]" value="<?php echo $screen->id ?>"  <?php if(in_array($screen->id,$accessRole)) { ?> checked="checked" <?php }?>/>						
						</td>
						
			
		<?php  
			
		
		} ?>
    </tbody>
  </table>
            
            </div> 
        <button type="submit" class="btn btn-primary">Submit</button>
		<button type="reset" class="btn btn-danger">Cancel</button>
    </form>
</div>
</section>
	</section>
		
		
	</div>
</div>

@endsection

@section('script')

@endsection
<script src="http://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( "#date_of_birth" ).datepicker();
</script>
</section>