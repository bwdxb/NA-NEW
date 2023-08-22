<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use DB;
use App\Role;
use App\Courses;
use App\Config;
use Session;
use Auth; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Butschster\Head\MetaTags\MetaInterface;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;
use App\Http\Controllers\Traits\MailTrait;
use App\Http\Controllers\Traits\RequestManageEngineTrait;
use App\Http\Controllers\Traits\SmsTrait;
use App\Http\Controllers\Traits\UtilTrait;
use Log;
use Exception;
class CoursesController extends Controller
{
   
    use RequestManageEngineTrait;
    use MailTrait;
    use SmsTrait;
    use UtilTrait;
    public function __construct() 
    { 
    $this->middleware('preventBackHistory');
    }

    public function index(Request $request)
    {   
        $courses = Courses::query();
        $config= Config::where('type',"COURSE_STATUS_BUTTON")->first();
        if ($request->search_key) {
            $courses = $courses->where('title', 'LIKE', trim($request->search_key).'%');
        }
        if ($request->category) {
            $courses = $courses->where('category', $request->category);
        }
        switch ($request->sort) {
            case 'Newest':
                $courses = $courses->latest();
                break;
            case 'Oldest':
                $courses = $courses->oldest();
                break;
            default:
                $courses = $courses->latest();
        }
        
        $courses = $courses->paginate(10);
        // dd($courses);
        return view('Admins.course_management.index',compact('courses'))->with('config',$config)->with('i', 1);
    }

    public function create()
    {
        return view('Admins.course_management.create');
    
    }

    public function store(Request $request)
    {

        $course = new Courses();
        $course->bi_lang = ($request->bi_lang)?1:0;
        $course->category = $request->category;
        $course->category_ar = $request->category_ar;
        $course->title = $request->title;
        $course->title_ar = $request->title_ar;
        $course->location = $request->location;
        $course->location_ar = $request->location_ar;
        $course->certification = $request->certification;
        $course->certification_ar = $request->certification_ar;
        $course->who_should_take_course = $request->who_should_take_course;
        $course->who_should_take_course_ar = $request->who_should_take_course_ar;
        $course->note = $request->note;
        $course->note_ar = $request->note_ar;
        $course->description = $request->description;
        $course->description_ar = $request->description_ar;
        $course->type = $request->type;
        $course->type_ar = $request->type_ar;
        $course->start_date = $request->start_date;
        $course->end_date = $request->end_date;
        $course->closing_date = $request->closing_date;
        $course->fee_type = $request->fee_type;
        $course->course_fee = $request->course_fee;
        $course->link = $request->link;
        $course->status = 1;
        switch($course->category){
            case 'National Association of Emergency Medical Technicians (NAEMT)':
                $course->logo="/public/Image/NAEMT.png";
                break;
            case 'American Heart Association (AHA)':
                $course->logo="/public/Image/AHA.png";
                break;
            case 'American Health and Safety Institute (ASHI)':
                $course->logo="/public/Image/ASHI.png";
                break;
            case 'Emergency Medical Services (EMS)':
                $course->logo="/public/website/images/company-logo.svg";
                break;
            case 'Community Outreach Programmes (CSR)':
                $course->logo="/public/website/images/company-logo.svg";
                break;
            default:
                $course->logo="/public/website/images/company-logo.svg";
                break;

        }
        // if($request->hasFile('logo'))
		// {
        //     $image=$request->file('logo');
        //     $new_name = rand(1000,99999)."-".$image->getClientOriginalName();
        //     $image->move(public_path('uploads/course'),$new_name);
        //     $course->logo = $new_name;
        // }  
		$course->created_by =Auth::user()->id;
		 
        if($course->save())
		{
        
			 Session::flash('message', 'Course has been added successfully');
			 return redirect()->route('course.index'); 
		}
		else
		{
			Session::flash('error', 'Course not added successfully');
			return redirect()->route('course.index'); 
		} 
    }

   
    public function edit($id)
    {
         $course = Courses::find($id);
         return view('Admins.course_management.edit',compact('course'));
    }
    public function duplicate($id)
    {
         $course = Courses::find($id);
         return view('Admins.course_management.duplicate',compact('course'));
    }

    public function update(Request $request, $id)
    {
	
        $course = Courses::where('id',$id)->first();
        $course->bi_lang = ($request->bi_lang)?1:0;
        $course->category = $request->category;
        $course->category_ar = $request->category_ar;
        $course->title = $request->title;
        $course->title_ar = $request->title_ar;
        $course->location = $request->location;
        $course->location_ar = $request->location_ar;
        $course->certification = $request->certification;
        $course->certification_ar = $request->certification_ar;
        $course->who_should_take_course = $request->who_should_take_course;
        $course->who_should_take_course_ar = $request->who_should_take_course_ar;
        $course->note = $request->note;
        $course->note_ar = $request->note_ar;
        $course->description = $request->description;
        $course->description_ar = $request->description_ar;
        $course->type = $request->type;
        $course->type_ar = $request->type_ar;
        $course->start_date = $request->start_date;
        $course->end_date = $request->end_date;
        $course->closing_date = $request->closing_date;
        $course->course_fee = $request->course_fee;
        $course->fee_type = $request->fee_type;
        $course->link = $request->link;
        
        switch($course->category){
            case 'National Association of Emergency Medical Technicians (NAEMT)':
                $course->logo="/public/Image/NAEMT.png";
                break;
            case 'American Heart Association (AHA)':
                $course->logo="/public/Image/AHA.png";
                break;
            case 'American Health and Safety Institute (ASHI)':
                $course->logo="/public/Image/ASHI.png";
                break;
            case 'Emergency Medical Services (EMS)':
                $course->logo="/public/website/images/company-logo.svg";
                break;
            case 'Community Outreach Programmes (CSR)':
                $course->logo="/public/website/images/company-logo.svg";
                break;
            default:
                $course->logo="/public/website/images/company-logo.svg";
                break;

        }
        // if($request->hasFile('logo'))
		// {
        //     $image=$request->file('logo');
        //     $new_name = rand(1000,99999)."-".$image->getClientOriginalName();
        //     $image->move(public_path('uploads/course'),$new_name);
        //     $course->logo = $new_name;
        // }  
		$course->updated_by = Auth::user()->id;
		    
        if($course->save())
		{
        
			 Session::flash('message', 'Course has been updated successfully');
			 return redirect()->route('course.index');
		}
		else
		{
			Session::flash('error', 'Course not updated successfully');
			return redirect()->route('course.index');
		}
    }
	
	public function status($id)
    {
        $course = Courses::where('id', $id)->first();

        if ($course->status == 1)
        {
            $course->status = 0; //0 for Block
            $course->save();

        }
        else 
		{
			$course->status = 1; //1 for Unblock
			$course->save();
		}

        if ($course->status == 1)
        {
            return 1;
        }
        else
        {
            return 2;
        }
    }
	public function courseStatus($id)
    {
        $course = Courses::where('id', $id)->first();

        if ($course->course_status == 1)
        {
            $course->course_status = 0; //0 for Block
            $course->save();

        }
        else 
		{
			$course->course_status = 1; //1 for Unblock
			$course->save();
		}

        if ($course->course_status == 1)
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
        $course = Courses::find($id);
        $course->delete();
        return redirect()->route('course.index');
       
    }


    public function listing(Request $request)
    {   
        $courses = Courses::where('status',1)->whereDate('closing_date','>=',Carbon::now()->format('Y-m-d'));
        if ($request->search_key) {
            $courses = $courses->where('title', 'LIKE', trim($request->search_key).'%');
        }
        if ($request->category) {
            $courses = $courses->where('category', $request->category);
        }
        switch ($request->sort) {
            case 'Newest':
                $courses = $courses->latest();
                break;
            case 'Oldest':
                $courses = $courses->oldest();
                break;
            default:
                $courses = $courses->latest();
        }
        
        $courses = $courses->paginate(10);
        // dd($courses);
        return view('website.courses.courses',compact('courses'));
    }

    public function detail($id)
    {   

        $course = Courses::find($id);
        if($course->course_status){
            Session::flash("error", __("Sorry, Seats are all filled !"));
            return redirect()->route('courses.list');
        }
        if (!$course) {
            // Session::flash('error', 'Failed to retrieve job course');

            return redirect()->back();
        }else{
            $title= $course->title;
            $image= url($course->logo);
            $description=$course->description;

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
            Meta::registerPackage($card);
            Meta::prependTitle($title);

        }
        return view('website.courses.course_detail',compact('course'));
    }

    public function applyFormView($id)
    {   
        $course = Courses::find($id);
         if($course->course_status){
        Session::flash("error", __("Sorry, Seats are all filled !"));
        return redirect()->route('courses.list');
    }
        return view('website.courses.course_apply_form',compact('course'));
    }

    public function apply(Request $request,$id)
    {   
     try {
        $course = Courses::find($id);
         //code...
         if($course->course_status){
            Session::flash("error", __("Sorry, Seats are all filled !"));
            return redirect()->route('courses.list');
        }

         $now = Carbon::now();
         $unique_timestamp = $now->format('YmdHisu');
       
         $validator = Validator::make($request->all(),[
                 'title' => 'required',
                 'name' => 'required',
                 'email' => 'required|email',
                 'phone_number' => 'required',
                //  'message' => 'required',
                 'agreement' => 'required',
                 'g-recaptcha-response' => 'required'                 
             ]);

             if($validator->fails()){
                //  dd($validator);
                 Session::flash('error', __('Validation failed'));
                 return redirect()->back()->withErrors($validator)
                 ->withInput();
             }
     
             if (!$this->validateGCaptcha($request['g-recaptcha-response'])) {
                 request()->validate(['g-recaptcha' => 'Invalid captcha code.']);
             }
             $today = Carbon::now()->format('Ymd');
             $course->applied_count=$course->applied_count+1;
             $format_index = sprintf('%02d', ($course->applied_count));
             $data = ['reference_no'=>'WNA-ED-'.$today.'-'.$course->id.'-'.$format_index,'course'=>$course->title,"course_category"=>$course->category]+$request->all();
             // $data['reference_no'] = 'WNA-ED-'.$today.'-'.$format_index;
             
             unset($data['_token']);
             unset($data['agreement']);
             unset($data['g-recaptcha-response']);

             $this->course_apply_mail($data);

             $data['name']=$data['title']." ".$data['name'];
             $this->courseApplyRequestManageEngine($data);
            //   dd($data);
            Session::flash('success', __('We will contact you soon to confirm your booking'));
            Session::flash('title_msg', __('Thank you for your booking request'));
            $course->save();
         return redirect()->route('course.apply.form',$id);
     } catch (Exception $th) {
         Log::error($th);
        Session::flash('error', __('internal server error'));
        return redirect()->route('course.apply.form',$id);
     }
    }
}
