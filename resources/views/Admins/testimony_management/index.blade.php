@extends('layouts.master')
@php
use app\Http\helper\Helper as Helper;
$services = Helper::all_services();
@endphp
@section('content')
<!-- Content Header (Page header) -->
<style type="text/css">
    tr,
    th,
    td {
        min-width: 150px;
    }

    td.ellipse-text {
        max-width: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
<section class="wrapper">
    <!-- page start-->

    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6 mt-4">
                                <h1 class="m-0 text-dark">Testimony Management</h1>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <div class="content">

                    <div class="container-fluid">
                        <form method="post" action="{{route('manage_testimonial.filter')}}">
                            @csrf

                            <div class="d-block">
                                <div class="row">
                                    <div class="col-lg-3" style="margin-right:4px">
                                        <input class="form-control " value="" name="filter" type="text" placeholder="Search..." aria-label="Search">
                                    </div>

                                    <!-- 
                                        <div class="col-lg-3" style="margin-right:4px">
                                            <input class="form-control form-control-navbar "
                                                   value="{{Request::get('mobile')}}" name="mobile" type="text"
                                                   placeholder="Search by phone" aria-label="Search">
                                        </div> -->

                                    <div class="col-lg-1 ">
                                        <button class="btn btn-primary " type="submit" style="margin-top:2px;">
                                            Search
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="float-sm-right mt-4 mb-3">
                            <a href="#storyForm" class="btn btn-primary " style="margin-bottom:5px;" onclick="(function(){$('#storyForm').show()})()">
                                Add Testimony
                            </a>
                        </div>

                        @if(Session::has('message'))
                        <div class="alert {{ Session::get('alert-class', 'alert-success') }}" style="margin-top: 15px;">
                            <div style="display:inline-block" id="">
                                {{ Session::get('message') }}
                            </div>
                        </div>
                        @endif
                        @if(Session::has('error'))
                        <div class="alert {{ Session::get('alert-class', 'alert-danger') }}" style="margin-top: 15px;">
                            <div style="display:inline-block" id="">
                                {{ Session::get('error') }}
                            </div>
                        </div>
                        @endif
                        <br />
                        <br />
                        <div id="storyForm" style="{{ isset($update)?'':'display:none;' }}">
                            <div class="row mt-5">
                                <div class="col-md-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="addProductForm" action="{{ route('manage_testimonial.createOrUpdate') }}" method="post" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="preview" value="" id="preview" />

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

                                                <ul class="errorMessages text-danger" style="list-style:unset;background-color: bisque;">
                                                </ul>
                                                <div class="form_column">
                                                    <h5>Add Testimonial</h5>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>Service category</label>
                                                            <select name="category" class="form-control">
                                                                <option value="">Select Service Category</option>
                                                                @foreach($services as $service)
                                                                <option value="{{$service->title}}" {{(isset($update->category) && $update->category == $service->title?'selected':'')}}>{{$service->title}}</option>
                                                                @endforeach

                                                            </select>
                                                            @error('category')
                                                            <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Client Name</label>
                                                            <input type="text" name="client_name" value="{{ trim((old('client_name')) ? old('client_name'): (isset($update->client_name)?$update->client_name:'')) }}" class="form-control">
                                                            @error('client_name')
                                                            <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Client Name (Ar)</label>
                                                            <input type="text" name="client_name_ar" value="{{ trim((old('client_name_ar')) ? old('client_name_ar'): (isset($update->client_name_ar)?$update->client_name_ar:'')) }}" class="form-control">
                                                            @error('client_name_ar')
                                                            <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Title</label>
                                                            <input type="text" name="title" {{--                                                               value="{{trim(old('title')?old('title'):(isset($update->title)?$update->title:''))}}"--}} value="{{ trim((old('title')) ? old('title'): (isset($update->title)?$update->title:'')) }}" class="form-control">
                                                            @error('title')
                                                            <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Title (Ar)</label>
                                                            <input type="text" name="title_ar" {{--                                                               value="{{trim(old('title_ar')?old('title_ar'):(isset($update->title_ar)?$update->title_ar:''))}}"--}} value="{{ trim((old('title_ar')) ? old('title_ar'): (isset($update->title_ar)?$update->title_ar:'')) }}" class="form-control">
                                                            @error('title_ar')
                                                            <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <input type="hidden" name="filter" value="{{trim(old('filter')?old('filter'):'')}}" class="form-control">
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label>The Testimony</label>
                                                            <textarea class="form-control" rows="4" name="testimonial" maxlength="300" required>{{ trim((old('testimonial')) ? old('testimonial'): (isset($update->testimonial)?$update->testimonial:'')) }}</textarea>
                                                            @error('testimonial')
                                                            <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label>The Testimony (Ar)</label>
                                                            <textarea class="form-control" rows="4" name="testimonial_ar" maxlength="300" required>{{ trim((old('testimonial_ar')) ? old('testimonial_ar'): (isset($update->testimonial_ar)?$update->testimonial_ar:'')) }}</textarea>
                                                            @error('testimonial_ar')
                                                            <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form_column">
                                                    <div class="row">
                                                        <a href="{{ url()->previous()}}" class="btn btn-primary"> Back</a>
                                                        <a href="" class="btn btn-secondary">Cancel</a>
                                                        <div class="btn_column form-group col-md-12 mt-3">
                                                            <input type="submit" class="btn btn-info" value="Preview " style="margin-right:15px;" id="preview-btn">

                                                            <button type="submit" class="default_btn">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped mt-5">
                            <tr>
                                <th style="width:50px;">S.No</th>
                                <!-- <th>Category</th>
                                    <th>Client Name</th>
                                    <th>Client Name (Ar)</th> -->
                                <th>Title</th>
                                <th>Title (Ar)</th>
                                <th>Testimonial</th>
                                <th>Testimonial (Ar)</th>
                                <!-- <th>Status</th> -->
                                <!-- <th colspan="2">Action</th> -->
                                <th>Status</th>

                            </tr>

                            @forelse ($data as $key=>$d)
                            <tr>

                                <td>{{($data->perPage() * ($data->currentPage() - 1))+ ($key+1)}}</td>
                                <!-- <td>{{ $d->category }}</td>
                                        <td>{{$d->client_name}}</td>
                                        <td>{{$d->client_name_ar}}</td> -->
                                <td>{{$d->title}}</td>
                                <td>{{$d->title_ar}}</td>
                                <td class="ellipse-text ">{{$d->testimonial}}</td>
                                <td class="ellipse-text ">{{$d->testimonial_ar}}</td>
                                <!-- <td>{{$d->status}}</td> -->
                                <!-- <td>
                                            Created at : {{ \Carbon\Carbon::parse($d->created_at)->diffForHumans() }}
                                            <br/>
                                            Last Updated at
                                            : {{ \Carbon\Carbon::parse($d->updated_at)->diffForHumans() }}
                                        </td> -->

                                <td class="user_action">
                                    <!-- Current Status : -->
                                    @if($d->status == 'active')
                                    <p class="text-success">{{$d->status}}</p>
                                    @else
                                    <p class="text-danger">{{$d->status}}</p>
                                    @endif
                                    @php
                                    $toStatus = ($d->status == 'active') ? 'inactive' : 'active'
                                    @endphp

                                   
                                    <!--    <a href="{{ route('user.show',$d->id)}}" class="btn btn-success" ><i class="fa fa-eye" aria-hidden="true"></i></a>-->

                                    {{-- <a onclick="statefunction('{{$d->id}}')"--}}
                                    <a href="{{ route('manage_testimonial.update',$d->id)}}" class="btn btn-info" title="Edit" style="color:white;">
                                        <i class="text-white fa fa-edit fa-edit" aria-hidden="true"></i>
                                    </a>
                                    <a url="{{ route('manage_testimonial.update.status',$d->id)}}" onclick="confirmation($(this).attr('url'))" title="update status to {{$toStatus}}" class="btn btn-success">
                                        @if($d->status == 'active')
                                        <i class="text-white fa fa-unlock" aria-hidden="true"></i>
                                        @else
                                        <i class="text-white fa fa-lock" aria-hidden="true"></i>
                                        @endif
                                    </a>
                                    <a href="{{ route('manage_testimonial.delete',$d->id)}}" class="btn btn-danger" title="Delete" style="color:white;">
                                        <i class="text-white fa fa-ban fa-trash" aria-hidden="true"></i>
                                    </a>

                                </td>


                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" style="text-align: center;">
                                    <b>
                                        No Records...
                                    </b>
                                </td>
                            </tr>
                            @endforelse


                        </table>
                    </div>
                </div>
                {{ $data->links() }}

            </section>
        </div>
    </div>
</section>
<div id="preview-page-content" style="display:none">
    @if(\Session::has('preview_page'))
    {!!\Session::get('preview_page')!!}
    @endif
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


@endsection
@section('script')

<script>
    @if(\Session::has('preview_page'))
    var w = window.open();
    var HTMLContent = $('#preview-page-content');
    HTMLContent.remove();
    $(w.document.body).html(HTMLContent.html());
    @endif

    $('#preview-btn').click(function() {

        $('#preview').val('PREVIEW');
    });

    function confirmation(url, msg = "Are u sure. you want to change the status?", successMsg = "You have successfully changed the status.") {
        swal({
            title: "Are you sure?",
            text: msg,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#069edb",
            confirmButtonText: "Yes",
            closeOnConfirm: false,
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {

            if (willDelete) {
                $.ajax({
                    type: 'get',
                    data: {
                        '_method': 'get'
                    },
                    url: url,
                    success: function(data) {
                        swal("Success", successMsg, "success").then(() => {
                            window.location.replace("{{url('/admin/manage-testimonial-info')}}");
                        });
                    }
                });
            }

        });
    }

    function statefunction(id) {
        swal({
            title: "Are you sure?",
            text: "You want to perform this action!",
            type: "warning",
            showCancelButton: true,
            cancelButtonClass: 'btn-danger',
            confirmButtonText: 'Yes,perform it',
            cancelButtonText: "Cancel",
            closeOnConfirm: false,
            closeOnCancel: true,
            buttons: true,
        }).then((isConfirm) => {
            if (isConfirm) {
                jQuery.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    type: 'get',
                    url: "{{url('/admin/user/status')}}/" + id,
                    success: function(data) {
                        if (data == 1) {
                            var status_user = 'unblocked';
                        } else {
                            var status_user = 'blocked';
                        }
                        swal({
                            title: "Done!",
                            text: " successfully!",
                            type: "success",
                            confirmButtonColor: "#069edb",
                        }).then(() => {
                            location.reload();
                        });
                    }
                });
            } else {
                window.location.replace("{{route('user.index')}}");
            }
        });
    }
</script>
@endsection