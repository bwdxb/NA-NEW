@php
use app\Http\helper\Helper as Helper;
        $launchConfigData = Helper::getLaunchConfig();
@endphp
@extends('layouts.app')

@section('content')
<meta property="twitter:image" content="{{url('/public/Image/200x200.jpg')}}" />
<meta property="twitter:image:url" content="{{url('/public/Image/200x200.jpg')}}" />
<link rel="stylesheet" href="{{asset('public/website/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('public/website/css/style.css')}}" media="all">
<style type="text/css">
.pageBanner{margin:0;}
body{padding:0;}
.header .logo{max-width:215px;width:100%;}
.header .logo img{width:100%;}
.card{padding:20px;text-align:center;}
.launch_btn{max-width:180px;padding:8px 10px 10px;margin:2rem auto 1rem;background:#243a76;border-color:#243a76;border-radius:6px;
-webkit-border-radius:6px;-moz-border-radius:6px;-ms-border-radius:6px;}
h6{font-weight:600;}
.loginBox {max-width:530px;}
</style>
<section class="pageBanner p-0"
style="background-image: url({{url('public/images/login-bg.jpg') }})">
<div class="container">
    <div class="row justify-content-center">
        <div class="loginBox">
            <div class="card">
                @if($launchConfigData && ($launchConfigData->status))<!-- code for hiding the login form when lauch status is true -->
                <div class="card-header" style="text-align:center; font-size:24px;">{{ config('app.name', 'National Ambulance') }}</div>
                <div class="card-body">
                    @if(Session::has('error'))
                      <div class="alert {{ Session::get('alert-class', 'alert-danger') }}" style="margin-top: 15px;" >
                        <div style="display:inline-block" id="">
                          {{ Session::get('message') }}
                        </div>
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" style="display:inline-block">&times;</a>
                      </div>
                    @endif

                        <form method="POST" action="{{ url('login') }}" id="loginForm">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check text-start">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0 text-start">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="default_btn navyblue_btn" style="min-width:inherit; padding:5px 15px 7px;font-size:15px;">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>

                        </form> 
                   </div>
                    <!-- <a href="/launch/reset"  class="mt-4 w-100 default_btn navyblue_btn">Reset Launch of <b>Nationalambulance.ae</b></a> -->

                    @else
                        <!-- <button type="button" onclick="countdown(this)" class="mt-4 w-100 default_btn navyblue_btn">Launch <b>Nationalambulance.ae</b></button> -->
                        <h6 class="mt-4 mb-2"><a href="{{ route('web.index') }}" style="direction:rtl;font-family:Almarai, sans-serif;">موقع الإسعاف الوطني</a></h6>
                        <h6 class="mb-1"><a href="{{ route('web.index') }}">www.nationalambulance.ae</a></h6>
                        <a href="{{ route('web.index') }}?launch=1"  class="default_btn launch_btn">Launch</a>
               
                    @endif
            </div>
            </div>
        </div>
    </div>
</section>
<script>
//     function countdown(e){

// // Set the date we're counting down to
// var countDownDate = new Date().getTime()+12*1000;

// // Update the count down every 1 second
// var x = setInterval(function() {

//   var distance = countDownDate - now;
//   // Get today's date and time
//   var now = new Date().getTime();

//   // Find the distance between now and the count down date

//   // Time calculations for days, hours, minutes and seconds
//   var days = Math.floor(distance / (1000 * 60 * 60 * 24));
//   var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//   var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
//   var seconds = Math.floor((distance % (1000 * 60)) / 1000);

//   // Display the result in the element with id="demo"
//   document.getElementById("countdown").innerHTML = (days&&(days + "d ")) + (hours&&(hours + "h ")
//   )+ (minutes&& (minutes + "m ")) + seconds + "s ";

//   // If the count down is finished, write some text
//   if (distance < 0) {
//     clearInterval(x);
//     document.getElementById("countdown").innerHTML = "Loading...";//EXPIRED
//     window.location.href="{{env('APP_URL')}}";
//   }
// }, 1000);
//     }
</script>

@endsection
