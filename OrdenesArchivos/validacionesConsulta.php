<?php

include("../conexion.php");
session_start();

$comando = mysqli_query($enlace, "SELECT T.Descripcion FROM usuarios as U inner join tipousuario as T on U.IdtipoUsuario = T.Idtipousuario where U.Correo = '" . $_SESSION['usuario'] . "'");
$fila = mysqli_fetch_array($comando);
$tipoUser = $fila[0];
mysqli_free_result($comando);

$fechaCorrecta = false;

//Validación de fecha
if (($_POST['FI'] == "" && $_POST['FF'] != "") || ($_POST['FI'] != "" && $_POST['FF'] == "")) {
    echo ("FechaNoValida");
}else if($_POST['FI'] != "" && $_POST['FF'] != ""){
    $fecha1 = new DateTime($_POST['FI']);
    $fecha2 = new DateTime($_POST['FF']);
    if ($fecha1 > $fecha2) 
        echo ("FechaMayor");
    else if ($fecha1 == $fecha2) 
        echo ("FechasIguales");
    else {
        $fechaCorrecta = true;
    }
}
//Validación de consulta por fecha
if ($fechaCorrecta && $_POST['IdProdu'] == "") {
    switch ($_POST['movi']) {
        case 'ordenes':
                $queryOrden = "SELECT * FROM ordenproductos WHERE Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' LIMIT 1;";
            break;
        case 'entregas':
                $queryOrden = "SELECT * FROM entregas WHERE Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' LIMIT 1;";
            break;
        case 'extraviados':
                $queryOrden = "SELECT * FROM extraviados WHERE Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' LIMIT 1;";
            break;
        default:
            break;
    }

    $comando = mysqli_query($enlace, $queryOrden);

    if (mysqli_num_rows($comando) == 0) 
        echo ("NoHayDatosFechas");
    else 
        echo ("ConsultaXFecha");

    mysqli_free_result($comando);
}

//Validación de consulta a productor
if ($_POST['IdProdu'] != "" && ($_POST['FI'] == "" && $_POST['FF'] == "")) {
    switch ($_POST['movi']) {
        case 'ordenes':
                $queryOrden = "SELECT * FROM ordenproductos WHERE IdProductor = '" . $_POST['IdProdu'] . "' LIMIT 1;";
            break;
        case 'entregas':
                $queryOrden = "SELECT * FROM entregas WHERE IdProductor = '" . $_POST['IdProdu'] . "' LIMIT 1;";
            break;
        case 'extraviados':
                $queryOrden = "SELECT * FROM extraviados WHERE IdProductor = '" . $_POST['IdProdu'] . "' LIMIT 1;";
            break;
        default:
            break;
    }

    $comando = mysqli_query($enlace, $queryOrden);

    if (mysqli_num_rows($comando) == 0) 
        echo ("NoHayDatosProductor");
    else 
        echo ("ConsultaXProductor");
    mysqli_free_result($comando);
}

//Validación de consulta por fecha y productor
if ($_POST['IdProdu'] != "" && $fechaCorrecta ) {
    switch ($_POST['movi']) {
        case 'ordenes':
                $queryOrden = "SELECT * FROM ordenproductos WHERE IdProductor = '" . $_POST['IdProdu'] . "' AND Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' LIMIT 1;";
            break;
        case 'entregas':
                $queryOrden = "SELECT * FROM entregas WHERE IdProductor = '" . $_POST['IdProdu'] . "' LIMIT 1;";
            break;
        case 'extraviados':
                $queryOrden = "SELECT * FROM extraviados WHERE IdProductor = '" . $_POST['IdProdu'] . "' LIMIT 1;";
            break;
        default:
            break;
    }

    $comando = mysqli_query($enlace, $queryOrden);

    if (mysqli_num_rows($comando) == 0) 
        echo ("NoHayDatosProductorYFecha");
    else 
        echo ("ConsultaXFechaYProduct");
    mysqli_free_result($comando);
}

//Validación de consulta general
if ($tipoUser == 'admin' && $_POST['IdProdu'] == "" && $_POST['FF'] == "" && $_POST['FI'] == "") {
   
    switch ($_POST['movi']) {
        case 'ordenes':
                $queryOrden = "SELECT * FROM ordenproductos LIMIT 1;";
            break;
        case 'entregas':
                $queryOrden = "SELECT * FROM entregas LIMIT 1;";
            break;
        case 'extraviados':
                $queryOrden = "SELECT * FROM extraviados LIMIT 1;";
            break;
        default:
            break;
    }

    $comando = mysqli_query($enlace, $queryOrden);

    if (mysqli_num_rows($comando) == 0) 
        echo ("NoHayDatosGeneral");
    else 
        echo ("ConsultaGeneral");

    mysqli_free_result($comando);
}

//Validación de acceso
if ($tipoUser == 'admin' ) {

}elseif($tipoUser == 'Distribuidores' && ($_POST['movi'] == 'ordenes' || $_POST['movi'] == 'entregas') ){
    $comando = mysqli_query($enlace, "SELECT IdDistribuidor FROM distribuidores WHERE Correo = '".$_SESSION['usuario']."' ") or die(mysqli_error());
    if (mysqli_num_rows($comando) == 0)   //Valida si hay distribuidores registrados en la db
        echo ("NoHayDistribuidores");
    mysqli_free_result($comando);
}elseif($tipoUser == 'Productores' && ($_POST['movi'] == 'ordenes' || $_POST['movi'] == 'entregas' || $_POST['movi'] == 'extraviados')){
    $comando = mysqli_query($enlace, "SELECT IdProductor FROM productores WHERE Correo = '".$_SESSION['usuario']."' ") or die(mysqli_error());
    if (mysqli_num_rows($comando) == 0)   //Valida si hay distribuidores registrados en la db
        echo ("NoHayProductores");
    mysqli_free_result($comando);
}elseif($tipoUser == 'Empresa Recolectora' && $_POST['movi'] == 'entregas'){
    $comando = mysqli_query($enlace, "SELECT IdERP FROM empresarecolectoraprivada WHERE Correo = '".$_SESSION['usuario']."' ") or die(mysqli_error());
    if (mysqli_num_rows($comando) == 0)   //Valida si hay distribuidores registrados en la db
        echo ("NoHayERP");
    mysqli_free_result($comando);
}elseif($tipoUser == 'Municipios' && $_POST['movi'] == 'entregas'){
    $comando = mysqli_query($enlace, "SELECT IdMunicipio FROM municipio WHERE Correo = '".$_SESSION['usuario']."' ") or die(mysqli_error());
    if (mysqli_num_rows($comando) == 0)   //Valida si hay distribuidores registrados en la db
        echo ("NoHayMunicipio");
    mysqli_free_result($comando);
}elseif($tipoUser == 'CAT' && $_POST['movi'] == 'entregas'){
    $comando = mysqli_query($enlace, "SELECT IdCAT FROM centroacopiotemporal WHERE Correo = '".$_SESSION['usuario']."' ") or die(mysqli_error());
    if (mysqli_num_rows($comando) == 0)   //Valida si hay distribuidores registrados en la db
        echo ("NoHayCAT");
    mysqli_free_result($comando);
}else{
    echo ("UsuarioNoPermitido");
}

mysqli_close($enlace);

?>