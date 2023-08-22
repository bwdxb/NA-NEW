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
            <h1 class="m-0 text-dark">Edit Contact Info</h1>
         </div>
         <div class="col-sm-3 mt-4">
         </div>
         <div class="col-sm-3 mt-4">
            <a href="{{route('contact.history')}}" class="btn btn-info"> Show History </a>
         </div>
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content mt-4">
   <div class="container-fluid">
   @if(Session::has('message'))
		  <div class="alert {{ Session::get('alert-class', 'alert-success') }}" style="margin-top: 15px;" >
			<div style="display:inline-block" id="">
			  {{ Session::get('message') }}
			</div>
		  </div>
		@endif 
		@if(Session::has('error'))
		  <div class="alert {{ Session::get('alert-class', 'alert-danger') }}" style="margin-top: 15px;" >
			<div style="display:inline-block" id="">
			  {{ Session::get('error') }}
			</div>
		  </div>
		@endif 
      <form method="post" action="{{ route('contact.update')}}" enctype="multipart/form-data" name="addPage" id="addPage">
       {{csrf_field()}}
       <input type="hidden" name="preview" value="" id="preview"/>

      <input type="hidden" name="id" value="1" />
			<br>
		
            <div class="row">
               <label class="col-sm-2">Description</label>
               <div class="col-sm-10"><textarea type="text" name="description" class="form-control" id="description">{{old('description')?old('description'):$contact->description}}</textarea></div>
               <div class="clearfix">
               </div>
            </div>
          <div class="row">
               <label class="col-sm-2">Description (Arabic)</label>
               <div class="col-sm-10"><textarea type="text" name="description_ar" class="form-control" id="description_ar">{{old('description_ar')?old('description_ar'):$contact->description_ar}}</textarea></div>
               <div class="clearfix">
               </div>
            </div>
			<br>
   
            <div class="form-group text-center">
            <a href="{{ url()->previous()}}"  class="btn btn-primary"> Back</a>
                                        <a href="" class="btn btn-secondary">Cancel</a>
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
<script src="https://cdn.ckeditor.com/4.16.0/standard-all/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
   @if(\Session::has('preview_page'))
   
       
      $().ready(function(){     var w = window.open();
       $('#loader').remove();
      $(w.document.body).html($('#preview-page-content').html());
      $('#preview-page-content').html(""); 
       $('#preview-page-content').remove();
            $('.FeedbackContent').remove();
            $('.footer').remove();
                $('body').attr('style',"");
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