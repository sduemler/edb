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

    <br>
    <br>
<!--    a count variable so that you don't display each of the boolean schemes more than once.     -->
        <?php 
            $count = 0;
         ?>
    <input type="hidden" name="_method" value="PUT">
    <div class="row">
        @foreach ($schemeArr as $scheme)
            @if ($scheme->type == 'input' && $scheme->key != 'earliest_record' && $scheme->key != 'latest_record' && $scheme->key != 'family')
                <div class="col-xl-3 col-lg-4 col-md-6 col-xs-12" style="margin-right: 60px;">
                    <div class="form-group">
                        {{Form::label($scheme->key, $scheme->displayed_name)}}
                        {{Form::text($scheme->key, $species->getAttribute($scheme->key), ['class' => 'form-control'])}}
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
                         //Creates an array that stores all the uses and one to store the boolean values of this specific species
                            $uses = array();
                            $usesValues = array();
                          ?>
                            @foreach($schemeArr as $scheme)
                                @if($scheme->category == 'uses')
                                    <?php 
                                        //While it's looping through the schemes array, if it finds anything with the category of uses, adds to the array
                                        $uses[$scheme->key] = $scheme->name;
                                        //This gets the true false value for each attribute so the page can load with the correct boxes checked
                                        //May be a better way to do this, however this is the only thing I could get to work
                                        $usesValues[$scheme->name] = $species->getAttribute($scheme->key)
                                    ?>
                                @endif
                            @endforeach

        <!--                  Takes the array into account for the selection and displays all the values- -->
                            @foreach($uses as $key => $name)
<!--                           How it goes about getting the correct information to fill in. I believe that this is where the issue lies
                               I'm assuming that it just has something to do with how the array is going through and what is being sent when
                               the form is submitted. I just don't know what the issue is-->
                                {{Form::checkbox($key, 'TRUE', $usesValues[$name]==='TRUE'?true:false)}}
                                {{$name}}
                                <br>
                            @endforeach
                             <?php 
                                $count++;
                            ?>
                        </div>
                    </div>
                @endif
        
<!--        Everything for the rest of the boolean fields works the same as the uses above-->
        
                <!--                So that you can say the new species is found in these habitats-->
                @if($scheme->category == 'habitat' && $count == 1)
                   <div class="form-group">
			            <div style="margin: 5px;">
				        <strong>Habitats: </strong>
                        <br>
                         <?php 
                         //Creates an array that stores all the habitats and one to store the boolean values of this specific species
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
                               {{Form::checkbox($key, 'TRUE', $habitatValues[$name]==='TRUE'?true:false)}}
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
                         //Creates an array that stores all the locations and one to store the boolean values of this specific species
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
                               {{Form::checkbox($key, 'TRUE', $locationsValues[$name]==='TRUE'?true:false)}}
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
                         //Creates an array that stores all the growth forms and one to store the boolean values of this specific species
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
                                   {{Form::checkbox($key, 'TRUE', $growth_formsValues[$name]==='TRUE'?true:false)}}
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
                         //Creates an array that stores all the seasons and one to store the boolean values of this specific species
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
                                   {{Form::checkbox($key, 'TRUE', $seasonValues[$name]==='TRUE'?true:false)}}
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
<!--
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
-->
            @else

            @endif
        @endforeach
    <br>
    
    </div>
    <br>

    <?php
            $specificSources = array();
            $sourcesCount = 0;
            foreach($sourcesArr as $source){
                if($source->oid == $species->oid){
                    $specificSources[] = array($source->reference_type, $source->content, $source->source, 
                                                          $source->source_date, $source->summary, $source->comments, $source->source_type, $source->citation);
                    $sourcesCount++;
                }
            }
            $emptyCount = 10 - $sourcesCount;
            while($emptyCount < 10){
                $specificSources[$emptyCount] = array(null, null, null, null, null, null, null, null);
                $emptyCount++;
            }
            print_r($specificSources[6][0]);
    ?>
    <h2>Sources</h2>
        Number of Sources
        {{Form::text('num_sources', $sourcesCount, ['class' => 'form-control'])}}
        <div class="row">
            <table class="table table-bordered" style="margin-top: 15px;">
                <thead>
                    <tr>
                        <th>Reference Type</th>
                        <th>Content</th>
                        <th>Source</th>
                        <th>Source Date</th>
                        <th>Summary</th>
                        <th>Comments</th>
                        <th>Source Type</th>
                        <th>Citation</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                        $source_types = array('Archival', 'Botanical', 'Related');
                        for($x = 0; $x < 10; $x++){                             
                    ?>
                        <tr>
                            <td>{!! Form::text('reference_type[][reference_type]', $specificSources[$x][0], ['class' => 'form-control']) !!}</td>
                            <td>{!! Form::text('content[][content]', $specificSources[$x][1], ['class' => 'form-control']) !!}</td>
                            <td>{!! Form::text('source[][source]', $specificSources[$x][2], ['class' => 'form-control']) !!}</td>
                            <td>{!! Form::text('source_date[][source_date]', $specificSources[$x][3], ['class' => 'form-control']) !!}</td>
                            <td>{!! Form::text('summary[][summary]', $specificSources[$x][4], ['class' => 'form-control']) !!}</td>
                            <td>{!! Form::text('comments[][comments]', $specificSources[$x][5], ['class' => 'form-control']) !!}</td>
                            <td>{!! Form::select('source_type[][source_type]', $source_types, $specificSources[$x][6], array('class' => 'form-control')) !!}</td>
                            <td>{!! Form::text('citation[][citation]', $specificSources[$x][7], ['class' => 'form-control']) !!}</td>
                        </tr>
                    <?php 
                        } ?>

                </tbody>
            </table>

        </div>
    {{Form::submit('Save', ['class' => 'btn btn-outline-danger', 'style' => 'cursor: pointer;'])}}
    {{Form::close()}}
    
@endsection