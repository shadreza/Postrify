<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
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

        dd('store');

        // store the user
        // signing the user in
        // redirect
    }
}
