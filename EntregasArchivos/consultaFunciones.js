$(document).ready(function () {
    const nombreProdu = document.getElementById("nomProdu");
    añadirProductores(nombreProdu); //Funcion que carga la combo de productores

    mostrarEntrega("","","");  //Función que se encarga de llenar el datatable
});

//Función jQuery  que se ejecuta cuando das clic al botón
$('#aceptar').click(function () {
    let fechaIni = document.getElementById('fechaInicio').value;
    let fechaFin = document.getElementById('fechafin').value;
    let idProd = document.getElementById('nomProdu').value;
    if (idProd == "Selecciona un productor") {
        mostrarEntrega(fechaIni, fechaFin, "");
    }else
        mostrarEntrega(fechaIni, fechaFin, idProd);
});


function mostrarEntrega(fechaI, fechaF, idProdud) {
    $.ajax({
        type: 'POST',
        url:'../OrdenesArchivos/validacionesConsulta.php',
        data:{'FI': fechaI, 'FF': fechaF, 'IdProdu': idProdud, 'movi': 'entregas'},
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
                    
                    generarTabla('','','');
                    break;
                default:
                    // var data = [
                    //     { 'IdOrden': "1", 'Distribuidor': "Infected", 'Productor': "Pancho",  'NumFactura': "8d8nnw", 'Factura': "Facturas/f1.png", 'NumReceta': "888sd88dd", 'Receta': "Recetas/r1.png", 'Fecha': "2023-04-06"}
                    // ];
                    
                    break;
            }
        }
    });
    
}

function generarTabla(opc, fechaI, fechaF, idProdud) {
    let tablaOrden = $('#entrega').DataTable({
        destroy:true,
        scrollX:true,
        scrollCollapse: true,
        processing: true,
        ajax: {
            "method":"POST",
            "url":"metodosConsulta.php",
            "data":{'Opcion': opc, 'FI': fechaI, 'FF': fechaF, 'IdProdu': idProdud },
            "error": function (res) {
                console.log(res);
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
            {data: "Fecha"},
            {defaultContent: "<button class='detalle-btn detalle'><img src='../Recursos/Iconos/detalle.svg' alt='Abrir detalle'></button>"},
            {defaultContent: "<button class='detalle-btn editar'><img src='../Recursos/Iconos/editar.svg' alt='Editar'></button>"}
            
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-MX.json'
        }
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