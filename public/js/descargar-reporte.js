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