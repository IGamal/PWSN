@extends('layouts.adminPanel')

@section('content')
    <form name="UerID" class="form-horizontal">

        <p id="Error" class="alert alert-danger" style="display: none"></p>
        <p id="Success" class="alert alert-success" style="display: none"></p>

        {{-- User ID Field --}}
        <div class="form-group">
            {!!Form::label('User ID', 'User ID')!!}
            {{-- Check if the field has any errors --}}
            <span id="UserIdError" class="alert-message"></span>
            <input type="text" class="form-control" id="userid" name="id" placeholder='insert User ID here...'>
        </div>

        <div> <button type="button" class="btn btn-primary" onClick="GetUser()">Get</button> </div>
    </form>

    <div id ="table"></div>

    <script>
        function GetUser()
        {
            var id = $('#userid').val();
            let _url = '/adminPanel/user';
            let _token = "{{ csrf_token() }}";
            $.ajax({
                url: _url,
                method: 'Post',
                data: {
                    id: id,
                    _token: _token
                },
                success: function(response){
                    if(response.code == 200)
                    {
                        $('#table').prepend('' +
                        '<table> ' +
                            '<thead> ' +
                                '<tr> ' +
                                    '<th>Id</th> ' +
                                    '<th>Name</th> ' +
                                    '<th>Email</th> ' +
                                    '<th>Email Verified at</th> ' +
                                    '<th>Image</th>' +
                                    '<th>Phone Number</th>' +
                                    '<th>Birthday</th>' +
                                    '<th>Verified</th>' +
                                    '<th>Admin</th>' +
                                    '<th>Created at</th>' +
                                    '<th>updated at</th>' +
                                    '<th>Make Admin</th>' +
                                    '<th>Delete</th>' +
                                '</tr>' +
                            '</thead>' +
                            '<tbody>' +
                                '<tr id="row">' +
                                    '<td>'+response.data.id+'</td>' +
                                    '<td>'+response.data.first_name +' '+ response.data.last_name+'</td>' +
                                    '<td>'+response.data.email+'</td>' +
                                    '<td>'+response.data.email_verified_at+'</td>' +
                                    '<td><img height= "50" src="/images/'+response.data.image+'"></td>' +
                                    '<td>'+response.data.phone+'</td>' +
                                    '<td>'+response.data.birthday+'</td>' +
                                    '<td>'+response.data.verified+'</td>' +
                                    '<td>'+response.data.admin+'</td>' +
                                    '<td>'+response.data.created_at+'</td>' +
                                    '<td>'+response.data.updated_at+'</td>' +
                                    '<td><a class="btn btn-success" onClick="MakeAdmin('+response.data.id+')">Make Admin</a></td>' +
                                    '<td><a class="btn btn-success" onClick="DeleteUser('+response.data.id+')">Delete</a></td> ' +
                                '</tr>' +
                            '</tbody>' +
                        '</table>');

                        $('#userid').val('');
                    }
                },
                error: function(response)
                {
                    $('#UserIdError').text(response.responseJSON.errors.id);
                }
            });
        }

        function MakeAdmin(id)
        {
            let _url = `/adminPanel/makeadmin/${id}`;
            let _token = "{{ csrf_token() }}";
            $.ajax({
                url: _url,
                method: 'Post',
                data: {
                    _token: _token
                },
                success: function(response) {
                    if(response.code == 200)
                    {
                        $('#Success').show();
                        $('#Success').text(response.success);
                    }
                    if(response.code == 201)
                    {
                        $('#Message').text(response.error);

                        $('#Error').show();
                        $('#Error').text(response.error);
                    }
                }
            });
        }

        function DeleteUser(id)
        {
            let _url = `/users/${id}`;
            let _token = "{{ csrf_token() }}";
            $.ajax({
                url: _url,
                method: 'Delete',
                data: {
                    _token: _token
                },
                success: function(response) {
                    if(response.code == 200)
                    {
                        $('#Success').show();
                        $('#Success').text(response.success);
                    }
                }
            });
        }
    </script>

@endsection
