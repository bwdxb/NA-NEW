<?php

namespace App\Http\Controllers;

use App\ServiceCMS;
use App\ServiceCMSVersion;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use DB;
use App\Role;
use App\Service;
use Illuminate\Support\Facades\Log;
use Session;
use Auth;
use App\StaticContent;

class ServiceController extends Controller
{

    public function index()
    {
        $services = Service::orderBy('id', 'DESC');
//        if (isset($request->search)) {
//            $services = $services->where('name', 'LIKE', '%' . $request->search . '%');
//        }
        $services = $services->paginate(10);
        return view('Admins.service_management.index', compact('services'));
    }

    public function create()
    {
        return view('Admins.service_management.create');

    }

    public function store(Request $request)
    {
        $service = new Service();
        $service->name = $request->name;
        $service->slug = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name));
        $service->description = $request->description;
        $service->created_by = Auth::user()->id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $new_name = rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/service'), $new_name);
            $service->image = $new_name;
        }
        if ($service->save()) {

            Session::flash('message', 'Service has been added successfully');
            return redirect()->route('service.index');
        } else {
            Session::flash('error', 'Service not added successfully');
            return redirect()->route('service.index');
        }
    }


    public function edit($id)
    {
        $service = Service::find($id);
        return view('Admins.service_management.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::where('id', $id)->first();

        $service->name = $request->name;
        $service->slug = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name));
        $service->description = $request->description;
        $service->updated_by = Auth::user()->id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $new_name = rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/service'), $new_name);
            $service->image = $new_name;
        }
        if ($service->save()) {

            Session::flash('message', 'Service has been updated successfully');
            return redirect()->route('service.index');
        } else {
            Session::flash('error', 'Service not updated successfully');
            return redirect()->route('service.index');
        }
    }

    public function status($id)
    {
        $service = Service::where('id', $id)->first();

        if ($service->status == 1) {
            $service->status = 0; //0 for Block
            $service->save();

        } else {
            $service->status = 1; //1 for Unblock
            $service->save();
        }

        if ($service->status == 1) {
            return 1;
        } else {
            return 2;
        }
    }

    public function validateService(Request $request)
    {

        $service = Service::where('name', $request->name)->first();
        if ($service) {
            return 0;
        }
        return 1;


    }

    public function validateServiceEdit(Request $request)
    {

        $service = Service::where('name', $request->name)->where('id', '!=', $request->id)->first();

        if ($service) {
            return 0;
        }

        return 1;
    }

    public function delete($id)
    {

        $service = Service::find($id);
        $service->delete();
        return redirect()->route('service.index');

    }

    public function adminCMSManageServiceInfo()
    {
        try {
            $service = ServiceCMS::find(1);


            return view('Admins.static_management.manage_services_info', [
                'data' => $service,
            ]);
        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('error', 'Internal Server Error Occured, Please try again later...');
            return back();
        }
    }

    public function adminUpdateCMSManageServiceInfo(Request $request)
    {
        try {
            $oldPage = ServiceCMS::find(1);
            $serviceCMS = ServiceCMS::find(1);
            $serviceCMS->intro = $request->intro;
            $serviceCMS->intro_ar = $request->intro_ar;
            $serviceCMS->concl = $request->concl;
            $serviceCMS->concl_ar = $request->concl_ar;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $new_name = rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/service'), $new_name);
                $serviceCMS->banner = $new_name;
            }
            if($request->preview){
                $services = StaticContent::where('status', '1')->where('parent_id', 4)
                    ->orderBy('id', 'asc')
                    ->get();
                                
                    
                $html =  view('website.our_services', ['data' => $serviceCMS, 'services' => $services])->render();
                 return redirect()->back()->with("preview_page",$html)->withInput();
                }else{
                    if($serviceCMS->isDirty()){
                   if ($serviceCMS->save()) {


                    $tempPageData= $oldPage->toArray();
                    $tempPageData['cms_id']=$tempPageData['id'];
                    $tempPageData['created_by']=Auth::user()->id;
                    unset($tempPageData['id']);
                    unset($tempPageData['created_at']);
                    // dd($tempPageData);
                    $vcData= new ServiceCMSVersion($tempPageData);
                    $vcData->save();
                        Session::flash('success', 'Service Info has been updated successfully');

                    } else {
                        Session::flash('error', 'Failed to update new Service Info');
                    }
}else{
    $serviceCMS->refresh();
    return view('Admins.static_management.manage_services_info', [
        'data' => $serviceCMS,
    ]); 
}
                }
          

        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('error', 'Internal Server Error Occured, Please try again later...');
        }
        // return redirect()->route('cms.manage_service');
        $serviceCMS->refresh();
        return view('Admins.static_management.manage_services_info', [
            'data' => $serviceCMS,
        ]);
    }


    public function pageRevert(Request $request,$id)
	{
        try{
            $revertPageData =  ServiceCMSVersion::where('id',$id)->first();
            $oldPage = ServiceCMS::find($revertPageData->cms_id);
            $page = ServiceCMS::find($revertPageData->cms_id);
            $page->intro = $revertPageData->intro;
            $page->intro_ar = $revertPageData->intro_ar;
            $page->concl = $revertPageData->concl;
            $page->concl_ar = $revertPageData->concl_ar;
            $page->banner = $revertPageData->banner;
           if($request->preview){
            $services = StaticContent::where('status', '1')->where('parent_id', 4)
                    ->orderBy('id', 'asc')
                    ->get();
                                
                    
                $html =  view('website.our_services', ['data' => $page, 'services' => $services])->render();
                 return redirect()->back()->with("preview_page",$html)->withInput();
                }else{ 
               if($page->isDirty()){
                if($page->save())
                {
                    $tempPageData= $oldPage->toArray();
                    $tempPageData['cms_id']=$tempPageData['id'];
                    $tempPageData['created_by']=Auth::user()->id;
                    unset($tempPageData['id']);
                    unset($tempPageData['created_at']);
                    $vcData= new ServiceCMSVersion($tempPageData+['reverted'=>1]);
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
        return redirect()->route('cms.manage_service');

    }

    public function history($id)
    {
        try {
            //code...
            $pages = ServiceCMSVersion::where('cms_id',$id)->orderBy('id','DESC');
            $pages = $pages->paginate(10);
            return view('Admins.static_management.our_service_history',compact('pages'))->with('i',1);
        } catch (Exception $ex) {
            Log::error($ex);
            Session::flash('error', 'internal server error');
            return redirect()->route('cms.manage_service');
        }
        
    }
}
