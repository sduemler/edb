<!--This is the 'All Species' page-->
@extends('layouts.app')
@section('title', 'All Species')
@section('css')

@endsection
@section('js')

@endsection
@section('content')
    <div class="row"> 
        @foreach ($speciesArr as $species)
            <div class="col-md-6 col-xs-12 speciesNameCard" style="padding: 0px 30px; margin-top: 15px;">
                <div class="row" style="border: 1px solid darkslategrey; padding: 15px;">
                    <!--The below two divs are for the latin name (and link) of the species and the general description of it-->
                        <h4><a href="{{route('species.show', ['id' => $species->id])}}"><i>{{$species->species_name ? $species->species_name : 'Undetermined'}}</i></a></h4>
                    <!--This is supposed to be the Common name and Myaamia name, however I'm not sure why it only works with the species name TODO-->
                    <div style="float: left; width: 1000px; text-align: justify; margin-left: 20px;">
                        <h5>{{$species->common_name ? $species->common_name : 'No common name'}}</h5>
                    </div>
                    <div style="float: left; width: 1000px; text-align: justify; margin-left: 20px;">
                        <h5>{{$species->miami_name ? $species->miami_name : 'No Myaamia name'}}</h5>
                    </div>
                    
                    
                    

                </div>
            </div>
        @endforeach
    </div>
@endsection