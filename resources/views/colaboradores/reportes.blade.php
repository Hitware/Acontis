@extends('layouts.home')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Reportes por asesor</h1>
@if (session('message'))
<div class="alert alert-warning" role="alert">
    {{session('message')}}
</div>  
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6>Tabla de Colaboradores</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nombres</th>
                        <th>Correo</th>
                        <th>Cargo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($colaboradores)>0)
                        @foreach ($colaboradores as $colaborador)
                            <tr>
                                <th>{{$colaborador->name}}</th>
                                <th>{{$colaborador->email}}</th>
                                <th>{{$colaborador->cargo}}</th>

                                <th>
                                    <center>
                                    <a onclick="mostrarReporte({{$colaborador->id_contador}})" class="btn btn-acontis btn-circle btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    </center>
                                 </th>
                            </tr>
                            <div id="reportesEmpresa" class="modal fade">
                                <div class="modal-dialog  modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body" id="reportEmpresa">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item">
                                                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#visitas" role="tab" aria-controls="visitas" aria-selected="true">Visitas</a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#actividades" role="tab" aria-controls="actividades" aria-selected="false">Actividades</a>
                                                </li>
                                                
                                            </ul>
                                            <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="visitas" role="tabpanel" aria-labelledby="home-tab">
                                                <br>
                                                <div class="container" id="visitaslist">

                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="actividades" role="tabpanel" aria-labelledby="profile-tab">
                                                <br>
                                                <div id="actividadeslist" class="container">

                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        @endforeach
                        
                    @else
                        <div class="alert alert-warning" role="alert">
                            Hasta el momento no hay Registros en el sistema
                        </div>
                    @endif
                </tbody>
            </table>
           
        </div>
    </div>
</div>  
<form action="reportes-colaborador" method="post" id="form">
    @csrf
    <input type="hidden" name="idcolaborador" id="idcolaborador">
</form>
<script>
    function mostrarReporte(idcolaborador){
        $("#idcolaborador").val(idcolaborador);
        $.ajax({
            url:'reportes-colaborador',
            method:'POST',
            data:$("#form").serialize()
        }).done(function(res){
            var arreglo=JSON.parse(res);
            console.log(res);
            var url="generar-pdf";
            var visita='<table id="dataTable1" class="table table-striped">';
                visita+='<thead>'
                        +'<tr>'
                        +'<th>Fecha</th>'
                        +'<th>Hora</th>'
                        +'<th>Empresa</th>'
                        +'<th></th>'
                    +'</tr>'
                +'</thead>'
                +'</thead>'
                +'</tbody>';
            var actividades= '<table id="dataTable2" class="table table-striped">';
                actividades+='<thead>'
                        +'<tr>'
                        +'<th>Fecha</th>'
                        +'<th>Hora</th>'
                        +'<th>Empresa</th>'
                        +'<th></th>'
                    +'</tr>'
                +'</thead>'
                +'</thead>'
                +'</tbody>';    
                for(var x=0;x<arreglo.length;x++){
                    if(arreglo[x].tipo_reporte="Visita"){
                        visita+='<tr><td>'+arreglo[x].fecha+'</td>';
                        visita+='<td>'+arreglo[x].hora+'</td>';
                        visita+='<td>'+arreglo[x].name_company+'</td>';
                        visita+='<td><a onclick="generarPdf('+arreglo[x].id_reporte+')" class="btn btn-acontis btn-circle btn-sm"><i class="fas fa-file-pdf"></i></a>';
                        visita+='<button type="button"  class="btn btn-acontis btn-circle btn-sm"><i class="fas fa-share-square"></i></button></td></tr>';               
                    }
                    else{
                        actividades+='<tr><td>'+arreglo[x].fecha+'</td>';
                        actividades+='<td>'+arreglo[x].hora+'</td>';
                        actividades+='<td>'+arreglo[x].name_company+'</td>';
                        actividades+='<td><a onclick="generarPdf('+arreglo[x].id_reporte+')" class="btn btn-acontis btn-circle btn-sm"><i class="fas fa-file-pdf"></i></a>';
                        actividades+='<button type="button"  class="btn btn-acontis btn-circle btn-sm"><i class="fas fa-share-square"></i></button></td></tr>';               
                    }
                }
                visita+='</tbody>'
                +'</table>';
                actividades+='</tbody>'
                +'</table>';
                $("#visitaslist").html(visita);
                $("#actividadeslist").html(actividades);
                $('#dataTable1,#dataTable2').DataTable({
                        "language":{
                        "processing": "Procesando...",
                        "lengthMenu": "Mostrar _MENU_ registros",
                        "zeroRecords": "No se encontraron resultados",
                        "emptyTable": "Ningún dato disponible en esta tabla",
                        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "search": "Buscar:",
                        "infoThousands": ",",
                        "loadingRecords": "Cargando...",
                        "paginate": {
                            "first": "Primero",
                            "last": "Último",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        },
                        
                        "decimal": ",",
                        
                        "select": {
                            "1": "%d fila seleccionada",
                            "_": "%d filas seleccionadas",
                            "cells": {
                                "1": "1 celda seleccionada",
                                "_": "$d celdas seleccionadas"
                            },
                            "columns": {
                                "1": "1 columna seleccionada",
                                "_": "%d columnas seleccionadas"
                            }
                        },
                        "thousands": "."
                    }  
                    }
                    );
                $("#reportesEmpresa").modal("show");
        })
    }
</script>  
<script>
    function generarPdf(id_reporte){
        var data = id_reporte;
        $.ajax({
        type: 'GET',
        url: 'generar-pdf/'+id_reporte,
        data: data,
        xhrFields: {
            responseType: 'blob'
        },
        success: function(response){
        var blob = new Blob([response]);
        var link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        link.download = "reporte.pdf";
        link.click();
        },
        error: function(blob){
            console.log(blob);
        }
        });
    }
</script>  
@endsection