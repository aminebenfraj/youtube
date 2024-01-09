<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentReaction;
use App\Models\Reply;
use App\Models\ReplyReaction;
use App\Models\Subscription;
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
        if (auth()->user()) {

            $subscriptions = Subscription::where('subscriberid', auth()->user()->id)->take(4)->get();
            $subscribedUserIds = $subscriptions->pluck('subscribedtoid')->toArray();

            $subscriptionsVideos = Video::whereIn('userid', $subscribedUserIds)->get();

            foreach ($subscriptionsVideos as $video) {
                $video->formatted_created_at = $this->formatTimeAgo($video->created_at);
                $video->formatted_views_count = $this->formatViewCount($video->views_count);
            }

            $trendingVideos = Video::whereNotIn('id', $subscriptionsVideos->pluck('id'))->orderBy('views_count', 'desc')->take(4)->get();

            foreach ($trendingVideos as $video) {
                $video->formatted_created_at = $this->formatTimeAgo($video->created_at);
                $video->formatted_views_count = $this->formatViewCount($video->views_count);
            }

            $latestVideos = Video::whereNotIn('id', $subscriptionsVideos->pluck('id'))
                ->whereNotIn('id', $trendingVideos->pluck('id'))
                ->latest()
                ->take(4)
                ->get();

            foreach ($latestVideos as $video) {
                $video->formatted_created_at = $this->formatTimeAgo($video->created_at);
                $video->formatted_views_count = $this->formatViewCount($video->views_count);
            }



            return view('home', compact('latestVideos', 'trendingVideos', 'subscriptionsVideos'));
        } else {
            $trendingVideos = Video::orderBy('views_count', 'desc')->take(4)->get();

            foreach ($trendingVideos as $video) {
                $video->formatted_created_at = $this->formatTimeAgo($video->created_at);
                $video->formatted_views_count = $this->formatViewCount($video->views_count);
            }

            $latestVideos = Video::whereNotIn('id', $trendingVideos->pluck('id'))
                ->latest()
                ->take(4)
                ->get();

            foreach ($latestVideos as $video) {
                $video->formatted_created_at = $this->formatTimeAgo($video->created_at);
                $video->formatted_views_count = $this->formatViewCount($video->views_count);
            }

        }

        return view('home', compact('latestVideos', 'trendingVideos'));
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

        $video->increment('views_count');

        $video->formatted_created_at = $this->formatTimeAgo($video->created_at);
        $video->formatted_views_count = $this->formatViewCount($video->views_count);

        $user = User::find($video->userid);

        $sameUserSideVideos = Video::whereNotIn('id',[$video->id])->where('userid', $user->id)->orderBy('views_count', 'desc')->take(20)->get();

        if ($sameUserSideVideos->count() < 20 ) {
            $otherVideos = Video::whereNotIn('id', $sameUserSideVideos->pluck('id')->push($video->id))->orderBy('views_count', 'desc')->take(20 - $sameUserSideVideos->count())->get();
            $sideVideos = $sameUserSideVideos->concat($otherVideos);
        } else {
            $sideVideos = $sameUserSideVideos;
        }

        foreach ($sideVideos as $sideVideo) {
            $sideVideo->formatted_created_at = $this->formatTimeAgo($sideVideo->created_at);
            $sideVideo->formatted_views_count = $this->formatViewCount($sideVideo->views_count);
        }

        $isSubscribed = false;

        if(auth()->user()) {
            $subscription = Subscription::where('subscriberid', auth()->user()->id)->where('subscribedtoid', $user->id)->first();
            if($subscription != null) {
                $isSubscribed = true;
            }
        }

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

        return view('videos.show', compact('video', 'likes', 'dislikes', 'user', 'comments', 'sideVideos', 'isSubscribed'));
    }

    public function edit($id)
    {
        $video = Video::find($id);
        return view('videos.edit', compact('video'));
    }

    public function update(Request $request, $id)
    {

        try {

            $title = $request->input('title');

            $description = $request->input('description');


            if ($request->hasFile('thumbnail')) {
                $uploadedThumbnailUrl = Cloudinary::upload($request->file('thumbnail')->getRealPath())->getSecurePath();
                Video::find($id)->update([
                    'title' => $title,
                    'description' => $description,
                    'thumbnail' => $uploadedThumbnailUrl,
                ]);
            } else {

                Video::find($id)->update([
                    'title' => $title,
                    'description' => $description,
                ]);
            }

            return redirect()->route('videos.show', $id)->with('success', 'Video created successfully');
        } catch (\Exception $e) {
            // Handle the error, for example, log it or return a response with an error message
            return redirect()->route('videos.edit', $id);
        }
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);

        // Delete related comments and their replies
        $video->comments()->each(function ($comment) {
            // Delete comment reactions
            $comment->commentReactions()->delete();

            $comment->replies()->each(function ($reply) {
                // Delete reply reactions
                $reply->replyReactions()->delete();
                $reply->delete();
            });

            // Delete the comment
            $comment->delete();
        });

        // Delete related video reactions
        $video->videoReactions()->delete();

        // Additional logic to check if the authenticated user has permission to delete the video

        // Delete the video
        $video->delete();

        return redirect()->route('home')->with('success', 'Video, comments, replies, and related records deleted successfully.');
    }



    public function trending()
    {
        $videos = Video::orderBy('views_count', 'desc')->get();

        // Update created_at to human-readable format
        foreach ($videos as $video) {
            $video->formatted_created_at = $this->formatTimeAgo($video->created_at);
            $video->formatted_views_count = $this->formatViewCount($video->views_count);
        }

        return view('videos.trending', compact('videos'));
    }

    public function subscriptions()
    {
        $subscriptions = Subscription::where('subscriberid', auth()->user()->id)->get();

        $subscribedUserIds = $subscriptions->pluck('subscribedtoid')->toArray();

        $videos = Video::whereIn('userid', $subscribedUserIds)->get();

        foreach ($videos as $video) {
            $video->formatted_created_at = $this->formatTimeAgo($video->created_at);
            $video->formatted_views_count = $this->formatViewCount($video->views_count);
        }

        return view('videos.subscriptions', compact('videos'));

    }

    public function mine()
    {

        $videos = Video::where('userid', auth()->user()->id)->latest()->get();

        foreach ($videos as $video) {
            $video->formatted_created_at = $this->formatTimeAgo($video->created_at);
            $video->formatted_views_count = $this->formatViewCount($video->views_count);
        }

        return view('videos.mine', compact('videos'));
    }

    public function liked()
    {
        $liked = VideoReaction::where('userid', auth()->user()->id)->where('type', true)->get();

        $likedVideoIds = $liked->pluck('videoid')->toArray();

        $videos = Video::whereIn('id', $likedVideoIds)->get();

        foreach ($videos as $video) {
            $video->formatted_created_at = $this->formatTimeAgo($video->created_at);
            $video->formatted_views_count = $this->formatViewCount($video->views_count);
        }

        return view('videos.liked', compact('videos'));
    }

    public function search(Request $request, $query = null)
    {
        $query = $query ?? $request->input('query');

        // Search for videos based on title and description
        $videos = Video::where('title', 'like', "%$query%")
            ->get();

        foreach ($videos as $video) {
            $video->formatted_created_at = $this->formatTimeAgo($video->created_at);
            $video->formatted_views_count = $this->formatViewCount($video->views_count);
        }

        return view('videos.search', compact('videos', 'query'));
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
