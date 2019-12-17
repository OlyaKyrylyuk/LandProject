<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Role
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
        if(Auth::user()->role == 'admin'){
            return $next($request);
        }
        else if(Auth::user()->role == 'member'){
            return redirect('member/home');
        }
        return redirect('/home');
    }
}
