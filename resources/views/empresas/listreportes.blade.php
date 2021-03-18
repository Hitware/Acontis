@extends('layouts.home')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Lista de Reportes</h1>
@if (session('message'))
<div class="alert alert-warning" role="alert">
    {{session('message')}}
</div>  
@endif
<div class="table-responsive">
    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Nombre Asesor</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if (count($reportes)>0)
                @foreach ($reportes as $reporte)
                    <tr>
                        <td>{{$reporte->fecha}}</td>
                        <td>{{$reporte->hora}}</td>
                        <td>{{$reporte->name}}</td>
                        <td><a onclick="generarPdf('{{$reporte->id_reporte}}')" class="btn btn-acontis btn-circle btn-sm"><i class="fas fa-file-pdf"></i></a></td>
                    </tr>
                @endforeach
            @else
            <div class="alert alert-warning" role="alert">
                Hasta el momento no hay Registros en el sistema
            </div> 
            @endif
        </tbody>
    </table>
</div>
<script src="{{URL::asset('js/descargar-reporte.js')}}"></script>
@endsection