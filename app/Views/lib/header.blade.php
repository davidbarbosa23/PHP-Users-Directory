@php
$session = new \Session();
@endphp

<header class="">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container p-0">
            <a class="navbar-brand" href="/">Zinobe</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    @if($session->check())
                    <li class="nav-item ">
                        <a class="nav-link" href="/search">Directory</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-secondary" href="/logout">Logout</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-secondary" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-primary ml-2" href="/register">Register</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
