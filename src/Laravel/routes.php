<?php

Route::get('/login',[
    'as'    => 'panel.login',
    'ueses' => 'AuthController@show_login'
]);

Route::group(['middleware' => 'panel.auth'],function()
{

    Route::get('/logout',[
        'as'    => 'panel.logout',
        'ueses' => 'AuthController@logout'
    ]);

});