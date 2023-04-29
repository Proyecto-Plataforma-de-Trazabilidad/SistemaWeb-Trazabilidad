$('#frmEntrega').submit(function(e) {

    e.preventDefault();  //detener la recarga de la pagina

    let entrega = document.getElementById('numEntrega');
    let IdEntrega = entrega.dataset.numEntrega;
    let tipoRecolect = document.getElementById("tipoRecol").value;
    let nomRecole = document.getElementById('nomRecol').value;
    let idProd = document.getElementById('nomProdu').value;
    let nomResEntrega = document.getElementById('nomResEntrega').value;
    let nomResRecibe = document.getElementById('nomResRecep').value;
    let fecha = document.getElementById('fecha').value;

    let datos = {
        idEntrega: IdEntrega,
        tipoRecol: tipoRecolect,
        nomRecol: nomRecole,
        idProduc: idProd,
        nomResEntrega: nomResEntrega,
        nomResRecibe: nomResRecibe,
        recibo: "",
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
    console.log(arreglo);
    insertarEntrega(datos, arreglo)

    function insertarEntrega(datosValidos, arregloValido) {
        //mandar entrega y detalle con ajax
        $.ajax({
            url: 'EntregasArchivos/insertarEntrega.php',
            data: { entrega: datosValidos, detalle: arregloValido },
            type: 'POST',
            success: function (response) {            
                if (response == 'correcto') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Orden Correcta',
                        text: 'Orden Registrada',
                        showConfirmButton: true,
                        confirmButtonText: 'Ok',
                        confirmButtonColor: '#285430',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            limpiar();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Orden Incorrecta',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            limpiar();
                        }
                    });
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                Swal.fire({
                    icon: 'error',
                    title: 'No se pudo registrar por error',
                    text: thrownError,
                });
            }, 
        });
        
    } 
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

function mensajeError(titulo, texto, elemen) {
    Swal.fire({
        icon: 'error',
        title: titulo,
        text: texto,
    }).then((result) => {
        if (result.isConfirmed) {
            $(elemen).val('');
        }
    });
}

function limpiar() {
    location.reload();
}