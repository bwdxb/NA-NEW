@php
use app\Http\helper\Helper as Helper;
$mainMenu = Helper::getMainMenu();

@endphp
@extends('layouts.index')

@section('content')
<!-- Content Header (Page header) Banner -->
<!-- <section class="pageBanner"
style="background-image: url({{ url('public/website/images/sitemap-banner.jpg') }})">
<div class="pageHeading">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{__('Sitemap')}}</h1>
                <span class="subTitle">{{__('National Ambulance')}}</span>
            </div>
        </div>
    </div>
</div>
</section> -->

<section class="pageWrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12  mt-5">
            <div class="contentWrap mb-5">
                <h2 class="sitemap_title">{{__('Sitemap')}}</h2>
                <ul class="navbar-nav sitemapList" id="menu">
        <?php
        foreach ($mainMenu as  $main) {
            $subMenu = Helper::geSubMenu($main->id);
            $subMenuArray = $subMenu->toArray();

             if ($main->id == 8 || $main->id==9) {
                ?>
                
                <?php
            } elseif ($main->id == 5) {
                ?>
                <li class="nav-item">
                    <a class="nav-link" target="_blank" aria-current="page" href="{{route('career-portal.index')}}">{{__('Careers')}}</a>
                </li>
                <?php
            } elseif ($main->id == 7) {
                ?>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{url('/contact-us')}}">{{__('Contact Us')}}</a>
                </li>
                <?php
            } else {
                ?>
                <li class="nav-item <?php if (!empty($subMenuArray)) {?> dropdownMenu <?php } ?>">
                    <!-- <a class="nav-link active" {{($main->id==4)?"href=".url('/our-services'):'#'}} {{($main->id==2)?"href=".url(''):'#'}} {{($main->id==6)?"href=".url('/page/news'):'#'}}  {{($main->id==3)?"href=".url('/page/clinical-governance'):'#'}} "> -->
                        <a class="nav-link" {{($main->id==4)?"href=".url('/our-services'):'#'}}>
                            
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
                                        <a class="subLink" <?php if (!empty($subSubMenuArray)) {?>  href="#"
                                         <?php } else {?> href="{{url('/page/'.$sub->slug)}}" <?php } ?>>
                                         @if(app()->getLocale() == 'en')
                                         {{$sub->title}}
                                         @else
                                         {{$sub->title_ar}}
                                         @endif
                                     </a>
                                     <?php if (!empty($subMenuArray)) {?>
                                        <ul id="menuLevel2" class="subMenu level_2">
                                            <?php foreach ($subSubMenu as $subSub) {?>
                                                <li><a href="{{url('/inner_page/'.$subSub->slug)}}">
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
                            <?php if ($main->title == 'About US') {?>
                                <li><a href="{{url('/board-director')}}">{{__('Board of Directors')}}</a></li>
                            <?php }?>
                        </ul>
                    <?php } ?>
                </li>
            <?php
            }
        }?>


        </ul>
                   </div>
                   </div>
        </div>
    </div>
</section>

@endsection
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    function btnRefresh() {
        $.ajax({
            type: 'GET',
            url: public_url + '/refresh_captcha',
            success: function (data) {

                $(".captcha span").html(data.captcha);

            }

        });

    }
</script>

@section('script')

@endsection