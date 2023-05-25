<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShowPinResource;
use App\Models\posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PinController extends Controller
{
    public function index()
    {
        $post = posts::all();
        return ShowPinResource::collection($post);
    }

    public function create(Request $request)
    {
        $request->validate([
            'title'         => 'required',
            'description'   => 'required',
            'author'        => 'required'
        ]);
        if($request->file) {

            $validated = $request->validate([
                'file' => 'mimes:jpg,jpeg,png|max:100000'
            ]);

            $filename = $this->generateRandomString();
            $extension = $request->file->extension();
            
            $path = Storage::putFileAs('image', $request->file, $filename.'.'.$extension);
        }

        $request['image'] = $filename.'.'.$extension;

        $post = posts::create($request->all());
        return new ShowPinResource($post);
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'title'         => 'required|string',
            'description'   => 'required|string'
        ]);

        $post = posts::findOrFail($id);
        $post->update($request->all());

        return new ShowPinResource($post);
    }

    public function delete($id)
    {
        $post = posts::findOrFail($id);
        $post->delete();

        return response()->json([
            'string' => 'this post has been deleted'
        ]);
    }
}
