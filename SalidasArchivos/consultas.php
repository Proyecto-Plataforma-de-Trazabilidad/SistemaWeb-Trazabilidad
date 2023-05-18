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

    if ($tipoUser == 'Distribuidores') {
        //productor
        $comando = mysqli_query($enlace, "SELECT IdDistribuidor, Nombre FROM distribuidores WHERE  Correo = '" . $correo . "' ") or die(mysqli_error());
        if (mysqli_num_rows($comando) == 0) { //Valida si hay productores registrados en la db
            echo ('SinDistribuidor');
        } else {
            $filaProd = mysqli_fetch_array($comando);
            $idDistribuidor = $filaProd[0];
        }
        mysqli_free_result($comando);

        $query = "SELECT S.IdSalida, S.IdContenedor, C.Origen, U.Nombre, S.Responsable, S.Cantidad, S.fecha FROM salidas as S inner join contenedores as C on S.IdContenedor= C.IdContenedor inner join usuarios as U on S.IdUsuario = U.IdUsuario inner join distribuidores as D on U.Correo = D.Correo where D.IdDistribuidor= " . $idDistribuidor;
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

    } else if ($tipoUser == 'Municipios') {
        //productor
        $comando = mysqli_query($enlace, "SELECT IdMunicipio, NombreLugar FROM municipio WHERE  Correo = '" . $correo . "' ") or die(mysqli_error());
        if (mysqli_num_rows($comando) == 0) { //Valida si hay productores registrados en la db
            echo ('SinProductor');
        } else {
            $filaProd = mysqli_fetch_array($comando);
            $idMunicipio = $filaProd[0];
        }
        mysqli_free_result($comando);

        $query = "SELECT S.IdSalida, S.IdContenedor, C.Origen, U.Nombre, S.Responsable, S.Cantidad, S.fecha FROM salidas as S inner join contenedores as C on S.IdContenedor= C.IdContenedor inner join usuarios as U on S.IdUsuario = U.IdUsuario inner join municipio as M on U.Correo = M.Correo where M.IdMunicipio= " . $idMunicipio;
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

    } else if ($tipoUser == 'Empresa Recolectora') {
        //productor
        $comando = mysqli_query($enlace, "SELECT IdERP, Nombre FROM empresarecolectoraprivada WHERE  Correo = '" . $correo . "' ") or die(mysqli_error());
        if (mysqli_num_rows($comando) == 0) { //Valida si hay productores registrados en la db
            echo ('SinProductor');
        } else {
            $filaProd = mysqli_fetch_array($comando);
            $idERP = $filaProd[0];
        }
        mysqli_free_result($comando);

        $query = "SELECT S.IdSalida, S.IdContenedor, C.Origen, U.Nombre, S.Responsable, S.Cantidad, S.fecha FROM salidas as S inner join contenedores as C on S.IdContenedor= C.IdContenedor inner join usuarios as U on S.IdUsuario = U.IdUsuario inner join empresarecolectoraprivada as E on U.Correo = E.Correo where E.IdMunicipio= " . $idERP;
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
        $query = "SELECT S.IdSalida, S.IdContenedor, C.Origen, U.Nombre, S.Responsable, S.Cantidad, S.fecha FROM salidas as S inner join contenedores as C on S.IdContenedor= C.IdContenedor inner join usuarios as U on S.IdUsuario = U.IdUsuario";
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