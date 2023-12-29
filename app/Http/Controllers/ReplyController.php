<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request, $commentid, $videoid) {
        
        $request->validate([
            'reply' => 'required|string|max:255',
        ]);

        Reply::create([
            'content' => $request->input('reply'),
            'commentid' => $commentid,
            'userid' => 1
        ]);

        return redirect()->route('videos.show', $videoid);
    }

    public function destroy($id, $videoid)
    {
        Reply::find($id)->delete();
        // delete all reply reactions
        return redirect()->route('videos.show', $videoid);
    }
}
