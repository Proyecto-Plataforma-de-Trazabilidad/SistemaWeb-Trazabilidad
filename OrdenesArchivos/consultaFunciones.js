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
            "data":{'FI': fechaI, 'FF': fechaF }
        },
        columns:[
            {data: "IdOrden"},
            {data: "Distribuidor"},
            {data: "Productor"},
            {data: "NumFactura"}, 
            {data: "Factura",       //Aqui esta el archivo factura
                render: function (data, type, row) {
                    return "<a href='"+data+"' target='_blank' class='archivo-btn'><img  src='../Recursos/Iconos/Ordenes32.svg' alt='Abrir archivo' ></a>";
                }
            },  
            {data: "NumReceta"},
            {data: "Receta",         //Aqui esta el archivo recteta
                render: function (data, type, row) {
                    return "<a href='"+data+"' target='_blank' class='archivo-btn'><img  src='../Recursos/Iconos/Ordenes32.svg' alt='Abrir archivo' ></a>";
                }
            }, 
            {data: "Fecha"},
            {defaultContent: "<button class='detalle-btn detalle'><img src='../Recursos/Iconos/detalle.svg' alt='Icono de detalle'></button>"},
            {defaultContent: "<button class='detalle-btn editar'><img src='../Recursos/Iconos/editar.svg' alt='Icono de detalle'></button>"}
            
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-MX.json'
        }
    });

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

}
