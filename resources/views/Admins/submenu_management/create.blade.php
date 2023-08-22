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
                                    <h1 class="m-0 text-dark">Add Static Page</h1>
                                </div>
                                <!-- /.col -->
                            <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href=" {{ url('/admin')}} ">Dashboard</a></li>
            </ol>
         </div> -->
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->
                    <section class="content mt-4">
                        <div class="container-fluid">
                            <form method="post" action="{{ route('submenu.store')}}" enctype="multipart/form-data"
                                  name="addPage" id="addPage">
                                {{csrf_field()}}
                                <input type="hidden" name="preview" value="" id="preview"/>

                                <div class="row">
                                    <label class="col-sm-2">Select Menu</label>
                                    <div class="col-sm-10">
                                        <select name="main_id" id="main_id" class="form-control"
                                                onchange="getSubmenu(this.value,'','{{ route("page.getSubmenu") }}');" @if(old('main_id')) onload="getSubmenu(this.value,'','{{ route("page.getSubmenu") }}');" @endif required  value="{{old('main_id')}}">

                                            <option value="">Select Menu</option>
                                            @foreach($menus as $key=>$menu)
                                                <option value="{{$key}}" {{($key==old('main_id'))? "selected":"" }} >{{$menu}}</option>
                                            @endforeach
                                        </select></div>
                                </div>
                                <br>
                                <div class="row">
                                    <label class="col-sm-2">Select Parent Menu</label>
                                    <div class="col-sm-10">
                                        <select name="parent_id" id="submenu_id" class="form-control" value="{{old('parent_id')}}" required>

                                            <option value="">Select Parent Menu</option>

                                        </select></div>
                                </div>
                                <br>


                                <div class="row">
                                    <label class="col-sm-2">Title</label>
                                    <div class="col-sm-10"><input type="text" name="title" id="title"
                                                                  class="form-control" value="{{old('title')}}"></div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2">Title (Arabic)</label>
                                    <div class="col-sm-10"><input type="text" name="title_ar" id="title_ar"
                                                                  class="form-control"
                                                                  value="{{ old('title_ar') }}"></div>
                                </div>
                                <br/>
                                <div class="row">
                                    <label class="col-sm-2">Upload Banner</label>
                                    <div class="col-sm-6">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="{{old('description_ar')?old('description_ar'):'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image'}}"
                                                     alt=""/>
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

                                    <br>

                                </div>
                                <br>
                                <div class="row">
                                    <label class="col-sm-2">Description</label>
                                    <div class="col-sm-10"><textarea type="text" name="description" class="form-control"
                                                                     id="description">{{old('description')?old('description'):""}}</textarea></div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2">Description (Arabic)</label>
                                    <div class="col-sm-10"><textarea type="text" name="description_ar"
                                                                     class="form-control"
                                                                     id="description_ar">{{old('description_ar')?old('description_ar'):""}}</textarea></div>
                                    <div class="clearfix">
                                    </div>
                                </div>
                                <br>


                                <div class="form-group text-center">
                                <a href="{{ url()->previous()}}"  class="btn btn-primary"> Back</a>
                                   <a href="{{route('submenu.index')}}" class="btn btn-secondary">Cancel</a>
                                <input type="submit" class="btn btn-info" value="Preview "
                                               style="margin-right:15px;" id="preview-btn">
                
                                <input type="submit" class="btn btn-primary" value="Save">
                                </div>
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
      @endif
   </div>
    <script type="text/javascript" src="{{asset('public/admin/js/ckeditor/ckeditor.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        @if(\Session::has('preview_page'))
            var w = window.open();
            $(w.document.body).html($('#preview-page-content').html());
            getSubmenu({{old('main_id')}},'','{{ route("page.getSubmenu") }}');
           $(document).ready(function(){
            $('#preview-page-content').remove();
            $('#submenu_id').val({{old('parent_id')}}).change();
           })
           
   @endif
        var public_url = window.location.origin;
        CKEDITOR.replace('description', {
            allowedContent: true,
            height: 300,
            filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });

        CKEDITOR.replace('description_ar', {
            allowedContent: true,
            height: 300,
            filebrowserUploadUrl: "{{ route('upload', ['_token' => csrf_token() ]) }}",
            filebrowserUploadMethod: 'form'
        });
        $('#preview-btn').click(function () {
      
             $('#preview').val('PREVIEW');
        });
    </script>
@endsection