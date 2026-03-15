<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {

        // chưa đăng nhập
        if(!session()->has('userid')){
            return redirect('/login')
            ->with('error','Vui lòng đăng nhập');
        }

        // không phải admin
        if(session('role') != 1){
            abort(403,'Bạn không có quyền truy cập');
        }

        return $next($request);
    }
}