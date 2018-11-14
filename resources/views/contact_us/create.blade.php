{!! Form::open(['route' => 'contact_us.store']) !!}


<div class="form-group">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group">
    {!! Form::label('email', 'Email Address') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group">
    {!! Form::label('msg', 'Feedback') !!}
    {!! Form::textarea('msg', null, ['class' => 'form-control', ]) !!}
</div>


{!! Form::submit('Submit', ['class' => 'btn btn-info', 'style' => 'background-color:green; color:white;']) !!}


{!! Form::close() !!}