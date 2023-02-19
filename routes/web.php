<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// adding the home route
Route::get('/', function () {
    return view('home');
})->name('home');

// adding the dashboard route
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

// adding the logout route
Route::post('logout', [LogoutController::class, 'store'])->name('logout');

// adding the login route
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'store']);

// adding the register name for the route
Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'store']);

// adding the post route
Route::get('posts', [PostController::class, 'index'])->name('posts');
Route::post('posts', [PostController::class, 'store']);
