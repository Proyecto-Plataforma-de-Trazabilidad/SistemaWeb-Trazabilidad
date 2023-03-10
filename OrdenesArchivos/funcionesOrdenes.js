
    const usuario = document.getElementById("nomDistri");
    const orden = document.getElementById("numOrden");
    //const numOrden= orden.getAttribute('data-numOrden');
    const tipoQuimi = document.getElementById("tipoQuimi");
    const nombreProdu = document.getElementById("nomProdu");
    
    
    function añadirQumicos(qumico){
        let quimico = qumico;
        tipoQuimi.insertAdjacentHTML('beforeend', `<option value="${quimico.IdTipo}">${quimico.Concepto}</option>`);
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
            orden.textContent = "Numero de orden: " + datos.orden; //Coloca el numero de orden
            orden.dataset.numOrden=""+datos.orden;
            datos.quimicos.map(quimico => añadirQumicos(quimico)); //Rellena la combo tipoQumicos
            datos.produtores.map(productor => añadirProductor(productor));//Rellena la combo proveedores      
        }
    })


