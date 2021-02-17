<li class="nav-item">
    <a class="nav-link" href="{{url('home')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Inicio</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{url('configuracion')}}">
        <i class="fas fa-cogs"></i>
        <span>Configuración</span></a>
</li>


<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Gestion de Datos    
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="{{url('/colaboradores')}}">
        <i class="fas fa-fw fa-user-tie"></i>
        <span>Colaboradores</span>
    </a>
    
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="{{url('/empresas')}}">
        <i class="fas fa-fw fa-building"></i>
        <span>Empresas</span>
    </a>
    <a class="nav-link collapsed" href="{{url('eventos')}}">
        <i class="fas fa-fw fa-calendar-check"></i>
        <span>Eventos</span>
    </a>
    <a class="nav-link collapsed" href="{{url('planeacion')}}">
        <i class="fas fa-fw fa-calendar-day"></i>
        <span>Planeación</span>
    </a>
    <!--<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <a class="collapse-item" href="utilities-color.html">Colors</a>
            <a class="collapse-item" href="utilities-border.html">Borders</a>
            <a class="collapse-item" href="utilities-animation.html">Animations</a>
            <a class="collapse-item" href="utilities-other.html">Other</a>
        </div>
    </div>-->
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Asignaciones
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link" href="{{url('/asignaciones')}}">
        <i class="fas fa-fw fa-user-cog"></i>
        <span>Paquetes por asesor</span>
    </a>
    <!--<div id="collapsePages" class="collapse show" aria-labelledby="headingPages"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="login.html">Login</a>
            <a class="collapse-item" href="register.html">Register</a>
            <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item active" href="blank.html">Blank Page</a>
        </div>
    </div>-->
</li>
<hr class="sidebar-divider">
<div class="sidebar-heading">
    Reportes
</div>
<!-- Nav Item - Charts -->
<li class="nav-item">
    <a class="nav-link" href="{{url('reportes-empresa')}}">
        <i class="fas fa-fw fa-file-pdf"></i>
        <span>Por Empresa</span></a>
</li>

<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="{{url('reportes-colaborador')}}">
        <i class="fas fa-fw fa-file-pdf"></i>
        <span>Por Colaborador</span></a>
</li>
