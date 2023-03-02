$(document).ready(function(){

    $.ajax({
        url:'MunicipioArchivos/metodosMuni.php',
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