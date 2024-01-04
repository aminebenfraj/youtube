<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentReaction;
use App\Models\Reply;
use App\Models\ReplyReaction;
use App\Models\VideoReaction;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\User;
use Carbon\Carbon;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class VideoController extends Controller
{

    public function index()
    {
        $videos = Video::all();

        // Update created_at to human-readable format
        foreach ($videos as $video) {
            $video->formatted_created_at = $this->formatTimeAgo($video->created_at);
            $video->formatted_views_count = $this->formatViewCount($video->views_count);
        }

        return view('home', compact('videos'));
    }



    public function create()
    {
        return view('videos.create');
    }

    public function store(Request $request)
    {
        try {
            // Upload video to Cloudinary
            $uploadedVideoUrl = Cloudinary::uploadVideo($request->file('video')->getRealPath())->getSecurePath();

            $uploadedThumbnailUrl = Cloudinary::upload($request->file('thumbnail')->getRealPath())->getSecurePath();

            $title = $request->input('title');

            $description = $request->input('description');
            
            $video = Video::create([
                'title' => $title,
                'description' => $description,
                'url' => $uploadedVideoUrl,
                'thumbnail' => $uploadedThumbnailUrl,
                'views_count' => 0,
                'userid' => auth()->user()->id,
            ]);

            return redirect()->route('videos.show', $video->id)->with('success', 'Video created successfully');
        } catch (\Exception $e) {
            // Handle the error, for example, log it or return a response with an error message
            return redirect()->route('videos.create')->with('error', 'Failed to upload video');
        }
    }



    public function show($id)
{
    $video = Video::find($id);

    // Increment views_count
    $video->increment('views_count');

    $video->formatted_created_at = $this->formatTimeAgo($video->created_at);
    $video->formatted_views_count = $this->formatViewCount($video->views_count);

    $user = User::find($video->userid);

    $likes = VideoReaction::where('videoid', $id)->where('type', true)->count();
    $dislikes = VideoReaction::where('videoid', $id)->where('type', false)->count();

    $comments = Comment::where('videoid', $id)->get();

    foreach ($comments as $comment) {

        $comment->likes = CommentReaction::where('commentid', $comment->id)->where('type', true)->count();
        $comment->dislikes = CommentReaction::where('commentid', $comment->id)->where('type', false)->count();

        $comment->replies = Reply::where('commentid', $comment->id)->get();

        foreach ($comment->replies as $reply) {

            $reply->likes = ReplyReaction::where('replyid', $reply->id)->where('type', true)->count();
            $reply->dislikes = ReplyReaction::where('replyid', $reply->id)->where('type', false)->count();
            
        }
    }

    return view('videos.show', compact('video', 'likes', 'dislikes', 'user', 'comments'));
}

    public function edit($id)
    {
        $video = Video::find($id);
        return view('videos.edit', compact('video'));
    }

    public function update(Request $request, $id)
    {
        // Validation goes here if needed
        Video::find($id)->update($request->all());
        return redirect()->route('videos.index')->with('success', 'Video updated successfully');
    }

    public function destroy($id)
    {
        Video::find($id)->delete();
        return redirect()->route('videos.index')->with('success', 'Video deleted successfully');
    }

    
    public function formatTimeAgo($created_at)
    {
        $now = Carbon::now();
        $created_at = Carbon::parse($created_at);

        $diffInSeconds = $now->diffInSeconds($created_at);

        if ($diffInSeconds < 60) {
            return 'just now';
        } elseif ($diffInSeconds < 3600) {
            $minutes = round($diffInSeconds / 60);
            return "{$minutes} minutes ago";
        } elseif ($diffInSeconds < 86400) {
            $hours = round($diffInSeconds / 3600);
            return "{$hours} hours ago";
        } elseif ($diffInSeconds < 2592000) {
            $days = round($diffInSeconds / 86400);
            return "{$days} days ago";
        } elseif ($diffInSeconds < 31536000) {
            $months = round($diffInSeconds / 2592000);
            return "{$months} months ago";
        } else {
            $years = round($diffInSeconds / 31536000);
            return "{$years} years ago";
        }
    }

    public function formatViewCount($views)
    {
        if ($views >= 1e9) {
            return round($views / 1e9, 1) . 'B';
        } elseif ($views >= 1e6) {
            return round($views / 1e6, 1) . 'M';
        } elseif ($views >= 1e3) {
            return round($views / 1e3, 1) . 'K';
        } else {
            return $views;
        }
    }
}
