<?php namespace Freshwork\Admin\Http\Controllers;

use Freshwork\Admin\Http\Middleware\CheckForInstalledPanel;
use Illuminate\Contracts\Auth\Guard;

class AuthController extends BaseController {

    public function login(CheckForInstalledPanel $check)
    {
        if(!$check->isPanelInstalled())
        {
            return redirect()->route('admin.installer.index');
        }
        return view('admin::auth.login');
    }

    public function logout()
    {

    }

    public function processLogin(Guard $auth)
    {
        $auth->attempt(['a' => 'a']);
    }
}