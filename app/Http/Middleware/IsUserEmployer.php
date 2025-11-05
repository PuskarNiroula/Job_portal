<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsUserEmployer
{
    public function handle(Request $request, Closure $next)
    {
        $user=Auth::user();
        if($user->role=="emp"){
            return $next($request);
        }
        return response()->json(['message'=>'You are not employer'],403);
    }
}

