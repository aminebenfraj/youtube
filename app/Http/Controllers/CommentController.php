<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    
    public function store(Request $request, $videoid) {

        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        Comment::create([
            'content' => $request->input('comment'),
            'videoid' => $videoid,
            'userid' => 1
        ]);

        return redirect()->route('videos.show', $videoid);
    }

    public function destroy($id, $videoid)
    {
        Comment::find($id)->delete();
        // delete all replies, all comment reactions and all reply reactions
        return redirect()->route('videos.show', $videoid);
    }
}
