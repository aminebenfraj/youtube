<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function videos($id)
    {

        if($id == auth()->user()->id){
            $user = auth()->user();
        } else{
            $user = User::find($id);
        }

        $videos = Video::where('userid',$id)->latest()->get();
        return view('users.videos', compact('user','videos'));
    }

    public function about($id)
    {
        $user = User::find($id);
        return view('users.about', compact('user'));
    }

    public function settings($id)
    {
        $user = User::find($id);
        return view('users.settings', compact('user'));
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

}
