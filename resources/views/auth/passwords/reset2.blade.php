@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <h3>Please contact administrator: {{env('APP_ADMIN_NAME', 'admin')}} (<a href="mailto: {{env('APP_ADMIN_EMAIL', 'test@test.com')}}">{{env('APP_ADMIN_EMAIL', 'test@test.com')}}</a>)</h3>
    </div>
</div>
@endsection
