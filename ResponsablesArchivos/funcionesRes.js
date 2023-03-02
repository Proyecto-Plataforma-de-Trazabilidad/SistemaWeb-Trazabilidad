$(document).ready(function(){

    $.ajax({
        url:'ResponsablesArchivos/metodosRes.php',
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
        console.log("paso por aqui");
        let nom=document.getElementById("innombre").value;
        let dom=document.getElementById("indom").value;
        let cp=document.getElementById("incp").value;
        let muni=document.getElementById("inmuni").value;
        let est=document.getElementById("inedo").value;
        let tel=document.getElementById("intel").value;
        let corr=document.getElementById("incorr").value;
        let edo=document.getElementById("inestado").value;
        let tipofuncion="registrar";
        if(cp.length<5 || cp.length>5){
            alert("El campo: Código postal, debe ser de 5 digitos");
            return false;
        }
        if(tel.length<10 || cp.length>10){
            alert("El campo: Código postal, debe ser de 10 digitos");
            return false;
        }
        let parametros={"nom":nom, "dom":dom, "cp":cp, "muni":muni, "est":est, "tel":tel, "corr":corr, "edo":edo, "tipo":tipofuncion}
        $.ajax({
            url:'ResponsablesArchivos/metodosRes.php',
            data:parametros,
            type:'POST',
            success:function(response){
                $('#bodyTabla').html(response);
                $('#tabla').DataTable();
            }
        });
        
        $('#frm').trigger('reset');
        //window.location.reload(true);
    });

});