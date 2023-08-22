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
            <h1 class="m-0 text-dark">Banner Management</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
   <div class="content">

   <div class="container-fluid">
      <form method="get" action="">
      <div class="d-block">
	    <div class="row">
        <div class="col-lg-3" style="margin-right:4px">
			 <input type="text"  autocomplete="off" id="banner_name" class="form-control" placeholder="Search By banner Name" value="{{Request::get('banner_name')}}" name="banner_name"> 
          </div>
	
		  	<div class="col-lg-1 ">
		  <button class="btn btn-primary " type="submit" style="margin-top:2px;" >Search </button>
		  </div>
		  </div>
        </div>
      </form>
	   <div class="float-sm-right mt-4 mb-3">
        <a href="{{ route('banner.create')}}" class="btn btn-primary " style="margin-bottom:5px;">Create Banner</a>
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
		  <th>Banner Name</th>
		  <th>Banner Position</th>
		  <th> Image</th>
		  <th> Image mobile</th>
		  
		  <th>Action</th>
		</tr>
              
            @foreach($banners as $key => $banner)

                                                
				<tr>
        <td style="width:50px;">{{($banners->perPage() * ($banners->currentPage() - 1))+ ($key+1)}}</td>
				  <td>{{$banner->name}}</td>
				  <td>{{$banner->sequence_number}}</td>
				  
				  <td>
				  @if($banner->file_type == 'image')
				  <img src="{{$banner->image}}" height="50px" width="100px">
				  @else
				   <!-- <img src="{{url('public/images/youtube-logo2.jpg')}}" height="50px" width="100px"> -->
           <video width="100%" height="100%"  autoplay muted loop playsinline controlsList="nodownload">
                                         <source src="{{$banner->image}}" type="video/mp4"/>
                                   
                                </video>
				    @endif
				  </td>
				  <td>
				  @if($banner->file_type == 'image')
				  <img src="{{$banner->image_mob}}" height="50px" width="100px">
				  <!-- <img src="{{url('public/uploads/banner/'.$banner->image_mob)}}" height="50px" width="100px"> -->
				  @else
          <video width="100%" height="100%"  autoplay muted loop playsinline controlsList="nodownload">
                                         <source src="{{$banner->image_mob}}" type="video/mp4"/>
                                   
                                </video>				    @endif
				  </td>
				       
				  <td>
				  <a href="{{ route('banner.edit',$banner->id)}}" class="btn btn-info" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
				  @if($banner->status == '1')
              <a  class="btn btn-success btn-successuser" title="Block" style="color:white;" href="{{route('banner.staus',$banner->id)}}"><i class="text-white fa fa-unlock" aria-hidden="true" ></i></a>
              @else
              <a  class="btn btn-danger btn-successuser" title="Unblock" style="color:white;"  href="{{route('banner.staus',$banner->id)}}"><i class="text-white fa fa-lock" aria-hidden="true" ></i></a>
                @endif
				  <a onclick="deleteConfirmation('{{$banner->id}}')" class="btn btn-danger" title="Delete" href="{{route('banner.delete',$banner->id)}}"><i class="text-white fa fa-ban fa-trash" aria-hidden="true" ></i></a>

					

					 </td>

				</tr>
             @endforeach
          

      </table>

 </div> 
		 
   </div>
   {{ $banners->links() }} 
</div>
		</section>
		
		
	</div>
</div>

   <script>
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
  dangerMode: true,
         }).then((isDeleted) =>{
         
        if(isDeleted){
         $.ajax({
                type: 'get',
                data: {
                '_method': 'get'
                },
                url: "/admin/banner/delete/" +id,
                success: function(data) {
                swal({
                     title: " Success!",
                     text: "banner deleted successfully!",
                     type: "success",
                     confirmButtonColor: "#069edb",
                     //timer: 3000
                     }).then(() =>{
                     window.location.replace("{{url('/admin/banner')}}");
                     });
                }
                });}
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
  dangerMode: true,
        }).then((isConfirm)=> {
          if(isConfirm){
           jQuery.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
          });
          jQuery.ajax({
            type: 'get',
            url:  "{{url('/admin/banner/status')}}/"+id,
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
                  }).then(()=> {
                  location.reload();
                });
              }
          });
        }
        else
        {
           window.location.replace("{{url('/admin/banner')}}");
        }
        });
      }

  </script> 
  
</section>
    
@endsection