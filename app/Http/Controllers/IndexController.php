<?php

namespace App\Http\Controllers;

use App\Banner;
use App\BoardDirector;
use App\News;
use App\Notification;
use App\Partner;
use App\PublicAwareness;
use App\StaticContent;
use App\SubMenu;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redis;
use Butschster\Head\MetaTags\MetaInterface;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;
use Session;

class IndexController extends Controller
{
   
    public function indexRedirect(){
        return redirect('/');
    }
    public function index()
    {
        // Artisan::call('optimize:clear');
        $banners = Banner::where('status', '1')->orderBy('sequence_number', 'asc');
        $banners = $banners->paginate(5);

        $services = StaticContent::where(array('parent_id' => 4, 'status' => 1))->orderBy('id', 'asc');
        $services = $services->paginate(4);

        $partners = Partner::orderBy('id', 'DESC');
        $partners = $partners->where('status',1)->get();
       
        $lang = 'English';
        if(app()->getLocale() != 'en'){
			$lang = 'Arabic';
		}
        $news = News::where(array('status'=>'1','lang'=> $lang))->orderBy('news_date', 'desc'); 
        $news = $news->paginate(3);

        $public_awareness = PublicAwareness::where('status', '1')->orderBy('id', 'asc');
        $public_awareness = $public_awareness->paginate(3);

    //     $title= "Our Services";
    //     $image= url('/public/Image/200x200.jpg');
    //     $description= "National Ambulance provides quality pre-hospital emergency medical services for the people of the United Arab Emirates in line with the nation's healthcare objectives.";
    //     $og = new OpenGraphPackage($title);
    //     $og->addImage($image);
    //     $og->setTitle($title);
    //     $og->setDescription(substr(strip_tags($description),0,300).'...');
    //     $card = new TwitterCardPackage($title);
    // $card->setTitle($title);
    // $card->setDescription(substr(strip_tags($description),0,300).'...');
    // $card->setImage($image);
    // $card->setType('summary_large_image');
    //     Meta::registerPackage($card);
    //     Meta::registerPackage($og);
    //     Meta::prependTitle("Our Services");

        // Meta::prependTitle('Home page')
        // ->setDescription("National Ambulance provides quality pre-hospital emergency medical services for the people of the United Arab Emirates in line with the nation's healthcare objectives.");
    
        return view('website.index', compact('banners', 'services', 'partners', 'news', 'public_awareness'));
    }

    public function launch()
    {
        // Artisan::call('optimize:clear');
        $banners = Banner::where('status', '1')->orderBy('sequence_number', 'asc');
        $banners = $banners->paginate(5);

        $services = StaticContent::where(array('parent_id' => 4, 'status' => 1))->orderBy('id', 'asc');
        $services = $services->paginate(4);

        $partners = Partner::orderBy('id', 'DESC');
        $partners = $partners->where('status',1)->get();
       
        $lang = 'English';
        if(app()->getLocale() != 'en'){
			$lang = 'Arabic';
		}
        $news = News::where(array('status'=>'1','lang'=> $lang))->orderBy('news_date', 'desc'); 
        $news = $news->paginate(3);

        $public_awareness = PublicAwareness::where('status', '1')->orderBy('id', 'asc');
        $public_awareness = $public_awareness->paginate(3);
        return view('website.launch', compact('banners', 'services', 'partners', 'news', 'public_awareness'));
    }

    public function cms($slug)
    {
        $page = Redis::get($slug);        

        if(empty($page))
        {
            $page = StaticContent::where('slug', $slug)->first();
            Redis::set($slug, $page);
        }else{
            $page = json_decode($page);
        }        
        // dd($page);
        if($page){
            $title= app()->getLocale() == 'ar'?$page->title_ar:$page->title;
            $image= url('/public/uploads/cms/'.$page->image);
            $description=app()->getLocale() == 'ar'?strip_tags($page->description_ar):strip_tags($page->description);
            if (strlen($description) > 300)
				{
					$description = substr($description, 0, 300);
					$description = explode(' ', $description);
					array_pop($description); // remove last word from array
					$description = implode(' ', $description);
				}
            $og = new OpenGraphPackage($title);
            $og->addImage($image);
            $og->setTitle($title);
            $og->setDescription($description);
            $card = new TwitterCardPackage($title);
            $card->setTitle($title);
            $card->setDescription($description);
            $card->setImage($image);
            $card->setType('summary_large_image');
            Meta::registerPackage($card);
            Meta::registerPackage($og);
            Meta::prependTitle($title);
           
            return view('website.cms', compact('page'));
        }
        return abort(404);
    }

    public function innercms($slug)
    {        
        $inner_page = Redis::get($slug);        

        if(empty($inner_page))
        {
            $inner_page = SubMenu::where('slug', $slug)->first();
            Redis::set($slug, $inner_page);
        }else{
            $inner_page = json_decode($inner_page);            
        }

        $page = null;
        if($inner_page){
            $page=StaticContent::where('id', $inner_page->parent_id)->first();
            $title= app()->getLocale() == 'ar'?$inner_page->title_ar:$inner_page->title;
            $image= url('/public/uploads/cms/'.$inner_page->image);
            $description=app()->getLocale() == 'ar'?$inner_page->description_ar:$inner_page->description;
            $og = new OpenGraphPackage($title);
            $og->addImage($image);
            $og->setTitle($title);
            $og->setDescription(substr(strip_tags($description),0,300).'...');
            $card = new TwitterCardPackage($title);
            $card->setTitle($title);
            $card->setDescription(substr(strip_tags($description),0,300).'...');
            $card->setImage($image);
            $card->setType('summary_large_image');
            Meta::registerPackage($og);
            Meta::prependTitle($title);
        }

        return view('website.innercms', compact('inner_page', 'page'));
    }

    public function board_director()
    {
        $board_director = BoardDirector::orderBy('sequence_number', 'asc');

        $board_director = $board_director->get();
        Meta::prependTitle("Board of Directors");
        return view('website.board_director', compact('board_director'));
    }


    public function webLogout(Request $request)
    {
        if (Auth::check()) {

            Auth::logout();
            Session::forget('role');
            Session::flush();
        }
        return redirect()->route('web.index');
    }
    public function sitemap(Request $request)
    {
        return view('website.sitemap');
    }
    public function download(Request $request)
    {
        
            return view('download');
      
    }
    
    public function loginPage(Request $request)
    {
        
     
        
            return redirect('/login');
        
      
      
    }

}
