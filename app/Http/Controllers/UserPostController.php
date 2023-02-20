<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserPostController extends Controller
{
    //  returning the view
    public function index(User $user)
    {
        // using eager loads
        $posts = $user->posts()->with(['user', 'likes'])->paginate(20);

        // returning the view
        return view('users.posts.index', compact('user', 'posts'));
    }
}
