<?php
    include "conexion.php";

        $usuario=(isset($_POST['user'])) ? $_POST['user'] : '';
        $contra=(isset($_POST['pass'])) ? $_POST['pass'] : '';

    $consulta="SELECT * FROM usuarios WHERE Nombre='".$usuario."' AND Contrasena='".$contra."'";
    $resultado=mysqli_query($enlace,$consulta);
    

    if($filas=mysqli_num_rows($resultado) >= 1){
        session_start();
        $_SESSION["usuario"]=$usuario;
    }
    else{
        $_SESSION["usuario"]= null;
        $data = null;
    }

    print json_encode($data);

    mysqli_close($enlace);
        
        
?>