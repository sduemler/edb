@extends('layouts.app')
@section('title', 'Warning')
@section('css')
    @yield('css')
@endsection
@section('js')
    @yield('js')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2  text-center" style="border: 1px solid antiquewhite; padding: 15px;">
            <h3 style="letter-spacing: 2px;">Warning</h3>
            <h6>@yield('title')</h6>
            <div class="row" style="margin-top: 20px;">
                @yield('buttons')
            </div>
        </div>
    </div>





@endsection
