<?php

namespace App\Http\Middleware;

use Closure;

class IsStaff
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
        $staff = $request->user()->isStaff();

        if ($staff) 
        {
             return $next($request);

        }

         flash('Sorry! You Do not have permission.', 'danger');

          return redirect('/oopst');
    }
}
