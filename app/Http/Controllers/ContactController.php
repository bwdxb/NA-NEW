<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Mail;
use DB;
use App\Role;
use App\Contact;
use App\ContactInformationVersion;
use Session;
use Auth;
use App\Country; 
use GuzzleHttp\Client;
use Butschster\Head\MetaTags\MetaInterface;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;


class ContactController extends Controller
{

	public function index(Request $request)
	{
		$contact = Contact::find(1);
		$countries =Country::pluck('country_name','id');
		if($contact){
		
            $description=app()->getLocale() == 'ar'?$contact->description_ar:$contact->description;
            $og = new OpenGraphPackage('contact-us');
           	$image=url('/public/Image/200x200.jpg');
            $og->setDescription(substr(strip_tags($description),0,300).'...');
			$card = new TwitterCardPackage('contact-us');
            $card->setTitle('Contact Us');
            $card->setDescription(substr(strip_tags($description),0,300).'...');
            $card->setImage($image);
			$card->setType('summary_large_image');
			
            Meta::registerPackage($card);
            Meta::registerPackage($og);
            Meta::prependTitle('Contact Us');
		}
		return view('website.contact_us',compact('countries','contact'));
	}
	
	public function contact_store(Request $request)
	{
		// dd($request->all());
        // request()->validate(['captcha.captcha'=>'Invalid captcha code.']);
		$request->validate([
			'enquiry_type'=>'required',
			'title'=>'required',
			'name'=>'required',
			'mobile'=>'required',
			'email'=>'required|email',
			'organisation'=>"required_unless:enquiry_type,General Enquiry,Website Issues",
			'country'=>'required',
			'description'=>'required',
			'agreement'=>'required',
			'g-recaptcha-response' => 'required',
		],['required'=>'this field is required']);

		$client = new Client;
		$response = $client->post(
			'https://www.google.com/recaptcha/api/siteverify',
			[
				'form_params' =>
				[
					'secret' => config('services.recaptcha.secret'),
					'response' => $request['g-recaptcha-response'],
				]
			]
		);
		$body = json_decode((string)$response->getBody());

		if (!$body || !$body->success) {
			$validator->errors()->add(
                'g-recaptcha-response', 'Invalid captcha code.'
            );
            Session::flash('error',"Invalid captcha");
            return redirect()->back()->withErrors($validator)
            ->withInput();
		}

		$form_data = $request->all();
		$form_data['name'] = $form_data['title'].' '.$form_data['name'];
		unset($form_data['_token']);
		unset($form_data['title']);
		unset($form_data['g-recaptcha-response']);
		
		$category = "GeneralEnquiries";
		$group = "GeneralEnquiries";
		if($request->enquiry_type=='General Enquiry'||$request->enquiry_type=='Website Issues'){
			unset($form_data['organisation']);
		}

		switch ($request->enquiry_type) {
			case 'Procurement and Supply Chain':
			$category = "SupplyChain Services";
			$group = "SupplyChain";
			break;

			case 'Feedback':
			$category = "QHSE Services";
			$group = "QHSE";
			break;
			case 'PCR':
			$category = "QHSE Services";
			$group = "QHSE";
			break;

			case 'Career':
			$category = "HR Services";
			$group = "Recruitment";
			break;

			case 'Education and Training':
			$category = "BSG Services";
			$group = "BSG";
			break;
			case 'Event Emergency Medical Coverage':
			$category = "Events Services";
			$group = "Events";
			break;
			case "Event's Ambulance Coverage":
			$category = "Events Services";
			$group = "Events";
			break;
			case 'Non-Emergency Medical Transport':
			$category = "Events Services";
			$group = "Events";
			break;
			case 'Non-Emergency Patient Transport':
			$category = "Events Services";
			$group = "Events";
			break;
			case 'Emergency Medical Services':
			$category = "BSG Services";
			$group = "BSG";
			break;

			case 'Media':
			$category = "Media Services";
			$group = "Media";
			break;
			case 'Website Issues':
			$category = "Media Services";
			$group = "Media";
			break;
		 }
		 $form_string = '';
		 foreach($form_data as $key =>$form)
		 {
		 	$form_string .= strtoupper($key)." :".$form.'<br>'; 
		 }

		 $form_string = substr($form_string,0,-1);

		 $curl = curl_init();

		 // curl_setopt_array($curl, array(
		 // 	CURLOPT_URL => 'https://naservicedesk.nationalambulance.ae/sdpapi/request',
		 // 	CURLOPT_RETURNTRANSFER => true,
		 // 	CURLOPT_ENCODING => '',
		 // 	CURLOPT_MAXREDIRS => 10,
		 // 	CURLOPT_TIMEOUT => 0,
		 // 	CURLOPT_SSL_VERIFYHOST => 0,
		 // 	CURLOPT_SSL_VERIFYPEER => 0,
		 // 	CURLOPT_FOLLOWLOCATION => true,
		 // 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		 // 	CURLOPT_CUSTOMREQUEST => 'POST',
		 // 	CURLOPT_POSTFIELDS => array('INPUT_DATA' => '{
		 // 		"operation": {
		 // 			"details": {
		 // 				"SUBJECT": "Get in Touch Form",
		 // 				"name": "'.$request->name.'",
		 // 				"requester":"' . $request->name . '",
		 // 				"email": "'.$request->email.'",
		 // 				"DESCRIPTION": "'.$form_string.'",
		 // 				"requesttype": "Service Request",
		 // 				"priority": "Normal",
		 // 				"category": "GeneralEnquiries",
		 // 				"site": "WebSite",
		 // 				"group": "GeneralEnquiries",
		 // 				"technician":"",
		 // 				"level": "Tier 1",
		 // 				"status": "open",
		 // 				"service": "WebSite"
		 // 			}
		 // 		}
		 // 	}','TECHNICIAN_KEY' => 'E22F5785-49A7-454B-9A16-A15CF97E5D04','OPERATION_NAME' => 'ADD_REQUEST','format' => 'json'),
		 // 	CURLOPT_HTTPHEADER => array(
		 // 		'Cookie: SDPSESSIONID=CE51E613B19F7936DC1BBE92397B0768; sdpcsrfcookie=12744fa4-d5d0-4f41-a84d-c43c3be01215'
		 // 	),
		 // ));

			curl_setopt_array($curl, array(
				CURLOPT_URL => 'https://naservicedesk.nationalambulance.ae/sdpapi/request',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_SSL_VERIFYHOST => 0,
				CURLOPT_SSL_VERIFYPEER => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => array('INPUT_DATA' => '{
					"operation": {
						"details": {
							"SUBJECT": "Get in Touch Form",
							"name": "'.$request->name.'",
							"requester":"' . $request->name . '",
							"email": "'.$request->email.'",
							"DESCRIPTION": "'.$form_string.'",
							"requesttype": "Service Request",
							"priority": "Normal",
							"category": "'.$category.'",
							"site": "WebSite",
							"group": "'.$group.'",
							"technician":"",
							"level": "Tier 1",
							"status": "open",
							"service": "WebSite"
						}
					}
				}','TECHNICIAN_KEY' => 'E22F5785-49A7-454B-9A16-A15CF97E5D04','OPERATION_NAME' => 'ADD_REQUEST','format' => 'json'),
				CURLOPT_HTTPHEADER => array(
					'Cookie: SDPSESSIONID=CE51E613B19F7936DC1BBE92397B0768; sdpcsrfcookie=12744fa4-d5d0-4f41-a84d-c43c3be01215'
				),
			));

			$response = curl_exec($curl);

			curl_close($curl); 
		//		print_r($response);

			$to_name = $request->name;
			$to_email = $form_data['email'];
			$form_data['name']=$request->name;
			Mail::send('emails.contact', $form_data, function($message) use ($to_name, $to_email) {
				$message->to($to_email, $to_name)
				->subject(__('Your message has been received'));
				$message->from(env('MAIL_FROM','laravel8000@gmail.com'),__('National Ambulance'));
			});

			Session::flash('message', __('Contact Information added successfully'));
			Session::flash('success', __('We will review your request and be in touch with you shortly.'));
			Session::flash('title_msg', __('Thank you for contacting us'));

			//return redirect()->route('contact-us');
			return redirect('/en/contact-us');
			// return redirect('/admin/page/get-in-touch');
		}

		public function manage_contact_info()
		{
			$contact = Contact::find(1);
			return view('Admins.static_management.manage_contact_info',compact('contact'));
		}

		public function update(Request $request)
		{
			$oldPage = Contact::where('id',$request->id)->first();
			$contact = Contact::where('id',$request->id)->first();
			$contact->description = $request->description;
			$contact->description_ar = $request->description_ar;
			if($request->preview){
				
				$countries =Country::pluck('country_name','id');
				
					    
                $html = view('website.contact_us',compact('countries','contact'))->render();
                 return redirect()->back()->with("preview_page",$html)->withInput();
                }else{
			if($contact->save())
			{
				$tempPageData= $oldPage->toArray();
                $tempPageData['contact_information_id']=$tempPageData['id'];
                $tempPageData['created_by']=Auth::user()->id;
                unset($tempPageData['id']);
                unset($tempPageData['created_at']);
                $vcData= new ContactInformationVersion($tempPageData);
                $vcData->save();
				Session::flash('message', 'Page has been updated successfully');
				return redirect('/admin/manage_contact_info');
			}
			else
			{
				Session::flash('error', 'Page not updated successfully');
				return redirect('/admin/manage_contact_info');
			}

			}
		}

		public function history(request $request)
    	{
			try {
				//code...
				$pages = ContactInformationVersion::orderBy('id','DESC');
				$pages = $pages->paginate(10);
				return view('Admins.static_management.manage_contact_history',compact('pages'))->with('i',1);
			} catch (Exception $ex) {
				Log::error($ex);
				Session::flash('error', 'internal server error');
				return redirect('/admin/manage_contact_info');
			}
    	}

		public function pageRevert(Request $request,$id)
		{
			try{
				$revertPageData =  ContactInformationVersion::where('id',$id)->first();
				$oldPage = Contact::find($revertPageData->contact_information_id);
				$contact  = Contact::find($revertPageData->contact_information_id);
				$contact->description = $revertPageData->description;
				$contact->description_ar = $revertPageData->description_ar;
				if($request->preview){
					$countries =Country::pluck('country_name','id');
					$html = view('website.contact_us',compact('countries','contact'))->render();
					return redirect()->back()->with("preview_page",$html)->withInput();
				}else{ 
					if($contact->isDirty()){
						if($contact->save())
						{
							$tempPageData= $oldPage->toArray();
							$tempPageData['contact_information_id']=$tempPageData['id'];
							$tempPageData['created_by']=Auth::user()->id;
							unset($tempPageData['id']);
							unset($tempPageData['created_at']);
							$vcData= new ContactInformationVersion($tempPageData+['reverted'=>1]);
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
			return redirect('/admin/manage_contact_info');
    	}

	}