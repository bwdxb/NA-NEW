@extends('layouts.master')
@section('content')
<section class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6 mt-4">
                                <h1 class="m-0 text-dark">Edit Career Info</h1>
                            </div>
                            <div class="col-sm-3 mt-4">
                            </div>
                            <div class="col-sm-3 mt-4">
                                <a href="{{route('manage-career-info.history',$data->id)}}" class="btn btn-info"> History </a>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->
                <section class="content mt-4">
                    <div class="container-fluid">
                        @if(Session::has('success'))
                        <div class="alert {{ Session::get('alert-class', 'alert-success') }}" style="margin-top: 15px;">
                            <div style="display:inline-block" id="">
                                {{ Session::get('success') }}
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

                        <form method="post" action="{{ route('cms.manage_career.update') }}" enctype="multipart/form-data" name="addPage" id="addPage">
                            {{ csrf_field() }}
                            <input type="hidden" name="preview" value="" id="preview" />
                            <input type="hidden" name="id" value="{{ $data->id }}" />
                            <br>
                            <div class="row">

                                <br />
                                <label class="col-sm-2">Upload Banner Video</label>
                                <div class="col-sm-10 pl-5">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                            <video width="100%" height="100%" autoplay muted loop>
                                                <source @if(isset($data->video))
                                                src="{{asset(old('video')?old('video'):($data->video?$data->video:'public/career_portal/videos/homepage-video.mp4'))}}"
                                                @else
                                                src="public/career_portal/videos/homepage-video.mp4"
                                                @endif
                                                type="video/mp4"/>
                                            </video>
                                        </div>
                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                        <div>
                                            <span class="btn btn-white btn-file">
                                                <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select
                                                    video</span>
                                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                <input type="file" name="video" class="default" accept="video/mp4" />
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2">Career Banner Content</label>
                                <div class="col-sm-10">
                                    <div class="col-sm-10">
                                        <textarea type="text" name="intro" class="custom_editor form-control" id="banner_content_textarea">{{ old('intro')?old('intro'):$data->intro }}</textarea>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2">Career Banner Content (Arabic)</label>
                                <div class="col-sm-10">
                                    <div class="col-sm-10">
                                        <textarea type="text" name="intro_ar" class="custom_editor form-control" id="banner_content_ar_textarea">{{ old('intro_ar')?old('intro_ar'):$data->intro_ar }}</textarea>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <label class="col-sm-2">Career Info Content</label>
                                <div class="col-sm-10">
                                    <div class="col-sm-10">
                                        <textarea type="text" name="concl" class="custom_editor form-control" id="info_content_textarea">{{ old('concl')?old('concl'):$data->concl }}</textarea>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2">Career Info Content (Arabic)</label>
                                <div class="col-sm-10">
                                    <div class="col-sm-10">
                                        <textarea type="text" name="concl_ar" class="custom_editor form-control" id="info_content_ar_textarea">{{ old('concl_ar')?old('concl_ar'):$data->concl_ar }}</textarea>
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                            </div>
                            <br />

                            <div class="form-group text-center">
                                <a href="{{ url()->previous()}}" class="btn btn-primary"> Back</a>
                                <a href="" class="btn btn-secondary">Cancel</a>
                                <input type="submit" class="btn btn-info" value="Preview " style="margin-right:15px;" id="preview-btn">

                                <input type="submit" class="btn btn-primary" value="Save">
                            </div>
                        </form>
                    </div>
                </section>
            </section>
        </div>
    </div>
</section>
<div id="preview-page-content" style="display:none">
    @if(\Session::has('preview_page'))
    {!!\Session::get('preview_page')!!}
    @endif</div>
<script src="https://cdn.ckeditor.com/4.16.0/standard-all/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    @if(\Session::has('preview_page'))
    //         var w = window.open();
    //   $(w.document.body).html($('#preview-page-content').html());
    //   $('#preview-page-content').html("");
    $().ready(function() {
        $('body').attr('style', "");
        $('#loader').remove();
        var w = window.open();
        $(w.document.body).html($('#preview-page-content').html());
        $('#preview-page-content').html("");
    });
    @endif
    let textareas = $(".custom_editor").each(function() {
        let t_id = this.id;
        console.log("textarea id : " + t_id);

        CKEDITOR.replace(t_id, {
            allowedContent: true,
            height: 300,
            filebrowserUploadUrl: "{{ route('upload', ['_token' => csrf_token() ]) }}",
            filebrowserUploadMethod: 'form'
        });
    });
    $('#preview-btn').click(function() {
        // alert();
        $('#preview').val('PREVIEW');
        // $('#editPage').submit();


    });
    // console.log(textareas.join());
</script>

@endsection