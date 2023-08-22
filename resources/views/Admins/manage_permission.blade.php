@extends('layouts.master')

@section('content')

<section class="wrapper"> 
<div class="row">
  <div class="col-md-12">
	  <section class="panel">
		@if(Session::has('success'))
		  <div class="alert alert-success alert-block">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
			  </button>
		  <strong>{{ session('success') }}</strong>
		  </div>
		@endif 
		@if(Session::has('fail'))
		  <div class="alert alert-danger alert-block">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
			  </button>
		  <strong>{{ session('fail') }}</strong>
		  </div>
		@endif 

	  </section>
  </div>
</div>

	  
<div class="row">
  <div class="col-sm-12">
	  <section class="panel">
		  
		  <div class="panel-body">
			<div class="adv-table"  >
			 <form method="POST" action="add_permission" name="roles" onSubmit="return checBoxValidation();">
			 {{csrf_field()}}
			<table id="DataGrid" cellpadding="0" cellspacing="0" style="float:left;">
			
			 
				<tr>
				 
				  <th width="270px;" style=" padding:10px;">RoleName</th>
				  <th width="270px;" style=" padding:10px;">Actions</th>
				</tr>
				<?php
					
					if(count($allRoles)){
					foreach($allRoles as $role){
						
					
				?>
			   <tr>
				   <td style="padding:10px;"><?php echo $role['role_name']?></td>
				   <td  style="padding:10px;">
					 <div class="floatL">
					<!-- <a href="edit_permission?id=<?php echo $role['id']?>&status=view" class="btn btn-primary" ><i class="fa fa-eye"></i> </a>  -->
					 <a href="edit-permission?id=<?php echo $role['id']?>&status=edit" class="btn btn-primary" title="Edit"><i class="fa fa-edit"></i></a> </div> 
				   
				  
				  
				   </td>	
					   
				  </tr>
				<?php } 
				} else {
				?>  
				  <tr>
					<td colspan="2"> <?php echo "Currently no result found."; ?></td>
				<?php } ?>
				</tr>
			</table>
                                                        
                                                        
		</form>
	</div>
				
		</section>
		</div>
	</div>
</section>

@endsection