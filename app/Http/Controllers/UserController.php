<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

    public function register (Request $request) {
        $request->validate([
            'name' =>'required',
            'email' => 'required|email|unique:users',
            'password' => 'required| confirmed',
            
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone_no = isset($request->phone_no) ? $request->phone_no : '';

        $user->save();

        return response()->json([
            'status' => 200,
            'message' => 'user created',
        ], 200);
    }

    public function login (Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', '=', $request->email)->first();
        if(isset($user->id)) {
            if(Hash::check($request->password, $user->password)) {
                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'status'=> 200,
                    'message'=> 'Login successful',
                    'token' => $token
                ], 200);

            } else {
                return response()->json([
                    'status'=> 404,
                    'message' => 'password is not correct',
                ], 404);
            }
        } else {
            return response()->json([
                'status'=> 404,
                'message' => 'user not found',
            ], 404);
        }
    }

    public function profile () {
        return response()->json([
            'status'=> 200,
            'message'=> 'User Profile Information',
            'data' => auth()->user() 
        ], 200);
    }

    public function logout () {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status'=> 200,
            'message'=> 'Logout Successfully',
        ], 200);

    }
}
