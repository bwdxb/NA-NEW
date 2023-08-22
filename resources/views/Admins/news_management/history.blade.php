@php
use app\Http\helper\Helper as Helper;
$news_category = Helper::getNewsCategoryAll();
@endphp
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
            <h1 class="m-0 text-dark"><a class="btn btn-primary" href="{{url('/admin/news')}}">Back</a>  News History</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
   <div class="content">


      
	  <table class="table table-bordered table-striped mt-5">
        <tr>
		  <th>S.no.</th>
      <th>Language</th>
		  <th>Category</th>
		  <th>Title</th>
		  <th>Date</th>
		  <th> Image</th>
		  <th> Created At</th>
		  <th>Action</th>
		</tr>
              
            @foreach($news as $key=>$new)
                               
				<tr>
				  <td>{{$key+1 }}</td>
          <td>{{$new->lang}}</td>
				  <td>{{$new->category}}</td>
				  <td>{{$new->title}}</td>
				 <td>{{date('d M Y', strtotime($new->news_date))}}</td>
				  
				  <td>
				  @php
				  $image = json_decode($new->image);
				  @endphp
				  @if(!empty($image))
				  <img src="{{url('public/uploads/news/'.$image[0])}}" height="50px" width="100px">
				  @endif
				  </td>
          <td>{{date('d-m-Y',strtotime($new->created_at))."(". \Carbon\Carbon::parse($new->created_at)->diffForHumans().")"}}</td>

				  <td> 
          <a href="{{route('revert.news',$new->id)}}" onclick="return confirm('Are u sure you want to revert this record ?')" class="btn btn-info w-100"> Revert</a>              
               <a href="{{route('revert.news',$new->id)}}?preview=1"  class="btn btn-info w-100 mt-1"> View</a>              
        
          </td>

				</tr>
             @endforeach
      </table>

 </div> 
		 
   </div>
   {{ $news->links() }} 
</div>
		</section>
		
		
	</div>
</div>


</section>
@endsection

@section('script')
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
         }).then((willDelete)=> {
         
        if(willDelete){
          $.ajax({
                type: 'get',
                data: {
                '_method': 'get'
                },
                url: "/admin/news/delete/" +id,
                success: function(data) {
                  swal({
                      title: " Success!",
                      text: "News deleted successfully!",
                      type: "success",
                      confirmButtonColor: "#069edb",
                      //timer: 3000
                      }).then(() =>{
                      window.location.replace("{{url('/admin/news')}}");
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
          buttons: true,
          dangerMode: true,
          closeOnCancel: true,
        }).then((isConfirm) =>{
          if(isConfirm){
           jQuery.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
          });
          jQuery.ajax({
            type: 'get',
            url:  "{{url('/admin/news/status')}}/"+id,
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
           window.location.replace("{{url('/admin/news')}}");
        }
        });
      }

  </script> 
  


@endsection