$('#registrar').click(function (e) {
    //detener la carga de la pagina 
    e.preventDefault();

    //tomar los valores del formulario 
    let orden="registrarOrden";
    
    let idDis= document.getElementById('nomDistri').getAttribute('data-id-distribuidor');
    let idProd= document.getElementById('nomProdu').value;
    let NumFac= document.getElementById('factOrden').value;
    let factura= document.getElementById('archFac').value;
    let numRec= document.getElementById('cedReceta').value;
    let receta= document.getElementById('archReceta').value;
    let fecha= document.getElementById('fecha').value;

    let datos={
        "accion":orden,
        "idDis":idDis,
        "idProd":idProd,
        "NumFac":NumFac,
        "factura": factura,
        "numRec":numRec,
        "receta":receta,
        "fecha":fecha,
    }
    console.log(datos);


    //mandar arreglo con ajax
    $.ajax({
        url:'OrdenesArchivos/pruebaAjax.php',
        data:datos,
        type:'POST',
        success:function(response){
            alert("Datos enviados");
        }
    });
});
