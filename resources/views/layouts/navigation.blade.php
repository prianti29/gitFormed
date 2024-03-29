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
                    <li style="margin-top: -10px">
                        <form action="{{ route('logout') }}" method="POST" class="logout-form">
                            @csrf
                            <button type="submit" class="btn btn-link logout-btn"><span
                                    class="glyphicon glyphicon-log-out"></span> Logout</button>
                        </form>
                    </li>
                    <li>
                        <a href="{{ url('/read-notifications') }}" id="notification-icon">
                            <span class="glyphicon glyphicon-bell"></span>
                            @php
                                $unreadNotificationsCount = Auth::user()->unreadNotificationsCount();
                            @endphp
                            @if ($unreadNotificationsCount > 0)
                            <span id="unread-notification-count" class="badge badge-danger">{{ $unreadNotificationsCount }}</span>
                            @endif
 
                         </a>
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
<script>
    $(document).ready(function () {
        // Get the current URL
        var currentUrl = "{{ url()->current() }}";

        // Add 'active' class to the corresponding menu item
        $('.custom-navbar .nav > li > a').each(function () {
            if ($(this).attr('href') == currentUrl) {
                $(this).parent().addClass('active');
            }
        });
    });
</script>