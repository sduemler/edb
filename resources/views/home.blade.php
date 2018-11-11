@extends('layouts.app')
@section('title', 'Home')
@section('css')

@endsection
@section('js')

@endsection
@section('content')
   <div class="searchModule">
    <form class="searchElements">
            <input id="searchBox" type="text" placeholder="Search by Scientific, Common, or Myaamia name" style="width: 375px;">
            <button id="searchBtn" type="submit"><i class="fa fa-search" aria-hidden="true" style="color:white";></i></button>
            <script>
                $( document ).ready(function() {
                    $('#searchBtn').click(function(e) {
                        e.preventDefault();
                        var q = $('#searchBox').val();
                        if(!q) return;
                        loading();
                        window.location.href = "{{route('search.result')}}?q=" + q;
                    });
                });
            </script>
            {{--<a class="btn btn-outline-success my-2 my-sm-0" href="{{route('search.index')}}" style="margin-left: 8px;">Advanced Search</a>--}}
        </form>
        <a href="{{route('species.index')}}"><button id="browseBtn" type="submit">Browse</button></a>
       <a href="{{route('search.index')}}"><button id="advancedSearchBtn" type="submit">Advanced Search</button></a>
    </div>
    
   <img src="{{asset('img/ethnobotanylandingpic.jpg')}}" style="display:block; margin-left: auto; margin-right:auto; width: 75%; height:75%; margin-top: 15px;">
            
    <h5 style="margin-top: 5px;">
        The Myaamia Ethnobotanical Database is a collection of plant references derived from over a decade of research and interviews regarding the historical and contemporary use of plants by the Myaamia People. This database organizes cultural information related to plants, and also contains other botanical information, scientific names, distribution, and related ecological data. 
    <br />
    <br />
        The information contained in the database supports the language and cultural revitalization efforts of the Miami Tribe of Oklahoma and is made available to the public through this searchable database. Many of these historical sources are unedited and may not have been verified against other sources so we recommend using historical references with caution or contacting the Myaamia Center to verify questionable references.

    </h5>
   
@endsection
