@extends('layouts.adminPanel')

@section('content')
    <h1>Donations</h1>

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
                <th>Image</th>
                <th>Description</th>
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
            @foreach($donations as $donation)
                <tr id="row_{{$donation->id}}">
                    <td>{{$donation->id}}</td>
                    <td>{{$donation->user->fullName()}}</td>
                    <td>{{$donation->user->id}}</td>
                    <td>{{$donation->user->email}}</td>
                    <td>{{$donation->title}}</td>
                    <td><img height= '50' src="/images/{{$donation->image}}"></td>
                    <td>{{$donation->description}}</td>
                    <td>{{$donation->phone}}</td>
                    <td>{{$donation->governorate->name}}</td>
                    <td>
                        @foreach($donation->categories as $category)
                            <span>{{$category->name}} / </span>
                        @endforeach
                    </td>
                    <td>{{$donation->created_at->diffforhumans()}}</td>
                    <td>{{$donation->updated_at->diffforhumans()}}</td>
                    <td><button class="btn btn-success" onclick="ApproveDonation({{$donation->id}})">Approve</button></td>
                    <td> <button class="btn btn-danger" onclick="DeleteDonation({{$donation->id}})">Delete</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        function ApproveDonation(id)
        {
            let _URl = `/donations/approve/${id}`;
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

        function DeleteDonation(id)
        {
            let _URl = `/donations/${id}`;
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
