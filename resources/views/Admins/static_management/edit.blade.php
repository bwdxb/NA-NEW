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
                            <form method="post" action="{{ route('staticpage.update',$page->id) }}"
                                  enctype="multipart/form-data" name="forms" id="editPage" class="mt-5">
                                {{ csrf_field() }}
                                @method('PUT')
                                <input type="hidden" name="preview" value="" id="preview"/>
                                <div class="form-group">
                                    <div class="form-row">
                                        <label class="col-sm-2">Select Menu</label>
                                        <div class="col-sm-10"><select name="parent_id" id="parent_id" class="form-control" required>

                                                <option value="">Select Menu</option>
                                                @foreach($menus as $key=>$menu)
                                                    <option value="{{ $key }}"
                                                            @if($key==(old('parent_id')?old('parent_id'):$page->parent_id)) selected="selected"
                                                            @endif>{{ $menu }}</option>
                                                @endforeach
                                            </select>
                                            @error('parent_id')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>                                
    
                                <div class="form-group">
                                    <div class="form-row">
                                        <label class="col-sm-2">Title</label>
                                        <div class="col-sm-10"><input type="text" name="title" id="title"
                                                                      class="form-control"
                                                                      value="{{ old('title')?old('title'):$page->title }}" required>
                                                                      @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-row">
                                        <label class="col-sm-2">Title (Arabic)</label>
                                        <div class="col-sm-10"><input type="text" name="title_ar" id="title_ar"
                                                                      class="form-control"
                                                                      value="{{ old('title_ar')?old('title_ar'):$page->title_ar }}" required> @error('title_ar')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror</div>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <label class="col-sm-2">Sequence Number</label>
                                    <div class="col-sm-6"><input type="text" name="sequence_number" class="form-control"
                                                                 id="sequence_number"
                                                                 value="{{ old('sequence_number')?old('sequence_number'):$page->sequence_number }}" required> @error('sequence_number')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                                <br/>
                                <div class="row">
                                    <label class="col-sm-2">Upload Banner</label>
                                    <div class="col-sm-6">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">

                                                <img @if(isset($page->image))
                                                     src="{{ asset('public/uploads/cms/').'/'.(old('image')?old('image'):$page->image) }}"
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
                                @if($page->parent_id==4)
                                    <div class="row" id="service-img">
                                        <label class="col-sm-2">Upload Image</label>
                                        <div class="col-sm-6">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-new thumbnail"
                                                     style="width: 200px; height: 150px;">

                                                    <img @if(isset($page->banner))
                                                         src="{{ asset('public/uploads/cms/').'/'.(old('banner')?old('banner'):$page->banner) }}"
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
                     <input type="file" name="banner" class="default"/>
                  </span>

                                                </div>
                                            </div>

                                        </div>

                                        <br/>


                                    </div>

                                @endif
                                <div class="form-group">
                                    <div class="form-row">
                                        <label class="col-sm-2">Description</label>
                                        <div class="col-sm-10">
                                            <textarea class="description"
                                                      name="description">{{ old('description')?old('description'):$page->description }}</textarea>
                                                      @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-row">
                                        <label class="col-sm-2">Description (Arabic)</label>
                                        <div class="col-sm-10">
                                            <textarea class="description"
                                                      name="description_ar">{{ old('description_ar')?old('description_ar'):$page->description_ar }}</textarea>
                                                      @error('description_ar')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-5">
                                    <div class="form-row justify-content-end">
                                       <a href="{{ url()->previous()}}"  class="btn btn-primary"> Back</a>
                                        <a href="{{ route('staticpage.index') }}" class="btn btn-secondary">Cancel</a>
                                         <input type="button" class="btn btn-info" value="Preview "
                                               style="margin-right:15px;" id="preview-btn">
                                               
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
        <div id="preview-page-content" style="display:none">
        @if(\Session::has('preview_page'))
            {!!\Session::get('preview_page')!!}
        @endif
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
                integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>

        <script src="https://cdn.ckeditor.com/4.16.0/standard-all/ckeditor.js"></script>

        <script>
            @if(\Session::has('preview_page'))
           
            $().ready(function(){
                $('body').attr('style',"");
                $('#loader').remove();
                 var w = window.open();
            $(w.document.body).html($('#preview-page-content').html());
            $('#preview-page-content').html("");
            });
            @endif
            var public_url = window.location.origin ;
            CKEDITOR.replace('description', {
                allowedContent: true,
                height: 300,
                filebrowserUploadUrl: "{{ route('upload', ['_token' => csrf_token() ]) }}",
                filebrowserUploadMethod: 'form'
            });

            CKEDITOR.replace('description_ar', {
                allowedContent: true,
                height: 300,
                filebrowserUploadUrl: "{{ route('upload', ['_token' => csrf_token() ]) }}",
                filebrowserUploadMethod: 'form'
            });

            if ($('#parent_id').val() != 4) {
                $('#service-img').hide()
            }


            $('#parent_id').change(function () {
                // alert($(this).val());
                if ($(this).val() == 4) {
                    $('#service-img').show()
                } else {
                    $('#service-img').hide()
                }

            });
            $('#preview-btn').click(function () {
                $('#preview').val('PREVIEW');
                $('#editPage').submit();
            

            });
        </script>
    </section>


@endsection