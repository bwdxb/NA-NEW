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
               <form method="post" action="{{ route('video_gallery.update',$video_gallery->id)}}" enctype="multipart/form-data" name="forms" id="editPage" class="mt-5">
                  {{csrf_field()}}
                  @method('PUT')
                  <div class="row">
                     <label class="col-sm-2">Select Lang </label>
                     <div class="col-sm-10">
                        <select name="lang" id="lang" class="form-control">
                         <option selected="selected">Select Lang</option>
                         <option {{(isset($video_gallery) && $video_gallery->lang == 'English') ? 'selected' : ''}}>English</option>
                         <option {{(isset($video_gallery) && $video_gallery->lang == 'Arabic') ? 'selected' : ''}}>Arabic</option>
                      </select>
                   </div>
                </div>
                <div class="row">
                  <label class="col-sm-2">Select Category</label>
                  <div class="col-sm-10">
                     <select name="cat_id[]" id="cat_id" class="form-control" multiple>
                      <option value="">Select Category</option>
                      @foreach($video_category as $category) 
                      <option {{(isset($video_gallery) && in_array($category->id,$video_gallery->cat_id) )? 'selected' : ''}} value="{{$category->id}}">{{$category->name}} ({{$category->name_ar}})</option>
                      @endforeach
                   </select>
                </div>
             </div>
             <br>

             <div class="form-group">
               <div class="form-row">
                  <label class="col-sm-2">Title</label>
                  <div class="col-sm-10"><input type="text" name="title" id="title"class="form-control" value="{{$video_gallery->title}}"></div>
               </div>
               <!-- <div class="form-row">
                  <label class="col-sm-2">Title (Arabic)</label>
                  <div class="col-sm-10"><input type="text" name="title_ar" id="title_ar"class="form-control" value="{{$video_gallery->title_ar}}"></div>
               </div> -->
            </div>
            <br />
            <div class="row">
               <label class="col-sm-2">Date</label>
               <div class="col-sm-9">

                 <div class="input-group date" data-date-format="yyyy-mm-dd" data-provide="datepicker">
                    <input type="text" readonly="" class="form-control" name="video_date" value="{{$video_gallery->video_date}}">
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-th"></span>
                   </div>
                </div>

             </div>
          </div>
          <br>
          <div class="row">
            <label class="col-sm-2">Youtube Link</label>
            <div class="col-sm-10"><input type="text" name="youtube_link"  class="form-control" id="youtube_link" value="{{$video_gallery->youtube_link}}">
            </div>
            <!-- <br>
            <div class="row">
               <label class="col-sm-2">Youtube Link Arabic Version</label>
               <div class="col-sm-10"><input type="text" name="youtube_link_ar"  class="form-control" id="youtube_link_ar" value="{{$video_gallery->youtube_link_ar}}">
               </div>

            </div> -->
            <br />


            <div class="form-group mt-5">
               <div class="form-group text-center">
                  <a href="{{ url()->previous()}}"  class="btn btn-primary"> Back</a>
                  <a href="{{route('video_gallery.index')}}" class="btn btn-secondary">Cancel</a>
                 <input type="submit" class="btn btn-primary" value="Update" style="margin-left:15px;">
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
   var public_url = window.location.origin+'/';
   CKEDITOR.replace('description', {
     allowedContent:true,
     height: 300,
     filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
     filebrowserUploadMethod: 'form'
  });
</script>
</section>


@endsection
