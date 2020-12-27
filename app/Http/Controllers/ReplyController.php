<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    //Store a newly created reply.
    public function store(Request $request)
    {
        request()->validate(['body' => 'required|min:2|max:255']);//Validate user input

        $reply = Auth::user()->replies()->create($request->all());

        return response()->json(['code'=>200,'data' => $reply], 200);
    }

    //Show the form for editing reply.
    public function edit(Comment $comment)
    {
    }

    //Update the specified reply.
    public function update(Request $request, Reply $reply)
    {
        request()->validate(['body' => 'required|min:2|max:255']);//Validate user input

        $reply->update($request->all());

        return response()->json(['code'=>200,'data' => $reply], 200);
    }

    //Remove the specified reply from storage.
    public function destroy(Reply $reply)
    {
        $reply->delete();

        return response()->json(['code'=>200]);
    }
}
