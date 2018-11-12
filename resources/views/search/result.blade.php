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
        <?php $speciesArray = array(); ?>
        
        @foreach ($speciesArr as $species)
           <?php $speciesArray[$species->id] = $species; ?>
            @foreach ($speciesArray as $id => $speciesObject)
            <?php 
                if ($species->oid == $speciesObject->oid) {
                    if ($species->version > $speciesObject->version){
                        unset($speciesArray[$speciesObject->id]);
                    } elseif ($species->version < $speciesObject->version) {
                        unset($speciesArray[$species->id]);
                    } else {
                        //do nothing
                    }
                } else {
                    //do nothing, because the oid's are different and 
                    //the species has already been put in the array
                } ?>
            @endforeach
        @endforeach
        @foreach($speciesArray as $id => $species)
        <!--Uses a ternary operator to check the database to see if the 3 categories exist. If so it pulls that data so you can see the 3 types of names, if not 
            it displays a default phrase that tells the user nothing is saved as the common, species, or Myaamia name-->
            <!--
            <div class="col-md-6 col-xs-12 speciesNameCard" style="padding: 0px 30px; margin-top: 15px;">
                <div class="row" style="border: 1px solid darkslategrey; padding: 15px;">
                    <h4><a href="{{route('species.show', ['id' => $species->id])}}"><i>{{$species->species_name ? $species->species_name : 'Undetermined'}}</i></a></h4>
                    <div style="float: left; width: 1000px; text-align: justify; margin-left: 20px;">
                        <h5>{{$species->common_name ? $species->common_name : 'No common name'}}</h5>
                    </div>
                    <div style="float: left; width: 1000px; text-align: justify; margin-left: 20px;">
                        <h5>{{$species->miami_name ? $species->miami_name : 'No Myaamia name'}}</h5>
                    </div>
                </div>
            </div>
            -->
            <div class="col-lg-12 col-md-12 col-xs-12 speciesNameCard" style="padding: 0px 30px; margin-top: 15px;">
                <h4><a href="{{route('species.show', ['id' => $species->id])}}" target="_blank"><i>{{$species->species_name ? $species->species_name : 'Undetermined'}}</i> &#124; {{$species->common_name ? $species->common_name : 'No common name'}} &#124; {{$species->miami_name ? $species->miami_name : 'No Myaamia name'}}</a></h4>
            </div>
        @endforeach
    </div>





@endsection
