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
                <h1 class="m-0 text-dark"style="text-decoration: bold;">    <a href="{{ route('video_gallery.index')}}" class="btn btn-primary " style="margin-bottom:5px;">Back</a> History</h1>
            </div>

        </div>


        <br />
    </div>
    <!-- /.container-fluid -->
</div>

<section class="content">
 <div class="container-fluid">
    
<div class="float-sm-right mt-4 mb-3">
</div>

<table class="table table-bordered table-striped">
   <tr>
    <th>Sr.No</th>
    <th>Language</th>
    <th>Category</th>
    <th>Title</th>
    <!-- <th>Title (Ar)</th> -->
    <th>Date</th>
    <th>Youtube Link</th>
    <th>Created By</th>
    <th>Created At</th>
    <th>Action</th>
</tr>
@foreach($video_gallery as $gallery)
<tr>
    <td>{{$i++}}</td>
    <td>{{$gallery->lang}}</td>
    <td>{{$gallery->getCategory()->name}}</td>
    <td>{{$gallery->title}}</td>
    <!-- <td>{{$gallery->title_ar}}</td> -->
    <td>{{date('d M Y', strtotime($gallery->video_date))}}</td>
    <td>{{$gallery->youtube_link}}</td>
    <td>{{$gallery->user()->full_name()}}</td>
    <td>{{date('d-m-Y',strtotime($gallery->created_at))."(". \Carbon\Carbon::parse($gallery->created_at)->diffForHumans().")"}}</td>

    <!-- <td>{{$gallery->youtube_link_ar}}</td> -->

    <td>
    <a href="{{route('video_gallery.revert',$gallery->id)}}" onclick="return confirm('Are u sure you want to revert this record ?')" class="btn btn-info w-100"> Revert</a>              
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
           closeOnConfirm: false
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