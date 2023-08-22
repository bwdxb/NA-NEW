<?php
$options = array();
if(count($allRoles)){
	foreach ($allRoles as $role){
			$options[$role['id']]=$role['role_name'];

	}
}
?>
<style>
.floatL {
    float: right;
    padding-left: 5px;
    text-align: left;
    
}
</style>
@extends('layouts.master')
    @section('content')
        <section class="wrapper">
        	<div class="row">
	            <div class="col-md-12">
	                <section class="panel">
	                    <header class="panel-heading">
	                       Add Role
	                    </header>
	                    <div class="panel-body">
	                    	<form method="POST" name="role"  action="save_role" id="AddRoleForm">
							{{csrf_field()}}
							  <div class="d-block">
								<div class="row">
								<div class="col-lg-4">
									<input type="text" name="role_name"  autocomplete="off" class="form-control" id="role_name" >  
									<input type="hidden" name="IsActive"  class="form-control" id="IsActive" value="1">  
								  </div>
						
									<div class="col-lg-1 ">
									<input type="submit" name="add" class="btn btn-primary" value="Save" />
								 
								  </div>
								  </div>
								</div>
							  </form>
						</div>
					</section>
			</div>
		</div>
			
	@if(Session::has('message'))
  <div class="alert {{ Session::get('alert-class', 'alert-success') }}" style="margin-top: 15px;" >
	<div style="display:inline-block" id="">
	  {{ Session::get('message') }}
	</div>
  </div>
@endif 
@if(Session::has('error'))
  <div class="alert {{ Session::get('alert-class', 'alert-danger') }}" style="margin-top: 15px;" >
	<div style="display:inline-block" id="">
	  {{ Session::get('error') }}
	</div>
  </div>
@endif 
	  
	<div class="row">
		<div class="col-sm-12">
			<section class="panel">
				<header class="panel-heading">Add Permission</header>
				<div class="panel-body">
					<div class="adv-table">
						<form method="POST" name="screen"  action="save_screens" id="AddPermissionForm">
							{{csrf_field()}}								
						 <div class="input-group col-lg-4 mb-4">                                  
						<select name="role_id" class="form-control" id="role" >
						<option value="">Select Role</option>
							@foreach($options as $key=>$value) 
							
							<option value="{{$key}}">{{$value}}</option>
							
							@endforeach
							</select>
					   </div>
						<div class="floatL" >
						<input type="submit" class="btn btn-primary" name="save" value="Save" onClick="return confSubmit(this.form)">
						<a href="manage-permission" class="btn btn-secondary">Cancel</a>
						</div>
						
						<div class="card-block mt-3">
							<label style="text-align:left;"><b>Screen Lists</b></label> </br></br>
							<input type="checkbox" id="checkAll" class="checkAll" name="checkAll" style="margin-right:5px;position:relative;top:2px;">Check/Uncheck All
							
						</div>
						<table class="mt-3" width="100%" border="0" cellspacing="2" cellpadding="2">
						<tr>
								<td colspan="5">
							
						   <span style="font-weight:bold;"><?php echo 'User Management' ?> </span></td>
							
							</tr>  
					<?php
						$i=1;
						$j=0;
						$cnt = count($allScreens);
						$same_label = '';
						$count = 1;
						$test = 0;
						
						foreach($allScreens as $screen){
						
						//echo "<pre>";
						//print_r($screen);
					
							if($count || $test)
							{
								if($count)
								{
									$same_label = $screen['module'];
								}
								
								if($same_label == $screen['module'])
								{
									$count = 0;
									$test = 1;
								} else { ?>
							  <tr> <td colspan="5">&nbsp;</td></tr>  
							 <tr>
								<td colspan="4">
							
									<span style="font-weight:bold;"><?php echo $screen['module']; ?> </span></td>
							 </tr>  
							
							<?php 
								  $test = 0;
								  $count = 1;  
								  $same_label = $screen['module'];
								  $i=2;
								  }  					
														
							  }
							   
							  if($i==1){
						?>
						
						<tr>
						
						<?php } ?>
						
									<td width="31%"><?php echo trim(ucwords(str_replace('_',' ',$screen['label'])));?></td>
									<td width="2%">
									<input type="hidden" name="page_ID[]" value="<?php echo $screen['id']; ?>">
										
									<input type="checkbox" name="page_code[]" value="<?php echo $screen['page_code']; ?>" class="check" />											
									</td>
									
						<?php 
						echo '<td >&nbsp;</td>';
						if($i==3 || $cnt==$j){
							
							if($cnt==$j && $i==1){
								//echo '1';
								echo '<td "31%">&nbsp;</td>';
								echo '<td width="2%">&nbsp;</td>';
								echo '<td "31%">&nbsp;</td>';
								echo '<td width="2%">&nbsp;</td>';
							}elseif($cnt==$j && $i==2){
								//echo '2';
								echo '<td>&nbsp;</td>';
								echo '<td width="2%">&nbsp;</td>';
							}
						?>
								
							
						</tr>
						<?php } ++$i; if($i>3) {$i=0; ++$j;}
						?>
					<?php  ++$i; 
						
					
					} ?>
					</table>
					
							<div class="floatL"> 
							   
								<input type="submit" class="btn btn-primary" name="save" value="Save" onClick="return confSubmit(this.form)">
								 <a href="manage-permission" class="btn btn-secondary">Cancel</a>
								 </div>
									
						</form>
					</div>
				</div>
			</section>
		</div>
	</div>
</section>
    @endsection

    @section('script')
    
   @endsection



 
