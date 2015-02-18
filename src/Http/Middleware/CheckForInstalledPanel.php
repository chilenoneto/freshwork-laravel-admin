<?php  namespace Freshwork\Admin\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Middleware;

class CheckForInstalledPanel implements Middleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$this->isPanelInstalled())
        {
            return redirect()->route('admin.install');
        }
        return $next($request);
    }

    private function isPanelInstalled()
    {
        return file_exists(storage_path().'/app/installed');
    }
}