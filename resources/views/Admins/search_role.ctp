<div id="rightpanel">
<h1>Manage Permissions</h1>

    <div class="searcharea">

<?php echo $this->Form->create('Admin',array('action'=>'manage_permission'));?>
	<div class="floatL">
		<?php echo $this->Form->input('Role', array('type'=>'text'));?>		
		<?php echo $this->Form->input('type', array('type'=>'hidden','value'=>'search'));?>	    				    </div>
	<div class="floatL">

	   <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;";?><?php echo $this->Form->button('Search',array('class'=>'submitbtn'));
	        echo $this->Form->end();?></div>

	  </div>


<table id="DataGrid" cellpadding="0" cellspacing="0">
	
    <tr>
    <td colspan="7">
    	
        <div  class="buttonalign">
        		<div class="floatL"><?php echo $this->html->link('Back',array('action'=>'manage_permission') ,array('class'=>'addsubmitbtn1'));?>  </div>
       			<div class="floatL"><?php echo $this->html->link('Add', array('action'=>'add_permission') , array('class' => 'addsubmitbtn1' ));?>
   	   </div>
    
    </td>
    
    </tr>

 
    <tr>
      <!--<th><?php echo $this->Form->input('', array('type'=>'checkbox', 'class' => 'checkAll'));?></th>-->
      <th width="270px;">Role Name</th>
      <th>Actions</th>
    </tr>
	<?php
		if(count($allRoles) > 0) {	
		foreach($allRoles as $role){
		
	?>
   <tr>
      <!-- <td><?php echo $this->Form->input('', array('type'=>'checkbox', 'class' => 'checkbox'));?></td>-->
       <td><?php echo $role['Role']['role_name'];?></td>
	   <td><?php echo $this->html->link('View / Edit',array('action'=>'edit_permission','?'=>array('id'=>$role['Role']['id'])));?></td>	  
      </tr>
    <?php } 
		} else { ?>
		
	<tr> <td colspan="5"><?php echo NoResult; ?></td>	</tr>
		
	<?php }?> 
	       
</table>


     
   
        
       </div>
</div>
