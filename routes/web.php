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

Auth::routes();
Route::get('/json', 'JsonController@index')->middleware('OptimizeImage');
Route::get('/launch/reset', 'LaunchController@reset')->name('launch.reset');
Route::get('/launch', 'LaunchController@launch')->name('launch.launch');
Route::group(['middleware' => ['preventBackHistory', 'admin-auth'],'prefix' => 'admin'], function () {
    Route::group([
        'prefix' => 'employee-portal',
        'namespace' => 'EmployeePortal',
        'as' => 'employee-portal.',
    ], function () {
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
                Route::get('/admin', 'InternalApplicationController@admin_view')->name('admin_view');
    
    
            });
    
           
    
        });
            Route::group([
                // 'prefix' => 'market-place',
                // 'as' => 'market-place.',
            ], function () {

                Route::group([
                    // 'middleware' => ['a-auth'],
                ], function () {

                    // METHOD: GET
                    // ROUTE: employee-portal.market-place.view.admin
                    // URL: http://127.0.0.1:8080/employee-portal/market-place/admin
                    Route::view('/market-place/admin', 'employee_portal.admin_market_place')->name('market-place.view.admin');
                    Route::get('/market-place/admin/list', 'MarketPlaceController@adminFetch')->name('market-place.view.admin.list');
                    Route::get('/market-place/admin/delete/{id}', 'MarketPlaceController@adminDelete')->name('market-place.view.admin.delete');

                    // METHOD: GET
                    // ROUTE: employee-portal.market-place.update.details
                    // URL: http://127.0.0.1:8080/employee-portal/market-place/update/details
                    Route::get('/market-place/admin-status', 'MarketPlaceController@adminChangeStatus')->name('market-place.update_status');

                });
                });


                Route::group([
                    'prefix' => 'story',
                    'as' => 'story.',
                ], function () {
                Route::group([
                    // 'middleware' => ['a-auth'],
                ], function () {
        
                    // METHOD: GET
                    // ROUTE: employee-portal.story.view.admin
                    // URL: http://127.0.0.1:8080/employee-portal/story/admin
                    Route::view('/admin', 'employee_portal.admin_story_review')->name('view.admin');
                    Route::get('/admin/list', 'StoryController@adminFetch')->name('view.admin.list');
                    Route::get('/admin/delete/{id}', 'StoryController@adminDelete')->name('admin.delete');
        
                    // METHOD: GET
                    // ROUTE: employee-portal.story.update_status
                    // URL: http://127.0.0.1:8080/employee-portal/story/admin-status
                    Route::get('/admin-status', 'StoryController@adminChangeStatus')->name('update_status');
        
                });
                });
                Route::group([
                    'prefix' => 'team-salute',
                    'as' => 'team-salute.',
                ], function () {
                Route::group([
                    // 'middleware' => ['a-auth'],
                ], function () {
        
                    // METHOD: GET
                    // ROUTE: employee-portal.story.view.admin
                    // URL: http://127.0.0.1:8080/employee-portal/story/admin
                    Route::get('/admin/list', 'TeamSaluteController@adminFetch')->name('admin.list');
                    Route::get('/admin/delete/{id}', 'TeamSaluteController@adminDelete')->name('admin.delete');
        
                });
                });



                Route::group([
                    'prefix' => 'heads-up',
                    'as' => 'heads-up.',
                ], function () {
            
                    Route::group([
                        // 'middleware' => ['a-auth'],
                    ], function () {
            
                        // METHOD: GET
                        // ROUTE: employee-portal.heads-up.admin_view
                        // URL: http://127.0.0.1:8080/employee-portal/heads-up/admin
                        Route::get('/admin', 'HeadsUpController@adminfetch')->name('admin_view');
            
                        // METHOD: POST
                        // ROUTE: employee-portal.heads-up.adminfilter
                        // URL: http://127.0.0.1:8080/employee-portal/heads-up/admin/filter
                        Route::post('/admin/filter', 'HeadsUpController@adminfilter')->name('adminfilter');
                        Route::post('/', 'HeadsUpController@create')->name('create');

                        // METHOD: GET
                        // ROUTE: employee-portal.heads-up.update
                        // URL: http://127.0.0.1:8080/employee-portal/heads-up
                        Route::get('/update/{id}', 'HeadsUpController@update')->name('update');
            
                        // METHOD: GET
                        // ROUTE: employee-portal.heads-up.delete
                        // URL: http://127.0.0.1:8080/employee-portal/heads-up
                        Route::get('/delete/{id}', 'HeadsUpController@delete')->name('delete');
                        Route::get('/{attribute?}-update-{id}', 'HeadsUpController@updateHeadsupAttribute')
            ->where('attribute', 'status|view_count')
            ->name('attribute.update');

                    });
                });
        });
        
    


    Route::get('/home', 'HomeController@index')->name('home');
  

    Route::resource('/manage-roles', 'AdminsController');
    Route::resource('/roles', 'RolesController');
    Route::post('/save_role', 'RolesController@save_role');
    Route::post('/save_user_roles', 'RolesController@save_user_roles');
    Route::get('/role/status/{id}', 'RolesController@status');

    Route::get('/add-permission', 'AdminsController@add_permission');
    Route::get('/manage-permission', 'AdminsController@manage_permission');
    Route::get('/edit-permission', 'AdminsController@edit_permission');

    Route::post('/update_screens', 'ScreensController@update_screens');
    Route::post('/save_screens', 'ScreensController@save_screens');
    Route::resource('/manage-screen', 'ScreensController');
    Route::get('/screen/create', 'ScreensController@create')->name('screen.create');
    Route::post('/screen/store', 'ScreensController@store')->name('screen.store');
    Route::get('/screen/show/{id}', 'ScreensController@show');

    Route::resource('/user', 'UsersController');
    Route::get('/user/create', 'UsersController@create')->name('user.create');
    Route::post('/user/store', 'UsersController@store')->name('user.store');
    Route::get('/user/edit/{id}', 'UsersController@edit');
    Route::get('/user/delete/{id}', 'UsersController@delete')->name('user.delete');
    Route::get('/user/softdelete/{id}', 'UsersController@softdelete')->name('user.softdelete');
    Route::get('/user/status/{id}', 'UsersController@status');
    // Route::post('/user/filter', 'UsersController@filter')->name('user.filter');
    Route::post('/changepassword/{userId}', 'UsersController@changepassword')->name('changepssword');
    Route::post('/email-config', 'UsersController@emailConfig')->name('email-config');
    Route::get('/email-config', 'UsersController@emailConfigView')->name('email-config.view');

    Route::resource('/staticpage', 'PageController');
    Route::get('/page', 'PageController@index')->name('page.index');
    Route::get('/page/create', 'PageController@create')->name('page.create');
    Route::post('/page/store', 'PageController@store')->name('page.store');
    Route::get('/page/edit/{id}', 'PageController@edit');
    Route::get('/page/delete/{id}', 'PageController@delete')->name('page.delete');
    Route::get('/page/status/{id}', 'PageController@status');
    Route::get('/revert/page/{id}', 'PageController@pageRevert')->name('revert.static_page');
    Route::get('/revert/{id}', 'PageController@history')->name('static_page.history');
    Route::get('/manage-menu', 'PageController@manage_menu');
    Route::post('getSubmenu', 'PageController@getSubmenu')->name('page.getSubmenu');

    Route::resource('/submenu', 'SubMenuController');
    Route::get('/submenu/create', 'SubMenuController@create')->name('submenu.create');
    Route::post('/submenu/store', 'SubMenuController@store')->name('submenu.store');
    Route::get('/submenu/edit/{id}', 'SubMenuController@edit');
    Route::get('/submenu/delete/{id}', 'SubMenuController@delete')->name('submenu.delete');
    Route::get('/submenu/status/{id}', 'SubMenuController@status');
    Route::get('/submenu/revert/{id}', 'SubMenuController@history')->name('sub_menu.history');
    Route::get('/submenu/revert/page/{id}', 'SubMenuController@pageRevert')->name('revert.sub_menu');

    Route::resource('/banner', 'BannerController');
    Route::get('/banner/create', 'BannerController@create')->name('banner.create');
    Route::post('/store', 'BannerController@store');
    Route::get('/banner/edit/{id}', 'BannerController@edit');
    Route::get('/banner/delete/{id}', 'BannerController@delete')->name('banner.delete');
    Route::get('/banner/status/{id}', 'BannerController@status')->name('banner.staus');
    Route::get('/validate-banner', 'BannerController@validateBanner');
    Route::get('/validate-banner-edit', 'BannerController@validateBannerEdit');

    Route::resource('/service', 'ServiceController');
    Route::get('/service/create', 'ServiceController@create')->name('service.create');
    Route::post('/service/store', 'ServiceController@store')->name('service.store');
    // Route::get('/service/edit/{id}', 'ServiceController@edit')->name('service.edit');
    Route::get('/service/update', 'ServiceController@update')->name('service.update');
    Route::get('/service/delete/{id}', 'ServiceController@delete');
    Route::get('/service/status/{id}', 'ServiceController@status');
    Route::get('/validate-service', 'ServiceController@validateService');
    Route::get('/validate-service-edit', 'ServiceController@validateServiceEdit');

    Route::resource('/partner', 'PartnerController');
    Route::get('/partner/create', 'PartnerController@create')->name('partner.create');
    Route::post('/partner/store', 'PartnerController@store')->name('partner.store');
    Route::get('/partner/edit/{id}', 'PartnerController@edit');
    Route::get('/partner/delete/{id}', 'PartnerController@delete');
    Route::get('/partner/status/{id}', 'PartnerController@status');
    Route::get('/validate-partner', 'PartnerController@validatePartner');
    Route::get('/partner/validate-partner-edit', 'PartnerController@validatePartnerEdit');

    Route::resource('/news', 'NewsController');
    Route::get('/news/create', 'NewsController@create')->name('news.create');
    Route::post('/news/store', 'NewsController@store')->name('news.store');
    Route::get('/news/edit/{id}', 'NewsController@edit');
    Route::get('/news/delete/{id}', 'NewsController@delete');
    Route::get('/news/status/{id}', 'NewsController@status');
    Route::get('/news/revert/{id}', 'NewsController@history')->name('news.history');
    Route::get('/news/revert/page/{id}', 'NewsController@pageRevert')->name('revert.news');

    //    Route::get('/profile', 'Admin\UserController@profileshow');
    //    Route::post('/profileupdate', 'Admin\UserController@profileupdate');
    //    Route::get('/changepass', 'Admin\UserController@changepassform');
    //    Route::post('/changepassword', 'Admin\UserController@changepassword')->name('changepssword');

    Route::resource('/blog', 'Admin\BlogController');
    Route::post('/blog/store', 'Admin\BlogController@store')->name('blog.store');
    Route::get('/blog/status/{id}', 'Admin\BlogController@status');
    Route::get('/blog/delete/{id}', 'Admin\BlogController@delete');
    Route::get('/manageblog/{id}', 'Admin\BlogController@manageblog');
    Route::get('/add_blog/{id}', 'Admin\BlogController@add_blog');

    Route::resource('/public_awareness', 'PublicAwarenessController');
    Route::get('/public_awareness/create', 'PublicAwarenessController@create')->name('public_awareness.create');
    Route::post('/public_awareness/store', 'PublicAwarenessController@store');
    Route::get('/public_awareness/edit/{id}', 'PublicAwarenessController@edit');
    Route::get('/public_awareness/delete/{id}', 'PublicAwarenessController@delete');
    Route::get('/public_awareness/status/{id}', 'PublicAwarenessController@status');
    Route::get('/public_awareness/manage_awareness_faq/{id}', 'PublicAwarenessController@manage_awareness_faq');
    Route::get('/public_awareness/add_awareness_faq/{id}', 'PublicAwarenessController@add_awareness_faq')->name('public_awareness.add_awareness_faq');
    Route::post('/public_awareness/store_awareness_faq/{id}', 'PublicAwarenessController@store_awareness_faq')->name('public_awareness.store_awareness_faq');
    Route::get('/public_awareness/faq_edit/{id}', 'PublicAwarenessController@faq_edit')->name('public_awareness.faq_edit');
    Route::post('/public_awareness/update_awareness_faq/{id}', 'PublicAwarenessController@update_awareness_faq')->name('public_awareness.update_awareness_faq');

    Route::get('/public_awareness/faq_delete/{id}', 'PublicAwarenessController@faq_delete');
    Route::get('/public_awareness/faq_status/{id}', 'PublicAwarenessController@faq_status');

    Route::resource('/public_awareness_category', 'PublicAwarenessCategoryController');
    Route::get('/public_awareness_category/create', 'PublicAwarenessCategoryController@create')->name('public_awareness_category.create');
    Route::post('/public_awareness_category/store', 'PublicAwarenessCategoryController@store');
    Route::get('/public_awareness_category/edit/{id}', 'PublicAwarenessCategoryController@edit');
    Route::get('/public_awareness_category/status/{id}', 'PublicAwarenessCategoryController@status');
    Route::get('/public_awareness_category/delete/{id}', 'PublicAwarenessCategoryController@delete');

    Route::resource('/board_director', 'BoardDirectorController');
    Route::get('/board_director/create', 'BoardDirectorController@create')->name('board_director.create');
    Route::post('/board_director/store', 'BoardDirectorController@store');
    Route::get('/board_director/edit/{id}', 'BoardDirectorController@edit');
    Route::get('/board_director/delete/{id}', 'BoardDirectorController@delete');

    Route::post('ckeditor/image_upload', 'CKEditorController@upload')->name('upload');

    Route::resource('/tender', 'TenderController');
    Route::get('/tender/create', 'TenderController@create')->name('tender.create');
    Route::post('/tender/store', 'TenderController@store')->name('tender.store');
    Route::get('/tender/edit/{id}', 'TenderController@edit');
    Route::get('/tender/delete/{id}', 'TenderController@delete');
    Route::get('/tender/status/{id}', 'TenderController@status');

    Route::resource('/organization_type', 'OrganizationTypeController');
    Route::get('/organization_type/create', 'OrganizationTypeController@create')->name('organization_type.create');
    Route::post('/organization_type/store', 'OrganizationTypeController@store')->name('organization_type.store');
    Route::get('/organization_type/edit/{id}', 'OrganizationTypeController@edit');
    Route::get('/organization_type/delete/{id}', 'OrganizationTypeController@delete');
    Route::get('/organization_type/status/{id}', 'OrganizationTypeController@status');
    Route::get('/add_organization_type', 'OrganizationTypeController@add_organization_type');

    Route::resource('/news_category', 'NewsCategoryController');
    Route::get('/news_category/create', 'NewsCategoryController@create')->name('news_category.create');
    Route::post('/news_category/store', 'NewsCategoryController@store')->name('news_category.store');
    Route::get('/news_category/edit/{id}', 'NewsCategoryController@edit');
    Route::get('/news_category/delete/{id}', 'NewsCategoryController@delete');
    Route::get('/news_category/status/{id}', 'NewsCategoryController@status');

    Route::resource('/course', 'CoursesController');
    Route::get('/course/create', 'CoursesController@create')->name('course.create');
    Route::post('/course/store', 'CoursesController@store')->name('course.store');
    Route::get('/course/edit/{id}', 'CoursesController@edit')->name('course.edit');;
    Route::get('/course/duplicate/{id}', 'CoursesController@duplicate')->name('course.duplicate');
    Route::get('/course/delete/{id}', 'CoursesController@delete');
    Route::get('/course/status/{id}', 'CoursesController@status');
    Route::get('/course/apply/status/{id}', 'CoursesController@courseStatus');

    Route::resource('/course_category', 'CourseCategoryController');
    Route::get('/course_category/create', 'CourseCategoryController@create')->name('course_category.create');
    Route::post('/course_category/store', 'CourseCategoryController@store')->name('course_category.store');
    Route::get('/course_category/edit/{id}', 'CourseCategoryController@edit')->name('course_category.edit');;
    Route::get('/course_category/delete/{id}', 'CourseCategoryController@delete');
    Route::get('/course_category/status/{id}', 'CourseCategoryController@status');

    Route::resource('/video_category', 'VideoCategoryController');
    Route::get('/video_category/create', 'VideoCategoryController@create')->name('video_category.create');
    Route::post('/video_category/store', 'VideoCategoryController@store')->name('video_category.store');
    Route::get('/video_category/edit/{id}', 'VideoCategoryController@edit');
    Route::get('/video_category/delete/{id}', 'VideoCategoryController@delete');
    Route::get('/video_category/status/{id}', 'VideoCategoryController@status');

    Route::resource('/video_gallery', 'VideoGalleryController');
    Route::get('/video_gallery/create', 'VideoGalleryController@create')->name('video_gallery.create');
    Route::post('/video_gallery/store', 'VideoGalleryController@store')->name('video_gallery.store');
    Route::get('/video_gallery/edit/{id}', 'VideoGalleryController@edit');
    Route::get('/video_gallery/delete/{id}', 'VideoGalleryController@delete');
    Route::get('/video_gallery/status/{id}', 'VideoGalleryController@status');
    Route::get('/video_gallery/revert/page/{id}', 'VideoGalleryController@pageRevert')->name('video_gallery.revert');
    Route::get('/video_gallery/revert/{id}', 'VideoGalleryController@history')->name('video_gallery.history');

    Route::get('manage_contact_info', 'ContactController@manage_contact_info');
    Route::post('/contact/update', 'ContactController@update')->name('contact.update');
    Route::get('/contact/history', 'ContactController@history')->name('contact.history');
    Route::get('/contact/revert/page/{id}', 'ContactController@pageRevert')->name('revert.contact');

    Route::resource('/document_library', 'DocumentLibraryController');
    Route::get('/document_library/create', 'DocumentLibraryController@create')->name('document_library.create');
    Route::post('/document_library/store', 'DocumentLibraryController@store')->name('document_library.store');
    Route::get('/document_library/edit/{id}', 'DocumentLibraryController@edit');
    Route::get('/document_library/delete/{id}', 'DocumentLibraryController@delete');
    Route::get('/document_library/status/{id}', 'DocumentLibraryController@status');

    Route::resource('/pmo_notice_board', 'PMONoticeBoardController');
    Route::get('/pmo_notice_board/create', 'PMONoticeBoardController@create')->name('pmo_notice_board.create');
    Route::post('/pmo_notice_board/store', 'PMONoticeBoardController@store')->name('pmo_notice_board.store');
    Route::get('/pmo_notice_board/edit/{id}', 'PMONoticeBoardController@edit');
    Route::get('/pmo_notice_board/delete/{id}', 'PMONoticeBoardController@delete');
    Route::get('/pmo_notice_board/deletedoc/{id}', 'PMONoticeBoardController@deletedoc');
    Route::get('/pmo_notice_board/status/{id}', 'PMONoticeBoardController@status');
    Route::post('/pmo_notice_board/update-dashboard', 'PMONoticeBoardController@updatedashboard')->name('pmo_notice_board.update-dashboard');

    // Document library type start
    Route::resource('/document_library_type', 'DocumentLibraryTypeController');
    Route::put('/document_library_type/update', 'DocumentLibraryTypeController@update');
    Route::get('/document_library_type/create', 'DocumentLibraryTypeController@create')->name('document_library.type.create');
    Route::post('/document_library_type/store', 'DocumentLibraryTypeController@store')->name('document_library.type.store');
    Route::get('/document_library_type/edit/{id}', 'DocumentLibraryTypeController@edit')->name('document_library.type.edit');
    Route::get('/document_library_type/delete/{id}', 'DocumentLibraryTypeController@delete');
    Route::get('/document_library_type/status/{id}', 'DocumentLibraryTypeController@status');
    // Document library type end
    // Document library department start
    Route::resource('/document_library_department', 'DocumentLibraryDepartmentController');
    //Route::post('/document_library_department/update/{id}', 'DocumentLibraryDepartmentController@update');
    Route::get('/document_library_department/create', 'DocumentLibraryDepartmentController@create')->name('document_library.department.create');
    Route::post('/document_library_department/store', 'DocumentLibraryDepartmentController@store')->name('document_library.department.store');
    Route::get('/document_library_department/edit/{id}', 'DocumentLibraryDepartmentController@edit')->name('document_library.department.edit');
    Route::post('/document_library_department/update/{id}', 'DocumentLibraryDepartmentController@update')->name('document_library.department.update');
    Route::get('/document_library_department/delete/{id}', 'DocumentLibraryDepartmentController@delete');
    Route::get('/document_library_department/status/{id}', 'DocumentLibraryDepartmentController@status');
    // Document library department end
    // Document library classification start
    Route::resource('/document_library_classification', 'DocumentLibraryClassificationController');
    Route::put('/document_library_classification/update', 'DocumentLibraryClassificationController@update');
    Route::get('/document_library_classification/create', 'DocumentLibraryClassificationController@create')->name('document_library.classification.create');
    Route::post('/document_library_classification/store', 'DocumentLibraryClassificationController@store')->name('document_library.classification.store');
    Route::get('/document_library_classification/edit/{id}', 'DocumentLibraryClassificationController@edit')->name('document_library.classification.edit');
    Route::get('/document_library_classification/delete/{id}', 'DocumentLibraryClassificationController@delete');
    Route::get('/document_library_classification/status/{id}', 'DocumentLibraryClassificationController@status');
    // Document library classification end
    // Document library classification start
    Route::resource('/story_category', 'StoryCategoryController');
    Route::put('/story_category/update', 'StoryCategoryController@update');
    Route::get('/story_category/create', 'StoryCategoryController@create')->name('story_category.create');
    Route::post('/story_category/store', 'StoryCategoryController@store')->name('story_category.store');
    Route::get('/story_category/edit/{id}', 'StoryCategoryController@edit')->name('story_category.edit');
    Route::get('/story_category/delete/{id}', 'StoryCategoryController@delete');
    Route::get('/story_category/status/{id}', 'StoryCategoryController@status');
    // Document library classification end

    Route::get('/config/course_status_button', 'ConfigController@courseChangeStatus')->name('config.course_status_button');
    Route::get('/config/career_status_button', 'ConfigController@careerChangeStatus')->name('config.career_status_button');

    /*For Market Mangement End*/
  
    
    Route::group([
        // 'name' => 'cms.manage_service.',
        'prefix' => 'manage-service-info',
    ], function () {
        // METHOD: GET
        // URL: http://na.bw.ae/national-ambulance/manage-service-info
        // Route: cms.manage_service
        Route::get('/', 'ServiceController@adminCMSManageServiceInfo')->name('cms.manage_service');
        Route::get('/revert/page/{id}', 'ServiceController@pageRevert')->name('manage-service-info.revert');
        Route::get('/revert/{id}', 'ServiceController@history')->name('manage-service-info.history');    
       
        // METHOD: GET
        // URL: http://na.bw.ae/national-ambulance/manage-service-info
        // Route: cms.manage_service.update
        Route::post('/', 'ServiceController@adminUpdateCMSManageServiceInfo')->name('cms.manage_service.update');
    });
    
Route::group([
    // 'name' => 'cms.manage_feedback.',
    'prefix' => 'manage-feedback-info',
], function () {
    // METHOD: GET
    // URL: http://na.bw.ae/national-ambulance/manage-feedback-info
    // Route: cms.manage_service
    Route::get('/', 'FeedbackController@adminCMSManageFeedbackInfo')->name('cms.manage_feedback');

    // METHOD: GET
    // URL: http://na.bw.ae/national-ambulance/manage-feedback-info
    // Route: cms.manage_feedback.update
    Route::post('/', 'FeedbackController@adminUpdateCMSManageFeedbackInfo')->name('cms.manage_feedback.update');
    Route::get('/revert/page/{id}', 'FeedbackController@pageRevert')->name('manage-feedback-info.revert');
    Route::get('/revert/{id}', 'FeedbackController@history')->name('manage-feedback-info.history');
});

Route::group([
    // 'middleware' => ['a-auth'],
    'prefix' => 'manage-testimonial-info',
    'as' => 'manage_testimonial.',
], function () {
    // METHOD: GET
    // URL: http://na.bw.ae/national-ambulance/manage-testimonial-info/{search?}
    // Route: manage_testimonial.search
    Route::get('/{search?}', 'TestimonialController@search')->name('search');

    // METHOD: GET
    // URL: http://na.bw.ae/national-ambulance/manage-testimonial-info/{search?}
    // Route: manage_testimonial.filter
    Route::post('/filter', 'TestimonialController@filter')->name('filter');

    // METHOD: POST
    // URL: http://na.bw.ae/national-ambulance/manage-testimonial-info
    // Route: manage_testimonial.createOrUpdate
    Route::post('/', 'TestimonialController@createOrUpdate')->name('createOrUpdate');

    // METHOD: GET
    // URL: http://na.bw.ae/national-ambulance/manage-testimonial-info
    // Route: manage_testimonial.update
    Route::get('/update/{id}', 'TestimonialController@edit')->name('update');

    // // METHOD: POST
    // // URL: http://na.bw.ae/national-ambulance/manage-testimonial-info
    // // Route: manage_testimonial.update
    // Route::post('/update/{id}', 'TestimonialController@update')->name('update');

    // METHOD: GET
    // URL: http://na.bw.ae/national-ambulance/manage-testimonial-info
    // Route: manage_testimonial.delete
    Route::get('/delete/{id}', 'TestimonialController@delete')->name('delete');

    // METHOD: GET
    // URL: http://na.bw.ae/national-ambulance/manage-testimonial-info
    // Route: manage_testimonial.update.status
    Route::get('/status/{id}', 'TestimonialController@status')->name('update.status');
});
Route::group([
    'prefix' => 'manage-career-info',
    'namespace' => 'CareerPortal',
], function () {
    // METHOD: GET
    // URL: http://na.bw.ae/national-ambulance/manage-career-info
    // Route: cms.manage_service
    Route::get('/', 'CareerController@adminCMSManageCareerInfo')->name('cms.manage_career');

    // METHOD: GET
    // URL: http://na.bw.ae/national-ambulance/manage-career-info
    // Route: cms.manage_feedback.update
    Route::post('/', 'CareerController@adminUpdateCMSManageCareerInfo')->name('cms.manage_career.update');
    Route::get('/revert/page/{id}', 'CareerController@pageRevert')->name('manage-career-info.revert');
    Route::get('/revert/{id}', 'CareerController@history')->name('manage-career-info.history');
});
Route::group([
    // 'name' => 'cms.manage_feedback.',
    'prefix' => 'manage-feedback-info',
], function () {
    // METHOD: GET
    // URL: http://na.bw.ae/national-ambulance/manage-feedback-info
    // Route: cms.manage_service
    Route::get('/', 'FeedbackController@adminCMSManageFeedbackInfo')->name('cms.manage_feedback');

    // METHOD: GET
    // URL: http://na.bw.ae/national-ambulance/manage-feedback-info
    // Route: cms.manage_feedback.update
    Route::post('/', 'FeedbackController@adminUpdateCMSManageFeedbackInfo')->name('cms.manage_feedback.update');
});


Route::group([
    'prefix' => '/career-portal',
    'namespace' => 'CareerPortal',
    'as' => 'career-portal.',
], function () {
    Route::group([
        'prefix' => 'admin/vacancy',
        'as' => 'admin.vacancy.',
    ], function () {

        Route::group([
            'prefix' => 'category',
            'as' => 'category.',
        ], function () {

            // METHOD: POST
            // ROUTE: career-portal.admin.vacancy.category.create_or_update
            // URL: http://127.0.0.1:8080/career-portal/admin/vacancy/category
            Route::post('/', 'VacancyCategoryController@adminCreateOrUpdateVacancyCategory')->name('create_or_update');

            // METHOD: GET
            // ROUTE: career-portal.admin.vacancy.category.view
            // URL: http://127.0.0.1:8080/career-portal/admin/vacancy/category
            Route::view('/', 'career_portal.admin.vacancy_category')->name('view');

            // METHOD: GET
            // ROUTE: career-portal.admin.vacancy.category.update.view
            // URL: http://127.0.0.1:8080/career-portal/admin/vacancy/category/update/{id}
            Route::get('/update/{id}', 'VacancyCategoryController@viewUpdateVacancyCategory')->name('update.view');

            // METHOD: GET
            // ROUTE: career-portal.admin.vacancy.category.delete
            // URL: http://127.0.0.1:8080/career-portal/admin/vacancy/category/delete/{id}
            Route::get('/delete/{id}', 'VacancyCategoryController@deleteVacancyCategory')->name('delete');

            // METHOD: GET
            // ROUTE: career-portal.admin.vacancy.category.update.status
            // URL: http://127.0.0.1:8080/career-portal/admin/vacancy/category/delete/{id}
            Route::get('/update/{id}/{status}', 'VacancyCategoryController@updateVacancyCategoryStatus')->name('update.status');

        });

        // METHOD: POST
        // ROUTE: career-portal.admin.vacancy.create_or_update
        // URL: http://127.0.0.1:8080/career-portal/admin/vacancy/category
        Route::post('/', 'VacancyController@adminCreateOrUpdateVacancy')->name('create_or_update');

        // METHOD: GET
        // ROUTE: career-portal.admin.vacancy.view
        // URL: http://127.0.0.1:8080/career-portal/admin/vacancy/category
        Route::view('/', 'career_portal.admin.vacancy')->name('view');

        // METHOD: GET
        // ROUTE: career-portal.admin.vacancy.update.view
        // URL: http://127.0.0.1:8080/career-portal/admin/vacancy/category/update/{id}
        Route::get('/update/{id}', 'VacancyController@viewUpdateVacancy')->name('update.view');
        Route::get('/duplicate/{id}', 'VacancyController@viewDuplicateVacancy')->name('duplicate.view');

        // METHOD: GET
        // ROUTE: career-portal.admin.vacancy.delete
        // URL: http://127.0.0.1:8080/career-portal/admin/vacancy/category/delete/{id}
        Route::get('/delete/{id}', 'VacancyController@deleteVacancy')->name('delete');

        // METHOD: GET
        // ROUTE: career-portal.admin.vacancy.update.status
        // URL: http://127.0.0.1:8080/career-portal/admin/vacancy/category/delete/{id}
        Route::get('/update/{id}/{status}', 'VacancyController@updateVacancyStatus')->name('update.status');
        Route::get('/revert/page/{id}', 'VacancyController@pageRevert')->name('revert');
        Route::get('/revert/{id}', 'VacancyController@history')->name('revert.history');
    });
});
    // Route::get('/{search?}', 'TestimonialController@search')->name('search');
 


});


Route::group(['prefix'=>LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],function(){
Route::domain(env('SUB_DOMAIN_CAREERS','career.na.bw.ae'))->group(function () {
        Route::get('', 'CareerPortal\CareerController@index')->name('career-domain-index');
});
Route::get('/download','IndexController@download')->name('download');
Route::get('/sitemap', 'IndexController@sitemap');
Route::get('/search', 'SearchController@index')->name('search');

Route::get('/bestseller', 'StaticContentController@categoryPage')->name('bestseller');


Route::resource('contact-us', 'ContactController');
Route::post('contact_store', 'ContactController@contact_store')->name('contact_store');

Route::get('/logout', 'IndexController@webLogout');
Route::get('/national-ambulance','IndexController@indexRedirect');
Route::get('/national-ambulance/index', 'IndexController@indexRedirect');
Route::get('/national-ambulance/login','IndexController@loginPage');
Route::get('/', 'IndexController@index')->name('web.index');
Route::get('index', 'IndexController@indexRedirect');
// Route::get('launch', 'IndexController@launch')->name('launch');
Route::get('page/{slug}', 'IndexController@cms');
Route::get('inner_page/{slug}', 'IndexController@innercms');
Route::get('/board-director', 'IndexController@board_director');
Route::get('getModalContent', 'IndexController@getModalContent');
Route::resource('/supplier-registration', 'SupplierController');
Route::post('/registerFirstPost', 'SupplierController@registerFirstPost');
Route::post('/registerSecondPost', 'SupplierController@registerSecondPost');
Route::post('/registerThirdPost', 'SupplierController@registerThirdPost');
Route::post('/registerFourPost', 'SupplierController@registerFourPost');
Route::get('/download/{id}', 'SupplierController@getDownload');
Route::post('/interest_store', 'SupplierController@interest_store')->name('interest_store');
Route::get('/manage_express_interest', 'SupplierController@manage_express_interest');
Route::get('/interst_show/{id}', 'SupplierController@interst_show');
Route::get('/news_detail/{id}', 'NewsController@news_detail')->name('news.detail');
Route::get('/upload', 'NewsController@upload');
Route::post('/csv_upload', 'NewsController@csv_upload');

Route::get('/courses', 'CoursesController@listing')->name('courses.list');
Route::get('/courses/detail/{id}', 'CoursesController@detail')->name('courses.detail');
Route::get('/courses/apply/{id}', 'CoursesController@applyFormView')->name('course.apply.form');
Route::post('/courses/apply/{id}', 'CoursesController@apply')->name('course.apply');

Route::get('refresh_captcha', 'HomeController@refreshCaptcha')->name('refresh_captcha');

Route::get('public-awareness', 'PublicAwarenessController@fetch_cms')->name('public_awareness.index');
Route::get('public-awareness/{id}', 'PublicAwarenessController@fetch_details')->name('public_awareness.detail');
// 02-06-2021

// METHOD: GET
// URL: http://na.bw.ae/national-ambulance/our-services
Route::get('our-services', 'OurServiceController@index');

// // METHOD: GET
// // URL: http://na.bw.ae/national-ambulance/feedback
// // Route::get('feedback', 'FeedbackController@index');
// Route::view('feedback', 'website.feedback');

// METHOD: POST
// URL: http://na.bw.ae/national-ambulance/post-feedback
Route::post('/post-feedback', 'FeedbackController@postFeedback')->name('post-feedback');

// METHOD: GET
// URL: http://na.bw.ae/national-ambulance/feedback
Route::get('feedback', 'FeedbackController@index')->name('feedback');

// // METHOD: GET
// // URL: http://na.bw.ae/national-ambulance/manage-service-info
// Route::get('/manage-service-info', 'ServiceController@adminCMSManageServiceInfo')->name('cms.manage_service');
// Route::post('/manage-service-info', 'ServiceController@adminUpdateCMSManageServiceInfo')->name('cms.manage_service.update');



// METHOD: POST
// URL: http://na.bw.ae/patient-transport-service
Route::post('/patient-transport-service', 'OurServiceController@ptsRegistration')->name('service.pts');

// METHOD: POST
// URL: http://na.bw.ae/events-ambulance-converage-service
Route::post('/events-ambulance-converage-service', 'OurServiceController@eventRegistration')->name('service.events');

// METHOD: POST
// URL: http://na.bw.ae/events-ambulance-converage-service
Route::post('/education-and-training-service', 'OurServiceController@educationTraining')->name('service.education');


Route::group([
    'prefix' => 'locale',
    'namespace' => 'Localization',
    'as' => 'locale.',
], function () {
    // METHOD: GET
    // ROUTE: locale.set
    // URL: http://127.0.0.1:8080/locale/set/{locale}
    Route::get('set/{locale}', 'LocalizationController@setLocalization')
    ->where('locale', 'en|ar')
    ->name('set');
    // METHOD: GET
    // ROUTE: locale.set
    // URL: http://127.0.0.1:8080/locale/set/{locale}
    Route::get('seten', 'LocalizationController@setLocalizationForVacancyList')
    ->name('seten');

    // METHOD: GET
    // ROUTE: locale.test
    // URL: http://127.0.0.1:8080/locale/test
    Route::view('test', 'localization.test')->name('test');
});

// METHOD: GET
// URL: http://na.bw.ae/national-ambulance/check-messenger
Route::get('/check-messenger', 'UtilController@checkMessenger');
});