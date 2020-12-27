@extends('layouts.main')

@section('title', 'Article')
@section('Background', 'articleBackground')

@section('content')
    <h1>{{$article->title}}</h1>

    <!-- favourite Button -->
    @if (Auth::check())
        <?php
        $is_favourite = '';

        ($favourite = Auth::user()->favourites()->where('article_id', $article->id)->first()) ? $is_favourite = 1 : $is_favourite = '';
        ?>
        @if($is_favourite === 1)
            <a onclick="Favouriate({{$article->id}})"><i id="favouriteButton" class="fa fa-heart favourite"></i></a>
        @else
            <a onclick="Favouriate({{$article->id}})"><i id="favouriteButton" class="fa fa-heart unfavourite"></i></a>
        @endif
    @endif
    <!-- favourite Button -->

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
            <div id='comment_{{$comment->id}}'>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img height= "40" width="40" class="media-object" src="/images/{{$comment->user->image}}">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$comment->user->fullName()}}
                            <small>{{$comment->created_at->diffforhumans()}}</small>
                        </h4>
                        <p id="commentBody_{{$comment->id}}" style="display: block">{{$comment->body}}</p>

                        <div id="editCommentForm_{{$comment->id}}" style="display: none">
                            <form name="EitCommentForm" class="form-horizontal">
                                {{-- body Field --}}
                                <div class="form-group">
                                    <p id="editcommenterror_{{$comment->id}}" class="alert alert-danger" style="display: none"></p>
                                    <input type="text" class="form-control" id="editcommentbody_{{$comment->id}}" name="body" value="{{$comment->body}}" placeholder="Type your Comment here...">
                                </div>

                                <div> <button type="button" class="btn btn-primary" onclick="EditComment({{$comment->id}})">Comment</button> </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="interaction">
                <!-- Like & Dislike Comments -->
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

                    <p id="youCommentLike_{{$comment->id}}" <?php if($is_like !== 1){ echo 'style="display: none"'; } ?>>you and</p>
                    <p>{{$comment->likes()->where('like', 1)->count()}}</p>   {{--get number of likes.--}}
                    <a onclick="LikeComment({{$comment->id}})"><i id="likeCommentButton_{{$comment->id}}"  class="fa fa-thumbs-up like" <?php if($is_like !== 1){ echo 'style =" color:lightgray"'; } ?>></i></a>

                    <p id="youCommentDislike_{{$comment->id}}" <?php if($is_like !== 0){ echo 'style="display: none"'; } ?>>you and</p>
                    <p>{{$comment->likes()->where('like', 0)->count()}}</p>   {{--get number of Dislikes.--}}
                    <a onclick="DislikeComment({{$comment->id}})"><i id="dislikeCommentButton_{{$comment->id}}"  class="fa fa-thumbs-down dislike" <?php if($is_like !== 0){ echo 'style =" color:lightgray"'; } ?>></i></a>

                    @endif
                    <!-- Like & Dislike Comments-->

                    <!-- Edit & Delete Comments -->
                    @if (Auth::user() == $comment->user) {{--only content owner can edit & delete this content.--}}

                        <a onclick="EditCommentButton({{$comment->id}})" ><i class="fa fa-pencil" style='font-size:30px;color:blue'></i></a>

                        <a onclick="DeleteComment({{$comment->id}})"><i class='fas fa-trash-alt' style='font-size:30px;color:red'></i></a>
                    @endif
                    <!-- Edit & Delete Comments -->

                    <button id="reply"  onclick="Reply({{$comment->id}})">reply</button>
                </div>

                <!-- Nested Replies -->
                <div class="replies">
                    @if(count($comment->replies) > 0)
                        @foreach($comment->replies as $reply)
                            <div id="reply_{{$reply->id}}" class="reply">
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img height= "40" width="40" class="media-object" src="/images/{{$reply->user->image}}">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{$reply->user->fullName()}}
                                            <small>{{$reply->created_at->diffforhumans()}}</small>
                                        </h4>
                                        <p id="replyBody_{{$reply->id}}" style="display: block">{{$reply->body}}</p>

                                        <!-- Edit Replies -->
                                        <div id="editReplyForm_{{$reply->id}}" style="display: none">
                                            <form name="EditReplyComment">
                                                <div class="form-group">
                                                    <p id="editreplyerror_{{$reply->id}}" class="alert alert-danger" style="display: none"></p>
                                                    <input type="text" id="editreplybody_{{$reply->id}}" name="body" value="{{$reply->body}}" class='form-control' placeholder="Your Your Reply Here...">
                                                </div>
                                                 <div> <button type="button" class= 'btn btn-primary' onclick="EditReply({{$reply->id}})">Reply</button> </div>
                                            </form>

                                        </div>
                                        <!-- Edit Replies -->
                                    </div>
                                </div>

                                <div class="interaction">
                                    <!-- Like & Dislike Replies-->
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

                                        <p id="youReplyLike_{{$reply->id}}" <?php if($is_like !== 1){ echo 'style="display: none"'; } ?>>you and</p>
                                        <p>{{$reply->likes()->where('like', 1)->count()}}</p>  {{--get number of likes.--}}
                                        <a onclick="LikeReply({{$reply->id}})"><i id="likeReplyButton_{{$reply->id}}"  class="fa fa-thumbs-up like" <?php if($is_like !== 1){ echo 'style =" color:lightgray"'; } ?>></i></a>

                                        <p id="youReplyDislike_{{$reply->id}}" <?php if($is_like !== 0){ echo 'style="display: none"'; } ?>>you and</p>
                                        <p>{{$reply->likes()->where('like', 0)->count()}}</p>  {{--get number of Dislikes.--}}
                                        <a onclick="DislikeReply({{$reply->id}})"><i id="dislikeReplyButton_{{$reply->id}}"  class="fa fa-thumbs-down dislike" <?php if($is_like !== 0){ echo 'style =" color:lightgray"'; } ?>></i></a>

                                    @endif
                                    <!-- Like & Dislike Replies-->

                                    <!-- Edit & Delete Replies-->
                                    @if (Auth::user() == $reply->user) {{--only content owner can edit & delete this content.--}}
                                        <a onClick="EditReplyButton({{$reply->id}})" ><i class="fa fa-pencil" style='font-size:33px;color:blue'></i></a>

                                        <a onclick="DeleteReply({{$reply->id}})"><i class='fas fa-trash-alt' style='font-size:30px;color:red'></i></a>
                                    @endif
                                    <!-- Edit & Delete Replies-->
                                </div>
                                <hr>
                            </div>
                        @endforeach
                    @endif
                </div>
                <!-- End Nested Replies -->

                <!-- Add Replies -->
                <div id="addReply_{{$comment->id}}" style="display: none">
                    <form name="reply" class="form-horizontal">

                        {{-- body Field --}}
                        <div class="form-group">
                            {{-- Check if the field has any errors --}}
                            <p id="addreplyerror_{{$comment->id}}" class="alert alert-danger" style="display: none"></p>
                            <input type="text" class="form-control" id="replybody_{{$comment->id}}" name="body" placeholder="Type your Reply here...">
                        </div>

                        <div>
                            <button type="button" class="btn btn-primary" onclick="AddReply({{$comment->id}})">Reply</button>
                        </div>
                    </form>
                </div>
                <!-- Add Replies -->
            </div>
        @endforeach
    @endif

    <!-- Add Comments -->
    <div>
        <form name="Comment" class="form-horizontal">
            {{-- body Field --}}
            <div class="form-group">
                {{-- Check if the field has any errors --}}
                <p id="addcommenterror" class="alert alert-danger" style="display: none"></p>
                <input type="text" class="form-control" id="commentbody" name="body" placeholder="Type your Comment here...">
            </div>

            <div> <button type="button" class="btn btn-primary" onclick="AddComment({{$article->id}})">Comment</button> </div>
        </form>
    </div>
    <!-- Add Comments -->

    <script>

        function Favouriate(id)
        {
            let _url = '/favourites';
            let _token = "{{ csrf_token() }}";
            $.ajax({
                url: _url,
                method: 'Post',
                data: {
                    article_id: id,
                    _token: _token
                },
                success: function (response) {
                    if(response.code == 200)
                    {
                        $("#favouriteButton").style.color = 'red';
                    }
                    if(response.code == 401)
                    {
                        $("#favouriteButton").style.color = 'lightgray';
                    }

                }
            });
        }

        function AddComment(id)
        {
            let _url = '/comments';
            let _token = "{{ csrf_token() }}";
            $.ajax({
                url: _url,
                method: 'Post',
                data: {
                    article_id : id,
                    body: $('#commentbody').val(),
                    _token: _token
                },
                success: function(response){
                    if(response.code == 200 && response.data.id != '')
                    {
                        var id = response.data.id;
                        console.log(response);
                        console.log(response.data.id);
                    }
                    $('#commentbody').val('');
                },
                error:function(response)
                {
                    $('#addcommenterror').show();
                    $('#addcommenterror').text(response.responseJSON.errors.body);
                }
            })
        }

        function EditCommentButton(id)
        {
            $('#commentBody_'+id).hide();
            $('#editCommentForm_'+id).show();

        }

        function EditComment(id)
        {
            let _url = `/comments/${id}`;
            let _token = "{{ csrf_token() }}";
            $.ajax({
                url: _url,
                method: 'PUT',
                data: {
                    body: $('#editcommentbody_'+id).val(),
                    _token: _token,
                },
                success: function(response){
                    if(response.code == 200 && response.data.id != '')
                    {
                        $('#commentBody_'+id).show();
                        $('#editCommentForm_'+id).hide();

                        $('#commentBody_'+id).text(response.data.body);
                    }
                    $('#editcommentbody'+id).val('');
                },
                error:function(response)
                {
                    $('#editcommenterror_'+id).show();
                    $('#editcommenterror_'+id).text(response.responseJSON.errors.body);
                }
            });
        }

        function DeleteComment(id)
        {
            let _url = `/comments/${id}`;
            let _token = "{{ csrf_token() }}";
            $.ajax({
                url: _url,
                method: 'Delete',
                data: {
                    _token: _token
                },
                success: function (response) {
                    if(response.code == 200)
                    {
                        $("#comment_"+id).remove();
                        console.log(response);
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        function LikeComment(id)
        {
            let _url = `/likeComment/${id}`;
            let _token = "{{ csrf_token() }}";
            $.ajax({
                url: _url,
                method: 'Post',
                data: {
                    _token: _token
                },
                success: function (response) {
                    if(response.code == 200)
                    {
                        document.getElementById("likeCommentButton_"+id).style.color = 'blue';
                        document.getElementById("youCommentLike_"+id).style.display = "block";
                        $('#youCommentLike_'+id).show();
                        console.log(response);
                    }
                    if(response.code == 201)
                    {
                        document.getElementById("likeCommentButton_"+id).style.color = 'lightgray';
                        $('#youCommentLike_'+id).hide();
                    }
                    if(response.code == 202)
                    {
                        document.getElementById("likeCommentButton_"+id).style.color = 'blue';
                        document.getElementById("dislikeCommentButton_"+id).style.color = 'lightgray';
                        $('#youCommentLike_'+id).show();
                        $('#youCommentDislike_'+id).hide();
                    }
                }
            });
        }

        function DislikeComment(id)
        {
            let _url = `/dislikeComment/${id}`;
            let _token = "{{ csrf_token() }}";
            $.ajax({
                url: _url,
                method: 'Post',
                data: {
                    _token: _token
                },
                success: function (response) {
                    if(response.code == 400)
                    {
                        document.getElementById("dislikeCommentButton_"+id).style.color = 'red';
                        $('#youCommentDislike_'+id).show();
                    }
                    if(response.code == 401)
                    {
                        document.getElementById("dislikeCommentButton_"+id).style.color = 'lightgray';
                        $('#youCommentDislike_'+id).hide();
                    }
                    if(response.code == 402)
                    {
                        document.getElementById("dislikeCommentButton_"+id).style.color = 'red';
                        document.getElementById("likeCommentButton_"+id).style.color = 'lightgray';
                        $('#youCommentDislike_'+id).show();
                        $('#youCommentLike_'+id).hide();
                    }
                }
            });
        }

        function Reply(id) {$('#addReply_'+id).show();}

        function AddReply(id)
        {
            let _url = '/replies';
            let _token = "{{ csrf_token() }}";
            $.ajax({
                url: _url,
                method: 'Post',
                data: {
                    comment_id : id,
                    body: $('#replybody_'+id).val(),
                    _token: _token
                },
                success: function(response){
                    if(response.code == 200)
                    {
                        console.log(response);
                        $("#addReply_"+id).hide();
                    }
                    $('#replybody_'+id).val('');
                },
                error:function(response)
                {
                    $('#addreplyerror_'+id).show();
                    $('#addreplyerror_'+id).text(response.responseJSON.errors.body);
                }
            })
        }

        function EditReplyButton(id)
        {
            $('#replyBody_'+id).hide();
            $('#editReplyForm_'+id).show();
        }

        function EditReply(id)
        {
            let _url = `/replies/${id}`;
            let _token = "{{ csrf_token() }}";
            $.ajax({
                url: _url,
                method: 'Put',
                data: {
                    body: $('#editreplybody_'+id).val(),
                    _token: _token
                },
                success: function(response){
                    if(response.code == 200 && response.data.id != '')
                    {
                        $('#replyBody_'+id).show();
                        $('#editReplyForm_'+id).hide();

                        $('#replyBody_'+id).text(response.data.body);
                    }
                    $('#editreplybody_'+id).val('');
                },
                error:function(response)
                {
                    $('#editreplyerror_'+id).show();
                    $('#editreplyerror_'+id).text(response.responseJSON.errors.body);
                }
            });
        }

        function DeleteReply(id)
        {
            let _url = `/replies/${id}`;
            let _token = "{{ csrf_token() }}";
            $.ajax({
                url: _url,
                method: 'Delete',
                data: {
                    _token: _token
                },
                success: function (response) {
                    if(response.code == 200)
                    {
                        $("#reply_"+id).remove();
                        console.log(response);
                    }
                }
            });
        }

        function LikeReply(id)
        {
            let _url = `/likeReply/${id}`;
            let _token = "{{ csrf_token() }}";
            $.ajax({
                url: _url,
                method: 'Post',
                data: {
                    _token: _token
                },
                success: function (response) {
                    if(response.code == 200)
                    {
                        document.getElementById("likeReplyButton_"+id).style.color = 'blue';
                        $('#youReplyLike_'+id).show();

                    }
                    if(response.code == 201)
                    {
                        document.getElementById("likeReplyButton_"+id).style.color = 'lightgray';
                        $('#youReplyLike_'+id).hide();
                    }
                    if(response.code == 202)
                    {
                        document.getElementById("likeReplyButton_"+id).style.color = 'blue';
                        document.getElementById("dislikeReplyButton_"+id).style.color = 'lightgray';
                        $('#youReplyLike_'+id).show();
                        $('#youReplyDislike_'+id).hide();
                    }
                }
            });
        }

        function DislikeReply(id)
        {
            let _url = `/dislikeReply/${id}`;
            let _token = "{{ csrf_token() }}";
            $.ajax({
                url: _url,
                method: 'Post',
                data: {
                    _token: _token
                },
                success: function (response) {
                    if(response.code == 400)
                    {
                        document.getElementById("dislikeReplyButton_"+id).style.color = 'red';
                        $('#youReplyDislike_'+id).show();
                    }
                    if(response.code == 401)
                    {
                        document.getElementById("dislikeReplyButton_"+id).style.color = 'lightgray';
                        $('#youReplyDislike_'+id).hide();
                    }
                    if(response.code == 402)
                    {
                        document.getElementById("dislikeReplyButton_"+id).style.color = 'red';
                        document.getElementById("likeReplyButton_"+id).style.color = 'lightgray';
                        $('#youReplyDislike_'+id).show();
                        $('#youReplyLike_'+id).hide();
                    }
                }
            });
        }
    </script>
@endsection

