<?php

include("../conexion.php");
session_start();

$comando = mysqli_query($enlace, "SELECT T.Descripcion FROM usuarios as U inner join tipousuario as T on U.IdtipoUsuario = T.Idtipousuario where U.Nombre = '".$_SESSION['usuario']."'");
$tipoUser =  mysqli_fetch_column($comando);
mysqli_free_result($comando);
 
    if ($_POST['FI'] == null && $_POST['FF'] == null) {
        
        $queryOrden = "CALL OrdenConsulta('".$tipoUser."',null,null);";
        $comando = mysqli_query($enlace, $queryOrden);
        
        if(empty(mysqli_fetch_assoc($comando))) {
            echo ("Hubo un error");
        }else{
            while ($datos = mysqli_fetch_assoc($comando)) {
                $consultaOrden["data"][] = $datos;
            }
            echo (json_encode($consultaOrden));
        }
        mysqli_free_result($comando);
    } else {
        
        $queryOrden = "CALL OrdenConsulta('".$tipoUser."','" .$_POST['FI']. "','" . $_POST['FF'] . "');";
        $comando = mysqli_query($enlace, $queryOrden);
        if(!$comando) {
            die("Error");
        }else{
            while ($datos = mysqli_fetch_assoc($comando)) {
                $consultaOrden["data"][] = $datos;
            }
        echo (json_encode($consultaOrden));
        }

        mysqli_free_result($comando);
    }

mysqli_close($enlace);

?>