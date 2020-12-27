@extends('users.home')

@section('title', 'User')

@section('contents')
    <button onclick="GetSaved('article')" class="btn ">Articles</button>
    <button onclick="GetSaved('donation')" class="btn ">Donations</button>
    <button onclick="GetSaved('news')" class="btn ">News</button>
    <button onclick="GetSaved('job')" class="btn ">Jobs</button>
    <button onclick="GetSaved('education')" class="btn ">Educations</button>

    <h1 id="title"></h1>
    <div id= 'row' class="row">

    </div>

    <script>
        function GetSaved(model)
        {
            let _url = `/saves/${model}`;
            let _token = "{{ csrf_token() }}";
            $.ajax({
                url: _url,
                method: 'Post',
                data: {
                    _token: _token
                },
                success: function (response)
                {
                    if(response.code == 200)
                    {
                        $('#title').text('Articles');

                        $('#row').html("")
                        var data = response.data;

                        for (var j = 0; j < data.length; j++)
                        {
                            for (var obj in data[j])
                            {
                                var tes = data[j][obj];

                                $('#row').prepend('' +
                                    '<a href="/articles/' + tes.slug + '">' +
                                    '<div class="col-md-6">' +
                                    '<div class="card ">' +
                                    '<h5 class="card-title">' + tes.title + '</h5>' +
                                    '<div class="card-body">' +
                                    '<img src="/images/' + tes.image + '" class="card-img-top">' +
                                    '<p class="card-text">' + tes.body + '</p>' +
                                    '<a href="/articles/' + tes.slug + '" >see more....</a>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</a>');
                            }
                        }
                    }

                    if(response.code == 201)
                    {
                        $('#title').text('Donations');

                        $('#row').html("")
                        var data = response.data;

                        for (var j = 0; j < data.length; j++)
                        {
                            for (var obj in data[j])
                            {
                                var tes = data[j][obj];

                                $('#row').prepend('' +
                                    '<a href="/donations/' + tes.slug + '">' +
                                    '<div class="col-md-6">' +
                                    '<div class="card ">' +
                                    '<h5 class="card-title">' + tes.title + '</h5>' +
                                    '<div class="card-body">' +
                                    '<img src="/images/' + tes.image + '" class="card-img-top">' +
                                    '<p class="card-text">' + tes.description + '</p>' +
                                    '<a href="/donations/' + tes.slug + '" >see more....</a>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</a>');
                            }
                        }
                    }

                    if(response.code == 202)
                    {
                        $('#title').text('News');

                        $('#row').html("")
                        var data = response.data;

                        for (var j = 0; j < data.length; j++)
                        {
                            for (var obj in data[j])
                            {
                                var tes = data[j][obj];

                                $('#row').prepend('' +
                                    '<a href="/news/' + tes.slug + '">' +
                                    '<div class="col-md-6">' +
                                    '<div class="card ">' +
                                    '<h5 class="card-title">' + tes.title + '</h5>' +
                                    '<div class="card-body">' +
                                    '<img src="/images/' + tes.image + '" class="card-img-top">' +
                                    '<p class="card-text">' + tes.body + '</p>' +
                                    '<a href="/news/' + tes.slug + '" >see more....</a>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</a>');
                            }
                        }
                    }
                    if(response.code == 203)
                    {
                        $('#title').text('Jobs');

                        $('#row').html("")
                        var data = response.data;

                        for (var j = 0; j < data.length; j++)
                        {
                            for (var obj in data[j])
                            {
                                var tes = data[j][obj];

                                $('#row').prepend('' +
                                    '<a href="/jobs/' + tes.slug + '">' +
                                    '<div class="col-md-6">' +
                                    '<div class="card ">' +
                                    '<h5 class="card-title">' + tes.title + '</h5>' +
                                    '<div class="card-body">' +
                                    '<p class="card-text">' + tes.description + '</p>' +
                                    '<a href="/jobs/' + tes.slug + '" >see more....</a>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</a>');
                            }
                        }
                    }
                    if(response.code == 204)
                    {
                        $('#title').text('Educations');

                        $('#row').html("")
                        var data = response.data;

                        for (var j = 0; j < data.length; j++)
                        {
                            for (var obj in data[j])
                            {
                                var tes = data[j][obj];

                                $('#row').prepend('' +
                                    '<a href="/educations/' + tes.slug + '">' +
                                    '<div class="col-md-6">' +
                                    '<div class="card ">' +
                                    '<h5 class="card-title">' + tes.title + '</h5>' +
                                    '<div class="card-body">' +
                                    '<img src="/images/' + tes.image + '" class="card-img-top">' +
                                    '<p class="card-text">' + tes.body + '</p>' +
                                    '<a href="/educations/' + tes.slug + '" >see more....</a>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</a>');
                            }
                        }
                    }
                }
            });
        }
    </script>
@endsection
