@extends('layouts.adminPanel')

@section('content')
    <h1>Jobs</h1>

    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Author ID</th>
            <th>Email</th>
            <th>Title</th>
            <th>Description</th>
            <th>Requirements</th>
            <th>Salary</th>
            <th>Phone Number</th>
            <th>Governorate</th>
            <th>categories</th>
            <th>Created at</th>
            <th>updated at</th>
            <th>Approve</th>
            <th>Delete</th>
        </tr>
        </thead>

        <tbody>
        @foreach($jobs as $job)
            <tr>
                <th>{{$job->id}}</th>
                <th>{{$job->user->fullName()}}</th>
                <th>{{$job->user->id}}</th>
                <th>{{$job->user->email}}</th>
                <th>{{$job->title}}</th>
                <th>{{$job->description}}</th>
                <th>{{$job->requirements}}</th>
                <th>{{$job->salary}}</th>
                <th>{{$job->phone}}</th>
                <th>{{$job->governorate->name}}</th>
                <th>
                    @foreach($job->categories as $category)
                        <span>{{$category->name}} / </span>
                    @endforeach
                </th>
                <th>{{$job->created_at->diffforhumans()}}</th>
                <th>{{$job->updated_at->diffforhumans()}}</th>
                <th>
                    {!! Form::model($job, ['action' =>['App\Http\Controllers\JobController@approve', $job->slug], 'method' => 'POST']) !!}
                    {!! Form::submit('Approve',['class' => 'btn btn-success']) !!}
                    {!! Form::close() !!}
                </th>
                <th>
                    {!! Form::model($job, ['method' => 'DELETE', "action" => ['App\Http\Controllers\JobController@destroy', $job->slug]]) !!}
                    {!!Form::submit('Delete', ['class' => 'btn btn-danger'])!!}
                    {!! Form::close() !!}
                </th>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
