$(document).ready(function(){

    function combocat(){
        let tipoFuncion="combo1";
        let parametros={"tipo":tipoFuncion}
        $.ajax({
            url:'Contenedores-Archivos/metodosCont.php',
            data:parametros,
            type:'POST',
            success:function(response){
                $('#intipocont').html(response);
            }
        });
    }
    combocat();

    $.ajax({
        url:'Contenedores-Archivos/metodosCont.php',
        data:{"tipo":""},
        type:'POST',
        success:function(response){
            $('#bodyTabla').html(response);
            $('#tabla').DataTable({
                scrollX:true,
            });
        }
    });
    window.addEventListener('resize', function(event){
        $('#tabla').DataTable().fnDestroy();
        $('#tabla').DataTable({
            scrollX:true,
        });
    },true);
});

