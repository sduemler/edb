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
		.panel-heading {
			background-image: none;
			background-color: #E82000;
			color: white;
			border-radius: 10px;
			border: 1px solid #FFFFFF;
			padding: 10px;
			width: 200px;
			text-align: center;
			height: 50px;
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
	<a href="#" class="btn btn-primary" id="advancedSearchBtn" style="float: right;">Search</a>
		<div class="panel-group">
		  <div class="panel panel-default">
			<div class="panel-heading">
			  <h4 class="panel-title">
				<a data-toggle="collapse" href="#collapse1">Names</a>
			  </h4>
			</div>
			<div id="collapse1" class="panel-collapse collapse">
			  <div class="panel-body">
				<div class="row">
				
				@foreach ($schemeArr as $scheme)
			@if ($scheme->category == 'name_type')
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
		  </div>
		</div>
	<br>
		<div class="panel-group">
		  <div class="panel panel-default">
			<div class="panel-heading">
			  <h4 class="panel-title">
				<a data-toggle="collapse" href="#collapse2">Uses</a>
			  </h4>
			</div>
			<div id="collapse2" class="panel-collapse collapse">
			  <div class="panel-body">
				<div class="row">
				
				@foreach ($schemeArr as $scheme)
					@if ($scheme->category == 'uses')
                <div class="col-lg-3 col-md-4 col-xs-6">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12">
                                {{Form::label($scheme->key, $scheme->displayed_name)}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                Yes
                                {{Form::radio($scheme->key, 'TRUE')}}
                                No
                                {{Form::radio($scheme->key, 'FALSE', false)}}
                            </div>
                        </div>
                    </div>
                </div>
					@endif
				@endforeach
			  </div>
			  </div>
			</div>
		  </div>
		</div>
	<br>
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" href="#collapse3">Habitats</a>
				</h4>
			</div>
			<div id="collapse3" class="panel-collapse collapse">
				<div class="panel-body">
					<div class="row">

						@foreach ($schemeArr as $scheme)
							@if ($scheme->category == 'habitat')
								<div class="col-lg-3 col-md-4 col-xs-6">
									<div class="form-group">
										<div class="row">
											<div class="col-12">
												{{Form::label($scheme->key, $scheme->displayed_name)}}
											</div>
										</div>
										<div class="row">
											<div class="col-12">
												Yes
												{{Form::radio($scheme->key, 'TRUE')}}
												No
												{{Form::radio($scheme->key, 'FALSE', false)}}
											</div>
										</div>
									</div>
								</div>
							@endif
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" href="#collapse4">Locations</a>
				</h4>
			</div>
			<div id="collapse4" class="panel-collapse collapse">
				<div class="panel-body">
					<div class="row">

						@foreach ($schemeArr as $scheme)
							@if ($scheme->category == 'locations')
								<div class="col-lg-3 col-md-4 col-xs-6">
									<div class="form-group">
										<div class="row">
											<div class="col-12">
												{{Form::label($scheme->key, $scheme->displayed_name)}}
											</div>
										</div>
										<div class="row">
											<div class="col-12">
												Yes
												{{Form::radio($scheme->key, 'TRUE')}}
												No
												{{Form::radio($scheme->key, 'FALSE', false)}}
											</div>
										</div>
									</div>
								</div>
							@endif
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" href="#collapse5">Growth Forms</a>
				</h4>
			</div>
			<div id="collapse5" class="panel-collapse collapse">
				<div class="panel-body">
					<div class="row">

						@foreach ($schemeArr as $scheme)
							@if ($scheme->category == 'growth_form')
								<div class="col-lg-3 col-md-4 col-xs-6">
									<div class="form-group">
										<div class="row">
											<div class="col-12">
												{{Form::label($scheme->key, $scheme->displayed_name)}}
											</div>
										</div>
										<div class="row">
											<div class="col-12">
												Yes
												{{Form::radio($scheme->key, 'TRUE')}}
												No
												{{Form::radio($scheme->key, 'FALSE', false)}}
											</div>
										</div>
									</div>
								</div>
							@endif
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" href="#collapse6">Season</a>
				</h4>
			</div>
			<div id="collapse6" class="panel-collapse collapse">
				<div class="panel-body">
					<div class="row">

						@foreach ($schemeArr as $scheme)
							@if ($scheme->category == 'season')
								<div class="col-lg-3 col-md-4 col-xs-6">
									<div class="form-group">
										<div class="row">
											<div class="col-12">
												{{Form::label($scheme->key, $scheme->displayed_name)}}
											</div>
										</div>
										<div class="row">
											<div class="col-12">
												Yes
												{{Form::radio($scheme->key, 'TRUE')}}
												No
												{{Form::radio($scheme->key, 'FALSE', false)}}
											</div>
										</div>
									</div>
								</div>
							@endif
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
    <br><br>
<!--    <a href="#" class="btn btn-primary" id="advancedSearchBtn" style="float: right;">Search</a>-->
	<br>
    {{Form::close()}}
@endsection
