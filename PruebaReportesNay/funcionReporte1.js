$(document).ready(function(){

    $.ajax({
        url:'PruebaReportesNay/metodoReporte1.php',
        type:'POST',
        data: {"tipo":"combo1"},
        success:function(response){
            $('#inprod').html(response);
        }
    });
    
   

    $('#frm').submit(function(e){
        e.preventDefault();
        
        let prod=document.getElementById("inprod").value;
        let tipofuncion="registrar";

        console.log(prod);
        console.log(tipofuncion);

        let parametros={"prod":prod,"tipo":tipofuncion}

        console.log(parametros);
        $.ajax({
            url:'PruebaReportesNay/metodoReporte1.php',
            data:parametros,
            type:'POST',
            success:function(response){
               
            
               console.log(response);
            
            }
        });
        $('#frm').trigger('reset');

    });



});