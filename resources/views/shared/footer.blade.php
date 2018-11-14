<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-12" style="text-align: center; color: white;">
                &copy; 2018 Miami Tribe of Oklahoma &#124; 3410 P Street &#124; Miami, OK 74354 &#124; 513-529-5648 &#124;
                @if (Auth::guest())
                <a style="color: green" href="{{url('/login')}}">Sign-in</a>
                @else
                <a href="{{ route('logout.logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" style="color: green;">
                            Logout ({{ Auth::user()->name }})
                        </a>

                        <form id="logout-form" action="{{ route('logout.logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                @endif
            </div>
        </div>
    </div>
</footer>