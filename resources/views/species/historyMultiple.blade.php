@extends('layouts.app')
@section('title', 'Home')
@section('css')

@endsection
@section('js')

@endsection
@section('content')

<div class="row">
    <div class="col-12">
        <h3>Change Log for {{ucwords($category)}}</h3>
        <table class="table table-bordered" style="margin-top: 15px;">
            <thead>
            <tr>
                <th>Version</th>
                <th>{{ucwords($category)}}</th>
                <th>Updated By</th>
                <th>Date and Time</th>
            </tr>
            </thead>
            
            <tbody>
               <?php $oldData = ''; 
                     $versionCount = 1;
                     $speciesArr = array_reverse($speciesArr);
                     $speciesCount = count($speciesArr);
                ?>
                @foreach ($speciesArr as $species)
                    <?php   $currentData = array();
                            foreach($schemeArr as $value){
                            if($species[$value['key']] == "TRUE"){
                                    array_push($currentData, $value['key']);
                                }
                            }
                            $currentDataString = implode(' ', $currentData);
                            if($oldData == $currentDataString){
                                continue;
                            } else {
                                $oldData = $currentDataString;
                            }
                            
                    ?>
                <tr>
                    <th scope="row"><?php  if($speciesCount == 1){
                                                echo 'Original';
                                            } else {
                                                echo $speciesCount;
                                            }
                                            $speciesCount--;
                                            
                        ?></th>
                    <td>
                       @foreach($schemeArr as $value)
                           @if($species[$value['key']] == "TRUE")
                               {{$value['name']}}
                               <br>
                           @endif
                       @endforeach
                    </td>
                    <td>
                         @foreach($userArr as $user)
                             @if($user['id'] == $species['user_id'])
                                 {{$user['name']}}
                             @endif
                         @endforeach
                    </td>
                    <td>{{substr($species['created_at'], 0, 10)}} , {{substr($species['created_at'], 11)}}</td>
                </tr>
                @endforeach
            </tbody>
            
        </table>
    </div>
</div>
<div class="row" style="margin-top: 15px;">
    <div class="col-12">
        <a href="javascript:history.go(-1)" class="btn btn-outline-danger">Go Back</a>
    </div>
</div>


@endsection