@extends('layouts.warning')
@section('css')

@endsection
@section('js')

@endsection
@section('title', 'Are you sure you want to deactivate this user?')
@section('buttons')

    <div class="col">
        <a href="{{route('user.destroy', ['id' => $data['id']])}}" class="btn btn-outline-danger btn-block" onclick="event.preventDefault();
document.getElementById('destroy-user-form').submit();">Deactivate</a>
        <form id="destroy-user-form" action="{{route('user.destroy', ['id' => $data['id']])}}" method="POST" style="display: none;">
            <input type="hidden" name="_method" value="DELETE">
            {{ csrf_field() }}
        </form>
    </div>

    <div class="col">
        <a href="javascript:history.go(-1)" class="btn btn-outline-secondary btn-block">Go Back</a>
    </div>



@endsection
