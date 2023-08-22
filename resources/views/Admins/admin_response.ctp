

<div id="rightpanel">

         <h1>Admin Request Handler</h1>
<?php echo $this->Form->create('Admin',array('action'=>'admin_response'));?>
	 <div class="searcharea">
<div class="floatL">
<table style="font-family:Verdana, Geneva, sans-serif">
<tr>
<td><b>Total Requests:</b></td>
<td><b>256</b></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><b>Request Responded:</b></td>
<td><b>156</b></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><b>Request Not Responded:</b></td>
<td><b>100</b></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><b>New Requests:</b></td>
<td><b>56</b></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>

<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>

</tr>
</table>
</div>

</div>

<div class="searcharea">

<div class="floatL">&nbsp;<b>Start Date:</b><input id="popupDatepicker" type="text" >
	  </div>

<div class="floatL">&nbsp;<b>End Date :</b><input type="text" id="popupDatepicker1" name="to">
	  </div>



<div class="floatL">
 <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?><?php echo $this->Form->button('Search',array('class'=>'submitbtn'));
	        echo $this->Form->end();?></div>
</div>




<table id="DataGrid" cellpadding="0" cellspacing="0">	

 <tr>
<th><?php echo $this->Form->input('', array('type'=>'checkbox'));?></th>
      <th>Sr. No</th>
      <th>Request Type</th>
      <th>Sender</th>
      <th>Reciever</th>
      <th>Description</th>
      <th>Status</th>
      
</tr>


     <tr>
      <td><?php echo $this->Form->input('', array('type'=>'checkbox'));?></td>
      <td>1.</td>
      <td><?php echo "Request 1";?></td>
      <td><?php echo "Mr. Rahul(MBNSD-001)";?></td>
      <td><?php echo "Curriculum Head";?></td>
      <td><?php echo  "Not able to upload Assignment";?></td>
      <td><?php echo $this->Html->link('Reply Pending',array('action'=>'conversation_thread'));
	            echo $this->Form->end();?></td>
     </tr>
  
   
  </table>

<div  class="buttonalign">
<?php echo $this->Form->create('Admin',array('action'=>'admin_response'));?>
	   <div class="floatL"><?php echo $this->Form->button('Delete',array('class'=>'submitbtn','onclick'=>'confSubmit(this.form)'));
	        echo $this->Form->end();?></div>
		
		
		
            </div>

</div>
</div>

