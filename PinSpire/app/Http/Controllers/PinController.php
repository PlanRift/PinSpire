<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShowPinResource;
use App\Models\posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PinController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('create', 'edit', 'delete');
    }

    public function index()
    {
        $post = posts::all();
        return ShowPinResource::collection($post->loadMissing('writer:id,username'));
    }

    public function show($id)
    {
        $post = posts::findOrFail($id);
        return new ShowPinResource($post);
    }

    function generateRandomString($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function create(Request $request)
    {
        $request->validate([
            'title'         => 'required',
            'description'   => 'required',
        ]);

        if ($request->file) {

            $validated = $request->validate([
                'file' => 'mimes:jpg,jpeg,png|max:100000'
            ]);

            $filename = $this->generateRandomString();
            $extension = $request->file->extension();

            $request['image'] = $filename . '.' . $extension;
            $request['author'] = Auth::user()->id;
            $post = posts::create($request->all());
        }

        $request['image'] = $filename . '.' . $extension;
        $request['author'] = Auth::user()->id;
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
