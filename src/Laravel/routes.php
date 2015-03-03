<?php
/*****************************************
 *  Installer routes
 ******************************************/

Route::get('/installer',[
    'as'    => 'admin.installer.index',
    'uses' => 'InstallerController@index'
]);

Route::get('/installer/db',[
    'as'    => 'admin.installer.db',
    'uses' => 'InstallerController@database'
]);

Route::post('/installer/db/save',[
    'as'    => 'admin.installer.db.save',
    'uses' => 'InstallerController@install_db'
]);


Route::get('/installer/tables',[
    'as'    => 'admin.installer.tables',
    'uses' => 'InstallerController@tables'
]);

Route::post('/installer/tables/save',[
    'as'    => 'admin.installer.tables.save',
    'uses' => 'InstallerController@install_tables'
]);

Route::get('/installer/user',[
    'as'    => 'admin.installer.user',
    'uses' => 'InstallerController@user'
]);

Route::post('/installer/user/save',[
    'as'    => 'admin.installer.user.save',
    'uses' => 'InstallerController@store_user'
]);


Route::get('/installer/review',[
    'as'    => 'admin.installer.review',
    'uses' => 'InstallerController@review'
]);

Route::get('/installer/review/confirm',[
    'as'    => 'admin.installer.review.confirm',
    'uses' => 'InstallerController@confirm_review'
]);


/*****************************************
 *  Login Route
 ******************************************/

Route::get('/auth/login',[
    'as'    => 'admin.auth.login',
    'uses' => 'AuthController@login'
]);

Route::post('/auth/login',[
    'as'    => 'admin.auth.login.process',
    'uses' => 'AuthController@processLogin'
]);

Route::get('/auth/register',[
    'as'    => 'admin.auth.register',
    'uses' => 'AuthController@register'
]);

/*****************************************
 *  Admin & ACL protected routes
 ******************************************/
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