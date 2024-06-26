<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Comment;
use App\Models\Post;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    /** ----------- RELATIONSHIP ----------- */

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasManyThrough(Comment::class, Post::class, 'user_id', 'user_id', 'id', 'id');
    }

    /** ----------- SCOPES ----------- */

    public function scopesearchByName($query, $type)
    {
        return $type != null ? $query->where('name', 'LIKE', $type['name'] . '%') : $query;
    }

    public function scopesearchByEmail($query, $type)
    {
        return $type != null ? $query->where('email', $type) : $query;
    }
}
