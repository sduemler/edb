@extends('layouts.app')
@section('title', 'Home')
@section('css')

@endsection
@section('js')

@endsection
@section('content')

<div class="row">
    <div class="col-12">
        <h3>History of: {{$category}} column</h3>
        <?php print_r($schemeArr); ?>
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
                @foreach ($speciesArr as $species)
                <tr>
                    <th scope="row">{{$species['version']}}</th>
                    <td>
                       @foreach($schemeArr as $value)
                           @if($species[$value['key']] == "TRUE")
                               {{$value['name']}}
                               <br>
                           @endif
                       @endforeach
                    </td>
                    <td>{{$species['user_id']}}</td>
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