@extends('layouts.warning')
@section('css')

@endsection
@section('js')

@endsection
@section('title', 'Are you sure you want to update role for this user?')
@section('buttons')


    <div class="col">
        <a href="{{route('user.update.role', ['id' => $data['id'], 'role_id' => $data['role_id']])}}" class="btn btn-outline-danger btn-block" onclick="event.preventDefault();
document.getElementById('update-user-role-form').submit();">Update</a>
        <form id="update-user-role-form" action="{{route('user.update.role', ['id' => $data['id'], 'role_id' => $data['role_id']])}}" method="POST" style="display: none;">
            <input type="hidden" name="_method" value="PUT">
            {{ csrf_field() }}
        </form>
    </div>

    <div class="col">
        <a href="javascript:history.go(-1)" class="btn btn-outline-secondary btn-block">Go Back</a>
    </div>


@endsection
