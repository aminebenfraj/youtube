<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        return view('videos.index', compact('videos'));
    }

    public function create()
    {
        return view('videos.create');
    }

    public function store(Request $request)
{
    try {
        // Upload video to Cloudinary
        $uploadedFileUrl = Cloudinary::uploadVideo($request->file('video')->getRealPath())->getSecurePath();

        // Additional logic to store other form data in the database
        $title = $request->input('title');
        $description = $request->input('description');

        // Create a new Video record in the database
        $video = Video::create([
            'title' => $title,
            'description' => $description,
            'url' => $uploadedFileUrl,
            'views_count' => 0,
            'userid' => 1,
        ]);

        return redirect()->route('videos.show',$video->id)->with('success', 'Video created successfully');
    } catch (\Exception $e) {
        // Handle the error, for example, log it or return a response with an error message
        return redirect()->route('videos.create')->with('error', 'Failed to upload video');
    }
}



    public function show($id)
    {
        $video = Video::find($id);
        return view('videos.show', compact('video'));
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
}
