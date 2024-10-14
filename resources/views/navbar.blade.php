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

                <!-- home icon -->
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-home"></i></a>
                </li>

                @guest
                    <!-- Guest -->
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-language"></i></a> <!-- language icon -->
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

                @else
                    <!-- logged-in user -->
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-circle-plus"></i></a> <!-- plus icon -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-language"></i></a> <!-- language icon -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-address-card"></i></a> <!--contact icon -->
                    </li>

                    <!-- User Icon Dropdown -->
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if(Auth::user()->profile_image)
                                <img src="{{ asset('storage/profile_images/' . Auth::user()->profile_image) }}" width="30" height="30" class="rounded-circle" alt="User">
                            @else
                                <i class="fas fa-user-circle" style="font-size: 30px;"></i>
                            @endif
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fa-solid fa-user me-1"></i>{{ __('Profile') }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-arrow-right-from-bracket me-1"></i>{{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li> --}}

                @endguest

                {{-- @if(Auth::user() && Auth::user()->isAdmin())
                    <!-- Admin -->
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-circle-plus"></i></a> <!-- Plus icon -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-language"></i></a> <!-- language icon -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-user-circle"></i></a> <!-- User Icon -->
                    </li>
                    <!-- Admin Dropdown -->
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fa-solid fa-user me-1"></i>{{ __('Profile') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-arrow-right-from-bracket me-1"></i>{{ __('Logout') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <i class="fa-solid fa-user-tie me-1"></i>{{ __('Admin Page') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                @endif --}}

            </ul>
        </div>
    </div>
</nav>


