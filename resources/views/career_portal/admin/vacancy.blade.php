@extends('layouts.master')
<div id="loader" class="center" style="visibility: visible;display: none;"></div>
@section('header-ss')
<!-- plugin css -->
<link rel="stylesheet" href="{{asset('public/employee_portal/assets/plugins/@mdi/font/css/materialdesignicons.min.css')}}">
<!-- <link rel="stylesheet"
          href="{{asset('public/employee_portal/assets/plugins/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/start/jquery-ui.css"
          type="text/css" media="all"/> -->

<!-- Font Awsome CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<!-- common css -->
<!-- <link rel="stylesheet" href="{{asset('public/employee_portal/css/app.css')}}"> -->
<!-- <link rel="stylesheet" href="{{asset('public/employee_portal/css/animate.min.css')}}"> -->
<!-- end common css -->

<style>
    /* .disable {
            cursor: not-allowed;
            pointer-events: none;
        }
        .draggable {
            cursor: move;
            user-select: none;
        }
        .placeholder {
            background-color: #edf2f7;
            border: 2px dashed #cbd5e0;
        }

        .clone-list {
            border-top: 1px solid #ccc;
        }

        .clone-table {
            border-collapse: collapse;
            border: none;
        }

        .clone-table th, .clone-table td {
            border: 1px solid #ccc;
            border-top: none;
            padding: 0.5rem;
        }

        .dragging {
            background: #fff;
            border-top: 1px solid #ccc;
            z-index: 999;
        }
        .adminTable.table td, .adminTable.table th{vertical-align:top!important;}
        .table thead th, .table tbody td{white-space:nowrap;}
        .table tbody td{
            overflow: hidden;
            text-overflow: ellipsis;
            max-height: 70px;
            max-width: 100px;
        }
        ul{
        white-space: nowrap;
        max-width: 100px;
        overflow: hidden;
        text-overflow: ellipsis;
        display: inline-flex;
        list-style: none;
        padding: 0;
    } */
    .table tbody td .h3,
    .table tbody td h3 {
        font-size: inherit;
    }

    .adminAction .actionLink {
        margin: 0 2px;
    }

    .adminAction {
        display: revert;
    }

    .adminAction .actionLink {
        display: inline-flex;
    }

    td.ellipse-text {
        max-width: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
<!-- @stack('plugin-styles') -->
@endsection
@section('content')

<section class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="content-header w-100">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="mt-4">
                            <h1 class="m-0 text-dark">Job Vacancy</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <div class="content w-100">
                <div class="row align-items-center">
                    <div class="col-md-8 selectFilter">
                        <div class="form-group w-100">
                            <label>Search:</label>
                            <input type="text" id="myInput" class="form-control" placeholder="Search by job ID" />

                        </div>
                    </div>

                    <div class="col-md-4 text-right">
                        <!-- @if(!$config->status)
                                <a href="{{ route('config.career_status_button')}}" class="btn btn-success ">Enable Career</a>
                           
                            @else
                                <a href="{{ route('config.career_status_button')}}" class="btn btn-danger ">Disable Career</a>
                            @endif  -->
                        <a href="#mediaContentForm" class="btn btn-primary" onclick="(function(){$('#mediaContentForm').show()})()">
                            Add Job Vacancy
                        </a>
                    </div>
                </div>
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
                <div id="mediaContentForm" style="{{ isset($update)?'':'display:none;' }}">
                    <ul class="errorMessages"></ul>
                    <div class="row mt-5">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form class="addProductForm" action="{{ route('career-portal.admin.vacancy.create_or_update') }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="preview" value="" id="preview" />
                                        @if(!isset($duplicate))
                                        <input type="hidden" name="id" value="{{ old('id') ? old('id'): ( isset($update->id) ? $update->id : '') }}" class="form-control">
                                        <input type="hidden" name="op_type" value="{{ isset($update->id) ? 'update' : 'create' }}" class="form-control">
                                        @else
                                        <input type="hidden" name="op_type" value="create" class="form-control">
                                        @endif




                                        <div class="form_column">
                                            @if(!isset($duplicate))
                                            <h5>{{ isset($update)?"Update":"Add" }} Job Vacancy</h5>
                                            @else
                                            <h5>Add Job Vacancy</h5>

                                            @endif

                                            {{-- <div class="row" style="display: none;">--}}
                                            {{-- <div class="form-group col-md-12">--}}
                                            {{-- <div class="custom-file">--}}
                                            {{-- <label for="exampleFormControlFile1">Upload Logo *</label>--}}
                                            {{-- <input type="file" class="form-control-file"--}}
                                            {{-- id="exampleFormControlFile1"--}}
                                            {{-- name="logofile"--}}
                                            {{-- {{ isset($update)?'':'' }}>--}}
                                            {{-- </div>--}}
                                            {{-- </div>--}}
                                            {{-- </div>--}}
                                            <div class="row">
                                                <input type="hidden" name="bi_lang" id="bi_lang" value="{{ (old('bi_lang')) ? old('bi_lang'): (isset($update->bi_lang)?$update->bi_lang:'0') }}" class="form-control">
                                                <div class="form-group  form-check col">
                                                    <input type="checkbox" name="bi_lang_check" id="bi_lang_check" class="form-check-input" {{(old('bi_lang')) ? (old('bi_lang')==1?'checked':''): (isset($update->bi_lang)&&$update->bi_lang==1?'checked':'')}}>
                                                    {{" "}}<label class="form-check-label" for="bi_lang_check"> Check this box if this Job Vacancy is MultiLingual.</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Select Job Category</label>
                                                    <select name="job_category" id="cat_id" class="form-control">
                                                        <option disabled>Choose Category from
                                                            below
                                                        </option>
                                                        @foreach($categories as $category)
                                                        <option temp="{{(old('job_category') ? old('job_category'): (isset($update->job_category)?$update->job_category:'') )}}" value="{{$category->job_category}}" {{((old('job_category') ? old('job_category'): (isset($update->job_category)?$update->job_category:'') ) == $category->job_category) ?"selected":''}}>
                                                            {{$category->job_category}} ({{$category->job_category_ar}})
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('job_category')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col">
                                                    <label>Job title</label>
                                                    <input type="text" class="form-control" name="job_title" value="{{ (old('job_title')) ? old('job_title'): (isset($update->job_title)?$update->job_title:'') }}" required>
                                                    @error('job_title')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col ar" style="display: none;">
                                                    <label>Job title (Arabic)</label>
                                                    <input type="text" class="form-control" name="job_title_ar" value="{{ (old('job_title_ar')) ? old('job_title_ar'): (isset($update->job_title_ar)?$update->job_title_ar:'') }}">
                                                    @error('job_title_ar')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col">
                                                    <label>Job Description</label>
                                                    <textarea class="form-control" name="job_description" id="job_description">{{(old('job_description')) ? old('job_description'): (isset($update->job_description)?$update->job_description:'') }}</textarea>
                                                    @error('job_description')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col ar" style="display: none;">
                                                    <label>Job Description (Arabic)</label>
                                                    <textarea class="form-control" name="job_description_ar" id="job_description_ar">{{(old('job_description_ar')) ? old('job_description_ar'): (isset($update->job_description_ar)?$update->job_description_ar:'') }}</textarea>
                                                    @error('job_description_ar')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col">
                                                    <label>Job Requirement - Qualifications and Experience</label>
                                                    <textarea class="form-control" name="job_reqiurement" id="job_reqiurement">{{(old('job_reqiurement')) ? old('job_reqiurement'): (isset($update->job_reqiurement)?$update->job_reqiurement:'') }}</textarea>
                                                    @error('job_reqiurement')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col ar" style="display: none;">
                                                    <label>Job Requirement - Qualifications and Experience
                                                        (Arabic)</label>
                                                    <textarea class="form-control" name="job_reqiurement_ar" id="job_reqiurement_ar">{{(old('job_reqiurement_ar')) ? old('job_reqiurement_ar'): (isset($update->job_reqiurement_ar)?$update->job_reqiurement_ar:'') }}</textarea>
                                                    @error('job_reqiurement_ar')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col">
                                                    <label>Select Employment Type</label>
                                                    <select name="employment_type" id="employment_type" class="form-control">
                                                        <option selected disabled>Choose type from below
                                                        </option>
                                                        <option temp="{{(isset($update->employment_type)?$update->employment_type:'' )}}" value="Full-time" {{((old('employment_type') ? old('employment_type'): (isset($update->employment_type)?$update->employment_type:'' ))== "Full-time" )?"selected":''}}>Full-time
                                                        </option>
                                                        <option value="Part-time" {{((old('employment_type') ? old('employment_type'): (isset($update->employment_type)?$update->employment_type:'' ))== "Part-time") ?"selected":''}}>Part-time
                                                        </option>
                                                        <option value="Contract" {{((old('employment_type') ? old('employment_type'): (isset($update->employment_type)?$update->employment_type:'' ))== "Contract") ?"selected":''}}>Contract
                                                        </option>
                                                        <option value="Temporary" {{((old('employment_type') ? old('employment_type'): (isset($update->employment_type)?$update->employment_type:'' ))== "Temporary") ?"selected":''}}>Temporary
                                                        </option>
                                                        <option value="Volunteer" {{((old('employment_type') ? old('employment_type'): (isset($update->employment_type)?$update->employment_type:'' ))== "Volunteer") ?"selected":''}}>Volunteer
                                                        </option>
                                                        <option value="Internship" {{((old('employment_type') ? old('employment_type'): (isset($update->employment_type)?$update->employment_type:'' ))== "Internship") ?"selected":''}}>Internship
                                                        </option>
                                                    </select>
                                                    @error('employment_type')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col">
                                                    <label>Salary and Benefits</label>
                                                    <textarea class="form-control" name="salary_package" id="salary_package">{{(old('salary_package')) ? old('salary_package'): (isset($update->salary_package)?$update->salary_package:'') }}</textarea>
                                                    @error('salary_package')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="form-group col ar" style="display: none;">
                                                    <label>Salary and Benefits (Arabic)</label>
                                                    <textarea class="form-control" name="salary_package_ar" id="salary_package_ar">{{(old('salary_package_ar')) ? old('salary_package_ar'): (isset($update->salary_package_ar)?$update->salary_package_ar:'') }}</textarea>
                                                    @error('salary_package_ar')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col en">
                                                    <label>Department</label>
                                                    <input type="text" class="form-control" name="department" value="{{ (old('department')) ? old('department'): (isset($update->department)?$update->department:'') }}" required>
                                                    @error('department')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col ar" style="display: none;">
                                                    <label>Department (Arabic)</label>
                                                    <input type="text" class="form-control" name="department_ar" value="{{ (old('department_ar')) ? old('department_ar'): (isset($update->department_ar)?$update->department_ar:'') }}">
                                                    @error('department_ar')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col">
                                                    <label>Location</label>
                                                    <input type="text" class="form-control" name="location" value="{{ (old('location')) ? old('location'): (isset($update->location)?$update->location:'') }}" required>
                                                    @error('location')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col ar" style="display: none;">
                                                    <label>Location (Arabic)</label>
                                                    <input type="text" class="form-control" name="location_ar" value="{{ (old('location_ar')) ? old('location_ar'): (isset($update->location_ar)?$update->location_ar:'') }}">
                                                    @error('location_ar')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col">
                                                    <label>Closing Date</label>
                                                    <input type="date" class="form-control" name="vacancy_closing_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ (old('vacancy_closing_date')) ? old('vacancy_closing_date'): (isset($update->vacancy_closing_date)?$update->vacancy_closing_date:'') }}" required>
                                                    @error('vacancy_closing_date')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form_column ">
                                            <div class="row">
                                                <div class="btn_column form-group col-md-12 mt-3">
                                                    <a href="{{ url()->previous()}}" class="btn btn-primary mr-2"> Back</a>
                                                    <a href="{{url('/admin/career-portal/admin/vacancy')}}" class="btn btn-primary mr-2"> Cancel</a>
                                                    <input type="submit" class="btn btn-info mr-2" value="Preview" id="preview-btn" />
                                                    <button type="submit" class="btn btn-primary">
                                                        @if(!isset($duplicate))
                                                        {{ isset($update)?"Update":"Create" }}
                                                        @else
                                                        Create
                                                        @endif
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="row">--}}
                {{-- <div class="col-lg-12">--}}
                {{-- <div class="form-group">--}}
                {{-- <label>Search:</label>--}}
                {{-- <input type="text" id="myInput" class="form-control"--}}
                {{-- placeholder="Search for a keyword contains in document name or controll number"/>--}}

                {{-- </div>--}}
                {{-- </div>--}}
                <div class="row grid-margin mt-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped adminTable" id="table">
                                        <thead>
                                            <tr>
                                                {{--<th>#</th>--}}
                                                {{--<th>Logo</th>--}}
                                                <th>Job id</th>
                                                {{--<th>Multi-Lingual Support</th>--}}
                                                <th>Job category</th>
                                                <th>Job title</th>
                                                {{--<th>Job description</th>--}}
                                                {{--<th>Job reqiurement</th>--}}
                                                {{--<th>Employment Type</th>--}}
                                                {{--<th>Salary Package</th>--}}
                                                <th>Department</th>
                                                {{--<th>Location</th>--}}
                                                <th>Closing Date</th>
                                                <th>Status</th>
                                                {{--<th>Timestamps</th>--}}
                                                <th>Operations</th>
                                            </tr>
                                        </thead>
                                        <tbody id="myTable">
                                            @forelse($data as $d)
                                            <tr>
                                                {{--<td>{{$loop->iteration}}</td>--}}
                                                {{--<td><img src="{{ url($d->logo) }}" alt="Product Image"></td>--}}
                                                <td>{{ $d->job_id }}</td>
                                                {{--<td>
                                                        Available
                                                        @if($d->bi_lang == 1)
                                                            in both English & Arabic
                                                        @else
                                                            only in English
                                                        @endif
                                                    </td>--}}
                                                <td class="ellipse-text">{{ $d->job_category }}
                                                    @if($d->bi_lang == 1)
                                                    <br />
                                                    {{ $d->job_category_ar }}
                                                    @endif
                                                </td>
                                                <td class="ellipse-text">
                                                    {{ $d->job_title }}
                                                    @if($d->bi_lang == 1)
                                                    <br />
                                                    {{ $d->job_title_ar }}
                                                    @endif
                                                </td>
                                                {{--<td>
                                                        {!! $d->job_description !!}
                                                        @if($d->bi_lang == 1)
                                                            <br/>
                                                            {!! $d->job_description_ar !!}
                                                        @endif
                                                    </td>--}}
                                                {{--<td>
                                                        {!! $d->job_reqiurement !!}
                                                        @if($d->bi_lang == 1)
                                                            <br/>
                                                            {!! $d->job_reqiurement_ar !!}
                                                        @endif
                                                    </td>--}
                                                    {{--<td>
                                                        {{ $d->employment_type }}
                                                </td>--}}
                                                {{--<td>
                                                        {!! $d->salary_package !!}
                                                        @if($d->bi_lang == 1)
                                                            <br/>
                                                            {!! $d->salary_package_ar !!}
                                                        @endif
                                                    </td>--}}
                                                <td>
                                                    {{ $d->department }}
                                                    @if($d->bi_lang == 1)
                                                    <br />
                                                    {{ $d->department_ar }}
                                                    @endif
                                                </td>
                                                {{--<td>
                                                        {{ $d->location }}
                                                @if($d->bi_lang == 1)
                                                <br />
                                                {{ $d->location_ar }}
                                                @endif
                                                </td>--}}
                                                <td>{{\Carbon\Carbon::createFromFormat('Y-m-d', $d->vacancy_closing_date)->format('d-m-Y')}}</td>
                                                <td class="adminAction">
                                                    {{-- {{$d->status}}--}}
                                                    @if($d->status == 'active')
                                                    <a class="btn btn-primary" url="{{ route('career-portal.admin.vacancy.update.status',['id'=>$d->id,'status'=>'inactive']) }}" onclick='confirmation($(this).attr("url"),"Are you sure ,you want to do this action ?","Status has changed Successfully.")'>
                                                        <span class="mdi mdi-lock-outline"></span>
                                                    </a>
                                                    <span class="text-success"> Active </span>
                                                    @else
                                                    <!-- <p class="text-danger"> InActive </p> -->
                                                    <a class="btn btn-primary" url="{{ route('career-portal.admin.vacancy.update.status',['id'=>$d->id,'status'=>'active']) }}" onclick='confirmation($(this).attr("url"),"Are you sure ,you want to do this action ?","Status has changed Successfully.")'>
                                                        <span class="fa fa-unlock"></span>
                                                    </a>
                                                    <span class="text-danger"> InActive </span>
                                                    @endif
                                                </td>

                                                {{--<td>
                                                        Created at : {{$d->created_at}} <br />
                                                Last Updated at : {{$d->updated_at}}
                                                </td>--}}
                                                <td class="adminAction" style="min-width:105px;">
                                                    <a href="{{route('career-portal.admin.vacancy.revert.history',$d->id)}}" class="actionLink bg-primary"><i class="text-white fas fa-history" aria-hidden="true"></i></a>

                                                    <a url="{{ route('career-portal.admin.vacancy.delete',['id'=>$d->id]) }}" type="button" onclick=deleteConfirmation("{{ route('career-portal.admin.vacancy.delete',['id'=>$d->id]) }}") class="actionLink redBg" title="Delete">
                                                        <span class="mdi mdi-delete"></span>
                                                    </a>
                                                    <a href="{{ route('career-portal.admin.vacancy.update.view',['id'=>$d->id]) }}" type="button" class="actionLink" title="Edit">
                                                        <span class="mdi mdi-pencil-box-outline"></span>
                                                    </a>
                                                    <a href="{{ route('career-portal.admin.vacancy.duplicate.view',['id'=>$d->id]) }}" type="button" class="actionLink" title="Duplicate">
                                                        <span class="mdi mdi-content-duplicate"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td class="text-center" colspan="9" style="text-align: center;">
                                                    <b>No Records Found!!!</b>
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                </div>
                <!----- Add Form----->

                {{-- </div>--}}
            </div>
        </div>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script> -->
<script type="text/javascript" src="{{asset('public/admin/js/ckeditor/ckeditor.js')}}"></script>
<div id="preview-page-content" style="display:none">
    @if(\Session::has('preview_page'))
    {!!\Session::get('preview_page')!!}
    @endif
</div>
<script>
    @if(\Session::has('preview_page'))
    var w = window.open();
    $('#loader').remove();
    $(w.document.body).html($('#preview-page-content').html());
    $(w.document.body).find('#loader').remove();

    $('#preview-page-content').remove();
    $().ready(function() {
        $('body').attr('style', "");
    });
    @endif
    CKEDITOR.replace('job_description', {
        allowedContent: true,
        height: 300,
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
    CKEDITOR.replace('job_reqiurement', {
        allowedContent: true,
        height: 300,
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
    CKEDITOR.replace('salary_package', {
        allowedContent: true,
        height: 300,
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });

    CKEDITOR.replace('job_description_ar', {
        allowedContent: true,
        height: 300,
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
    CKEDITOR.replace('job_reqiurement_ar', {
        allowedContent: true,
        height: 300,
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
    CKEDITOR.replace('salary_package_ar', {
        allowedContent: true,
        height: 300,
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
    $('#preview-btn').click(function() {

        $('#preview').val('PREVIEW');
    });
</script>
<script>
    $(document).ready(function() {

        if ($("#bi_lang_check").attr('checked') === 'checked') {
            $('.ar').show()
            $("#bi_lang").prop('value', "1")
        } else {
            $('.ar').hide()
            $("#bi_lang").prop('value', "0")
        }
        $("#bi_lang_check").click(function() {
            if (this.checked) {
                $('.ar').show()
                $("#bi_lang").prop('value', "1")
            } else {
                $('.ar').hide()
                $("#bi_lang").prop('value', "0")
            }
        });

        $("#myInput").on("keyup", function() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        });
    });


    var public_url = $('meta[name="base_url"]').attr('content');


    function deleteConfirmation(url) {
        swal({
            title: "Are you sure?",
            text: "Are you sure ,you want to DELETE ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#069edb",
            confirmButtonText: "Yes, delete it!",
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
                        swal({
                            title: " Success!",
                            text: "Vacancy deleted successfully!",
                            type: "success",
                            confirmButtonColor: "#069edb",
                            //timer: 3000
                        }).then(() => {
                            window.location.replace("{{url('/admin/career-portal/admin/vacancy')}}");
                        });
                    }
                });
            }

        });
    }

    function confirmation(url, msg, successMsg) {

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
                $('#loader').show();
                $.ajax({
                    type: 'get',
                    data: {
                        '_method': 'get'
                    },
                    url: url,
                    success: function(data) {
                        swal("Success", successMsg, "success").then(() => {
                            window.location.replace("{{url('/admin/career-portal/admin/vacancy')}}");
                        });
                        $('#loader').hide();
                    }
                });
            }

        });
    }
</script>
@endsection