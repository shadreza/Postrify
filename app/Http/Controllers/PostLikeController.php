<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostLikeController extends Controller
{

    // adding middleware
    public function __contructor()
    {
        $this->middleware(['auth']);
    }

    //  storing the like
    public function store(Post $post, Request $request)
    {
        // if the user has already added a like then this will show an error page
        if ($post->likedBy($request->user())) {
            return response(null, 409);
        } else {
            $post->likes()->create([
                'user_id' => $request->user()->id,
            ]);

            // redirecting back
            return back();
        }
    }

    // deleting likes -> unlike
    public function destroy(Post $post, Request $request)
    {
        // unliking
        $request->user()->likes()->where('post_id', $post->id)->delete();

        // redirecting
        return back();
    }
}
