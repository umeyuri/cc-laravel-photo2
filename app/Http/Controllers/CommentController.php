<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(CommentRequest $request) {
        Comment::create([
            'post_id' => $request->post_id,
            'body' => $request->body,
            'user_id' => \Auth::user()->id,
        ]);

        session()->flash('success', 'コメントを投稿しました');
        
        return redirect()->route('posts.index');
    }
}
