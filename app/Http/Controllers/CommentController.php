<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //Store a newly created comment.
    public function store(Request $request)
    {
        request()->validate(['body' => 'required|min:2|max:255']);//Validate user input

        $input = $request->all();

        $input['user_id'] = Auth::id(); //Add user Id

        Comment::create($input);

        return redirect()->back();
    }

    //Update the specified Comment.
    public function update(Request $request, Comment $comment)
    {
        request()->validate(['body' => 'required|min:2|max:255']);//Validate user input

        $comment->update($request->all());

        return redirect()->back();
    }

    //Remove the specified Comment from storage.
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->back();
    }
}
