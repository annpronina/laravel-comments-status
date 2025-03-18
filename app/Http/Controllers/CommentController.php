<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller implements HasMiddleware
{

    public static function middleware() {
        return [
            new Middleware('auth:sanctum', except: ['index', 'show'])
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Post $post)
    {
        return $post->comments;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        // return $request->user()->id;
        $request->validate([
            'content' => 'required'
        ]);
        
        return Comment::create ([
            'post_id' => $post->id,
            'user_id'=> $request->user()->id,
            'content' => $request->content
        ]);

        // $comment = $request->user()->comments()->create($fields);
        // return $comment;
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        Gate::authorize('modify', $comment);
        $comment->delete();
        return ['message' => "The comment ($comment->id) has been deleted"];
        
    }
}
