@extends('layouts.master')

@section('content')
<style type="text/css">
  td.ellipse-text {
      max-width: 150px;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
  }
</style> 

<section class="wrapper"> 
<div class="row">
	<div class="col-sm-12">
		<section class="panel">
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6 mt-4">
            <h1 class="m-0 text-dark"style="text-decoration: bold;">Story Category Management</h1>
         </div>
         
      </div>
      
	  
	  <br />
   </div>
   <!-- /.container-fluid -->
</div>
 
<section class="content">
   <div class="container-fluid">
   <!-- <form method="get" action="">
      <div class="d-block">
	    <div class="row">
      <div class="col-lg-4" style="">
			    <input type="text" autocomplete="off" id="search_key" class="form-control" placeholder="Search By Controlled Number or Name" value="{{Request::get('search_key')}}" name="search_key"> 
        </div>
        
      
        <div class="col-lg-3" style="">
        <select name="sort" class="form-control">
                            <optgroup label="Sort By">
                                <option value="latest" selected="true"  >Newest to Oldest</option>
                                <option value="ASC" @if(Request::get('sort') =='ASC') selected @endif>
                                    Oldest to Newest</option>
                            </optgroup>
                        </select>
          </div>
		
		  	<div class="col-lg-1 ">
		  <button class="btn btn-primary " type="submit" style="margin-top:2px;" >Search </button>
		  </div>
		  </div>
        </div>
      </form> -->
	  <div class="float-sm-right  mb-3">
        <a href="{{ route('story_category.create')}}" class="btn btn-primary " style="margin-bottom:5px;">Create Story Category</a>
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
          <th>Story categor</th>	
          <th>Created By</th>
          <th>Updated By</th>
          <th>Created At</th>
          <th>Updated At</th>
          <th>Action</th>
         </tr>
         @foreach($data as $key =>$document)
          <tr>
              <td>{{($data->perPage() * ($data->currentPage() - 1))+ ($key+1)}}</td>
              <td>{{$document->category}}</td>
              <td>{{$document->getUser($document->created_by)}}</td>
              <td>{{$document->getUser($document->updated_by)}}</td>
              <td>{{date('d M Y',strtotime($document->created_at))}}</td>
              <td>{{date('d M Y',strtotime($document->updated_at))}}</td>
              <td style="min-width:118px;">
                  <a href="{{route('story_category.edit',$document->id)}}" class="btn btn-info" title="Edit"> 
                  <i class="text-white fa fa-edit fa-edit" aria-hidden="true" ></i></a>
                    @if($document->status == '1')
                      <a  onclick="statefunction('{{$document->id}}')" class="btn btn-success btn-successuser" title="Block" style="color:white;"><i class="text-white fa fa-unlock" aria-hidden="true" ></i></a>
                    @else
                      <a  onclick="statefunction('{{$document->id}}')" class="btn btn-danger btn-successuser" title="Unblock" style="color:white;"><i class="text-white fa fa-lock" aria-hidden="true" ></i></a>
                    @endif
                    <a onclick="deleteConfirmation('{{$document->id}}')" class="btn btn-danger" title="Delete"><i class="text-white fa fa-ban fa-trash" aria-hidden="true" ></i></a> 
              </td>
            </tr>
         @endforeach
		 </tbody>
      </table>
        {{ $data->links() }}
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
         }).then(()=> {
            $.ajax({
                  type: 'get',
                  data: {
                  '_method': 'get'
                  },
                  url: "/admin/story_category/delete/" +id,
                  success: function(data) {
                        swal({
                          title: " Success!",
                          text: "Document deleted successfully!",
                          type: "success",
                          confirmButtonColor: "#069edb",
                          //timer: 3000
                          }).then(()=> {
                              window.location.replace("{{url('/admin/story_category')}}");
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
        }).then((isConfirm)=> {
          if(isConfirm){
           jQuery.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
          });
          jQuery.ajax({
            type: 'get',
            url:  "{{url('/admin/story_category/status')}}/"+id,
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
           window.location.replace("{{url('/admin/story_category')}}");
        }
        });
      }

  </script> 
</section>


@endsection