@extends('layouts.master')

@section('content')
 <!-- Content Header (Page header) -->
 <style type="text/css">
  tr,th,td{
    min-width: 150px;
  }
</style>  
<section class="wrapper">
<!-- page start-->

<div class="row">
	<div class="col-sm-12">
		<section class="panel">
			<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 mt-4">
            <h1 class="m-0 text-dark">Website Launch Config</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
   <div class="content">

   <div class="container-fluid">
   <form method="post" action="#">
   <fieldset class="form-group">
    <div class="row">
      <legend class="col-form-label col-sm-2 pt-0">Launch Status</legend>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="status" id="status1" value="option1" checked>
          <label class="form-check-label" for="status1">
            Enable
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="status" id="status2" value="option2">
          <label class="form-check-label" for="status2">
            Disable
          </label>
        </div>
        
      </div>
    </div>
  </fieldset>
  <div class="form-group">
    <label for="inputCountdown">Launch Countdown (in Seconds)</label>
    <input type="number" name="countdown" class="form-control" id="inputCountdown" placeholder="Countdown in seconds">
  </div>

 
 
  <button type="submit" class="btn btn-primary">Launch</button>
</form>

    </div> 
		 
   </div>
    </div>
		</section>
		
		
	</div>
</div>

   <script>
  </script> 
  
</section>
    
@endsection