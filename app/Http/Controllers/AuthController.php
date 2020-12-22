<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => ' required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'message' => 'Bad request'
            ]);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'status' => 200,
            'message' => 'User registered succesfully'
        ]);

    }

    public function login( Request $request ){
        $validator = Validator::make($request->all(),[
            'email' => ' required|email',
            'password' => 'required|min:6'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'message' => 'Bad credentials'
            ]);
        }

        $credentials = $request->only('email', 'password');

        if(!Auth::attempt($credentials)){
            return response()->json([
                'status' => 500,
                'message' => 'Unauthorized'
            ]);
        }

        $user = User::where('email',$request->email)->first();

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'status' => 200,
            'token' => $token
        ]);
    }

    public function logout( Request $request ){
        $request->user()->tokens()->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Token deleted successfully',
            'user' => $request->user()
        ]);
    }
}
