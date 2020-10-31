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

        $input = $request->all();

        $input['user_id'] = Auth::id(); //Add user Id

        Reply::create($input);

        return redirect()->back();
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

        return redirect()->back();
    }

    //Remove the specified reply from storage.
    public function destroy(Reply $reply)
    {
        $reply->delete();

        return redirect()->back();
    }
}
