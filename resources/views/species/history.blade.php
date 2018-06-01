@extends('layouts.app')
@section('title', 'Home')
@section('css')

@endsection
@section('js')

@endsection
@section('content')

<div class="row">
    <div class="col-12">
        <h3>History of: {{$key}} column</h3>
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
                    @if($species[$key] == null)
                        <td style="color: gray;">(empty)</td>
                    @else
                        <td>
                        @if($key == 'photo')
                            <img src="{{UrlSigner::sign(url('file/'. $species[$key]), Carbon::now()->addSeconds(10))}}" alt="photo">
                        @elseif($key == 'audio')
                            <audio controls>
                                <source src="{{UrlSigner::sign(url('file/'. $species[$key]), Carbon::now()->addSeconds(300))}}">
                                Your browser does not support the audio tag.
                            </audio>
                        @else
                            {{$species[$key]}}
                        @endif
                        </td>
                    @endif
                    <td>{{$species['name']}}</td>
                    <td>{{$species['created_at']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="row" style="margin-top: 15px;">
    <div class="col-12">
        <a href="javascript:history.go(-1)" class="btn btn-primary">Go Back</a>
    </div>
</div>



@endsection
