<?php

namespace App\Http\Controllers\CareerPortal;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\UtilTrait;
use App\JobVacancyCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Session;


class VacancyCategoryController extends Controller
{
//    public function adminFetchAll()
//    {
//        try {
//
//            $data = JobVacancyCategory::orderBy('job_category', 'asc')
//                ->get();
//            Session::flash('success', 'Successfully retrieved vacancy categories');
//            return view('career_portal.admin.vacany_category', ['data' => $data]);
//
//        } catch (\Exception $ex) {
//            Session::flash('error', 'Failed to retrieve vacancy categories');
//            return redirect()->back()->withInput();
//        }
//    }

    public function adminCreateOrUpdateVacancyCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'sometimes',
            'job_category' => 'sometimes',
            'job_category_ar' => 'sometimes',
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Failed to update Vacancy Categories');
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }

        try {

            $vacancyCategory = JobVacancyCategory::updateOrCreate([
                'id' => $request->id,
            ], [
                'job_category' => $request->job_category,
                'job_category_ar' => $request->job_category_ar,
            ]);

            //  $this->created_at == $this->updated_at    if new record else its a record that been updated

            if (!$vacancyCategory) {
                Session::flash('error', 'Failed to update Vacancy Categories');
                return redirect()->back()->withInput();
            }

            Session::flash('success', 'Successfully updated vacancy categories');
            return redirect()->route('career-portal.admin.vacancy.category.view');

        } catch (\Exception $ex) {
        //    dd($ex->getMessage());
            Session::flash('error', 'Internal Exception Occured :'.$ex->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function viewUpdateVacancyCategory($id)
    {
        try {
            if (!$id) {
                Session::flash('error', 'Failed to get Vacancy Category');
                return redirect()->back();
            }

            $vacancyCategory = JobVacancyCategory::find($id);

            if (!$vacancyCategory) {
                // Session::flash('error', 'Successfully retrieved Vacancy Category');
                Session::flash('error', 'Failed to get Vacancy Category');

                return redirect(url()->previous().'#mediaContentForm');
            }

            $data = JobVacancyCategory::orderBy('created_at', 'desc')->get();

            // Session::flash('success', 'Successfully get the Media Content');
            return view('career_portal.admin.vacancy_category', ['update' => $vacancyCategory, 'data' => $data]);

        } catch (\Exception $ex) {
            // dd($ex->getMessage());
            Session::flash('error', 'Internal Exception Occured');
            return redirect()->back()->withInput();
        }

    }

    public function deleteVacancyCategory($id)
    {
        try {
            if (!$id) {
                Session::flash('error', 'Failed to delete the Vacancy Category');
                return redirect()->back();
            }

            $vacancyCategory = JobVacancyCategory::find($id);

            if (!$vacancyCategory) {
                Session::flash('error', 'Failed to delete the Vacancy Category');
                return redirect()->back();
            }

            $delete = $vacancyCategory->delete();

            if ($delete) {
                Session::flash('success', 'Successfully deleted the Vacancy Category');
            } else {
                Session::flash('error', 'Failed to delete the Vacancy Category');
            }

            return redirect()->route('career-portal.admin.vacancy.category.view');

        } catch (\Exception $ex) {

            Session::flash('error', 'Internal Exception Occured');
            return redirect()->back()->withInput();

        }
    }

    public function updateVacancyCategoryStatus($id, $status)
    {
        try {

            if (!$id) {
                Session::flash('error', 'Failed to update Vacancy Category Status');
                return redirect()->back();
            }

            $vacancyCategory = JobVacancyCategory::find($id);
            if (!$vacancyCategory) {
                Session::flash('error', 'Failed to update Vacancy Category Status');
                return redirect()->back();
            }

            $update = $vacancyCategory->update([
                'status' => $status
            ]);

            if ($update) {
                Session::flash('success', 'Successfully updated Status of Vacancy Category');
            } else {
                Session::flash('error', 'Failed to update Vacancy Category Status');
            }

            return redirect()->route('career-portal.admin.vacancy.category.view');

        } catch (\Exception $ex) {

            Session::flash('error', 'Internal Exception Occured');
            return redirect()->back()->withInput();

        }
    }
}