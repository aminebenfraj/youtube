<?php

namespace App\Http\Controllers;

use App\Models\CommentReaction;
use Illuminate\Http\Request;

class CommentReactionController extends Controller
{
    public function like($commentid,$videoid)
    {

    $existingReaction = CommentReaction::where('userid', auth()->user()->id)
        ->where('commentid', $commentid)
        ->first();

    if ($existingReaction !== null) {
        if ($existingReaction->type == true) {
            // If the existing reaction type is already true, delete it (unlike)
            $existingReaction->delete();
            $message = 'Video reaction removed successfully.';
        } else {
            // If the existing reaction type is false, you can decide what to do here
            // For example, update the type to true or handle it according to your logic
            $existingReaction->update(['type' => true]);
            $message = 'Video reaction updated successfully.';
        }
    } else {
        // If no reaction exists, create a new one
        CommentReaction::create([
            'type' => true,
            'commentid' => $commentid,
            'userid' => auth()->user()->id,
        ]);
        $message = 'Video reaction created successfully.';
    }

    return redirect()->route('videos.show', $videoid);
}



    public function dislike($commentid,$videoid) {

    $existingReaction = CommentReaction::where('userid', auth()->user()->id)
        ->where('commentid', $commentid)
        ->first();

    if ($existingReaction !== null) {
        if ($existingReaction->type == false) {
            // If the existing reaction type is already true, delete it (unlike)
            $existingReaction->delete();
            $message = 'Video reaction removed successfully.';
        } else {
            // If the existing reaction type is false, you can decide what to do here
            // For example, update the type to true or handle it according to your logic
            $existingReaction->update(['type' => false]);
            $message = 'Video reaction updated successfully.';
        }
    } else {
        // If no reaction exists, create a new one
        CommentReaction::create([
            'type' => false,
            'commentid' => $commentid,
            'userid' => auth()->user()->id,
        ]);
        $message = 'Video reaction created successfully.';
    }

    return redirect()->route('videos.show', $videoid);

}
}
