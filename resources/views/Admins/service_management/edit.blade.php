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
                                    <h1 class="m-0 text-dark">Edit Static Page</h1>
                                </div>

                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->
                    <section class="content">
                        <div class="container-fluid">
                            <form method="post" action="{{ route('staticpage.update',$page->id)}}"
                                  enctype="multipart/form-data" name="forms" id="editPage" class="mt-5">
                                {{csrf_field()}}
                                @method('PUT')
                                <div class="row">
                                    <label class="col-sm-2">Select Menu</label>
                                    <div class="col-sm-10"><select name="parent_id" id="parent_id" class="form-control">

                                            <option value="">Select Menu</option>
                                            @foreach($menus as $key=>$menu)
                                                <option value="{{$key}}"
                                                        @if($key ==$page->parent_id) selected="selected" @endif>{{$menu}}</option>
                                            @endforeach
                                        </select></div>
                                </div>
                                <br>

                                <div class="form-group">
                                    <div class="form-row">
                                        <label class="col-sm-2">Title</label>
                                        <div class="col-sm-10"><input type="text" name="title" id="title"
                                                                      class="form-control" value="{{$page->title}}">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <label class="col-sm-2">Sequence Number</label>
                                    <div class="col-sm-6"><input type="text" name="sequence_number" class="form-control"
                                                                 id="sequence_number"
                                                                 value="{{$page->sequence_number}}">
                                    </div>

                                </div>
                                <br/>
                                <div class="row">
                                    <label class="col-sm-2">Upload Banner</label>
                                    <div class="col-sm-6">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">

                                                <img @if(isset($page->image))
                                                     src="{{asset('public/uploads/cms/').'/'.($page->image)}}"
                                                     @else
                                                     src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
                                                     @endif
                                                     alt="news_image"/>

                                            </div>
                                            <div class="fileupload-preview fileupload-exists thumbnail"
                                                 style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                            <div>
                     <span class="btn btn-white btn-file">
                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                        <input type="file" name="image" class="default"/>
                     </span>

                                            </div>
                                        </div>

                                    </div>

                                    <br/>


                                </div>
                                <div class="form-group">
                                    <div class="form-row">
                                        <label class="col-sm-2">Description</label>
                                        <div class="col-sm-10">
                                            <textarea class="description"
                                                      name="description">{{$page->description}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-5">
                                    <div class="form-row justify-content-end">
                                        <a href="{{ url()->previous()}}"  class="btn btn-primary"> Back</a>
                                        <a href="{{route('staticpage.index')}}" class="btn btn-secondary">Cancel</a>
                                        <input type="submit" class="btn btn-primary" value="Update"
                                               style="margin-left:15px;">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </section>


            </div>
        </div>
        <script src="https://cdn.ckeditor.com/4.16.0/standard-all/ckeditor.js"></script>

        <script>
            var public_url = window.location.origin + '/national-ambulance';
            CKEDITOR.replace('description', {
                allowedContent: true,
                height: 300,
                filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
        </script>
    </section>


@endsection
