<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Socialite;
use App\Models\User;

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

    /**
     * Redirect the user to the Google authentication page.
     * 
     * @param $provider - the OAuth provider, such as google
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Google.
     * 
     * @param $provider - the OAuth provider, such as google
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $authUser = User::firstOrCreate([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'google_id' => $user->getId(),
        ]);

        Auth::login($authUser);

        return redirect('/');

    }
}
