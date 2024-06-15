<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\User;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];


    /** ----------- RELATIONSHIP ----------- */

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function comment () {
        return $this->hasMany(Comment::class);
    }
}