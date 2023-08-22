@extends('layouts.index')


@section('meta_tags')
    {!! Meta::toHtml() !!} 
   <!-- <meta property="og:description" content="Our Careers portal offers information about the opportunities available at National Ambulance  " />
  <meta property="og:title" content="Careers-National Ambulance" /> -->
  <meta name="image" property="og:image" content="{{url('/public/Image/200x200.jpg')}}">
@endsection

@section('content')
<section class="page_banner"
style="background-image: url({{ url('public/website/images/course-apply-banner.jpg') }})">
</section>

<section class="form_section">
    <form method="post" action="{{route('course.apply',$course->id)}}" enctype="multipart/form-data">
    @csrf
        <div class="container">
            <div class="row">
                <div class="col-md-12 course_wrapper">
                    <!--<h5 class="jobID">RNA1631016070</h5>-->
                    <div class="form_panel">
                        <h1>Request Reservation</h1>
                        <p>Fill in the contact form to express your interest in joining the course and in reserving your slot. We will contact you to confirm booking details and payment method. Please note that course reservation will only be confirmed after full payment. National Ambulance reserves the right to change the dates of the courses as required.</p> 
                        <div class="form_column">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <select id="title" name="title" class="form-control" required>
                                        <option selected="" disabled="true" value="">Title*</option>
                                        <option value="Dr" @if(old('title')=='Dr') selected @endif>Dr</option>
                                        <option value="Prof"  @if(old('title')=='Prof') selected @endif>Prof</option>
                                        <option value="Mr"  @if(old('title')=='Mr') selected @endif>Mr</option>
                                        <option value="Mrs"  @if(old('title')=='Mrs') selected @endif>Mrs</option>
                                        <option value="Miss"  @if(old('title')=='Miss') selected @endif>Miss</option>
                                        <option value="Ms"  @if(old('title')=='Ms') selected @endif>Ms</option>
                                    </select>
                                    @error('type')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <input class="form-control" name="name" placeholder="Full Name *" type="text" required value="{{old('name')}}">
                                    @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                </div>
                            </div>
                            <div class="row">                                
                                <div class="form-group col-md-6">
                                    <input class="form-control" name="email" placeholder="Email Address*" type="email" required value="{{old('email')}}">
                                    @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <input class="form-control" name="phone_number" placeholder="Mobile Number*" type="text" required value="{{old('phone_number')}}">
                                    @error('phone_number')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                </div>
                            </div>
                            <div class="row">                                
                                <div class="form-group col-md-6">
                                    <input class="form-control" name="profession" placeholder="Profession" type="text">
                                </div>
                                <div class="form-group col-md-6">
                                    <input class="form-control" name="workplace" placeholder="Workplace" type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="mb-2">Message</label>
                                    <textarea name="message" class="form-control" cols="7" rows="4">{{old('message')}}</textarea>
                                    @error('message')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                </div>
                            </div>                            
                            <div class="row">
                                <div class="form-group col-md-12">
                                   <div class="form-check">
                                        <input name="agreement" class="form-check-input" type="checkbox" required>
                                        <label class="form-check-label fw-normal" for="flexCheckChecked">
                                        By submitting this form, I agree to the <a href="/page/terms-and-conditions">Terms and Conditions</a> and <a href="/page/privacy-policy">Privacy Policy</a>. I understand that my slot will only be confirmed after I am contacted by National Ambulance staff to confirm booking details and payment. I certify that I have completed this form with the correct and true information to the best of my knowledge. I am also aware that course reservation will only be confirmed after full payment and National Ambulance reserves the right to change the dates of the courses as required.*
                                        </label>
                                    </div>
                                </div>
                            </div> 
                            <div class="row">
                            @if(config('services.recaptcha.key'))
                                <div class="g-recaptcha"  data-sitekey="{{ config('services.recaptcha.key') }}"></div>
                            @endif
                            <label id="g-recaptcha-response-msg"  style="color: red;font-weight: 400;"></label>

                            @error('g-recaptcha-response')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror   
                            </div>
                            <div class="row mt-3">
                                <div class="btn_column form-group col-md-12">
                                    <button type="submit" class="default_btn">Submit</button>
                                </div>
                            </div> 
                        </div>               

                    </div>
                </div>
            </div>
        </div>
    </form>
</section>

@endsection

@section('script')
<script>
    window.onload = function() {
        var $recaptcha = document.querySelector('#g-recaptcha-response');
        if($recaptcha) {
            $recaptcha.setAttribute("required", "required");
        }
    };
       $(function () {
        $("form").validate();
       
        $('form').submit(function(e){
            $("#g-recaptcha-response-msg").text('');

           var index=1;
           var isError = false;
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
            if(isError){
                
                e.preventDefault();   
                $("label[for='g-recaptcha-response']").show();
              
            }else{           
                $('#loader').show();
            }
                     
        });
    });
</script>
<script>
    @if(app()->getLocale() != 'en')                           
        window.location.replace("LaravelLocalization::getLocalizedURL('en')}}");
    @endif
</script>

@endsection