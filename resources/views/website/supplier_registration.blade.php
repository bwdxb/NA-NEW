<style>
    .error {
        color: #FF0000
    }
</style>
@extends('layouts.index')
@section('content')


    <section class="pageBanner">
        <div class="pageHeading">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>{{__('How We Work')}}</h1>
                        <span class="subTitle">{{__('National Ambulance')}}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pageBreadcrumbs">
        <div class="container">
            <div class="row">
                <nav aria-label="breadcrumb" class="col-md-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">{{__('Home')}}</a></li>
                        <li class="breadcrumb-item"><a href="#">{{__('Library')}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('Data')}}</li>
                    </ol>
                </nav>
                contact
            </div>
        </div>
    </section>
    <!--pageBreadcrumbs end-->
    <section class="pageWrapper section_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="wrapTitle mb-4">Supply Chain</h2>
                </div>
                <div class="col-md-12">
                    <div class="accordion" id="spl_accordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    {{__('Supplier Registration Forms')}}
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                 data-bs-parent="#spl_accordion">
                                <div class="accordion-body">
                                    <div class="form_panel">
                                        <div id="msgregister"></div>
                                        <div class="customTabs">
                                            <ul class="nav nav-tabs step_list" id="nav-tab" role="tablist">
                                                <li><a class="nav-link active" href="#step_1" data-bs-toggle="tab"
                                                       data-bs-target="#step_1" role="tab" id="tab_1"
                                                       aria-controls="step_1" aria-selected="true">{{__('General
                                                        Information')}}</a></li>
                                                <li><a class="nav-link" href="#step_2" data-bs-toggle="tab"
                                                       data-bs-target="#step_2" role="tab" id="tab_2"
                                                       aria-controls="step_2" aria-selected="false">Financial
                                                        Information</a></li>
                                                <li><a class="nav-link" href="#step_3" data-bs-toggle="tab"
                                                       data-bs-target="#step_3" role="tab" id="tab_3"
                                                       aria-controls="step_3" aria-selected="false">Products and
                                                        Services</a></li>
                                                <li><a class="nav-link" href="#step_4" data-bs-toggle="tab"
                                                       data-bs-target="#step_4" role="tab" id="tab_4"
                                                       aria-controls="step_4" aria-selected="false">QHSE</a></li>
                                            </ul>

                                            <div class="tab-content" id="nav-tabContent">
                                                <div class="inner_tab tab-pane show active" id="step_1" role="tabpanel"
                                                     aria-labelledby="step_1">
                                                    <!-- <form class="generalForm" id="SupplierFirstStep"
                                                          name="SupplierFirstStep" enctype="multipart/form-data"> -->
                                                        {{csrf_field()}}
                                                        <div class="form_column">
                                                            <h5>General Information</h5>
                                                            <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <input type="name" name="first_name"
                                                                           class="form-control"
                                                                           placeholder="First Name *">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <input type="name" name="last_name"
                                                                           class="form-control" placeholder="Last Name">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <input type="email" name="email"
                                                                           class="form-control" placeholder="Email*">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <select id="inputCountry" name="country_id"
                                                                            class="form-control">
                                                                        <option value="">Country</option>
                                                                        @foreach($countries as $key=>$country)
                                                                            <option value="{{$key}}">{{$country}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <select id="orgType" name="organization_type_id"
                                                                            class="form-control">
                                                                        <option value="">Organisation Type</option>
                                                                        @foreach($organization_type as $key=>$organization)
                                                                            <option value="{{$key}}">
                                                                                @if(app()->getLocale() == 'en')
                                                                                    {{$organization}}
                                                                                @else
                                                                                    {{$organization_ar}}
                                                                                @endif

                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <input type="text" class="form-control"
                                                                           name="tax_registration_no"
                                                                           placeholder="TAX Registration Number (TRN)">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group halfColumn">
                                                                    <div class="col-md-4">
                                                                        <input name="country_code" class="form-control"
                                                                               placeholder="Country Code" type="text">
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <input type="text" name="mobile"
                                                                               class="form-control"
                                                                               placeholder="Phone Number">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group halfColumn">
                                                                    <div class="col-md-4">
                                                                        <input name="area_code" class="form-control"
                                                                               placeholder="Area Code" type="text">
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <input type="text" name="landline_no"
                                                                               class="form-control"
                                                                               placeholder="Landline Number">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <input type="text" name="registration_address"
                                                                           class="form-control"
                                                                           placeholder="Registered Address">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <div class="custom-file">
                                                                        <label for="formFileLg" class="form-label">Please
                                                                            provide a copy of your industrial and/or
                                                                            trade license:</label>
                                                                        <input class="form-control file-size-limit" id="formFileLg"
                                                                               type="file" name="trade_license_file" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form_column">
                                                            <div class="row">
                                                                <div class="btn_column form-group col-md-12">
                                                                    <!-- <button type="button"  class="default_btn grey_bgbtn">Previous</button>-->
                                                                    <button type="button" id="firstStepButton"
                                                                            class="default_btn">Next
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <!-- </form> -->
                                                </div>
                                                <div class="inner_tab tab-pane fade" id="step_2" role="tabpanel"
                                                     aria-labelledby="step_2">
                                                    <form class="financialForm" id="SupplierSecondStep"
                                                          name="SupplierSecondStep" enctype="multipart/form-data">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="supplier_id" id="supplier_id"
                                                               value=""/>
                                                        <h5>Financial Information</h5>
                                                        <div class="form_column">
                                                            <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <input type="name" name="bank_name"
                                                                           class="form-control" placeholder="Bank Name">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <input type="text" name="branch_name"
                                                                           class="form-control"
                                                                           placeholder="Branch Name">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group halfColumn">
                                                                    <div class="col-md-4">
                                                                        <select id="inputCurrency" name="currency"
                                                                                class="form-control">
                                                                            <option selected>Currency:</option>
                                                                            <option value="USD">USD</option>
                                                                            <option value="AUD">AUD</option>
                                                                            <option value="Euro">Euro</option>

                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <input type="text" name="amount"
                                                                               class="form-control"
                                                                               placeholder="Enter Amount">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <input type="text" name="account_no"
                                                                           class="form-control"
                                                                           placeholder="Account Number">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <input type="text" name="iban" class="form-control"
                                                                           placeholder="IBAN">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form_column">
                                                            <div class="row">
                                                                <div class="btn_column form-group col-md-12">
                                                                    <button type="button" class="default_btn grey_bgbtn"
                                                                            onclick="goToFirst();">Previous
                                                                    </button>
                                                                    <button type="button" id="secondStepButton"
                                                                            class="default_btn">Next
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="inner_tab tab-pane fade" id="step_3" role="tabpanel"
                                                     aria-labelledby="step_3">
                                                    <form class="servicesForm" id="SupplierThirdStep"
                                                          name="SupplierThirdStep" enctype="multipart/form-data">
                                                        {{csrf_field()}}
                                                        <div class="form_column">
                                                            <h5>Products and Services</h5>
                                                            <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <select class="form-control" name="service_type">
                                                                        <option value="">Services Type</option>
                                                                        <option value="Medical Supplies">Medical
                                                                            Supplies
                                                                        </option>
                                                                        <option value="Medical Services">Medical
                                                                            Services
                                                                        </option>
                                                                        <option value="Auto Trading"> Auto Trading
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <select id="inputCountry" class="form-control"
                                                                            name="distributor">
                                                                        <option value="Authorised Distributor">
                                                                            Authorised Distributor
                                                                        </option>
                                                                        <option value="Wholesaler">Wholesaler</option>
                                                                        <option value="Manufacturer">Manufacturer
                                                                        </option>
                                                                        <option value="Trading">Trading</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <h6>
                                                                        Do you Provide Warranty/ Maintenance for your
                                                                        Goods/ Services?
                                                                    </h6>
                                                                    <div class="radio_row">
                                                                        <strong>Warranty</strong>
                                                                        <label class="radio">Available
                                                                            <input type="radio" name="warrenty"
                                                                                   value="yes">
                                                                            <span class="checkround"></span>
                                                                        </label>
                                                                        <label class="radio">Not Available
                                                                            <input type="radio" name="warrenty"
                                                                                   value="no" checked="checked">
                                                                            <span class="checkround"></span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="radio_row">
                                                                        <strong>Maintenance</strong>
                                                                        <label class="radio">Available
                                                                            <input type="radio" name="maintenance"
                                                                                   value="yes">
                                                                            <span class="checkround"></span>
                                                                        </label>
                                                                        <label class="radio">Not Available
                                                                            <input type="radio" name="maintenance"
                                                                                   value="no" checked="checked">
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
                                                                            onclick="goToSecond();">Previous
                                                                    </button>
                                                                    <button type="button" id="thirdStepButton"
                                                                            class="default_btn">Next
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
                                                            <h5>QUALITY (ISO 9000), HEALTH AND SAFETY (ISO45001),
                                                                ENVIRONMENTAL (ISO14001</h5>
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <h6>Confirm your organization has ISO 45001, ISO
                                                                        14001, or/and ISO 9001 or an equivalent Health
                                                                        and Safety, Environmental, or/and Quality
                                                                        Policy.</h6>
                                                                    <div class="radio_row">
                                                                        <label class="radio">Available
                                                                            <input type="radio" name="ISO_certification"
                                                                                   class="iso_class" value="yes">
                                                                            <span class="checkround"></span>

                                                                        </label>
                                                                        <label class="radio">Not Available
                                                                            <input type="radio" name="ISO_certification"
                                                                                   value="no" class="iso_class"
                                                                                   checked="checked">
                                                                            <span class="checkround"></span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="custom-file mt-4">
                                                                        <label for="formFileLg" class="form-label">Attachment</label>
                                                                        <input class="form-control file-size-limit" id="iso_file"
                                                                               type="file" name="iso_file">
                                                                        <span id="iso_error"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <h6>Please confirm if you hold the necessary licence
                                                                        to provide the Products or Services NA are
                                                                        purchasing (e.g. hazardous, medical waste
                                                                        licence):</h6>
                                                                    <div class="radio_row">
                                                                        <label class="radio">Available
                                                                            <input type="radio" name="licence"
                                                                                   value="yes">
                                                                            <span class="checkround"></span>
                                                                        </label>
                                                                        <label class="radio">Not Available
                                                                            <input type="radio" name="licence"
                                                                                   value="no" checked="checked">
                                                                            <span class="checkround"></span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="custom-file mt-4">
                                                                        <label for="formFileLg" class="form-label">Attachment</label>
                                                                        <input class="form-controlfile-size-limit" id="formFileLg"
                                                                               type="file" name="licence_file">
                                                                        <span id="licence_error"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <h6>Provide a copy of your certification/
                                                                        license:</h6>
                                                                    <div class="radio_row">
                                                                        <label class="radio">Available
                                                                            <input type="radio" name="certification"
                                                                                   value="yes">
                                                                            <span class="checkround"></span>
                                                                        </label>
                                                                        <label class="radio">Not Available
                                                                            <input type="radio" name="certification"
                                                                                   value="no" checked="checked">
                                                                            <span class="checkround"></span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="custom-file mt-4">
                                                                        <label for="formFileLg" class="form-label">Attachment</label>
                                                                        <input class="form-control file-size-limit" id="formFileLg"
                                                                               type="file" name="certification_file">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <h6>Provide a copy of your company indemnity
                                                                        insurance related to the products and services
                                                                        NA are purchasing:</h6>
                                                                    <div class="radio_row">
                                                                        <label class="radio">Available
                                                                            <input type="radio"
                                                                                   name="indemnity_insurance"
                                                                                   value="yes">
                                                                            <span class="checkround"></span>
                                                                        </label>
                                                                        <label class="radio">Not Available
                                                                            <input type="radio"
                                                                                   name="indemnity_insurance" value="no"
                                                                                   checked="checked">
                                                                            <span class="checkround"></span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="custom-file mt-4">
                                                                        <label for="formFileLg" class="form-label">Attachment</label>
                                                                        <input class="form-control file-size-limit" id="formFileLg"
                                                                               type="file"
                                                                               name="indemnity_insurance_file">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <h6>Provide MSDC and/ or safety certificates for
                                                                        products and services provided:</h6>
                                                                    <div class="radio_row">
                                                                        <label class="radio">Available
                                                                            <input type="radio" name="MSDC_certificate"
                                                                                   value="yes">
                                                                            <span class="checkround"></span>
                                                                        </label>
                                                                        <label class="radio">Not Available
                                                                            <input type="radio" name="MSDC_certificate"
                                                                                   value="no">
                                                                            <span class="checkround"></span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="custom-file mt-4">
                                                                        <label for="formFileLg" class="form-label">Attachment</label>
                                                                        <input class="form-control file-size-limit" id="formFileLg"
                                                                               type="file" name="MSDC_certificate_file">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form_column">
                                                            <div class="row">
                                                                now now
                                                                @if(config('services.recaptcha.key'))
                                                                    in gcaptcha
                                                                    <div class="g-recaptcha mt-2"
                                                                         data-sitekey="{{ config('services.recaptcha.key') }}">
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form_column">

                                                            <div class="row">
                                                                <div class="btn_column form-group col-md-12">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                               value="" id="flexCheckChecked">
                                                                        <label class="form-check-label"
                                                                               for="flexCheckChecked">
                                                                            I agree to the <a href="#">Terms and
                                                                                Conditions</a>.
                                                                        </label>
                                                                    </div>
                                                                    <h6>Disclaimer</h6>
                                                                    <p>Filling the National Ambulance’s Supplier
                                                                        Registration Form does not automatically place
                                                                        your company on our approved supplier database.
                                                                        We reserve the right to refrain from responding,
                                                                        but may consider contacting you should an
                                                                        opportunity that matches your company’s
                                                                        product(s) or service(s) arises.<br> *By
                                                                        submitting this form, I certify that all
                                                                        information provided in this form is complete,
                                                                        true and correct to the best of my knowledge. I
                                                                        agree to the [.]Terms and Conditions and
                                                                        understand that filling the National Ambulance’s
                                                                        Supplier Registration Form does not
                                                                        automatically place my company on their approved
                                                                        supplier database.</p>
                                                                    <button type="button" class="default_btn grey_bgbtn"
                                                                            onclick="goToThird();">Previous
                                                                    </button>
                                                                    <button type="button" id="fourStepButton"
                                                                            class="default_btn">Submit
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
                                    About Supply Chain
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                 data-bs-parent="#spl_accordion">
                                <div class="accordion-body">
                                    <strong><em>National Ambulance is committed to developing and maintaining an
                                            efficient and sustainable supply chain of partners and service
                                            providers</em></strong> and finds it essential to the continued success of
                                    our business. In our approach to managing supply chain, National Ambulance focuses
                                    on a number of elements that are important in maintaining sustainable and healthy
                                    business partnerships. Those elements are: effective contract management, efficient
                                    purchasing strategies and inventory control management, as well as encouraging our
                                    partners to meet high standards of quality, health, safety and environmental
                                    performance. This is complemented by regular compliance audits and a transparent
                                    relationship with our suppliers to ensure our business objectives and requirements
                                    remain clear and expectations are met.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                    Contact Information
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                 data-bs-parent="#spl_accordion">
                                <div class="accordion-body d-flex">
                                    <div class="col-md-4">
                                        <div class="contactRow">
                                            <label>Contact Us</label>
                                            <span>Have a question for us? Fill an enquiry form to contact us. <br>Our team will get back to you as soon as possible.<br><a
                                                        class="FeedbackLink" href="/national-ambulance/contact-us">Enquire Now</a></span>
                                        </div>
                                        <div class="contactRow">
                                            <label>Email</label>
                                            <span><a href="mailto:info@nationalambulance.ae">info@nationalambulance.ae</a></span>
                                        </div>
                                        <div class="contactRow">
                                            <label>Mobile</label>
                                            <span>+971 2 596 8600</span>
                                        </div>
                                        <div class="contactRow">
                                            <label>Telephone</label>
                                            <span>+971 2 596 8600</span>
                                        </div>
                                        <div class="contactRow">
                                            <label>PO Box</label>
                                            <span>63788, Abu Dhabi, UAE</span>
                                        </div>
                                        <div class="contactRow">
                                            <label>Working Hours</label>
                                            <span>7:00 AM- 4:00 PM</span>
                                        </div>
                                        <div class="contactRow">
                                            <label>Address</label>
                                            <span>Kizad A8<br>Industrial Unit # IU01, IU02 and IU03,<br>Al Samha Abu Dhabi sample</span>
                                        </div>
                                    </div>


                                    <div class="col-md-8">
                                        <div class="contactMap">
                                            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
                                            <script src="https://maps.googleapis.com/maps/api/js?v=3.11&sensor=false"
                                                    type="text/javascript"></script>
                                            <script type="text/javascript">
                                                function initialize() {
                                                    var locations = [
                                                        ['Bondi Beach', 24.7197418, 54.7274064],

                                                    ];

                                                    var map = new google.maps.Map(document.getElementById('map_canvas'), {
                                                        zoom: 10,
                                                        center: new google.maps.LatLng(24.71, 54.72),
                                                        mapTypeId: google.maps.MapTypeId.ROADMAP
                                                    });

                                                    var infowindow = new google.maps.InfoWindow();

                                                    var marker, i;

                                                    for (i = 0; i < locations.length; i++) {
                                                        marker = new google.maps.Marker({
                                                            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                                                            map: map
                                                        });

                                                        google.maps.event.addListener(marker, 'click', (function (marker, i) {
                                                            return function () {
                                                                infowindow.setContent(locations[i][0]);
                                                                infowindow.open(map, marker);
                                                            }
                                                        })(marker, i));
                                                    }
                                                }

                                                function loadScript() {
                                                    var script = document.createElement('script');
                                                    script.type = 'text/javascript';
                                                    script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&' +
                                                        'callback=initialize';
                                                    document.body.appendChild(script);
                                                }

                                                window.onload = loadScript;
                                            </script>
                                            <div id="map_canvas" style="width:100%; height:400px;">&nbsp;</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFourth">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFourth" aria-expanded="false"
                                        aria-controls="collapseFourth">
                                    Tenders
                                </button>
                            </h2>
                            <div id="collapseFourth" class="accordion-collapse collapse" aria-labelledby="headingFourth"
                                 data-bs-parent="#spl_accordion">
                                <div class="accordion-body d-flex flex-wrap">
                                    @if(!empty($tenders))
                                        @foreach($tenders as $tender)
                                            <div class="col-md-6">
                                                <div class="tenderRow">
                                                    <label>Tender Nameeee</label>

                                                    <span>
            @if(app()->getLocale() == 'en')
                                                            english : {{$tender->name}}
                                                        @else
                                                            arabic : {{$tender->name_ar}}
                                                        @endif
        </span>
                                                </div>
                                                <div class="tenderRow">
                                                    <label>Description</label>
                                                    <p>
                                                        @if(app()->getLocale() == 'en')
                                                            {!! $tender->description !!}
                                                        @else
                                                            {!! $tender->description_ar !!}
                                                        @endif

                                                    </p>
                                                </div>
                                                <div class="tenderRow">
                                                    <label>Publishing Date</label>
                                                    <span>{{date('d M Y', strtotime($tender->publishing_date))}}</span>
                                                </div>
                                                <div class="tenderRow">
                                                    <label>Closing Date</label>
                                                    <span>{{date('d M Y', strtotime($tender->closing_date))}}</span>
                                                </div>
                                                @if($tender->upload_file)
                                                    <div class="tenderRow">
                                                        <label>Download File</label>
                                                        <span><a href="{{ url('download',$tender->id)}}"><img
                                                                        src="{{asset('public/website/images/download-icon.svg')}}"></a></span>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    @endif
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
                                        <form method="post" class="tenderForm form_panel"
                                              action="{{url('interest_store')}}" name="addExpressInterest"
                                              id="addExpressInterest">
                                            {{csrf_field()}}
                                            <div class="form_column">
                                                <h5 class="mb-3">Expression of Interest Form</h5>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <input type="text" name="name" class="form-control"
                                                               placeholder="Name*">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <input type="text" name="email" class="form-control"
                                                               placeholder="Email*">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <input type="text" name="company" class="form-control"
                                                               placeholder="Company Name">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <select id="orgType" class="form-control" name="tender_id">
                                                            <option value="">Tender Name</option>
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
                                                               placeholder="Phone Number">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <input type="text" name="landline" class="form-control"
                                                               placeholder="LandLine Number">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <textarea class="form-control" name="comment"
                                                                  placeholder="Comments" rows="3"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form_column">
                                                <div class="row">
                                                    <div class="btn_column form-group col-md-12">
                                                        <button type="submit" class="default_btn">Send</button>
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
        </div>
    </section>
    <!-- /End button popover  -->

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

@endsection
@section('script')
@endsection
<script>
    function btnRefresh() {
        $.ajax({
            type: 'GET',
            url: public_url + '/refresh_captcha',
            success: function (data) {

                $(".captcha span").html(data.captcha);

            }

        });


    }

    window.onbeforeunload = function () {
        window.scrollTo(0, 0);
    }
</script>