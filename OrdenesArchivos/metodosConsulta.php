<?php

include("../conexion.php");
session_start();

$comando = mysqli_query($enlace, "SELECT T.Descripcion FROM usuarios as U inner join tipousuario as T on U.IdtipoUsuario = T.Idtipousuario where U.Correo = '" . $_SESSION['usuario'] . "'");
$tipoUser = mysqli_fetch_column($comando);
mysqli_free_result($comando);



if ($tipoUser == 'admin') {
    $distribuidor = 'admin';
    
}elseif($tipoUser == 'Distribuidores'){

    $comando = mysqli_query($enlace, "SELECT Nombre FROM distribuidores WHERE  Correo = '".$_SESSION['usuario']."' ") or die(mysqli_error());
    if (mysqli_num_rows($comando) != 0)   //Valida si hay distribuidores registrados en la db
        $distribuidor = mysqli_fetch_column($comando);

}


if (true) {
    include("../conexion.php");

    $queryOrden = "CALL OrdenConsulta('" .$distribuidor. "',null,null);";
    $comando = mysqli_query($enlace, $queryOrden);
    
    
    if (mysqli_num_rows($comando) == 0) {
        echo ("Error");
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
    if (mysqli_num_rows($comando) == 0) {
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