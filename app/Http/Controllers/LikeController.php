<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function likeComment($comment_id)
    {
        $like = Auth::user()->likes()->where('comment_id', $comment_id)->first(); //check if user already liked or disLiked this comment.

        if($like)
        {
            if($like->like === 1)
            {
                $like->delete();           //if user already liked this comment the like will be deleted.
                return redirect()->back();
            }
            if($like->like === 0)
            {
                $like->update(['like' => 1]) ;  //if user already disliked this comment it will convert to like.
                return redirect()->back();
            }
        }
        else //if user didnt liked or disliked this comment a new like will be added to this comment
        {
            Like::create([
                'user_id' => auth()->id(),
                'comment_id' => $comment_id,
                'like' => 1
            ]);
            return redirect()->back();
        }
    }

    public function DislikeComment($comment_id)
    {
        $like = Auth::user()->likes()->where('comment_id', $comment_id)->first(); //check if user already liked or disLiked this comment.

        if($like)
        {
            if($like->like === 0)
            {
                $like->delete();          //if user already disliked this comment the dislike will be deleted.
                return redirect()->back();
            }
            if($like->like === 1)
            {
                $like->update(['like' => 0]) ;  //if user already liked this comment it will convert to dislike.
                return redirect()->back();
            }
        }
        else //if user didnt liked or disliked this comment a new dislike will be added to this comment
        {
            Like::create([
                'user_id' => auth()->id(),
                'comment_id' => $comment_id,
                'like' => 0
            ]);
            return redirect()->back();
        }
    }

    public function likeReply($reply_id)
    {
        $like = Auth::user()->likes()->where('reply_id', $reply_id)->first(); //check if user already liked or disLiked this reply.

        if($like)
        {
            if($like->like === 1)
            {
                $like->delete();           //if user already liked this reply the like will be deleted.
                return redirect()->back();
            }
            if($like->like === 0)
            {
                $like->update(['like' => 1]) ;  //if user already disliked this reply it will convert to like.
                return redirect()->back();
            }
        }
        else //if user didnt liked or disliked this reply a new like will be added to this reply
        {
            Like::create([
                'user_id' => auth()->id(),
                'reply_id' => $reply_id,
                'like' => 1
            ]);
            return redirect()->back();
        }
    }

    public function DislikeReply($reply_id)
    {
        $like = Auth::user()->likes()->where('reply_id', $reply_id)->first(); //check if user already liked or disLiked this reply.

        if($like)
        {
            if($like->like === 0)
            {
                $like->delete();          //if user already disliked this reply the dislike will be deleted.
                return redirect()->back();
            }
            if($like->like === 1)
            {
                $like->update(['like' => 0]) ;  //if user already liked this reply it will convert to dislike.
                return redirect()->back();
            }
        }
        else //if user didnt liked or disliked this reply a new dislike will be added to this reply
        {
            Like::create([
                'user_id' => auth()->id(),
                'reply_id' => $reply_id,
                'like' => 0
            ]);
            return redirect()->back();
        }
    }
}
