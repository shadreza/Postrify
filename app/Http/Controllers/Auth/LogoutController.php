<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    // logout the user
    public function store()
    {
        // logging the user out
        auth()->logout();

        // redirect
        return redirect()->route('home');
    }
}
