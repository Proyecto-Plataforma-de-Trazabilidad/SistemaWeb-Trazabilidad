$(document).ready(function(){

    function comboerp() {
        let tipoFuncion = "combo1";
        let parametros = {"tipo":tipoFuncion}
        $.ajax({
            url:'ErpVehiculosArchivos/metodosErpVehiculos.php',
            data:parametros,
            type: 'POST',
            success:function(response){
                $('#inerp').html(response);
            }
        });
    }
    comboerp();

    $.ajax({
        url: 'ErpVehiculosArchivos/metodosErpVehiculos.php',
        data: {"tipo":""},
        type: 'POST',
        success:function(response){
            $('#bodytabla').html(response);
            $('#tabla').DataTable({
                scrollX:true,
            });
        }
    });
});