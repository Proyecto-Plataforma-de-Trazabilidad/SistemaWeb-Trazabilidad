$(document).ready(function(){

    $.ajax({
        url:'DestinoArchivos/metodosDestino.php',
        data:{"tipo":""},
        type:'POST',
        success:function(response){
            $('#bodyTabla').html(response);
            $('#tabla').DataTable({
                scrollX:true,
            });
        }
    });

});