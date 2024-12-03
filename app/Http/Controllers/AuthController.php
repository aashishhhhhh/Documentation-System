<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['user' => $user], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        Session::put('id', auth()->user()->id);
        Session::put('email', auth()->user()->email);
        return response()->json(['user' => Auth::user()]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'Logged out successfully']);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function checkUser()
    {
        $user = Auth::user();
        if ($user != null) {
            return response()->json($user);
            # code...
        } else {
            return response()->json('unauthenticated');
        }
    }

    public function checkPw(Request $request)
    {

        $check = Hash::check($request->password, auth()->user()->password);
        return response()->json($check);
    }

    public function changePw(Request $request)
    {
        try{
            if(auth()->user()->id!=null)
            {
                User::find(auth()->user()->id)->update([
                    'password' => Hash::make($request->password)
                ]);
            }
            return response()->json(1);
        }
        catch(Exception $e)
        {
            return response()->json($e->getMessage());
        }

    }
}
