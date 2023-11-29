<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        return User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response([
                'message' => 'Invalid credentials',

            ], Response::HTTP_UNAUTHORIZED);
        } else {
            
            $user = User::where('email', $request->input('email'))->firstOrFail();
        
            $token = $user->createToken('auth_token')->plainTextToken;

            // $cookie = cookie('jwt', $token, 60 * 24);

            return response()->json([
                'user' => $user,
                'auth_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }
    }


    public function getUser()
    {
        
        return Auth::user();
    }

    public function authUser()
    {
        return Auth::user();
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'message' => 'Logged out',
        ],Response::HTTP_OK );
    }

    public function test()
    {
        return 'test';
    }

    public function authTest()
    {
        return 'test';
    }
}
