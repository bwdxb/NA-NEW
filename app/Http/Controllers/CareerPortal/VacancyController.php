<?php

namespace App\Http\Controllers\CareerPortal;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MailTrait;
use App\Http\Controllers\Traits\UtilTrait;

use App\Http\Controllers\Traits\RequestManageEngineTrait;
use App\Http\Controllers\Traits\SmsTrait;
use App\Config;
use App\JobVacancy;
use App\JobVacancyVersion;
use App\JobVacancyCategory;
use App\Subscriptions;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Session;
use Butschster\Head\MetaTags\MetaInterface;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;
use Auth;

class VacancyController extends Controller
{
    use RequestManageEngineTrait;
    use MailTrait;
    use SmsTrait;
    use UtilTrait;

    protected $meta;
    public function adminCreateOrUpdateVacancy(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'id' => 'sometimes',
            'logofile' => 'sometimes',
            'job_category' => 'required_without:id',
            'job_title' => 'required_without:id',
            // 'job_description' => 'required_without:id',
            // 'job_reqiurement' => 'required_without:id',
            'employment_type' => 'required_without:id',
            'department' => 'sometimes',
            'location' => 'sometimes',
            'vacancy_closing_date' => 'sometimes',
        ]);

        $current_timestamp = Carbon::now()->timestamp;
        //  job_id - generate unique job id : Job ID should start with: RNA followed by the number
        $job_id = 'RNA' . $current_timestamp;

        if ($validator->fails()) {
            Session::flash('error', 'Failed to update Vacancies');

            return redirect()->back()->withErrors($validator)
                ->withInput();
        }

        try {
            $logoUrl = '';
            if (!empty($request->file('logofile'))) {
                $logo = $request->file('logofile');

                $logoName = rand(1000, 9999) . '.' . $logo->getClientOriginalExtension();
                 $logo->move(public_path('uploads/vacancy/'.$job_id), $logoName);
                //$logoUrl = $this->s3Upload('uploads/vacancy', $logoName, $logo);
                 $logoUrl = '/public/uploads/vacancy/'.$job_id.'/'.$logoName;
            }

            if ($request->preview) {
                $vacTempData = new JobVacancy(
                    $request->all() + [
                        'job_category_ar' => JobVacancyCategory::where('job_category', $request->job_category)->first()->job_category_ar,
                        'id' => $request->id,
                        'bi_lang' => $request->bi_lang,
                        'job_id' => $job_id,
                        'logo' => $logoUrl,
                    ]
                );

                $html =  view('career_portal.job-detail_preview', ['data' => $vacTempData])->render();
                return redirect()->back()->with("preview_page", $html)->withInput();
            } else {
                $oldPage = JobVacancy::find($request->id);
                $vacancy = JobVacancy::updateOrCreate(
                    ['id' => $request->id],
                    $request->all() + [
                        'job_category_ar' => JobVacancyCategory::where('job_category', $request->job_category)->first()->job_category_ar,
                        'bi_lang' => $request->bi_lang,
                        'job_id' => $job_id,
                        'logo' => $logoUrl,
                    ]
                );

                if (!$vacancy) {
                    Session::flash('error', 'Failed to update Vacancies');

                    return redirect()->back()->withInput();
                } else {
                    if ($oldPage) {

                        $tempPageData = $oldPage->toArray();
                        $tempPageData['vacancy_id'] = $tempPageData['id'];
                        $tempPageData['created_by'] = Auth::user()->id;
                        unset($tempPageData['id']);
                        unset($tempPageData['created_at']);
                        unset($tempPageData['applied_count']);
                        $vcData = new JobVacancyVersion($tempPageData);
                        $vcData->save();
                    }
                }
                if (isset($request->id)) {

                    Session::flash('success', 'Successfully updated Vacancies');
                } else {

                    Session::flash('success', 'Successfully Created Vacancies');
                    //     $vacancy = JobVacancy::where('job_id', $vacancy->job_id)->first();

                    //    $searchWords = explode(',',$vacancy->job_category);
                    //     $subscribers = Subscriptions::where('status',"ACTIVE");
                    //     foreach($searchWords as $word){
                    //         $subscribers->orWhere('job_category', 'LIKE', '%'.$word.'%');
                    //     }
                    //     $subscribers = $subscribers->distinct('email')->get()->pluck('email')->toArray();
                    //     foreach ($subscribers as $key => $value) {
                    //         $this->jobAlertMail(['email' => $value, 'name' => $value, 'vacancy' => $vacancy]);
                    //     }
                }

                return redirect()->route('career-portal.admin.vacancy.view');
            }
        } catch (\Exception $ex) {
            //    dd($ex);
            Log::error($ex);
            Session::flash('error', 'Internal Exception Occured');

            return redirect()->back()->withInput();
        }
    }

    public function viewUpdateVacancy($id)
    {
        try {
            if (!$id) {
                // Session::flash('error', 'Failed to get Vacancy');

                return redirect()->back();
            }

            $vacancy = JobVacancy::find($id);

            if (!$vacancy) {
                // Session::flash('error', 'Successfully retrieved Vacancy');

                return redirect(url()->previous() . '#mediaContentForm');
            }

            $data = JobVacancy::orderBy('created_at', 'desc')->get();
            $config = Config::where("type", "CAREER_STATUS_BUTTON")->first();
            // Session::flash('success', 'Successfully get the Media Content');

            return view('career_portal.admin.vacancy', ['config' => $config, 'update' => $vacancy, 'data' => $data]);
        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('error', 'Internal Exception Occured');

            return redirect()->back()->withInput();
        }
    }
    public function viewDuplicateVacancy($id)
    {
        try {
            if (!$id) {
                // Session::flash('error', 'Failed to get Vacancy');

                return redirect()->back();
            }

            $vacancy = JobVacancy::find($id);

            if (!$vacancy) {
                // Session::flash('error', 'Successfully retrieved Vacancy');

                return redirect(url()->previous() . '#mediaContentForm');
            }

            $data = JobVacancy::orderBy('created_at', 'desc')->get();
            $config = Config::where("type", "CAREER_STATUS_BUTTON")->first();
            // Session::flash('success', 'Successfully get the Media Content');

            return view('career_portal.admin.vacancy', ['config' => $config, 'update' => $vacancy, 'data' => $data, 'duplicate' => true]);
        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('error', 'Internal Exception Occured');

            return redirect()->back()->withInput();
        }
    }

    public function deleteVacancy($id)
    {
        try {
            if (!$id) {
                Session::flash('error', 'Failed to delete the Vacancy');

                return redirect()->back();
            }

            $vacancy = JobVacancy::find($id);

            if (!$vacancy) {
                Session::flash('error', 'Failed to delete the Vacancy');

                return redirect()->back();
            }

            $delete = $vacancy->delete();

            if ($delete) {
                Session::flash('success', 'Successfully deleted the Vacancy');
            } else {
                Session::flash('error', 'Failed to delete the Vacancy');
            }

            return redirect()->route('career-portal.admin.vacancy.view');
        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('error', 'Internal Exception Occured');

            return redirect()->back()->withInput();
        }
    }

    public function updateVacancyStatus($id, $status)
    {
        try {
            if (!$id) {
                Session::flash('error', 'Failed to update Vacancy Status');

                return redirect()->back();
            }

            $vacancy = JobVacancy::find($id);
            if (!$vacancy) {
                Session::flash('error', 'Failed to update Vacancy Status');

                return redirect()->back();
            }

            $update = $vacancy->update([
                'status' => $status,
            ]);

            if ($update) {
                Session::flash('success', 'Successfully updated Status of Vacancy');
                if ($status == 'active') {
                    $vacancy = JobVacancy::where('job_id', $vacancy->job_id)->first();

                    $searchWords = explode(',', $vacancy->job_category);
                    $subscribers = Subscriptions::where('status', "ACTIVE");
                    foreach ($searchWords as $word) {
                        $subscribers->orWhere('job_category', 'LIKE', '%' . $word . '%');
                    }
                    $subscribers = $subscribers->distinct('email')->get()->pluck('email')->toArray();
                    foreach ($subscribers as $key => $value) {
                        $this->jobAlertMail(['email' => $value, 'name' => $value, 'vacancy' => $vacancy]);
                    }
                }
            } else {
                Session::flash('error', 'Failed to update Vacancy Status');
            }

            return redirect()->route('career-portal.admin.vacancy.view');
        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('error', 'Internal Exception Occured');

            return redirect()->back()->withInput();
        }
    }

    public function filter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'filter' => 'required',
            'sort' => 'required',
        ]);

        if ($validator->fails()) {
            // Session::flash('error', 'Failed to fetch filtered Media Content');

            return redirect()->back()->withErrors($validator)
                ->withInput();
        }

        $filterCategory = explode('-', $request->filter);

        $item = JobVacancy::query();
        if (isset($request->year)) {
            $item = $item->whereYear('created_at', $request->year);
        }
        if (isset($request->month)) {
            $item = $item->whereMonth('created_at', $request->month);
        }
        switch ($filterCategory[0]) {
            case 'all':
                break;
            default:
                $item = $item->where($filterCategory[1], $filterCategory[0]);
        }

        switch ($request->sort) {
            case 'latest':
                $item = $item->groupby('created_at', $filterCategory[1])->latest();
                break;
            default:
                $item = $item->groupby('created_at', $filterCategory[1])->oldest();
        }
        // dd($headsUpContents->toSql());
        $item = $item->get();

        // Session::flash('success', 'Successfully retrieved filtered Media Content');

        return view('employee_portal.heads_up', ['data' => $item, 'filter' => $request->all()]);
    }

    public function adminfilter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'filter' => 'required',
            'sort' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Failed to fetch filtered Media Content');

            return redirect()->back()->withErrors($validator)
                ->withInput();
        }

        $filterCategory = explode('-', $request->filter);

        $item = JobVacancy::query();
        $config = Config::where("type", "CAREER_STATUS_BUTTON")->first();
        if (isset($request->year)) {
            $item = $item->whereYear('created_at', $request->year);
        }
        if (isset($request->month)) {
            $item = $item->whereMonth('created_at', $request->month);
        }
        switch ($filterCategory[0]) {
            case 'all':
                break;
            default:
                $item = $item->where($filterCategory[1], $filterCategory[0]);
        }

        switch ($request->sort) {
            case 'latest':
                $item = $item->groupby('created_at', $filterCategory[1])->latest();
                break;
            default:
                $item = $item->groupby('created_at', $filterCategory[1])->oldest();
        }
        // dd($headsUpContents->toSql());
        $item = $item->get();

        // Session::flash('success', 'Successfully retrieved filtered Media Content');

        return view('employee_portal.admin_heads_up', ['config' => $config, 'data' => $item, 'filter' => $request->all()]);
    }

    public function viewUserVacancies()
    {
        $item = JobVacancy::where('status', 'active')->whereDate('vacancy_closing_date','>=',Carbon::now())->orderBy('id', 'DESC')->get();

        return view('career_portal.job-listing', ['data' => $item]);
    }

    public function userViewVacancyDetails($id)
    {
        \Session::put('locale', 'en');
        if (!$id) {
            // Session::flash('error', 'Failed to retrieve job vacancy');

            return redirect()->back();
        }

        $vacancy = JobVacancy::find($id);
        if (!$vacancy) {
            // Session::flash('error', 'Failed to retrieve job vacancy');

            return redirect()->back();
        } else {
            $title = __("Check out this job at National Ambulance UAE: ") . $vacancy->job_title . ".)";
            $image = url('/public/Image/200x200.jpg');
            $description = $vacancy->job_description;

            $og = new OpenGraphPackage($title);
            $og->addImage($image);
            $og->setTitle($title);
            $og->setDescription(substr(strip_tags($description), 0, 300) . '...');

            $card = new TwitterCardPackage($title);
            $card->setTitle($title);
            $card->setDescription(substr(strip_tags($description), 0, 300) . '...');
            $card->setImage($image);
            $card->setType('summary_large_image');
            Meta::registerPackage($card);
            Meta::registerPackage($og);
            Meta::prependTitle($title);
        }
        // Session::flash('success', 'Successfully retrieved job vacancy');

        Meta::prependTitle($vacancy->job_title);
        return view('career_portal.job-detail', ['data' => $vacancy]);
    }

    public function userApplyVacancyForm($id)
    {
        \Session::put('locale', 'en');
        if (!$id) {
            // Session::flash('error', 'Failed to retrieve job form');

            return redirect()->back();
        }

        $vacancy = JobVacancy::find($id);
        if (!$vacancy) {
            // Session::flash('error', 'Failed to retrieve job form');

            return redirect()->back();
        }
        // Session::flash('success', 'Successfully retrieved job form');

        return view('career_portal.job-apply-form', ['data' => $vacancy]);
    }

    public function userApplyJobVacancy(Request $request)
    {
        $now = Carbon::now();
        $unique_timestamp = $now->format('YmdHisu');
        $data = $request->all();
        try {
            $validator = Validator::make($request->all(), [
                'job_id' => 'required',
                'title' => 'required',
                'name' => 'required',
                'gender' => 'required',
                'date_of_birth' => 'required',
                'nationality' => 'required',

                /* If nationality is UAE */
                'passport_no' => 'required_if:nationality,uae',
                'unified_no' => 'required_if:nationality,uae',
                'family_book_no' => 'required_if:nationality,uae',
                'emirates_id_no' => 'required_if:nationality,uae',
                'national_service' => 'required_if:nationality,uae',
                'attach_waiver' => 'required_if:national_service,0',
                'marital_status' => 'required_if:nationality,uae',
                'email' => 'sometimes|nullable|required_if:nationality,uae|email',
                'mobile' => 'required_if:nationality,uae',
                'address' => 'required_if:nationality,uae',
                'emirates' => 'required_if:nationality,uae',
                'languages_known' => 'required_if:nationality,uae',
                'key_skills' => 'required_if:nationality,uae',

                /* If nationality is other */
                'non_uae_passport_no' => 'required_if:nationality,other',
                'non_uae_marital_status' => 'required_if:nationality,other',
                'non_uae_email' => 'sometimes|nullable|required_if:nationality,other|email',
                'non_uae_mobile' => 'required_if:nationality,other',
                // 'nationality_other' => 'required_if:nationality,other',
                // 'country' => 'required',
                'uae_type_of_visa' => 'required_if:country,uae',
                // 'uae_emirates_id_no' => 'required_if:country,uae',
                'non_uae_languages_known' => 'required_if:country,uae',
                'non_uae_key_skills' => 'required_if:country,uae',

                'attach_cv' => 'required',

                'basic_education' => 'required',
                'work_experience' => 'required',
                'current_position' => 'required',
                'employer_name' => 'required',
                'current_salary' => 'required',
                'expected_salary' => 'required',
                'interview_availability' => 'required',
                'work_start_date' => 'required',
                'notice_period' => 'required',
                'job_heard' => 'required',
                'g-recaptcha-response' => 'required',
            ]);

            // Certificate ulti level file upload end
            // return redirect()->back()->withErrors($validator)->withInput($request->all());
            if ($validator->fails()) {

                // job_apply_
                foreach ($validator->messages()->get('*') as $key => $value) {

                    Session::flash('error', __('Validation failed') . ": " . $value[0]);
                }
                // return redirect()->back()->withInput($request->all());
                return redirect()->back()
                    ->withInput($request->all())->withErrors($validator);
            }

            $vacancy = JobVacancy::where('job_id', $request->job_id)->first();

            if (!$vacancy) {
                Session::flash('error', 'Failed to retrieve job details, Please try again...');

                return redirect()->back()->withInput();
            }

            $vacancy->update([
                'applied_count' => ($vacancy->applied_count + 1),
            ]);

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
                // request()->validate(['g-recaptcha-response' => 'Invalid captcha code.']);
                $validator->errors()->add(
                    'g-recaptcha-response',
                    'Invalid captcha code.'
                );
                Session::flash('error', "Invalid captcha");
                return redirect()->back()->withErrors($validator)
                    ->withInput();
            }

            unset($data['g-recaptcha-response']);

            $today = Carbon::now()->format('Ymd');
            $format_index = sprintf('%02d', ($vacancy->applied_count));
            $data['reference_no'] = ' REF-' . $today . '-' . $format_index;
            $complaint_format = 'EMT ' . ' ' . $vacancy->job_id . '##' . $data['reference_no'];
            $data['job-desc'] = $vacancy->title . ' ' . $complaint_format;
            $data['job_title'] = $vacancy->job_title;
            unset($data['id']);
            // dd("hello");

            // Waiver file upload
            if ($request->hasFile('attach_waiver')) {
                $image = $request->file('attach_waiver');
                $new_name = rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
                 $image->move(public_path('uploads/career_vacancy'), $new_name);
                //$logoUrl = $this->s3Upload('uploads/career_vacancy', $new_name, $image);

                if (in_array($image->getClientOriginalExtension(), ['doc', 'DOC', 'docx', 'DOCX'])) {

                     $data['waiver'] = '<a href="'.route('download').'?u='.url('public/uploads/career_vacancy/'.$new_name).'" download>waiver file</a>';
                    //$data['waiver'] = '<a href="' . route('download') . '?u=' . $logoUrl . '" download>waiver file</a>';
                } else {

                    // $data['waiver'] = '<a href="'.url('public/uploads/career_vacancy/'.$new_name).'" download>waiver file</a>';
                    $data['waiver'] = '<a href="' . $logoUrl . '" download>waiver file</a>';
                }
                unset($data['attach_waiver']);
            }
            // Cv Upload
            if ($request->hasFile('attach_cv')) {
                $image = $request->file('attach_cv');
                $new_name = rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
                 $image->move(public_path('uploads/career_vacancy'), $new_name);
                //$logoUrl = $this->s3Upload('uploads/career_vacancy', $new_name, $image);

                if (in_array($image->getClientOriginalExtension(), ['doc', 'DOC', 'docx', 'DOCX'])) {

                    $data['cv'] = '<a href="'.route('download').'?u='.url('public/uploads/career_vacancy/'.$new_name).'" download>CV file</a>';
                    //$data['cv'] = '<a href="' . route('download') . '?u=' . $logoUrl . '" download>CV file</a>';
                } else {

                     $data['cv'] = '<a href="'.url('public/uploads/career_vacancy/'.$new_name).'" download>CV file</a>';
                    //$data['cv'] = '<a href="' . $logoUrl . '" download>CV file</a>';
                }
                unset($data['attach_cv']);
            }

            // Certificate ulti level file upload start
            $certificateNameArr = [];
            $certificateUrlArr = [];
            if (isset($request->attach_certificates) && is_array($request->attach_certificates)) {
                foreach ($request->attach_certificates as $key => $multiFileValue) {
                    foreach ($multiFileValue as $key1 => $certificate) {
                        $tempCertName = $request->certification_type[$key] ? $request->certification_type[$key] . '-' : '';

                        $certificatename = $tempCertName . 'certificate-' . ($key1 + 1) . '-' . $unique_timestamp . '.' . $certificate->getClientOriginalExtension();
                         $certificate->move(public_path('uploads/vacancy/certificate/'.$request->name), $certificatename);
                        //$logoUrl = $this->s3Upload('uploads/vacancy/certificate', $certificatename, $certificate);
                        if (in_array($certificate->getClientOriginalExtension(), ['doc', 'DOC', 'docx', 'DOCX'])) {

                             $certificateUrl = '<a href="'.route('download').'?u='.url('/public/uploads/vacancy/certificate/'.$request->name.'/'.$certificatename).'" download>certificate-'.($key1 + 1).'</a>';
                            //$certificateUrl = '<a href="' . route('download') . '?u=' . $logoUrl . '" download>certificate-' . ($key1 + 1) . '</a>';
                        } else {

                            // $certificateUrl = '<a href="'.url('/public/uploads/vacancy/certificate/'.$request->name.'/'.$certificatename).'" download>certificate-'.($key1 + 1).'</a>';
                            $certificateUrl = '<a href="' . $logoUrl . '" download>certificate-' . ($key1 + 1) . '</a>';
                        }

                        $certificateNameArr[] = $certificatename;
                        $certificateUrlArr[] = $certificateUrl;
                    }
                }
                $certificateFileNames = implode(', ', $certificateNameArr);
                $certificateFileUrls = implode(', ', $certificateUrlArr);
                $tempCertArray = '';
                foreach ($certificateNameArr as $key => $value) {
                    // dd($value.' ('.$certificateUrlArr[$key].')');
                    $tempCertArray = $tempCertArray . "\n" . ($value . ' (' . $certificateUrlArr[$key] . ')');
                }
                $data['certificates'] = $tempCertArray;
            }
            unset($data['certification_type']);
            unset($data['attach_certificates']);
            // Certificate ulti level file upload end

            // document ulti level file upload start
            $documentNameArr = [];
            $documentUrlArr = [];
            if (isset($request->attach_documents) && is_array($request->attach_documents)) {
                foreach ($request->attach_documents as $key => $multiFileValue) {
                    foreach ($multiFileValue as $key1 => $document) {
                        $tempCertName = $request->document_type[$key] ? $request->document_type[$key] . '-' : '';
                        $documentname = $tempCertName . 'document-' . ($key1 + 1) . '-' . $unique_timestamp . '.' . $document->getClientOriginalExtension();
                         $document->move(public_path('uploads/vacancy/document/'.$request->name), $documentname);
                        //$logoUrl = $this->s3Upload('uploads/vacancy/document', $documentname, $document);

                        if (in_array($document->getClientOriginalExtension(), ['doc', 'DOC', 'docx', 'DOCX'])) {

                             $documentUrl = '<a href="'.route('download').'?u='.url('/public/uploads/vacancy/document/'.$request->name.'/'.$documentname).'" download>document-'.($key1 + 1).'</a>';
                            //$documentUrl = '<a href="' . route('download') . '?u=' . $logoUrl . '" download>document-' . ($key1 + 1) . '</a>';
                        } else {

                            $documentUrl = '<a href="'.url('/public/uploads/vacancy/document/'.$request->name.'/'.$documentname).'" download>document-'.($key1 + 1).'</a>';
                            //$documentUrl = '<a href="' . $logoUrl . '" download>document-' . ($key1 + 1) . '</a>';
                        }
                        $documentNameArr[] = $documentname;
                        $documentUrlArr[] = $documentUrl;
                    }
                }
                $documentFileNames = implode(', ', $documentNameArr);
                $documentFileUrls = implode(', ', $documentUrlArr);
                $tempDocArray = '';
                foreach ($documentNameArr as $key => $value) {
                    $tempDocArray = $tempDocArray . "\n" . ($value . ' (' . $documentUrlArr[$key] . ')');
                }
                $data['documents'] = $tempDocArray;
            }
            unset($data['document_type']);
            unset($data['attach_documents']);
            unset($data['_token']);
            if ($data['nationality'] == 'United Arab Emirates') {
                unset($data['non_uae_passport_no']);
                unset($data['non_uae_marital_status']);
                unset($data['non_uae_email']);
                unset($data['non_uae_mobile']);
                unset($data['country']);
                unset($data['uae_type_of_visa']);
                unset($data['uae_emirates_id_no']);
                unset($data['non_uae_languages_known']);
                unset($data['non_uae_key_skills']);
            } else {
                unset($data['passport_no']);
                unset($data['unified_no']);
                unset($data['family_book_no']);
                unset($data['emirates_id_no']);
                unset($data['marital_status']);
                unset($data['email']);
                unset($data['mobile']);
                unset($data['address']);
                unset($data['languages_known']);
                unset($data['key_skills']);
                /**set  */
                $data['passport_no'] = $data['non_uae_passport_no'];
                $data['marital_status'] = $data['non_uae_marital_status'];

                $data['email'] = $data['non_uae_email'];
                $data['mobile'] = $data['non_uae_mobile'];
                $data['languages_known'] = $data['non_uae_languages_known'];
                $data['key_skills'] = $data['non_uae_key_skills'];
                $data['non_uae_passport_no'];

                unset($data['non_uae_passport_no']);
                unset($data['non_uae_marital_status']);
                unset($data['non_uae_email']);
                unset($data['non_uae_mobile']);
                unset($data['non_uae_languages_known']);
                unset($data['non_uae_key_skills']);
            }
            $data['name'] = $data['title'] . ' ' . $data['name'];
            unset($data['title']);
            $request_engine_status = $this->jobApplicationRequestManageEngine($data);
            // dd($data);
            $data['name'] = $request->name;
            $mail_status = $this->jobApplicationMail($data);
            // dd("hello");
            // dd($mail_status);
            $job_title = $vacancy->job_title;
            Session::flash('success', 'Thank you for taking the time to apply for the position of ' . $job_title . ' at National Ambulance.   Your application will be screened and reviewed and we will contact you if your qualifications match our criteria.');
            Session::flash('title_msg', 'Thank you for your interest in working at National Ambulance');
            // dd($request->all());
            return redirect()->back();
        } catch (\Exception $ex) {
            // dd($ex);
            Log::error($ex);
            Session::flash('error', 'Internal Server Error Occured, Please try again later...');

            return redirect()->back()->withInput();
        }
    }

    public function vacancyListFilter(Request $request)
    {
        try {
            \Session::put('locale', 'en');
            // dd($request->all());
            $item = JobVacancy::query();
            if (isset($request->search_key)) {
                $item = $item->where('job_id', 'LIKE', trim($request->search_key) . '%')->orWhere('job_title', 'LIKE', '%' . trim($request->search_key) . '%');
            }
            if (isset($request->category)) {
                $item = $item->whereIn('job_category', $request->category);
            }

            switch ($request->sort) {
                case 'Newest':
                    $item = $item->latest();
                    break;
                case 'Oldest':
                    $item = $item->oldest();
                    break;
                default:
                    $item = $item->latest();
            }
            // dd($headsUpContents->toSql());
            $item = $item->get();

            // Session::flash('success', 'Successfully retrieved filtered Content');

            return view('career_portal.job-listing', ['data' => $item, 'filter' => $request->all()]);
        } catch (\Exception $ex) {
            Log::error($ex);
            // Session::flash('error', 'Internal Server Error Occured, Please try again later...');

            return redirect()->back();
        }
    }


    public function pageRevert(Request $request, $id)
    {
        try {
            $revertPageData =  JobVacancyVersion::find($id);
            $oldPage = JobVacancy::find($revertPageData->vacancy_id);
            $page = JobVacancy::find($revertPageData->vacancy_id);
            $page->logo = $revertPageData->logo;
            $page->bi_lang = $revertPageData->bi_lang;
            $page->job_id = $revertPageData->job_id;
            $page->job_category = $revertPageData->job_category;
            $page->job_category_ar = $revertPageData->job_category_ar;
            $page->job_title = $revertPageData->job_title;
            $page->job_title_ar = $revertPageData->job_title_ar;
            $page->job_description = $revertPageData->job_description;
            $page->job_description_ar = $revertPageData->job_description_ar;
            $page->job_reqiurement = $revertPageData->job_reqiurement;
            $page->job_reqiurement_ar = $revertPageData->job_reqiurement_ar;
            $page->employment_type = $revertPageData->employment_type;
            $page->salary_package = $revertPageData->salary_package;
            $page->salary_package_ar = $revertPageData->salary_package_ar;
            $page->department = $revertPageData->department;
            $page->department_ar = $revertPageData->department_ar;
            $page->location = $revertPageData->location;
            $page->location_ar = $revertPageData->location_ar;
            $page->vacancy_closing_date = $revertPageData->vacancy_closing_date;
            $page->status = $revertPageData->status;
            if ($request->preview) {
                $html =  view('career_portal.job-detail_preview', ['data' => $page])->render();
                return redirect()->back()->with("preview_page", $html)->withInput();
            } else {
                if ($page->isDirty()) {
                    if ($page->save()) {
                        $tempPageData = $oldPage->toArray();
                        $tempPageData['vacancy_id'] = $tempPageData['id'];
                        $tempPageData['created_by'] = Auth::user()->id;
                        unset($tempPageData['id']);
                        unset($tempPageData['created_at']);
                        unset($tempPageData['applied_count']);
                        $vcData = new JobVacancyVersion($tempPageData + ['reverted' => 1]);
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
        return redirect('/career-portal/admin/vacancy');
    }

    public function history($id)
    {
        try {
            //code...
            $data = JobVacancyVersion::where('vacancy_id', $id)->orderBy('id', 'DESC');
            $data = $data->paginate(10);
            return view('career_portal.admin.history', compact('data'))->with('i', 1);
        } catch (Exception $ex) {
            Log::error($ex);
            Session::flash('error', 'internal server error');
            return redirect('/career-portal/admin/vacancy');
        }
    }
}
