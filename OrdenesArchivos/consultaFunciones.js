$(document).ready(function () {
    const nombreProdu = document.getElementById("nomProdu");
    añadirProductores(nombreProdu); //Funcion que carga la combo de productores

    mostrarOrden("","","");  //Función que se encarga de llenar el datatable
});

//Funcion jQuery  que se ejecuta cuando das clic al boton
$('#aceptar').click(function () {
    let fechaIni = document.getElementById('fechaInicio').value;
    let fechaFin = document.getElementById('fechafin').value;
    let idProd = document.getElementById('nomProdu').value;
    if (idProd == "Selecciona un productor") {
        mostrarOrden(fechaIni, fechaFin, "");
    }else
        mostrarOrden(fechaIni, fechaFin, idProd);
});

function generarTabla(fechaI, fechaF, idProdud) {
    let tablaOrden = $('#orden').DataTable({
        destroy:true,
        scrollX:true,
        scrollCollapse: true,
        processing: true,
        ajax: {
            "method":"POST",
            "url":"metodosConsulta.php",
            "data":{'FI': fechaI, 'FF': fechaF, 'IdProdu': idProdud },
            "complete": function (res) {
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
            {data: "IdOrden"},
            {data: "Distribuidor"},
            {data: "Productor"},
            {data: "NumFactura"}, 
            {data: "Factura",       //Aqui esta el archivo factura
                render: function (data, type, row) {  
                    if (data == "Faltante" || data == "" ) {
                        return "<button class='archivo-btn'><img  src='../Recursos/Iconos/Ordenes32NoEncontrado.svg' alt='No hay archivo' ></button>";
                    }else
                        return "<a href='"+data+"' target='_blank' class='archivo-btn'><img  src='../Recursos/Iconos/Ordenes32.svg' alt='Abrir archivo' ></a>";
                }
            },  
            {data: "NumReceta"},
            {data: "Receta",         //Aqui esta el archivo recteta
                render: function (data, type, row) {
                    if (data == "Faltante" || data == "" ) {
                        return "<button class='archivo-btn'><img  src='../Recursos/Iconos/Ordenes32NoEncontrado.svg' alt='No hay archivo' ></button>";
                    }else
                        return "<a href='"+data+"' target='_blank' class='archivo-btn'><img  src='../Recursos/Iconos/Ordenes32.svg' alt='Abrir archivo' ></a>";
                }
            }, 
            {data: "Fecha"},
            {defaultContent: "<button class='detalle-btn detalle'><img src='../Recursos/Iconos/detalle.svg' alt='Abrir detalle'></button>"},
            {defaultContent: "<button class='detalle-btn editar'><img src='../Recursos/Iconos/editar.svg' alt='Editar'></button>"}
            
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-MX.json'
        }
    });

        // $.fn.dataTable.ext.errMode = function ( settings, helpPage, message ) { 
    //     console.log(message);
    // };

    $("#orden tbody").on('click', 'button.detalle', function () {
        var datosFila = tablaOrden.row($(this).parents('tr')).data();
        if (datosFila != undefined) {
            mostrarDetalle(datosFila);
            console.log(datosFila);
        }
        
    });

    $("#orden tbody").on('click', 'button.editar', function () {
        var datosFila = tablaOrden.row($(this).parents('tr')).data();
        if (datosFila != undefined) {
            editar(datosFila);
        }
        
    });
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

function mostrarOrden(fechaI, fechaF, idProdud) {
    $.ajax({
        type: 'POST',
        url:'validacionesConsulta.php',
        data:{'FI': fechaI, 'FF': fechaF, 'IdProdu': idProdud, 'movi': 'ordenes'},
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
                    mensajeError('No hay datos', "Del productor uqe selecciono");
                    break;
                case "NoHayDatosProductorYFecha":
                    mensajeError('No hay datos', "De la fecha y el el productor que selecciono");
                    break;
                case "NoHayDatosGeneral":
                    mensajeError('No hay datos', "Actualmente no hay registros de ordenes");
                    break;
                case "ConsultaGeneral":
                    console.log("ConsultaGeneral");
                    generarTabla('','','');
                    break;
                case "ConsultaXFechaYProduct":
                    console.log("ConsultaXFechaYProduct");
                    generarTabla(fechaI,fechaF,idProdud)
                    break;
                case "ConsultaXProductor":
                    console.log("ConsultaXProductor");
                    generarTabla('','',idProdud)
                    break;
                case "ConsultaXFecha":
                    console.log("ConsultaXFecha");
                    generarTabla(fechaI,fechaF,'')
                    break;
                case "ProductorConsultaGeneral":
                    console.log("ProductorConsultaGeneral");
                    generarTabla("","",datos.data)
                    break;
                case "ProductorConsultaXFecha":
                    console.log("ProductorConsultaXFecha");
                    generarTabla(fechaF,fechaF,datos.data)
                    break;
                case "DistribuidorConsultaGeneral":
                    console.log("DistribuidorConsultaGeneral");
                    generarTabla("","","")
                    break;
                case "DistribuidorConsultaXFecha":
                    console.log("DistribuidorConsultaXFecha");
                    generarTabla(fechaF,fechaF,"")
                    break;
                case "DistribuidorConsultaXProductor":
                    console.log("DistribuidorConsultaXProductor");
                    generarTabla("","",idProdud)
                    break;
                case "DistribuidorConsultaXFechaYProduct":
                    console.log("DistribuidorConsultaXFechaYProduct");
                    generarTabla(fechaF,fechaF,idProdud)
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



function mostrarDetalle(datosFila) {

        //Llenar tabla detalle 
        $('#detalle').DataTable({
            destroy:true,
            ajax: {
                "method":"POST",
                "url":"obtenerDetalle.php",
                "data":{'IdOrden': datosFila.IdOrden} //Se le manda el IdOrden dependiendo de la fila presionada
            },
            columns:[
                {data: "IdOrden"},
                {data: "Consecutivo"},
                {data: "IdTipoQuimico"},
                {data: "TipoEnvase"},
                {data: "Color"},
                {data: "CantidadPiezas"},
                {defaultContent: "<button class='detalle-btn editar'><img src='../Recursos/Iconos/editar.svg' alt='Icono de detalle'></button>"}
            ]
        });
    
}

function editar(datosFila) {
    console.log(datosFila);
    $('.titulo h1').text("Editar registro");
    $('.consultaOrden').remove();
    $('.titulo').after(`<section class="form-Principal">
    <form class="row g-4 container-fluid" id="frmOrden" method="POST"
         enctype="multipart/form-data" action="actualizarOrden.php">

        <div class="form-Principal-encabezado">
            <div class="form-Principal-encabezado-numero">
                <label for="" id="numOrden" data-numOrden="">Numero de orden: ${datosFila.IdOrden}</label> 
            </div>
            <div>
                <label for="startDate">Seleccionar Fecha: &nbsp;</label>
            </div>

            <div class="col-sm-2">
                <input id="fecha" class="form-control" type="date" value="${datosFila.Fecha}" required/>
            </div>
        </div>

        <div class="col-sm-4" id="nom">
            <label for="OrdNombre" class="form-label">Nombre del distribuidor</label>
            <!-- debe de cargar dependiendo el inicio de seccion  -->               
            <input disabled type="text" id="nomDistri" name="nomDistribuidor" class="form-control" maxlength="30"
                required placeholder="${datosFila.Distribuidor}" data-idDistribuidor="">
        </div>

        <div class="col-sm-4">
            <label for="OrdFact" class="form-label">Factura</label>
            <input type="text" id="factOrden" name="facturaOrden" class="form-control" maxlength="30"
                pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#0-9.,-]{1,30}" placeholder="${datosFila.NumFactura}">
        </div>

        <div class="col-sm-4">
            <label for="formFileMultiple" class="form-label">Subir Factura</label>
            <input class="form-control" type="file" id="archFac" name="archFac" multiple>
        </div>

        <div class="col-sm-4">
            <div>
                <label for="inestado" class="form-label">Nombre de Productor</label>
                <select name="nomProdu" id="nomProdu" class="form-select" required>
                    <option hidden>Selecciona un productor registrado</option>
                </select>
            </div>
        </div>

        <div class="col-sm-4">
            <label for="OrdFact" class="form-label">Cédula de receta</label>
            <input type="text" id="cedReceta" name="facturaOrden" class="form-control" maxlength="30"
                pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#0-9.,-]{1,30}" placeholder="${datosFila.NumReceta}">
        </div>

        <div class="col-sm-4">
            <label for="formFileMultiple" class="form-label">Subir Receta</label>
            <input class="form-control" type="file" id="archReceta" name="archRece" multiple>
        </div>
        <div class="col-sm-4">
            <button type="submit" class="btn btn-success button-actualizar" id="actualizar" name="actualizar" form="frmOrden">Guardar</button>
        </div>
    </form>
</section>
<script type="text/javascript" src="btn_Registrar.js"></script>`);

const nombreProdu = document.getElementById("nomProdu");
const orden = document.getElementById("numOrden");
const distri = document.getElementById("nomDistri");

orden.dataset.numOrden=""+datosFila.IdOrden;
distri.dataset.idDistribuidor = ""+datosFila.Distribuidor; //Asigna el id del distribuidor al dataset
añadirProductores(nombreProdu);

}

function añadirProductores(comboProduc){
    $.ajax({
        url:'peticiones.php',
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