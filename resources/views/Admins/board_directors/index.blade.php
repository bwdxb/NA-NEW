@extends('layouts.master')

@section('content')
 <!-- Content Header (Page header) -->
 <style type="text/css">
  /* tr,th,td{
    min-width: 150px;
  } */
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
            <h1 class="m-0 text-dark">Board Director Management</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
   <div class="content">

   <div class="container-fluid">
      
	   <div class="float-sm-right mt-4 mb-3">
        <a href="{{ route('board_director.create')}}" class="btn btn-primary " style="margin-bottom:5px;">Create Board Director</a>
      </div>
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
	  <table class="table table-bordered table-striped mt-5">
        <tr>
		  <th>S.no.</th>
		  <th>Name</th>
      <th>Name (Ar)</th>
		  <th>Designation</th>
      <th>Designation (Ar)</th>
		  <!-- <th>Institute</th>
      <th>Institute (Ar)</th>
		  <th>Sequence</th> -->
		  <th>Image</th>
		  <th>Action</th>
		</tr>
              
            @foreach($board_director as $key => $board)
                               
				<tr>
        <td>{{($board_director->perPage() * ($board_director->currentPage() - 1))+ ($key+1)}}</td>
				  <td>{{$board->name}}</td>
          <td>{{$board->name_ar}}</td>
				  <td>{{$board->designation}}</td>
          <td>{{$board->designation_ar}}</td>
				  <!-- <td>{{$board->institute}}</td>
          <td>{{$board->institute_ar}}</td>
				  <td>{{$board->sequence_number}}</td> -->
				  
				  <td><img src="{{url('public/uploads/board_director/'.$board->image)}}" height="50px" width="100px"></td>
				       
				  <td style="min-width:118px;">
				  <a href="{{ route('board_director.edit',$board->id)}}" class="btn btn-info" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
				  @if($board->status == '1')
             <a  onclick="statefunction('{{$board->id}}')" class="btn btn-success btn-successuser" title="Block" style="color:white;"><i class="text-white fa fa-unlock" aria-hidden="true" ></i></a>
              @else
              <a  onclick="statefunction('{{$board->id}}')" class="btn btn-danger btn-successuser" title="Unblock" style="color:white;"><i class="text-white fa fa-lock" aria-hidden="true" ></i></a>
                @endif
				  <a onclick="deleteConfirmation('{{$board->id}}')" class="btn btn-danger" title="Delete"><i class="text-white fa fa-ban fa-trash" aria-hidden="true" ></i></a>

					 </td>

				</tr>
             @endforeach
      </table>

 </div> 
		 
   </div>
   {{ $board_director->links() }} 
</div>
		</section>
		
		
	</div>
</div>

   <script>

var public_url = $('meta[name="base_url"]').attr('content');


 function deleteConfirmation(id) {
    swal({
         title: "Are you sure?",
         text: "Are you sure ,you want to DELETE ?",
         type: "warning",
         showCancelButton: true,
         confirmButtonColor: "#069edb",
         confirmButtonText: "Yes, delete it!",
         closeOnConfirm: false,
            buttons: true,
         }).then(()=> {
         
        
         $.ajax({
                type: 'get',
                data: {
                '_method': 'get'
                },
                url: "/admin/board_director/delete/" +id,
                success: function(data) {
                swal({
                     title: " Success!",
                     text: "Board Director deleted successfully!",
                     type: "success",
                     confirmButtonColor: "#069edb",
                     //timer: 3000
                     }).then(()=> {
                     window.location.replace("{{url('/admin/board_director')}}");
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
          closeOnCancel: true,
            buttons: true,
        }).then((isConfirm)=> {
          if(isConfirm){
           jQuery.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
          });
          jQuery.ajax({
            type: 'get',
            url:  "{{url('/admin/board_director/status')}}/"+id,
            success: function(data) {
                if(data == 1){
                  var status_banner = 'unblocked';
                }
                else{
                  var status_banner = 'blocked';
                }
                swal({
                    title: "Done!",
                    text: " successfully!",
                    type: "success",
                    confirmButtonColor: "#069edb",
                  }).then(() =>{
                  location.reload();
                });
              }
          });
        }
        else
        {
           window.location.replace("{{url('/admin/board_director')}}");
        }
        });
      }

  </script> 
  
</section>
    
@endsection