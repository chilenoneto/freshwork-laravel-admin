<?php

Route::get('/login',[
    'as'    => 'admin.login',
    'uses' => 'AuthController@show_login'
]);

Route::group(['middleware' =>['admin','acl'],'permission' => 'read'],function()
{

    Route::get('/',[
        'as'    => 'admin.dashboard',
        'uses' => 'DashboardController@show'
    ]);

    Route::get('/logout',[
        'as'    => 'admin.logout',
        'uses' => 'AuthController@logout'
    ]);

});