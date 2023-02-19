<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    // if the user is signed in he should not be able to go to the login route
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    //  showing the form
    public function index()
    {
        return view('auth/login');
    }

    //  signing in
    public function store(Request $request)
    {
        // validation
        $this->validate($request, [
            'email' => 'required | email',
            'password' => 'required',
        ]);

        // user sign in
        // remember me functionality needs to be passed to the auth attempt so that it can make a remember token and store it so that if we don't logout  but close the tab and when reentering into the website we won't be needing to login again
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            // shortcut for redirecting back from where we came
            // with will flash a message to the session
            return back()->with('status', 'Invalid Login Details');
        }

        // redirect
        return redirect()->route('dashboard');
    }
}
