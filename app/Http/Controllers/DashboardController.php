<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    // constructor will be working with the middleware

    // adding the dashboard route
    // adding the auth middleware so that user must be logged in and valid
    // Route::get('dashboard', [DashboardController::class, 'index'])
    //     ->name('dashboard')
    //     ->middleware('auth');

    // an alternative to the above snippet is bellow

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    //  this is for the view returning
    public function index()
    {
        return view('dashboard');
    }
}
