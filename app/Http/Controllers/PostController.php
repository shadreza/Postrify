<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // returning the view
    public function index()
    {
        // this will return all the posts in a collection
        // if there are millions and millions of data then that would pull all those as collection
        // thats not good
        // $posts = Post::get();

        // solution pagination -> returns in LengthAwarePaginator
        // adding eager loading
        $posts = Post::with(['user', 'likes'])->paginate(20);


        // we can pass the data in many ways

        // return view('posts.index', [
        //     'posts' => $posts
        // ]);

        return view('posts.index', compact('posts'));
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

        // the user_id will automatically filled in
        $request->user()->posts()->create($request->only('body'));

        // redirecting back
        return back();
    }
}
