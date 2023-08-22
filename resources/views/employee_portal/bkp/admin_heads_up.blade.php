@extends('layouts.employee_portal.master')

@push('plugin-styles')
@endpush

@section('content')
    <div class="row mt-4">
        <div class="col-md-12 d-flex align-items-center justify-content-between">
            <h1 class="h1_heading">The Head’s Up</h1>
            <div class="addProduct">
                <a id="addmediacontent" href="#"><i class="mdi mdi-plus-circle"></i>Add Your Media Content</a>
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-12">
            <div class="documentFilter">
                <form class="addProductForm" action="{{ route('employee-portal.heads-up.adminfilter') }}" method="post">
                    <div class="selectFilter">
                        {{ csrf_field() }}
                        <label class="filterTxt mr-2">Filter by:</label>
{{--                        <div class="filterBox">--}}
{{--                            <select name="filter" class="form-control">--}}
{{--                                <option value="eBooks"><b>My Stories</b></option>--}}
{{--                                <optgroup label="Status">--}}
{{--                                    <option value="all-status" selected="true">Select Category</option>--}}
{{--                                    <option value="approved-status"--}}
{{--                                            {{ ( isset($filter )&& $filter['filter'] ==='approved-status')?"selected":"" }}>--}}
{{--                                        Approved--}}
{{--                                    </option>--}}
{{--                                    <option value="pending-status"--}}
{{--                                            {{ ( isset($filter )&& $filter['filter'] ==='pending-status')?"selected":"" }}>--}}
{{--                                        Pending--}}
{{--                                    </option>--}}
{{--                                </optgroup>--}}

{{--                                <optgroup label="Media Type">--}}
{{--                                    <option value="all-media_type"--}}
{{--                                            {{ ( isset($filter )&& $filter['filter'] ==='all-media_type')?"selected":"" }}>--}}
{{--                                        All--}}
{{--                                    </option>--}}
{{--                                    <option value="image-media_type"--}}
{{--                                            {{ ( isset($filter )&& $filter['filter'] ==='image-media_type')?"selected":"" }}>--}}
{{--                                        Photo--}}
{{--                                    </option>--}}
{{--                                    <option value="video-media_type"--}}
{{--                                            {{ ( isset($filter )&& $filter['filter'] ==='video-media_type')?"selected":"" }}>--}}
{{--                                        Video--}}
{{--                                    </option>--}}
{{--                                </optgroup>--}}
{{--                            </select>--}}
{{--                        </div>--}}
                        <div class="filterBox">
                            <input type="text" autocomplete="off" id="myInput" name="search" class="form-control"
                                   placeholder="Search By Keyword">
                        </div>
                        <div class="filterBox">
                            <select name="year" class="form-control" autocomplete="off">
                                <option value="">Year</option>
                                <?php  $currentYear = date('Y');
                                foreach (range(2010, $currentYear) as $value) {?>
                                <option value="<?php echo $value?>"
                                        {{ ( isset($filter )&& $filter['year'] == $value)?"selected":"" }}>
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
                                        {{ ( isset($filter )&& $filter['month'] == $value)?"selected":"" }}>
                                    <?php echo $label?></option>

                                <?php }?>
                            </select>
                        </div>
                        <div class="DT_Reset">
                            <button class="btn btn-primary navyblueBtn" type="submit">Filter</button>
                        </div>
                        <div class="filterBox">
                            <select name="sort" class="form-control">

                                <option value="latest" selected="true">Newest</option>
                                <option value="Sale"
                                        {{ ( isset($filter )&& $filter['sort'] ==='Sale')?"selected":"" }}>
                                    Oldest
                                </option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row grid-margin mt-4 headWrapper">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body d-flex flex-wrap" id="myTable">
                    <h3><i class="mdi mdi-lead-pencil"></i>Gallery</h3>
                    @forelse ($data as $d)
                        <div class="col-xl-4 col-lg-4 tr">
                            <div class="headItem mb-4">

                                <a class="hoverEffect" href="#" target="_blank">

                                    <div class="mediaWrap">
                                        @if($d->media_type == 'image')
                                            <img class="imgHover" src="{{ url($d->file_url) }}">
                                        @else
                                            <iframe allowfullscreen="" frameborder="0"
                                                    src="{{ url($d->file_url) }}"></iframe>
                                        @endif
                                    </div>
                                    <h4 class="search">{{$d->title}}</h4><span>{{isset($d->from_)?$d->from_:''}}</span>

                                    <span class="date">
                                <!-- Feb 12, 2015 -->
                                {{ \Carbon\Carbon::parse($d->created_at)->diffForHumans() }}    / {{$d->view_count}} views
                            </span>
                                </a>
                            </div>
                            <div class="row">
                                <a href="{{route('employee-portal.heads-up.delete',['id'=>$d->id])}}" type="button"
                                   class="actionLink redBg">
                                    <span class="mdi mdi-delete"></span>
                                </a>
                                <a href="{{route('employee-portal.heads-up.update',['id'=>$d->id])}}" type="button"
                                   class="actionLink">
                                    <span class="mdi mdi-pencil-box-outline"></span>
                                </a>
                            </div>
                        </div>

                    @empty
                        <div class="container-fluid" colspan="4" style="text-align: center;">
                            <b>No Records in the repository</b>
                        </div>
                @endforelse
                <!-- <div class="col-xl-4 col-lg-4">
                    <div class="headItem mb-4">
                        <a class="hoverEffect" href="#" target="_blank">
                            <div class="mediaWrap">
                                <iframe allowfullscreen="" frameborder="0"
                                src="https://www.youtube.com/embed/9KE_i9h-WLU?modestbranding=1&showinfo=0&fs=0"></iframe>
                            </div>
                            <h4>Events' Ambulance Coverage</h4>
                            <span class="date">3 years ago / 2720 views</span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <div class="headItem mb-4">
                        <a class="hoverEffect" href="#" target="_blank">
                            <div class="mediaWrap">
                                <img class="imgHover"
                                src="http://na.bw.ae/national-ambulance/public/uploads/service/9534.jpg">
                            </div>
                            <h4>Events' Ambulance Coverage</h4>
                            <span class="date">Feb 12, 2015</span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <div class="headItem mb-4">
                        <a class="hoverEffect" href="#" target="_blank">
                            <div class="mediaWrap">
                                <img class="imgHover"
                                src="http://na.bw.ae/national-ambulance/public/uploads/service/9534.jpg">
                            </div>
                            <h4>Events' Ambulance Coverage</h4>
                            <span class="date">Feb 12, 2015</span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <div class="headItem mb-4">
                        <a class="hoverEffect" href="#" target="_blank">
                            <div class="mediaWrap">
                                <iframe allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen="" frameborder="0"
                                src="https://www.youtube.com/embed/9KE_i9h-WLU"
                                title="YouTube video player"></iframe>
                            </div>
                            <h4>Events' Ambulance Coverage</h4>
                            <span class="date">3 years ago / 2720 views</span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <div class="headItem mb-4">
                        <a class="hoverEffect" href="#" target="_blank">
                            <div class="mediaWrap">
                                <img class="imgHover"
                                src="http://na.bw.ae/national-ambulance/public/uploads/service/9534.jpg">
                            </div>
                            <h4>Events' Ambulance Coverage</h4>
                            <span class="date">Feb 12, 2015</span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <div class="headItem mb-4">
                        <a class="hoverEffect" href="#" target="_blank">
                            <div class="mediaWrap">
                                <iframe allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen="" frameborder="0"
                                src="https://www.youtube.com/embed/9KE_i9h-WLU"
                                title="YouTube video player"></iframe>
                            </div>
                            <h4>Events' Ambulance Coverage</h4>
                            <span class="date">3 years ago / 2720 views</span>
                        </a>
                    </div>
                </div> -->
                </div>
            </div>
        </div>
    </div>
    <div id="mediaContentForm" style="{{ isset($update)?'':'display:none;' }}">
        <div class="row mt-5">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3>Give a Head's Up !!!</h3>
                        <!-- <p>Do you have a story to tell or a photo to share? Have you witnessed or been part of a successful incident or event? Have you or your coworker done an extra ordinary job in saving a patient’s life or making a difference at work? Please share with us. Your story will be reviewed before it goes live and we will get in touch if we require more details.</p> -->
                        <form class="addProductForm" action="{{ route('employee-portal.heads-up.create') }}"
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
                                <!-- <div class="form-group col-md-6">
                                <label>Category</label>
                                <select class="form-control" name="category">
                                    <option selected disabled="true">In which Category did the story belong to?</option>
                                    <option {{ old('category') ? old('category') : (isset($update->category)?$update->category:'') ==='Operations'?"selected":"" }}>Operations</option>
                                    <option {{ old('category') ? old('category') : (isset($update->category)?$update->category:'') ==='Supporting Departments'?"selected":"" }}>Supporting Departments</option>
                                    <option {{ old('category') ? old('category') : (isset($update->category)?$update->category:'') ==='AUH Contracts'?"selected":"" }}>AUH Contracts</option>
                                </select>
                            </div> -->
                                </div>
                            <!--    <div class="row">
                                 <div class="form-group col-md-6">
                                    <label>Photo/Video Credits</label>
                                    <input type="text" 
                                    pattern="[A-Za-z ]{1,32}"
                                    title="no numeric values accepted for Photo Credits" 
                                    name="nationality"
                                    value="{{ old('city') }}" 
                                    class="form-control">
                                    @error('area_location')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    </div> -->
                            <!--  <div class="form-group col-md-6">
                                    <label> Credits</label>
                                    <input type="text" class="form-control">
                                    @error('area_location')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    </div>
                                </div>-->
                            <!-- <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Tell Us Your Story</label>
                                    <textarea class="form-control" row="3" name="story" required>{{ (old('story')) ? old('story'): (isset($update->story)?$update->story:'') }}</textarea>
                                    @error('story')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="fromInput">From</label>
                                        <input type="text" pattern="[A-Za-z ]{1,32}" id="fromInput"
                                               value="{{ (old('from_')) ? old('from_'): (isset($update->from_)?$update->from_:'') }}"
                                               name="from_" class="form-control" required>
                                        @error('from_')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="custom-file">
                                            <label for="exampleFormControlFile1">Upload Photo/Video</label>
                                            <input type="file" name="file" class="form-control-file"
                                                   id="exampleFormControlFile1">
                                            @error('file')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                <!-- <div class="form-group col-md-6">
                                    <label>Photo/Video Credits</label>
                                    <input type="text" 
                                    pattern="[A-Za-z ]{1,32}"
                                    title="no numeric values accepted for Photo Credits" 
                                    name="file_credits"
                                    value="{{ (old('file_credits')) ? old('file_credits'): (isset($update->file_credits)?$update->file_credits:'') }}" 
                                    class="form-control">
                                    @error('file_credits')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                        </div> -->
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                    <!-- <div class="form-check form-check-flat">
                                        <label class="form-check-label">
                                            <input type="checkbox" 
                                            name="dont_publish_name_status" 
                                            class="form-check-input" {{ old('dont_publish_name_status') ? old('dont_publish_name_status') : (isset($update->dont_publish_name_status)?$update->dont_publish_name_status: '') ==='1'?"checked":"" }}> 
                                            Please don’t publish my name <i class="input-helper"></i>
                                        </label>
                                    </div> -->
                                        <div class="form-check form-check-flat">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input">
                                                I accept the Media Terms and Conditions <i class="input-helper"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form_column">
                                <div class="row">
                                    <div class="btn_column form-group col-md-12 mt-3">
                                        <button type="submit" class="default_btn">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


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

@push('plugin-scripts')
@endpush

@push('custom-scripts')
@endpush