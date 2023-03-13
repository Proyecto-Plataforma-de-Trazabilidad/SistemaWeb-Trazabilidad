$('#frmOrden').submit(function(e) {
    //detener la carga de la pagina 
    e.preventDefault();

    let formData = new FormData(this);

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

    //mandar archivo con ajax
    $.ajax({
        url:'OrdenesArchivos/insertar2.php',
        type:'POST',
        data:formData,
        contentType: false,
        cache: false,
        processData:false,
        success:function(response){
            //console.log(response);
        }
    });

    //mandar orden y detalle con ajax
    $.ajax({
        url:'OrdenesArchivos/insertar2.php',
        data:{orden: datos, detalle: arreglo},
        type:'POST',
        success:function(response){
            console.log(response);
        }
    });

});
