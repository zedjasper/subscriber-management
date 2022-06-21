<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    /**
     * Display login form
     * 
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request) {
        return view('users.login');
    }

    /**
     * Handle a user login attempt.
     * Returns bearer token for rest requests and redirect link for web
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $redirectUrl = redirect()->intended('/')->getTargetUrl();
            
            //For app logins
            if($request->expectsJson()){
                $user = auth()->user();
                $user->token = $user->createToken(config('app.name'))->accessToken;
                return response()->json([
                    'user' => $user,
                    'redirect_url' => $redirectUrl
                ]);
            }else{
                $request->session()->regenerate();
 
                return $redirectUrl;
            }
        }
 
        return response()->json('The provided credentials do not match our records', 403);
    }

    public function logout(){
        auth()->logout();

        return redirect('/login');
    }
}
