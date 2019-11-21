<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class IsDeveloperOrSwitched
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */    protected $user;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */    public function __construct(Guard $auth)
    {
        $this->user = $auth->user();
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */    public function handle($request, Closure $next)
    {

        if($this->user->hasRole('Developer') || $request->session()->get('user_is_switched')){
            return $next($request);
        }
        return redirect()->to('/');

    }
}
