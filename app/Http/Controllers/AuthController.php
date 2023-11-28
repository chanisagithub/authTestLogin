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
                'message' => 'fail',

            ], Response::HTTP_UNAUTHORIZED);
        } else {
            

            return $user = Auth::user();
        
            // $token = $user->createToken('token')->plainTextToken;

            // $cookie = cookie('jwt', $token, 60 * 24); //one day

            // return response([
            //     'token' => $token,
            // ])->withCookie($cookie);
        }
    }


    public function user()
    {
        return Auth::user();
    }

    public function logout()
    {
        $cookie = Cookie::forget('jwt');

        return response(['message' => 'logout success'])->withCookie($cookie);
    }

    public function test()
    {
        return 'test';
    }
}
