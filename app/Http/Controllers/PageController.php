<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use DB;
use App\Role;
use App\StaticContent;
use App\StaticContentVersion;
use App\Menu;
use Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redis;
use Auth;
use Image;
use File;

use app\Http\helper\Helper as Helper;

class PageController extends Controller
{

    public function index(Request $request)
    {
        Helper::checkUserSession();
        Helper::checkPagePermission('VW_CMS', 'view', session('userRoleIDs'));
        $menus = Menu::pluck('title', 'id');
        $pages = DB::table('menu_management')->join('static_content', 'menu_management.id', '=', 'static_content.parent_id');
        if (isset($request->parent_id)) {
            $pages = $pages->where('static_content.parent_id', '=', $request->parent_id);
        }
        if (isset($request->title)) {
            $pages = $pages->where('static_content.title', 'LIKE', '%' . $request->title . '%');
        }


        $pages = $pages->select('menu_management.title as parent_title', 'static_content.*')->Paginate(10);

        return view('Admins.static_management.index', compact('pages', 'menus'))->with('i', 1);
    }

    public function create()
    {
        Helper::checkUserSession();
        Helper::checkPagePermission('CR_CMS', 'view', session('userRoleIDs'));
        $menus = Menu::pluck('title', 'id');
        //echo "<pre>";
        //print_r($menus);die;
        return view('Admins.static_management.create', compact('menus'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            //  patient details
            'parent_id' => 'required',
            'title' => 'required',
            'title_ar' => 'required',
            'sequence_number' => 'required',
            'description' => 'required',
            'description_ar' => 'required',
        ], ['required' => "this field is required"]);
        if ($validator->fails()) {
            // Session::flash('error', 'validation failed. please fill all the fields');
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }
        $page = new StaticContent();
        $page->parent_id = $request->parent_id;
        $page->title = $request->title;
        $page->title_ar = $request->title_ar;
        $page->sequence_number = $request->sequence_number;
        $page->slug = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title));
        $page->description = $request->description;
        $page->description_ar = $request->description_ar;
        $page->created_by = Auth::user()->id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $new_name = rand(1000, 9999) . time() . '.' . $image->getClientOriginalExtension();
            $media_type = explode('/', $image->getMimeType())[0];
            if ($media_type == 'image') {
                $img = Image::make($image->path());
                // $img = $img->encode('webp', 75);  // 75 is image quality and its value can be 1 to 100
                // $img->resize(500, 500, function ($constraint) { $constraint->aspectRatio(); }); // compression with aspectratio
                $file_url = 'public/uploads/cms/' . $new_name;
                $path = 'public/uploads/cms';
                if (!File::exists($path)) {
                    // path does not exist
                    File::makeDirectory($path, 0777, true, true);
                }
                $img->save($file_url, 75);
            } else {
                $image->move(public_path('uploads/cms'), $new_name);
            }
            $page->image = $new_name;
        }
        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $new_name = rand(1000, 9999) . time() . '.' . $image->getClientOriginalExtension();
            $media_type = explode('/', $image->getMimeType())[0];
            if ($media_type == 'image') {
                $img = Image::make($image->path());
                // $img = $img->encode('webp', 75);  // 75 is image quality and its value can be 1 to 100
                // $img->resize(500, 500, function ($constraint) { $constraint->aspectRatio(); }); // compression with aspectratio
                $file_url = 'public/uploads/cms/' . $new_name;
                $path = 'public/uploads/cms';
                if (!File::exists($path)) {
                    // path does not exist
                    File::makeDirectory($path, 0777, true, true);
                }
                $img->save($file_url, 75);
            } else {
                $image->move(public_path('uploads/cms'), $new_name);
            }
            $page->banner = $new_name;
        }
        if ($request->preview) {
            // dd($request->all());
            // $page = StaticContent::where('slug', $slug)->first();
            // dd($request->all());
            // return view('website.cms', compact('page'));
            $html = view('website.cms', compact('page'))->render();
            return redirect()->back()->with("preview_page", $html)->withInput();
        } else {
            if ($page->save()) {


                Session::flash('message', 'Page has been added successfully');
                return redirect()->route('staticpage.index');
            } else {
                Session::flash('error', 'Page not added successfully');
                return redirect()->route('staticpage.index');
            }
        }
    }

    public function show($id)
    {
        $page = StaticContent::where('id', $id)->first();
        return view('Admins.static_management.show', compact('page'));
    }


    public function edit($id)
    {
        $page = StaticContent::find($id);
        $menus = Menu::pluck('title', 'id');

        return view('Admins.static_management.edit', compact('page', 'menus'));
    }

    public function update(Request $request, $id)
    {       
        $validator = Validator::make($request->all(), [
            //  patient details
            'parent_id' => 'required',
            'title' => 'required',
            'title_ar' => 'required',
            'sequence_number' => 'required',
            'description' => 'required',
            'description_ar' => 'required',
        ], ['required' => "this field is required"]);
        if ($validator->fails()) {
            // Session::flash('error', 'validation failed. please fill all the fields');

            return redirect()->back()->withErrors($validator)
                ->withInput();
        }
        $page = StaticContent::where('id', $id)->first();
        $oldPage = StaticContent::where('id', $id)->first(); // for version control
        $page->parent_id = $request->parent_id;
        $page->title = $request->title;
        $page->title_ar = $request->title_ar;
        $page->sequence_number = $request->sequence_number;
        if ($page->slug == "feedback") {
            $page->slug = "feedback";
        } else {

            $page->slug = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->title));
        }
        $page->description = $request->description;
        $page->description_ar = $request->description_ar;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $new_name = rand(1000, 9999) . time() . '.' . $image->getClientOriginalExtension();
            $media_type = explode('/', $image->getMimeType())[0];
            if ($media_type == 'image') {
                $img = Image::make($image->path());
                // $img = $img->encode('webp', 75);  // 75 is image quality and its value can be 1 to 100
                // $img->resize(500, 500, function ($constraint) { $constraint->aspectRatio(); }); // compression with aspectratio
                $file_url = 'public/uploads/cms/' . $new_name;
                $path = 'public/uploads/cms';
                if (!File::exists($path)) {
                    // path does not exist
                    File::makeDirectory($path, 0777, true, true);
                }
                $img->save($file_url, 75);
            } else {
                $image->move(public_path('uploads/cms'), $new_name);
            }
            $page->image = $new_name;
        }
        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $new_name = rand(1000, 9999) . time() . '.' . $image->getClientOriginalExtension();
            $media_type = explode('/', $image->getMimeType())[0];
            if ($media_type == 'image') {
                $img = Image::make($image->path());
                // $img = $img->encode('webp', 75);  // 75 is image quality and its value can be 1 to 100
                // $img->resize(500, 500, function ($constraint) { $constraint->aspectRatio(); }); // compression with aspectratio
                $file_url = 'public/uploads/cms/' . $new_name;
                $path = 'public/uploads/cms';
                if (!File::exists($path)) {
                    // path does not exist
                    File::makeDirectory($path, 0777, true, true);
                }
                $img->save($file_url, 75);
            } else {
                $image->move(public_path('uploads/cms'), $new_name);
            }
            $page->banner = $new_name;
        }
        if ($request->preview) {
            // dd($request->all());
            // $page = StaticContent::where('slug', $slug)->first();
            // dd($request->all());
            // return view('website.cms', compact('page'));
            $html = view('website.cms', compact('page'))->render();
            return redirect()->back()->with("preview_page", $html)->withInput();
        } else {
            if ($page->isDirty()) {
                if ($page->save()) {
                    $tempPageData = $oldPage->toArray();
                    $tempPageData['static_content_id'] = $tempPageData['id'];
                    $tempPageData['created_by'] = Auth::user()->id;
                    unset($tempPageData['id']);
                    unset($tempPageData['created_at']);
                    $vcData = new StaticContentVersion($tempPageData);
                    $vcData->save();

                    Redis::del($page->slug);

                    Session::flash('message', 'Page has been updated successfully');
                    return redirect()->route('staticpage.index');
                } else {
                    Session::flash('error', 'Page not updated successfully');
                    return redirect()->route('staticpage.index');
                }
            } else {
                return redirect()->route('staticpage.index');
            }
        }
    }

    public function status($id)
    {
        $page = StaticContent::where('id', $id)->first();

        if ($page->status == 1) {
            $page->status = 0; //0 for Block
            $page->save();
        } else {
            $page->status = 1; //1 for Unblock
            $page->save();
        }

        if ($page->status == 1) {
            return 1;
        } else {
            return 2;
        }
    }

    public function destroy($id)
    {

        $page = StaticContent::find($id);
        if ($page->delete()) {
            Session::flash('success', 'Page has been updated successfully');
        } else {
            Session::flash('error', 'Failed to delete the page');
        }

        return redirect()->route('page.index');
    }
    public function delete($id)
    {

        $page = StaticContent::find($id);
        if ($page->delete()) {
            Session::flash('success', 'Page has been updated successfully');
        } else {
            Session::flash('error', 'Failed to delete the page');
        }
        return redirect()->route('page.index');
    }
    public function manage_menu()
    {
        $menus = Menu::orderBy('id', 'DESC');
        $menus = $menus->paginate(10);
        return view('Admins.static_management.manage_menu', compact('menus'))->with('i', 1);
    }

    public function getSubmenu(Request $request)
    {
        $submenu_id = '';
        $submenu_list = StaticContent::where('parent_id', $request->parent_id)->orderBy('id')->pluck('title', 'id');

        if (!empty($request->submenu_id)) {
            $submenu_id = $request->submenu_id;
        }
        return view('Admins.ajax.get_sub_menu', compact('submenu_list', 'submenu_id'));
    }
    public function pageRevert(Request $request, $id)
    {
        try {
            $revertPageData =  StaticContentVersion::where('id', $id)->first();
            $oldPage = StaticContent::find($revertPageData->static_content_id);
            $page = StaticContent::find($revertPageData->static_content_id);
            $page->parent_id = $revertPageData->parent_id;
            $page->title = $revertPageData->title;
            $page->title_ar = $revertPageData->title_ar;
            $page->sequence_number = $revertPageData->sequence_number;
            $page->slug = $revertPageData->slug;
            $page->description = $revertPageData->description;
            $page->description_ar = $revertPageData->description_ar;
            $page->image = $revertPageData->image;
            $page->banner = $revertPageData->banner;
            if ($request->preview) {
                // dd($request->all());
                // $page = StaticContent::where('slug', $slug)->first();
                // dd($request->all());
                // return view('website.cms', compact('page'));
                $html = view('website.cms', compact('page'))->render();
                return redirect()->back()->with("preview_page", $html)->withInput();
            } else {
                if ($page->isDirty()) {
                    if ($page->save()) {
                        $tempPageData = $oldPage->toArray();
                        $tempPageData['static_content_id'] = $tempPageData['id'];
                        $tempPageData['created_by'] = Auth::user()->id;
                        unset($tempPageData['id']);
                        unset($tempPageData['created_at']);
                        $vcData = new StaticContentVersion($tempPageData + ['reverted' => 1]);
                        $vcData->save();
                        Session::flash('success', 'Page has been reverted successfully');
                    } else {
                        Session::flash('error', 'Page not updated successfully');
                    }
                } else {
                    Session::flash('success', 'Ignored, No changes found in the reverted and current data');
                }
            }
        } catch (Exception $ex) {
            Log::error($ex);
            Session::flash('error', 'internal server error');
        }
        return redirect()->route('staticpage.index');
    }

    public function history($id)
    {
        try {
            //code...
            $pages = StaticContentVersion::where('static_content_id', $id)->orderBy('id', 'DESC');
            $pages = $pages->paginate(10);
            return view('Admins.static_management.history', compact('pages'))->with('i', 1);
        } catch (Exception $ex) {
            Log::error($ex);
            Session::flash('error', 'internal server error');
            return redirect()->route('staticpage.index');
        }
    }
}
