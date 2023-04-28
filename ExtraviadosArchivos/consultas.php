<?php
include("../conexion.php");

session_start();


if (isset($_SESSION['usuario'])) {
    $correo = $_SESSION['usuario'];
    //tipo de usuario
    $comando = mysqli_query($enlace, "SELECT T.Descripcion FROM usuarios as U inner join tipousuario as T on U.IdtipoUsuario = T.Idtipousuario where U.Correo = '" . $correo . "'");
    $fila = mysqli_fetch_array($comando);
    $tipoUser = $fila[0];
    //echo($tipoUser);
    mysqli_free_result($comando);

    if ($tipoUser == 'Productores') {
        //productor
        $comando = mysqli_query($enlace, "SELECT IdProductor, Nombre FROM productores WHERE  Correo = '" . $correo . "' ") or die(mysqli_error());
        if (mysqli_num_rows($comando) == 0) { //Valida si hay productores registrados en la db
            echo ('SinProductor');
        } else {
            $filaProd = mysqli_fetch_array($comando);
            $idProductor = $filaProd[0];
        }
        mysqli_free_result($comando);

        $query = "SELECT E.IdExtraviados, P.Nombre, E.TipoEnvaseVacio, E.CantidadPiezas, E.Aclaracion, E.fecha FROM extraviados as E inner join productores as P on E.IdProductor = P.IdProductor where P.IdProductor = " . $idProductor;
        $comando = mysqli_query($enlace, $query);
        //echo ($resultado);
        if (mysqli_num_rows($comando) == 0) {
            echo ("Error");
        } else {
            while ($datos = mysqli_fetch_assoc($comando)) {
                $consulta["data"][] = $datos;
            }
            echo (json_encode($consulta));
        }
        mysqli_free_result($comando);

    } else if ($tipoUser == 'admin') {
        $query = "SELECT E.IdExtraviados, P.Nombre, E.TipoEnvaseVacio, E.CantidadPiezas, E.Aclaracion, E.fecha FROM extraviados as E inner join productores as P on E.IdProductor = P.IdProductor";
        $comando = mysqli_query($enlace, $query);
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
        echo ("TipoUsuario");
        
    }


    mysqli_close($enlace);
} else {
    echo ('la variable de usuario no entro correctamente');
}





?>