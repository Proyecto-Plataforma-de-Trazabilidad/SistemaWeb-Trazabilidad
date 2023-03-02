$(document).ready(function(){
    $.ajax({
        url:'DistVehicArchivos/metodosDistVehic.php',
        type:'POST',
        data: {"tipo":""},
        success:function(response){
            $('#bodyTabla').html(response);
            $('#tabladistv').DataTable({
                scrollX:true,
            });
        }
    });
});