<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {

        $request->authenticate();


        $request->session()->regenerate();  $user = $request->user();

        // Create a personal access token
        $token = $user->createToken('authToken')->plainTextToken;
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function dashboard(){
        if(Auth::user()->role=="admin") {
            return redirect("/admin");
        }else if(Auth::user()->role=="job"){
            return redirect('/jobseeker');
        }else{
            return redirect("/employer");
        }

    }
}
