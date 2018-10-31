@extends('layouts.app')
@section('title', 'Document')
@section('css')
    <style>
        .container a {
            color: #0275d8 !important;
        }
    </style>
@endsection
@section('js')

@endsection
@section('content')
	<div class="container">
		<div class="row">
		    <div class="col-10" id="AboutMain">
		        @include('wiki.about')
		    </div>

		    <div class="col" id="contributors">
		        @include('wiki.contributors');
		    </div>
	    </div>
    </div>
@endsection
