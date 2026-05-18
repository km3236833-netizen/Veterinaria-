<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Brand -->
    <a class="navbar-brand text-gray-800 font-weight-bold ml-md-3 my-2 my-md-0 mr-auto text-decoration-none h5 mb-0" href="{{ route('home') }}">
        <i class="fas fa-paw text-primary mr-1"></i> Sistema Veterinario
    </a>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Inicio -->
        <li class="nav-item mr-3 my-auto">
            <a class="nav-link {{ request()->routeIs('home') ? 'text-primary font-weight-bold' : 'text-gray-600' }}" href="{{ route('home') }}">
                <i class="fas fa-home mr-1 {{ request()->routeIs('home') ? 'text-primary' : 'text-gray-400' }}"></i>
                <span>Inicio</span>
            </a>
        </li>

        <!-- Nav Item - Expedientes -->
        <li class="nav-item mr-3 my-auto">
            <a class="nav-link {{ request()->routeIs('expedientes') ? 'text-primary font-weight-bold' : 'text-gray-600' }}" href="{{ route('expedientes') }}">
                <i class="fas fa-folder-open mr-1 {{ request()->routeIs('expedientes') ? 'text-primary' : 'text-gray-400' }}"></i>
                <span>Expedientes</span>
            </a>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>



        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">December 12, 2019</div>
                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                    </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name ?? 'User' }}</span>
                <img class="img-profile rounded-circle"
                    src="{{ asset('startbootstrap-sb-admin-2-gh-pages/img/undraw_profile.svg') }}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->
