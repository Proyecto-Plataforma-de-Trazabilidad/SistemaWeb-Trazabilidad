$(document).ready(function () {
    const nombreProdu = document.getElementById("nomProdu");
    añadirProductores(nombreProdu); //Funcion que carga la combo de productores

    mostrarEntrega("","","", "");  //Función que se encarga de llenar el datatable
});

//Función jQuery  que se ejecuta cuando das clic al botón
$('#aceptar').click(function () {
    let fechaIni = document.getElementById('fechaInicio').value;
    let fechaFin = document.getElementById('fechafin').value;
    let idProd = document.getElementById('nomProdu').value;
    let tipoRecol = document.getElementById('tipoRecol').value;

    if (idProd == "Selecciona un productor" && tipoRecol == "Selecciona un recolector") //Verifica si nos se selecciona ninguna combo
        mostrarEntrega(fechaIni, fechaFin, "", "");
    else if (idProd == "Selecciona un productor" && tipoRecol != "Selecciona un recolector") //Limpia si se selecciono solo tipo
        mostrarEntrega(fechaIni, fechaFin, "", tipoRecol)
    else if (tipoRecol == "Selecciona un recolector" && idProd != "Selecciona un productor") //Limpia si se selecciono solo productor
        mostrarEntrega(fechaIni, fechaFin, idProd, "");
    else
        mostrarEntrega(fechaIni, fechaFin, idProd, tipoRecol);
});


function mostrarEntrega(fechaI, fechaF, idProdud, tipoRecol) {
    $.ajax({
        type: 'POST',
        url:'../OrdenesArchivos/validacionesConsulta.php',
        data:{'FI': fechaI, 'FF': fechaF, 'IdProdu': idProdud, 'IdTipo': tipoRecol, 'movi': 'entregas'},
        success: function (res) {
            let datos = JSON.parse(res);//Trae los datos en formato json y los pasa a objeto
            let opc = datos.mensaje;
            console.log(opc);
            switch (opc) {
                case "FechaNoValida":
                    mensajeError('Fecha no valida', "fallo");
                    break;
                case "FechaMayor":
                    mensajeError('Fecha inicio mayor', "fallo");
                    break;
                case "FechasIguales":
                    mensajeError('Fechas iguales', "fallo");
                    break;
                case "NoHayDatosFechas":
                    mensajeError('No hay datos', "De la fecha que selecciono");
                    break;
                case "NoHayDatosProductor":
                    mensajeError('No hay datos', "Del productor que selecciono");
                    break;
                case "NoHayDatosProductorYFecha":
                    mensajeError('No hay datos', "De la fecha y el el productor que selecciono");
                    break;
                case "NoHayDatosGeneral":
                    mensajeError('No hay datos', "Actualmente no hay registros");
                    break;
                case "ConsultaGeneral":
                    console.log("ConsultaGeneral");
                    generarTabla("ConsultaGeneral", fechaI, fechaF, idProdud, tipoRecol);
                    break;
                case "ConsultaXFecha":
                    console.log("ConsultaXFecha");
                    generarTabla("ConsultaXFecha", fechaI, fechaF, idProdud, tipoRecol);
                    break;
                case "ConsultaXProductor":
                    console.log("ConsultaXProductor");
                    generarTabla("ConsultaXProductor", fechaI, fechaF, idProdud, tipoRecol);
                    break;
                case "ConsultaXFechaYProduct":
                    console.log("ConsultaXFechaYProduct");
                    generarTabla("ConsultaXFechaYProduct", fechaI, fechaF, idProdud, tipoRecol);
                    break;
                case "ConsultaXTipos":
                    console.log("ConsultaXTipos");
                    generarTabla("ConsultaXTipos", fechaI, fechaF, idProdud, tipoRecol);
                    break;
                case "ConsultaXTiposYFecha":
                    console.log("ConsultaXTiposYFecha");
                    generarTabla("ConsultaXTiposYFecha", fechaI, fechaF, idProdud, tipoRecol);
                    break;
                case "ConsultaXTiposProductor":
                    console.log("ConsultaXTiposProductor");
                    generarTabla("ConsultaXTiposProductor", fechaI, fechaF, idProdud, tipoRecol);
                    break;
                case "ConsultaXTiposYFechaYProduct":
                    console.log("ConsultaXTiposYFechaYProduct");
                    generarTabla("ConsultaXTiposYFechaYProduct", fechaI, fechaF, idProdud, tipoRecol);
                    break;
                    //Usuario distribuidor
                case "DistribuidorConsultaGeneral":
                    console.log("DistribuidorConsultaGeneral");
                    generarTablaV2("DistribuidorConsultaGeneral", fechaI, fechaF, idProdud, tipoRecol);
                    break;
                case "DistribuidorConsultaXFecha":
                    console.log("DistribuidorConsultaXFecha");
                    generarTablaV2("DistribuidorConsultaXFecha", fechaI, fechaF, idProdud, tipoRecol);
                    break;
                case "DistribuidorConsultaXProductor":
                    console.log("DistribuidorConsultaXProductor");
                    generarTablaV2("DistribuidorConsultaXProductor", fechaI, fechaF, idProdud, tipoRecol);
                    break;
                case "DistribuidorConsultaXFechaYProduct":
                    console.log("DistribuidorConsultaXFechaYProduct");
                    generarTablaV2("DistribuidorConsultaXFechaYProduct", fechaI, fechaF, idProdud, tipoRecol);
                    break;
                default:                    
                    break;
            }
        }
    });
    
}

function generarTabla(opc, fechaI, fechaF, idProdud, tipoRecolec) {
    let tablaEntrega = $('#entrega').DataTable({
        destroy:true,
        scrollX:true,
        scrollCollapse: true,
        processing: true,
        ajax: {
            "method":"POST",
            "url":"metodosConsulta.php",
            "data":{'Opcion': opc, 'FI': fechaI, 'FF': fechaF, 'IdProdu': idProdud, 'TipoRecol': tipoRecolec},
            "error": function (res) {
                if (res.responseText == "Error") {
                    console.log(res.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'No hay datos disponibles',
                        text: 'No se encontraron registros del distribuidor',
                    });
                }else 
                    return res.responseText;                   
            }
        },
        columns:[
            {data: "IdEntrega"},
            {data: "TipoRecolector"},
            {data: "NomRecolector"},
            {data: "Productor"},
            {data: "Recibo",       //Aquí esta el recibo
                render: function (data, type, row) {  
                    if (data == "Faltante" || data == "" ) {
                        return "<button class='archivo-btn'><img  src='../Recursos/Iconos/Ordenes32NoEncontrado.svg' alt='No hay archivo' ></button>";
                    }else
                        return "<a href='"+data+"' target='_blank' class='archivo-btn'><img  src='../Recursos/Iconos/Ordenes32.svg' alt='Abrir archivo' ></a>";
                }
            },  
            {data: "ResponsableEntrega"},
            {data: "ResponsableRecepcion"},
            {data: "fecha"},
            {defaultContent: "<button class='detalle-btn detalle'><img src='../Recursos/Iconos/detalle.svg' alt='Abrir detalle'></button>"},
            {defaultContent: "<button class='detalle-btn editar'><img src='../Recursos/Iconos/editar.svg' alt='Editar'></button>"}
            
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-MX.json'
        }
    });

    //Evento que muestra el detalle cuando se da clic al botón de mostrar
    $("#entrega tbody").on('click', 'button.detalle', function () {
        var datosFila = tablaEntrega.row($(this).parents('tr')).data();
        if (datosFila != undefined) {
            mostrarDetalle(datosFila);
            console.log(datosFila);
        }
        
    });
}

function generarTablaV2(opc, fechaI, fechaF, idProdud, tipoRecolec) {
    let tablaEntrega = $('#entrega').DataTable({
        destroy:true,
        scrollX:true,
        scrollCollapse: true,
        processing: true,
        ajax: {
            "method":"POST",
            "url":"metodosConsulta.php",
            "data":{'Opcion2': opc, 'FI': fechaI, 'FF': fechaF, 'IdProdu': idProdud, 'TipoRecol': tipoRecolec},
            "error": function (res) {
                if (res.responseText == "Error") {
                    console.log(res.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'No hay datos disponibles',
                        text: 'No se encontraron registros del distribuidor',
                    });
                }else 
                    return res.responseText;                   
            }
        },
        columns:[
            {data: "IdEntrega"},
            {data: "Productor"},
            {data: "Recibo",       //Aquí esta el recibo
                render: function (data, type, row) {  
                    if (data == "Faltante" || data == "" ) {
                        return "<button class='archivo-btn'><img  src='../Recursos/Iconos/Ordenes32NoEncontrado.svg' alt='No hay archivo' ></button>";
                    }else
                        return "<a href='"+data+"' target='_blank' class='archivo-btn'><img  src='../Recursos/Iconos/Ordenes32.svg' alt='Abrir archivo' ></a>";
                }
            },  
            {data: "ResponsableEntrega"},
            {data: "ResponsableRecepcion"},
            {data: "fecha"},
            {defaultContent: "<button class='detalle-btn detalle'><img src='../Recursos/Iconos/detalle.svg' alt='Abrir detalle'></button>"},
            {defaultContent: "<button class='detalle-btn editar'><img src='../Recursos/Iconos/editar.svg' alt='Editar'></button>"}
            
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-MX.json'
        }
    });

    //Evento que muestra el detalle cuando se da clic al botón de mostrar
    $("#entrega tbody").on('click', 'button.detalle', function () {
        var datosFila = tablaEntrega.row($(this).parents('tr')).data();
        if (datosFila != undefined) {
            mostrarDetalle(datosFila);
            console.log(datosFila);
        }
        
    });
}

function mostrarDetalle(datosFila) {

    //Llenar tabla detalle 
    $('#detalle').DataTable({
        destroy:true,
        ajax: {
            "method":"POST",
            "url":"obtenerDetalle.php",
            "data":{'IdEntrega': datosFila.IdEntrega} //Se le manda el IdEntrega dependiendo de la fila presionada
        },
        columns:[
            {data: "IdEntrega"},
            {data: "Consecutivo"},
            {data: "TipoEnvaseVacio"},
            {data: "CantidadPiezas"},
            {data: "Peso"},
            {data: "Observaciones"},
            {defaultContent: "<button class='detalle-btn editar'><img src='../Recursos/Iconos/editar.svg' alt='Icono de detalle'></button>"}
        ]
    });

}

function añadirProductores(comboProduc){
    $.ajax({
        url:'optenerCampos.php',
        type: 'GET',
        success: function (res) {
            let datos = JSON.parse(res);//Trae los datos en formato json y los pasa a objeto
            if (datos.produtores == "No hay productores") {
                mensajeError('No hay ningún productor registrado', "Por favor vaya a registrar uno");
            }else
            datos.produtores.map(productor => {
                comboProduc.insertAdjacentHTML('beforeend', `<option value="${productor.IdProductor}">${productor.Nombre}</option>`);//Rellena la combo proveedores    
            });  
        }
    })
}

function mensajeError(titulo, texto) {
    Swal.fire({
        icon: 'error',
        title: titulo,
        text: texto,
    }).then((result) => {
        if (result.isConfirmed) {
            console.log("Fallo");
        }
    });
}