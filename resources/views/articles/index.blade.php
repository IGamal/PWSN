@extends('layouts.main')

@section('title','Articles')
@section('Background', 'articleBackground')

@section('content')
        <h1>Articles</h1>
        <div class="row">
            @foreach($articles as $article)
                <div class="col-md-6">
                    <div class="card mb-5">
                        <!-- save Button -->
                        @if (Auth::check())
                            <?php
                            $is_saved = '';

                            ($save = Auth::user()->saves()->where('article_id', $article->id)->first()) ? $is_saved = 1 : $is_saved = '';
                            ?>
                            @if($is_saved === 1)
                                <a onclick="Save('article', {{$article->id}})"><i id="SaveButton_{{'article'}}_{{$article->id}}" class="fa fa-check"></i></a>
                            @else
                                <a onclick="Save('article', {{$article->id}})"><i id="SaveButton_{{'article'}}_{{$article->id}}" class="fa fa-plus"></i></a>
                        @endif
                    @endif
                    <!-- save Button -->
                        <h5 class="card-title">{{$article->title}}</h5>
                        <div class="card-body">
                            <img src="images/{{$article->image}}" class="card-img-top">
                            <p class="card-text">{{$article->body}}</p>
                            <a href="/articles/{{$article->slug}}">see more....</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
<script>
    function Save(model, id)
    {
        let _url = `/saves/${model}/${id}`;
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
                    $("#SaveButton_"+model+"_"+id).removeClass("fa-plus");
                    $("#SaveButton_"+model+"_"+id).addClass("fa-check");
                }
                if(response.code == 401)
                {
                    $("#SaveButton_"+model+"_"+id).removeClass("fa-check");
                    $("#SaveButton_"+model+"_"+id).addClass("fa-plus");
                }
            }
        });
    }
</script>
@endsection
