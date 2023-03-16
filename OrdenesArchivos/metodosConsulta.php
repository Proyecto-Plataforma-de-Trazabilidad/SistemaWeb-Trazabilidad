<?php

include("../conexion.php");

$tipo = $_POST['tipo'];

switch ($tipo) {
    case 'orden':
        consultaOrden();
        break;

    case 'detalle':
        consultadetalle();
        break;

    default:
        echo "Variable enviada fallida";
        break;
}


function consultaOrden()
{

    if ($_POST['FI'] == null && $_POST['FF'] == null) {
        include("../conexion.php");
        $queryOrden = "CALL ordenFechas(null,null);";
        echo $queryOrden;
        $comando = mysqli_query($enlace, $queryOrden);
        while ($row = mysqli_fetch_array($comando)) {
            echo "
            <tr>
                <td>" . $row[0] . "</td>
                <td>" . $row[1] . "</td>
                <td>" . $row[2] . "</td>
                <td>" . $row[3] . "</td>
                <td>" . $row[4] . "</td>
                <td>" . $row[5] . "</td>
                <td>" . $row[6] . "</td>
                <td>" . $row[7] . "</td>
                <td class='iconos' ><button class='detalle-btn' id='iconDetalle' data-idOrden='" . $row[0] . "' ><img src='../Recursos/Iconos/detalle.svg' alt='Icono de detalle'></button></td>
                <td class='iconos' ><button class='detalle-btn' id='editar' data-idOrden='" . $row[0] . "' ><img src='../Recursos/Iconos/editar.svg' alt='Icono de detalle'></button></td>
            </tr>
            ";
        }
        mysqli_close($enlace);
    } else {
        include("../conexion.php");
        $queryOrden = "CALL ordenFechas('" . $_POST['FI'] . "',' " . $_POST['FF'] . "');";
        echo $queryOrden;
        $comando = mysqli_query($enlace, $queryOrden);
        while ($row = mysqli_fetch_array($comando)) {
            echo "
            <tr>
                <td>" . $row[0] . "</td>
                <td>" . $row[1] . "</td>
                <td>" . $row[2] . "</td>
                <td>" . $row[3] . "</td>
                <td>" . $row[4] . "</td>
                <td>" . $row[5] . "</td>
                <td>" . $row[6] . "</td>
                <td>" . $row[7] . "</td>
                <td class='iconos' ><button class='detalle-btn' id='iconDetalle' data-idOrden='" . $row[0] . "' ><img src='../Recursos/Iconos/detalle.svg' alt='Icono de detalle'></button></td>
                <td class='iconos' ><button class='detalle-btn' id='editar' data-idOrden='" . $row[0] . "' ><img src='../Recursos/Iconos/editar.svg' alt='Icono de detalle'></button></td>
            </tr>
            ";
        }
        mysqli_close($enlace);
    }


}

function consultadetalle()
{

    include("../conexion.php");
    $queryOrden = "SELECT * FROM detalleorden";
    $comando = mysqli_query($enlace, $queryOrden);
    while ($row = mysqli_fetch_array($comando)) {
        echo "
            <tr>
                <td>" . $row[0] . "</td>
                <td>" . $row[1] . "</td>
                <td>" . $row[2] . "</td>
                <td>" . $row[3] . "</td>
                <td>" . $row[4] . "</td>
                <td>" . $row[5] . "</td>        
                <td class='iconos' ><button class='detalle-btn' id='editar' data-idOrden='" . $row[0] . "' ><img src='../Recursos/Iconos/editar.svg' alt='Icono de detalle'></button></td>
            </tr>
            ";
    }
    mysqli_close($enlace);
}

?>