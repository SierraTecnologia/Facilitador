<?php

namespace Facilitador\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class FacilitadorAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        auth()->setDefaultDriver(app('FacilitadorGuard'));

        if (!Auth::guest()) {
            $user = Auth::user();
            app()->setLocale($user->locale ?? app()->getLocale());

            return $user->hasPermission('browse_admin') ? $next($request) : redirect('/');
        }

        $urlLogin = route('facilitador.login');

        return redirect()->guest($urlLogin);
    }
}
