$('#frmEntrega').submit(function (e) {

    e.preventDefault();  //detener la recarga de la pagina

    let formData = new FormData(this); //Obtiene los archivos del formulario
    console.log(formData);

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

    if (idProd == "Selecciona un productor registrado") {
        mensajeAdvertencia("Fallo al generar el PDF", "Debe añadir seleccionar un Productor");
    } else {
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

        formData.append("IdEntrega", IdEntrega); //Se agrega el id de la entrega para mandarlo junto con los archivos
        formData.append("idProduc", idProd);
        //formData.append("fecha", fecha);

        let arreglo = new Array();
        let tabla = document.querySelector('#detalle'); //buscamos la tabla
        let filas = tabla.querySelectorAll('tr'); // seleccionamos todas los renglones

        // if (filas[1] == undefined) {
        //     mensajeAdvertencia("Fallo al generar el PDF", "Debe añadir un registro al detalle");
        // } else {
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
        //console.log(arreglo);

        crearPDF(datos, arreglo, formData);
        //insertarArchivo(formData);
        //}
    }

});

function insertarArchivo(formData) {
    $.ajax({
        url: 'EntregasArchivos/Peticiones/insertarArchivo.php',
        type: 'POST',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            // resArchivo = JSON.parse(response);

            // let urlArchivo = "http://localhost/Nuevo-SistemaWeb-Trazabilidad/EntregasArchivos/verPDF.php?archivo=" + resArchivo.nombreArchivo;
            // console.log(urlArchivo);
            // window.location.href = urlArchivo;

            // datos.recibo = resArchivo.rutaRecibo;
            // console.log(datos);
            // // //!Errores de extension
            // if (resArchivo.extCorrectaRecibo == "No permitida")
            //     mensajeError('Extensión incorrecta', 'Del recibo', '#archRecibo');
            // else if (resArchivo.guardadoRecibo == "Fallido") //!Errores de guardado
            //     mensajeError('Error al guardar', 'El recibo no se pudo guardar, intentelo de nuevo', '#archRecibo');
            // else {
            //     insertarEntrega(datos, arreglo);
            //     //     if (opcion == "registra") 

            //     //     else
            //     //         actualizarOrden(datos);
            // }

        }
    });
}

function crearPDF(datosValidos, arregloValido, formData) {
    $.ajax({
        url: 'EntregasArchivos/Peticiones/generarPDF.php',
        data: formData,
        type: 'POST',
        xhrFields: { responseType: 'blob' },
        contentType: false,
        processData: false,
        success: function (response) {
            console.log(response);
            let res = {};
            try {
                res = JSON.parse(response) ? JSON.parse(response) : { mensaje: "" };
            } catch (error) {

            }


            if (res.mensaje == 'PosteoOffline') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Registro offline',
                    text: 'El registro se realizara cuando vuelva la conexión',
                    showConfirmButton: true,
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#285430',
                }).then((result) => {
                    if (result.isConfirmed) {
                        //limpiar();
                    }
                });
            } else {
                $('#recibo').prop("disabled", false);
                //console.log(response);
                var blob = new Blob([response], { type: 'application/pdf' });
                var file = new File([blob], "archivo.pdf");
                console.log(file);

                formData.append("archRecibo", file); //Se agrega el objeto file(contiene el archivo que se genero) al formData 
                console.log(formData);
                insertarArchivo(formData); //Se llama a la funcion 
                // var link = document.createElement('a');
                // link.href = URL.createObjectURL(file);
                // link.download = file.name;
                // link.click();
            }


            //

            // var link = document.createElement('a');
            // link.href = URL.createObjectURL(file);
            // link.download = file.name;
            // link.click();
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
                title: 'No se pudo generar por error',
                text: thrownError,
            });
        }
    });
}

function mensajeAdvertencia(titulo, texto) {
    Swal.fire({
        icon: 'warning',
        title: titulo,
        text: texto,
        showConfirmButton: false,
        timer: 1800
    });
}