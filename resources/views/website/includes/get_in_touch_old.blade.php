@php
use app\Http\helper\Helper as Helper;
$countries = Helper::getAllCountries();

@endphp
<div class="row">			  
  <div class="col-md-12">

	  <div class="form_panel">
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
				
			<form method="post" class="generalForm" action="{{url('contact_store')}}" id="contactForm" name="contactForm" enctype="multipart/form-data">
				 {{csrf_field()}}
				  <div class="form_column">
					  <h5>Contact Information</h5>
					  <div class="row">
						  
							  <div class="form-group col-md-12">
								<select id="inputCountry" name="enquiry_type" class="form-control" >
									<option value="">Type of Enquiry</option>
									<option value="General Enquiry">General Enquiry</option>
									<option value="Procurement and Supply Chain">Procurement and Supply Chain</option>
									<option value="Education and Training">Education and Training</option>
									<option value="Events� Ambulance Coverage">Event's Ambulance Coverage</option>
									<option value=" Non-Emergency Medical Transport"> Non-Emergency Medical Transport</option>
									<option value="Emergency Medical Services">Emergency Medical Services</option>
									<option value="Media">Media</option>
									<option value="Website Issues">Website Issues</option>	
								  </select>
							</div>
							  
						  </div>
					  <div class="row">
					  <div class="form-group col-md-2">
							  <select id="title" name="title" class="form-control" >
							  <option value="">Select</option>
							  <option value="Mr">Mr</option>
							  <option value="Mrs">Mrs</option>
							  <option value="Miss">Miss</option>
							  </select>
						  </div>
					  <div class="form-group col-md-8">
							  <input type="text" class="form-control" name="name" placeholder="Name *">
						  </div>  
					  </div>
					  <div class="row">
						<div class="form-group col-md-12">
							  <input type="text" name="email" class="form-control" placeholder="Email *">
						  </div>
						
					  </div>
					  
					  <div class="row">
			
						<div class="form-group col-md-12">
							<input type="text" name="mobile" class="form-control" placeholder="Contact Number *">
						</div>
					  </div>
					  <div class="form-group col-md-12">
							<select id="inputCountry" name="country_id" class="form-control" >
								<option value="">Country</option>
									@foreach($countries as $key=>$country)
									<option value="{{$country}}">{{$country}}</option>
									@endforeach
							  </select>
						</div>
					  <div class="row">
			
						<div class="form-group col-md-12">
							<textarea name="description" class="form-control" rows="5" placeholder="Description *" ></textarea>
						</div>
					  </div>
					  
					  <div class="row">
					  <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">

                      <div class="col-md-6">

                          <div class="captcha">

                          <span>{!! captcha_img() !!}</span>

                          <button type="button" class="btn btn-success btn-refresh"><i class="fas fa-sync-alt"></i></button>

                          </div>

                          <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">

                          @if ($errors->has('captcha'))

                              <span class="error">

                                  <strong>{{ $errors->first('captcha') }}</strong>

                              </span>

                          @endif

                      </div>

                  </div>
					  </div>
					   
					   
				  </div>
				  <div class="form_column">
						  <div class="row">
							  <div class="btn_column form-group col-md-12">
								   <button type="submit" class="default_btn">Submit</button>
							  </div>
						  </div>
				  </div>              
			</form>  
	   </div> 
							  
  </div>
</div>
<!-- /End button popover  -->

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">

$(".btn-refresh").click(function(){
  $.ajax({
     type:'GET',
     url:public_url+'/refresh_captcha',
     success:function(data){

        $(".captcha span").html(data.captcha);

     }

  });

});

</script>