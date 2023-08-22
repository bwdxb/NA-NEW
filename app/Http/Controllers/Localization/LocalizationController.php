<?php

namespace App\Http\Controllers\Localization;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;


class LocalizationController extends Controller
{

    public function setLocalization($locale)
    {
        try {
            \Session::put('locale', $locale);

        } catch (\Exception $ex) {

        } finally{
            return redirect()->back();
        }

    }
    public function setLocalizationForVacancyList()
    {
        try {
            \Session::put('locale', 'en');
            // \Session::put('locale', $locale);

        } catch (\Exception $ex) {

        } finally{
            return redirect()->route('career-portal.user.vacancy.view.all');
        }

    }


}