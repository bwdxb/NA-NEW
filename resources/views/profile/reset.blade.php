@php
if(Session::get('role')=='ADMIN')
$extends = 'layouts.master';
else
$extends = 'layouts.employee_portal.master';
@endphp
@extends($extends)
@section('content')
<div class="container" style="margin-top: 100px;min-height:80vh;">
    {{--        <p class="text-danger text-black-50">id : {{$data->id}}</p>--}}
    <div class="row justify-content-center">
         @include('layouts.includes.breadcrumbs')
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <!-- @if(Session::has('message'))
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
            @endif -->
            <form method="POST" action="{{ route('user-profile.password.update') }}">
                @csrf

                <div class="form-group row">
                    <label for="email"
                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email"
                        class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{$data->email}}" required autocomplete="email"
                        autofocus readonly>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password"
                    class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror" name="password"
                        required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm"
                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control"
                        name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
@endsection
