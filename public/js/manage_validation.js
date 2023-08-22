/*Manage Screen Functions*/
	function validateCheckBoxes() 
	{
			var isValid = false;
			//alert("Check if any checkbox is not checked..."); 
			var allRows = document.getElementsByTagName("input");
			for (var i=0; i < allRows.length; i++) {
				if (allRows[i].type == 'checkbox') {
					if (allRows[i].checked == true) {
						   return true;
					}
				}
			} 
			return isValid;
	}

	function submitBtn(form,isDependent)
	{
		
     	 if (!validateCheckBoxes())
		 {
				alert("Please choose one or more record.");
		 }
		else
		{
				confDelete(form,isDependent);
		}
	}

	$(function(){ //short for $(document).ready(function(){


    $('.checkAll').click(function(){
	  // ...do this for each line
      if($(this).is(':checked'))
	  {
		  $('.check').attr('checked', true); 
	  }
	  else
	  {
		  $('.check').attr('checked', false); 
	  }
    });
	
	
	
	});



/* 
This function is used in manage roles screen.
It will check if any user is slected or not.
If yes then it checks if any roles is slected or not.

*/

	function checBoxValidation() 
	{
			var isValid = false;
			var msg='';
			var rolesArr=new Array();
			
			var allRows = document.getElementsByTagName("input"); // get all input in a form
			var rolesCount=document.getElementById('rolesCount').value; // get roles count from hidden filed.
			//alert(msg);
			/* loop through the input array and check if there is any checkbox slected */
			for (var i=0; i < allRows.length; i++) {
				if (allRows[i].type == 'checkbox' && allRows[i].name=='user_id[]') 
				{
					if (allRows[i].checked == true) 
					{
						   	isValid=true;
							rolesArr.push(allRows[i].value);
					}
				}
			}
			// if no checkbox is selected, show alert to select user
			if(!isValid)
			{
				alert('Please select at least one user');
				return false;
			}
	
			/* role check start here */
			if(rolesArr.length>0)
			{
				var roleChkName;
				for(var i=0;i<rolesArr.length;i++)
				{
					var k=0;
					var existsRole=false; // we are considering role do not exists for user first.
					for(var j=0;j<rolesCount;j++)
					{
						k=k+1;
						roleChkName = 'roles_'+rolesArr[i]+'_'+k; // prepared id for roles
						
						if(document.getElementById(roleChkName).checked==true)
						{
							existsRole=true; 
							//rolesArr.push('Please choose at least one roles for selected userID '+ rolesArr[i]);
						}
					}
					
					/* append messages for different user */
					if(!existsRole) 
					{
						var uname= 'user_name_'+rolesArr[i];
						msg=msg+'\n Please choose at least one roles for selected user "'+ document.getElementById(uname).value+'"';
					}
				}
				// Show alert to select user and its roles
				if(msg && msg!='')
				{
					alert(msg);
					return false;
				}else{
					return true;
				}
			}
			
	}
	
	function confSubmit(frm){
	var val=validateCheckBoxes();
	
	if (val==false)
		 {
				alert("Please choose one or more record.");
				return false;
		 }
		else
		{
			return true;
		}
	}
	
	
function confSubmit(frm){

var val=validateCheckBoxes();

if (val==false)

	 {
	 alert("Please choose one or more record.");
	return false;
	 }
	else
	{
		return true;
	}
}

$(document).ready(function() { 
	 $('#addBanner').submit(function(e) {
	 if($("#addBanner").validate())
	 {	
		if($('#image').val()) {
			e.preventDefault();
			//$('#loader-icon').show();
			$(this).ajaxSubmit({ 
				//target:   '#targetLayer', 
				beforeSubmit: function() {
				  $("#progress-bar").width('0%');
				},
				uploadProgress: function (event, position, total, percentComplete){	
					$("#progress-bar").width(percentComplete + '%');
					$("#progress-bar").html('<div id="progress-status">' + percentComplete +' %</div>')
				},
				success:function (){
				window.location.href = public_url+'/banner';
					
				},
				
			}); 
			return false; 
		}
		}
	});
}); 

$(document).ready(function() { 
	 $('#editBanner').submit(function(e) {
	 if($("#editBanner").validate())
	 {	
		if($('#image').val()) {
			e.preventDefault();
			//$('#loader-icon').show();
			$(this).ajaxSubmit({ 
				//target:   '#targetLayer', 
				beforeSubmit: function() {
				  $("#progress-bar").width('0%');
				},
				uploadProgress: function (event, position, total, percentComplete){	
					$("#progress-bar").width(percentComplete + '%');
					$("#progress-bar").html('<div id="progress-status">' + percentComplete +' %</div>')
				},
				success:function (){
					window.location.href = public_url+'/banner';
				},
				
			}); 
			return false; 
		}
		}
	});
}); 