<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:image" content="http://na.bw.ae/public/website/images/national-ambulance-logo-blue.svg" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'National Ambulance') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
	<style>
	.error{color:#e3342f; font-weight:bold;}
	
	</style>  
</head>   
<body class="loginPage"> 
    <div id="app">
       <!--header-->
        <header class="header fixedHeader">           
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 headerWrap">
                                <div class="logo">
                                    <a href="/">
                                        <img src="{{asset('public/images/national-ambulance-logo-white.svg')}}" alt="National Ambulance">
                                    </a>
                                </div>                        
                                <div class="backWebsite">
                                    <a class="back_NA" href="{{env('APP_URL')}}index">{{__('National Ambulance Website')}}</a>
                                </div>
                            </div>
                        </div> 
                    </div>
            </header>
            <!--header end-->

        <main>
            @yield('content')
        </main>
    </div>
	   
		<script src="{{ asset('public/js/jquery.validate.js') }}" defer></script>
		<script src="{{ asset('public/js/validation.js') }}" defer></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
 @if(session('success'))
        
 swal("{{session('title_msg')?session('title_msg'):'Success'}}", "{{ session('success') }}", "success").then(function() {
    window.location.reload();
});  
 {{ Session::flush() }}

           
    @endif
    @if(session('error'))
    
    swal("Error", "{{ session('error') }}", "error").then(function() {
    window.location.reload();
});  
 {{ Session::flush() }}
      
    @endif
    </script>
</body>
</html>
