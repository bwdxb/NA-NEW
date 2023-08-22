<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\MailTrait;
use App\Http\Controllers\Traits\RequestManageEngineTrait;
use App\Http\Controllers\Traits\SmsTrait;
use App\Http\Controllers\Traits\UtilTrait;
use App\Notification;
use App\ServiceCMS;
use App\ServiceRequest;
use App\StaticContent;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use Butschster\Head\MetaTags\MetaInterface;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;


class OurServiceController extends Controller
{

    use RequestManageEngineTrait;
    use MailTrait;
    use SmsTrait;
    use UtilTrait;
    public function __construct() 
    { 
    $this->middleware('preventBackHistory');
    }

    public function index()
    {

        $data = ServiceCMS::find(1);
        $services = StaticContent::where('status', '1')->where('parent_id', 4)
            ->orderBy('id', 'asc')
            // ->paginate(4);
            ->get();
            if($data){
                $title= "Our Services";
                $image= url('public/uploads/service/'.$data->banner);
                $description= $data->intro;
                $og = new OpenGraphPackage($title);
                $og->addImage($image);
                $og->setTitle($title);
                $og->setDescription(substr(strip_tags($description),0,300).'...');
                $card = new TwitterCardPackage($title);
            $card->setTitle($title);
            $card->setDescription(substr(strip_tags($description),0,300).'...');
            $card->setImage($image);
            $card->setType('summary_large_image');
                Meta::registerPackage($card);
                Meta::registerPackage($og);
                Meta::prependTitle("Our Services");
            }
        //      return view('website.our_services',compact( 'services'));
        return view('website.our_services', [
            'data' => $data,
            'services' => $services,
        ]);
    }

    public function ptsRegistration(Request $request)
    {

      try {
        $now = Carbon::now();

        $tranferTypeArr = [
            'hospital_transfer' => 'Hospital Transfer',
            'appointment_tranfer' => 'Appointment Tranfer',
        ];

        // $yr18 = $now->subYear(18)->format('Y-m-d');

       $validator= Validator::make($request->all(),[
            //  patient details
            'title' => 'required',
            'name' => 'required',
            'dob' => 'required',
            'emirates_id' => 'required',
            'emirates_file' => 'required',
            'medical_report_files.*' => 'required', //multiple files
            // 'medical_report_files.*' => 'required|mimes:jpg,jpeg,png,bmp', //multiple files
            //  transport details
            'tranfer_type' => 'required|in:hospital_transfer,appointment_tranfer',
            'pickup_date' => 'required',    //hospital transfer,appointment tranfer
            'pickup_time' => 'required',    //hospital transfer,appointment tranfer
            'appointment_time' => 'required_if:tranfer_type,==,appointment_tranfer',    //appointment_tranfer
            'receiving_hospital' => 'required_if:tranfer_type,==,hospital_transfer',
            'receiving_hospital_emirates' => 'required_if:tranfer_type,==,hospital_transfer',
            'receiving_city' => 'required_if:tranfer_type,==,hospital_transfer',

            'transferring_hospital' => 'required_if:tranfer_type,==,hospital_transfer',
            'transferring_hospital_emirates' => 'required_if:tranfer_type,==,hospital_transfer',
            'transferring_city' => 'required_if:tranfer_type,==,hospital_transfer',

            'pick_up_address' => 'required_if:tranfer_type,==,appointment_tranfer',
            'city' => 'required_if:tranfer_type,==,appointment_tranfer',
            'emirates' => 'required_if:tranfer_type,==,appointment_tranfer',
           


            'transferring_doctor' => 'required_if:tranfer_type,==,hospital_transfer', //hospital_transfer
            'transferring_doctor_contact_number' => 'required_if:tranfer_type,==,hospital_transfer', //hospital_transfer
            'receiving_doctor' => 'required_if:tranfer_type,==,hospital_transfer',    //hospital_transfer
            'receiving_doctor_contact_number' => 'required_if:tranfer_type,==,hospital_transfer',    //hospital_transfer

            'return_trip_status' => 'required_if:tranfer_type,==,appointment_tranfer',    //appointment_tranfer
            'return_date' => 'required_if:return_trip_status,==,1',    //appointment_tranfer
            'return_time' => 'required_if:return_trip_status,==,1',    //appointment_tranfer
            'appointment_file' => 'required_if:tranfer_type,==,appointment_tranfer', //appointment_tranfer

            'physician_transfer_status' => 'required_if:tranfer_type,==,hospital_transfer', //hospital_transfer
            'admission_file' => 'required_if:physician_transfer_status,==,1', //hospital_transfer

            'transport_accompany_status' => 'required',
            'transport_accompany_relation' => 'required_if:transport_accompany_status,==,1',

            //  primary contact details
            'primary_contact_title' => 'required',
            'primary_contact_name' => 'required',
            'primary_contact_number' => 'required',
            'primary_contact_relation' => 'required',
            'primary_contact_email' => 'required|email',

            'g-recaptcha-response' => 'required',
        ]);
        if($validator->fails()){
            // dd($validator);
            foreach ($validator->messages()->get('*') as $key => $value) {
               
                Session::flash('error', __('Validation failed').": ". $value[0]);
            }

            return redirect()->back()->withErrors($validator)
            ->withInput();
        }

        if (!$this->validateGCaptcha($request['g-recaptcha-response'])) {
            $validator->errors()->add(
                'g-recaptcha-response', 'Invalid captcha code.'
            );
            Session::flash('error',"Invalid captcha");
            return redirect()->back()->withErrors($validator)
            ->withInput();
        }
        $unique_timestamp = $now->format('YmdHisu');
        // start of emirate file upload
        $emirateFileNameArr = [];
        $emirateFileUrlArr = [];
        if (!empty($request->file('emirates_file'))) {
            $emirateFiles = $request->file('emirates_file');
            foreach ($emirateFiles as $key=>$emirateFile) {
                $emirateFilename = $emirateFile->getFilename() . '-' . $unique_timestamp . '.' . $emirateFile->getClientOriginalExtension();
                 $emirateFile->move(public_path('uploads/pts_service'), $emirateFilename);
                //$logoUrl=$this->s3Upload('uploads/pts_service',$emirateFilename,$emirateFile);
                if(in_array($emirateFile->getClientOriginalExtension(),['doc','DOC','docx','DOCX'])){
                     $emirateFileUrl = '<a href=\''.route('download').'?u='.url(('/public/uploads/pts_service/' . $emirateFilename)).'\'>Emirate-File-'.($key+1).'</a>';
                    //$emirateFileUrl = '<a href=\''.route('download').'?u='.$logoUrl.'\'>Emirate-File-'.($key+1).'</a>';
                }else{
                     $emirateFileUrl = '<a href=\''.url(('/public/uploads/pts_service/' . $emirateFilename)).'\'>Emirate-File-'.($key+1).'</a>';
                    //$emirateFileUrl = '<a href=\''.$logoUrl.'\'>Emirate-File-'.($key+1).'</a>';
                }
                $emirateFileNameArr[] = $emirateFilename;
                $emirateFileUrlArr[] = $emirateFileUrl;
            }
        }
        $emirateFileNames = implode(", ", $emirateFileNameArr);
        $emirateFileUrls = implode(", ", $emirateFileUrlArr);
        // end of emirate file uploads

        $medicalReportFileNameArr = [];
        $medicalReportFileUrlArr = [];
        if (!empty($request->file('medical_report_files'))) {
            $medicalReportFiles = $request->file('medical_report_files');
            
            foreach ($medicalReportFiles as $key=>$medicalReportFile) {
                $medicalReportFilename = $medicalReportFile->getFilename() . '-' . $unique_timestamp . '.' . $medicalReportFile->getClientOriginalExtension();
                $medicalReportFile->move(public_path('uploads/pts_service'), $medicalReportFilename);
                //$logoUrl=$this->s3Upload('uploads/pts_service',$medicalReportFilename,$medicalReportFile);

                if(in_array($medicalReportFile->getClientOriginalExtension(),['doc','DOC','docx','DOCX'])){

                    $medicalReportFileUrl = '<a href=\''.route('download').'?u='.url(('/public/uploads/pts_service/' . $medicalReportFilename)).'\'>Medical-report-'.($key+1).'</a>';
                    //$medicalReportFileUrl = '<a href=\''.route('download').'?u='.$logoUrl.'\'>Medical-report-'.($key+1).'</a>';
                }else{

                     $medicalReportFileUrl = '<a href=\''.url(('/public/uploads/pts_service/' . $medicalReportFilename)).'\'>Medical-report-'.($key+1).'</a>';
                    //$medicalReportFileUrl = '<a href=\''.$logoUrl.'\'>Medical-report-'.($key+1).'</a>';
                }
                
                $medicalReportFileNameArr[] = $medicalReportFilename;
                $medicalReportFileUrlArr[] = $medicalReportFileUrl;
            }
            
        }
        $medicalReportFileNames = implode(", ", $medicalReportFileNameArr);
        $medicalReportFileUrls = implode(", ", $medicalReportFileUrlArr);
        
        
        $data = $request->all();
        $primary_contact_number = $request->primary_contact_number; //for sending sms
        unset($data['_token']);
        
       
        
        unset($data['emirates_file']);
        $data['emirates_id_file_url'] = $emirateFileUrls;
        unset($data['medical_report_files']);
        $data['medical_report_file_urls'] = $medicalReportFileUrls;
        
        $data['tranfer_type'] = $tranferTypeArr[$data['tranfer_type']];
        
        $data['receiving_hospital_info'] = $data['receiving_hospital'] . ', ' . $data['receiving_hospital_emirates'] . ', ' . $data['receiving_city'];
        unset($data['receiving_hospital']);
        unset($data['receiving_hospital_emirates']);
        unset($data['receiving_city']);
        
        
        if ($data['transport_accompany_status'] == '1') {
            $data['transport_accompany_status'] = 'Yes, ' . $data['transport_accompany_relation'];
        } else {
            $data['transport_accompany_status'] = 'No';
        }
        unset($data['transport_accompany_relation']);
        
        $appointmentFileUrl = '';
        if ($request->hasFile('appointment_file')) {
            $appointmentFile = $request->file('appointment_file');
            $appointmentFilename = $appointmentFile->getFilename() . '-' . $unique_timestamp . '.' . $appointmentFile->getClientOriginalExtension();
             $appointmentFile->move(public_path('uploads/service'), $appointmentFilename);
            //$logoUrl=$this->s3Upload('uploads/service',$appointmentFilename,$appointmentFile);
            if(in_array($appointmentFile->getClientOriginalExtension(),['doc','DOC','docx','DOCX'])){

                 $appointmentFileUrl ='<a href=\''.route('download').'?u='.url(("/public/uploads/service/".$appointmentFilename)).'\'>appointment-file</a>';
                //$appointmentFileUrl ='<a href=\''.route('download').'?u='.$logoUrl.'\'>appointment-file</a>';
            }else{
    
                $appointmentFileUrl ='<a href=\''.url(("/public/uploads/service/".$appointmentFilename)).'\'>appointment-file</a>';
                //$appointmentFileUrl ='<a href=\''.$logoUrl.'\' >appointment-file</a>';
            }
        }
        unset($data['appointment_file']);
        
        $admissionFileUrl = '';
        if ($request->hasFile('admission_file')) {
            $admissionFile = $request->file('admission_file');
            $admissionFilename = $admissionFile->getFilename() . '-' . $unique_timestamp . '.' . $admissionFile->getClientOriginalExtension();
             $admissionFile->move(public_path('uploads/service'), $admissionFilename);
            //$logoUrl=$this->s3Upload('uploads/service',$admissionFilename,$admissionFile);
            if(in_array($admissionFile->getClientOriginalExtension(),['doc','DOC','docx','DOCX'])){

                $admissionFileUrl = '<a href=\''.route('download').'?u='.url(("/public/uploads/service/". $admissionFilename)).'\'>admission_file</a>';
                //$admissionFileUrl = '<a href=\''.route('download').'?u='.$logoUrl.'\'>admission_file</a>';
            }else{
    
                $admissionFileUrl = '<a href=\''.url(("/public/uploads/service/". $admissionFilename)).'\'>admission_file</a>';
                //$admissionFileUrl = '<a href=\''.$logoUrl.'\' >admission_file</a>';
            }
        }
        unset($data['admission_file']);
        
        
        if ($data['physician_transfer_status'] == '1') {
            $physicianTransferStatus = 'Yes';
        } else {
            $physicianTransferStatus = 'No';
        }
        
        
        switch ($request->tranfer_type) {
            case 'hospital_transfer':

                $data['transferring_hospital_info'] = $data['transferring_hospital'] . ', ' . $data['transferring_hospital_emirates'] . ', ' . $data['transferring_city'];
                $data['transferring_doctor_info'] = $data['transferring_doctor'] . ', PH. ' . $data['transferring_doctor_contact_number'];
                $data['receiving_doctor_info'] = $data['receiving_doctor'] . ', PH. ' . $data['receiving_doctor_contact_number'];
                $data['physician_transfer_status'] = $physicianTransferStatus . ', Admission Letter File Url : ' . $admissionFileUrl;
                // unset($data['appointment_time']);
                break;
                case 'appointment_tranfer':
                    
                    $data['pick_up_location_info'] = $data['pick_up_address'] . ', ' . $data['city'] . ', ' . $data['emirates'];
                    if (isset($data['location_gps'])) {
                        $data['pick_up_info'] = ', GPS Coordinates : ' . $data['location_gps'];
                    }
                    
                    
                    if ($data['return_trip_status'] == '1') {
                        $data['return_time']= Carbon::createFromFormat('H:i', $data['return_time'])->format('g:i:s A');
                        
                        $data['return_trip_status'] = 'Yes';
                        $data['return_trip_info'] = 'Date : ' . $data['return_date'] . ', Time : ' . $data['return_time'];
                    } else {
                        $data['return_trip_status'] = 'Nil';
                    }
                    
                    // $appointmentFile = $request->file('appointment_file');
                    // $appointmentFilename = $request->emirates_id . '-' . $request->name . '-' . $unique_timestamp . '.' . $appointmentFile->getClientOriginalExtension();
                    break;
                }
                
                unset($data['transferring_hospital']);
        unset($data['transferring_hospital_emirates']);
        unset($data['transferring_city']);
        
        unset($data['pick_up_address']);
        unset($data['city']);
        unset($data['emirates']);
        unset($data['location_gps']);
        
        unset($data['transferring_doctor']);
        unset($data['transferring_doctor_contact_number']);
        
        unset($data['receiving_doctor']);
        unset($data['receiving_doctor_contact_number']);
        
        unset($data['return_date']);
        unset($data['return_time']);
        
        unset($data['physician_transfer_status']);
        // unset($data['return_trip_status']);
        
        
        $data['primary_contact_info'] = 'Title : ' . $data['primary_contact_title'] . ', Name : ' . $data['primary_contact_name'] . ', Email : ' . $data['primary_contact_email'] . ', PH. : ' . $data['primary_contact_number'] . ', Relationship : ' . $data['primary_contact_relation'];
        // $this->pts_mail($data);
        
        unset($data['primary_contact_title']);
        unset($data['primary_contact_name']);
        unset($data['primary_contact_number']);
        unset($data['primary_contact_relation']);
        unset($data['primary_contact_email']);
        unset($data['agreement']);
        
        unset($data['g-recaptcha-response']);
        // $data['pickup_time']= Carbon::createFromFormat('H:i', $data['pickup_time'])->format('g:i:s A');
        
        $this->pts_mail($data+['name'=>$request->primary_contact_name,'email'=>$request->primary_contact_email]);
        $data['name'] = $data['title'] . ' ' . $data['name'];
        unset($data['title']);
        $this->ptServiceRequestManageEngine($data);
        $service_request=ServiceRequest::where('service','PTS')->first();
        if($service_request){
            $service_request->request_count= $service_request->request_count+1;
            $service_request->save();}
        // $messenger_status = $this->service_messenger($primary_contact_number, 'Patient Transport Service Request Successfull');
        // dd($request->all());
        // header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        //  header("Cache-Control: post-check=0, pre-check=0", false); 
        //  header("Pragma: no-cache");
        Session::flash('success',__('We are working on your request and will contact you soon.'));
        Session::flash('title_msg', __('Thank you for requesting our service'));

        return redirect(url()->previous() . '#pts-form');
        
        } catch (Exception $ex) {
            // dd($ex);
            Log::error($ex);
            Session::flash('error', __('internal server error'));
            return redirect()->back()->withInput();
        }
    }


public function eventRegistration(Request $request)
{
 try {
    $now = Carbon::now();
    $unique_timestamp = $now->format('YmdHisu');
    
    
    $validator = Validator::make($request->all(),[
        //  event details
        'event_name' => 'required',
            'event_start_date' => 'required',
            // 'event_start_date' => 'required',
            'event_end_date' => 'required',
            // 'event_end_date' => 'required',
            'event_location' => 'required',
            'event_start_time' => 'required',
            'event_end_time' => 'required',
            'event_type' => 'required',
            'event_type_other' => 'required_if:event_type,==,other',
            'venue_type' => 'required',
            'venue_type_other' => 'required_if:venue_type,==,other',

            // 'files' => 'required',
            'files' => 'sometimes',

            'expected_no_of_persons' => 'required',
            'alcohol_consumed' => 'required',     //yes/no

            'vip_attendance' => 'required',     //yes/no
            'vip_attending_detail' => 'required_if:vip_attendance,==,yes',

            'particpants' => 'required',
            'particpants_other' => 'required_if:particpants,==,other',
            'audience' => 'required',
            'audience_other' => 'required_if:audience,==,other',

            'security_risk_hazards' => 'required',     //yes/no
            'security_risk_hazards_detail' => 'required_if:security_risk_hazards,==,yes',

            'previous_history_of_event' => 'required',     //yes/no
            'previous_history_of_event_detail' => 'required_if:previous_history_of_event,==,yes',

            'other_agencies' => 'required',     //yes/no
            'other_agencies_detail' => 'required_if:other_agencies,==,yes',

            //  primary contact details
            'title' => 'required',
            'primary_contact_name' => 'required',
            'primary_contact_email' => 'required|email',
            'primary_contact_number' => 'required',
            'primary_contact_company_name' => 'required',
            'Job_Title' => 'required',

            // 'additional_info' => 'required',
            'additional_info' => 'sometimes',
            'g-recaptcha-response' => 'required',
        ]);
        if($validator->fails()){
            foreach ($validator->messages()->get('*') as $key => $value) {
               
                Session::flash('error', __('Validation failed').": ". $value[0]);
            }

            return redirect()->back()->withErrors($validator)
            ->withInput();
        }
        if (!$this->validateGCaptcha($request['g-recaptcha-response'])) {
            $validator->errors()->add(
                'g-recaptcha-response', 'Invalid captcha code.'
            );
            Session::flash('error',"Invalid captcha");
            return redirect()->back()->withErrors($validator)
            ->withInput();
        }

        $fileNameArr = [];
        $fileUrlArr = [];
        if (!empty($request->file('files'))) {
            $files = $request->file('files');

            foreach ($files as $key=>$file) {
                $filename = rand(). '-' . $unique_timestamp . '.' . $file->getClientOriginalExtension();
                 $file->move(public_path('uploads/event'), $filename);
                //$logoUrl=$this->s3Upload('uploads/event',$filename,$file);
                if(in_array($file->getClientOriginalExtension(),['doc','DOC','docx','DOCX'])){

                     $fileUrl = '<a href=\''.route('download').'?u='.url(('/public/uploads/event/' . $filename)).'\'>File-'.($key+1).'</a>';
                    //$fileUrl = '<a href=\''.route('download').'?u='.$logoUrl.'\'>File-'.($key+1).'</a>';
                }else{

                    $fileUrl = '<a href=\''.url(('/public/uploads/event/' . $filename)).'\'>File-'.($key+1).'</a>';
                    //$fileUrl = '<a href=\''.$logoUrl.'\'>File-'.($key+1).'</a>';
                }

                $fileNameArr[] = $filename;
                $fileUrlArr[] = $fileUrl;
            }

        }
        $fileNames = implode(", ", $fileNameArr);
        $fileUrls = implode(", ", $fileUrlArr);


        $data = $request->all();
       
        unset($data['_token']);
        unset($data['agreement']);
        unset($data['files']);
        $data['file_urls'] = $fileUrls;

        if ($data['event_type'] === 'other') {
            $data['event_type'] = $data['event_type_other'];
           
        }else{
            unset($data['event_type_other']);
        }

        if ($data['venue_type'] === 'other') {
            $data['venue_type'] = $data['venue_type_other'];
            
        }else{
            unset($data['venue_type_other']);
        }

        if ($data['particpants'] === 'other') {
            $data['particpants'] = $data['particpants_other'];
            
        }else{
            unset($data['particpants_other']);
        }

        if ($data['audience'] === 'other') {
            $data['audience'] = $data['audience_other'];
            
        }else{
            unset($data['audience_other']);
        }

        if ($data['vip_attendance'] === 'no') {
            unset($data['vip_attending_detail']);
        }
        if ($data['security_risk_hazards'] === 'no') {
            unset($data['security_risk_hazards_detail']);
        }
        if ($data['previous_history_of_event'] === 'no') {
            unset($data['previous_history_of_event_detail']);
        }


        $data['primary_contact_info'] = 'Name : ' . $data['title'] . ' ' . $data['primary_contact_name'] . ', PH. : ' . $data['primary_contact_number'] . ', Email : ' . $data['primary_contact_email'] . ', Company Name : ' . $data['primary_contact_company_name'] . ', Job Title : ' . $data['Job_Title'];
        $this->events_mail($data+['email'=>$data['primary_contact_email'],'name'=>$data['primary_contact_name']]);

        unset($data['title']);
        unset($data['primary_contact_name']);
        unset($data['primary_contact_number']);
        unset($data['primary_contact_email']);
        unset($data['primary_contact_company_name']);
        unset($data['job_title']);
        unset($data['g-recaptcha-response']);
        // dd($data);
        // $data['event_start_date']= Carbon::createFromFormat('H:i', $data['event_start_date'])->format('d-m-Y');
        // $data['event_end_date']= Carbon::createFromFormat('H:i', $data['event_end_date'])->format('d-m-Y');
        // $data['event_start_time']= Carbon::createFromFormat('H:i', $data['event_start_time'])->format('g:i:s A');
        // $data['event_end_time']= Carbon::createFromFormat('H:i', $data['event_end_time'])->format('g:i:s A');
        // header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); header("Cache-Control: post-check=0, pre-check=0", false); header("Pragma: no-cache");
        $this->eventServiceRequestManageEngine($data);
        $service_request=ServiceRequest::where('service','EVENTS')->first();
        if($service_request){
        $service_request->request_count= $service_request->request_count+1;
        $service_request->save();}
        Session::flash('success', __('We are working on your request and will contact you soon.'));
        Session::flash('title_msg', __('Thank you for requesting our service'));
        return redirect(url()->previous() . '#event-form');
    
 } catch (Exception $th) {
    //  dd($th);
     Log::error($th);
     Session::flash('error', __('internal server error'));
    return redirect()->back()->withInput();
 }
}


public function educationTraining(Request $request)
{
    // dd($request->all());
 try {
    $now = Carbon::now();
    $unique_timestamp = $now->format('YmdHisu');
    $validator = Validator::make($request->all(),[
            'title' => 'required',
            'name' => 'required',
            'training_type' => 'required',
            'mobile_number' => 'required',
            'email' => 'required|email',
            // 'naemt_course_type' => 'sometimes|nullable|required_if:training_type,==,organisation',
            // 'aha_course_type' => 'sometimes|nullable|required_if:training_type,==,organisation',
            // 'ashi_course_type' => 'sometimes|nullable|required_if:training_type,==,organisation',
            'hear_about_from' => 'required',
            'agreement' => 'required',
            'g-recaptcha-response' => 'required',
            
            //individual_group choice
            'no_of_participants' => 'sometimes|nullable|required_if:training_type,==,individual_group',
            'training' => 'sometimes|nullable|required_if:no_of_participants,>=,3',//When would you like to attend the training?
            
            // organisation choice
            'organisation_name' => 'sometimes|nullable|required_if:training_type,==,organisation',
            'training_status' => 'sometimes|nullable|required_if:training_type,==,organisation',//Do you have a training site?
            'no_of_students' => 'sometimes|nullable|required_if:training_type,==,organisation',
            'training_when' => 'sometimes|nullable|required_if:training_type,==,organisation',//When would you like to attend the training?
            
    ]);
        if($validator->fails()){
            // dd($validator);
            foreach ($validator->messages()->get('*') as $key => $value) {
               
                Session::flash('error', __('Validation failed').": ". $value[0]);
            }
            return redirect()->back()->withErrors($validator)
            ->withInput();
        }

        if (!$this->validateGCaptcha($request['g-recaptcha-response'])) {
            $validator->errors()->add(
                'g-recaptcha-response', 'Invalid captcha code.'
            );
            Session::flash('error',"Invalid captcha");
            return redirect()->back()->withErrors($validator)
            ->withInput();
        }
        $service_request=ServiceRequest::where('service','EDUCATION_AND_TRAINING')->first();
        $service_request->request_count= $service_request->request_count+1;
        $today = Carbon::now()->format('Ymd');
        
        $format_index = sprintf('%02d', ($service_request->request_count));
        $data = ['reference_no'=>'WNA-ED-'.$today.'-'.$format_index]+$request->all();
        unset($data['_token']);
        unset($data['agreement']);
        unset($data['g-recaptcha-response']);
        if(isset($data['naemt_course_type'])){

            $data['naemt_course_type']= implode(', ',$data['naemt_course_type']);           
        }else{
            unset($data['naemt_course_type']);   
        }
        if(isset($data['ashi_course_type'])){

            $data['ashi_course_type']= implode(', ',$data['ashi_course_type']);           
        }else{
            unset($data['ashi_course_type']);   
        }
        if(isset($data['aha_course_type'])){

            $data['aha_course_type']= implode(', ',$data['aha_course_type']);           
        }else{
            unset($data['aha_course_type']);   
        }
        if($request->training_type=='organisation'){
            $data['when_would_you_like_to_attend_the_training']=$data['training_when'];
            $data['do_you_have_a_training_site']=$data['training_status']==1?"yes":"no";
            unset($data['no_of_participants']);
            unset($data['training']);
            unset($data['training_when']);
        }else if($request->training_type=='individual_group'){
           
            unset($data['landline_number']);
            unset($data['training_when']);
            unset($data['organisation_name']);
            unset($data['other_training_info']);
            unset($data['training_status']);
            unset($data['no_of_students']);
            if($data['no_of_participants']<3){
                unset($data['training']);
            }else{
                
                $data['when_would_you_like_to_attend_the_training']=$data['training'];
                unset($data['training']);
            }
        }
       
        $this->education_mail($data+['email'=>$data['email'],'name'=>$data['name']]);
        $data['name']=$data['title']." ".$data['name'];
        unset($data['title']);
        
        
        $this->educationTrainingRequestManageEngine($data);
        
        Session::flash('success', __('We are working on your request and will contact you soon.'));
        Session::flash('title_msg', __('Thank you for requesting our service'));
        // dd($data);
        $service_request->save();
        return redirect(url()->previous() . '#serviceTab');
    
 } catch (Exception $th) {
    //  dd($th);
     Log::error($th);
     Session::flash('error', __('internal server error'));
    return redirect()->back()->withInput();
 }
}

}