<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="base_url" content="{{ url('/') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" 
  type="image/jpg" 
  href="{{url('/public/Image/200x200.jpg')}}">
  <!-- Tell the browser to be responsive to screen width -->
  <!-- <link href="https://bootswatch.com/yeti/bootstrap.min.css" rel="stylesheet"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('public/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link href="{{ asset('public/admin/js/iCheck/skins/minimal/minimal.css')}}" rel="stylesheet">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('public/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" type="text/css" href="{{asset('public/admin/js/bootstrap-datepicker/css/datepicker.css')}}" />
  <link rel="stylesheet" type="text/css" href="{{asset('public/admin/js/bootstrap-datetimepicker/css/datetimepicker.css')}}" />
  <link rel="stylesheet" href="{{ asset('public/plugins/daterangepicker/daterangepicker.css')}}">
  
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Search bar -->
  <link href="{{asset('public/js/sweetalert/sweetalert.css')}}" rel="stylesheet">
  
  
  <!-- Added by bhavana-->
  
  <!-- <link href="{{ asset('public/admin/bs3/css/bootstrap.min.css')}}" rel="stylesheet"> -->
  <link href="{{ asset('public/admin/css/bootstrap-reset.css')}}" rel="stylesheet">
  <link href="{{ asset('public/admin/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
  <!--responsive table-->
  <link href="{{ asset('public/admin/css/table-responsive.css')}}" rel="stylesheet" />
  
  <!-- Custom styles for this template -->
  <link href="{{ asset('public/admin/css/style.css')}}" rel="stylesheet">
  <link href="{{ asset('public/admin/css/style-responsive.css')}}" rel="stylesheet" />
  
  <!-- Added by bhavana-->
  <!-- pankaj -->
  <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/js/bootstrap-datepicker/css/datepicker.css')}}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/js/select2/select2.css')}}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/css/bootstrap-switch.css')}}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/js/bootstrap-fileupload/bootstrap-fileupload.css')}}"/>
  <link rel="stylesheet" href="{{ asset('public/admin/js/morris-chart/morris.css')}}">
  
  
  <link rel="stylesheet" href="{{ asset('public/admin/js/data-tables/DT_bootstrap.css')}}" />
  <link rel="stylesheet" href="https://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.min.css" />
  

  
  @yield('header-ss')
  
  <style type="text/css">
  .error{
      color:red;
      
    }.green{
        color: green;
    }.dataTables_length,.dataTables_filter{
        display: none;
    }
    
    </style>

</head>
<body >
    
    <section id="container" >
        <!-- Navbar -->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                
                <a href="/admin/home" class="logo">
                    <img alt="National Ambulance" src="{{asset('public/admin/images/logo.png')}}">
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
                
            </div>
            <!--logo end-->
            <div class="topRight">
                <!-- Bread crumbs start -->
                @include('layouts.includes.breadcrumbs')
                <!-- Bread crumbs end -->
                <div class="topSearch">
                    <input type="text" class="form-control search" placeholder=" Search">
                </div>
                <div class="nav notify-row" id="top_menu">
                    <!--  notification start -->
                    <ul class="nav top-menu"> 
                        <!-- <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="fa fa-tasks"></i>
                                <span class="badge bg-success">8</span>
                            </a>
                            <ul class="dropdown-menu extended tasks-bar">
                                <li>
                                    <p class="">You have 8 pending tasks</p>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info clearfix">
                                            <div class="desc pull-left">
                                                <h5>Target Sell</h5>
                                                <p>25% , Deadline  12 June’13</p>
                                            </div>
                                            <span class="notification-pie-chart pull-right" data-percent="45">
                                                <span class="percent"></span>
                                            </span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info clearfix">
                                            <div class="desc pull-left">
                                                <h5>Product Delivery</h5>
                                                <p>45% , Deadline  12 June’13</p>
                                            </div>
                                            <span class="notification-pie-chart pull-right" data-percent="78">
                                                <span class="percent"></span>
                                            </span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info clearfix">
                                            <div class="desc pull-left">
                                                <h5>Payment collection</h5>
                                                <p>87% , Deadline  12 June’13</p>
                                            </div>
                                            <span class="notification-pie-chart pull-right" data-percent="60">
                                                <span class="percent"></span>
                                            </span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="task-info clearfix">
                                            <div class="desc pull-left">
                                                <h5>Target Sell</h5>
                                                <p>33% , Deadline  12 June’13</p>
                                            </div>
                                            <span class="notification-pie-chart pull-right" data-percent="90">
                                                <span class="percent"></span>
                                            </span>
                                        </div>
                                    </a>
                                </li>
                                
                                <li class="external">
                                    <a href="#">See All Tasks</a>
                                </li>
                            </ul>
                </li>
                <li id="header_inbox_bar" class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge bg-important">4</span>
                    </a>
                    <ul class="dropdown-menu extended inbox">
                        <li>
                            <p class="red">You have 4 Mails</p>
                        </li>
                        <li>
                            <a href="#">
                                <span class="photo"><img alt="avatar" src="public/images/avatar-mini.jpg"></span>
                                <span class="subject">
                                    <span class="from">Jonathan Smith</span>
                                    <span class="time">Just now</span>
                                </span>
                                <span class="message">
                                    Hello, this is an example msg.
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="photo"><img alt="avatar" src="public/images/avatar-mini-2.jpg"></span>
                                <span class="subject">
                                    <span class="from">Jane Doe</span>
                                    <span class="time">2 min ago</span>
                                </span>
                                <span class="message">
                                    Nice admin template
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="photo"><img alt="avatar" src="public/images/avatar-mini-3.jpg"></span>
                                <span class="subject">
                                    <span class="from">Tasi sam</span>
                                    <span class="time">2 days ago</span>
                                </span>
                                <span class="message">
                                    This is an example msg.
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="photo"><img alt="avatar" src="images/avatar-mini.jpg"></span>
                                <span class="subject">
                                    <span class="from">Mr. Perfect</span>
                                    <span class="time">2 hour ago</span>
                                </span>
                                <span class="message">
                                    Hi there, its a test
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">See all messages</a>
                        </li>
                    </ul>
                </li> -->
                <li id="header_notification_bar" class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        
                        <i class="fa fa-bell-o"></i>
                        <!-- <span class="badge bg-warning">3</span> -->
                    </a>
                    <ul class="dropdown-menu extended notification">
                        <!-- <li>
                            <p>Notifications</p>
                        </li> -->
                        
                        <!-- <li>
                            <div class="alert alert-success clearfix">
                                <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                <div class="noti-success">
                                    <a href="#" style="color: black; text-decoration: none !important;"> 2</a>
                                </div>
                            </div>
                        </li>
                        
                        <li>
                            <a class="btn btn-sm btn-primary" href="#">See All Notification</a>
                        </li> -->
                    </ul>
                </li> 
            </ul>
            <!--  notification end -->
        </div>
        
        <div class="top-nav">
            <!--search & user info start-->
            <ul class="nav pull-right top-menu">
                <!-- user login dropdown start-->
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <!-- <img src="{{asset('public/admin/images/user2-160x160.jpg')}}"> -->
                        @if(session('LoggedUser.image')) <!-- 1153.jpeg  -->
                        <img src="{{asset(session('LoggedUser.image'))}}" alt="Profile image">
                        @else
                        <img src="{{ 'https://ui-avatars.com/api/?name='.session('LoggedUser.first_name').' '.session('LoggedUser.last_name') }}" alt="Profile image">
                        
                        @endif
                        <span class="username">{{ Auth::user()->first_name}} {{ Auth::user()->last_name}}</span>
                        <b class="caret"></b>
                    </a> 
                    <ul class="dropdown-menu extended logout">
                        <li><a href="{{ route('user-profile.view')}}" ><i class="fa fa-suitcase"></i>Profile</a></li>
                        <li><a href="{{ route('user-profile.password.view') }}"><i class="fa fa-lock"></i>Change Password</a></li>
                        @if(Auth::id()==1)
                        <li><a href="{{route('email-config.view')}}"><i class="fa fa-cog"></i>Email Config</a></li>
                        @endif
                        <li><a href="{{ url('logout') }}" onClick="return confirm('Are You sure you want to logout?');"><i class="fa fa-key"></i>Log Out</a></li>
                    </ul>
                </li>
                <!-- user login dropdown end -->
            </ul>
            <!--search & user info end-->
        </div>  
    </div>
    
</header>
<!-- /.navbar -->

<!-- Main Sidebar Container -->

<aside>
    
    <div id="sidebar" class="nav-collapse">
        
        <!-- sidebar menu start-->  
        <div class="leftside-navigation" >
            <ul class="sidebar-menu" id="nav-accordion">
                
                <!-- <li>
                    <a href="{{ route('home')}} " class="nav-link">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                    
                    </a>
                 </li> -->
            
            <?php 			 
            $arr_icon = array('fa-user','fa-graduation-cap','fa-language','fa-group','fa-book','fa-list','fa-product-hunt','fa-pencil','fa-database','fa-child','fa-first-order','fa-paper-plane-o','fa-file-video-o','fa-tag','fa-rss','fa-bullhorn','fa-street-view','fa-question-circle-o','fa-picture-o','fa-upload','fa-window-restore','fa fa-vcard','fa-first-order','fa-registered','fa-users','fa-university');
            $i = 0;
            use app\Http\helper\Helper as Helper;
            $module = Helper::getModule();

            $pageCodenew = array();
            foreach ($module as $mod) {
                $page_code = Helper::getpageCode($mod->module);               

                foreach($page_code as $code)
                {
                    $explode = explode('/',ltrim($code->page_url,'/'));
                    $pageCodenew[$explode['0']] = $mod->module;
                }
            }
            
            foreach ($module as $mod) {
                
                
                $page_code = Helper::getpageCode($mod->module);
                
                
                
                $pageCode = array();
                
                foreach($page_code as $code)
                {
                    $pageCode[] = $code->page_code;
                }
                
                $permission=$pageCode;
                //echo "<pre>";
                //print_r($permission);die;
                if(count(array_intersect($permission,Session::get('LoggedUser')['allowedPageCodeList']))) { 
                    if($mod->module!="Screen Management"){
                    ?>

                        <li class="nav-item new">
                            <a href="#" class="nav-link  <?php if($pageCodenew[Request::segment(2)]==$mod->module) {echo "active";} ?>" >
                                <i class="fa fa-users"></i>
                                {{$mod->module}}
                                
                            </a>
                            <ul class="nav nav-treeview">
                                <?php foreach($page_code as $code) {
                                    if(in_array($code->page_code,Session::get('LoggedUser')['allowedPageCodeList'])) {?>
                                                <li class="nav-item">
                                                    <a href="{{url('/admin/').$code->page_url}}" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <span>{{$code->label}} </span>
                                                </a>
                                                </li>
                                <?php } }?>
                                            
                                            
                            </ul>
                        </li>
                 <?php
                }}$i++;
                }?> 
                   
          @if(Auth::user()->role_id==1)
            <li class="nav-item">
                <a href="#" class="nav-link <?php if(Request::segment(2) == 'submenu') {echo "active";} ?>" >
                    <i class="fa fa-file-text"></i>
                    Sub Menu Management
                    
                </a>
                <ul class="nav nav-treeview">
                    
                    <li class="nav-item">
                        <a href="{{route('submenu.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <span>Manage Sub CMS </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('submenu.create')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <span>Create Sub CMS</span>
                        </a>
                    </li>
                    
                </ul>
                
                
            </li>
            
            
            <li class="nav-item">
                <a href="#" class="nav-link <?php if(Request::segment(2) == 'news_category' || Request::segment(2) == 'news')  {echo "active";} ?>"  >
                    <i class="fa fa-file-text"></i>
                    News Management
                    
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('news_category.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <span>Manage News Category </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('news_category.create')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <span>Create News Category</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('news.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <span>Manage News </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('news.create')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <span>Create News</span>
                        </a>
                    </li>
                    
                </ul>
                
                
            </li>
            
            <li class="nav-item">
                <a href="#" class="nav-link <?php if(Request::segment(2) == 'public_awareness')  {echo "active";} ?>"  >
                    <i class="fa fa-file-text"></i>
                    Public Awareness Management
                    
                </a>
                <ul class="nav nav-treeview">
                    
                    <li class="nav-item">
                        <a href="{{route('public_awareness_category.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <span>Public Awareness Category</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/admin/public_awareness')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <span>Manage Public Awareness </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('public_awareness.create')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <span>Create Public Awareness</span>
                        </a>
                    </li>
                    
                </ul>
                
                
            </li>
            
            <li class="nav-item">
                <a href="#" class="nav-link <?php if(Request::segment(2) == 'board_director')  {echo "active";} ?>"  >
                    <i class="fa fa-file-text"></i>
                    Board Director Management
                    
                </a>
                <ul class="nav nav-treeview">
                    
                    <li class="nav-item">
                        <a href="{{route('board_director.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <span>Manage Board Director </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('board_director.create')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <span>Create Board Director</span>
                        </a>
                    </li>
                    
                </ul>
                
                
            </li>
            
            <li class="nav-item">
                <a href="#" class="nav-link <?php if(Request::segment(2) == 'organization_type')  {echo "active";} ?>"  >
                    <i class="fa fa-file-text"></i>
                    Organization Type Management
                    
                </a>
                <ul class="nav nav-treeview">
                    
                    <li class="nav-item">
                        <a href="{{route('organization_type.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <span>Manage Organization Type </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('organization_type.create')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <span>Create Organization Type</span>
                </a>
            </li>
            </ul>
            </li>

    @endif

@if(Auth::user()->role_id==1)
<li class="nav-item">
    <a href="#" class="nav-link <?php if(Request::segment(2) == 'tender')  {echo "active";} ?>"  >
        <i class="fa fa-file-text"></i>
        Tender Management
    </a>
    <ul class="nav nav-treeview">
        
        <li class="nav-item">
            <a href="{{route('tender.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <span>Manage Tender </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('tender.create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <span>Create Tender</span>
            </a>
        </li>
        
    </ul>
    
    
</li>
<li class="nav-item">
    <a href="#" class="nav-link <?php if(Request::segment(2) == 'video_category' || Request::segment(2) == 'video_gallery')  {echo "active";} ?>"  >
        <i class="fa fa-file-text"></i>
        Video Gallery Management
        
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{route('video_category.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <span>Manage Video Category </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('video_category.create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <span>Create Video Category</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a href="{{route('video_gallery.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <span>Manage Video Gallery </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('video_gallery.create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <span>Create Video Gallery</span>
            </a>
        </li>
        
    </ul>
    
    
</li>

<!-- <li class="nav-item">
    <a href="#" class="nav-link <?php if(Request::segment(2) == 'document_library')  {echo "active";} ?>"  >
        <i class="fa fa-file-text"></i>
        Document Library Management
        
    </a>
    <ul class="nav nav-treeview">
        
        <li class="nav-item">
            <a href="{{url('document_library')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <span>Manage Document Library </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('document_library.create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <span>Create Document Library</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('document_library_type.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <span>Document Type</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('document_library_department.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <span>Document Department</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('document_library_classification.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <span>Document Classification</span>
            </a>
        </li>
        
    </ul>
     
    
</li>-->



<li>
    <a href="{{ url('logout') }}" onClick="return confirm('Are You sure you want to logout?');">
        <i class="fa fa-lock"></i>
        <span>{{ __('Logout') }}</span>
    </a>
</li>

            
@endif
</br>
</br>
</br>
</ul>
</br>
</br>
</br>
</div>        
<!-- sidebar menu end-->
</div>
</aside>
<!-- Content Wrapper. Contains page content -->
<link rel="stylesheet" type="text/css" href="{{asset('public/css/toastr.min.css')}}">
<section id="main-content">
    @yield('content')
    
</section>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; 2022 </strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        
        </div>
    </footer>
    
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</section>
<!-- ./wrapper -->

<!-- jQuery -->
<!--Added by bhavana-->

<!-- <script src=="{{ asset('admin/js/jquery.js')}}"></script> -->
<script src="{{ asset('public/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('public/admin/js/scripts.js')}}"></script>
<script src="{{ asset('public/js/manage_validation.js') }}" defer></script>
<script src="{{ asset('public/js/jquery.validate.js') }}" defer></script>
<script src="{{ asset('public/js/validation.js') }}" defer></script>
<script src="{{ asset('public/js/jquery.ajax.js') }}" defer></script>
<script src="{{ asset('public/admin/bs3/js/bootstrap.min.js')}}"></script>
<script class="include" type="text/javascript" src="{{ asset('public/admin/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{ asset('public/admin/js/jquery.scrollTo.min.js')}}"></script>
<script src="{{ asset('public/admin/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js')}}"></script>
<script src="{{ asset('public/admin/js/jquery.nicescroll.js')}}"></script>

<script type="text/javascript" src="{{ asset('public/admin/js/bootstrap-fileupload/bootstrap-fileupload.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/admin/js/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/admin/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js')}}"></script>

<!-- <script src="{{ asset('admin/js/jquery.customSelect.min.js')}}" ></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script type="text/javascript" language="javascript" src="{{asset('public/admin/js/advanced-datatable/js/jquery.dataTables.js')}}"></script>
<script type="text/javascript" src="{{asset('public/admin/js/data-tables/DT_bootstrap.js')}}"></script>
<script src="{{asset('public/js/sweetalert/sweetalert.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/toastr.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/admin/js/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript" src="{{asset('public/admin/js/progress_bar.js')}}"></script>
<script type="text/javascript" src="https://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>



{!! Toastr::message() !!}

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

$(function () {
                    $('#start_date').change(function () {
                        $('#end_date').attr('min', $(this).val());
                    });

});

    @if(session('success'))
    swal("{{session('title_msg')?session('title_msg'):'Success'}}", "{{ session('success') }}", "success").then(function() {
    
});  
 
    @endif
    @if(session('message'))
    swal("{{session('title_msg')?session('title_msg'):'Success'}}", "{{ session('message') }}", "success").then(function() {
    
});  
 
    @endif
    @if(session('error'))
    swal("Error", "{{ session('error') }}", "error");  
 
    @endif

    $('.file-size-limit').on('change', function() {
        var isSizeValid = true;
        console.log(this.files.length);
        // if(this.files.length>1){
            $.each(this.files ,function( index, file ){
                const size = (file.size / 1024 / 1024).toFixed(2);
                // console.log(size);
                if(size>2){
                    isSizeValid=false;
                }
            });
        // }
        if (!isSizeValid) {
            $(this).val(''); 
            alert("File must be less than size 2 MB");
        } 
    });
    function makeid(length) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * 
 charactersLength));
   }
   return result;
}
    var pathname = window.location.pathname; // Returns path only (/path/example.html)
var url      = window.location.href;     // Returns full URL (https://example.com/path/example.html)
var origin   = window.location.origin;   // Returns base URL (https://example.com)
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const s_id = urlParams.get('s_id');


</script>

@yield('script')

</body>
</html>
