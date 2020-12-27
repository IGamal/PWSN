@extends('layouts.main')

@section('title', 'Jobs')
@section('Background', 'jobBackground')

@section('content')
    <h1>Jobs</h1>
    <div class="row">
        @foreach($jobs as $job)
            <div class="col-md-6">
                <div class="card mb-5">
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
                    <h5 class="card-title">{{$job->title}}</h5>
                    <div class="card-body">
                        <p class="card-text">{{$job->description}}</p>
                        <a href="/jobs/{{$job->slug}}" lass="btn btn-primary">see more....</a>
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
