$(document).ready(function(){

    $.ajax({
        url:'ProductoresArchivos/metodosProd.php',
        type:'POST',
        data: {"tipo":""},
        success:function(response){
            $('#bodyTabla').html(response);
            $('#tabla').DataTable({
                scrollX:true,
            });
        }
    });

    $('#frm').submit(function(e){
        e.preventDefault();
        let nom=document.getElementById("innom").value;
        let reg=document.getElementById("inreg").value;
        let dom=document.getElementById("indom").value;
        let cp=document.getElementById("incp").value;
        let ciu=document.getElementById("inciu").value;
        let muni=document.getElementById("inmuni").value;
        let est=document.getElementById("inest").value;
        let tel=document.getElementById("intel").value;
        let corr=document.getElementById("incorr").value;
        let puntos=document.getElementById("inpuntos").value;
        let orden=document.getElementById("inorden").value;
        let entrega=document.getElementById("inentrega").value;
        let giro=document.getElementById("ingiro").value;
        let tipofuncion="registrar";
        let parametros={"nom":nom, "reg":reg, "dom":dom, "cp":cp,"ciu":ciu, 
                        "muni":muni, "est":est, "tel":tel, "corr":corr, 
                        "puntos":puntos,"orden":orden,"entrega":entrega,
                        "giro":giro, "tipo":tipofuncion}
        $.ajax({
            url:'ProductoresArchivos/metodosProd.php',
            data:parametros,
            type:'POST',
            success:function(response){
                $('#bodyTabla').html(response);
                $('#tabla').DataTable({
                    scrollX:true,
                });
            }
        });
        
        $('#frm').trigger('reset');
    });

});