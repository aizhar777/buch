<?php

namespace App\Http\Middleware;

use App\Library\Traits\CurrentUserModel;
use Closure;

class OnEnter
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
        if ($this->getCurrentUser() !== null and $this->getCurrentUser()->isUserRole('admin'))
        {
            \Debugbar::enable();
        }else{
            \Debugbar::disable();
        }
        return $next($request);
    }
}
