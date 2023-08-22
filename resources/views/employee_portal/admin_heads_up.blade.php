@extends('layouts.master')
@php
    use app\Http\helper\Helper as Helper;
    $services = Helper::all_services();
@endphp
@section('header-ss')
    <!-- plugin css -->
    <link rel="stylesheet" href="{{asset('public/employee_portal/assets/plugins/@mdi/font/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/employee_portal/assets/plugins/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/start/jquery-ui.css" type="text/css" media="all" />

    <!-- Font Awsome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- common css -->
  
  <link rel="stylesheet" href="{{asset('public/employee_portal/css/animate.min.css')}}">
  <!-- end common css -->
  @stack('plugin-styles')
@endsection
@section('content')
    <section class="wrapper">
        
<div class="card mt-4">
                <div class="card-body headsUp_block">

                    @if(isset($heads_up_today) && isset($heads_up_today[0]))
                        <div class="headsUp_image">
                        <img class="imgHover"
                                 src="{{ asset('public/employee_portal/images/headsup-icon.jpg') }}">
                            <p class="mb-0 text-left text-md-center text-xl-left">
                                <a href="{{route('employee-portal.heads-up.view')}}" class="text-muted">
                                    <i class="mdi mdi-refresh mr-1" aria-hidden="true"></i> View All
                                </a>
                            </p>
                               
                            <p class="mb-0 text-left text-md-center text-xl-left">
                                <!-- <a href="{{route('employee-portal.heads-up.view')}}" class="text-muted">
                                    <i class="mdi mdi-refresh mr-1" aria-hidden="true"></i> View All
                                </a> -->
                            </p>
                        </div>
                        <div class="headsUp_text blur tet">
                            <ul class="headsUp_slider">
                                @foreach($heads_up_today as $headsUp)
                                     <li><h3>{{$headsUp->title}}</h3></li>
                                @endforeach
                             
                            </ul>                            
                            <!-- <h3>The Head's Up<br>+ Announcements</h3> -->
                        </div>
                    @else
                        <div class="headsUp_image">
                            <img class="imgHover"
                                 src="{{ asset('public/employee_portal/images/headsup-icon.jpg') }}">
                            <p class="mb-0 text-left text-md-center text-xl-left">
                                <!-- <a href="{{route('employee-portal.heads-up.view')}}" class="text-muted">
                                    <i class="mdi mdi-refresh mr-1" aria-hidden="true"></i> View All
                                </a> -->
                            </p>
                        </div>
                        <div class="headsUp_text blur">
                            <ul class="headsUp_slider">
                                <li><a href="{{route('employee-portal.heads-up.view')}}">The Head's Up<br>+ Announcements</a></h3></li>
                                <li><a href="{{route('employee-portal.heads-up.view')}}">The Head's Up<br>+ Announcements</a></li>
                                <li><a href="{{route('employee-portal.heads-up.view')}}">The Head's Up<br>+ Announcements</a></li>
                                <li><a href="{{route('employee-portal.heads-up.view')}}">The Head's Up<br>+ Announcements</a></li>
                                <li><a href="{{route('employee-portal.heads-up.view')}}">The Head's Up<br>+ Announcements</a></li>
                                <li><a href="{{route('employee-portal.heads-up.view')}}">The Head's Up<br>+ Announcements</a></li> 
                            </ul>                            
                            <!-- <h3>The Head's Up<br>+ Announcements</h3> -->
                        </div>   
                    @endif
                </div>
            <!-- <a href="{{route('employee-portal.heads-up.view')}}" class="text-center" style="color: black">View all Head's Up
                    contents</a> -->
            </div>
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6 mt-4">
                                    <h1 class="m-0 text-dark">The Head’s Up</h1>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    
                    <div class="content">

                        <div class="container-fluid">
                          
                            <form class="addProductForm" action=""
                                  method="get">
                                <div class="selectFilter">
                                    <label class="filterTxt mr-2">Filter by:</label>
                                    <div class="filterBox">
                                        <input type="text" autocomplete="off" id="myInput" name="search"
                                               class="form-control"
                                               placeholder="Search By Keyword" value="{{ Request::get('search')}}">
                                    </div>
                                    <div class="filterBox">
                                        <select name="year" class="form-control" autocomplete="off">
                                            <option value="">Year</option>
                                            <?php  $currentYear = date('Y');
                                            foreach (range(2010, $currentYear) as $value) {?>
                                            <option value="<?php echo $value?>"
                                                    {{ ( Request::get('year') == $value)?"selected":"" }}>
                                                <?php echo $value?></option>

                                            <?php }      ?>
                                        </select>
                                    </div>
                                    <div class="filterBox">
                                        <select name="month" class="form-control" autocomplete="off">
                                            <option value="">Month</option>
                                            <?php
                                            for ($i = 0; $i < 12; $i++) {
                                            $time = strtotime(sprintf('%d months', $i));
                                            $label = date('F', $time);
                                            $value = date('n', $time);?>

                                            <option value='<?php echo $value?>'
                                                    {{ ( Request::get('month') == $value)?"selected":"" }}>
                                                <?php echo $label?></option>

                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="DT_Reset mr-4">
                                        <button class="btn btn-primary navyblueBtn" type="submit">Filter</button>
                                    </div>
                                    <div class="filterBox">
                                        <select name="sort" class="form-control">

                                            <option value="latest" selected="true">Newest</option>
                                            <option value="Sale"
                                                    {{ ( Request::get('sort') =='Sale')?"selected":"" }}>
                                                Oldest
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <div class="col-md-12 mt-4 mb-3 text-right">
                                {{--                                <a href="#storyForm" class="btn btn-primary " style="margin-bottom:5px;"--}}
                                {{--                                   onclick="(function(){$('#storyForm').show()})()">--}}
                                {{--                                    Add The Media Content--}}
                                {{--                                </a>--}}
                                <a href="#mediaContentForm" class="btn btn-primary " style="margin-bottom:5px;"
                                   onclick="(function(){$('#mediaContentForm').show()})()">
                                    Add The Media Content
                                </a>
                            </div>
                            {{--                </div>--}}
                            {{--            </div>--}}
                            {{--        </div>--}}
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

                            <div class="row grid-margin mt-4 headWrapper">
                                <!-- <h3><i class="mdi mdi-lead-pencil"></i>Gallery</h3> -->
                                @forelse ($data as $d)
                                    <div class="col-xl-4 col-lg-4 tr">
                                        <div class="headItem mb-4">
                                            <a class="hoverEffect" href="#" target="_blank">

                                                <div class="mediaWrap">
                                                <?php
                                    $files=explode(',',$d->file_url);
                                    if($d->file_url&&count($files)>0){
                                        foreach ($files as $file) {
                                            // dd(explode("-",explode("heads_up/",$file)[1])[0]);
                                            
                                          ?>
                                          
                                            @if(explode("-",explode("heads_up/",$file)[1])[0] == 'video')
                                            <iframe allowfullscreen="" frameborder="0" src="{{ url($file) }}"></iframe>
                                            <video width="320" height="240" controls>
                                                <source src="{{  url($file) }}" type="video/mp4">
                                                 Your browser does not support the video tag.
                                            </video>
                                            @else
                                                <img class="imgHover" src="{{  url($file) }}">
                                            @endif
                                           
                                          <?php
                                        }
                                    }
                                ?>
                                                </div>
                                                <h4 class="search">{{$d->title}}</h4>
                                                <p>{{$d->description}}</p>
                                                <span class="desg_name">{{isset($d->from_)?$d->from_:''}}</span>
                                                <span class="date">{{ \Carbon\Carbon::parse($d->created_at)->diffForHumans() }}    / {{$d->view_count}} views</span>
                                            </a>
                                            <div class="actionBtn">
                                                <a href="{{route('employee-portal.heads-up.delete',['id'=>$d->id])}}"
                                                   type="button"
                                                   class="actionLink redBg">
                                                    <span class="mdi mdi-delete"></span>
                                                </a>
                                                <a href="{{route('employee-portal.heads-up.update',['id'=>$d->id])}}"
                                                   type="button"
                                                   class="actionLink">
                                                    <span class="mdi mdi-pencil-box-outline"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="container-fluid" colspan="4" style="text-align: center;">
                                        <b>No Records in the repository</b>
                                    </div>
                                @endforelse
                            </div>
                            {{ $data->links() }}
                            <br/>
                            <div id="mediaContentForm" style="{{ isset($update)?'':'display:none;' }}">
                                <div class="row mt-5">
                                    <div class="col-md-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <h3>Give a Head's Up !!!</h3>
                                                <form class="addProductForm"
                                                      action="{{ route('employee-portal.heads-up.create') }}"
                                                      method="post" enctype="multipart/form-data">
                                                    {{ csrf_field() }}

                                                    <input type="hidden"
                                                           name="id"
                                                           value="{{ old('id') ? old('id'): ( isset($update->id) ? $update->id : '') }}"
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
                                                        <h5>Add Your Media Content</h5>
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label>Title</label>
                                                                <input type="text"
                                                                       name="title"
                                                                       value="{{ (old('title')) ? old('title'): (isset($update->title)?$update->title:'') }}"
                                                                       class="form-control">
                                                                @error('title')
                                                                <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="fromInput">From</label>
                                                                <input type="text" id="fromInput"
                                                                       value="{{ (old('from_')) ? old('from_'): (isset($update->from_)?$update->from_:'') }}"
                                                                       name="from_" class="form-control" required>
                                                                @error('from_')
                                                                <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label>Description</label>
                                                                <textarea type="text"
                                                                       name="description"
                                                                       value=""
                                                                       class="form-control">{{ (old('description')) ? old('description'): (isset($update->description)?$update->description:'') }}</textarea>
                                                                       @error('description')
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                       @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row">                                                        
                                                            <div class="form-group col-md-6">
                                                                <div class="custom-file">
                                                                    <label for="exampleFormControlFile1">Upload
                                                                        Photo/Video</label>
                                                                    <input type="file" name="file[]"
                                                                           class="form-control-file file-size-limit form-control" multiple
                                                                           id="exampleFormControlFile1">
                                                                    @error('file')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-12 mt-3">
                                                                <div class="form-check form-check-flat" style="padding-left:2rem;">
                                                                    <label class="form-check-label"> 
                                                                        <input type="checkbox" class="form-check-input" style="margin-left: -18px;margin-top: 3px;">I accept the Media Terms and Conditions<i class="input-helper"></i>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form_column">
                                                        <div class="row">
                                                            <div class="btn_column form-group mt-3">
                                                                <div class="col-md-12">
                                                                    <a href="{{ url()->previous()}}"  class="btn btn-primary"> Back</a>
                                                                    <a href=""  class="btn grey_bgbtn px-3"> Cancel</a>
                                                                </div>
                                                                <div class="col-md-12 mt-3">
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                                </div>
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
                </section>
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
                tr = table.getElementsByClassName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByClassName("search")[0];
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