<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserStatus
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
        if(Auth::user()->status):
            return $next($request);
        else:
            Auth::logout();
            return redirect('login')->with('error','Lo sentimos el usuario esta desactivado, contacta un administrador.');
        endif;
    }
}
