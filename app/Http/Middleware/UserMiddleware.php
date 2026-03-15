<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
        public function handle(Request $request, Closure $next)
        {
            if(!session()->has('userid')){
                return redirect('/login')
                ->with('error','Vui lòng đăng nhập để đặt tour');
            }

            return $next($request);
        }
}
