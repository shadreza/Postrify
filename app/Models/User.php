<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Like;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        // adding the mass assignment for username col
        'username',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // adding the elequent relationship with posts
    // one to many
    // user : posts
    public function posts()
    {
        // as we have id in the user table and posts table has user_id
        // by convention we will not have to pass the next indexes with the parameters
        return $this->hasMany(Post::class);
    }

    // we will be working on the one to many elequent relationship here
    // one user can give many likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
