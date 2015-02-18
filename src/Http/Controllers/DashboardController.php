<?php  namespace Freshwork\Admin\Http\Controllers;

use Illuminate\Routing\Controller;

class DashboardController extends Controller {
    public function show()
    {
        return view('panel::dashboard.index');
    }
}