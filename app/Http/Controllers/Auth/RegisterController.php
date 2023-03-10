<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    // if the user is signed in he should not be able to go to the register route
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    // this will be index function
    public function index()
    {
        return view('auth.register');
    }

    // post will come to this function
    public function store(Request $request)
    {
        // validation
        $this->validate($request, [
            'name' => 'required | max:255',
            'username' => 'required | max:255',
            'email' => 'required | email | max:255',
            // in password by adding the confirmed key word in the validation
            // it will look for another field with _confirmed name and math them
            'password' => 'required | confirmed | min:8',
        ]);

        // store the user
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // signing the user in
        // auth attempt will be trying to sign the user in
        // only the email and the password will be passed
        auth()->attempt($request->only('email', 'password'));

        // redirect
        return redirect()->route('dashboard');
    }
}
