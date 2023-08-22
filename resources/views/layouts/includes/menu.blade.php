@php
use app\Http\helper\Helper as Helper;
$mainMenu = Helper::getMainMenu();
$config = Helper::getConfigByType('CAREER_STATUS_BUTTON');

@endphp
<div class="navbar-collapse" id="navbar_menu">
    <ul class="navbar-nav" id="menu">
        <?php
        foreach ($mainMenu as  $main) {
            $subMenu = Helper::geSubMenu($main->id);
            $subMenuArray = $subMenu->toArray();

            if ($main->id == 8 || $main->id==9) {
                ?>
                
                <?php
            } elseif ($main->id == 5) {
                ?>
                @if($config->status)
                <li class="nav-item">
                @if(app()->getLocale() == 'en')
                            <a class="nav-link" aria-current="page" href="{{env('SUB_DOMAIN_CAREERS')}}/en">{{__('Careers')}}</a>
                            @else
                            <a class="nav-link" aria-current="page" href="{{env('SUB_DOMAIN_CAREERS')}}/ar">{{__('Careers')}}</a>
                            @endif
                    <!-- <a class="nav-link" aria-current="page" href="{{route('career-portal.index')}}">{{__('Careers')}}</a> -->
                </li>
                @endif
                <?php
            } elseif ($main->id == 7) {
                ?>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{LaravelLocalization::localizeUrl('/contact-us')}}">{{__('Contact Us')}}</a>
                </li>
                <?php
            } else {
                ?>
                <li class="nav-item <?php if (!empty($subMenuArray)) {?> dropdownMenu <?php } ?>">
                    <a class="nav-link" {{($main->id==4)?"href=".LaravelLocalization::localizeUrl('/our-services'):'#'}} {{($main->id==2)?"href=".LaravelLocalization::localizeUrl('/page/who-we-are'):'#'}} {{($main->id==6)?"href=".LaravelLocalization::localizeUrl('/page/news'):'#'}}   " style="cursor:pointer;">
    
                            
                            @if(app()->getLocale() == 'en')
                            {{$main->title}}
                            @else
                            {{$main->title_ar}}
                            @endif
                            

                        </a>
                        <?php if (!empty($subMenuArray)) {?>
                            <ul id="submenu" class="subMenu">
                                <?php foreach ($subMenu as $sub) {
                    $subSubMenu = Helper::geSubSubMenu($sub->id);
                    $subSubMenuArray = $subSubMenu->toArray(); ?>

                                    <li <?php if (!empty($subSubMenuArray)) {?> class="subNav" <?php } ?>>
                                        <a class="subLink" <?php if (!empty($subSubMenuArray)) {?>  href="javascript:void(0)"
                                         <?php } else {?> href="{{LaravelLocalization::localizeUrl('/page/'.$sub->slug)}}" <?php } ?>>
                                         @if(app()->getLocale() == 'en')
                                         {{$sub->title}}
                                         @else
                                         {{$sub->title_ar}}
                                         @endif
                                     </a>
                                     <?php if (!empty($subMenuArray)) {?>
                                        <ul id="menuLevel2" class="subMenu level_2">
                                            <?php foreach ($subSubMenu as $subSub) {?>
                                                <li><a href="{{LaravelLocalization::localizeUrl('/inner_page/'.$subSub->slug)}}">
                                                    @if(app()->getLocale() == 'en')
                                                    {{$subSub->title}}
                                                    @else
                                                    {{$subSub->title_ar}}
                                                    @endif
                                                </a></li>
                                            <?php }?>
                                        </ul>
                                    <?php } ?>
                                </li>

                            <?php
                }?>
                            <?php if ($main->title == 'About Us') {?>
                                <li><a class="subLink" href="{{LaravelLocalization::localizeUrl('/board-director')}}">{{__('Board of Directors')}}</a></li>
                            <?php }?>
                        </ul>
                    <?php } ?>
                </li>
            <?php
            }
        }?>


        </ul>
        <div class="topSearch mobHide">
            <button class="searchBtn"></button>
        </div>
        <form id="deskSearch" class="toggleSearch mobHide" style="display:none;" action="{{route('search')}}">
            <input type="text" name="s" class="form-control " placeholder="{{__('Search here...')}}">
        </form>
    <!-- {{--    <a class="mob_lang" href="#">العربية</a>--}}
    @if(app()->getLocale() == 'en')
    <a class="mob_lang" href="{{route('locale.set',['locale'=>'ar'])}}">العربية</a>
    @else
    <a class="mob_lang" href="{{route('locale.set',['locale'=>'en'])}}">| English</a>
    @endif -->
</div>