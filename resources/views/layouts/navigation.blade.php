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
            <ul class="nav navbar-nav" style="margin-top: 10px;">
                @if (Auth::check())
                    <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ url('/allrepo') }}">All Repositories</a></li>
                    <li><a href="{{ url('/addrepo') }}">My Repositories</a></li>
                    <li><a href="{{ url('/add-pull-req') }}">Pull Request</a></li>
                @else
                    <li><a href="{{ url('/allrepo') }}">Repositories</a></li>
                @endif
            </ul>

            <ul class="nav navbar-nav navbar-right" style="margin-top: 10px;">
                @if (Auth::check())
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="logout-form">
                            @csrf
                            <button type="submit" class="btn btn-link logout-btn"><span
                                    class="glyphicon glyphicon-log-out"></span> Logout</button>
                        </form>
                    </li>
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
