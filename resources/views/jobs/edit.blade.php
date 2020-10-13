@extends('layouts.main')

@section('title', 'Edit Job')
@section('Background', 'jobBackground')

@section('content')
    <h1>Edit Job</h1>

    {{-- Edit Job form  --}}
    {!! Form::model($job, ['method' => 'PATCH', "action" => ['App\Http\Controllers\JobController@update', $job->slug]]) !!}

    {{-- Title Field --}}
    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('title')) <div class="alert alert-danger">{{$errors->first('title') }}</div> @endif
        {{Form::text('title', $job->title, ['class' => 'form-input', 'placeholder' => 'Type your the Title here...'])}}
    </div>

    {{-- Description Field --}}
    <div class="form-group">
        {{Form::label('description', 'Description')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('description')) <div class="alert alert-danger">{{$errors->first('description') }}</div> @endif
        {{Form::textarea('description', $job->description, ['class' => 'form-textarea', 'placeholder' => '&nbsp;Add Text.....'])}}
    </div>

    {{-- Requirements Field --}}
    <div class="form-group">
        {{Form::label('requirements', 'Requirements')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('requirements')) <div class="alert alert-danger">{{$errors->first('requirements') }}</div> @endif
        {{Form::textarea('requirements', $job->requirements, ['class' => 'form-textarea', 'placeholder' => '&nbsp;Add Requirements here.....'])}}
    </div>

    {{-- Salary Field --}}
    <div class="form-group">
        {{Form::label('salary', 'Salary')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('salary')) <div class="alert alert-danger">{{$errors->first('salary') }}</div> @endif
        {{Form::text('salary', $job->salary, ['class' => 'form-input', 'placeholder' => 'Add salary here...'])}}
    </div>

    {{-- Governorate Field --}}
    <div class="form-group">
        {{Form::label('governorate', 'Governorate')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('governorate_id')) <div class="alert alert-danger">{{$errors->first('governorate_id') }}</div> @endif
        {{Form::select('governorate_id', $governorates, null, ['class' =>'form-input', 'placeholder' => 'choose a Governorate...'])}}
    </div>

    {{-- Phone Number Field --}}
    <div class="form-group">
        {{Form::label('phone', 'Phone Number')}}
        {{-- Check if the field has any errors --}}
        @if($errors->has('phone')) <div class="alert alert-danger">{{$errors->first('phone') }}</div> @endif
        {{Form::text('phone', $job->phone, ['class' => 'form-input', 'placeholder' => 'Type your Phone Number here...'])}}
    </div>

    {{-- Category Field --}}
    <div class = "form-group">
        {!! Form::label('category_id', 'Category', ['class' => 'control-label']) !!}
        <h2>Your Categories</h2>
        @foreach($job->categories as $category)
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
            {{Form::submit('Edit Job', ['class' => 'btn btn-primary'])}}
        </div>
    {!! Form::close() !!}

    {{-- Delete Job form  --}}
    {!! Form::model($job, ['method' => 'DELETE', "action" => ['App\Http\Controllers\JobController@destroy',
                    $job->slug], 'onsubmit' => 'return confirm("Are You sure You Want To Delete This Job")']) !!}
        <div>
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        </div>
    {!! Form::close() !!}

@endsection
