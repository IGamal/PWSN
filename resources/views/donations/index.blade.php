@extends('layouts.main')

@section('title','Donations')
@section('Background', 'donationBackground')

@section('content')
    <h1>Donations</h1>
    <div class="row">
        @foreach($donations as $donation)
            <div class="col-md-6">
                <div class="card mb-5">
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
                    <h5 class="card-title">{{$donation->title}}</h5>
                    <div class="card-body">
                        <img src="images/{{$donation->image}}" class="card-img-top">
                        <p class="card-text">{{$donation->description}}</p>
                        <a href="/donations/{{$donation->slug}}" lass="btn btn-primary">see more....</a>
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
