$(document).ready(function(){
    $.ajax({
        url:'ErpVehiculosArchivos/metodosErpVehiculos.php',
        type:'POST',
        data: {"tipo":""},
        success:function(response){
            $('#bodyTabla').html(response);
            $('#tabla').DataTable({
                scrollX:true,
            });
        }
    });
});