<?php

namespace App\Http\Middleware;

use Closure;

class OnEnter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\Auth::user()!== null and \Auth::user()->isRole('admin'))
        {
            \Debugbar::enable();
        }else{
            \Debugbar::disable();
        }
        return $next($request);
    }
}
