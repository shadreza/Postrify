<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'body',
    ];

    // as we need the name of user of a post so there needs to be a relation between post and the user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
