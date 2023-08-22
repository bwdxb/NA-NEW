<?php

namespace App\Http\Controllers\EmployeePortal;
use App\Http\Controllers\Traits\MailTrait;
use App\Http\Controllers\Controller;
use App\MarketItemImages;
use App\MarketPlace;
use App\User;
use App\Notification;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;
use Log;
use Mail;
use Image;
use File;

class MarketPlaceController extends Controller
{
    use MailTrait;
    /*
     * todo (Employee Middleware): authenticate loggedin user trying to access the MarketPlace features are of type/role Employee
     * */

     public function adminFetch()
     {
         try {
             //code...
             $data=MarketPlace::all();
             return view('employee_portal.admin_market_place_list',['data'=>$data]);
         } catch (\Exception $th) {
             //throw $th;
             Log::error($th);
         }
     }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'category' => 'sometimes',
            'price' => 'required',
            'address' => 'required',
            'description' => 'sometimes',
            'photos.*' => 'sometimes|mimes:jpg,jpeg,png,bmp|max:20000',
            'cover_img' => 'required_if:photos,.*',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)
            ->withInput();
        }

        $newMarketData = MarketPlace::create($request->all()+['created_by' => Auth::id()]);

        if (!$newMarketData) {
            Session::flash('error', 'Product has not added to market place successfully');
            return redirect()->back()->withInput();
        }



        if (!empty($request->file('photos'))) {
            $itemPhotos = $request->file('photos');
            $itemPhotoArr = [];

            foreach ($itemPhotos as $itemPhoto) {
                $itemPhotoName = time() . '.' . $itemPhoto->getClientOriginalExtension();
                $media_type = explode('/', $itemPhoto->getMimeType())[0];

                if($media_type=='image'){
                    $img = Image::make($itemPhoto->path());
                    // $img = $img->encode('webp', 75);  // 75 is image quality and its value can be 1 to 100
                    $img->resize(500, 500, function ($constraint) { $constraint->aspectRatio(); }); // compression with aspectratio
                    // public/uploads/market_place/' . $request->title 
                   $path='public/uploads/market_place/' . $request->title;
                    if(!File::exists($path)) {
                        // path does not exist
                        File::makeDirectory($path, 0777, true, true);
                    }
                    $itemPhotoUrl='public/uploads/market_place/' . $request->title . '/'. $itemPhotoName;
                    $img->save($itemPhotoUrl, 75);
                }else{
                    $itemPhoto->move(public_path('uploads/market_place/' . $request->title), $itemPhotoName);
                    $itemPhotoUrl = '/public/uploads/market_place/' . $request->title . '/' . $itemPhotoName;
                }
                $flag = (trim($request->cover_img) == trim($itemPhoto->getClientOriginalName())) ? 1 : 0;
                // dd([
                //     'request->all'=>$request->all(),
                //     'request->cover_img'=>$request->cover_img,
                //     'itemPhoto'=>$itemPhoto,
                //     'itemPhoto'=>[
                //         'item name'=>$itemPhoto->getClientOriginalName(),
                //         'item ext'=>$itemPhoto->getClientOriginalExtension(),
                //     ]
                // ]);

                $marketItemImage = MarketItemImages::create([
                    'market_item_id' => $newMarketData->id,
                    'employee_id' => 1,
                    'file_url' => $itemPhotoUrl,
                    'cover_status' => $flag,
                ]);

                if (!$marketItemImage) {
                    MarketItemImages::destroy($itemPhotoArr);
                    $newMarketData->delete();
                    Session::flash('error', 'Product has not added to market place');
                    return redirect()->back()->withInput();
                }
                $itemPhotoArr[] = $marketItemImage->id;
                if ($marketItemImage->cover_status === 1) {
                    $newMarketData->refresh();
                    $newMarketData->update([
                        'photo' => $marketItemImage->id
                    ]);
                    $newMarketData->refresh();
                }
            }
        }
        Session::flash('title_msg', 'Thank You.');
        Session::flash('success', 'Your product has been submitted for review and approval. We will get in touch with you if further information is required.');
        // return view('employee_portal.market_place');
        return redirect('/employee-portal/market-place/');

    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'title' => 'sometimes',
            'email' => 'sometimes|email',
            'phone' => 'sometimes',
            'category' => 'sometimes',
            'price' => 'sometimes',
            'address' => 'sometimes',
            'description' => 'sometimes',
            'photos.*' => 'sometimes|mimes:jpg,jpeg,png,bmp|max:20000',
        //            'photo_ids' => 'required',
            'cover_img' => 'sometimes',
            'deleteimage' => 'sometimes',
        //            'cover_img_type' => 'required|in:new,old',
        ]);
        if ($validator->fails()) {
            Session::flash('error', 'Failed to update the product to the market place');
            return redirect()->back()->withErrors($validator)
            ->withInput();
        }

        $marketPlace = MarketPlace::find($request->id);
        if (!$marketPlace) {
            Session::flash('error', 'Failed to update the product to the market place');
            return redirect()->back()->withInput();
        }

        // $itemCoverImageBakk = $marketPlace->itemCoverImage();
        // if ($marketPlace->itemCoverImage()) {
        //     $marketPlace->itemCoverImage()->update([
        //         'cover_status' => 0
        //     ]);
        // }
        if (!empty($request->deleteimage)) {
            foreach($request->deleteimage as $val) {
                $image = MarketItemImages::find($val);
                $public_path = str_replace('\public', '',public_path());
                //unlink($public_path.$image->file_url);
                $delete = $image->delete();
            }
        }
        

        foreach ($marketPlace->itemImages() as $itemPhoto) {
        //            $itemPhotoName = rand(1000, 9999) . '.' . $itemPhoto->getClientOriginalExtension();
        //            $itemPhoto->move(public_path('uploads/market_place' . $request->title), $itemPhotoName);
        //            $itemPhotoUrl = '/public/uploads/market_place/' . $request->title . '/' . $itemPhotoName;

            $flag = 0;
            if ($request->cover_img && isset($request->cover_img) && is_numeric($request->cover_img)) {
                // dd('gotcha');
                $flag = (trim($request->cover_img) == trim($itemPhoto->id)) ? 1 : 0;
            }

            $itemPhoto->update([
                'cover_status' => $flag,
            ]);

            $itemPhoto->refresh();

            if ($itemPhoto->cover_status === 1) {
                $marketPlace->update([
                    'photo' => $itemPhoto->id
                ]);
                $marketPlace->refresh();
                break;
            }
        }

        if (!empty($request->file('photos'))) {

            $itemPhotos = $request->file('photos');
            $itemPhotoArr = [];

            foreach ($itemPhotos as $itemPhoto) {
                $itemPhotoName = rand(1000, 9999) . '.' . $itemPhoto->getClientOriginalExtension();
               
                $media_type = explode('/', $itemPhoto->getMimeType())[0];

                if($media_type=='image'){
                    $img = Image::make($itemPhoto->path());
                    // $img = $img->encode('webp', 75);  // 75 is image quality and its value can be 1 to 100
                    $img->resize(500, 500, function ($constraint) { $constraint->aspectRatio(); }); // compression with aspectratio
                    $path='public/uploads/market_place/' . $request->title;
                    if(!File::exists($path)) {
                        // path does not exist
                        File::makeDirectory($path, 0777, true, true);
                    }
                    $itemPhotoUrl='public/uploads/market_place/' . $request->title . '/'. $itemPhotoName;
                    $img->save($itemPhotoUrl, 75);
                }else{ 
                    $itemPhoto->move(public_path('uploads/market_place/' . $request->title), $itemPhotoName);
                    $itemPhotoUrl = '/public/uploads/market_place/' . $request->title . '/' . $itemPhotoName;
                }
                $flag = 0;
                // dd(is_numeric($request->cover_img));
                if ($request->cover_img &&
                    isset($request->cover_img) &&
                    is_numeric($request->cover_img) == false
        //                    && $marketPlace->itemCoverImage() == null
                ) {
                    // dd('gotcha');
                    $flag = (trim($request->cover_img) == trim($itemPhoto->getClientOriginalName())) ? 1 : 0;
                }

                $marketItemImage = MarketItemImages::create([
                    'market_item_id' => $marketPlace->id,
                    'employee_id' => 1,
                    'file_url' => $itemPhotoUrl,
                    'cover_status' => $flag,
                ]);

                if (!$marketItemImage) {
                    MarketItemImages::destroy($itemPhotoArr);
                    Session::flash('error', 'Failed to update the product to the market place');
                    return redirect()->back()->withInput();
                }
                $itemPhotoArr[] = $marketItemImage->id;
                if ($marketItemImage->cover_status === 1) {
                    $marketPlace->update([
                        'photo' => $marketItemImage->id
                    ]);
                }
            }
        }

        // $marketPlace->refresh();
        // if (!$marketPlace->itemCoverImage()) {
        //     if ($itemCoverImageBakk) {
        //         $itemCoverImageBakk->refresh();
        //         $itemCoverImageBakk->update([
        //             'cover_status' => 1,
        //         ]);
        //     }
            

        //     $marketPlace->update([
        //         'photo' => $itemCoverImageBakk->id
        //     ]);
        // }
        // $marketPlace->refresh();


        // if ($marketPlace->itemCoverImage()->id) {
        //     $marketPlace->itemCoverImage()->update([
        //         'status' => 0
        //     ]);
        // }

        $request['status']="PENDING";
        $update = $marketPlace->update($request->all());

        if ($update) {
            Session::flash('title_msg', 'Thank You.');

            Session::flash('success', 'Your product has been submitted for review and approval. We will get in touch with you if further information is required.');
            // return view('employee_portal.market_place');
            return redirect('/employee-portal/market-place/');

        } else {
            Session::flash('error', 'Failed to update the product to the market place');
            return redirect()->back()->withInput();
        }
    }

    public function adminDelete($id)
    {
        if (!$id) {
            Session::flash('error', 'Failed to delete market place product ');
            return redirect('/employee-portal/market-place/admin/list');
        }

        $marketPlace = MarketPlace::find($id);
        if (!$marketPlace) {
            Session::flash('error', 'Failed to delete market place product');
            return redirect('/employee-portal/market-place/admin/list');
        }

        $delete = $marketPlace->delete();

        if (!$delete) {
            Session::flash('error', 'Failed to delete market place product');
            return redirect('/employee-portal/market-place/admin/list');
        }

        Session::flash('success', 'Successfully deleted market place product');
        return redirect('/employee-portal/market-place/admin/list');

    }
    public function delete($id, $title = ' ')
    {
        if (!$id) {
            Session::flash('error', 'Failed to delete ' . $title);
            return redirect('/employee-portal/market-place');
        }

        $marketPlace = MarketPlace::find($id);
        if (!$marketPlace) {
            Session::flash('error', 'Failed to delete ' . $title);
            return redirect('/employee-portal/market-place');
        }

        $delete = $marketPlace->delete();

        if (!$delete) {
            Session::flash('error', 'Failed to delete ' . $title);
            return redirect('/employee-portal/market-place');
        }

        Session::flash('success', 'Successfully deleted ' . $title);
        return redirect('/employee-portal/market-place');

    }

    public function adminChangeStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'status' => 'required',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)
            ->withInput();
        }

        $marketPlace = MarketPlace::find($request->id);
        if (!$marketPlace) {
            return redirect()->back()->withInput();
        }
        $data = $request->all();
        $data['status'] = $request->status == 'ACCEPT' ? 'ACCEPT' : 'REJECT';

        $update = $marketPlace->update($data);

        if ($update) {
            $createdUser = User::find($marketPlace->created_by);
            if($request->status == 'ACCEPT'){
                $notificationData = new Notification();
                $notificationData->title="Market Place";
                $notificationData->type="marketplace";
                $notificationData->created_by=Auth::id();
                $notificationData->seen_by=$marketPlace->created_by.",";
                $notificationData->description="New product was added to the Market Place by ".($createdUser->first_name." ".$createdUser->last_name);
                $notificationData->url='/employee-portal/market-place';
                $notificationData->save();

                /** for accepted alert to posted user */
                $notificationForStory = new Notification();
                $notificationForStory->title="Market place product approved";
                $notificationForStory->type="marketplace";
                $notificationForStory->created_by=Auth::id();
                $notificationForStory->send_to=$marketPlace->created_by.",";
                // Hi Username, your (Name of product) ad has been approved and posted!
                $notificationForStory->description="Hi ".($createdUser->first_name." ".$createdUser->last_name).", your ".$marketPlace->title." ad has been approved and posted!";
                $notificationForStory->url='/employee-portal/market-place';
                $notificationForStory->save();
            }else{
                /** for accepted alert to posted user */
                $notificationForStory = new Notification();
                $notificationForStory->title="Market place product rejected";
                $notificationForStory->type="marketplace";
                $notificationForStory->created_by=Auth::id();
                $notificationForStory->send_to=$marketPlace->created_by.",";
                $notificationForStory->description="Hi ".($createdUser->first_name." ".$createdUser->last_name).". your product in marketplace (".$marketPlace->title.") has been rejected. ";
                $notificationForStory->url='/employee-portal/market-place';
                $notificationForStory->save();
            }
            Session::flash('success', 'Successfully updated the status of product');
            $data = MarketPlace::orderBy('created_at', 'desc')->where('status', 'PENDING')->get();
            return view('employee_portal.admin_market_place')->with(compact('data'));

        } else {
            Session::flash('error', 'Failed to update the product status');
            return redirect()->back()->withInput();
        }
    }

    public function fetch($id, $title = ' ')
    {
        if (!$id) {
            Session::flash('error', 'Failed to fetch ' . $title . 'details');
            return redirect()->back();
        }

        $data = MarketPlace::find($id);
        if (!$data) {
            Session::flash('error', 'Failed to fetch ' . $title . 'details');
            return redirect()->back();
        }

        $data->photos = $data->itemImages();
        // dd($data->photos);

        // Session::flash('success', 'Successfully fetched ' . $title . 'details');
        return view('employee_portal.market_place', ['details' => $data]);

    }
    public function showInterest($id)
    {
        $mData = MarketPlace::find($id);
        // dd($mData);
        try {
            if (!$mData) {
                Session::flash('error', 'Failed to fetch marketplace data');
                return redirect()->back();
            }
            $users= explode(',',$mData->interested_users);
            if(in_array(Auth::id(), $users)){
                
                Session::flash('title_msg',"Thank You");
                Session::flash('success',"Your message has been sent. You can either wait for the seller to get in touch with you or contact them directly via email or phone.");
        

            }else{
                $mData->interested_users=$mData->interested_users.Auth::id().",";
                $mData->save();
                // dd($mData);
                $mail_status = $this->marketplace(User::find($mData->created_by),Auth::user(),$mData->title);
                $createdUser = User::find($mData->created_by);

                /** for inrested alert to posted user */
                $notificationForStory = new Notification();
                $notificationForStory->title="Intrest Recieved";
                $notificationForStory->type="marketplace";
                $notificationForStory->created_by=Auth::id();
                $notificationForStory->send_to=$mData->created_by.",";
                // Hi Username, (username xx) is interested in your (name of product).
                $notificationForStory->description="Hi ".($createdUser->first_name." ".$createdUser->last_name).", ".Auth::user()->first_name." ".Auth::user()->last_name." is interested in your ".$marketPlace->title;
                $notificationForStory->url='/employee-portal/market-place';
                $notificationForStory->save();


                    Session::flash('title_msg',"Thank You");
                    Session::flash('success',"Your message has been sent. You can either wait for the seller to get in touch with you or contact them directly via email or phone.");
            
            }
       } catch (\Exception $th) {
            //throw $th;
            Log::error($th);
            Session::flash('error', 'internal server error');

        }
        
   return redirect('/employee-portal/market-place/');   

    }

}