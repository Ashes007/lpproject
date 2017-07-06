<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function index()
    {
    	return view('dashboard');
    }

    public function login()
    {
    	return view('login');
    }

    public function dologin(Request $request)
    {
    	$this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:5'
      ]);


    	if(Auth::guard()->attempt(['email' => $request->email, 'password' => $request->password]))
      	{
    		return redirect()->intended(route('dashboard'));
    	}

    	return redirect()->back()->with('err_login','Invalid Username or Password')->withInput($request->only('email'));
    }

    public function logout()
    {
    	Auth::guard()->logout();
    	return redirect()->route('login');
    }
}
