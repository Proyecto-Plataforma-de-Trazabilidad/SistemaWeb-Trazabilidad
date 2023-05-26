<?php
    session_start();
    include "../conexion.php";

        $json = file_get_contents('php://input');

        $obj = json_decode($json,true);

        $email = $obj['email'];
        $password = $obj['password'];


        $pass = md5($password); //Se encripta la contraseña enviada por el usuario para compararla con la de la BD


    $consulta="SELECT * FROM usuarios WHERE Correo='".$email."' AND Contrasena='".$pass."'";
    $resultado=mysqli_query($enlace,$consulta);
    
    
    if($filas=mysqli_num_rows($resultado) >= 1){
        $data = mysqli_fetch_all($resultado);
        $_SESSION["usuario"]=$email;
    }
    else{
        $_SESSION["usuario"]= null;
        $data = null;
    }
    
    echo json_encode("Usuario logeado");
    print json_encode($data);
    

    mysqli_close($enlace);
        
        
?>