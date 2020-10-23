@extends('layouts.main')

@section('title', 'Edit Education')
@section('Background', 'educationBackground')

@section('content')
    <h1>Edit Education</h1>

    {{-- Edit Education form  --}}
    {!! Form::model($education, ['method' => 'PATCH', "action" => ['App\Http\Controllers\EducationController@update', $education->slug], 'files' => 'true']) !!}

        {{-- Title Field --}}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{-- Check if the field has any errors --}}
            @if($errors->has('title')) <div class="alert alert-danger">{{$errors->first('title') }}</div> @endif
            {{Form::text('title', $education->title, ['class' => 'form-input', 'placeholder' => 'Type your the Title here...'])}}
        </div>

        {{-- Book Field --}}
        @if($education->book)
            {{Form::label('book', 'Book')}}
            <img src="/books/{{$education->book}}">

            <div class="form-group">
                {{-- Check if the field has any errors --}}
                @if($errors->has('book')) <div class="alert alert-danger">{{$errors->first('book') }}</div> @endif
                <input type="file" class="photo" name="book" > <p class="p3"> Change the book....</p>
            </div>
        @endif {{-- check if that education has a book --}}

        {{-- Body Field --}}
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{-- Check if the field has any errors --}}
            @if($errors->has('body')) <div class="alert alert-danger">{{$errors->first('body') }}</div> @endif
            {{Form::textarea('body', $education->body, ['class' => 'form-input', 'placeholder' => '&nbsp;Add Text.....'])}}
        </div>

        {{-- Video Field --}}
        @if($education->video)
            {{Form::label('video', 'Video')}}
            <video controls muted  poster="" > <source src="/videos/{{$education->video}}"> This video cannot be loaded </video>

            <div class="form-group">
                {{-- Check if the field has any errors --}}
                @if($errors->has('video')) <div class="alert alert-danger">{{$errors->first('video') }}</div> @endif
                <input type="file" class="video" name="video"> <p class="p4"> Change the Video....</p>
            </div>
        @endif {{-- check if that education has a video --}}

        {{-- Category Field --}}
        <div class = "form-group">
            {!! Form::label('category_id', 'Category', ['class' => 'control-label']) !!}
                <h2>Your Categories</h2>
                @foreach($education->categories as $category)
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
            {{Form::submit('Edit Education', ['class' => 'btn btn-primary'])}}
        </div>
    {!! Form::close() !!}

    {{-- Delete Article form  --}}
    {!! Form::model($education, ['method' => 'DELETE', "action" => ['App\Http\Controllers\EducationController@destroy',
                    $education->slug], 'onsubmit' => 'return confirm("Are You sure You Want To Delete This Education")']) !!}
        <div>
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        </div>
    {!! Form::close() !!}

@endsection
