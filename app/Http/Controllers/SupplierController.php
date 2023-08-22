<?php

namespace App\Http\Controllers;

use App\Country;
use App\Http\Controllers\Traits\MailTrait;
use App\Http\Controllers\Traits\UtilTrait;
use App\OrganizationType;
use App\Supplier;
use App\Tender;
use DB;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Session;

class SupplierController extends Controller
{
    use MailTrait;
    use UtilTrait;

    public function index()
    {
        /*$tenders = Tender::where('closing_date', '>=', date('m/d/Y'))->orderBy('id','DESC')->get();
        $countries = Country::pluck('country_name','id');
        $organization_type = OrganizationType::pluck('type','id');
        return view('website.includes.supplier_registration',compact('countries','organization_type','tenders'));*/
    }

    public function registerFirstPost(Request $request)
    {
        $form_data = $request->all();

        if ($request->organization_type != '') {
            $request->organization_type_id = $request->organization_type;
        }

        unset($form_data['_token']);
        unset($form_data['name']);
        unset($form_data['email']);

        /*echo "<pre>";
        print_r($form_data);
        "</pre>";*/
        Session::put('Supplier.email', $request->email_);
        Session::put('Supplier.name', $request->organization_name);

        if ($request->hasFile('trade_license_file')) {
            $image = $request->file('trade_license_file');
            $new_name = rand(1000, 9999).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/supplier_document'), $new_name);
            //$logoUrl=$this->s3Upload('uploads/supplier_document',$new_name,$image);
            $form_data['trade_license_file'] = '<a href="'.url('/public/uploads/supplier_document/'.$new_name).'" download="Trade License File">Trade License File</a>';
            //$form_data['trade_license_file'] = "<a  href= '".$logoUrl."' download='Trade License File'>Trade License File</a>";
        }

        $form_string_1 = '';

        foreach ($form_data as $key => $form) {
            $form_string_1 .= strtoupper($key).' :'.$form.'<br><br>';
        }

        $form_string_1 = substr($form_string_1, 0, -1);
        Session::put('Supplier.form_string_1', $form_string_1);

        //echo Session::get('Supplier')['form_string_1'];die;
        if (Session::get('Supplier')['form_string_1'] != '') {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function registerSecondPost(Request $request)
    {
        $form_data = $request->all();
        unset($form_data['_token']);
        $form_string_2 = '';
        foreach ($form_data as $key => $form) {
            $form_string_2 .= strtoupper($key).' :'.$form.'<br><br>';
        }

        $form_string_2 = substr($form_string_2, 0, -1);
        Session::put('Supplier.form_string_2', $form_string_2);

        if (Session::get('Supplier')['form_string_2'] != '') {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function registerThirdPost(Request $request)
    {
        if ($request->other_service != '') {
            $request->service_type = $request->service_type;
        }
        $form_data = $request->all();
        unset($form_data['_token']);
        $form_string_3 = '';
        foreach ($form_data as $key => $form) {
            $form_string_3 .= strtoupper($key).' :'.$form.'<br><br>';
        }

        $form_string_3 = substr($form_string_3, 0, -1);
        Session::put('Supplier.form_string_3', $form_string_3);
        if (Session::get('Supplier')['form_string_3'] != '') {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function registerFourPost(Request $request)
    {
        $client = new Client();
        $response = $client->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'form_params' => [
                    'secret' => config('services.recaptcha.secret'),
                    'response' => $request['g-recaptcha-response'],
                ],
            ]
        );
        $body = json_decode((string) $response->getBody());
        // dd($body);

        if (!$body || !$body->success) {
            $validator->errors()->add(
                'g-recaptcha-response', 'Invalid captcha code.'
            );
            Session::flash('error',"Invalid captcha");
            return redirect()->back()->withErrors($validator)
            ->withInput();        }

        $form_data = $request->all();
        unset($form_data['g-recaptcha-response']);

        unset($form_data['_token']);
        if ($request->hasFile('iso_9001_file')) {
            $image_1 = $request->file('iso_9001_file');
            $new_name = rand(1000, 9999).'.'.$image_1->getClientOriginalExtension();
             $image_1->move(public_path('uploads/supplier_document'), $new_name);
            //$logoUrl=$this->s3Upload('uploads/supplier_document',$new_name,$image_1);
            if(in_array($image_1->getClientOriginalExtension(),['doc','DOC','docx','DOCX'])){

                //$form_data['iso_9001_file'] = $form_data['trade_license_file'] = "<a  href= '".route('download').'?u='.$logoUrl."' >ISO 9001 File</a>";
                $form_data['iso_9001_file'] = $form_data['trade_license_file'] = "<a  href= '".route('download').'?u='.url('/').'/public/uploads/supplier_document/'.$new_name."'>ISO 9001 File</a>";

            }else{

                //$form_data['iso_9001_file'] = $form_data['trade_license_file'] = "<a  href= '".$logoUrl."' download='ISO 9001 File'>ISO 9001 File</a>";
                $form_data['iso_9001_file'] = $form_data['trade_license_file'] = "<a  href= '".url('/').'/public/uploads/supplier_document/'.$new_name."'>ISO 9001 File</a>";
            }
            unset($form_data['trade_license_file']);
        }
        if ($request->hasFile('iso_45001_file')) {
            $image_1 = $request->file('iso_45001_file');
            $new_name = rand(1000, 9999).'.'.$image_1->getClientOriginalExtension();
            $image_1->move(public_path('uploads/supplier_document'), $new_name);
            //$logoUrl=$this->s3Upload('uploads/supplier_document',$new_name,$image_1);
            if(in_array($image_1->getClientOriginalExtension(),['doc','DOC','docx','DOCX'])){
                $form_data['iso_45001_file'] = '<a href="'.route('download').'?u='.url('uploads/supplier_document/'.$new_name).'" download>ISO 45001 File</a>';
                //$form_data['iso_45001_file'] = "<a  href= '".route('download').'?u='.$logoUrl."' >ISO 45001 File</a>";
             }else{
                $form_data['iso_45001_file'] = '<a href="'.url('uploads/supplier_document/'.$new_name).'" download>ISO 45001 File</a>';
                // $form_data['iso_45001_file'] = "<a  href= '".$logoUrl."' download='ISO 45001 File'>ISO 45001 File</a>";
             } 
        }
        if ($request->hasFile('iso_14001_file')) {
            $image_1 = $request->file('iso_14001_file');
            $new_name = rand(1000, 9999).'.'.$image_1->getClientOriginalExtension();
             $image_1->move(public_path('uploads/supplier_document'), $new_name);
            //$logoUrl=$this->s3Upload('uploads/supplier_document',$new_name,$image_1);
            if(in_array($image_1->getClientOriginalExtension(),['doc','DOC','docx','DOCX'])){

                //$form_data['iso_14001_file'] = "<a  href= '".route('download').'?u='.$logoUrl."' >ISO 14001 File</a>";
                $form_data['iso_14001_file'] = "<a  href= '".route('download').'?u='.url('/').'/public/uploads/supplier_document/'.$new_name."'>ISO 14001 File</a>";
            }else{

                //$form_data['iso_14001_file'] = "<a  href= '".$logoUrl."' download='ISO 14001 File'>ISO 14001 File</a>";
                $form_data['iso_14001_file'] = "<a  href= '".url('/').'/public/uploads/supplier_document/'.$new_name."'>ISO 14001 File</a>";
            }
        }
        // dd($request->all());
        if ($request->hasfile('equivalent_certifications_file')) {
            foreach ($request->file('equivalent_certifications_file') as $file) {
                $name = rand(1000, 9999).'.'.$file->getClientOriginalExtension();
                $file->move(public_path('uploads/supplier_document'), $name);
                //$logoUrl=$this->s3Upload('uploads/supplier_document',$name,$file);
                if(in_array($file->getClientOriginalExtension(),['doc','DOC','docx','DOCX'])){

                    //$data[] = "<a href='".route('download').'?u='.$logoUrl."' >".$name.'</a>';
                    $data[] = "<a href='".route('download').'?u='.url(('/public/uploads/supplier_document/'.$name))."'>".$name.'</a>';
                }else{
    
                    //$data[] = "<a href='".$logoUrl."' download='".$name."'>".$name.'</a>';
                    $data[] = "<a href='".url(('/public/uploads/supplier_document/'.$name))."'>".$name.'</a>';
                }
            }
            $form_data['equivalent_certifications_file'] = implode(',', $data);
        }

        if ($request->hasFile('licence_file')) {
            $image_2 = $request->file('licence_file');
            $new_name = rand(1000, 9999).'.'.$image_2->getClientOriginalExtension();
            $image_2->move(public_path('uploads/supplier_document'), $new_name);
            //$logoUrl=$this->s3Upload('uploads/supplier_document',$new_name,$image_2);

            if(in_array($image_2->getClientOriginalExtension(),['doc','DOC','docx','DOCX'])){

            //$form_data['licence_file'] = "<a  href= '".route('download').'?u='.$logoUrl."' > License File</a>";
            $form_data['licence_file'] = "<a  href= '".route('download').'?u='.url('/').'/public/uploads/supplier_document/'.$new_name."'> License File</a>";
        }else{
                //$form_data['licence_file'] = "<a  href= '".$logoUrl."' download='License File'> License File</a>";
                $form_data['licence_file'] = "<a  href= '".url('/').'/public/uploads/supplier_document/'.$new_name."' download='License File'> License File</a>";

            }
        }
        if ($request->hasFile('indemnity_insurance_file')) {
            $image_4 = $request->file('indemnity_insurance_file');
            $new_name = rand(1000, 9999).'.'.$image_4->getClientOriginalExtension();
            $image_4->move(public_path('uploads/supplier_document'), $new_name);
            //$logoUrl=$this->s3Upload('uploads/supplier_document',$new_name,$image_4);
            if(in_array($image_4->getClientOriginalExtension(),['doc','DOC','docx','DOCX'])){

            
            //$form_data['indemnity_insurance_file'] = "<a  href= '".route('download').'?u='.$logoUrl."' >Indemnity Insurance File</a>";
            $form_data['indemnity_insurance_file'] = "<a  href= '".route('download').'?u='.url('/').'/public/uploads/supplier_document/'.$new_name."'>Indemnity Insurance File</a>";
            }else{ 
                //$form_data['indemnity_insurance_file'] = "<a  href= '".$logoUrl."' download='Indemnity Insurance File'>Indemnity Insurance File</a>";
                $form_data['indemnity_insurance_file'] = "<a  href= '".url('/').'/public/uploads/supplier_document/'.$new_name."'>Indemnity Insurance File</a>";
            }
        }
        if ($request->hasFile('MSDC_certificate_file')) {
            $image_5 = $request->file('MSDC_certificate_file');
            $new_name = rand(1000, 9999).'.'.$image_5->getClientOriginalExtension();
            $image_5->move(public_path('uploads/supplier_document'), $new_name);
            //$logoUrl=$this->s3Upload('uploads/supplier_document',$new_name,$image_5);
            if(in_array($image_5->getClientOriginalExtension(),['doc','DOC','docx','DOCX'])){

            
            //$form_data['MSDC_certificate_file'] = "<a  href= '".route('download').'?u='.$logoUrl."'>MSDC Certificate File</a>";
            $form_data['MSDC_certificate_file'] = "<a  href= '".route('download').'?u='.url('/').'/public/uploads/supplier_document/'.$new_name."'>MSDC Certificate File</a>";
            }else{


                //$form_data['MSDC_certificate_file'] = "<a  href= '".$logoUrl."' download='MSDC Certificate File'>MSDC Certificate File</a>";
                $form_data['MSDC_certificate_file'] = "<a  href= '".url('/').'/public/uploads/supplier_document/'.$new_name."'>MSDC Certificate File</a>";
            }
        
        }
        $form_string_4 = '';
        // dd(Session::get('Supplier'));
        foreach ($form_data as $key => $form) {
            $form_string_4 .= strtoupper($key).' :'.$form.'<br><br>';
        }

        $form_string_4 = substr($form_string_4, 0, -1);

        $form_string = Session::get('Supplier')['form_string_1'].','.Session::get('Supplier')['form_string_2'].','.Session::get('Supplier')['form_string_3'].','.$form_string_4;
        Log::error($form_string);
        $curl = curl_init();

        curl_setopt_array($curl, [
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
              CURLOPT_POSTFIELDS => ['INPUT_DATA' => '{
				"operation": {
					"details": {
						"SUBJECT": "Supplier Form",
						"email": "'.Session::get('Supplier.email').'",
						"requester":"'.Session::get('Supplier.name').'",
						"DESCRIPTION": "'.$form_string.'",
						"requesttype": "Service Request",
						"priority": "Normal",
						"category": "SupplyChain Services",
						"site": "WebSite",
						"group": "SupplyChain",
						"technician":"",
						"level": "Tier 1",
						"status": "open",
						"service": "WebSite"
					}
				}
			}', 'TECHNICIAN_KEY' => 'E22F5785-49A7-454B-9A16-A15CF97E5D04', 'OPERATION_NAME' => 'ADD_REQUEST', 'format' => 'json'],
              CURLOPT_HTTPHEADER => [
                'Cookie: SDPSESSIONID=CE51E613B19F7936DC1BBE92397B0768; sdpcsrfcookie=12744fa4-d5d0-4f41-a84d-c43c3be01215',
              ],
            ]);

        $response = curl_exec($curl);

        curl_close($curl);
        // Session::flash('message', __('Thank you for taking the time to fill our form and for your interest in becoming a supplier for National Ambulance.'));
        Session::flash('success', __('Thank you for taking the time to fill our form and for your interest in becoming a supplier for National Ambulance.'));
        Session::flash('title_msg', __('Your submission has been sent'));
        $this->supplier_mail(['email' => Session::get('Supplier.email'), 'name' => Session::get('Supplier.name')]);

        print_r($response);
    }

    public function getDownload($id)
    {
        $tender = Tender::where('id', $id)->first();
        $headers = [
              'Content-Type: application/pdf',
            ];
        $file = public_path().'/uploads/tender/'.$tender->upload_file;

        return response()->download($file, 'filename.pdf', $headers);
    }

    public function interest_store(Request $request)
    {
        $form_data = $request->all();

        $form_string = '';
        foreach ($form_data as $key => $form) {
            $form_string .= strtoupper($key).' :'.$form.'<br><br>';
        }

        $form_string = substr($form_string, 0, -1);

        $curl = curl_init();

        curl_setopt_array($curl, [
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
              CURLOPT_POSTFIELDS => ['INPUT_DATA' => '{
				"operation": {
					"details": {
						"SUBJECT": "Expression of Interest Form",
						"email": "'.$request->email.'",
						"requester": "'.$request->email.'",
						"DESCRIPTION": "'.$form_string.'",
						"requesttype": "Service Request",
						"priority": "Normal",
						"category": "SupplyChain Services",
						"site": "WebSite",
						"group": "SupplyChain",
						"technician":"",
						"level": "Tier 1",
						"status": "open",
						"service": "WebSite"
					}
				}
			}', 'TECHNICIAN_KEY' => 'E22F5785-49A7-454B-9A16-A15CF97E5D04', 'OPERATION_NAME' => 'ADD_REQUEST', 'format' => 'json'],
              CURLOPT_HTTPHEADER => [
                'Cookie: SDPSESSIONID=CE51E613B19F7936DC1BBE92397B0768; sdpcsrfcookie=12744fa4-d5d0-4f41-a84d-c43c3be01215',
              ],
            ]);

        $response = curl_exec($curl);

        curl_close($curl);
        // print_r($response);

        //DB::table('tender_interest')->insert(array( 'name' => $request->name, 'email' => $request->email, 'company' => $request->company, 'tender_id' => $request->tender_id, 'phone' => $request->phone, 'landline' => $request->landline, 'comment' => $request->comment  ));

        return redirect('/admin/page/supply-chain');
    }

    public function manage_express_interest(Request $request)
    {
        $tenders = Tender::pluck('name', 'id');
        $interests = DB::table('tender_interest')->join('tender_management as t', 't.id', '=', 'tender_interest.tender_id');

        if (isset($request->tender_id)) {
            $interests = $interests->where('tender_interest.id', '=', $request->tender_id);
        }
        $interests = $interests->select('tender_interest.*', 't.name as tender_name')->Paginate(10);

        return view('Admins.tender_management.manage_express_interest', compact('interests', 'tenders'))->with('i', 1);
    }

    public function interst_show($id)
    {
        $tenders = Tender::pluck('name', 'id');
        $interests = DB::table('tender_interest')->where('id', $id)->get();

        return view('Admins.tender_management.show_interest', compact('interests', 'tenders'));
    }
}
