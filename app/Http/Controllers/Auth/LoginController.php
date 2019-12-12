<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
	 * Authenticate a user
	 * 
	 * @param Request
	 * 
	 * @return Response
	 */	
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json('ok');
        }

        abort(400, 'Login attempt failed');
    }

    
    /**
	 * Unauthenticate a user and flush the session
	 * 
	 * @param Request
	 * 
	 * @return void
	 */	
    public function logout(Request $request)
    {
        Auth::logout();
        \Session::flush();
    }
}
