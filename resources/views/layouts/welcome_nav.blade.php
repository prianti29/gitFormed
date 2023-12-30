<nav class="navbar navbar-default custom-navbar">
    <div class="container-fluid">
        <!-- Navbar Header -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
            </button>
        </div>

        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse" id="navbar-collapse">
            {{-- <ul class="nav navbar-nav">
                <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                <li><a href="{{ url('/addrepo') }}">Repository</a></li>
                <li><a href="{{ url('/') }}">Pull Request</a></li>
            </ul> --}}
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ url('/allrepo') }}">Repositories</a></li>
                @if (Auth::check())
                    <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ url('/logout') }}">Logout</a></li>
                @else
                    <li><a href="{{ route('login') }}">Log in</a></li>
                    @if (Route::has('register'))
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @endif
                @endif
            </ul>
        </div>
    </div>
</nav>
