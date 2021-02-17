function mostrarReporte(idempresa){
    $("#idempresa").val(idempresa);
    $.ajax({
        url:'mostrar-reportes',
        method:'POST',
        data:$("#form").serialize()
    }).done(function(res){
        var arreglo=JSON.parse(res);
        var url="generar-pdf";
        var visita='<table id="dataTable1" class="table table-striped">';
            visita+='<thead>'
                    +'<tr>'
                    +'<th>Fecha</th>'
                    +'<th>Hora</th>'
                    +'<th>Nombre Asesor</th>'
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
                    +'<th>Nombre Asesor</th>'
                    +'<th></th>'
                +'</tr>'
            +'</thead>'
            +'</thead>'
            +'</tbody>';    
            for(var x=0;x<arreglo.length;x++){
                if(arreglo[x].tipo_reporte=="Visita"){
                    visita+='<tr><td>'+arreglo[x].fecha+'</td>';
                    visita+='<td>'+arreglo[x].hora+'</td>';
                    visita+='<td>'+arreglo[x].name+'</td>';
                    visita+='<td><a onclick="generarPdf('+arreglo[x].id_reporte+')" class="btn btn-acontis btn-circle btn-sm"><i class="fas fa-file-pdf"></i></a>';
                    visita+='<button type="button"  class="btn btn-acontis btn-circle btn-sm"><i class="fas fa-share-square"></i></button></td></tr>';               
                }
                else{
                    actividades+='<tr><td>'+arreglo[x].fecha+'</td>';
                    actividades+='<td>'+arreglo[x].hora+'</td>';
                    actividades+='<td>'+arreglo[x].name+'</td>';
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