@extends('layouts.app')
@section('title', 'Import')
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
<div class="row">
    <div class="col-md-6 col-xs-12">
        <h4 style="text-align: center;">Species Import Instruction</h4>
        <ol>
            <li>Download template file
                <ul>
                    <li><a href="{{route('import.createTemplate', ['format' => 'csv'])}}" style="color: #0275d8;"><i class="fa fa-download" aria-hidden="true"></i> CSV Format (.csv)</a></li>
                    <li><a href="{{route('import.createTemplate', ['format' => 'xlsx'])}}" style="color: #0275d8;"><i class="fa fa-download" aria-hidden="true"></i> Excel Format (.xlsx)</a></li>
                </ul>
            </li>
            <li>Fill data into template file
                <ul>
                    <li>You can change the order of columns in the first row, but please Do not delete/modify any characters</li>
                </ul>
            </li>
            <li>Selecting file to upload by clicking "Browse" button</li>
            <li>Click "Upload" button and preview</li>
            <li>If everything looks good, click "Start Import" button</li>
            <li>If something is wrong, click "Choose Another File" button to select another file to import</li>
        </ol>
    </div>
    <div class="col-md-6 col-xs-12">
        {{ Form::open(['route' => 'import.upload', 'files' => 'true']) }}
        <div class="row" style="margin-top: 20px;">
            <div class="col-12">

                <label class="custom-file">
                    {{Form::file('importFile', ['class' => 'custom-file-input'])}}
                    <span class="custom-file-control"></span>
                </label>

            </div>
            <div class="col-12" style="margin-top: 20px;">
                {{Form::submit('Upload', ['class' => 'btn btn-primary'])}}
                @if ($errors->has('invalid_format'))
                    <span class="error">
                        <strong>{{ $errors->first('invalid_format') }}</strong>
                    </span>
                @endif
                @if ($errors->has('no_file'))
                    <span class="error">
                        <strong>{{ $errors->first('no_file') }}</strong>
                    </span>
                @endif
                @if ($errors->has('exception'))
                    <span class="error">
                        <strong>{{ $errors->first('exception') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        {{ Form::close() }}
    </div>
</div>


@endsection
