$( "#generarPDF" ).on( "click", function() {
    let entrega = document.getElementById('numEntrega');
    let IdEntrega = entrega.dataset.numEntrega;
    let tipo = document.getElementById("tipoRecol");
    let tipoRecolect = tipo.dataset.tipoRecolector
    let nombre = document.getElementById('nomRecol');
    let nomRecole = nombre.dataset.nombreRecolect;
    //let nomProd = $( "#nomProdu option:selected" ).text();
    let idProd = document.getElementById('nomProdu').value;
    let nomResEntrega = $('#nomResEntrega').val();
    let nomResRecibe = $('#nomResRecep').val();
    let fecha = $('#fecha').val();
    
    let datos = {
        idEntrega: IdEntrega,
        tipoRecol: tipoRecolect,
        nomRecol: nomRecole,
        idProduc: idProd,
        nomResEntrega: nomResEntrega,
        nomResRecibe: nomResRecibe,
        fecha: fecha,
    };
    //console.log(datos);

    let arreglo = new Array();
    let tabla = document.querySelector('#detalle'); //buscamos la tabla
    let filas = tabla.querySelectorAll('tr'); // seleccionamos todas los renglones

    if (filas[1] == undefined) {
        mensajeAdvertencia("Fallo al registrar", "Debe añadir un registro al detalle");
    }else{
        //ciclo que recorre las filas del detalle
        for (var i = 1; i < filas.length; i++) {
            //ejecutara todo el numero de filas
            var celdas = filas[i].getElementsByTagName('td'); //solo tomara las que son de td       
            var fila = {
                idEntrega: IdEntrega,
                consecutivo: celdas[0].innerHTML,
                tipoEnvase: celdas[1].innerHTML,
                cantidad: celdas[2].innerHTML,
                peso: celdas[3].innerHTML,
                observa: celdas[4].innerHTML,
            };
            arreglo.push(fila);
        }
    }
    //console.log(arreglo);

    $.ajax({
        url: 'EntregasArchivos/designPdf.php',
        data: { entrega: datos, detalle: arreglo },
        type: 'POST',
        xhrFields: { responseType: 'blob' },
        success: function (response) {     
            //console.log(response);
            var blob = new Blob([response], {type : 'application/pdf'});     
            var file = new File([blob], "archivo.pdf");
            var link=document.createElement('a');
            link.href=URL.createObjectURL(file);
            link.download = file.name;
            link.click();
            // if (response == 'correcto') {
            //     Swal.fire({
            //         icon: 'success',
            //         title: 'Orden Correcta',
            //         text: 'Orden Registrada',
            //         showConfirmButton: true,
            //         confirmButtonText: 'Ok',
            //         confirmButtonColor: '#285430',
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             limpiar();
            //         }
            //     });
            // } else {
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Orden Incorrecta',
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             limpiar();
            //         }
            //     });
            // }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            Swal.fire({
                icon: 'error',
                title: 'No se pudo registrar por error',
                text: thrownError,
            });
        }
    });
});

    function mensajeAdvertencia(titulo, texto) {
        Swal.fire({
            icon: 'warning',
            title: titulo,
            text: texto,
            showConfirmButton: false,
            timer: 1800
        });
    }