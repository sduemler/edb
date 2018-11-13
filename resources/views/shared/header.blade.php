<nav id="headerNavbar" class="navbar navbar-toggleable-md navbar-light fixed-top bg-inverse" >

    <button class="no-loading navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon" style="color:black;"></span>
    </button>
    <a id="bannerImgContainer" class="navbar-brand" href="{{route('home.index')}}">
        <img id="bannerImg" src="{{asset('img/ethnobotanybanner.jpg')}}" alt=".">
    </a>
    <div class="collapse navbar-collapse" id="navbarCollapse">


        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" style="color: white" href="{{route('home.index')}}">Home</a></li>
            <li class="nav-item"><a class="nav-link" style="color: white" href="{{route('docs.index')}}">About</a> </li>
            <li class="nav-item"><a class="nav-link" style="color: white" href="{{route('bibliography.index')}}">Bibliography</a> </li>
            <li class="nav-item"><a class="nav-link" style="color: white" href="{{route('contact_us.index')}}">Contact Us</a> </li>
            
            @if(!Auth::guest() && Auth::user()->role_id != 4)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" style="color: darkslategrey" href="#" id="navbarActionsLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actions
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarActionsLink">
                        <a class="dropdown-item" href="{{url('/species/create')}}">Add Species</a>
                        @if(Auth::user()->role_id == 1)
                            <a class="dropdown-item" href="{{url('/user')}}">User Management</a>
                        @endif
                    </div>
                </li>
            @endif
        </ul>
    </div>
    
    <div style="width: 100%; position: absolute; top: 56px; left: 0; right: 0; height: 20px;  background-image: url({{asset("img/MIDAribbon.jpg")}}); background-color: black; background-repeat: repeat-x; background-size: 80px;" id="headerSepBar"></div>

</nav>
