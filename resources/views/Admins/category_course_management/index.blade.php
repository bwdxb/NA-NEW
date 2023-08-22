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
            <h1 class="m-0 text-dark">Category Course management</h1>
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
        <select name="category" id="category" class="form-control"  >
                  <option value="">Select course category</option>
                  <option value="NAEMT" @if(Request::get('category')=='NAEMT') selected @endif>NAEMT</option>
                  <option value="AHA"  @if(Request::get('category')=='AHA') selected @endif>AHA</option>
                  <option value="ASHI"  @if(Request::get('category')=='ASHI') selected @endif>ASHI</option>
                  <option value="EMS"  @if(Request::get('category')=='EMS') selected @endif>EMS</option>
               </select>
          </div>
          <div class="col-lg-3" style="margin-right:4px">
            <input type="text" autocomplete="off" id="search_key" class="form-control" placeholder="Search By Course Name" value="{{Request::get('search_key')}}" name="search_key"> 
          </div>
          <div class="col-lg-3" style="margin-right:4px">
          <select name="sort" id="sort" class="form-control" required >
                    <option value="Newest" @if(Request::get('sort')=='Newest') selected @endif>Newest</option>
                    <option value="Oldest" @if(Request::get('sort')=='Oldest') selected @endif>Oldest</option>
                   
                 </select>
            </div>
		  	<div class="col-lg-1 ">
		  <button class="btn btn-primary " type="submit" style="margin-top:2px;" >Search </button>
		  </div>
		  </div>
        </div>
      </form>
	   <div class="float-sm-right mt-4 mb-3">
        <a href="{{ route('course_category.create')}}" class="btn btn-primary " style="margin-bottom:5px;">Create Category Course</a>
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
		  <!-- <th>Logo</th> -->
		  <th>Course</th>
		  <th>Category</th>
		  
		  <th>Action</th>
		</tr>
              
            @foreach($courses as $key => $course)
                               
				<tr>
        <td>{{($courses->perPage() * ($courses->currentPage() - 1))+ ($key+1)}}</td>
				  <!-- <td><img src="/public/uploads/course_category/{{$course->logo}}" width="50" height="50"/></td> -->
				  <td> <b> English : </b>{{$course->title}}
         {{--
          <br/> <b> Arabic : </b>{{$course->title_ar}}
          --}} 
        </td>
				  <td>{{$course->category}}</td>
			
				  <td>
				  <a href="{{ route('course_category.edit',$course->id)}}" class="btn btn-info" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
				  @if($course->status == '1')
             <a  onclick="statefunction('{{$course->id}}')" class="btn btn-success btn-successuser" title="Block" style="color:white;"><i class="text-white fa fa-unlock" aria-hidden="true" ></i></a>
              @else
              <a  onclick="statefunction('{{$course->id}}')" class="btn btn-danger btn-successuser" title="Unblock" style="color:white;"><i class="text-white fa fa-lock" aria-hidden="true" ></i></a>
                @endif
				  <a onclick="deleteConfirmation('{{$course->id}}')" class="btn btn-danger" title="Delete"><i class="text-white fa fa-ban fa-trash" aria-hidden="true" ></i></a>

					 </td>

				</tr>
        
        
             @endforeach
      </table>

 </div> 
		 
   </div>
   {{ $courses->links() }} 
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
                dangerMode: true,
         }).then((isDelete)=> {
         
        if(isDelete){
         $.ajax({
                type: 'get',
                data: {
                '_method': 'get'
                },
                url: "/admin/course_category/delete/" +id,
                success: function(data) {
                swal({
                     title: " Success!",
                     text: "Category course deleted successfully!",
                     type: "success",
                     confirmButtonColor: "#069edb",
                     //timer: 3000
                     }).then(()=> {
                     window.location.replace("{{url('/admin/course_category')}}");
                     });
                }
                });
              }
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
        }).then((isConfirm) =>{
          if(isConfirm){
           jQuery.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
          });
          jQuery.ajax({
            type: 'get',
            url:  "{{url('/admin/course_category/status')}}/"+id,
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
        
        });
      }

  </script> 
  
</section>
    
@endsection