@extends('layouts.employee_portal.master')

@push('plugin-styles')

@endpush

@section('content')
    <div class="row">
        <div class="col-md-12 mt-3 mb-3">
            <h1 class="h1_heading">Welcome to NA’s Employee Portal</h1>
        </div>
        <div class="col-md-7">
        	            <div class="user-wrapper">
                <div class="profile-image">
                    <img src="{{ 'https://ui-avatars.com/api/?name='.session('LoggedUser.first_name') }} {{session('LoggedUser.last_name')}}"
                         alt="profile image" style="width:100%;height:100%;">
                </div>
                <div class="text-wrapper">
                    <!-- <h4 class="profile-name">Ali Al Kharusi</h4> -->
                    <h4 class="profile-name">{{session('LoggedUser.first_name')}} {{session('LoggedUser.last_name')}} </h4>
                    <div class="dropdown" data-display="static">
                        <div class="" id="UsersettingsDropdown">
                        <!-- <a class="d-flex" id="UsersettingsDropdown" href="javascript:void(0)"> -->
                            <!-- <small class="designation text-muted">QHSE and BC Manager</small> -->
                            <small class="designation text-muted">{{session('LoggedUser.designation')}}</small>
                            <span class="status-indicator online"></span>
                        <!-- </a> -->
                    </div>
                    </div>
                </div>
            </div>

            <div class="row logoWrapper">
                @foreach($internal_applications as $internal_application)
                    <div class="col-md-4 col-sm-4 grid-margin stretch-card">
                        <div class="card navyblueBG">
                            <a class="card-body linkItem hoverEffect" href="{{ $internal_application->url }}"
                               target="_blank">
                              <span class="logoIcon">
                                   <img class="imgHover"
                                        src="{{ url('public/'.$internal_application->logo) }}">
                              </span>
                                @if(str_contains($internal_application->title, 'Outlook'))
                                    <h5>{{ $internal_application->title }}</h5>
                                @endif
                            </a>
                        </div>
                    </div>
            @endforeach
        
                <div class="col-md-12 text-center">
                    <div class="card">
                        <div class="card-body">
                            <a class="primary_btn"
                               href="{{ route('employee-portal.internal-application.view') }}">All
                                Applications</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 stretch-card flex-wrap">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">To Do List</h4>
                    <div class="add-items d-flex">
                        <input type="text" class="form-control todo-list-input"
                               id="todo"
                               placeholder="What do you need to do this week?"
                               title="What do you need to do this week?">
                        <input type="text" id="todo-date" class="form-control"
                               min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                               placeholder="DD/MM/YYYY">
                               <i class="mdi mdi-calendar"></i>
                        <button id="add_todo"
                                class="add btn btn-primary font-weight-medium todo-list-add-btn navyblueBtn">
                            Add
                        </button>
                    </div>
                    <!-- <p id="todo-op-status">
                        {{ session('success') }}<br/>
                    </p> -->
                    <div class="list-wrapper">
                        <ul id="todo-list" class="d-flex flex-column-reverse todo-list todo-list-custom">
                        </ul>
                        <p class="mt-2 text-center">
                            <a href="{{route('employee-portal.todo.view-all')}}" class="text-muted">View All To Do’s</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-body headsUp_block">

                    @if(isset($heads_up_today) && isset($heads_up_today[0]))
                        <h3 class="headsupTitle">The Head's Up</h3>
                        <div class="headsUp_image">
                        <img class="imgHover"
                                 src="{{ asset('public/employee_portal/images/headsup-icon.jpg') }}">
                            
                               
                            <p class="mb-0 text-left text-md-center text-xl-left">
                                <a href="{{route('employee-portal.heads-up.view')}}" class="text-muted">
                                     View All<i class="mdi mdi-arrow-right ml-1" aria-hidden="true"></i>
                                </a>
                            </p>
                        </div>
                        <div class="headsUp_text">                            
                            <div class="headsUp_slider">
                                <marquee scrollamount="6" onmouseover="stop()" onmouseout="start()" direction="up" scrolldelay="400"> 
                                    <ul class="ulList">
                                    @foreach($heads_up_today as $headsUp)
                                        <li><a href="{{route('employee-portal.heads-up.view')}}?id={{$headsUp->id}}">{{$headsUp->title}}</a></li>
                                    @endforeach
                                    </ul>
                                </marquee>
                            </div>                            
                            <!-- <h3>The Head's Up<br>+ Announcements</h3> -->
                            {{--<em class="text-danger">{{ $analysis['heads_up_new'] }} New</em>--}}
                        </div>
                    @else
                        <h3 class="headsupTitle">The Head's Up</h3>
                        <div class="headsUp_image">
                            <img class="imgHover"
                                 src="{{ asset('public/employee_portal/images/headsup-icon.jpg') }}">
                            <p class="mb-0 text-left text-md-center text-xl-left">
                                <a href="{{route('employee-portal.heads-up.view')}}" class="text-muted">
                                    View All<i class="mdi mdi-arrow-right ml-1" aria-hidden="true"></i>
                                </a>
                            </p>
                        </div>
                        {{--<div class="headsUp_text blur">
                            <div class="headsUp_slider">
                                <!-- <h3><a href="{{route('employee-portal.heads-up.view')}}">The Head's Up<br>+ Announcements</a></h3>
                                <h3><a href="{{route('employee-portal.heads-up.view')}}">The Head's Up<br>+ Announcements</a></h3>
                                <h3><a href="{{route('employee-portal.heads-up.view')}}">The Head's Up<br>+ Announcements</a></h3>
                                <h3><a href="{{route('employee-portal.heads-up.view')}}">The Head's Up<br>+ Announcements</a></h3>
                                <h3><a href="{{route('employee-portal.heads-up.view')}}">The Head's Up<br>+ Announcements</a></h3>
                                <h3><a href="{{route('employee-portal.heads-up.view')}}">The Head's Up<br>+ Announcements</a></h3> -->
                            </div>                            
                            <!-- <h3>The Head's Up<br>+ Announcements</h3> -->
                            <em class="text-danger">{{ $analysis['heads_up_new'] }} New</em>
                        </div>--}}
                    @endif
                </div>
            <!-- <a href="{{route('employee-portal.heads-up.view')}}" class="text-center" style="color: black">View all Head's Up
                    contents</a> -->
            </div>
        </div>
    </div>
    <!-- <a class="primary_btn" href="{{ route('employee-portal.market-place.view') }}">View Story Board</a>
    <a class="primary_btn" href="{{ route('employee-portal.document-library.view') }}">View Document Library</a> -->
    <div class="row mt-4">
        <div class="col-lg-8 col-md-7">
            <div class="col-lg-12 col-md-12">
                <div class="row">
                    <div class="col-md-12 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card card-statistics">
                            <div class="card-body">
                                <div class="d-flex flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
                                    <div class="float-left">
                                        <i class="mdi mdi-file-document-box-multiple text-primary icon-lg mdi_icon"></i>
                                        <p class="mb-0 text-left text-md-center text-xl-left">
                                            <a href="{{route('employee-portal.document-library.view')}}" class="text-muted">
                                                 View All<i class="mdi mdi-arrow-right ml-1" aria-hidden="true"></i>
                                            </a>
                                        </p>
                                    </div>
                                    <div class="float-right">
                                        <p class="mb-0 text-right">Document Library</p>
                                        <div class="fluid-container">
                                            <h3 class="font-weight-medium text-right mb-0">
                                                {{ $analysis['document_library'] }}</h3>
                                        </div>
                                    </div>
                                </div>
                                {{--                            <p class="text-muted mt-3 mb-0 text-left text-md-center text-xl-left">--}}
                                {{--                                {{ $analysis['document_library_new'] }} New </p>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card card-statistics">
                            <div class="card-body">
                                <div class="d-flex flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
                                    <div class="float-left">
                                        <i class="mdi_icon">
                                          <img class="imgHover" src="{{ asset('public/employee_portal/images/stories-icon.png') }}">
                                        </i>
                                        <p class="mb-0 text-left text-md-center text-xl-left">
                                            <a href="{{route('employee-portal.story.view')}}" class="text-muted">
                                                 View All<i class="mdi mdi-arrow-right ml-1" aria-hidden="true"></i>
                                            </a>
                                        </p>
                                    </div>
                                    <div class="float-right">
                                        <p class="mb-0 text-right">Stories</p>
                                        <div class="fluid-container">
                                            <h3 class="font-weight-medium text-right mb-0">
                                                {{ $analysis['stories'] }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="cardBotm mt-3">
                                {{--                                <p class="text-muted mb-0 text-left text-md-center text-xl-left">--}}
                                {{--                                    {{ $analysis['stories_new'] }} New</p>--}}
                                <!-- <span class="text-muted">0 New</span>                             -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card card-statistics">
                            <div class="card-body">
                                <div
                                        class="d-flex flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
                                    <div class="float-left">
                                        <i class="mdi mdi-cart-arrow-right text-primary icon-lg mdi_icon"></i>
                                        <p class="mb-0 text-left text-md-center text-xl-left">
                                            <a href="{{route('employee-portal.market-place.view')}}" class="text-muted">
                                                 View All<i class="mdi mdi-arrow-right ml-1" aria-hidden="true"></i>
                                            </a>
                                        </p>
                                    </div>
                                    <div class="float-right">
                                        <p class="mb-0 text-right">Marketplace</p>
                                        <div class="fluid-container">
                                            <h3 class="font-weight-medium text-right mb-0">
                                                {{ $analysis['market_place'] }}</h3>
                                        </div>
                                    </div>
                                </div>
                                {{--                            <p class="text-muted mt-3 mb-0 text-left text-md-center text-xl-left">--}}
                                {{--                                <em>{{ $analysis['market_place_new'] }} New</em></p>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card card-statistics">
                            <div class="card-body">
                                <div
                                        class="d-flex flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
                                    <div class="float-left">
                                        <i class="mdi_icon">
                                            <img class="imgHover" src="{{ asset('public/employee_portal/images/team-salute-icon.png') 
                                                             }}">
                                        </i>
                                        <p class="mb-0 text-left text-md-center text-xl-left">
                                            <a href="{{route('employee-portal.team-salute.view')}}" class="text-muted">
                                                 View All<i class="mdi mdi-arrow-right ml-1" aria-hidden="true"></i>
                                            </a>
                                        </p>
                                    </div>
                                    <div class="float-right">
                                        <p class="mb-0 text-right">Team Member Salute</p>
                                        <div class="fluid-container">
                                            <h3 class="font-weight-medium text-right mb-0">
                                                {{ $analysis['team_salutes'] }}</h3>
                                        </div>
                                    </div>
                                </div>
                                {{--                            <p class="text-muted mt-3 mb-0 text-left text-md-center text-xl-left">--}}
                                {{--                                <em>{{ $analysis['team_salutes_new'] }} New</em></p>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(count($pmo_notices))
            <div class="col-lg-12 col-md-12">
                @if(isset($pmo_notices))
                <h1 class="h1_heading text-center">PMO Notice Board</h1>
                <div class="row logoWrapper mt-4">
                @foreach($pmo_notices as $pmo_notice)
                    <div class="col-md-3 col-sm-3 grid-margin stretch-card">
                        <div class="card">
                            <a href="{{route('employee-portal.pmo-notice-board.view','id='.$pmo_notice->id) }}"
                                       target="_blank">                    
                              <span class="logoIcon">
                                   <img class="imgHover"
                                        src="{{ url('public/uploads/pmo/'.$pmo_notice->cover_img) }}">
                              </span>
                            </a>                    
                        </div>
                    </div>
                @endforeach
                </div>
                @endif
            </div>
            @endif
        </div>
        <div class="col-lg-4 col-md-5">
            <div class="twitterBox">
                <div class="widgetHeader">
                    <h5>Tweets</h5>
                    <a href="#"><img
                                src="{{ asset('public/website/images/twitter-follow-btn.png') }}"></a>
                </div>
                <div class="feedContent">
                    <a class="twitter-timeline" href="https://twitter.com/NAmbulanceUAE?ref_src=twsrc%5Etfw">Tweets by
                        NAmbulanceUAE</a>
                    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

                </div>
            </div>
        </div>
        
    </div>
    
    @if(count($stories))
    <div class="card grid-margin mt-4 storyWrapper">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="mb-4">Stories</h3>
                </div>
                @forelse($stories as $d)
                    <div class="col-sm-6 col-lg-4">
                        <div class="storyItem mb-4">
                            <div class="storyImage">
                                @if($d->media_type == 'image')
                                    <img class="imgHover" src="{{ url($d->file_url) }}">
                                @else
                                <video width="100%" height="100%" autoplay muted loop playsinline controlsList="nodownload">
                                     <source src="{{ url($d->file_url) }}" type="video/mp4"/>
                                </video>
                                    <!-- <iframe 
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen="" frameborder="0" src=""
                                            controlsList="nodownload" title="video player" width="400px" height="300px"></iframe> -->
                                @endif

                            </div>

                            <div class="Description">

                                <div class="storyCredit">
                                    <span class="search">{{ $d->category }}</span>
                                </div>

                                <h4 class="storyTitle mt-3 w-100">{{ $d->title }}</h4>
                                <p class="story_content search story-desc w-100 more"
                                   val="{{ $d->id }}" id="story-desc-{{ $d->id }}">
                                    {{ $d->story }}
                                </p>
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
                                    <div class="photoCredit">
                                    <!-- @if($d->media_type == 'image')
                                        Photo
                                    @else
                                        Video
                                    @endif
                                            Credits -->
                                        <span class="search">&copy;{{ $d->file_credits }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- <div class="col-xl-4 col-lg-4">
                    <div class="storyItem mb-4">
                         <a class="hoverEffect" href="#" target="_blank">
                              <div class="storyImage">
                                   <img class="imgHover"
                                        src="http://na.bw.ae/national-ambulance/public/uploads/news/7399.jpg">
                              </div>
                              <div class="storyDescription">
                                   <div class="storyCredit"><span>Inspirations</span></div>
                                   <h4 class="storyTitle">Events' Ambulance Coverage</h4>
                                   <p>There are many variations of passages of Lorem Ipsum available, but the majority
                                        have suffered alteration in some form, by injected humour, or randomised words
                                        which don't look...<small>read more</small></p>
                                   <div class="storyAuthor">
                                        <span class="authorName">
                                             <font>By</font> Nour Saifi .
                                        </span>
                                        <span class="poostDate">Nov 7, 2019</span>
                                   </div>
                              </div>
                         </a>
                    </div>\
               </div>
               <div class="col-xl-4 col-lg-4">
                    <div class="storyItem mb-4">
                         <a class="hoverEffect" href="#" target="_blank">
                              <div class="storyImage">
                                   <img class="imgHover"
                                        src="http://na.bw.ae/national-ambulance/public/uploads/news/7399.jpg">
                              </div>
                              <div class="storyDescription">
                                   <div class="storyCredit"><span>Community</span></div>
                                   <h4 class="storyTitle">Events' Ambulance Coverage</h4>
                                   <p>There are many variations of passages of Lorem Ipsum available, but the majority
                                        have suffered alteration in some form, by injected humour, or randomised words
                                        which don't look...<small>read more</small></p>
                                   <div class="storyAuthor">
                                        <span class="authorName">
                                             <font>By</font> Nour Saifi .
                                        </span>
                                        <span class="poostDate">Nov 7, 2019</span>
                                   </div>
                              </div>
                         </a>
                    </div>
               </div> -->
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="{{ route('employee-portal.story.view') }}"
                       class="primary_btn">View More</a>
                </div>
            </div>
        </div>
    </div>
@endif


@if(count($team_salutes))

    <div class="hometeamSalute grid-margin mt-4">
        @if(isset($team_salutes))
            <div class="row grid-margin mt-2">
                @foreach($team_salutes as $d)
                    <?php
                   $color = "";
                   switch ($d->category) {
                       case "Respect":
                           $color = "darkgreySalut";
                           break;
                       case "Excellence":
                           $color = "navyblueSalut";
                           break;
                       case "Integrity":
                           $color = "redSalut";
                           break;
                       case "Mutual Support":
                           $color = "blueSalut";
                           break;
           
                       default:
                           break;
                   }
                    ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card salut_certificate">
                            <div class="pin"></div>
                            <div class="card-body  {{ $color }}">
                                <h3>Team Member Salute</h3>
                                <div class="salutDesciription">
                                    <div class="stRow">
                                        <label>To</label>
                                        @if($d->getToUserInfo()&&$d->getToUserInfo()->gst_no==1)
                            <del> <span>{{ $d->ts_to }}</span> </del>
                            @else
                            <span>{{ $d->ts_to }}</span>
                            @endif
                                    </div>
                                    <div class="stRow">
                                        <label>From:</label>
                                        @if($d->getUserInfo()->gst_no==1)
                            <del><span>{{ $d->ts_from }}</span></del>
                            @else
                            <span>{{ $d->ts_from }}</span>

                            @endif
                                    </div>
                                    <div class="stRow">
                                        <label>Date:</label>
                                        <span>{{ \Carbon\Carbon::parse($d->ts_date)->format('d-m-Y') }}</span>
                                    </div>
                                    <div class="stRow st_des">
                                        <!-- <label>For:</label> -->
                                        <span>{{ $d->ts_for }}</span>
                                    </div>
                                </div>
                                <div class="CategoryTitle">
                                    <h4>{{ $d->category }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="{{ route('employee-portal.team-salute.view') }}"
                   class="primary_btn">View More</a>
            </div>
        </div>
    </div>

@endif
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- <script src="{{asset('public/api-routes/todo-api-routes.js')}}"></script> -->
<script>
    $(document).ready(function () {
        fetchTodos();
        // Add Todo record
        $('#add_todo').click(function () {

            var todo = $('#todo').val();
            var todoDate = $('#todo-date').val();
            if (todo != '') {
                $.ajax({
                    url: "{{route('employee-portal.todo.create')}}",
                    type: 'post',

                    data: {
                        "_token": "{{ csrf_token() }}",
                        "todo": todo,
                        "date": todoDate,
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.response_code == 200) {
                            $('#todo').val('');
                            $("#todo-op-status").addClass('text-success')
                        } else {
                            $("#todo-op-status").addClass('text-danger')
                        }
                        $("#todo-op-status").html(response.response_message)
                        $("#todo-op-status").show().delay(5000).queue(function (n) {
                            $(this).hide();
                            n();
                        });
                        fetchTodos();
                    },
                    error: function (response) {
                        console.log(response)
                        $("#todo-op-status").addClass('text-danger')
                        //$("#todo-op-status").html(response)
                        $("#todo-op-status").show().delay(5000).queue(function (n) {
                            $(this).hide();
                            n();
                        });
                        // fetchTodos();

                    }
                });
            } else {
                $("#todo-op-status").addClass('text-danger')
                $("#todo-op-status").html('Fill in the Todo !!!')
                $("#todo-op-status").show().delay(5000).queue(function (n) {
                    $(this).hide();
                    n();
                });
                fetchTodos();
            }
        });
    });

    // Delete Todo record
    function deleteTodo(todoId) {
        $.ajax({
            url: "{{route('employee-portal.todo.fetch')}}/delete/" + todoId,
            type: 'get',
            dataType: 'json',
            success: function (response) {
                if (response.response_code == 200) {
                    $("#todo-op-status").addClass('text-success')
                } else {
                    $("#todo-op-status").addClass('text-danger')
                }

                $("#todo-op-status").html(response.response_message)
                $("#todo-op-status").show().delay(5000).queue(function (n) {
                    $(this).hide();
                    n();
                });
                fetchTodos();
            },
            error: function (response) {
                console.log(response)
                $("#todo-op-status").addClass('text-danger')
                //$("#todo-op-status").html(response)
                $("#todo-op-status").show().delay(5000).queue(function (n) {
                    $(this).hide();
                    n();
                });
                fetchTodos();
            }
        });
    }

    // Delete Todo record
    function updateTodo(todoId) {
        $.ajax({
            url: "{{route('employee-portal.todo.fetch')}}/update/" + todoId,
            type: 'get',
            dataType: 'json',
            success: function (response) {
                if (response.response_code == 200) {
                    $("#todo-op-status").addClass('text-success')
                } else {
                    $("#todo-op-status").addClass('text-danger')
                }

                $("#todo-op-status").html(response.response_message)
                $("#todo-op-status").show().delay(5000).queue(function (n) {
                    $(this).hide();
                    n();
                });
                fetchTodos();
            },
            error: function (response) {
                console.log(response)
                $("#todo-op-status").addClass('text-danger')
                //$("#todo-op-status").html(response)
                $("#todo-op-status").show().delay(5000).queue(function (n) {
                    $(this).hide();
                    n();
                });
                fetchTodos();
            }
        });
    }


    // Fetch records
    function fetchTodos() {
        $.ajax({
            url: '{{route('employee-portal.todo.fetch')}}',
            type: 'get',
            dataType: 'json',
            success: function (response) {
                if (response.response_code == 200) {
                    $("#todo-op-status").addClass('text-success')
                    $("#todo-list").empty()
                    $.each(response.data, function (key, val) {
                        var code = '';
                        if (val.status == "completed") {
                            code += '<li class="completed">' +
                                '<div class="form-check form-check-flat">' +
                                '<input class="checkbox" onchange="updateTodo(' + val.id + ')" type="checkbox" checked />' +
                                '<label class="form-check-label">' + val.todo + '</label>' +
                                '</div>' +
                                '<i class="remove mdi mdi-close-circle-outline" style="cursor:pointer;" onclick="deleteTodo(' + val.id + ')"></i>' +
                                '</li>';
                        } else {
                            code += '<li>' +
                                '<div class="form-check form-check-flat">' +
                                '<input class="checkbox" onchange="updateTodo(' + val.id + ')" type="checkbox" />' +
                                '<label class="form-check-label">' + val.todo + '</label>' +
                                '</div>' +
                                '<i style="cursor: not-allowed" class="remove mdi mdi-close-circle-outline"></i></li>';
                        }
                        $("#todo-list").append(code);
                    });
                } else {
                    $("#todo-op-status").addClass('text-danger')
                }

                $("#todo-op-status").html(response.response_message)
                $("#todo-op-status").show().delay(5000).queue(function (n) {
                    $(this).hide();
                    n();
                });
            },
            error: function (response) {
                console.log(response)
                $("#todo-op-status").addClass('text-danger')
                //$("#todo-op-status").html(response)
                $("#todo-op-status").show().delay(5000).queue(function (n) {
                    $(this).hide();
                    n();
                });
                fetchTodos();
            }
        });
    }

    $( function() {
        $( "#todo-date" ).datepicker({
            dateFormat: "dd-mm-yy",
            duration: "fast",
            changeMonth: true,
            changeYear: true,
        });
    } );

</script>
@push('plugin-scripts')

    <script
            src="{{ asset('public/employee_portal/assets/plugins/chartjs/chart.min.js') }}">
    </script>
    <script
            src="{{ asset('public/employee_portal/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}">
    </script>

@endpush

@push('custom-scripts')
    <script src="{{ asset('public/employee_portal/assets/js/dashboard.js') }}"></script>

@endpush 