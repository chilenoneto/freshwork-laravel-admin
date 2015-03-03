<?php  namespace Freshwork\Admin\Http\Middleware;

use Closure;
use Freshwork\Admin\Contracts\Auth\ACL;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Http\Request;

class AclMiddleware implements Middleware {
    /**
     * @var ACL
     */
    private $acl;

    function __construct(ACL $acl)
    {
        $this->acl = $acl;
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
        $neededPermission = $this->neededPermission($request);
        if(!$this->acl->can($neededPermission))
        {
            if ($request->ajax())
            {
                return response('Unauthorized.', 401);
            }
            else
            {
                $url = redirect()->getUrlGenerator()->route('admin.auth.login');
                return redirect()->guest($url);
            }
        }
        return $next($request);
    }

    private function neededPermission(Request $request)
    {
        $action = $request->route()->getAction();
        return isset($action['permission']) ? explode('|', $action['permission']) : null;
    }
}