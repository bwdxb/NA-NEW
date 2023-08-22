@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <style type="text/css">
        tr, th, td {
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
                                    <h1 class="m-0 text-dark">Manage Roles</h1>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <section class="content">

                        <div class="container-fluid">
                            <form method="get" action="">
                                <div class="d-block">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <input class="form-control " value="{{Request::get('role')}}" name="role"
                                                   type="text" placeholder="Search by role" aria-label="Search">
                                        </div>


                                        <div class="col-lg-1">
                                            <button class="btn btn-primary searchBtn" type="submit"
                                                    style="margin-top:5px;">Search
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @if(Session::has('message'))
                                <div class="alert {{ Session::get('alert-class', 'alert-success') }}"
                                     style="margin-top: 15px;">
                                    <div style="display:inline-block" id="">
                                        {{ Session::get('message') }}
                                    </div>
                                </div>
                            @endif
                            @if(Session::has('error'))
                                <div class="alert {{ Session::get('alert-class', 'alert-danger') }}"
                                     style="margin-top: 15px;">
                                    <div style="display:inline-block" id="">
                                        {{ Session::get('error') }}
                                    </div>
                                </div>
                            @endif
                            <br/>
                            <br/>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>S.No</th>
                                    <th>Role</th>

                                    <th colspan="2">Action</th>

                                </tr>

                                @foreach($roles as $key=>$role)
                                    <tr>

                                    <td>{{($roles->perPage() * ($roles->currentPage() - 1))+ ($key+1)}}</td>
                                        <td>{{$role->role_name}}</td>

                                        <td>


                                            @if($role->IsActive == '1')
                                                <a onclick="statefunction('{{$role->id}}')"
                                                   class="btn btn-success btn-successuser" title="Block"
                                                   style="color:white;"><i class="text-white fa fa-unlock"
                                                                           aria-hidden="true"></i></a>
                                            @else
                                                <a onclick="statefunction('{{$role->id}}')"
                                                   class="btn btn-danger btn-successuser" title="Unblock"
                                                   style="color:white;"><i class="text-white fa fa-lock"
                                                                           aria-hidden="true"></i></a>
                                            @endif

                                        </td>


                                    </tr>
                                @endforeach


                            </table>
                        </div>

            </div>
        {{ $roles->links() }}
    </section>
    </section>


    </div>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        function statefunction(id) {
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
            }).then(isConfirm => {
                console.log(isConfirm);
                if (isConfirm) {
                    jQuery.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    jQuery.ajax({
                        type: 'get',
                        url: "{{url('/admin/role/status')}}/" + id,
                        success: function (data) {
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
                                }).then(success => {
                                    location.reload();
                                });
                        }
                    });
                } else {
                    window.location.replace("{{url('/admin/manage-roles')}}");
                }
            });
        }

    </script>

    </section>

@endsection




 
