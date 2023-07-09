
let db = new PouchDB('Registros');

function guardaRegistro(datos) {
    datos._id = new Date().toISOString();

    db.put(datos).then(() => {
        console.log('Se preguardo el registro');
    });
}