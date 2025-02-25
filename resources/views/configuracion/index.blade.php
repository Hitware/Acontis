@extends('layouts.home')
@section('content')
@if (session('message'))
<div class="alert alert-warning" role="alert">
    {{session('message')}}
</div>  
@endif
<div class="card-shadow mb-4">
    <div class="card-header py-3">
        <h4>Configuración</h4>
    </div>
    <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link" id="home-tab" data-toggle="tab" href="#sedes" role="tab" aria-controls="home" aria-selected="true">Sedes</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#certificaciones" role="tab" aria-controls="profile" aria-selected="false">Documentos y Certificaciones</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="contact-tab" data-toggle="tab" href="#servicios" role="tab" aria-controls="contact" aria-selected="false">Servicios</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="contact-tab" data-toggle="tab" href="#clasificacion" role="tab" aria-controls="contact" aria-selected="false">Tipo de Cliente</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="contact-tab" data-toggle="tab" href="#tipoclientes" role="tab" aria-controls="contact" aria-selected="false">Clasificación</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#alertas" role="tab" aria-controls="contact" aria-selected="false">Tipo de Documentos</a>
                </li>
                
                <li class="nav-item">
                  <a class="nav-link" id="contact-tab" data-toggle="tab" href="#cargos" role="tab" aria-controls="contact" aria-selected="false">Cargos</a>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="cargos" role="tabpanel" aria-labelledby="profile-tab">
                  @include('configuracion.cargos')
               </div>
                <div class="tab-pane fade" id="sedes" role="tabpanel" aria-labelledby="home-tab">
                   @include('configuracion.sedes')
                </div>
                <div class="tab-pane fade" id="certificaciones" role="tabpanel" aria-labelledby="profile-tab">
                    <br>
                    @include('configuracion.documentos')
                </div>
                <div class="tab-pane fade" id="servicios" role="tabpanel" aria-labelledby="contact-tab">
                    <br>
                    @include('configuracion.servicios')
                </div>
                <div class="tab-pane fade" id="tipoclientes" role="tabpanel" aria-labelledby="contact-tab">
                    <br>
                    @include('configuracion.tipoclientes')
                </div>
                <div class="tab-pane fade" id="alertas" role="tabpanel" aria-labelledby="contact-tab">
                    <br>
                    @include('configuracion.tipodocumentos')
                </div>
                <div class="tab-pane fade" id="clasificacion" role="tabpanel" aria-labelledby="contact-tab">
                  <br>
                  @include('configuracion.clasificacion')
                </div>
              </div> 
    </div>
</div>
@endsection