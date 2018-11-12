<nav class="navbar navbar-toggleable-md navbar-light fixed-top bg-inverse" style="background-color: #97c388 !important;">

    <button class="no-loading navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon" style="color:black;"></span>
    </button>
    <a class="navbar-brand" href="{{route('home.index')}}" style="line-height: 40px; height: 40px; vertical-align: middle; font-size: 1.6em; width: 130px; padding: 0; margin: 0; color: darkslategrey;">
        <img src="{{asset('img/ethnobotanybanner.jpg')}}" style="vertical-align: middle; height: 40px; margin-top: -7px;" alt=".">
    </a>
    <div class="collapse navbar-collapse justify-content-right" id="navbarCollapse">


        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" style="color: darkslategrey" href="{{route('home.index')}}">Home</a></li>
            <li class="nav-item"><a class="nav-link" style="color: darkslategrey" href="{{route('docs.index')}}">About</a> </li>
            <li class="nav-item"><a class="nav-link" style="color: darkslategrey" href="{{route('species.index')}}">Browse</a></li>
            <li class="nav-item"><a class="nav-link" style="color: darkslategrey" href="{{route('search.index')}}">Advanced Search</a></li>
            <li class="nav-item"><a class="nav-link" style="color: darkslategrey" href="{{route('bibliography.index')}}">Bibliography</a> </li>
            <li class="nav-item"><a class="nav-link" style="color: darkslategrey" href="{{route('contact_us.index')}}">Contact Us</a> </li>
            
            @if(!Auth::guest() && Auth::user()->role_id != 4)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" style="color: darkslategrey" href="#" id="navbarActionsLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actions
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarActionsLink">
                        <a class="dropdown-item" href="{{url('/species/create')}}">Add Species</a>
                        <!--
                        @if(in_array(Auth::user()->role_id, [1, 2]))
                            <a class="dropdown-item" href="{{url('/species/approval')}}">Approval Page</a>
                        @endif
                        -->
                        @if(Auth::user()->role_id == 1)
                            <a class="dropdown-item" href="{{url('/user')}}">User Management</a>
<!--
                            <a class="dropdown-item" href="{{url('/import')}}">Data Import</a>
                            <a class="dropdown-item" href="{{url('/backup')}}">Backup</a>
-->
                        @endif
                    </div>
                </li>
            @endif
        </ul>
    </div>
    
    <div style="width: 100%; position: absolute; top: 56px; left: 0; right: 0; height: 20px;  background-image: url({{asset("img/newribbonwork1.png")}}); background-color: black; background-repeat: repeat-x; background-size: 40px;" id="headerSepBar"></div>

</nav>
