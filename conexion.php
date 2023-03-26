<?php
    $host="aws-dbinstance.cagy0earnfql.us-east-2.rds.amazonaws.com";
    $puerto="3306";
    $usuario="admin";
    $contrasena="Te-k3li-L!";
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