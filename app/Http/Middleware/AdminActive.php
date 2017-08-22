<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminActive
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
        $user = Auth::user();

        if ($user->isActive()) 
        {
             return $next($request);

        }

         flash('Sorry! Your Account is Deactiveted Please Contact to Suppoert DMSZar Team.', 'danger');

          return redirect('/auth/ooops');
    }
}
