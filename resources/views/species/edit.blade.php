@extends('layouts.app')
@section('title', 'Edit Species')
@section('css')
    <style>
        .custom-file-control.selected:lang(en)::after {
            content: "" !important;
        }
    </style>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $("input:file").change(function(e) {
                var fileName = $(this).val();
                $(this).next('.custom-file-control').addClass("selected").html(fileName);
            });
        });
    </script>
@endsection
@section('content')

    {{Form::open(['route' => ['species.update', $species->id], 'files' => true])}}
    {{Form::submit('Submit', ['class' => 'btn btn-large btn-primary openbutton', 'style' => 'cursor: pointer;'])}}

    <input type="hidden" name="_method" value="PUT">
    <div class="row">
        @foreach ($schemeArr as $scheme)
            @if ($scheme->type == 'input')
                <div class="col-xl-3 col-lg-4 col-md-6 col-xs-12">
                    <div class="form-group">
                        {{Form::label($scheme->key, $scheme->displayed_name)}}
                        {{Form::text($scheme->key, $species->getAttribute($scheme->key), ['class' => 'form-control'])}}
                    </div>
                </div>
            @elseif ($scheme->type == 'textarea')
                <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        {{Form::label($scheme->key, $scheme->displayed_name)}}
                        {{Form::textarea($scheme->key, $species->getAttribute($scheme->key), ['class' => 'form-control'])}}
                    </div>
                </div>
            @elseif ($scheme->type == 'boolean')
                <div class="col-lg-3 col-md-4 col-xs-6">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12">
                                {{Form::label($scheme->key, $scheme->displayed_name)}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                Yes
                                {{Form::radio($scheme->key, 'TRUE', $species->getAttribute($scheme->key)==='TRUE'?true:false)}}
                                No
                                {{Form::radio($scheme->key, 'FALSE', $species->getAttribute($scheme->key)==='FALSE'?true:false)}}
                            </div>
                        </div>
                    </div>
                </div>
            @elseif ($scheme->type == 'photo' || $scheme->type == 'audio')
                <div class="col-md-6 col-xs-12">

                    <div class="row">
                        <div class="col-12">
                            {{Form::label($scheme->key, $scheme->displayed_name)}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label class="custom-file">
                                {{Form::file($scheme->key, ['class' => 'custom-file-input'])}}
                                <span class="custom-file-control"></span>
                            </label>
                        </div>
                    </div>
                </div>
            @else

            @endif
        @endforeach
    </div>
    {{Form::submit('Save', ['class' => 'btn btn-large btn-primary openbutton', 'style' => 'cursor: pointer;'])}}
    {{Form::close()}}

@endsection