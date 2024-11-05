<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

use function PHPUnit\Framework\returnSelf;

class JWTAuthController extends Controller
{
    public function register(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = JWTAuth::fromUser($user);
        return response()->json(compact('user','token'), 201);

    }

    public function login(Request $request){
        $cred = $request->only('email', 'password');

        try{
            if(!JWTAuth::attempt($cred)){
                return response()->json(['error' => 'Invalid credentials'], 401);
            }

            $user = auth()->user();

            $token = JWTAuth::fromUser($user);

            return response()->json(compact('token'));
        
        }
        catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
    }
}
