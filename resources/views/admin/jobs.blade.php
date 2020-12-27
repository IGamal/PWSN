@extends('layouts.adminPanel')

@section('content')
    <h1>Jobs</h1>

    <p id="Deleted" class="alert alert-danger" style="display: none"></p>
    <p id="Approved" class="alert alert-success" style="display: none"></p>

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
            <tr id="row_{{$job->id}}">
                <td>{{$job->id}}</td>
                <td>{{$job->user->fullName()}}</td>
                <td>{{$job->user->id}}</td>
                <td>{{$job->user->email}}</td>
                <td>{{$job->title}}</td>
                <td>{{$job->description}}</td>
                <td>{{$job->requirements}}</td>
                <td>{{$job->salary}}</td>
                <td>{{$job->phone}}</td>
                <td>{{$job->governorate->name}}</td>
                <td>
                    @foreach($job->categories as $category)
                        <span>{{$category->name}} / </span>
                    @endforeach
                </td>
                <td>{{$job->created_at->diffforhumans()}}</td>
                <td>{{$job->updated_at->diffforhumans()}}</td>
                <td><button class="btn btn-success" onclick="ApproveJob({{$job->id}})">Approve</button></td>
                <td> <button class="btn btn-danger" onclick="DeleteJob({{$job->id}})">Delete</button></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <script>
        function ApproveJob(id)
        {
            let _URl = `/jobs/approve/${id}`;
            let _token = "{{ csrf_token() }}";
            $.ajax({
                url: _URl,
                method: 'Post',
                data:{
                    _token: _token
                },
                success: function (response) {
                    if(response.code == 200)
                    {
                        $('#Approved').show();
                        $('#Approved').text(response.success);
                        $("#row_"+id).remove();
                    }
                }
            });
        }

        function DeleteJob(id)
        {
            let _URl = `/jobs/${id}`;
            let _token = "{{ csrf_token() }}";
            $.ajax({
                url: _URl,
                method: 'Delete',
                data:{
                    _token: _token
                },
                success: function (response) {
                    if(response.code == 200)
                    {
                        $('#Deleted').show();
                        $('#Deleted').text(response.success);
                        $('#row_'+id).remove();
                    }
                }
            })
        }
    </script>
@endsection
