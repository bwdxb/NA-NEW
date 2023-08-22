<link rel="stylesheet" href="{{asset('public/website/css/multiselect.css')}}">
@php
    use app\Http\helper\Helper as Helper;
    $naemt_courses=Helper::getCoursesByCategory('NAEMT');
    $aha_courses=Helper::getCoursesByCategory('AHA');
    $ashi_courses=Helper::getCoursesByCategory('ASHI');
@endphp
<div class="accordion mt-3 mb-5" id="serviceTab">
    <div class="accordion-item">
        <!-- <div class="accordion-header" id="heading_one">
            <h3 class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapse_one"
                aria-expanded="false" aria-controls="collapse_one">
                {{__('EMS Educational Training Request Form')}}
            </h3>
        </div> -->
        <div id="collapse_one" class="accordion-collapse collapse" aria-labelledby="heading_one"
             data-bs-parent="#serviceTab">
            <div class="accordion-body d-flex flex-wrap">
                <div class="servicesForm">
                    <div class="form_panel">
                        <form method="post" class="educationForm" action="{{route('service.education')}}" name="EducationTrainingForm" enctype="multipart/form-data">
                        @csrf   
                        <div class="form_column">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                            <label>{{__('Title')}}*</label>
                                            <select id="title" name="title" class="form-control" required>
                                                        <option selected disabled="true"
                                                                value="">{{__('Select')}} *</option>
                                                        <option value="Dr" {{old('title')=='Dr'?'selected':''}}>{{__('Dr')}}</option>
                                                        <option value="Prof" {{old('title')=='Prof'?'selected':''}}>{{__('Prof')}}</option>
                                                        <option value="Mr" {{old('title')=='Mr'?'selected':''}}>{{__('Mr')}}</option>
                                                        <option value="Mrs" {{old('title')=='rs'?'selected':''}}>{{__('Mrs')}}</option>
                                                        <option value="Miss" {{old('title')=='ss'?'selected':''}}>{{__('Miss')}}</option>
                                                        <option value="Ms" {{old('title')=='Ms'?'selected':''}}>{{__('Ms')}}</option>
                                                        
                                                    </select>
                                                    @error('title')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>{{__('Full Name')}} *</label>
                                        <input type="text" name="name" class="form-control" required value="{{old('name')}}">
                                        @error('name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                    </div>
                                </div>
                                <div class="row" id="individual-or-organisation">
                                    <div class="form-group col-md-12">
                                        <div class="radio_row mb-3">
                                            <h6 class="col-12 mb-3 darkgrey">{{__('Do you require individual/group or organisation training?')}}*</h6>
                                            <label class="radio">
                                                <strong class="nvColor">{{__('Individual/Group')}}</strong>
                                                <input name="training_type" type="radio" value="individual_group" @if(old('training_type')=='individual_group'||!(old('training_type')))checked @endif>
                                                <span class="checkround"></span>
                                            </label>
                                            <label class="radio">
                                                <strong class="nvColor">{{__('Organisation')}}</strong>
                                                <input name="training_type" type="radio" value="organisation" @if(old('training_type')=='organisation')checked @endif>
                                                <span class="checkround"></span>
                                            </label>
                                        </div>
                                        @error('training_type')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>{{__('Mobile Number')}} *</label>
                                            <input type="text" name="mobile_number" class="form-control" required value="{{old('mobile_number')}}">
                                            @error('mobile_number')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>{{__('Email Address')}} *</label>
                                            <input type="email" name="email" class="form-control" required value="{{old('email')}}">
                                            @error('email')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                        </div>
                                    </div>   
                                    <div class="organization-type" style="display:none;">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label>{{__('Organisation Name')}} *</label>
                                                <input type="text" name="organisation_name" class="form-control"  value="{{old('organisation_name')}}">
                                                @error('organisation_name')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                            </div>
                                        
                                            <div class="form-group col-md-6">
                                                <label>{{__('Landline Number')}}</label>
                                                <input type="text" name="landline_number" id="landline_number" class="form-control"  value="{{old('landline_number')}}">
                                                @error('landline_number')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>                                        
                                        </div>
                                    </div>
                                <div class="row">
                                            <h6 class="col-md-12 mb-3 darkgrey">{{__('Which course(s) do you need? Check all that apply')}}*</h6>
                                            <div class="form-group col-md-6">
                                                <label>{{__('National Association of Emergency Medical Technicians (NAEMT) Courses')}}</label>                                        
                                                <select name="naemt_course_type[]" class="form-control" multiple >
                                                    <!-- <option value="" selected="">Select</option> -->
                                                    @foreach($naemt_courses as $course)
                                                    <option value="{{$course->title}}">{{$course->title}}</option>

                                                    @endforeach
                                            
                                                </select>
                                                @error('naemt_course_type')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                                <p class="text-danger" id="naemt_course_type"></p>
                                            </div>
                                            <div id="AHA_course" class="form-group col-md-6">
                                                <label class="h-align">{{__('American Heart Association (AHA) Courses')}}</label>                                        
                                                <select name="aha_course_type[]" class="form-control" multiple id="aha_course_type">
                                                    <!-- <option value="" selected="">Select</option> -->
                                                    @foreach($aha_courses as $course)
                                                    <option value="{{$course->title}}">{{$course->title}}</option>
                                                    @endforeach
                                                    
                                                </select>  @error('aha_course_type')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                                <p class="text-danger" id="aha_course_type"></p>

                                            </div>
                                    
                                            <div class="form-group col-md-6">
                                                <label>{{__('American Health and Safety Institute (ASHI) Courses')}}</label>                                        
                                                <select name="ashi_course_type[]" class="form-control" multiple >
                                                    <!-- <option value="" selected="">Select</option> -->
                                                    @foreach($ashi_courses as $course)
                                                    <option value="{{$course->title}}">{{$course->title}}</option>
                                                    @endforeach
                                            
                                                </select>
                                                @error('aha_course_type')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                                <p class="text-danger" id="ashi_course_type"></p>

                                            </div>
                                        
                                            <div class="form-group col-md-6  indivigual-group"  >
                                                <label>{{__('How many participants would like to attend the course?')}}*</label>                                        
                                                <input type="text"  name="no_of_participants" class="form-control" required value="{{old('no_of_participants')}}" id="no_of_participants">
                                                @error('no_of_participants')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div> 

                                            <div class="form-group col-md-6 organization-type"  style="display:none;">
                                                <label>{{__('What else would you like on-site training for?')}}</label> 
                                                <input type="text" name="other_training_info" id="other_training_info" class="form-control" value="{{old('other_training_info')}}">
                                                @error('other_training_info')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                </div> 
                                 <!-- Indivigual/group -->
                                <div class="individual_group indivigual-group"  >
                                    <div class="row" style="display:none;" id="if-one-person">
                                        <div class="form-group col-md-12">
                                            <h6>{{__('You will be on the waiting list to complete the total number of participants in one class')}}</h6>
                                        </div>
                                    </div>
                                    <div class="row" style="display:none;" id="if-3-and-up-person">
                                        <div class="form-group col-md-12">
                                            <label>{{__('When would you like to attend the training?')}}</label>
                                            <input type="text" name="training" class="form-control" > 
                                        </div>
                                    </div>                                   
                                </div>
                                <!-- Organisation -->
                                <div class="organisationType organization-type" style="display:none;">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>{{__('Do you have a training site?')}}*</label> 
                                            <div class="radio_row mt-0">
                                                <label class="radio">
                                                    {{__('Yes')}}
                                                    <input name="training_status" type="radio" value="1" @if(old('training_status')) checked @endif>
                                                    <span class="checkround"></span>
                                                </label>
                                                <label class="radio">
                                                    {{__('No')}}
                                                    <input name="training_status" type="radio" value="0"  @if(!old('training_status')) checked @endif>
                                                    <span class="checkround"></span>
                                                </label>
                                                
                                            </div>
                                            @error('training_status')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>{{__('Please provide number of students for each course')}}*</label>
                                            <input type="text" name="no_of_students" class="form-control"  value="{{old('no_of_students')}}">
                                            @error('no_of_students')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <!-- <div class="form-group col-md-6">
                                            <label>How did you hear about us?</label>
                                            <input type="text" name="" class="form-control" required value="">
                                        </div> -->
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>{{__('When would you like to conduct the training?')}}*</label>
                                            <input type="text" name="training_when" class="form-control" value="{{old('training_when')}}"> 
                                       
                                            @error('training_when')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror </div>                                        
                                    </div>
                                    <!-- <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>Message</label>
                                            <textarea name="Message" class="form-control" rows="5" required></textarea>
                                        </div>
                                    </div> -->
                                </div>
                              
                            </div>
                            <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>{{__('How did you hear about us?')}} *</label>
                                            <input type="text" name="hear_about_from" class="form-control" required value="{{old('hear_about_from')}}">
                                            @error('hear_about_from')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                            <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>{{__('Message')}}</label>
                                            <textarea name="message" class="form-control" rows="5" >{{old('message')}}</textarea>
                                            @error('message')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                                @if(config('services.recaptcha.key'))
                                                    <div class="g-recaptcha"
                                                         data-sitekey="{{ config('services.recaptcha.key') }}">
                                                    </div>
                                                @endif
                                                <span id="g-recaptcha-response-msg"  style="color: red;font-weight: 400;margin-bottom: 1.5rem;"></span>

                                                @error('g-recaptcha-response')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <div class="form-check form-check-flat">
                                                <label class="form-check-label">
                                                    <input type="checkbox" name="agreement" class="form-check-input" required>{{__('By submitting this form, I understand that I am requesting a quotation for educational/ training courses from National Ambulance UAE. I acknowledge that completion of this form does not automatically guarantee approval of request. I agree to the')}} <a href="/page/terms-and-conditions" target="_blank">{{__('Terms and Conditions')}}</a> {{__('and')}} <a href="/page/privacy-policy" target="_blank">{{__('Privacy Policy')}}</a> {{__(', and certify that I have completed this form with the correct and true information to the best of my knowledge.')}}*
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                            <div class="form_column">
                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <p class="showcontent"><em><small>{{__('**The American Heart Association strongly promotes knowledge and proficiency in all its courses and has developed instructional materials for this purpose. Use of these materials in an educational course does not represent course sponsorship by the AHA. Any fees charged for such a course, except for a portion of fees needed for AHA course materials, do not represent income to the AHA.')}}</small></em></p>
                                    </div>
                                    <div class="form-group col-md-4 text-end">
                                        <button type="submit" class="default_btn">{{__('Submit')}}</button>
                                    </div>
                                </div>    
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

<script src="{{asset('public/website/js/multiselect.js')}}"></script>
<script type="text/javascript">
window.onload = function() {
    var $recaptcha = document.querySelector('#g-recaptcha-response');

    if($recaptcha) {
        $recaptcha.setAttribute("required", "required");
    }
};
    $(function () {
        $("select[name='aha_course_type[]']").change(function(){
            alert();
            if($("select[name='aha_course_type[]']").val()==""){
$('#aha-msg').hide();
}else{
                $('#aha-msg').show();

            }
        });
        if($("select[name='aha_course_type[]']").val()==""){
$('#aha-msg').hide();
}else{
                $('#aha-msg').show();

            }
        @if(old('no_of_participants')<3)
            $('#if-3-and-up-person').find('input').removeAttr("required");
        @else if(old('no_of_participants')>=3)
             $('#if-3-and-up-person').find('input').attr("required",true);
        @endif

        $('#no_of_participants').on('change',function(){
            var value = $(this).val();
            if(value>=3){
                $('#if-one-person').hide();
                $('#if-3-and-up-person').show();
                $('#if-3-and-up-person').find('input').attr("required",true);
            }else {
                $('#if-one-person').show();
                $('#if-3-and-up-person').hide();
                $('#if-3-and-up-person').find('input').removeAttr("required");
            }
        });
    // indivigual-group
@if(old('training_type')=='individual_group')
$('.organization-type').hide();
                $('.organization-type').find('input').removeAttr('required');
                $('.indivigual-group').show();
                $('.indivigual-group').find('input').attr("required", true);
                $('#landline_number').removeAttr('required');
                $('#other_training_info').removeAttr('required');

@elseif(old('training_type')=='organisation')
$('.indivigual-group').hide();
                $('.indivigual-group').find('input').removeAttr("required");
                $('.organization-type').show();
                $('.organization-type').find('input').attr('required',true);
                $('#landline_number').removeAttr('required');
                $('#other_training_info').removeAttr('required');
@endif
    $('#individual-or-organisation input[type=radio]').change(function () {
            var checkedValue = $(this).val();

            if (checkedValue === 'individual_group') {
                $('.organization-type').hide();
                $('.organization-type').find('input').removeAttr('required');
                $('.indivigual-group').show();
                $('.indivigual-group').find('input').attr("required", true);
                $('#landline_number').removeAttr('required');
                $('#other_training_info').removeAttr('required');
            } else {
                $('.indivigual-group').hide();
                $('.indivigual-group').find('input').removeAttr("required");
                $('.organization-type').show();
                $('.organization-type').find('input').attr('required',true);
                $('#landline_number').removeAttr('required');
                $('#other_training_info').removeAttr('required');
            }
        });
    });


    $(function () {
        $("form").validate();
       
        $('form').submit(function(e){
            $("#g-recaptcha-response-msg").text('');
           var index=1;
           var isError = false;
           var isAnyCourseSelected = false;
            $(this).find('input[required], select[required], textarea[required]').each(function(){
                if (!$(this).valid()){
                    if(index==1){
                        index++;
                        $(this).focus();
                    }
                    $(this).css("border-color", "red");
                    // if($(this).attr('name')=='g-recaptcha-response'){
                    //     $("#g-recaptcha-response-msg").text('This field is required.');
                    // }
                    isError= true;
                }else{
                    $(this).css("border-color", "green");
                }
                

            });
            if($("select[name='naemt_course_type[]']").val()=="" && $("select[name='aha_course_type[]']").val()=="" && $("select[name='ashi_course_type[]']").val()==""){
                e.preventDefault();
                isError= true;
                swal("You have to choose at least one course from any of the listed categories")
            }
            if($("select[name='aha_course_type[]']").val()==""){
                 $('#aha-msg').hide();
            }else{
                $('#aha-msg').show();

            }
            if(isError){
                e.preventDefault();
                $("label[for='g-recaptcha-response']").show();

                // if($(this).attr('name')=='naemt_course_type[]') {
                //     $('#naemt_course_type').html("check this field");
                // }else{
                //     $('#naemt_course_type').html("");
                // }

                // if($(this).attr('name')=='aha_course_type[]') {
                //     $('#aha_course_type').html("check this field");
                // }else{
                //     $('#aha_course_type').html("");
                // }

                // if($(this).attr('name')=='ashi_course_type[]') {
                //     $('#ashi_course_type').html("check this field");
                // }else{
                //     $('#ashi_course_type').html("");
                // }
                 
            }else{
                $('#loader').show();
            }
                     
        });

});

</script>
<script type="text/javascript">

@if(app()->getLocale() != 'en')                           
    
    $("select[multiple]").easySelect({
        buttons: true,
        action: true,
        placeholder: 'الرجاء الاختيار',
        placeholderColor: '#999',
        selectColor: '#243a76',
        itemTitle: 'NAEMT selected',  
        showEachItem: true,
        width: '100%',
        dropdownMaxHeight: '300px',
    })
@endif
   
$("select[multiple]").easySelect({
    buttons: true,
    action: true,
    placeholder: 'Select',
    placeholderColor: '#999',
    selectColor: '#243a76',
    itemTitle: 'NAEMT selected',  
    showEachItem: true,
    width: '100%',
    dropdownMaxHeight: '300px',
});

$(document).ready(function(){
  $("#AHA_course .select-item, #AHA_course #selectAlleasySelect").click(function(){
    if ($('#AHA_course .select-item>input').is(':checked')){
      
      $('.showcontent').show();

    }else{
        $('.showcontent').hide();
    }
  });

  $("#AHA_course #clearAlleasySelect, #AHA_course .clearSelectfromDiv").click(function(){
    if ($('#AHA_course .select-item>input').not(':checked')){
      
      $('.showcontent').hide();
    }else{
        //$('.showcontent').hide();
    }
  });
});
</script>

<!-- Non Emergency Patient Transport Service Form -->