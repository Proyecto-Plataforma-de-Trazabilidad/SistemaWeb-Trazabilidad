$(document).ready(function(){

    $.ajax({
        url:'UserArchivos/metodosUser.php',
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