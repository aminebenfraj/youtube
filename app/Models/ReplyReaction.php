<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyReaction extends Model
{
    protected $fillable = ['type', 'replyid', 'userid'];
}
