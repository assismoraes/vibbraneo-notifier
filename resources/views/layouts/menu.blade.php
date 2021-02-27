@if (Auth::check())
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('home') }}">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('applications-list') }}">Applications</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('channels-list') }}">Channels</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link float-right" href="{{ route('logout') }}">Quit</a>
                </li>
            </ul>
        </div>
    </nav>
    <br>
@endif