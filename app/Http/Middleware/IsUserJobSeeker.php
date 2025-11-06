<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsUserJobSeeker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user=Auth::user();
        if($user->role=="job"){
            return $next($request);
        }
        if ($request->expectsJson()) {
            return response()->json(['message' => 'You are not Job Seeker'], 403);
        }

        // Redirect to login or error page for non-JSON requests
        return redirect()->route('login')->withErrors(['message' => 'You are not Job Seeker']);
    }
}
