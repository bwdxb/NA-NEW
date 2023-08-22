@php
    use app\Http\helper\Helper as Helper;

@endphp

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
<!-- <form action="#" class="eventdetailForm" method="post" name="eventdetailForm"> -->
<div class="accordion mt-3 mb-5" id="serviceTab">
    <div class="accordion-item">
        <div class="accordion-header" id="headingOne">
            <h3 class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                aria-expanded="false" aria-controls="collapseOne">
                {{__('Event Emergency Medical Coverage Form')}}
            </h3>
        </div>
        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
             data-bs-parent="#serviceTab">
            <div class="accordion-body d-flex flex-wrap">
                <div class="col-md-12">
                    <p>{{__('Thank you for requesting event emergency medical support from National Ambulance. Please submit this form at least 14 days prior to the event. If your request is urgent, call 02-596-8600 during business hours during business hours Monday through Thursday between 8:00 AM and 5:00 PM, and Friday between 8:00 AM and 12:00 PM. The service is provided only in the Emirates of Abu Dhabi, Ajman, Sharjah, Ras al Khaimah, Fujairah and Umm Al Quwain. The following form must be completed accurately so that we may assess the requirements for ambulance service provision and level of clinical cover. Our Event Team will review your request and contact you to further assess your event requirements followed by our quotation. Please note that completion of this form does not guarantee provision of service as certain criteria must be evaluated.')}} </p>

                    <!--<strong class="nvColor">Our Events&#39; Coverage Team will review your request and contact you to........... ( please complete)</strong></p>  -->
                </div>
                <form action="{{ route('service.events') }}" class="eventdetailForm" method="post"
                      name="eventdetailForm" enctype='multipart/form-data'>
                    <ul class="errorMessages text-danger" style="list-style:unset;background-color: bisque;"></ul>

                    @csrf
                    <div class="servicesForm">
                        <div class="form_panel">
                            <div class="customTabs">
                                <ul class="nav nav-tabs step_list" id="nav-tab" role="tablist">
                                    <li><a class="nav-link active" href="#tab_one" data-bs-toggle="tab"
                                           data-bs-target="#tab_one"
                                           role="tab" aria-controls="tab_one"
                                           aria-selected="true">{{__('Event Details')}}</a></li>
                                    <li><a class="nav-link" href="#tab_two" data-bs-toggle="tab"
                                           data-bs-target="#tab_two" role="tab"
                                           aria-controls="tab_two" aria-selected="false">{{__('Primary Contact')}}</a>
                                    </li>
                                    <li><a class="nav-link" href="#tab_three" data-bs-toggle="tab"
                                           data-bs-target="#tab_three"
                                           role="tab" aria-controls="tab_three"
                                           aria-selected="false">{{__('Additional Information')}}</a></li>
                                </ul>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="inner_tab tab-pane show active" id="tab_one" role="tabpanel"
                                         aria-labelledby="tab_one">
                                        <div class="form_column">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <input class="form-control" name="event_name"
                                                           placeholder="{{__('Event Name')}} *" type="text"
                                                           value="{{ old('event_name') }}" required/>
                                                    @error('event_name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            <!-- <div class="form-group col-md-6">
                                                        <input class="form-control" placeholder="Event Date" type="text" name="event_date"
                                                        value="{{ old('event_date') }}"
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        onblur="(this.type='text')" onfocus="(this.type='date')" required>
                                                        <i class="far fa-calendar-alt"></i>
                                                        @error('event_date')
                                                    <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div> -->
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <input id="Event_startDate" class="form-control" placeholder="{{__('Event Start Date')}} *"
                                                           type="text" name="event_start_date"
                                                           value="{{ old('event_start_date') }}"
                                                          {{-- min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"--}}
                                                           onblur="(this.type='text')" onfocus="(this.type='text')"
                                                           required>
                                                    <i class="far fa-calendar-alt"></i>
                                                    @error('event_start_date')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input  id="Event_endDate" class="form-control" placeholder="{{__('Event End Date')}} *"
                                                           type="text" name="event_end_date"
                                                           value="{{ old('event_end_date') }}" required
                                                           {{--min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"--}}
                                                           onblur="(this.type='text')" onfocus="(this.type='text')">
                                                    <i class="far fa-calendar-alt"></i>
                                                    @error('event_end_date')
                                                    <p id="even-end-date" class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <input class="form-control" name="event_location"
                                                           placeholder="{{__('Event Location')}} *" required
                                                           value="{{ old('event_location') }}" type="text"/>
                                                    @error('event_location')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <input id="timepicker1" class="form-control"
                                                           placeholder="{{__('Event Start Time *')}}" type="text"
                                                         {{--  max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"--}}
                                                           value="{{ old('event_start_time') }}" required
                                                           onfocus="(this.type='text')" onblur="(this.type='text')"
                                                           name="event_start_time"/>
                                                    <i class="far fa-clock"></i>
                                                    @error('event_start_time')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input id="timepicker2" class="form-control"
                                                           placeholder="{{__('Event End Time *')}}" type="text"
                                                          {{--max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"--}} 
                                                           value="{{ old('event_end_time') }}" required
                                                           onfocus="(this.type='text')" onblur="(this.type='text')"
                                                           name="event_end_time"/>
                                                    <i class="far fa-clock"></i>
                                                    @error('event_end_time')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <select class="form-control" name="event_type" required>
                                                        <option value="">{{__('Event Type')}} *</option>
                                                        <option value="air-show"  {{(old('event_type')=="air-show")?"selected":''}}>{{__('Air Show')}}</option>
                                                        <option value="award-show"  {{(old('event_type')=="award-show")?"selected":''}}>{{__('Award Show')}}</option>
                                                        <option value="ceremonial-launch-event"  {{(old('event_type')=="ceremonial-launch-event")?"selected":''}}>{{__('Ceremonial/ Launch Event')}}</option>
                                                        <option value="community-charity-event"  {{(old('event_type')=="community-charity-event")?"selected":''}}>{{__('Community/ Charity Event')}}</option>
                                                        <option value="concert-performance"  {{(old('event_type')=="concert-performance")?"selected":''}}>{{__('Concert/ Performance')}}</option>
                                                        <option value="conference-seminar-forum"  {{(old('event_type')=="conference-seminar-forum")?"selected":''}}>{{__('Conference/ Seminar/ Forum')}}</option>
                                                        <option value="emergency-mci-drill"  {{(old('event_type')=="emergency-mci-drill")?"selected":''}}>{{__('Emergency/ MCI Drill')}}</option>
                                                        <option value="equestrian-polo"  {{(old('event_type')=="equestrian-polo")?"selected":''}}>{{__('Equestrian/ Polo')}}</option>
                                                        <option value="exhibition/trade show"  {{(old('event_type')=="exhibition/trade show")?"selected":''}}>{{__('Exhibition/ Trade Show')}}</option>
                                                        <option value="festival-fair"  {{(old('event_type')=="festival-fair")?"selected":''}}>{{__('Festival/ Fair')}}</option>
                                                        <option value="firework-display"  {{(old('event_type')=="firework-display")?"selected":''}}>{{__('Firework Display')}}</option>
                                                        <option value="motor-sports"  {{(old('event_type')=="motor-sports")?"selected":''}}>{{__('Motor Sports')}}</option>
                                                        <option value="parade"  {{(old('event_type')=="parade")?"selected":''}}>{{__('Parade')}}</option>
                                                        <option value="party-reception"  {{(old('event_type')=="party-reception")?"selected":''}}>{{__('Party/ Reception')}}</option>
                                                        <option value="public-occasion"  {{(old('event_type')=="public-occasion")?"selected":''}}>{{__('Public Occasion')}}</option>
                                                        <option value="race-walk-run-cycle"  {{(old('event_type')=="race-walk-run-cycle")?"selected":''}}>{{__('Race/Walk/Run/Cycle')}}</option>
                                                        <option value="school-events-school-sports"  {{(old('event_type')=="school-events-school-sports")?"selected":''}}>{{__('School Event/ School Sports')}}</option>
                                                        <option value="sports-community-event"  {{(old('event_type')=="sports-community-event")?"selected":''}}>{{__('Sports Community Event')}}</option>
                                                        <option value="sports-professional-sports-competition"  {{(old('event_type')=="sports-professional-sports-competition")?"selected":''}}>{{__('Sports-Professional Sports/ Competition')}}</option>
                                                        <option value="tv-film-production-sets"  {{(old('event_type')=="tv-film-production-sets")?"selected":''}}>{{__('TV & Film and Production sets')}}</option>
                                                        <option value="vip-royalty-event"  {{(old('event_type')=="vip-royalty-event")?"selected":''}}>{{__('VIP/ Royalty Event')}}</option>
                                                        <option value="water-sports"  {{(old('event_type')=="water-sports")?"selected":''}}>{{__('Water Sports')}}</option>
                                                        <option value="other"  {{(old('event_type')=="other")?"selected":''}}>{{__('Other')}}</option>
                                                    </select>
                                                    @error('event_type')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6" id="event_type_other"
                                                     style="display: none;">
                                                    <input class="form-control" name="event_type_other"
                                                           value="{{ old('event_type_other') }}"
                                                           placeholder="{{__('If other, please specify')}} *"
                                                           type="text"/>
                                                    @error('event_type_other')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <select class="form-control" name="venue_type" required>
                                                        <option value="">{{__('Venue Type')}} *</option>
                                                        <option value="Academic Institution" {{old('venue_type')=="Academic Institution"?"selected":''}}>{{__('Academic Institution')}}</option>
                                                        <option value="Arena" {{old('venue_type')=="Arena"?"selected":''}}>{{__('Arena')}}</option>
                                                        <option value="Beach" {{old('venue_type')=="Beach"?"selected":''}}>{{__('Beach')}}</option>
                                                        <option value="Exhibition Centre" {{old('venue_type')=="Exhibition Centre"?"selected":''}}>{{__('Exhibition Centre')}}</option>
                                                        <option value="Farm" {{old('venue_type')=="Farm"?"selected":''}}>{{__('Farm')}}</option>
                                                        <option value="Field" {{old('venue_type')=="Field"?"selected":''}}>{{__('Field')}}</option>
                                                        <option value="Hotel" {{old('venue_type')=="Hotel"?"selected":''}}>{{__('Hotel')}}</option>
                                                        <option value="Mall" {{old('venue_type')=="Mall"?"selected":''}}>{{__('Mall')}}</option>
                                                        <option value="Park" {{old('venue_type')=="Park"?"selected":''}}>{{__('Park')}}</option>
                                                        <option value="private-property" {{old('venue_type')=="private-property"?"selected":''}}>{{__('Private Property')}}</option>
                                                        <option value="Public Road" {{old('venue_type')=="Public Road"?"selected":''}}>{{__('Public Road')}}</option>
                                                        <option value="Public Venue" {{old('venue_type')=="Public Venue"?"selected":''}}>{{__('Public Venue')}}</option>
                                                        <option value="Sport Club" {{old('venue_type')=="Sport Club"?"selected":''}}>{{__('Sport Club')}}</option>
                                                        <option value="Stadium" {{old('venue_type')=="Stadium"?"selected":''}}>{{__('Stadium')}}</option>
                                                        <option value="temporary-outdoor-structure" {{old('venue_type')=="temporary-outdoor-structure"?"selected":''}}>{{__('Temporary Outdoor Structure')}}</option>
                                                        <option value="Theatre" {{old('venue_type')=="Theatre"?"selected":''}}>{{__('Theatre')}}</option>
                                                        <option value="other" {{old('venue_type')=="other"?"selected":''}}>{{__('Other')}}</option>
                                                    </select>
                                                    @error('venue_type')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6" id="venue_type_other"
                                                     style="display: none;">
                                                    <input class="form-control" name="venue_type_other"
                                                           value="{{ old('venue_type_other') }}"
                                                           placeholder="{{__('If other, please specify')}} *"
                                                           type="text"/>
                                                    @error('venue_type_other')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <strong class="d-block mb-2">{{__('What is the expected number of persons on site (including staff/ volunteers, participants and audience)?')}}*</strong>
                                                    <input class="form-control" placeholder=""
                                                           type="text"
                                                           value="{{ old('expected_no_of_persons') }}"
                                                           name="expected_no_of_persons" required/>
                                                    @error('expected_no_of_persons')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div class="radio_row">
                                                        <strong>{{__('Will alcohol be consumed on site?')}}</strong>
                                                        <label class="radio">{{__('Yes')}}
                                                            <input type="radio" value="yes" name="alcohol_consumed"
                                                                   required @if(old('alcohol_consumed')=='yes') checked @endif/>
                                                            <span class="checkround"></span>
                                                        </label>
                                                        <label class="radio">{{__('No')}}
                                                            <input type="radio" value="no" name="alcohol_consumed"
                                                                   required @if(old('alcohol_consumed')=='no'||!(old('alcohol_consumed'))) checked @endif/>
                                                            <span class="checkround"></span>
                                                        </label>

                                                    </div>
                                                    @error('alcohol_consumed')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <div class="radio_row">
                                                        <strong>{{__('Will there be any VIPs in attendance? (e.g. Royal Family, Ministers,etc.)')}}</strong>
                                                        <label class="radio">{{__('Yes')}}
                                                            <input type="radio" value="yes" name="vip_attendance"
                                                                   required @if(old('vip_attendance')=='yes') checked @endif/>
                                                            <span class="checkround"></span>
                                                        </label>
                                                        <label class="radio">{{__('No')}}
                                                            <input type="radio" value="no" name="vip_attendance"
                                                                   required @if(old('vip_attendance')=='no'||!(old('vip_attendance'))) checked @endif/>
                                                            <span class="checkround"></span>
                                                        </label>
                                                    </div>
                                                    @error('vip_attendance')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-12" id="vip_attendance"
                                                     style="display: none;">
                                                    <input class="form-control" name="vip_attending_detail"
                                                           value="{{ old('vip_attending_detail') }}"
                                                           placeholder="{{__('If VIP attending, please provide details')}} *"
                                                           type="text"/>
                                                    @error('vip_attending_detail')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <select class="form-control" name="particpants" required>
                                                        <option value="">{{__('Type of Particpants')}} *</option>
                                                        <option value="corporate-private-businesses">{{__('Corporate/Private Businesses')}}</option>
                                                        <option value="general-public">{{__('General Public')}}</option>
                                                        <option value="government-entities">{{__('Government Entities')}}</option>
                                                        <option value="performers">{{__('Performers')}}</option>
                                                        <option value="professional-athletes">{{__('Professional Athletes')}}</option>
                                                        <option value="sports-community">{{__('Sports Community')}}</option>
                                                        <option value="other">{{__('Other')}}</option>
                                                    </select>
                                                    @error('particpants')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6" id="particpants_other"
                                                     style="display: none;">
                                                    <input class="form-control" name="particpants_other"
                                                           value="{{ old('particpants_other') }}"
                                                           placeholder="{{__('If other, please specify')}} *"
                                                           type="text"/>
                                                    @error('particpants_other')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <select class="form-control" name="audience" required>
                                                        <option value="">{{__('Type of Audience')}} *</option>
                                                        <option value="adults">{{__('Adults')}}</option>
                                                        <option value="children-under-18">{{__('Children(under 18)')}}</option>
                                                        <option value="corporate-private-sector">{{__('Corporate/ Private Sector')}}</option>
                                                        <option value="Families">{{__('Families')}}</option>
                                                        <option value="general-public">{{__('General Public')}}</option>
                                                        <option value="government-sector">{{__('Government Sector')}}</option>
                                                        <option value="Ladies Only">{{__('Ladies Only')}}</option>
                                                        <option value="seniors-older-persons">{{__('Seniors/ Older Persons')}}</option>
                                                        <option value="special-needs">{{__('Special Needs')}}</option>
                                                        <option value="other">{{__('Other')}}</option>
                                                    </select>
                                                    @error('audience')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6" id="audience_other"
                                                     style="display: none;">
                                                    <input class="form-control" name="audience_other"
                                                           value="{{ old('audience_other') }}"
                                                           placeholder="{{__('If other, please specify')}} *"
                                                           type="text"/>
                                                    @error('audience_other')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div class="radio_row">
                                                        <strong>{{__('Are there any security risks or hazards identified?')}}</strong>
                                                        <label class="radio">{{__('Yes')}}
                                                            <input type="radio" value="yes" name="security_risk_hazards"
                                                                   required @if(old('security_risk_hazards')=='yes') checked @endif/>
                                                            <span class="checkround"></span>
                                                        </label>
                                                        <label class="radio">{{__('No')}}
                                                            <input type="radio" value="no" name="security_risk_hazards"
                                                                   required @if(old('security_risk_hazards')=='no'||!(old('security_risk_hazards'))) checked @endif/>
                                                            <span class="checkround"></span>
                                                        </label>
                                                    </div>
                                                    @error('security_risk_hazards')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-12" id="security_risk_hazards"
                                                     style="display:none;">
                                                    <input class="form-control" name="security_risk_hazards_detail"
                                                           value="{{ old('security_risk_hazards_detail') }}"
                                                           placeholder="{{__('If security risk or hazards, please provide details')}} *"
                                                           type="text"/>
                                                    @error('security_risk_hazards_detail')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <div class="radio_row">
                                                        <strong>{{__('If previous history of event, has there been any history of previous injuries?')}}</strong>
                                                        <label class="radio">{{__('Yes')}}
                                                            <input type="radio" value="yes"
                                                                   name="previous_history_of_event" required @if(old('previous_history_of_event')=='yes') checked @endif/>
                                                            <span class="checkround"></span>
                                                        </label>
                                                        <label class="radio">{{__('No')}}
                                                            <input type="radio" value="no"
                                                                   name="previous_history_of_event" required @if(old('previous_history_of_event')=='no'||!(old('previous_history_of_event'))) checked @endif/>
                                                            <span class="checkround"></span>
                                                        </label>
                                                    </div>
                                                    @error('previous_history_of_event')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-12" id="previous_history_of_event"
                                                     style="display:none;">
                                                    <input class="form-control" name="previous_history_of_event_detail"
                                                           value="{{ old('previous_history_of_event_detail') }}"
                                                           placeholder="{{__('If previous history, please provide details')}} *"
                                                           type="text"/>
                                                    @error('previous_history_of_event_detail')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <div class="radio_row">
                                                        <strong>{{__('Please identify if other agencies will be on site (i.e. Police, Civil Defense, etc)')}}</strong>
                                                        <label class="radio">{{__('Yes')}}
                                                            <input type="radio" value="yes" name="other_agencies"
                                                                   required @if(old('other_agencies')=='yes') checked @endif/>
                                                            <span class="checkround"></span>
                                                        </label>
                                                        <label class="radio">{{__('No')}}
                                                            <input type="radio" value="no" name="other_agencies"
                                                                   required @if(old('other_agencies')=='no'||!(old('other_agencies'))) checked @endif/>
                                                            <span class="checkround"></span>
                                                        </label>
                                                    </div>
                                                    @error('other_agencies')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-12" id="other_agencies"
                                                     style="display:none;">
                                                    <input class="form-control" name="other_agencies_detail"
                                                           value="{{ old('other_agencies_detail') }}"
                                                           placeholder="{{__('If other agencies, please identify')}} *"
                                                           type="text"/>
                                                    @error('other_agencies_detail')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form_column mt-3">
                                            <div class="row">
                                                <div class="btn_column form-group col-md-12">
                                                    <button type="button" class="default_btn btn_next"
                                                            id="btn_event_details">{{__('Next')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inner_tab tab-pane fade" id="tab_two" role="tabpanel"
                                         aria-labelledby="tab_two">

                                        <div class="form_column">
                                            <h5>{{__('Primary Contact')}}</h5>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <select id="title" name="title" class="form-control" required>
                                                        <option selected disabled="true"
                                                                value="">{{__('Title')}} *</option>
                                                        <option value="Mr" {{old('title')=='Mr'?'selected':''}}>{{__('Mr')}}</option>
                                                        <option value="Mrs" {{old('title')=='rs'?'selected':''}}>{{__('Mrs')}}</option>
                                                        <option value="Miss" {{old('title')=='ss'?'selected':''}}>{{__('Miss')}}</option>
                                                        <option value="Ms" {{old('title')=='Ms'?'selected':''}}>Ms</option>
                                                        
                                                    </select>
                                                    @error('title')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input type="text" class="form-control" name="primary_contact_name"
                                                           value="{{ old('primary_contact_name') }}"
                                                           placeholder="{{__('Full Name')}} *" 
                                                            required/>
                                                    @error('primary_contact_name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <input type="email" class="form-control"
                                                           name="primary_contact_email"
                                                           value="{{ old('primary_contact_email') }}"
                                                           placeholder="{{__('Email Address')}} *" required/>
                                                    @error('primary_contact_email')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input type="text" class="form-control"
                                                           name="primary_contact_number" required 
                                                           value="{{ old('primary_contact_number') }}"
                                                           placeholder="{{__('Mobile Number')}} *"/>
                                                    @error('primary_contact_number')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <input type="text" class="form-control"
                                                           placeholder="{{__('Company Name')}} *"
                                                           value="{{ old('primary_contact_company_name') }}"
                                                           name="primary_contact_company_name" required/>
                                                    @error('primary_contact_company_name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input type="text" class="form-control" name="Job Title"
                                                           placeholder="{{__('Job Title')}} *"
                                                           value="{{ old('primary_contact_job_title') }}"
                                                           name="primary_contact_job_title" required/>
                                                    @error('primary_contact_job_title')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form_column">
                                            <div class="row">
                                                <div class="btn_column form-group col-md-12">
                                                    <!-- <button type="button" class="default_btn btn_next grey_bgbtn">Save</button> -->
                                                    <button type="button" class="default_btn btn_next"
                                                            id="btn_primary_contact">{{__('Next')}}</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="inner_tab tab-pane fade" id="tab_three" role="tabpanel"
                                         aria-labelledby="tab_three">

                                        <div class="form_column">
                                            <h5>{{__('Additional Information or Special Instructions')}}</h5>
                                            <p>{{__('Please provide important event information and details and any special instruction including:')}}</p>
                                            <ul class="ulList">
                                                <li>
                                                    {{__('Event website')}}
                                                </li>
                                                <li>
                                                    {{__('Date(s) and time(s) if you require medical coverage for the event set up/ take down')}}
                                                </li>
                                                <li>
                                                    {{__('Required locations, dates and time for multiple days or multiple locations')}}
                                                </li>
                                            </ul>

                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">

                                                <textarea class="form-control" cols="7" name="additional_info"
                                                          rows="4">{{ old('additional_info') }}</textarea>
                                                @error('additional_info')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="form-group col-md-12">
                                                <div class="custom-file">
                                                    <label class="form-label" for="formFileLg">
                                                        {{__('Upload any supporting documentation: (e.g. risk assessment, route maps, event schedule(s), etc.)')}}
                                                        
                                                    </label>
                                                    <!-- <label for="supportingFile" style="display:none;">{{__('Choose Filee')}}</label> -->
                                                    <div class="customFile">
                                                        <input class="form-control file  file-size-limit" id="supportingFile" name="files[]" type="file"
                                                            data-show-dd="true" data-show-caption="true" multiple onchange="supportfileFunction()"/>
                                                        <span class="file_label">{{__('Upload File')}}</span>
                                                        @error('files')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <small>{{__('You can upload multiple files. If you choose to, please select and upload them in one go.')}}</small>
                                                    <div id="supportFilelist"></div>
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
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div class="form-check form-check-flat">
                                                        <label class="form-check-label">
                                                            <input name="agreement" type="checkbox" class="form-check-input" required/>
                                                            {{__('By submitting this form, I understand that I am requesting a quotation for event emergency medical coverage from National Ambulance UAE and I am aware that completion of this form does not automatically guarantee approval of request. I agree to the')}} <a href="/page/terms-and-conditions" target="_blank">{{__('Terms and Conditions')}}</a> {{__('and')}} <a href="/page/privacy-policy" target="_blank">{{__('Privacy Policy')}}</a>{{__(', and certify that I have completed this form with the correct and true information to the best of my knowledge and will keep National Ambulance informed of any changes to the information.')}}*
                                                            <i class="input-helper"></i></label>
                                                            @error('agreement')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form_column mt-3">
                                            <div class="row">
                                                <div class="btn_column form-group col-md-12">
                                                    <button type="submit"
                                                            class="default_btn btn_next ms-0">{{__('Submit')}}</button>
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
            @if($testimony->category=='Event Emergency Medical Coverage')
                <div class="testimonials_item">
                    <div class="client_info">
                        <h4>{{$testimony->client_name}}</h4>
                        <span class="desgnation">{{$testimony->title}}</span>
                        <p>“{{$testimony->testimonial}}”</p>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

<script type="text/javascript">
window.onload = function() {
    var $recaptcha = document.querySelector('#g-recaptcha-response');

    if($recaptcha) {
        $recaptcha.setAttribute("required", "required");
    }
};
    $(function () {
        $('#Event_startDate').change(function () {
            $('#Event_endDate').attr('min', moment($(this).val(),'DD-MM-YYYY').format('YYYY-MM-DD'));
        });



        $("form").validate();
    
        $('.default_btn.btn_next').on('click',function(e){
            $("#g-recaptcha-response-msg").text('');

            var isError=false;
            var tabActive = $(this).parents('.inner_tab.tab-pane').attr('id');
            var index = 1;
            $(this).parents('.inner_tab.tab-pane').find('input[required], select[required], textarea[required]').each(function(){
                console.log($(this).attr('name'));
                console.log($(this).attr('name')+" : "{{__('+$(this).valid()')}});
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
                $("label[for='g-recaptcha-response']").show();

            }else{
                switch (tabActive) {
                    case "tab_one":
                        $('#nav-tab a[href="#tab_two"]').tab('show');
                        $('html, body').animate({
                scrollTop: $("#tab_two").offset().top - 200
            }, 500);
                        break;
                    case "tab_two":
                        $('#nav-tab a[href="#tab_three"]').tab('show');
                        
                        break;
                }
            }          
        });

        $('form').submit(function() {
            if($('form').isValid()){

$('#loader').show();
 }else{
e.preventDefault();
$("label[for='g-recaptcha-response']").show();

 }
        });

        
        $('select[name="event_type"]').change(function () {
            var checkedValue = $(this).val();
            if (checkedValue === 'other') {
                $('#event_type_other').show();
                $('#event_type_other').find('input').attr("required", true);

            } else {
                $('#event_type_other').hide();
                $('#event_type_other').find('input').removeAttr("required");

            }
        });
@if(old('event_type'))
            $('select[name="event_type"]').val("{{old('event_type')}}").change();
        @endif
       
        $('select[name="venue_type"]').change(function () {
            var checkedValue = $(this).val();
            if (checkedValue === 'other') {
                $('#venue_type_other').show();
                $('#venue_type_other').find('input').attr("required", true);

            } else {
                $('#venue_type_other').hide();
                $('#venue_type_other').find('input').removeAttr("required");

            }
        }); @if(old('venue_type'))
            $('select[name="venue_type"]').val("{{old('venue_type')}}").change();
        @endif
        
        $('select[name="particpants"]').change(function () {
            var checkedValue = $(this).val();
            if (checkedValue === 'other') {
                $('#particpants_other').show();
                $('#particpants_other').find('input').attr("required", true);

            } else {
                $('#particpants_other').hide();
                $('#particpants_other').find('input').removeAttr("required");

            }
        });
        
        @if(old('particpants'))
            $('select[name="particpants"]').val("{{old('particpants')}}").change();
        @endif
        
        $('select[name="audience"]').change(function () {
            var checkedValue = $(this).val();
            if (checkedValue === 'other') {
                $('#audience_other').show();
                $('#audience_other').find('input').attr("required", true);

            } else {
                $('#audience_other').hide();
                $('#audience_other').find('input').removeAttr("required");

            }
        });
        
        @if(old('audience'))
            $('select[name="audience"]').val("{{old('audience')}}").change();
        @endif
       
        $('input[name="vip_attendance"]').change(function () {

            var checkedValue = $(this).val();
            if (checkedValue === 'yes') {
                $('#vip_attendance').show();
                $('#vip_attendance').find('input').attr("required", true);

            } else {
                $('#vip_attendance').hide();
                $('#vip_attendance').find('input').removeAttr("required");

            }
        }); @if(old('vip_attendance'))
            $('input[name="vip_attendance"]').val("{{old('vip_attendance')}}").change();
        @endif
        
        $('input[name="security_risk_hazards"]').change(function () {
            var checkedValue = $(this).val();
            if (checkedValue === 'yes') {
                $('#security_risk_hazards').show();
                $('#security_risk_hazards').find('input').attr("required", true);

            } else {
                $('#security_risk_hazards').hide();
                $('#security_risk_hazards').find('input').removeAttr("required");

            }
        });
        
        @if(old('security_risk_hazards'))
            $('input[name="security_risk_hazards"]').val("{{old('security_risk_hazards')}}").change();
        @endif
        
        $('input[name="previous_history_of_event"]').change(function () {
            var checkedValue = $(this).val();
            if (checkedValue === 'yes') {
                $('#previous_history_of_event').show();
                $('#previous_history_of_event').find('input').attr("required", true);

            } else {
                $('#previous_history_of_event').hide();
                $('#previous_history_of_event').find('input').removeAttr("required");

            }
        });
        
        @if(old('previous_history_of_event'))
            $('input[name="previous_history_of_event"]').val("{{old('previous_history_of_event')}}").change();
        @endif
        
        $('input[name="other_agencies"]').change(function () {
            var checkedValue = $(this).val();
            if (checkedValue === 'yes') {
                $('#other_agencies').show();
                $('#other_agencies').find('input').attr("required", true);

            } else {
                $('#other_agencies').hide();
                $('#other_agencies').find('input').removeAttr("required");
            }
        });
        @if(old('other_agencies'))
            $('input[name="other_agencies"]').val("{{old('other_agencies')}}").change();
        @endif


    });

    function invalidFunction(e, message) {
        e.preventDefault();
        document.getElementById('errorHeader').innerText = message;
    }

   
</script>
<!-- Event Coverage Service Form -->