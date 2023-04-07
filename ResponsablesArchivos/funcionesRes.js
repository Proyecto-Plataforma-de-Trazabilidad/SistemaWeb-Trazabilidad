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

    $.ajax({
        type: "POST",
        url: "procesar-estados.php",
        data: { estados : "Mexico" } 
        }).done(function(data){
        $("#jmr_contacto_estado").html(data);
        });
        // Obtener municipios
        $("#jmr_contacto_estado").change(function(){
        var estado = $("#jmr_contacto_estado option:selected").val();
        $.ajax({
        type: "POST",
        url: "procesar-estados.php",
        data: { municipios : estado } 
        }).done(function(data){
        $("#jmr_contacto_municipio").html(data);
        });
        });



    $('#frm').submit(function(e){
        e.preventDefault();
        console.log("paso por aqui");
        let nom=document.getElementById("innombre").value;
        let dom=document.getElementById("indom").value;
        let cp=document.getElementById("incp").value;
        let muni=document.getElementById("jmr_contacto_municipio").value;
        let est=document.getElementById("jmr_contacto_estado").value;
        let tel=document.getElementById("intel").value;
        let corr=document.getElementById("incorr").value;
        let edo=document.getElementById("inestado").value;
        let tipofuncion="registrar";
        console.log("Me vale madres");
        let parametros={"nom":nom, "dom":dom, "cp":cp, "muni":muni, "est":est, "tel":tel, "corr":corr, "edo":edo, "tipo":tipofuncion}
        $.ajax({
            url:'ResponsablesArchivos/metodosRes.php',
            data:parametros,
            type:'POST',
            contentType: false,
            cache: false,
            processData:false,
            datatype: "json",
            success:function(data){ //!!!Las respuestas que reciba de la petición se deben imprimir con sweetalerts
                if(data == "null"){
                  Swal.fire({
                      icon: 'error',
                      title: 'No se pudo realizar el insert',
                    });
                }else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Se a hecho el registro correctamente',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'yeiiiii'
                    }).then((result) => {
                        if(result.value){
                        registrarUsuario();  //Funcion para hacer el registro del usuario con los datos del form
                        }
                    });
                  }
                }
            });

            function registrarUsuario() {
                //console.log(formData);
                formData.append("tipousuario", "11");
      
                $.ajax({
                    url:'UserArchivos/nuevoRegistrar.php',
                    data:formData,
                    type:'POST',
                    contentType: false,
                    cache: false,
                    processData:false,
                    datatype: "json",
                    success:function(data){
                        if(data == "null"){
                            Swal.fire({
                                icon: 'error',
                                title: 'Error al registrar al nuevo usuario',
                            })
                        }else {
                            Swal.fire({
                              icon: 'success',
                              title: 'El usuario se a creado correctamente',
                              confirmButtonColor: '#3085d6',
                              confirmButtonText: 'Okiiiii'
                            }).then((result) => {
                              if (result.value) {
                                window.location.href = "ResponsableCAT.php";
                              }
                            });
                          }
                    }
                });
              }
    
        });
    });
