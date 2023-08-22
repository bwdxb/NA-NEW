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
            <h1 class="m-0 text-dark">Add Screen</h1>
         </div>
         <!-- /.col -->
         
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content mt-4">
   <div class="container-fluid">
      <form method="post" action="{{ route('screen.store')}}" id="addScreenFrom" enctype="multipart/form-data">
       {{csrf_field()}}
      
         <div class="form-group">

            <div class="row">
               <label class="col-sm-2">Page Name</label>
               <div class="col-sm-6"><input type="text"  maxlength="25" name="page_name" id="page_name" class="form-control" value="{{old('page_name')}}"></div>
            </div>
			<br />
			<div class="row">
               <label class="col-sm-2">Page Url</label>
               <div class="col-sm-6"><input type="text"   name="page_url" id="page_url" class="form-control" value="{{old('page_url')}}"></div>
            </div>
			<br />
			<div class="row">
               <label class="col-sm-2">Label</label>
               <div class="col-sm-6"><input type="text"  maxlength="25" name="label" id="label" class="form-control" value="{{old('label')}}"></div>
            </div>
			<br />
			<div class="row">
               <label class="col-sm-2">Page Code</label>
               <div class="col-sm-6"><input type="text"  maxlength="25" name="page_code" id="page_code" class="form-control" value="{{old('page_code')}}">
			   <span style="font-size:10px;">(Like: VW_USER, CR_USER, ED_USER, DE_USER)</span>
			   </div>
            </div>
			<br />
			<div class="row">
               <label class="col-sm-2">Module</label>
               <div class="col-sm-6"><input type="text"  maxlength="25" name="module" id="module" class="form-control" value="{{old('module')}}"></div>
            </div>
			<br />
			<div class="row">
               <label class="col-sm-2">Show In Menu</label>
               <div class="col-sm-6"><input type="radio" name="show_menu" value="1" checked> Yes
                                     <input type="radio" name="show_menu" value="0"> No</div>
            </div>
            <br>

              <div class="form-group text-center">
                 <a href="{{ url()->previous()}}"  class="btn btn-primary"> Back</a>
               <a href="{{url('/admin/manage-screen')}}" class="btn btn-secondary ">Cancel</a>
               <input type="submit" class="btn btn-primary" value="Add">
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

@section('script')
 <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Form Validations</title>
    

@endsection