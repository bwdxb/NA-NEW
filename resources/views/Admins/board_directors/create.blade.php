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
                     <h1 class="m-0 text-dark">Add Board Director</h1>
                  </div>

               </div>
               <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
         </div>
         <!-- /.content-header -->
         <section class="content mt-4">
            <div class="container-fluid">
               <form method="post" action="{{ route('board_director.store')}}" enctype="multipart/form-data" name="addBoardDirector" id="addBoardDirector">
                 {{csrf_field()}}
                 <input type="hidden" name="preview" value="" id="preview"/>

                 <div class="form-group">


                  <div class="row">
                     <label class="col-sm-2">Name</label>
                     <div class="col-sm-10"><input type="text" name="name" id="name" class="form-control" value="{{old('name')}}"></div>
                  </div>
                  <div class="row">
                     <label class="col-sm-2">Name (Arabic)</label>
                     <div class="col-sm-10"><input type="text" name="name_ar" id="name_ar" class="form-control" value="{{old('name_ar')}}"></div>
                  </div>
                  <br>

                  <div class="row">
                     <label class="col-sm-2">Designation</label>
                     <div class="col-sm-10"><input type="text" name="designation" id="designation" class="form-control" value="{{old('designation')}}"></div>
                  </div>
                  <div class="row">
                     <label class="col-sm-2">Designation (Arabic)</label>
                     <div class="col-sm-10"><input type="text" name="designation_ar" id="designation_ar" class="form-control"  value="{{old('designation_ar')}}"></div>
                  </div>

                  <br />
                  <div class="row">
                     <label class="col-sm-2">Institute</label>
                     <div class="col-sm-10"><input type="text" name="institute" id="institute" class="form-control"  value="{{old('institute')}}"></div>
                  </div>
                  <div class="row">
                     <label class="col-sm-2">Institute (Arabic)</label>
                     <div class="col-sm-10"><input type="text" name="institute_ar" id="institute_ar" class="form-control"  value="{{old('institute_ar')}}" ></div>
                  </div>
                  <br />
                  <div class="row">
                     <label class="col-sm-2">Sequence</label>
                     <div class="col-sm-10"><input type="text" name="sequence_number" id="sequence_number" class="form-control" value="{{old('sequence_number')}}"></div>
                  </div>

                  <br />
                  <div class="row">
                     <label class="col-sm-2">Upload Image</label>
                     <div class="col-sm-6">
                      <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                          <img src="{{old('image')?old('image'):'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image'}}" alt="" />
                       </div>
                       <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                       <div>
                          <span class="btn btn-white btn-file">
                            <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                            <input type="file" name="image" class="default" />
                         </span>

                      </div>
                   </div>
                </div>

                <br>  

             </div>
             <br />
             <div class="row">
               <label class="col-sm-2">Description</label>
               <div class="col-sm-10"><textarea type="text" name="description" class="form-control" id="description">{{old('description')}}</textarea></div>
               <div class="clearfix">
               </div>
            </div>
            <div class="row">
               <label class="col-sm-2">Description (Arabic)</label>
               <div class="col-sm-10"><textarea type="text" name="description_ar" class="form-control" id="description_ar">{{old('description_ar')}}</textarea></div>
               <div class="clearfix">
               </div>
            </div>
            <br>
            
            <div class="form-group text-center">
            <a href="{{ url()->previous()}}"  class="btn btn-primary"> Back</a>
               <a href="{{url('/admin/board_director')}}" class="btn btn-secondary">Cancel</a>
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
   <script src="{{ asset('public/plugins/jquery/jquery.min.js')}}"></script>

<script type="text/javascript" src="{{asset('public/admin/js/ckeditor/ckeditor.js')}}"></script>

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
  CKEDITOR.replace('description', {
     allowedContent:true,
     height: 300,
     filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
     filebrowserUploadMethod: 'form'
  });
  CKEDITOR.replace('description_ar', {
     allowedContent:true,
     height: 300,
     filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
     filebrowserUploadMethod: 'form'
  });
  $('#preview-btn').click(function () {
      
      $('#preview').val('PREVIEW');
 });
</script>

@endsection