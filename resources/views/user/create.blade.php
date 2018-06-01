@extends('layouts.app')
@section('title', 'Add User')
@section('css')

@endsection
@section('js')

@endsection
@section('content')
    <div class="row">
        <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-xs-12">
            {{ Form::open(['route' => 'user.store']) }}
            <input style="display:none" type="text" name="email"/>
            <input style="display:none" type="password" name="password"/>
            <div class="col-12">
                <div class="form-group">
                    {{Form::label('name', 'Name')}}
                    {{Form::text('name', '', ['class' => 'form-control'])}}
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    {{Form::label('email', 'Email')}}
                    {{Form::text('email', '', ['class' => 'form-control'])}}
                </div>
                @if ($errors->has('email'))
                    <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                @endif
            </div>

            <div class="col-12">
                <div class="form-group">
                    {{Form::label('password', 'Password')}}
                    {{Form::password('password', ['class' => 'form-control'])}}
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    {{Form::label('role_id', 'Role')}}
                    {{Form::select('role_id', $userRoles, '', ['class' => 'form-control'])}}
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    {{Form::submit("Add User", ['class' => 'btn btn-outline-primary'])}}
                </div>
            </div>

            {{ Form::close() }}
        </div>
    </div>

@endsection
