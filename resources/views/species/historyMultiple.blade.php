@extends('layouts.app')
@section('title', 'Home')
@section('css')

@endsection
@section('js')

@endsection
@section('content')

<div class="row">
    <div class="col-12">
        <h3>History of: {{$category}}</h3>
        <table class="table table-bordered" style="margin-top: 15px;">
            <thead>
            <tr>
                <th>Version</th>
                <th>Value</th>
                <th>Create User</th>
                <th>Date Created</th>
            </tr>
            </thead>
            
            <tbody>
               <?php $oldData = ''; ?>
                @foreach ($speciesArr as $species)
                    <?php   $currentData = array();
                            foreach($schemeArr as $value){
                            if($species[$value['key']] == "TRUE"){
                                    array_push($currentData, $value['key']);
                                }
                            }
                            $currentDataString = implode(' ', $currentData);
                            //echo $currentDataString;
                            //print_r($currentData);
                            if($oldData == $currentDataString){
                                continue;
                            } else {
                                $oldData = $currentDataString;
                            }
                            /*$diff = array_diff($oldData, $currentData);
                            print_r($diff);
                            if(count($diff) == 0){
                                continue;
                            } else {
                                $oldData = $currentData;
                            }
                            */
                            
                    ?>
                <tr>
                    <th scope="row"><?php $version = intval($species['version']);
                                            if($version == 0){
                                                echo 'Origin';
                                            } else {
                                                echo $version + 1;
                                            }
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
                    <td>{{$species['created_at']}}</td>
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