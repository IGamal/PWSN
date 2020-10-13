@extends('layouts.main')

@section('title', 'Edit News')
@section('Background', 'newsBackground')

@section('content')
    <h1>Edit News</h1>

    {{-- Edit News form  --}}
    {!! Form::model($news, ['method' => 'PATCH', "action" => ['App\Http\Controllers\NewsController@update', $news->slug], 'files' => 'true']) !!}

        {{-- Title Field --}}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{-- Check if the field has any errors --}}
            @if($errors->has('title')) <div class="alert alert-danger">{{$errors->first('title') }}</div> @endif
            {{Form::text('title', $news->title, ['class' => 'form-input', 'placeholder' => 'Type your the Title here...'])}}
        </div>

        {{-- Image Field --}}
        <div class="form-group">
            {{Form::label('image', 'Image')}}
            @if($news->image) <img src="/images/{{$news->image}}"> @endif {{-- check if that article has an image --}}
            {{-- Check if the field has any errors --}}
            @if($errors->has('image')) <div class="alert alert-danger">{{$errors->first('image') }}</div> @endif
            <input type="file" class="photo" name="image" > <p class="p3"> Change the Image....</p>
        </div>

        {{-- Body Field --}}
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{-- Check if the field has any errors --}}
            @if($errors->has('body')) <div class="alert alert-danger">{{$errors->first('body') }}</div> @endif
            {{Form::textarea('body', $news->body, ['class' => 'form-input', 'placeholder' => '&nbsp;Add Text.....'])}}
        </div>

        {{-- Video Field --}}
        @if($news->video) <video controls muted  poster="" > <source src="/videos/{{$news->video}}"> This video cannot be loaded </video> @endif {{-- check if that article has a video --}}
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
                @foreach($news->categories as $category)
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
            {{Form::submit('Edit News', ['class' => 'btn btn-primary'])}}
        </div>
    {!! Form::close() !!}

    {{-- Delete News form  --}}
    {!! Form::model($news, ['method' => 'DELETE', "action" => ['App\Http\Controllers\NewsController@destroy',
                    $news->slug], 'onsubmit' => 'return confirm("Are You sure You Want To Delete This News")']) !!}
        <div>
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        </div>
    {!! Form::close() !!}

@endsection
