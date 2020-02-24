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
    public function handle($request, Closure $next, $role)
    {
        // 1 => Normal User
        // 2 => Admin
        
        if (!Auth::check()){
            return redirect('guest/login');
        }

        $user = Auth::user();

        if($user->role == $role){
            return $next($request);
        }

        return redirect('unauthorized');
    }
}
