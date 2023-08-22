@extends('layouts.app_employee')

@section('content')
<section class="pageBanner"
style="background-image: url({{url('public/images/login-bg.jpg') }})">
    <div class="container loginForm" >
        <div class="row justify-content-center">
            <div class="loginBox">
                <div class="card" >
                    <div class="card-header" style="text-align:center; font-size:24px;">{{ config('app.name', 'National Ambulance') }} Employee Portal</div>

                    <div class="card-body">
                        @if(Session::has('error'))
                        <div class="alert {{ Session::get('alert-class', 'alert-danger') }}" style="margin-top: 15px;" >
                            <div style="display:inline-block" id="">
                            {{ Session::get('message') }}
                            </div>
                            <a href="#" class="close" data-dismiss="alert" aria-label="close" style="display:inline-block">&times;</a>
                        </div>
                        @endif
                        <form method="POST" action="{{ route('employee-portal.auth') }}" id="loginForm" class="login_form">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="form-field">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="form-label text-md-right">{{ __('Password') }}</label>

                                <div class="form-field">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                 <label class="form-label"></label>
                                 <div class="form-field">
                                    <div class="form-check form-check-flat">
                                        <label class="form-check-label sr">
                                            <input type="checkbox" name="remember" id="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                 </div>
                            </div>

                            <div class="form-group row mb-0">
                                 <label class="form-label"></label>
                                 <div class="form-field">
                                    <button type="submit" class="btn navyblueBtn">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="mr-2" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
