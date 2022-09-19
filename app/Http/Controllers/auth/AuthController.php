<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function registration(Request $request)
    {
        $request->validate([
            'username'=>'required|max:191',
            'email'=>'required|email|unique:users,email',
            'password'=>'required',
        ]);


        $user = new User;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json(['message'=>'User Successfully Created'],200);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)){
            $user = $request->user();
            $user->api_token = Str::random(100);
            $user->save();
            return response()->json(['User'=>$user],200);
        }
        return response()->json(['message'=>'login failed email does not exist','Email'=>$request->email],401);

    }
    public function logout()
    {

        $user = Auth::user();
        if ($user)
        {
            $user->api_token = null;
            $user->save();
        }
        return response()->json(['message'=>'User logout Successfully'],200);
    }
}
