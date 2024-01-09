<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoReaction extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'videoid', 'userid'];

    public function replyReactions()
    {
        return $this->hasMany(ReplyReaction::class, 'replyid');
    }
}
