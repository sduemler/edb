@extends('layouts.app')
@section('title', 'Edit Species')
@section('css')
    <style>
        .custom-file-control.selected:lang(en)::after {
            content: "" !important;
        }
    </style>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $("input:file").change(function(e) {
                var fileName = $(this).val();
                $(this).next('.custom-file-control').addClass("selected").html(fileName);
            });
        });
    </script>
@endsection
@section('content')

    {{Form::open(['route' => ['species.update', $species->id], 'files' => true])}}
    {{Form::submit('Save', ['class' => 'btn btn-outline-danger', 'style' => 'cursor: pointer;'])}}

<!--    a count variable so that you don't display each of the boolean schemes more than once.     -->
        <?php 
            $count = 0;
         ?>
<!--    <input type="hidden" name="_method" value="PUT">-->
    <div class="row">
        @foreach ($schemeArr as $scheme)
            @if ($scheme->type == 'input' && $scheme->key != 'earliest_record' && $scheme->key != 'latest_record' && $scheme->key != 'family')
                <div class="col-xl-3 col-lg-4 col-md-6 col-xs-12" style="margin-right: 60px;">
                    <div class="form-group">
                        {{Form::label($scheme->key, $scheme->displayed_name)}}
                        {{Form::text($scheme->key, $species->getAttribute($scheme->key), ['class' => 'form-control'])}}
                    </div>
                </div>
            @elseif ($scheme->type == 'textarea' && $scheme->key != 'horticultural_info')
                <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        {{Form::label($scheme->key, $scheme->displayed_name)}}
                        {{Form::textarea($scheme->key, $species->getAttribute($scheme->key), ['class' => 'form-control'])}}
                    </div>
                </div>
            @elseif ($scheme->type == 'boolean')
                <br>
                
<!--                So that you can say the new species has these uses-->
                @if($scheme->category == 'uses' && $count == 0)
                    <div class="form-group" style="margin-left: 10">
			             <div style="margin: 5px;">
				         <strong>Uses: </strong>
                         <br>
                          <?php 
                          //Creates an array that stores all the uses
                            $uses = array();
                            $usesValues = array();
                          ?>
                            @foreach($schemeArr as $scheme)
                                @if($scheme->category == 'uses')
                                    <?php 
                                        //While it's looping through the schemes array, if it finds anything with the category of uses, adds to the array
                                        $uses[$scheme->key] = $scheme->name;
                                        $usesValues[$scheme->name] = $species->getAttribute($scheme->key)
                                    ?>
                                @endif
                            @endforeach

        <!--                  Takes the array into account for the selection and displays all the values- -->
                            @foreach($uses as $key => $name)
                                {{Form::checkbox($scheme->key, 'TRUE', $usesValues[$name]==='TRUE'?true:false)}}
                                {{$name}}
                                <br>
                            @endforeach
                             <?php 
                                $count++;
                            ?>
                        </div>
                    </div>
                @endif
                <!--                So that you can say the new species is found in these habitats-->
                @if($scheme->category == 'habitat' && $count == 1)
                   <div class="form-group">
			            <div style="margin: 5px;">
				        <strong>Habitats: </strong>
                        <br>
                         <?php 
                         //Creates an array that stores all the uses
                           $habitat = array();
                           $habitatValues = array();
                           ?>
                           @foreach($schemeArr as $scheme)
                               @if($scheme->category == 'habitat')
                                   <?php 
                                       //While it's looping through the schemes array, if it finds anything with the category of uses, adds to the array
                                       $habitat[$scheme->key] = $scheme->name;
                                       $habitatValues[$scheme->name] = $species->getAttribute($scheme->key)
                                   ?>
                               @endif

                           @endforeach
        <!--                 Takes the array into account for the selection and displays all the values- -->
                           @foreach($habitat as $key => $name)
                               {{Form::checkbox($scheme->key, 'TRUE', $habitatValues[$name]==='TRUE'?true:false)}}
                               {{$name}}
                               <br>
                           @endforeach
                             <?php 
                                $count++;
                            ?>
                       </div>
                    </div>
                @endif
                       <!--                so that you can choose if a new species is at which locations-->

                @if($scheme->category == 'locations' && $count == 2)
                   <div class="form-group">
			            <div style="margin: 5px;">
				        <strong>Locations: </strong>
                   <br>
                         <?php 
                         //Creates an array that stores all the uses
                           $locations = array();
                           $locationsValues = array();
                           ?>
                           @foreach($schemeArr as $scheme)
                               @if($scheme->category == 'locations')
                                   <?php 
                                       //While it's looping through the schemes array, if it finds anything with the category of uses, adds to the array
                                       $locations[$scheme->key] = $scheme->name;
                                       $locationsValues[$scheme->name] = $species->getAttribute($scheme->key)
                                   ?>
                               @endif

                           @endforeach
        <!--                 Takes the array into account for the selection and displays all the values- -->
                           @foreach($locations as $key => $name)
                               {{Form::checkbox($scheme->key, 'TRUE', $locationsValues[$name]==='TRUE'?true:false)}}
                               {{$name}}
                               <br>
                           @endforeach
                             <?php 
                                $count++;
                            ?>
                       </div>
                    </div>
                @endif
        <!--                so that you can choose if a new species has which growth forms-->
                @if($scheme->category == 'growth_form' && $count == 3)
                   <div class="form-group">
			            <div style="margin: 5px;">
				        <strong>Growth Forms: </strong>
                   <br>
                         <?php 
                         //Creates an array that stores all the uses
                           $growth_forms = array();
                           $growth_formValues = array();
                           ?>
                               @foreach($schemeArr as $scheme)
                                   @if($scheme->category == 'growth_form' && $scheme->key != 'wild')
                                       <?php 
                                           //While it's looping through the schemes array, if it finds anything with the category of uses, adds to the array
                                           $growth_forms[$scheme->key] = $scheme->name;
                                           $growth_formsValues[$scheme->name] = $species->getAttribute($scheme->key)
                                       ?>
                                   @endif

                               @endforeach
            <!--                 Takes the array into account for the selection and displays all the values- -->
                               @foreach($growth_forms as $key => $name)
                                   {{Form::checkbox($scheme->key, 'TRUE', $growth_formsValues[$name]==='TRUE'?true:false)}}
                                   {{$name}}
                                   <br>
                               @endforeach
                             <?php 
                                $count++;
                            ?>
                       </div>
                    </div>
                @endif
<!--                So that you can account for all harvest seasons-->
                @if($scheme->category == 'season' && $count == 4)
                   <div class="form-group">
			            <div style="margin: 5px;">
				        <strong>Seasons: </strong>
                   <br>
                         <?php 
                         //Creates an array that stores all the uses
                           $season = array();
                           $seasonValues = array();
                           ?>
                               @foreach($schemeArr as $scheme)
                                   @if($scheme->category == 'season' && $scheme->key != 'unkn' && $scheme->key != 'na')
                                       <?php 
                                           //While it's looping through the schemes array, if it finds anything with the category of uses, adds to the array
                                           $season[$scheme->key] = $scheme->name;
                                           $seasonValues[$scheme->name] = $species->getAttribute($scheme->key)
                                       ?>
                                   @endif

                               @endforeach
            <!--                 Takes the array into account for the selection and displays all the values- -->
                               @foreach($season as $key => $name)
                                   {{Form::checkbox($scheme->key, 'TRUE', $seasonValues[$name]==='TRUE'?true:false)}}
                                   {{$name}}
                                   <br>
                               @endforeach
                             <?php 
                                $count++;
                            ?>
                       </div>
                    </div>
                @endif
            @elseif ($scheme->type == 'photo' || $scheme->type == 'audio')
                <div class="col-md-6 col-xs-12">

                    <div class="row">
                        <div class="col-12">
                            {{Form::label($scheme->key, $scheme->displayed_name)}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label class="custom-file">
                                {{Form::file($scheme->key, ['class' => 'custom-file-input'])}}
                                <span class="custom-file-control"></span>
                            </label>
                        </div>
                    </div>
                </div>
            @else

            @endif
        @endforeach
    </div>
    {{Form::submit('Save', ['class' => 'btn btn-outline-danger', 'style' => 'cursor: pointer;'])}}
    {{Form::close()}}

@endsection