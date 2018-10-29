<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-12" style="text-align: center; color: grey;">
                &copy; 2018 Miami Tribe of Oklahoma &#124; 3410 P Street &#124; Miami, OK 74354 &#124; 513-529-5648 &#124;
                @if (Auth::guest())
                <a style="color: darkslategrey" href="{{url('/login')}}">Sign-in</a>
                @else
                <a href="{{ route('cas.logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            Logout ({{ Auth::user()->name }})
                        </a>

                        <form id="logout-form" action="{{ route('cas.logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                @endif
            </div>
        </div>
    </div>
</footer>