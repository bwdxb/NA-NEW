@extends('layouts.master')
@php
      use app\Http\helper\Helper as Helper;
@endphp
@section('content')
<section class="wrapper"> 
<div class="row">
	<div class="col-sm-12">
		<section class="panel">
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6 mt-4">
            <h1 class="m-0 text-dark">Edit PMO Notice</h1>
         </div>
         
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
   <div class="container-fluid">
      <form method="post" action="{{ route('pmo_notice_board.update',$document->id)}}" enctype="multipart/form-data" name="forms" id="editPage" class="mt-5">
         {{csrf_field()}}
         @method('PUT')
   		<div class="row">
            <label class="col-sm-2">Title</label>
             <div class="col-sm-10"><input type="text" name="title"  class="form-control" id="title" value="{{$document->title}}">
             </div>
         </div>
         <br/>
         <div class="row">
            <label class="col-sm-2" for="">Cover Image</label>
            <div class="col-sm-6">
               <input type="file" name="cover_img" class="myfrm form-control">
               <img src="{{url('public/uploads/pmo/'.$document->cover_img)}}" height="50" width="50" />
               <info>Note: this one will be set as cover picture.</info>
            </div>
         </div>
         <br/>
         <div class="row">
            <label class="col-sm-2" for="">Banner Image</label>
            <div class="col-sm-6">
               <input type="file" name="banner_img" class="myfrm form-control">
               <img src="{{url('public/uploads/pmo/'.$document->banner_img)}}" height="50" width="50" />
               <info>Note: this one will be set as Banner picture.</info>
            </div>
         </div>
         <br>
         <div class="row">
            <label class="col-sm-2">Upload Documents</label>
            <div class="col-sm-6">
               <div class="input-group hdtuto control-group lst increment" >
                 <input type="file" name="filenames[]" onchange="validateUpload(this.value,this)" class="myfrm form-control">
                 <div class="input-group-btn">
                  <button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
                 </div>
               </div>
               <?php 
               if(!empty($documents))
               {
                for($i=0; $i<count($documents);$i++){?>
                  <div>
                     <a href="{{url('/public/uploads/pmo/'.$documents[$i]->document)}}" target="_blank" style="color:#0000FF">{{$documents[$i]->document}}</a>
                     <a onclick="deleteConfirmation({{$documents[$i]->id}})" class="btn btn-danger" title="Delete"><i class="text-white fa fa-ban fa-trash" aria-hidden="true"></i></a>
                  </div>
                  
                  <?php }} ?>
               <div class="clone hide">
                 <div class="hdtuto control-group lst input-group myclone" style= "margin-top:10px">
                  <input type="file" name="filenames[]"  onchange="validateUpload(this.value,this)" class="myfrm form-control">
                  <div class="input-group-btn"> 
                    <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
                  </div>
                 </div>
               </div>
            </div>            
           <br>
         </div>
         <br>
         <div class="form-group mt-5">
            <div class="form-row justify-content-end">           
               <a href="{{ url()->previous()}}"  class="btn btn-primary"> Back</a>
               <a href="{{url('/admin/pmo_notice_board')}}" class="btn btn-secondary">Cancel</a>
               <input type="submit" class="btn btn-primary" value="Update" style="margin-left:15px;">
            </div>            
         </div>
      </form>
   </div>
</section>
</section>		
	</div>
</div>
</section>
<script src="{{ asset('public/plugins/jquery/jquery.min.js')}}"></script>
<script type="text/javascript">
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
</script>
<script>
 function deleteConfirmation(id) {
    swal({
         title: "Are you sure?",
         text: "Are you sure ,you want to DELETE ?",
         type: "warning",
         showCancelButton: true,
         confirmButtonColor: "#069edb",
         confirmButtonText: "Yes, delete it!",
         closeOnConfirm: false,
            buttons: true,
         }).then(()=> {
         
        
         $.ajax({
                type: 'get',
                data: {
                '_method': 'get'
                },
                url: "/admin/pmo_notice_board/deletedoc/" +id,
                success: function(data) {
                swal({
                     title: " Success!",
                     text: "Document deleted successfully!",
                     type: "success",
                     confirmButtonColor: "#069edb",
                     //timer: 3000
                     }).then(()=> {
                     window.location.replace("{{ route('pmo_notice_board.update',$document->id)}}/edit");
                     });
                }
                });
         });
}
function validateUpload(file,thisd) {
         var ext = file.split(".");
          ext = ext[ext.length-1].toLowerCase();      
          var arrayExtensions = ["pdf"];

         if(arrayExtensions.lastIndexOf(ext) == -1){
            swal({
                  title: " Error!",
                  text: "Only PDF File type is allowed!",
                  type: "success",
                  confirmButtonColor: "#069edb",
                  //timer: 3000
               });
            $(thisd).val("");
         }

         var totalBytes = thisd.files[0].size;
         if(totalBytes > 1000000){
                     
            var _size = Math.floor(totalBytes/1000000);  
            if(_size>20)
            {
               swal({
                     title: " Error!",
                     text: "PDF size is too Large, Allowd Only 20MB!",
                     type: "success",
                     confirmButtonColor: "#069edb",
                     //timer: 3000
                     });
              $(thisd).val("");
            }
         }
    };
  </script>
@endsection