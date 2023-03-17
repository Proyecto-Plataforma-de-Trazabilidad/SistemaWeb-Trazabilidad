const entrega = document.getElementById("numEntrega");
const tipoRecolect = document.getElementById("tipoRecol");
const nombreRecolect = document.getElementById("nomRecol");
const nombreProdu = document.getElementById("nomProdu");

$.ajax({
    url:'EntregasArchivos/optenerCampos.php',
    type: 'GET',
    success: function (res) {
      
        // let datos = JSON.parse(res);//Trae los datos en formato json y los pasa a objeto
        // usuario.placeholder = datos.usuario; //Ubica al usuario en el input
        // orden.textContent = "Numero de orden: " + datos.orden; //Coloca el numero de orden
        // orden.dataset.numOrden=""+datos.orden;
        // datos.quimicos.map(quimico => añadirQumicos(quimico)); //Rellena la combo tipoQumicos
        // datos.produtores.map(productor => añadirProductor(productor));//Rellena la combo proveedores      
    }
})