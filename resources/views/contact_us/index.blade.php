@extends('layouts.app')
@section('title', 'Home')
@section('css')

@endsection
@section('js')

@endsection
@section('content')

<h1 style="text-align: center;">Contact Us</h1>

<br>

@include('contact_us.contact')
  
@include('contact_us.create')
  
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif  
@endsection
