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

Route::group([
    'prefix' => 'employee-portal',
    'as' => 'employee-portal.',
    'namespace' => 'Auth',
], function () {

    // METHOD: GET
    // ROUTE: employee-portal.login
    // URL: http://127.0.0.1:8080/employee-portal/login
    Route::view('/login','employee_portal.login')->name('login');
    // METHOD: POST
    // ROUTE: employee-portal.auth
    // URL: http://127.0.0.1:8080/employee-portal/login
    Route::post('/login','LoginController@employeelogin')->name('auth');

});
Route::group([
    'prefix' => 'employee-portal',
    'as' => 'employee-portal.',
], function () {
    Route::get('/logout', 'IndexController@webLogout');
});

Route::group([
    'prefix' => 'employee-portal',
    'namespace' => 'EmployeePortal',
    'as' => 'employee-portal.',
], function () {
    Route::group([
        'middleware' => ['e-auth'],
    ], function () {
        // METHOD: GET
        // ROUTE: employee-portal.home
        // URL: http://127.0.0.1:8080/employee-portal/home
        Route::get('/home', 'DashboardController@index')->name('home');
        Route::view('/notifications', 'employee_portal.notification')->name('notifications');
        Route::get('/notifications/{id}', 'NotificationController@seenBy')->name('notifications.seen');
    });

    Route::group([
        'prefix' => 'market-place',
        'as' => 'market-place.',
    ], function () {

      

        Route::group([
            'middleware' => ['e-auth'],
        ], function () {

            // METHOD: GET
            // ROUTE: employee-portal.market-place.view
            // URL: http://127.0.0.1:8080/employee-portal/market-place
            Route::view('/', 'employee_portal.market_place')->name('view');

            // METHOD: POST
            // ROUTE: employee-portal.market-place.create
            // URL: http://127.0.0.1:8080/employee-portal/market-place
            Route::post('/', 'MarketPlaceController@create')->name('create');
            Route::get('/{id}', 'MarketPlaceController@showInterest')->name('show-interest');

            // METHOD: POST
            // ROUTE: employee-portal.market-place.update
            // URL: http://127.0.0.1:8080/employee-portal/market-place/update
            Route::post('/update', 'MarketPlaceController@update')->name('update');

            // METHOD: GET
            // ROUTE: employee-portal.market-place.delete
            // URL: http://127.0.0.1:8080/employee-portal/market-place/delete/{id}-{title?}
            Route::get('/delete/{id}-{title?}', 'MarketPlaceController@delete')->name('delete');

            // METHOD: GET
            // ROUTE: employee-portal.market-place.fetch
            // URL: http://127.0.0.1:8080/employee-portal/market-place/fetch/{id}-{title?}
            Route::get('/fetch/{id}-{title?}', 'MarketPlaceController@fetch')->name('fetch');

            // METHOD: GET
            // ROUTE: employee-portal.market-place.cart.add
            //@todo
            // URL: http://127.0.0.1:8080/employee-portal/market-place/add-{id}-{title?}-to-market-cart
            Route::get('/add-{id}-{title?}-to-market-cart/', 'MarketPlaceController@addToMarketCart')->name('cart.add');

        });

    });
    Route::group([
        'middleware' => ['e-auth'],
        'prefix' => 'todo',
        'as' => 'todo.',
    ], function () {

        // METHOD: GET
        // ROUTE: employee-portal.todo.fetch
        // URL: http://127.0.0.1:8080/employee-portal/todo
        Route::get('/', 'TodoController@fetch')->name('fetch');

        // METHOD: GET
        // ROUTE: employee-portal.todo.fetch.all
        // URL: http://127.0.0.1:8080/employee-portal/todo/all
        Route::get('/all', 'TodoController@fetchAll')->name('fetch.all');

        // METHOD: POST
        // ROUTE: employee-portal.todo.create
        // URL: http://127.0.0.1:8080/employee-portal/todo
        Route::post('/', 'TodoController@create')->name('create');

        // METHOD: GET
        // ROUTE: employee-portal.todo.view-all
        // URL: http://127.0.0.1:8080/employee-portal/todo/view-all
        Route::view('/view-all', 'employee_portal.todos')->name('view-all');

        // METHOD: PUT
        // ROUTE: employee-portal.todo.update
        // URL: http://127.0.0.1:8080/employee-portal/todo/update/{id}
        Route::get('/update/{id}', 'TodoController@update')->name('update');

        // METHOD: GET
        // ROUTE: employee-portal.todo.delete
        // URL: http://127.0.0.1:8080/employee-portal/todo/delete
        Route::get('/delete/{id}', 'TodoController@delete')->name('delete');
    });

    Route::group([
        'prefix' => 'story',
        'as' => 'story.',
    ], function () {

        Route::group([
            'middleware' => ['e-auth'],
        ], function () {

            // METHOD: GET
            // ROUTE: employee-portal.story.view
            // URL: http://127.0.0.1:8080/employee-portal/story
            Route::get('/', 'StoryController@fetch')->name('view');

            // METHOD: POST
            // ROUTE: employee-portal.story.create
            // URL: http://127.0.0.1:8080/employee-portal/story
            Route::post('/', 'StoryController@create')->name('create')->middleware('OptimizeImage');

            // METHOD: GET
            // ROUTE: employee-portal.story.update
            // URL: http://127.0.0.1:8080/employee-portal/story/update/{id}
            Route::get('/update/{id}', 'StoryController@update')->name('update');

            // METHOD: GET
            // ROUTE: employee-portal.story.delete
            // URL: http://127.0.0.1:8080/employee-portal/story/delete{id}
            Route::get('/delete/{id}', 'StoryController@delete')->name('delete');

            // METHOD: GET
            // ROUTE: employee-portal.story.attribute.update
            // URL: http://127.0.0.1:8080/employee-portal/story/{attribute?}-update-{id}
            Route::get('/{attribute?}-update-{id}', 'StoryController@updateStoryAttribute')
            ->where('attribute', 'status|like_count|dislike_count|view_count')
            ->name('attribute.update');

            // METHOD: POST
            // ROUTE: employee-portal.story.filter
            // URL: http://127.0.0.1:8080/employee-portal/story/filter
            Route::post('/filter', 'StoryController@filter')->name('filter');

        });

      

        Route::group([
            // 'middleware' => ['a-auth'],
            'prefix' => 'category',
            'as' => 'category.',
        ], function () {

//            // METHOD: GET
//            // ROUTE: employee-portal.story.category.view
//            // URL: http://127.0.0.1:8080/employee-portal/story/category
//            @todo
//            Route::get('/', 'StoryController@getAllStoryCategory')->name('view');

            // METHOD: GET
            // ROUTE: employee-portal.story.category.create-update
            // URL: http://127.0.0.1:8080/employee-portal/story/category
            Route::post('/', 'StoryController@createOrUpdateStoryCategory')->name('create-update');

            // METHOD: GET
            // ROUTE: employee-portal.story.category.delete
            // URL: http://127.0.0.1:8080/employee-portal/story/category/delete/{id}
            Route::get('delete/{id}', 'StoryController@deleteStoryCategory')->name('delete');
        });
    });


    Route::group([
        'prefix' => 'document-library',
        'as' => 'document-library.',
    ], function () {

        Route::group([
            // 'middleware' => ['a-auth'],
        ], function () {

            // METHOD: GET
            // ROUTE: employee-portal.document-library.admin..view
            // URL: http://127.0.0.1:8080/employee-portal/document-library/admin
            Route::get('admin/', 'DocumentLibraryController@adminView')->name('admin.view');

            // METHOD: POST
            // ROUTE: employee-portal.document-library.create
            // URL: http://127.0.0.1:8080/employee-portal/document-library
            Route::post('/', 'DocumentLibraryController@create')->name('create');

            // METHOD: GET
            // ROUTE: employee-portal.document-library.update
            // URL: http://127.0.0.1:8080/employee-portal/document-library/update/{id}
            Route::get('/update/{id}', 'DocumentLibraryController@update')->name('update');

            // METHOD: GET
            // ROUTE: employee-portal.document-library.delete
            // URL: http://127.0.0.1:8080/employee-portal/document-library/delete/{id}
            Route::get('/delete/{id}', 'DocumentLibraryController@delete')->name('delete');

            // METHOD: POST
            // ROUTE: employee-portal.document-library.adminfilter
            // URL: http://127.0.0.1:8080/employee-portal/document-library/filter/admin
            Route::post('/filter/admin', 'DocumentLibraryController@adminFilter')->name('adminfilter');

        });

        Route::group([
            'middleware' => ['e-auth'],
        ], function () {

            // METHOD: GET
            // ROUTE: employee-portal.document-library.view
            // URL: http://127.0.0.1:8080/employee-portal/document-library
            Route::get('/', 'DocumentLibraryController@fetch')->name('view');

            // METHOD: POST
            // ROUTE: employee-portal.document-library.filter
            // URL: http://127.0.0.1:8080/employee-portal/document-library/filter
            Route::post('/filter', 'DocumentLibraryController@filter')->name('filter');

        });

        // METHOD: GET
        // ROUTE: employee-portal.document-library.download
        // URL: http://127.0.0.1:8080/employee-portal/document-library/download
        Route::get('/download/{docId}', 'DocumentLibraryController@downloadDoc')->name('download');

    });
    Route::group([
            'prefix' => 'pmo-notice-board',
            'as' => 'pmo-notice-board.',
        ], function () {

        Route::group([
            // 'middleware' => ['a-auth'],
        ], function () {

            // METHOD: GET
            // ROUTE: employee-portal.pmo-notice-board.admin..view
            // URL: http://127.0.0.1:8080/employee-portal/pmo-notice-board/admin
            Route::get('admin/', 'PMONoticeBoardController@adminView')->name('admin.view');

            // METHOD: POST
            // ROUTE: employee-portal.pmo-notice-board.create
            // URL: http://127.0.0.1:8080/employee-portal/pmo-notice-board
            Route::post('/', 'PMONoticeBoardController@create')->name('create');

            // METHOD: GET
            // ROUTE: employee-portal.pmo-notice-board.update            
            Route::get('/view/{id}', 'PMONoticeBoardController@view')->name('view');

            // METHOD: GET
            // ROUTE: employee-portal.pmo-notice-board.delete
            // URL: http://127.0.0.1:8080/employee-portal/pmo-notice-board/delete/{id}
            Route::get('/delete/{id}', 'PMONoticeBoardController@delete')->name('delete');

            // METHOD: POST
            // ROUTE: employee-portal.pmo-notice-board.adminfilter
            // URL: http://127.0.0.1:8080/employee-portal/pmo-notice-board/filter/admin
            Route::post('/filter/admin', 'PMONoticeBoardController@adminFilter')->name('adminfilter');

        });

        Route::group([
            'middleware' => ['e-auth'],
        ], function () {

            // METHOD: GET
            // ROUTE: employee-portal.pmo-notice-board.view
            // URL: http://127.0.0.1:8080/employee-portal/pmo-notice-board
            Route::get('/', 'PMONoticeBoardController@fetch')->name('view');

            // METHOD: POST
            // ROUTE: employee-portal.pmo-notice-board.filter
            // URL: http://127.0.0.1:8080/employee-portal/pmo-notice-board/filter
            Route::post('/filter', 'PMONoticeBoardController@filter')->name('filter');

        });

        // METHOD: GET
        // ROUTE: employee-portal.pmo-notice-board.download
        // URL: http://127.0.0.1:8080/employee-portal/pmo-notice-board/download
        Route::get('/download/{docId}', 'PMONoticeBoardController@downloadDoc')->name('download');

    });
    Route::group([
        'prefix' => 'terms-and-conditions',
        'as' => 'terms-and-conditions.',
        'middleware' => ['e-auth'],
    ], function () {


        // METHOD: GET
        // ROUTE: employee-portal.team-salute.view
        // URL: http://127.0.0.1:8080/employee-portal/team-salute
        Route::get('/', 'TermAndConditionsController@index')->name('view');
    });

    Route::group([
        'prefix' => 'team-salute',
        'as' => 'team-salute.',
        'middleware' => ['e-auth'],
    ], function () {


        // METHOD: GET
        // ROUTE: employee-portal.team-salute.view
        // URL: http://127.0.0.1:8080/employee-portal/team-salute
        Route::get('/', 'TeamSaluteController@index')->name('view');

        // METHOD: POST
        // ROUTE: employee-portal.team-salute.create
        // URL: http://127.0.0.1:8080/employee-portal/team-salute
        Route::post('/', 'TeamSaluteController@create')->name('create');

        // METHOD: GET
        // ROUTE: employee-portal.team-salute.update
        // URL: http://127.0.0.1:8080/employee-portal/team-salute/update/{id}
        Route::get('/update/{id}', 'TeamSaluteController@update')->name('update');

        // METHOD: GET
        // ROUTE: employee-portal.team-salute.delete
        // URL: http://127.0.0.1:8080/employee-portal/team-salute/delete/{id}
        Route::get('/delete/{id}', 'TeamSaluteController@delete')->name('delete');

        // METHOD: POST
        // ROUTE: employee-portal.story.filter
        // URL: http://127.0.0.1:8080/employee-portal/team-salute/filter
        Route::post('/filter', 'TeamSaluteController@filter')->name('filter');

    });
    Route::group([
        'prefix' => 'internal-application',
        'as' => 'internal-application.',
    ], function () {

        Route::group([
            // 'middleware' => ['a-auth'],
        ], function () {

            // METHOD: GET
            // ROUTE: employee-portal.internal-application.admin_view
            // URL: http://127.0.0.1:8080/employee-portal/internal-application/admin
            // Route::get('/admin', 'InternalApplicationController@admin_view')->name('admin_view');

            // METHOD: POST
            // ROUTE: employee-portal.internal-application.create
            // URL: http://127.0.0.1:8080/employee-portal/internal-application
            Route::post('/', 'InternalApplicationController@create')->name('create');

            // METHOD: POST
            // ROUTE: employee-portal.internal-application.update-dashboard
            // URL: http://127.0.0.1:8080/employee-portal/internal-application
            Route::post('/update-dashboard', 'InternalApplicationController@updateDashboard')->name('update-dashboard');

            // METHOD: GET
            // ROUTE: employee-portal.internal-application.update
            // URL: http://127.0.0.1:8080/employee-portal/internal-application/update/{id}
            Route::get('/update/{id}', 'InternalApplicationController@update')->name('update');

            // METHOD: GET
            // ROUTE: employee-portal.internal-application.delete
            // URL: http://127.0.0.1:8080/employee-portal/internal-application/delete/{id}
            Route::get('/delete/{id}', 'InternalApplicationController@delete')->name('delete');

        });

        Route::group([
            'middleware' => ['e-auth'],
        ], function () {

            // METHOD: GET
            // ROUTE: employee-portal.internal-application.view
            // URL: http://127.0.0.1:8080/employee-portal/internal-application
            Route::get('/', 'InternalApplicationController@index')->name('view');

        });

    });

    Route::group([
        'prefix' => 'heads-up',
        'as' => 'heads-up.',
    ], function () {


        Route::group([
            'middleware' => ['e-auth'],
        ], function () {

            // METHOD: GET
            // ROUTE: employee-portal.heads-up.view
            // URL: http://127.0.0.1:8080/employee-portal/heads-up/
            Route::get('/', 'HeadsUpController@fetch')->name('view');

            // METHOD: GET
            // ROUTE: employee-portal.heads-up.attribute.update
            // URL: http://127.0.0.1:8080/employee-portal/heads-up/{attribute?}-update-{id}
            // Route::get('/{attribute?}-update-{id}', 'HeadsUpController@updateHeadsupAttribute')
            // ->where('attribute', 'status|view_count')
            // ->name('attribute.update');

            // METHOD: POST
            // ROUTE: employee-portal.heads-up.filter
            // URL: http://127.0.0.1:8080/employee-portal/heads-up/filter
            Route::post('/filter', 'HeadsUpController@filter')->name('filter');

        });

    });

});

// 404 for undefined routes
// Route::any('/{page?}', function () {
//     return View::make('pages.error-pages.error-404');
// })->where('page', '.*');
