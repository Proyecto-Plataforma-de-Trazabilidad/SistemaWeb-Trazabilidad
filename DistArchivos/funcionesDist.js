$(document).ready(function(){

    $.ajax({
        url:'DistArchivos/metodosDist.php',
        data:{"tipo":""},
        type:'POST',
        success:function(response){
            $('#bodyTabla').html(response);
            $('#tabla').DataTable({
                scrollX:true,
            });
        }
    });

    $('#frm').submit(function(e){
        e.preventDefault();
        let formData = new FormData(this); //Este método trae todos los datos del form sin necesidad de leer el valor de cada campo
        
        $.ajax({
            url:'DistArchivos/Insertar.php',
            data:formData,
            type:'POST',
            contentType: false,
            cache: false,
            processData:false,
            datatype: "json",
            success:function(data){ //!!!Las respuestas que reciba de la petición se deben imprimir con sweetalerts
              if(data == "null"){
                Swal.fire({
                    icon: 'error',
                    title: 'Seleccione los 3 archivos validos',
                  });
              } else if(data == "extension"){
                Swal.fire({
                    icon: 'warning',
                    title: 'Solo se permiten archivos con extensión .pdf .jpg .jpeg .png',
                });
              } else if(data == "error"){
                Swal.fire({
                    icon: 'error',
                    title: 'Error al subir el archivo',
                });
              } else if(data == "server fail"){
                Swal.fire({
                    icon: 'error',
                    title: 'Hay un error con el servidor',
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
            formData.append("tipousuario", "3");
  
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
                            window.location.href = "Distribuidores.php";
                          }
                        });
                      }
                }
            });
          }

    });
});