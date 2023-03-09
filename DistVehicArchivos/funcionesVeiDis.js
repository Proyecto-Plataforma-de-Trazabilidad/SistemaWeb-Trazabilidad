$(document).ready(function(){

    function combodist(){
        let tipoFuncion="combo1";
        let parametros={"tipo":tipoFuncion}
        $.ajax({
            url:'DistVehicArchivos/metodosDistVehic.php',
            data:parametros,
            type:'POST',
            success:function(response){
                $('#indist').html(response);
            }
        });
    }
    combodist();

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