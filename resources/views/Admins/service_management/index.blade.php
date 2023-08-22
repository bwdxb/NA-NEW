@extends('layouts.master')
@section('content')
<section class="wrapper"> 
<div class="row">
	<div class="col-sm-12">
		<section class="panel">
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6 mt-4">
            <h1 class="m-0 text-dark"style="text-decoration: bold;">Service Management</h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item">
                  <a href=" # "></a>
               </li>
            </ol>
         </div>
         <!-- /.col -->
      </div>
       <div class="float-sm-right mt-4 mb-3">
        <a href="{{ route('service.create')}}" class="btn btn-primary " style="margin-bottom:5px;">Create Service</a>
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
	  <br />
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
   <div class="container-fluid">
    
      <table class="table table-bordered table-striped">
         <tr>
            <th>Sr.No</th>
            <th>Name</th>
			<th>Image</th>
            <th>Description</th>
            <th>Action</th>
         </tr>
         @foreach($services as $key=>$service)
         <tr>
         <td>{{($services->perPage() * ($services->currentPage() - 1))+ ($key+1)}}</td>
            <td>{{$service->name}}</td>
			<td><img src="{{url('public/uploads/service/'.$service->image)}}" height="50px" width="100px"> </td>
            <td>{{strip_tags(\Illuminate\Support\Str::limit($service->description, 90, $end='...'))}}</td>
            <td>
               <a href="{{route('service.edit',$service->id)}}" class="btn btn-info"> 
               <i class="text-white fa fa-edit fa-edit" aria-hidden="true" ></i></a>
                @if($service->status == '1')
              <a  onclick="statefunction('{{$service->id}}')" class="btn btn-success btn-successuser" title="Block" style="color:white;"><i class="text-white fa fa-unlock" aria-hidden="true" ></i></a>
              @else
              <a  onclick="statefunction('{{$service->id}}')" class="btn btn-danger btn-successuser" title="Unblock" style="color:white;"><i class="text-white fa fa-lock" aria-hidden="true" ></i></a>
                @endif
				
				<a onclick="deleteConfirmation('{{$service->id}}')" class="btn btn-danger"><i class="text-white fa fa-ban fa-trash" aria-hidden="true" ></i></a>
               
            </td>
         </tr>
         @endforeach
      </table>
        {{ $services->links() }}
   </div>
</section>
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
         closeOnConfirm: false
         }).then(()=> {
         
        
         $.ajax({
                type: 'get',
                data: {
                '_method': 'get'
                },
                url: public_url + "/admin/service/delete/" +id,
                success: function(data) {
                swal({
                     title: " Success!",
                     text: "Service deleted successfully!",
                     type: "success",
                     confirmButtonColor: "#069edb",
                     //timer: 3000
                     }).then(() =>{
                     window.location.href = public_url + '/admin/banner';
                     });
                }
                });
         });
}
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
        }).then((isConfirm)=> {
          if(isConfirm){
           jQuery.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
          });
          jQuery.ajax({
            type: 'get',
            url:  "{{url('/admin/service/status')}}/"+id,
            success: function(data) {
                if(data == 1){
                  var status_user = 'unblocked';
                }
                else{
                  var status_user = 'blocked';
                }
                swal({
                    title: "Done!",
                    text: " successfully!",
                    type: "success",
                    confirmButtonColor: "#069edb",
                  }).then(()=> {
                  location.reload();
                });
              }
          });
        }
        else
        {
           window.location.replace("{{url('/admin/service')}}");
        }
        });
      }

  </script> 
</section>
@endsection