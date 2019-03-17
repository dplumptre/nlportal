<?php

namespace App\Http\Middleware;

use Closure;

class mustBeSupervisor
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
     
        if (   $request->user()->hasRole('admin')  OR $request->user()->hasRole('supervisor')      ) {
            return $next($request); 
        }

      
        return redirect('access-denied');
    }
}
