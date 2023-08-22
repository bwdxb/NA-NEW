<?php
use app\Http\helper\Helper as Helper;
//echo Request::segment(1);
if(Request::segment(2) == 'board-director')
{
	$parent_id = 2;
}
elseif(Request::segment(2) == 'news_detail')
{
	$parent_id = 6;
}
else
{
	$parent_id = $page->parent_id;
}
$mainMenuTitle = Helper::mainMenuTitleById($parent_id);
$leftSubMenu = Helper::geSubMenu($parent_id);
?>
<aside class="menuSidebar mt-4">

	@if(app()->getLocale() == 'en')
	<h4>{{$mainMenuTitle->title}}</h4>
	@else
	<h4>{{$mainMenuTitle->title}}</h4>
	@endif
	<ul class="sidebarNav">
		<?php foreach($leftSubMenu as $leftSub){
			$leftSubSubMenu = Helper::geSubSubMenu($leftSub->id);
			$leftSubSubMenuArray = $leftSubSubMenu->toArray();
			?>
			<li <?php if(!empty($leftSubSubMenuArray)){?>class="dropdown"<?php }?> <?php if(Request::segment(2) == $leftSub->slug) {?>class="active" <?php }?>>
				<a <?php if(!empty($leftSubSubMenuArray)) {?> class="dropdown-link"  <?php }else {?> href="{{url('/page/'.$leftSub->slug)}}" <?php }?>>
					@if(app()->getLocale() == 'en')
					{{$leftSub->title}}
					@else
					{{$leftSub->title}}
					@endif
				</a>
				<?php if(!empty($leftSubSubMenuArray)){?>
					<div class="sidebarDropdown" style="display:none;"> 
						<?php foreach($leftSubSubMenu as $leftSubSub){?>
							<a class="dropdown-item" href="{{url('/inner_page/'.$leftSubSub->slug)}}">
								@if(app()->getLocale() == 'en')
								{{$leftSubSub->title}}
								@else
								{{$leftSubSub->title}}
								@endif
							</a>
						<?php }?>

					</div>
				<?php }?>
			</li>

		<?php }?>
		<?php if($mainMenuTitle->title == 'About Us'){?>
			<li <?php if(Request::segment(1) == 'board-director'){?> class="active" <?php }?>><a href="{{url('/board-director')}}" >Board of Directors</a></li>
		<?php }?>

	</ul>
</aside>