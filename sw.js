//Imports
importScripts('https://cdn.jsdelivr.net/npm/pouchdb@8.0.1/dist/pouchdb.min.js');
importScripts('./js/sw-db.js');

const CACHE_STATIC_NAME = 'cache-static-03'
const CACHE_DYNAMIC_NAME = 'cache-dyna-03';
const CACHE_INMUNE_NAME = 'cache-inmune-01';

function limpiarCache(cacheName, numeroItems) {

    caches.open(cacheName).then(cache => {

        return cache.keys().then(keys => {
            if (keys.length > numeroItems) {
                cache.delete(keys[0]).then(limpiarCache(cacheName, numeroItems))
            }
        });

    });


}

self.addEventListener('install', e => {

    const cachePromise = caches.open(CACHE_STATIC_NAME).then(cache => {

        return cache.addAll([
            './index.php',
            './Logos/LogoTep.png',
            './Logos/pead.jpg',
            './Logos/APEAJAL2.jpg',
            './Logos/AMOCALI.jpg',
            './Logos/ASICA.jpg',
            './Recursos/Iconos/Loading-Icon-TEP2.gif',
            './Recursos/Iconos/ResponsableCat.svg',
            './Recursos/Iconos/CAT.svg',
            './Recursos/Iconos/Distribuidores.svg',
            './Recursos/Iconos/Productores.svg',
            './Recursos/Iconos/Huertos.svg',
            './Recursos/Iconos/TipoQuimicos.svg',
            './Recursos/Iconos/EP.svg',
            './Recursos/Iconos/ERPVehiculos.svg',
            './Recursos/Iconos/distribuidoresVehiculos.svg',
            './Recursos/Iconos/Contenedores.svg',
            './Recursos/Iconos/TipoContenedores.svg',
            './Recursos/Iconos/EmpresaDestino.svg',
            './Recursos/Iconos/Municipio.svg',
            './Recursos/Iconos/MunicipioVehiculos.svg',
            './Recursos/Iconos/Ordenes.svg',
            './Recursos/Iconos/Entregas.svg',
            './Recursos/Iconos/Extraviados.svg',
            './Recursos/Iconos/Salidas2.svg',
            './js/sw-db.js'
        ]);
    });

    const cacheInmutable = caches.open(CACHE_INMUNE_NAME).then(cache => {

        return cache.addAll([
            'https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js',
            'https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css',
            './plugins/Sweetalert2/sweetalert2.min.css',
            './plugins/Sweetalert2/sweetalert2.all.min.js',
            './jquery-3.6.0.min.js',
            'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css',
            'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js',
            './bootstrap-5.1.3-dist/css/bootstrap.min.css',
            './bootstrap-5.1.3-dist/js/bootstrap.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js',
            './poper/popper.min.js',
            'https://cdn.jsdelivr.net/npm/pouchdb@8.0.1/dist/pouchdb.min.js',
            'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
            'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
            'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,800;1,300;1,400;1,500;1,600&display=swap',
            'https://kit.fontawesome.com/c65c1f4f0a.js',
            'https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js',
            'https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css',
            './datatables.min.js',
            './Librerias/MaterialToast/mdtoast.min.css',
            './Librerias/MaterialToast/mdtoast.min.js',
            'https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js',
        ]);
    });

    e.waitUntil(Promise.all([cachePromise, cacheInmutable]));
});

self.addEventListener('activate', e => {

    const respuesta = caches.keys().then(keys => {
        keys.forEach(key => {
            //Borra el cache viejo estatico 
            if (key != CACHE_STATIC_NAME && key.includes('cache-static'))
                return caches.delete(key);

            //Borra el cache viejo estatico 
            if (key != CACHE_DYNAMIC_NAME && key.includes('cache-dyna'))
                return caches.delete(key);
        });
    });

    e.waitUntil(respuesta);

});

///////////////////////////////////////////
self.addEventListener('fetch', e => {
    let respuesta;

    if (e.request.url.includes('maps') || e.request.url.includes('/serviciopush/') || e.request.url.includes('obtenerSession')) { //Pasan las peticiones sin ser guardadas
        //console.log(e.request.url);

        respuesta = fetch(e.request).then(res => { //Ase el fetch del request y lo deja pasar sin guardarlo en el cache
            return res;
        });

    } else if (e.request.url.includes('loggin/logout.php')) {//Pasan las peticiones sin ser guardadas

        caches.delete(CACHE_DYNAMIC_NAME);  //Borra el cache dinamico para eliminar los datos de la session

        respuesta = fetch(e.request).then(res => { //Ase el fetch del request y lo deja pasar sin guardarlo en el cache
            return res;
        });

    } else if (e.request.method === 'POST' && e.request.url.includes('insertar')) { //Si la peticion es de tipo post y esta insertando
        respuesta = fetch(e.request.clone()).then(res => {
            if (res.clone().ok) {
                return res.clone().json(); //Devuelve la respuesta del fetch
            }

        }).then(data => {
            ///console.log(data);
            const response = new Response(JSON.stringify(data));
            return response.clone();

        }).catch(err => {
            console.log("No se pudo acceder a:" + e.request.url);
            return procesaPOST(e.request.clone());

        });

    } else if (e.request.url.includes('generarPDF')) {

        respuesta = fetch(e.request.clone()).then(res => { //Ase el fetch del request y lo deja pasar sin guardarlo en el cache
            if (res.clone().ok) {
                return res.clone().blob(); //Devuelve la respuesta del fetch
            }
        }).then(blob => {
            console.log(blob);
            const response = new Response(blob);
            return response.clone();

        }).catch(err => {
            console.log("No se pudo generar el archivo de:" + e.request.url);
            return procesaPOST(e.request.clone());

        });

    } else if (e.request.url.includes('obtener')) {  //Primero envia la respuesta con internet y si se cae envia lo que hay en cache
        //console.log("procesando campos");
        respuesta = procesarCampos(CACHE_DYNAMIC_NAME, e.request);

    } else {
        respuesta = caches.match(e.request).then(res => {

            //Si si exiten los archivos en el cache los retorna como estan y acaba
            if (res) {
                return res;
            } else {
                //Si no existen los va a buscar a la web
                return fetch(e.request).then(newRes => {

                    if (newRes.ok) { //Valida que la respuesta sea de una pagina que si se encontro (filtra el error 404)

                        if (!newRes.url.includes('extension')) { //Filtro para que no se intente añadir las extenciones de chrome al cache
                            //console.log(newRes.url);
                            caches.open(CACHE_DYNAMIC_NAME).then(cache => {
                                cache.put(e.request, newRes) //Añade al cache los nuevos recursos que se encontraron
                                //limpiarCache.put(CACHE_DYNAMIC_NAME, 100); //El segundo parametro indica la cantidad de recursos que se van a borrar
                            });

                        }
                        return newRes.clone(); //Se debe clonar la respuesta porque se esta usando 2 veces (La primera vez que se utiliza se limpia y queda vacia)

                    } else {
                        return newRes;
                    }

                });//.catch(err => {
                //     if (e.request.headers.get('accept').includes('text/html')) {
                //         return caches.match(); //Añadir una pagina para mostrar offline
                //     }
                // });
            }

        }); //Verifica si el archivo de la petición se encuentra en el cache (cierre)
    }



    e.respondWith(respuesta);
});

//////////////////////////////////////////
self.addEventListener('sync', e => {
    console.log('Ejecutando sync')

    if (e.tag === 'Nuevo-POST') {
        const registros = sincronizarRegistros();

        e.waitUntil(registros);
    }
});



//////////////////////////////// 
//!PushManager

self.addEventListener('push', e => {

    const datos = JSON.parse(e.data.text());

    const title = datos.titulo;
    const options = {
        body: datos.cuerpo,
        icon: './Logos/LogoTep-72.png',
        badge: './Logos/logo-tep-ico.ico',
        image: './Logos/pead.jpg',
        data: {
            url: datos.url
        }
    };

    e.waitUntil(self.registration.showNotification(title, options));

});

self.addEventListener('notificationclick', e => {

    const notificacion = e.notification;
    console.log(notificacion);

    clients.openWindow(notificacion.data.url);

    notificacion.close();
});


// self.addEventListener('fetch', event => {
//     //console.log(event.request.url);

//     //event.respondWith(fetch(event.request));
//     if (event.request.url.includes('APEAJAL2.jpg')) {
//         event.respondWith(fetch('Recursos/Iconos/Envases.png'));
//     }
// });


//Codigo para verificar la conexion a internet
// self.addEventListener('fetch', e => {

//     const resp = fetch(e.request).catch(() => {
//         return new Response(`
//         Necesitas tener conexion a internet
//     `);
//     });

//     e.respondWith(resp);
// });