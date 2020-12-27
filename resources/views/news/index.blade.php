@extends('layouts.main')

@section('title','News')
@section('Background', 'newsBackground')

@section('content')
    <h1>News</h1>
    <div class="row">
        @foreach($newses as $news)
            <div class="col-md-6">
                <div class="card mb-5">
                    <!-- save Button -->
                    @if (Auth::check())
                        <?php
                        $is_saved = '';

                        ($save = Auth::user()->saves()->where('news_id', $news->id)->first()) ? $is_saved = 1 : $is_saved = '';
                        ?>
                        @if($is_saved === 1)
                            <a onclick="Save('news', {{$news->id}})"><i id="SaveButton_{{'news'}}_{{$news->id}}" class="fa fa-check"></i></a>
                        @else
                            <a onclick="Save('news', {{$news->id}})"><i id="SaveButton_{{'news'}}_{{$news->id}}" class="fa fa-plus"></i></a>
                        @endif
                    @endif
                    <!-- save Button -->
                    <h5 class="card-title">{{$news->title}}</h5>
                    <div class="card-body">
                        <img src="images/{{$news->image}}" class="card-img-top">
                        <p class="card-text">{{$news->body}}</p>
                        <a href="/news/{{$news->slug}}" lass="btn btn-primary">see more....</a>
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
