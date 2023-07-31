<?php
    session_start();
    include "../conexion.php";

        $usuario=(isset($_POST['user'])) ? $_POST['user'] : '';
        $contra=(isset($_POST['pass'])) ? $_POST['pass'] : '';

        $pass = md5($contra); //Se encripta la contraseña enviada por el usuario para compararla con la de la BD


    $consulta="SELECT IdUsuario  FROM usuarios WHERE Correo='".$usuario."' AND Contrasena='".$pass."'";
    $resultado=mysqli_query($enlace,$consulta);
    
    
    if($filas=mysqli_num_rows($resultado) >= 1){
        $data = mysqli_fetch_array($resultado);
        $_SESSION["idUsuario"]=$data[0];
        $_SESSION["usuario"]=$usuario;
        $_SESSION["notifiStatus"]="false"; ///!!!Nose
    }
    else{
        $_SESSION["usuario"]= null;
        $data = null;
    }

    print json_encode($data);

    mysqli_close($enlace);
        
        
?>