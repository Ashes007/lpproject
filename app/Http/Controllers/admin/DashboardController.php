<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {

      //$user = Auth::guard('admin')->user();
      //dd($user);
    	return view('admin.dashboard');
    }

    public function login()
    {
    	return view('admin.login');
    }

    public function doLogin(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:5'
      ]);
//echo $request->email."==".$request->password.$request->remember; die();
      // Attempt to log the user in
      if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        // if successful, then redirect to their intended location
        return redirect()->intended(route('admin_dashboard'));
      }

      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->with('err_login','Invalid Username or Password')->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
      Auth::guard('admin')->logout();
      return redirect()->route('admin_login');
    }
}
