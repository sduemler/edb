@extends('layouts.app')
@section('title', 'Backup')
@section('css')
    <style>
        pre {
            font-family: "Lucida Console", "Lucida Sans Typewriter", monaco, "Bitstream Vera Sans Mono", monospace;
        }
    </style>
@endsection
@section('js')

@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <h3>Backup Status</h3>
            @if($monitor['isHealth'])
                <h5 style="color: green;">{{$monitor['status']}}</h5>
            @else
                <h5 style="color: red;">{{$monitor['status']}}</h5>
            @endif
        </div>
    </div>

    <div class="row" style="margin-top: 20px;">
        <div class="col-12">
            <h3>Detail</h3>
            <table class="table table-bordered">
                <thead>
                <tr>
                    @foreach(array_keys($list) as $key)
                        <th>{{$key}}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                <tr>
                    @foreach ($list as $value)
                        <td>{{$value}}</td>
                    @endforeach
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row" style="margin-top: 20px;">
        <div class="col-12">
            <h3>File Location</h3>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Full Path</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($files as $path => $data)
                        <tr>
                            <td>{{$data['fullPath']}}</td>
                            <td>{{$data['datetime']}}</td>
                            <td>
                                <a href="#" onclick="event.preventDefault();
document.getElementById('backup-destroy-form{{$data['index']}}').submit();" class="btn btn-danger">Delete</a>
                                <form id="backup-destroy-form{{$data['index']}}" action="{{route('backup.destroy')}}" method="POST" style="display: none;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="path" value="{{$path}}">
                                    {{ csrf_field() }}
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if(!count($files))
                <p style="text-indent: 15px;">No backup file found</p>
            @endif
        </div>
    </div>

    <div class="row" style="margin-top: 20px;">
        <div class="col-12">
            <h3>Backup Actions</h3>

            <a href="#" onclick="event.preventDefault();
document.getElementById('backup-store-form').submit();" class="btn btn-primary">Create New Backup</a>
            <form id="backup-store-form" action="{{route('backup.store')}}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection
