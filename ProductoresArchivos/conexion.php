<?php

    $host="Localhost";
    $puerto="3306";
    $usuario="root";
    $contrasena="";
    $baseDeDatos="apeajaldb";

    $enlace=mysqli_connect($host.":".$puerto, $usuario, $contrasena, $baseDeDatos);
    if(!$enlace)
    {
        echo "Error no se pudo conectar a MySQL.".PHP_EOL;
        echo "Errno de depuracion: ".mysqli_connect_errno().PHP_EOL;
        echo "Error de depuracion: ".mysqli_connect_error().PHP_EOL;
        exit();
    }
?>