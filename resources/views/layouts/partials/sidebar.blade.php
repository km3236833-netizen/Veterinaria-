<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-paw"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Veterinaria</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Gestión Médica</div>

    <!-- Nav Item - Expedientes -->
    <li class="nav-item {{ request()->routeIs('expedientes') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('expedientes') }}">
            <i class="fas fa-fw fa-folder-open"></i>
            <span>Expedientes</span>
        </a>
    </li>

    <!-- Nav Item - Mascotas (Pacientes) -->
    <li class="nav-item {{ request()->routeIs('mascotas.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('mascotas.index') }}">
            <i class="fas fa-fw fa-dog"></i>
            <span>Pacientes</span>
        </a>
    </li>

    <!-- Nav Item - Dueños -->
    <li class="nav-item {{ request()->routeIs('duenos.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('duenos.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Propietarios</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Administración</div>

    <!-- Nav Item - Usuarios (solo admin) -->
    @if(auth()->user()->rol === 'administrador')
    <li class="nav-item {{ request()->routeIs('admin.usuarios.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.usuarios.index') }}">
            <i class="fas fa-fw fa-user-cog"></i>
            <span>Usuarios</span>
        </a>
    </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
