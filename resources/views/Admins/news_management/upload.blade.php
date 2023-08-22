<form method="post" action="{{ url('csv_upload')}}" class="j-pro" enctype="multipart/form-data" >
{{csrf_field()}}
	  
 <div class="j-content">
	 
	
	  
	  <div class="j-row">
		  <div class="j-span12 j-unit">
			   <input type="file" name="csv_file" id="csv_file">
   
		</div>
	  </div>
	  
	  
	  
	  
 </div>
																	 

  <div class="j-footer">
	 <button type="submit" class="btn btn-primary">Save</button>
  </div>



  
</form>