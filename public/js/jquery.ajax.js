var public_url = $('meta[name="base_url"]').attr('content');

function getSubmenu(parent_id,submenu_id,actionurl)
{
	if(parent_id != 'null')
	{
	 $.ajaxSetup({
		            headers: {
		              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		            }
		        });
		$.ajax({
					 type: "POST",
					 url: actionurl,
					 data: 'parent_id='+ parent_id +'&submenu_id=' + submenu_id,
					 success: function(data) 
					 {
						 $('#submenu_id').empty();
						 $('#submenu_id').html(data);


					 }
				});								
		
	}
	else
	{
			$('#submenu_id').html("<option value=''>Select Parent Menu</option>");

	}
}

