@extends('layouts.master')
@php
    use app\Http\helper\Helper as Helper;
    $services = Helper::all_services();
@endphp
@section('header-ss')
    <!-- plugin css -->
    <link rel="stylesheet"
          href="{{asset('public/employee_portal/assets/plugins/@mdi/font/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('public/employee_portal/assets/plugins/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/start/jquery-ui.css"
          type="text/css" media="all"/>

    <!-- Font Awsome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- common css -->
    <!-- <link rel="stylesheet" href="{{asset('public/employee_portal/css/app.css')}}"> -->
    <link rel="stylesheet" href="{{asset('public/employee_portal/css/animate.min.css')}}">
    <!-- end common css -->

    <style>
        .disable {
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
        }
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
                                <h1 class="m-0 text-dark">Internal Application</h1>
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
                                           placeholder="Search for a keyword contains in document name or controll number"/>

                                </div>
                        </div>
                        {{--        <div class="row">--}}
                        {{--            <div class="col-md-12 d-flex align-items-center justify-content-between">--}}
                        {{--                <h1 class="h1_heading">Internal Application </h1>--}}
                        {{--                <div class="addProduct">--}}
                        {{--                    <a id="addmediacontent" href="#" type="button" class="btn btn-primary">--}}
                        {{--                        <i class="mdi mdi-plus-circle"></i>--}}
                        {{--                        Add Application--}}
                        {{--                    </a>--}}
                        {{--                </div>--}}
                        {{--            </div>--}}
                        {{--        </div>--}}
                        <div class="col-md-3 text-right">
                            {{--                                <a href="#storyForm" class="btn btn-primary"--}}
                            {{--                                   onclick="(function(){$('#storyForm').show()})()">--}}
                            {{--                                    Add The Media Content--}}
                            {{--                                </a>--}}
                            <a href="#mediaContentForm" class="btn btn-primary mt-2"
                               onclick="(function(){$('#mediaContentForm').show()})()">
                                Add Application
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
                        {{--                            <div class="row">--}}
                        {{--                                <div class="col-lg-12">--}}
                        {{--                                    <div class="form-group">--}}
                        {{--                                        <label>Search:</label>--}}
                        {{--                                        <input type="text" id="myInput" class="form-control"--}}
                        {{--                                               placeholder="Search for a keyword contains in document name or controll number"/>--}}

                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        <div class="row grid-margin mt-4">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="{{ route('employee-portal.internal-application.update-dashboard') }}"
                                              method="post">
                                            {{ csrf_field() }}
                                            <div class="table-responsive">
                                                <table class="table table-striped adminTable">
                                                    <thead>
                                                    <tr>
                                                        <th style="width:50px;">#</th>
                                                        <th style="width:100px;">Title</th> 
                                                        <th style="width:35%;">URL</th>
                                                        <th style="width:100px;">Logo</th>
                                                        <th>Operations</th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                                <table class="table table-striped" id="table">
                                                    <tbody id="myTable">
                                                    @forelse($data as $d)
                                                        <tr>
                                                            <td style="width:50px;">
                                                                <input class="form-check-input checkBoxAppClass ml-0"
                                                                       type="checkbox"
                                                                       id="{{$d->id}}"
                                                                       @if($d->selected == 1)
                                                                       checked
                                                                        @endif
                                                                >
                                                                <input id="check{{$d->id}}" type="hidden"
                                                                       name="app_ids[]" value="0">
                                                            </td>
                                                            <td style="width:100px;">{{ $d->title }}</td>
                                                            <td style="width:35%;"class="py-1 doc_name ellipse-text">
                                                                <a href="{{ $d->url }}"
                                                                   target="_blank">{{ $d->url }}</a>
                                                            </td>
                                                            <td style="width:100px;">
                                                                <img src="{{ url('public/'.$d->logo) }}" style="background-color: black;width:40px; height:40px;"/>
                                                            </td>
                                                            <td>
                                                                    <a href="{{ route('employee-portal.internal-application.update',['id'=>$d->id]) }}"
                                                                       type="button" class="btn btn-info mr-1" title="Edit">
                                                                        <span class="mdi mdi-pencil-box-outline"></span>
                                                                    </a>
                                                                    <a href="{{ route('employee-portal.internal-application.delete',['id'=>$d->id]) }}"
                                                                       type="button"
                                                                       class="btn btn-danger" title="Delete">
                                                                       <i class="text-white fa fa-ban" aria-hidden="true" ></i>
                                                                    </a>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td class="text-center" colspan="9"
                                                                style="text-align: center;">
                                                                <b>No Records in the Found!!!</b>
                                                            </td>
                                                        </tr>
                                                    @endforelse
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
                                    </div>
                                </div>
                            </div>
                            <br/>
                        </div>
                        <!----- Add Form----->
                        <div id="mediaContentForm"
                             style="{{ isset($update)?'':'display:none;' }}">
                            <ul class="errorMessages"></ul>
                            <div class="row mt-5">
                                <div class="col-md-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="addProductForm"
                                                  action="{{ route('employee-portal.internal-application.create') }}"
                                                  method="post" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="id"
                                                       value="{{ old('id') ? old('id'): ( isset($update->id) ? $update->id : '') }}"
                                                       class="form-control">

                                                <input type="hidden" name="op_type"
                                                       value="{{ isset($update->id) ? 'update' : 'create' }}"
                                                       class="form-control">

                                                <div class="form_column">
                                                    <h5>{{ isset($update)?"Update":"Add" }} Internal
                                                        Application</h5>

                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>Title</label>
                                                            <input type="text" class="form-control" name="title"
                                                                   value="{{ (old('title')) ? old('title'): (isset($update->title)?$update->title:'') }}"
                                                                   required>
                                                            @error('title')
                                                            <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Url</label>
                                                            <input type="text" class="form-control" name="url"
                                                                   value="{{ (old('url')) ? old('url'): (isset($update->url)?$update->url:'') }}"
                                                                   required>
                                                            @error('url')
                                                            <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <div class="custom-file">
                                                                <label for="exampleFormControlFile1">Upload
                                                                    Photo *</label>
                                                                <input type="file" class="form-control-file"
                                                                       id="exampleFormControlFile1"
                                                                       name="logo"
                                                                        {{ isset($update)?'':'required' }}>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form_column">
                                                    <div class="row">
                                                        <div class="btn_column form-group col-md-12 mt-3">
                                                        <a href="{{ url()->previous()}}"  class="btn btn-primary"> Back</a>
                                                            <a href=""  class="btn btn-primary btn-block"> Cancel</a>
                                                            <button type="submit" class="default_btn">Submit
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
@endsection