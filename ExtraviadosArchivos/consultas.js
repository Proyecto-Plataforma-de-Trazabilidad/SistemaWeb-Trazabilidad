$(document).ready(function () {

    generarTabla();
});
function generarTabla() {

    $('#extraviados').DataTable({
        destroy:true,
        ajax: {
            "method":"POST",
            "url":"consultas.php",
            
        },
        columns:[
            {data: "IdExtraviados"},
            {data: "Nombre"},
            {data: "TipoEnvaseVacio"},
            {data: "CantidadPiezas"},
            {data: "Aclaracion"},
            {data: "fecha"},        
        ]
    });

}
