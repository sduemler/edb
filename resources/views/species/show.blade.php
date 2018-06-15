@extends('layouts.app')
@section('title', 'View')
@section('css')
<style>
    .viewBlock {
        margin-top: 10px;
    }

    /*These two sections are to put borders and
    correct spacing for all the fields of 
    all categories.*/
    .viewBlock .row:nth-child(1) {
        padding-right: 15px;
    }

    .viewBlock .row:nth-child(1) > div {
        border: 1px solid #D8D8D8;
    }

    /*These next two sections are to put the border
    and spacing around the species info.*/
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
    }

    .historyButton {
        position: relative;
        left: 10px;
    }
    
    table, th, td {
        border: 1px solid black;
        text-align: center;
    }
</style>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $("#showHistoryBtn").click(function(e) {
            e.preventDefault();
            $(this).hide();
            $("#hideHistoryBtn").removeClass("btn-outline-primary");
            $("#hideHistoryBtn").addClass("btn-primary");
            $("#hideHistoryBtn").show();
            $(".historyBtn").show();

        });
        $("#hideHistoryBtn").click(function(e) {
            e.preventDefault();
            $(this).hide();
            $("#showHistoryBtn").removeClass("btn-primary");
            $("#showHistoryBtn").addClass("btn-outline-primary");
            $("#showHistoryBtn").show();
            $(".historyBtn").hide();
        });
    });

</script>
@endsection
@section('content')
<h1 style="text-align: center;">
    <i>{{$species->species_name}} </i>
    <br>
    {{$species->common_name}}
</h1>
<br>
<div class="row">
    @foreach ($schemeArr as $scheme)			
    @if ($scheme->category == 'name_type' && $scheme->key != 'alt_word_form' && $scheme->key != 'french_name')
    <div class="viewBlock col-xl-12 col-lg-12 col-md-12 col-xs-12">
        <div class="row">
            <strong>{{$scheme->name}}: &nbsp;</strong>
            @if ($scheme->key == 'species_name')
                <i>{{$species->getAttribute($scheme->key)}}</i>
            @else
                {{$species->getAttribute($scheme->key)}}
            @endif
            <span class="historyButton">
                <a class="historyBtn" style="display: none;" href="{{route('species.history', ['id' => $species->id, 'key' => $scheme->key])}}"><i class="fa fa-history" aria-hidden="true"></i></a>
            </span>
        </div>
    </div>
    @else
    @endif
    @endforeach
</div>
<div class="row">
    <?php $uses = array(); ?>
    @foreach ($schemeArr as $scheme)		
    @if ($scheme->category == 'uses' && $species->getAttribute($scheme->key) == 'TRUE')
        <?php array_push($uses, $scheme->name);?>
    @else
    @endif
    @endforeach
    <div class="viewBlock col-xl-12 col-lg-12 col-md-12 col-xs-12">
        <div class="row">
            <strong>Uses: &nbsp;</strong>
    @if (count($uses) == 0)
        This species does not have any known uses.
    @else
            <?php $useCount = 0; ?>
            @foreach($uses as $use)
                @if ($useCount == count($uses) - 1)
                    {{$use}}
                @else
                    {{$use}},
                @endif
                <?php $useCount++; ?>
            @endforeach
            @endif
            <span class="historyButton">
                <a class="historyBtn" style="display: none;" href="{{route('species.history', ['id' => $species->id, 'key' => $scheme->key])}}"><i class="fa fa-history" aria-hidden="true"></i></a>
            </span>
        </div>
    </div>
</div>
<div class="row">
    <?php $harvestSeasons = array(); ?>
    @foreach ($schemeArr as $scheme)		
    @if ($scheme->category == 'season' && $species->getAttribute($scheme->key) == 'TRUE')
        <?php array_push($harvestSeasons, $scheme->name);?>
    @else
    @endif
    @endforeach
    <div class="viewBlock col-xl-12 col-lg-12 col-md-12 col-xs-12">
    <div class="row">
    <strong>Harvest Seasons: &nbsp;</strong>
    @if (count($harvestSeasons) == 0)
        This species does not have any known harvest seasons.
    @else
            <?php $harvestCount = 0; ?>
            @foreach($harvestSeasons as $harvest)
                @if ($harvestCount == count($harvestSeasons) - 1)
                    {{$harvest}}
                @else
                    {{$harvest}},
                @endif
                <?php $harvestCount++; ?>
            @endforeach
            @endif
            <span class="historyButton">
                <a class="historyBtn" style="display: none;" href="{{route('species.history', ['id' => $species->id, 'key' => $scheme->key])}}"><i class="fa fa-history" aria-hidden="true"></i></a>
            </span>
        </div>
    </div>
</div>
<div class="row">
    <?php $habitats = array(); ?>
    @foreach ($schemeArr as $scheme)		
    @if ($scheme->category == 'habitat' && $species->getAttribute($scheme->key) == 'TRUE')
        <?php array_push($habitats, $scheme->name);?>
    @else
    @endif
    @endforeach
    <div class="viewBlock col-xl-12 col-lg-12 col-md-12 col-xs-12">
    <div class="row">
    <strong>Habitats: &nbsp;</strong>
    @if (count($habitats) == 0)
        This species does not have any known habitats.
    @else
            <?php $habitatCount = 0; ?>
            @foreach($habitats as $habitat)
                @if ($habitatCount == count($habitats) - 1)
                    {{$habitat}}
                @else
                    {{$habitat}},
                @endif
                <?php $habitatCount++; ?>
            @endforeach
            @endif
            <span class="historyButton">
                <a class="historyBtn" style="display: none;" href="{{route('species.history', ['id' => $species->id, 'key' => $scheme->key])}}"><i class="fa fa-history" aria-hidden="true"></i></a>
            </span>
        </div>
    </div>
</div>
<div class="row">
    <?php $locations = array(); ?>
    @foreach ($schemeArr as $scheme)		
    @if ($scheme->category == 'locations' && $species->getAttribute($scheme->key) == 'TRUE')
        <?php array_push($locations, $scheme->name);?>
    @else
    @endif
    @endforeach
    <div class="viewBlock col-xl-12 col-lg-12 col-md-12 col-xs-12">
    <div class="row">
    <strong>Locations: &nbsp;</strong>
    @if (count($locations) == 0)
        This species is not located on any Myaamia property.
    @else
            <?php $locationCount = 0; ?>
            @foreach($locations as $location)
                @if ($locationCount == count($locations) - 1)
                    {{$location}}
                @else
                    {{$location}},
                @endif
                <?php $locationCount++; ?>
            @endforeach
            @endif
            <span class="historyButton">
                <a class="historyBtn" style="display: none;" href="{{route('species.history', ['id' => $species->id, 'key' => $scheme->key])}}"><i class="fa fa-history" aria-hidden="true"></i></a>
            </span>
        </div>
    </div>
</div>       
<div class="row">
    <?php $growthForms = array(); ?>
    @foreach ($schemeArr as $scheme)		
    @if ($scheme->category == 'growth_form' && $species->getAttribute($scheme->key) == 'TRUE')
        <?php array_push($growthForms, $scheme->name);?>
    @else
    @endif
    @endforeach
    <div class="viewBlock col-xl-12 col-lg-12 col-md-12 col-xs-12">
    <div class="row">
    <strong>Growth Forms: &nbsp;</strong>
    @if (count($growthForms) == 0)
        This species does not have any known growth forms.
    @else
            <?php $growthCount = 0; ?>
            @foreach($growthForms as $form)
                @if ($growthCount == count($growthForms) - 1)
                    {{$form}}
                @else
                    {{$form}},
                @endif
                <?php $growthCount++; ?>
            @endforeach
            @endif
            <span class="historyButton">
                <a class="historyBtn" style="display: none;" href="{{route('species.history', ['id' => $species->id, 'key' => $scheme->key])}}"><i class="fa fa-history" aria-hidden="true"></i></a>
            </span>
        </div>
    </div>
</div>
<br>
<div class="panel panel-default">
    <a data-toggle="collapse" data-parent="#accordion" href="#collapse8">
        <div class="panel-heading">
            <h4 class="panel-title">
                Sources
            </h4>
        </div>
    </a>
    <div id="collapse8" class="panel-collapse collapse in">
        <div class="panel-body">
         <?php $tableCount = count($sourceArr); ?>
         @if ($tableCount > 0)
          <table style="margin-top: 15px;">
              <thead>
                  <tr>
                      <th>Date</th>
                      <th>Reference Type</th>
                      <th>Content</th>
                      <th>Source</th>
                      <th>Comments</th>
                  </tr>
              </thead>
              <tbody>
                @foreach($sourceArr as $source)
                     <tr>
                         <td>{{$source->source_date}}</td>
                         <td>{{$source->reference_type}}</td>
                         <td>{{$source->content}}</td>
                         <td>{{$source->source}}</td>
                         <td>{{$source->comments}}</td>
                     </tr>
                @endforeach
              </tbody>
          </table>
          @else
          The data for this species does not have any known sources.
          @endif
          
          
          
           <!--
            <div class="row">
                @foreach ($schemeArr as $scheme)			
                @if ($scheme->category == 'long_descr' && $scheme->key != 'horticultural_info'  && $scheme->key != 'ecological_info' && $scheme->key != 'researcher_note')
                <div class="viewBlock col-md-12 col-xs-12">
                    <div class="row">
                        <strong>{{$scheme->name}}:</strong>
                        <span style="position: absolute; top: 0; right: 18px;">
                            <a class="historyBtn" style="display: none;" href="{{route('species.history', ['id' => $species->id, 'key' => $scheme->key])}}"><i class="fa fa-history" aria-hidden="true"></i></a>
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-12" style="height: 200px; overflow-y: auto;">
                            {{$species->getAttribute($scheme->key)}}
                        </div>
                    </div>
                </div>		  
                @else
                @endif
                @endforeach
            </div>
            -->
        </div>
    </div>
</div>
<br>

<div class="row">
    @if (Auth::guest())
    @else
    <div class="col-12">
        <a href="#" id="showHistoryBtn" class="no-loading btn btn-outline-primary float-right" style="margin-left: 15px;">Show Change Log Buttons</a>
        <a href="#" id="hideHistoryBtn" class="no-loading btn btn-outline-primary float-right" style="margin-left: 15px; display: none;">Hide Change Log Buttons</a>
        <a href="{{route('species.edit', ['id' => $species->id])}}" class="float-right btn btn-outline-primary">Edit This Species</a>
    </div>
    @endif
    
    <!--
    <div class="col-12">
        <p style="text-align: right; margin: 0; color: gray;">Version: {{$species->version}} </p>
        <p style="text-align: right; margin: 0; color: gray;">Created By: {{\App\User::find($species->user_id)->name}}</p>
        <p style="text-align: right; margin: 0; color: gray;">Created At: {{$species->created_at}}</p>
        @if(!$species->is_approved)
        <p style="text-align: right; margin: 0; color: #941728;">This version hasn't been approved</p>
        @endif
    </div>
    -->
</div>
@endsection