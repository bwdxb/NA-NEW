<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
class HomeController extends Controller
{
    public function index(Request $request)
    {
        //echo "hiii";die;
        return view('home');
        // return redirect('/profile');
    }

    public function myCaptcha()
    {
        return view('myCaptcha');
    }

    public function myCaptchaPost(Request $request)
    {

        request()->validate([

            'email' => 'required|email',

            'password' => 'required',

            'captcha' => 'required|captcha'

        ],

        ['captcha.captcha'=>'Invalid captcha code.']);

        // dd("You are here :) .");

    }
    public function refreshCaptcha()

    {

        return response()->json(['captcha'=> captcha_img()]);

    }
}
