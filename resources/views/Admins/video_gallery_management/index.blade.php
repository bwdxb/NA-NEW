@extends('layouts.master')
@section('content')
@use \App\Http\Controllers\VideoGalleryController;

<section class="wrapper"> 
    <div class="row">
       <div class="col-sm-12">
          <section class="panel">
            <div class="content-header">
             <div class="container-fluid">
              <div class="row mb-2">
               <div class="col-sm-6 mt-4">
                <h1 class="m-0 text-dark"style="text-decoration: bold;">Video Gallery Management</h1>
            </div>

        </div>


        <br />
    </div>
    <!-- /.container-fluid -->
</div>

<section class="content">
 <div class="container-fluid">
     <form method="get" action="">
      <div class="d-block">
       <div class="row">
        <div class="col-lg-2" style="margin-right:4px">
            <select name="lang" id="lang" class="form-control">

               <option value="">Select Lang Type</option>
               <option @if("All" ==Request::get('lang')) selected="selected" @endif>All</option>
               <option @if("English" ==Request::get('lang')) selected="selected" @endif>English</option>
               <option @if("Arabic" ==Request::get('lang')) selected="selected" @endif>Arabic</option>
           </select>
       </div>
       <div class="row">
        <div class="col-lg-4" style="margin-right:4px">
            <select name="cat_id" id="cat_id" class="form-control">

               <option value="">Select Category</option>
               @foreach($video_category as $key=>$category) 
               <option @if($category->id ==Request::get('cat_id')) selected="selected" @endif value="{{$category->id}}">{{$category->name}}</option>
               @endforeach
           </select>
       </div>
       <div class="col-lg-4" style="margin-right:4px">
        <input type="text"  autocomplete="off" id="title" class="form-control" placeholder="Search By Title" value="{{Request::get('title')}}" name="title"> 
    </div>
    <div class="col-lg-1 ">
        <button class="btn btn-primary " type="submit" style="margin-top:2px;" >Search </button>
    </div>
</div>
</div>
</form>
<div class="float-sm-right mt-4 mb-3">
    <a href="{{ route('video_gallery.create')}}" class="btn btn-primary " style="margin-bottom:5px;">Create Video Gallery</a>
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
<table class="table table-bordered table-striped">
   <tr>
    <th>Sr.No</th>
    <th>Language</th>
    <th>Category</th>
    <th>Title</th>
    <!-- <th>Title (Ar)</th> -->
    <th>Date</th>
    <th>Youtube Link</th>
    <!-- <th>Youtube Link (Ar)</th> -->
    <th>Action</th>
</tr>
@foreach($video_gallery as $key =>$gallery)
<tr>
    <td>{{($video_gallery->perPage() * ($video_gallery->currentPage() - 1))+ ($key+1)}}</td>
    <td>{{$gallery->lang}}</td>
    <td>{{ \App\Http\Controllers\VideoGalleryController::getCategory($gallery->cat_id)}}</td>
    <td>{{$gallery->title}}</td>
    <!-- <td>{{$gallery->title_ar}}</td> -->
    <td>{{date('d M Y', strtotime($gallery->video_date))}}</td>
    <td>{{$gallery->youtube_link}}</td>
    <!-- <td>{{$gallery->youtube_link_ar}}</td> -->

    <td style="min-width:155px;">
    <a href="{{route('video_gallery.history',$gallery->id)}}" class="btn btn-warning" title="History"><i class="text-white fas fa-history" aria-hidden="true"></i></a>

     <a href="{{route('video_gallery.edit',$gallery->id)}}" class="btn btn-info" title="Edit"> 
         <i class="text-white fa fa-edit fa-edit" aria-hidden="true" ></i></a>
         @if($gallery->status == '1')
         <a  onclick="statefunction('{{$gallery->id}}')" class="btn btn-success btn-successuser" title="Block" style="color:white;"><i class="text-white fa fa-unlock" aria-hidden="true" ></i></a>
         @else
         <a  onclick="statefunction('{{$gallery->id}}')" class="btn btn-danger btn-successuser" title="Unblock" style="color:white;"><i class="text-white fa fa-lock" aria-hidden="true" ></i></a>
         @endif
         <a onclick="deleteConfirmation('{{$gallery->id}}')" class="btn btn-danger" title="Delete"><i class="text-white fa fa-ban fa-trash" aria-hidden="true" ></i></a> 
     </td>
 </tr>
 @endforeach
</tbody>
</table>
{{ $video_gallery->links() }}
</div>
</section>
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
       }, function() {


           $.ajax({
            type: 'get',
            data: {
                '_method': 'get'
            },
            url: "/admin/video_gallery/delete/" +id,
            success: function(data) {
                swal({
                   title: " Success!",
                   text: "Video Gallery deleted successfully!",
                   type: "success",
                   confirmButtonColor: "#069edb",
                     //timer: 3000
                 },
                 function() {
                   window.location.replace("{{route('video_gallery.index')}}");
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
                url:  "{{url('/admin/video_gallery/status')}}/"+id,
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
                }).then(() =>{
                  location.reload();
              });
              }
          });
         }
         else
         {
             window.location.replace("{{route('video_gallery.index')}}");
         }
     });
    }

</script> 
</section>


@endsection