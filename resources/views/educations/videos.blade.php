@extends('layouts.main')

@section('title','Videos')
@section('Background', 'videosBackground')

@section('content')
    <h1>Videos</h1>
    <div>
        @foreach($videos as $video)
            <!-- save Button -->
                @if (Auth::check())
                    <?php
                    $is_saved = '';

                    ($save = Auth::user()->saves()->where('education_id', $video->id)->first()) ? $is_saved = 1 : $is_saved = '';
                    ?>
                    @if($is_saved === 1)
                        <a onclick="Save('education', {{$video->id}})"><i id="SaveButton_{{'education'}}_{{$video->id}}" class="fa fa-check"></i></a>
                    @else
                        <a onclick="Save('education', {{$video->id}})"><i id="SaveButton_{{'education'}}_{{$video->id}}" class="fa fa-plus"></i></a>
                    @endif
                @endif
            <!-- save Button -->
            <img src="http://placehold.it/300" alt= "Test">

            <a href="/educations/{{$video->slug}}" lass="btn btn-primary">{{$video->title}}</a>
            <p class="card-text">{{$video->body}}</p>
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
