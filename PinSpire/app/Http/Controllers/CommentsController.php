<?php

namespace App\Http\Controllers;

use App\Http\Resources\commentsResource;
use App\Models\comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
   
    public function comment(Request $request)
    {
        $validate = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comments_content' => 'required'
        ]);

        $request['author'] = Auth::user()->id;

        $comment = comments::create($request->all());

        return new commentsResource($comment->loadMissing('commentator'));
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'comments_content' => 'required'
        ]);

        $comment = comments::findOrFail($id);
        $comment->update($request->all());

        return new commentsResource($comment->loadMissing('commentator'));
    }

    public function delete($id)
    {
        $comment = comments::findOrFail($id);
        $comment->delete();

        return response()->json([
            'message' => 'This Comment Has Been Deleted'
        ]);
    }
}
