<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-user-shield"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin Panel</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard Admin</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Gestión
    </div>

    <!-- Nav Item - Menú -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.menu.index') }}">
            <i class="fas fa-fw fa-th-list"></i>
            <span>Menú de Opciones</span></a>
    </li>

    <!-- Nav Item - Usuarios -->
    <li class="nav-item {{ request()->routeIs('admin.usuarios.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.usuarios.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Usuarios</span></a>
    </li>

    <!-- Nav Item - Diagnósticos -->
    <li class="nav-item {{ request()->routeIs('consultas.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('consultas.index') }}">
            <i class="fas fa-fw fa-file-medical-alt"></i>
            <span>Diagnósticos</span>
        </a>
    </li>

    <!-- Nav Item - Reportes -->
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Reportes</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
