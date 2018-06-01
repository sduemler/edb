@extends('layouts.app')
@section('title', 'Approval')
@section('css')

@endsection
@section('js')

@endsection
@section('content')
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Request ID</th>
            <th>Species Name</th>
            <th>Request By</th>
            <th>Request Type</th>
            <th>Request Item ID</th>
            <th>Created At</th>
            <th>Updated At</th>

            <th>Status</th>
            <th>Proceed By</th>
            <th>Proceed At</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($requests as $request)
            <tr>
                <th scope="row">{{$request->id}}</th>
                <td>{{$request->species_name}}</td>
                <td>{{$request->requested_by}}</td>
                <td>{{$request->type}}</td>
                <td>{{$request->species_id}}</td>

                <td>{{$request->created_at}}</td>
                <td>{{$request->updated_at}}</td>


                <td>{{$request->status}}</td>
                <td>{{$request->proceed_by}}</td>
                <td>{{$request->proceed_at}}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Action Button Group">
                        <a target="_blank" href="{{route('species.show', ['id' => $request->species_id])}}" class="no-loading btn btn-outline-primary">View</a>

                        @if($request->status != 'Approved')
                            <a href="#" class="btn btn-outline-success" onclick="event.preventDefault();
document.getElementById('approval-approve-form-{{$request->id}}').submit();">Approve</a>
                        @endif

                        <form id="approval-approve-form-{{$request->id}}" action="{{route('species.approval.approve', ['id' => $request->id])}}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>

                        @if($request->status != 'Denied')
                            <a href="#" class="btn btn-outline-danger" onclick="event.preventDefault();
document.getElementById('approval-deny-form-{{$request->id}}').submit();">Deny</a>
                        @endif
                        <form id="approval-deny-form-{{$request->id}}" action="{{route('species.approval.deny', ['id' => $request->id])}}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>





@endsection
