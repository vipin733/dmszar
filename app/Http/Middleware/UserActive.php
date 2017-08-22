<?php

namespace App\Http\Middleware;
use Auth;

use Closure;

class UserActive
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
        
        $student = $request->user();

        if ($student->owner->isActive()) 
        {
             return $next($request);

        }

         flash('Sorry! You Do not have permission.', 'danger');

          return redirect('/oops');
       
       }
}
