@extends('layouts.master')

@section('content')
<style>
.floatL {
    float: right;
    padding-left: 5px;
    text-align: left;
    
}
</style>
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
			 <form method="POST" name="screen"  action="update_screens" id="AddPermissionForm">
			 {{csrf_field()}}
                    <input type="hidden" name="role_id" value="<?php echo $_GET['id']?>">
                                              
						<div class="floatL">
						 <?php  if($_GET['status'] == 'edit') {?>
						<input type="submit" class="btn btn-primary" name="save" value="Save" onClick="return confSubmit(this.form)">
						 <?php } ?>
						<a href="manage-permission" class="btn btn-secondary">Cancel</a>
						</div>
                                               
                                                
							<div class="card-block">
								<label style="text-align:left;"><b>Screen Lists</b></label> </br></br>
								<input type="checkbox" id="checkAll" class="checkAll" name="checkAll"> Check/Uncheck All
								
							</div>
								<table width="100%" border="0" cellspacing="2" cellpadding="2">
								<tr><td colspan="5"><span style="font-weight:bold; padding:15px;"><?php echo 'User Management' ?> </span></td></tr>  
							<?php
								$i=1;
								$j=0;
								$cnt = count($allScreens);
								$same_label = '';
								$count = 1;
								$test = 0;
							   
								foreach($allScreens as $screen){
									//echo '<pre>';
									//print_r($screen);die;

									if($count || $test)
									{
										if($count)
										{
											$same_label = $screen->module;
										}
										
										if($same_label == $screen->module)
										{
											$count = 0;
											$test = 1;
										} else { ?>
									  <tr> <td colspan="5">&nbsp;</td></tr>  
									 <tr>
										<td colspan="5">
									
											<span style="font-weight:bold; padding:15px;"><?php echo $screen->module; ?> </span></td>
									 </tr>  
									
									<?php 
										  $test = 0;
										  $count = 1;  
										  $same_label = $screen->module;
										  $i=2;
										  }  					
																
									  }
									   
									  if($i==1){
								?>
								
								<tr>
								
								<?php } ?>
											<td width="31%" style="padding-left:17px;"><?php echo trim(ucwords(str_replace('_',' ',$screen->label)));?></td>
											<td width="2%">
											<input type="hidden" name="page_ID[]" value="<?php echo $screen->page_id; ?>">
											
											<input type="checkbox" name="page_code[]" value="<?php echo $screen->page_code; ?>" <?php if($screen->allowed=='Y'){?> checked=checked <?php }?> class="check" <?php if($_GET['status'] == 'view'){?> disabled="true" <?php }?> />
											<input type="hidden" name="isEdit" value="1" >											
											</td>
											
								<?php 
								echo '<td >&nbsp;</td>';
								if($i==3 || $cnt==$j){
									
									if($cnt==$j && $i==1){
										
										echo '<td "31%">&nbsp;</td>';
										echo '<td width="2%">&nbsp;</td>';
										echo '<td "31%">&nbsp;</td>';
										echo '<td width="2%">&nbsp;</td>';
									}elseif($cnt==$j && $i==2){
										
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
                                                       <?php if($_GET['status'] == 'edit') {?>
                                                        <input type="submit" class="btn btn-primary" name="save" value="Save" onClick="return confSubmit(this.form)">
                                                        <?php }?>
                                                        <a href="manage-permission" class="btn btn-secondary">Cancel</a>
                                                            
                                                            </form>
	</div>
				
		</section>
		</div>
	</div>
</section>

@endsection