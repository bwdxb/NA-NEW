@php
    use app\Http\helper\Helper as Helper;
    $countries = Helper::getAllCountries();
    $country_codes = Helper::getAllCountryCodes();
    $organization_type = Helper::getAllOrganizationType();
    $tenders = Helper::getAllTenders();
    $content = Helper::getSupplyChainContent();
@endphp
<div class="row">

    <div class="col-md-12">
        @if(app()->getLocale() == 'en')
            {!!$content->description!!}
        @else
            {!!$content->description_ar!!}
        @endif
        <div class="accordion" id="spl_accordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" >
                        {{__('Supplier Registration Form')}}
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
                    <div class="accordion-body">
                        <p>{{__('Thank you for your interest in becoming a supplier for National Ambulance. Please note that filling the National Ambulance’s Supplier Registration Form does not automatically place your company on our approved supplier database nor does it mean that your company is eligible to receive tender invitations. We reserve the right to refrain from responding to rejecting/approving your application. We may consider contacting you should an opportunity that matches your company’s product(s) or service(s) arises. Approved vendors will receive a confirmation email after the registration process is completed successfully.')}}</p>
                        <div class="form_panel">
                            <!-- <div id="msgregister"></div> -->
                            <div class="customTabs">
                                <ul class="nav nav-tabs step_list" id="nav-tab" role="tablist">
                                    <li><a class="nav-link active" href="#step_1" data-bs-toggle="tab"
                                           data-bs-target="#step_1" role="tab" id="tab_1" aria-controls="step_1"
                                           aria-selected="true">{{__('General Information')}}</a></li>
                                    <li><a class="nav-link" href="#step_2" data-bs-toggle="tab" data-bs-target="#step_2"
                                           role="tab" id="tab_2" aria-controls="step_2"
                                           aria-selected="false">{{__('Banking Information')}}</a></li>
                                    <li><a class="nav-link" href="#step_3" data-bs-toggle="tab" data-bs-target="#step_3"
                                           role="tab" id="tab_3" aria-controls="step_3"
                                           aria-selected="false">{{__('Products and Services')}}</a></li>
                                    <li><a class="nav-link" href="#step_4" data-bs-toggle="tab" data-bs-target="#step_4"
                                           role="tab" id="tab_4" aria-controls="step_4"
                                           aria-selected="false">{{__('Certification')}}</a>
                                    </li>
                                </ul>

                                <div class="tab-content" id="nav-tabContent">
                                    <div class="inner_tab tab-pane show active" id="step_1" role="tabpanel"
                                         aria-labelledby="step_1">
                                        <form class="generalForm" id="SupplierFirstStep" name="SupplierFirstStep"
                                              enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="form_column">
                                                <h5>{{__('General Information')}}</h5> 
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <input type="text" class="form-control" name="organization_name"
                                                               placeholder="{{__('Legal Name of Organisation')}} *"
                                                               required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <select id="inputCountry" name="country_id"
                                                                class="form-control serachSelect" required>
                                                            <option value="">{{__('Country')}}</option>
                                                            @foreach($countries as $key=>$country)
                                                                <option value="{{$country}}">{{$country}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <select id="orgType" name="organization_type_id"
                                                                class="form-control" required
                                                                onchange="displayTextBox(this.value);">
                                                            <option value="">{{__('Organisation Type')}}</option>
                                                            @foreach($organization_type as $organization)
                                                                <option value="{{$organization->id}}">
                                                                    @if(app()->getLocale() == 'en')
                                                                        {{$organization->type}}
                                                                    @else
                                                                        {{$organization->type_ar}}
                                                                    @endif
                                                                </option>
                                                            @endforeach
                                                            <option value="other">{{__('Other')}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6" id="organization_type"
                                                         style="display:none;">
                                                        <input type="text" class="form-control" name="organization_type"
                                                               placeholder="{{__('Organization Type')}}">
                                                        <span for="organization_type" generated="true" class="error">This field is required.</span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <input type="text" class="form-control"
                                                               name="tax_registration_no" required
                                                               placeholder="{{__('TAX Registration Number (TRN)')}} *">
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <input type="text" name="registration_address" required
                                                               class="form-control"
                                                               placeholder="{{__('Registered Address')}} *">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <input type="text" name="name" class="form-control" required
                                                               placeholder="{{__('Contact Full Name')}} *">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <input type="email" name="email " class="form-control" required
                                                               placeholder="{{__('Email')}} *">
                                                    </div>

                                                    <div class="form-group halfColumn">
                                                        <div class="col-md-4 col-sm-12">
                                                            <select id="countryCode" name="country_code"
                                                                    class="form-control serachSelect">
                                                                <option value="">{{__('Country Code')}}</option>
                                                                @foreach($country_codes as $key=>$code)
                                                                    <option value="{{$code}}">{{$key}}
                                                                         {{" "}}+{{$code}}</option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                        <div class="col-md-8 col-sm-12">
                                                            <input type="text" name="mobile" class="form-control"
                                                                   required
                                                                   placeholder="{{__('Mobile Number')}} *">
                                                        </div>
                                                    </div>
                                                    <div class="form-group halfColumn">
                                                        <div class="col-md-4 col-sm-12">
                                                            <input name="area_code" class="form-control"
                                                                   placeholder="{{__('Area Code')}}" type="text">
                                                        </div>
                                                        <div class="col-md-8 col-sm-12">
                                                            <input type="text" name="landline_no" class="form-control"
                                                                   placeholder="{{__('Landline Number')}}">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <div class="custom-file">
                                                            <label for="formFileLg"
                                                                   class="form-label">{{__('Please provide a copy of valid trade/ commercial license')}}*</label>
                                                            <div class="customFile">
                                                                <input class="form-control file-size-limit" id="trade_license_file"
                                                                       type="file" name="trade_license_file"
                                                                       onchange="licenseFile()" required>
                                                                <span class="file_label"
                                                                      id="licensefileLabel">{{__('Upload File')}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="organization_website" class="form-label"
                                                               style="margin-top:15px"></label>
                                                        <input type="text" id="organization_website"
                                                               name="organization_website" class="form-control"
                                                               placeholder="{{__('Organisation Website')}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form_column">
                                                <div class="row">
                                                    <div class="btn_column form-group col-md-12">
                                                        <!-- <button type="button"  class="default_btn grey_bgbtn">Previous</button>-->
                                                        <button type="submit" id="firstStepButton" class="default_btn " >
                                                            {{__('Next')}}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="inner_tab tab-pane fade" id="step_2" role="tabpanel"
                                         aria-labelledby="step_2">
                                        <form class="financialForm" id="SupplierSecondStep" name="SupplierSecondStep"
                                              enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <input type="hidden" name="supplier_id" id="supplier_id" value=""/>
                                            <h5>{{__('Banking Information')}}</h5>
                                            <div class="form_column">
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <input type="name" name="bank_name" class="form-control"
                                                               placeholder="{{__('Bank Name')}} *" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <input type="text" name="branch_name" class="form-control"
                                                               placeholder="{{__('Branch Name')}} *" required>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="form-group col-md-6">
                                                        <select id="inputCurrency" name="currency" class="form-control"
                                                                required>
                                                            <option value="">{{__('Account Currency')}}</option>
                                                            <option value="AED">{{__('AED')}}</option>
                                                            <option value="USD">{{__('USD')}}</option>
                                                            <option value="GBP">{{__('GBP')}}</option>
                                                            <option value="Euro">{{__('Euro')}}</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <input type="text" name="account_no" class="form-control"
                                                               placeholder="{{__('Account Number')}} *" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <input type="text" name="iban" class="form-control"
                                                               placeholder="{{__('IBAN')}} *" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form_column">
                                                <div class="row">
                                                    <div class="btn_column form-group col-md-12">
                                                        <button type="button" class="default_btn grey_bgbtn"
                                                                onclick="goToFirst();">{{__('Previous')}}
                                                        </button>
                                                        <button type="button" id="secondStepButton" class="default_btn " >
                                                            {{__('Next')}}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="inner_tab tab-pane fade" id="step_3" role="tabpanel"
                                         aria-labelledby="step_3">
                                        <form class="servicesForm" id="SupplierThirdStep" name="SupplierThirdStep"
                                              enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="form_column">
                                                <h5>{{__('Products and Services')}}</h5>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <select class="form-control" name="service_type" required
                                                                onchange="displayServiceTextbox(this.value)">
                                                            <option value=""> {{__('Products/ Services Type')}}</option>
                                                            <option value="Medical Supplies">{{__('Medical Supplies')}}</option>
                                                            <option value="Medical Services">{{__('Medical Services')}}</option>
                                                            <option value="IT Supplies">{{__('IT Supplies')}}</option>
                                                            <option value="Auto Trading"> {{__('Auto Trading')}}</option>
                                                            <option value="Vehicle Repair/ Maintenance">{{__('Vehicle Repair/ Maintenance')}}
                                                            </option>
                                                            <option value="General Maintenance & Repair">{{__('General Maintenance & Repair')}}
                                                            </option>
                                                            <option value="Printing & Stationary">{{__('Printing & Stationary')}}
                                                            </option>
                                                            <option value="Office Supplies"> {{__('Office Supplies')}}</option>
                                                            <option value="Car Rental">{{__('Car Rental')}}</option>
                                                            <option value="Tailoring, Fashion & Uniforms">{{__('Tailoring, Fashion & Uniforms')}}
                                                            </option>
                                                            <option value="Consultancy">{{__('Consultancy')}}</option>
                                                            <option value="Audit">{{__('Audit')}}</option>
                                                            <option value="Media">{{__('Media')}}</option>
                                                            <option value="Fire Safety"> {{__('Fire Safety')}}</option>
                                                            <option value="Interior Design/ Civil Work">{{__('Interior Design/ Civil Work')}}
                                                            </option>
                                                            <option value="other">{{__('Other')}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6" id="other_service"
                                                         style="display:none;">

                                                        <input type="text" name="other_service" class="form-control"
                                                               placeholder="Other Service Type"/>
                                                        <span for="other_service" generated="true" class="error">This field is required.</span>

                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <select id="inputCountry" class="form-control"
                                                                name="supplier_type" required>
                                                            <option value="">{{__('Supplier Type')}}</option>
                                                            <option value="Authorised Distributor">{{__('Authorised Distributor')}}</option>
                                                            <option value="Wholesaler">{{__('Wholesaler')}}</option>
                                                            <option value="Manufacturer">{{__('Manufacturer')}}</option>
                                                            <option value="Trading Company or Authorised Agent">{{__('Trading Company or Authorised Agent')}}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <h6>
                                                            {{__('Do you provide warranty and/ or maintenance for your products/ services?')}}
                                                        </h6>
                                                        <div class="radio_row">
                                                            <strong>{{__('Warranty')}}</strong>
                                                            <label class="radio">{{__('Available')}}
                                                                <input type="radio" name="warrenty" value="yes">
                                                                <span class="checkround"></span>
                                                            </label>
                                                            <label class="radio">{{__('Not Available')}}
                                                                <input type="radio" name="warrenty" value="no"
                                                                       checked="checked">
                                                                <span class="checkround"></span>
                                                            </label>
                                                        </div>
                                                        <div class="radio_row">
                                                            <strong>{{__('Maintenance')}}</strong>
                                                            <label class="radio">{{__('Available')}}
                                                                <input type="radio" name="maintenance" value="yes">
                                                                <span class="checkround"></span>
                                                            </label>
                                                            <label class="radio">{{__('Not Available')}}
                                                                <input type="radio" name="maintenance" value="no"
                                                                       checked="checked">
                                                                <span class="checkround"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form_column">
                                                <div class="row">
                                                    <div class="btn_column form-group col-md-12">
                                                        <button type="button" class="default_btn grey_bgbtn"
                                                                onclick="goToSecond();">{{__('Previous')}}
                                                        </button>
                                                        <button type="button" id="thirdStepButton" class="default_btn " >
                                                            {{__('Next')}}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="inner_tab tab-pane fade" id="step_4" role="tabpanel"
                                         aria-labelledby="step_4">
                                        <form class="QHSEform" id="SupplierFourStep" name="SupplierFourStep"
                                              enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="form_column">
                                                <h5>{{__('Quality, Health, Safety and Environment')}}</h5>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <h6>{{__('Confirm your organisation has Quality (ISO 9001),Occupational Health and Safety ISO 45001, and/ or Environment (ISO 14001), or equivalent certifications')}}</h6>
                                                        <h5>{{__('ISO 9001')}}</h5>
                                                        <div class="radio_row">
                                                            <label class="radio">{{__('Available')}}
                                                                <input type="radio" name="ISO_9001" class="iso_class"
                                                                       value="yes">
                                                                <span class="checkround"></span>

                                                            </label>
                                                            <label class="radio">{{__('Not Available')}}
                                                                <input type="radio" name="ISO_9001" value="no"
                                                                       class="iso_class" checked="checked">
                                                                <span class="checkround"></span>
                                                            </label>
                                                        </div>
                                                        <div class="custom-file mt-4">
                                                            <label for="formFileLg"
                                                                   class="form-label">{{__('Attachment')}}</label>
                                                            <div class="customFile">
                                                                <input class="form-control file-size-limit" id="iso_9001_file"
                                                                       type="file"
                                                                       name="iso_9001_file" onchange="isoFile()">
                                                                <span class="file_label"
                                                                      id="isofileLabel">{{__('Upload File')}}</span>
                                                                <span id="iso_error"></span>
                                                            </div>
                                                        </div>
                                                        <br/>
                                                        <h5>{{__('ISO 45001')}}</h5>
                                                        <div class="radio_row">
                                                            <label class="radio">{{__('Available')}}
                                                                <input type="radio" name="ISO_45001" class="iso_class"
                                                                       value="yes">
                                                                <span class="checkround"></span>

                                                            </label>
                                                            <label class="radio">{{__('Not Available')}}
                                                                <input type="radio" name="ISO_45001" value="no"
                                                                       class="iso_class" checked="checked">
                                                                <span class="checkround"></span>
                                                            </label>
                                                        </div>
                                                        <div class="custom-file mt-4">
                                                            <label for="formFileLg"
                                                                   class="form-label">{{__('Attachment')}}</label>
                                                            <div class="customFile">
                                                                <input class="form-control file-size-limit" id="iso_45001_file"
                                                                       type="file"
                                                                       name="iso_45001_file" onchange="isoFile1()">
                                                                <span class="file_label"
                                                                      id="isofileLabel1">{{__('Upload File')}}</span>
                                                                <span id="iso_error"></span>
                                                            </div>
                                                        </div>
                                                        <br/>
                                                        <h5>{{__('ISO 14001')}}</h5>
                                                        <div class="radio_row">
                                                            <label class="radio">{{__('Available')}}
                                                                <input type="radio" name="ISO_14001" class="iso_class"
                                                                       value="yes">
                                                                <span class="checkround"></span>

                                                            </label>
                                                            <label class="radio">{{__('Not Available')}}
                                                                <input type="radio" name="ISO_14001" value="no"
                                                                       class="iso_class" checked="checked">
                                                                <span class="checkround"></span>
                                                            </label>
                                                        </div>
                                                        <div class="custom-file mt-4">
                                                            <label for="formFileLg"
                                                                   class="form-label">{{__('Attachment')}}</label>
                                                            <div class="customFile">
                                                                <input class="form-control file-size-limit" id="iso_14001_file"
                                                                       type="file"
                                                                       name="iso_14001_file" onchange="isoFile2()">
                                                                <span class="file_label"
                                                                      id="isofileLabel2">{{__('Upload File')}}</span>
                                                                <span id="iso_error"></span>
                                                            </div>
                                                        </div>
                                                        <br/>
                                                        <h5>{{__('Equivalent Certifications')}}</h5>
                                                        <div class="radio_row">
                                                            <label class="radio">{{__('Available')}}
                                                                <input type="radio" name="equivalent_certifications"
                                                                       class="iso_class" value="yes">
                                                                <span class="checkround"></span>

                                                            </label>
                                                            <label class="radio">{{__('Not Available')}}
                                                                <input type="radio" name="equivalent_certifications"
                                                                       value="no" class="iso_class" checked="checked">
                                                                <span class="checkround"></span>
                                                            </label>
                                                        </div>
                                                        <div class="custom-file mt-4">
                                                            <label for="formFileLg"
                                                                   class="form-label">{{__('Attachment')}}</label>
                                                            <div class="customFile">
                                                                <input class="form-control file-size-limit"
                                                                       id="equivalent_certifications_file" type="file"
                                                                       name="equivalent_certifications_file[]" multiple
                                                                       
                                                                       onchange="javascript:updateList()"
                                                                       >
                                                                <span class="file_label"
                                                                      id="equfileLabel">{{__('Upload File')}}</span>
                                                                <span id="iso_error"></span>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <h6>{{__('Confirm your organisation holds the licenses required to provide the products and/or services (e.g. hazardous, medical waste license, etc.):')}}</h6>
                                                        <div class="radio_row">
                                                            <label class="radio">{{__('Available')}}
                                                                <input type="radio" name="licence" value="yes">
                                                                <span class="checkround"></span>
                                                            </label>
                                                            <label class="radio">{{__('Not Available')}}
                                                                <input type="radio" name="licence" value="no"
                                                                       checked="checked">
                                                                <span class="checkround"></span>
                                                            </label>
                                                        </div>
                                                        <div class="custom-file mt-4">
                                                            <label for="formFileLg"
                                                                   class="form-label">{{__('Attachment')}}</label>
                                                            <div class="customFile">
                                                                <input class="form-control file-size-limit" id="licence_file"
                                                                       type="file"
                                                                       name="licence_file" onchange="licenceFile2()">
                                                                <span class="file_label"
                                                                      id="licenceLabel">{{__('Upload File')}}</span>
                                                                <span id="licence_error"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <h6>{{__('Provide a copy of the indemnity insurance related to the products and services provided:')}}</h6>
                                                        <div class="radio_row">
                                                            <label class="radio">{{__('Available')}}
                                                                <input type="radio" name="indemnity_insurance"
                                                                       value="yes">
                                                                <span class="checkround"></span>
                                                            </label>
                                                            <label class="radio">{{__('Not Available')}}
                                                                <input type="radio" name="indemnity_insurance"
                                                                       value="no" checked="checked">
                                                                <span class="checkround"></span>
                                                            </label>
                                                        </div>
                                                        <div class="custom-file mt-4">

                                                            <label for="formFileLg"
                                                                   class="form-label">{{__('Attachment')}}</label>
                                                            <div class="customFile">
                                                                <input class="form-control file-size-limit" id="formFileLg" type="file"
                                                                       name="indemnity_insurance_file"
                                                                       onchange="formFile()">
                                                                <span class="file_label"
                                                                      id="formFileLabel">{{__('Upload File')}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <h6>{{__('Provide MSDC and/or safety certificates for products and services provided:')}}</h6>
                                                        <div class="radio_row">
                                                            <label class="radio">{{__('Available')}}
                                                                <input type="radio" name="MSDC_certificate" value="yes">
                                                                <span class="checkround"></span>
                                                            </label>
                                                            <label class="radio">{{__('Not Available')}}
                                                                <input type="radio" name="MSDC_certificate" value="no" checked="checked">
                                                                <span class="checkround"></span>
                                                            </label>
                                                        </div>
                                                        <div class="custom-file mt-4">
                                                            <label for="formFileLg"
                                                                   class="form-label">{{__('Attachment')}}</label>
                                                            <div class="customFile">
                                                                <input class="form-control file-size-limit" id="MSDC_certificate_file"
                                                                       type="file"
                                                                       name="MSDC_certificate_file"
                                                                       onchange="MSDCfile()">
                                                                <span class="file_label"
                                                                      id="MSDCfileLabel">{{__('Upload File')}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check mt-4">
                                                            <input class="form-check-input" type="checkbox" required
                                                                   id="flexCheckChecked">
                                                            <label class="form-check-label fw-normal"
                                                                   for="flexCheckChecked">
                                                                {{__('By submitting this form, I certify that all information provided is complete, true and correct to the best of my knowledge. I agree to the')}}
                                                                <a href="/page/terms-and-conditions">{{__('Terms and Conditions')}}</a> {{__('and')}}
                                                                <a href="/page/privacy-policy">{{__('Privacy Policy')}}</a> {{__(', and understand that filling the National Ambulance’s Supplier Registration Form does not automatically place my company on their approved supplier database. I also understand that National Ambulance reserves the right to refrain from responding or rejecting/ approving my application.')}}
                                                                *
                                                            </label> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form_column">
                                                <div class="row">
                                                    @if(config('services.recaptcha.key'))
                                                        <div class="g-recaptcha mt-2"
                                                             data-sitekey="{{ config('services.recaptcha.key') }}">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form_column">
                                                <div class="row">
                                                    <div class="btn_column form-group col-md-12">


                                                        <button type="button" class="default_btn grey_bgbtn"
                                                                onclick="goToThird();">{{__('Previous')}}
                                                        </button>
                                                        <button type="submit" id="fourStepButton" class="default_btn">
                                                            {{__('Submit')}}
                                                        </button>
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
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        {{__('Contact Information')}}
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo">
                    <div class="accordion-body d-flex">
                        <div class="col-md-12">
                            <div class="contactBlock">
                                <div class="contactRow">
                                    <i class="contact_icon"><img
                                                src="{{asset('public/website/images/contact-user.svg')}}"></i>
                                    <label>{{__('Contact Us')}}</label>
                                    <span>{{__('Do you have a question or require more information? Send us a message and our team will get back to you as soon as possible.')}}<br><a
                                                class="FeedbackLink"
                                                href="/contact-us?type=Procurement and Supply Chain#contactForm1">{{__('Send Message')}}</a></span>
                                                
                                </div>
                                <div class="contactRow">
                                    <i class="contact_icon"><img
                                                src="{{asset('public/website/images/contact-phone.svg')}}"></i>
                                    <label>{{__('Phone Number')}}</label>
                                    <span dir="ltr">+971 2 596 8600</span>
                                </div>
                                <div class="contactRow">
                                    <i class="contact_icon"><img
                                                src="{{asset('public/website/images/contact-fax.svg')}}"></i>
                                    <label>{{__('Fax Number')}}</label>
                                    <span dir="ltr">+971 2 4412266</span>


                                </div>
                                <div class="contactRow">
                                    <i class="contact_icon"><img
                                                src="{{asset('public/website/images/contact-postbox.svg')}}"></i>
                                    <label>{{__('PO Box')}}</label>
                                    <span>{{__('63788, Abu Dhabi, UAE')}}</span>
                                </div>
                                <div class="contactRow">
                                    <i class="contact_icon"><img
                                                src="{{asset('public/website/images/working-hours.svg')}}"></i>
                                    <label>{{__('Working Hours')}}</label>
                                    <span>{{__('7:30 AM- 4:00 PM')}}</span>
                                </div>
                                <div class="contactRow">
                                    <i class="contact_icon"><img
                                                src="{{asset('public/website/images/contact-location.svg')}}"></i>
                                    <label>{{__('Address')}}</label>
                                    <span>{{__('Kizad A8')}}<br>{{__('Industrial Unit # IU01, IU02 and IU03',)}}<br>{{__('Al Samha Abu Dhabi')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="contactMap">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3624.207902010705!2d54.727406414592764!3d24.719741784120515!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5e55eafe1316eb%3A0x1df77307b1e1d1ab!2sNational%20Ambulance%20Warehouse%20Facility%20(KIZAD)!5e0!3m2!1sen!2sin!4v1626677366173!5m2!1sen!2sin"
                                        width="100%" height="450" class="locationMap" style="border:0;"
                                        allowfullscreen="" loading="lazy"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        {{__('Tenders')}}
                    </button>
                </h2> 
                <!--<p>{{__('There are no current tenders available.')}}</p>-->               
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree">
                    <div class="accordion-body d-flex flex-wrap">
                        @if(!empty($tenders->toArray()))
                            @foreach($tenders as $tender)
                                <div class="col-md-12">                                    
                                    <div class="tenderWrapper">
                                        <div class="tenderRow">
                                            <label>{{__('Tender Name')}}</label>
                                            <span>
                                        @if(app()->getLocale() == 'en')
                                                    {{$tender->name}}
                                                @else
                                                    {{$tender->name_ar}}
                                                @endif
                                    </span>
                                        </div>
                                        <div class="tenderRow">
                                            <label>{{__('Description')}}</label>
                                            @if(app()->getLocale() == 'en')
                                                {!! $tender->description !!}
                                            @else
                                                {!! $tender->description_ar !!}
                                            @endif
                                        </div>
                                        <div class="tenderRow">
                                            <label>{{__('Issue Date')}}</label>
                                            <span>{{date('d m Y', strtotime($tender->publishing_date))}}</span>
                                        </div>
                                        <div class="tenderRow">
                                            <label>{{__('Closing Date')}}</label>
                                            <span>{{date('d m Y', strtotime($tender->closing_date))}}</span>
                                        </div>
                                        @if($tender->upload_file)
                                            <div class="tenderRow">
                                                <label>{{__('Download File')}}</label>
                                                <span><a href="{{ url('download',$tender->id)}}"><img
                                                                src="{{asset('public/website/images/download-icon.svg')}}"></a></span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                            <div class="col-md-6">
                                @if(Session::has('message'))
                                    <div class="alert {{ Session::get('alert-class', 'alert-success') }}"
                                         style="margin-top: 15px;">
                                        <div style="display:inline-block" id="">
                                            {{ Session::get('message') }}
                                        </div>
                                    </div>
                                @endif
                                @if(Session::has('error'))
                                    <div class="alert {{ Session::get('alert-class', 'alert-danger') }}"
                                         style="margin-top: 15px;">
                                        <div style="display:inline-block" id="">
                                            {{ Session::get('error') }}
                                        </div>
                                    </div>
                                @endif


                                @if($tenders[0]->upload_file == '')
                                    <form method="post" class="tenderForm form_panel" action="{{route('interest_store')}}"
                                          name="addExpressInterest" id="addExpressInterest">
                                        {{csrf_field()}}
                                        <div class="form_column">
                                            <h5 class="mb-3">{{__('Expression of Interest Form')}}</h5>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <input type="text" name="name" class="form-control"
                                                           placeholder="{{__('Name')}}*">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input type="email" name="email" class="form-control"
                                                           placeholder="{{__('Email')}}*">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <input type="text" name="company" class="form-control"
                                                           placeholder="{{__('Company Name')}}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <select id="orgType" class="form-control" name="tender_id">
                                                        <option value="">{{__('Tender Name')}}</option>
                                                        @foreach($tenders as $tender)
                                                            <option value="{{$tender->id}}">
                                                                @if(app()->getLocale() == 'en')
                                                                    {{$tender->name}}
                                                                @else
                                                                    {{$tender->name_ar}}
                                                                @endif
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <input type="text" name="phone" class="form-control"
                                                           placeholder="{{__('Phone Number')}}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input type="text" name="landline" class="form-control"
                                                           placeholder="{{__('LandLine Number')}}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                    <textarea class="form-control" name="comment" placeholder="{{__('Comments')}}"
                                              rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form_column">
                                            <div class="row">
                                                <div class="btn_column form-group col-md-12">
                                                    <button type="submit" class="default_btn">{{__('Send')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                                @endif
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /End button popover  -->


@section('script')
<link rel="stylesheet" href="{{asset('public/website/css/selectize.bootstrap.min.css')}}">
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script type="text/javascript">
 window.onload = function() {
        var $recaptcha = document.querySelector('#g-recaptcha-response');
        if($recaptcha) {
            $recaptcha.setAttribute("required", "required");
        }
    };
    function displayTextBox(val) {
        if (val == 'other') {
            $('#organization_type').show();
        } else {
            $('#organization_type').hide();
        }
    }

    function displayServiceTextbox(val) {
        if (val == 'other') {
            $('#other_service').show();
        } else {
            $('#other_service').hide();
        }
    }
    updateList = function() {
    var input = document.getElementById('equivalent_certifications_file');
    console.log(input);
    console.log(input.files);
    var output = document.getElementById('equfileLabel');
    var children = "";
    for (var i = 0; i < input.files.length; ++i) {
        children += '<li>' + input.files.item(i).name + '</li>';
    }
    output.innerHTML = '<ul>'+children+'</ul>';
};

</script>


@endsection