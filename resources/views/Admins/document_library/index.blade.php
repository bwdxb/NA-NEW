@extends('layouts.master')
@php
use app\Http\helper\Helper as Helper;
$department_owner =[
  'QHSE'=>'QHSE',
  'Clinical Service'=>'Clinical Service',
  'Corporate'=>'Corporate',
  'Finance'=>'Finance',
  'IT'=>'IT',
  'Human Resources'=>'Human Resources',
  'Operation'=>'Operation',
  'Supply Chain'=>'Supply Chain',
  ];
  $department_owner = Helper::getDocumentDepartment();
@endphp
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
            <h1 class="m-0 text-dark"style="text-decoration: bold;">Document Library Management</h1>
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
      <div class="col-lg-4" style="">
			    <input type="text" autocomplete="off" id="search_key" class="form-control" placeholder="Search By Controlled Number or Name" value="{{Request::get('search_key')}}" name="search_key"> 
        </div>
        <div class="col-lg-2" style="">
			 <select name="document_type_id" id="document_type_id" class="form-control">
					  
					<option value="">Select Document Type</option>
					@foreach($document_type as $key=>$type) 
					<option @if($key ==Request::get('document_type_id')) selected="selected" @endif value="{{$key}}">{{$type}}</option>
					@endforeach
					</select>
          </div>
        <div class="col-lg-2" style="">
			 <select name="department_owner" id="department_owner" class="form-control">
					  
					<option value="">Select Department</option>
					<!-- @foreach($department_owner as $type) 
					<option @if($type ==Request::get('department_owner')) selected="selected" @endif value="{{$type}}">{{$type}}</option>
					@endforeach -->
                    @foreach($department_owner as $key=>$docDept)

                     <option @if($docDept->department ==Request::get('department_owner')) selected="selected" @endif value="{{$docDept->department}}">{{$docDept->department}}</option>
                     @endforeach
					</select>
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
      </form>
	  <div class="float-sm-right mt-4 mb-3">
        <a href="{{ route('document_library.create')}}" class="btn btn-primary " style="margin-bottom:5px;">Create Document Library</a>
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
			<th style="width:120px;">Document Type</th>
            <!-- <th>Controlled Number</th> -->
			<th>Document Name</th>
			<th style="width:120px;">Version Number</th>
			<th>Department owner</th>
			<th>Data Classification</th>
			<th style="min-width:75px;">Date</th>
			<th>Document File</th>
      <th style="width:120px;">Action</th>
         </tr>
         @foreach($documents as $key=>$document)
         <tr>
            <td>{{($documents->perPage() * ($documents->currentPage() - 1))+ ($key+1)}}</td>
            <td>{{$document->document_type}}</td>
            <!-- <td>{{$document->controlled_number}}</td> -->
            <td class="ellipse-text">{{$document->document_name}}</td>
            <td>{{$document->version_number}}</td>
            <td>{{$document->department_owner}}</td>
            <td>{{$document->data_classification}}</td>
            <td>{{date(' M Y',strtotime($document->document_date))}}</td>
            <td class="ellipse-text"><a href="{{url($document->document_file)}}" target="_blank" style="color:#0000FF" download="{{$document->document_name}}">{{$document->document_file}}</a></td>
                  
            <td style="min-width:118px;">
               <a href="{{route('document_library.edit',$document->id)}}" class="btn btn-info" title="Edit"> 
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
        {{ $documents->appends(request()->input())->links() }}
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
         }).then(()=> {
         
        
         $.ajax({
                type: 'get',
                data: {
                '_method': 'get'
                },
                url: "/admin/document_library/delete/" +id,
                success: function(data) {
                swal({
                     title: " Success!",
                     text: "Document deleted successfully!",
                     type: "success",
                     confirmButtonColor: "#069edb",
                     //timer: 3000
                     }).then(()=> {
                     window.location.replace("{{url('/admin/document_library')}}");
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
            url:  "{{url('/admin/document_library/status')}}/"+id,
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
           window.location.replace("{{url('/admin/document_library')}}");
        }
        });
      }

  </script> 
</section>


@endsection