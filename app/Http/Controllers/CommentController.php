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
}
