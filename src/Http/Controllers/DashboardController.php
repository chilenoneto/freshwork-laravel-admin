<?php  namespace Freshwork\Admin\Http\Controllers;


class DashboardController extends BaseController {
    public function show()
    {
        return view('panel::dashboard.index');
    }
}