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
            <h1 class="m-0 text-dark">Create FAQs</h1>
         </div>
        
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content mt-4">
   <div class="container-fluid">
      <form method="post" action="{{ route('public_awareness.store_awareness_faq',$id)}}" enctype="multipart/form-data" name="addFaq" id="addFaq">
	  <input type="hidden" name="awareness_id" value="{{$id}}" />
       {{csrf_field()}}
         <div class="form-group">
			<br />
			<div class="row">
               <label class="col-sm-2">Question and Answer</label>
                <div class="col-sm-10">
					<div class="input-group hdtuto control-group lst increment" >
					  <input type="text" name="question[]" class="myfrm form-control" placeholder="Question">
					  <br />
					  <input type="text" name="question_ar[]" class="myfrm form-control" placeholder="Question (ar)">
					  <br />
					  <textarea name="answer[]" class="myfrm form-control" placeholder="Answer"></textarea>
					  
					  <br />
					  <textarea name="answer_ar[]" class="myfrm form-control" placeholder="Answer (ar)"></textarea>
					  
					  <div class="input-group-btn"> 
						<button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
					  </div>
					</div>
					<div class="clone hide">
					  <div class="hdtuto control-group lst input-group myclone" style= "margin-top:10px">
						<input type="text" name="question[]" class="myfrm form-control" placeholder="Question">
						<br />
						<input type="text" name="question_ar[]" class="myfrm form-control" placeholder="Question (ar)">
						<br />
						<textarea name="answer[]" class="myfrm form-control" placeholder="Answer"></textarea>
						<br />
						<textarea name="answer_ar[]" class="myfrm form-control" placeholder="Answer (ar)"></textarea>
						<div class="input-group-btn"> 
						  <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
						</div>
					  </div>
					</div>
				</div>
				
              <br>  
                 
            </div>
			
			<br />
			
            <div class="form-group text-center">
			<a href="{{ url()->previous()}}"  class="btn btn-primary"> Back</a>
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


@endsection