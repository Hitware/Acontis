// Call the dataTables jQuery plugin
$(document).ready(function() {
    $('#dataTable').DataTable(
      {
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
  });
  