<?php
namespace App\Http\helper;
use DB;
use Auth;
use App\Menu;
use App\StaticContent;
use App\SubMenu;
use App\Screen;
use App\Config;
use App\News;
use App\Country;
use App\OrganizationType;
use App\DocumentType;
use App\DocumentClassification;
use App\DocumentDepartment;
use App\Tender;
use Carbon\Carbon;
use App\VideoCategory;
use App\JobVacancyCategory;
use App\JobVacancy;
use App\NewsCategory;
use App\VideoGallery;
use App\Testimonials;
use App\Notification;
use App\MarketItemImages;
use App\Courses;
use App\CourseCategory;
use App\StoryCategory;
use App\Story;
use App\LaunchConfig;


class Helper
{ 
	/*Frontend function start*/
	
	public static function getMainMenu()
	{
		// $mainMenu = Menu::orderBy('id','asc')->get();
		$mainMenu = Menu::orderBy('id', 'asc')
		->whereNotin('id', [1])
		->get();
		return $mainMenu;
	}
	public static function geSubMenu($main_id)
	{
		$subMenu = StaticContent::orderBy('sequence_number','asc')->where(array('parent_id' => $main_id, 'status' => 1))->get();
		return $subMenu;
	}
	
	public static function geSubSubMenu($sub_id)
	{
		$subSubMenu = SubMenu::orderBy('id','asc')->where(array('parent_id' => $sub_id, 'status' => 1))->get();
		return $subSubMenu;
	}
	
	public static function mainMenuTitleById($parent_id)
	{
		$mainMenuTitle = Menu::where('id',$parent_id)->first();
		return $mainMenuTitle;
	}
	
	public static function subMenuTitleById($parent_id)
	{
		$subMenuTitle = StaticContent::where('id',$parent_id)->first();
		return $subMenuTitle;
	}
	
	public static function getNewsCategory()
	{
		$news_category = NewsCategory::pluck('name','id');
		return $news_category;
	}
	public static function getNewsCategoryAll()
	{
		$news_category = NewsCategory::get();
		return $news_category;
	}
	
	public static function getAllNews($cat_id,$title,$year,$month,$sort_by)
	{
		$lang = 'English';
		if(app()->getLocale() != 'en'){
			$lang = 'Arabic';
		}		
		$news = DB::table('news_management')->leftjoin('news_category', 'news_management.cat_id', '=', 'news_category.id')->where(array('news_management.status' => 1,'news_management.lang'=> $lang));
		
		if($cat_id)
		{
			$news = $news->where('cat_id', (int)$cat_id);
		}
		if($title)
		{
			$news = $news->where('title','LIKE','%'.$title.'%');
		}
		if($year)
		{
			$news = $news->whereYear('news_date', (int)$year);
		}
		if($month)
		{
			$news = $news->whereMonth('news_date',  (int)$month);
		}
		if($sort_by)
		{
			$news = $news->orderBy('news_date',$sort_by);
		}
		else
		{
			$news = $news->orderBy('news_date','desc');
		}
		$news = $news->select('news_category.name as cat_name','news_category.name_ar as cat_name_ar', 'news_management.*')->paginate(15);
		return $news;
	}
	public static function getAllCountries()
	{
		$allCountries =Country::pluck('country_name','id');
		return $allCountries;
	}
	public static function getAllCountryCodes()
	{
		$allCountryCodes = Country::pluck('phone_code','country_name');
		//echo "<pre>";
		//print_r($allCountryCodes);die;
		// dd($allCountryCodes);
		return $allCountryCodes;
	}
	public static function getAllOrganizationType()
	{
		// $allOrganizationType =OrganizationType::pluck('type','id');
		$allOrganizationType =OrganizationType::all();
		return $allOrganizationType;
	}

	public static function getAllTenders()
	{
		$allTenders = Tender::where('publishing_date', '<=', date('m/d/Y'))->where('closing_date', '>=', date('m/d/Y'))->orderBy('id','DESC')->get();
		return $allTenders;
	}
	
	public static function getSupplyChainContent()
	{
		$content = StaticContent::where(array('slug' => 'supply-chain'))->first();
		return $content;
	}
	
	public static function getVideoCategory()
	{
		//		$video_category = VideoCategory::pluck('name','id');
		$video_category = VideoCategory::all();
		return $video_category;
	}
	public static function getAllGallery($cat_id,$title,$year,$month,$sort_by)
	{
		$video_gallery = VideoGallery::where(array('status' => 1));
		if(isset($title))
		{
			$video_gallery = $video_gallery->where('title','LIKE','%'.$title.'%');
		}
		if(isset($cat_id))
		{
			$video_gallery = $video_gallery->where('cat_id', '=', $cat_id);
		}
		if(isset($year))
		{
			$video_gallery = $video_gallery->whereYear('video_date', '=', $year);
		}
		if(isset($month))
		{
			$video_gallery = $video_gallery->whereMonth('video_date', '=', $month);
		}
		if(isset($sort_by))
		{
			$video_gallery = $video_gallery->orderBy('video_date',$sort_by);
		}
		else
		{
			$video_gallery = $video_gallery->orderBy('video_date','desc');
		}

		$video_gallery = $video_gallery->paginate(15);
		return $video_gallery;
	}
	public static function getAllLangGallery($cat_id,$title,$year,$month,$sort_by)
	{
		$lang = 'English';
		if(app()->getLocale() != 'en'){
			$lang = 'Arabic';
		}
		$video_gallery = VideoGallery::where(array('status' => 1));
		$video_gallery = $video_gallery->where('lang', '=', $lang);
		if(isset($title))
		{
			$video_gallery = $video_gallery->where('title','LIKE','%'.$title.'%');
		}
		if(isset($cat_id))
		{
			//$video_gallery = $video_gallery->where('cat_id', '=', $cat_id);
			$video_gallery = $video_gallery->whereRaw('FIND_IN_SET("'.$cat_id.'",cat_id)');
			/*$video_gallery = $video_gallery->where('FIND_IN_SET('.$cat_id.', video_gallery.cat_id) > 0');*/
			
		}
		if(isset($year))
		{
			$video_gallery = $video_gallery->whereYear('video_date', '=', $year);
		}
		if(isset($month))
		{
			$video_gallery = $video_gallery->whereMonth('video_date', '=', $month);
		}
		if(isset($sort_by))
		{
			$video_gallery = $video_gallery->orderBy('video_date',$sort_by);
			// $video_gallery = $video_gallery->orderBy('created_at',$sort_by);
		}
		else
		{
			$video_gallery = $video_gallery->orderBy('video_date','desc');
			// $video_gallery = $video_gallery->orderBy('created_at','desc');
		}

		$video_gallery = $video_gallery->paginate(15);
		return $video_gallery;
	}
	/*end function end*/
	
	/*Admin function start*/
	public static function getModule()
	{
		$res = DB::table('screens')
		->select('module')
		->where('module', '!=', NULL)
		->where(array('show_menu' => 1))
		->distinct()->get();
		return $res;
	}
	
	public static function getpageCode($module)
	{
		$res = DB::table('screens')
		->select('*')
		->where(array('module'=> $module,'show_menu' => 1))->get();
		
		return $res;			
		
	}
	public static function checkPagePermission($pageCode,$mode,$session_roleID)
	{
		$isValid='0';
		if(!empty($roleIDs))
		{
			foreach($roleIDs as $role)
			{
				if(array_key_exists($pageCode,$_SESSION['allowedPageActions'][$role]))
				{
					if(($_SESSION['allowedPageActions'][$role][$pageCode] == '0' || $_SESSION['allowedPageActions'][$role][$pageCode]=='') && $isValid!='1')
					{
						$isValid= '0';
					}
					if($_SESSION['allowedPageActions'][$role][$pageCode] == '1')
					{
						$isValid= '1';
					}
				}
				else
				{
					$isValid= '0';
				}
			}
		}
		else
		{
			$isValid= '0';
		}
		
		if($isValid=='0')
		{
			return redirect('/no_access');
			return false;
			exit;		
		}

	} 
	public static function checkPageAccess($pageCode,$mode='view',$roleIDs='',$value='0')
	{
		$isValid='0';
		
		
		if(!empty($roleIDs))
		{
			foreach($roleIDs as $role)
			{
				if(array_key_exists($pageCode,$_SESSION['allowedPageActions'][$role]))
				{
					if(($_SESSION['allowedPageActions'][$role][$pageCode] == '0' || $_SESSION['allowedPageActions'][$role][$pageCode]=='') && $isValid!='1')
					{
						$isValid= '0';
					}
					if($_SESSION['allowedPageActions'][$role][$pageCode] == '1')
					{
						$isValid= '1';
					}
				}
				else
				{
					$isValid= '0';
				}
			}
		}
		else
		{
			$isValid= '0';
		}
		if($isValid== '0') return '0';
		else return true;	
	} 
	
	public static function checkUserSession()
	{
		session_start();
		if(!isset($_SESSION['LoggedUser']['user_id']))
		{
			return redirect('/login');
			return false;	
		}
	} 
	public static function all_services()
	{
		$services = StaticContent::where('status', '1')->where('parent_id', 4)
		->orderBy('id', 'asc')
		->get();
		return $services;
	} 
	public static function all_testimonials()
	{
		$services = Testimonials::where('status', '1')
		->orderBy('id', 'asc')
		->get();
		return $services;
	} 
	public static function services($slug)
	{
		$services = StaticContent::where('status', '1')->where('parent_id', 4)->where('slug','!=',$slug)
		->orderBy('id', 'asc')
		->get();
		return $services;
	} 
	public static function testimonials($category)
	{
		
		$services = Testimonials::where('status', '1')->where('category', trim($category))
		->orderBy('id', 'asc')
		->get();
		return $services;
	} 
	public static function testimonialsByCat($slug)
	{
		$services = StaticContent::where('status', '1')->where('parent_id', 4)->where('slug',$slug)
		->first();
		
		$testi = Testimonials::where('status', 'active')->where('category',$services->title)
		->orderBy('id', 'asc')
		->get();
		return $testi;
	} 
	public static function getJobCategories()
	{
		$categories = JobVacancyCategory::where('status', 'active')
		->orderBy('id', 'asc')
		->get();
		return $categories;
	} 
	// public static function getJobVacancyById($id)
	// {
	// 	$vacancy = JobVacancy::find($id);
	// 	->orderBy('id', 'asc')
	// 	->get();
	// 	return $vacancy;
	// } 
	/*Admin function start*/

	public static function getMyNotificationByLastWeek()
	{
		$data=[];
		$filtredArray=[];
		try {
			// Notification::where('')
			$previous_week = strtotime("-1 week +1 day");
			$start_week = strtotime("last sunday midnight",$previous_week);
			$end_week = strtotime("next saturday",$start_week);
			$start_week = date("Y-m-d",$start_week);
			$end_week = date("Y-m-d",$end_week);
			
			$data=Notification::orderBy('created_at','desc')->get();
			// $data=Notification::whereBetween('created_at', [$start_week, $end_week])->get();
			foreach ($data as  $value) {
				if(((in_array(Auth::id(),explode(',',$value->send_to)))&&!(in_array(Auth::id(),explode(',',$value->seen_by))))||($value->send_to==null&&!(in_array(Auth::id(),explode(',',$value->seen_by))))){
					$filtredArray[]=$value;
				}
			}
		} catch (\Exception $ex) {
		Log::error($ex);
		dd($ex);

		}
		return $filtredArray;
	}
	public static function getMyNotifications()
	{
		$data=[];
		$filtredArray=[];
		try {
			// Notification::where('')
			$previous_week = strtotime("-1 week +1 day");
 			$start_week = strtotime("last sunday midnight",$previous_week);
			$end_week = strtotime("next saturday",$start_week);
			$start_week = date("Y-m-d",$start_week);
			$end_week = date("Y-m-d",$end_week);

			$data=Notification::orderBy('created_at','desc')->get();
			foreach ($data as  $value) {
				if(((in_array(Auth::id(),explode(',',$value->send_to)))&&!(in_array(Auth::id(),explode(',',$value->seen_by))))||($value->send_to==null&&!(in_array(Auth::id(),explode(',',$value->seen_by))))){
					$filtredArray[]=$value;
				}
			}
		} catch (\Exception $ex) {
		Log::error($ex);
		dd($ex);

		}
		return $filtredArray;
	}
	public static function notificationSeen($ids){
		try {
			$notificatinData=Notification::find($ids);
			foreach ($notificatinData as $key => $value) {
				if(!in_array(Auth::id(),explode(',',$value->seen_by))){
				$value->seen_by= $value->seen_by.Auth::id().",";
				$value->save();
			}
			}
		} catch (\Exception $ex) {
			Log::error($ex);
		
		}

	}
	public static function getCoursesByCategory($cat){
		$courses=CourseCategory::where('status',1);
		try {
			if($cat){
				$courses=$courses->where('category',$cat);
			}
			
			$courses=$courses->get();
			
		} catch (\Exception $ex) {
			Log::error($ex);
		
		}
		return $courses;

	}
	public static function getMarketImages($id){
		
			$notificatinData=MarketItemImages::where('market_item_id',$id)->get();
			
		
		return $notificatinData;

	}
	public static function getConfigByType($type){
		
			$configData=Config::where('type',$type)->first();
			
		
		return $configData;

	}
	public static function getDocumentType(){
		
			$configData=DocumentType::where('status',1)->get();
			
		
		return $configData;

	}
	public static function getDocumentClassification(){
		
			$configData=DocumentClassification::where('status',1)->get();
			
		
		return $configData;

	}
	public static function getDocumentDepartment(){
		
			$configData=DocumentDepartment::where('status',1)->get();
			
		
		return $configData;

	}
	public static function getStoryCategory(){
			$configData=StoryCategory::where('status',1)->get();
		return $configData;

	}
	public static function getStoryYears(){
			
			$years=Story::where('status','approved')
			->get()
			->groupBy(function($val) {
				return Carbon::parse($val->created_at)->format('Y');
	  		})->toArray();
		return $years;
		

	}
	public static function getLaunchConfig(){
			
			$data=LaunchConfig::find(1);
		return $data;
		

	}
	
}