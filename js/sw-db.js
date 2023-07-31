
let db = new PouchDB('Registros');

function guardaRegistro(datos) {
    datos._id = new Date().toISOString();

    return db.put(datos).then(() => {
        self.registration.sync.register('Nuevo-POST')

        const resOffline = { mensaje: 'PosteoOffline' };

        //console.log('Se preguardo el registro');
        return new Response(JSON.stringify(resOffline));
    });
}

function guardaConsulta(datos) {
    //console.log(datos);
    datos.data.forEach(row => {
        console.log(row);
    });
    // datos._id = new Date().toISOString();

    // db.put(datos).then(() => {
    //     console.log('Se preguardo el registro');
    // });
}

function procesaPOST(req) {

    if (self.registration.sync) {

        return req.clone().formData().then(formData => { //No se procesa como texto la peticion ya que esta codificado como FormData

            let data = Object.fromEntries(formData); //Convierte el form data en un objeto simple
            //console.log(data);

            // if (data.hasOwnProperty('archRecibo')) {
            //     delete data.archRecibo;
            // }
            data['urlPeticion'] = req.url;
            console.log(data);
            return guardaRegistro(data);

        }).then(res => { return res });

    }

}

function procesarCampos(nombreCache, req) {

    // return req.clone().text().then(jsonDatos => {

    //     console.log(jsonDatos);

    //     const resOffline = { extraviados: 10000000, idProduc: "1", nomProduc: "SAEN" };

    //     return new Response(JSON.stringify(resOffline));
    // });


    return fetch(req).then(res => { //Hace la petcion 
        if (res.clone().ok) {
            return res.clone().json(); //Devuelve la respuesta del fetch
        }
    })
        .then(data => {
            const response = new Response(JSON.stringify(data)); //Crea la respuesta en formato json
            caches.open(nombreCache).then(cache => {
                cache.put(req, response.clone()); //Guarda en el cache la respuesta
                //console.log("Se guardo en el cache");
            });

            return response.clone();     //Retorna respuesta creada

        })
        .catch(err => {//Si falla la peticion devuelve lo que hay en cache

            console.log("Usando cache");
            return caches.match(req)
            // .then(myCache => {
            //     myCache.json().then(json => console.log(json))
            // })
        });
}

//Funcion que registra en la BD cuando se recupera la conexion
function sincronizarRegistros() {

    return db.allDocs({ include_docs: true }).then(docs => {
        const posteos = [];

        docs.rows.forEach(row => {

            const urlPeticion = row.doc.urlPeticion;
            //console.log(urlPeticion);

            const datos = row.doc;

            //Convierte un objeto a formData
            const formData = new FormData();    //Crea el objeto form data
            Object.entries(datos).forEach(([key, value]) => { //Recorre el registro obteniendo su indice y su valor
                formData.append(key, value);                    //Los agrega el form data
            });

            if (urlPeticion.includes('insertar')) { //Se hace lo siguiente si la url de la peticion contiene un insertar

                const fetchProm = fetch(urlPeticion, {
                    method: 'POST',
                    cache: "no-cache",
                    body: formData
                }).then(res => res.json())
                    .then(mensaje => {
                        if (mensaje.mensaje == "Correcto") {
                            console.log("Se a realizado un " + row.doc.accion + " el: " + row.doc._id);
                            return db.remove(datos);
                        }

                    }).catch(err => {
                        console.log('No se puedo insertar');
                    });

                posteos.push(fetchProm);

            } else if (urlPeticion.includes('generarPDF')) { //Se hace lo siguiente si la url de la peticion contiene un generar 
                console.log('GenerandoPDF');
                let tipoPeticion = urlPeticion.split('/');
                // let tamano = tipoPeticion.length - 1;
                // console.log(tipoPeticion[tamano]);
                tipoPeticion.pop();

                const fetchProm2 = fetch(urlPeticion, { //Se llama el archivo que va a generar el PDF
                    method: 'POST',
                    body: formData
                }).then(res => {
                    console.log(res.type);
                    res.blob().then((blob) => {
                        var file = new File([blob], "archivo.pdf");
                        console.log(file);
                    })
                }).catch(err => {
                    console.log('No se puedo generar');
                });



            }






        }); //Fin foreach
        //console.log(posteos);
        return Promise.all(posteos);  //Verifica que todos los posteos se agan correctamente
    });

}