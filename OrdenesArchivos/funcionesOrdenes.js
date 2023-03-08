$(document).ready(function(){
    const usuario = document.getElementById("nomDistri");
    const orden = document.getElementById("numOrden");
    const tipoQuimi = document.getElementById("tipoQuimi");
    const nombreProdu = document.getElementById("nomProdu");
    
    
    function añadirQumicos(qumico){
        let quimico = qumico;
        tipoQuimi.insertAdjacentHTML('beforeend', `<option value="${quimico.Concepto}">${quimico.Concepto}</option>`);
    }

    function añadirProductor(productor){
        let product = productor;
        nombreProdu.insertAdjacentHTML('beforeend', `<option value="${product.IdProductor}">${product.Nombre}</option>`);
    }

    $.ajax({
        url:'OrdenesArchivos/peticiones.php',
        type: 'GET',
        success: function (res) {
          
            let datos = JSON.parse(res);//Trae los datos en formato json y los pasa a objeto
            usuario.placeholder = datos.usuario; //Ubica al usuario en el input
            orden.textContent = "Numero de orden: 00" + datos.orden; //Coloca el numero de orden
            datos.quimicos.map(quimico => añadirQumicos(quimico)); //Rellena la combo tipoQumicos
            datos.produtores.map(productor => añadirProductor(productor));//Rellena la combo proveedores      
        }
    })


})