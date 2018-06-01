@extends('layouts.app')
@section('title', 'Request Result')
@section('css')

@endsection
@section('js')

@endsection
@section('content')
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Request ID</th>
            <th>Request Type</th>
            <th>Request Item ID</th>
            <th>Created At</th>
            <th>Updated At</th>

            <th>Status</th>
            <th>Proceed By</th>
            <th>Proceed At</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($requests as $request)
            <tr>
                <th scope="row">{{$request->id}}</th>
                <td>{{$request->type}}</td>
                <td>{{$request->species_id}}</td>

                <td>{{$request->created_at}}</td>
                <td>{{$request->updated_at}}</td>


                <td>{{$request->status}}</td>
                <td>{{$request->proceed_by}}</td>
                <td>{{$request->proceed_at}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>





@endsection
