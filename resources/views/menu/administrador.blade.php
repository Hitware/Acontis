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
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false">
        <i class="fas fa-fw fa-user-tie"></i>
        <span>Colaboradores</span>
    </a>
    <div id="collapseOne" class="collapse" aria-labelledby="headingTwo"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{url('/colaboradores/activos')}}">Activos</a>
            <a class="collapse-item" href="{{url('/colaboradores/retirados')}}">Retirados</a>
            <a class="collapse-item" href="{{url('/certificados')}}">Certificados</a>
        </div>
    </div>    
    
</li>
<li class="nav-item">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" 
        aria-controls="collapseTwo">
        <i class="fas fa-fw fa-building"></i>
        <span>Empresas</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{url('empresas/general')}}">General</a>
            <a class="collapse-item" href="{{url('empresas/acontis')}}">Acontis</a>
            <a class="collapse-item" href="{{url('empresas/guido')}}">Guido</a>
           
            @foreach ($sedes as $sede)
                <a class="collapse-item" href="{{url('empresas/'.$sede->nombre_ciudad)}}">{{$sede->nombre_ciudad}}</a>
            @endforeach
            <a class="collapse-item" href="{{url('empresas/retiradas')}}">Retiradas</a>
           
        </div>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePro" 
        aria-controls="collapsePro">
        <i class="fas fa-fw fa-hands-helping"></i>
        <span>Proveedores</span>
    </a>
    <div id="collapsePro" class="collapse" aria-labelledby="headingTwo"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            
            <a class="collapse-item" href="{{url('proveedores/activos')}}">Activos</a>
            <a class="collapse-item" href="{{url('proveedores/retirados')}}">Retirados</a>
        </div>
    </div>
</li>
<!-- Nav Item - Utilities Collapse Menu -->

<li class="nav-item">
    <a class="nav-link collapsed" href="{{url('eventos')}}">
        <i class="fas fa-fw fa-calendar-check"></i>
        <span>Eventos</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePlaneacion" aria-expanded="false"
        aria-controls="collapsePlaneacion">
        <i class="fas fa-fw fa-calendar-day"></i>
        <span>Planeación</span>
    </a>
    <div id="collapsePlaneacion" class="collapse" aria-labelledby="headingTwo"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            @foreach ($sedes as $sede)
                <a class="collapse-item" href="{{url('planeacion/'.$sede->nombre_ciudad)}}">{{$sede->nombre_ciudad}}</a>
            @endforeach
            <a class="collapse-item" href="{{url('planeacion/general')}}">General</a>
        </div>
    </div>
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

<!-- Heading -->
<div class="sidebar-heading">
    Acontis Social
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link" href="{{url('/acontisitos')}}">
        <i class="fas fa-fw fa-child"></i>
        <span>Acontisitos</span>
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


<hr class="sidebar-divider">
<div class="sidebar-heading">
    Alertas
</div>
<li class="nav-item">
    <a class="nav-link" href="{{url('alertas')}}">
        <i class="fas fa-fw fa-bell"></i>
        <span>Notificaciones</span></a>
</li>

<!-- Heading -->
