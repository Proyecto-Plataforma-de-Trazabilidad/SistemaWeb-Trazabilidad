<?php

include("../conexion.php");
session_start();

$comando = mysqli_query($enlace, "SELECT T.Descripcion, U.IdUsuario FROM usuarios as U inner join tipousuario as T on U.IdtipoUsuario = T.Idtipousuario where U.Correo = '" . $_SESSION['usuario'] . "'");
$fila = mysqli_fetch_array($comando);
$tipoUser = $fila[0];
$IdUsuario = $fila[1];
mysqli_free_result($comando);

$queryEntrega = "SELECT E.IdEntrega, T.Descripcion AS 'TipoRecolector', U.Nombre AS 'NomRecolector', P.Nombre AS 'Productor', E.Recibo, E.ResponsableEntrega, E.ResponsableRecepcion, E.fecha FROM entregas AS E INNER JOIN productores AS P ON E.IdProductor=P.IdProductor INNER JOIN usuarios AS U ON E.IdUsuario=U.IdUsuario INNER JOIN tipousuario AS T ON T.Idtipousuario=U.Idtipousuario";
switch ($_POST['Opcion']) {
    //Admin
    case 'ConsultaGeneral':
        realizarConsulta($queryEntrega);
        break;
    case "ConsultaXFecha":
        $queryEntrega = $queryEntrega + " WHERE Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "' ";
        break;
    case "ConsultaXProductor":
        $queryEntrega = $queryEntrega + "WHERE IdProductor = '" . $_POST['IdProdu'] . "'";
        break;
    case "ConsultaXFechaYProduct":
        $queryEntrega = $queryEntrega + "WHERE IdProductor = '" . $_POST['IdProdu'] . "' AND Fecha BETWEEN '" . $_POST['FI'] . "' AND '" . $_POST['FF'] . "'";
        break; 

    //Distribuidor    
    case "DistribuidorConsultaGeneral":
        $queryEntrega = $queryEntrega + "WHERE ";
        break;
    case "DistribuidorConsultaXFecha":

        break;
    case "DistribuidorConsultaXProductor":

        break;
    case "DistribuidorConsultaXFechaYProduct":

        break;   
    default:
        # code...
        break;
}

function realizarConsulta($queryCorrecto){
    $comando = mysqli_query($enlace, $queryCorrecto);
    
    if (mysqli_num_rows($comando) == 0) {
        echo ("Error");
    } else {
        while ($datos = mysqli_fetch_assoc($comando)) {
            $consulta["data"][] = $datos;
        } 
        echo (json_encode($consulta));
    }
    mysqli_free_result($comando);
}

?>