<?php  namespace Freshwork\Admin\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Routing\Middleware;

class SimpleAuthMiddleware implements Middleware {
    /**
     * @var Guard
     */
    private $auth;

    function __construct(Guard $auth)
    {

        $this->auth = $auth;
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
        $admin_field = config('admin.auth.admin_field');
        if($this->auth->check() && $this->auth->user()->{$$admin_field} == true)
        {
            return $next($request);
        }

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
}