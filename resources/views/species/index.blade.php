<!--This is the 'All Species' page-->
@extends('layouts.app')
@section('title', 'All Species')
@section('css')

@endsection
@section('js')

@endsection
@section('content')
   @include('search.searchModule')
   
    <div class="row"> 
        @foreach ($speciesArr as $species)
            <div class="col-lg-12 col-md-12 col-xs-12 speciesNameCard" style="padding: 0px 30px; margin-top: 15px;">
                <h4><a href="{{route('species.show', ['id' => $species->id])}}"><i>{{$species->species_name ? $species->species_name : 'Undetermined'}}</i> &#124; {{$species->common_name ? $species->common_name : 'No common name'}} &#124; {{$species->miami_name ? $species->miami_name : 'No Myaamia name'}}</a></h4>
            </div>
        @endforeach
    </div>
@endsection