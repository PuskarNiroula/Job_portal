<?php

namespace App\Http\Api;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $user =User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
      $token=  $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'token' => $token,
            'message' => 'Login successful',
            'user' => $user,
            'session_user_id' => Session::get('user_id'),
        ]);
    }


    public function logout(Request $request)
    {
        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
}
