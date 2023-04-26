$('#frmExtraviados').submit(function (e) {

    e.preventDefault();  //detener la recarga de la pagina

    //let formData = new FormData(this); //Obtiene los archivos del formulario

    //tomar los valores del formulario
    let accion = 'registrarExtraviados';

    let Productor = document.getElementById('productor')
    let idProd = Productor.dataset.idProduc;
    let tipoEnv = document.getElementById('tipoEnva').value;
    let piezas = document.getElementById('numPiezas').value;
    let aclaracion = document.getElementById('aclaracion').value;
    let fecha = document.getElementById('fecha').value;


    //validar campos del formulario de orden
    let datos = {
        accion: accion,
        idProd: idProd,
        tipoEnv: tipoEnv,
        piezas: piezas,
        aclaracion: aclaracion,
        fecha: fecha,
    };
    console.log(datos);

    //realizar ejecucion 
    insertarExtraviados(datos);

    function insertarExtraviados(datosValidos) {
        //mandar datos del formulario con ajax
        $.ajax({
            url: 'ExtraviadosArchivos/peticiones/insertar.php',
            data: { extraviados: datosValidos },
            type: 'POST',
            success: function (response) {
                if (response == 'correcto') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro Exitoso',
                        text: 'Registro se ha guardado correcctamente',
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
                        title: 'Registro Incorrecto',
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
                    title: 'No se pudo registrar por algun error',
                    text: thrownError,
                });
            },
        });
    }

});

function limpiar() {
    location.reload();
}
