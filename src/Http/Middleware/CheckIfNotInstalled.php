<?php  namespace Freshwork\Admin\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Middleware;

class CheckIfNotInstalled implements  Middleware {
    /**
     * @var CheckForInstalledPanel
     */
    private $checkForInstalledPanel;

    function __construct(CheckForInstalledPanel $checkForInstalledPanel)
    {
        $this->checkForInstalledPanel = $checkForInstalledPanel;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($this->checkForInstalledPanel->isPanelInstalled())
        {
            return redirect()->to('/');
        }
        return $next($request);
    }
}