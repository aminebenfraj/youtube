<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

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
        Video::create($request->all());
        return redirect()->route('videos.index')->with('success', 'Video created successfully');
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
