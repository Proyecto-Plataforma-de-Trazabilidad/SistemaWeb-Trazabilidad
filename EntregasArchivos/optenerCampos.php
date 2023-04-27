<?php
include("../conexion.php");
//verificar conexion
if ($enlace->connect_error) {
    //mandar mensaje y salir
    die("Conexion fallida: " . $enlace->connect_error);
} else { //si todo funciona correctamente

    session_start();

    $comando = mysqli_query($enlace, "SELECT count(*) from entregas");
    $entrega =  mysqli_fetch_column($comando) + 1;
    
    mysqli_free_result($comando);

    $comando = mysqli_query($enlace, "SELECT T.Descripcion, U.Nombre FROM usuarios as U inner join tipousuario as T on U.IdtipoUsuario = T.Idtipousuario where U.Correo = '" . $_SESSION['usuario'] . "'");
    $fila = mysqli_fetch_array($comando);
    $tipoRecolec = $fila[0];
    $nombreRecolec = $fila[1];
    mysqli_free_result($comando);
    $mensaje = "TodoCorrecto";
    //Validaciones de recolector
    switch ($tipoRecolec) {
        case 'Distribuidores':
            $comando = mysqli_query($enlace, "SELECT Nombre FROM distribuidores WHERE Correo = '".$_SESSION['usuario']."' ") or die(mysqli_error());
            if (mysqli_num_rows($comando) == 0)
                $mensaje = "NoHayDistribuidores";
            else{
                $fila = mysqli_fetch_array($comando);
                $ValidarNomRecole = $fila[0];
                if ($ValidarNomRecole != $nombreRecolec) 
                    $mensaje = "RecoleUsuarioNoValido";
            }
            mysqli_free_result($comando);
            break;
        case 'Empresa Recolectora':
            $comando = mysqli_query($enlace, "SELECT Nombre FROM empresarecolectoraprivada WHERE Correo = '".$_SESSION['usuario']."' ") or die(mysqli_error());
            if (mysqli_num_rows($comando) == 0)   //Valida si hay distribuidores registrados en la db
                $mensaje ="NoHayERP";
            else{
                $fila = mysqli_fetch_array($comando);
                $ValidarNomRecole = $fila[0];
                if ($ValidarNomRecole != $nombreRecolec) 
                    $mensaje ="RecoleUsuarioNoValido";
            }
            mysqli_free_result($comando);
            break;
        case 'Municipios':
            $comando = mysqli_query($enlace, "SELECT NombreLugar FROM municipio WHERE Correo = '".$_SESSION['usuario']."' ") or die(mysqli_error());
            if (mysqli_num_rows($comando) == 0)   //Valida si hay distribuidores registrados en la db
                $mensaje = "NoHayMunicipio";
            else{
                $fila = mysqli_fetch_array($comando);
                $ValidarNomRecole = $fila[0];
                if ($ValidarNomRecole != $nombreRecolec) 
                    $mensaje = "RecoleUsuarioNoValido";
            }
            mysqli_free_result($comando);
            break;
        case 'CAT':
            $comando = mysqli_query($enlace, "SELECT NombreCentro FROM centroacopiotemporal WHERE Correo = '".$_SESSION['usuario']."' ") or die(mysqli_error());
            if (mysqli_num_rows($comando) == 0)   //Valida si hay distribuidores registrados en la db
                $mensaje ="NoHayCAT";
            else{
                $fila = mysqli_fetch_array($comando);
                $ValidarNomRecole = $fila[0];
                if ($ValidarNomRecole != $nombreRecolec) 
                    $mensaje = "RecoleUsuarioNoValido";
            }
            mysqli_free_result($comando);
            break;
        default:
        $mensaje = "UsuarioNoPermitido";
            break;
    }

    $comando = mysqli_query($enlace, "SELECT * FROM productores") or die(mysqli_error());
    if (mysqli_num_rows($comando) == 0) {          //Valida si hay productores registrados en la db
        $productores = "No hay productores";
    }else {
        while($fila1 = mysqli_fetch_array($comando)){
            $productores[] = array(
                'IdProductor' => $fila1[0],
                'Nombre' => $fila1[1]
            );
        }
    }
    mysqli_free_result($comando);


        $datos = json_encode(array('mensaje' => $mensaje, 'entrega' => $entrega, 'tipoRecol'=> $tipoRecolec, 'nomRecol'=> $nombreRecolec,'produtores' => $productores));
        echo $datos;
    

    
    mysqli_close($enlace);
}

?>