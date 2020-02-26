<?php

namespace App\Http\Controllers;

use App\CommentRating;

class CommentRatingController extends Controller
{
    public function index()
    {
        $comments = CommentRating::where('content', '<>', '')
            ->with('user:id,name')
            ->with('product:id,name')
            ->paginate(10);

        return view('Admin.comment.index', compact('comments'));
    }

    public function show($id)
    {
        $comment = CommentRating::where('id', $id)
            ->with('user:id,name')
            ->with('product:id,name')
            ->first();

        return view('Admin.comment.show', compact('comment'));
    }

    public function update($id)
    {
        $comment = CommentRating::where('id', '=', $id)->firstOrFail();
        if ($comment->rating) {
            $comment->content = '';
            $comment->save();
        } else {
            $comment->delete();
        }
        return redirect()->route('comment.index');
    }
}
