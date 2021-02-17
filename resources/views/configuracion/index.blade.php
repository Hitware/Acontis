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
        <div class="row">
            <div class="col-md-6">
                @include('configuracion.tipodocumentos')
            </div>
            <div class="col-md-6">Sedes</div>
            <div class="col-md-6">Cargos</div>
            <div class="col-md-6">Servicios</div>
            <div class="col-md-6">Tipo Clientes</div>
        </div>
    </div>
</div>
@endsection