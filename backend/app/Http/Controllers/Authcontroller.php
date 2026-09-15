<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class Authcontroller extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $user = User::where('email', $request->email)->first();
        if(!$user){
            return response()->json(['message' => 'User not found'], 404);
        }
        if(!Hash::check($request->password, $user->password)){
            return response()->json(['message' => 'Invalid password'], 401);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'User logged in successfully',
            'token' => $token,
            'user' => $user,
        ], 200);
    }
}
