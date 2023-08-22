@php
    use app\Http\helper\Helper as Helper;

@endphp
<div class="accordion mt-3 mb-5" id="serviceTab">
    <div class="accordion-item">
        <div class="accordion-header" id="headingOne">
            <h3 class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                aria-expanded="false" aria-controls="collapseOne">
                {{__('Non-Emergency Patient Transport Service Form')}}
            </h3>
        </div>
        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
             data-bs-parent="#serviceTab">
            <div class="accordion-body d-flex flex-wrap">
                <div class="col-md-12">
                    <p>{{__('Thank you for choosing National Ambulance to provide you with the Non-Emergency Patient Transport Service (PTS). Please ensure that this form is completed within at least three days of the intended transport date. If your request is urgent, call 02-596-8600 during business hours Monday through Thursday between 8:00 AM and 5:00 PM, and Friday between 8:00 AM and 12:00 PM. The service is based on certain criteria and your request will be reviewed by a National Ambulance Medical Professional to ensure the patient is suitable for transport. If not, you will be notified accordingly. It is extremely important that all of the questions/ fields in this form are answered/filled accurately. You might be asked to provide further information before your request is approved. Upon approval, our PTS Team will contact you to confirm booking details along with payment amount. In some cases, we will require an escort to accompany the patient during the transfer (home or hospital nurse). In these circumstances we will notify you prior to the transport.')}}</p>
                </div>
                <form method="post" action="{{ route('service.pts') }}" enctype="multipart/form-data">
                    <ul class="errorMessages text-danger" style="list-style:unset;background-color: bisque;"></ul>
                    <div class="servicesForm">
                        <div class="form_panel">
                            <div class="customTabs">
                                <ul class="nav nav-tabs step_list" id="nav-tab" role="tablist">
                                    <li><a class="nav-link active" href="#tab_1" data-bs-toggle="tab"
                                           data-bs-target="#tab_1" role="tab"
                                           aria-controls="tab_1" aria-selected="true">{{__('Patient Details')}}</a></li>
                                    <li><a class="nav-link" href="#tab_2" data-bs-toggle="tab" data-bs-target="#tab_2"
                                           role="tab"
                                           aria-controls="tab_2" aria-selected="false">{{__('Transport Details')}}</a>
                                    </li>
                                    <li><a class="nav-link" href="#tab_3" data-bs-toggle="tab" data-bs-target="#tab_3"
                                           role="tab"
                                           aria-controls="tab_3" aria-selected="false">{{__('Primary Contact')}}</a>
                                    </li>
                                    <li><a class="nav-link" href="#tab_4" data-bs-toggle="tab" data-bs-target="#tab_4"
                                           role="tab"
                                           aria-controls="tab_4"
                                           aria-selected="false">{{__('Additional Information')}}</a></li>
                                </ul>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="inner_tab tab-pane show active" id="tab_1" role="tabpanel"
                                         aria-labelledby="tab_1">

                                        {{ csrf_field() }}
                                        <div class="form_column">
                                            <h5>{{__('Patient Details')}}</h5>                                            
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <select id="title" name="title" class="form-control" required>
                                                        <option selected disabled="true"
                                                                value="">{{__('Title')}} *</option>                                                        
                                                        <option value="Mr" @if(old('title')=='Mr') selected @endif>{{__('Mr')}}</option>
                                                        <option value="Mrs" @if(old('title')=='Mrs') selected @endif>{{__('Mrs')}}</option>
                                                        <option value="Miss" @if(old('title')=='Miss') selected @endif>{{__('Miss')}}</option>
                                                        <option value="Ms" @if(old('title')=='Ms') selected @endif>{{__('Ms')}}</option>
                                                       
                                                    </select>
                                                    @error('title')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <input class="form-control" name="name"
                                                           placeholder="{{__('Patient Full Name')}} *"
                                                           
                                                           value="{{old('name')}}"
                                                           type="text" required/>
                                                    @error('name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-12 col-lg-4">
                                                    <input id="patient_dob" type="text" name="dob"
                                                          class="form-control"
                                                           placeholder="{{__('Patient Date of Birth')}} *"
                                                           value="{{old('dob')}}"
                                                           onfocus="(this.type='text')"
                                                           onblur="(this.type='text')" required>
                                                    <i class="far fa-calendar-alt"></i>
                                                    @error('dob')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <!-- +97125968600 -->
                                                    <input class="form-control" name="emirates_id"
                                                    pattern="^[0-9]{3}-[0-9]{4}-[0-9]{7}-[0-9]{1}$"
                                                    title="Required valid emirate id eg: 123-1234-1234567-1"
                                                           value="{{old('emirates_id')}}"
                                                           placeholder="{{__('Patient Emirates ID Number')}} *"
                                                           type="text"
                                                           id="emirates_id"
                                                           onkeyup="addHyphen(this)"
                                                           required/>
                                                    @error('emirates_id')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div class="custom-file">
                                                        <label class="form-label" for="formFileLg">
                                                            {{__("Please provide a copy of your emirates ID (front and back)")}}*
                                                        </label>
                                                        <div class="customFile">
                                                            <label for="patient_file" style="display:none;">{{__('Choose File')}}</label>
                                                            <input class="form-control file-size-limit" id="patient_file" name="emirates_file[]" type="file"  data-show-upload="true" data-show-caption="true"  onchange="patientFile()" multiple required/>
                                                            <span class="file_label">{{__('Upload File')}}</span>
                                                            @error('emirates_file')
                                                            <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                        <small>{{__('You can upload multiple files. If you choose to, please select and upload them in one go.')}}</small>
                                                        <div id="fileList"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <div class="custom-file">
                                                        <label class="form-label" for="formFileLg">
                                                            {{__("Please provide patient's most recent medical report with any additional documents")}}
                                                            *
                                                        </label>
                                                        <div class="customFile">
                                                            <input class="form-control file file-size-limit" id="medical_report_files" name="medical_report_files[]"
                                                                type="file"
                                                                data-show-upload="true" data-show-caption="true" multiple
                                                                required onchange="medicalReportFile()"/>
                                                                <span class="file_label">{{__('Upload File')}}</span>
                                                                @error('medical_report_files')
                                                                <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                        </div>
                                                        <small>{{__('You can upload multiple files. If you choose to, please select and upload them in one go.')}}</small>
                                                        <div id="rptfileList"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form_column mt-3">
                                            <div class="row">
                                                <div class="btn_column form-group col-md-12">
                                                    <!-- <button type="button" class="default_btn grey_bgbtn">Save</button> -->
                                                    <button type="button" class="default_btn btn_next"
                                                            id="btn_patient">{{__('Next')}}</button>
                                                    <!-- <button type="submit" class="default_btn grey_bgbtn">Save</button> -->
                                                    <!-- <button type="submit" class="default_btn">Next</button> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inner_tab tab-pane fade" id="tab_2" role="tabpanel"
                                         aria-labelledby="tab_2">
                                        <div class="form_column">
                                            <h5>{{__('Transport Details')}}</h5>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <div class="radio_row mb-3" id="tranfer_type">
                                                        <h6 class="col-12 mb-3">{{__('Please select the required type of transfer')}}
                                                            *</h6>
                                                        <label class="radio">
                                                            <strong class="nvColor">{{__('Hospital Transfer')}}</strong>
                                                            <input name="tranfer_type" type="radio"
                                                                   value="hospital_transfer"  @if(old('tranfer_type')=='hospital_transfer'||old('tranfer_type')) checked @endif/>
                                                            <span class="checkround"></span>
                                                        </label>
                                                        <label class="radio">
                                                            <strong class="nvColor">{{__('Medical Appointment Transfer')}}</strong>
                                                            <input name="tranfer_type" type="radio"
                                                                   value="appointment_tranfer" @if(old('tranfer_type')=='appointment_tranfer') checked @endif/>
                                                            <span class="checkround"></span>
                                                        </label>
                                                        @error('tranfer_type')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                {{-- pickup_date, pickup_time & appointment_time --}}
                                                <div class="form-group col">
                                                    <input id="PickUp_date" type="text" name="pickup_date" value="{{old('pickup_date')}}"
                                                           class="form-control" placeholder="{{__('Pick-up Date')}}*"
                                                           onfocus="(this.type='text')"
                                                           onblur="(this.type='text')" required>
                                                    <i class="far fa-calendar-alt"></i>
                                                    @error('pickup_date')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col">
                                                    <input id="timepicker3" class="form-control"
                                                           placeholder="{{__('Pick-up Time')}}*" type="text"
                                                           value="{{old('pickup_time')}}" required
                                                           onfocus="(this.type='text')" onblur="(this.type='text')"
                                                           name="pickup_time"/>
                                                          <i class="far fa-clock"></i>
                                                    @error('pickup_time')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col appointmentSelectedField">
                                                    <input id="appointment_time" type="text" name="appointment_time"
                                                           value="{{old('appointment_time')}}"
                                                           class="form-control"
                                                           placeholder="{{__('Appointment Time')}}*"
                                                           onfocus="(this.type='text')" onblur="(this.type='text')">
                                                           <i class="far fa-clock"></i>
                                                    @error('appointment_time')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row ">
                                                <div class="form-group col-md-4">
                                                    <input type="text" class="form-control" name="transferring_hospital"
                                                           value="{{old('transferring_hospital')}}"
                                                           
                                                           placeholder="{{__('Transferring Hospital/ Facility Name')}} *" required>
                                                    @error('transferring_hospital')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <select class="form-control" name="receiving_hospital_emirates" id="receiving_hospital_emirates"
                                                            required>
                                                        <option selected disabled="true">{{__('Emirate')}} *</option>
                                                        <option  @if(old('receiving_hospital_emirates')=='Sharjah') selected @endif>{{__('Sharjah')}}</option>
                                                        <option  @if(old('receiving_hospital_emirates')=='Ajman') selected @endif>{{__('Ajman')}}</option>
                                                        <option  @if(old('receiving_hospital_emirates')=='Umm Al Quwain') selected @endif>{{__('Umm Al Quwain')}} </option>
                                                        <option  @if(old('receiving_hospital_emirates')=='Ras Al Khaimah') selected @endif>{{__('Ras Al Khaimah')}}</option>
                                                        <option  @if(old('receiving_hospital_emirates')=='Fujairah') selected @endif>{{__('Fujairah')}}</option>
                                                        <option  @if(old('receiving_hospital_emirates')=='Abu Dhabi') selected @endif>{{__('Abu Dhabi')}}</option>
                                                        <option  @if(old('receiving_hospital_emirates')=='Dubai') selected @endif>{{__('Dubai')}}</option>
                                                    </select>
                                                    @error('receiving_hospital_emirates')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-12 col-lg-4">
                                                    <input type="text" class="form-control" name="receiving_city"
                                                           value="{{old('receiving_city')}}"
                                                           placeholder="{{__('City')}} *" required>
                                                    @error('receiving_city')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                            </div>


                                            <div class="hospitalSelectedField">
                                                <div class="row ">
                                                    {{-- Transferring Hospital/ Facility details --}}
                                                    <div class="form-group col-md-4">
                                                        <input type="text" class="form-control"
                                                               name="receiving_hospital" required 
                                                               value="{{old('receiving_hospital')}}"
                                                    
                                                               placeholder="{{__('Receiving Hospital/ Facility Name')}} *"
                                                               required>
                                                        @error('receiving_hospital')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <select class="form-control" required 
                                                                name="transferring_hospital_emirates" id="transferring_hospital_emirates">
                                                            <option selected disabled="true"
                                                                    value="">{{__('Emirate')}} *</option>
                                                                    <option selected disabled="true">{{__('Emirate')}} *</option>
                                                        <option  @if(old('transferring_hospital_emirates')=='Sharjah') selected @endif>{{__('Sharjah')}}</option>
                                                        <option  @if(old('transferring_hospital_emirates')=='Ajman') selected @endif>{{__('Ajman')}}</option>
                                                        <option  @if(old('transferring_hospital_emirates')=='Umm Al Quwain') selected @endif>{{__('Umm Al Quwain')}} </option>
                                                        <option  @if(old('transferring_hospital_emirates')=='Ras Al Khaimah') selected @endif>{{__('Ras Al Khaimah')}}</option>
                                                        <option  @if(old('transferring_hospital_emirates')=='Fujairah') selected @endif>{{__('Fujairah')}}</option>
                                                        <option  @if(old('transferring_hospital_emirates')=='Abu Dhabi') selected @endif>{{__('Abu Dhabi')}}</option>
                                                        <option  @if(old('transferring_hospital_emirates')=='Dubai') selected @endif>{{__('Dubai')}}</option>
                                                        </select>
                                                        @error('transferring_hospital_emirates')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-12 col-lg-4">
                                                        <input type="text" class="form-control" name="transferring_city"
                                                               value="{{old('transferring_city')}}"
                                                                required 
                                                               placeholder="{{__('City')}} *">
                                                        @error('transferring_hospital_city')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    {{-- transferring doctor details --}}
                                                    <div class="form-group col-md-6">
                                                        <input type="text" class="form-control"
                                                               name="transferring_doctor" required 
                                                               value="{{old('transferring_doctor')}}"
                                                               
                                                               placeholder="{{__('Transferring Physician Name')}} *">
                                                        @error('transferring_doctor')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <input type="text" class="form-control" required 
                                                               name="transferring_doctor_contact_number"
                                                               value="{{old('transferring_doctor_contact_number')}}"
                                                              
                                                               placeholder="{{__('Transferring Physician Contact Number')}} *">
                                                        @error('transferring_doctor_contact_number')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    {{-- receiving doctor details --}}
                                                    <div class="form-group col-md-6">
                                                        <input type="text" class="form-control" name="receiving_doctor"
                                                               value="{{old('receiving_doctor')}}"
                                                                required 
                                                               placeholder="{{__('Receiving Physician Name')}} *">
                                                        @error('receiving_doctor')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <input type="text" class="form-control" required 
                                                               name="receiving_doctor_contact_number"
                                                               value="{{old('receiving_doctor_contact_number')}}"
                                                               placeholder="{{__('Receiving Physician Contact Number')}} *">
                                                        @error('receiving_doctor_contact_number')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    {{-- transfer approve status & addmission file upload --}}
                                                    <div class="form-group col-md-12">
                                                        <strong class="col-md-12">
                                                            {{__('Has transfer been approved by patient physician?')}}
                                                        </strong>
                                                        <div class="radio_row col-md-6">
                                                            <div id="physician_transfer_status">
                                                                <label class="radio">
                                                                    {{__('Yes')}}
                                                                    <input name="physician_transfer_status" type="radio"
                                                                           value="1" @if(old('physician_transfer_status')==1) checked @endif/>
                                                                    <span class="checkround"></span>
                                                                </label>
                                                                <label class="radio">
                                                                    {{__('No')}}
                                                                    <input name="physician_transfer_status" type="radio"
                                                                           value="0" @if(old('physician_transfer_status')==0||(!old('physician_transfer_status'))) checked @endif/>
                                                                    <span class="checkround"></span>
                                                                </label>
                                                            </div>
                                                            @error('physician_transfer_status')
                                                            <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    {{-- addmission file upload --}}
                                                    <div class="form-group col-md-12 physicianTransferSelectedField">
                                                        <div class="custom-file">
                                                            <label class="form-label"
                                                                   for="formFileLg">{{__('Please provide a copy of admission letter')}}</label>
                                                            <div class="customFile">
                                                                <input class="form-control file-size-limit" id="admission_file" name="admission_file" type="file" onchange="admissionFile()"/>
                                                                <span class="file_label" id="admissionFileLabel">{{__('Upload File')}}</span>
                                                                @error('admission_file')
                                                                <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="appointmentSelectedField">
                                                <div class="row">

                                                    <div class="form-group col-md-6">
                                                        <input type="text" class="form-control" name="pick_up_address"
                                                               value="{{old('pick_up_address')}}" required 
                                                               placeholder="{{__('Pick-up Address')}} *">
                                                        @error('transferring_hospital_address')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <input id="location_gps" type="text" class="form-control" name="location_gps"
                                                               value="{{old('location_gps')}}"
                                                               placeholder="{{__('GPS Coordinates')}}">
                                                        @error('receiving_hospital_location_gps')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <select class="form-control" name="emirates" >
                                                            <option selected disabled="true"
                                                                    value="">{{__('Emirate')}} *</option>
                                                            <option @if(old('emirate')=='Sharjah') selected @endif>{{__('Sharjah')}}</option>
                                                            <option @if(old('emirate')=='Ajman') selected @endif>{{__('Ajman')}}</option>
                                                            <option @if(old('emirate')=='Umm Al Quwain') selected @endif>{{__('Umm Al Quwain')}}</option>
                                                            <option @if(old('emirate')=='Ras Al Khaimah') selected @endif>{{__('Ras Al Khaimah')}}</option>
                                                            <option @if(old('emirate')=='Fujairah') selected @endif>{{__('Fujairah')}}</option>
                                                            <option @if(old('emirate')=='Abu Dhabi') selected @endif>{{__('Abu Dhabi')}}</option>
                                                            <option @if(old('emirate')=='Dubai') selected @endif>{{__('Dubai')}}</option>
                                                        </select>
                                                        @error('receiving_hospital_emirates')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <input type="text" class="form-control" name="city" required 
                                                               value="{{old('city')}}" placeholder="{{__('City')}} *">
                                                        @error('city')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="journWrapper">
                                                    <div class="row">
                                                        <div class="form-group col-md-12 row">
                                                            <strong class="col-md-12 ">
                                                                {{__('Does the patient require a return journey?')}}
                                                            </strong>
                                                            <div class="radio_row">
                                                                <div id="return_trip_status">
                                                                    <label class="radio">
                                                                        {{__('Yes')}}
                                                                        <input name="return_trip_status" type="radio"
                                                                               value="1"  @if(old('return_trip_status')==1) checked @endif/>
                                                                        <span class="checkround"></span>
                                                                    </label>
                                                                    <label class="radio">
                                                                        {{__('No')}}
                                                                        <input name="return_trip_status" type="radio"
                                                                               value="0"  @if(old('return_trip_status')==0||(!old('return_trip_status'))) checked @endif/>
                                                                        <span class="checkround"></span>
                                                                    </label>
                                                                </div>

                                                                @error('return_trip_status')
                                                                <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="journeySelectedField">
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <input id="ReturnDate" type="text" name="return_date"
                                                                       class="form-control"
                                                                       value="{{old('return_date')}}"
                                                                       placeholder="{{__('Return Date')}}*"
                                                                       onfocus="(this.type='text')"
                                                                       onblur="(this.type='text')" required>
                                                                <i class="far fa-calendar-alt"></i>
                                                                @error('return_date')
                                                                <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <input id="return_time" type="text" name="return_time"
                                                                       value="{{old('return_time')}}"
                                                                       class="form-control"
                                                                       placeholder="{{__('Return Time')}}*"
                                                                       onfocus="(this.type='text')"
                                                                       onblur="(this.type='text')" required>
                                                                       <i class="far fa-clock"></i>
                                                                @error('return_time')
                                                                <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <div class="custom-file">
                                                            <label class="form-label"
                                                                   for="formFileLg">{{__('Please provide a copy of appointment letter/ message')}}
                                                            </label>
                                                            <div class="customFile">
                                                                <input class="form-control file-size-limit" id="appointment_file" name="appointment_file" type="file" onchange="appointmentFile()"/>
                                                                <span class="file_label" id="appointmentFileLabel">{{__('Upload File')}}</span>
                                                                @error('name')
                                                                <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12 ">
                                                    <strong class="col-md-6 ">{{__('Will anyone be accompanying the patient during transport?')}} </strong>
                                                    <div class="radio_row col-md-6">
                                                        <div id="transport_accompany_status">
                                                            <label class="radio">
                                                                {{__('Yes')}}
                                                                <input name="transport_accompany_status" type="radio"
                                                                       value="1"  @if(old('transport_accompany_status')==1) checked @endif/>
                                                                <span class="checkround"></span>
                                                            </label>
                                                            <label class="radio">
                                                                {{__('No')}}
                                                                <input name="transport_accompany_status" type="radio"
                                                                       value="0"   @if(old('transport_accompany_status')==0||(!old('transport_accompany_status'))) checked @endif/>
                                                                <span class="checkround"></span>
                                                            </label>
                                                        </div>

                                                        @error('transport_accompany_status')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6 tripAccompanySelectedField">
                                                    <input type="text" class="form-control"
                                                           name="transport_accompany_relation"
                                                           value="{{old('transport_accompany_relation')}}"
                                                           placeholder="{{__("Companion's Relationship to Patient")}}"/>
                                                    @error('transport_accompany_relation')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form_column mt-3">
                                            <div class="row">
                                                <div class="btn_column form-group col-md-12">
                                                    <!-- <button type="button" class="default_btn grey_bgbtn">Save</button> -->
                                                    <button type="button" class="default_btn btn_next"
                                                            id="btn_transport">{{__('Next')}}
                                                    </button>
                                                    <!-- <button type="submit" class="default_btn grey_bgbtn">Save</button> -->
                                                    <!-- <button type="submit" class="default_btn">Next</button> -->
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="inner_tab tab-pane fade" id="tab_3" role="tabpanel"
                                         aria-labelledby="tab_3">

                                        <div class="form_column">
                                            <h5>{{__('Primary Contact')}}</h5>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <select class="form-control" name="primary_contact_title" required>
                                                        <option selected disabled="true"
                                                                value="">{{__('Title')}} *</option>
                                                        <option value="Mr" @if(old('primary_contact_title')=='Mr') selected @endif >{{__('Mr')}}</option>
                                                        <option value="Mrs" @if(old('primary_contact_title')=='Mrs') selected @endif>{{__('Mrs')}}</option>
                                                        <option value="Miss" @if(old('primary_contact_title')=='Miss') selected @endif>{{__('Miss')}}</option>
                                                       
                                                    </select>
                                                    @error('primary_contact_title')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input type="text" class="form-control" name="primary_contact_name"
                                                           value="{{old('primary_contact_name')}}"
                                                           
                                                           placeholder="{{__('Full Name')}} *" required/>
                                                    @error('primary_contact_name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <input type="email" class="form-control"
                                                           name="primary_contact_email" required 
                                                           value="{{old('primary_contact_email')}}"
                                                           placeholder="{{__('Email')}} *"/>
                                                    @error('primary_contact_email')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input type="text" class="form-control"
                                                           name="primary_contact_number" required 
                                                           value="{{old('primary_contact_number')}}"
                                                           placeholder="{{__('Mobile Number')}} *"/>
                                                    @error('primary_contact_number')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input type="text" class="form-control"
                                                           name="primary_contact_relation"
                                                           value="{{old('primary_contact_relation')}}"
                                                            required 
                                                           placeholder="{{__('Relationship to Patient')}} *"/>
                                                    @error('primary_contact_relation')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form_column mt-3">
                                            <div class="row">
                                                <div class="btn_column form-group col-md-12">
                                                    <!-- <button type="button" class="default_btn grey_bgbtn">Save</button> -->
                                                    <button type="button" class="default_btn btn_next"
                                                            id="btn_primary">{{__('Next')}}</button>
                                                    <!-- <button type="submit" class="default_btn grey_bgbtn">Save</button> -->
                                                    <!-- <button type="submit" class="default_btn">Next</button> -->
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="inner_tab tab-pane fade" id="tab_4" role="tabpanel"
                                         aria-labelledby="tab_4">

                                        <div class="form_column">
                                            <h5>{{__('Additional Information')}}</h5>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label class="mb-2"><strong>{{__('Additional Information including patient diagnosis or special clinical requirements during transport')}}</strong></label>
                                                    <textarea name="additional_information" class="form-control" cols="7" rows="4">{{old('additional_information')}}</textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                @if(config('services.recaptcha.key'))
                                                    <div class="g-recaptcha"
                                                         data-sitekey="{{ config('services.recaptcha.key') }}">
                                                    </div>
                                                @endif
                                                <label id="g-recaptcha-response-msg"  style="color: red;font-weight: 400;"></label>

                                                @error('g-recaptcha-response')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="row ">
                                                <div class="form-group col-md-12">
                                                    <div class="form-check form-check-flat">
                                                        <label class="form-check-label">
                                                            {{--                                                                <input type="checkbox" class="form-check-input" required>I hereby certify--}}
                                                            {{--                                                                that all--}}
                                                            {{--                                                                information provided in this form is complete, true and correct to the best--}}
                                                            {{--                                                                of my knowledge. <i class="input-helper"></i></label>--}}
                                                            <input type="checkbox" class="form-check-input" name="agreement" required>
                                                            {{__('By submitting this form, I understand that I am requesting a quotation for non-emergency patient transport from National Ambulance UAE and I am aware that completion of this form does not automatically guarantee approval of request. I agree to the')}} <a href="/page/terms-and-conditions" target="_blank">{{__('Terms and Conditions')}}</a> {{__('and')}} <a href="/page/privacy-policy" target="_blank">{{__('Privacy Policy')}}</a>{{__(', and certify that I have completed this form with the correct and true information to the best of my knowledge and will keep National Ambulance informed of any changes to the information.')}}*
                                                            <i class="input-helper"></i>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form_column mt-3">
                                            <div class="row">
                                                <div class="btn_column form-group col-md-12">
                                                    <button type="submit" class="default_btn btn_next ms-0">{{__('Submit')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- <div class="testimonials">
    <div class="row">
        <div class="col-md-12 text-center mb-5">
            <h2>{{__('What Clients Say')}}</h2>
            <div class="headingLine mx-auto"></div>
        </div>
    </div>
    <div class="testimonialSlider">
        @foreach($testimonials as $testimony)
            @if($testimony->category=='Non-Emergency Patient Transport (PTS)')
                <div class="testimonials_item">
                    <div class="client_info">
                        @if(app()->getLocale() == 'en')
                        <h4>{{$testimony->client_name}}</h4>
                        <span class="desgnation">{{$testimony->title}}</span>
                        <p>“{{$testimony->testimonial}}”</p>
                        @else
                        <h4>{{$testimony->client_name_ar}}</h4>
                        <span class="desgnation">{{$testimony->title_ar}}</span>
                        <p>“{{$testimony->testimonial_ar}}”</p>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div> -->
<!-- <div id="response_div">
    @if(session('success'))
        <div class="submitMsg">
            <h5 class="navyColor">
                <i class="fas fa-check"></i>
                {{ session('success') }}<br/>
            </h5>
        </div>
    @endif
    @if(session('error'))
    <div class="submitMsg">
        <h5 class="text-danger">
            <i class="fas fa-times"></i>
            {{ session('error') }}
        </h5>
    </div>
    @endif
</div> -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script type="text/javascript">
window.onload = function() {
    var $recaptcha = document.querySelector('#g-recaptcha-response');

    if($recaptcha) {
        $recaptcha.setAttribute("required", "required");
    }
};
    // var invalidElement = null;
    $(function () {

        @if(old('tranfer_type'))
        var checkedValue = "{{old('tranfer_type')}}";
            if (checkedValue === 'hospital_transfer') {
                $('.appointmentSelectedField').hide();
                $('.hospitalSelectedField').show();
                $('.hospitalSelectedField').find('input').attr("required", true);
                $('.appointmentSelectedField').find('input').removeAttr("required");
                $('.appointmentSelectedField').find('select').removeAttr("required");
                $('.hospitalSelectedField').find('select').attr("required", true);
                $('#location_gps').removeAttr("required");
            } else if (checkedValue === 'appointment_tranfer')  {
                $('.appointmentSelectedField').show();
                $('.hospitalSelectedField').hide();
                $('.appointmentSelectedField').find('input').attr("required", true);
                $('.hospitalSelectedField').find('input').removeAttr("required");
                $('.appointmentSelectedField').find('select').attr("required", true);
                $('.hospitalSelectedField').find('select').removeAttr("required");
                $('#location_gps').removeAttr("required");
            }

            initReturnTripSelect();
            initTransportAccompanySelect();
        @endif
               
        $("form").validate();
        $('.default_btn.btn_next').on('click',function(e){
            $("#g-recaptcha-response-msg").text('');

            var isError=false;
            var tabActive = $(this).parents('.inner_tab.tab-pane').attr('id');
            var index = 1;
            $(this).parents('.inner_tab.tab-pane').find('input[required], select[required], textarea[required]').each(function(){
                console.log($(this).attr('name'));
                console.log($(this).attr('name')+" : "+$(this).valid());
                if ($(this)&&!$(this).valid()){
                    // $(this).addClass('is-invalid');
                    if(index==1){
                        index++;
                        $(this).focus();
                    }
                    $(this).css("border-color", "red");
                    if($(this).attr('name')=='g-recaptcha-response'){
                        $("#g-recaptcha-response-msg").text('This field is required.');
                    }
                    isError= true;
                }else{
                    $(this).css("border-color", "green");
                    
                }
            });
            if(isError){
                    if($(this).attr('type')=='submit'){
                        swal("Error","Validation failed. Please fill the required fields in all the sections of the form.");

                    }
                e.preventDefault();
                $('#nav-tab a[href="#' + tabActive + '"]').tab('show');
            }else{
                switch (tabActive) {
                    case "tab_1":
                        $('#nav-tab a[href="#tab_2"]').tab('show');
                        break;
                    case "tab_2":
                        $('#nav-tab a[href="#tab_3"]').tab('show');
                        $('html, body').animate({
                            scrollTop: $("#tab_3").offset().top + 2200   
                        }, 500);
                        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                            $('html, body').animate({
                            scrollTop: $("#tab_3").offset().top + 4000   
                        }, 500);
                        }
                        break;
                    case "tab_3":
                        $('#nav-tab a[href="#tab_4"]').tab('show');
                        break;
                }
            }          
        });

        // $('form').submit(function () {
            // if (!$('#certifyChkBox')[0].checked) {
            //     alert(
            //         'Please do certify that all information provided here is complete, true and correct to the best of your knowledge in "Additional Information" Tab. !'
            //     );
            //     return false;
            // }else{
            //     $('#loader').show();
            // }
            // $('#loader').show();
        // });
        $('form').submit(function(e) {
            if($('form').isValid()){

                $('#loader').show();
                 }else{
e.preventDefault();
$("label[for='g-recaptcha-response']").show();

                 }
        });
        initTransferTypeSelect();

        $('input[name="pickup_date"]').change(function () {
            $('input[name="return_date"]').attr('min', $(this).val());
        });
        $('input[name="appointment_time"]').change(function () {
            var maxTime = moment($('input[name="pickup_date"]').val() + " " + $(this).val(),
                "YYYY-MM-DD HH:mm").add(4, 'hours');
            var minTime = moment($('input[name="pickup_date"]').val() + " " + $(this).val(),
                "YYYY-MM-DD HH:mm");

            //  tempDT.setHours(tempDT.getHours() + 4);
            $('input[name="return_time"]').attr('max', maxTime.format("HH:mm"));
            $('input[name="return_time"]').attr('min', minTime.format("HH:mm"));
        });
        $('#tranfer_type input[type=radio]').change(function () {
            // alert($(this).val())
            var checkedValue = $(this).val();
            if (checkedValue === 'hospital_transfer') {
                $('.appointmentSelectedField').hide();
                $('.hospitalSelectedField').show();
                $('.hospitalSelectedField').find('input').attr("required", true);
                $('.appointmentSelectedField').find('input').removeAttr("required");
                $('.hospitalSelectedField').find('select').attr("required", true);
                $('#location_gps').removeAttr("required");
            } else {
                $('.appointmentSelectedField').show();
                $('.hospitalSelectedField').hide();
                $('.appointmentSelectedField').find('input').attr("required", true);
                $('.hospitalSelectedField').find('input').removeAttr("required");
                $('.appointmentSelectedField').find('select').attr("required", true);
                $('.hospitalSelectedField').find('select').removeAttr("required");
                $('#location_gps').removeAttr("required");
            }

            initReturnTripSelect();
            initTransportAccompanySelect();
        });

        initReturnTripSelect();

        $('#return_trip_status input[type=radio]').change(function () {
            // alert($(this).val())
            var checkedValue = $(this).val();
            if (checkedValue === '0') {
                $('.journeySelectedField').hide();
                $('.journeySelectedField').find('input').removeAttr('required');

            } else {
                $('.journeySelectedField').show();
                $('.journeySelectedField').find('input').attr("required", true);
                $('.journeySelectedField').find('select').attr("required", true);
            }
        });

        initTransportAccompanySelect();

        $('#transport_accompany_status input[type=radio]').change(function () {
            // alert($(this).val())
            var checkedValue = $(this).val();
            if (checkedValue === '0') {
                $('.tripAccompanySelectedField').hide();
                $('.tripAccompanySelectedField').find('input').removeAttr('required');

            } else {
                $('.tripAccompanySelectedField').show();
                $('.tripAccompanySelectedField').find('input').attr("required", true);

            }
        });

        initPhysicianTransferSelect();

        $('#physician_transfer_status input[type=radio]').change(function () {
            // alert($(this).val())
            var checkedValue = $(this).val();
            if (checkedValue === '0') {
                $('.physicianTransferSelectedField').hide();
                $('.physicianTransferSelectedField').find('input').removeAttr('required');

            } else {
                $('.physicianTransferSelectedField').show();
                $('.physicianTransferSelectedField').find('input').attr("required", true);

            }
        });
    });

    function initTransferTypeSelect() {
        let tranfer_type_val = "hospital_transfer";
        $("#tranfer_type input[name=tranfer_type][value=" + tranfer_type_val + "]").prop('checked', true);
        $('.hospitalSelectedField').show();
        $('.hospitalSelectedField').find('input').attr("required", true);
        $('.appointmentSelectedField').hide();
        $('.appointmentSelectedField').find('input').removeAttr('required');

        $('#location_gps').removeAttr("required");
    }


    function initReturnTripSelect() {
        let return_trip_status_val = "0";
        $("#return_trip_status input[name=return_trip_status][value=" + return_trip_status_val + "]").prop('checked',
            true);
        $('.journeySelectedField').hide();
        $('.journeySelectedField').find('input').removeAttr('required');
    }

    function initTransportAccompanySelect() {
        let transport_accompany_status_val = "0";
        $("#transport_accompany_status input[name=transport_accompany_status][value=" + transport_accompany_status_val +
            "]").prop('checked', true);
        $('.tripAccompanySelectedField').hide();
        $('.tripAccompanySelectedField').find('input').removeAttr('required');
    }

    function initPhysicianTransferSelect() {
        let physician_transfer_status_val = "0";
        $("#physician_transfer_status input[name=physician_transfer_status][value=" + physician_transfer_status_val +
            "]").prop('checked', true);
        $('.physicianTransferSelectedField').hide();
        $('.physicianTransferSelectedField').find('input').removeAttr('required');
    }

    function invalidFunction(e, message) {
        // e.preventDefault();
        document.getElementById('errorHeader').innerText = message;
    }
    // transferring_hospital_emirates
    $('#transferring_hospital_emirates').change(function(){
        var receiving_emirates = $('#receiving_hospital_emirates').val();
        
        if($(this).val()=='Dubai'&&receiving_emirates=='Dubai'){
            swal('info','This service is not within our coverage area');
            $(this).val(null);
            $('#receiving_hospital_emirates').val(null);
        }
    });
    $('#receiving_hospital_emirates').change(function(){
        var receiving_emirates = $('#transferring_hospital_emirates').val();
        
        if($(this).val()=='Dubai'&&receiving_emirates=='Dubai'){
            swal('info','This service is not within our coverage area');
            $(this).val(null);
            $('#transferring_hospital_emirates').val(null);
        }
    });
    // receiving_hospital_emirates

</script>

<script>
	function addHyphen (element) {
    	let ele = document.getElementById(element.id);
        ele = ele.value;   
        let finalVal=ele;
        if(ele.length==3){
            finalVal = ele+"-";
        }else if(ele.length==8){
            finalVal = ele+"-";
        }else if(ele.length==16){
            finalVal = ele+"-";
        }else if(ele.length>18){
            finalVal = ele.slice(0, -1);
        }
        document.getElementById(element.id).value = finalVal;
    }
</script>
<!-- Non Emergency Patient Transport Service Form -->