@extends('layouts.app')
@section('title', 'Home')
@section('css')

@endsection
@section('js')

@endsection
@section('content')

<h1 style="text-align: center;">Contact Us</h1>

<br>

<div class="container">
    <div class="row">
        <div class="col-6">
            @include('contact_us.contact')
        </div>
        <div class="col-6">
            @include('contact_us.create')
        </div>
    </div>
</div>
  
 
@endsection
