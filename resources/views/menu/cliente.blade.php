<li class="nav-item">
    <a class="nav-link" href="{{url('home')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Inicio</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Gestion de Datos    
</div>
<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="{{url('perfil-empresa/'.Auth::user()->companie_id)}}">
        <i class="fas fa-fw fa-building"></i>
        <span>Mi Empresa</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="{{url('solicitudes')}}">
        <i class="fas fa-fw fa-file-signature"></i>
        <span>Certificaciones</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="{{url('reportes')}}">
        <i class="fas fa-fw fa-file-pdf"></i>
        <span>Reportes</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="{{url('mi-informacion-contable')}}">
        <i class="fas fa-file-invoice-dollar"></i>
        <span>
            @php
                $id_empresa=auth()->user()->companie_id;
                $empresa=\App\Models\Empresa::where('id_company','=',$id_empresa)->get();
                if($empresa[0]->servicio=="Revisoria fiscal"){
                    echo "Mis dictamenes / Informes" ;
                }
                else {
                    echo "Mi backup contable";
                }
            @endphp
          
        </span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="{{route('get.generar.pdf.empresa', [ 'id' => Auth::user()->companie_id ])}}">
        
        @php
        $id_empresa=auth()->user()->companie_id;
        $empresa=\App\Models\Empresa::where('id_company','=',$id_empresa)->get();
        if($empresa[0]->servicio!="Revisoria Fiscal"){
            echo '<i class="fas fa-fw fa-calculator"></i><span>Información Contable</span>' ;
        }
    @endphp
    </a>
</li>

<!-- Heading -->


