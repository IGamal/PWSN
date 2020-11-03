@extends('layouts.main')

@section('title', 'Add Category')
@section('Background', 'CategoryBackground')

@section('content')
    <h1>Categories</h1>

    <div class="">
        @foreach ($categories as $category)
            <div class="">
                <h2>{{$category->name}}</h2>
                <p>{{$category->description}}</p>
            </div>

            <div class="">
                <a class="btn btn-primary" href="categories/{{$category->id}}/edit">Edit</a>
            </div>

            <hr>
        @endforeach
    </div>

    <div class="">
        {{-- Create New category form  --}}
        {!! Form::open(['action' => 'App\Http\Controllers\CategoryController@store', 'method' => 'POST']) !!}

        {{-- Name Field --}}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{-- Check if the field has any errors --}}
            @if($errors->has('name')) <div class="alert alert-danger">{{$errors->first('name') }}</div> @endif
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Type Category Name here...'])}}
        </div>

        {{-- Description Field --}}
        <div class="form-group">
            {{Form::label('description', 'Description')}}
            {{-- Check if the field has any errors --}}
            @if($errors->has('description')) <div class="alert alert-danger">{{$errors->first('description') }}</div> @endif
            {{Form::text('description', '', ['class' => 'form-control', 'placeholder' => 'Type Description here...'])}}
        </div>

        <div>
            {{Form::submit('Add Category', ['class' => 'btn btn-primary'])}}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
