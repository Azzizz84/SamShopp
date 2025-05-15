<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if (admin()->check()){
            Auth::setUser(admin_user());
            if ($request=='login'){
                return redirect('admin/home');
            }
            return $next($request);
        }
        return redirect('admin/login');
    }
}
