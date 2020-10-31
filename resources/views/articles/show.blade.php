@extends('layouts.main')

@section('title', 'Article')
@section('Background', 'articleBackground')

@section('content')
    <h1>{{$article->title}}</h1>
    @if (auth()->id() === $article->user_id) {{-- check for user who created that article --}}
    <a class="btn btn-primary" href="/articles/{{$article->slug}}/edit">Edit</a>
    @endif

    @if($article->image) <img src="/images/{{$article->image}}"> @endif {{-- check if that article has an image --}}

    <div class="article">
        <h2> Article </h2>
        <p>{{$article->body}}</p>
    </div>

    @if($article->video) <video controls muted  poster="" > <source src="/videos/{{$article->video}}"> This video cannot be loaded </video> @endif {{-- check if that article has a video --}}

    <div>
        <h2>Categories</h2>
        @foreach($article->categories as $category)
            <span>{{$category->name}}</span>
        @endforeach
    </div>
@endsection

@section('comments')
    @if(count($article->comments) > 0)
        <h1>Comments</h1>
        @foreach ($article->comments as $comment)
            <div class="media">
                <a class="pull-left" href="#">
                    <img height= "40" width="40" class="media-object" src="/images/{{$comment->user->image}}">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$comment->user->fullName()}}
                        <small>{{$comment->created_at->diffforhumans()}}</small>
                    </h4>
                    <p id="comment" style="display: block">{{$comment->body}}</p>

                    <div id="editCommentForm" style="display: none">
                        {!! Form::model($comment, ['method' => 'PATCH', "action" => ['App\Http\Controllers\CommentController@update', $comment->id]]) !!}

                        {{-- Body Field --}}
                        <div class="form-group">
                            {{-- Check if the field has any errors --}}
                            @if($errors->has('body')) <div class="alert alert-danger">{{$errors->first('body') }}</div> @endif
                            {!!Form::text('body', $comment->body, ['class' => 'form-control', 'placeholder' => 'Type your comment here...'])!!}
                        </div>

                        <div>
                            {!!Form::submit('Update', ['class' => 'btn btn-primary'])!!}
                        </div>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>

            <!-- Like & Dislike -->
            <div class="interaction">
                @if (Auth::user() != $comment->user) {{--only not comment owner can like & dislike this comment.--}}
                    <?php
                    $is_like = '';

                    if (Auth::user()) //check if user is logged in.
                    {
                        if ($like = Auth::user()->likes()->where('comment_id', $comment->id)->first()) //check if user already liked or disliked this comment.
                        {
                            $is_like = $like->like;
                        }
                    }
                    ?>

                <p>{{$comment->likes()->where('like', 1)->count()}}</p>   {{--get number of likes.--}}
                {!! Form::model($comment, ['action' => ['App\Http\Controllers\LikeController@likeComment', $comment->id] , 'method' => 'POST']) !!}

                    {{Form::submit('Like', ['class' => $is_like === 1 ? 'btn btn-primary' : "btn btn-outline-primary"])}}

                {!! Form::close() !!}

                <p>{{$comment->likes()->where('like', 0)->count()}}</p>   {{--get number of Dislikes.--}}
                {!! Form::model($comment, ['action' => ['App\Http\Controllers\LikeController@DislikeComment', $comment->id] , 'method' => 'POST']) !!}

                    {{Form::submit('DisLike', ['class' => $is_like === 0 ? 'btn btn-danger' : "btn btn-outline-danger" ])}}

                {!! Form::close() !!}
                @endif
                <!-- Like & Dislike -->

                <!-- Edit & Delete -->
                @if (Auth::user() == $comment->user) {{--only content owner can edit & delete this content.--}}

                    <button id="editComment" class="btn btn-primary">Edit</button>

                    {!! Form::model($comment, ['method' => 'DELETE', "action" => ['App\Http\Controllers\CommentController@destroy', $comment->id] ]) !!}
                    <div>
                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                    </div>
                    {!! Form::close() !!}
                @endif
                <!-- Edit & Delete -->

                <button id="reply">reply</button>
            </div>

            <!-- Replies -->
            <div class="replies">
                @if(count($comment->replies) > 0)
                    @foreach($comment->replies as $reply)
                        <!-- Nested Replies -->
                        <div class="reply">
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img height= "40" width="40" class="media-object" src="/images/{{$reply->user->image}}">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">{{$reply->user->fullName()}}
                                        <small>{{$reply->created_at->diffforhumans()}}</small>
                                    </h4>
                                    <p id="reply" style="display: block">{{$reply->body}}</p>


                                    <div id="editReplyForm" style="display: none">
                                        {!! Form::model($reply, ['method' => 'PATCH', "action" => ['App\Http\Controllers\ReplyController@update', $reply->id]]) !!}

                                        {{-- Body Field --}}
                                        <div class="form-group">
                                            {{-- Check if the field has any errors --}}
                                            @if($errors->has('body')) <div class="alert alert-danger">{{$errors->first('body') }}</div> @endif
                                            {!!Form::text('body', $reply->body, ['class' => 'form-control', 'placeholder' => 'Type your comment here...'])!!}
                                        </div>

                                        <div>
                                            {!!Form::submit('Update', ['class' => 'btn btn-primary'])!!}
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                            <!-- End Nested Replies -->

                                <!-- Like & Dislike -->
                                <div class="interaction">
                                @if (Auth::user() != $reply->user) {{--only not reply owner can like & dislike this reply.--}}
                                <?php
                                $is_like = '';

                                if (Auth::user()) //check if user is logged in.
                                {
                                    if ($like = Auth::user()->likes()->where('reply_id', $reply->id)->first()) //check if user already liked or disliked this reply.
                                    {
                                        $is_like = $like->like;
                                    }
                                }

                                ?>

                                <p>{{$reply->likes()->where('like', 1)->count()}}</p>  {{--get number of likes.--}}
                                {!! Form::model($reply, ['action' => ['App\Http\Controllers\LikeController@likeReply', $reply->id] , 'method' => 'POST']) !!}

                                {{Form::submit('Like', ['class' => $is_like === 1 ? 'btn btn-primary' : "btn btn-outline-primary"])}}

                                {!! Form::close() !!}

                                <p>{{$reply->likes()->where('like', 0)->count()}}</p>  {{--get number of Dislikes.--}}
                                    {!! Form::model($reply, ['action' => ['App\Http\Controllers\LikeController@DislikeReply', $reply->id] , 'method' => 'POST']) !!}

                                {{Form::submit('DisLike', ['class' => $is_like === 0 ? 'btn btn-danger' : "btn btn-outline-danger" ])}}

                                {!! Form::close() !!}
                                @endif
                                <!-- Like & Dislike -->

                                <!-- Edit & Delete -->
                                @if (Auth::user() == $reply->user) {{--only content owner can edit & delete this content.--}}

                                <button id="editReply" class="btn btn-primary">Edit</button>

                                {!! Form::model($reply, ['method' => 'DELETE', "action" => ['App\Http\Controllers\ReplyController@destroy', $reply->id] ]) !!}
                                <div>
                                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                </div>
                            {!! Form::close() !!}
                            @endif
                            <!-- Edit & Delete -->
                            </div>
                            <hr>
                        </div>
                        @endforeach
                    @endif
            </div>
            <!-- Replies -->

            <div id="addReply" style="display: none">
                {!! Form::open(['action' => 'App\Http\Controllers\ReplyController@store', 'method' => 'POST']) !!}

                <input name="comment_id" value="{{$comment->id}}" hidden>

                {{-- body Field --}}
                <div class="form-group">
                    {{-- Check if the field has any errors --}}
                    @if($errors->has('body')) <div class="alert alert-danger">{{$errors->first('body') }}</div> @endif
                    {!!Form::text('body', '', ['class' => 'form-control', 'placeholder' => 'Type your Reply here...'])!!}
                </div>

                <div>
                    {{Form::submit('Reply', ['class' => 'btn btn-primary'])}}
                </div>
                {!! Form::close() !!}
            </div>
        @endforeach
    @endif

    <div>
        {!! Form::open(['action' => 'App\Http\Controllers\CommentController@store', 'method' => 'POST']) !!}

            <input name="article_id" value="{{$article->id}}" hidden>

        {{-- body Field --}}
            <div class="form-group">
                {{-- Check if the field has any errors --}}
                @if($errors->has('body')) <div class="alert alert-danger">{{$errors->first('body') }}</div> @endif
                {!!Form::text('body', '', ['class' => 'form-control', 'placeholder' => 'Type your Comment here...'])!!}
            </div>

            <div>
                {{Form::submit('Comment', ['class' => 'btn btn-primary'])}}
            </div>
        {!! Form::close() !!}
    </div>

    <script>
        document.getElementById("reply").onclick = function() {

            document.getElementById("addReply").style.display = "block";
        },

        document.getElementById("editComment").onclick = function() {

            document.getElementById("comment").style.display = "none";
            document.getElementById("editCommentForm").style.display = "block";
        },

        document.getElementById("editReply").onclick = function() {

            document.getElementById("reply").style.display = "none";
            document.getElementById("editReplyForm").style.display = "block";
        }
    </script>
@endsection

