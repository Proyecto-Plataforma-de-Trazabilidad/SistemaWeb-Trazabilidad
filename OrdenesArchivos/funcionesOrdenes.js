$(document).ready(function(){
    const usuario = document.getElementById("nomDistri");
    const orden = document.getElementById("numOrden");
    const tipoQuimi = document.getElementById("tipoQuimi");
    
    
    function añadirQumicos(qumico){
        let quimico = qumico;
        tipoQuimi.insertAdjacentHTML('beforeend', `<option value="${quimico.IdTipo}">${quimico.Concepto}</option>`);
    }

    $.ajax({
        url:'OrdenesArchivos/peticiones.php',
        type: 'GET',
        success: function (res) {
            //
            let datos = JSON.parse(res);
            usuario.placeholder = datos.usuario;

            orden.textContent = "Numero de orden: 00" + datos.orden;
            datos.quimicos.map(quimico => añadirQumicos(quimico));
        }
    })
})