<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Annonce;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, Annonce $annonce)
{
    $request->validate([
        'content' => 'required|string', 
    ]);

    $comment = new Comment();
    $comment->content = $request->content; 
    $comment->user_id = Auth::id();
    $comment->annonce_id = $annonce->id;
    $comment->save();

    return redirect()->route('annonces.show', $annonce->id)->with('success', 'Comment added successfully.');
}

public function destroy(Comment $comment)
    {
        // to mke sure that the owner of the user 
        if (Auth::id() === $comment->user_id) {
            $comment->delete();

            return redirect()->back()->with('success', 'Comment deleted successfully.');
        }

        return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
    }

    public function edit(Comment $comment)
    {
                // to make sure that the owner of the user 

        if (Auth::id() !== $comment->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to edit this comment.');
        }

        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
    
                // to make sure that the owner of the user 

        if (Auth::id() !== $comment->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to update this comment.');
        }

        $request->validate([
            'content' => 'required|string',
        ]);

        $comment->contenu = $request->content;
        $comment->save();

        return redirect()->route('annonces.show', $comment->annonce_id)->with('success', 'Comment updated successfully.');
    
}
}
