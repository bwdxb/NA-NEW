@extends('layouts.employee_portal.master')

@push('plugin-styles')
@endpush

@section('content')
<div class="row mt-4">
    <div class="col-md-12 d-flex align-items-center justify-content-between">
        <h1 class="h1_heading">The Head’s Up</h1>
        <!-- <div class="addProduct">
            <a id="addmediacontent" href="#"><i class="mdi mdi-plus-circle"></i>Add Your Media Content</a>
        </div> -->
    </div>
</div>
<div class="card mt-4">
                <div class="card-body headsUp_block singleHeadsUp">

                    @if(isset($heads_up_today) && isset($heads_up_today[0]))
                        <div class="headsUp_image m-auto">             
                               
                        <img class="imgHover"
                                 src="{{ asset('public/employee_portal/images/headsup-icon.jpg') }}">
                            <p class="mb-0 text-left text-md-center text-xl-left">
                                <!-- <a href="{{route('employee-portal.heads-up.view')}}" class="text-muted">
                                    <i class="mdi mdi-refresh mr-1" aria-hidden="true"></i> View All
                                </a> -->
                            </p>
                        </div>
                        <!-- <div class="headsUp_text m-auto">                  
                            <div class="headsUp_slider">
                                <marquee class="text-center" onmouseover="stop()" onmouseout="start()" direction="up" scrolldelay="200"> 
                                    @foreach($heads_up_today as $headsUp)
                                        <a href="{{route('employee-portal.heads-up.view')}}">{{$headsUp->title}}</a>
                                    @endforeach
                                </marquee>
                            </div>           
                            <h3>The Head's Up<br>+ Announcements</h3>
                        </div> -->
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
                        <!-- <div class="headsUp_text blur">
                            <div class="headsUp_slider">
                                <marquee onmouseover="stop()" onmouseout="start()" direction="up" scrolldelay="200"> 
                                        <h3><a href="{{route('employee-portal.heads-up.view')}}">The Head's Up<br>+ Announcements</a></h3>
                                        <h3><a href="{{route('employee-portal.heads-up.view')}}">The Head's Up<br>+ Announcements</a></h3>
                                        <h3><a href="{{route('employee-portal.heads-up.view')}}">The Head's Up<br>+ Announcements</a></h3>
                                        <h3><a href="{{route('employee-portal.heads-up.view')}}">The Head's Up<br>+ Announcements</a></h3>
                                        <h3><a href="{{route('employee-portal.heads-up.view')}}">The Head's Up<br>+ Announcements</a></h3>
                                        <h3><a href="{{route('employee-portal.heads-up.view')}}">The Head's Up<br>+ Announcements</a></h3>
                                </marquee>                              
                            </div>                            
                            <h3>The Head's Up<br>+ Announcements</h3>
                        </div>    -->
                    @endif
                </div>
            <!-- <a href="{{route('employee-portal.heads-up.view')}}" class="text-center" style="color: black">View all Head's Up
                    contents</a> -->
            </div>
<div class="row mb-2">
    <div class="col-md-12">
        <div class="documentFilter">
            <form class="addProductForm" action="" method="get">
                <div class="selectFilter">
                    <label class="filterTxt mr-2">Filter by:</label>
                    <div class="filterBox">
                        <input type="text" autocomplete="off" id="" name="search"
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
                    <a type="reset" href="http://na.bw.ae/employee-portal/heads-up" class="btn btn-primary navyblueBtn"><i onclick="(function(){$('form').clear()})" class="mdi mdi-redo-variant"></i> Reset</a>
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
        </div>
    </div>
</div>

<div class="row grid-margin mt-4 headWrapper">
    
    <div class=" d-flex flex-wrap"  id="myTable">
        <!-- <h3>Management</h3>                 -->
        @forelse ($data as $d)
        <div class="col-sm-6 col-lg-4 tr">
              <div class="card mb-4">
                  <div class="card-body">
                    <div class="headItem mb-4" >                        
                    <!-- <a class="hoverEffect" href="#" target="_blank"> -->
                        <div class="hoverEffect" data-toggle="modal" data-target="#exampleModal{{$d->id}}">
                            
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
                        <div class="Description px-0">
                            <h4><a id="readmore-{{ $d->id }}" href="#" value="{{ $d->id }}" onclick="updateCount('view_count', '{{$d->id}}')">{{$d->title}}</a></h4>
                            <p class="headsContent headmore">{{$d->description}}</p>
                            <span>{{isset($d->from_)?$d->from_:''}}</span>
                            
                            <span class="date">
                                <!-- Feb 12, 2015 -->
                                {{ \Carbon\Carbon::parse($d->created_at)->diffForHumans() }}    / <span id="view_count{{$d->id}}">{{$d->view_count}}</span> views
                            </span>
                        </div>
                    </div>
                </div>
                  </div>
              </div>          
            <!-- <div class="row">
                <a href="{{route('employee-portal.heads-up.delete',['id'=>$d->id])}}" type="button" class="actionLink redBg">
                    <span class="mdi mdi-delete"></span>
                </a>
                <a href="{{route('employee-portal.heads-up.update',['id'=>$d->id])}}" type="button" class="actionLink">
                    <span class="mdi mdi-pencil-box-outline"></span>
                </a>
            </div> -->
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel{{$d->id}}">{{$d->title}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="modalImage">
                            <div class="imageSlider">
                                <?php
                                $files=explode(',',$d->file_url);
                                if($d->file_url&&count($files)>0){
                                    foreach ($files as $file) {
                                        // dd(explode("-",explode("heads_up/",$file)[1])[0]);
                                        ?>
                                        <div>
                                        @if(explode("-",explode("heads_up/",$file)[1])[0] == 'video')
                                        <iframe allowfullscreen="" frameborder="0" src="{{ url($file) }}"></iframe>
                                        <!-- <video width="320" height="240" controls>
                                            <source src="{{  url($file) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video> -->
                                        @else
                                        <img class="imgHover" src="{{  url($file) }}">
                                        @endif
                                    </div>
                                        <?php
                                    }
                                }
                                ?>
                             </div>
                    </div>
                    <h4><a id="readmore-{{ $d->id }}" href="#" value="{{ $d->id }}" onclick="updateCount('view_count', '{{$d->id}}')">{{$d->title}}</a></h4><p>{{$d->description}}</p><span>{{isset($d->from_)?$d->from_:''}}</span>
                    
                    <span class="date">
                        <!-- Feb 12, 2015 -->
                        {{ \Carbon\Carbon::parse($d->created_at)->diffForHumans() }}    / <span id="view_count{{$d->id}}">{{$d->view_count}}</span> views
                    </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn navyblueBtn text-white" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@empty

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
                src="{{env('APP_URL')}}public/uploads/service/9534.jpg">
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
                src="{{env('APP_URL')}}public/uploads/service/9534.jpg">
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
                src="{{env('APP_URL')}}public/uploads/service/9534.jpg">
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



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script>

    function updateCount(attr, hearsUpId) {

            $.ajax({
                url: "{{env('APP_URL')}}employee-portal/heads-up/view_count-update-" + hearsUpId,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    if (response.response_code == 200) {
                        $("#view_count" + hearsUpId).text(response.data)
                    }
                },
                error: function (response) {
                    console.log(response)
                }
            });
        }

 $(document).ready(function () {
    const queryString = window.location.search;
        // console.log(queryString);
        const urlParams = new URLSearchParams(queryString);
        const type = urlParams.get('id')
        // console.log(type);
        if (type) {
            console.log(type);
            $('#exampleModal'+type).modal('show')
        }
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