<link rel="stylesheet" href="assest/test2.css">

<nav>
    <a href="index.html"><img src="assest/logo34.png" alt="logo"></a>
    <div class="nav-links">
        <ul>
            <li><a href="{{ route('dashboard') }}">Home</a></li>
            <li><a href="Turtle categories.html">Appointments</a></li>
            <li><a href="{{ route('pages.discussion') }}">Discussion forum</a></li>
            <li><a href="{{ route('pages.plantinfo') }}">Plant information</a></li>
            <li><a href="threats.html">Resources</a></li>
        </ul>
    </div>
    @auth
    <div class="profile-dropdown">
        <button class="profile-button">{{ Auth::user()->name }}</button>
        <div class="profile-menu">
            <a href="{{ route('profile.show') }}">Profile</a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
        </div>
    </div>
    @endauth
</nav>