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
            <h1 class="m-0 text-dark"style="text-decoration: bold;"><a class="btn btn-primary" href="{{url('/admin/manage-feedback-info')}}">Back</a>   History</h1>
         </div>
      </div> 
	  <br />
   </div>
   <!-- /.container-fluid -->
</div>
 
<section class="content">
   <div class="container-fluid">
      <table class="table table-bordered table-striped">
         <tr>
            <th>#</th>
           
			   <th>Banner</th>
            <th>Description-1</th>
            <th>Description-1 (Ar)</th>
            <th>Description-2</th>
            <th>Description-2 (Ar)</th>
            <th>Updated By</th>
            <th>Date</th>
            <th>Action</th>
         </tr>
         @foreach($pages as $key=>$page)
         <tr>
            <td>{{$key+1}}</td>
           
			<td><img src="{{url('public/uploads/feedback/'.$page->banner)}}" height="50px" width="100px"></td>
            <td>{{$page->intro}}</td>
            <td>{{$page->intro_ar}}</td>
            <td>{{$page->concl}}</td>
            <td>{{$page->concl_ar}}</td>
            <td>{{$page->user()->full_name()}}</td>
            <td>{{date('d-m-Y',strtotime($page->created_at))."(". \Carbon\Carbon::parse($page->created_at)->diffForHumans().")"}}</td>
            <td >
         <div class="d-table"> <a href="{{route('manage-feedback-info.revert',$page->id)}}" onclick="return confirm('Are u sure you want to revert this record ?')" class="btn btn-info w-100"> Revert</a>              
               <a href="{{route('manage-feedback-info.revert',$page->id)}}?preview=1"  class="btn btn-info w-100 mt-1"> View</a>              
         </div>     
         </td>
         </tr>
         
         @endforeach
      </table>
        {{ $pages->links() }}
   </div>
</section>
</section>
		
		
	</div>
</div>
<div id="preview-page-content" style="display:none">
      @if(\Session::has('preview_page'))
        {!!\Session::get('preview_page')!!}
      @endif
</div>
<script>
   @if(\Session::has('preview_page')) 
      $().ready(function(){
         $('body').attr('style',"");
         $('#loader').remove();
         var w = window.open();
         $(w.document.body).html($('#preview-page-content').html());
         $('#preview-page-content').html("");
      });
   @endif
  function statefunction(id){
        swal({
          title: "Are you sure?",
          text: "You want to perform this action!",
          icon: "warning",
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
            url:  "{{url('/admin/page/status')}}/"+id,
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
           window.location.replace("{{route('staticpage.index')}}");
        }
        });
      }

  </script> 
</section>
@endsection