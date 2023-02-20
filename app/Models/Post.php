<?php

namespace App\Models;

use App\Models\User;
use App\Models\Like;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'body',
    ];

    public function likedBy(User $user)
    {
        // look inside of a collection and using the particular key it will return a boolean whether the user is within the list or not
        return $this->likes->contains('user_id', $user->id);
    }

    // as we need the name of user of a post so there needs to be a relation between post and the user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // we will be working on the one to many elequent relationship here
    // one post can have many likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
