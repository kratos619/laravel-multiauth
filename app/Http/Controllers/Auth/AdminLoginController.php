<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function showForm()
    {
        return view('auth.admin-login');
    }
    public function login(Request $request)
    {
        //Validate the form

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        //Attempt to log user In
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            //if successfull redurect to location
            return redirect()->intended(route('admin.dashboard'));
        }
        // in not reditrect to back
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
