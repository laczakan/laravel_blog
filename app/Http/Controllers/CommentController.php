<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Comment;

class CommentController extends Controller
{

    // Save comment to database
    public function store(Request $request, Article $article)
    {
        $request->validate([
            'content' => ['required', 'min:4', 'max:1000'],
        ]);

        $comments = new Comment;
        $comments->user_id = Auth::id();
        $comments->article_id = $article->id;
        $comments->content = $request->input('content');
        $comments->status = 'active';
        $comments->updated_at = null;
        $comments->save();

        return redirect('articles/'. $article->id)->with('success', 'Comment added');
    }

    // Show edit comment form
    public function edit(Comment $comment)
    {
        return view('comments.edit')->with('comment', $comment);
    }

    // Save Edited comment to database
    public function update(Comment $comment, Request $request)
    {
        $request->validate([
            'content' => ['required', 'min:4', 'max:1000'],
        ]);

        $comment->content = $request->input('content');
        $comment->save();

        return redirect('articles/' . $comment->article_id)->with('success', 'Comment edited succesfully');
    }

    // Soft delete comment
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect('articles/' . $comment->article_id)->with('success', 'Comment deleted!');
    }
}
