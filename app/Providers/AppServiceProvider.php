<?php

namespace App\Providers;

use App\MarketItemImages;
use App\MarketPlace;
use App\Story;
use App\StoryCategory;
use App\Testimonials;
use App\Config;
use App\User;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Log;
use App\JobVacancy;
use App\JobVacancyCategory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        error_reporting(E_ALL ^ E_NOTICE);
        
        if(env('APP_ENV', false) === 'production') {
            \URL::forceScheme('https');
        }
       
        // DB::listen(function ($query) {
        //     Log::info(
        //         $query->sql,
        //         $query->bindings,
        //         $query->time
        //     );
        // });

        $this->templateServices();

        // $this->app['validator']->extend('numericarray', function ($attribute, $value, $parameters)
        // {
        //     foreach ($value as $v) {
        //         if (!is_int($v)) {
        //             return false;
        //         }
        //     }
        //     return true;
        // });
    }

    public function templateServices()
    {
//        View::composer('employee_portal.dashboard', function ($view) {
//            $todos = Todo::where('employee_id', 1)
//            ->whereDate('created_at', Carbon::today())
//            ->groupby('date', 'time')
//            ->orderBy('date', 'asc')
//            ->get();
//
//            $view->with('todos', $todos);
//        });

        View::composer('employee_portal.admin_story_review', function ($view) {
            $data = Story::where('status', 'pending')
            ->groupby('updated_at', 'status', 'created_at')
            ->orderBy('created_at', 'asc')
            ->get();

            foreach ($data as $d) {
                $d->created_by = User::find($d->created_by);
            }
            $view->with('data', $data);
        });

        View::composer('employee_portal.market_place', function ($view) {
            $data = MarketPlace::where('status','ACCEPT')->orWhere('created_by',Auth::id())->orderBy('created_at', 'desc')->paginate(8);
            foreach ($data as $d) {
                $marketItemDefaultCoverImage = 'https://via.placeholder.com/150?text=No%20Image';

                $marketItemDefaultCoverImageModel = MarketItemImages::where('market_item_id', $d->id)->get()->first();
                if ($marketItemDefaultCoverImageModel) {
                    $marketItemDefaultCoverImage = $marketItemDefaultCoverImageModel->file_url;
                }

                if ($d->photo) {
                    $MarketItemCoverImage = MarketItemImages::find($d->photo);
                    // dd([
                    //     'market product' => $d,
                    //     'cover image id' => $d->photo,
                    //     'cover image model' => $MarketItemCoverImage,
                    // ]);
                    if ($MarketItemCoverImage) {
                        $d->photo = $MarketItemCoverImage->file_url;
                    } else {
                        $d->photo = $marketItemDefaultCoverImage;
                    }
                } else {
                    $d->photo = $marketItemDefaultCoverImage;
                }


                //     $d->img = $d->itemImages();
            }
            $view->with('data', $data);
        });

        View::composer('employee_portal.admin_market_place', function ($view) {
            $data = MarketPlace::orderBy('created_at', 'desc')
            ->where('status', 'pending')
            ->get();
//                ->paginate(8);
            foreach ($data as $d) {
                $marketItemDefaultCoverImage = 'https://via.placeholder.com/150?text=No%20Image';

                $marketItemDefaultCoverImageModel = MarketItemImages::where('market_item_id', $d->id)->get()->first();
                if ($marketItemDefaultCoverImageModel) {
                    $marketItemDefaultCoverImage = $marketItemDefaultCoverImageModel->file_url;
                }

                if ($d->photo) {
                    $MarketItemCoverImage = MarketItemImages::find($d->photo);
                    // dd([
                    //     'market product' => $d,
                    //     'cover image id' => $d->photo,
                    //     'cover image model' => $MarketItemCoverImage,
                    // ]);
                    if ($MarketItemCoverImage) {
                        $d->photo = $MarketItemCoverImage->file_url;
                    } else {
                        $d->photo = $marketItemDefaultCoverImage;
                    }
                } else {
                    $d->photo = $marketItemDefaultCoverImage;
                }


                //     $d->img = $d->itemImages();
            }
            $view->with('data', $data);
        });

        View::composer('employee_portal.story_board', function ($view) {
            // $data = StoryCategory::orderBy('category', 'asc')->get();
            // $view->with('category', $data);
        });

        View::composer('employee_portal.heads_up', function ($view) {
            // $data = HeadsUp::orderBy('created_at', 'desc')->paginate(8);
            // $view->with('data', $data);
        });

        View::composer('employee_portal.team_salute', function ($view) {
            $data = User::orderBy('first_name', 'asc')->get();

            // dd([
            //    'data'=> $data,
            //    'json data'=> $data->toJson(),
            // ]);
            $view->with('users', $data);
            // $view->with('users', $data->toJson());
        });

        View::composer(['website.includes.pts_registration', 'website.includes.events_ambulance_coverage_form'], function ($view) {
            $data = Testimonials::orderBy('client_name', 'asc')->get();

            // dd([
            //    'data'=> $data,
            //    'json data'=> $data->toJson(),
            // ]);
            $view->with('testimonials', $data);
            // $view->with('users', $data->toJson());
        });

        View::composer('career_portal.admin.vacancy_category', function ($view) {
            $data = JobVacancyCategory::orderBy('job_category', 'asc')->get();
            $config=Config::where('type',"CAREER_STATUS_BUTTON")->first();
            $view->with('data', $data)->with('config',$config);
        });

        View::composer('career_portal.admin.vacancy', function ($view) {
            $data = JobVacancy::orderBy('updated_at', 'desc')->get();
            $categories = JobVacancyCategory::orderBy('job_category', 'asc')->where('status', 'active')->get();
            $view->with('data', $data);
            $config=Config::where('type',"CAREER_STATUS_BUTTON")->first();

            $view->with('categories', $categories)->with('config',$config);;
        });

        View::composer(['profile.display','profile.reset'], function ($view) {
            $user = Auth::user();
            // dd($user);
            $data = User::find($user->id);
            $view->with('data', $data);
        });

    }
}
