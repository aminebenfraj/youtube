<?php

namespace App\Http\Controllers;

use App\Models\VideoReaction;

class VideoReactionController extends Controller
{

    public function like($videoId)
    {

    $existingReaction = VideoReaction::where('userid', auth()->user()->id)
        ->where('videoid', $videoId)
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
        VideoReaction::create([
            'type' => true,
            'videoid' => $videoId,
            'userid' => auth()->user()->id,
        ]);
        $message = 'Video reaction created successfully.';
    }

    return redirect()->route('videos.show', $videoId)->with('success', $message);
}



    public function dislike($videoId) { // Assuming you are hardcoding user ID for testing

    $existingReaction = VideoReaction::where('userid', auth()->user()->id)
        ->where('videoid', $videoId)
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
        VideoReaction::create([
            'type' => false,
            'videoid' => $videoId,
            'userid' => auth()->user()->id,
        ]);
        $message = 'Video reaction created successfully.';
    }

    return redirect()->route('videos.show', $videoId)->with('success', $message);

}
}