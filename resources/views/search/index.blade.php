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
<!--	<button type="submit" class="btn btn-primary" id="advancedSearchBtn" style="float: right;">Search</button>-->
		<div class="form-group">
            <h4>Names</h4>
			<div class="form-body">
				<div class="row">
				
				@foreach ($schemeArr as $scheme)
			@if ($scheme->category == 'name_type' && $scheme->key != 'french_name' && $scheme->key != 'alt_word_form')
				<div class="col-xl-3 col-lg-4 col-md-6 col-xs-12">
					<div class="form-group">
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
				Uses: 
                <?php 
                    $uses = array();
                ?>
                @foreach($schemeArr as $scheme)
                    @if($scheme->category == 'uses')
                        <?php 
                            array_push($uses, $scheme->name)
                        ?>
                    @endif

                @endforeach
                {{Form::select($scheme, $uses, $selected = null, ['class' => 'form-control', 'multiple' => 'multiple', 'style' => 'background-color: white;'])}}
			  </div>
		</div>
	<br>
	<div class="form-group">
			  <div style="margin: 5px;">
				Habitats: 
                <?php 
                    $habitat = array();
                ?>
                @foreach($schemeArr as $scheme)
                    @if($scheme->category == 'habitat')
                        <?php 
                            array_push($habitat, $scheme->name)
                        ?>
                    @endif

                @endforeach
                {{Form::select($scheme, $habitat, $selected = null, ['class' => 'form-control', 'multiple' => 'multiple'])}}
			  </div>
	</div>
	<br>
	<div class="form-group">
			  <div style="margin: 5px;">
				Locations: 
                <?php 
                    $locations = array();
                ?>
                @foreach($schemeArr as $scheme)
                    @if($scheme->category == 'locations')
                        <?php 
                            array_push($locations, $scheme->name)
                        ?>
                    @endif

                @endforeach
                {{Form::select($scheme, $locations, $selected = null, ['class' => 'form-control', 'multiple' => 'multiple'])}}
			  </div>
	</div>
	<br>
	<div class="form-group">
		<div style="margin: 5px;">
				Growth Forms: 
                <?php 
                    $growthForms = array();
                ?>
                @foreach($schemeArr as $scheme)
                    @if($scheme->category == 'growth_form')
                        <?php 
                            array_push($growthForms, $scheme->name)
                        ?>
                    @endif

                @endforeach
                {{Form::select($scheme, $growthForms, $selected = null, ['class' => 'form-control', 'multiple' => 'multiple'])}}
			  </div>
	</div>
	<br>
	<div class="form-group">
		<div style="margin: 5px;">
				Season: 
                <?php 
                    $season = array();
                ?>
                @foreach($schemeArr as $scheme)
                    @if($scheme->category == 'season')
                        <?php 
                            array_push($season, $scheme->name)
                        ?>
                    @endif

                @endforeach
                {{Form::select($scheme, $season, $selected = null, ['class' => 'form-control', 'multiple' => 'multiple'])}}
			  </div>
	</div>
    </div>
    <br><br>
    <a href="#" class="btn btn-danger" id="advancedSearchBtn" style="float: right;">Search</a>
	<br>
<!--    {{Form::submit('Search', ['class'=>'btn btn-primary'])}}-->
    {{Form::close()}}
@endsection
