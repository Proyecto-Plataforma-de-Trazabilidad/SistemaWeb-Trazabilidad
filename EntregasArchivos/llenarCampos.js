const entrega = document.getElementById("numEntrega");
const tipoRecolect = document.getElementById("tipoRecol");
const nombreRecolect = document.getElementById("nomRecol");
const nombreProdu = document.getElementById("nomProdu");


$.ajax({
    url:'EntregasArchivos/optenerCampos.php',
    type: 'GET',
    success: function (res) {
        let datos = JSON.parse(res);//Trae los datos en formato json y los pasa a objeto
        tipoRecolect.placeholder = datos.tipo; //Ubica al usuario en el input
        entrega.textContent = "Numero de entrega: " + datos.entrega; //Coloca el numero de orden
        datos.produtores.map(productor => {
            nombreProdu.insertAdjacentHTML('beforeend', `<option value="${productor.IdProductor}">${productor.Nombre}</option>`);
        });//Rellena la combo proveedores      
    }
})