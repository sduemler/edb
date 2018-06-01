<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>EDB - @yield('title')</title>
    <link rel="icon" href="{{asset('favicon.ico?v='.time())}}" type="image/x-icon">
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="{{ asset("css/app.css"."?time=".time()) }}" rel="stylesheet">
    @yield('css')

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};

        function showWarningBox(reason, data) {
            var json = {};
            json.reason = reason;
            json.data = data;

            $('#warning-box-form input').val(JSON.stringify(json));
            $('#warning-box-form').submit();
        }
    </script>
</head>
<body>
    <div id="loading-screen" style="display: none; position: absolute; left: 0; top: 0; z-index: 2000; width: 100%; height: 100vh; background-color: #000000; opacity: 0.75;">
        <div style="width: 150px; height: 150px; background-color: white; position: absolute; left: calc(50% - 75px); top: calc(45% - 75px); border-radius: 200px;">
            <img src="{{ asset('img/loading.gif') }}" alt="loading" style="width: 100px; height: 76px; position: relative; left: calc(50% - 50px); top: calc(50% - 38px);">
        </div>
    </div>

    <form id="warning-box-form" action="{{route('warning.index')}}" method="POST" style="display: none;">
        <input type="hidden" name="data">
    </form>

    @include('shared.header')
    <div class="container">
        @yield('content')
    </div>
    @include('shared.footer')

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js?time='.time()) }}"></script>
    <script>
        $(document).ready(function() {
            $('button:not(.no-loading), .btn:not(.no-loading), .loading').click(function(e) {
                $('#loading-screen').show();
            });
        });

        function loading() {
            $('#loading-screen').show();
        }
    </script>
    @yield('js')
</body>
</html>
