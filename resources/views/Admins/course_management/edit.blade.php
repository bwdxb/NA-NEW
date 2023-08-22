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
						<h1 class="m-0 text-dark">Edit Course</h1>
					 </div>
					
				  </div>
				  <!-- /.row -->
			   </div>
			   <!-- /.container-fluid -->
			</div>
<!-- /.content-header -->
<section class="content mt-4">
   <div class="container-fluid">
      <form method="post" action="{{route('course.update',['id'=>$course->id])}}" enctype="multipart/form-data" class="form-horizontal" >
       {{csrf_field()}}
	   @method('PUT')
      
         <div class="form-group">

         <!-- <div class="row">
               <label class="col-sm-2">Upload File</label>
                <div class="col-sm-6">
					<div class="fileupload fileupload-new" data-provides="fileupload">
						<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
						
						<a href="{{url('public/uploads/course/'.$course->logo)}}" target="_blank" style="color:#0000FF">{{$course->document_file}}</a>
								
							</div>
						<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
						<div>
							<span class="btn btn-white btn-file">
								<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
								<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
								<input type="file" name="logo" class="default" />
							</span>
							
						</div>
					</div>
					
				</div>
		
            </div>
          <br /> -->
          <div class="row">
                                                    <input type="hidden" name="bi_lang" id="bi_lang"
                                                           value="{{ (old('bi_lang')) ? old('bi_lang'): (isset($course->bi_lang)?$course->bi_lang:'0') }}"
                                                           class="form-control">
                                                    <div class="form-group  form-check col">
                                                        <input type="checkbox" name="bi_lang_check" id="bi_lang_check"
                                                        class="form-check-input" {{(old('bi_lang')) ? (old('bi_lang')==1?'checked':''): (isset($course->bi_lang)&&$course->bi_lang==1?'checked':'')}}>
                                                          {{" "}}<label class="form-check-label" for="bi_lang_check"> Check this box if this Job Vacancy is MultiLingual.</label>
                                                    </div>
                                                </div>
         <div class="row">
               <label class="col-sm-2">Course Category</label>
               <div class="col-sm-10"><select name="category" id="category" class="form-control" required >
                  <option value="">Select course category</option>
                  <option value="National Association of Emergency Medical Technicians (NAEMT)" @if($course->category =='National Association of Emergency Medical Technicians (NAEMT)') selected @endif>National Association of Emergency Medical Technicians (NAEMT)</option>
                  <option value="American Heart Association (AHA)"  @if($course->category =='American Heart Association (AHA)') selected @endif>American Heart Association (AHA)</option>
                  <option value="American Health and Safety Institute (ASHI)"  @if($course->category =='American Health and Safety Institute (ASHI)') selected @endif>American Health and Safety Institute (ASHI)</option>
                  <option value="Emergency Medical Services (EMS)"  @if($course->category =='Emergency Medical Services (EMS)') selected @endif>Emergency Medical Services (EMS)</option>
                  <option value="Community Outreach Programmes (CSR)"  @if($course->category =='Community Outreach Programmes (CSR)') selected @endif>Community Outreach Programmes (CSR)</option>
               </select></div>
            </div>
			<br>
         <div class="row ar" style="display: none;">
               <label class="col-sm-2">Course Category (ar)</label>
               <div class="col-sm-10"><select name="category_ar" id="category_ar" class="form-control"  >
                  <option value="">Select course category</option>
                  <option value="الجمعية الوطنية الأمريكية لفنيي طب الطوارئ (NAEMT)" @if($course->category_ar =='الجمعية الوطنية الأمريكية لفنيي طب الطوارئ (NAEMT)') selected @endif>الجمعية الوطنية الأمريكية لفنيي طب الطوارئ (NAEMT)</option>
                  <option value="الجمعية الأمريكية للقلب (AHA)"  @if($course->category_ar =='الجمعية الأمريكية للقلب (AHA)') selected @endif>الجمعية الأمريكية للقلب (AHA)</option>
                  <option value="معهد الصحة والسلامة الأمريكي (ASHI)"  @if($course->category_ar =='معهد الصحة والسلامة الأمريكي (ASHI)') selected @endif>معهد الصحة والسلامة الأمريكي (ASHI)</option>
                  <option value="خدمات الطوارئ الطبية (EMS)"  @if($course->category_ar =='خدمات الطوارئ الطبية (EMS)') selected @endif>خدمات الطوارئ الطبية (EMS)</option>
                  <option value="برامج التوعية المجتمعية (المسؤولية المجتمعية)"  @if($course->category_ar =='برامج التوعية المجتمعية (المسؤولية المجتمعية)') selected @endif>برامج التوعية المجتمعية (المسؤولية المجتمعية)</option>
               </select></div>
            </div>
			<br>
         
         <div class="row">
               <label class="col-sm-2">Course Name</label>
               <div class="col-sm-10"><input type="text" name="title" id="title" class="form-control" required value="{{$course->title}}"></div>
         </div>
			<br>
            <div class="row ar" style="display: none;">
               <label class="col-sm-2">Course Name (ar)</label>
               <div class="col-sm-10"><input type="text" name="title_ar" id="title_ar" class="form-control"  value="{{$course->title_ar}}"></div>
            </div>
			<br>
            <div class="row">
               <label class="col-sm-2">Type</label>
               <div class="col-sm-10"><select name="type" id="type" class="form-control" required value="{{$course->type}}">
                  <option value="">Select Type</option>
                  <option value="Classroom" @if($course->type=='Classroom') selected @endif>Classroom</option>
                  <option value="Virtual"  @if($course->type=='Virtual') selected @endif>Virtual</option>
                  <option value="Blended"  @if($course->type=='Blended') selected @endif>Blended</option>
                   </select></div>
            </div>
			<br>
            <div class="row ar" style="display: none;">
               <label class="col-sm-2">Type (ar)</label>
               <div class="col-sm-10"><select name="type_ar" id="type_ar" class="form-control"  value="{{$course->type_ar}}">
                  <option value="">Select Type</option>
               
                  <option value="فصل دراسي" @if($course->type_ar=='فصل دراسي') selected @endif>فصل دراسي</option>
                  <option value="افتراضي"  @if($course->type_ar=='افتراضي') selected @endif>افتراضي</option>
                  <option value="التعليم المدمج"  @if($course->type_ar=='التعليم المدمج') selected @endif>التعليم المدمج</option>
             
               </select></div>
            </div>
			<br>
         <div class="row">
               <label class="col-sm-2">Start Date</label>
               <div class="col-sm-10"><input type="date" name="start_date" id="start_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="form-control" required value="{{$course->start_date}}"></div>
            </div>
			<br> <div class="row">
               <label class="col-sm-2">End Date</label>
               <div class="col-sm-10"><input type="date" name="end_date" id="end_date" min="{{ \Carbon\Carbon::create($course->start_date)->format('Y-m-d') }}" class="form-control" required value="{{$course->end_date}}"></div>
            </div>
			<br>
			<br> <div class="row">
               <label class="col-sm-2">Location</label>
               <div class="col-sm-10"><textarea type="text" class="custom_editor" name="location" id="location" class="form-control"  value="">{{$course->location}}</textarea></div>
            </div>
			<br> <div class="row ar" style="display: none;">
               <label class="col-sm-2">Location (ar)</label>
               <div class="col-sm-10"><textarea type="text" class="custom_editor" name="location_ar" id="location_ar" class="form-control"  value="">{{$course->location_ar}}</textarea></div>
            </div>
			<br>
         <div class="row">
               <label class="col-sm-2">Link (Meeting Link)</label>
               <div class="col-sm-10"><input type="text" name="link" id="link" class="form-control"  value="{{$course->link}}"></div>
            </div>
			<br>
         <div class="row">
               <label class="col-sm-2">Certification</label>
               <div class="col-sm-10"><textarea type="text" class="custom_editor" name="certification" id="certification" class="form-control" required value="">{{$course->certification}}</textarea></div>
            </div>
			<br>
         <div class="row  ar" style="display: none;">
               <label class="col-sm-2">Certification (ar)</label>
               <div class="col-sm-10"><textarea type="text" class="custom_editor" name="certification_ar" id="certification_ar" class="form-control"  value="">{{$course->certification_ar}}</textarea></div>
            </div>
			<br>
         <div class="row">
               <label class="col-sm-2">Who should take the course?</label>
               <div class="col-sm-10"><textarea type="text" class="custom_editor" name="who_should_take_course" id="who_should_take_course" class="form-control" required value="">{{$course->who_should_take_course}}</textarea></div>
            </div>
			<br>
         <div class="row ar" style="display: none;">
               <label class="col-sm-2">Who should take the course? (ar)</label>
               <div class="col-sm-10"><textarea type="text" class="custom_editor" name="who_should_take_course_ar" id="who_should_take_course_ar" class="form-control"  value="">{{$course->who_should_take_course_ar}}</textarea></div>
            </div>
			<br>
         <div class="row">
               <label class="col-sm-2">Note</label>
               <div class="col-sm-10"><textarea type="text" class="custom_editor" name="note" id="note" class="form-control"  value="">{{$course->note}}</textarea></div>
            </div>
			<br>
         <div class="row ar" style="display: none;">
               <label class="col-sm-2">Note (ar)</label>
               <div class="col-sm-10"><textarea type="text" class="custom_editor" name="note_ar" id="note_ar" class="form-control"  value="">{{$course->note_ar}}</textarea></div>
            </div>
			<br>
         <div class="row">
               <label class="col-sm-2">Closing date</label>
               <div class="col-sm-10"><input type="date" name="closing_date" id="closing_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="form-control" required value="{{$course->closing_date}}"></div>
            </div>
			<br>
         <div class="row">
               <label class="col-sm-2">Course Fee Type</label>
               <div class="col-sm-10">
                  <select  name="fee_type" id="fee_type" class="form-control" required>
                        <option value="">Select Fee Type</option>
                        <option value="AED" @if($course->fee_type=='AED') selected @endif>AED</option>
                        <option value="CSR (No Charges Apply)"  @if($course->fee_type=='CSR (No Charges Apply)') selected @endif>CSR (No Charges Apply)</option>
                  </select>
               </div>
            </div>
			<br>
         <div class="row" id="aed-field" style="display:none;">
               <label class="col-sm-2">Course Fee</label>
               <div class="col-sm-10"><input type="text" name="course_fee" id="course_fee" class="form-control" required value="{{$course->course_fee}}"></div>
            </div>
			<br>
            <div class="row">
               <label class="col-sm-2">Course Description</label>
               <div class="col-sm-10"><textarea type="text" class="custom_editor" rows="3" name="description" id="description" class="form-control" required >{{$course->description}}</textarea></div>
            </div>
			<br>
            <div class="row ar" style="display: none;">
               <label class="col-sm-2">Course Description (ar)</label>
               <div class="col-sm-10"><textarea type="text" class="custom_editor" rows="3" name="description_ar" id="description_ar" class="form-control"  >{{$course->description}}</textarea></div>
            </div>
			<br>
            <div class="form-group text-center">
            <a href="{{ url()->previous()}}"  class="btn btn-primary"> Back</a>
            <input type="submit" class="btn btn-secondary" value="Save">
            <a href="/course"  class="btn btn-primary"> Cancel</a>
            </div>
         </div>
      </form>

   </div>
</section>
</section>
		
		
	</div>
</div>
</section>
<script src="https://cdn.ckeditor.com/4.16.0/standard-all/ckeditor.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    let textareas = $(".custom_editor").each(function () {
            let t_id = this.id;
            console.log("textarea id : " + t_id);

            CKEDITOR.replace(t_id, {
                allowedContent: true,
                height: 300,
                filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
        });
        $(document).ready(function () {
         $('#fee_type').on('change',()=>{
               var feeType= $('#fee_type').val();
               if(feeType=='AED'){
                  $('#aed-field').show();
               }else{
                  $('#aed-field').hide();
               }
            });
           @if($course->fee_type=='AED')
               $('#aed-field').show();
            @else
               $('#aed-field').hide();
           @endif


           @if(old('bi_lang')==1)
            $('.ar').show();
           @endif
        if($("#bi_lang_check").attr('checked')==='checked'){
    $('.ar').show();
                    $("#bi_lang").prop('value', "1");
}else {
                    $('.ar').hide();
                    $("#bi_lang").prop('value', "0");
                }
            $("#bi_lang_check").click(function () {
                if (this.checked) {
                    $('.ar').show();
                    $("#bi_lang").prop('value', "1");
                } else {
                    $('.ar').hide();
                    $("#bi_lang").prop('value', "0");
                }
            });
            });
</script>
@endsection