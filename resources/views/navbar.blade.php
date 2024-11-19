<!-- Navbar -->
<nav class="navbar navbar-expand-md navbar-dark shadow-sm 
    {{ Auth::user() && Auth::user()->isAdmin() ? 'navbar-admin' : (Auth::check() ? 'navbar-registered' : 'navbar-guest') }}">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logos/whereToGo_navbar_sample.png') }}" alt="navbar-logo" class="navbar-logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Home icon -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}"><i class="fas fa-home"></i></a>
                </li>

                @if(Auth::user() && Auth::user()->isAdmin())
                    <!-- Admin -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('select-post-form') }}">
                            <i class="fa-solid fa-circle-plus"></i>
                        </a> <!-- Plus icon -->
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-language"></i></a> <!-- Language icon -->
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{route('profile.show', Auth::user()->id)}}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if(Auth::user()->avatar)
                                <img src="data:image/{{ explode(';', Auth::user()->avatar)[0] }};base64,{{ explode(',', Auth::user()->avatar)[1] }}" width="30" height="30" class="rounded-circle" alt="Admin User">
                            @else
                                <i class="fas fa-user-circle" style="font-size: 30px;"></i>
                            @endif
                            <span class="username">
                                {{ Auth::user()->username }}
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile.show', Auth::user()->id)}}">
                                <i class="fa-solid fa-user me-1"></i>{{ __('Profile') }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-arrow-right-from-bracket me-1"></i>{{ __('Logout') }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('admin.inquiries.index') }}">
                                <i class="fa-solid fa-user-tie me-1"></i>{{ __('Admin Page') }}
                            </a>
                        </div>
                    </li>
                @elseif(Auth::check())
                    <!-- Logged-in user -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('select-post-form') }}"><i class="fa-solid fa-circle-plus"></i></a> <!-- Plus icon -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-language"></i></a> <!-- Language icon -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact.create') }}"><i class="fas fa-address-card"></i></a> <!-- Contact icon -->
                    </li>
                    <!-- User Icon Dropdown -->
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{route('profile.show', Auth::user()->id)}}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if(Auth::user()->avatar)
                                <img src="data:image/{{ explode(';', Auth::user()->avatar)[0] }};base64,{{ explode(',', Auth::user()->avatar)[1] }}" width="30" height="30" class="rounded-circle" alt="User">
                            @else
                                <i class="fas fa-user-circle" style="font-size: 30px;"></i>
                            @endif
                            <span class="username">
                                {{ Auth::user()->username }}
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('profile.show', Auth::user()->id)}}">
                                <i class="fa-solid fa-user me-1"></i>{{ __('Profile') }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-arrow-right-from-bracket me-1"></i>{{ __('Logout') }}
                            </a>
                        </div>
                    </li>
                @else
                    <!-- Guest -->
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-language"></i></a> <!-- Language icon -->
                    </li>
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i class="fa-solid fa-arrow-right-to-bracket"></i></a>
                        </li>
                    @endif
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}"><i class="fa-solid fa-user-plus"></i></a>
                        </li>
                    @endif
                @endif

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            </ul>
        </div>
    </div>
</nav>
