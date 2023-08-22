@extends('layouts.master')
@php
use app\Http\helper\Helper as Helper;
    $document_classification = Helper::getDocumentClassification();
    $document_department = Helper::getDocumentDepartment();
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
            <h1 class="m-0 text-dark">Add Document Library</h1>
         </div>
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content mt-4">
   <div class="container-fluid">
      <form method="post" action="{{ route('document_library.store')}}" enctype="multipart/form-data" name="addPage" id="addPage">
       {{csrf_field()}}
      
          <div class="row">
               <label class="col-sm-2">Document Type</label>
               <div class="col-sm-10">
			   	<select name="document_type_id" id="document_type_id" class="form-control">
					  
					<option value="">Select Document Type</option>
					@foreach($document_type as $key=>$type) 
					<option @if($key ==old('document_type_id')) selected="selected" @endif value="{{$key}}">{{$type}}</option>
					@endforeach
					</select>
               <a href="{{route('document_library.type.create')}}" class="">Create Document Type</a>
				</div>
            </div>

			<br>
			
			
           
            <div class="row">
               <label class="col-sm-2">Controlled Number</label>
               <div class="col-sm-10"><input type="text" name="controlled_number" id="controlled_number" class="form-control" value="{{old('controlled_number')}}"></div>
            </div>
			<br />
			<div class="row">
               <label class="col-sm-2">Document Name</label>
                <div class="col-sm-10"><input type="text" name="document_name"  class="form-control" id="document_name" value="{{old('document_name')}}">
                </div>
                 
            </div>
			<br />
			<div class="row">
               <label class="col-sm-2">Version Number</label>
                <div class="col-sm-10"><input type="text" name="version_number"  class="form-control" id="version_number" value="{{old('version_number')}}">
                </div>
                 
            </div>
			<br />
			<div class="row">
               <label class="col-sm-2">Department Owner</label>
                <div class="col-sm-10">
                   <!-- <input type="text" name="department_owner"  class="form-control" id="department_owner" value="{{old('department_owner')}}"> -->
                   <select name="department_owner" id="department_owner" class="form-control" required>
                     <option  value="">Select Department</option>
                     @foreach($document_department as $key=>$docDept)

                     <option @if(old('department_owner')== $docDept->department) selected @endif value="{{$docDept->department}}">{{$docDept->department}}</option>
                     @endforeach
                     <!-- <option @if(old('department_owner')=='Clinical Service') selected @endif value="Clinical Service">Clinical Service</option>
                     <option @if(old('department_owner')=='Corporate') selected @endif value="Corporate">Corporate</option>
                     <option @if(old('department_owner')=='Finance') selected @endif value="Finance">Finance</option>
                     <option @if(old('department_owner')=='Human Resources') selected @endif value="Human Resources">Human Resources</option>
                     <option @if(old('department_owner')=='IT') selected @endif value="IT">IT</option>
                     <option @if(old('department_owner')=='Operation') selected @endif value="Operation">Operation</option>
                     <option @if(old('department_owner')=='Supply Chain') selected @endif value="Supply Chain">Supply Chain</option> -->
					   </select>
                  <a href="{{route('document_library.department.create')}}" class="">Create Department</a>
                </div>
                 
            </div>
			<br />
			<div class="row">
               <label class="col-sm-2">Data Classification</label>
                <div class="col-sm-10">
				<select name="data_classification" id="data_classification" class="form-control">
					  
					<option value="">Select Classification</option>
               @foreach($document_classification as $key=>$docClass)
                     <option @if(old('data_classification')==$docClass->classification) selected @endif value="{{$docClass->classification}}">{{$docClass->classification}}</option>

                     @endforeach
					<!-- <option value="Public">Public</option>
					<option value="Restricted">Restricted</option>
					<option value="Confidential">Confidential</option> -->
					
					</select>
               <a href="{{route('document_library.classification.create')}}" class="">Create Document Classification</a>

                </div>
                 
            </div>
			<br />
			<br />
			<div class="row">
               <label class="col-sm-2">Date</label>
                <div class="col-sm-9">
				
				
            <select name="year" class="form-control" autocomplete="off" required>
				<option value="">{{__('Year')}}</option>
				<?php  $currentYear = date('Y'); 
				foreach (range(2010, $currentYear) as $value) {?>
					<option value="<?php echo $value?>" @if($value ==Request::get('year')) selected="selected" @endif><?php echo $value?></option>   

				<?php }
				?>

			</select>
         <select name="month" class="form-control" autocomplete="off" required>
				<option value="">{{__('Month')}}</option>
				<?php
				
				for ($i = 0; $i < 12; $i++) {
					$time = strtotime(sprintf('%d months', $i),strtotime("01/01/2021"));   
					$label = date('F', $time);   
					$value = date('n', $time);?>

					<option  value='<?php echo $value?>' @if($value ==Request::get('month')) selected="selected" @endif>{{__($label)}}</option>

				<?php }?>
			</select>
				
			</div>
			<!-- <div class="row">
               <label class="col-sm-2">Date</label>
                <div class="col-sm-9">
				
				<div class="input-group date" data-date-format="yyyy-mm-dd" data-provide="datepicker">
				<input type="text" readonly="" class="form-control" name="document_date">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-th"></span>
				</div>
			</div> -->
				
                </div>
            </div>
			<div class="row">
               <label class="col-sm-2">Upload File</label>
                <div class="col-sm-6">
					<div class="fileupload fileupload-new" data-provides="fileupload">
						<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
							<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
						</div>
						<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
						<div>
							<span class="btn btn-white btn-file">
								<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select file</span>
								<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
								<input type="file" name="document_file" class="default" />
							</span>
							
						</div>
					</div>
				</div>
				
              <br>  
                 
            </div>
			<br>
            
			
            <div class="form-group text-center">
            <a href="{{ url()->previous()}}"  class="btn btn-primary"> Back</a>
               <a href="/admin/document_library"  class="btn btn-primary"> Cancel</a>
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