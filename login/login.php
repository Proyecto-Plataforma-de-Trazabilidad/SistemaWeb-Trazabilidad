<?php
    session_start();
    
    include 'conexion.php';

    $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
    $psw = (isset($_POST['psw'])) ? $_POST['psw'] : '';

    $pass = md5($psw); //Se encripta la contraseña enviada por el usuario para compararla con la de la BD
    
    $consulta = "SELECT * FROM usuarios WHERE Nombre = '$usuario' AND  Contrasena = '$pass'";
    $resultado = mysqli_query($enlace, $consulta);
    $res = mysqli_fetch_array($resultado);

    if($res >= 1){
        $data = $res;
        $_SESSION["usuario"] = $usuario;
    }else{
        $_SESSION["usuario"] = null;
        $data = null;

    }
    
    print json_encode($data);

?>