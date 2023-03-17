$('#aceptar').click(function () {

    

    var fi = document.getElementById('fechaInicio').value;
    var fechaFin = document.getElementById('fechafin').value;

    if (fi === '' && fechaFin === '') {
        //window.location.reload();
        //cargar orden
        $.ajax({
            url: 'metodosConsulta.php',
            type: 'POST',
            data: { tipo: 'orden', FI: null, FF: null },
            success: function (response) {
                $('#bodyTabla1').html(response);
                $('#orden').DataTable({
                    scrollX: true,
                });
            },
        });
        window.addEventListener('resize', function(event){
            $('#orden').DataTable().fnDestroy();
            $('#orden').DataTable({
                scrollX:true,
            });
        },true);
    } else {
        //window.location.reload();
        //cargar orden
        $.ajax({
            url: 'metodosConsulta.php',
            type: 'POST',
            data: { tipo: 'orden', FI: fi, FF: fechaFin },
            success: function (response) {
                $('#bodyTabla1').html(response);
                $('#orden').DataTable({
                    scrollX: true,
                });
            },
        });
        window.addEventListener('resize', function(event){
            $('#orden').DataTable().fnDestroy();
            $('#orden').DataTable({
                scrollX:true,
            });
        },true);
    }

    $.ajax({
        url: 'metodosConsulta.php',
        type: 'POST',
        data: { tipo: 'detalle' },
        success: function (response) {
            $('#bodyTabla2').html(response);
            $('#detalle').DataTable({
                scrollX: true,
            });
        },
    });
    window.addEventListener('resize', function(event){
        $('#orden').DataTable().fnDestroy();
        $('#orden').DataTable({
            scrollX:true,
        });
    },true);
});

$('#iconDetalle').click(function (evento) { });
