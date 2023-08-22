<?php

Route::group([
    'prefix' => 'profile',
    'as' => 'user-profile.',
    'middleware' => ['auth'],
], function () {

    // METHOD: GET
    // ROUTE: user-profile.view
    // URL: http://127.0.0.1:8080/profile
    Route::view('/', 'profile.display')->name('view');

    // METHOD: GET
    // ROUTE: user-profile.password.view
    // URL: http://127.0.0.1:8080/profile/password
    Route::view('/password', 'profile.reset')->name('password.view');

    // METHOD: POST
    // ROUTE: user-profile.update
    // URL: http://127.0.0.1:8080/profile
    Route::post('/', 'ProfileController@update')->name('update');

    // METHOD: POST
    // ROUTE: user-profile.password.update
    // URL: http://127.0.0.1:8080/profile/password/update
    Route::post('/password', 'ProfileController@updatePassword')->name('password.update');

});