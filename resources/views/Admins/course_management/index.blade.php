@extends('layouts.master')

@section('content')
 <!-- Content Header (Page header) -->
 <style type="text/css">
  /* tr,th,td{
    min-width: 150px;
  } */
  td.ellipse-text {
    max-width: 150px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.grey_bgbtn {
    background: #747474;
    color: #fff;
    border-color: #747474;
}
.grey_bgbtn:hover{color:#fff;}
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
            <h1 class="m-0 text-dark">Course management</h1>
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
                  <option value="National Association of Emergency Medical Technicians (NAEMT)" @if(Request::get('category')=='National Association of Emergency Medical Technicians (NAEMT)') selected @endif>National Association of Emergency Medical Technicians (NAEMT)</option>
                  <option value="American Heart Association (AHA)"  @if(Request::get('category')=='American Heart Association (AHA)') selected @endif>American Heart Association (AHA)</option>
                  <option value="American Health and Safety Institute (ASHI)"  @if(Request::get('category')=='American Health and Safety Institute (ASHI)') selected @endif>American Health and Safety Institute (ASHI)</option>
                  <option value="Emergency Medical Services (EMS)"  @if(Request::get('category')=='Emergency Medical Services (EMS)') selected @endif>Emergency Medical Services (EMS)</option>
                  <option value="Community Outreach Programmes (CSR)"  @if(Request::get('category')=='Community Outreach Programmes (CSR)') selected @endif>Community Outreach Programmes (CSR)</option>
              </select>
          </div>
          <div class="col-lg-3" style="margin-right:4px">
            <input type="text" autocomplete="off" id="search_key" class="form-control" placeholder="Search By Course Name" value="{{Request::get('search_key')}}" name="search_key"> 
          </div>
          <div class="col-lg-3" style="margin-right:4px">
          <select name="sort" id="sort" class="form-control"  >
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
        <a href="{{ route('course.create')}}" class="btn btn-primary " style="margin-bottom:5px;">Create Course</a>
      </div>
      @if(!$config->status)
	   <div class="float-sm-right mt-4 mb-3 mr-1">
        <a onclick=courseButtonStatusfunction('{{ route('config.course_status_button')}}') url="{{ route('config.course_status_button')}}" class="btn grey_bgbtn " style="margin-bottom:5px;">Enable View Courses</a>
      </div>
      @else
	   <div class="float-sm-right mt-4 mb-3 mr-1">
        <a onclick=courseButtonStatusfunction('{{ route('config.course_status_button')}}') url="{{ route('config.course_status_button')}}" class="btn btn-danger " style="margin-bottom:5px;">Disable View Courses</a>
      </div>
      @endif
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
		  <th style="width:50px;">S.no.</th>
		  <!-- <th>Logo</th> -->
		  <th>Course</th>
		  <th>Category</th>
		  <!-- <th>Type</th> -->
		  <th>Date</th>
		  <!-- <th>Location</th>
		  <th>Link</th>
		  <th>Certification</th>
		  <th>Who Should Take The Course?</th> -->
		  <!-- <th>Note</th> -->
		  <th>Closing Date</th>
		  <!-- <th>Fee Type</th> -->
		  <th>Course Fee</th>
		  
		  <!-- <th>Description</th> -->
		  <th>Action</th>
		</tr>
              
            @foreach($courses as $key => $course)
                               
				<tr>
        <td>{{($courses->perPage() * ($courses->currentPage() - 1))+ ($key+1)}}</td>
				  <!-- <td><img src="/public/uploads/course/{{$course->logo}}" width="50" height="50"/></td> -->
				  <td class="ellipse-text"> <b> English : </b>{{$course->title}}
          <br/> <b> Arabic : </b>{{$course->title_ar}}</td>
          <td class="ellipse-text"> 
            <b>English</b> : {{$course->category}}
            <br/> <b>Arabic</b> : {{$course->category_ar}}

          </td>
          <!-- <td>
            <b>English</b> : {{$course->type}}
            <br/> <b>Arabic</b> : {{$course->type_ar}}

          </td> -->
				  <td> <b> Start Date : </b>{{\Carbon\Carbon::createFromFormat('Y-m-d', $course->start_date)->format('d-m-Y')}}<br/> <b> End Date : </b>{{\Carbon\Carbon::createFromFormat('Y-m-d', $course->end_date)->format('d-m-Y')}}</td>
				  <!-- <td>
            <b>English</b> : {!!$course->location!!}
            <br/> <b>Arabic</b> : {!!$course->location_ar!!}

          </td>
				  <td>{{$course->link}}</td>
				  <td>
            <b>English</b> : {!!$course->certification!!}
            <br/> <b>Arabic</b> : {!!$course->certification_ar!!}
          </td>
				  <td>
            <b>English</b> : {!!$course->who_should_take_course!!}
            <br/> <b>Arabic</b> : {!!$course->who_should_take_course_ar!!}
          </td>
				  <td>
            <b>English</b> : {!!$course->note!!}
            <br/> <b>Arabic</b> : {!!$course->note_ar!!}
          </td> -->
				  <td>{{\Carbon\Carbon::createFromFormat('Y-m-d', $course->closing_date)->format('d-m-Y')}}</td>
				  <!-- <td>{{$course->fee_type}}</td> -->
				  <td>{{$course->course_fee}} @if($course->fee_type=='AED') AED @endif</td>
				  <!-- <td> <b> English : </b>{!!$course->description!!}<br/> <b> Arabic : </b>{!!$course->description_ar!!}</td> -->
				       
				  <td class="course_action">
				  <a href="{{ route('course.edit',$course->id)}}" class="btn btn-info" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
				  <a href="{{ route('course.duplicate',$course->id)}}" class="btn btn-warning" title="Duplicate Course"><i class="fa fa-copy" aria-hidden="true"></i></a>
				  @if($course->status == '1')
             <a  onclick="statefunction('{{$course->id}}')" class="btn btn-success btn-successuser" title="Block" style="color:white;"><i class="text-white fa fa-unlock" aria-hidden="true" ></i></a>
              @else
              <a  onclick="statefunction('{{$course->id}}')" class="btn btn-danger btn-successuser" title="Unblock" style="color:white;"><i class="text-white fa fa-lock" aria-hidden="true" ></i></a>
                @endif
				  @if($course->course_status == '1')
             <a  onclick="coursestatefunction('{{$course->id}}')" class="btn btn-info btn-successuser" title="Mark As Available" style="color:white;"><i class="text-white fa fa-link" aria-hidden="true" ></i></a>
              @else
              <a  onclick="coursestatefunction('{{$course->id}}')" class="btn btn-info btn-successuser" title="Mark as full" style="color:white;"><i class="text-white fa fa-link" aria-hidden="true" ></i></a>
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

        // var public_url = $('meta[name="base_url"]').attr('content');


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
                }).then((isConfirm) =>{
                  if(isConfirm){
                
                
                $.ajax({
                        type: 'get',
                        data: {
                        '_method': 'get'
                        },
                        url: "/admin/course/delete/" +id,
                        success: function(data) {
                        swal({
                            title: " Success!",
                            text: "News course deleted successfully!",
                            type: "success",
                            confirmButtonColor: "#069edb",
                            //timer: 3000
                            }).then(()=> {
                            window.location.replace("{{url('/admin/course')}}");
                            });
                        }
                        });
                  }
                });

        }
</script> 


<script>
    function courseButtonStatusfunction(url){
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
            url:  url,
            success: function(data) {
              swal("Success","Successfully changed the status of course button view","success").then(() =>{
                                    window.location.replace("{{url('/admin/course')}}");
                                });
                            }
              });
          
        }
        else
        {
           window.location.replace("{{url('/admin/course')}}");
        }
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
              url:  "{{url('/admin/course/status')}}/"+id,
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


  function coursestatefunction(id){
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
            url:  "{{url('/admin/course/apply/status')}}/"+id,
            success: function(data) {
                if(data == 1){
                  var status_banner = 'unblocked';
                }
                else{
                  var status_banner = 'blocked';
                }
                swal({
                    title: "Done!",
                    text: "successfully marked course as full!",
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
           window.location.replace("{{url('/admin/course')}}");
        }
        });
      }


 
  </script> 
  
</section>
    
@endsection