@extends('layouts.employee_portal.master')
@php
use app\Http\helper\Helper as Helper;
$story_category = Helper::getStoryCategory();
$storyYears = Helper::getStoryYears();

@endphp
@push('plugin-styles')

@endpush

@section('content')


<div class="row mt-4">
    <div class="col-md-12 d-flex align-items-center justify-content-between">
        <h1 class="h1_heading">Stories<i class="heading_icon"><img src="{{ url('public/employee_portal/images/stories-icon.png') }}"></i></h1>
        <div class="addProduct">
            <a id="addstory" href="#"><i class="mdi mdi-plus-circle"></i>Add Your Story</a>
        </div>
    </div>
</div>
<div class="row mb-4">
    <div class="col-md-12">
        <div class="documentFilter">
            <form class="addProductForm" action="" method="get">
                <div class="selectFilter">
                    <label class="filterTxt mr-2">Filter by:</label>
                    <div class="filterBox">
                        <select name="filter" class="form-control">
                            <option value="all" {{ ( Request::get('filter')=='all')?"selected":"" }}>
                                <b>Story Board</b>
                            </option>
                            <optgroup label="My Stories">
                                <option value="all-status" selected="true">All</option>
                                <option value="approved-status" {{ ( Request::get('filter') =='approved-status')?"selected":"" }}>
                                    Approved
                                </option>
                                <option value="pending-status" {{ ( Request::get('filter') =='pending-status')?"selected":"" }}>
                                    Pending
                                </option>
                            </optgroup>

                            <optgroup label="Media Type">
                                <option value="all-media_type" {{ ( Request::get('filter') =='all-media_type')?"selected":"" }}>
                                    All
                                </option>
                                <option value="image-media_type" {{ ( Request::get('filter') =='image-media_type')?"selected":"" }}>
                                    Photo
                                </option>
                                <option value="video-media_type" {{ ( Request::get('filter') =='video-media_type')?"selected":"" }}>
                                    Video
                                </option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="filterBox">
                        <input type="text" autocomplete="off" id="" name="search" class="form-control" placeholder="Search By Keyword" value="{{Request::get('search')}}">
                    </div>
                    <div class="filterBox">
                        <select name="year" class="form-control" autocomplete="off">
                            <option value="">Year</option>
                            <?php $currentYear = date('Y');
                            foreach ($storyYears as $value => $key) { ?>
                                <option value="<?php echo $value ?>" {{ ( Request::get('year') == $value)?"selected":"" }}>
                                    <?php echo $value ?></option>

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
                                $value = date('n', $time); ?>

                                <option value='<?php echo $value ?>' {{ ( Request::get('month') == $value)?"selected":"" }}>
                                    <?php echo $label ?></option>

                            <?php } ?>
                        </select>
                    </div>
                    <div class="DT_Reset">
                        <button class="btn btn-primary navyblueBtn" type="submit">Filter</button>
                    </div>
                    <div class="filterBox">
                        <select name="sort" class="form-control">

                            <option value="latest" selected="true">Newest</option>
                            <option value="Sale" {{ ( Request::get('sort') ==='Sale')?"selected":"" }}>
                                Oldest
                            </option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row grid-margin mt-4 storyWrapper" id="myTable">
    @forelse($data as $d)
    <div class="col-md-6 col-lg-4 tr">
        <div class="storyItem mb-4">
            <div class="hoverEffect">
                <div class="storyImage">
                    @if($d->media_type == 'image')
                    <img class="imgHover" src="{{ url($d->file_url) }}">
                    @else
                    <!-- <video playsinline muted
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen="" frameborder="0" src="{{ url($d->file_url) }}"
                                        controlsList="nodownload" autoplay="off" muted title="video player">
                                        <source src="{{ url($d->file_url) }}" type="video/mp4">
                                    </video> -->
                    <iframe allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture;" allowfullscreen="" frameborder="0" src="{{ url($d->file_url) }}" controlsList="nodownload" autoplay="off" muted title="video player"></iframe>
                    @endif
                </div>

                <div class="Description">
                    <div class="storyCredit">
                        <span class="search">{{ $d->category }}</span>
                        <div class="like_action">
                            <i style="cursor:pointer;" onclick="updateCount('like_count', '{{$d->id}}')" title="Like Story" class="fa fa-thumbs-up" id="like_count{{$d->id}}">{{$d->like_count}}</i>
                            <!-- <i class="fa fa-thumbs-down" id="dislike_count{{$d->id}}">{{$d->dislike_count}}</i> -->
                            <i style="cursor:pointer;" onclick="updateCount('view_count','{{$d->id}}')" title="Story Views" class="fa fa-eye" id="view_count{{$d->id}}">{{$d->view_count}}</i>
                        </div>
                    </div>

                    @if($d->created_by == auth()->id())
                    @php
                    $tempDelUrl= route('employee-portal.story.delete',['id'=>$d->id]);
                    @endphp
                    <div class="row actionBtn" style="bottom:247px">
                        <a url="{{ route('employee-portal.story.delete',['id'=>$d->id]) }}" title="Delete Story" onclick="confirmDelete('{{$tempDelUrl}}','')" type="button" class="actionLink redBg">
                            <span class="mdi mdi-delete"></span>
                        </a>
                        <a href="{{ route('employee-portal.story.update',['id'=>$d->id]) }}" title="Update Story" type="button" class="actionLink">
                            <span class="mdi mdi-pencil-box-outline"></span>
                        </a>
                    </div>
                    @else
                    <div class="row actionBtn" style="bottom:247px">
                        <!-- <a onclick="updateCount('like_count', '{{$d->id}}')"
                                        title="Like Story" 
                                       type="button" class="actionLink">
                                        <span class="mdi mdi-pencil-box-outline"></span>
                                    </a>
                                    <a onclick="updateCount('dislike_count', '{{$d->id}}')"
                                        title="DisLike Story" 
                                       type="button" class="actionLink redBg">
                                        <span class="mdi mdi-delete"></span>
                                    </a> -->
                        {{-- <a type="button" onclick="updateCount('like_count', '{{$d->id}}')">--}}
                        {{-- --}}{{-- <span class="mdi mdi-delete"></span>--}}
                        {{-- <i class="fas fa-thumbs-up"></i>--}}
                        {{-- </a>--}}
                        {{-- <a type="button" onclick="updateCount('dislike_count', '{{$d->id}}')">--}}
                        {{-- --}}{{-- <span class="mdi mdi-pencil-box-outline"></span>--}}
                        {{-- <i class="fas fa-thumbs-down"></i>--}}
                        {{-- </a>--}}
                    </div>
                    @endif
                    <h4 class="storyTitle mt-3 w-100">{{ $d->title }}</h4>
                    <p class="story_content search  story-desc w-100 more" val="{{ $d->id }}" id="story-desc-{{ $d->id }}">
                        {{ $d->story }}
                    </p>
                    @if(Auth::id()==$d->created_by)
                    <span>Status :<span class="{{$d->status!='accepted'?'text-danger':'text-success'}}"> {{ $d->status }}</span></span>

                    @endif
                    <div class="storyfooter">
                        <div class="storyAuthor">
                            <span class="authorName">
                                @if(!$d->dont_publish_name_status && $d->getUserFullName() !== '')
                                @if($d->getUserInfo()&&$d->getUserInfo()->gst_no==1)

                                <font>Posted by </font><del>{{$d->getUserFullName()}}</del>
                                @else

                                <font>Posted by </font>{{$d->getUserFullName()}}
                                @endif
                                @endif
                            </span>

                            <span class="poostDate">{{ \Carbon\Carbon::parse($d->created_at)->diffForHumans() }}</span>
                        </div>

                        @if(!$d->dont_publish_name_status && $d->getUserFullName() !== '')
                        <div class="photoCredit">
                            <!-- @if($d->media_type == 'image')
                                        Photo
                                    @else
                                        Video
                                    @endif
                                    Credits -->
                            <span class=" {{$d->getUserInfo()->gst_no==1?'search text-muted':'search'}}">&copy;{{ $d->file_credits }}</span>
                        </div>
                        @endif
                       


                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty

    @endforelse
    {{ $data->links() }}
</div>
<!-- <div id="storyForm" style="{{ isset($update)?'':'display:none;' }}"> -->
<div id="storyForm">
    <div class="row mt-5">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h3>Tell Us Your Story</h3>
                    <p>Do you have a story to tell or a photo to share? Have you witnessed or been part of a
                        successful
                        incident or event? Have you or your coworker done an extra ordinary job in saving a
                        patient’s
                        life or making a difference at work? Please share with us. Your story will be reviewed
                        before it
                        goes live and we will get in touch if we require more details.</p>
                    <form id="form2" class="addProductForm" action="{{ route('employee-portal.story.create') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <input type="hidden" name="id" value="{{ old('id') ? old('id'): ( isset($update->id) ? $update->id : '') }}" class="form-control">


                        @if(session('success'))
                        <p class="text-success">
                            {{ session('success') }}<br />
                        </p>
                        @endif
                        @if(session('error'))                        
                        <p class="text-danger">
                            {{ session('error') }}
                        </p>
                        @endif                        

                        <p id="story-op-status"></p>
                        <ul class="errorMessages text-danger" style="list-style:unset;background-color: bisque;"></ul>

                        <h5>Add Your Story</h5>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Title</label>
                                <input type="text" name="title" value="{{ (old('title')) ? old('title'): (isset($update->title)?$update->title:'') }}" class="form-control">
                                @error('title')                                
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Category</label>
                                <select class="form-control" name="category">
                                    <option selected disabled="true">Where does the story come from?</option>
                                    @foreach($story_category as $storyCat)
                                    <option value="{{$storyCat->category}}" {{ old('category') ? old('category') : ((isset($update->category)?$update->category:'') ===$storyCat->category?"selected":"") }}>
                                        {{$storyCat->category}}
                                    </option>

                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>
                        <!--   <div class="form-group col-md-6">
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
                        <input type="hidden" name="id" value="{{ (old('id')) ? old('id'): (isset($update->id)?$update->id:'') }}">
                        <div class="form_column">
                            <!-- <div class="row">
                              <div class="form-group col-md-6">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="title" required value="{{ (old('title')) ? old('title'): (isset($update->title)?$update->title:'') }}">
                                    @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    </div>
                                </div> -->
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Tell Us Your Story</label>
                                    <textarea class="form-control" row="3" name="story" required>{{ (old('story')) ? old('story'): (isset($update->story)?$update->story:'') }}</textarea>
                                    @error('story')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="custom-file">
                                        <label for="exampleFormControlFile1">Upload Photo/Video</label>
                                        <input type="file" name="file" class="form-control-file file-size-limit" id="exampleFormControlFile1">
                                        @error('file')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group col-md-6">
                                    <label>Photo/Video Credits</label>
                                    <input type="text" pattern="[A-Za-z ]{1,32}" title="no numeric values accepted for Photo Credits" name="file_credits" value="{{ (old('file_credits')) ? old('file_credits'): (isset($update->file_credits)?$update->file_credits:'') }}" class="form-control">
                                    @error('file_credits')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <div class="form-check form-check-flat">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="dont_publish_name_status" class="form-check-input" {{ old('dont_publish_name_status') ? old('dont_publish_name_status') : ((isset($update->dont_publish_name_status)?$update->dont_publish_name_status: '') =='1'?"checked":"") }}>
                                            Please don’t publish my name <i class="input-helper"></i>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-flat">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="accept_terms" class="form-check-input" id="accept-terms" />
                                            I agree to the  
                                            <i class="input-helper"></i><a href="/employee-portal/terms-and-conditions" target="_blank">Terms and Conditions.</a>
                                        </label>
                                    </div>
                                            @error('accept_terms')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form_column">
                            <div class="row">
                                <div class="btn_column form-group col-md-12 mt-3">
                                    <button type="submit" class="default_btn">Submit</button>
                                    <button type="button" id="close-form" class="default_btn">Cancel</button>
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
    $().ready(() => {
        $('#close-form').click(function() {
            //$('#storyForm').toggle('slow');
            $('#form2')[0].reset();
            $('html, body').animate({
                scrollTop: 0
            }, 1000);
        });
    });

    function confirmDelete(url, title) {
        return swal({
                title: "Are you sure?",
                text: "Are you sure you want to delete your story?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = url;
                } else {
                    return false;
                }
            });

    }

    $(document).ready(function() {



        $(".readmore").click(function(e) {
            e.preventDefault();
            var id = $(this).attr('value');
            if ($('#story-desc-' + id).hasClass('text-truncate')) {
                $('#story-desc-' + id).removeClass('text-truncate');
                $(this).text('Read Less');
            } else {
                $('#story-desc-' + id).addClass('text-truncate');
                $(this).text('Read More');

            }
        });

        // // form.on("submit", function (event) {
        // $(".addProductForm").submit(function() {
        //     if ($("input[type='checkbox']").is(':checked')) {

        //     }else{

        //     }
        //     alert();
        //     // if ($("input[type='checkbox']").val() == "text 1") {
        //     //     alert("Please confirm if everything is correct");
        //     //     $("input[type='submit']").val("text 2");
        //     //     return false;
        //     // }
        // });

        $("#myInput").on("keyup", function() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByClassName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByClassName("search")[0];
                td1 = tr[i].getElementsByClassName("search")[1];
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

    // Delete Todo record
    function updateCount(attr, storyId) {

        // var updateAttr = null;
        // if (attr == 'like_count') {
        //     updateAttr = $("#" + like_count);
        // } else if (attr == 'dislike_count') {
        //     updateAttr = $("#" + dislike_count);
        // } else {
        //     updateAttr = $("#" + view_count);
        // }
        // if (attr == 'view_count'){
        //     atvalue = $("#readmore-" + storyId).text()
        //     if (atvalue.includes("Less")) {
        //         return false
        //     }
        // }

        // var updateAttr = $("#" + attr + storyId);
        // alert(updateAttr);

        $.ajax({
            url: "{{env('APP_URL')}}employee-portal/story/" + attr + "-update-" + storyId,
            type: 'get',
            dataType: 'json',
            success: function(response) {
                if (response.response_code == 200) {
                    $("#" + attr + storyId).text(response.data)
                    $("#story-op-status").addClass('text-success')
                } else {
                    $("#story-op-status").addClass('text-danger')
                }

                $("#story-op-status").html(response.response_message)
                $("#story-op-status").show().delay(5000).queue(function(n) {
                    $(this).hide();
                    n();
                });
            },
            error: function(response) {
                console.log(response)
                $("#todo-op-status").addClass('text-danger')
                //$("#todo-op-status").html(response)
                $("#todo-op-status").show().delay(5000).queue(function(n) {
                    $(this).hide();
                    n();
                });
            }
        });
    }


    var createAllErrors = function() {
        var form = $(this),
            errorList = $("ul.errorMessages", form);

        var showAllErrorMessages = function() {
            errorList.empty();

            // Find all invalid fields within the form.
            var invalidFields = form.find(":invalid").each(function(index, node) {

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
        form.on("submit", function(event) {
            if (this.checkValidity && !this.checkValidity()) {
                $(this).find(":invalid").first().focus();
                event.preventDefault();
            }
        });

        $("input[type=submit], button:not([type=button])", form)
            .on("click", showAllErrorMessages);

        $("input", form).on("keypress", function(event) {
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
    @error('title')
    <script type="text/javascript">    
        $(document).ready(function() {
            $('html, body').animate({
              scrollTop: $("#storyForm").offset().top - 100
            }, 1000);
        });
    </script>
    @enderror

    @error('file')
    <script type="text/javascript">    
        $(document).ready(function() {
            $('html, body').animate({
              scrollTop: $("#storyForm").offset().top - 100
            }, 1000);
        });
    </script>
    @enderror

    @error('accept_terms')
    <script type="text/javascript">    
        $(document).ready(function() {
            $('html, body').animate({
              scrollTop: $("#storyForm").offset().top - 100
            }, 1000);
        });
    </script>
    @enderror
@endpush

@push('plugin-scripts')
<script src="{{ asset('public/employee_portal/assets/plugins/chartjs/chart.min.js') }}">
</script>
<script src="{{ asset('public/employee_portal/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}">
</script>
@endpush

@push('custom-scripts')
{{-- <script src="{{ asset('public/employee_portal/assets/js/dashboard.js') }}"></script>--}}
@endpush