@extends('layouts.home')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Lista de Empresas</h1>
@if (session('message'))
<div class="alert alert-warning" role="alert">
    {{session('message')}}
</div>  
@endif
<div id="container">
    <div id="right">
        <button data-toggle="modal" data-target="#ModalAgregar" class="btn btn-acontis btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Agregar</span>
        </button>
        <a href="{{route('excel-empresas')}}" class="btn btn-acontis btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-file-excel"></i>
            </span>
            <span class="text">Excel</span>
        </a>
    </div>
</div>
<br>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6>Lista de Empresas</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Asesor</th>
                        <th>Nit</th>
                        <th>Correo</th>
                        <th>Servicio</th>
                        <th>Telefono</th>
                        <th>Rep. Legal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($empresas)>0)
                        @foreach ($empresas as $empresa)
                        @if ($empresa->propietario=="ACONTIS")
                        <tr>
                        @else
                        <tr style="background-color: #82e0aa ">
                        @endif
                            
                                <th>{{Str::limit($empresa->name_company, 40)}}</th>
                                <th>
                                @if ($empresa->name!=null)
                                    {{$empresa->name}}
                                @else
                                    Sin Asignar
                                @endif
                                </th>
                                <th>{{$empresa->nit_company}}</th>
                                <th>{{$empresa->email_company}}</th>
                                <th>{{$empresa->servicio}}</th>

                                <th>{{$empresa->telephone_company}}</th>
                                <th>{{Str::limit($empresa->representante_legal, 30)}}</th>
                                <th>
                                    <a href="{{url('perfil-empresa/'.$empresa->id_company)}}" class="btn btn-acontis btn-circle btn-sm">
                                        <i class="fas fa-arrow-alt-circle-right"></i>
                                    </a>
                                    <a data-toggle="modal"
                                     data-target="#modalQR{{$empresa->id_company}}" class="btn btn-acontis btn-circle btn-sm">
                                        <i class="fas fa-qrcode"></i>
                                    </a>
                                    <a onclick="mostrarUsuarios({{$empresa->id_company}});" class="btn btn-acontis btn-circle btn-sm">
                                        <i class="fas fa-users"></i>
                                    </a>
                                    <!--<a data-toggle="modal" data-target="#modalEnviar{{$empresa->id_company}}" class="btn btn-acontis btn-circle btn-sm">
                                        <i class="fas fa-share-square"></i>
                                    </a>-->
                                    <a data-toggle="modal" data-target="#ModalEditar{{$empresa->id_company}}" class="btn btn-acontis btn-circle btn-sm">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    @if ($empresa->sede!="retiradas")
                                        <a data-toggle="modal" data-target="#modalEliminar{{$empresa->id_company}}" class="btn btn-acontis btn-circle btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    @endif
                                    @if ($empresa->sede=="retiradas")
                                        <a data-toggle="modal" data-target="#modalVerRetiro{{$empresa->id_company}}" class="btn btn-acontis btn-circle btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endif
                                </th>
                               
                            </tr>
                            <div id="modalQR{{$empresa->id_company}}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <center>
                                                <div class="title m-b-md">
                                                    {!!QrCode::size(300)->generate("$empresa->id_company") !!}
                                                 </div>
                                            </center>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="modalUsuarios" class="modal fade bd-example-modal-lg">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container" id="usuariosList">

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="modalEnviar{{$empresa->id_company}}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            Para confirmar el envio del QR a la empresa {{$empresa->name_company}} porfavor da clic en Enviar
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-acontis">Cerrar</button>
                                            <a type="button" href="{{url('enviar-qr/'.$empresa->id_company)}}" class="btn btn-acontis">Enviar</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="modalEliminar{{$empresa->id_company}}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{url('eliminar-empresa/'.$empresa->id_company)}}" method="post">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Estas seguro de retirar {{$empresa->name_company}} del sistema?
                                            <br>
                                            <br>
                                         <textarea name="retiro" id="retiro" cols="30" rows="3" class="form-control"></textarea>   
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger">Cancelar</button>
                                            <button type="submit" class="btn btn-acontis">Retirar</a>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div id="modalVerRetiro{{$empresa->id_company}}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <h3>Motivo de Retiro de empresa</h3>
                                            <br>
                                            <b>{{$empresa->motivo}}</b>
                                         </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div id="ModalEditar{{$empresa->id_company}}" class="modal fade">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5>Editar Empresa</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{url('/actualizar-empresa',['id'=>$empresa->id_company])}}" method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group col">
                                                            <label for="">Nombre de la empresa</label>
                                                            <input type="text" id="nombre-empresa" name="nombre-empresa" value="{{$empresa->name_company}}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group col">
                                                            <label for="">Representante legal</label>
                                                            <input type="text" id="representante-legal" value="{{$empresa->representante_legal}}" name="representante-legal" class="form-control">
                                                        </div>
                                                    </div>  
                                                    <div class="col-md-4">
                                                        <div class="form-group col">
                                                            <label for="">Nit</label>
                                                            <input type="text" id="nit" value="{{$empresa->nit_company}}" name="nit" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group col">
                                                            <label for="">Fecha de Contrato</label>
                                                            <input type="date" id="fecha_contrato" value="{{$empresa->fecha_contrato}}" name="fecha_contrato" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group col">
                                                            <label for="">Correo principal</label>
                                                            <input type="text" id="correo" name="correo" value="{{$empresa->email_company}}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group col">
                                                            <label for="">Telefono</label>
                                                            <input type="text" id="telefono" value="{{$empresa->telephone_company}}" name="telefono" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="">Sede</label>
                                                        <select name="sede" id="sede" class="form-control" required>
                                                            <option value="{{$empresa->sede}}" selected >{{$empresa->sede}}</option>
                                                            @include('empresas.sedes')
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group col">
                                                            <label for="">Tipo de Cliente</label>
                                                            <select name="clasificacion" id="clasificacion" class="form-control">
                                                                <option value="{{$empresa->clasificacion}}" selected>{{$empresa->clasificacion}}</option>
                                                                @include('empresas.clasificacion')
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group col">
                                                            <label for="">Clasificación</label>
                                                            <select name="tipo-cliente" id="tipo-cliente" class="form-control">
                                                                <option value="{{$empresa->tipo_cliente}}" selected>{{$empresa->tipo_cliente}}</option>
                                                                @include('empresas.tipoclientes')
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-4">
                                                        <div class="form-group col">
                                                            <label for="">Servicio</label>
                                                            <select name="servicio" id="servicio" class="form-control">
                                                                <option value="{{$empresa->servicio}}" selected>{{$empresa->servicio}}</option>
                                                                @include('empresas.servicios')
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-4">
                                                        <div class="form-group col">
                                                            <label for="">Servidor de BD</label>
                                                            <select name="basedatos" id="basedatos" class="form-control">
                                                                <option value="{{$empresa->propietario}}" selected >{{$empresa->propietario}}</option>
                                                                <option value="GUIDO">GUIDO</option>
                                                                <option value="ACONTIS">ACONTIS</option>
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group col">
                                                            <label for="">Dirección</label>
                                                            <input type="text" id="direccion" name="direccion" value="{{$empresa->address_company}}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group col">
                                                            <label for="">Base de Datos</label>
                                                            <input type="text" id="dbword" name="dbword" value="{{$empresa->name_bd_adm}}" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                
                                                <button type="submit" class="btn btn-acontis">Actualizar</button>
                                                <button type="button" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
                                            </form>
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
            <div id="ModalAgregar" class="modal fade">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Agregar Empresa</h5>
                        </div>
                        <div class="modal-body">
                            <form action="{{url('agregar-empresa')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group col">
                                            <label for="">Nombre de la empresa</label>
                                            <input type="text" id="nombre-empresa" name="nombre-empresa" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group col">
                                            <label for="">Representante legal</label>
                                            <input type="text" id="representante-legal" name="representante-legal" class="form-control" required>
                                        </div>
                                    </div>  
                                    <div class="col-md-4">
                                        <div class="form-group col">
                                            <label for="">Nit</label>
                                            <input type="text" id="nit" name="nit" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group col">
                                            <label for="">Correo principal</label>
                                            <input type="text" id="correo" name="correo" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group col">
                                            <label for="">Telefono</label>
                                            <input type="text" id="telefono" name="telefono" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group col">
                                            <label for="">Sede</label>
                                            <select name="sede" id="sede" class="form-control" required>
                                                <option value="" selected disabled>--SELECCIONE--</option>
                                                @include('empresas.sedes')
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group col">
                                            <label for="">Clasificación</label>
                                            <select name="tipo-cliente" id="tipo-cliente" class="form-control" required>
                                                <option value="" selected disabled>--SELECCIONE--</option>
                                                @include('empresas.tipoclientes')
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group col">
                                            <label for="">Tipo de Cliente</label>
                                            <select name="clasificacion" id="clasificacion" class="form-control" required>
                                                <option value="" selected disabled>--SELECCIONE--</option>
                                                @include('empresas.clasificacion')
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group col">
                                            <label for="">Servicio</label>
                                            <select name="servicio" id="servicio" class="form-control" required>
                                                <option value="" selected disabled>--SELECCIONE--</option>
                                                @include('empresas.servicios')
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group col">
                                            <label for="">Servidor de BD</label>
                                            <select name="basedatos" id="basedatos" class="form-control">
                                                <option value="" selected disabled>--SELECCIONE--</option>
                                                <option value="GUIDO">GUIDO</option>
                                                <option value="ACONTIS">ACONTIS</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group col">
                                            <label for="">Dirección</label>
                                            <input type="text" id="direccion" name="direccion" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                
                                <button type="submit" class="btn btn-acontis">Guardar</button>
                                <button type="button" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function mostrarUsuarios(id){
        var data = id;
        $.ajax({
        type: "GET",
        url: '/mostrar-usuarios/'+id,
        data: data,
        success: function(response){
            var arreglo=JSON.parse(response);
            var usuarios='<table id="dataTable1" class="table table-striped">';
                usuarios+='<thead>'
                        +'<tr>'
                        +'<th>Nombre</th>'
                        +'<th>Correo</th>'
                        
                    +'</tr>'
                +'</thead>'
                +'</thead>'
                +'</tbody>';
                for(var x=0;x<arreglo.length;x++){
                    usuarios+='<tr><td>'+arreglo[x].name+'</td>';
                    usuarios+='<td>'+arreglo[x].email+'</td></tr>';
                }
                usuarios+='</tbody>'
                +'</table>';
                $("#usuariosList").html(usuarios);
                $('#dataTable1').DataTable({
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
                $("#modalUsuarios").modal("show");
        }
        });
    }  
</script>
@endsection