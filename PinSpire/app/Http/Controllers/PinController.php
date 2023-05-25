<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShowPinResource;
use App\Models\posts;
use Illuminate\Http\Request;
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
        return ShowPinResource::collection($post);
    }

    public function show($id)
    {
        $post = posts::findOrFail($id);
        return new ShowPinResource($post);
    }

    public function create(Request $request)
    {
        $request->validate([
            'image'         => 'required',
            'title'         => 'required',
            'description'   => 'required',
            'author'        => 'required'
        ]);

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
