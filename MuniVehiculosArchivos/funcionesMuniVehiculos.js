$(document).ready(function(){
    $.ajax({
        url:'MuniVehiculosArchivos/metodosMuniVehiculos.php',
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