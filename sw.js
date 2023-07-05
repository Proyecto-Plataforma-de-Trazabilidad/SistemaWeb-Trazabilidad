const CACHE_STATIC_NAME = 'cache-static-01';
const CACHE_DYNAMIC_NAME = 'cache-dyna-01';
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
            '/index.php',
            './Logos/LogoTep.png',
            './Logos/pead.jpg',
            './Logos/APEAJAL2.jpg',
            './Logos/AMOCALI.jpg',
            './Logos/ASICA.jpg',
        ]);
    });

    const cacheInmutable = caches.open(CACHE_INMUNE_NAME).then(cache => {

        return cache.addAll([
            'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css',
            'https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js',
            'https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css',
            './jquery-3.6.0.min.js',
            'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js',
            './poper/popper.min.js',
            'https://cdn.jsdelivr.net/npm/pouchdb@8.0.1/dist/pouchdb.min.js',
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

self.addEventListener('fetch', e => {

    const respuesta = caches.match(e.request).then(res => {

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
                }

            });//.catch(err => {
            //     if (e.request.headers.get('accept').includes('text/html')) {
            //         return caches.match(); //Añadir una pagina para mostrar offline
            //     }
            // });
        }


    }).catch(err => {
        console.log("No se encontro el recurso" + err);
    })

    e.respondWith(respuesta);
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