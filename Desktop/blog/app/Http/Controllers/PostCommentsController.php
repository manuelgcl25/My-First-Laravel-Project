<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentsController extends Controller
{
    public function store (Post $post)
        {
            // validate:
            request()->validate([
                'body' => 'required'
            ]);

            // perform an action:
            $post->comments()->create([
                'user_id' => auth()->user()->id,
                'body' => request('body')
            ]);

            // redirect
            return back()->with('success', 'Your comment has been submitted.');
        }
}
