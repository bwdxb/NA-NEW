<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="base_url" content="{{ url('/') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
<!-- <link href="https://bootswatch.com/yeti/bootstrap.min.css" rel="stylesheet"> -->
<!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link href="{{ asset('admin/js/iCheck/skins/minimal/minimal.css')}}" rel="stylesheet">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" type="text/css" href="{{asset('admin/js/bootstrap-datepicker/css/datepicker.css')}}" />
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css')}}">


  <!-- summernote -->
  <!-- <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css')}}"> -->
  <!-- Google Font: Source Sans Pro -->



  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   <!-- Search bar -->
   <link href="{{asset('js/sweetalert/sweetalert.css')}}" rel="stylesheet">


<!-- Added by bhavana-->
  
  <link href="{{ asset('admin/bs3/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('admin/css/bootstrap-reset.css')}}" rel="stylesheet">
    <link href="{{ asset('admin/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <!--responsive table-->
    <link href="{{ asset('admin/css/table-responsive.css')}}" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="{{ asset('admin/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('admin/css/style-responsive.css')}}" rel="stylesheet" />
    
    <!-- Added by bhavana-->
    <!-- pankaj -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/js/bootstrap-datepicker/css/datepicker.css')}}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/bootstrap-switch.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/js/bootstrap-fileupload/bootstrap-fileupload.css')}}"/>
    <link rel="stylesheet" href="{{ asset('admin/js/morris-chart/morris.css')}}">

    <!-- <link href="{{ asset('admin/js/advanced-datatable/css/demo_page.css') }}" rel="stylesheet" /> -->
    <!-- <link href="{{ asset('admin/js/advanced-datatable/css/demo_table.css') }}" rel="stylesheet" /> -->

    <link rel="stylesheet" href="{{ asset('admin/js/data-tables/DT_bootstrap.css')}}" />
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

    <a href="index.html" class="logo">
        <h2>40a1Express</h2>
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->


<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="images/avatar1_small.jpg">
                <span class="username">{{ Auth::user()->first_name}}</span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="{{ url('profile')}}"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                <li><a href="{{ url('logout') }}"><i class="fa fa-key"></i> Log Out</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
        <li>
            <div class="toggle-right-box">
                <div class="fa fa-bars"></div>
            </div>
        </li>
    </ul>
    <!--search & user info end-->
</div>
</header>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @if(Auth::user()->role_id == 1)
  <aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->            <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
             <li>
                 <a href="{{ url('/home')}} " class="nav-link ">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ url('profile')}}">
                    <i class="fa fa-user"></i>
                    <span>My Profile</span>
                </a>
            </li>
           
            <!--<li>
                <a href="{{url('changepass')}}">
                    <i class="fa fa-unlock"></i>
                    <span>Change Password</span>
                </a>
            </li>-->
            <li >
                <a href="{{ url('user')}}">
                    <i class="fa fa-users"></i>
                    <span>User Management</span>
                </a>
                
            </li>
            <li>
                <a href="{{ route('mall.index')}}">
                    <i class="fa fa-book"></i>
                    <span>Mall Management</span>
                </a>
                
            </li>
			<!--<li>
                <a href="{{url('mall-category')}}">
                    <i class="fa fa-book"></i>
                    <span>Manage Mall Category</span>
                </a>
                
            </li>-->
			<li>
                <a href="{{url('staticmallpage')}}">
                    <i class="fa fa-file-text"></i>
                    <span> Mall Static Content Management</span>
                </a>
            </li>
			<li>
                <a href="{{ url('mall-kyc')}}">
                    <i class="fa fa-book"></i>
                    <span>KYC Management Mall</span>
                </a>
                
            </li>
			<li>
                <a href="{{ route('subAdmin.index')}}">
                    <i class="fa fa-book"></i>
                    <span>Sub Admin Management </span>
                </a>
            </li>
			<li>

                <a href="{{route('logo.index')}}">

                    <i class="fa fa-image"></i>
                    <span>Logo Management</span>
                </a>
            </li>
			<li>
                <a href="{{url('banner')}}">
                    <i class="fa fa-image"></i>
                    <span>Banner Management</span>
                </a>
            </li>
			<li>
                <a href="{{ url('categories')}}">
                    <i class="fa fa-bars"></i>
                    <span> Category Management </span>
                </a>
            </li>
			<li>
                <a href="{{route('subcategory.index')}}">
                    <i class="fa fa-bars"></i>
                    <span>Sub Category Management</span>
                </a>
            </li>
			
			<li>
                <a href="{{route('admin.brand.index')}}">
                    <i class="fa fa-compass"></i>

                    <span>Brand Management</span>
                </a>
            </li>
			<li>
                <a href="{{ route('products.index')}}">
                    <i class="fa fa-ellipsis-h"></i>
                    <span> Product Management</span>
                </a>
            </li>
			
			<li>
                <a href="{{url('transaction')}}">
                    <i class="fa fa-exchange"></i>
                    <span>Transaction Management</span>
                </a>
            </li>
			<li>
                <a href="{{ route('store-management.index')}}">
                    <i class="fa fa-keyboard-o"></i>
                    <span>Store Management</span>
                </a>
            </li>
			 <li>
                <a href="{{url('order')}}">
                    <i class="fa fa-sort"></i>
                    <span>Order Management</span>
                </a>
            </li>
            <li>
                <a href="{{route('offer.index')}}">
                    <i class="fa fa-retweet"></i>
                    <span>Offer Management</span>
                </a>
            </li>
			<li>
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span>Payment Management</span>
                </a>
            </li>
			<li>
                <a href="{{url('staticpage')}}">
                    <i class="fa fa-file-text"></i>
                    <span> Static Content Management</span>
                </a>
            </li>
              <li >
                  <a href="{{ url('icon')}}">
                        <i class="fa fa-upload"></i>
                        <span>Icon Upload</span>
                    </a>
                    
                </li>
				<li >
                  <a href="{{route('admin.notification')}}">
                        <i class="fa fa-laptop"></i>
                        <span>Notification Management</span>
                        
                    </a>
                    <!-- <ul>
                        <li><a href="{{route('notification-text.index')}}"><span>Select Notification Text</span></a></li>
                      </ul> -->
                </li>
        		<li>
              <a href="{{route('notification-templet.index')}}">
                    <i class="fa fa-group"></i>
                    <span>Notification Templet</span>
                </a>

                <a href="{{ url('market')}}">
                    <i class="fa fa-group"></i>
                    <span>Market Management</span>
                </a>
                
            </li>
				
			<li>
                <a href="{{url('slim')}}">
                    <i class="fa fa-image"></i>
                    <span> Slim Banner</span>
                </a>
            </li>
			<li>
                <a href="{{url('landingpage')}}">
                    <i class="fa fa-file-text"></i>
                    <span> Landing Page Management</span>
                </a>
            </li>
			<li>
                <a href="{{url('productpage')}}">
                    <i class="fa fa-book"></i>
                    <span> Product Page Management</span>
                </a>
            </li>

            <!--<li>
                <a href="{{url('campaign')}}">
                    <i class="fa fa-book"></i>
                    <span>Campaign Management</span>
                </a>
            </li>-->

            <li>
                <a href="{{ route('faq.index')}}">
                    <i class="fa fa-book"></i>
                    <span> Faq Management</span>
                </a>
            </li>

			<li>

                <a href="{{ url('market-kyc')}}">
                    <i class="fa fa-book"></i>
                    <span>KYC Management Market</span>
                </a>
                
            </li>
            
            <li>
                <a href="{{ url('logout') }}">
                    <i class="fa fa-user"></i>
                    <span>{{ __('Logout') }}</span>
                </a>
            </li>
        </ul></div>        
<!-- sidebar menu end-->
    </div>
</aside>
@endif
@if(Auth::user()->role_id == 3)
  <aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->            
		<div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
             <li>
                 <a href="{{ url('/home')}} " class="nav-link ">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ url('profile')}}">
                    <i class="fa fa-user"></i>
                    <span>My Profile</span>
                </a>
            </li>
           
            <!--<li>
                <a href="{{url('changepass')}}">
                    <i class="fa fa-unlock"></i>
                    <span>Change Password</span>
                </a>
            </li>-->
   			<li>
                
                <a href="{{route('market.product.index',Auth::user()->id)}}">
                    <i class="fa fa-ellipsis-h"></i>
                    <span> Product Management</span>
                </a>
            </li>
			
			<li>

                <a href="{{url('marketlogo')}}">

                    <i class="fa fa-image"></i>
                    <span>Market Logo Management</span>
                </a>
            </li>
			<li>
                <a href="#">
                    <i class="fa fa-image"></i>
                    <span>Market Additional Logo</span>
                </a>
            </li>
			<li>
                <a href="#">
                    <i class="fa fa-image"></i>
                    <span>Market Location</span>
                </a>
            </li>
			<li>
                <a href="{{url('marketbanner')}}">
                    <i class="fa fa-image"></i>
                    <span>Banner Management</span>
                </a>
            </li>
			<li>
                <a href="{{ url('marketcategory')}}">
                    <i class="fa fa-bars"></i>
                    <span> Category Management </span>
                </a>
            </li>
			<li>
                <a href="{{route('subcategory.index')}}">
                    <i class="fa fa-bars"></i>
                    <span>Sub Category Management</span>
                </a>
            </li>
			
			<li>
                <a href="{{url('marketbrand')}}">
                    <i class="fa fa-compass"></i>
                    <span>Brand Management</span>
                </a>
            </li>
			
			
			<li>
                <a href="{{url('transaction')}}">
                    <i class="fa fa-exchange"></i>
                    <span>Transaction Management</span>
                </a>
            </li>
			
			 <li>
                <a href="{{url('order')}}">
                    <i class="fa fa-sort"></i>
                    <span>Order Management</span>
                </a>
            </li>
            <li>
                <a href="{{route('offer.index')}}">
                    <i class="fa fa-retweet"></i>
                    <span>Offer Management</span>
                </a>
            </li>
			
				<li >
                  <a href="#">
                        <i class="fa fa-laptop"></i>
                        <span>Notification Management</span>
                    </a>
                    
                </li>
            
            <li>
                <a href="{{ url('logout') }}">
                    <i class="fa fa-user"></i>
                    <span>{{ __('Logout') }}</span>
                </a>
            </li>
        </ul></div>        
<!-- sidebar menu end-->
    </div>
</aside>
@endif
@if(Auth::user()->role_id == 2)
  <aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->            
		<div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
             <li>
                 <a href="{{ url('/home')}} " class="nav-link ">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ url('profile')}}">
                    <i class="fa fa-user"></i>
                    <span>My Profile</span>
                </a>
            </li>
           
            <!--<li>
                <a href="{{url('changepass')}}">
                    <i class="fa fa-unlock"></i>
                    <span>Change Password</span>
                </a>
            </li>-->
   			<li>
                @php $mall = \App\Mall::where('user_id',Auth::user()->id)->first();
                    
                @endphp
                @if(!empty($mall))
                <a href="{{route('admin.mall.product',$mall->id)}}">
                    <i class="fa fa-ellipsis-h"></i>
                    <span>Product Management</span>
                </a>
                @endif
            </li>
			
			<li>
                <a href="{{url('staticmallpage')}}">
                    <i class="fa fa-file-text"></i>
                    <span> Mall Static Content Management</span>
                </a>
            </li>
			<li>
                <a href="#">
                    <i class="fa fa-image"></i>
                    <span>Product FAQ</span>
                </a>
            </li>
			<a href="#">
                    <i class="fa fa-money"></i>
                    <span>Payment Management</span>
                </a>
			 @if(!empty($mall))
    			<li>
                    <a href="{{route('mall-category.index',$mall->id)}}">
                        <i class="fa fa-bars"></i>
                        <span>Category Management </span>
                    </a>
                </li>
            @endif
			<li>
                <a href="{{route('subcategory.index')}}">
                    <i class="fa fa-bars"></i>
                    <span>Sub Category Management</span>
                </a>
            </li>
			
			<li>
                <a href="{{route('admin.brand.index')}}">
                    <i class="fa fa-compass"></i>
                    <span>Brand Management</span>
                </a>
            </li>

			 <li>
                <a href="{{url('order')}}">
                    <i class="fa fa-sort"></i>
                    <span>Order Management</span>
                </a>
            </li>
            <li>
                <a href="{{route('offer.index')}}">
                    <i class="fa fa-retweet"></i>
                    <span>Offer Management</span>
                </a>
            </li>
			
				
				<li>
                <a href="{{url('campaign')}}">
                    <i class="fa fa-book"></i>
                    <span>Campaign Management</span>
                </a>
            </li>
            
            <li>
                <a href="{{ url('logout') }}">
                    <i class="fa fa-user"></i>
                    <span>{{ __('Logout') }}</span>
                </a>
            </li>
        </ul></div>        
<!-- sidebar menu end-->
    </div>
</aside>
@endif

 

  <!-- Content Wrapper. Contains page content -->
  <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('css/toastr.min.css')}}">
  <section id="main-content">
    @yield('content')

     </section>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 </strong>
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

<!--<script src=="{{ asset('admin/js/jquery.js')}}"></script>-->
<script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('admin/js/scripts.js')}}"></script>

<script src="{{ asset('js/jquery.validate.js') }}" defer></script>
<script src="{{ asset('js/validation.js') }}" defer></script>
<script src="{{ asset('js/manage_validation.js') }}" defer></script>
<script src="{{ asset('admin/bs3/js/bootstrap.min.js')}}"></script>
<script class="include" type="text/javascript" src="{{ asset('admin/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{ asset('admin/js/jquery.scrollTo.min.js')}}"></script>
<script src="{{ asset('admin/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js')}}"></script>
<script src="{{ asset('admin/js/jquery.nicescroll.js')}}"></script>

<script type="text/javascript" src="{{ asset('admin/js/bootstrap-fileupload/bootstrap-fileupload.js')}}"></script>
<script type="text/javascript" src="{{ asset('admin/js/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>

<!-- <script src="{{ asset('admin/js/jquery.customSelect.min.js')}}" ></script> -->
<script type="text/javascript" language="javascript" src="{{asset('admin/js/advanced-datatable/js/jquery.dataTables.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/data-tables/DT_bootstrap.js')}}"></script>
<script src="{{asset('js/sweetalert/sweetalert.min.js')}}"></script>
<!-- <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script> -->
<script type="text/javascript" src="{{asset('js/toastr.min.js')}}"></script>
<script src="{{asset('admin/js/iCheck/jquery.icheck.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('admin/js/icheck-init.js')}}"></script>
<script src="{{asset('admin/js/flot-chart/jquery.flot.js')}}"></script>
<script src="{{asset('admin/js/flot-chart/jquery.flot.pie.js')}}"></script>
<script src="{{asset('admin/js/advanced-form.js')}}"></script>

    {!! Toastr::message() !!}


@yield('script')
   
</body>
</html>
