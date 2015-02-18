<?php namespace Freshwork\Admin\Http\Controllers;

use Illuminate\Routing\Controller;

class AuthController extends Controller {

    public function show_login()
    {
        return view('panel::auth.login');
    }

    public function logout()
    {

    }

    public function login()
    {

    }
}