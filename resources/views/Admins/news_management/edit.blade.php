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
            <h1 class="m-0 text-dark">Add News</h1>
         </div>
        
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content mt-4">
   <div class="container-fluid">
      <form method="post" action="{{route('news.update',['id'=>$news->id])}}" enctype="multipart/form-data" id="editNews">
       {{csrf_field()}}
     @method('PUT')
     <input type="hidden" name="preview" value="" id="preview"/>

     <div class="form-group">
          
           <div class="row">
                <label class="col-sm-2">Select Lang </label>
                <div class="col-sm-10">
                  <select name="lang" id="lang" class="form-control" required>
                    <option selected="selected">Select Lang</option>
                    <option {{((old('lang')?old('lang'):$news->lang) == 'English') ? 'selected' : ''}}>English</option>
                    <option {{((old('lang')?old('lang'):$news->lang) == 'Arabic') ? 'selected' : ''}}>Arabic</option>
                </select>
              </div>
          </div>
          <br /> 
        <div class="row">
               <label class="col-sm-2">Select Category</label>
               <div class="col-sm-10"><select name="cat_id" id="cat_id" class="form-control" required>
            
          <option value="">Select Category</option>
          @foreach($news_category as $key=>$category) 
          <option value="{{$key}}" @if($key ==(old('cat_id')?old('cat_id'):$news->cat_id)) selected="selected" @endif>{{$category}}</option>
          @endforeach
          </select></div>
            </div>
           <br />
            <div class="row">
               <label class="col-sm-2">Title</label>
               <div class="col-sm-10"><input type="text" name="title" id="title" class="form-control"  value="{{old('title')?old('title'):$news->title}}" required></div>
            </div>
      <div class="row">
               <label class="col-sm-2">Alias</label>
               <div class="col-sm-10"><input type="text" name="alias" id="alias" class="form-control"  value="{{old('alias')?old('alias'):$news->alias}}" required></div>
            </div>
      <br>
      <div class="row">
               <label class="col-sm-2">Date</label>
                <div class="col-sm-9">
        
        <div class="input-group date" data-provide="datepicker">
        <input type="text" readonly="" class="form-control" name="news_date"  value="{{old('news_date')?old('news_date'):$news->news_date}}">
        <div class="input-group-addon">
          <span class="glyphicon glyphicon-th"></span>
        </div>
      </div>
        
                </div>
            </div>
      <br />
      <div class="row">
               <label class="col-sm-2">Video Link</label>
               <div class="col-sm-10"><input type="text" name="video" id="video" class="form-control"  value="{{old('video')?old('video'):$news->video}}"></div>
            </div>
      <br />
      <div class="row">
               <label class="col-sm-2">Short Description</label>
               <div class="col-sm-10"><textarea type="text" name="short_description" class="form-control" >{{old('short_description')?old('short_description'):$news->short_description}}</textarea></div>
               
            </div>
      <br />
      <div class="row">
        <label class="col-sm-2" for="">Cover Image</label>
        <div class="col-sm-6">
            <input type="file" name="cover_img" class="myfrm form-control">
            <img src="{{url('public/uploads/news/'.$news->cover_img)}}" height="50" width="50" />
            <info>Note: this one will be set as cover picture.</info>
          </div>
        </div>
      </div>
      <br />
      <div class="row">
        <label class="col-sm-2">Upload Image</label>
          <div class="col-sm-6">
          <?php          
            if($news->image){
              $images = json_decode($news->image);          
              $images = array_reverse($images);
            }          
          ?>        
          
          <div class="input-group hdtuto control-group lst increment" >
            <input type="file" name="filenames[]" class="myfrm form-control">

            <div class="input-group-btn"> 
            <button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
            </div>
          </div>
          <?php 
          if(!empty($images))
          {
          for($i=0; $i<count($images);$i++){?>
          <div class="hdtuto control-group lst input-group myclone" style= "margin-top:10px">
            
            <input type="file" name="filenames[]" class="myfrm form-control">
            <input type="hidden" name="image[]" value="{{$images[$i]}}" />
            <div class="input-group-btn"> 
              <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
            </div>
            <br />
            <img src="{{url('public/uploads/news/'.$images[$i])}}" height="50" width="50" />
            </div>
            <?php }} ?>
          <div class="clone hide">
            <div class="hdtuto control-group lst input-group myclone" style= "margin-top:10px">
            <input type="file" name="filenames[]" class="myfrm form-control">
            <div class="input-group-btn"> 
              <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
            </div>
            </div>
          </div>
        </div>
        
              <br>  
                 
            </div>
      <br />
      <div class="row">
               <label class="col-sm-2">Description</label>
               <div class="col-sm-10"><textarea type="text" name="description" class="form-control" id="description">{{old('description')?old('description'):$news->description}}</textarea></div>
               <div class="clearfix">
               </div>
            </div>
      <br>
            
            <div class="form-group text-center">
            <a href="{{ url()->previous()}}"  class="btn btn-primary"> Back</a>
               <a href="{{route('news.index')}}" class="btn btn-secondary">Cancel</a>
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
<script type="text/javascript">
  @if(\Session::has('preview_page'))
  $().ready(function(){
                $('body').attr('style',"");
                $('#loader').remove();
                 var w = window.open();
            $(w.document.body).html($('#preview-page-content').html());
            $('#preview-page-content').html("");
            });
          
           
   @endif
    $(document).ready(function() {
      $(".btn-success").click(function(){ 
          var lsthmtl = $(".clone").html();
          $(".increment").after(lsthmtl);
      });
	  
      $("body").on("click",".btn-danger",function(){ 
	  $(this).closest('.myclone').remove();
          //$(this).parents(".hdtuto control-group lst").remove();
		  
      });
      
    });
    $('#preview-btn').click(function () {
      
      $('#preview').val('PREVIEW');
 });
</script>
<script type="text/javascript" src="{{asset('public/admin/js/ckeditor/ckeditor.js')}}"></script>

<script>
    CKEDITOR.replace('description', {
	allowedContent:true,
      height: 300,
    filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form'
    });
  </script>

@endsection