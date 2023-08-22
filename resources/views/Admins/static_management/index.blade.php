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
                <h1 class="m-0 text-dark" style="text-decoration: bold;">Static Page Management</h1>
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
                  <div class="col-lg-3" style="margin-right:4px">
                    <select name="parent_id" id="parent_id" class="form-control">

                      <option value="">Select Menu</option>
                      @foreach($menus as $key=>$menu)
                      <option @if($key==Request::get('parent_id')) selected="selected" @endif value="{{$key}}">{{$menu}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-lg-3" style="margin-right:4px">
                    <input type="text" autocomplete="off" id="title" class="form-control" placeholder="Search By Title" value="{{Request::get('title')}}" name="title">
                  </div>
                  <div class="col-lg-1 ">
                    <button class="btn btn-primary " type="submit" style="margin-top:2px;">Search </button>
                  </div>
                </div>
              </div>
            </form>
            <div class="float-sm-right mt-4 mb-3">
              <a href="{{ route('staticpage.create')}}" class="btn btn-primary " style="margin-bottom:5px;">Create CMS</a>
            </div>
            @if(Session::has('message'))
            <div class="alert {{ Session::get('alert-class', 'alert-success') }}" style="margin-top: 15px;">
              <div style="display:inline-block" id="">
                {{ Session::get('message') }}
              </div>
            </div>
            @endif
            @if(Session::has('error'))
            <div class="alert {{ Session::get('alert-class', 'alert-danger') }}" style="margin-top: 15px;">
              <div style="display:inline-block" id="">
                {{ Session::get('error') }}
              </div>
            </div>
            @endif
            <table class="table table-bordered table-striped">
              <tr>
                <th>Sr.No</th>
                <th>Parent Menu</th>
                <th>Title</th>
                <th>Title (Ar)</th>
                <th>Banner</th>
                <th>Description</th>
                <th>Description (Ar)</th>
                <th>Action</th>
              </tr>
              @foreach($pages as $key =>$page)
              <tr>
                <td>{{($pages->perPage() * ($pages->currentPage() - 1))+ ($key+1)}}</td>
                <td>{{$page->parent_title}}</td>
                <td>{{$page->title}}</td>
                <td>{{$page->title_ar}}</td>
                <td><img src="{{url('public/uploads/cms/'.$page->image)}}" height="50px" width="100px"></td>
                <td>{{strip_tags(\Illuminate\Support\Str::limit($page->description, 80, $end='...'))}}</td>
                <td>{{strip_tags(\Illuminate\Support\Str::limit($page->description_ar, 80, $end='...'))}}</td>
                <td style="min-width:155px;">
                  <a href="{{route('static_page.history',$page->id)}}" class="btn btn-warning" title="History"><i class="text-white fas fa-history" aria-hidden="true"></i></a>
                  <a href="{{route('staticpage.edit',$page->id)}}" class="btn btn-info" title="Edit">
                    <i class="text-white fa fa-edit fa-edit" aria-hidden="true"></i></a>
                  @if($page->status == '1')
                  <a onclick="statefunction('{{$page->id}}')" class="btn btn-success btn-successuser" title="Block" style="color:white;"><i class="text-white fa fa-unlock" aria-hidden="true"></i></a>
                  @else
                  <a onclick="statefunction('{{$page->id}}')" class="btn btn-danger btn-successuser" title="Unblock" style="color:white;"><i class="text-white fa fa-lock" aria-hidden="true"></i></a>
                  @endif
                  <a onclick="deleteConfirmation(`{{route('page.delete',$page->id)}}`)" url="{{route('page.delete',$page->id)}}" class="btn btn-danger" title="Delete">
                    <i class="text-white fa fa-ban fa-trash" aria-hidden="true"></i></a>
                 

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
  <script>
    function deleteConfirmation(url) {
      swal({
        title: "Are you sure?",
        text: "Are you sure ,you want to DELETE ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#069edb",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
      }).then((isConfirm) => {
        if (isConfirm) {
          $.ajax({
            type: 'get',
            data: {
              '_method': 'get'
            },
            url: url,
            success: function(data) {
              swal({
                title: " Success!",
                text: "Document deleted successfully!",
                type: "success",
                confirmButtonColor: "#069edb",
                //timer: 3000
              }).then(() => {
                window.location.reload();
              });
            }
          });
        }
      });
    }
  </script>
  <script>
    function statefunction(id) {
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
      }).then((isConfirm) => {
        if (isConfirm) {
          jQuery.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
          });
          jQuery.ajax({
            type: 'get',
            url: "{{url('/admin/page/status')}}/" + id,
            success: function(data) {
              if (data == 1) {
                var status_user = 'unblocked';
              } else {
                var status_user = 'blocked';
              }
              swal({
                title: "Done!",
                text: " successfully!",
                type: "success",
                confirmButtonColor: "#069edb",
              }).then(() => {
                location.reload();
              });
            }
          });
        } else {
          window.location.replace("{{route('staticpage.index')}}");
        }
      });
    }
  </script>
</section>
@endsection