@extends('layouts.app')
@section('title', 'Home')
@section('css')

@endsection
@section('js')

@endsection
@section('content')
   
    @include('search.searchModule')
    
   <img src="{{asset('img/ethnobotanylandingpic.jpg')}}" style="display:block; margin-left: auto; margin-right:auto; width: 75%; height:75%; margin-top: 15px;">
            
    <h5 style="margin-top: 5px;">
        The Myaamia Ethnobotanical Database is a collection of plant references derived from over a decade of research and interviews regarding the historical and contemporary use of plants by the Myaamia People. This database organizes cultural information related to plants, and also contains other botanical information, scientific names, distribution, and related ecological data. 
    <br />
    <br />
        The information contained in the database supports the language and cultural revitalization efforts of the Miami Tribe of Oklahoma and is made available to the public through this searchable database. Many of these historical sources are unedited and may not have been verified against other sources so we recommend using historical references with caution or contacting the Myaamia Center to verify questionable references.

    </h5>
   
@endsection
