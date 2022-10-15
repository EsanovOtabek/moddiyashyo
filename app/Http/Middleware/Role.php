<?php

namespace App\Http\Middleware;

use App\Http\Controllers\RoleController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{

    public function handle(Request $request, Closure $next,... $roles)
    {
        if (!Auth::check())
            return redirect('login');

        $user = Auth::user();

        if($user->role == 'admin')
            return $next($request);

        foreach($roles as $role) {
            if(RoleController::hasRole($role))
                return $next($request);
        }

        return redirect('login');
    }
}
