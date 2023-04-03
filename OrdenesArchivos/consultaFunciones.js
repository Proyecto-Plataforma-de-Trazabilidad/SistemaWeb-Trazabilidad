$(document).ready(function () {
    mostrarOrden(null,null);
    
});

$('#aceptar').click(function () {
    let fechaIni = document.getElementById('fechaInicio').value;
    let fechaFin = document.getElementById('fechafin').value;
    
    mostrarOrden(fechaIni, fechaFin);
});

function mostrarOrden(fechaI, fechaF) {
    
    let tablaOrden = $('#orden').DataTable({
        destroy:true,
        scrollX:true,
        scrollCollapse: true,
        ajax: {
            "method":"POST",
            "url":"metodosConsulta.php",
            "data":{'FI': fechaI, 'FF': fechaF },
            "error": function (xhr, textStatus, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'No hay datos disponibles',
                    text: 'No se encontraron registros del distribuidor',
                });
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
                required placeholder="${datosFila.Distribuidor}" data-id-distribuidor="">
        </div>

        <div class="col-sm-4">
            <label for="OrdFact" class="form-label">Factura</label>
            <input type="text" id="factOrden" name="facturaOrden" class="form-control" maxlength="30"
                pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#0-9.,-]{1,30}" required placeholder="${datosFila.NumFactura}">
        </div>

        <div class="col-sm-4">
            <label for="formFileMultiple" class="form-label">Subir Factura</label>
            <input class="form-control" type="file" id="archFac" name="archFac" multiple>
        </div>

        <div class="col-sm-4">
            <div>
                <label for="inestado" class="form-label">Nombre de Productor</label>
                <select name="nomProdu" id="nomProdu" class="form-select" required>
                    <option hidden>${datosFila.Productor}</option>
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
orden.dataset.numOrden=""+datosFila.IdOrden;

//rellena la combo de producotores
function añadirProductor(productor){
    nombreProdu.insertAdjacentHTML('beforeend', `<option value="${productor.IdProductor}">${productor.Nombre}</option>`);
}

$.ajax({
    url:'peticiones.php',
    type: 'GET',
    success: function (res) {
        let datos = JSON.parse(res);//Trae los datos en formato json y los pasa a objeto
        datos.produtores.map(productor => añadirProductor(productor));//Rellena la combo proveedores      
    }
})
    
}
