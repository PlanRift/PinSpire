<?php

namespace App\Http\Controllers;

use App\Models\likes;
use App\Models\posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('LikedPost')->only('like');
        $this->middleware('PemilikLike')->only('unlike');
    }

    public function like($id)
    {
        // $request->validate([
        //     'post_id'   =>  'required|exists:posts,id',
        // ]);

        // $request['author'] = Auth::user()->id;

        // $like = likes::create($request->all());

        // $like = likes::findOrFail($id);
        $author = Auth::user()->id;
        $post = posts::findOrFail($id);

        $like = likes::create([
            'author' => $author,
            'post_id' => $post->id
        ]);

        return response()->json([
            'string' => 'You Have Liked This Post'
        ]);
    }

    public function unlike($id)
    {
        $like = likes::findOrFail($id);
        $like->delete();

        return response()->json([
            'message' => 'ok no more likes'
        ]);
    }
}
