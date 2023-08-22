<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use DB;
use App\Role;
use App\News;
use App\NewsVersion;
use App\NewsCategory;
//use App\StaticContent;
use Session;
use Auth; 
use Butschster\Head\MetaTags\MetaInterface;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;
use Image;
use File;

class NewsController extends Controller
{
   
    public function index(Request $request)
    {    	
		// dd($request->all());
        $news = DB::table('news_management')->leftjoin('news_category', 'news_management.cat_id', '=', 'news_category.id');
        if(isset($request->title))
		{
            $news = $news->where('title','LIKE','%'.$request->title.'%');
        }

		if($request->lang){
			$news = $news->where('lang',$request->lang);
		}
		if($request->cat_id)
		{
			$news = $news->where('cat_id', (int)$request->cat_id);
		}
		
		if($request->year)
		{
			$news = $news->whereYear('news_date', (int)$request->year);
		}
		if($request->month)
		{
			$news = $news->whereMonth('news_date',  (int)$request->month);
		}
		if($request->sort_by){

			$news = $news->orderBy('news_date',$request->sort_by);
		}else{

			$news = $news->orderBy('news_date','desc');
		}
		$news = $news->select('news_category.name as category', 'news_management.*') ->Paginate(10);		
        return view('Admins.news_management.index',compact('news'))->with('i', 1);
    }

    public function create()
    {
		$news_category = NewsCategory::pluck('name','id');
        return view('Admins.news_management.create',compact('news_category'));
    
    }

    public function store(Request $request)
    {
        $news = new News();
		$news->cat_id = $request->cat_id;
        $news->title = $request->title;
		$news->lang = $request->lang;
		
		if($request->alias == '')
		{
			$news->alias = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title));
		}
		else
		{
			$news->alias = $request->alias;
		}
		$news->news_date = date('Y-m-d', strtotime($request->news_date));
		$news->video = $request->video;
        $news->description =$request->description;
		$news->short_description =$request->short_description;
		$news->created_by =Auth::user()->id;
		
		 if($request->hasfile('cover_img'))
         {
			 $cover_img=$request->cover_img;
			$name = time().'-'.rand(1000,9999).'.'.$cover_img->extension();
			$media_type = explode('/', $cover_img->getMimeType())[0];
			if($media_type=='image'){
				$img = Image::make($cover_img->path());
				
				$file_url='public/uploads/news/' . $name;
				$path='public/uploads/news/';
				if(!File::exists($path)) {
					// path does not exist
					File::makeDirectory($path, 0777, true, true);
				}
				$img->save($file_url, 75);
			}else{
				$file->move(public_path('uploads/news'),$name);
			} 
			$news->cover_img=$name;
		 }
		 if($request->hasfile('filenames'))
         {
            foreach($request->file('filenames') as $file)
            {
                $name = time().'-'.rand(1000,9999).'.'.$file->extension();
				$media_type = explode('/', $file->getMimeType())[0];
				if($media_type=='image'){
					$img = Image::make($file->path());
					// $img = $img->encode('webp', 75);  // 75 is image quality and its value can be 1 to 100
					// $img->resize(500, 500, function ($constraint) { $constraint->aspectRatio(); }); // compression with aspectratio
					$file_url='public/uploads/news/' . $name;
					$path='public/uploads/news/';
                    if(!File::exists($path)) {
                        // path does not exist
                        File::makeDirectory($path, 0777, true, true);
                    }
					$img->save($file_url, 75);
				}else{
					$file->move(public_path('uploads/news'),$name);
				}  
                $data[] = $name;  
            }
			 $news->image=json_encode($data);
         }
		 if($request->preview){
			 return view('website.news_detail',compact('news'));
			// $html =  view('website.news_detail',compact('news'))->render();
			//  return redirect()->back()->with("preview_page",$html)->withInput();
			}else{
				if($news->save())
				{
				
					Session::flash('message', 'News has been added successfully');
					return redirect()->route('news.index'); 
				}
				else
				{
					Session::flash('error', 'Service not added successfully');
					return redirect()->route('news.index'); 
				} 
	}
    }

   
    public function edit($id)
    {    	
		$news_category = NewsCategory::pluck('name','id');
        $news = News::find($id);

        return view('Admins.news_management.edit',compact('news','news_category'));
    }

    public function update(Request $request, $id)
    {
        $oldPage = News::where('id',$id)->first();
        $news = News::where('id',$id)->first();
		$news->cat_id = $request->cat_id;
		$news->lang = $request->lang;
        $news->title = $request->title;
		$news->alias = $request->alias;
		$news->news_date = date('Y-m-d', strtotime($request->news_date));
		$news->video = $request->video;
		$news->short_description =$request->short_description;
        $news->description =$request->description;
		$news->updated_by =Auth::user()->id;
		$data = array();

		if($request->hasfile('cover_img'))
		{
			$cover_img=$request->cover_img;
		   $name = time().'-'.rand(1000,9999).'.'.$cover_img->extension();
		   $media_type = explode('/', $cover_img->getMimeType())[0];
		   if($media_type=='image'){
			   $img = Image::make($cover_img->path());
			   
			   $file_url='public/uploads/news/' . $name;
			   $path='public/uploads/news/';
			   if(!File::exists($path)) {
				   // path does not exist
				   File::makeDirectory($path, 0777, true, true);
			   }
			   $img->save($file_url, 75);
		   }else{
			   $file->move(public_path('uploads/news'),$name);
		   } 
		   $news->cover_img=$name;
		}
		if(!empty($request->image))
		{
			for($i = 0; $i<count($request->image);$i++)
			{
				$data[] = $request->image[$i];
			}
		}
		 if($request->hasfile('filenames'))
         {
            foreach($request->file('filenames') as $file)
            {
                $name = time().'-'.rand(1000,9999).'.'.$file->extension();
				$media_type = explode('/', $file->getMimeType())[0];
				if($media_type=='image'){
					$img = Image::make($file->path());
					// $img = $img->encode('webp', 75);  // 75 is image quality and its value can be 1 to 100
					// $img->resize(500, 500, function ($constraint) { $constraint->aspectRatio(); }); // compression with aspectratio
					$file_url='public/uploads/news/' . $name;
					$path='public/uploads/news/';
                    if(!File::exists($path)) {
                        // path does not exist
                        File::makeDirectory($path, 0777, true, true);
                    }
					$img->save($file_url, 75);
				}else{
                $file->move(public_path('uploads/news'),$name);  
				}
                $data[] = $name;  
            }
			 $news->image=json_encode($data);
         }
		 else
		 {
		 	$news->image=json_encode($data);
		 }
		 if(!empty($news->image)){
			$news->image=json_encode(array_reverse(json_decode($news->image)));
		   }
		 if($request->preview){
			 return view('website.news_detail',compact('news'));
			// $html =  view('website.news_detail',compact('news'))->render();
			//  return redirect()->back()->with("preview_page",$html)->withInput();
			}else{
       if($news->isDirty()){
		    if($news->save())
				{
					$tempPageData= $oldPage->toArray();
                    $tempPageData['news_id']=$tempPageData['id'];
                    $tempPageData['created_by']=Auth::user()->id;
                    unset($tempPageData['id']);
                    unset($tempPageData['created_at']);
                    $vcData= new NewsVersion($tempPageData);
                    $vcData->save();
				
					Session::flash('message', 'News has been updated successfully');
					return redirect()->route('news.index');
				}
				else
				{
					Session::flash('error', 'News not updated successfully');
					return redirect()->route('news.index');
				}
		}else{
			return redirect()->route('news.index');
		   }
	}
    }
	
	public function status($id)
    {
        $news = News::where('id', $id)->first();

        if ($news->status == 1)
        {
            $news->status = 0; //0 for Block
            $news->save();

        }
        else 
		{
			$news->status = 1; //1 for Unblock
			$news->save();
		}

        if ($news->status == 1)
        {
            return 1;
        }
        else
        {
            return 2;
        }
    }

    public function delete($id)
    {
        $news = News::find($id);
        $news->delete();
       return redirect()->route('news.index');
       
    }
	
	public function news_detail(Request $request,$id)
	{
		/*$news = News::find($id);
		return view('website.news_detail',compact('news'));*/
		$news = News::find($id);
		
		if((app()->getLocale() == 'en')&&($news->lang=='English')||(app()->getLocale() == 'ar')&&($news->lang=='Arabic')){
			if($news){
				$title= $news->title;
				$description=strip_tags($news->description);
				if (strlen($description) > 300)
				{
					$description = substr($description, 0, 300);
					$description = explode(' ', $description);
					array_pop($description); // remove last word from array
					$description = implode(' ', $description);
				}
				$og = new OpenGraphPackage($title);
				$images = json_decode($news->image);
				
				$og->setTitle($title);
				$og->setDescription(($description));
				// $og->setDescription(substr(strip_tags($description),0,300).'...');
				$card = new TwitterCardPackage($title);
				$card->setTitle($title);
				$card->setDescription(($description));
				// $card->setDescription(substr(strip_tags($description),0,300).'...');
				$card->setType('summary_large_image');
				if(!empty($images)){
					for($i=0; $i<count($images); $i++) {         
					if($i==0){
						$og->addImage(url('public/uploads/news/'.$images[$i]));
						$card->setImage(url('public/uploads/news/'.$images[$i]));
					}
				 }
				}
				Meta::registerPackage($card);
				Meta::registerPackage($og);
				Meta::prependTitle($title);
				Meta::setDescription($description);
				// Meta::placement('twitter.meta')->addMeta('twitter:card', ['content' => $description])->includePackages('twitter');
			}
			return view('website.news_detail',compact('news'));
		}else{		
			// if($news->lang=='Arabic'){
				// \Session::put('locale', 'ar');
				// return view('website.news_detail',compact('news'));
				// return redirect()->route('news.detail',$id);
			// }	
			return redirect('/admin/page/news');
		}
	}
	
	public function upload()
	{
		return view('Admins.news_management.upload');
	}
	
	public function csv_upload(Request $request)
	{
		$fname = $_FILES['csv_file']['name'];     
  		$chk_ext = explode(".",$fname);             

        $filename = $_FILES['csv_file']['tmp_name'];   
		 $handle = fopen($filename, "r");      
		 if(!$handle)
		 {
		 	die ('Cannot open file for reading');
		 }      
		while (($data = fgetcsv($handle, 10000, ",")) !== FALSE)
		 {
		
			DB::table('news_management')->insert(array( 'title' => $data[1], 'alias' => $data[2], 'cat_id' => 1, 'image' => $data[5], 'description' => $data[3], 'sequence_number' => $data[6], 'news_date' => $data[4]  ));
							 
		 }
		 fclose($handle);
		 exit;
	}


	public function pageRevert(Request $request,$id)
	{
        try{
            $revertPageData =  NewsVersion::where('id',$id)->first();
            $oldPage = News::find($revertPageData->news_id);
			$page = News::find($revertPageData->news_id);
			$page->cat_id = $revertPageData->cat_id;
			$page->lang = $revertPageData->lang;
			$page->title = $revertPageData->title;
			$page->alias = $revertPageData->alias;
			$page->news_date = $revertPageData->news_date;
			$page->video = $revertPageData->video;
			$page->short_description =$revertPageData->short_description;
			$page->description =$revertPageData->description;
			$page->image =$revertPageData->image;
			$page->updated_by =Auth::user()->id;
           if($request->preview){
            $news= $page;
			return view('website.news_detail',compact('news'));
          }else{ 
			  if($page->isDirty()){
                if($page->save())
                {
                    $tempPageData= $oldPage->toArray();
                    $tempPageData['news_id']=$tempPageData['id'];
                    $tempPageData['created_by']=Auth::user()->id;
                    unset($tempPageData['id']);
                    unset($tempPageData['created_at']);
                    $vcData= new NewsVersion($tempPageData+['reverted'=>1]);
                    $vcData->save();                
                    Session::flash('success', 'Page has been reverted successfully');
                }else{
                    Session::flash('error', 'Page not updated successfully');
                }
            }else{
                Session::flash('success', 'Ignored, No changes found in the reverted and current data');
            }
        }
           
        }catch(Exception $ex){
            Log::error($ex);
            Session::flash('error', 'internal server error');
        }
        return redirect()->route('news.index');

    }

    public function history($id)
    {
        try {
            //code...
            $news = NewsVersion::where('news_id',$id)->orderBy('id','DESC');
            $news = $news->paginate(10);
            return view('Admins.news_management.history',compact('news'))->with('i',1);
        } catch (Exception $ex) {
            Log::error($ex);
            Session::flash('error', 'internal server error');
            return redirect()->route('news.index');
        }
        
    }
}