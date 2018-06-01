@extends('layouts.app')
@section('title', 'Signup')
@section('css')

@endsection
@section('js')

@endsection
@section('content')
<!--
    <div class="row" style="margin-top: 25px;">
        <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-xs-12">
            <a href="{{route('cas.index')}}" class="btn btn-block" style="background-color: #C8102E; color: white;">Miami Login</a>
        </div>
    </div>
    <div class="row" style="padding: 40px;">
        <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-xs-12" style="border-bottom: 2px solid #888888;">
            <span style="position: absolute; left: calc(50% - 20px); top: calc(50% - 12px); background: black;">&nbsp;&nbsp;&nbsp;OR&nbsp;&nbsp;&nbsp;</span>
        </div>
    </div>
-->
    <div class="row">
        <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-xs-12">
            <form role="form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">Name</label>

                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">E-Mail Address</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
