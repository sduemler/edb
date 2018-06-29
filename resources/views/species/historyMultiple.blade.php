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