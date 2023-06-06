<?php

namespace App\Http\Middleware;

use App\Models\likes;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PemilikLike
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id_liker = likes::findOrFail($request->id);
        $user = Auth::user();

        if($id_liker->author != $user->id){
            return response()->json(['ga bisa ngilangin like orang lain bro']);
        }

        return $next($request);
    }
}
