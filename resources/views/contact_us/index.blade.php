@extends('layouts.app')
@section('title', 'Home')
@section('css')

@endsection
@section('js')

@endsection
@section('content')

@if(Session::has('message'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('message', '') }}
    </div>
@endif
<h1 style="text-align: center;">Contact Us</h1>

<div class="container">
    <div class="row">
        <div class="col-6">
           <h1 style="text-align: center;">Contact Information</h1>
            @include('contact_us.contact')
        </div>
        <div class="col-6">
           <h1 style="text-align: center;">Submit Feedback</h1>
            @include('contact_us.create')
        </div>
    </div>
</div>
  
 
@endsection
