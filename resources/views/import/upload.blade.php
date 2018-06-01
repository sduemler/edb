@extends('layouts.app')
@section('title', 'Upload')
@section('css')

@endsection
@section('js')

@endsection
@section('content')


<div class="row">
    <div class="col-12">
        {{ Form::open(['route' => 'import.process']) }}
            <input type="hidden" name="path" value="{{$path}}">
            <a href="{{route('import.index')}}" class="btn btn-outline-secondary">Choose Another File</a>
            {{ Form::submit('Start Import', ['class' => 'btn btn-outline-primary']) }}
        {{ Form::close() }}
    </div>
</div>

<div class="row" style="margin-top: 30px;">
    <div class="col-12">
        <table class="table table-bordered">
            <thead>
            <tr>
                @foreach ($schemeArr as $scheme)
                    <th>{{$scheme->getAttribute('name')}}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach ($rows as $row)
                <tr>
                    @foreach ($schemeArr as $scheme)
                        <td>{{$row->get($scheme->getAttribute('key'))}}</td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection
