<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfileResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('logout', 'profile');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
     
        $user = User::where('email', $request->email)->first();
     
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
     
        return $user->createToken('user login')->plainTextToken;
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['string' => 'you have logged out!']);
    }

    public function profile()
    {
        $user = Auth::user();
        return new ProfileResource($user);
    }
}
