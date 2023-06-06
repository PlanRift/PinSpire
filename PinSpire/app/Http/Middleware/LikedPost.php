<?php

namespace App\Http\Middleware;

use App\Models\likes;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LikedPost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user_id = Auth::user()->id;
        $post_id = $request->route('id');

        $LikedPost = likes::where('author', $user_id)->where('post_id', $post_id)->exists();

        if ($LikedPost){
            return response()->json([
                'message' => 'You can\'t like a post two times dumbass'
            ]);
        }

        return $next($request);
    }
}
