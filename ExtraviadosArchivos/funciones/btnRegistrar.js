$('#frmExtraviados').submit(function (e) {

    e.preventDefault();  //detener la recarga de la pagina

    let formData = new FormData(this); //Obtiene los archivos del formulario

    //tomar los valores del formulario
    let accion = 'registrarExtraviados';

    let Productor = document.getElementById('productor')
    let idProd = Productor.dataset.idProduc;
    let tipoEnv = document.getElementById('tipoEnva').value;
    let piezas = document.getElementById('numPiezas').value;
    let aclaracion = document.getElementById('aclaracion').value;
    let fecha = document.getElementById('fecha').value;


    formData.append("accion", accion);
    formData.append("idProd", idProd);

    //validar campos del formulario de orden
    // let datos = {
    //     accion: accion,
    //     idProd: idProd,
    //     tipoEnv: tipoEnv,
    //     piezas: piezas,
    //     aclaracion: aclaracion,
    //     fecha: fecha,
    // };
    console.log(formData);

    //realizar ejecucion 
    insertarExtraviados(formData);

    function insertarExtraviados(formData) {
        //mandar datos del formulario con ajax
        $.ajax({
            url: 'ExtraviadosArchivos/peticiones/insertarExtraviado.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                res = JSON.parse(response);
                if (res.mensaje == 'Correcto') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro exitoso',
                        text: 'El registro se ha guardado correctamente',
                        showConfirmButton: true,
                        confirmButtonText: 'Ok',
                        confirmButtonColor: '#285430',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            limpiar();
                        }
                    });
                } else if (res.mensaje == 'PosteoOffline') {
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
                    Swal.fire({
                        icon: 'error',
                        title: 'Registro incorrecto',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            //limpiar();
                        }
                    });
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                Swal.fire({
                    icon: 'error',
                    title: 'No se pudo registrar por algún error',
                    text: thrownError,
                });
            },
        });
    }

});

function limpiar() {
    location.reload();
}
