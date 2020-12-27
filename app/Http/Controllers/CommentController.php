<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(Authenticate::class)->except(['index','show']);
    }

    //Store a newly created comment.
    public function store(Request $request)
    {
        request()->validate(['body' => 'required|min:2|max:255']);//Validate user input

        $comment = Auth::user()->comments()->create($request->all());

        return response()->json(['code'=>200,'data' => $comment], 200);
    }

    //Update the specified Comment.
    public function update(Request $request, Comment $comment)
    {
        request()->validate(['body' => 'required|min:2|max:255']);//Validate user input

        $comment->update($request->all());

        return response()->json(['code'=>200,'data' => $comment], 200);
    }

    //Remove the specified Comment from storage.
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json(['code'=>200]);
    }
}
