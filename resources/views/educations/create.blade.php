@extends('layouts.main')

@section('title', 'Add Education')
@section('Background', 'educationBackground')

@section('content')
    <h1>Add Education</h1>

    @if(Session('error')) <p class="flex-center btn btn-danger"> {{session('error')}}</p> @endif

    {{-- Create New Article form  --}}
    {!! Form::open(['action' => 'App\Http\Controllers\EducationController@store', 'method' => 'POST', 'files' => 'true']) !!}

        {{-- Title Field --}}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{-- Check if the field has any errors --}}
            @if($errors->has('title')) <div class="alert alert-danger">{{$errors->first('title') }}</div> @endif
            {{Form::text('title', '', ['class' => 'form-input', 'placeholder' => 'Type the Title here...'])}}
        </div>

        {{-- Book Field --}}
        <div class="form-group">
            {{Form::label('book', 'Book')}}
            {{-- Check if the field has any errors --}}
            @if($errors->has('book')) <div class="alert alert-danger">{{$errors->first('book') }}</div> @endif
            <input type="file" class="photo" name="book" > <p class="p3"> Add book....</p>
        </div>

        {{-- Video Field --}}
        <div class="form-group">
            {{Form::label('video', 'Video')}}
            {{-- Check if the field has any errors --}}
            @if($errors->has('video')) <div class="alert alert-danger">{{$errors->first('video') }}</div> @endif
            <input type="file" class="video" name="video"> <p class="p4"> Add Video....</p>
        </div>

        {{-- Body Field --}}
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{-- Check if the field has any errors --}}
            @if($errors->has('body')) <div class="alert alert-danger">{{$errors->first('body') }}</div> @endif
            {{Form::textarea('body', '', ['class' => 'form-textarea', 'placeholder' => '&nbsp;Add Text.....'])}}
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
            {{Form::submit('Add Education', ['class' => 'btn btn-primary'])}}
        </div>
    {!! Form::close() !!}

@endsection
