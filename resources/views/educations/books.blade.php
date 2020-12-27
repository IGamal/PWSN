@extends('layouts.main')

@section('title','Books')
@section('Background', 'bookBackground')

@section('content')
        <h1>Books</h1>
        <div>
            @foreach($books as $book)
                    <img src="http://placehold.it/300" alt= "Test">

                    <a href="/educations/{{$book->slug}}" lass="btn btn-primary">{{$book->title}}</a>
                    <p class="card-text">{{$book->body}}</p>
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
