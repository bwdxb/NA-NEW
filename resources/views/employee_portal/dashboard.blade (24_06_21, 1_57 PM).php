@extends('layouts.employee_portal.master')

@push('plugin-styles')

@endpush

@section('content')
<div class="row">
     <div class="col-md-12 mt-3 mb-3">
          <h1 class="h1_heading">Welcome to NA’s Employee Portal</h1>
     </div>
     <div class="col-md-7">
          <div class="user-wrapper">
               <div class="profile-image">
                    <img src="{{ url('public/employee_portal/images/314-ALI-AL-KHARUSI.jpg') }}"
                         alt="profile image">
               </div>
               <div class="text-wrapper">
                    <h4 class="profile-name">Ali Al Kharusi</h4>
                    <div class="dropdown" data-display="static">
                         <a class="d-flex" id="UsersettingsDropdown" href="javascript:void(0)">
                              <small class="designation text-muted">QHSE and BC Manager</small>
                              <span class="status-indicator online"></span>
                         </a>
                    </div>
               </div>
          </div>
          <div class="row logoWrapper">
               @foreach($internal_applications as $internal_application)
                    <div class="col-md-4 grid-margin stretch-card">
                         <div class="card navyblueBG">
                              <a class="card-body linkItem hoverEffect" href="{{ $internal_application->url }}"
                                   target="_blank">
                                   <span class="logoIcon">
                                        <img class="imgHover"
                                             src="{{ url('public/'.$internal_application->logo) }}">
                                   </span>
                                   <h5>{{ $internal_application->title }}</h5>
                              </a>
                         </div>
                    </div>
               @endforeach
               <!-- <div class="col-md-4 grid-margin stretch-card">
                     <div class="card navyblueBG">
                          <a class="card-body linkItem hoverEffect" href="https://mail.nationalambulance.ae\OWA" target="_blank">
                            <span class="logoIcon">
                                  <img class="imgHover" src="{{ asset('public/employee_portal/images/kronos-logo.svg') }}">
                            </span>
                             <h5>Kronos</h5>
                          </a>
                     </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                     <div class="card navyblueBG">
                          <a class="card-body linkItem hoverEffect" href="https://mail.nationalambulance.ae\OWA" target="_blank">
                            <span class="logoIcon">
                                  <img class="imgHover" src="{{ asset('public/employee_portal/images/lms-logo.svg') }}">
                            </span>
                             <h5>LMS</h5>
                          </a>
                     </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                     <div class="card navyblueBG">
                          <a class="card-body linkItem hoverEffect" href="https://mail.nationalambulance.ae\OWA" target="_blank">
                             <span class="logoIcon">
                                  <img class="imgHover" src="{{ asset('public/employee_portal/images/asana-logo.svg') }}">
                             </span>
                             <h5>Asana</h5> 
                          </a>
                     </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                     <div class="card navyblueBG">
                          <a class="card-body linkItem hoverEffect" href="https://mail.nationalambulance.ae\OWA" target="_blank">
                             <span class="logoIcon">
                                   <img style="max-height:35px;" class="imgHover" src="{{ asset('public/employee_portal/images/opiq-logo.svg') }}">
                              </span>
                             <h5>OpIQ</h5>
                          </a>  
                     </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                     <div class="card navyblueBG">
                          <a class="card-body linkItem hoverEffect" href="https://mail.nationalambulance.ae\OWA" target="_blank">
                             <span class="logoIcon">
                                  <img class="imgHover" src="{{ asset('public/employee_portal/images/oracle-logo.svg') }}">
                             </span>
                             <h5>Oracle</h5>
                          </a>
                     </div>
                </div> -->
               <div class="col-md-12 text-center">
                    <div class="card">
                         <div class="card-body">
                              <a class="primary_btn"
                                   href="{{ route('employee-portal.internal-application.view') }}">All
                                   Applications</a>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-md-5 stretch-card flex-wrap">
          <div class="card">
               <div class="card-body">
                    <h4 class="card-title">Todo</h4>
                    <div class="add-items d-flex">
                         <input type="text" class="form-control todo-list-input"
                              placeholder="What do you need to do today?">
                         <button
                              class="add btn btn-primary font-weight-medium todo-list-add-btn navyblueBtn">Add</button>
                    </div>
                    <div class="list-wrapper">
                         <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                              <li class="completed">
                                   <div class="form-check form-check-flat">
                                        <label class="form-check-label">
                                             <input class="checkbox" type="checkbox" checked> Call John </label>
                                   </div>
                                   <i class="remove mdi mdi-close-circle-outline"></i>
                              </li>
                              <li>
                                   <div class="form-check form-check-flat">
                                        <label class="form-check-label">
                                             <input class="checkbox" type="checkbox"> Create invoice </label>
                                   </div>
                                   <i class="remove mdi mdi-close-circle-outline"></i>
                              </li>
                              <li>
                                   <div class="form-check form-check-flat">
                                        <label class="form-check-label">
                                             <input class="checkbox" type="checkbox"> Print Statements </label>
                                   </div>
                                   <i class="remove mdi mdi-close-circle-outline"></i>
                              </li>
                              <li class="completed">
                                   <div class="form-check form-check-flat">
                                        <label class="form-check-label">
                                             <input class="checkbox" type="checkbox" checked> Prepare for presentation
                                        </label>
                                   </div>
                                   <i class="remove mdi mdi-close-circle-outline"></i>
                              </li>
                         </ul>
                    </div>
               </div>
          </div>
          <div class="card mt-4">
               <div class="card-body headsUp_block">

                    @if(isset($heads_up_today) && isset($heads_up_today[0]))
                         <div class="headsUp_image">
                              @if($heads_up_today[0]->media_type == 'image')
                                   <img class="imgHover" src="{{ url($heads_up_today[0]->file_url) }}">
                              @else
                                   <iframe allowfullscreen="" frameborder="0"
                                        src="{{ url($heads_up_today[0]->file_url) }}"></iframe>
                              @endif
                              <p class="text-muted mb-0 text-left text-md-center text-xl-left">
                                   <i class="mdi mdi-refresh mr-1" aria-hidden="true"></i> Updated Now
                              </p>
                         </div>
                         <div class="headsUp_text">
                              <h3>{{$heads_up_today[0]->title}}</h3>
                              <!-- <h3>The Head's Up<br>+ Announcements</h3> -->
                              <em class="text-danger">{{ $analysis['heads_up_new'] }} New</em>
                         </div>
                    @else
                         <div class="headsUp_image">
                              <img class="imgHover"
                                   src="{{ asset('public/employee_portal/images/headsup-icon.jpg') }}">
                              <p class="text-muted mb-0 text-left text-md-center text-xl-left">
                                   <i class="mdi mdi-refresh mr-1" aria-hidden="true"></i> Updated Now
                              </p>
                         </div>
                         <div class="headsUp_text">
                              <h3>The Head's Up<br>+ Announcements</h3>
                              <!-- <h3>The Head's Up<br>+ Announcements</h3> -->
                              <em class="text-danger">{{ $analysis['heads_up_new'] }} New</em>
                         </div>
                    @endif

               </div>
          </div>
     </div>
</div>
<div class="row mt-4">
     <div class="col-md-8">
          <div class="row">
               <div class="col-md-6 grid-margin stretch-card">
                    <div class="card card-statistics">
                         <div class="card-body">
                              <div
                                   class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
                                   <div class="float-left">
                                        <i class="mdi mdi-file-document-box-multiple text-primary icon-lg"></i>
                                   </div>
                                   <div class="float-right">
                                        <p class="mb-0 text-right">Document Library</p>
                                        <div class="fluid-container">
                                             <h3 class="font-weight-medium text-right mb-0">
                                                  {{ $analysis['document_library'] }}</h3>
                                        </div>
                                   </div>
                              </div>
                              <p class="text-muted mt-3 mb-0 text-left text-md-center text-xl-left">
                                   {{ $analysis['document_library_new'] }} New </p>
                         </div>
                    </div>
               </div>
               <div class="col-md-6 grid-margin stretch-card">
                    <div class="card card-statistics">
                         <div class="card-body">
                              <div
                                   class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
                                   <div class="float-left">
                                        <i class="mdi_icon"><img class="imgHover"
                                                  src="{{ asset('public/employee_portal/images/stories-icon.png') }}"></i>
                                   </div>
                                   <div class="float-right">
                                        <p class="mb-0 text-right">Stories</p>
                                        <div class="fluid-container">
                                             <h3 class="font-weight-medium text-right mb-0">
                                                  {{ $analysis['stories'] }}</h3>
                                        </div>
                                   </div>
                              </div>
                              <div class="cardBotm mt-3">
                                   <p class="text-muted mb-0 text-left text-md-center text-xl-left">
                                        {{ $analysis['stories_new'] }} New</p>
                                   <!-- <span class="text-muted">0 New</span>                             -->
                              </div>
                         </div>
                    </div>
               </div>
               <div class="col-md-6 grid-margin stretch-card">
                    <div class="card card-statistics">
                         <div class="card-body">
                              <div
                                   class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
                                   <div class="float-left">
                                        <i class="mdi mdi-cart-arrow-right text-primary icon-lg"></i>
                                   </div>
                                   <div class="float-right">
                                        <p class="mb-0 text-right">Market Place</p>
                                        <div class="fluid-container">
                                             <h3 class="font-weight-medium text-right mb-0">
                                                  {{ $analysis['market_place'] }}</h3>
                                        </div>
                                   </div>
                              </div>
                              <p class="text-muted mt-3 mb-0 text-left text-md-center text-xl-left">
                                   <em>{{ $analysis['market_place_new'] }} New</em></p>
                         </div>
                    </div>
               </div>
               <div class="col-md-6 grid-margin stretch-card">
                    <div class="card card-statistics">
                         <div class="card-body">
                              <div
                                   class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
                                   <div class="float-left">
                                        <i class="mdi_icon"><img class="imgHover"
                                                  src="{{ asset('public/employee_portal/images/team-salute-icon.png') }}"></i>
                                   </div>
                                   <div class="float-right">
                                        <p class="mb-0 text-right">Team Member Salute</p>
                                        <div class="fluid-container">
                                             <h3 class="font-weight-medium text-right mb-0">
                                                  {{ $analysis['team_salutes'] }}</h3>
                                        </div>
                                   </div>
                              </div>
                              <p class="text-muted mt-3 mb-0 text-left text-md-center text-xl-left">
                                   <em>{{ $analysis['team_salutes_new'] }} New</em></p>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-md-4">
          <div class="twitterBox">
               <div class="widgetHeader">
                    <h5>Tweets</h5>
                    <a href="#"><img
                              src="{{ asset('public/website/images/twitter-follow-btn.png') }}"></a>
               </div>
               <div class="feedContent">
                    <a class="twitter-timeline" href="https://twitter.com/NAmbulanceUAE?ref_src=twsrc%5Etfw">Tweets by
                         NAmbulanceUAE</a>
                    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

               </div>
          </div>
     </div>
</div>
<div class="card grid-margin mt-4 storyWrapper">
     <div class="card-body">
          <div class="row">
               <div class="col-md-12">
                    <h3 class="mb-4">Stories</h3>
               </div>
               @forelse($stories as $d)
                    <div class="col-xl-4 col-lg-4">
                         <div class="storyItem mb-4">
                              <div class="storyImage">
                                   @if($d->media_type == 'image')
                                        <img class="imgHover" src="{{ url($d->file_url) }}">
                                   @else
                                        <iframe
                                             allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                             allowfullscreen="" frameborder="0" src="{{ url($d->file_url) }}"
                                             controlsList="nodownload" title="video player"></iframe>
                                   @endif

                              </div>

                              <div class="storyDescription">

                                   <div class="storyCredit">
                                        <span class="search">{{ $d->category }}</span>
                                   </div>

                                   <h4 class="storyTitle mt-3 w-100">{{ $d->title }}</h4>
                                   <div class="story_content search  text-truncate story-desc w-100"
                                        val="{{ $d->id }}" id="story-desc-{{ $d->id }}">
                                        {{ $d->story }}
                                   </div>
                                   <a class="readmore" id="readmore-{{ $d->id }}" href="#" value="{{ $d->id }}">read
                                        more </a>

                                   <div class="storyAuthor">
                                        <span class="authorName">@if(!$d->dont_publish_name_status)<font>By </font>
                                             {{ $d->file_credits }} .@endif</span>
                                        <span
                                             class="poostDate">{{ \Carbon\Carbon::parse($d->created_at)->diffForHumans() }}</span>
                                   </div>
                              </div>
                         </div>
                    </div>
               @endforeach

               <!-- <div class="col-xl-4 col-lg-4">
                    <div class="storyItem mb-4">
                         <a class="hoverEffect" href="#" target="_blank">
                              <div class="storyImage">
                                   <img class="imgHover"
                                        src="http://na.bw.ae/national-ambulance/public/uploads/news/7399.jpg">
                              </div>
                              <div class="storyDescription">
                                   <div class="storyCredit"><span>Inspirations</span></div>
                                   <h4 class="storyTitle">Events' Ambulance Coverage</h4>
                                   <p>There are many variations of passages of Lorem Ipsum available, but the majority
                                        have suffered alteration in some form, by injected humour, or randomised words
                                        which don't look...<small>read more</small></p>
                                   <div class="storyAuthor">
                                        <span class="authorName">
                                             <font>By</font> Nour Saifi .
                                        </span>
                                        <span class="poostDate">Nov 7, 2019</span>
                                   </div>
                              </div>
                         </a>
                    </div>
               </div>
               <div class="col-xl-4 col-lg-4">
                    <div class="storyItem mb-4">
                         <a class="hoverEffect" href="#" target="_blank">
                              <div class="storyImage">
                                   <img class="imgHover"
                                        src="http://na.bw.ae/national-ambulance/public/uploads/news/7399.jpg">
                              </div>
                              <div class="storyDescription">
                                   <div class="storyCredit"><span>Community</span></div>
                                   <h4 class="storyTitle">Events' Ambulance Coverage</h4>
                                   <p>There are many variations of passages of Lorem Ipsum available, but the majority
                                        have suffered alteration in some form, by injected humour, or randomised words
                                        which don't look...<small>read more</small></p>
                                   <div class="storyAuthor">
                                        <span class="authorName">
                                             <font>By</font> Nour Saifi .
                                        </span>
                                        <span class="poostDate">Nov 7, 2019</span>
                                   </div>
                              </div>
                         </a>
                    </div>
               </div> -->
          </div>
          <a href="{{ route('employee-portal.story.view') }}"
               class=" btn btn-primary font-weight-medium todo-list-add-btn navyblueBtn">View More</a>
     </div>
</div>


<div class="card grid-margin mt-4">
     <div class="card-body pt_5">
          <!-- <div class="row"> -->

          @if(isset($team_salutes))
               <div class="row grid-margin mt-2">
                    @foreach($team_salutes as $d)
                         <?php
    $color="";
    switch ($d->category) {
  case "Respect":
    $color = "darkgreySalut";
    break;
  case "Excellence":
    $color = "navyblueSalut";
    break;
  case "Integrity":
    $color = "redSalut";
    break;
  case "Mutual Support":
    $color = "blackSalut";
    break;
  case "Accountability":
    $color = "blueSalut";
    break;
  default:
  break;
}
    ?> <div class="col-md-4">
                              <div class="card salut_certificate">
                                   <div class="pin"></div>
                                   <div class="card-body  {{ $color }}">
                                        <h3>Team Member Salute</h3>
                                        <div class="salutDesciription">
                                             <div class="stRow">
                                                  <label>To:</label>
                                                  <span>{{ $d->ts_to }}</span>
                                             </div>
                                             <div class="stRow">
                                                  <label>From:</label>
                                                  <span>{{ $d->ts_from }}</span>
                                             </div>
                                             <div class="stRow">
                                                  <label>Date:</label>
                                                  <span>{{ $d->ts_date }}</span>
                                             </div>
                                             <div class="stRow">
                                                  <label>For:</label>
                                                  <span>{{ $d->ts_for }}</span>
                                             </div>
                                             <div class="stRow"></div>
                                             <div class="stRow"></div>
                                             <div class="stRow"></div>
                                        </div>
                                        <div class="CategoryTitle">
                                             <h4>{{ $d->category }}</h4>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    @endforeach
          @endif
          <!-- <div class="col-md-4">
                    <div class="card salut_certificate">
                         <div class="pin"></div>
                         <div class="card-body redSalut">
                              <h3>Team Member Salute</h3>
                              <div class="salutDesciription">
                                   <div class="stRow">
                                        <label>To:</label>
                                        <span></span>
                                   </div>
                                   <div class="stRow">
                                        <label>From:</label>
                                        <span></span>
                                   </div>
                                   <div class="stRow">
                                        <label>Date:</label>
                                        <span></span>
                                   </div>
                                   <div class="stRow">
                                        <label>For:</label>
                                        <span></span>
                                   </div>
                                   <div class="stRow"></div>
                                   <div class="stRow"></div>
                                   <div class="stRow"></div>
                              </div>
                              <div class="CategoryTitle">
                                   <h4>Integrity</h4>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="col-md-4">
                    <div class="card salut_certificate">
                         <div class="pin"></div>
                         <div class="card-body darkgreySalut">
                              <h3>Team Member Salute</h3>
                              <div class="salutDesciription">
                                   <div class="stRow">
                                        <label>To:</label>
                                        <span></span>
                                   </div>
                                   <div class="stRow">
                                        <label>From:</label>
                                        <span></span>
                                   </div>
                                   <div class="stRow">
                                        <label>Date:</label>
                                        <span></span>
                                   </div>
                                   <div class="stRow">
                                        <label>For:</label>
                                        <span></span>
                                   </div>
                                   <div class="stRow"></div>
                                   <div class="stRow"></div>
                                   <div class="stRow"></div>
                              </div>
                              <div class="CategoryTitle">
                                   <h4>Respect</h4>
                              </div>
                         </div>
                    </div>
               </div> -->
          <!-- </div> -->
          <a href="{{ route('employee-portal.team-salute.view') }}"
               class=" btn btn-primary font-weight-medium todo-list-add-btn navyblueBtn">View More</a>

     </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
     $(document).ready(function () {

          $(".readmore").click(function (e) {
               e.preventDefault();

               var id = $(this).attr('value');
               if ($('#story-desc-' + id).hasClass('text-truncate')) {
                    $('#story-desc-' + id).removeClass('text-truncate');
                    $(this).text('Read Less');
               } else {
                    $('#story-desc-' + id).addClass('text-truncate');
                    $(this).text('Read More');
               }
          });
     });
</script>
@push('plugin-scripts')

     <script
          src="{{ asset('public/employee_portal/assets/plugins/chartjs/chart.min.js') }}">
     </script>
     <script
          src="{{ asset('public/employee_portal/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}">
     </script>

@endpush

@push('custom-scripts')
     <script src="{{ asset('public/employee_portal/assets/js/dashboard.js') }}"></script>

@endpush