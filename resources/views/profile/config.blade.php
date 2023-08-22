@extends('layouts.master')
@section('content')
<div class="container" style="margin-top: 100px">
    <div class="row justify-content-center">
     @include('layouts.includes.breadcrumbs') 
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Email Configuration') }}</div>

                <div class="card-body">
                  
            <form method="POST" action="{{ route('email-config') }}">
                @csrf

                <div class="form-group row">
                    <label for="MAIL_DRIVER"
                    class="col-md-4 col-form-label text-md-right">{{ __('MAIL_DRIVER') }}</label>

                    <div class="col-md-6">
                        <input id="MAIL_DRIVER" type="text"
                        class="form-control" name="MAIL_DRIVER"
                        value="{{env('MAIL_DRIVER')}}" required 
                        >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="MAIL_HOST"
                    class="col-md-4 col-form-label text-md-right">{{ __('MAIL_HOST') }}</label>

                    <div class="col-md-6">
                        <input id="MAIL_HOST" type="text"
                        class="form-control" name="MAIL_HOST"
                        value="{{env('MAIL_HOST')}}" required 
                        >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="MAIL_PORT"
                    class="col-md-4 col-form-label text-md-right">{{ __('MAIL_PORT') }}</label>

                    <div class="col-md-6">
                        <input id="MAIL_PORT" type="text"
                        class="form-control" name="MAIL_PORT"
                        value="{{env('MAIL_PORT')}}" required 
                        >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="MAIL_USERNAME"
                    class="col-md-4 col-form-label text-md-right">{{ __('MAIL_USERNAME') }}</label>

                    <div class="col-md-6">
                        <input id="MAIL_USERNAME" type="text"
                        class="form-control" name="MAIL_USERNAME"
                        value="{{env('MAIL_USERNAME')}}" required 
                        >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="MAIL_PASSWORD"
                    class="col-md-4 col-form-label text-md-right">{{ __('MAIL_PASSWORD') }}</label>

                    <div class="col-md-6">
                        <input id="MAIL_PASSWORD" type="text"
                        class="form-control" name="MAIL_PASSWORD"
                        value="{{env('MAIL_PASSWORD')}}" required 
                        >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="MAIL_ENCRYPTION"
                    class="col-md-4 col-form-label text-md-right">{{ __('MAIL_ENCRYPTION') }}</label>

                    <div class="col-md-6">
                        <input id="MAIL_ENCRYPTION" type="text"
                        class="form-control" name="MAIL_ENCRYPTION"
                        value="{{env('MAIL_ENCRYPTION')}}" required 
                        >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="MAIL_FROM"
                    class="col-md-4 col-form-label text-md-right">{{ __('MAIL_FROM') }}</label>

                    <div class="col-md-6">
                        <input id="MAIL_FROM" type="text"
                        class="form-control" name="MAIL_FROM"
                        value="{{env('MAIL_FROM')}}" required 
                        >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="MAIL_FROM_NAME"
                    class="col-md-4 col-form-label text-md-right">{{ __('MAIL_FROM_NAME') }}</label>

                    <div class="col-md-6">
                        <input id="MAIL_FROM_NAME" type="text"
                        class="form-control" name="MAIL_FROM_NAME"
                        value="{{env('MAIL_FROM_NAME')}}" required 
                        >
                    </div>
                </div>


                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Save Config') }}
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
