$(document).ready(function() {
    $('#registrar').click(function() {
        let arreglo = new Array();
        let container = document.querySelector('#detalle');
        let celdasId = container.querySelectorAll('td');
       
        for (let i=0; i< celdasId.length; ++i){
            if(celdasId[i].firstChild.data != undefined){
            arreglo[i]=celdasId[i].firstChild.data; 
            
        }
    }
    let formulario = document.querySelector('#formOrden');
    let datos = new FormData(formulario);
    

    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "OrdenesArchivos/insertar2.php",
        data: datos,
        processData: false,
        contentType: false,
        success: function (res) {
            console.log("SUCCESS : ", res);
        },
        error: function (e) {
            console.log("ERROR : ", e);
        }
    });

    });

});