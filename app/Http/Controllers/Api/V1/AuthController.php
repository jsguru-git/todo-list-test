<?php

namespace App\Http\Controllers\Api\V1;

use App\User;
use JWTAuth;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterFormRequest;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
	{
	    $credentials = $request->only('email', 'password');
	    if ( ! $token = JWTAuth::attempt($credentials)) {
	            return response([
	                'status' => 'error',
	                'error' => 'invalid.credentials',
	                'msg' => 'Invalid Credentials.'
	            ], 400);
	    }
	    return response([
	            'status' => 'success'
	        ])
	        ->header('Authorization', $token);
	}
    public function register(RegisterFormRequest $request)
	{
		var_dump('received request');
	    $user = new User;
	    $user->email = $request->email;
	    $user->name = $request->name;
	    $user->password = bcrypt($request->password);
	    $user->save();
	    return response([
	        'status' => 'success',
	        'data' => $user
	       ], 200);
	}
	public function user(Request $request)
	{
	    $user = User::find(Auth::user()->id);
	    return response([
	            'status' => 'success',
	            'data' => $user
	        ]);
	}
	public function refresh()
	{
	    return response([
	            'status' => 'success'
	        ]);
	}
	public function logout()
	{
	    JWTAuth::invalidate();
	    return response([
	            'status' => 'success',
	            'msg' => 'Logged out Successfully.'
	        ], 200);
	}
}
