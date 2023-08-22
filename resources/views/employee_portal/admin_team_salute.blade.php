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

<link rel="stylesheet" href="{{asset('public/employee_portal/css/animate.min.css')}}">
<!-- end common css -->
@stack('plugin-styles')
@endsection
@section('content')
<section class="wrapper admin_marketplace">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                {{--        <div class="col-md-12">--}}
                    {{--            <h1 class="h1_heading">Admin market place for verification</h1>--}}
                {{--        </div>--}}
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6 mt-4">
                                <h1 class="m-0 text-dark">Story List</h1>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <div class="content">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" autocomplete="off" id="myInput" name="search"
                                class="form-control"
                                placeholder="Search By Keyword">
                            </div>
                        </div>
                        {{--        <div class="col-lg-12">--}}
                            {{--            <div class="form-group">--}}
                                {{--                <label>Search:</label>--}}
                                {{--                <input type="text" id="myInput" class="form-control" placeholder="Search for a keyword"/>--}}
                            {{--            </div>--}}
                        {{--        </div>--}}

                        {{--        <div class="col-lg-12 grid-margin">--}}
                            <div class="row grid-margin mt-4">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
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
                                            <div class="table-responsive">
                                                <table class="table table-striped adminTable">
                                                    <thead>
                                                        <tr>
                                                        <th>Category</th>
                                                            <th>To</th>
                                                            <th>From</th>
                                                            <th>Date</th>
                                                            <th>For</th>
                                                            <th>Created By</th>   <!--file_url & file_credits & -->
                                                            
                                                            <th>Created at</th>
                                                            <th>Operations</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="myTable">
                                                        @forelse($data as $d)
                                                        <tr>
                                                            <td>{{ $d->category }}</td>
                                                            <td >{{ $d->ts_to }}</td>
                                                          
                                                            <td>{{ $d->ts_from }}</td>
                                                            <td>{{ $d->ts_date }}</td>
                                                            <td>{{ $d->ts_for }}</td>
                                                            <td>{{ $d->getUserFullName() }}</td>
                                                            <td>{{ $d->created_at }}</td>
                                                        
                                                      
                                                       <td class="actionbtn">
                                                       @php
                                                        $tempDelUrl=route('employee-portal.team-salute.admin.delete',['id'=>$d->id]);
                                                        @endphp
                                                       <a class="reject"
                                                            url="{{ $tempDelUrl }}"
                                                            type="button" onclick="confirmDelete('{{$tempDelUrl}}','')">
                                                                <span class="mdi mdi-close-box-outline">Delete</span>
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
                                {{$data->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
        </div>
    </div>
</section>
</div>
</div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
      function confirmDelete(url,title){
                          return  swal({
                        title: "Are you sure?",
                        text: "Are you sure you want to delete team salute record?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                        })
                        .then((willDelete) => {
                        if (willDelete) {
                            window.location.href=url;
                        } else {
                            return false;
                        }
                        });
                        
            }
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