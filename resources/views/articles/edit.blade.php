@extends('layouts.main')

@section('title', 'Edit Article')
@section('Background', 'articleBackground')

@section('content')
    <h1>Edit Article</h1>

    {{-- Edit Article form  --}}
    {!! Form::model($article, ['method' => 'PATCH', "action" => ['App\Http\Controllers\ArticleController@update', $article->slug], 'files' => 'true']) !!}

        {{-- Title Field --}}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{-- Check if the field has any errors --}}
            @if($errors->has('title')) <div class="alert alert-danger">{{$errors->first('title') }}</div> @endif
            {{Form::text('title', $article->title, ['class' => 'form-input', 'placeholder' => 'Type your the Title here...'])}}
        </div>

        {{-- Image Field --}}
        <div class="form-group">
            {{Form::label('image', 'Image')}}
            @if($article->image) <img src="/images/{{$article->image}}"> @endif {{-- check if that article has an image --}}
            {{-- Check if the field has any errors --}}
            @if($errors->has('image')) <div class="alert alert-danger">{{$errors->first('image') }}</div> @endif
            <input type="file" class="photo" name="image" > <p class="p3"> Change the Photo....</p>
        </div>

        {{-- Body Field --}}
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{-- Check if the field has any errors --}}
            @if($errors->has('body')) <div class="alert alert-danger">{{$errors->first('body') }}</div> @endif
            {{Form::textarea('body', $article->body, ['class' => 'form-input', 'placeholder' => 'Type Todo Date'])}}
        </div>

        {{-- Video Field --}}
        @if($article->video) <video controls muted  poster="" > <source src="/videos/{{$article->video}}"> This video cannot be loaded </video> @endif {{-- check if that article has a video --}}
        <div class="form-group">
                {{Form::label('video', 'Video')}}
                {{-- Check if the field has any errors --}}
                @if($errors->has('video')) <div class="alert alert-danger">{{$errors->first('video') }}</div> @endif
            <input type="file" class="video" name="video"> <p class="p4"> Change the Video....</p>
        </div>

        {{-- Category Field --}}
        <div class = "form-group">
            {!! Form::label('category_id', 'Category', ['class' => 'control-label']) !!}
                <h2>Your Categories</h2>
                @foreach($article->categories as $category)
                    <span>{{$category->name}}</span>
                @endforeach
            {{-- Check if the field has any errors --}}
            @if($errors->has('category_id')) <p class="alert alert-danger">{{$errors->first('category_id') }}</p> @endif
            <select name="category_id[]" class ='form-textarea' placeholder ="Change your Category" multiple>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </div>

        <div>
            {{Form::submit('Edit Article', ['class' => 'btn btn-primary'])}}
        </div>
    {!! Form::close() !!}

    {{-- Delete Article form  --}}
    {!! Form::model($article, ['method' => 'DELETE', "action" => ['App\Http\Controllers\ArticleController@destroy',
                    $article->slug], 'onsubmit' => 'return confirm("Are You sure You Want To Delete This Article")']) !!}
        <div>
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        </div>
    {!! Form::close() !!}

@endsection
