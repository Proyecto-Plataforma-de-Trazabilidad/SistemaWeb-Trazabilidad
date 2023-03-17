$('#aceptar').click(function () {
    var fi = document.getElementById('fechaInicio').value;
    var fechaFin = document.getElementById('fechafin').value;

    if ((fi === '') && (fechaFin === '')) {
        //cargar orden
        $.ajax({
            url: 'metodosConsulta.php',
            type: 'POST',
            data: { 'tipo': 'orden', 'FI': null, 'FF': null },
            success: function (response) {
                $('#bodyTabla1').html(response);
            },
        });
    }
    else {
        //cargar orden
        $.ajax({
            url: 'metodosConsulta.php',
            type: 'POST',
            data: { 'tipo': 'orden', 'FI': fi, 'FF': fechaFin },
            success: function (response) {
                $('#bodyTabla1').html(response);
            },
        });
    }

    $.ajax({
        url: 'metodosConsulta.php',
        type: 'POST',
        data: { tipo: 'detalle' },
        success: function (response) {
            $('#bodyTabla2').html(response);
        },
    });
});

$('#iconDetalle').click(function (evento) { });
