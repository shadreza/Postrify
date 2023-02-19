<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // returning the view
    public function index()
    {
        return view('posts.index');
    }

    // post the post
    public function store(Request $request)
    {
        // validation
        $this->validate($request, [
            'body' => 'required',
        ]);

        // create the post
        // Post::create([
        //     'user_id' => auth()->id(),
        //     'body' => $request->body
        // ]);

        // as the user will have many posts so lets make a one to many relationship using the elequent relationship on the user model

    }
}
