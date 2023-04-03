<?php

include("../conexion.php");
session_start();

$comando = mysqli_query($enlace, "SELECT T.Descripcion FROM usuarios as U inner join tipousuario as T on U.IdtipoUsuario = T.Idtipousuario where U.Nombre = '" . $_SESSION['usuario'] . "'");
$tipoUser = mysqli_fetch_column($comando);
mysqli_free_result($comando);



if ($tipoUser == 'admin') {
    $distribuidor = 'admin';
}else{
    $distribuidor = $_SESSION['usuario'];
}


if (true) {
    include("../conexion.php");

    $queryOrden = "CALL OrdenConsulta('" .$distribuidor. "',null,null);";
    $comando = mysqli_query($enlace, $queryOrden);
    
    
    if (!$comando) {
        echo ("Hubo un error");
    } else {
        while ($datos = mysqli_fetch_assoc($comando)) {
            $consulta["data"][] = $datos;
        } 
        echo (json_encode($consulta));
    }
    mysqli_free_result($comando);
} else {

    $queryOrden = "CALL OrdenConsulta('" . $distribuidor . "','" . $_POST['FI'] . "','" . $_POST['FF'] . "');";
    $comando = mysqli_query($enlace, $queryOrden);
    if (!$comando) {
        die("Error");
    } else {
        while ($datos = mysqli_fetch_assoc($comando)) {
            $consultaOrden["data"][] = $datos;
        }
        echo (json_encode($consultaOrden));
    }

    mysqli_free_result($comando);
}

mysqli_close($enlace);

?>