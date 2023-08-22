<?php

namespace App\Http\Controllers\CareerPortal;

use App\Feedback;
use App\Http\Controllers\Controller;
use App\Config;
use App\ServiceCMS;
use App\StaticContent;
use Illuminate\Http\Request;
use App\ServiceCMSVersion;
use Session;
use Auth;

class CareerController extends Controller
{
    public function adminCMSManageCareerInfo()
    {
        try {
            $feedback = ServiceCMS::find(3);

            // Session::flash('success', 'Career CMS Components loaded successfully');

            return view('Admins.static_management.manage_career_info', [
                'data' => $feedback,
            ]);
        } catch (\Exception $ex) {
            // dd([
            //     'exception message'=>$ex->getMessage(),
            //     // 'exception in'=>$ex->getFile(),
            //     'exception line no.'=>$ex->getLine(),
            //     // 'exception trace'=>$ex->getTrace(),
            // ]);
            Session::flash('error', 'Internal Server Error Occured, Please try again later...');
            // return back()->with('error', 'Internal Server Error Occured, Please try again later...');
            return back();
        }
    }

    public function adminUpdateCMSManageCareerInfo(Request $request)
    {
        //        dd($request->all());
        try {
            $oldPage = ServiceCMS::find(3);
            $serviceCMS = ServiceCMS::find(3);

            $serviceCMS->intro = $request->intro;
            $serviceCMS->intro_ar = $request->intro_ar;
            $serviceCMS->concl = $request->concl;
            $serviceCMS->concl_ar = $request->concl_ar;
            if ($request->hasFile('video')) {
                $image = $request->file('video');
                $new_name = rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/career'), $new_name);
                // $logoUrl=$this->s3Upload('uploads/career_vacancy',$new_name,$image);
                $serviceCMS->banner = '/public/uploads/career/' + $new_name;
                // $serviceCMS->banner = $logoUrl;
            }
            if ($request->preview) {
                $html = view('career_portal.careers', ['data' => $serviceCMS])->render();
                return redirect()->back()->with("preview_page", $html)->withInput();
            } else {
                if ($serviceCMS->isDirty()) {
                    if ($serviceCMS->save()) {
                        $tempPageData= $oldPage->toArray();
                    $tempPageData['cms_id']=$tempPageData['id'];
                    $tempPageData['created_by']=Auth::user()->id;
                    unset($tempPageData['id']);
                    unset($tempPageData['created_at']);
                    // dd($tempPageData);
                    $vcData= new ServiceCMSVersion($tempPageData);
                    $vcData->save();
                        Session::flash('success', 'Career Info has been updated successfully');
                    } else {
                        Session::flash('error', 'Failed to update new Career Info');
                    }
                } else {
                    $serviceCMS->refresh();
                    return view('Admins.static_management.manage_career_info.blade', [
                        'data' => $serviceCMS,
                    ]);
                }
            }
        } catch (\Exception $ex) {
            // dd($ex);
            Session::flash('error', 'Internal Server Error Occured, Please try again later...');
            // return back()->with('error', 'Internal Server Error Occured, Please try again later...');
            // return back();
        }
        // return redirect()->route('cms.manage_career');
        $serviceCMS->refresh();

        return view('Admins.static_management.manage_career_info', [
            'data' => $serviceCMS,
        ]);
    }

    public function index()
    {
        $data = ServiceCMS::find(3);
        //        $page = StaticContent::where('slug', 'feedback')->first();
        //        return view('website.feedback', compact('page'));
        return view('career_portal.careers', [
            'data' => $data,
            //            'page' => $page,
        ]);
    }
    public function pageRevert(Request $request, $id)
    {
        try {
            $revertPageData =  ServiceCMSVersion::where('id', $id)->first();
            $oldPage = ServiceCMS::find($revertPageData->cms_id);
            $page = ServiceCMS::find($revertPageData->cms_id);
            $page->intro = $revertPageData->intro;
            $page->intro_ar = $revertPageData->intro_ar;
            $page->concl = $revertPageData->concl;
            $page->concl_ar = $revertPageData->concl_ar;
            $page->banner = $revertPageData->banner;
            if ($request->preview) {
                $services = StaticContent::where('status', '1')->where('parent_id', 4)
                    ->orderBy('id', 'asc')
                    ->get();


                $html =  view('website.our_services', ['data' => $page, 'services' => $services])->render();
                return redirect()->back()->with("preview_page", $html)->withInput();
            } else {
                if ($page->isDirty()) {
                    if ($page->save()) {
                        $tempPageData = $oldPage->toArray();
                        $tempPageData['cms_id'] = $tempPageData['id'];
                        $tempPageData['created_by'] = Auth::user()->id;
                        unset($tempPageData['id']);
                        unset($tempPageData['created_at']);
                        $vcData = new ServiceCMSVersion($tempPageData + ['reverted' => 1]);
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
        return redirect()->route('cms.manage_career');
    }

    public function history($id)
    {
        try {
            //code...
            $pages = ServiceCMSVersion::where('cms_id', $id)->orderBy('id', 'DESC');
            $pages = $pages->paginate(10);
            return view('Admins.static_management.our_career_history', compact('pages'))->with('i', 1);
        } catch (Exception $ex) {
            Log::error($ex);
            Session::flash('error', 'internal server error');
            return redirect()->route('cms.manage_career');
        }
    }
}
