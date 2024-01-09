<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['content', 'videoid', 'userid'];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class, 'commentid');
    }

    public function commentReactions()
    {
        return $this->hasMany(CommentReaction::class, 'commentid');
    }
}
