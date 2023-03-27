<?php
        
    include('../conexion.php');
    $email = $_POST['email'];
    $asunto = "Recuperar Contraseña";
    $mensaje = 'Este es un correo generado automáticamente para reestablecer la constraseña de su cuenta.<br>
                Por favor, visite la página <a href="localhost/SistemaWeb-Trazabilidad/loggin/changepsw.php?id='.$row[0].'">Sistema de trazabilidad</a>';

    
    $consulta = "SELECT * FROM usuarios where Correo = '$email'";
    $resultado = mysqli_query($enlace, $consulta);

    $row = mysqli_fetch_assoc($resultado);

    if($filas=mysqli_num_rows($resultado) > 1){
        //Create an instance; passing `true` enables exceptions
 

    try {
        if(mail($email, $asunto, $mensaje)){
            header("Location: ../index.php?message=ok");
        }
        
    } catch (Exception $e) {
        header("Location: ../index.php?message=error");
    }

    }else{
        header("Location: ../index.php?message=notfound");
    }
