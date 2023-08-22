<?php

namespace App\Http\Controllers;

use App\Testimonials;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Mail;
use Session;


class TestimonialController extends Controller
{
    public function search($search = '')
    {
        $testimonials = Testimonials::query();
        if ($search != '') {
            $testimonials = $testimonials->where('client_name', 'LIKE', "%$search%")
            ->orWhere('title', 'LIKE', "%$search%")
            ->orWhere('testimonial', 'LIKE', "%$search%");
        }
        
        $testimonials = $testimonials->paginate(10);
        // Session::flash('success', 'Fetched Testimonial records');
        return view('Admins.testimony_management.index', ['data' => $testimonials]);
    }

    public function filter(Request $request)
    {
        
        return redirect()->route('manage_testimonial.search', ['search' => ($request->filter)?$request->filter:'']);
    }

//    public function create()
//    {
//        $allRoles = Role::where('IsActive', 1)->orderBy('id')->pluck('role_name', 'id');
//        return view('Admins.user_management.create', compact('allRoles'));
//    }

    public function createOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'sometimes',
            'category' => 'sometimes|required_without:id',
            'client_name' => 'sometimes|required_without:id',
            'client_name_ar' => 'sometimes|required_without:id',
            'title' => 'sometimes|required_without:id',
            'title_ar' => 'sometimes|required_without:id',
            'testimonial' => 'sometimes|required_without:id',
            'testimonial_ar' => 'sometimes|required_without:id',
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Failed to add Testimonial');
            return redirect()->back()->withErrors($validator)
            ->withInput();
        }


        if (!isset($request->id) && !$request->id) {
            $testimonials = Testimonials::create($request->all());

            if (!$testimonials) {
                Session::flash('error', 'failed to add Testimonial');
                return redirect()->route('manage_testimonial.search', ['search' => '']);
            }
            // dd([
            //     'testimonials'=>$testimonials,
            //     'request'=>$request->all(),
            // ]);
            $testimonials->slug = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $testimonials->title));
            if($request->preview){
				$data =Testimonials::get();
                
                $isEdit= false;
                $html = view('website.testimonials_preview',compact('testimonials','data','isEdit'))->render();
                return redirect()->back()->with("preview_page",$html)->withInput();
                }else{
                    $testimonials->save();
                    Session::flash('success', 'successfully added Testimonial');
                    return redirect()->route('manage_testimonial.search', ['search' => '']);
                }
            } else {
                $testimonials = Testimonials::find($request->id);
                if (!$testimonials) {
                    Session::flash('error', 'failed to update Testimonial');
                    return redirect()->route('manage_testimonial.search', ['search' => '']);
                }
                if($request->preview){
                    
                    $data =Testimonials::get();
                    
                    $testimonials = new Testimonials($request->all());
                        $isEdit= true;
                        return view('website.testimonials_preview',compact('testimonials','data','isEdit'));
                    // $html = view('website.testimonials_preview',compact('testimonials','data','isEdit'))->render();
                    // return redirect()->back()->with("preview_page",$html)->withInput();
                    }else{
                $update = $testimonials->update($request->all());

                if (!$update) {
                    Session::flash('error', 'failed to update Testimonial');
                    return redirect()->route('manage_testimonial.search', ['search' => '']);
                }

                Session::flash('success', 'successfully updated Testimonial');
                return redirect()->route('manage_testimonial.search', ['search' => '']);
            }
        }
    }

    public function edit($id)
    {
        if (!$id) {
            Session::flash('error', 'failed to update Testimonial');
            return redirect()->route('manage_testimonial.search', ['search' => '']);
        }

        $testimonials = Testimonials::find($id);

        if (!$testimonials) {
            Session::flash('error', 'failed to update Testimonial');
            return redirect()->route('manage_testimonial.search', ['search' => '']);
        }

        $data = Testimonials::orderBy('created_at', 'desc')->paginate(8);
        return view('Admins.testimony_management.index', [
            'update' => $testimonials,
            'data' => $data,
        ]);
    }

//    public function update(Request $request, $id)
//    {
//        $user = AdminUser::where('id', $id)->first();
//        //$user->role_id = $request->role_id;
//        $user->user_name = $request->user_name;
//        $user->first_name = $request->first_name;
//        $user->last_name = $request->last_name;
//        $user->mobile = $request->mobile;
//
//        if ($user->save()) {
//
//            Session::flash('message', 'User has been updated successfully');
//            return redirect('/user');
//        } else {
//            Session::flash('error', 'User has been updated successfully');
//            return redirect('/user');
//        }
//
//    }

    public function delete($id)
    {
        if (!$id) {
            Session::flash('error', 'failed to delete Testimonial');
            return redirect()->route('manage_testimonial.search', ['search' => '']);
        }

        $testimonials = Testimonials::find($id);

        if (!$testimonials) {
            Session::flash('error', 'failed to delete Testimonial');
            return redirect()->route('manage_testimonial.search', ['search' => '']);
        }

        $update = $testimonials->delete();

        if (!$update) {
            Session::flash('error', 'failed to delete Testimonial');
            return redirect()->route('manage_testimonial.search', ['search' => '']);
        }

        Session::flash('success', 'successfully deleted Testimonial');
        return redirect()->route('manage_testimonial.search', ['search' => '']);
    }

    public function status($id)
    {

        if (!$id) {
            Session::flash('error', 'failed to update status of Testimonial');
            return redirect()->route('manage_testimonial.search', ['search' => '']);
        }
        $testimonials = Testimonials::find($id);

        if (!$testimonials) {
            Session::flash('error', 'failed to update status of Testimonial');
            return redirect()->route('manage_testimonial.search', ['search' => '']);
        }

        $update = $testimonials->update([
            'status' => ($testimonials->status == 'active') ? 'inactive' : 'active',
        ]);
        if (!$update) {
            Session::flash('error', 'failed to update status of Testimonial');
            return redirect()->route('manage_testimonial.search', ['search' => '']);
        }

        Session::flash('success', 'successfully updated status of Testimonial');
        return redirect()->route('manage_testimonial.search', ['search' => '']);

    }
}