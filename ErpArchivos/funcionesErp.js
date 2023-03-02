$(document).ready(function(){

    $.ajax({
        url:'ErpArchivos/metodosErp.php',
        data:{"tipo":""},
        type:'POST',
        success:function(response){
            $('#bodyTabla').html(response);
            $('#tablaCAT').DataTable({
                scrollX:true,
            });
        }
    });
});