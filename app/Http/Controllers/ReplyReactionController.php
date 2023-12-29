<?php

namespace App\Http\Controllers;

use App\Models\ReplyReaction;
use Illuminate\Http\Request;

class ReplyReactionController extends Controller
{
    public function like($replyid,$videoid)
    {
        $userId = 2; // Assuming you are hardcoding user ID for testing
    
        $existingReaction = ReplyReaction::where('userid', $userId)
            ->where('replyid', $replyid)
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
            ReplyReaction::create([
                'type' => true,
                'replyid' => $replyid,
                'userid' => $userId,
            ]);
            $message = 'Video reaction created successfully.';
        }
    
        return redirect()->route('videos.show', $videoid);
    }
    
    
    
        public function dislike($replyid,$videoid) {
            $userId = 2; // Assuming you are hardcoding user ID for testing
    
        $existingReaction = ReplyReaction::where('userid', $userId)
            ->where('replyid', $replyid)
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
            ReplyReaction::create([
                'type' => false,
                'replyid' => $replyid,
                'userid' => $userId,
            ]);
            $message = 'Video reaction created successfully.';
        }
    
        return redirect()->route('videos.show', $videoid);
    
    }
}
