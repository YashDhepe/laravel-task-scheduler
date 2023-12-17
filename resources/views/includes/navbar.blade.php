{{-- BEGIN: Default Header --}}
{{-- <nav class="w-100 d-flex px-4 py-2 mb-4 shadow-sm main-navbar">
    <!-- close sidebar -->
    <button class="btn py-0 d-lg-none" id="open-sidebar">
      <span class="bi bi-list text-primary h3"></span>
    </button>
    <div class="dropdown ml-auto">
      <button class="btn py-0 d-flex align-items-center" id="logout-dropdown" data-toggle="dropdown" aria-expanded="false">
        <span class="bi bi-person text-primary h4"></span>
        <span class="bi bi-chevron-down ml-1 mb-2 small"></span>
      </button>
      <div class="dropdown-menu dropdown-menu-right border-0 shadow-sm" aria-labelledby="logout-dropdown">
        <a class="dropdown-item" href="#">Logout</a>
        <a class="dropdown-item" href="#">Settings</a>
      </div>
    </div>
  </nav> --}}
{{-- END: Default Header --}}


<nav class="navbar navbar-expand-lg navbar-darkk bg-darkk sticky-top mt-3">
    <div class="container-fluid">
        <!-- Navbar brand/logo -->
        <a class="navbar-brand" href="#">Task Scehedular</a>

        <!-- Navbar toggle button for smaller screens -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="navbarNav">

            @guest()
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class=" {{ (Route::currentRouteName() == 'login')?'btn btn-primary':'nav-link' }}" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class=" {{ (Route::currentRouteName() == 'register')?'btn btn-primary':'nav-link' }}" href="{{ route('register') }}">Register</a>
                    </li>
                </ul>
            @else
                <!-- User dropdown menu -->
                <div class="nav-item dropdown ms-auto">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Welcome, {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                        {{-- <li><a class="dropdown-item" href="#">Profile</a></li>
                  <li><a class="dropdown-item" href="#">Settings</a></li> --}}
                        {{-- <li><hr class="dropdown-divider"></li> --}}
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                @endguest
            </div>
        </div>
    </div>
</nav>
