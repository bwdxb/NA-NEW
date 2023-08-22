<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\SmsTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class UtilController extends Controller
{
    use SmsTrait;
    public function optimize()
    {
        try {
            $prev_u = '';
            if (url()->previous()) {
                $prev_u = url()->previous();
            }
            Artisan::call('optimize:clear');
            if (!empty($prev_u)) {
                return redirect($prev_u);
            }
            return redirect('/');
        } catch (Exception $e) {
            Log::error(date("Y-m-d H:i:s"));
            Log::error('---------------------exception start--------------------------------');
            Log::error('exception message : ' . $e->getMessage());
            Log::error('exception in : ' . $e->getFile());
            Log::error('exception line no. : ' . $e->getLine());
            Log::error('exception trace : ' . json_encode($e->getTrace()));
            Log::error('----------------------exception end--------------------------------');
            return back()->with('error', 'Internal Server Error Occured, Please try again later...');
        }
    }

    public function cacheClear()
    {
        try {
            $prev_u = '';
            if (url()->previous()) {
                $prev_u = url()->previous();
            }
            Artisan::call('cache:clear');
            Artisan::call('route:cache');
            if (!empty($prev_u)) {
                return redirect($prev_u);
            }
            return redirect('/');
        } catch (Exception $e) {
            Log::error(date("Y-m-d H:i:s"));
            Log::error('---------------------exception start--------------------------------');
            Log::error('exception message : ' . $e->getMessage());
            Log::error('exception in : ' . $e->getFile());
            Log::error('exception line no. : ' . $e->getLine());
            Log::error('exception trace : ' . json_encode($e->getTrace()));
            Log::error('----------------------exception end--------------------------------');
            return back()->with('error', 'Internal Server Error Occured, Please try again later...');
        }
    }

    public function configClear()
    {
        try {
            $prev_u = '';
            if (url()->previous()) {
                $prev_u = url()->previous();
            }
            Artisan::call('config:clear');
            if (!empty($prev_u)) {
                return redirect($prev_u);
            }
            return redirect('/');
        } catch (Exception $e) {
            Log::error(date("Y-m-d H:i:s"));
            Log::error('---------------------exception start--------------------------------');
            Log::error('exception message : ' . $e->getMessage());
            Log::error('exception in : ' . $e->getFile());
            Log::error('exception line no. : ' . $e->getLine());
            Log::error('exception trace : ' . json_encode($e->getTrace()));
            Log::error('----------------------exception end--------------------------------');
            return back()->with('error', 'Internal Server Error Occured, Please try again later...');
        }
    }

    public function configCache()
    {
        try {
            $prev_u = '';
            if (url()->previous()) {
                $prev_u = url()->previous();
            }
            Artisan::call('config:cache');
            if (!empty($prev_u)) {
                return redirect($prev_u);
            }
            return redirect('/');
        } catch (Exception $e) {
            Log::error(date("Y-m-d H:i:s"));
            Log::error('---------------------exception start--------------------------------');
            Log::error('exception message : ' . $e->getMessage());
            Log::error('exception in : ' . $e->getFile());
            Log::error('exception line no. : ' . $e->getLine());
            Log::error('exception trace : ' . json_encode($e->getTrace()));
            Log::error('----------------------exception end--------------------------------');
            return back()->with('error', 'Internal Server Error Occured, Please try again later...');
        }
    }

    public function routeCache()
    {
        try {
            $prev_u = '';
            if (url()->previous()) {
                $prev_u = url()->previous();
            }
            Artisan::call('route:cache');
            if (!empty($prev_u)) {
                return redirect($prev_u);
            }
            return redirect('/');
        } catch (Exception $e) {
            Log::error(date("Y-m-d H:i:s"));
            Log::error('---------------------exception start--------------------------------');
            Log::error('exception message : ' . $e->getMessage());
            Log::error('exception in : ' . $e->getFile());
            Log::error('exception line no. : ' . $e->getLine());
            Log::error('exception trace : ' . json_encode($e->getTrace()));
            Log::error('----------------------exception end--------------------------------');
            return back()->with('error', 'Internal Server Error Occured, Please try again later...');
        }
    }

    public function makeConsole($command='AdvertsScheduler')
    {
        try {
            $prev_u = '';
            if (url()->previous()) {
                $prev_u = url()->previous();
            }

            // dd($command);
            Artisan::call('make:command',[$command]);
            if (!empty($prev_u)) {
                return redirect($prev_u);
            }
            return redirect('/');
        } catch (Exception $e) {
            Log::error(date("Y-m-d H:i:s"));
            Log::error('---------------------exception start--------------------------------');
            Log::error('exception message : ' . $e->getMessage());
            Log::error('exception in : ' . $e->getFile());
            Log::error('exception line no. : ' . $e->getLine());
            Log::error('exception trace : ' . json_encode($e->getTrace()));
            Log::error('----------------------exception end--------------------------------');
            return back()->with('error', 'Internal Server Error Occured, Please try again later...');
        }
    }

    public function scheduleAdvert()
    {
        try {
            $prev_u = '';
            if (url()->previous()) {
                $prev_u = url()->previous();
            }

            // dd($command);
            Artisan::call('schedule:advert');
            if (!empty($prev_u)) {
                return redirect($prev_u);
            }
            return redirect('/');
        } catch (Exception $e) {
            Log::error(date("Y-m-d H:i:s"));
            Log::error('---------------------exception start--------------------------------');
            Log::error('exception message : ' . $e->getMessage());
            Log::error('exception in : ' . $e->getFile());
            Log::error('exception line no. : ' . $e->getLine());
            Log::error('exception trace : ' . json_encode($e->getTrace()));
            Log::error('----------------------exception end--------------------------------');
            return back()->with('error', 'Internal Server Error Occured, Please try again later...');
        }
    }

    public function checkMessenger()
    {
        try {
            $messenger_status = $this->feedback_messenger('8129088240', 'test message');
            dd($messenger_status);
        } catch (Exception $e) {
            Log::error(date("Y-m-d H:i:s"));
            Log::error('---------------------exception start--------------------------------');
            Log::error('exception message : ' . $e->getMessage());
            Log::error('exception in : ' . $e->getFile());
            Log::error('exception line no. : ' . $e->getLine());
            Log::error('exception trace : ' . json_encode($e->getTrace()));
            Log::error('----------------------exception end--------------------------------');
            return back()->with('error', 'Internal Server Error Occured, Please try again later...');
        }
    }
}
