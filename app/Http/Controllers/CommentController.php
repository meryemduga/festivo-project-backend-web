<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Event;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $request->validate(['body' => 'required|string']);

        $event->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        return back()->with('success', 'Reactie geplaatst!');
    }

    public function destroy(Comment $comment)
    {
        if (auth()->id() === $comment->user_id || auth()->user()->is_admin) {
            $comment->delete();
            return back()->with('success', 'Reactie verwijderd!');
        }
        abort(403);
    }
}