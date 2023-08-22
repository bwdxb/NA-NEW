@php

use app\Http\helper\Helper as Helper;
$notifications = Helper::getMyNotificationByLastWeek();

@endphp

<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
    <a class="navbar-brand brand-logo" href="{{ url('/employee-portal/home') }}">
      <img src="{{asset('public/website/images/national-ambulance-logo-white.svg')}}" alt="logo"/> </a>
  
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        
          @include('layouts.includes.breadcrumbs')
      
   
           <ul class="navbar-nav navbar-nav-right">
        
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="mdi mdi-bell-outline"></i>
              @if(count($notifications)>0)
                <span class="count bg-success">{{count($notifications)}}</span>
              @endif
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">
                <a class="dropdown-item py-3 border-bottom">
                  <p class="mb-0 font-weight-medium float-left">{{count($notifications)}} New Notifications </p>
                  <span  class="badge badge-pill badge-primary float-right" href="{{route('employee-portal.notifications')}}" onclick="javascript:window.location.replace(this.getAttribute('href'))">View all</span>
                </a>
                @foreach($notifications as $key=>$value)
                
                <a class="dropdown-item preview-item py-3" href="{{route('employee-portal.notifications.seen',$value->id)}}" >
                 
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal text-dark mb-1 text-capitalize">{{$value->title}}</h6>
                    <small class="pb-1">{{$value->description}}</small>
                    <p class="font-weight-light small-text mb-0 mt-1"> {{\Carbon\Carbon::parse($value->created_at)->diffForHumans()}}</p>
                  </div>
                </a>
                @endforeach
               
              </div>
            </li> 
         
            <li class="nav-item dropdown d-none d-xl-inline-block">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown"
              aria-expanded="false">
             
              <span class="profile-text d-none d-md-inline-flex"> {{session('LoggedUser.first_name')}}   {{session('LoggedUser.last_name')}}</span>
                
                     @if(session('LoggedUser.image')) <!-- 1153.jpeg  -->
                     <img class="img-xs rounded-circle"
                     src="{{asset(session('LoggedUser.image'))}}" alt="Profile image">
                     @else
                     <img class="img-xs rounded-circle"
                     src="{{ 'https://ui-avatars.com/api/?name='.session('LoggedUser.first_name').' '.session('LoggedUser.last_name') }}" alt="Profile image">

                     @endif

                   </a>
                 </a>
                 <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                  <a class="dropdown-item p-0">
                    <div class="d-flex border-bottom w-100 justify-content-center">
                          
                              <a href="{{route('user-profile.view')}}"
                              class="py-3 px-4 d-flex align-items-center justify-content-center">
                              {{--                                <i class="mdi mdi-account-outline mr-0 text-gray"></i>--}}
                              <i class=" fa fa-suitcase"></i>Profile
                            </a>
                           
                          </div>
                        </a>
                        
                        <a class="dropdown-item align-items-center justify-content-center mt-3" href="{{route('user-profile.password.view')}}"><i class="fa fa-lock"></i> Change Password</a>
                    
                        <hr/>
                        <a href="{{url('/employee-portal/logout')}}" class="dropdown-item align-items-center justify-content-center" onClick="return confirm('Are You sure you want to logout?');"><i class="fa fa-key"></i> Log Out</a>
                      </div>
                    </li>
                  </ul>
                  <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                  data-toggle="offcanvas">
                  <span class="mdi mdi-menu icon-menu"></span>
                </button>
              </div>
            </nav>