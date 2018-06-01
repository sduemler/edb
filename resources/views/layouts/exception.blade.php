@extends('layouts.app')
@section('title', 'oops')
@section('css')

@endsection
@section('js')

@endsection
@section('content')
    <h1 style="font-size: 120px; margin-top: -50px;">oops.</h1>
    <h1 style="margin-top: 20px;">We're sorry, but something went wrong.</h1>
    <h2 style="margin-top: 20px;">Detail: </h2>
    <h3>@yield('reason')</h3>
    <h4 style="margin-top: 20vh;"><a href="{{route('home.index')}}">Take me back to the home page</a></h4>
@endsection
