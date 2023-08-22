@extends('layouts.master')
@section('header-ss')
    <!-- plugin css -->
    <link rel="stylesheet"
          href="{{asset('public/employee_portal/assets/plugins/@mdi/font/css/materialdesignicons.min.css')}}">
    <!-- <link rel="stylesheet"
          href="{{asset('public/employee_portal/assets/plugins/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/start/jquery-ui.css"
          type="text/css" media="all"/> -->

    <!-- Font Awsome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- common css -->
    <!-- <link rel="stylesheet" href="{{asset('public/employee_portal/css/app.css')}}"> -->
    <!-- <link rel="stylesheet" href="{{asset('public/employee_portal/css/animate.min.css')}}"> -->
    <!-- end common css -->

    <style>
        /* .disable {
            cursor: not-allowed;
            pointer-events: none;
        }

        .draggable {
            cursor: move;
            user-select: none;
        }

        .placeholder {
            background-color: #edf2f7;
            border: 2px dashed #cbd5e0;
        }

        .clone-list {
            border-top: 1px solid #ccc;
        }

        .clone-table {
            border-collapse: collapse;
            border: none;
        }

        .clone-table th, .clone-table td {
            border: 1px solid #ccc;
            border-top: none;
            padding: 0.5rem;
        }

        .dragging {
            background: #fff;
            border-top: 1px solid #ccc;
            z-index: 999;
        } */
        td.ellipse-text {
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
    @stack('plugin-styles')
@endsection
@section('content')

    <section class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="content-header w-100">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="mt-4">
                                <h1 class="m-0 text-dark">Vacancy Category</h1>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <div class="content w-100">
                    <div class="row align-items-center">
                        <div class="col-md-8 selectFilter">
                            <div class="form-group w-100">
                                <label>Search:</label>
                                <input type="text" id="myInput" class="form-control"
                                       placeholder="Search for the category"/>

                            </div>
                        </div>
                     
                        <div class="col-md-3 text-right">
                      
                            <a href="#mediaContentForm" class="btn btn-primary mt-2"
                               onclick="(function(){$('#mediaContentForm').show()})()">
                                Add Category
                            </a>
                        </div>
                    </div>
                    @if(session('success'))
                        <p class="text-success">
                            {{ session('success') }}<br/>
                        </p>
                    @endif
                    @if(session('error'))
                        <p class="text-danger">
                            {{ session('error') }}
                        </p>
                    @endif
            <!----- Add Form----->
            <div id="mediaContentForm"
                         style="{{ isset($update)?'':'display:none;' }}">
                        <ul class="errorMessages"></ul>
                        <div class="row mt-5">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <form class="addProductForm"
                                              action="{{ route('career-portal.admin.vacancy.category.create_or_update') }}"
                                              method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id"
                                                   value="{{ old('id') ? old('id'): ( isset($update->id) ? $update->id : '') }}"
                                                   class="form-control">

                                            <input type="hidden" name="op_type"
                                                   value="{{ isset($update->id) ? 'update' : 'create' }}"
                                                   class="form-control">

                                            <div class="form_column">
                                                <h5>{{ isset($update)?"Update":"Add" }} Category</h5>

                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>Job Category Name</label>
                                                        <input type="text" class="form-control" name="job_category"
                                                               value="{{ (old('job_category')) ? old('job_category'): (isset($update->job_category)?$update->job_category:'') }}"
                                                               required>
                                                        @error('job_category')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Job Category Name (ar)</label>
                                                        <input type="text" class="form-control" name="job_category_ar"
                                                               value="{{ (old('job_category_ar')) ? old('job_category_ar'): (isset($update->job_category_ar)?$update->job_category:'') }}"
                                                               required>
                                                        @error('job_category_ar')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="form_column">
                                                <div class="row">
                                                    <div class="btn_column form-group col-md-12 mt-3">
                                                        <a href="{{ url()->previous()}}"  class="btn btn-primary mr-2">Back</a>
                                                        <a href=""  class="btn btn-primary mr-2">Cancel</a>
                                                        <button type="submit" class="btn btn-primary">{{ isset($update)?"Update":"Create" }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row grid-margin mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped adminTable">
                                            <thead>
                                            <tr>
                                                <th style="width:50px;">#</th>
                                                <th style="max-width:150px;">Category Name</th>
                                                <th style="max-width:150px;">Category Name (ar)</th> 
                                                <th>Status</th>
                                                <!-- <th>Timestamps</th> -->
                                                <th>Operations</th>
                                            </tr>
                                            </thead>
                                        </table>
                                        <table class="table table-striped" id="table">
                                            <tbody id="myTable">
                                            @forelse($data as $d)
                                                <tr>
                                                    <td style="width:50px;">
                                                        {{$loop->iteration}}
                                                    </td>
                                                    <td class="ellipse-text">{{ $d->job_category }}</td>
                                                    <td class="ellipse-text">{{ $d->job_category_ar }}</td>
                                                    <td class="">
<!-- {{--                                                        {{$d->status}}--}} -->
                                                        @if($d->status == 'active')
                                                            <p class="text-success"> Active </p>
                                                            <a url="{{ route('career-portal.admin.vacancy.category.update.status',['id'=>$d->id,'status'=>'inactive']) }}"
                                                            onclick="confirmation($(this).attr('url'),'Are you sure, you want to change the status?','Status successfully changed')"   
                                                            type="button" class="actionLink">
                                                            <span class="mdi mdi-pencil-box-outline"></span>
                                                        </a>
                                                        @else
                                                        <p class="text-danger"> InActive </p>
                                                        <a url="{{ route('career-portal.admin.vacancy.category.update.status',['id'=>$d->id,'status'=>'active']) }}"
                                                                onclick="confirmation($(this).attr('url'),'Are you sure, you want to change the status?','Status successfully changed')"   
                                                               type="button" class="actionLink">
                                                                <span class="mdi mdi-pencil-box-outline"></span>
                                                            </a>
                                                        @endif
                                                    </td>

                                                    <!-- <td>
                                                        Created at : {{$d->created_at}} <br/>
                                                        Last Updated at : {{$d->updated_at}}
                                                    </td> -->
                                                    <td class="adminAction">
                                                            <a url="{{ route('career-portal.admin.vacancy.category.delete',['id'=>$d->id]) }}"
                                                               onclick="deleteConfirmation($(this).attr('url'))"
                                                               class="actionLink redBg">
                                                                <span class="mdi mdi-delete"></span>
                                                            </a>
                                                            <a href="{{ route('career-portal.admin.vacancy.category.update.view',['id'=>$d->id]) }}"
                                                               type="button" class="actionLink">
                                                                <span class="mdi mdi-pencil-box-outline"></span>
                                                            </a>

                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="text-center" colspan="9"
                                                        style="text-align: center;">
                                                        <b>No Records Found!!!</b>
                                                    </td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                    </div>
                  
                    {{--                            </div>--}}
                </div>
            </div>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script> -->
    <script>
        function updateButtonStatus() {

            var n = $("input:checked").length;
            // alert('#'+n);
            $('#update6Apps').prop('disabled', true);
            $('#update6Apps').addClass("disable");
            $('#update6Apps').text('6 Apps should be selected for Dashboard')
            if (n == 6) {
                $('#update6Apps').prop('disabled', false);
                $('#update6Apps').removeClass("disable");
                $('#update6Apps').text('Update Dashboard Apps')
            } else if (n > 6) {
                $('#update6Apps').text('Only 6 Apps should be selected')
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

            // $("#myInput").on("keyup", function () {
            //     var input, filter, table, tr, td, i, txtValue;
            //     input = document.getElementById("myInput");
            //     filter = input.value.toUpperCase();
            //     table = document.getElementById("myTable");
            //     tr = table.getElementsByTagName("tr");
            //     for (i = 0; i < tr.length; i++) {
            //         td = tr[i].getElementsByTagName("td")[0];
            //         if (td) {
            //             txtValue = td.textContent || td.innerText;
            //             if (txtValue.toUpperCase().indexOf(filter) > -1) {
            //                 tr[i].style.display = "";
            //             } else {
            //                 tr[i].style.display = "none";
            //             }
            //         }
            //     }
            // });
            $(document).ready(function(){
                $("#myInput").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#myTable tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        });
        function confirmation(url,msg,successMsg) {
            swal({
                title: "Are you sure?",
                text: msg,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#069edb",
                confirmButtonText: "Yes",
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
                        url: url,
                        success: function(data) {
                            swal("Success",successMsg,"success").then(() =>{
                                    window.location.replace("{{url('/admin/career-portal/admin/vacancy/category')}}");
                                });
                            }
                        });
                }
            
                });
        }
        function deleteConfirmation(url) {
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
               url: url,
               success: function(data) {
                 swal({
                     title: " Success!",
                     text: "Vacancy category deleted successfully!",
                     type: "success",
                     confirmButtonColor: "#069edb",
                     //timer: 3000
                     }).then(() =>{
                     window.location.replace("{{url('/admin/career-portal/admin/vacancy/category')}}");
                     });
                 }
               });
       }
       
        });
 }


    </script>
@endsection