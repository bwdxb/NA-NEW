<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix'=>LaravelLocalization::setLocale(),'middleware' => [ 'locale','localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],function(){






Route::group([
    'prefix' => 'career-portal',
    'namespace' => 'CareerPortal',
    'as' => 'career-portal.',
], function () {

   

    // METHOD: GET
    // ROUTE: locale.test
    // URL: http://127.0.0.1:8080/career-portal/1

    Route::get('', function(){
        return redirect()->route('career-domain-index');
    })->name('index');
    // Route::get('', 'CareerController@index')->name('index');
    // URL: http://127.0.0.1:8080/career-portal/2
    Route::view('2', 'career_portal.job-apply-form');

    // URL: http://127.0.0.1:8080/career-portal/3
    Route::view('3', 'career_portal.job-detail');

    // URL: http://127.0.0.1:8080/career-portal/4
    Route::view('4', 'career_portal.job-listing');

  

    Route::group([
        'prefix' => 'user/vacancy',
        'as' => 'user.vacancy.',
    ], function () {

        // METHOD: GET
        // ROUTE: career-portal.user.vacancy.view.all
        // URL: http://127.0.0.1:8080/career-portal/user/vacancy/
        Route::domain(env('SUB_DOMAIN_CAREERS','career.na.bw.ae'))->group(function () {

        Route::get('/', 'VacancyController@viewUserVacancies')->name('view.all');
    });
    Route::get('/filter', 'VacancyController@vacancyListFilter')->name('view.filter');

        // METHOD: GET
        // ROUTE: career-portal.user.vacancy.filter.view
        // URL: http://127.0.0.1:8080/career-portal/user/vacancy/filter
        Route::post('/filter', 'VacancyController@viewUpdateVacancy')->name('filter.view');

        // METHOD: GET
        // ROUTE: career-portal.user.vacancy.details.view
        // URL: http://127.0.0.1:8080/career-portal/user/vacancy/view/{id}
        Route::get('/view/{id}', 'VacancyController@userViewVacancyDetails')->name('details.view');

               // METHOD: GET
        // ROUTE: career-portal.user.vacancy.apply
        // URL: http://127.0.0.1:8080/career-portal/user/vacancy/apply/{id}
        Route::get('/apply/{id}', 'VacancyController@userApplyVacancyForm')->name('apply');

        // METHOD: POST
        // ROUTE: career-portal.user.vacancy.apply
        // URL: http://127.0.0.1:8080/career-portal/user/vacancy/apply
        Route::post('/apply', 'VacancyController@userApplyJobVacancy')->name('create');
      
    });

    Route::group([
        'prefix' => 'subscription',
        'as' => 'subscription.',
    ], function () {
        // METHOD: GET
        // ROUTE: career-portal.user.vacancy.filter.view
        // URL: http://127.0.0.1:8080/career-portal/user/vacancy/filter
        Route::post('/', 'SubscriptionController@addSubscriber')->name('create');
        Route::get('/unsubscribe', 'SubscriptionController@unsubscribe')->name('unsubscribe');
        Route::get('/verify', 'SubscriptionController@verifySubscription')->name('verify');
    });
    Route::group([
        'prefix' => 'general',
        'as' => 'general.',
    ], function () {
        // METHOD: GET
        // ROUTE: career-portal.user.vacancy.filter.view
        // URL: http://127.0.0.1:8080/career-portal/user/vacancy/filter
        Route::post('/', 'GeneralCvController@create')->name('create');
        // Route::get('/unsubscribe', 'GeneralCvController@unsubscribe')->name('unsubscribe');
    });


    // METHOD: GET
    // ROUTE: career-portal.document-library.download
    // URL: http://127.0.0.1:8080/career-portal/document-library/download
    Route::get('/download/{docId}', 'DocumentLibraryController@downloadDoc')->name('download');

});

// // 404 for undefined routes
// Route::any('/{page?}', function () {
//     return View::make('pages.error-pages.error-404');
// })->where('page', '.*');
});