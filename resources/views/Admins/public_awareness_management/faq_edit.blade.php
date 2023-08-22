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
      <form method="post" action="{{ route('public_awareness.update_awareness_faq',$faq[0]->id)}}" enctype="multipart/form-data" name="addFaq" id="addFaq">
       {{csrf_field()}}
         <div class="form-group">
			<br />
			<div class="row">
               <label class="col-sm-2">Question</label>
               <div class="col-sm-10"><input type="text" name="question" id="question" class="form-control"  value="{{$faq[0]->question}}"></div>
            </div>
			<br />
			<div class="row">
               <label class="col-sm-2">Question (ar)</label>
               <div class="col-sm-10"><input type="text" name="question_ar" id="question_ar" class="form-control"  value="{{$faq[0]->question_ar}}"></div>
            </div>
			<br />
			<div class="row">
               <label class="col-sm-2">Answer</label>
               <div class="col-sm-10"><textarea name="answer" id="answer" class="form-control">{{$faq[0]->answer}}</textarea></div>
            </div>
			<br />
			<div class="row">
               <label class="col-sm-2">Answer (ar)</label>
               <div class="col-sm-10"><textarea name="answer_ar" id="answer_ar" class="form-control">{{$faq[0]->answer_ar}}</textarea></div>
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



@endsection