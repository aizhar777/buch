<?php

namespace App\Http\Middleware;

use App\Library\Traits\CurrentUserModel;
use Auth;
use Closure;
use Flash;
use Illuminate\Http\RedirectResponse;

class CheckAdmin
{
    use CurrentUserModel;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $this->checkPerm('access.admin')) {
            Flash::error('Sorry, you do not have the proper permissions.');

            return new RedirectResponse(url('/'));
        }
        return $next($request);
    }
}
