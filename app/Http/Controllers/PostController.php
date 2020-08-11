<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('posts.index', compact('posts'));
    }

    public function like(): JsonResponse
    {
        $post = Post::find(request()->id);

        if ($post->isLikedByLoggedInUser()) {
            $res = Like::where([
                'user_id' => auth()->user()->id,
                'post_id' => request()->id
            ])->delete();

            if ($res) {
                return response()->json([
                    'count' => Post::find(request()->id)->likes->count()
                ]);
            }

        } else {
            $like = new Like();

            $like->user_id = auth()->user()->id;
            $like->post_id = request()->id;

            $like->save();

            return response()->json([
                'count' => Post::find(request()->id)->likes->count()
            ]);
        }
    }
}
