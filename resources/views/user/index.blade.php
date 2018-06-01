@extends('layouts.app')
@section('title', 'User Management')
@section('css')

@endsection
@section('js')
    <script>
        $( document ).ready(function() {
            $('.user_role_id').change(function(e) {
                $(this).parent().parent().find(".saveBtn").show();
            });
        });
    </script>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{route('user.create')}}" class="btn btn-outline-primary">Create User</a>
        </div>
    </div>
    <div class="row" style="margin-top: 15px;">
        <div class="col-12">
            {{Form::open(['route' => ['user.update.role', 0]])}}
            <input type="hidden" name="_method" value="PUT">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>UID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Account Type</th>
                    <th>Create Date</th>
                    <th>Update Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    @if($user->has_deleted)
                        <tr style="opacity: 0.5;">
                    @else
                        <tr>
                            @endif

                            <th scope="row" class="user-id">{{$user->id}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                {{$userRoles[$user->role_id]}}
                            </td>
                            <td>
                                @if ($user->is_miami == 1)
                                    Miami SSO
                                @elseif ($user->is_google == 1)
                                    Google SSO
                                @else
                                    Email/Password
                                @endif
                            </td>
                            <td>{{$user->created_at}}</td>
                            <td>{{$user->updated_at}}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Action Button Group">
                                    <button type="button" onclick="event.preventDefault(); showWarningBox('updateUserRole', {id: '{{$user->id}}', role_id: $($(this).parent().parent().parent().find('.user_role_id')[0]).val()});" class="saveBtn btn btn-outline-primary" style="display: none;">Save</button>
                                    <a href="{{route('user.edit', ['id' => $user->id])}}"  class="btn btn-outline-warning">Edit</a>
                                    @if($user->has_deleted)
                                        <a href="{{route('user.restore', ['id' => $user->id])}}"  class="btn btn-outline-success">Restore</a>
                                    @else
                                        <button type="button" onclick="event.preventDefault(); showWarningBox('destroyUser', {id: '{{$user->id}}'});" class="deleteBtn btn btn-outline-danger">Delete</button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
            {{Form::close()}}
        </div>
    </div>

@endsection
