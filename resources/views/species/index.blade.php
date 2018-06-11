<!--This is the 'All Species' page-->
@extends('layouts.app')
@section('title', 'All Species')
@section('css')

@endsection
@section('js')

@endsection
@section('content')
    <div class="row">
        @if(!count($speciesArr))
            <div class="col-12">
                No Result Found!
            </div>
        @endif
        @foreach ($speciesArr as $species)
            <div class="col-md-6 col-xs-12 speciesNameCard" style="padding: 0px 30px; margin-top: 15px;">
                <div class="row" style="border: 1px solid #DDDDDD; padding: 15px;">
                    <!--The below two divs are for the latin name (and link) of the species and the general description of it-->
                        <h4><a href="{{route('species.show', ['id' => $species->id])}}"><i>{{$species->species_name ? $species->species_name : 'No Species Name'}}</i></a></h4>
                    <!--This is supposed to be the description, however I'm not sure why it only works with the species name TODO-->
                    <div style="float: left; width: 1000px; text-align: justify; margin-left: 20px;">
                        <h5>{{$species->species_name ? $species->species_name : 'No general description'}}</h5>
                    </div>
                    <div style="float: left; width: 1000px; text-align: justify; margin-left: 20px;">
                        <h5>{{$species->species_name ? $species->species_name : 'No general description'}}</h5>
                    </div>
                    
                    
                    

                </div>
            </div>
        @endforeach
<!-- Commented out because this is the all species page, and there will never be an instance of not finding any results -->

<!--
        @if(!count($speciesArr))
            No Species Found !
            @if(!Auth::guest() && Auth::user()->role_id == 1)
                You can (<a href="{{route('import.index')}}">import species</a>) from csv/excel file
            @endif
        @endif
-->

    </div>
@endsection