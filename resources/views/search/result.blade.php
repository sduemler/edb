@extends('layouts.app')
@section('title', 'Search Results')
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
        <!--Uses a ternary operator to check the database to see if the 3 categories exist. If so it pulls that data so you can see the 3 types of names, if not 
            it displays a default phrase that tells the user nothing is saved as the common, species, or Myaamia name-->
            <div class="col-md-6 col-xs-12 speciesNameCard" style="padding: 0px 30px; margin-top: 15px;">
                <div class="row" style="border: 1px solid #DDDDDD; padding: 15px;">
                    <h4><a href="{{route('species.show', ['id' => $species->id])}}"><i>{{$species->species_name ? $species->species_name : 'No scientific name'}}</i></a></h4>
                    <div style="float: left; width: 1000px; text-align: justify; margin-left: 20px;">
                        <h5>{{$species->common_name ? $species->common_name : 'No common name'}}</h5>
                    </div>
                    <div style="float: left; width: 1000px; text-align: justify; margin-left: 20px;">
                        <h5>{{$species->miami_name ? $species->miami_name : 'No Myaamia name'}}</h5>
                    </div>
<!--
                    <div style="float: left; width: calc(100% - 135px); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        <h4><a href="{{route('species.show', ['id' => $species->id])}}"><i>{{$species->species_name ? $species->species_name : 'No Species Name'}}</i></a></h4>
                    </div>
-->
                </div>
            </div>
        @endforeach
    </div>





@endsection
