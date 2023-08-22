@extends('layouts.master')

@section('content')
 <!-- Content Header (Page header) -->
   
<section class="wrapper">
<!-- page start-->

<div class="row">
	<div class="col-sm-12">
		<section class="panel">
			<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Sub Admin Management</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<section class="content">
   <div class="container-fluid">
      <form method="get" action="">
      <div class="d-block">
	    <div class="row">
        <div class="input-group col-lg-2" style="margin:4px">
			<input class="form-control " value="{{Request::get('first_name')}}" name="first_name" type="text" placeholder="Search by name" aria-label="Search">  
          </div>
		   <div class="input-group col-lg-2" style="margin:4px">
          		<!--<input class="form-control" value="{{Request::get('gender')}}" name="gender" type="text" placeholder="Search by gender" aria-label="Search">--> 
				<select name="gender" class="form-control">
				<option value="">Select Gender</option>
				
				<option value="male" @if(Request::get('gender') == 'male') selected  @endif>Male</option>
				<option value="female" @if(Request::get('gender') == 'female') selected  @endif>Female</option>
				</select>
          </div>
		  <div class="input-group col-lg-2" style="margin:4px">
          		<input class="form-control form-control-navbar " value="{{Request::get('mobile')}}" name="mobile" type="text" placeholder="Search by phone" aria-label="Search">  
          </div>
		  
		  <div class="col-lg-2 col-sm-6">
		   <div class="form-group ">
				<div class="col-md-12 col-sm-6 col-xs-11">

					<div data-date-viewmode="years" data-date-format="mm/dd/yyyy" data-date="12-02-2012"  class="input-append date dpYears">
						<input type="text" readonly="" value="{{Request::get('f_dob')}}"  class="form-control" name="f_dob" placeholder = "DOB from">
							  <span class="input-group-btn add-on">
								<button class="btn btn-primary" type="button"><i class="fa fa-calendar"></i></button>
							  </span>
					</div>
					
				</div>
			</div>
		  </div>
		  <div class="col-lg-2 col-sm-6">
		   <div class="form-group ">
				<div class="col-md-12 col-sm-6 col-xs-11">

					<div data-date-viewmode="years" data-date-format="mm/dd/yyyy" data-date="12-02-2012"  class="input-append date dpYears">
						<input type="text" readonly="" value="{{Request::get('t_dob')}}"  class="form-control" name="t_dob" placeholder = "DOB from">
							  <span class="input-group-btn add-on">
								<button class="btn btn-primary" type="button"><i class="fa fa-calendar"></i></button>
							  </span>
					</div>
					
				</div>
			</div>
		  </div>
		  
		  	<div class="col-lg-1 ">
		  <button class="btn btn-primary " type="submit" style="margin-top:5px;" >Search </button>
		  </div>
		  </div>
        </div>
      </form>
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
		
	  <br />
	  <br />
	  <div class="float-sm-right">
        <a href="{{ route('subAdmin.create')}}" class="btn btn-primary " style="margin-bottom:5px;">Add</a>
      </div>
	  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>S.No</th>
          <th>First Name</th>
          <th>Last Name</th>
		  <th>Phone Number</th>
		  <th>Gender</th>
		  <th>DOB</th>
          <th colspan="4">Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach($users as $key => $row)

      <tr>
        <td>{{$key+1}}</td>
        <td>{{$row->first_name}}</td>
        <td>{{$row->last_name}}</td>
        <td>{{$row->mobile}}</td>
		 <td>{{$row->gender}}</td>
		 <td>{{$row->date_of_birth}}</td>
        <!--<td> @if($row->status == '1')
              {{'Active'}}
              @else
              {{'Blocked'}}
              @endif 
          </td>-->
        <td>
              @if($row->status == '1')
              <a  onclick="statefunction('{{$row->id}}')" class="btn btn-success btn-successuser" title="Block" style="color:white;"><i class="text-white fa fa-lock" aria-hidden="true" ></i></a>
              @else
              <a  onclick="statefunction('{{$row->id}}')" class="btn btn-danger btn-successuser" title="Unblock" style="color:white;"><i class="text-white fa fa-unlock" aria-hidden="true" ></i></a>
              @endif
                    

            <a href="{{route('subAdmin.edit',$row->id)}}" class="btn btn-info"> 
             <i class="fa fa-edit" aria-hidden="true"></i></a>
     
           

             <a href="{{route('subAdmin.show', $row->id)}}" class="btn btn-success">
              <i class="text-white fa fa-eye fa-eye" aria-hidden="true" ></i></a>

        <a onclick="deleteConfirmation('{{$row->id}}')" class="btn btn-danger btn-successuser" style="color:white;">
                            <i class="far fa-trash-alt"></i></a>


                 <form action="{{ route('subAdmin.destroy', $row->id)}}" method="post" id="delete" class="delete" >
                   @csrf
                   @method('DELETE')
                 </form>
        </td>
       
  
      </tr>
      @endforeach
    </tbody>
  </table>
 </div> 
		 
   </div>
   {{ $users->links() }} 
</section>
		</section>
		
		
	</div>
</div>
 <script>

var public_url = $('meta[name="base_url"]').attr('content');


 function deleteConfirmation(id) {
    swal({
         title: "Are you sure?",
         text: "Are you sure you want to delete this user?",
         type: "warning",
         showCancelButton: true,
         confirmButtonColor: "#069edb",
         confirmButtonText: "Yes, delete it!",
         closeOnConfirm: false
         }, function() {
         
        
         $.ajax({
                type: 'get',
                data: {
                '_method': 'get'
                },
                url: public_url + "/user/delete/" +id,
                success: function(data) {
                swal({
                     title: " Success!",
                     text: "Deleted successfully!",
                     type: "success",
                     confirmButtonColor: "#069edb",
                     //timer: 3000
                     },
                     function() {
                     window.location.href = public_url + '/subAdmin';
                     });
                }
                });
         });
}
  </script> 
  <script>
  function statefunction(id){
        swal({
          title: "Are you sure?",
          text: "You want to perform this action!",
          type: "warning",
          showCancelButton: true,
          cancelButtonClass: 'btn-danger',
          confirmButtonText: 'Yes,perform it',
          cancelButtonText: "Cancel",
          closeOnConfirm: false,
          closeOnCancel: true
        },function(isConfirm) {
          if(isConfirm){
           jQuery.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
          });
          jQuery.ajax({
            type: 'get',
            url:  "{{url('user/status/')}}/"+id,
            success: function(data) {
                if(data == 1){
                  var status_user = 'unblocked';
                }
                else{
                  var status_user = 'blocked';
                }
                swal({
                    title: "Done!",
                    text: status_user+" successfully!",
                    type: "success",
                    confirmButtonColor: "#069edb",
                  },
                   function() {
                  location.reload();
                });
              }
          });
        }
        else
        {
           window.location.replace("{{url('/subAdmin')}}");
        }
        });
      }

  </script>  
</section>
    
@endsection




 
