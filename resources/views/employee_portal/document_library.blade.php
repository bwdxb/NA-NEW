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
  ]
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
    <link rel="stylesheet" href="{{asset('public/employee_portal/css/animate.min.css')}}">
    <!-- end common css -->
    @stack('plugin-styles')
@endsection
{{--@section('content')--}}
{{--    <section class="wrapper">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-12">--}}
{{--                <h1 class="h1_heading">Document Library</h1>--}}
{{--            </div>--}}
{{--            <div class="col-lg-12">--}}
{{--                <div class="form-group">--}}
{{--                    <label>Search:</label>--}}

{{--                    <input type="text" id="myInput" class="form-control"--}}
{{--                           placeholder="Search for a keyword contains in document name or controll number..."/>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-lg-12 grid-margin">--}}
{{--                <div class="documentFilter">--}}
@section('content')
    <section class="wrapper">
        <div class="panel">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-md-12 mt-4">
                            <h1 class="m-0 text-dark">The Document Library</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="addProductForm" action="" method="get">
                                {{ csrf_field() }}
                                <input type="hidden" value="admin" name="logged">
                                <div class="selectFilter">
                                    <label class="filterTxt mr-2">Filter by:</label>
                                    <div class="filterBox">
                                    <select name="data_classification_id" id="data_classification_id" class="form-control">
                                        <option value="">Department</option>
                                        @foreach($data_classification as $key=>$type) 
                                        <option @if($key ==Request::get('data_classification_id')) selected="selected" @endif value="{{$key}}">{{$type}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                    <div class="filterBox">
                                    <select name="document_type_id" id="document_type_id" class="form-control">
                                        <option value="">Document Type</option>
                                        @foreach($department_owner as $key=>$type) 
                                        <option @if($key ==Request::get('department_owner')) selected="selected" @endif value="{{$key}}">{{$type}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                    <div class="filterBox">
                                    <input type="text" autocomplete="off" id="search_key" class="form-control" placeholder="Search By Controlled Number or Name" value="{{Request::get('search_key')}}" name="search_key"> 

                                    </div>
                                    <div class="DT_Reset">
                                        <button class="btn submit" type="submit"><i class="mdi mdi-submit-variant"></i>
                                            Filter
                                        </button>
                                        <button class="btn submit" type="reset"><i class="mdi mdi-redo-variant"
                                                                                   onclick="(function(){$('form').get(0).reset()})"></i>
                                            Reset
                                        </button>
                                    </div>
                                    <div class="filterBox">
                                        <select name="sort" class="form-control">
                                            <optgroup label="Sort By">
                                                <option value="latest" selected="true">Newest to Oldest</option>
                                                <option value="Sale"
                                                        {{ ( isset($filter )&& $filter['sort'] ==='Sale')?"selected":"" }}>
                                                    Oldest to Newest
                                                </option>
                                            </optgroup>
                                        </select>
                                        @error('sort')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{--                    <div class="addProduct">--}}
                        {{--                        <a id="addmediacontent" href="#"><i class="mdi mdi-plus-circle"></i>Add Document Record</a>--}}
                        {{--                    </div>--}}
                        <div class="col-md-12 text-right">
                            {{--                                <a href="#storyForm" class="btn btn-primary " style="margin-bottom:5px;"--}}
                            {{--                                   onclick="(function(){$('#storyForm').show()})()">--}}
                            {{--                                    Add The Media Content--}}
                            {{--                                </a>--}}
                            <a href="#mediaContentForm" class="btn btn-primary mt-3"
                               onclick="(function(){$('#mediaContentForm').show()})()">
                                Add Document Record
                            </a>
                        </div>
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
                        {{--                </div>--}}
                        <div class="grid-margin mt-4">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped adminTable">
                                                <thead>
                                                <tr>
                                                    <th>Controlled Number</th>
                                                    <th>Document Name</th>
                                                    <th>Version</th>
                                                    <th>Date</th>
                                                    <th>Department</th>
                                                    <th>Document Type</th>
                                                    <th>Size</th>
                                                    <th>Link</th>
                                                    <th>Operations</th>
                                                </tr>
                                                </thead>
                                                <tbody id="myTable">
                                                @forelse($data as $d)
                                                    <tr>
                                                        <td>{{ $d->controlled_number }}</td>
                                                        <td class="py-1 doc_name">{{ $d->document_name }}</td>
                                                        <td class="v_number">{{ $d->version_number }}</td>
                                                        <td class="">{{ (new \Carbon\Carbon($d->document_date))->format('M Y') }}</td>
                                                        <td>{{ $d->department_owner }}</td>
                                                        <td>{{ $d->data_classification }}</td>
                                                        <td class="file_size">{{ $d->file_size }}</td>
                                                        <td class="file_link">
                                                            <a href="{{ route('employee-portal.document-library.download',['docId'=>$d->id]) }}"
                                                               class="doc_button" >
                                                                <i aria-hidden="true" class="mdi mdi-cloud-download-outline mr-2"></i>
                                                                Download
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="adminAction">
                                                                <a href="{{ route('employee-portal.document-library.delete',['id'=>$d->id]) }}"
                                                                   type="button" class="actionLink redBg">
                                                                    <span class="mdi mdi-delete"></span>
                                                                </a>
                                                                <a href="{{ route('employee-portal.document-library.update',['id'=>$d->id]) }}"
                                                                   type="button" class="actionLink">
                                                                    <span class="mdi mdi-pencil-box-outline"></span>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="text-center" colspan="9"
                                                            style="text-align: center;">
                                                            <b>No Records in the Document Library!!!</b>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                {{--            </div>--}}
                                {{--        </div>--}}
                            </div>
                            <br/>
                        </div>
                        <div id="mediaContentForm"
                             style="{{ isset($update)?'':'display:none;' }}">
                            <div class="row mt-5">
                                <div class="col-md-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3>Document Library</h3>
                                            <form class="addProductForm"
                                                  action="{{ route('employee-portal.document-library.create') }}"
                                                  method="post"
                                                  enctype="multipart/form-data">
                                                {{ csrf_field() }}

                                                <input type="hidden" name="id"
                                                       value="{{ old('id') ? old('id'): ( isset($update->id) ? $update->id : '') }}"
                                                       class="form-control">

                                                <input type="hidden" name="op_type"
                                                       value="{{ isset($update->id) ? 'update' : 'create' }}"
                                                       class="form-control">
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
                                                <ul class="errorMessages text-danger"
                                                    style="list-style:unset;background-color: bisque;"></ul>

                                                <div class="form_column">
                                                    <h5>Add The Document</h5>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>Controlled Number</label>
                                                            <input type="text" name="controlled_number"
                                                                   value="{{ (old('controlled_number')) ? old('controlled_number'): (isset($update->controlled_number)?$update->controlled_number:'') }}"
                                                                   class="form-control">
                                                            @error('controlled_number')
                                                            <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>Document Name</label>
                                                            <input type="text" name="document_name"
                                                                   value="{{ (old('document_name')) ? old('document_name'): (isset($update->document_name)?$update->document_name:'') }}"
                                                                   class="form-control">
                                                            @error('document_name')
                                                            <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>Version Number</label>
                                                            <input type="text" name="version_number"
                                                                   value="{{ (old('version_number')) ? old('version_number'): (isset($update->version_number)?$update->version_number:'') }}"
                                                                   class="form-control">
                                                            @error('version_number')
                                                            <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>Issue Date</label>
                                                            <input type="date" name="document_issue_date"
                                                                   max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                   value="{{ (old('document_issue_date')) ? old('document_issue_date'): (isset($update->document_issue_date)?$update->document_issue_date:'') }}"
                                                                   class="form-control">
                                                            @error('document_issue_date')
                                                            <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>Department Owner</label>
                                                            <select class="form-control" name="department_owner">
                                                                <option selected disabled="true">In which Category
                                                                    did the Department
                                                                    belong
                                                                    to?
                                                                </option>
                                                                <option
                                                                        {{ old('department_owner') ? old('department_owner') : (isset($update->department_owner)?$update->department_owner:'') ==='Operation'?"selected":"" }}>
                                                                    Operation
                                                                </option>
                                                                <option
                                                                        {{ old('department_owner') ? old('department_owner') : (isset($update->department_owner)?$update->department_owner:'') ==='Corporate'?"selected":"" }}>
                                                                    Corporate
                                                                </option>
                                                                <option
                                                                        {{ old('department_owner') ? old('department_owner') : (isset($update->department_owner)?$update->department_owner:'') ==='Human Resources (HR)'?"selected":"" }}>
                                                                    Human Resources (HR)
                                                                </option>
                                                                <option
                                                                        {{ old('department_owner') ? old('department_owner') : (isset($update->department_owner)?$update->department_owner:'') ==='Finance'?"selected":"" }}>
                                                                    Finance
                                                                </option>
                                                                <option
                                                                        {{ old('department_owner') ? old('department_owner') : (isset($update->department_owner)?$update->department_owner:'') ==='Supply Chain'?"selected":"" }}>
                                                                    Supply Chain
                                                                </option>
                                                                <option
                                                                        {{ old('department_owner') ? old('department_owner') : (isset($update->department_owner)?$update->department_owner:'') ==='IT'?"selected":"" }}>
                                                                    IT
                                                                </option>
                                                                <option
                                                                        {{ old('department_owner') ? old('department_owner') : (isset($update->department_owner)?$update->department_owner:'') ==='QHSE & BC'?"selected":"" }}>
                                                                    QHSE & BC
                                                                </option>
                                                                <option
                                                                        {{ old('department_owner') ? old('department_owner') : (isset($update->department_owner)?$update->department_owner:'') ==='Clinical Governance'?"selected":"" }}>
                                                                    Clinical Governance
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>Document Type</label>
                                                            <select class="form-control" name="data_classification">
                                                                <option selected disabled="true">
                                                                    In which Category did the Document belong to?
                                                                </option>
                                                                <option
                                                                        {{ old('data_classification') ? old('data_classification') : (isset($update->data_classification)?$update->data_classification:'') ==='Policy'?"selected":"" }}>
                                                                    Policy
                                                                </option>
                                                                <option
                                                                        {{ old('data_classification') ? old('department_owner') : (isset($update->data_classification)?$update->data_classification:'') ==='Form'?"selected":"" }}>
                                                                    Form
                                                                </option>
                                                                <option
                                                                        {{ old('data_classification') ? old('data_classification') : (isset($update->data_classification)?$update->data_classification:'') ==='Workflow'?"selected":"" }}>
                                                                    Workflow
                                                                </option>
                                                                <option
                                                                        {{ old('data_classification') ? old('data_classification') : (isset($update->data_classification)?$update->data_classification:'') ==='Graphics'?"selected":"" }}>
                                                                    Graphics
                                                                </option>
                                                                <option
                                                                        {{ old('data_classification') ? old('data_classification') : (isset($update->data_classification)?$update->data_classification:'') ==='Position Description'?"selected":"" }}>
                                                                    Position Description
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <div class="custom-file">
                                                                <label for="exampleFormControlFile1">Upload Document
                                                                    File</label>
                                                                <input type="file" name="document_file"
                                                                       class="form-control-file file-size-limit"
                                                                       id="exampleFormControlFile1">
                                                                @error('document_file')
                                                                <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <div class="form-check form-check-flat">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input">
                                                                    I accept the Media Terms and Conditions <i
                                                                            class="input-helper"></i>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form_column">
                                                    <div class="row">
                                                        <div class="btn_column form-group col-md-12 mt-3">
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
                    </div>                
                </div>
            </div>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#myInput").on("keyup", function () {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("myTable");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[0];
                    td1 = tr[i].getElementsByTagName("td")[1];
                    if (td && td1) {
                        txtValue = td.textContent || td.innerText;
                        txtValue1 = td1.textContent || td1.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1 || txtValue1.toUpperCase().indexOf(
                            filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }

                }
            });
        });
        var createAllErrors = function () {
            var form = $(this),
                errorList = $("ul.errorMessages", form);

            var showAllErrorMessages = function () {
                errorList.empty();

                // Find all invalid fields within the form.
                var invalidFields = form.find(":invalid").each(function (index, node) {

                    // Find the field's corresponding label
                    var label = node.name,
                        // Opera incorrectly does not fill the validationMessage property.
                        message = node.validationMessage || 'Invalid value.';
                    // $(this).parent('div').append("<span class='text-danger'>" +  message + "</span>");

                    errorList
                        .show()
                        .append("<li><span>" + label + "</span> " + message + "</li>");
                });
            };

            // Support Safari
            form.on("submit", function (event) {
                if (this.checkValidity && !this.checkValidity()) {
                    $(this).find(":invalid").first().focus();
                    event.preventDefault();
                }
            });

            $("input[type=submit], button:not([type=button])", form)
                .on("click", showAllErrorMessages);

            $("input", form).on("keypress", function (event) {
                var type = $(this).attr("type");
                if (/date|email|month|number|search|tel|text|time|url|week/.test(type) &&
                    event.keyCode == 13) {
                    showAllErrorMessages();
                }
            });
        };

        $("form").each(createAllErrors);
    </script>
@endsection