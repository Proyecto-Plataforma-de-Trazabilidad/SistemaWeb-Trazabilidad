$(document).ready(function(){

    $.ajax({
        url:'ProductoresArchivos/metodosProd.php',
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
        $('#tabla').DataTable({
            scrollX:true,
            destroy:true, //Este parámetro permite volver a generar el DataTable destruyendo la que ya estaba para que no se pisen
        });
    },true);


    $('#frm').submit(function(e){
        e.preventDefault();
        let formData = new FormData(this); //Este método trae todos los datos del form sin necesidad de leer el valor de cada campo
        formData.append("tipo", "registrar");

        $.ajax({
            url:'ProductoresArchivos/metodosProd.php',
            data:formData,
            type:'POST',
            contentType: false,
            cache: false,
            processData:false,
            success:function(response){
                $('#bodyTabla').html(response);
                // $('#tabla').DataTable({   //No necesita volver a convertir la tabla en DataTable 
                //     scrollX:true,
                //     destroy:true,
                // });
            }
        });
        
        $('#frm').trigger('reset');
        
    });

});