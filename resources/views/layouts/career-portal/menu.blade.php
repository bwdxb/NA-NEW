    @php
use app\Http\helper\Helper as Helper;
$subMenu = Helper::geSubMenu(5);//id 5 is career portal menu parent id
$subMenuArray = $subMenu->toArray();
@endphp

<div class="navbar-collapse" id="navbar_menu">
    <ul class="navbar-nav" id="menu">
        <!--<li class="nav-item">
            <a class="nav-link active" href="{{env('APP_URL')}}career-portal">{{__('Careers')}}</a>
        </li>-->
        <?php
        foreach($subMenu as $sub){
            $subSubMenu = Helper::geSubSubMenu($sub->id);
            $subSubMenuArray = $subSubMenu->toArray();
       
        ?>
<li class="nav-item {{!empty($subMenuArray)?'dropdownMenu':''}}">
                <a class="nav-link" aria-current="page">
                    @if(app()->getLocale() == 'en')
                        {{$sub->title}}
                    @else
                        {{$sub->title_ar}}
                    @endif
                </a>
                 @if(!empty($subMenuArray)) 
                    <ul id="submenu" class="subMenu">
                        @foreach($subSubMenu as $subSub)
                            <li>
                                <a href="{{LaravelLocalization::localizeUrl('/inner_page/'.$subSub->slug)}}">
                                    @if(app()->getLocale() == 'en')
                                    {{$subSub->title}}
                                    @else
                                    {{$subSub->title_ar}}
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif 
            </li>
        <?php } ?>
<!--             <li class="nav-item dropdownMenu">
                <a class="nav-link" href="http://na.bw.ae/national-ambulance/contact-us">{{__('Contact Us')}}</a>
                <ul id="submenu" class="subMenu">
                    <li><a href="#">{{__('Emergency')}}</a></li>
                    <li><a href="#">{{__('Non Emergency')}}</a></li>
                    <li class="subNav">
                        <a class="subLink" href="#">{{__('Feedback')}}</a>
                        <ul id="menuLevel2" class="subMenu level_2">
                            <li><a href="#">{{__('Compliments, Complaints Or Suggestions')}}</a></li>
                            <li><a href="#">{{__('Surveys')}}</a></li>
                            <li><a href="#">{{__('Patient Testimonials')}}</a></li>
                        </ul>
                    </li>
                </ul>
            </li> -->
    </ul>
    <div class="topSearch mobHide">
        <button class="searchBtn"></button>
    </div>
    <form id="deskSearch" class="toggleSearch mobHide" style="display:none;"  action="{{route('search')}}">
                <input type="text" name="s" class="form-control " placeholder="{{__('Search here...')}}">
            </form>
    <!-- @if(app()->getLocale() == 'en')
    <a class="mob_lang" href="{{route('locale.set',['locale'=>'ar'])}}">العربية</a>
    @else
    <a class="mob_lang" href="{{route('locale.set',['locale'=>'en'])}}">| English</a>
    @endif -->
</div>