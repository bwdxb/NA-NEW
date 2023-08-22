@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<style type="text/css">
    /* tr, th, td {
    min-width: 150px;
} */
    td.ellipse-text {
        max-width: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .user_action {
        min-width: 82px;
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
                                <h1 class="m-0 text-dark">User Management</h1>
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
                                        <input class="form-control " value="{{Request::get('first_name')}}" name="first_name" type="text" placeholder="Search by name" aria-label="Search">
                                    </div>


                                    <div class="col-lg-3" style="margin-right:4px">
                                        <input class="form-control form-control-navbar " value="{{Request::get('mobile')}}" name="mobile" type="text" placeholder="Search by phone" aria-label="Search">
                                    </div>
                                    <div class="col-lg-3" style="margin-right:4px">
                                        <input class="form-control form-control-navbar " value="{{Request::get('email')}}" name="email" type="text" placeholder="Search by email" aria-label="Search">
                                    </div>
                                    <!-- <div class="col-lg-3" style="margin-right:4px">
                                    <label for="limit_select">Per Page</label>
                                    <select name="limit" id="limit_select" class="form-control form-control-navbar ">
                                        <option @if(Request::get('limit') == 10) selected @endif value="10">10</option>
                                        <option @if(Request::get('limit') == 50) selected @endif  value="50">50</option> 
                                        <option @if(Request::get('limit') == 100) selected @endif  value="100">100</option>
                                    </select>
                                       
                                    </div> -->

                                    <div class="col-lg-1 ">
                                        <button class="btn btn-primary " type="submit" style="margin-top:2px;">
                                            Search
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="row col-lg-3 mt-5" style="margin-right:4px">
                                <label for="limit_select" class="mr-3">Per Page </label>
                                <select name="limit" id="limit_select" class="" onchange="this.form.submit()">
                                    <option @if(Request::get('limit')==10) selected @endif value="10">10</option>
                                    <option @if(Request::get('limit')==50) selected @endif value="50">50</option>
                                    <option @if(Request::get('limit')==100) selected @endif value="100">100</option>
                                </select>

                            </div>
                        </form>

                        <div class="float-sm-right mt-4 mb-3">
                            <a href="{{ route('user.create')}}" class="btn btn-primary " style="margin-bottom:5px;">Create
                                User</a>
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
                        <table class="table table-bordered table-striped mt-5">
                            <tr>
                                <th style="width:50px;">S.No</th>
                                <th>Role</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <!-- <th>User Name</th> -->
                                <th>Email</th>
                                <!-- <th>Phone Number</th> -->
                                <th>Designation</th>


                                <th colspan="2">Action</th>
                                <!-- <th>Update Password</th> -->
                            </tr>

                            @forelse($users as $key=>$user)
                            <tr>

                                <td style="width:50px;">{{($users->perPage() * ($users->currentPage() - 1))+ ($key+1)}}</td>
                                <td>{{$user->role()?$user->role()->role_name:""}}</td>
                                <td>{{$user->first_name}}</td>
                                <td>{{$user->last_name}}</td>
                                <!-- <td>{{$user->user_name}}</td> -->
                                <td class="ellipse-text">{{$user->email}}</td>
                                <!-- <td>{{$user->mobile}}</td> -->
                                <td>{{$user->designation}}</td>


                                <td class="user_action"><a href="{{ route('user.edit',['id'=>$user->id])}}" class="btn btn-info" title="Edit">
                                        <i class="text-white fa fa-edit fa-edit" aria-hidden="true"></i></a>
                                    <!--    <a href="{{ route('user.show',$user->id)}}" class="btn btn-success" ><i class="fa fa-eye" aria-hidden="true"></i></a>-->


                                    @if($user->status == '1')
                                    <a onclick="statefunction('{{$user->id}}')" class="btn btn-success btn-successuser" title="Block" style="color:white;"><i class="text-white fa fa-unlock" aria-hidden="true"></i></a>
                                    @else
                                    <a onclick="statefunction('{{$user->id}}')" class="btn btn-danger btn-successuser" title="Unblock" style="color:white;"><i class="text-white fa fa-lock" aria-hidden="true"></i></a>
                                    @endif
                                    <a onclick="deleteConfirmation('{{route('user.softdelete',$user->id)}}')" class="btn btn-danger" title="Delete"><i class="text-white fa fa-ban fa-trash" aria-hidden="true"></i></a>

                                </td>
                                <td>
                                    <a id="a-{{$user->id}}" onclick="displayUpdatePassword('{{$user->id}}')" class="pass-form-label btn text-info">Update Password</a>

                                    <form id="pass-{{$user->id}}" style="display:none;" method="post" action="{{route('changepssword', ['userId'=>$user->id])}}" class="pass-form row p-5">
                                        @csrf
                                        <div class="row container-fluid">
                                            <input type="password" name="newpassword" placeholder="New Password" class="form-control col-6">
                                            <input type="password" name="confirmpassword" placeholder="Confirm Password" class="form-control col-6">
                                        </div>
                                        <div class="row container-fluid mt-3">
                                            <input type="submit" value="Proceed" class="btn btn-success col-6">
                                            <input type="button" value="cancel" onclick="cancelUpdatePassword('{{$user->id}}')" class="btn btn-danger col-6">
                                        </div>
                                    </form>

                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="9" style="text-align: center;">
                                    <b>No Records in the Found!!!</b>
                                </td>
                            </tr>
                            @endforelse


                        </table>

                    </div>

                </div>
                {{ $users->appends(request()->input())->links() }}
        </div>
</section>


</div>
</div>
<script>
    function deleteConfirmation(url) {
        swal({
            title: "Are you sure?",
            text: "Are you sure you want to delete the user?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#069edb",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false,
            buttons: true,
        }).then((isconfirm) => {
            if (isconfirm) {
                window.location.replace(url);
                $.ajax({
                    type: 'get',
                    data: {
                        '_method': 'get'
                    },
                    url: url,
                    success: function(data) {
                        swal({
                            title: " Success!",
                            text: "User Record deleted successfully!",
                            type: "success",
                            confirmButtonColor: "#069edb",
                            //timer: 3000
                        }).then(() => {
                            window.location.replace("{{url('/admin/user')}}");
                        });
                    }
                });
            }
        });
    }
</script>
<script>
    function displayUpdatePassword(divid) {
        // alert(divid);
        $('.pass-form').hide();
        $('.pass-form-label').show();
        $('#pass-' + divid).show();
        $('#a-' + divid).hide();
    }

    function cancelUpdatePassword(divid) {
        // alert(divid);
        $('#pass-' + divid).hide();
        $('#a-' + divid).show();
    }

    function statefunction(id) {
        swal({
            title: "Are you sure?",
            text: "You want to perform this action!",
            type: "warning",
            showCancelButton: true,
            cancelButtonClass: 'btn-danger',
            confirmButtonText: 'Yes,perform it',
            cancelButtonText: "Cancel",
            closeOnConfirm: true,
            closeOnCancel: true,
            buttons: true,
        }).then((isConfirm) => {
            if (isConfirm) {
                jQuery.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    type: 'get',
                    url: "{{url('/admin/user/status')}}/" + id,
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
                window.location.replace("{{route('user.index')}}");
            }
        });
    }
</script>

</section>

@endsection