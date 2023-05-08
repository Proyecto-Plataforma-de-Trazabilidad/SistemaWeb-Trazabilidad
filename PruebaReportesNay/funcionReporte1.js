$(document).ready(function(){

    $.ajax({
        url:'PruebaReportesNay/metodoReporte1.php',
        type:'POST',
        data: {"tipo":"combo1"},
        success:function(response){
            $('#inprod').html(response);
        }
    });
    

   

    window.addEventListener('resize', function(event){
        $('#tabla').DataTable().fnDestroy();
        $('#tabla').DataTable({
            scrollX:true,
        });
    },true);

    

});