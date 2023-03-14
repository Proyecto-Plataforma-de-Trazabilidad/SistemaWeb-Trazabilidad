$('#frmOrden').submit(function(e) {
    //detener la carga de la pagina
    e.preventDefault();
  
    let formData = new FormData(this);
    //tomar los valores del formulario
    let accion = 'registrarOrden';
    let acceso = false;

    let nomDis = document.getElementById('nomDistri')
    let idDis = nomDis.getAttribute('data-id-distribuidor');
    let idProd = document.getElementById('nomProdu').value;
    let NumFac = document.getElementById('factOrden').value;
    let factura = "";
    let numRec = document.getElementById('cedReceta').value;
    let receta = "";
    let fecha = document.getElementById('fecha').value;

    //validar campos del formulario de orden

    let datos = {
        accion: accion,
        idDis: idDis,
        idProd: idProd,
        NumFac: NumFac,
        factura: factura,
        numRec: numRec,
        receta: receta,
        fecha: fecha,
    };
    //console.log(datos);

    //tomar los valores de la tabla detalle
    let arreglo = new Array();
    let tabla = document.querySelector('#detalle'); //buscamos la tabla
    let filas = tabla.querySelectorAll('tr'); // seleccionamos todas los renglones
    let orden = document.getElementById('numOrden');
    const numOrden = orden.dataset.numOrden;

    //ciclo
    for (var i = 1; i < filas.length; i++) {
        //ejecutara todo el numero de filas
        var celdas = filas[i].getElementsByTagName('td'); //solo tomara las que son de td
        var fila = {
            idOrden: numOrden,
            consecutivo: celdas[0].innerHTML,
            idquimico: celdas[1].dataset.tableIdquimico,
            tipoEnvase: celdas[2].innerHTML,
            color: celdas[3].innerHTML,
            piezas: celdas[4].innerHTML,
        };
        arreglo.push(fila);
    }
    //console.log(arreglo);

    let resArchivo = "";
    
    //mandar archivo con ajax
    $.ajax({
        url:'OrdenesArchivos/insertarArchivo.php',
        type:'POST',
        data:formData,
        contentType: false,
        cache: false,
        processData:false,
        success:function(response){
            resArchivo = JSON.parse(response);
            console.log(resArchivo);
            if (resArchivo.guardadoArchFac == "Correcto") 
                datos.factura = resArchivo.rutaArchFac;
            if (resArchivo.guardadoArchRece == "Correcto")
                datos.receta = resArchivo.rutaArchRece;
            
            // if(resArchivo.rutaArchFac == "Faltante")
            //     mensajeAdvertencia('No ingreso archivo de factura', 'Pero puede continuar de igual manera');
            // if(resArchivo.rutaArchRece == "Faltante")
            //     mensajeAdvertencia('No ingreso archivo de receta', 'Pero puede continuar de igual manera');
            
            //!Errores de extencion
            if(resArchivo.extCorrectaArchFac == "No permitida")
                mensajeError('Extencion incorrecta', 'De archivo factura', '#archFac');
            else if(resArchivo.extCorrectaArchRece == "No permitida")
                mensajeError('Extencion incorrecta', 'De archivo receta', '#archReceta');
            else if(resArchivo.guardadoArchFac == "Fallido") //!Errores de guardado
                mensajeError('Error al guardar', 'El archivo factura no se pudo guardar, intentelo de nuevo', '#archFac');
            else if(resArchivo.guardadoArchRece == "Fallido")
                mensajeError('Error al guardar', 'El archivo receta no se pudo guardar, intentelo de nuevo', '#archReceta');
            else
            insertarOrden();
            
        }
    });
    //resArchivo.guardadoArchFac != "Fallido" && resArchivo.guardadoArchRece != "Fallido" && resArchivo.extCorrectaArchFac != "No permitida" && resArchivo.extCorrectaArchRece != "No permitida"
    
    function insertarOrden() {
        //mandar orden y detalle con ajax
        $.ajax({
            url: 'OrdenesArchivos/insertar.php',
            data: { orden: datos, detalle: arreglo },
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
        timer: 1500
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
