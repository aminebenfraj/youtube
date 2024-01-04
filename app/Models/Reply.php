<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['content', 'commentid', 'userid'];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }
}
