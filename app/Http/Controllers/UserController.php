<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use App\Models\Video;
use Carbon\Carbon;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function videos($id)
    {
        $isSubscribed = false;

        if(auth()->user() && $id == auth()->user()->id){
            $user = auth()->user();
        } else{
            $user = User::find($id);
            if(auth()->user()) {
                $subscription = Subscription::where('subscriberid', auth()->user()->id)->where('subscribedtoid', $user->id)->first();
                if($subscription != null) {
                    $isSubscribed = true;
                }

            }
        }

        $videos = Video::where('userid',$id)->latest()->get();

        foreach ($videos as $video) {
            $video->formatted_created_at = $this->formatTimeAgo($video->created_at);
            $video->formatted_views_count = $this->formatViewCount($video->views_count);
        }
        
        return view('users.videos', compact('user','videos','isSubscribed'));
    }

    public function about($id)
    {
        $isSubscribed = false;

        if(auth()->user() && $id == auth()->user()->id){
            $user = auth()->user();
        } else{
            $user = User::find($id);
            if(auth()->user()) {
                $subscription = Subscription::where('subscriberid', auth()->user()->id)->where('subscribedtoid', $user->id)->first();
                if($subscription != null) {
                    $isSubscribed = true;
                }

            }
        }

        return view('users.about', compact('user','isSubscribed'));
    }

    public function settings($id)
    {
        $isSubscribed = false;

        if(auth()->user() && $id == auth()->user()->id){
            $user = auth()->user();
            return view('users.settings', compact('user','isSubscribed'));
        } else {
            return redirect()->back();
        }

    }

    public function update(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|min:8',
            'bio' => 'required|string|max:255',
        ]);

        $user = User::find(auth()->user()->id);

        if (!$user) {
            return redirect()->route('login')->with('error', 'User not found');
        }

        if ($request->hasFile('profile')) {
            $uploadedProfilePicUrl = Cloudinary::upload($request->file('profile')->getRealPath())->getSecurePath();
            $user->image = $uploadedProfilePicUrl;
        }


        $user->update($request->except('profile'));

        return redirect()->route('users.settings', auth()->user()->id)->with('success', 'Profile updated successfully');
    }


    public function security(Request $request) {
        $user = User::find(auth()->user()->id);

        $request->validate([
            'oldPassword' => ['required'],
            'newPassword' => ['required', 'string', 'confirmed'],
        ]);
    
        if (!Hash::check($request->oldPassword, $user->password)) {
            return redirect()->back()->withErrors(['oldPassword' => 'The old password is incorrect.']);
        }
        
        $user->update([
            'password' => Hash::make($request->newPassword),
        ]);
    
        return redirect()->route('users.settings', auth()->user()->id);
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
