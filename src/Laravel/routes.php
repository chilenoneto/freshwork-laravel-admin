<?php

Route::get('/login',[
    'as'    => 'admin.login',
    'ueses' => 'AuthController@show_login'
]);

Route::group(['middleware' => 'admin.auth'],function()
{

    Route::get('/logout',[
        'as'    => 'admin.logout',
        'ueses' => 'AuthController@logout'
    ]);

});