<?php

    $host="aws-dbinstance.cagy0earnfql.us-east-2.rds.amazonaws.com";
    $usuario="admin";
    $contrasena="Te-k3li-L!";
    $baseDeDatos="apeajaldb";

    //Establecer conexion con la base de datos
    $conn = mysqli_connect($host, $usuario, $contrasena, $baseDeDatos);

    //Verificar la conexion
    if(!$conn){
        die("Error al conectar a la base de datos: ".mysqli_connect_error());
    }

    //Obtener las credenciales enviadas desde la aplicación de React Native
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    //Transformar la contraseña a MD5
    $psw = md5($password);

    //Realizar la consulta para verificar las credenciales
    $query = "SELECT * From usuarios where Correo = '$email' AND Contrasena = '$psw'";
    $resultado = mysqli_query($conn, $query);

    //Verificar si se encontró el usuario
    if(mysqli_num_rows($resultado) > 0){
        //Los datos son correctos, se puede iniciar sesión
        $response = array("success" => true, "message" => "Inicio de sesión exitoso");

    } else{
        //Los datos no son válidos, no se puede iniciar sesión
        $response = array("success" => false, "message" => "Datos inválidos. Intentar de nuevo");
    }

    //Devolver la respuesta como JSON
    echo json_encode($response);

    //Cerrar la conexión
    mysqli_close($conn);


?>