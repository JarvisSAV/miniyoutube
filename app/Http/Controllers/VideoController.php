<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Abre el formulario de captura de registros
        return view('video.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validacion del formulario
        $validateData = $this->validate($request, [
            'title' => 'required|min:5',
            'description' => 'required',
            'video' => 'mimes:mp4'
        ]);

        $video = new Video();
        $user = Auth::user();
        $video->user_id = $user->id;
        $video->title = $request->input('title');
        //Subida de la miniatura
        $image = $request->file('image');
        if ($image) {
            $image_path = time() . $image->getClientOriginalName();
            // \Storage::disk('images')->put($image_path, \File::get($image));

            $video->image = $image_path;
        }

        $video->description = $request->input('description');
        //Subida de la miniatura
        $image = $request->file('image');
        if ($image) {
            $image_path = time() . $image->getClientOriginalName();
            // \Storage::disk('images')->put($image_path, \File::get($image));

            $video->image = $image_path;
        }

        //Subida del video
        $video_file = $request->file('video');
        if ($video_file) {
            $video_path = time() . $video_file->getClientOriginalName();
            // \Storage::disk('videos')->put($video_path, \File::get($video_file));
            $video->video_path = $video_path;
        }
        // $video->save();
        return redirect()->route('home')->with(array(
            'message' => 'El video se ha subido correctamente'
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
