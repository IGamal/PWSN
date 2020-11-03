@extends('layouts.main')

@section('title', 'Edit Category')
@section('Background', 'CategoryBackground')

@section('content')
    <h1>Edit Category</h1>

    {{-- Edit category form  --}}
    {!! Form::model($category, ['method' => 'PATCH', "action" => ['App\Http\Controllers\CategoryController@update', $category->id]]) !!}

    {{-- Name Field --}}
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('name')) <div class="alert alert-danger">{{$errors->first('name') }}</div> @endif
        {{Form::text('name', $category->name, ['class' => 'form-input', 'placeholder' => 'categories'])}}
    </div>

    {{-- Description Field --}}
    <div class="form-group">
        {{Form::label('description', 'Description')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('description')) <div class="alert alert-danger">{{$errors->first('description') }}</div> @endif
        {{Form::text('description', $category->description, ['class' => 'form-input', 'placeholder' => 'Type Description here...'])}}
    </div>

    <div>
        {{Form::submit('Edit Category', ['class' => 'btn btn-primary'])}}
    </div>
    {!! Form::close() !!}

    {{-- Delete category form  --}}
    {!! Form::model($category, ['method' => 'DELETE', "action" => ['App\Http\Controllers\CategoryController@destroy', $category->id], 'onsubmit' => 'return confirm("Are You sure You Want To Delete This Category")']) !!}
    <div> {{Form::submit('Delete', ['class' => 'btn btn-danger'])}} </div>
    {!! Form::close() !!}

@endsection
