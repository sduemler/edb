@extends('layouts.app')
@section('title', 'Home')
@section('css')

@endsection
@section('js')

@endsection
@section('content')

<div class="row">
    <div class="col-12">
        <h3>Change log for "{{$key}}" category</h3>
        <table class="table table-bordered" style="margin-top: 15px;">
            <thead>
            <tr>
                <th>Version</th>
                <th>{{$key}}</th>
                <th>Updated By</th>
                <th>Date and Time</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($speciesArr as $species)
                <tr>
                    <th scope="row" style="border:1px solid darkslategrey;">{{$species['version']}}</th>
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
