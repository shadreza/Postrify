<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
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
        if (!auth()->attempt($request->only('email', 'password'))) {
            // shortcut for redirecting back from where we came
            // with will flash a message to the session
            return back()->with('status', 'Invalid Login Details');
        }

        // redirect
        return redirect()->route('dashboard');
    }
}
