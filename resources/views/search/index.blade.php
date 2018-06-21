@extends('layouts.app')
@section('title', 'Advanced Search')
@section('css')
	<style>
		.viewBlock {
			margin-top: 15px;
		}

		.viewBlock .row:nth-child(2) {
			padding-right: 15px;
		}

		.viewBlock .row:nth-child(2) > div {
			border: 1px solid #D8D8D8;
		}
	</style>
@endsection
@section('js')
    <script>
        function objectifyForm(formArray) {//serialize data function

            var returnArray = {};
            for (var i = 0; i < formArray.length; i++){
                returnArray[formArray[i]['name']] = formArray[i]['value'];
            }
            return returnArray;
        }

        $('#advancedSearchBtn').click(function(e) {
            e.preventDefault();


            window.location.href = "{{route('search.result')}}?type=advancedSearch&q=" + JSON.stringify(objectifyForm($('#advancedSearchForm').serializeArray()));
        });
		
		$(document).ready(function() {
		$('#collapse1').collapse("show");
		});
		
    </script>
@endsection
@section('content')

    {{Form::open(['route' => 'species.store', 'id' => 'advancedSearchForm'])}}
	<button type="submit" class="btn btn-outline-danger" id="advancedSearchBtn" style="float: right;">Search</button>
		<div class="panel-group">
            <h4>Names</h4>
			<div class="panel-body">
				<div class="row">
				
				@foreach ($schemeArr as $scheme)
			@if ($scheme->category == 'name_type' && $scheme->key != 'french_name' && $scheme->key != 'alt_word_form' && $scheme->key != 'family')
				<div class="col-xl-3 col-lg-4 col-md-6 col-xs-12">
					<div class="panel-group">
						{{Form::label($scheme->key, $scheme->displayed_name)}}
						{{Form::text($scheme->key, '', ['class' => 'form-control'])}}
					</div>
				</div>
			@endif
		@endforeach
			  </div>
			  </div>
		</div>
	<br>
    <div class="row">
		<div class="form-group">
			  <div style="margin: 5px;">
				<strong>Uses: </strong>
               <br>
                  <?php 
                  //Creates an array that stores all the uses
                    $uses = array();
                ?>
                @foreach($schemeArr as $scheme)
                    @if($scheme->category == 'uses')
                        <?php 
                            //While it's looping through the schemes array, if it finds anything with the category of uses, adds to the array
                            $uses[$scheme->key] = $scheme->name;
                        ?>
                    @endif

                @endforeach
<!--                  Takes the array into account for the selection and displays all the values-
                {{Form::select('uses', $uses, $selected = null, ['class' => 'form-control', 'multiple' => 'multiple'])}} -->
                @foreach($uses as $key => $name)
                    {{Form::checkbox($key, 'TRUE')}}
                    {{$name}}
                    <br>
                @endforeach
			  </div>
		</div>
        
<!--        Uses the same format for all the different categories below-->
	<br>
	<div class="form-group">
			  <div style="margin: 5px;">
				<strong>Habitats: </strong>
               <br>
                <?php 
                    $habitat = array();
                ?>
                @foreach($schemeArr as $scheme)
                    @if($scheme->category == 'habitat')
                        <?php 
                            $habitat[$scheme->key] = $scheme->name;
                        ?>
                    @endif

                @endforeach
                <!--
                {{Form::select($scheme, $habitat, $selected = null, ['class' => 'form-control', 'multiple' => 'multiple'])}}
                -->
                @foreach($habitat as $key => $name)
                    {{Form::checkbox($key, 'TRUE')}}
                    {{$name}}
                    <br>
                @endforeach
			  </div>
	</div>
	<br>
	<div class="form-group">
			  <div style="margin: 5px;">
				<strong>Locations: </strong>
               <br>
                <?php 
                    $locations = array();
                ?>
                @foreach($schemeArr as $scheme)
                    @if($scheme->category == 'locations')
                        <?php 
                            $locations[$scheme->key] = $scheme->name;
                        ?>
                    @endif

                @endforeach
                <!--
                {{Form::select($scheme, $locations, $selected = null, ['class' => 'form-control', 'multiple' => 'multiple'])}}
                -->
                @foreach($locations as $key => $name)
                    {{Form::checkbox($key, 'TRUE')}}
                    {{$name}}
                    <br>
                @endforeach
			  </div>
	</div>
	<br>
	<div class="form-group">
		<div style="margin: 5px;">
				<strong>Growth Forms: </strong>
               <br>
                <?php 
                    $growthForms = array();
                ?>
                @foreach($schemeArr as $scheme)
                    @if($scheme->category == 'growth_form' && $scheme->key != 'wild')
                        <?php 
                            $growthForms[$scheme->key] = $scheme->name;
                        ?>
                    @endif

                @endforeach
                <!--
                {{Form::select($scheme, $growthForms, $selected = null, ['class' => 'form-control', 'multiple' => 'multiple'])}}
                -->
                @foreach($growthForms as $key => $name)
                    {{Form::checkbox($key, 'TRUE')}}
                    {{$name}}
                    <br>
                @endforeach
			  </div>
	</div>
	<br>
	<div class="form-group">
		<div style="margin: 5px;">
				<strong>Harvest Season: </strong>
               <br>
                <?php 
                    $season = array();
                ?>
                @foreach($schemeArr as $scheme)
                    @if($scheme->category == 'season' && $scheme->key != 'unkn' && $scheme->key != 'na')
                        <?php 
                            $season[$scheme->key] = $scheme->name;
                        ?>
                    @endif

                @endforeach
                <!--
                {{Form::select($scheme, $season, $selected = null, ['class' => 'form-control', 'multiple' => 'multiple'])}}
                -->
                @foreach($season as $key => $name)
                    {{Form::checkbox($key, 'TRUE')}}
                    {{$name}}
                    <br>
                @endforeach
			  </div>
	</div>
    </div>
    <br><br>
<!--    <a href="#" class="btn btn-danger" id="advancedSearchBtn" style="float: right;">Search</a>-->
	<br>
    {{Form::close()}}
@endsection
