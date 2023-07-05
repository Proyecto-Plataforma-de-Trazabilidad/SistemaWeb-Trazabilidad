$('#frmOrden').submit(function (e) {


    e.preventDefault();  //detener la recarga de la pagina
    let formData = new FormData(this); //Obtiene los archivos del formulario

    let db = new PouchDB('Ordenes');

    //tomar los valores del formulario
    let accion = 'registrarOrden';

    let nomDis = document.getElementById('nomDistri')
    let idDis = nomDis.dataset.idDistribuidor;
    let idProd = document.getElementById('nomProdu').value;
    let NumFac = document.getElementById('factOrden').value;
    let numRec = document.getElementById('cedReceta').value;
    let fecha = document.getElementById('fecha').value;

    //validar campos del formulario de orden
    let datos = {
        _id: new Date().toISOString(),
        accion: accion,
        idDis: idDis,
        idProd: idProd,
        NumFac: NumFac,
        factura: "",
        numRec: numRec,
        receta: "",
        fecha: fecha,
    };

    //console.log(datos);

    //db.put(datos).then(console.log("Registro exitoso"));

    db.allDocs({ include_docs: true, descending: false }).then(doc => {
        console.log(doc.rows);
    });

});

