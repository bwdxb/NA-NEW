<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redis;
use DB;
use App\Role;
use App\StaticContent;
use App\Menu;
use App\SubMenu;
use App\SubMenuVersion;
use Session;
use Auth; 

use app\Http\helper\Helper as Helper;

class SubMenuController extends Controller
{
   
    public function index(Request $request)
    {
	
		Helper::checkUserSession();
		Helper::checkPagePermission('VW_CMS','view',session('userRoleIDs')); 
		$menus = Menu::pluck('title','id');
		$pages = DB::table('sub_menu')->join('static_content', 'sub_menu.parent_id', '=', 'static_content.id')
		 							->join('menu_management', 'menu_management.id', '=', 'static_content.parent_id');
									
		if(isset($request->main_id))
		 {
			$pages = $pages->where('sub_menu.main_id', '=', $request->main_id);
		 }
         if(isset($request->parent_id))
		 {
			$pages = $pages->where('sub_menu.parent_id', '=', $request->parent_id);
		 }
         if(isset($request->title))
		 {
			$pages = $pages->where('sub_menu.title','LIKE','%'.$request->title.'%');
		 }
		
		
        $pages = $pages->select('menu_management.title as main_title','static_content.title as parent_title', 'sub_menu.*') ->Paginate(10);
		
        return view('Admins.submenu_management.index',compact('pages', 'menus'))->with('i', 1);
    }

    public function create()
    {
		Helper::checkUserSession();
		Helper::checkPagePermission('CR_CMS','view',session('userRoleIDs')); 
		$menus = Menu::pluck('title','id');
		
        return view('Admins.submenu_management.create',compact('menus'));
    
    }

    public function store(Request $request)
    {
        $page = new SubMenu();
		$page->main_id = $request->main_id;
		$page->parent_id = $request->parent_id;
        $page->title = $request->title;
        $page->title_ar = $request->title_ar;
		$page->slug = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title));
        $page->description =$request->description;
        $page->description_ar =$request->description_ar;
		$page->created_by =Auth::user()->id;
		if($request->hasFile('image'))
		{
            $image=$request->file('image');
            $new_name = rand(1000,9999).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/cms'),$new_name);
            $page->image = $new_name;
        }  
        if($request->preview){
				

        $parent_page = StaticContent::where('id', $page->parent_id)->first();

        // return view('website.innercms', compact('inner_page', 'page'));
           
            $html = view('website.innercms',['inner_page'=>$page,'page'=>$parent_page])->render();
             return redirect()->back()->with("preview_page",$html)->withInput();
            }else{
        if($page->save())
		{
        
			 Session::flash('message', 'Page has been added successfully');
			  return redirect()->route('submenu.index'); 
		}
		else
		{
			Session::flash('error', 'Page not added successfully');
			  return redirect()->route('submenu.index');  
		}

    }
    }

    public function show($id)
    { 
        $page = SubMenu::where('id',$id)->first();
        return view('Admins.submenu_management.show',compact('page'));
    }

   
    public function edit($id)
    {
         $page = SubMenu::find($id);
        $menus = Menu::pluck('title','id');
        return view('Admins.submenu_management.edit',compact('page','menus'));
    }

    public function update(Request $request, $id)
    {
        $page = SubMenu::where('id',$id)->first();
        $oldPage = SubMenu::where('id',$id)->first(); // for version control
        $page->main_id = $request->main_id;
        $page->parent_id = $request->parent_id;
        $page->title = $request->title;
        $page->title_ar = $request->title_ar;
		$page->slug = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title));
        $page->description = $request->description;
        $page->description_ar = $request->description_ar;
		if($request->hasFile('image'))
		{
            $image=$request->file('image');
            $new_name = rand(1000,9999).'.'.$image->getClientOriginalExtension();
            $image-> move(public_path('uploads/cms'),$new_name);
            $page->image = $new_name;
        }  
                if($request->preview){
                    $parent_page = StaticContent::where('id', $page->parent_id)->first();
                    // return view('website.innercms', compact('inner_page', 'page'));
                    
                        $html = view('website.innercms',['inner_page'=>$page,'page'=>$parent_page])->render();
                        return redirect()->back()->with("preview_page",$html)->withInput();
                }else{
                    if($page->save())
                    {
                        $tempPageData= $oldPage->toArray();
                        $tempPageData['sub_menu_id']=$tempPageData['id'];
                        $tempPageData['created_by']=Auth::user()->id;
                        unset($tempPageData['id']);
                        unset($tempPageData['created_at']);
                        $vcData= new SubMenuVersion($tempPageData);
                        $vcData->save();
                        Redis::del($page->slug);
                        Session::flash('message', 'Page has been updated successfully');
                        return redirect()->route('submenu.index'); 
                    }
                    else
                    {
                        Session::flash('error', 'Page not updated successfully');
                        return redirect()->route('submenu.index'); 
                    }
       
                }
    }
	
	public function status($id)
    {
        $page = SubMenu::where('id', $id)->first();

        if ($page->status == 1)
        {
            $page->status = 0; //0 for Block
            $page->save();

        }
        else 
		{
			$page->status = 1; //1 for Unblock
			$page->save();
		}

        if ($page->status == 1)
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
       
        $page=SubMenu::find($id);
        
        if($page->delete())
        {
            Session::flash('message', 'Page has been updated successfully');
            Session::flash('success', 'Page has been deleted successfully');
        }else{
            Session::flash('error', 'Failed to delete the page');
        }
       return redirect()->route('submenu.index'); 
       
    }
    public function history($id)
    {
        try {
            //code...
            $pages = SubMenuVersion::where('sub_menu_id',$id)->orderBy('id','DESC');
            $pages = $pages->paginate(10);
            return view('Admins.submenu_management.history',compact('pages'))->with('i',1);
        } catch (Exception $ex) {
            Log::error($ex);
            Session::flash('error', 'internal server error');
            return redirect()->route('submenu.index'); 
        }
        
    }
    public function pageRevert(Request $request,$id)
	{
        try{
            $revertPageData =  SubMenuVersion::where('id',$id)->first();
            $oldPage = SubMenu::find($revertPageData->sub_menu_id);
            $page = SubMenu::find($revertPageData->sub_menu_id);
            $page->main_id = $revertPageData->main_id;
            $page->parent_id = $revertPageData->parent_id;
            $page->title = $revertPageData->title;
            $page->title_ar = $revertPageData->title_ar;
            $page->sequence_number = $revertPageData->sequence_number;
            $page->slug = $revertPageData->slug;
            $page->description = $revertPageData->description;
            $page->description_ar = $revertPageData->description_ar;
            $page->image = $revertPageData->image;
           if($request->preview){
            // dd($request->all());
            // $page = StaticContent::where('slug', $slug)->first();
            // dd($request->all());
            // return view('website.cms', compact('page'));
            $html = view('website.cms', compact('page'))->render();
            return redirect()->back()->with("preview_page",$html)->withInput();
        }else{ 
               if($page->isDirty()){
                if($page->save())
                {
                    $tempPageData= $oldPage->toArray();
                    $tempPageData['sub_menu_id']=$tempPageData['id'];
                    $tempPageData['created_by']=Auth::user()->id;
                    unset($tempPageData['id']);
                    unset($tempPageData['created_at']);
                    $vcData= new SubMenuVersion($tempPageData+['reverted'=>1]);
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
        return redirect()->route('submenu.index'); 

    }
	
}
