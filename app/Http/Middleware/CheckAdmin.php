<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Flash;
use Illuminate\Http\RedirectResponse;

class CheckAdmin
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
        if (! Auth::user()->can('access.admin')) {
            Flash::error('Sorry, you do not have the proper permissions.');

            return new RedirectResponse(url('/'));
        }
        return $next($request);
    }
}
