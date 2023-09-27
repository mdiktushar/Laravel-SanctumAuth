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

    }

    public function profile () {

    }

    public function logout () {

    }
}
