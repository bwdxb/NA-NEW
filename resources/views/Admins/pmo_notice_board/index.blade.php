@extends('layouts.master')
@php
$department_owner =[
  'QHSE'=>'QHSE',
  'Clinical Service'=>'Clinical Service',
  'Corporate'=>'Corporate',
  'Finance'=>'Finance',
  'IT'=>'IT',
  'Human Resources'=>'Human Resources',
  'Operation'=>'Operation',
  'Supply Chain'=>'Supply Chain',
  ]
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
            <h1 class="m-0 text-dark"style="text-decoration: bold;">PMO Notice Board</h1>
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
        <a href="{{ route('pmo_notice_board.create')}}" class="btn btn-primary " style="margin-bottom:5px;">Create PMO Notice</a>
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
       <form action="{{ route('pmo_notice_board.update-dashboard') }}" method="post">
            {{ csrf_field() }}
        <div class="table-responsive">
        <table class="table table-striped adminTable">
            <tbody>
         <tr>
            <th style="width:50px;">#</th>
			<th style="width:120px;">Title</th>
            <th style="width:120px;">Action</th>
         </tr>
         @foreach($pmodata as $key=>$data)
            <tr>
                <td><input class="form-check-input checkBoxAppClass ml-0" type="checkbox" id="{{$data->id}}" @if($data->selected == 1) checked @endif>
                    <input id="check{{$data->id}}" type="hidden" name="app_ids[]" value="0">
                </td>
                <td>{{$data->title}}</td>
                <td style="min-width:118px;">
                    <a href="{{route('pmo_notice_board.edit',$data->id)}}" class="btn btn-info" title="Edit"><i class="text-white fa fa-edit fa-edit" aria-hidden="true" ></i></a>
                    <a onclick="deleteConfirmation('{{$data->id}}')" class="btn btn-danger" title="Delete"><i class="text-white fa fa-ban fa-trash" aria-hidden="true" ></i></a>
                </td>
            </tr>
         @endforeach
		 </tbody>
      </table>
      </div>
        <div class="col-md-12 text-center">
            <div class="btn_column form-group mt-3">
                <button id="update6Apps" type="submit"
                        class="btn btn-primary">Update Dashboard Apps
                </button>
            </div>
        </div>
        </form>
        {{ $pmodata->appends(request()->input())->links() }}
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
                url: "/admin/pmo_notice_board/delete/" +id,
                success: function(data) {
                swal({
                     title: " Success!",
                     text: "Document deleted successfully!",
                     type: "success",
                     confirmButtonColor: "#069edb",
                     //timer: 3000
                     }).then(()=> {
                     window.location.replace("{{url('/admin/pmo_notice_board')}}");
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
            url:  "{{url('/admin/pmo_notice_board/status')}}/"+id,
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
           window.location.replace("{{url('/admin/pmo_notice_board')}}");
        }
        });
      }

  </script> 
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <script>
        function updateButtonStatus() {

            var n = $("input:checked").length;
            
            // alert('#'+n);
            /*$('#update6Apps').prop('disabled', true);
            $('#update6Apps').addClass("disable");
            $('#update6Apps').text('8 Apps should be selected for Dashboard')*/
            if (n == 8) {
                $('#update6Apps').prop('disabled', false);
                $('#update6Apps').removeClass("disable");
                $('#update6Apps').text('Update Dashboard Apps')
            } else if (n > 8) {
                $('#update6Apps').text('Only 8 Apps should be selected')
            }
        }

        $(document).ready(function () {
            // items = document.getElementsByClassName('checkBoxAppClass');
            items = $("input:checked");
            $.each(items, function (index, item) {
                var itemId = '#' + item.id;
                var itemElement = $(itemId);
                console.log(index, itemId, itemElement.prop('checked'), itemElement, $('#check' + item.id).prop('value'))

                if (itemElement.prop('checked')) {
                    if (itemElement.prop('checked')) {
                        $('#check' + item.id).prop('value', "" + item.id)
                    } else {
                        $('#check' + item.id).prop('value', "0")
                    }
                }
            });

            updateButtonStatus();

            $(".checkBoxAppClass").click(function () {
                items = document.getElementsByClassName('checkBoxAppClass');
                var id = $(this).prop('id');
                if (id) {
                    if ($(this).prop('checked')) {
                        $('#check' + id).prop('value', "" + id)
                    } else {
                        $('#check' + id).prop('value', "0")
                    }
                }
                updateButtonStatus();
            });

            $("#myInput").on("keyup", function () {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("myTable");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[0];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            });
        });
    </script>
</section>


@endsection