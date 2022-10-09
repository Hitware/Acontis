@extends('layouts.home')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Lista de Asesores</h1>
@if (session('message'))
<div class="alert alert-warning" role="alert">
    {{session('message')}}
</div>  
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Cedula</th>
                        <th>Nombres</th>
                        <th>Correo</th>
                        <th>Telefono</th>
                        <th>Cargo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($colaboradores)>0)
                            @foreach ($colaboradores as $colaborador)
                                <tr>
                                    <th>{{$colaborador->cedula}}</th>
                                    <th>{{$colaborador->name}}</th>
                                    <th>{{$colaborador->email}}</th>
                                    <th>{{$colaborador->telefono}}</th>
                                    <th>{{$colaborador->cargo}}</th>
                                    
                                    <th>
                                        <center>
                                        <a class="btn btn-acontis btn-circle btn-sm" onclick="empresasAsignadas({{$colaborador->id_contador}});">
                                            <i class="fas fa-list"></i>
                                        </a>
                                        <a class="btn btn-acontis btn-circle btn-sm" onclick="empresas({{$colaborador->id_contador}});">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        </center>
                                     </th>
                                     <div class="modal fade" id="ModalAsignadas" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Empresas Asignadas</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" id="asignadas">
                                                    
                                                </div>
                                                <div class="modal-footer"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="ModalEmpresas" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                        
                                                </div>
                                                <div class="modal-footer">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </tr>
                                
                            @endforeach
                            
                        @else
                            <div class="alert alert-warning" role="alert">
                                Hasta el momento no hay Registros en el sistema
                            </div>
                        @endif
                </tbody>
            </table>
            <div class="modal fade" id="ModalAux" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" >
                            <h5>Esta empresa ya cuenta con un asesor asignador<br>
                                ¿Deseas asignarlo como asesor primario o segundo asesor?
                            </h5>
                        </div>
                        <div class="modal-footer" id="asignar-dos">

                        </div>
                    </div>
                </div>
            </div>
            

        </div>
    </div>
</div>
<form action="empresas-total" method="post" id="form">
    @csrf
    <input type="hidden" name="idasesor" id="idasesor">
</form>
<form action="empresas-asignadas" method="post" id="form-asignadas">
    @csrf
    <input type="hidden" name="asesorid" id="asesorid">
    <input type="hidden" name="idempresa" id="idempresa">
</form>
<script>
    function empresasAsignadas(idasesor){
        $("#idasesor").val(idasesor);
        $.ajax({
            url:'empresas-asignadas',
            method:'POST',
            data:$("#form").serialize()
        }).done(function(res){
            var arreglo=JSON.parse(res);
            console.log(arreglo);
            var tabla='<table id="dataTable" class="table table-striped">';
                tabla+='<thead>'
                        +'<tr>'
                        +'<th>Nombre</th>'
                        +'<th>Correo</th>'
                        +'<th></th>'
                    +'</tr>'
                +'</thead>'
                +'</thead>'
                +'</tbody>';
                for(var x=0;x<arreglo.length;x++){
                    tabla+='<tr><td>'+arreglo[x].name_company+'</td>';
                    tabla+='<td>'+arreglo[x].email_company+'</td>';
                    tabla+='<td><button class="btn btn-acontis btn-circle btn-sm" onclick="desasignar('+idasesor+','+arreglo[x].id_company+')"><i class="fas fa-minus"></button></td>';
                }
                tabla+='</tbody>'
                +'</table>';
                $("#asignadas").html(tabla);
                $('#dataTable').DataTable({
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
                
            $("#ModalAsignadas").modal("show");
        }); 
    }
</script>

<script>
    function empresas(colaborador){
        
        $.ajax({
            url:'empresas-total',
            method:'POST',
            data:$("#form").serialize()
        }).done(function(res){
            var arreglo=JSON.parse(res);
            var tabla='<table id="dataTable" class="table table-striped">';
                tabla+='<thead>'
                        +'<tr>'
                        +'<th>Nombre</th>'
                        +'<th>Nit</th>'
                        +'<th></th>'
                    +'</tr>'
                +'</thead>'
                +'</thead>'
                +'</tbody>';
                for(var x=0;x<arreglo.length;x++){
                    tabla+='<tr><td>'+arreglo[x].name_company+'</td>';
                    tabla+='<td>'+arreglo[x].nit_company+'</td>';
                    tabla+='<td><a class="btn btn-acontis btn-circle btn-sm" onclick="asignar('+colaborador+','+arreglo[x].id_company+');">';
                    tabla+='<i class="fas fa-plus"></i>';
                    tabla+='</a></td>';
                }
                tabla+='</tbody>'
                +'</table>';
                $("#asignadas").html(tabla);
                $('#dataTable').DataTable();
            $("#ModalAsignadas").modal("show");
        }); 
    }
</script>
<script>
    function asignar(colaborador,empresa){
        $("#asesorid").val(colaborador);
        $("#idempresa").val(empresa);
        $.ajax({
            url:'asignar-empresa',
            method:'POST',
            data:$("#form-asignadas").serialize()
        }).done(function(res){
            if(res=="R"){
                var botones="<button class='btn btn-acontis' onclick='primario("+colaborador+","+empresa+");'>Primario</button>";
                botones+="<button class='btn btn-acontis' onclick='secundario("+colaborador+","+empresa+");'>Segundario</button>";
                $("#asignar-dos").html(botones);
                $("#ModalAux").modal("show");
            }
            else{
               alert("Asignacion exitosa"); 
            }
        })
    }
    function primario(colaborador,empresa){
        $("#asesorid").val(colaborador);
        $("#idempresa").val(empresa);
        $.ajax({
            url:'asignar-empresa-uno',
            method:'POST',
            data:$("#form-asignadas").serialize()
        }).done(function(res){
            alert(res);
            $("#ModalAux").modal("hide");

        })
    }
    function secundario(colaborador,empresa){
        $("#asesorid").val(colaborador);
        $("#idempresa").val(empresa);
        $.ajax({
            url:'asignar-empresa-dos',
            method:'POST',
            data:$("#form-asignadas").serialize()
        }).done(function(res){
            alert(res);
            $("#ModalAux").modal("hide");
        })
    }
    function desasignar(colaborador,empresa){
        $("#idempresa").val(empresa);
        $("#asesorid").val(colaborador);
        $.ajax({
            url:'desasignar',
            method:'POST',
            data:$("#form-asignadas").serialize()
        }).done(function(res){
            alert(res);
        })
    }
</script>
@endsection