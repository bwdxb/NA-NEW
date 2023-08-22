
@php
if(Session::get('role')=='ADMIN')
$extends = 'layouts.master';
else
$extends = 'layouts.employee_portal.master';
@endphp
@extends($extends)
@push('plugin-styles')
<style>
body {
    margin-top: 20px;
    color: #1a202c;
    text-align: left;
    background-color: #e2e8f0;
}

.main-body {
    padding: 15px;
}

.card {
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0, 0, 0, .125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm > .col, .gutters-sm > [class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}

.mb-3, .my-3 {
    margin-bottom: 1rem !important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}

.h-100 {
    height: 100% !important;
}

.shadow-none {
    box-shadow: none !important;
}
#main-content .container{padding-top:10%;}
</style>
@endpush

@section('content')
<div class="container"  style="{{$data->role_id!=3?'width:100%':''}}">
    <div class="main-body" >
        <div class="row">
            @include('layouts.includes.breadcrumbs')
        </div>
        <div id="display-div" class="row gutters-sm mt-4">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                       <!-- <div class="d-flex flex-column align-items-center text-center"> -->
                        <div class="flex-column align-items-center text-center">
                            @if($data->image) <!-- 1153.jpeg  -->
                            <img src="{{asset($data->image)}}" alt="Admin"
                            class="rounded-circle" width="150">
                            @else
                            <img src="{{ 'https://ui-avatars.com/api/?name='.$data->first_name.' '.$data->last_name }}" class="rounded-circle" width="150"
                            alt="profile image">
                            @endif

                            <div class="mt-3">
                                <h4>{{$data->first_name}} {{$data->last_name}}</h4>
                                <p class="navyBlue mb-1 mt-5">
                                    @if($data->designation)Designation <b>{{$data->designation}}</b> @endif
                                </p>
                                <p class="text-muted font-size-sm">
                                    @if($data->state){{$data->state}}, @endif @if($data->city){{$data->city}}
                                    ,@endif @if($data->country){{$data->country}}@endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="m-0">Full Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{$data->first_name}} {{$data->last_name}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="m-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{$data->email}}
                            </div>
                        </div>
                        <hr>
                        <!-- <div class="row">
                            <div class="col-sm-3">
                                <h6 class="m-0">Mobile</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{$data->mobile}}
                            </div>
                        </div>
                        <hr> -->
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="m-0">Designation</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{$data->designation}}
                            </div>
                        </div>
                        <hr>
                        <!-- <div class="row">
                            <div class="col-sm-3">
                                <h6 class="m-0">Date of birth</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{$data->date_of_birth}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="m-0">Country</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{$data->country}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="m-0">City</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{$data->city}}
                            </div>
                        </div>
                        <hr> -->
                        <!-- <div class="row">
                            <div class="col-sm-3">
                                <h6 class="m-0">State</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{$data->state}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="m-0">Zip code</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{$data->zip_code}}
                            </div>
                        </div>
                        <hr> -->
                        {{--                            <div class="row">--}}
                            {{--                                <div class="col-sm-12">--}}
                                {{--                                    <a class="btn btn-info " target="__blank"--}}
                                {{--                                       href="https://www.bootdey.com/snippets/view/profile-edit-data-and-skills">Edit</a>--}}
                            {{--                                </div>--}}
                        {{--                            </div>--}}
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <a class="btn navyblueBtn text-white" target="__blank" onclick="updateDiv()">
                    Edit
                </a>
            </div>
        </div>
        <form method="post" action="{{route('user-profile.update')}}" enctype="multipart/form-data"
        class="row gutters-sm" id="update-div"
        style="display: none">
        @csrf
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body p-5">
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
                                <div class="d-flex flex-column align-items-center text-center mt-4">
                                    {{--                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin"--}}
                                    {{--                                     class="rounded-circle" width="150">--}}
                                    {{--                                <img src="{{ 'https://ui-avatars.com/api/?name='.session('LoggedUser.first_name') }}"--}}
                                    {{--                                     alt="profile image" style="width:100%;height:100%;">--}}
                                    {{--                                <div class="mt-3">--}}
                                        {{--                                    <button type="button" class="btn btn-outline-primary">Change Profile Image</button>--}}
                                    {{--                                </div>--}}

                                    Update Profile Picture
                                    @if($data->image) <!-- 1153.jpeg  -->
                                    <img src="{{asset($data->image)}}" alt="Admin"
                                    class="rounded-circle propic-img" width="150">
                                    @else
                                    <img src="{{ 'https://ui-avatars.com/api/?name='.$data->first_name.' '.$data->last_name }}" class="rounded-circle propic-img" width="150" 
                                    alt="profile image">
                                    @endif



                                    {{--                                <div class="row">--}}
                                        {{--                                    <label class="col-sm-2"></label>--}}
                                        {{--                                    <div class="col-sm-6">--}}
                                            {{--                                        <div class="fileupload fileupload-new" data-provides="fileupload">--}}
                                                {{--                                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">--}}
                                                    {{--                                                --}}

                                                {{--                                            </div>--}}
                                                {{--                                            <div class="fileupload-preview fileupload-exists thumbnail"--}}
                                                {{--                                                 style="max-width: 200px; max-height: 150px; line-height: 20px;">--}}

                                            {{--                                            </div>--}}
                                            {{--                                            <input class="form-control" type="file", name="pro-pic">--}}
                                        {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <br/>--}}
                                {{--                                </div>--}}

                                <p><input type="file"  accept="image/*" name="propic" id="file"  onchange="loadFile(event)" style="display: none;"></p>
                                <p><label for="file" class="navyBlue" style="cursor: pointer;">Upload Profile Image</label></p>
                                <p><img id="output" width="200" /></p>
                            </div>
                            <!-- <input class="form-control" type="file" , name="propic">

                            <div class="fileupload-preview fileupload-exists thumbnail mb-5"
                                 style="max-width: 200px; max-height: 150px; line-height: 20px;">

                             </div> -->
                             
                         </div>
                     </div>
                 </div>
                 <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">

                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-4 text-secondary">
                                    <input type="text" name="first_name" class="form-control"
                                    value="{{$data->first_name}}">
                                </div>
                                <div class="col-sm-4 text-secondary">
                                    <input type="text" name="last_name" class="form-control"
                                    value="{{$data->last_name}}">
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <h6 class="mb-0 form-label">Email</h6>
                                </div>
                                <div class="col-sm-8 text-secondary">
                                    <input type="text" name="email" class="form-control" value="{{$data->email}}" readonly>
                                </div>
                            </div>
                            <hr>
                            <!-- <div class="row mb-3">
                                <div class="col-sm-4">
                                    <h6 class="mb-0">Mobile</h6>
                                </div>
                                <div class="col-sm-8 text-secondary">
                                    <input type="text" name="mobile" class="form-control" value="{{$data->mobile}}">
                                </div>
                            </div>
                            <hr> -->
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <h6 class="mb-0">Designation</h6>
                                </div>
                                <div class="col-sm-8 text-secondary">
                                    <input type="text" maxlength="255" name="designation" class="form-control" value="{{$data->designation}}">
                                </div>
                            </div>
                            <hr>
                            <!-- <div class="row mb-3">
                                <div class="col-sm-4">
                                    <h6 class="mb-0">Date of birth</h6>
                                </div>
                                <div class="col-sm-8 text-secondary">
                                    <input type="text" name="date_of_birth" class="form-control"
                                    value="{{$data->date_of_birth}}">
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <h6 class="mb-0">Country</h6>
                                </div>
                                <div class="col-sm-8 text-secondary">
                                    <input type="text" name="country" class="form-control"
                                    value="{{$data->country}}">
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <h6 class="mb-0">City</h6>
                                </div>
                                <div class="col-sm-8 text-secondary">
                                    <input type="text" name="city" class="form-control" value="{{$data->city}}">
                                </div>
                            </div>
                            <hr> -->
                            <!-- <div class="row mb-3">
                                <div class="col-sm-4">
                                    <h6 class="mb-0">State</h6>
                                </div>
                                <div class="col-sm-8 text-secondary">
                                    <input type="text" name="state" class="form-control" value="{{$data->state}}">
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <h6 class="mb-0">Zip code</h6>
                                </div>
                                <div class="col-sm-8 text-secondary">
                                    <input type="text" name="zip_code" class="form-control"
                                    value="{{$data->zip_code}}">
                                </div>
                            </div>
                            <hr> -->
                            {{--                            <div class="row">--}}
                                {{--                                <div class="col-sm-3"></div>--}}
                                {{--                                <div class="col-sm-9 text-secondary">--}}
                                    {{--                                    <input type="button" class="btn navyblueBtn text-white px-4" value="Save Changes">--}}
                                {{--                                </div>--}}
                            {{--                            </div>--}}
                        </div>
                    </div>

                </div>
                <div class="col-md-1">
                    {{--                    <a class="btn navyblueBtn text-secondary" target="__blank"--}}
                    {{--                       href="https://www.bootdey.com/snippets/view/profile-edit-data-and-skills">--}}
                    {{--                        Edit--}}
                {{--                    </a>--}}

                <input type="submit" class="btn navyblueBtn text-white px-4" value="Save Changes">
            </div>
        </form>
    </div>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- <script src="{{asset('public/api-routes/todo-api-routes.js')}}"></script> -->
<script>
    // Delete Todo record
    function updateDiv() {
        $("#display-div").hide()
        
        $("#update-div").show()
    }

    var loadFile = function(event) {
        var image = document.getElementById('output');
        $(".propic-img").hide()
        image.src = URL.createObjectURL(event.target.files[0]);
    };


</script>