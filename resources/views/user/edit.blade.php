@extends('layouts.app')
@section('title', 'Profile')
@section('css')

@endsection
@section('js')

@endsection
@section('content')
    {{Form::open(['route' => ['user.update', $user->id]])}}
    <input style="display:none" type="text" name="email"/>
    <input style="display:none" type="password" name="password"/>
    <input type="hidden" name="_method" value="PUT">
    <div class="row">
        <div class="col-lg-5 col-xs-12">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        {{Form::label('email', 'Email')}}
                        <p><input type="text" class="form-control" disabled="disabled" value="{{$user->email}}" id="email"></p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        {{Form::label('name', 'Name')}}
                        @if($user->is_miami)
                            {{Form::text('name', $user->name, ['class' => 'form-control', 'disabled' => 'disabled'])}}
                        @else
                            {{Form::text('name', $user->name, ['class' => 'form-control'])}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if(!$user->is_miami)
            <div class="col-lg-5 offset-lg-2 col-xs-12">
                <div class="row">
                    <div class="col-12">
                        @if(Auth::user()->role_id != 1)
                            <div class="form-group">
                                {{Form::label('oldPassword', 'Old Password')}}
                                {{Form::password('oldPassword', ['class' => 'form-control'])}}
                                @if (session()->has('oldPassword'))
                                    <span class="help-block">
                                    <strong>{{ session('oldPassword') }}</strong>
                                </span>
                                @endif
                            </div>
                        @else
                            <div class="form-group">
                                {{Form::label('role_id', 'Role')}}
                                {{Form::select('role_id', $userRoles, $user->role_id, ['class' => 'form-control'])}}
                            </div>
                        @endif
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            {{Form::label('password', 'New Password')}}
                            {{Form::password('password', ['class' => 'form-control'])}}
                            @if (session()->has('password'))
                                <span class="help-block">
                                    <strong>{{ session('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif


        <div class="col-12">
            {{Form::submit('Update', ['class' => 'btn btn-outline-primary'])}}
        </div>

    </div>
    {{Form::close()}}

@endsection
