@extends('layouts.main')

@section('title', 'Add Article')
@section('Background', 'articleBackground')

@section('content')
    <h1>Add Article</h1>

    {{-- Create New Article form  --}}
    {!! Form::open(['action' => 'App\Http\Controllers\ArticleController@store', 'method' => 'POST', 'files' => 'true']) !!}

        {{-- Title Field --}}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{-- Check if the field has any errors --}}
            @if($errors->has('title')) <div class="alert alert-danger">{{$errors->first('title') }}</div> @endif
            {{Form::text('title', '', ['class' => 'form-input', 'placeholder' => 'Type your the Title here...'])}}
        </div>

        {{-- Image Field --}}
        <div class="form-group">
            {{Form::label('image', 'Image')}}
            {{-- Check if the field has any errors --}}
            @if($errors->has('image')) <div class="alert alert-danger">{{$errors->first('image') }}</div> @endif
            <input type="file" class="photo" name="image" > <p class="p3"> Add Photo....</p>
        </div>


        {{-- Body Field --}}
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{-- Check if the field has any errors --}}
            @if($errors->has('body')) <div class="alert alert-danger">{{$errors->first('body') }}</div> @endif
            {{Form::textarea('body', '', ['class' => 'form-textarea', 'placeholder' => '&nbsp;Add Text.....'])}}
        </div>

        {{-- Video Field --}}
        <div class="form-group">
            {{Form::label('video', 'Video')}}
            {{-- Check if the field has any errors --}}
            @if($errors->has('video')) <div class="alert alert-danger">{{$errors->first('video') }}</div> @endif
            <input type="file" class="video" name="video"> <p class="p4"> Add Video....</p>
        </div>

        {{-- Category Field --}}
        <div class = "form-group">
            {!! Form::label('category_id', 'Category', ['class' => 'control-label']) !!}
            {{-- Check if the field has any errors --}}
            @if($errors->has('category_id')) <p class="alert alert-danger">{{$errors->first('category_id') }}</p> @endif
            <select name="category_id[]" class ='form-textarea' placeholder ="Choose one or more Category" multiple>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </div>

        <div>
            {{Form::submit('Add Article', ['class' => 'btn btn-primary'])}}
        </div>
    {!! Form::close() !!}

@endsection
