

let swRegistro;

if (navigator.serviceWorker) {
    navigator.serviceWorker.register("./sw.js").then(reg => {
        swRegistro = reg;
    })
}

//Notificaciones
function activaNotificaciones() {
    if (!window.Notification) {
        console.log("No soporta las notifiaciones");
    }
    if (Notification.permission === 'granted') {
        new Notification('Estoy notificandote')
        console.log("notificandote");

    } else if (Notification.permission != 'denied' || Notification.permission === 'default') {
        Notification.requestPermission(function (permiso) {
            console.log(permiso);
            if (permiso === 'granted') {
                new Notification('Estoy notificandote');
            }
        })
    }
}

//Notifiaciones Subscripcion
function verificaSubscripcion(estatus) {
    console.log(estatus);
    if (estatus) { //Si estatus es true lo pone azul
        $('.fab').css("background-color", "#25B594");
        $('.material-icons').removeClass('fa-bell-slash').addClass('fa-bell');
    } else { //Si no lo desactiva y lo pone rojo 
        $('.fab').css("background-color", "#BC2C46");
        $('.material-icons').removeClass('fa-bell').addClass('fa-bell-slash');
    }
}

$(document).ready(function () {
    activaNotificaciones();

    fetch('./obtenerSession.php')
        .then(session => session.json())
        .then(datos => {

            if (datos.notifiStatus == "false") { //Notifiaciones desactivadas
                verificaSubscripcion(false);
            } else if (datos.notifiStatus == "true") { //Notifiaciones activadas
                verificaSubscripcion(true);
            }

        });
});
//notificarme();

//Obtener llave
function getPublicKey() {
    return fetch('https://nodejs-api-tep-production.up.railway.app/serviciopush/key', {
    })
        .then(res => res.arrayBuffer())
        .then(key => new Uint8Array(key))
}


$('#notificaciones').on("click", function () {

    if (!swRegistro) return console.log("No hay registro de sw");

    fetch('./obtenerSession.php')
        .then(session => session.json())
        .then(datos => {
            const notifiacionStatus = datos.notifiStatus;
            const idUsuario = datos.idUsuario;

            if (notifiacionStatus == "false") { //Si esta en falso quiere decir que esta desactivada por en de se debe activar

                getPublicKey().then(key => {

                    swRegistro.pushManager.subscribe({
                        userVisibleOnly: true,
                        applicationServerKey: key
                    }).then(res => res.toJSON())
                        .then(suscripcion => {

                            suscripcion['idusuario'] = idUsuario;
                            console.log(suscripcion);

                            fetch('https://nodejs-api-tep-production.up.railway.app/serviciopush/subscribe', {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json' },
                                body: JSON.stringify(suscripcion)
                            }).then(res => res.text())
                                .then(mensaje => {
                                    console.log(mensaje);
                                    if (mensaje == 'todoCorrecto') {

                                        //desactiva estatus 
                                        const formData = new FormData();    //Crea el objeto form data
                                        formData.append('opcion', 'activarNotifiaciones');

                                        fetch('./obtenerSession.php', {
                                            method: 'POST',
                                            body: formData
                                        }).then(res => res.json())
                                            .then(verificaSubscripcion)
                                    }//fin del if que verifica

                                })
                                .catch(cancelarSuscripcion); //Si no puede comunicarse con el servidor push

                        });//Fin del subscribe

                })//Fin de la funcion get

            }//Fin del if

        });



});

//Canselar la suscripcion
function cancelarSuscripcion() {
    swRegistro.pushManager.getSubscription().then(sub => {
        sub.unsubscribe().then(() => {

            //desactiva estatus 
            const formData = new FormData();    //Crea el objeto form data
            formData.append('opcion', 'desactivarNotifiaciones');

            fetch('./obtenerSession.php', {
                method: 'POST',
                body: formData
            }).then(res => res.json())
                .then(verificaSubscripcion(false))
        });
    })

}

$('#notificaciones').on("click", function () {

    fetch('./obtenerSession.php')
        .then(session => session.json())
        .then(datos => {
            const notifiacionStatus = datos.notifiStatus;

            if (notifiacionStatus == "true") {    //Si el estatus es true quiere decir que estan activadas las notificaciones por ende hay que desactivarlas
                cancelarSuscripcion();
            }


        });


});