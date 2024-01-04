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
}
