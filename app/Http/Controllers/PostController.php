<?php

namespace App\Http\Controllers;

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
        dd($request);
    }

}
