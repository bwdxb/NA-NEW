<div id="rightpanel">


<div class="stylized">
<h1>Admin Dashboard</h1>

<div class="MindformFull">
<div class="stylizedfull">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="60%" valign="top">
	
    
		<fieldset>
            <legend>Latest 5 User Added</legend>
            
            <table width="100%" cellspacing="0" cellpadding="0" id="DataGrid">
               <tbody><tr>
                  <th>Name</th>
                  <th>Created By</th>
                  <th>Created Date</th>
                </tr>
            
             <tr>
                   <td>Role 1</td>
                   <td>Admin</td>
                   <td>22 May 2013</td>
              </tr>
            
             <tr>
				    <td>Role 2</td>
                   <td>Delivery Head</td>
                   <td>23 May 2013</td>
             </tr>
            <tr>
            	   <td>Role 3</td>
                   <td>Curriculum Head</td>
                   <td>24 May 2013</td>
           </tr>
           
            <tr>
            	   <td>Role 4</td>
                   <td>Admin</td>
                   <td>25 May 2013</td>
           </tr>
           
            <tr>
            	   <td>Role 5</td>
                   <td>Admin</td>
                   <td>26 May 2013</td>
           </tr>
            
            <tr>
				<td colspan="5"></td>
			</tr>
                            
          </tbody></table>
           
		</fieldset>
	
	

	<div class="stylizedfull">

        <fieldset>
            <legend>Today's Course Session Log</legend>
    
    		 <table width="100%" cellspacing="0" cellpadding="0" id="DataGrid">
               <tbody><tr>
               	  <th>Faculty Name</th>
                  <th>Log Time</th>
              </tr>
            
             <tr>
                   <td>Faculty 1</td>
                   <td>2-5-2013 10:53:10</td>
            </tr>
            
             <tr>
                   <td>Faculty 2</td>
                   <td>2-5-2013 10:53:10</td>
            </tr>
           <tr>
                   <td>Faculty 3</td>
                   <td>2-5-2013 10:53:10</td>
            </tr>
          
          	<tr>
	<td colspan="5"></td>
</tr>
          </tbody></table>
           
           <?php echo $this->html->link('View More...',array('action'=>'#'), array('class'=>'nolink'));?>
        
        </fieldset>

	</div>

	<div class="stylizedfull">

		<fieldset>
        	<legend>Quick Links</legend>
			
             <ul>
            
                <li class="dash_icons padding-15">
                    <a href="manage_student"><div class="icon"><img src="../img/student_dash.png" title="Manage User"/></div></a>
                </li>
                <li class="dash_icons padding-15">
                    <a href="manage_assgn"><div class="icon"><img src="../img/assignment_dash.png" title="Manage Assignment"/></div></a>
                </li>
                <li class="dash_icons padding-10">
                    <a href="faculty_help"><div class="icon"><img height="42" width="42" src="../img/helpdesk_dash.png" title="Helpdesk Request"/></div></a>
                </li>
                <li class="dash_icons padding-15">
                    <a href="course_compl"><div class="icon"><img src="../img/course_dash.png" title="Corse Delivered"/></div></a>
                </li>
                <li class="dash_icons padding-10">
                    <a href="manage_batch"><div class="icon"><img src="../img/batch_dash.png" height="45" width="40" title="Manage Batch"/></div></a>
                </li>
                 <li class="dash_icons padding-15">
                    <a href="#"><div class="icon"><img src="../img/backup_dash.png"  height="42" width="40" title="Backup Report"/></div></a>
                </li>
                 <li class="dash_icons" style="padding: 15px 7px;">
                    <a href="#"><div class="icon"><img src="../img/asset_dash.png"  height="42" width="40" title="Manage Asset"/></div></a>
                </li>
                <li class="dash_icons padding-15">
                    <a href="#"><div class="icon"><img src="../img/level_dash.png"  height="42" width="40" title="Manage Level"/></div></a>
                </li>
                 <li class="dash_icons padding-15">
                    <a href="#"><div class="icon"><img src="../img/lessons_dash.png"  height="42" width="40" title="Manage Lesson"/></div></a>
                </li>
                 <li class="dash_icons padding-15">
                    <a href="#"><div class="icon"><img src="../img/schemes_dash.png"  height="42" width="40" title="Manage Scheme"/></div></a>
                </li>
                <li class="dash_icons padding-15">
                    <a href="#"><div class="icon"><img src="../img/program_dash.png"  height="42" width="40" title="Manage Scheme"/></div></a>
                </li>
                
            </ul>
		
			
		</fieldset>

	</div>

	
    
    
</td>


<td width="40%" valign="top">

	<div class="stylizedfull">

        <fieldset>
            <legend>Last Login</legend>
            
    		<div style="padding: 5px 0px 10px;">
            &nbsp;&nbsp;23 May 2013 at &nbsp;&nbsp;10:30 am
            </div>  
            
       </fieldset>
        
        <fieldset>
            <legend>Profile</legend>
            
    		<div style="padding: 4px 5px;">
             <?php echo $this->html->link('Update Your Profile',array('action'=>'edit_faculty'), array('class'=>'nolink'));?>
            </div>  
            
                     
        </fieldset>

	</div>
    
    
	<div class="stylizedfull">
		<fieldset>
        
        	<legend>Latest Activities</legend>
            
            <table width="100%" cellspacing="0" cellpadding="0" id="DataGrid">
               <tbody>
               <tr>
                  <th>Action</th>
                  <th>Performed On</th>
               </tr>
            
             <tr>
                  
                   <td>Added Program </td>
                   <td>15 May 2013</td>
             </tr>
            
             <tr>
				 
                   <td>Added Lenove Laptop</td>
                   <td>18 May 2013</td>
            </tr>
            <tr>
            	  
                   <td>Edit Lesson 4</td>
                   <td>20 May 2013</td>
             </tr>
                         
                            
          </tbody></table>
			
            <?php echo $this->html->link('View More...',array('action'=>'#'), array('class'=>'nolink'));?>
        
        </fieldset>
	</div>
	
    <div class="stylizedfull">
		<fieldset>
        
        	<legend>Last 5 Online Activities</legend>
            
            <table width="100%" cellspacing="0" cellpadding="0" id="DataGrid">
               <tbody>
               <tr>
                  <th>Action</th>
                  <th>Performed On</th>
               </tr>
            
             <tr>
                  
                   <td>Activity 1</td>
                   <td>15 May 2013</td>
             </tr>
            
             <tr>
				 
                   <td>Activity 2</td>
                   <td>18 May 2013</td>
            </tr>
            <tr>
            	  
                   <td>Activity 3</td>
                   <td>20 May 2013</td>
             </tr>
             <tr>
            	  
                   <td>Activity 4</td>
                   <td>21 May 2013</td>
             </tr>
             <tr>
            	  
                   <td>Activity 5</td>
                   <td>23 May 2013</td>
             </tr>      
                                 
          </tbody></table>
		
        	  <?php echo $this->html->link('View More...',array('action'=>'#'), array('class'=>'nolink'));?>
        </fieldset>
	</div>
	
    <div class="stylizedfull">
		<fieldset>
        
        	<legend>Latest Helpdesk Request</legend>
            
            <table width="100%" cellspacing="0" cellpadding="0" id="DataGrid">
               <tbody>
               <tr>
                  <th>Request Type</th>
                  <th>Date</th>
               </tr>
            
             <tr>
                  
                   <td>Request Type 1</td>
                   <td>15 May 2013</td>
             </tr>
            
             <tr>
				 
                   <td>Request Type 2</td>
                   <td>18 May 2013</td>
            </tr>
            <tr>
            	  
                   <td>Request Type 3</td>
                   <td>20 May 2013</td>
             </tr>
             <tr>
            	  
                   <td>Request Type 4</td>
                   <td>21 May 2013</td>
             </tr>
                            
          </tbody></table>
          
           <?php echo $this->html->link('View More...',array('action'=>'#'), array('class'=>'nolink'));?>
		
        </fieldset>
	</div>
    
    <div class="stylizedfull">
		<fieldset>
        
        	<legend>Password Reset Request</legend>
            
            <table width="100%" cellspacing="0" cellpadding="0" id="DataGrid">
               <tbody>
               <tr>
                  <th>User Name</th>
                  <th>Date</th>
               </tr>
            
             <tr>
                  
                   <td>Delivery Head 2</td>
                   <td>15 May 2013</td>
             </tr>
            
             <tr>
				 
                   <td>Curriculum Head</td>
                   <td>18 May 2013</td>
            </tr>
            <tr>
            	  
                   <td>Faculty Name 12</td>
                   <td>20 May 2013</td>
             </tr>
             
                      	  
                          
                            
          </tbody></table>
          
           <?php echo $this->html->link('View More...',array('action'=>'#'), array('class'=>'nolink'));?>
		
        </fieldset>
	</div>
    
    <div class="stylizedfull">
		<fieldset>
        
        	<legend>Site Statistics</legend>
            
            <div style="padding:7px;"><b>No. of Logged in Users</b> - 3</div>
            <div style="padding:7px;"><b>Total Users</b> - 50</div>
            
					
        </fieldset>
	</div>

    
</td>

</tr>

<tr>
	<td colspan="5"></td>
</tr>

</table>
</div>
</div>





      </div> 
           
          
          
          
  </div> 
  	 
