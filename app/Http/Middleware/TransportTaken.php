<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class TransportTaken
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
        $student = Auth::user();

        if ($student->TransportationTaken()) 
        {
             return $next($request);

        }

         flash('Sorry! You Do not have permission.', 'danger');

          return redirect('/student');
       
     
    }
}
