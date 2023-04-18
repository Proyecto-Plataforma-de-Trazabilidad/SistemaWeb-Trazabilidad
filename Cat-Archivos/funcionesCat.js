$(document).ready(function(){

    $.ajax({
        url:'Cat-Archivos/metodosCat.php',
        type:'POST',
        data: {"tipo":""},
        success:function(response){
            $('#bodyTabla').html(response);
            $('#tabla').DataTable({
                scrollX:true,
            });
        }
    });

    function combocat(){
        let tipoFuncion="combo1";
        let parametros={"tipo":tipoFuncion}
        $.ajax({
            url:'Cat-Archivos/metodosCat.php',
            data:parametros,
            type:'POST',
            success:function(response){
                $('#inres').html(response);
            }
        });
    }
    combocat();
 


    $('#frm').submit(function(e){
        e.preventDefault();
        let res=document.getElementById("inres").value;
        let nom=document.getElementById("innom").value;
        let nra=document.getElementById("inNra").value;
        let des=document.getElementById("info").value;
        let dom=document.getElementById("indom").value;
        let cp=document.getElementById("incp").value;
        let muni=document.getElementById("inmuni").value;
        let est=document.getElementById("inest").value;
        let tel=document.getElementById("intel").value;
        let corr=document.getElementById("incorr").value;
        let hor=document.getElementById("inhor").value;
        let lat=document.getElementById("inlat").value;
        let lon=document.getElementById("inlon").value;
        let plan=document.getElementById("inplan").value;
        let tipofuncion="registrar";
        let parametros={"res":res,"nom":nom, "nra":nra, "des":des, "dom":dom, "cp":cp, "muni":muni, "est":est, "tel":tel, "corr":corr, "hor":hor, "lat":lat,"lon":lon, "plan":plan, "tipo":tipofuncion}
        if(nra.length>10){
        alert("El campo: Numero de registro ambiental, es invalido");
        return false;
        }   
        if(cp.length>5 || cp.length<5){
        alert("El campo: Código postal, es invalido");
        return false;
        }
        if(tel.length>10 || tel.length<10){
        alert("El campo: Telefono, es invalido");
        return false;
        }
        $.ajax({
            url:'Cat-Archivos/metodosCat.php',
            data:parametros,
            type:'POST',
            success:function(response){
                $('#bodyTabla').html(response);
                tabla.ajax.reload();
            }
        });
        $('#frm').trigger('reset');
        
    });
});