@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">Articles</div>

                <div class="card-body">
                    @foreach($articles as $article)
                        <a href="/articles/{{$article->slug}}">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="images/{{$article->image}}" class="card-img-top">
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
                                </div>
                                <div class="col-md-7">
                                    <h4 class="card-title">{{$article->title}}</h4>
                                    <p class="card-text">{{$article->body}}</p>
                                    <a href="/articles/{{$article->slug}}">see more....</a>
                                </div>
                            </div>
                        </a>
                        <hr>
                    @endforeach
                </div>
            </div>

            <div class="card">
                <div class="card-header">News</div>

                <div class="card-body">
                    @foreach($newses as $news)
                        <a href="/news/{{$news->slug}}">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="images/{{$news->image}}" class="card-img-top">
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
                                </div>
                                <div class="card mb-4">
                                    <h4 class="card-title">{{$news->title}}</h4>
                                    <p class="card-text">{{$news->body}}</p>
                                    <a href="/news/{{$news->slug}}" lass="btn btn-primary">see more....</a>
                                </div>
                            </div>
                        </a>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Donations</div>

                <div class="card-body">
                    @foreach($donations as $donation)
                        <a href="/donations/{{$donation->slug}}">
                            <div>
                                <img src="images/{{$donation->image}}" class="card-img-top">
                                <!-- save Button -->
                                @if (Auth::check())
                                    <?php
                                    $is_saved = '';

                                    ($save = Auth::user()->saves()->where('donation_id', $donation->id)->first()) ? $is_saved = 1 : $is_saved = '';
                                    ?>
                                    @if($is_saved === 1)
                                        <a onclick="Save('donation', {{$donation->id}})"><i id="SaveButton_{{'donation'}}_{{$donation->id}}" class="fa fa-check"></i></a>
                                    @else
                                        <a onclick="Save('donation', {{$donation->id}})"><i id="SaveButton_{{'donation'}}_{{$donation->id}}" class="fa fa-plus"></i></a>
                                    @endif
                                @endif
                                <!-- save Button -->
                                    <br>
                                <h4>{{$donation->title}}</h4>
                            </div>
                        </a>
                        <hr>
                    @endforeach
                </div>
            </div>

            <div class="card">
                <div class="card-header">Jobs</div>

                <div class="card-body">
                    @foreach($jobs as $job)
                        <div>
                            <!-- save Button -->
                            @if (Auth::check())
                                <?php
                                $is_saved = '';

                                ($save = Auth::user()->saves()->where('job_id', $job->id)->first()) ? $is_saved = 1 : $is_saved = '';
                                ?>
                                @if($is_saved === 1)
                                    <a onclick="Save('job', {{$job->id}})"><i id="SaveButton_{{'job'}}_{{$job->id}}" class="fa fa-check"></i></a>
                                @else
                                    <a onclick="Save('job', {{$job->id}})"><i id="SaveButton_{{'job'}}_{{$job->id}}" class="fa fa-plus"></i></a>
                                @endif
                            @endif
                            <!-- save Button -->
                            <a href="/jobs/{{$job->slug}}" lass="btn btn-primary">{{$job->title}}</a>
                            <p class="card-text">{{$job->description}}</p>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
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
