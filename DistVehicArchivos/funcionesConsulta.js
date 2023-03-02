$(document).ready(function(){
    $('#btnGuardar').click(function(e){
        let conc=document.getElementById("inconc").value;
        let des=document.getElementById("indes").value;
        let tipo=document.getElementById("intipo").value;
        let cap=document.getElementById("incap").value;
        let marca=document.getElementById("inmarca").value;
        let placa=document.getElementById("inplaca").value;

        let tipofuncion="actualizar";
        let parametros={"conc":conc,"des":des,"tipo":tipo,"cap":cap,"marca":marca, "placa":placa, "tipo":tipofuncion}
        $.ajax({
            url:'metodosDistVehic.php',
            data:parametros,
            type:'POST',
        });
    });

    $('#btnEditar').click(function(e){
        console.log("Paso aqui");
        document.getElementById("inconc").disabled=false;
        document.getElementById("indes").disabled=false;
        document.getElementById("intipo").disabled=false;
        document.getElementById("incap").disabled=false;
        document.getElementById("inmarca").disabled=false;
        document.getElementById("inplaca").disabled=false;
    });

});