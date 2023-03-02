$(document).ready(function(){
    function combocat(){
        let tipoFuncion="combo2";
        let parametros={"tipo":tipoFuncion}
        $.ajax({
            url:'metodosCont.php',
            data:parametros,
            type:'POST',
            success:function(response){
                $('#intipocont').html(response);
            }
        });
    }
    $('#btnEditar').click(function(e){
        combocat();
    });
    $('#btnGuard').click(function(e){
        let idcon=document.getElementById("inid").value;
        let des=document.getElementById("indes").value;
        let cap=document.getElementById("incap").value;
        let ulti=document.getElementById("inulti").value;
        let lat=document.getElementById("inlat").value;
        let man=document.getElementById("inman").value;
        document.getElementById("indes").disabled=true;
        document.getElementById("incap").disabled=true;
        document.getElementById("inulti").disabled=true;
        document.getElementById("inlat").disabled=true;
        document.getElementById("inman").disabled=true;
        document.getElementById("btnGuardar").disabled=true;
        document.getElementById("btnEditar").disabled=true;
        let tipofuncion="actualizar";
        let parametros={"idcon":idcon, "des":des, "cap":cap,"ulti":ulti, "lat":lat, "man":man, "tipo":tipofuncion}
        $.ajax({
            url:'metodosCont.php',
            data:parametros,
            type:'POST',
        });
    });

    $('#borrar').click(function(e){
        let tipofuncion="borrar";
        let idcat=document.getElementById("incat").value;
        let parametros={"idcat":idcat, "tipo":tipofuncion};
        $.ajax({
            url:'metodosCat.php',
            data:parametros,
            type:'POST',
        });

    });
});