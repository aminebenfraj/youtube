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
    // Validation goes here if needed

    // Assuming you have a file input with the name 'video' in your form
    $video = $request->file('video');

    // // Upload the video to Cloudinary
    // $upload = Cloudinary::uploadVideo($video->getRealPath(), ['resource_type' => 'video', 'folder' => 'uploads']);

    // // Access the Cloudinary URL
    // $videoUrl = $upload->getSecurePath();

    // Additional logic to store other form data in the database
    $title = $request->input('title');
    $description = $request->input('description');

    // Save video data to the database
    // Video::create([
    //     'title' => $title,
    //     'description' => $description,
    //     'url' => $videoUrl,
    //     'views_count' => 0,
    //     'userid' => 1,
    // ]);

    return redirect()->route('videos.create')->with('success', 'Video created successfully');
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
