$('#registrar').click(function (e) {
    //detener la carga de la pagina 
    e.preventDefault();

    //tomar los valores del formulario 
    let accion="registrarOrden";
    
    let idDis= document.getElementById('nomDistri').getAttribute('data-id-distribuidor');
    let idProd= document.getElementById('nomProdu').value;
    let NumFac= document.getElementById('factOrden').value;
    let factura= document.getElementById('archFac').value;
    let numRec= document.getElementById('cedReceta').value;
    let receta= document.getElementById('archReceta').value;
    let fecha= document.getElementById('fecha').value;

    let datos={
        "accion":accion,
        "idDis":idDis,
        "idProd":idProd,
        "NumFac":NumFac,
        "factura": factura,
        "numRec":numRec,
        "receta":receta,
        "fecha":fecha,
    }
    //console.log(datos);


    //tomar los valores de la tabla detalle 
    let arreglo= new Array();
    let tabla  = document.querySelector('#detalle'); //buscamos la tabla
    let filas = tabla.querySelectorAll('tr'); // seleccionamos todas los renglones     
    let orden= document.getElementById('numOrden');
    const numOrden= orden.dataset.numOrden;


    //ciclo 
    for(var i=1; i<filas.length; i++){ //ejecutara todo el numero de filas 
        var celdas= filas[i].getElementsByTagName("td"); //solo tomara las que son de td              
        var fila={
            "idOrden": numOrden,
            "consecutivo": celdas[0].innerHTML,
            "idquimico": celdas[1].dataset.tableIdquimico,
            "tipoEnvase": celdas[2].innerHTML,
            "color": celdas[3].innerHTML,
            "piezas":celdas[4].innerHTML
        }
        arreglo.push(fila);
    }
    
    //console.log(arreglo);

    //mandar arreglo con ajax
    $.ajax({
        url:'OrdenesArchivos/insertar.php',
        data:{orden: datos, detalle: arreglo},
        type:'POST',
        success:function(response){
            //console.log(response);
        }
    });
});
