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
    public function store()
    {
        dd('abc');
    }
}
